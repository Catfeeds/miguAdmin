<?php

/**
 * Created by PhpStorm.
 * User: xiangl
 * Date: 2015/8/19 0019
 * Time: 11:48
 */

class GuideController extends VController{
	public function actionDefault(){
		$this->render('default');
	}

	public function actionIndex(){
		$parent = 0;
        //var_dump($_GET['id']);
		if(!empty($_GET['id'])) $parent = intval($_GET['id']);
		$p = VerGuide::model()->findByPk($parent);
        //($p);
		$list = VerGuideManager::getforparent($parent);
        //var_dump($list);die;
		$this->render('index',array('guide'=>$list,'p'=>$p));
	}

	public function actionAdd(){
		try{
			if(!empty($_GET['id'])){
				$guide = VerGuide::model()->findByPk($_GET['id']);
			}else{
				$guide = new VerGuide();
				$guide->addTime = time();
			}


			if(!empty($_POST)){
				$post = $_POST;
				if(empty($post['name'])) throw new ExceptionEx('请输入导航名称');
				if(empty($post['uType']))throw new ExceptionEx('请选择链接类型');
				if(empty($post['url'])) throw new ExceptionEx('请输入链接');
				if(!empty($_GET['id']) && $_GET['id'] == $post['pid']){
					throw new ExceptionEx('自己不能作为自己的父类');
				}
				$sql = 'select `order` from yd_wx_guide order by `order` desc limit 1';
				$return = Yii::app()->db->createCommand($sql)->queryRow();
				$guide->pid = intval($post['pid']);
				$guide->name = trim($post['name']);
				$guide->url = trim($post['url']);
				$guide->module = $this->module->id;
				if($guide->isNewRecord){
					$guide->order = $return['order'];
				}
					if(!empty($_FILES['ico_true']['tmp_name'])){
						$filename = 'ico_true';
						$path = $this->up($filename);
						$guide ->ico_true    = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . $path;
						//$guide ->ico_true    = 'http://192.168.1.110/file/' . $path;
					}

					if(!empty($_FILES['ico_false']['tmp_name'])){
						$filenames = 'ico_false';
						$path = $this->up($filenames);
						$guide ->ico_false   = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . $path;
						//$guide ->ico_false   = 'http://192.168.1.110/file/' . $path;
					}
				//var_dump($guide);die;

				if(!$guide->save()){
					LogWriter::logModelSaveError($guide,__METHOD__,$guide->attributes);
					throw new ExceptionEx('信息保存失败');
				}
				$list = VerGuide::model()->findByPk($_REQUEST['pid']);
				if(!empty($list)) {
					if ($list->attributes['name'] == '导航管理') {
						$sheng = $_POST['province'];
						$gid = $guide->attributes['id'];
						$shi = $_POST['city'];
						$cp = $_POST['cp'];
						for ($i = 0; $i < count($sheng); $i++) {
							for ($c = 0; $c < count($cp); $c++) {
								$nav = new VerNav();
								$nav->gid = $gid;
								$se = explode('_', $sheng[$i]);
								$nav->province = $se[0];
								$nav->usergroup = $_REQUEST['usergroup'];
								$nav->epgcode = $_REQUEST['epgcode'];
								$s = explode('_', $shi[$i]);
								$nav->city = $s[0];
								$nav->cp = $cp[$c];
								$nav->save();
								if (!$nav->save()) {
									LogWriter::logModelSaveError($nav, __METHOD__, $nav->attributes);
									throw new ExceptionEx('信息保存失败');
								}
							}
						}
					}else if ($list->attributes['name'] == '站点管理') {

					}
				}
				if(empty($_GET['id'])){
					$this->RecordOperatingLog(MSG::MYSQL_EDIT_ADD,$guide,'导航',$guide->name);
				}else{
					$this->RecordOperatingLog(MSG::MYSQL_EDIT_EDIT,$guide,'导航',$guide->name);
				}
				$this->PopMsg('保存成功');
				$this->redirect($this->get_url('guide','index'));
			}
		}catch (ExceptionEx $ex){
			$this->PopMsg($ex->getMessage());
		}catch (Exception $e){
			$this->log($e->getMessage());
		}
		$province = Province::model()->findAll("1=1 order by id asc");

		$p = isset($p) ? $p : '';
		$cityCode = isset($cityCode) ? $cityCode : '';
		$c = isset($c) ? $c : '';
		$pid = !empty($_REQUEST['pid'])?$_REQUEST['pid']:'0';
		$parent = VerGuide::model()->findAllByAttributes(array('pid'=>$pid));
		$this->render('add',array('guide'=>$guide,'parent'=>$parent,'province'=>$province,'provinceCode'=>$p,'city'=>$cityCode,'cityCode'=>$c));
	}


