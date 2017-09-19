<?php
class StationController extends VController
{
    public function actionIndex()
    {
//        $model = new VerStation();
        /*$sql = "select a.id,a.cp,a.usergroup,a.epgcode,mark,a.name,b.provinceName,c.cityName from yd_ver_station as a left join yd_province as b on a.province=b.provinceCode left join yd_city as c on a.city=c.cityCode group by a.id limit 10";
	//var_dump($sql);die;
        $list = SQLManager::queryAll($sql);*/
        $p = !empty($_REQUEST['p'])?$_REQUEST['p']:'0';
        $page = $p*30;
//        $model = new VerStation();
        //$sql = "select a.id,a.cp,a.usergroup,a.epgcode,mark,a.name,b.provinceName,c.cityName from yd_ver_station as a left join yd_province as b on a.province=b.provinceCode left join yd_city as c on a.city=c.cityCode group by a.id limit 10";
//        $sql = "select * from yd_ver_station limit $page,10";
        $sql_where = " where delFalg=0 ";
        if(!empty($_REQUEST['name'])){
            $sql_where .=" and name like '%{$_REQUEST['name']}%'";
        }
        if(!empty($_REQUEST['cp'])){
            $sql_where .=" and cp like '%{$_REQUEST['cp']}%'";
        }
        $sql_select = "select * from yd_ver_station";
        $sql_limit = " limit $page,30";
        $sql = $sql_select . $sql_where . $sql_limit;
        //var_dump($sql);die;
        $list= array();
        $res = SQLManager::queryAll($sql);
        //var_dump($res);die;
        foreach($res as $k=>$v){
            $arr = explode(' ',trim($v['province']));
            $citylist = explode(' ',trim($v['city']));
            $province='';
            $city='';
            foreach($arr as $key=>$val){
                $sql_pro = "select provinceName from yd_province where provinceCode=$val";
                $pro = SQLManager::queryRow($sql_pro);
                $province .=$pro['provinceName'].' ';
            }
            foreach($citylist as $key=>$val){
                $sql_city = "select cityName from yd_city where cityCode='$val'";
                $ci = SQLManager::queryRow($sql_city);
                $city .=$ci['cityName'].' ';
            }
            $list[$k] = $v;
            $list[$k]['provinceName']=$province;
            $list[$k]['cityName']=$city;
        }
        //var_dump($list);die;
        $this->render('index',array('list'=>$list));
    }

