<?php

class ContentController extends VController
{
	public function actionIndex()
	{
                $username=$_SESSION['nickname'];
		$flag=1;
		$res = Common::getUser($username,$flag);
		$page = 100;
		$data = $this->getPageInfo($page);
		$list = array();
		if(!empty($_REQUEST['title'])){
			$list['title']=$_REQUEST['title'];
		}
		if(empty($res['cp'])){
			if(!empty($_REQUEST['cp'])){
				$list['cp']=$_REQUEST['cp'];
			}
		}else{
			$list['cp']=$res['cp'][0];
		}
                if(!empty($_REQUEST['ShowType'])){
			$list['ShowType']=$_REQUEST['ShowType'];
		}
                if(isset($_REQUEST['flag'])){
			$list['flag']=$_REQUEST['flag'];
		}
		if(!empty($_REQUEST['first'])){
			$list['first']=strtotime($_REQUEST['first']);
		}
		if(!empty($_REQUEST['timeend'])){
			$list['timeend']=strtotime($_REQUEST['timeend']);
		}
	        if(!empty($_REQUEST['isfree'])){
			$list['isfree'] = $_REQUEST['isfree'];
		}
		$tmp =VideoManager::getContentData($data,$list);
		$url = $this->createUrl($this->action->id);
		$pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage'],$tmp['alwaysCount']);
                $list = array();
		if(in_array('1',$res['status']) || in_array('3',$res['status']) || $_SESSION['auth']=='1'){
			$list = $tmp['list'];
		}
		$this->render('index',array('list'=>$tmp['list'],'page'=>$pagination,'res'=>$res));
	}

	public function actionAdd(){
		try {
			if(!empty($_POST)){
				if(empty($_REQUEST['id'])){
					$video = new Video();
				}else{
					$video = Video::model()->findByPk($_REQUEST['id']);
				}
				$extra = VideoExtra::model()->find("vid='{$_REQUEST['vid']}'");
				if(empty($extra)){
					$extra = new VideoExtra();
				}
				if(!empty($_POST['title'])) $video->title=$_POST['title'];
				if(!empty($_POST['cp'])){
					switch($_POST['cp']){
					    case '华数':$cp='642001';break;
						case '百视通':$cp='BESTVOTT';break;
						case '未来电视':$cp='ICNTV';break;
						case '南传':$cp='youpeng';break;
						case '芒果':$cp='HNBB';break;
						case '国广':$cp='CIBN';break;
						case '银河':$cp='YGYH';break;
						case '咪咕':$cp='poms';break;
                                        }
					$video->cp=$cp;
				}
                                $arr = implode(' ',$_POST['type']);
				if(!empty($_POST['type'])) $video->type = !empty($arr) ? $arr : ' ';
				$video->flag='0';
                                $video->upTime = time();
                                $video->ShowType = !empty($_POST['ShowType'])?$_POST['ShowType']:'1';
                                $video->simple_set = isset($_POST['simple_set'])?$_POST['simple_set']:'';
                                $video->templateType = !empty($_POST['templateType'])?$_POST['templateType']:'';
                                $video->short = !empty($_POST['short'])?$_POST['short']:'';
				if(!empty($_POST['info'])) $video->info=!empty($_POST['info'])?$_POST['info']:'';
				//if(!empty($_POST['type'])) $video->type=!empty($_POST['type'])?$_POST['type']:'';
				if(!empty($_POST['initial'])) $video->initial=!empty($_POST['initial'])?$_POST['initial']:'';
				if(!empty($_POST['year'])) $video->year=!empty($_POST['year'])?$_POST['year']:'';
				if(!empty($_POST['director'])) $video->director=!empty($_POST['director'])?$_POST['director']:'';
				if(!empty($_POST['actor'])) $video->actor=!empty($_POST['actor'])?$_POST['actor']:'';
				if(!empty($_POST['keyword'])) $video->keyword=!empty($_POST['keyword'])?$_POST['keyword']:'';
				if(!empty($_POST['CountryOfOrigin'])) $video->CountryOfOrigin=!empty($_POST['CountryOfOrigin'])?$_POST['CountryOfOrigin']:'';
				if(!empty($_POST['language'])) $video->language=$_POST['language'];
				if(!empty($_POST['vid'])) $extra->vid=$_REQUEST['vid'];
				$extra->prize=!empty($_POST['prize'])?$_POST['prize']:'null';
				$extra->boxoffice=!empty($_POST['boxoffice'])?$_POST['boxoffice']:'null';
				$extra->comment=!empty($_POST['comment'])?$_POST['comment']:'null';
				$extra->end=!empty($_POST['end'])?$_POST['end']:'';
				$extra->orders=!empty($_POST['orders'])?$_POST['orders']:'0';
				$extra->subtitles=!empty($_POST['subtitles'])?$_POST['subtitles']:'';
                                $video->score=!empty($_POST['score'])?$_POST['score']:'';
                                $extra->score=!empty($_POST['score'])?$_POST['score']:'';
                                $extra->total=!empty($_POST['total'])?$_POST['total']:'0';
                                $extra->tvstation=!empty($_POST['tvstation'])?$_POST['tvstation']:'0';
                                $extra->bftime=!empty($_POST['bftime'])?$_POST['bftime']:'';
				$extra->cp=$cp;
				$video->save();
				$extra->save();
				if(!$video->save()){
                                        //echo 1;die;
					var_dump($video->getErrors());
					LogWriter::logModelSaveError($video,__METHOD__,$video->attributes);
					throw new ExceptionEx('信息保存失败');
				}
				if(!$extra->save()){
                                       echo 2;die;
					var_dump($extra->getErrors());
					LogWriter::logModelSaveError($extra,__METHOD__,$extra->attributes);
					throw new ExceptionEx('信息保存失败');
				}
                                //echo 1;die;
				$this->PopMsg('保存成功');
				$this->redirect($this->get_url('content','add',array('vid'=>$_REQUEST['vid'],'id'=>$_REQUEST['id'])));
			}
			$vid = $_REQUEST['vid'];
			$id = $_REQUEST['id'];
			$data = Video::model()->find("id = $id");
			$arr = array();
			$list= array();
			if (!empty($data)) {
				$arr = $data->attributes;
                                $arr['type']=explode(' ',$arr['type']);
                                $groupid = $arr['vid'];
                                $lable= $arr['keyword'];
				$fee=$arr['prdpack_id'];
				$playTime=$arr['first_play_time'];
				//var_dump($lable);
				//pa = "/[^\d,]*/";
				$pa = "/^[\d,']+$/";
				preg_match($pa, $lable, $match);
                                //var_dump($match);
                                $arr['str']='';
				if(!empty($match)){
                                        //var_dump($match);
					$str = KeyWordManager::getKeyword($lable);
					$arr['str']=$str;
				}
				$list = VideoManager::findlist($groupid);
                                //$showtype = $arr['ShowType'];
                                //$tmp=array();
                                //if($showtype=='Movie' || $showtype=='News'){
                                  // $tmp = VideoManager::getVideoList($vid,$id);
                                //} 
			}
			$dataextra = VideoExtra::model()->find("vid = '$vid'");
			$extra = array();
			if (!empty($dataextra)) {
				$extra = $dataextra->attributes;
			}
                        $reject=array();
                        $reject = VerReject::model()->find(" vid='$vid' and flag='2' order by id desc");
			$pic = VideoPic::model()->findAll("vid = '$vid' order by type desc");
			if($arr['CountryOfOrigin'] == '100'){
                                if( $data->attributes['region'] == '内地'){
                                        $arr['CountryOfOrigin'] = '1';
                                }else if($data->attributes['region'] == '港台'){
                                        $arr['CountryOfOrigin'] = '2';
                                }else if($data->attributes['region'] == '韩日'){
                                        $arr['CountryOfOrigin'] = '3';
                                }else if($data->attributes['region'] == '欧美'){
                                        $arr['CountryOfOrigin'] = '4';
                                }else if($data->attributes['region'] == '东南亚'){
                                        $arr['CountryOfOrigin'] = '5';
                                }else{
					$tmp_sql = "select CountryOfOrigin from yd_video where CountryOfOrigin not in(99,100) group by CountryOfOrigin order by CountryOfOrigin desc";
					$tmp_res = SQLManager::queryRow($tmp_sql);
					if($tmp_res['CountryOfOrigin']==99){
					   $tmp_res['CountryOfOrigin']=101;
					}else if($tmp_res['CountryOfOrigin']==100){
					   $tmp_res['CountryOfOrigin']=102;
					}
					$a= (int)$tmp_res['CountryOfOrigin'] + 1;
					//var_dump($a);die;
					$data->CountryOfOrigin = $a;
					//var_dump($data->CountryOfOrigin);die;
					if(!$data->save()){
						var_dump($data->getErrors());
						LogWriter::logModelSaveError($data,__METHOD__,$data->attributes);	
					}
					$tmp_data = Video::model()->find("id = $id");
					$arr['CountryOfOrigin']	= $tmp_data->attributes['CountryOfOrigin'];
				}
                                //$arr['CountryOfOrigin'] = $data->attributes['region'];
                        }
			$this->render('add', array( 'arr' => $arr,'extra'=>$extra, 'vid' => $_REQUEST['vid'],'pic'=>$pic,'list'=>$list,'reject'=>$reject,"fee"=>$fee,"playtime"=>$playTime));
		}catch (ExceptionEx $ex){
			$this->PopMsg($ex->getMessage());
		}catch (Exception $e){
			$this->log($e->getMessage());
		}
	}

