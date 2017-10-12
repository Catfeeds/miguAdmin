<?php

class ReviewController extends VController
{
    public function actionIndex()
    {
        $username=$_REQUEST['pro'];
        $flag= '1';
        $res  = Common::getUser($username,$flag);
        $page = 20;
        $data = $this->getPageInfo($page);
        $list = array();
        if(!empty($_REQUEST['type'])){
            $list['type']=$_REQUEST['type'];
        }
	
        if(!empty($res['cp'])){
            $list['cp']=$res['cp'];
        }else{
            if(!empty($_REQUEST['cp'])){
                $list['cp'][0]=$_REQUEST['cp'];
            }
        }
        $list['review']=$res['review'];
        if(!empty($_REQUEST['title'])){
	    $list['title']=$_REQUEST['title'];
	}
        if(!empty($_REQUEST['first'])){
            $list['first']=strtotime($_REQUEST['first']);
        }
        if(!empty($_REQUEST['timeend'])){
            $list['end'] = strtotime($_REQUEST['timeend']);
        }
        if(!empty($_REQUEST['allbtn'])){
            $allbtn=$_REQUEST['allbtn'];
            if($allbtn=='已通过'){
                $type =1;
                $tmp = ReviewManager::getContentLog($data,$type,$list);
            }else if($allbtn=='驳回'){
                $type =2;
                $tmp = ReviewManager::getContentLog($data,$type,$list);
            }else{
                $tmp =VideoManager::getReview($data,$list);
            }
        }else{
            $tmp =VideoManager::getReview($data,$list);
        }
        //$tmp =VideoManager::getReview($data,$list);
        $url = $this->createUrl($this->action->id);
        $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage'],$tmp['alwaysCount']);
        $list = array();
        if(!empty($res['review']) || $_SESSION['auth']=='1'){
            $list = $tmp['list'];
        }else{
            if(in_array('3',$res['status'])){
                $list=$tmp['list'];
            }
        }
        $this->render('index',array('list'=>$list,'page'=>$pagination,'res'=>$res));
    }

    public function actionAdd(){
        try {
            $username = $_REQUEST['username'];
            //var_dump($username);
            $flag=1;
            $workid = Common::EditWorkid($username,$flag);
            $tmp = Video::model()->findByPk($_REQUEST['gid']);
            $vid = $tmp->attributes['vid'];
            $reject = VerReject::model()->find("vid='$vid'");
            if(empty($reject)){
                $reject = new VerReject();
            }
            $reject->user = $username;
            $reject->addTime=time();
            $reject->vid=$vid;
            $reject->flag='1';
            $reject->save();
            $time=time();
            //var_dump($workid);die;
            $result = Video::model()->updateAll(array('flag'=>1,'workid'=>$workid,'upTime'=>$time),'id=:id',array(':id'=>$_REQUEST['gid']));
            //$resulst = Video::model()->updateAll(array('flag'=>1,'upTime'=>time()),'id=:id',array(':id'=>$_REQUEST['gid']));

        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
        }
    }
   
    public function actionAccess(){
        try {
            $vid = $_REQUEST['vid'];
            $username=$_REQUEST['nickname'];
            $flag= '1';
            $res  = Common::workid($username,$flag);
            $tmp = Video::model()->find("vid='$vid'");
            if($res=='1'){
                $this->Access($vid,$_REQUEST['gid']);
                $this->Rejectlog($vid,1);
                $this->AccessReject($vid,$_REQUEST['gid']);
            }else{
                if($tmp->attributes['flag']==$res || $tmp->attributes['flag']=='5'){
                    $this->Access($vid,$_REQUEST['gid']);
                    $this->Rejectlog($vid,1);
                    $this->AccessReject($vid,$_REQUEST['gid']);
                }else{
                    $flag=$tmp->attributes['flag']+1;
                    $this->Rejectlog($vid,1);
                    $result = Video::model()->updateAll(array('flag'=>$flag),'id=:id',array(':id'=>$_REQUEST['gid']));
                    $this->AccessReject($vid,$_REQUEST['gid']);
                    if($result){
                        echo json_encode(array('code'=>200));
                    }else{
                        echo json_encode(array('code'=>404));
                    }
                }
            }
            //$this->Access($vid);
        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
        }
    }

    public function actionAllSub(){
            $username = $_REQUEST['username'];
            $flag=1;
            $res  = Common::workid($username,$flag);
		$lists=array();
		$vidlist=array();
		$idlist=array();
        $arr=explode(' ',trim($_REQUEST['ids'])); 
		for($i=0;$i<count($arr);$i++){
			$lists=explode('_',$arr[$i]); 
			$vidlist[]=$lists[1]; //id
			$idlist[]=$lists[0];  //id
		}
		//存入vid
		//存入id
		foreach($idlist as $key=>$value){
                        $tmp = Video::model()->findByPk($value);
                        if($tmp->attributes['flag']==$res || $tmp->attributes['flag']=='5'){
                            $this->Access($tmp->attributes['vid'],$value);
                            $this->AccessReject($tmp->attributes['vid'],$value);
                            $this->Rejectlog($tmp->attributes['vid'],1);
                         }else{
                            $this->Rejectlog($tmp->attributes['vid'],1);
                    	    $newflag=$tmp->attributes['flag']+1;
                            $this->AccessReject($tmp->attributes['vid'],$value);
                    	    $result = Video::model()->updateAll(array('flag'=>$newflag),'id=:id',array(':id'=>$value));
                         } 

		}
		
    }


