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
	$Pro = Province::model()->findAll("provinceCode not in(40,41,42,43,44,45) order by provinceCode asc");
        if(!empty($_REQUEST['name'])){
            $sql_where .=" and name like '%{$_REQUEST['name']}%'";
        }
        if(!empty($_REQUEST['cp'])){
            $sql_where .=" and cp like '%{$_REQUEST['cp']}%'";
        }
	if(!empty($_REQUEST['province'])){
            $sql_where .= " and province like '%{$_REQUEST['province']}%'";
        }
        $sql_select = "select * from yd_ver_station";
        $sql_order = " order by id asc ";
        $sql_limit = " limit $page,30";
        $sql = $sql_select . $sql_where . $sql_order . $sql_limit;
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
        $this->render('index',array('list'=>$list,"Pro"=>$Pro));
    }

    public function actionGetReviewStatus($nid){
            $sql = "SELECT id FROM yd_ver_topic_review where gid = $nid and flag in (1,2,3,4,5)";
            $res = SQLManager::queryAll($sql);
            $sql1 = "SELECT id FROM yd_ver_topic_review where gid = $nid and flag in (6)";
            $res1 = SQLManager::queryAll($sql1);

            if(!empty($res)){
                    echo '500';
                    return '500';
            }else if(!empty($res1)){
                    echo '300';
                    return '300';
            }else{
                    echo '200';
                    return '200';
            }

    }

    public function actionGetStationId($nid){
            $sql = "SELECT * from yd_ver_sitelist where id = $nid";
            $res = SQLManager::queryAll($sql);
            if(!empty($res)){
                    while($res['0']['pid'] <> 0){
                    $nid = $res[0]['pid'];
                    $sql = "SELECT * from yd_ver_sitelist where id = $nid";
                    $res = SQLManager::queryAll($sql);

                    }
            }
            if(!empty($res[0]['name'])){
                    return $res[0]['name'];
            }else{
                    return "";
            }
    }

    public function actionDoSubmit(){

        $nid = $_GET['nid'];

        $reviewstatus = $this->actionGetReviewStatus($nid);
        if($reviewstatus == '300'){
            $sql = "SELECT * from yd_ver_topic_review where gid = $nid and flag = 6";
            $res =SQLManager::queryAll($sql);
            foreach($res as $key=>$value){

                if($value['type'] == 'bkimg'){

                    $content1 = VerBkimgCopy::model()->findByPk($value['topic_id']);
                    $content1->flag = 0;
                    $content1->save();

                    $res1 = VerBkimg::model()->findByPk($value['topic_id']);
                    if(!empty($res1)){

                        $res1->url = $content1->attributes['url'];
                        $res1->type = $content1->attributes['type'];
                        $res1->save();
                    }else{
                        $res1 = new VerBkimg();
                        $res1->id = $content1->attributes['id'];
                        $res1->url = $content1->attributes['url'];
                        $res1->type = $content1->attributes['type'];
                        $res1->status = $content1->attributes['status'];
                        $res1->delFlag = $content1->attributes['delFlag'];
                        $res1->gid = $content1->attributes['gid'];
                        $res1->template_id = $content1->attributes['template_id'];
                        $res1->save();
                    }

                    $review_type = 4;
                    $review_times = 1;
                    $review_flag = 4;   //驳回
                    $review_message = '发布';
                    $bind_id = $res1->attributes['id'];
                    $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);

                }else if($value['type'] == 'verui'){

                    if($value['uptype'] == '3'){
                        VerUiCopy::model()->deleteByPk($value['topic_id']);
                        VerUi::model()->deleteByPk($value['topic_id']);
                    }else{
                        $content2 = VerUiCopy::model()->findByPk($value['topic_id']);
                        $res2 = VerUi::model()->findByPk($value['topic_id']);
                        if(!empty($res2)){
                            $res2->title = $content2->attributes['title'];
                            $res2->tType = $content2->attributes['tType'];
                            $res2->param = $content2->attributes['param'];
                            $res2->action = $content2->attributes['action'];
                            $res2->pic = $content2->attributes['pic'];
                            $res2->cp = $content2->attributes['cp'];
                            $res2->addTime = $content2->attributes['addTime'];
                            $res2->upTime = $content2->attributes['upTime'];
                            $res2->position = $content2->attributes['position'];
                            $res2->delFlag = $content2->attributes['delFlag'];
                            $res2->vid = $content2->attributes['vid'];
                            $res2->gid = $content2->attributes['gid'];
                            $res2->type = $content2->attributes['type'];
                            $res2->uType = $content2->attributes['uType'];
                            $res2->scort = $content2->attributes['scort'];
                            $res2->save();
                        }else{
                            $res2 = new VerUi();
                            $res2->id = $content2->attributes['id'];
                            $res2->title = $content2->attributes['title'];
                            $res2->tType = $content2->attributes['tType'];
                            $res2->param = $content2->attributes['param'];
                            $res2->action = $content2->attributes['action'];
                            $res2->pic = $content2->attributes['pic'];
                            $res2->cp = $content2->attributes['cp'];
                            $res2->addTime = $content2->attributes['addTime'];
                            $res2->upTime = $content2->attributes['upTime'];
                            $res2->position = $content2->attributes['position'];
                            $res2->delFlag = $content2->attributes['delFlag'];
                            $res2->vid = $content2->attributes['vid'];
                            $res2->gid = $content2->attributes['gid'];
                            $res2->type = $content2->attributes['type'];
                            $res2->uType = $content2->attributes['uType'];
                            $res2->scort = $content2->attributes['scort'];
                            $res2->save();
                        }
                        $content2->flag = 0;
                        $content2->save();

                        $review_type = 5;
                        $review_times = 1;
                        $review_flag = 4;   //驳回
                        $review_message = '发布';
                        $bind_id = $res2->attributes['id'];
                        $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);

                    }



                }else if($value['type'] == 'specialtopic'){
                    if($value['uptype'] == '3'){
                        SpecialTopicCopy::model()->deleteByPk($value['topic_id']);
                        SpecialTopic::model()->deleteByPk($value['topic_id']);
                    }else{
                        $content = SpecialTopicCopy::model()->findByPk($value['topic_id']);
                        $res = SpecialTopic::model()->findByPk($value['topic_id']);

                        if(!empty($res)){
                            $res->title = $content->attributes['title'];
                            $res->type = $content->attributes['type'];
                            $res->tType = $content->attributes['tType'];
                            $res->uType = $content->attributes['uType'];
                            $res->action = $content->attributes['action'];
                            $res->param = $content->attributes['param'];
                            $res->cid = $content->attributes['cid'];
                            $res->x = $content->attributes['x'];
                            $res->y = $content->attributes['y'];
                            $res->width = $content->attributes['width'];
                            $res->height = $content->attributes['height'];
                            $res->order = $content->attributes['order'];
                            $res->videoUrl = $content->attributes['videoUrl'];
                            $res->sid = $content->attributes['sid'];
                            $res->picSrc = $content->attributes['picSrc'];
                            $res->save();
                        }else{
                            $res = new SpecialTopic();
                            $res->id = $content->attributes['id'];
                            $res->title = $content->attributes['title'];
                            $res->type = $content->attributes['type'];
                            $res->tType = $content->attributes['tType'];
                            $res->uType = $content->attributes['uType'];
                            $res->action = $content->attributes['action'];
                            $res->param = $content->attributes['param'];
                            $res->cid = $content->attributes['cid'];
                            $res->x = $content->attributes['x'];
                            $res->y = $content->attributes['y'];
                            $res->width = $content->attributes['width'];
                            $res->height = $content->attributes['height'];
                            $res->order = $content->attributes['order'];
                            $res->videoUrl = $content->attributes['videoUrl'];
                            $res->sid = $content->attributes['sid'];
                            $res->picSrc = $content->attributes['picSrc'];
                            $res->save();
                        }
                        $content->flag = 0;
                        $content->save();

                        $review_type = 6;
                        $review_times = 1;
                        $review_flag = 4;   //驳回
                        $review_message = '发布';
                        $bind_id = $res->attributes['id'];
                        $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);
                    }
                }
            }
            $flag = 7;
            $sql = "UPDATE yd_ver_topic_review set flag =  $flag  where gid = $nid";
            $res = SQLManager::execute($sql);
            $flag = 0;
            $sql = "UPDATE yd_ver_bkimg_copy set flag =  $flag  where gid = $nid";
            $res = SQLManager::execute($sql);

        }
    }

    public function actionDoReview(){
        $nid = $_GET['nid'];

        $reviewstatus = $this->actionGetReviewStatus($nid);
        $stationId = $this->actionGetStationId($nid);
        if($reviewstatus == '200'){
            $sql = "INSERT yd_ver_topic_review(type,topic_id,title,uptype,tType,action,param,pic,uptime,uType,vid,videUrl,flag,stationid,gid) ( SELECT 'bkimg' as type,id as topic_id,'' as title,type as uptype,'' as tType,'' as action,'' as param,url as pic,unix_timestamp() as uptime,'' as uType,'' as vid,'' as videoUrl,1 as flag,'$stationId' as stationid,$nid as gid FROM yd_ver_bkimg_copy WHERE gid = $nid AND flag = 7) UNION ALL ( SELECT 'specialtopic' as type,id as topic_id,title as title,type as uptype,tType as tType,action as action,param as param,picSrc as pic,unix_timestamp() as uptime,uType as uType,cid as vid,videoUrl as videoUrl,1 as flag,'$stationId' as stationid,$nid as gid FROM yd_special_topic_copy WHERE sid = $nid AND flag = 7 ) UNION ALL (SELECT 'verui' as type,id as topic_id,title as title,type as uptype,tType as tType,action as action,param as param,pic as pic,unix_timestamp() as uptime,uType as uType,vid as vid,'' as videoUrl,1 as flag,'$stationId' as stationid,$nid as gid FROM yd_ver_ui_copy WHERE gid = $nid AND flag = 7)";
            $list = SQLManager::execute($sql);
        }
        $this->topicReviewRecord($nid,3);
    }

    public function topicReviewRecord($nid,$review_flag)
    {
        $type_res = VerBkimgCopy::model()->find("gid=$nid AND flag = 7");
        $review_times = 1;
        //$review_flag = 3;   //提审
        $review_message = '提审';
        if(!empty($type_res)){
            $review_type = 4;   //专题背景图
            $bind_id = $type_res->attributes['id'];
            $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);
        }else{
            $type_res = VerBkimg::model()->find("gid=$nid");
        }

        if($type_res->attributes['type'] == '1' || $type_res->attributes['type'] == '2'){
            $review_type = 5;   //yd_ver_ui专题
            $res = VerUiCopy::model()->findAll("gid = $nid AND flag = 7");
            if(!empty($res)){
                foreach ($res as $k=>$v){
                    $bind_id = $v->attributes['id'];
                    $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);
                }
            }
        }else if($type_res->attributes['type'] == '4'){
            $review_type = 6;   //yd_special_topic河南专题
            $res = SpecialTopicCopy::model()->findAll("sid = $nid AND flag = 7");
            if(!empty($res)){
                foreach ($res as $k=>$v){
                    $bind_id = $v->attributes['id'];
                    $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);
                }
            }
        }

    }

    public function actionAdd()
    {
        $province = Province::model()->findAll("provinceCode not in(40,41,42,43,44) order by provinceCode asc");
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
        $model->message = !empty($_REQUEST['message'])?trim($_REQUEST['message']):'1';
        $model->guide = !empty($_REQUEST['topguide'])?trim($_REQUEST['topguide']):'1';
        $model->template = !empty($_REQUEST['tmp'])?trim($_REQUEST['tmp']):'1';
	$model->circular = isset($_POST['circular'])?trim($_POST['circular']):'';
	$pic =  isset($_POST['pic'])?trim($_POST['pic']):'';
        //$model->logo      = 'http://117.144.248.58:8082/file/'.$pic;
        //Common::synchroPic($pic);
        //$model->logo      = 'http://117.131.17.46:8086/file/'.$pic;
        $model->logo      = FTP_PATH.$pic;
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

        $province = Province::model()->findAll("provinceCode not in(40,41,42,43,44) order by provinceCode asc");
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
                'message'=>$message,
                'template'=>$tmp,
                'guide'=>$guide
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));*/
        $id = trim($_REQUEST['id']);
        //$sql = "select a.id,a.cp,a.usergroup,a.epgcode,mark,a.name,b.provinceName,c.cityName from yd_ver_station as a left join yd_province as b on a.province=b.provinceCode left join yd_city as c on a.city=c.cityCode where a.id=$id";
        $sql = "select * from yd_ver_station where id=$id";
        $list = SQLManager::queryAll($sql);
        $province = Province::model()->findAll("provinceCode not in(40,41,42,43,44) order by provinceCode asc");
        $p = isset($p) ? $p : '';
        $cityCode = isset($cityCode) ? $cityCode : '';
        $message=$list[0]['message'];
        $tmp=$list[0]['template'];
        $guide=$list[0]['guide'];
	$circular=$list[0]['circular'];
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
                'num'=>$num,
                'message'=>$message,
                'template'=>$tmp,
                'guide'=>$guide,
		'circular'=>$circular
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionDoUpdate()
    {
        $id = trim($_REQUEST['id']);
        $model = VerStation::model()->findByPk($id);
        if($_REQUEST['pro'] == '0'){
            $model->mark = isset($_REQUEST['mark'])?trim($_REQUEST['mark']):'';
            $model->name = isset($_REQUEST['name'])?trim($_REQUEST['name']):'';
            $model->usergroup = isset($_REQUEST['usergroup'])?trim($_REQUEST['usergroup']):'';
            $model->epgcode = isset($_REQUEST['epgcode'])?trim($_REQUEST['epgcode']):'';
            $model->cp = isset($_REQUEST['cp'])?trim($_REQUEST['cp']):'';
            $model->cps= isset($_REQUEST['cps'])?trim($_REQUEST['cps']):'';
            $model->province = isset($_REQUEST['pro'])?trim($_REQUEST['pro']):'';
            $model->city = isset($_REQUEST['city'])?trim($_REQUEST['city']):'';
            $model->message = !empty($_REQUEST['message'])?trim($_REQUEST['message']):'1';
            $model->guide = !empty($_REQUEST['topguide'])?trim($_REQUEST['topguide']):'1';
            $model->template = !empty($_REQUEST['tmp'])?trim($_REQUEST['tmp']):'1';
	    $model->circular = !empty($_REQUEST['circular'])?trim($_REQUEST['circular']):'1'; 
	    $model->id = $id;
            $pic =  isset($_POST['pic'])?trim($_POST['pic']):'';
            $pic = basename($pic);
            if(!empty($pic)){
                //Common::synchroPic($pic);
                //$model->logo      = 'http://117.144.248.58:8082/file/'.$pic;
                //$model->logo      = 'http://117.131.17.46:8086/file/'.$pic;
                $model->logo      = FTP_PATH.$pic;
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
           $model->message = !empty($_REQUEST['message'])?trim($_REQUEST['message']):'1';
            $model->guide = !empty($_REQUEST['topguide'])?trim($_REQUEST['topguide']):'1';
            $model->template = !empty($_REQUEST['tmp'])?trim($_REQUEST['tmp']):'1';
	    $model->circular = !empty($_REQUEST['circular'])?trim($_REQUEST['circular']):1;
	    $model->id = $id;
            $pic =  isset($_POST['pic'])?trim($_POST['pic']):'';
            $pic = basename($pic);
            if(!empty($pic)){
                //Common::synchroPic($pic);
                //$model->logo      = 'http://117.144.248.58:8082/file/'.$pic;
                //$model->logo      = 'http://117.131.17.46:8086/file/'.$pic;
                $model->logo      = FTP_PATH.$pic;
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
//        $pid = 0;
        $list = VerStation::model()->findByPk($id);
        if(!empty($list)){
            $name = $list->attributes['name'];
            $tmp = VerSitelist::model()->find(
                array(
                    'select'=>'id,name,pid',
                    'condition'=>'name=:name and type=0',
                    'params'=>array(':name'=>$name),
                ));
            $sid = $tmp->attributes['id'];
//            $pid = $sid;
            $this->delSiteListData($sid);
            //Yii::app()->db->createCommand()->delete('{{ver_sitelist}}', "pid=$sid");

        }
        $res = VerStation::model()->deleteByPk($id);
        if($res){
            echo json_encode(array('code'=>200));
        }else{
            echo json_encode(array('code'=>404));
        }
    }


    public function delSiteListData($id)
    {
        $result = VerSitelist::model()->deleteAllByAttributes(array('pid'=>$id));
        $result = VerSitelist::model()->deleteByPk($id);

    }


    public function actionTopic()
    {
        try{
            $username=$_SESSION['nickname'];
            $flag= '6';
            if(!empty($_REQUEST['type'])){
                $result = Common::getWork($_REQUEST['type'],$_REQUEST['nid']);
            }else{
                $result = Common::getUser($username,$flag);
            }
            if(!empty($_REQUEST['nid'])){
                $gid = $_REQUEST['nid'];
            }else{
                $gid=$_REQUEST['gid'];
            }
            $bkimg = VerBkimgCopy::model()->find("gid = $gid");
            $html = '';
            if(empty($bkimg)){
                $bkimg = new VerBkimgCopy();
            }else{
                $type = $bkimg->attributes['type'];
                $list =VerUiCopyManager::getAll($gid);

                switch($type){
                    case '1':$html = HTML::data($list);break;
                    case '2':$html = HTML::top();break;
                    //测试服
                    case '4':
                        $template_id = $bkimg->attributes['template_id'];
                        $html = HTML::getTemplate($template_id);
                        break;
                }
            }

            if(!empty($_POST)){
                if(empty($_POST['type']))throw new ExceptionEx('请选择链接类型');
                $bkimg->type=$_POST['type'];
                $bkimg->status = '1';
                                $bkimg->flag = '7';
                $bkimg->gid = $_REQUEST['gid'];
                $bkimg->template_id = $_REQUEST['template_id'];
                $template_id = $_REQUEST['template_id'];
                if(!empty($_FILES['url']['tmp_name'])){
                    $filename = 'url';
                    $path = $this->up($filename);
                   $bkimg ->url    =  FTP_PATH. $path;
                }
                if(!empty($_POST['url'])){
                    $bkimg ->url = $_POST['url'];
                }
                if(!$bkimg->save()){
                    var_dump($bkimg->getErrors());
                    LogWriter::logModelSaveError($bkimg,__METHOD__,$bkimg->attributes);
                    throw new ExceptionEx('信息保存失败');
                }
                $gid = $_REQUEST['gid'];
                $list =VerUiCopyManager::getAll($gid);
//                var_dump($list);die;
		        switch($bkimg->type){
                    case '1':$html = HTML::data($list);break;
                    //测试
                    case '2':$html = HTML::top();break;
//                    case '4':$html=HTML::henan();break;
                    case '4':
                        $template_id = $_REQUEST['template_id'];
                        $html = HTML::getTemplate($template_id);
                        break;
                }
            }
            $type = $bkimg->attributes['type'];
            //测试代码
            $sql="select * from yd_special_topic_copy where sid={$_GET['nid']} and type <> 3";
            $res=SQLManager::queryAll($sql);
            $res=json_encode($res);
            if($type == '2'){
                $list  = $this->topIndex($gid);
                if(!empty($list)){
                    $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'topList'=>$list,'res'=>$result,'result'=>$res));
                }else{
                    $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result,'result'=>$res));
                }
            }else if($type == '3'){
                $list  = $this->topIndexNews($gid);
                if(!empty($list)){
                    $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'news'=>$list,'res'=>$result,'result'=>$res));
                }else{
                    $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result,'result'=>$res));
                }
            }elseif($type == '4'){
                $this->render("topic",array("bkimg"=>$bkimg,"html"=>$html,"res"=>$result,"type"=>$type,"result"=>$res,'flag'=>'1','template_id'=>$template_id));
            }else{
                $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result,'result'=>$res));
            }
        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
            $this->PopMsg('系统繁忙,请稍后再试');
        }
    }

         public function actionTopic1(){
        try{
            $username=$_SESSION['nickname'];
            $flag= '6';
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

            $bkimg = VerBkimgCopy::model()->find("gid = $gid");
            $html = '';
            if(empty($bkimg)){
                $bkimg = new VerBkimgCopy();
            }else{
                $type = $bkimg->attributes['type'];
                $list =VerUiCopyManager::getAll($gid);
                //var_dump($gid);
                switch($type){
                    case '1':$html = HTML::data($list);break;
                    case '2':$html = HTML::top();break;
                    //测试服
                    case '4':
                        $template_id = $bkimg->attributes['template_id'];
                        $html = HTML::getTemplate($template_id);
                        break;
                }
            }
//      var_dump($_POST);die;
            if(!empty($_POST)){
                if(empty($_POST['type']))throw new ExceptionEx('请选择链接类型');
                $bkimg->type=$_POST['type'];
                $bkimg->status = '1';
                $bkimg->gid = $_REQUEST['gid'];
                if(!empty($_FILES['url']['tmp_name'])){
                    $filename = 'url';
                    $path = $this->up($filename);
                    //$bkimg ->url    = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . $path;
                    //$bkimg ->url    = 'http://117.131.17.46:8087/file/' . $path;
                    //$bkimg ->url    = 'http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $path;
                    $bkimg ->url    =  FTP_PATH. $path;
                    //Common::synchroPic(basename($path));
                    //$guide ->ico_true    = 'http://192.168.1.110/file/' . $path;
                }
                if(!empty($_POST['url'])){
                    $bkimg ->url = $_POST['url'];
                    //Common::synchroPic(basename($_POST['url']));
                }
                if(!$bkimg->save()){
                    var_dump($bkimg->getErrors());
                    LogWriter::logModelSaveError($bkimg,__METHOD__,$bkimg->attributes);
                    throw new ExceptionEx('信息保存失败');
                }
                $gid = $_REQUEST['gid'];
                $list =VerUiCopyManager::getAll($gid);
                switch($bkimg->type){
                    case '1':$html = HTML::data($list);break;
                    //测试
                    case '2':$html = HTML::top();break;
//                    case '2':$html = HTML::top();break;
                    case '4':
                        $template_id = $_REQUEST['template_id'];
                        $html = HTML::getTemplate($template_id);
                        break;
                }
            }
            $type = $bkimg->attributes['type'];
            //测试代码
            $sql="select * from yd_special_topic_copy where sid={$_GET['nid']}";
            $res=SQLManager::queryAll($sql);
            $res=json_encode($res);
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
                $this->render('topic1',array('bkimg'=>$bkimg,'html'=>$html,'topList'=>$list,'res'=>$result,'result'=>$res));
            }else{
                $this->render('topic1',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result,'result'=>$res));
            }
        }else if($type == '3'){
            $list  = $this->topIndexNews($gid);
            //      var_dump($list);die;
            if(!empty($list)){
                $this->render('topic1',array('bkimg'=>$bkimg,'html'=>$html,'news'=>$list,'res'=>$result,'result'=>$res));
            }else{
                $this->render('topic1',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result,'result'=>$res));
            }
        }elseif($type == '4'){
            $this->render("topic1",array("bkimg"=>$bkimg,"html"=>$html,"res"=>$result,"type"=>$type,"result"=>$res,'flag'=>'1','template_id'=>$template_id));
        }else{
            $this->render('topic1',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result,'result'=>$res));
        }
        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
            $this->PopMsg('系统繁忙,请稍后再试');
        }
    }
 public function actionTopic2(){
        try{
            $username=$_SESSION['nickname'];
            $flag= '6';
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
                    //测试服
                    case '4':
                        $template_id = $bkimg->attributes['template_id'];
                        $html = HTML::getTemplate($template_id);
                        break;
                }
            }