	public function actionAccess(){
		try {
			//var_dump($_REQUEST);die;
			$resulst = Video::model()->updateAll(array('flag'=>3),'id=:id',array(':id'=>$_REQUEST['gid']));
			$id = $_REQUEST['gid'];
			$video = VerContent::model()->find("vid=$id");
			if(empty($video)){
				$video = new VerContent();
			}
			//var_dump($video);
			$video->cTime = time();
			$video->status='0';
			$video->flag='0';
			$video->vid = $id;
			//var_dump($video);die;
			if(!$video->save()){
				var_dump($video->getErrors());
				LogWriter::logModelSaveError($video,__METHOD__,$video->attributes);
				throw new ExceptionEx('入库失败');
			}
		}catch (ExceptionEx $ex){
			$this->PopMsg($ex->getMessage());
		}catch (Exception $e){
			$this->log($e->getMessage());
		}
	}

	public function actionMessage(){
		//try{
			if(empty($_REQUEST['id'])){
				$message = new VerMessage();
			}else{
				$message = VerMessage::model()->findByPk($_REQUEST['id']);
			}
			if(!empty($_POST)){
				//var_dump($_POST);die;
				$stationId=$_REQUEST['gid'];
				$start = !empty($_REQUEST['firstTime'])?strtotime($_REQUEST['firstTime']):'';
				$end= !empty($_REQUEST['endTime'])?strtotime($_REQUEST['endTime']):'';
				if(!empty($_REQUEST['id'])){
					$sql="select id from yd_ver_message where gid=$stationId and id<>{$_REQUEST['id']} AND ((endTime>={$end} and firstTime<={$start}) or (firstTime<={$end} and firstTime>={$start}) or (endTime>={$start} and endTime<={$end}))";
				}else{
					$sql="select id from yd_ver_message where gid=$stationId AND ((endTime>={$end} and firstTime<={$start}) or (firstTime<={$end} and firstTime>={$start}) or (endTime>={$start} and endTime<={$end}))";
				}
				//echo $sql;die;
				$res=SQLManager::queryRow($sql);
				if(!empty($res)){
					$this->PopMsg('已存在相同时间内同站点的消息');
				}else{
					$adminLeftOneName = !empty($_POST['adminLeftOneName'])?$_POST['adminLeftOneName']:'';
					$adminLeftTwoName = !empty($_POST['epg'])?$_GET['epg']:$_POST['adminLeftTwoName'];
					$adminLeftOne = !empty($_POST['adminLeftOne'])?$_POST['adminLeftOne']:'';
					$adminLeftTwo = !empty($_POST['adminLeftTwo'])?$_POST['adminLeftTwo']:'';
					$message->action = !empty($_POST['action'])?$_POST['action']:'';
					$message->title = !empty($_POST['title'])?$_POST['title']:'';
					$message->param = !empty($_POST['param'])?$_POST['param']:'';
					$message->vid = !empty($_POST['upvid'])?$_POST['upvid']:'';
					$message->gid = !empty($_POST['gid'])?$_POST['gid']:'1';
					$message->url = !empty($_POST['url'])?$_POST['url']:'';
					$message->type = !empty($_POST['type'])?$_POST['type']:'';
					$message->uType = !empty($_POST['uType'])?$_POST['uType']:'';
					$message->info = !empty($_POST['info'])?$_POST['info']:'';
					$firstTime = !empty($_POST['firstTime'])?$_POST['firstTime']:'';
					$message->firstTime = strtotime($firstTime);
					$endTime = !empty($_POST['endTime'])?$_POST['endTime']:'';
					$message->endTime = strtotime($endTime);
					$message->cTime = time();
					$message->flag = '0';
					$message->cp = !empty($_POST['cp'])?$_POST['cp']:'';
					if(!$message->save()){
						var_dump($message->getErrors());
						LogWriter::logModelSaveError($message,__METHOD__,$message->attributes);
						throw new ExceptionEx('入库失败');
					}
					$this->PopMsg('保存成功');
					//$this->redirect($this->get_url('content','msgindex'));
					$this->redirect($this->get_url('content','msgindex',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName)));
				}
			}
		//}catch (ExceptionEx $ex){
			//$this->PopMsg($ex->getMessage());
		//}catch (Exception $e){
			//$this->log($e->getMessage());
		//}
		$this->render('message',array('message'=>$message));
	}

	public function actionDel(){
		$id = $_REQUEST['id'];
		$resulst = Video::model()->updateAll(array('targetgroupassetid'=>0),'id=:id',array(':id'=>$_REQUEST['id']));
	}
        
        public function actionDelete(){
		$id = $_REQUEST['id'];
		$result = VideoPic::model()->deleteByPk($_REQUEST['id']);
	}
        public function actionSubmit(){
		$id = $_REQUEST['id'];
		$delFlag = $_REQUEST['flag'];
		$video = Video::model()->findByPk($id);
                $video->endDateTime='0';
		$video->startDateTime='0';
		$video->ShowType=!empty($_REQUEST['ShowType'])?$_REQUEST['ShowType']:'';
		$video->info=!empty($_REQUEST['info'])?$_REQUEST['info']:'';
		$video->delFlag = $delFlag;
		$video->save();
		var_dump($video->getErrors());
        }
        public function actionUpload(){
		$vid = $_REQUEST['vid'];
		$title = $_REQUEST['title'];
		switch($_REQUEST['cp']){
			case '华数':$cp='642001';break;
			case '百视通':$cp='BESTVOTT';break;
			case '未来电视':$cp='ICNTV';break;
			case '南传':$cp='youpeng';break;
			case '芒果':$cp='HNBB';break;
			case '国广':$cp='CIBN';break;
			case '银河':$cp='YGYH';break;
			case '咪咕':$cp='poms';break;
		}
		$n = $this->renderPartial(
				'upload',
				array(
						'vid'=>$vid,
						'title'=>$title,
						'cp'=>$cp,
				),
				true
		);
		die(json_encode(array('code'=>200,'msg'=>$n)));
	}
        public function actionAlert(){
		$id = $_REQUEST['id'];
		$tmp = VideoManager::getVideo($id);
		$n = $this->renderPartial(
				'alert',
				array(
						'tmp'=>$tmp,
				),
				true
		);
		die(json_encode(array('code'=>200,'msg'=>$n)));
	}
        public function actionPicAdd(){
		//var_dump($_REQUEST);die;
				$pic = new VideoPic();
				//$pic->url = 'http://117.144.248.58:8082/file/'.$_REQUEST['url'];
                                $piclist = trim($_REQUEST['url']);
        			$piclist = basename($piclist);
                                //Common::synchroPic($piclist);
        			//$pic->url = 'http://117.131.17.46:8086/file/' . $piclist;
        			//$pic->url = 'http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $piclist;
        			//$pic->url = 'http://117.144.248.58:8082/file/' . $piclist;
				$pic->url=FTP_PATH.$piclist;
				$pic->title=$_REQUEST['title'];
				$pic->cp=$_REQUEST['cp'];
				$pic->vid=$_REQUEST['vid'];
				$pic->md5=rand(0,100000);
				$pic->size=$_REQUEST['size'];
				$pic->type=$_REQUEST['type'];
				$pic->cTime = time();
                                $pictype = VideoPic::model()->find("vid = '{$_REQUEST['vid']}' and type='{$_REQUEST['type']}'");
				if(!empty($pictype)){
					$newid = $pictype->attributes['id'];
					$res = VideoPic::model()->updateAll(array('type'=>0),'id=:id',array(':id'=>$newid));
				}
				//var_dump($pic);die;
				//$pic->save();
		        if(!$pic->save()){
					var_dump($pic->getErrors());
				}else{
					$this->die_json(array('code'=>200));
				}
	}
        public function actionOrder(){
		$id = $_REQUEST['id'];
		$video = Video::model()->findByPk($id);
		$video->order = $_REQUEST['order'];
		$video->save();
		var_dump($video->getErrors());
	}
        public function actionColadd(){
		$vid = $_REQUEST['vid'];
		$n = $this->renderPartial(
				'coladd',
				array(
						'vid'=>$vid,
				),
				true
		);
		die(json_encode(array('code'=>200,'msg'=>$n)));
	}

	public function actionData(){
		$page = 10;
		$data = $this->getPageInfo($page);
		$title = $_REQUEST['title'];
		$tmp =VideoManager::getInfo($data,$title);
		$res['list'] = $tmp['list'];
		$res['total_num'] = $tmp['count'];
		$res['page_size']=10;
		$res['page_total_num']=ceil($res['total_num']/$res['page_size']);
		echo json_encode($res);
	}

	public function actionAjaxAdd(){
		$vid = $_REQUEST['vid'];
		$arr=explode(' ',trim($_REQUEST['ids']));
		foreach($arr as $k=>$v){
			$res = Video::model()->updateAll(array('targetgroupassetid'=>$vid),'id=:id',array(':id'=>$v));
		}
	}
        public function actionCollection(){
		try{
			if(!empty($_POST)){
				$adminLeftOneName = !empty($_POST['adminLeftOneName'])?$_POST['adminLeftOneName']:'';
                                $adminLeftTwoName = !empty($_POST['epg'])?$_GET['epg']:$_POST['adminLeftTwoName'];
                		$adminLeftOne = !empty($_POST['adminLeftOne'])?$_POST['adminLeftOne']:'';
                		$adminLeftTwo = !empty($_POST['adminLeftTwo'])?$_POST['adminLeftTwo']:'';
				if(empty($_REQUEST['id'])){
					$video = new Video();
				}else{
					$video = Video::model()->findByPk($_REQUEST['id']);
				}
                                $vid = 'c'.time();
				$extra = VideoExtra::model()->find("vid='{$vid}'");
				if(empty($extra)){
					$extra = new VideoExtra();
				}
                                if(!empty($_POST['title'])) $video->title=$_POST['title'];
                                if(!empty($_POST['cp'])){
                                        switch($_POST['cp']){
                                            case '华数':$cp='642001';break;
                                                case '百视通':$cp='BESTVOTT';break;
                                                case '未来电视':$cp='ICNTV';break;
                                                case '南传':$cp='youpeng';break;
                                                case '芒果':$cp='HNBB';break;
                                                case '国广':$cp='CIBN';break;
                                                case '银河':$cp='YGYH';break;
						case '咪咕':$cp='poms';break;
                                        }
                                        $video->cp=$cp;
                                }
                                $arr = implode(' ',$_POST['type']);
                                if(!empty($_POST['type'])) $video->type = !empty($arr) ? $arr : ' ';
                                $video->flag='0';
                                $video->upTime = time();
                                $video->vid = time();
                                $video->IsAdvertise='0';
                                $video->cTime = time();
                                $video->ShowType = !empty($_POST['ShowType'])?$_POST['ShowType']:'1';
                                $video->simple_set = isset($_POST['simple_set'])?$_POST['simple_set']:'';
                                $video->templateType = !empty($_POST['templateType'])?$_POST['templateType']:'';
                                $video->short = !empty($_POST['short'])?$_POST['short']:'';
                                if(!empty($_POST['info'])) $video->info=!empty($_POST['info'])?$_POST['info']:'';
                                //if(!empty($_POST['type'])) $video->type=!empty($_POST['type'])?$_POST['type']:'';
                                if(!empty($_POST['initial'])) $video->initial=!empty($_POST['initial'])?$_POST['initial']:'';
                                if(!empty($_POST['year'])) $video->year=!empty($_POST['year'])?$_POST['year']:'';
                                if(!empty($_POST['director'])) $video->director=!empty($_POST['director'])?$_POST['director']:'';
                                if(!empty($_POST['actor'])) $video->actor=!empty($_POST['actor'])?$_POST['actor']:'';
                                if(!empty($_POST['keyword'])) $video->keyword=!empty($_POST['keyword'])?$_POST['keyword']:'';
                                if(!empty($_POST['CountryOfOrigin'])) $video->CountryOfOrigin=!empty($_POST['CountryOfOrigin'])?$_POST['CountryOfOrigin']:'';
                                if(!empty($_POST['language'])) $video->language=$_POST['language'];
                                $extra->vid=$vid;
                                $extra->prize=!empty($_POST['prize'])?$_POST['prize']:'null';
                                $extra->boxoffice=!empty($_POST['boxoffice'])?$_POST['boxoffice']:'null';
                                $extra->comment=!empty($_POST['comment'])?$_POST['comment']:'null';
                                $extra->end=!empty($_POST['end'])?$_POST['end']:'2';
                                $extra->orders=!empty($_POST['orders'])?$_POST['orders']:'0';
                                $extra->subtitles=!empty($_POST['subtitles'])?$_POST['subtitles']:'';
                                $video->score=!empty($_POST['score'])?$_POST['score']:'';
                                $extra->score=!empty($_POST['score'])?$_POST['score']:'';
                                $extra->total=!empty($_POST['total'])?$_POST['total']:'0';
                                $extra->tvstation=!empty($_POST['tvstation'])?$_POST['tvstation']:'0';
                                $extra->bftime=!empty($_POST['bftime'])?$_POST['bftime']:'';
                                $extra->cp=$cp;
                                $video->save();
                                $extra->save();
				if(!$video->save()){
					var_dump($video->getErrors());
					LogWriter::logModelSaveError($video,__METHOD__,$video->attributes);
					throw new ExceptionEx('信息保存失败');
				}
				if(!$extra->save()){
					var_dump($extra->getErrors());
					LogWriter::logModelSaveError($extra,__METHOD__,$extra->attributes);
					throw new ExceptionEx('信息保存失败');
				}
				$this->PopMsg('保存成功');
				$this->redirect($this->get_url('content','index',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName)));

			}
			
			//$this->render('collection',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName));
			$this->render('collection');
		}catch (ExceptionEx $ex){
			$this->PopMsg($ex->getMessage());
		}catch (Exception $e){
			$this->log($e->getMessage());
		}

	}
	public function actionUp($filename){
		if (!empty($filename)) {
			if ($_FILES[$filename]["error"] > 0) {
				$this->error('上传文件错误! 错误代码:' . $_FILES[$filename]['error'], '', 3);
			}
			$dir =  './Public/uploads/';
			//echo $dir;die();
			$name = date('YmdHis') . mt_rand(0000, 9999);
			//$expand_arr = explode('/',$_FILES['media']['type']);
			//$expand = '.'.$expand_arr[1];
			$expand = '.' . pathinfo($_FILES[$filename]['name'], PATHINFO_EXTENSION);
			if (is_uploaded_file($_FILES[$filename]["tmp_name"])) {
				if (move_uploaded_file($_FILES[$filename]["tmp_name"], $dir . $name . $expand)) {
					$path = $name . $expand;
					//$path = isset($name) ? $name . $expand : '';
				} else {
					$this->error('上传服务器临时错误');
				}
			} else {
				$this->error('非法上传方法');
			}
		}
		return $path;
	}

        public function actionPic(){
		$pic = VideoPic::model()->findByPk($_REQUEST['id']);
		$url = $pic->attributes['url'];
		$n = $this->renderPartial(
				'pic',
				array(
						'url'=>$url,
				),
				true
		);
		die(json_encode(array('code'=>200,'msg'=>$n)));
	}
        public function actionBofang(){
		$id = $_REQUEST['id'];
		$videolist = VideoList::model()->findByPk($id);
		$vid = $videolist->attributes['vid'];
		$res = VideoList::model()->updateAll(array('flag'=>0),'vid=:vid',array(':vid'=>$vid));
		$result = VideoList::model()->updateAll(array('flag'=>1),'id=:id',array(':id'=>$id));
                if($result){
			echo json_encode(array('code'=>200));
		}else{
			echo json_encode(array('code'=>404));
		}

	}
        public function actionPicType(){
		$vid=$_REQUEST['vid'];
		$arr = explode('_',$_REQUEST['flag']);
		$id = $arr[0];
		$type = $arr[1];
		$pic = VideoPic::model()->find("type='$type' and vid = '$vid'");
		if(empty($pic)){
			$res = VideoPic::model()->updateAll(array('type'=>$type),'id=:id',array(':id'=>$id));
		}else{
			$newid = $pic->attributes['id'];
			$res = VideoPic::model()->updateAll(array('type'=>0),'id=:id',array(':id'=>$newid));
			$res = VideoPic::model()->updateAll(array('type'=>$type),'id=:id',array(':id'=>$id));
		}
	}
        public function actionSubRev(){
		$arr=explode(' ',trim($_REQUEST['ids']));
                $username = $_REQUEST['username'];
            //var_dump($username);
            $time=time();
            $flag=1;
            $workid = Common::EditWorkid($username,$flag);
		foreach($arr as $k=>$v){
                        $tmp = Video::model()->findByPk($v);
            $vid = $tmp->attributes['vid'];
            $reject = VerReject::model()->find("vid='$vid'");
            if(empty($reject)){
                $reject = new VerReject();
            }
            $reject->user = $username;
            $reject->addTime=$time;
            $reject->vid=$vid;
            $reject->flag='1';
            $reject->save();
			$res = Video::model()->updateAll(array('flag'=>1,'workid'=>$workid,'upTime'=>$time),'id=:id',array(':id'=>$v));
		}
	}
        public function actionMsgIndex(){
                $username=$_SESSION['nickname'];
		$flag= '4';
		$res  = Common::getUser($username,$flag);
		$uid = $_SESSION['userid'];
            $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 4 left join yd_ver_worker as c on c.workid=b.id where c.uid=$uid group by a.id";
            $st = SQLManager::QueryAll($sql);
	
		$page = 20;
		$data = $this->getPageInfo($page);
		$list = array();
		if(!empty($_REQUEST['title'])){
			$list['title']=$_REQUEST['title'];
		}
		if(!empty($_REQUEST['stationId'])){
         	   $list['stationId']=$_REQUEST['stationId'];
        	}
		$str = "";
		if(!empty($st) && $_SESSION['auth'] <> 1){
			foreach($st as $k=>$v){
			$str .= ",'". $v['id']."'";
		}
		 $list['uid']=substr($str,1,strlen($str)-1);
		}
	
		$tmp =MessageManager::getMsgList($data,$list);
		$url = $this->createUrl($this->action->id);
		$pagination = $this->renderPagination($url,count($tmp['list']),$page,$data['currentPage'],$tmp['alwaysCount']);
                $test=array();
		//if(in_array('1',$res['status']) || $_SESSION['auth']=='1'){
			$test = $tmp['list'];
		//}
		$this->render('msgindex',array('list'=>$test,'page'=>$pagination,'res'=>$res));
	}

    public function actionMsgDel(){
		$id = $_REQUEST['id'];
		//$res = VerMessage::model()->deleteByPk($id);
		//$res = VerMessage::model()->updateByPk($id,'delFlag',array('delFlag'=>1));
        $username = $_SESSION['nickname'];
        $flag=4;

        $review_flag = 3;   //提交审核
        $review_times = 1;
        $review_message = '删除消息提审';
        $bind_id = $_REQUEST['id'];
        $review_type = 1;   //消息
        $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);

        $workid = Common::EditWorkid($username,$flag);

        $result = VerMessage::model()->updateAll(array('flag'=>1,'workid'=>$workid,'cTime'=>time(),'delFlag'=>1),'id=:id',array(':id'=>$_REQUEST['id']));

		if($result){
			echo json_encode(array('code'=>200,'msg'=>'删除消息提审成功'));
		}else{
			echo json_encode(array('code'=>404,'msg'=>'删除消息提审失败'));
		}
	}
        public function actionAllSubmit(){
		$groupid = $_REQUEST['vid'];
		$result = Video::model()->updateAll(array('delFlag'=>1),'targetgroupassetid=:targetgroupassetid',array(':targetgroupassetid'=>$groupid));
		$res = Video::model()->updateAll(array('delFlag'=>1),'vid=:vid',array(':vid'=>$groupid));
	}
        public function actionChangeTitle(){
		$id = $_REQUEST['id'];
		$video = Video::model()->findByPk($id);
		$video->title = $_REQUEST['title'];
		$video->save();
		var_dump($video->getErrors());
	}
        public function actionKeyWord(){
		$page = 50;
		$data = $this->getPageInfo($page);
		$list= array();
		if(!empty($_REQUEST['type'])){
			$list['type']=$_REQUEST['type'];
		}
		if(!empty($_REQUEST['title'])){
			$list['title']=$_REQUEST['title'];
		}
		
		$tmp =KeyWordManager::getData($data,$list);
		$url = $this->createUrl($this->action->id);
		$pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage'],$tmp['alwaysCount']);
		$this->render('keyword',array('list'=>$tmp['list'],'page'=>$pagination));
		//$this->render('keyword');
	}

	public function actionKeyAdd(){
		if(empty($_REQUEST['id'])){
			$id = '';
			$keyword = new VerKeyword();
		}else{
			$id = $_REQUEST['id'];
			$keyword = VerKeyword::model()->findByPk($id);
		}
		$n = $this->renderPartial(
				'keyadd',
				array(
					'id'=>$id,
					'keyword'=>$keyword
				),
				true
		);
		die(json_encode(array('code'=>200,'msg'=>$n)));
	}

	public function actionKeySub(){
		if(empty($_REQUEST['id'])){
			$keyword = new VerKeyword();
		}else{
			$keyword = VerKeyword::model()->findByPk($_REQUEST['id']);
		}
		$keyword->keyword = $_REQUEST['name'];
		$keyword->type = $_REQUEST['type'];
		$keyword->cTime = time();
		$keyword->save();
	}
        public function actionAllPlay(){
		$vid = $_REQUEST['vid'];
		$list = Video::model()->findAll("targetgroupassetid='$vid' or vid='$vid'");
		foreach($list as $k=>$v){
			$videolist = VideoList::model()->find("vid = {$v->attributes['vid']} order by filesize desc");
                        if(!empty($videolist)){
                            $videolist->flag = 1;
			    if(!$videolist->save()){
				var_dump($videolist->getErrors());
			    }
                        }
		}
		//var_dump($list);
	}
        public function actionKeyDel(){
		$id = $_REQUEST['id'];
		$res = VerKeyword::model()->deleteByPk($id);
		if($res){
			echo json_encode(array('code'=>200,'msg'=>'删除成功'));
		}else{
			echo json_encode(array('code'=>404,'msg'=>'删除失败'));
		}
	}
        public function actionKeyList(){

		$n = $this->renderPartial(
				'keylist',
				array(

				),
				true
		);
		die(json_encode(array('code'=>200,'msg'=>$n)));
	}

	public function actionAjax(){
		$p = $_REQUEST['page'];
		$list = array();
		if(!empty($_REQUEST['type'])){
			$list['type']=$_REQUEST['type'];
		}
		$tmp =KeyWordManager::getList($list,$p);
		$res['list'] = $tmp['list'];
		$res['total_num'] = $tmp['count'];
		//$res['page_size']=10;
		//$res['page_total_num']=ceil($res['total_num']/$res['page_size']);
		echo json_encode($res);
	}
       public function actionContentIndex()
    {
        $username=$_SESSION['nickname'];
        $flag=1;
        $res = Common::getUser($username,$flag);
        $page = 100;
        $data = $this->getPageInfo($page);
        $list = array();
        if(!empty($_REQUEST['title'])){
            $list['title']=$_REQUEST['title'];
        }
        if(!empty($_REQUEST['cp'])){
            $list['cp']=$_REQUEST['cp'];
        }
        if(!empty($_REQUEST['type'])){
            $list['type']=$_REQUEST['type'];
        }
        if(isset($_REQUEST['flag'])){
            $list['flag']=$_REQUEST['flag'];
        }
        if(!empty($_REQUEST['first'])){
            $list['first']=strtotime($_REQUEST['first']);
        }
        if(!empty($_REQUEST['end'])){
            $list['end']=strtotime($_REQUEST['end']);
        }
	if(!empty($_REQUEST['isfree'])){
	    $list['isfree'] = $_REQUEST['isfree']=="free"?1002261:1002381;
	}
        $tmp =ContentDataManager::getData($data,$list);
        $url = $this->createUrl($this->action->id);
        //$pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage']);
        $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage'],$tmp['alwaysCount']);
	$this->render('contentindex',array('list'=>$tmp['list'],'online'=>$tmp['online'],'offline'=>$tmp['offline'],'page'=>$pagination,'res'=>$res));
    }
    public function actionDataSub(){
        $vid = $_REQUEST['vid'];
        $flag= $_REQUEST['flag'];
        if($flag=='1'){
            $res = VerSite::model()->updateAll(array('status'=>0),'vid=:vid',array(':vid'=>$vid));
        }else{
            $res = VerSite::model()->updateAll(array('status'=>1),'vid=:vid',array(':vid'=>$vid));
        }
        $result = VerContent::model()->updateAll(array('flag'=>$flag),'vid=:vid',array(':vid'=>$vid));
        if($result){
            echo json_encode(array('code'=>200));
        }else{
            echo json_encode(array('code'=>404));
        }
    }

    public function actionAllSub(){
        $arr=explode(' ',trim($_REQUEST['ids']));
        $flag = $_REQUEST['flag'];
	if($flag == 1){
		$status = 0;
	}else{
		$status = 1;
	}
        foreach($arr as $k=>$v){
            $resulst = VerContent::model()->updateAll(array('flag'=>$flag),'vid=:vid',array(':vid'=>$v));
            $res = VerSite::model()->updateAll(array('status'=>$status,'upTime'=>time()),'vid=:vid',array(':vid'=>$v));
        }
    }

    public function actionRecall(){
        $vid = $_REQUEST['vid'];
        Yii::app()->db->createCommand()->delete('{{ver_site}}', "vid=$vid");
        $result = Yii::app()->db->createCommand()->delete('{{ver_content}}', "vid=$vid");
        $res = Video::model()->updateAll(array('flag'=>0),'vid=:vid',array(':vid'=>$vid));
        if($result){
            echo json_encode(array('code'=>200));
        }else{
            echo json_encode(array('code'=>404));
        }
    }
    public function actionDetail(){
		try {
			if(!empty($_POST)){
				if(empty($_REQUEST['id'])){
					$video = new Video();
				}else{
					$video = Video::model()->findByPk($_REQUEST['id']);
				}
				$extra = VideoExtra::model()->find("vid='{$_REQUEST['vid']}'");
				if(empty($extra)){
					$extra = new VideoExtra();
				}
				if(!empty($_POST['title'])) $video->title=$_POST['title'];
				if(!empty($_POST['cp'])){
					switch($_POST['cp']){
						case '华数':$cp='642001';break;
						case '百视通':$cp='BESTVOTT';break;
						case '未来电视':$cp='ICNTV';break;
						case '南传':$cp='youpeng';break;
						case '芒果':$cp='HNBB';break;
						case '国广':$cp='CIBN';break;
						case '银河':$cp='YGYH';break;
						case '咪咕':$cp='poms';break;
					}
					$video->cp=$cp;
				}
				$arr = implode(' ',$_POST['type']);
				if(!empty($_POST['type'])) $video->type = !empty($arr) ? $arr : ' ';
				$video->flag='0';
				$video->upTime = time();
				$video->ShowType = !empty($_POST['ShowType'])?$_POST['ShowType']:'';
				$video->simple_set = isset($_POST['simple_set'])?$_POST['simple_set']:'';
				$video->templateType = !empty($_POST['templateType'])?$_POST['templateType']:'';
				$video->short = !empty($_POST['short'])?$_POST['short']:'';
				if(!empty($_POST['info'])) $video->info=!empty($_POST['info'])?$_POST['info']:'';
				if(!empty($_POST['initial'])) $video->initial=!empty($_POST['initial'])?$_POST['initial']:'';
				if(!empty($_POST['year'])) $video->year=!empty($_POST['year'])?$_POST['year']:'';
				if(!empty($_POST['director'])) $video->director=!empty($_POST['director'])?$_POST['director']:'';
				if(!empty($_POST['actor'])) $video->actor=!empty($_POST['actor'])?$_POST['actor']:'';
				if(!empty($_POST['keyword'])) $video->keyword=!empty($_POST['keyword'])?$_POST['keyword']:'';
				if(!empty($_POST['CountryOfOrigin'])) $video->CountryOfOrigin=!empty($_POST['CountryOfOrigin'])?$_POST['CountryOfOrigin']:'';
				if(!empty($_POST['language'])) $video->language=$_POST['language'];
				if(!empty($_POST['vid'])) $extra->vid=$_REQUEST['vid'];
				$extra->prize=!empty($_POST['prize'])?$_POST['prize']:'null';
				$extra->boxoffice=!empty($_POST['boxoffice'])?$_POST['boxoffice']:'null';
				$extra->comment=!empty($_POST['comment'])?$_POST['comment']:'null';
				$extra->end=!empty($_POST['end'])?$_POST['end']:'';
				$extra->orders=!empty($_POST['orders'])?$_POST['orders']:'';
				$extra->subtitles=!empty($_POST['subtitles'])?$_POST['subtitles']:'';
				$video->score=!empty($_POST['score'])?$_POST['score']:'';
				$extra->score=!empty($_POST['score'])?$_POST['score']:'';
				$extra->total=!empty($_POST['total'])?$_POST['total']:'0';
				$extra->tvstation=!empty($_POST['tvstation'])?$_POST['tvstation']:'0';
				$extra->bftime=!empty($_POST['bftime'])?$_POST['bftime']:'';
				$extra->cp=$cp;
				$video->save();
				$extra->save();
				if(!$video->save()){
					var_dump($video->getErrors());
					LogWriter::logModelSaveError($video,__METHOD__,$video->attributes);
					throw new ExceptionEx('信息保存失败');
				}
				if(!$extra->save()){
					var_dump($extra->getErrors());
					LogWriter::logModelSaveError($extra,__METHOD__,$extra->attributes);
					throw new ExceptionEx('信息保存失败');
				}
				$this->PopMsg('保存成功');
				$this->redirect($this->get_url('content','add',array('vid'=>$_REQUEST['vid'],'id'=>$_REQUEST['id'])));
			}
			$vid = $_REQUEST['vid'];
			$id = $_REQUEST['id'];
			$data = Video::model()->find("id = $id");
			$arr = array();
			$list= array();
			if (!empty($data)) {
				$arr = $data->attributes;
				$arr['type']=explode(' ',$arr['type']);
				$groupid = $arr['vid'];
				$lable= $arr['keyword'];
				$pa = "/^[\d,']+$/";
				preg_match($pa, $lable, $match);
				$arr['str']='';
				if(!empty($match)){
					$str = KeyWordManager::getKeyword($lable);
					$arr['str']=$str;
				}
				$list = VideoManager::findlist($groupid);
			}
			$dataextra = VideoExtra::model()->find("vid = '$vid'");
			$extra = array();
			if (!empty($dataextra)) {
				$extra = $dataextra->attributes;
			}
			$pic = VideoPic::model()->findAll("vid = '$vid' order by type desc");
			$this->render('detail', array( 'arr' => $arr,'extra'=>$extra, 'vid' => $_REQUEST['vid'],'pic'=>$pic,'list'=>$list));
		}catch (ExceptionEx $ex){
			$this->PopMsg($ex->getMessage());
		}catch (Exception $e){
			$this->log($e->getMessage());
		}
	}


      public function actionMvAdd(){
                try {
                        $vid = $_REQUEST['vid'];
                        $id = $_REQUEST['id'];
                        $data = Video::model()->find("id = $id");
                        $arr = array();
                        $list= array();
                        if (!empty($data)) {
                                $arr = $data->attributes;
                                $arr['type']=explode(' ',$arr['type']);
                                $groupid = $arr['vid'];
                                $lable= $arr['keyword'];
                                $pa = "/^[\d,']+$/";
                                preg_match($pa, $lable, $match);
                                $arr['str']='';
                                if(!empty($match)){
                                        $str = KeyWordManager::getKeyword($lable);
                                        $arr['str']=$str;
                                }
                                $list = VideoManager::findlist($groupid);
                                $relist = VerReject::model()->find("vid=$vid");
                        }
                        $dataextra = VideoExtra::model()->find("vid = '$vid'");
                        $extra = array();
                        if (!empty($dataextra)) {
                                $extra = $dataextra->attributes;
                        }
                        $pic = VideoPic::model()->findAll("vid = '$vid' order by type desc");
                        $this->render('mvadd', array( 'arr' => $arr,'extra'=>$extra, 'vid' => $_REQUEST['vid'],'pic'=>$pic,'list'=>$list,'tmp'=>$relist));
                }catch (ExceptionEx $ex){
                        $this->PopMsg($ex->getMessage());
                }catch (Exception $e){
                        $this->log($e->getMessage());
                }
        }
	
	//演职员
	public function actionActor(){
	    $model=new cdbcriteria();
		$model->select="*";
		if(!empty($_REQUEST["title"])){//姓名
			$model->addSearchCondition('name',$_REQUEST["title"]);
		}
		if(!empty($_REQUEST["occupation"])){//职业
			$model->addSearchCondition("professon",$_REQUEST['occupation']);
		}
		if(isset($_REQUEST['sex']) && $_REQUEST["sex"]!=-1){//性别
			$model->addCondition("sex=:sex");
			$model->params["sex"]=$_REQUEST['sex'];
		}
		if(!empty($_REQUEST["nationality"])){//国籍
			$model->addCondition("nationality=:nationality");
			$model->params["nationality"]=$_REQUEST['nationality'];
		}
		$model->order="id asc,nationality asc";
		$page = 20;
		$model->limit=$page;
		$model->offset=isset($_REQUEST['page'])?($_REQUEST['page']-1)*$page:0;
		$data = $this->getPageInfo($page);
		$currentCount=VideoStar::model()->count($model);
		$info=VideoStar::model()->findAll($model);
		$count=VideoStar::model()->count();
		$url = $this->createUrl($this->action->id);
		$pagination = $this->renderPagination($url,$currentCount,$page,$data['currentPage'],$count);
		$this->render("actor",array("data"=>$info,"page"=>$pagination));	
	}

	public function actionEdit(){
	    $actorId=$_REQUEST['id'];
    	    $info=VideoStar::model()->findByPk($actorId);//基本信息
	    $starId=$info->starId;
	    $name=$info->name;
	    $keyword=trim($name);
	    $img=VideoStarImages::model()->findByAttributes(array("starId"=>$starId));//演员图片

	    /*$url="http://10.200.26.100:80/api/search/poms?mediaShape=全片,专题,连载&pageSize=999999999&keyword=$keyword";
	    $file=file_get_contents("$url");

	    $obj=simplexml_load_string($file, 'SimpleXMLElement', LIBXML_NOCDATA);
	    $result=array();
	    $res_s=array();
	    
	    $pagesize = 10;
	    $pageinfo = $this->getPageInfo($pagesize);
	    $page=isset($_REQUEST['page'])?$_REQUEST['page']:1;
	    $currentPage=($page-1)*10;

	    foreach($obj->searchResults->searchResult  as $k=>$v){//获取contid
		$result[]=array("contId"=>$v->contId);
	    }

	    $data=json_decode(json_encode($result),true);//xml对象转json对象，再转数组 contid数组

	    $sql_count="select count(id) from yd_video where actor like '%$keyword%' and cp='poms'";
  	    $total=SQLManager::queryRow($sql_count);
	    $count=$total['count(id)']; 
	
	    for($i=0;$i<count($data);$i++){
		$sql="select * from yd_video where vid={$data[$i]["contId"][0]} limit $currentPage,10";
		$res_s[$i]['info']=SQLManager::queryRow($sql);
		$res_s[$i]['contid']=$data[$i]["contId"][0];
	    }*/

	    $pagesize = 10;
            $pageinfo = $this->getPageInfo($pagesize);
            $page=isset($_REQUEST['page'])?$_REQUEST['page']:1;
            $currentPage=($page-1)*10;
	    $sql_count="select count(id) from yd_video where actor like '%$keyword%' and targetgroupassetid=0";
            $total=SQLManager::queryRow($sql_count);
            $count=$total['count(id)'];

	    $sql="select * from yd_video v left join yd_ver_content c on v.vid=c.vid where v.actor like '%$keyword%' and v.targetgroupassetid=0 limit $currentPage,10";
	    $res_s=SQLManager::queryAll($sql);
	//var_dump($res_s);die;
	    $url = $this->createUrl($this->action->id);//url
	    $pagination = $this->renderPagination($url,$count,10,$pageinfo['currentPage'],$count);
	    $this->render("edit",array("info"=>$info,"src"=>$img,"data"=>$res_s,"page"=>$pagination));
	}
}