    public function AccessReject($vid,$gid){
                    $tmp = Video::model()->findByPk($gid);
                    $message = '通过';
                    $reject = VerReject::model()->find("vid = '$vid'");
                    if(empty($reject)){
                        $reject = new VerReject();
                    }
                    switch($tmp->attributes['flag']){
                        case '1':$reject->message1=$message;$reject->addTime1  = time();$reject->user1=$_SESSION['nickname'];break;
                        case '2':$reject->message2=$message;$reject->addTime2  = time();$reject->user2=$_SESSION['nickname'];break;
                        case '3':$reject->message3=$message;$reject->addTime3  = time();$reject->user3=$_SESSION['nickname'];break;
                        case '4':$reject->message4=$message;$reject->addTime4  = time();$reject->user4=$_SESSION['nickname'];break;
                        case '5':$reject->message5=$message;$reject->addTime5  = time();$reject->user5=$_SESSION['nickname'];break;
                    }
                    $reject->flag='1';
                    $reject->delFlag='0';
                    $reject->vid  = $vid;
                    $reject->save();
    } 

    public function Access($vid,$id){
        //$vid = $_REQUEST['vid'];
             $list = VerContent::model()->find("vid='$vid'");
             if(empty($list)){
                        $list=new VerContent();
             }
                        $list->vid=$vid;
                        $list->flag=0;
                        $list->status=0;
                        $list->cTime=time();
                        $list->delFlag=0;
                        $list->save();
            $res = VerSiteListManager::getInsert($vid);
            $resulst = Video::model()->updateAll(array('flag'=>6),'id=:id',array(':id'=>$id));
    }

    public function rejectlog($vid,$flag){
        $tmp = VerReject::model()->find("vid='$vid'");
        $reject = new VerRejectLog();
        $reject->user = $tmp->attributes['user'];
        $reject->user1 = $tmp->attributes['user1'];
        $reject->user2 = $tmp->attributes['user2'];
        $reject->user3 = $tmp->attributes['user3'];
        $reject->user4 = $tmp->attributes['user4'];
        $reject->user5 = $tmp->attributes['user5'];
        $reject->flag = $flag;
        $reject->message1 = $tmp->attributes['message1'];
        $reject->message2 = $tmp->attributes['message2'];
        $reject->message3 = $tmp->attributes['message3'];
        $reject->message4 = $tmp->attributes['message4'];
        $reject->message5 = $tmp->attributes['message5'];
        $reject->vid = $tmp->attributes['vid'];
        $reject->addTime = time();
        $reject->addTime1 = $tmp->attributes['addTime1'];
        $reject->addTime2 = $tmp->attributes['addTime2'];
        $reject->addTime3 = $tmp->attributes['addTime3'];
        $reject->addTime4 = $tmp->attributes['addTime4'];
        $reject->addTime5 = $tmp->attributes['addTime5'];
        $reject->save();
    }

    public function actionAccesslog(){

        if(!empty($_REQUEST['flag'])){
            $flag= $_REQUEST['flag'];
            $tmp = ReviewManager::getLog($flag);
        }else{
            $username=$_REQUEST['username'];
            $flag= '1';
            $res  = Common::getUser($username,$flag);
            $page = 20;
            $data = $this->getPageInfo($page);
            $list = array();
            if(!empty($_REQUEST['type'])){
                $list['type']=$_REQUEST['type'];
            }
            //var_dump($res);die;
            $list['cp']=$res['cp'];
            $list['review']=$res['review'];
            $tmp =VideoManager::getReview($data,$list);
            $url = $this->createUrl($this->action->id);
            $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage']);
            $list = array();
            if(!empty($res['review'])){
                $list = $tmp['list'];
            }else{
                if(in_array('3',$res['status'])){
                    $list=$tmp['list'];
                }
            }
            $tmp =$list;
        }

        echo json_encode($tmp);
    }