//      var_dump($_POST);die;
            if(!empty($_POST)){
                if(empty($_POST['type']))throw new ExceptionEx('请选择链接类型');
                $bkimg->type=$_POST['type'];
                $bkimg->status = '1';
                $bkimg->gid = $_REQUEST['gid'];
                if(!empty($_FILES['url']['tmp_name'])){
                    $filename = 'url';
                    $path = $this->up($filename);
                    //$bkimg ->url    = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . $path;
                    //$bkimg ->url    = 'http://117.131.17.46:8087/file/' . $path;
                    //$bkimg ->url    = 'http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $path;
                    $bkimg ->url    =  FTP_PATH. $path;
                    //Common::synchroPic(basename($path));
                    //$guide ->ico_true    = 'http://192.168.1.110/file/' . $path;
                }
                if(!empty($_POST['url'])){
                    $bkimg ->url = $_POST['url'];
                    //Common::synchroPic(basename($_POST['url']));
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
                    //测试
                    case '2':$html = HTML::top();break;
                    case '4':
                        $template_id = $_REQUEST['template_id'];
                        $html = HTML::getTemplate($template_id);
                        break;
                }
            }

            $type = $bkimg->attributes['type'];
            //测试代码
            $sql="select * from yd_special_topic where sid={$_GET['nid']}";
            $res=SQLManager::queryAll($sql);
            $res=json_encode($res);
            /*if($type == '2'){
                $list  = $this->topIndextrue($gid);
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

            $list  = $this->topIndextrue($gid);

//              echo '<pre>';
//              var_dump($list);die;
            if(!empty($list)){
                $this->render('topic2',array('bkimg'=>$bkimg,'html'=>$html,'topList'=>$list,'res'=>$result,'result'=>$res));
            }else{
                $this->render('topic2',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result,'result'=>$res));
            }
        }else if($type == '3'){
            $list  = $this->topIndexNewstrue($gid);
            //      var_dump($list);die;
            if(!empty($list)){
                $this->render('topic2',array('bkimg'=>$bkimg,'html'=>$html,'news'=>$list,'res'=>$result,'result'=>$res));
            }else{
                $this->render('topic2',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result,'result'=>$res));
            }
        }elseif($type == '4'){

            $this->render("topic2",array("bkimg"=>$bkimg,"html"=>$html,"res"=>$result,"type"=>$type,"result"=>$res,'flag'=>'1','template_id'=>$template_id));
        }else{
            $this->render('topic2',array('bkimg'=>$bkimg,'html'=>$html,'res'=>$result,'result'=>$res));
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
	$id=$guide->id;//返回插入id
        echo json_encode(array("id"=>$id));
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
        //var_dump($tmp);die;
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
	//print_r($list);die;
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
                    }}
                }}
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
        $sql = "select position from yd_ver_ui_copy where gid=$gid and delFlag='0' GROUP BY position";
        $res = SQLManager::queryAll($sql);
        $tmp = array();

        foreach ($res as $k=>$v){

            if($v['position'] != 'appTop'){

                $sql2 = "select pic,title,id,position,scort from yd_ver_ui_copy where gid=$gid and `delFlag`=0 and position != 'appTop' AND position='".$v['position']."' order by `scort` asc";

                $arr = SQLManager::queryAll($sql2);
                $tmp[] = $arr;
            }
        }

        $sql3 = "select pic,title,id ,position,scort from yd_ver_ui_copy where gid=$gid and `delFlag`=0 and position='appTop' ORDER BY `scort` asc";
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
    public function topIndextrue($gid)
    {

        //$gid = $_REQUEST['nid'];
        //$gid=0;
        $sql = "select position from yd_ver_ui where gid=$gid and delFlag='0' GROUP BY position";
        $res = SQLManager::queryAll($sql);
        $tmp = array();

        foreach ($res as $k=>$v){

            if($v['position'] != 'appTop'){

                $sql2 = "select pic,title,id,position,scort from yd_ver_ui where gid=$gid and `delFlag`=0 and position != 'appTop' AND position='".$v['position']."' order by `scort` asc";

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

    public function actionNew(){//河南专题控制器
        $this->render("new");
    }
    public function actionFirstPageDel(){
        $id=$_REQUEST['id'];
        $model=SpecialTopic::model()->deleteByPk($id);
        if($model>0){
            echo json_encode(array("code"=>200));
        }else{
            echo json_encode(array("code"=>500,"msg"=>"fail"));
        }
    }
//保存
    public function actionFirstPageAdd(){
        //var_dump($_POST);
        $model=new SpecialTopicCopy();
        $model->sid=$_GET['nid'];//站点id
        $model->action=$_POST['action'];
        $model->param=$_POST['param'];
        $model->cid=$_POST['cid'];
        $model->width=$_POST['width'];
        $model->height=$_POST['height'];
        $model->videoUrl=$_POST['videoUrl'];
        $model->picSrc=$_POST['key'];
        $model->x=$_POST['x'];
        $model->y=$_POST['y'];
        $model->order=$_POST['order'];
        $model->type=$_POST['type'];
        $model->tType=$_POST['tType'];
        $model->uType=$_POST['uType'];
        $model->title=$_POST['title'];
                $model->flag=7;
        if($model->save()){
            echo json_encode(array("code"=>200));
        }else{
            echo json_encode(array("code"=>500));
        }
    }
    //详情
    public function actionUpdateContentshow(){
	$id=$_REQUEST['id'];
        $model=SpecialTopic::model()->findByPk($id);
	$this->render("updatecontentshow",array("screenContent"=>$model));

	}
    public function actionUpdateContent(){
           $id=$_REQUEST['id'];
        $model=SpecialTopicCopy::model()->findByPk($id);
        if(!empty($_POST)){

            $model->sid=$_POST['nid'];//站点id
            $model->action=$_POST['action'];
            $model->param=$_POST['param'];
            $model->cid=$_POST['cid'];
            $model->width=$_POST['width'];
            $model->height=$_POST['height'];
            $model->videoUrl=$_POST['videoUrl'];
            $model->picSrc=$_POST['key'];
            $model->x=$_POST['x'];
            $model->y=$_POST['y'];
            $model->order=$_POST['order'];
            $model->type=$_POST['type'];
            $model->tType=$_POST['tType'];
            $model->uType=$_POST['uType'];
            $model->title=$_POST['title'];
                        $model->flag = 7;

            if($model->save()){
                echo json_encode(array("code"=>200));
                //echo 200;
                die;
            }else{
                echo json_encode(array("code"=>500,"msg"=>"保存失败"));
            }
        }
        $this->render("updatecontent",array("screenContent"=>$model));
    }
    //banner
    public function actionBanner(){
        $this->render("new");
    }
	public function actionAddress(){
	$criteria = new CDbCriteria();
        $criteria->select = '*';
        if(!empty($_REQUEST['title'])){
            $criteria->addSearchCondition("name",$_REQUEST['title']);
        }
        if(!empty($_REQUEST['stationId'])){
            $criteria->addCondition("stationId=".$_REQUEST['stationId']);
        }
        if(!empty($_REQUEST['province'])){
            $criteria->addSearchCondition("province",$_REQUEST['province']);
        }
	if(!empty($_REQUEST['city'])){
            $criteria->addSearchCondition("city",$_REQUEST['city']);
        }
	$data=VerAddress::model()->findAll($criteria);
        $this->render("address",array("data"=>$data));
    }

    public function actionAddressAdd(){
	$this->render("addressadd");
    }

	public function actionAddressDel(){
        $id=$_REQUEST['id'];
        $model=VerAddress::model()->deleteByPk($id);
        if($model>0){
            echo json_encode(array("code"=>200));
        }else{
            echo json_encode(array("code"=>500));
        }
    }

	public function actionAddressUpdate(){
	$id=$_REQUEST['id'];
	$info=VerAddress::model()->findByPk($id);
        $this->render("addressupdate",array("info"=>$info));
    }

    public function actionDoAddressUpdate(){
        $model=VerAddress::model()->findByPk($_REQUEST['id']);
        $code=$_REQUEST['code'];
        $img=$_REQUEST['img'];
        $web=$_REQUEST['web'];

        for($i=0;$i<count($code);$i++){
            $tmp=explode("-",$code[$i]);
            $province[$i]=$tmp[0];
            $city[$i]=$tmp[1];
        }
        $p=join("/",$province);
        $c=join("/",$city);
        $model->province=$p;
        $model->city=$c;
        $model->web_ip=$web;
        $model->img_ip=$img;
        $res=$model->update(array("id","province","city","web_ip","img_ip"));
        if($res>0){
            echo json_encode(array("code"=>200));
        }else{
            echo json_encode(array("code"=>500));
        }
    }
    public function actionDoAddressAdd(){
	$model=new VerAddress();
	$model->name=$_POST['name'];
        for($i=0;$i<count($_POST['code']);$i++){
            $tmp=explode("-",$_POST['code'][$i]);
            $province[]=$tmp[0];
            $city[]=$tmp[1];
        }
        $p=join("/",$province);
        $c=join("/",$city);
        $model->province=$p;
        $model->city=$c;
        $model->stationId=$_POST['stationId'];
        $model->web_ip=$_POST['web'];
        $model->img_ip=$_POST['img'];
        if($model->save()){
            echo json_encode(array('code'=>200));
        }else{
            echo json_encode(array('code'=>500));
        }
    }

	public function actionGetInfo(){
        $stationId=$_REQUEST['stationId'];
        $data=VerStation::model()->findByPk($stationId);
        $province=$data->province;
        $city=$data->city;
        $p=explode(" ",$province);
        $c=explode(" ",$city);
        for($i=0;$i<count($p);$i++){
            $ptmp=Province::model()->findByAttributes(array("provinceCode"=>$p[$i]));
            $pArray[$i]=array("provinceName"=>$ptmp->provinceName,"provinceCode"=>$ptmp->provinceCode);
            $ctmp=City::model()->findByAttributes(array("provinceId"=>$p[$i],"cityCode"=>$c[$i]));
            $cArray[$i]=array("cityName"=>$ctmp->cityName,"cityCode"=>$ctmp->cityCode);
        }
        for($m=0;$m<count($pArray);$m++){
            $newArr[]=array("name"=>$pArray[$m]['provinceName']."-".$cArray[$m]['cityName'],"Code"=>$pArray[$m]['provinceCode']."-".$cArray[$m]['cityCode']);
        }
        echo json_encode($newArr);
    }

    public function actionCheckTopicAuth()
    {
        $sitelist_id = !empty($_GET['sitelist_id'])?$_GET['sitelist_id']:"0";
        $a = VerSitelist::model()->find(
            array(
                'select'=>'id,pid,name,type',
                'condition'=>'id=:id',
                'params'=>array(':id'=>$sitelist_id),
            )
        );
        $station_name = $a->attributes['name'];
        if($a->attributes['pid'] != 0 ){
            $b = VerSitelist::model()->find(
                array(
                    'select'=>'id,pid,name,type',
                    'condition'=>'id=:id',
                    'params'=>array(':id'=>$a->attributes['pid']),
                )
            );
            $station_name = $b->attributes['name'];
            if($b->attributes['pid'] != 0 ){
                $c = VerSitelist::model()->find(
                    array(
                        'select'=>'id,pid,name,type',
                        'condition'=>'id=:id',
                        'params'=>array(':id'=>$b->attributes['pid']),
                    )
                );
                $station_name = $c->attributes['name'];
                if($c->attributes['pid'] != 0 ){
                    $d = VerSitelist::model()->find(
                        array(
                            'select'=>'id,pid,name,type',
                            'condition'=>'id=:id',
                            'params'=>array(':id'=>$c->attributes['pid']),
                        )
                    );
                    $station_name = $d->attributes['name'];
                }
            }
        }

        $stationid = VerStation::model()->find("name='$station_name'");
        $stationid = $stationid->attributes['id'];
        $sql = "SELECT t1.type,	t1.workid,t1.uid FROM yd_ver_worker t1 JOIN yd_ver_work t2 ON t1.workid = t2.id and t2.stationId = '$stationid' and t2.flag = 6 WHERE t1.uid = '{$_SESSION['userid']}'";
        $res['status'][] = 1;
        $res['status'][] = 2;
        $ss = SQLManager::queryAll($sql);
        $estatus = 1;
        $submit = 1;
        $show = 1;
        foreach ($ss as $key => $value) {
            if($value['type'] == 1  ){
                $estatus =0;
            }else if($value['type']  == 2 ){
                $submit =0;
            }else if($value['type']  == 3 ){
                //    $show =0;
            }
        }

        if($_SESSION['auth']=='1'){
            $estatus = 0;
            $submit = 0;
        }

        $auth = array();
        $auth['estatus'] = $estatus;
        $auth['submit'] = $submit;
        $auth['show'] = $show;
        echo json_encode($auth);
    }

    public function actionGetOneGuideId()
    {
        $template_id = $_REQUEST['template_id'];
        $tmp_res = VerScreenGuide::model()->find("templateId=$template_id order by id desc limit 1");
        echo $tmp_res->attributes['id'];
    }
}


