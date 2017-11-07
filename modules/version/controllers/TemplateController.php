<?php
class TemplateController extends VController
{
    public function actionIndex()
    {
//        $guideModel = new MvGuide();
        $this->render('index');

    }

    public function actionDefault(){
	$sql_count="select count(id) ";
	$sql="select * ";
	$sql_from=" from yd_ver_template ";
	$sql_where=" where 1=1";
	if(!empty($_REQUEST['title'])){
            $sql_where .=" and name like '%{$_REQUEST['title']}%'";
        }
	$sql_order=" order by id desc";
	
        $res=SQLManager::queryAll($sql.$sql_from.$sql_where.$sql_order);

	$count=SQLManager::queryRow($sql_count.$sql_from.$sql_where);
	$alwayscount=SQLManager::queryRow($sql_count.$sql_from);
	$page = 20;
	$data = $this->getPageInfo($page);
	$url = $this->createUrl($this->action->id);
	$pagination = $this->renderPagination($url,$count['count(id)'],$page,$data['currentPage'],$alwayscount['count(id)']);
        $this->render("default",array("data"=>$res,"page"=>$pagination));
    }

    public function actionChose()
    {
        $nid=$_GET['nid'];
        $gid=$nid;
        $epg=$_GET['epg'];
        if($epg=='首页'){
            $epg=1;
        }
        if($epg=='影视'){
            $epg=2;
        }
        if($epg=='教育'){
            $epg=3;
        }
        if($epg=='游戏'){
            $epg=4;
        }
        if($epg=='应用'){
            $epg=5;
        }
        if($epg=='咪咕专区'){
            $epg=6;
        }
        if($epg=='综艺专区'){
            $epg=7;
        }
        if($epg=='华数专区'){
            $epg=8;
        }
        if($epg=='咪咕极光'){
            $epg=9;
        }
        if($epg=='咪咕现场秀'){
            $epg=10;
        }
        if($epg=='咪咕精彩'){
            $epg=11;
        }
        if($epg=='甘肃专区'){
            $epg=12;
        }
        if($epg=='音乐'){
            $epg=13;
        }
        if($epg=='体育'){
            $epg=14;
        }
        if($epg=='南传专区'){
            $epg=15;
        }

        $mvui = MvUiManager::getAll($gid,$epg,99);
        $xiaotu = MvUiManager::getAll($gid,$epg,1);
        $html = HTML::moveThree($mvui,$xiaotu);
        $this->render("chose",array('html'=>$html,'mvui'=>$mvui,'xiaotu'=>$xiaotu,'gid'=>$gid,'epg'=>$epg));//,'epg'=>$epg
    }

    public function actionChose2()
    {
        $nid=$_GET['nid'];
        $gid=$nid;
        $epg=$_GET['epg'];
        if($epg=='首页'){
            $epg=1;
        }
        if($epg=='影视'){
            $epg=2;
        }
        if($epg=='教育'){
            $epg=3;
        }
        if($epg=='游戏'){
            $epg=4;
        }
        if($epg=='应用'){
            $epg=5;
        }
        if($epg=='咪咕专区'){
            $epg=6;
        }
        if($epg=='综艺专区'){
            $epg=7;
        }
        if($epg=='华数专区'){
            $epg=8;
        }
        if($epg=='咪咕极光'){
            $epg=9;
        }
        if($epg=='咪咕现场秀'){
            $epg=10;
        }
        if($epg=='咪咕精彩'){
            $epg=11;
        }
        if($epg=='甘肃专区'){
            $epg=12;
        }
        if($epg=='音乐'){
            $epg=13;
        }
        if($epg=='体育'){
            $epg=14;
        }
        if($epg=='南传专区'){
            $epg=15;
        }

        $mvui = MvUiManager::getAll($gid,$epg,99);
        $xiaotu = MvUiManager::getAll($gid,$epg,1);
        $html = HTML::move($mvui,$xiaotu);

        $this->render("chose2",array('html'=>$html,'mvui'=>$mvui,'xiaotu'=>$xiaotu,'gid'=>$gid,'epg'=>$epg));//,'epg'=>$epg
    }

    public function actionSelect()
    {
        $this->render('select');
    }