    public function actionRejectView(){
        $gid = $_REQUEST['gid'];
        $flag = $_REQUEST['flag'];
        $n = $this->renderPartial(
            'rejectview',
            array(
                'gid'=>$gid,
                'flag'=>$flag,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionReject(){
            $username=$_REQUEST['username'];
            $message = $_REQUEST['message'];
            if($_REQUEST['flag']=='1'){
                $gid = $_REQUEST['gid'];
                $tmp = Video::model()->findByPk($gid);
                $vid = $tmp->attributes['vid'];
                $reject = VerReject::model()->find("vid = '$vid'");
                if(empty($reject)){
                    $reject = new VerReject();
                }
                switch($tmp->attributes['flag']){
                    case '1':$reject->message1=$message;$reject->message2=0;$reject->message3=0;$reject->message4=0;$reject->message5=0;$reject->addTime1  = time();$reject->user1=$username;break;
                    case '2':$reject->message2=$message;$reject->message1=0;$reject->message3=0;$reject->message4=0;$reject->message5=0;$reject->addTime2  = time();$reject->user2=$username;break;
                    case '3':$reject->message3=$message;$reject->message2=0;$reject->message1=0;$reject->message4=0;$reject->message5=0;$reject->addTime3  = time();$reject->user3=$username;break;
                    case '4':$reject->message4=$message;$reject->message2=0;$reject->message3=0;$reject->message1=0;$reject->message5=0;$reject->addTime4  = time();$reject->user4=$username;break;
                    case '5':$reject->message5=$message;$reject->message2=0;$reject->message3=0;$reject->message4=0;$reject->message1=0;$reject->addTime5  = time();$reject->user5=$username;break;
                }
                $reject->flag='2';
                $reject->delFlag='0';
                $reject->vid  = $vid;
                $reject->save();
                $type=2;
                $this->rejectlog($vid,$type);
                //var_dump($reject->getErrors());
                $resulst = Video::model()->updateAll(array('flag'=>0),'id=:id',array(':id'=>$gid));
            }else{
                $arr=explode(' ',trim($_REQUEST['gid']));
                for($i=0;$i<count($arr);$i++){
                    $lists=explode('_',$arr[$i]);
                    $vidlist[]=$lists[1]; //id
                    $idlist[]=$lists[0];  //id
                }
                foreach($vidlist as $k=>$v){
                    $tmp = Video::model()->find("vid='$v'");
                    $reject = VerReject::model()->find("vid='$v'");
                    if(empty($reject)){
                        $reject = new VerReject();
                    }
                    /*switch($tmp->attributes['flag']){
                        case '1':$reject->message1=$message;$reject->addTime1  = time();$reject->user1=$username;break;
                        case '2':$reject->message2=$message;$reject->addTime2  = time();$reject->user2=$username;break;
                        case '3':$reject->message3=$message;$reject->addTime3  = time();$reject->user3=$username;break;
                        case '4':$reject->message4=$message;$reject->addTime4  = time();$reject->user4=$username;break;
                        case '5':$reject->message5=$message;$reject->addTime5  = time();$reject->user5=$username;break;
                    }*/
                    switch($tmp->attributes['flag']){
                        case '1':$reject->message1=$message;$reject->message2=0;$reject->message3=0;$reject->message4=0;$reject->message5=0;$reject->addTime1  = time();$reject->user1=$username;break;
                        case '2':$reject->message2=$message;$reject->message1=0;$reject->message3=0;$reject->message4=0;$reject->message5=0;$reject->addTime2  = time();$reject->user2=$username;break;
                        case '3':$reject->message3=$message;$reject->message2=0;$reject->message1=0;$reject->message4=0;$reject->message5=0;$reject->addTime3  = time();$reject->user3=$username;break;
                        case '4':$reject->message4=$message;$reject->message2=0;$reject->message3=0;$reject->message1=0;$reject->message5=0;$reject->addTime4  = time();$reject->user4=$username;break;
                        case '5':$reject->message5=$message;$reject->message2=0;$reject->message3=0;$reject->message4=0;$reject->message1=0;$reject->addTime5  = time();$reject->user5=$username;break;
                    }

                    $reject->flag='2';
                    $reject->delFlag='0';
                    $reject->vid  = $v;
                    $reject->save();
                    $type=2;
                    $this->rejectlog($v,$type);
                    //var_dump($reject->getErrors());
                    $resulst = Video::model()->updateAll(array('flag'=>0),'vid=:vid',array(':vid'=>$v));
                }

            }
            if(!empty($result)){
               echo json_encode(array('code'=>200));
            }else{
               echo json_encode(array('code'=>404));
            }
            //$this->Access($vid);
    }

    
    public function actionMvAdd(){
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
			$this->render('mvadd', array( 'arr' => $arr,'extra'=>$extra, 'vid' => $_REQUEST['vid'],'pic'=>$pic,'list'=>$list));
		}catch (ExceptionEx $ex){
			$this->PopMsg($ex->getMessage());
		}catch (Exception $e){
			$this->log($e->getMessage());
		}
	}



    /*public function actionScreenReview(){
        //$list = VerScreenContentCopy::model()->findAll();
        $sql="select p.*,g.title as gtitle,s.name from yd_ver_screen_content_copy p inner join yd_ver_screen_guide g on p.screenGuideid=g.id and p.delFlag=1 and p.flag in(1,6) inner join yd_ver_station s on s.id=g.gid";
        $list = SQLManager::queryAll($sql);
        //var_dump($list);
        $this->render('screenreview',array('list'=>$list));
    }*/

    public function actionScreenReview()
    {
        $workInfo = Common::getWorkInfo();
        $workNum = array();
        if(!empty($workInfo)){
            foreach ($workInfo as $K=>$v){
                $workNum[] = $v['type'];
            }
            $maxWork = $workInfo[0]['maxLength'];
            $sign = $workNum[0];
	        $m = count($workInfo)-1;
//            $stationId = $workInfo[$m]['stationId'];
            $stationId = array();
            foreach ($workInfo as $k=>$v){
                $stationId[] = $v['stationId'];
            }
	    $tmp_stationId=join(",",$stationId);
            //$tmp_stationId = explode(',',$stationId);
//            $sql_top = "select a.*,g.title as gtitle,s.name from yd_ver_screen_content_copy as a left join yd_ver_screen_guide as g on a.screenGuideid=g.id left join yd_ver_station as s on s.id=g.gid left join yd_ver_station as b on b.id=g.gid where  b.id=$stationId ";
            $sql_top = "select a.*,g.title as gtitle,s.name from yd_ver_screen_content_copy as a left join yd_ver_screen_guide as g on a.screenGuideid=g.id left join yd_ver_station as s on s.id=g.gid left join yd_ver_station as b on b.id=g.gid where  b.id in ($tmp_stationId) ";
            $sql_where = " where  1=1";
            if(!empty($_REQUEST['title'])){
                $sql_where .= " and a.title='%{$_REQUEST['title']}%'";
            }
            if(!empty($_REQUEST['cp'])){
                $sql_where .= " and a.cp='{$_REQUEST['cp']}'";
            }

 //         $sql_top = $sql . $sql_where;
            //$sql_bottom = " inner join yd_ver_station s on s.id=g.gid GROUP BY p.flag";
            $sql_bottom = " group by a.id";
            if(in_array($sign,$workNum) && $sign==1){
                $workFlag = $sign*10;   //  || flag=1  一审数据
                $sql_center = " and a.flag in (1,6) or a.flag=$workFlag";
                $sql_work = $sql_top.$sql_center.$sql_bottom;
                $sign++;
            }else if(in_array($sign,$workNum)){
                $workFlag = $sign*10;   //   flag=20  二审数据
                //$sql_center = " and a.flag in (1,6) or a.flag=$workFlag";
                $sql_center = " and  a.flag=$workFlag";
                $sql_work = $sql_top.$sql_center.$sql_bottom;
                if($sign==5){
                   $sign = $sign;
                }else{
                   $sign++;
                }
            }else{
                $list = null;
                $this->render('screenreview',array('list'=>$list,'readFlag'=>'1'));die;
            }
//	var_dump($sql_work);die;
            $list = SQLManager::queryAll($sql_work);
            $this->render('screenreview',array('list'=>$list,'readFlag'=>'1'));
        }else{
            if(!empty($_REQUEST['allbtn'])){
                $allbtn=$_REQUEST['allbtn'];
                if($allbtn=='已通过'){
                     $sql="select p.*,g.title as gtitle,s.name from yd_ver_screen_content_log p inner join yd_ver_screen_guide g on p.screenGuideid=g.id and p.delFlag='1' inner join yd_ver_station s on s.id=g.gid ";
                      
                }else if($allbtn=='已驳回'){
                     $sql="select p.*,g.title as gtitle,s.name from yd_ver_screen_content_log p inner join yd_ver_screen_guide g on p.screenGuideid=g.id and p.delFlag='2' inner join yd_ver_station s on s.id=g.gid ";
                }else{
         		    $sql="select p.*,g.title as gtitle,s.name from yd_ver_screen_content_copy p inner join yd_ver_screen_guide g on p.screenGuideid=g.id and p.delFlag=1 and p.flag in(1,6,10,20,30,40,50,100) inner join yd_ver_station s on s.id=g.gid";
                }
            }else{
         		$sql="select p.*,g.title as gtitle,s.name from yd_ver_screen_content_copy p inner join yd_ver_screen_guide g on p.screenGuideid=g.id and p.delFlag=1 and p.flag in(1,6,10,20,30,40,50,100) inner join yd_ver_station s on s.id=g.gid";
            }
            $sql_where = " where  1=1";
            if(!empty($_REQUEST['stationId'])){
                $sql_where .= " and s.id='{$_REQUEST['stationId']}'";
            }
            if(!empty($_REQUEST['title'])){
                $sql_where .= " and p.title like '%{$_REQUEST['title']}%'";
            }
            if(!empty($_REQUEST['cp'])){
                $sql_where .= " and p.cp='{$_REQUEST['cp']}'";
            }

            $sql = $sql . $sql_where;
            $list = SQLManager::queryAll($sql);
//            print_r($sql);
//            var_dump($list);die;
            $this->render('screenreview',array('list'=>$list,'readFlag'=>'2'));
        }
//        echo $sql_work;die;
    //    $list = SQLManager::queryAll($sql_work);
    //    $this->render('screenreview',array('list'=>$list));
        //$list = VerScreenContentCopy::model()->findAll();
//        $sql="select p.*,g.title as gtitle,s.name from yd_ver_screen_content_copy p inner join yd_ver_screen_guide g on p.screenGuideid=g.id and p.delFlag=1 and p.flag in(1,6) inner join yd_ver_station s on s.id=g.gid";
//        $list = SQLManager::queryAll($sql);
        //var_dump($list);
//        $this->render('screenreview',array('list'=>$list));
    }	

    public function actionPic(){
        $pic = $_REQUEST['img'];
        $n = $this->renderPartial(
            'pic',
            array(
                'pic'=>$pic,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    /*public function actionContentAccess(){
        $flag = $_REQUEST['flag'];
        if(!empty($_REQUEST['id'])){
           $arr = explode(' ',trim($_REQUEST['id']));
            foreach($arr as $k=>$v){
                $list = VerScreenContentCopy::model()->findByPk($v);
                $screenGuideid = $list->screenGuideid;
                if($flag=='1'){
                    $this->addlog($list);
                    if($list->flag=='1'){
                        $list->flag='2';
                    }else{
                        $list->flag='5';
                    }
                    $delFlag='2';
                    //$list->delFlag='2';
                }else{
                    $this->nolog($list);
                    $list->flag='7';
                    $delFlag='0';
                    //$list->delFlag='0';
                }
                $list->save();
            $result = VerScreenContentCopy::model()->updateAll(array('delFlag'=>$delFlag),'screenGuideid=:screenGuideid',array(':screenGuideid'=>$screenGuideid));
            }
        }
    }*/

    public function newGetWorkInfo($id)
    {
        $screenGuideid_res = VerScreenContentCopy::model()->find(
            array(
                'select'=>'screenGuideid',
                'condition'=>'id=:id',
                'params'=>array(':id'=>$id)
            ));
        $station_res = VerScreenGuide::model()->find(
            array(
                'select'=>'gid',
                'condition'=>'id=:id',
                'params'=>array(':id'=>$screenGuideid_res->attributes['screenGuideid'])
            ));
        $uid = $_SESSION['userid'];
        $stationId = $station_res->attributes['gid'];
        $sql = "select a.type,b.type as maxLength,b.stationId from yd_ver_review_work as a left join yd_ver_work as b on b.id=a.workid  where a.uid=$uid and b.flag=3 and b.stationId=$stationId";  //确定当前用户是几审用户以及此工作流需要几审
        $res = SQLManager::queryAll($sql);
        return $res;
    }

    public function actionContentAccess()
    {
        $workInfo = Common::getWorkInfo();
        //var_dump($workInfo);die;
        if(!empty($workInfo)){
//            $maxWork = $workInfo[0]['maxLength'];
            $flag = $_REQUEST['flag'];
            if(!empty($_REQUEST['id'])){
                $arr = explode(' ',trim($_REQUEST['id']));
                foreach($arr as $k=>$v){
                    $list = VerScreenContentCopy::model()->findByPk($v);
                    $screenGuideid = $list->screenGuideid;
//                    $sign = $workInfo[0]['type'];
                    $new_workInfo = $this->newGetWorkInfo($v);
                    $sign = $new_workInfo[0]['type'];
                    $maxWork = $new_workInfo[0]['maxLength'];
                    if($flag=='1'){
                        $this->addlog($list);
                        if($list->flag=='1') {
                            $sign++;
                            $list->flag = 10*$sign;
			                $delFlag='1';
                        }else if($list->flag < $maxWork*10){
                            $sign++;
                            $list->flag = 10*$sign;
                            $delFlag='1';
                        }else if($list->flag >= $maxWork*10){
                            $list->flag = 100;
                            $delFlag='2';
                        }else{
                            $list->flag='5';
			                $delFlag='2';
                        }
                    }else{
			            if($list->pic == '/file/3.png'){
                            $id = $_REQUEST['id'];
                            $sql = "select * from yd_ver_screen_content_del where id = $v ORDER BY upTime desc limit 1";
                            $res = SQLManager::queryAll($sql);
                            $list->uType = $res['0']['uType'];
                            $list->pic = $res['0']['pic'];
                            $list->tType = $res['0']['tType'];
                            $list->title = $res['0']['title'];
                            $list->action = $res['0']['action'];
                            $list->param = $res['0']['param'];
                            $list->cp = $res['0']['cp'];
                            $list->cid = $res['0']['cid'];
                            $list->videoUrl = $res['0']['videoUrl'];
                            $list->type = $res['0']['type'];
						}
                        $this->nolog($list);
                        $list->flag='7';
                        $delFlag='0';
                    }
                    $list->delFlag=$delFlag;
                    $list->save();
                    //$result = VerScreenContentCopy::model()->updateAll(array('delFlag'=>$delFlag),'id=:id',array(':id'=>$v));
//                $result = VerScreenContentCopy::model()->updateAll(array('delFlag'=>$delFlag),'screenGuideid=:screenGuideid',array(':screenGuideid'=>$screenGuideid));
                }
            }
        }else{
            $flag = $_REQUEST['flag'];
		//var_dump($_REQUEST['id']);die;
            if(!empty($_REQUEST['id'])){
                $arr = explode(' ',trim($_REQUEST['id']));
                foreach($arr as $k=>$v){
                    $list = VerScreenContentCopy::model()->findByPk($v);
                    $screenGuideid = $list->screenGuideid;
                    $sign = 0;
                    if($flag=='1'){
                        $this->addlog($list);
                        if($list->flag=='1'){
                            $list->flag='100';
                            $delFlag='2';
                        }else{
                            $list->flag='5';
                            $delFlag='2';
                        }
                        //$delFlag='2';
                        $list->delFlag=$delFlag;
                    }else{
			            if($list->pic == '/file/3.png'){
                            $id = $_REQUEST['id'];
                            $sql = "select * from yd_ver_screen_content_del where id = $v ORDER BY upTime desc limit 1";
                            $res = SQLManager::queryAll($sql);
                            $list->uType = $res['0']['uType'];
                            $list->pic = $res['0']['pic'];
                            $list->tType = $res['0']['tType'];
                            $list->title = $res['0']['title'];
                            $list->action = $res['0']['action'];
                            $list->param = $res['0']['param'];
                            $list->cp = $res['0']['cp'];
                            $list->cid = $res['0']['cid'];
                            $list->videoUrl = $res['0']['videoUrl'];
                            $list->type = $res['0']['type'];
						}
                        $this->nolog($list);
                        $list->flag='7';
                        //$delFlag='1';
                        $list->delFlag='0';
                    }
                    $list->save();
                    //$result = VerScreenContentCopy::model()->updateAll(array('delFlag'=>$delFlag),'screenGuideid=:screenGuideid',array(':screenGuideid'=>$screenGuideid));
                }
            }
        }
    }

    public function actionAccessData(){
        $flag = $_REQUEST['flag'];
        if($flag=='1'){
            $flag='4';
        }else{
            $flag='5';
        }
        $tmp = ReviewManager::getData($flag);
        echo json_encode($tmp);
    }

    public function actionReviewData(){
        //$list = VerScreenContentCopy::model()->findAll();
        $sql="select p.*,g.title as gtitle,s.name from yd_ver_screen_content_copy p inner join yd_ver_screen_guide g on p.screenGuideid=g.id and p.delFlag=1 and p.flag in(1,6) inner join yd_ver_station s on s.id=g.gid order by addTime desc";
        $list = SQLManager::queryAll($sql);
        echo json_encode($list);
    }


    public function addlog($list){
        $content = new VerScreenContentLog();
        $content->title=$list->attributes['title'];
        $content->type=$list->attributes['type'];
        $content->tType=$list->attributes['tType'];
        $content->param=$list->attributes['param'];
        $content->action=$list->attributes['action'];
        $content->pic=$list->attributes['pic'];
        $content->cp=$list->attributes['cp'];
        $content->epg=$list->attributes['epg'];
        $content->screenGuideid=$list->attributes['screenGuideid'];
        $content->cid=$list->attributes['cid'];
        $content->width=$list->attributes['width'];
        $content->height=$list->attributes['height'];
        $content->x=$list->attributes['x'];
        $content->y=$list->attributes['y'];
        $content->order=$list->attributes['order'];
        $content->delFlag='4';
        $content->addTime=time();
        $content->uType=$list->attributes['uType'];
        if(!$content->save()){
            var_dump($content->getErrors());
        }
    }

    public function nolog($list){
        $content = new VerScreenContentLog();
        $content->title=$list->attributes['title'];
        $content->type=$list->attributes['type'];
        $content->tType=$list->attributes['tType'];
        $content->param=$list->attributes['param'];
        $content->action=$list->attributes['action'];
        $content->pic=$list->attributes['pic'];
        $content->cp=$list->attributes['cp'];
        $content->epg=$list->attributes['epg'];
        $content->screenGuideid=$list->attributes['screenGuideid'];
        $content->cid=$list->attributes['cid'];
        $content->width=$list->attributes['width'];
        $content->height=$list->attributes['height'];
        $content->x=$list->attributes['x'];
        $content->y=$list->attributes['y'];
        $content->addTime=time();
        $content->order=$list->attributes['order'];
        $content->delFlag='5';

        $content->uType=$list->attributes['uType'];
        if(!$content->save()){
            var_dump($content->getErrors());
        }
    }

    public function test($list){
        if(!empty($list->attributes['sid'])){
            $content = VerScreenContent::model()->findByPk($list->attributes['sid']);
        }else{
            $content = new VerScreenContent();
        }
        $content->title=$list->attributes['title'];
        $content->type=$list->attributes['type'];
        $content->tType=$list->attributes['tType'];
        $content->param=$list->attributes['param'];
        $content->action=$list->attributes['action'];
        $content->pic=$list->attributes['pic'];
        $content->cp=$list->attributes['cp'];
        $content->epg=$list->attributes['epg'];
        $content->screenGuideid=$list->attributes['screenGuideid'];
        $content->cid=$list->attributes['cid'];
        $content->width=$list->attributes['width'];
        $content->height=$list->attributes['height'];
        $content->x=$list->attributes['x'];
        $content->y=$list->attributes['y'];
        $content->order=$list->attributes['order'];
        $content->uType=$list->attributes['uType'];
        if(!$content->save()){
            var_dump($content->getErrors());
        }
        $list->sid=$content->attributes['id'];
    }
    public function actionSee(){
        $vid = $_REQUEST['vid'];
        $tmp=array();
        $tmp = ReviewManager::getList($vid);
        $n = $this->renderPartial(
            'see',
            array(
                'tmp'=>$tmp,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionGetReviewTimes()
    {
        $stationId = $_REQUEST['stationId'];
         $screenGuideId = $_GET['screenGuideId'];
	$sql = "select type from yd_ver_work where stationId=$stationId order by id desc";
        $res = SQLManager::queryRow($sql);
        $maxReviewTimes = $res['type'];
//	$maxFlag = 10*$maxReviewTimes;
        $sql = " select a.*,g.title as gtitle,s.name from yd_ver_screen_content_copy as a left join yd_ver_screen_guide as g on a.screenGuideid=g.id left join yd_ver_station as s on s.id=g.gid left join yd_ver_station as b on b.id=g.gid where b.id=$stationId and a.flag=100 and a.delFlag=1 and a.screenGuideid=g.id";
	//var_dump($sql);die;
	$res = SQLManager::queryAll($sql);
      	$e = VerScreenContentCopy::model()->findAll("screenGuideid=$screenGuideId and delFlag=1 and flag<>20");
		
	  if(!empty($res)){
            echo '1';
        }else if($maxReviewTimes == 1 && empty($e)){
        	echo '1';
        }
	else{
            echo '2';
        }
    }

    public function actionCheckReviewData()
    {
	$stationId = $_REQUEST['stationId'];
	$sql="select a.*,g.title as gtitle,s.name from yd_ver_screen_content_copy as a left join yd_ver_screen_guide as g on a.screenGuideid=g.id left join yd_ver_station as s on s.id=g.gid where s.id=$stationId and a.flag in(1,6,10,20,30,40,50) and delFlag=1  group by a.id";
	$res = SQLManager::queryRow($sql);
	if(empty($res)){
            echo '1';
        }else{
            echo '2';
        }	
    }

    public function actionCheckReviewDataCopy()
    {
        $stationId = $_REQUEST['stationId'];
        $sql="select a.*,g.title as gtitle,s.name from yd_ver_screen_content_copy as a left join yd_ver_screen_guide as g on a.screenGuideid=g.id left join yd_ver_station as s on s.id=g.gid where a.screenGuideid=$stationId and a.flag in(1,6,10,20,30,40,50) and delFlag=1  group by a.id";
        $res = SQLManager::queryRow($sql);
        if(empty($res)){
            echo '1';
        }else{
            echo '2';
        }
    }

    public function actionMsgReview()
    {
        $username=$_SESSION['nickname'];
	    $sql = "select t3.type from yd_ver_admin t1 left join yd_ver_review_work t2 on t1.id = t2.uid left join yd_ver_work t3 on t2.workid = t3.id where t1.nickname = '$username' and t3.flag = 4";
	 
	    $type = SQLManager::QueryAll($sql);
	    if(!empty($type['0']['type'])){
                $list['typea'] = $type['0']['type'];
        }

        $flag= '4';
        $res  = Common::getUser($username,$flag);
       
	    $page = 20;
        $data = $this->getPageInfo($page);
       // $list = array();
        if(!empty($_REQUEST['type'])){
            $list['type']=$_REQUEST['type'];

        }

	    if(!empty($_REQUEST['gid'])){
            $list['gud']=$_REQUEST['gid'];
        }

	    $uid = $_SESSION['userid'];
        $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 4 left join  yd_ver_review_work as
c on c.workid=b.id where c.uid=$uid  group by a.id";
        $st = SQLManager::QueryAll($sql);
	
        if(!empty($st) && $_SESSION['auth'] <> 1){
            $list['gid'] = $st;
        }
	
        $list['cp']=$res['cp'];
        $list['review']=$res['review'];
        if($_SESSION['auth']==1){
            $list['workid'] ='';
        }else{
            //$list['workid']=Common::WorkidList($username,$flag);

        }
	
        $tmp =VideoManager::getMsgReview($data,$list);
        
	    $url = $this->createUrl($this->action->id);
        $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage'],$tmp['alwaysCount']);
        $list = array();
        if(!empty($res['review']) || $_SESSION['auth']=='1'){
            $list = $tmp['list'];
        }else{
            if(in_array('3',$res['status'])){
                $list=$tmp['list'];
            }
        }
        $this->render('msgreview',array('list'=>$list,'page'=>$pagination,'res'=>$res));

    }
    public function actionTopicallaccess(){
    	$ids = $_REQUEST['ids'];
    	 $ids = substr($ids, 0,strlen($ids)-1);
		$sql ="SELECT
	t1.id,t1.flag,t3.type
FROM
	yd_ver_topic_review t1
LEFT JOIN yd_ver_sitelist t2 ON t1.stationid = t2.`name` and t2.pid = 0
LEFT JOIN yd_ver_work t3 on t2.id = t3.stationId and t3.flag = 6

WHERE
	t1.id IN ($ids)";

	
	
	
	
	
	$res = SQLManager::queryAll($sql);
	if(!empty($res)){
		foreach ($res as $key => $value) {
			
			if($value['flag'] == $value['type'] || $_SESSION['auth']=='1'){
				$sql = "UPDATE yd_ver_topic_review set flag = 6 where id = {$value['id']}";
				$res = SQLManager::execute($sql);
			}else if($value['flag'] < $value['type']){
				$flag = $value['flag'] + 1;
				$sql = "UPDATE yd_ver_topic_review set flag = $flag where id = {$value['id']}";
				$res = SQLManager::execute($sql);
			}
		}
	}
	
    }
	
	  public function actionTopicnotaccess(){
    	$ids = $_REQUEST['ids'];
    	 $ids = substr($ids, 0,strlen($ids)-1);
		$sql ="UPDATE yd_ver_topic_review set flag = 0 WHERE id IN ($ids)";
		$res = SQLManager::execute($sql);
		$sql1 = "SELECT * from yd_ver_topic_review where id IN ($ids) and type <> 'bkimg' and uptype = '3'";
		$res = SQLManager::queryAll($sql1);
		if(!empty($res)){
			foreach ($res as $key => $value) {
				if($value['type'] == 'specialtopic'){
					$sql = "update yd_special_topic_copy set type = 1 where id = '{$value['topic_id']}'";
					SQLManager::execute($sql);
				}else{
					$sql = "update yd_ver_ui_copy set type = 1 where id = '{$value['topic_id']}'";
					SQLManager::execute($sql);
				}
			}
		}
    }
  public function actionTopicReview()
    {
        $username=$_SESSION['nickname'];
	    $flag= '6';
        $res  = Common::getUser($username,$flag);
		
        $page = 20;
        $data = $this->getPageInfo($page);
	
        $list = array();
        if(!empty($_REQUEST['type'])){
            $list['type']=$_REQUEST['type'];
        }
	if(!empty($_REQUEST['stationId'])){
		$stationId = "";
            $list['stationId'] = $_REQUEST['stationId'];
			$a = VerSiteListManager::getList($_REQUEST['stationId']);

			if(!empty($a)){
			
				foreach ($a as $k => $v) {
				
					if($v['name'] == '专题'){
				
						$b = VerSiteListManager::getList($v['id']);
							
						if(!empty($b)){
							foreach ($b as $key1 => $value1) {
								$c = VerSiteListManager::getList($value1['id']);
								if(!empty($c)){
									foreach ($c as $key2 => $value2) {
										$stationId .= $value2['id'].",";
									}
								}
							}
						}	
					}
				}
							
			}
			$list['stationId'] = substr($stationId,0,strlen($stationId)-1);
			
        }

	$uid = $_SESSION['userid'];
	$sitelist = array();
            $sql = "select a.* from yd_ver_sitelist as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 6 left join  yd_ver_review_work as
 c on c.workid=b.id  where c.uid=$uid  group by a.id";
	$st = SQLManager::QueryAll($sql);

	if(!empty($st)){

		foreach($st as $key=>$value){
		if($value['id'] == 7){
			$aa = $st;
		}else{
			$aa = VerSiteListManager::getList($value['id']);
		}
		

			if(!empty($aa)){
			
				foreach ($aa as $k => $v) {
					
					
					if($v['name'] == '专题'){
				
						$bb = VerSiteListManager::getList($v['id']);
					
						if(!empty($bb)){
							foreach ($bb as $key1 => $value1) {
								$cc = VerSiteListManager::getList($value1['id']);
							
								if(!empty($cc)){
									foreach ($cc as $key2 => $value2) {
										if($v['id'] == 7){
											$list['sitelist'][7][] = $value2['id'];
										}else{
										$list['sitelist'][$v['pid']][] = $value2['id'];
									}}
								}
							}
						}	
					}
				}
							
			}
	}}

	if(!empty($list['sitelist'])){
		foreach ($list['sitelist']  as $key => $value) {
			$sql = "SELECT t1.type FROM yd_ver_review_work t1 LEFT JOIN yd_ver_work t2 on t1.workid = t2.id where t1.uid = $uid and t2.stationId = $key";
			$ss = SQLManager::queryAll($sql);
			
			if(!empty($ss)){
				foreach ($ss as $key1 => $value1) {
					$list['typelist'][$key][] = $value1['type']; 
				}
				
			}
		}
	}

        $tmp =VideoManager::getTopicReview($data,$list);
        //print_r($tmp);die;
	$url = $this->createUrl($this->action->id);
        $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage'],$tmp['alwaysCount']);
        $list = array();
        if(!empty($res['review']) || $_SESSION['auth']=='1'){
            $list = $tmp['list'];
        }else{
            if(in_array('3',$res['status'])){
                $list=$tmp['list'];
            }
        }
        $this->render('topicreview',array('list'=>$list,'page'=>$pagination,'res'=>$res));
    }

    public function actionWallReview()
    {
        $username=$_SESSION['nickname'];
	    $flag= '5';
        $res  = Common::getUser($username,$flag);
        $page = 20;
        $data = $this->getPageInfo($page);
        $list = array();
        if(!empty($_REQUEST['type'])){
            $list['type']=$_REQUEST['type'];
        }
	    if(!empty($_REQUEST['stationId'])){
            $list['stationId'] = $_REQUEST['stationId'];
        }
	    $uid = $_SESSION['userid'];
        $sql = "select a.*,c.uid from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 5 left join  yd_ver_review_work as c on c.workid=b.id  where c.uid=$uid  group by a.id";
            
	    $st = SQLManager::QueryAll($sql);
//        var_dump($st);die;
        if(!empty($st) && $_SESSION['auth'] <> 1){
                $list['gid'] = $st;
        }

        $list['cp']=$res['cp'];
        $list['review']=$res['review'];
        if($_SESSION['auth']==1){
            $list['workid'] ='';
        }else{
            //$list['workid']=Common::WorkidList($username,$flag);
        }
        $tmp =VideoManager::getWallReview($data,$list);
//        print_r($tmp);die;
	    $url = $this->createUrl($this->action->id);
        $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage'],$tmp['alwaysCount']);
        $list = array();
        if(!empty($res['review']) || $_SESSION['auth']=='1'){
            $list = $tmp['list'];
        }else{
            if(in_array('3',$res['status'])){
                $list=$tmp['list'];
            }
        }
//        echo '<pre>';
//        var_dump($list);die;
        $this->render('wallreview',array('list'=>$list,'page'=>$pagination,'res'=>$res));
    }

      public function actionAllTopicReview()
    {
        $username=$_SESSION['nickname'];
	    $flag= '5';
        $res  = Common::getUser($username,$flag);
        $page = 20;
        $data = $this->getPageInfo($page);
        $list = array();
        if(!empty($_REQUEST['type'])){
            $list['type']=$_REQUEST['type'];
        }
	    if(!empty($_REQUEST['stationId'])){
            $list['stationId'] = $_REQUEST['stationId'];
        }
	    $uid = $_SESSION['userid'];
            $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 5 left join  yd_ver_review_work as
 c on c.workid=b.id  where c.uid=$uid  group by a.id";
            
	    $st = SQLManager::QueryAll($sql);

        if(!empty($st) && $_SESSION['auth'] <> 1){
                $list['gid'] = $st;
        }

        $list['cp']=$res['cp'];
        $list['review']=$res['review'];
        if($_SESSION['auth']==1){
            $list['workid'] ='';
        }else{
            //$list['workid']=Common::WorkidList($username,$flag);
        }

        $tmp =VideoManager::getWallReview($data,$list);
        //print_r($tmp);die;
	    $url = $this->createUrl($this->action->id);
        $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage'],$tmp['alwaysCount']);
        $list = array();
        if(!empty($res['review']) || $_SESSION['auth']=='1'){
            $list = $tmp['list'];
        }else{
            if(in_array('3',$res['status'])){
                $list=$tmp['list'];
            }
        }
        $this->render('wallreview',array('list'=>$list,'page'=>$pagination,'res'=>$res));
    }


//    public function actionGetQuoteInfo()
    public function GetQuoteInfo($pasteGuideId)
    {
//        $pasteGuideId = $_REQUEST['guideId'];
        $res = VerScreenQuote::model()->findAll("`pasteGuideId`=$pasteGuideId and `status`=1");
        if(!empty($res)){
            return $res;
        }else{
            return false;
        }
    }

    public function actionGetQuoteInfo()
    {
        $copyGuideId = $_REQUEST['guideId'];
        $res = VerScreenQuote::model()->findAll("`copyGuideId`=$copyGuideId and `status`=1");
        $stuList = array();
        if (!empty($res)) {
            $stuList = json_decode(CJSON::encode($res),true);
        }
        echo json_encode($stuList);
    }
}