	public function actionList()
	{
		$page = 20;
		$data = $this->getPageInfo($page);
		$list = array();
		$list=$_REQUEST;                
		$gid=$_REQUEST['nid'];
		$tmp =VerContentManager::getData($data,$list);
		$url = $this->createUrl($this->action->id);
		$pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage']);
		$this->render('list',array('list'=>$tmp['list'],'gid'=>$gid,'page'=>$pagination));
	}

	public function actionNoAdd(){
		try{
			$id = $_REQUEST['id'];
			$flag = $_REQUEST['flag'];
			$resulst = VerContent::model()->updateAll(array('flag'=>$flag),'id=:id',array(':id'=>$_REQUEST['id']));
		}catch (ExceptionEx $ex){
			$this->PopMsg($ex->getMessage());
		}catch (Exception $e){
			$this->log($e->getMessage());
			$this->PopMsg('系统繁忙,请稍后再试');
		}
	}

	public function actionDel(){
		try{
			if(empty($_GET['id'])) throw new ExceptionEx('参数错误');
			$id = intval($_GET['id']);
			$ex = WxGuide::model()->exists('pid=:id',array(':id'=>$id));
			if($ex){
				throw new ExceptionEx('该分类下含有子类,请先处理子类');
			}

			$del = WxGuide::model()->deleteByPk($id);
			if(!$del){
				throw new ExceptionEx('系统繁忙,删除失败');
			}

		}catch (ExceptionEx $ex){
			$this->PopMsg($ex->getMessage());
		}catch (Exception $e){
			$this->log($e->getMessage());
			$this->PopMsg('系统繁忙,请稍后再试');
		}
		$this->redirect($this->getPreUrl());
	}


	public function actionEpgList(){
		$page = 20;
		$data = $this->getPageInfo($page);
		$list = VerContentManager::getList($data);
		$url = $this->createUrl($this->action->id);
		//$this->render('epglist');
		$pagination = $this->renderPagination($url,$list['count'],$page,$data['currentPage']);
		$this->render('epglist',array('list'=>$list['list'],'page'=>$pagination));
	}

	public function actionEpgAdd(){
		try{
			if(!empty($_GET['id'])){
				$epg = VerEpg::model()->findByPk($_REQUEST['id']);
			}else{
				$epg = new VerEpg();
				$epg->cTime = time();
			}
			if(!empty($_POST)){
				$epg->epgName=$_POST['epgName'];
				$epg->epg=$_POST['epg'];
				$epg->delFlag='0';
				if(!$epg->save()){
					var_dump($epg->getErrors());
					LogWriter::logModelSaveError($epg,__METHOD__,$epg->attributes);
					throw new ExceptionEx('信息保存失败');
				}
				$this->PopMsg('保存成功');
				$this->redirect($this->get_url('guide','epglist'));
			}
		}catch (ExceptionEx $ex){
			$this->PopMsg($ex->getMessage());
		}catch (Exception $e){
			$this->log($e->getMessage());
			$this->PopMsg('系统繁忙,请稍后再试');
		}
		$this->render('epgadd',array('epg'=>$epg));
	}