    public function actionAdd()
    {
        $province = Province::model()->findAll("provinceCode not in(40,41,42,43,44,45) order by provinceCode asc");
        $p = isset($p) ? $p : '';
        $cityCode = isset($cityCode) ? $cityCode : '';
        $c = isset($c) ? $c : '';

        $n = $this->renderPartial(
            'add',
            array(
                'province'=>$province,
                'provinceCode'=>$p,
                'city'=>$cityCode,
                'cityCode'=>$c,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionDoAdd()
    {
        $model = new VerStation();
        $model->cp        = isset($_POST['cp'])?trim($_POST['cp']):'';
        $model->cps       = isset($_POST['cps'])?trim($_POST['cps']):'';
        $model->province  = isset($_POST['pro'])?trim($_POST['pro']):'';
        $model->city      = isset($_POST['city'])?trim($_POST['city']):'';
        $model->name      = isset($_POST['name'])?trim($_POST['name']):'';
        $model->mark      = isset($_POST['mark'])?trim($_POST['mark']):'';
        $model->usergroup = isset($_POST['usergroup'])?trim($_POST['usergroup']):'';
        $model->epgcode   = isset($_POST['epgcode'])?trim($_POST['epgcode']):'';
        $model->gid       = isset($_POST['gid'])?trim($_POST['gid']):'';
        $pic =  isset($_POST['pic'])?trim($_POST['pic']):'';
        //$model->logo      = 'http://117.144.248.58:8082/file/'.$pic;
        Common::synchroPic($pic);
        //$model->logo      = 'http://117.131.17.46:8086/file/'.$pic;
        $model->logo      = 'http://117.131.17.105:8083/file/'.$pic;
        $sitelist = new VerSitelist();
        $sitelist->pid = '0';
        $sitelist->module = 'version';
        $sitelist->url = '/version/station/default';
        $sitelist->name = isset($_POST['name'])?trim($_POST['name']):'';
        $sitelist->type = '0';
        $sitelist->protype='1';
        if($sitelist->save()){
            $pid = $sitelist->attributes['id'];
            $arr = array('栏目','专题');
            for($i=0;$i<count($arr);$i++){
                $site = new VerSitelist();
                $site->pid = $pid;
                if($arr[$i]=='栏目'){
                    $url = '/version/station/index';
                }else{
                    $url = '/version/station/topic';
                }
                $site->name = $arr[$i];
                $site->url = $url;
                $site->module='version';
                $site->type = '1';
                $site->save();
            }
        }
        if($model->save()){
            $this->stationlog($model);
            echo '200';
        }else{
            echo '500';
        }
    }

    public function actionUpdate()
    {
        /*$id = trim($_REQUEST['id']);
        $sql = "select a.id,a.cp,a.usergroup,a.epgcode,mark,a.name,b.provinceName,c.cityName from yd_ver_station as a left join yd_province as b on a.province=b.provinceCode left join yd_city as c on a.city=c.cityCode where a.id=$id";
        $list = SQLManager::queryAll($sql);

        $province = Province::model()->findAll("provinceCode not in(40,41,42,43,44,45) order by provinceCode asc");
        $p = isset($p) ? $p : '';
        $cityCode = isset($cityCode) ? $cityCode : '';
        $c = isset($c) ? $c : '';

        $cp = explode('/',$list[0]['cp']);
        $cps = explode('/',$list[0]['cps']);
        $n = $this->renderPartial(
            'update',
            array(
                'province'=>$province,
                'provinceCode'=>$p,
                'city'=>$cityCode,
                'cityCode'=>$c,
                'list'=>$list,
                'cp'=>$cp,
                'cps'=>$cps,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));*/
        $id = trim($_REQUEST['id']);
        //$sql = "select a.id,a.cp,a.usergroup,a.epgcode,mark,a.name,b.provinceName,c.cityName from yd_ver_station as a left join yd_province as b on a.province=b.provinceCode left join yd_city as c on a.city=c.cityCode where a.id=$id";
        $sql = "select * from yd_ver_station where id=$id";
        $list = SQLManager::queryAll($sql);
        $province = Province::model()->findAll("provinceCode not in(40,41,42,43,44,45) order by provinceCode asc");
        $p = isset($p) ? $p : '';
        $cityCode = isset($cityCode) ? $cityCode : '';

        $c = isset($c) ? $c : '';
        $pro = explode(' ',trim($list[0]['province']));
        $num = count($pro);
        $city = explode(' ',trim($list[0]['city']));
        //var_dump($city);
        for($i=0;$i<count($city);$i++){
            //$cityarr[]= array_map(create_function('$record','return $record->attributes;'),City::model()->findAll("provinceId = '$city[$i]'"));
            $cityarr[]= array_map(create_function('$record','return $record->attributes;'),City::model()->findAll("provinceId = '$pro[$i]'"));
        }
        //var_dump($cityarr);die;

        $cp = explode('/',$list[0]['cp']);
        $cps = explode('/',$list[0]['cps']);
        $n = $this->renderPartial(
            'update',
            array(
                'pro'=>$pro,
                'citys'=>$city,
                'province'=>$province,
                'city'=>$cityCode,
                'provinceCode'=>$p,
                'cityCode'=>$c,
                'list'=>$list,
                'cp'=>$cp,
                'cps'=>$cps,
                'cityarr'=>$cityarr,
                'num'=>$num
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionDoUpdate()
    {
        $id = trim($_REQUEST['id']);
        $model = VerStation::model()->findByPk($id);
	//var_dump($_REQUEST);die;
        if($_REQUEST['pro'] == '0'){
            $model->mark = isset($_REQUEST['mark'])?trim($_REQUEST['mark']):'';
            $model->name = isset($_REQUEST['name'])?trim($_REQUEST['name']):'';
            $model->usergroup = isset($_REQUEST['usergroup'])?trim($_REQUEST['usergroup']):'';
            $model->epgcode = isset($_REQUEST['epgcode'])?trim($_REQUEST['epgcode']):'';
            $model->cp = isset($_REQUEST['cp'])?trim($_REQUEST['cp']):'';
            $model->cps= isset($_REQUEST['cps'])?trim($_REQUEST['cps']):'';
            $model->province = isset($_REQUEST['pro'])?trim($_REQUEST['pro']):'';
            $model->city = isset($_REQUEST['city'])?trim($_REQUEST['city']):'';
            $model->id = $id;
            $pic =  isset($_POST['pic'])?trim($_POST['pic']):'';
            $pic = basename($pic);
            if(!empty($pic)){
                Common::synchroPic($pic);
                //$model->logo      = 'http://117.144.248.58:8082/file/'.$pic;
                //$model->logo      = 'http://117.131.17.46:8086/file/'.$pic;
                $model->logo      = 'http://117.131.17.105:8083/file/'.$pic;
            }
            $oldname = isset($_REQUEST['oldname'])?trim($_REQUEST['oldname']):'';
            $name = isset($_REQUEST['name'])?trim($_REQUEST['name']):'';
            $resulst = VerSitelist::model()->updateAll(array('name'=>$name),'name=:name',array(':name'=>$oldname));
            if($model->save()){
                echo '200';
            }else{
                echo '500';
            }
        }else{
	    /*var_dump($_REQUEST['city']);
	    if(empty($_REQUEST['city'])){
		echo '1';
	    }else{
		echo '2';
	    }	
	    if(isset($_REQUEST['city'])){
		echo '3';
	    }else{
		echo '4';
	    }
	    die;*/	
            $model->mark = isset($_REQUEST['mark'])?trim($_REQUEST['mark']):'';
            $model->name = isset($_REQUEST['name'])?trim($_REQUEST['name']):'';
            $model->usergroup = isset($_REQUEST['usergroup'])?trim($_REQUEST['usergroup']):'';
            $model->epgcode = isset($_REQUEST['epgcode'])?trim($_REQUEST['epgcode']):'';
            $model->cp = !empty($_REQUEST['cp'])?trim($_REQUEST['cp']):'';
            $model->cps = !empty($_REQUEST['cps'])?trim($_REQUEST['cps']):'';
            $model->province = isset($_REQUEST['pro'])?trim($_REQUEST['pro']):'';
            $model->city = isset($_REQUEST['city'])?trim($_REQUEST['city']):'';
            $model->id = $id;
            $pic =  isset($_POST['pic'])?trim($_POST['pic']):'';
            $pic = basename($pic);
            if(!empty($pic)){
		//echo '1';die;
                Common::synchroPic($pic);
                //$model->logo      = 'http://117.144.248.58:8082/file/'.$pic;
                //$model->logo      = 'http://117.131.17.46:8086/file/'.$pic;
                $model->logo      = 'http://117.131.17.105:8083/file/'.$pic;
            }
            //$model->logo      = 'http://117.144.248.58:8082/file/'.$pic;
            $oldname = isset($_REQUEST['oldname'])?trim($_REQUEST['oldname']):'';
            $name = isset($_REQUEST['name'])?trim($_REQUEST['name']):'';
            $resulst = VerSitelist::model()->updateAll(array('name'=>$name),'name=:name',array(':name'=>$oldname));
            if($model->save()){
                echo '200';
            }else{
		var_dump($model->getErrors());
                echo '500';
            }
        }
    }
    public function actionDel(){
        $id = $_REQUEST['id'];
        $list = VerStation::model()->findByPk($id);
        if(!empty($list)){
            $name = $list->attributes['name'];
            $tmp = VerSitelist::model()->find("name='$name'");
            $sid = $tmp->attributes['id'];
            Yii::app()->db->createCommand()->delete('{{ver_sitelist}}', "pid=$sid");
            $result = VerSitelist::model()->deleteByPk($sid);

        }
        $res = VerStation::model()->deleteByPk($id);
        if($res){
            echo json_encode(array('code'=>200));
        }else{
            echo json_encode(array('code'=>404));
        }
    }


    public function actionTopic(){
        try{
            $username=$_SESSION['nickname'];
            $flag= '2';
            if(!empty($_REQUEST['type'])){
                $result = Common::getWork($_REQUEST['type'],$_REQUEST['nid']);
            }else{
                $result = Common::getUser($username,$flag);
            }

            //$result  = Common::getUser($username,$flag);
            if(!empty($_REQUEST['nid'])){
                $gid = $_REQUEST['nid'];
            }else{
                $gid=$_REQUEST['gid'];
            }
            $bkimg = VerBkimg::model()->find("gid = $gid");
            $html = '';
            if(empty($bkimg)){
                $bkimg = new VerBkimg();
            }else{
                $type = $bkimg->attributes['type'];
                $list =VerUiManager::getAll($gid);
                //var_dump($gid);
                switch($type){
                    case '1':$html = HTML::data($list);break;
                    case '2':$html = HTML::top();break;
                }
            }
//		var_dump($_POST);die;
            if(!empty($_POST)){
                if(empty($_POST['type']))throw new ExceptionEx('请选择链接类型');
                $bkimg->type=$_POST['type'];
                $bkimg->status = '1';
                $bkimg->gid = $_REQUEST['gid'];
                if(!empty($_FILES['url']['tmp_name'])){
                    $filename = 'url';
                    $path = $this->up($filename);
		    //$bkimg ->url    = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . $path;
		    Common::synchroPic($path);	
                    $bkimg ->url    = 'http://117.131.17.105:8083/file/' . $path;
                    //$guide ->ico_true    = 'http://192.168.1.110/file/' . $path;
                }
		if(!empty($_POST['url'])){
                    $bkimg ->url = $_POST['url'];
		    $path = basename($_POST['url']);	
		    Common::synchroPic($path);
                }
                if(!$bkimg->save()){
                    var_dump($bkimg->getErrors());
                    LogWriter::logModelSaveError($bkimg,__METHOD__,$bkimg->attributes);
                    throw new ExceptionEx('信息保存失败');
                }
                $gid = $_REQUEST['gid'];
                $list =VerUiManager::getAll($gid);
                switch($bkimg->type){
                    case '1':$html = HTML::data($list);break;
                }
            }
            $type = $bkimg->attributes['type'];
            /*if($type == '2'){
                $list  = $this->topIndex($gid);
//              echo '<pre>';
//              var_dump($list);die;
                if(!empty($list)){
                    $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'list'=>$list,'res'=>$result));
                }else{
                    $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result));
                }
            }else{
                $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result));
            }*/
            //$this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result));
	    if($type == '2'){
            $list  = $this->topIndex($gid);
//              echo '<pre>';
//              var_dump($list);die;
            if(!empty($list)){
                $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'topList'=>$list,'res'=>$result));
            }else{
                $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result));
            }
        }else if($type == '3'){
            $list  = $this->topIndexNews($gid);
            //      var_dump($list);die;
            if(!empty($list)){
                $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'news'=>$list,'res'=>$result));
            }else{
                $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result));
            }
        }else{
            $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result));
        }	
        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
            $this->PopMsg('系统繁忙,请稍后再试');
        }
    }

    public function actionGuide(){
        $gid = $_REQUEST['gid'];
        $sitelist = VerSitelist::model()->findByPk($gid);
        $type='0';
        $protype='0';
        if(!empty($sitelist)){
            $type = $sitelist->attributes['type'];
            $protype = $sitelist->attributes['protype'];
        }
        $n = $this->renderPartial(
            'guide',
            array(
                'gid'=>$gid,
                'vtype'=>$type,
                'vprotype'=>$protype,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionGuideAdd(){
        $guide = new VerSitelist();
        //var_dump($_REQUEST);die;
        $guide->name=$_REQUEST['name'];
        $guide->type = $_REQUEST['type']+1;
        $guide->protype = isset($_REQUEST['protype'])?$_REQUEST['protype']:'0';
        $guide->search = isset($_REQUEST['search'])?$_REQUEST['search']:'0';
        $guide->filter = isset($_REQUEST['filter'])?$_REQUEST['filter']:'0';
        $guide->url = '/version/station/index';
        $guide->module = 'version';
        $guide->pid = $_REQUEST['gid'];
        $guide->order = '1';
        if(!$guide->save()){
            var_dump($guide->getErrors());
        }
    }

    public function actionEdit(){
        $id = $_REQUEST['id'];
        $site = VerSitelist::model()->findByPk($id);
        $n = $this->renderPartial(
            'edit',
            array(
                'edit'=>$site,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionEditAdd(){
        $guide = VerSitelist::model()->findByPk($_REQUEST['id']);
        //var_dump($_REQUEST);die;
        $guide->name=$_REQUEST['name'];
        $guide->type = $_REQUEST['type'];
        $guide->protype = isset($_REQUEST['protype'])?$_REQUEST['protype']:'0';
        $guide->search = isset($_REQUEST['search'])?$_REQUEST['search']:'0';
        $guide->filter = isset($_REQUEST['filter'])?$_REQUEST['filter']:'0';
        $guide->pid = $_REQUEST['pid'];
        $guide->order = '1';
        if(!$guide->save()){
            var_dump($guide->getErrors());
        }
    }
    public function actionTopAdd(){
        $gid = $_REQUEST['gid'];
        $sitelist = VerSitelist::model()->findByPk($gid);
        $type='0';
        $protype='0';
        if(!empty($sitelist)){
            $type = $sitelist->attributes['type'];
            $protype = $sitelist->attributes['protype'];
        }
        $n = $this->renderPartial(
            'topadd',
            array(
                'gid'=>$gid,
                'vtype'=>$type,
                'vprotype'=>$protype,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionTopSave(){
        $guide = new VerSitelist();
        //var_dump($_REQUEST);die;
        $guide->name=$_REQUEST['name'];
        $guide->type = $_REQUEST['type']+1;
        $guide->protype = isset($_REQUEST['protype'])?$_REQUEST['protype']:'0';
        $guide->search = isset($_REQUEST['search'])?$_REQUEST['search']:'0';
        $guide->filter = isset($_REQUEST['filter'])?$_REQUEST['filter']:'0';
        $guide->url = '/version/station/topic';
        $guide->module = 'version';
        $guide->pid = $_REQUEST['gid'];
        $guide->order = '1';
        if(!$guide->save()){
            var_dump($guide->getErrors());
        }
    }

    public function actionBkadd(){
        $n = $this->renderPartial(
            'bkadd',
            array(

            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
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
    
    public function actionIndexList(){
        $list= array();
        if(!empty($_REQUEST['flag'])){
	    $list['flag']=$_REQUEST['flag'];
        }
        if(!empty($_REQUEST['cp'])){
	    $list['cp']=$_REQUEST['cp'];
        }
        if(!empty($_REQUEST['user'])){
	    $list['user']=$_REQUEST['user'];
        }
        if(!empty($_REQUEST['name'])){
	    $list['name']=$_REQUEST['name'];
        }
        if(isset($_REQUEST['type'])){
            if($_REQUEST['type']=='0'){
               $list['type']='0';
            }else if(!empty($_REQUEST['type'])){

	    $list['type']=$_REQUEST['type'];
            }
        }
        $page = 20;
        $data = $this->getPageInfo($page);
        $tmp =VerStationManager::getData($data,$list);
        $url = $this->createUrl($this->action->id);
        //$pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage']);
	$pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage'],$tmp['alwaysCount']);
	$this->render('indexlist',array('list'=>$tmp['list'],'page'=>$pagination));
	//$this->render('indexlist');
    }

    public function actionGetStationList(){
        $flag=$_REQUEST['flag'];
        $tmp = VerStationManager::getStation($flag);
        echo json_encode($tmp);
    }


    public function actionGetData(){
        $username=$_SESSION['nickname'];
        $flag= '2';
        $result  = Common::getUser($username,$flag);
        $list = array();
        if(!empty($_REQUEST['flag'])){
            $list['flag']=$_REQUEST['flag'];
        }
        if(!empty($_REQUEST['cp'])){
            $list['cp']=$_REQUEST['cp'];
        }
        if(!empty($_REQUEST['user'])){
            $list['user']=$_REQUEST['user'];
        }
        if(!empty($_REQUEST['name'])){
            $list['name']=$_REQUEST['name'];
        }
        if(isset($_REQUEST['type'])){
            if($_REQUEST['type']=='0'){
                $list['type']='0';
            }else if(!empty($_REQUEST['type'])){

                $list['type']=$_REQUEST['type'];
            }
        }
        $tmp =VerStationManager::getDataList($list);
        echo json_encode($tmp);
    }


    public function actionWorkAdd(){
        try{
            if(empty($_REQUEST['id'])){
                $work = new VerWork();
            }else{
                $work = VerWork::model()->findByPk($_REQUEST['id']);
            }
            if($_POST){
                //var_dump($_POST);die;
                $work->name=$_POST['workname'];
                $work->cp=$_POST['cp'];
                $work->type=$_POST['model'];
		$work->stationId=!empty($_POST['station'])?$_POST['station']:'0';
                $work->status = '0';
                $work->order = '0';
                $work->addTime = time();
                $work->flag = $_POST['flag'];
                if(!$work->save()){
                    var_dump($work->getErrors());
                    LogWriter::logModelSaveError($work,__METHOD__,$work->attributes);
                    throw new ExceptionEx('信息保存失败');
                }
                $workid = $work->attributes['id'];
                if(!empty($_POST['editadd'])){
                    foreach($_POST['editadd'] as $k=>$v){
                        $worker = new VerWorker();
                        $worker->uid = $v;
                        $worker->order = '0';
                        $worker->status = '0';
                        $worker->addTime = time();
                        $worker->type = '1';
                        $worker->workid = $workid;
                        $worker->save();
                    }
                }
                if(!empty($_POST['fb'])){
                    foreach($_POST['fb'] as $k=>$v){
                        $worker = new VerWorker();
                        $worker->uid = $v;
                        $worker->order = '0';
                        $worker->status = '0';
                        $worker->addTime = time();
                        $worker->type = '2';
                        $worker->workid = $workid;
                        $worker->save();
                    }
                }
                if(!empty($_POST['see'])){
                    foreach($_POST['see'] as $k=>$v){
                        $worker = new VerWorker();
                        $worker->uid = $v;
                        $worker->order = '0';
                        $worker->status = '0';
                        $worker->addTime = time();
                        $worker->type = '3';
                        $worker->workid = $workid;
                        $worker->save();
                    }
                }
		if(!empty($_POST['model'])){		
                for($i=1;$i<=$_POST['model'];$i++){
                    $str = 'first-'.$i;
		    if(!empty($_POST[$str])){	
                    foreach($_POST[$str] as $key=>$val){
                        $worker = new VerReviewWork();
                        $worker->uid = $val;
                        $worker->order = '0';
                        $worker->status = '0';
                        $worker->addTime = time();
                        $worker->type = $i;
                        $worker->workid = $workid;
                        $worker->save();
                    }
		  }
                }
		}
                $this->PopMsg('保存成功');
		$adminLeftOneName = !empty($_POST['adminLeftOneName'])?$_POST['adminLeftOneName']:'';
                $adminLeftTwoName = !empty($_POST['epg'])?$_GET['epg']:$_POST['adminLeftTwoName'];
                $adminLeftOne = !empty($_POST['adminLeftOne'])?$_POST['adminLeftOne']:'';
                $adminLeftTwo = !empty($_POST['adminLeftTwo'])?$_POST['adminLeftTwo']:'';
                $this->redirect($this->get_url('station','indexlist',array('flag'=>$_POST['flag'],'adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName)));
            }
        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
        }
        $this->render('workadd');
    }

    public function actionWorkDel(){
        Yii::app()->db->createCommand()->delete('{{ver_worker}}', "workid='{$_REQUEST['id']}'");
        Yii::app()->db->createCommand()->delete('{{ver_review_work}}', "workid='{$_REQUEST['id']}'");
        $res = VerWork::model()->deleteByPk($_REQUEST['id']);
    }

    public function actionAjaxList(){
        $p = $_REQUEST['page'];
        $fu = $_REQUEST['fu'];
        $list = StationManager::getAll($p);
        $n = $this->renderPartial(
            'ajaxlist',
            array(
                'list'=>$list,
                'fu'=>$fu,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
        /*if($list){
            echo json_encode(array('code'=>200,'list'=>$list));
        }else{
            echo json_encode(array('code'=>200,'msg'=>'获取用户失败'));
        }*/
    }
    public function actionGetList(){
        $list = $_REQUEST;
        $tmp = StationManager::getList($list);
        echo json_encode($tmp);
    }
    public function actionWorkUpdate(){
        if(!empty($_POST)){
	    $adminLeftOneName = !empty($_POST['adminLeftOneName'])?$_POST['adminLeftOneName']:'';
            $adminLeftTwoName = !empty($_POST['epg'])?$_GET['epg']:$_POST['adminLeftTwoName'];
            $adminLeftOne = !empty($_POST['adminLeftOne'])?$_POST['adminLeftOne']:'';
            $adminLeftTwo = !empty($_POST['adminLeftTwo'])?$_POST['adminLeftTwo']:'';	
            $id= $_POST['wid'];
            $work = VerWork::model()->findByPk($_REQUEST['id']);
            $work->name=$_POST['workname'];
            $work->cp=$_POST['cp'];
            $work->type=$_POST['model'];
	    $work->stationId=!empty($_POST['station'])?$_POST['station']:'0';
            $work->status = '0';
            $work->order = '0';
            $work->addTime = time();
            $work->flag = $_POST['flag'];
            if(!$work->save()){
                var_dump($work->getErrors());
                LogWriter::logModelSaveError($work,__METHOD__,$work->attributes);
                throw new ExceptionEx('信息保存失败');
            }
            Yii::app()->db->createCommand()->delete('{{ver_worker}}', "workid='{$id}'");
            Yii::app()->db->createCommand()->delete('{{ver_review_work}}', "workid='{$id}'");
            if(!empty($_POST['editadd'])){
                foreach($_POST['editadd'] as $k=>$v){
                    $worker = new VerWorker();
                    $worker->uid = $v;
                    $worker->order = '0';
                    $worker->status = '0';
                    $worker->addTime = time();
                    $worker->type = '1';
                    $worker->workid = $id;
                    $worker->save();
                }
            }
            if(!empty($_POST['fb'])){
                foreach($_POST['fb'] as $k=>$v){
                    $worker = new VerWorker();
                    $worker->uid = $v;
                    $worker->order = '0';
                    $worker->status = '0';
                    $worker->addTime = time();
                    $worker->type = '2';
                    $worker->workid = $id;
                    $worker->save();
                }
            }
            if(!empty($_POST['see'])){
                foreach($_POST['see'] as $k=>$v){
                    $worker = new VerWorker();
                    $worker->uid = $v;
                    $worker->order = '0';
                    $worker->status = '0';
                    $worker->addTime = time();
                    $worker->type = '3';
                    $worker->workid = $id;
                    $worker->save();
                }
            }
            for($i=1;$i<=$_POST['model'];$i++){
                $str = 'first-'.$i;
            if(!empty($_POST[$str])){
                foreach($_POST[$str] as $key=>$val){
                    $worker = new VerReviewWork();
                    $worker->uid = $val;
                    $worker->order = '0';
                    $worker->status = '0';
                    $worker->addTime = time();
                    $worker->type = $i;
                    $worker->workid = $id;
                    $worker->save();
                }
            }
            }
            $this->PopMsg('保存成功');
            $this->redirect($this->get_url('station','indexlist',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName)));
        }
        $id = $_REQUEST['id'];
        $work = VerWork::model()->findByPk($id);
        $sql_work = "select * from yd_ver_worker w inner join yd_ver_admin a on w.workid=$id and a.id=w.uid";
        $workerlist = SQLManager::queryAll($sql_work);
        $worker = array();
        foreach($workerlist as $k=>$v){
            $type = $v['type'];
            $worker[$type][$k]=$v;
        }
        $sql_review = "select * from yd_ver_review_work w inner join yd_ver_admin a on w.workid=$id and a.id=w.uid order by w.type";
        $reviewlist = SQLManager::queryAll($sql_review);
        $review = array();
        foreach($reviewlist as $k=>$v){
            $type = $v['type'];
            $review[$type][$k]=$v;
        }
        $this->render('workupdate',array('work'=>$work,'worker'=>$worker,'review'=>$review));
    }

    public function topIndex($gid)
    {
        //$gid = $_REQUEST['nid'];
        //$gid=0;
        $sql = "select position from yd_ver_ui where gid=$gid and delFlag='0' GROUP BY position";
        $res = SQLManager::queryAll($sql);
        $tmp = array();
        foreach ($res as $k=>$v){
            if($v['position'] != 'appTop'){
                $sql2 = "select pic,title,id,position,scort from yd_ver_ui where gid=$gid and `delFlag`=0 and position != 'appTop' AND position=".$v['position']." order by `scort` asc";
                $arr = SQLManager::queryAll($sql2);
                $tmp[] = $arr;
            }
        }
        $sql3 = "select pic,title,id ,position,scort from yd_ver_ui where gid=$gid and `delFlag`=0 and position='appTop' ORDER BY `scort` asc";
        $list = SQLManager::queryAll($sql3);
        if(!empty($list)){
            //$this->render('index',array('list'=>$tmp,'res'=>$list));
            $res['list'] = $tmp;
            $res['res'] = $list;
            return $res;
        }else{
            //$this->render('index',array('list'=>$tmp));
            $res['list'] = $tmp;
            return $res;
        }

    }

    public function stationlog($model){
        $id = $model->attributes['id'];
        $name = $model->attributes['name'];
        $city = $model->attributes['city'];
        $citylist = explode(' ',$city);
        $province = $model->attributes['province'];
        $provincelist = explode(' ',$province);
        $usergroup='';
        $cp = $model->attributes['cp'];
        $cp = trim($cp,'/');
        if(!empty($model->attributes['usergroup'])){
            $usergroup=$model->attributes['usergroup'];
        }
        $epgcode='';
        if(!empty($model->attributes['epgcode'])){
            $epgcode=$model->attributes['epgcode'];
        }

        foreach($citylist as $key=>$val){
            $province='';
            $province = $provincelist[$key];
            $provinceName='';
            if(!empty($province)){
                $tmp = Province::model()->find("provinceCode = '$province'");
                $provinceName=$tmp->attributes['provinceName'];
            }

            $city='';
            $city = $val;
            $cityName='';
            if(!empty($city) || $city=='0'){
                $tmp = City::model()->find("cityCode = '$city'");
                $cityName=$tmp->attributes['cityName'];
            }
            $str = $id.'|'.$name.'|'.$province.'|'.$provinceName.'|'.$city.'|'.$cityName.'|'.$usergroup.'|'.''.'|'.$epgcode.'|'.''.'|'.$cp;
            $this->setlog($str,1);
        }

    }

    public function setlog($str,$type){
        $fileName=date("Ymd", time()); //文件名字
        //$fileName='./data/sp/'.$fileName.'_OTT-21104.txt';
        if($type=='1'){
            $fileName=Yii::app()->basePath.'/../data/station/80000000-10004-'.$fileName.'.log';
        }else{
            $fileName=Yii::app()->basePath.'/../data/layout/i_'.$fileName.'_OTT-21104.txt';
        }


        //判断文件是否存在 如果不存在就创建
        if(!file_exists($fileName)) {
            $file = fopen("$fileName",'a+');
            fwrite($file,"$str"."\r\n");
            fclose($file);
        }else{
            $file = fopen("$fileName",'a+');
            fwrite($file,"$str"."\r\n");
            fclose($file);
        }
    }


}
