<?php

/**
 * Created by PhpStorm.
 * User:
 * Date: 2016/05/13
 * Time: 11:48
 */
class WallpaperController extends VController{

    public function actionIndex(){
         $uid = $_SESSION['userid'];
            $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 5 left join yd_ver_worker as c on c.workid=b.id where c.uid=$uid group by a.id";
            $st = SQLManager::QueryAll($sql);
	    $gud = ""; 
	
	if(!empty($st) && $_SESSION['auth'] <> 1){
		foreach($st as $k =>$v){
			$gud .= ",'".$v['id']."'";	
		}
		$gud ="(". substr($gud,1,strlen($gud)-1)."";
	}

	
	$id=$_GET['nid'];
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $username=$_SESSION['nickname'];
        $flag=5;
        $res = Common::getStation($username,$flag);
	if(!empty($id) && empty($type)){
            $page = 10;
            $data = $this->getPageInfo($page);
            $criteria = new CDbCriteria();
            $criteria->select = '*';
            if(!empty($res['stationId']) || $_SESSION['auth']=='1'){
                if(!empty($res['stationId']) && $_SESSION['auth']=='1'){
			 $criteria->addCondition("gid=".$res['stationId'][0]);
                }else {
		//if(!empty($res['stationId'])){
		//	$criteria->addCondition("gid=".$res['stationId'][0]);
		//}
		  if(!empty($gud)){
                        $criteria->addCondition("gid in".$gud.")");
                    }

		}
            }else{
		
                $criteria->addCondition("flag=7");
            }
            $count = VerWall::model()->count($criteria);
            $criteria->offset = $data['start'];
            $criteria->limit = $data['limit'];
            $criteria->order = 'addTime desc';
            $list = VerWall::model()->findAll($criteria);
            $url = $this->createUrl($this->action->id);
            $pagination = $this->renderPagination($url,$count,$page,$data['currentPage'],$count);
   
	    $this->render('index',array('list'=>$list,'page'=>$pagination,'res'=>$res));
        }else{ 
		
            $gid  = !empty($_REQUEST['gid'])?$_REQUEST['gid']:'';
            $page = 10;
            $data = $this->getPageInfo($page);
            $criteria = new CDbCriteria();
            $criteria->select = '*';
            $count = VerWall::model()->count($criteria);
		if(!empty($res['stationId']) || $_SESSION['auth']=='1'){
                if(!empty($res['stationId']) && $_SESSION['auth']=='1'){
             
		    $criteria->addCondition("gid=".$res['stationId'][0]);
                }else{
                    if(!empty($gid)){
                        $criteria->addCondition("gid=".$gid);
                    }
		     if(!empty($gud)){
                        $criteria->addCondition("gid in".$gud.")");
                    }

                    if(!empty($_REQUEST['title'])){
                        $criteria->addCondition("title like '%{$_REQUEST['title']}%'");
                    }
		    if(!empty($_REQUEST['type'])){
			if($_REQUEST['type']==1){
                        	$criteria->addCondition(" type=0");
			}else{
				$criteria->addCondition(" type=1");
			}
                    }
                    if(!empty($_REQUEST['province'])) {
                        $criteria->addCondition(" province like '%{$_REQUEST['province']}%'");
                    }
                }
            }else{
                $criteria->addCondition("flag=7");
            }
            $criteria->order = 'addTime desc';
            $list = VerWall::model()->findAll($criteria);
            $url = $this->createUrl($this->action->id);
            $pagination = $this->renderPagination($url,count($list),$page,$data['currentPage'],$count);
           // print_r($list);
       
	  $this->render('index',array('list'=>$list,'page'=>$pagination,'res'=>$res));
        }


    }