    public function actionFirstPageAdd()
    {
        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        if(empty($_POST['tType'])) $this->die_json(array('code'=>404,'msg'=>'上传类型不能为空'));
        if(empty($_POST['title'])) $this->die_json(array('code'=>404,'msg'=>'标题不能为空'));
        if(empty($_POST['key'])) $this->die_json(array('code'=>404,'msg'=>'图片地址不能为空'));
        if(empty($_POST['position'])) $this->die_json(array('code'=>404,'msg'=>'系统错误'));
        $mvui = MvUi::model()->findByAttributes(array('position'=>$_POST['position'],'type'=>$_POST['type'],'id'=>$_POST['id']));
        if(!$mvui){
            $mvui = new MvUi();
            $mvui->addTime = time();
        }else{
            $mvui->upTime = time();
        }

        $mvui->title    = trim($_POST['title']);
        $mvui->position = trim($_POST['position']);
        $mvui->type     = trim($_POST['type']);
        $mvui->tType    = trim($_POST['tType']);
        $mvui->cp       = trim($_POST['cp']);
        $mvui->gid      = trim($_POST['gid']);
        $mvui->epg      = trim($_POST['epg']);
        $mvui->action   = trim($_POST['action']);
        $mvui->param    = trim($_POST['param']);
        $mvui->pic      = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . trim(substr($_POST['key'],-36));
        if(!$mvui->save()){
            LogWriter::logModelSaveError($mvui,__METHOD__,$mvui->attributes);
            $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
        }
//        if(!empty($_REQUEST['flag'])){
//            $this->RecordAdd($_POST,$mvui->pic,$flag=1);
//        }else{
//            $this->RecordAdd($_POST,$mvui->pic,$flag=0);
//        }

        $this->die_json(array('code'=>200));
    }

    public function actionTest()
    {
    	if(!empty($_POST['html'])){
		//var_dump($_POST);die;
    	
    		$pa = "/e\">([\s\S]*?)<\/p>/";
		//$pa="/\">([\s\S]*?)<\/td>/";
    		preg_match_all($pa, $_POST['html'],$aa);
		$arr = $aa[1];
		//var_dump($arr);die;
			foreach ($arr as $key => $value) {
				$arr[$key] = explode(',', str_replace("<br>", ",", $value));
				//var_dump($arr[$key]);die;
				if(count($arr[$key]) == 1){
					$arr[$key]['start'] = explode("x",$arr[$key][0]);;
					$arr[$key]['width'] = $_POST['width'];
					$arr[$key]['height'] = $_POST['height'];
					$arr[$key]['cols'] = 1;
					$arr[$key]['rows'] = 1;
				}else{
					$res=explode("x",$arr[$key][count($arr[$key])-1]);
					$arr[$key]['end'] = $res;
					$arr[$key]['start'] = explode("x",$arr[$key][0]);
					$arr[$key]['width'] = $arr[$key]['end'][0] - $arr[$key]['start'][0] + $_POST['width'];
					$arr[$key]['height'] = $arr[$key]['end'][1] - $arr[$key]['start'][1] + $_POST['height'];
					$arr[$key]['cols'] = (($arr[$key]['width'] - $_POST['width'])/($_POST['width'] + $_POST['cellspacing']) + 1);
					$arr[$key]['rows'] = (($arr[$key]['height'] - $_POST['height'])/($_POST['height'] + $_POST['cellspacing']) + 1);
				}
				
			}//var_dump($arr);die;

			 if(!empty($_FILES['url']['tmp_name'])){
                    $filename = 'url';
                    $path = $this->up($filename);
                    //$bkimg ->url    = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . $path;
                    $pic    = "/file/". $path;
                    //$guide ->ico_true 1   = 'http://192.168.1.110/file/' . $path;
                }

			$name = !empty($_POST['name'])?$_POST['name']:"";
			$sql = "INSERT yd_ver_template(pic,name,cols,rows,colw,roww,cellspacing,h_coord,v_coord,add_time,add_user) values ('{$pic}','$name','{$_POST['cols']}','{$_POST['rows']}','{$_POST['width']}','{$_POST['height']}','{$_POST['cellspacing']}','{$_POST['h_coord']}','{$_POST['v_coord']}','".time()."','".$_SESSION['username']."')";
			$res = SQLManager::execute($sql);
			$sql = "select id from yd_ver_template where name = '$name' and pic = '{$pic}'";
			$res = SQLManager::queryAll($sql);
			if(!empty($res)){
				$id = $res[0]['id'];
			$sql = "INSERT yd_ver_template_detail(tem_id,x,y,width,height,cols,rows) VALUES";
			
			foreach ($arr as $key => $value) {
				$x = $value['start'][0];
				$y = $value['start'][1];
				$width = $value['width'];
				$height = $value['height'];
				$cols = $value['cols'];
				$rows = $value['rows'];
				$sql .= "('$id','$x','$y','$width','$height','$cols','$rows'),";
			}				
				
			}
			$sql = substr($sql,0,strlen($sql)-1);
			//echo $sql;die;
			$res = SQLManager::execute($sql);
			echo "<script>alert('保存成功！')</script>";
			echo '<script>window.location.href="/version/template/default.html?mid=-1&nid=51";</script>';
		}

		$this->render('test');
    }

     public function actionDel(){
        $id=$_POST['id'];
        $sql="delete from yd_ver_template where id={$id}";
        $res=SQLManager::execute($sql);
        if($res){
            echo json_encode(array("code"=>200));
        }else{
            echo json_encode(array("code"=>500));
        }
    }


    public function up($filename){
        if (!empty($filename)) {
            if ($_FILES[$filename]["error"] > 0) {
                $this->error('上传文件错误! 错误代码:' . $_FILES[$filename]['error'], '', 3);
            }
            $dir =  Yii::app()->basePath . '/../file/';
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