	public function actionEpgDel(){
		if(empty($_REQUEST['id'])) throw new ExceptionEx('参数错误');
		$result = VerEpg::model()->deleteByPk($_REQUEST['id']);
		if($result){
			echo json_encode(array('code'=>200,'msg'=>'删除成功'));
		}else{
			echo json_encode(array('code'=>404,'msg'=>'删除失败'));
		}
	}

	public function actionSiteAdd(){
		$page = 10;
		$data = $this->getPageInfo($page);
		//var_dump($data);
		$list = array();
		if(!empty($_REQUEST['type'])){
			$list['type']=$_REQUEST['type'];
		}
		$tmp =VideoManager::getData($data,$list);
		$pagenum = $tmp['count'];
		$n = $this->renderPartial(
				'siteadd',
				array(
						'list'=>$tmp['list'],
					    'data'=>$data,
						'pagenum'=>$pagenum,
				),
				true
		);
		die(json_encode(array('code'=>200,'msg'=>$n)));
	}

	public function actionAjax(){
		$page = 10;
		$data = $this->getPageInfo($page);
		$list = array();
		if(!empty($_REQUEST['type'])){
			$list['type']=$_REQUEST['type'];
		}
		$tmp =VideoManager::getData($data,$list);
		$res['list'] = $tmp['list'];
		$res['total_num'] = $tmp['count'];
		$res['page_size']=10;
		$res['page_total_num']=ceil($res['total_num']/$res['page_size']);
		echo json_encode($res);
	}

	//读取出符合条件的所有的市
	public function actionGetcity(){
		$id=$_GET['id'];
		$city = array_map(create_function('$record','return $record->attributes;'),City::model()->findAll("provinceId = '$id' order by id desc"));

		echo json_encode($city);
	}

	public function actionGetpro(){
		$pro = array_map(create_function('$record','return $record->attributes;'),Province::model()->findAll("1=1 order by provinceCode asc"));
		echo json_encode($pro);
	}

    public function actionContent(){
		$username=$_SESSION['nickname'];
		$uid=$_SESSION['userid'];
		$flag= 8;
		$res  = Common::getUser($username,$flag);
		$sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = {$flag} left join yd_ver_worker as c on c.workid=b.id where c.uid=$uid group by a.id";
		$st = SQLManager::QueryAll($sql);
		$list=array();
		$str='';
		if(!empty($st) && $_SESSION['auth'] <> 1){
			foreach($st as $k=>$v){
				$str .= ",'". $v['id']."'";
			}
			$list['uid']=substr($str,1,strlen($str)-1);
		}
                $page = 100;
		$data = $this->getPageInfo($page);
                $url = $this->createUrl($this->action->id);
		if($_SESSION['auth']==1){
                	$sql_select="select a.*,b.name from yd_ver_upload as a left join yd_ver_station as b on a.stationId=b.id ";
		}else{
                	$sql_select="select a.*,b.name from yd_ver_upload as a left join yd_ver_station as b on a.stationId=b.id left join yd_ver_work as d on a.stationId=d.stationId and d.flag=8 inner join yd_ver_worker as c on c.workid=d.id and c.uid={$_SESSION['userid']} ";
		}
                $sql_where = " where a.flag<7 ";
                if(!empty($_REQUEST['title'])){
 			$sql_where .=" and a.title like '%{$_REQUEST['title']}%'";
                }
                if(!empty($_REQUEST['gid'])){
                        $sql_where .=" and a.stationId='{$_REQUEST['gid']}'";
                }
                $sql_limit = "group by a.id order by a.id desc limit ".$data['start'].','.$data['limit'];
                $sql = $sql_select . $sql_where . $sql_limit;
                $content=SQLManager::queryAll($sql);
                $tmp['count'] = VerUpload::model()->count();
		$pagination = $this->renderPagination($url,count($content),$page,$data['currentPage'],$tmp['count']);
		$this->render('content',array('list'=>$content,'page'=>$pagination,'res'=>$res));
	}