    public function actionAdd(){
        try{
		//var_dump($_REQUEST);die;
            if(!empty($_GET['id'])){
                $paper = MvWallpaper::model()->findByPk($_GET['id']);
                $id = $_GET['id'];
                $provinceCode = array_map(create_function('$record','return $record->attributes;'),MvWallpaper::model()->findAll("id = $id"));
                if(!empty($provinceCode)){
                    $p = $provinceCode[0]['province'];//查询出来的省份编码
                    $c = $provinceCode[0]['city'];//查询出来的城市编码
                    $cityCode = array_map(create_function('$record','return $record->attributes;'),City::model()->findAll("provinceId = $p"));
                }
            }else{
                $paper = new MvWallpaper();
                $paper->addTime = time();
            }
            if(!empty($_POST)){

                $paper ->title = trim($_POST['title']);

                $sheng = explode('_',$_POST['province']);
                $paper -> province = trim($sheng[0]);
                $shi = explode('_',$_POST['city']);
                $paper -> city     = trim($shi[0]);


                if(!empty($_FILES['pic']['tmp_name'])){
                    $filename = 'pic';
                    $path = $this->up($filename);
                    $paper ->pic    = FTP_PATH . $path;
                    //$paper ->pic    = 'http://192.168.1.109/file/' . $path;
                }
                if(!$paper->save()){
                    LogWriter::logModelSaveError($paper,__METHOD__,$paper->attributes);
                    throw new ExceptionEx('信息保存失败');
                }

                $this->PopMsg('保存成功');
                $this->redirect($this->get_url('wallpaper','index'));
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

        $this->render('add',array('wallpaper'=>$paper,'province'=>$province,'provinceCode'=>$p,'city'=>$cityCode,'cityCode'=>$c));
    }

    public function actionNewAdd()
    {
        $this->render('newAdd');
    }

    public function actionUpdate()
    {
        try{
            if(!empty($_GET['id'])){
                $paper = VerWall::model()->findByPk($_GET['id']);
                $id = $_GET['id'];
                $provinceCode = array_map(create_function('$record','return $record->attributes;'),VerWall::model()->findAll("id = $id"));
                if(!empty($provinceCode)){
                    $p = $provinceCode[0]['province'];//查询出来的省份编码
                    $c = $provinceCode[0]['city'];//查询出来的城市编码
                    $cityCode = array_map(create_function('$record','return $record->attributes;'),City::model()->findAll("provinceId = $p"));
                }
            }else{
                $paper = new VerWall();
                $paper->addTime = time();
            }
            if(!empty($_POST)){

                $paper ->title = trim($_POST['title']);

                $sheng = explode('_',$_POST['province']);
                $paper -> province = trim($sheng[0]);
                $shi = explode('_',$_POST['city']);
                $paper -> city     = trim($shi[0]);

                if(!empty($_FILES['pic']['tmp_name'])){
                    $filename = 'pic';
                    $path = $this->up($filename);
                    $paper ->pic    = FTP_PATH . $path;
                    //$paper ->pic    = 'http://192.168.1.109/file/' . $path;
                }
                if(!$paper->save()){
                    LogWriter::logModelSaveError($paper,__METHOD__,$paper->attributes);
                    throw new ExceptionEx('信息保存失败');
                }

                $this->PopMsg('保存成功');
                $this->redirect($this->get_url('wallpaper','index'));
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
	//var_dump($p);die;
        $this->render('update',array('wallpaper'=>$paper,'province'=>$province,'provinceCode'=>$p,'city'=>$cityCode,'cityCode'=>$c));
    }

    public function actionDoNewAdd()
    {
	$gid=$_REQUEST['gid'];
	//var_dump($gid);die;
	$start=!empty($_POST['start'])?strtotime($_POST['start']):0;
	$end=!empty($_POST['end'])?strtotime($_POST['end'])+86399:0;
	//var_dump($_POST['Code']);die;
	if($_POST['Code']!="0-0"){
	for($i=0;$i<count($_POST['Code']);$i++){
            $tmp=$_POST['Code'][$i];
            $arr=explode("-",$tmp);
            $cCode=$arr[1];//市code
            $pCode=$arr[0];//省份code
            $sql="select id from yd_ver_wall where gid=$gid and province like '%$pCode%' and city like '%$cCode%' and type=1  and ((endTime>={$end} and startTime<={$start}) or (startTime<={$end} and startTime>={$start}) or (endTime>={$start} and endTime<={$end}))";
            $data[]=SQLManager::queryRow($sql);
        }
	//var_dump($data);die;
	//echo $sql;die;
	for($i=0;$i<count($data);$i++){
            if($data[$i]!=false) {
                echo 321;die;
            }
        }}
		$model = new VerWall();
        	$model->title = trim($_POST['title']);
        	$Code=$_REQUEST['Code'];//选择的Code
        	//var_dump($Code);die;
        	$cityCode=array();
        	$provinceCode=array();
        	$newArr=array();
        for($i=0;$i<count($Code);$i++){
            $tmp=$Code[$i];
            $arr=explode("-",$tmp);
            $cityCode[]=$arr[1];//市code
            $provinceCode[]=$arr[0];//省份code
        }
        $c=join("/",$cityCode);
        $p=join("/",$provinceCode);
        $newArr=array("province"=>$p,"city"=>$c);
        $model->province=$newArr['province'];
        $model->city=$newArr['city'];
        //var_dump($cityCode);die;
        $pic_true = trim($_POST['pic']);
        $pic_thum = trim($_POST['thum']);
        $pic_true = basename($pic_true);
        $pic_thum = basename($pic_thum);
        //Common::synchroPic($pic_true);
	$model->thum = FTP_PATH.$pic_thum;
        $model->pic = FTP_PATH . $pic_true;
        $model->gid =  trim($_POST['gid']);
        $model->flag =  0;
        $model->addTime = time();
        $model->type=!empty($_POST['type'])?$_POST['type']:0;//默认普通类型
        $model->startTime=!empty($_POST['start'])?strtotime($_POST['start']):0;
        $model->endTime=!empty($_POST['end'])?strtotime($_POST['end'])+86399:0;
	$model->pic_time=time();//图片上传时间
        if($model->save()){
            echo '200';
        }else{
            echo '500';
        }
    }

    public function actionDoUpdate()
    {	
	$gid=$_POST['gid'];
        $id = trim($_POST['id']);
        $title = trim($_POST['title']);
        $thum = trim($_POST['thum']);
        //$pic = trim($_POST['pic']);
        $pic_true = trim($_POST['pic']);
        $pic_true = basename($pic_true);
        $pic_thum = basename($thum);
	$pic_time=!empty($_POST['pic_time'])?$_POST['pic_time']:time();
	$startTime=!empty($_POST['start'])?strtotime($_POST['start']):0;
        $endTime=!empty($_POST['end'])?strtotime($_POST['end'])+86399:0;
	$Code=$_POST['Code'];
        if($Code!="0-0"){
            for($i=0;$i<count($_POST['Code']);$i++){
                $tmp=$_POST['Code'][$i];
                $arr=explode("-",$tmp);
                $cCode=$arr[1];//市code
                $pCode=$arr[0];//省份code
                $sql="select id from yd_ver_wall where id not in($id) and gid=$gid and province like '%$pCode%' and city like '%$cCode%' and type=1  and ((endTime>={$endTime} and startTime<={$startTime}) or (startTime<={$endTime} and startTime>={$startTime}) or (endTime>={$startTime} and endTime<={$endTime}))";
                $data[]=SQLManager::queryRow($sql);
            }
            for($i=0;$i<count($data);$i++){
                if($data[$i]!=false) {
                    echo 321;die;//存在相同时间壁纸
                }
            }
        }
        $type=$_POST['type'];//壁纸类型
        $res=VerWall::model()->findByPk($id);
        $pic_t=$res->pic;
        $pic_u=$res->thum;
        if(!empty($pic_t)){
            if(basename($pic_t)!==$pic_true){
           //Common::synchroPic($pic_true);
           //$pic = 'http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $pic_true;
           $pic = FTP_PATH . $pic_true;
	   }else{
		$pic=FTP_PATH.$pic_true;
	   }
        }
	 if(!empty($pic_u)){
            if(basename($pic_u)!==$pic_thum){
                //Common::synchroPic($pic_thum);
           //$pic_thum = 'http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $pic_thum;
           $pic_thum = FTP_PATH . $pic_thum;
	   }else{
		$pic_thum=FTP_PATH.$pic_thum;
	   }
        }
        //Common::synchroPic($pic_true);
        //$pic = 'http://117.131.17.46:8086/file/' . $pic_true;
        //$pic = 'http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $pic_true;
        //$pic = 'http://117.144.248.58:8082/file/' . $pic_true;
        //$gid = trim($_POST['gid']);
        $addTime = time();
	for($i=0;$i<count($Code);$i++){
            $tmp=$Code[$i];
            $arr=explode("-",$tmp);
            $cityCode[]=$arr[1];//市code
            $provinceCode[]=$arr[0];//省份code
        }
        $c=join("/",$cityCode);
        $p=join("/",$provinceCode);
        $sql_set = "update yd_ver_wall set `province`='$p',`city`='$c', `title`='$title',`thum`='$pic_thum',`pic`='$pic',`gid`=$gid,`addTime`=$addTime,`flag`=0 ,`startTime`=$startTime,`endTime`=$endTime,`type`=$type";
        $sql_where = " where id=$id";
        $sql = $sql_set.$sql_where;
        $res = SQLManager::execute($sql);
        if($res){
           echo '200';
        }else{
            echo '500';
        }
    }

    public function actionDel(){
        if(empty($_POST['id'])) $this->die_json(array('code'=>404,'msg'=>'参数不能为空'));
        $del = VerWall::model()->deleteByPk($_POST['id']);
        if(!$del){
            $this->die_json(array('code'=>404,'msg'=>'删除失败'));
        }
      //  $title = count($del) > 1 ? '' : $del[0]['name'];
        //$this->RecordOperatingLog(MSG::MYSQL_EDIT_DEL,$del,'权限组',$title);
        $this->die_json(array('code'=>404,'msg'=>'删除成功'));
    }

    public function actionGetcity(){
        $id=$_GET['id'];
        $city = array_map(create_function('$record','return $record->attributes;'),City::model()->findAll("provinceId = '$id' order by id desc"));

        echo json_encode($city);
    }

    public function actionReview()
    {
        try{
            $username = $_SESSION['nickname'];
            $flag=5;
            $workid = Common::EditWorkid($username,$flag);
            $reject = VerWallReject::model()->find("vid = '{$_REQUEST['id']}' and flag=$flag");
            if(empty($reject)){
                $reject = new VerWallReject();
            }
            $reject->user = $username;
            $reject->addTime=time();
            $reject->vid=$_REQUEST['id'];
            $reject->flag='5';
            $reject->save();
            $result = VerWall::model()->updateAll(array('flag'=>1,'workid'=>$workid,'cTime'=>time()),'id=:id',array(':id'=>$_REQUEST['id']));
            if($result){
                echo json_encode(array('code'=>200));
            }else{
                echo json_encode(array('code'=>404));
            }
        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
        }
    }

    public function actionAccess(){
        try {
            $username=$_SESSION['nickname'];
            $flag= '5';
            $res  = Common::workid($username,$flag);
            $tmp = VerWall::model()->findByPk($_REQUEST['gid']);
            $this->AccessReject($_REQUEST['gid'],$flag);
            $this->rejectlog($_REQUEST['gid'],1);
            if($tmp->attributes['flag']==$res || $tmp->attributes['flag']=='5'){
                $result = VerWall::model()->updateAll(array('flag'=>6),'id=:id',array(':id'=>$_REQUEST['gid']));
            }else{
                $flag=$tmp->attributes['flag']+1;
                $result = VerWall::model()->updateAll(array('flag'=>$flag),'id=:id',array(':id'=>$_REQUEST['gid']));
            }
            if($result){
                echo json_encode(array('code'=>200));
            }else{
                echo json_encode(array('code'=>404));
            }

        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
        }
    }


    public function actionAllAccess(){
        $username = $_SESSION['nickname'];
        $flag=5;
        $res  = Common::workid($username,$flag);
        $arr=explode(' ',trim($_REQUEST['ids']));
	
        foreach($arr as $k=>$v){
            $tmp = VerWall::model()->findByPk($v);
         
	   $this->AccessReject($v,$flag);
        
	    $this->rejectlog($v,1);
	     $sql = "select c.type from yd_ver_wall as a left join yd_ver_station as b on a.gid=b.id left join yd_ver_work c on b.id = c.stationId and c.flag = 5 where a.id = ".$tmp->attributes['id'];
//                        $AA['0']['type'] = ""; 
			$AA =  SQLManager::QueryAll($sql);
		if(empty($AA)){$AA['0']['type'] = "";
 }		
	    if($tmp->attributes['flag']==0 || $tmp->attributes['flag']== 6){
			return false;	
	    }
            if($tmp->attributes['flag']==$AA['0']['type'] || $tmp->attributes['flag']=='5'){
                $result = VerWall::model()->updateAll(array('flag'=>6),'id=:id',array(':id'=>$v));
            }else{
                $newflag=$tmp->attributes['flag']+1;
                $result = VerWall::model()->updateAll(array('flag'=>$newflag),'id=:id',array(':id'=>$v));
            }
		
        }
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
        $username = $_SESSION['nickname'];
        $message = $_REQUEST['message'];
        if($_REQUEST['flag']=='1'){
            $tmp = VerWall::model()->findByPk($_REQUEST['gid']);
            $reject = VerWallReject::model()->find("vid = '{$_REQUEST['gid']}'");
            if(empty($reject)){
                $reject = new VerWallReject();
            }
            switch($tmp->attributes['flag']){
                case '1':$reject->message1=$message;$reject->addTime1  = time();$reject->user1=$username;break;
                case '2':$reject->message2=$message;$reject->addTime2  = time();$reject->user2=$username;break;
                case '3':$reject->message3=$message;$reject->addTime3  = time();$reject->user3=$username;break;
                case '4':$reject->message4=$message;$reject->addTime4  = time();$reject->user4=$username;break;
                case '5':$reject->message5=$message;$reject->addTime5  = time();$reject->user5=$username;break;
            }
            $reject->delFlag='0';
            $reject->vid  = $_REQUEST['gid'];
            $reject->save();
            $this->rejectlog($_REQUEST['gid'],2);
            $resulst = VerWall::model()->updateAll(array('flag'=>0),'id=:id',array(':id'=>$_REQUEST['gid']));
        }else{
            $arr = explode(' ',trim($_REQUEST['gid']));
            foreach($arr as $k=>$v){
                $tmp = VerWall::model()->findByPk($v);
                $reject = VerWallReject::model()->find("vid = '{$v}'");
                if(empty($reject)){
                    $reject = new VerWallReject();
                }
                $test = $tmp->attributes['flag'];
                switch($test){
                    case '1':$reject->message1=$message;$reject->addTime1  = time();$reject->user1=$username;break;
                    case '2':$reject->message2=$message;$reject->addTime2  = time();$reject->user2=$username;break;
                    case '3':$reject->message3=$message;$reject->addTime3  = time();$reject->user3=$username;break;
                    case '4':$reject->message4=$message;$reject->addTime4  = time();$reject->user4=$username;break;
                    case '5':$reject->message5=$message;$reject->addTime5  = time();$reject->user5=$username;break;
                }
                $reject->delFlag='0';
                $reject->vid  = $v;
                $reject->save();
                $this->rejectlog($v,2);
                $resulst = VerWall::model()->updateAll(array('flag'=>0),'id=:id',array(':id'=>$v));
            }
        }
    }

    public function AccessReject($gid,$flag){
        $tmp = VerWall::model()->findByPk($gid);
        $message = '通过';
        $reject = VerWallReject::model()->find("vid = '$gid' and flag='$flag'");
        if(empty($reject)){
            $reject = new VerWallReject();
        }
        switch($tmp->attributes['flag']){
            case '1':$reject->message1=$message;$reject->addTime1  = time();$reject->user1=$_SESSION['nickname'];break;
            case '2':$reject->message2=$message;$reject->addTime2  = time();$reject->user2=$_SESSION['nickname'];break;
            case '3':$reject->message3=$message;$reject->addTime3  = time();$reject->user3=$_SESSION['nickname'];break;
            case '4':$reject->message4=$message;$reject->addTime4  = time();$reject->user4=$_SESSION['nickname'];break;
            case '5':$reject->message5=$message;$reject->addTime5  = time();$reject->user5=$_SESSION['nickname'];break;
        }
        $reject->delFlag='0';
        $reject->vid  = $gid;
        $reject->save();
    }


    public function rejectlog($vid,$flag){
        $tmp = VerWallReject::model()->find("vid='$vid'");
        $reject = new VerWallLog();
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
    public function actionLog(){
        $flag = $_REQUEST['flag'];
        $sql = "select * from yd_ver_wall_log r inner join yd_ver_wall w on w.id=r.vid where r.flag='$flag'";
        $result = SQLManager::queryAll($sql);
        echo json_encode($result);
    }


    public function actionAccesslog(){

        $username=$_SESSION['nickname'];
        $flag= '5';
        $res  = Common::getUser($username,$flag);
        $page = 20;
        $data = $this->getPageInfo($page);
        $list = array();
        if(!empty($_REQUEST['type'])){
            $list['type']=$_REQUEST['type'];
        }
        $list['cp']=$res['cp'];
        $list['review']=$res['review'];
        if($_SESSION['auth']==1){
            $list['workid'] ='';
        }else{
            $list['workid']=Common::WorkidList($username,$flag);
        }
        $tmp =VideoManager::getWallReview($data,$list);
        $url = $this->createUrl($this->action->id);
        $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage']);
        $list = array();
        if(!empty($res['review']) || $_SESSION['auth']=='1'){
            $list = $tmp['list'];
        }else{
            if(in_array('3',$res['status'])){
                $list=$tmp['list'];
            }
        }
        echo json_encode($list);
    }
	public function actionGetInfo(){
		$stationId=$_REQUEST['stationId'];
        	$info=VerStation::model()->findByPk($stationId);
        	$province=$info->province;
        	$city=$info->city;
		$flag=explode(" ",$province);
		$cflag=explode(" ",$city);
		//var_dump($flag);die;
		for($i=0;$i<count($flag);$i++){
			$sql="select * from yd_province where provinceCode={$flag[$i]}";
			$sql_c="select * from yd_city where cityCode='{$cflag[$i]}' and provinceId=$flag[$i]";
			$data[]=SQLManager::queryRow($sql);
			$data_c[]=SQLManager::queryRow($sql_c);

			for($j=0;$j<count($data);$j++){
				$new[$j]=array("provinceName"=>$data[$j]['provinceName'],"cityName"=>$data_c[$j]['cityName'],"provinceCode"=>$data[$j]['provinceCode'],"cityCode"=>$data_c[$j]['cityCode']);
			}
		}
		//var_dump($new);die;
		
        	echo json_encode($new);
	}

	public function actionCity(){//壁纸生效省市
        $stationId=$_REQUEST['stationId'];
        $info=VerStation::model()->findByPk($stationId);
        $province=$info->province;
        $city=$info->city;
        $flag=explode(" ",$province);
        $cflag=explode(" ",$city);
        for($i=0;$i<count($flag);$i++){//站点下的省份
            $sql="select * from yd_province where provinceCode={$flag[$i]}";
            $sql_c="select * from yd_city where cityCode='{$cflag[$i]}' and provinceId=$flag[$i]";
            $data[]=SQLManager::queryRow($sql);
            $data_c[]=SQLManager::queryRow($sql_c);
            for($j=0;$j<count($data);$j++){
                $new[$j]=array("provinceName"=>$data[$j]['provinceName'],"cityName"=>$data_c[$j]['cityName'],"provinceCode"=>$data[$j]['provinceCode'],"cityCode"=>$data_c[$j]['cityCode']);
            }
        }
	//var_dump($new);
	
	$data="select * from yd_ver_wall where gid=$stationId and id={$_REQUEST['id']}";
        $result=SQLManager::queryRow($data);
	$res=array();
	if(!empty($result)){
            $p=explode("/",$result['province']);
	    $c=explode("/",$result['city']);
            for($i=0;$i<count($p);$i++){
                $sql="select p.provinceName,c.cityName,p.provinceCode,c.cityCode from yd_province p,yd_city c WHERE p.provinceCode=c.provinceId and p.provinceCode=$p[$i] and c.cityCode=$c[$i]";
                $res[]=SQLManager::queryRow($sql);
            }
        }

	//var_dump($res);

	for($m=0;$m<count($res);$m++){
            for($n=0;$n<count($new);$n++){
                if($res[$m]==$new[$n]){
                    $new[$n]['checked']="checked";
                }
            }
        }

	echo json_encode($new);
    }
}