	public function actionReview(){
		$id=$_REQUEST['id'];
		$time=time();
		$sql="update yd_ver_upload set `flag`=1,`time`={$time},`reason`=1,`uname`='{$_SESSION['nickname']}' where id={$id}";
		$res=SQLManager::execute($sql);
		$review_flag = 3;   //提交审核
		$review_times = 1;
		$review_message = '提审';
		$bind_id = $id;
		$review_type = 8;   //素材
		$this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);
		if($res>0){
			echo json_encode(array("code"=>200));
		}else{
			echo json_encode(array("code"=>500));
		}
	}

	public function actionUploads(){
		if(!empty($_POST)){

			$stationId=trim($_POST['stationId']);
			$flag=VerStation::model()->findByPk($stationId);

			$content = new VerUpload();
			$content->title=$_POST['title'];
                        $pic_true = trim($_POST['url']);
        		$pic_true = basename($pic_true);
      		if($flag->province==90){
				$content->url="http://pic-portal-v3.itv.cmvideo.cn:8083/file/".$pic_true;//存公网
			}else{
				$content->url=FTP_PATH.$pic_true;//同步图片服务器ip
			}
			//Common::synchroPic($pic_true);
        		//$content->url = 'http://117.131.17.46:8086/file/' . $pic_true;
        		//$content->url = 'http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $pic_true;
        		//$content->url = 'http://117.144.248.58:8082/file/' . $pic_true;
			//$content->url=FTP_PATH.$pic_true;
			//$content->url=$_POST['url'];
			$content->stationId = trim($_POST['stationId']);
			if(!$content->save()){
				LogWriter::logModelSaveError($content,__METHOD__,$content->attributes);
				throw new ExceptionEx('信息保存失败');
			}
			$this->PopMsg('保存成功');
			$adminLeftOneName = !empty($_POST['adminLeftOneName'])?$_POST['adminLeftOneName']:'';
                	$adminLeftTwoName = !empty($_POST['epg'])?$_GET['epg']:$_POST['adminLeftTwoName'];
               	 	$adminLeftOne = !empty($_POST['adminLeftOne'])?$_POST['adminLeftOne']:'';
                	$adminLeftTwo = !empty($_POST['adminLeftTwo'])?$_POST['adminLeftTwo']:'';
			$this->redirect($this->get_url('guide','content',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName)));
		}
		$this->render('uploads');
	}

	public function actionVideo()
	{
	

		//文件保存目录
		$targetFolder = 'file'; // Relative to the root
		//  var_dump($targetFolder);
		//得到上传的临时文件流
		$tempFile = $_FILES['Filedata']['tmp_name'];
		
		if (!is_dir($targetFolder)) {
			mkdir($targetFolder);
		}


		//图片重命名
		$imgType = strchr($_FILES['Filedata']['name'], '.');
		$imgKey = time() . rand(111111, 999999) . $imgType;
		//$imgKey = $_FILES['Filedata']['name'];
		//保存文件
		move_uploaded_file($tempFile, $targetFolder . '/' . $imgKey);

		if (file_exists($targetFolder . '/' . $imgKey)) {
			die('http://' . $_SERVER['HTTP_HOST'] . '/' . $targetFolder . '/' . $imgKey);
		} else {
			die('上传失败');
		}
	}


	public function actionDelete(){
		$id = $_REQUEST['id'];
		$time=time();
		$sql="update yd_ver_upload set `flag`=1,`reason`=2,`time`=$time ,`uname`='{$_SESSION['nickname']}' where id={$id}";
		$count=SQLManager::execute($sql);
		$review_flag = 3;   //提交审核
		$review_times = 1;
		$review_message = '删除数据提审';
		$bind_id = $_REQUEST['id'];
		$review_type = 8;
		$this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);
		if($count>0){
			echo json_encode(array('code'=>'200','msg'=>'已提交审核'));
		}else{
			echo json_encode(array('code'=>'404','msg'=>'提交审核失败'));
		}
	}


	public function up($filename){
		if (!empty($filename)) {
			if ($_FILES[$filename]["error"] > 0) {
				$this->error('上传文件错误! 错误代码:' . $_FILES[$filename]['error'], '', 3);
			}
			$dir = Yii::app()->basePath . '/../file/';
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

}
