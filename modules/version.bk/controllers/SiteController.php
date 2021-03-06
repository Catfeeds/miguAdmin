<?php
class SiteController extends VController
{
    public function actionIndex(){
        $username=$_SESSION['nickname'];
	$flag=2;
        if(!empty($_REQUEST['type'])){
	    $res = Common::getWork($_REQUEST['type'],$_REQUEST['nid']);
        }else{
	   $res = Common::getUser($username,$flag);
        }
        $page = 20;
        $data = $this->getPageInfo($page);
        $list = array();
        $list = $_REQUEST;
        $list['gid']=$_REQUEST['nid'];
        $gid=$_REQUEST['nid'];
        $type='0';
        $type = VerSitelist::model()->find("id = '$gid'");
        if(!empty($type)){
            $type=$type->attributes['xyType'];
        }
        $tmp =VerSiteListManager::getDatas($data,$list,$gid);
        $url = $this->createUrl($this->action->id);
        $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage'],$tmp['cou']);
	$cou = !empty($tmp['cou'])?$tmp['cou']:'0';
	$online = !empty($tmp['online'])?$tmp['online']:'0';
        $this->render('index',array('list'=>$tmp['list'],'gid'=>$gid,'page'=>$pagination,'type'=>$type,'cou'=>$cou,'onlie'=>$online,'res'=>$res));
    }

    public function actionTest(){
        $page = 20;
        $data = $this->getPageInfo($page);
        $list = array();
        $list = $_REQUEST;
        $list['gid']=$_REQUEST['nid'];
        $gid=$_REQUEST['nid'];
        $type='0';
        $type = VerSitelist::model()->find("id = '$gid'");
        if(!empty($type)){
            $type=$type->attributes['xyType'];
        }
        $tmp =VerSiteListManager::getDatas($data,$list,$gid);
        $url = $this->createUrl($this->action->id);
        $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage']);
        $cou = !empty($tmp['cou'])?$tmp['cou']:'0';
        $online = !empty($tmp['online'])?$tmp['online']:'0';
        $this->render('test',array('list'=>$tmp['list'],'gid'=>$gid,'page'=>$pagination,'type'=>$type,'cou'=>$cou,'onlie'=>$online));
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

    public function actionSiteAdd(){
          $gid = $_REQUEST['gid'];
        $n = $this->renderPartial(
            'siteadd',
            array(
               'gid'=>$gid
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionAjaxAdd(){
        $arr=explode(' ',trim($_REQUEST['ids']));
        foreach($arr as $k=>$v){
            $list = VerSite::model()->find("gid = '{$_REQUEST['gid']}' and vid = '{$v}'");
            if(empty($list)){
                $site = new VerSite();
                $site->vid = $v;
                $site->gid = $_REQUEST['gid'];
                $site->cTime=time();
                $site->save();
            }
        }
    }

    public function actionClassify(){
        $gid = $_REQUEST['gid'];
	//var_dump($gid);die;
	$sql = "select * from yd_ver_category where gid=$gid";
	$res = SQLManager::QueryAll($sql);
	//echo '<pre>';
	//var_dump($res);
        $cp=array();
	if(!empty($res[0]['cp'])){
		$cp = explode(' ',$res[0]['cp']);
	}
        $type=array();
	if(!empty($res[0]['type'])){
                $type = explode(' ',$res[0]['type']);
        }
        $simple_set=array();
        if(!empty($res[0]['simple_set'])){
            $simple_set = explode(' ',$res[0]['simple_set']);
        }
	if(!empty($res) ){
	   $n = $this->renderPartial(
              'updateClassify',
              array(
                 'gid'=>$gid,
		 'res'=>$res,
                 'cp'=>$cp,
		 'type'=>$type,
         'simple_set'=>$simple_set
              ),
              true
            );
          die(json_encode(array('code'=>200,'msg'=>$n)));
	}else{
        $n = $this->renderPartial(
            'classify',
            array(
                'gid'=>$gid,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
      } 
   }

    public function actionAjax(){
        $page = 10;
        $data = $this->getPageInfo($page);
        $list = array();
        if(!empty($_REQUEST['cp'])){
            $list['cp']=$_REQUEST['cp'];
        }
        if(!empty($_REQUEST['ShowType'])){
            $list['ShowType']=$_REQUEST['ShowType'];
        }
        if(!empty($_REQUEST['title'])){
            $list['title']=$_REQUEST['title'];
        }
        $list['gid']=$_REQUEST['gid'];
        $list['flag']='2';
        $tmp =VideoManager::getFirstAjax($data,$list);
        $res['list'] = $tmp['list'];
        $res['total_num'] = $tmp['count'];
        $res['page_size']=10;
        $res['page_total_num']=ceil($res['total_num']/$res['page_size']);
        //var_dump($res);die;
        echo json_encode($res);
    }

    public function actionTopic(){
        try{
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
           // 	var_dump($type);die;
		switch($type){
                    case '1':$html = HTML::data($list);break;
                    case '2':$html = HTML::top();break;
                    case '3':$html = HTML::news();break;
                }
            }
            if(!empty($_POST)){
                if(empty($_POST['type']))throw new ExceptionEx('请选择链接类型');
                $bkimg->type=$_POST['type'];
                $bkimg->status = '1';
                $bkimg->gid = $_REQUEST['gid'];
                /*if(!empty($_FILES['url']['tmp_name'])){
                    $filename = 'url';
                    $path = $this->up($filename);
                    $bkimg ->url    = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . $path;
                    //$guide ->ico_true    = 'http://192.168.1.110/file/' . $path;
                }*/
		 if(!empty($_POST['url'])){
                    $bkimg ->url = $_POST['url'];
                }
                //var_dump($bkimg);die;
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
	    if($type == '2'){
                $list  = $this->topIndex($gid);
//		echo '<pre>';
//		var_dump($list);die;
	        if(!empty($list)){
		   $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'list'=>$list));
	        }else{		
            	   $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html));
	        } 	
	    }else if($type == '3'){
		$list  = $this->topIndexNews($gid);
	//	var_dump($list);die;
                if(!empty($list)){
                   $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html,'news'=>$list));
                }else{
                   $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html));
                }
	    }else{
		  $this->render('topic',array('bkimg'=>$bkimg,'html'=>$html));
	    }		
        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
            $this->PopMsg('系统繁忙,请稍后再试');
        }
    }

    public function actionUpload(){
        if(empty($_GET['val']) || empty($_GET['gid'])){
            $this->die_json(array('code'=>404,'msg'=>'请选择要设置的位置'));
        }
        $pos = $_REQUEST['val'];
        if(empty($_REQUEST['id'])){
            $mvui = VerUiManager::getAll($_GET['gid']);
        }else{
            $mvui = VerUiManager::getData($_GET['gid'],$pos);
        }
        //$mvui = VerUiManager::getData($_GET['gid'],$pos);
        $html = HTML::data($mvui);
        $fid = isset($_GET['fid'])?$_GET['fid']:'0';
        $t = isset($_GET['val'])?$_GET['val']:'';


            if(empty($mvui[$t][$fid])){
                $cp = '';
                $id = '';
                $tType = '';

            }else{
                $tType = $mvui[$t][$fid]['tType'];
                $cp = $mvui[$t][$fid]['cp'];
                $id = $mvui[$t][$fid]['id'];
            }

        $gid = $_GET['gid'];
        $n = $this->renderPartial(
            'upload',
            array(
                'address'=>$_GET['val'],
                'fid'=>$fid,
                'ui'=>$mvui,
                'html'=>$html,
                'id' =>$id,
                'gid'=>$_GET['gid'],
                'tType'=>$tType,
                'cp' =>$cp,
                'gid'=>$gid,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionAdd(){
        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        if(empty($_POST['tType'])) $this->die_json(array('code'=>404,'msg'=>'上传类型不能为空'));
        if(empty($_POST['title'])) $this->die_json(array('code'=>404,'msg'=>'标题不能为空'));

        if(empty($_POST['key'])) $this->die_json(array('code'=>404,'msg'=>'图片地址不能为空'));
        if(empty($_POST['position'])) $this->die_json(array('code'=>404,'msg'=>'系统错误'));

        $mvui = VerUi::model()->findByAttributes(array('position'=>$_POST['position'],'id'=>$_POST['id']));

        if(!$mvui){
            $mvui = new VerUi();
            $mvui->addTime = time();
        }else{
            $mvui->upTime = time();
        }

        $mvui->title    = trim($_POST['title']);
        $mvui->position = trim($_POST['position']);
        $mvui->type     = trim($_POST['type']);
        $mvui->uType     = trim($_POST['uType']);
        $mvui->tType    = trim($_POST['tType']);
        $mvui->cp       = trim($_POST['cp']);
        $mvui->gid      = trim($_POST['gid']);
        $mvui->action   = trim($_POST['action']);
        $mvui->param    = trim($_POST['param']);
        $mvui->vid    = trim($_POST['vid']);
        $mvui->delFlag = 0; 
        $path = trim(substr($_POST['key'],-36));
        Common::synchroPic($path);
        //$mvui->pic      = 'http://117.144.248.58:8082/file/' . trim(substr($_POST['key'],-36));
        //$mvui->pic      = 'http://117.131.17.46:8086/file/' . trim(substr($_POST['key'],-36));
        $mvui->pic      = 'http://117.131.17.105:8083/file/' . trim(substr($_POST['key'],-36));
        if(!$mvui->save()){
            LogWriter::logModelSaveError($mvui,__METHOD__,$mvui->attributes);
            $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
        }


        $this->die_json(array('code'=>200));
    }
    public function actionDel(){
        $id = $_REQUEST['id'];
        $result = VerUi::model()->deleteByPk($id);
        if($result){
            echo json_encode(array('code'=>200,'msg'=>'删除成功'));
        }else{
            echo json_encode(array('code'=>404,'msg'=>'删除失败'));
        }
    }
    public function actionChange(){
        $id = $_REQUEST['id'];
        $xytype = $_REQUEST['flag'];
        $result = VerSitelist::model()->updateAll(array('xyType'=>$xytype),'id=:id',array(':id'=>$id));
        if($result){
            echo json_encode(array('code'=>200,'msg'=>'切换成功'));
        }else{
            echo json_encode(array('code'=>404,'msg'=>'切换失败'));
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
        $guide->url = '/version/site/index';
        $guide->module = 'version';
        $guide->pid = $_REQUEST['gid'];
        $guide->order = '1';
        if(!$guide->save()){
            var_dump($guide->getErrors());
        }
    }
    public function actionContentAdd(){
        $list = $_REQUEST;
        $gid = $_REQUEST['gid'];
        $tmp = VideoManager::getClassify($list);
        //var_dump($tmp);
        if(!empty($tmp)){
            Yii::app()->db->createCommand()->delete('{{ver_site}}', "gid=$gid");
            foreach($tmp as $k=>$v){
                $site = VerSite::model()->find("vid = {$v['id']} and gid='$gid'");
                if(empty($site)){
                    $sitelist = new VerSite();
                    $sitelist->vid = $v['id'];
                    $sitelist->gid = $gid;
                    $sitelist->status='0';
                    $sitelist->delFlag='0';
                    $sitelist->order='0';
                    $sitelist->cTime=time();
                    $sitelist->save();
                    if(!$sitelist->save()){
                       var_dump($sitelist->getErrors());
                    }
                }
            }
        }

    }
    public function actionOrder(){
       if(!empty($_REQUEST['id'])){
            $id = $_REQUEST['id'];
            $order=$_REQUEST['order'];
            $tmp=array_combine($id,$order);
            foreach($tmp as $k=>$v){
                $result = VerSite::model()->updateAll(array('order'=>$v),'id=:id',array(':id'=>$k));
                if($result){
                    echo $k.'<br>';
                }
            }
        } 
    }
    public function actionDelSite(){
        $id = $_REQUEST['id'];
        $site = VerSitelist::model()->findAll("pid = '$id'");
        if(empty($site)){
            $result = VerSitelist::model()->deleteByPk($id);
            Yii::app()->db->createCommand()->delete('{{ver_site}}', "gid=$id");
            if($result){
                echo json_encode(array('code'=>200,'msg'=>'删除成功'));
            }else{
                echo json_encode(array('code'=>404,'msg'=>'删除失败'));
            }
        }else{
            echo json_encode(array('code'=>404,'msg'=>'请删除子分类的内容'));
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
        $guide->url = '/version/site/topic';
        $guide->module = 'version';
        $guide->pid = $_REQUEST['gid'];
        $guide->order = '1';
        if(!$guide->save()){
            var_dump($guide->getErrors());
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

    public function actionChangeStatus()
    {
	$id = $_GET['id'];
	$status  = $_GET['status'];
	$time = time();
        $vid = $_REQUEST['vid'];
        $type = $_REQUEST['type'];
        $list = VerContent::model()->find("vid = '$vid'");
        if($list->attributes['flag']=='0'){
        if($type=='3'){
            $sql_select = "select l.pid from yd_ver_site s inner join yd_ver_sitelist l on s.gid=l.id and s.id=$id";
	    $pid = SQLManager::queryRow($sql_select);
            $list = VerSite::model()->find("vid=$vid and gid={$pid['pid']}");
            $res = '';
            if($list->attributes['status']=='1'){
		$res = VerSite::model()->updateAll(array('status'=>$status,'upTime'=>$time),'id=:id',array(':id'=>$id));
            }
        }else{
            $sql_select = "select l.id from yd_ver_site s inner join yd_ver_sitelist l on s.id='$id' and s.gid=l.pid";
            $result = SQLManager::queryAll($sql_select);
            foreach($result as $k=>$v){
               $res = VerSite::model()->updateAll(array('status'=>$status,'upTime'=>$time),'vid=:vid and gid=:gid',array(':gid'=>$v['id'],':vid'=>$vid));
            }
            $res = VerSite::model()->updateAll(array('status'=>$status,'upTime'=>$time),'id=:id',array(':id'=>$id));
        }
        }
	//$sql = "update yd_ver_site set `status`=$status,`upTime`='$time' where id=$id";
	//$res = SQLManager::execute($sql);
	if(!empty($res)){
	    echo '200';	
	}else{
	    echo '500';	
	}	
    }
   
     public function actionCategoryAdd()
    {
        $model = new VerCategory();
        $model->actor           = !empty($_POST['actor'])?trim($_POST['actor']):'';
        $model->boxoffice       = !empty($_POST['boxoffice'])?trim($_POST['boxoffice']):'';
        $model->CountryOfOrigin = !empty($_POST['CountryOfOrigin'])?trim($_POST['CountryOfOrigin']):'';
        $model->cp              = !empty($_POST['cps'])?trim($_POST['cps']):'';
        $model->director        = !empty($_POST['director'])?trim($_POST['director']):'';
        $model->end             = !empty($_POST['end'])?trim($_POST['end']):'';
        $model->keyword         = !empty($_POST['keyword'])?trim($_POST['keyword']):'';
        $model->orders          = !empty($_POST['orders'])?trim($_POST['orders']):'';
        $model->language        = !empty($_POST['language'])?trim($_POST['language']):'';
        $model->type            = !empty($_POST['type'])?trim($_POST['type']):'';
        $model->score           = !empty($_POST['score'])?trim($_POST['score']):'';
        $model->prize           = !empty($_POST['prize'])?trim($_POST['prize']):'';
        $model->year            = !empty($_POST['year'])?trim($_POST['year']):'';
        $model->short           = !empty($_POST['short'])?trim($_POST['short']):'';
        $model->gid             = !empty($_POST['gid'])?trim($_POST['gid']):'';
        $model->simple_set     = !empty($_POST['simple_set'])?trim($_POST['simple_set']):'';
        $list = $_REQUEST;
        $gid = $_REQUEST['gid'];
        $sql="select * from  yd_ver_sitelist where id=$gid";
        $res = SQLManager::QueryRow($sql);
        $pid= $res['pid'];
        $tmp=VideoManager::Classify($list,$pid);
        //$tmp = VideoManager::getClassify($list);
        //var_dump($tmp);
            Yii::app()->db->createCommand()->delete('{{ver_site}}', "gid=$gid");
        if(!empty($tmp)){
            foreach($tmp as $k=>$v){
                $site = VerSite::model()->find("vid = {$v['vid']} and gid='$gid'");
                if(empty($site)){
                    $sitelist = new VerSite();
                    $sitelist->vid = $v['vid'];
                    $sitelist->gid = $gid;
                    $sitelist->status='0';
                    $sitelist->delFlag='0';
                    $sitelist->order='99';
                    $sitelist->cTime=time();
                    $sitelist->save();
                    if(!$sitelist->save()){
                       var_dump($sitelist->getErrors());
                    }
                }
            }
        }

        if($model->save()){
            echo '200';
        }else{
            echo '500';
        }

    }

    public function actionCategoryUpdate()
    {
        $id = trim($_POST['id']);
        $model = VerCategory::model()->findByPk($id);
        $model->actor           = !empty($_POST['actor'])?trim($_POST['actor']):'';
        $model->boxoffice       = !empty($_POST['boxoffice'])?trim($_POST['boxoffice']):'';
        $model->CountryOfOrigin = !empty($_POST['CountryOfOrigin'])?trim($_POST['CountryOfOrigin']):'';
        $model->cp              = !empty($_POST['cps'])?trim($_POST['cps']):'';
        $model->director        = !empty($_POST['director'])?trim($_POST['director']):'';
        $model->end             = !empty($_POST['end'])?trim($_POST['end']):'';
        $model->keyword         = !empty($_POST['keyword'])?trim($_POST['keyword']):'';
        $model->orders          = !empty($_POST['orders'])?trim($_POST['orders']):'';
        $model->language        = !empty($_POST['language'])?trim($_POST['language']):'';
        $model->type            = !empty($_POST['type'])?trim($_POST['type']):'';
        $model->score           = !empty($_POST['score'])?trim($_POST['score']):'';
        $model->prize           = !empty($_POST['prize'])?trim($_POST['prize']):'';
        $model->year            = !empty($_POST['year'])?trim($_POST['year']):'';
        $model->gid             = !empty($_POST['gid'])?trim($_POST['gid']):'';
        $model->short           = !empty($_POST['short'])?trim($_POST['short']):'';
        $model->simple_set     = !empty($_POST['simple_set'])?trim($_POST['simple_set']):'';
        $model->id             = !empty($_POST['id'])?trim($_POST['id']):'';
        $list = $_REQUEST;
        $gid = $_REQUEST['gid'];
        $sql="select * from  yd_ver_sitelist where id=$gid";
        $res = SQLManager::QueryRow($sql);
        $pid= $res['pid'];
        $tmp=VideoManager::Classify($list,$pid);
        //$tmp = VideoManager::getClassify($list);
//        var_dump($tmp);die;
            $res = Yii::app()->db->createCommand()->delete('{{ver_site}}', "gid=$gid");
        if(!empty($tmp)){
            foreach($tmp as $k=>$v){
                $site = VerSite::model()->find("vid = {$v['vid']} and gid='$gid'");
                if(empty($site)){
                    $sitelist = new VerSite();
                    $sitelist->vid = $v['vid'];
                    $sitelist->gid = $gid;
                    $sitelist->status='0';
                    $sitelist->delFlag='0';
                    $sitelist->order='99';
                    $sitelist->cTime=time();
                    $sitelist->save();
                    if(!$sitelist->save()){
                       var_dump($sitelist->getErrors());
                    }
                }
            }
        }

        if($model->save()){
            echo '200';
        }else{
            echo '500';
        }
    }
    public function actionStation(){
        $gid = $_REQUEST['gid'];
        if(!empty($_REQUEST['gid'])){
            $cate = VerCategory::model()->find("gid = $gid");
        }else{
            $cate = new VerCategory();
        }
        $type = array();
        if(!empty($cate->attributes['type'])){
            $type = explode(' ',$cate->attributes['type']);
        }
        $cp = array();
        if(!empty($cate->attributes['cp'])){
            $cp = explode(' ',$cate->attributes['cp']);
        }
        $n = $this->renderPartial(
            'station',
            array(
                'gid'=>$gid,
                'cate'=>$cate,
                'type'=>$type,
                'cp'=>$cp
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionStationadd(){
        $gid = $_REQUEST['gid'];
        if(!empty($_REQUEST['id'])){
            $cate = VerCategory::model()->findByPk($_REQUEST['id']);
        }else{
            $cate = new VerCategory();
        }
        $cate->actor           = !empty($_POST['actor'])?trim($_POST['actor']):'';
        $cate->boxoffice       = !empty($_POST['boxoffice'])?trim($_POST['boxoffice']):'';
        $cate->CountryOfOrigin = !empty($_POST['CountryOfOrigin'])?trim($_POST['CountryOfOrigin']):'';
        $cate->cp              = !empty($_POST['cps'])?trim($_POST['cps']):'';
        $cate->director        = !empty($_POST['director'])?trim($_POST['director']):'';
        $cate->end             = !empty($_POST['end'])?trim($_POST['end']):'';
        $cate->keyword         = !empty($_POST['keyword'])?trim($_POST['keyword']):'';
        $cate->orders          = !empty($_POST['orders'])?trim($_POST['orders']):'';
        $cate->language        = !empty($_POST['language'])?trim($_POST['language']):'';
        $cate->type            = !empty($_POST['type'])?trim($_POST['type']):'';
        $cate->score           = !empty($_POST['score'])?trim($_POST['score']):'';
        $cate->prize           = !empty($_POST['prize'])?trim($_POST['prize']):'';
        $cate->year            = !empty($_POST['year'])?trim($_POST['year']):'';
        $cate->gid             = !empty($_POST['gid'])?trim($_POST['gid']):'';
        $cate->short           = !empty($_POST['short'])?trim($_POST['short']):'';
        $cate->simple_set      = !empty($_POST['simple_set'])?trim($_POST['simple_set']):'';
        if(!$cate->save()){
            var_dump($cate->getErrors());
        }
        //$type = $_REQUEST['type'];
        $list = $_REQUEST;
        $tmp = VerSiteListManager::getStation($list);
        $res = Yii::app()->db->createCommand()->delete('{{ver_site}}', "gid=$gid");
        //var_dump($tmp);die;
        if(!empty($tmp)){
            foreach($tmp as $k=>$v){
                $site = VerSite::model()->find("vid = {$v['vid']} and gid='$gid'");
                if(empty($site)){
                    $sitelist = new VerSite();
                    $sitelist->vid = $v['vid'];
                    $sitelist->gid = $gid;
                    $sitelist->status='0';
                    $sitelist->delFlag='0';
                    $sitelist->order='99';
                    $sitelist->cTime=time();
                    $sitelist->save();
                    if(!$sitelist->save()){
                        var_dump($sitelist->getErrors());
                    }
                }
            }
            $list = VerSiteListManager::getSecond($gid);
        }
    }
    public function actionFirstAdd(){
        $n = $this->renderPartial(
            'firstadd',
            array(
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionFirstAjax(){
        $page = 10;
        $data = $this->getPageInfo($page);
        $list = array();
        if(!empty($_REQUEST['cp'])){
            $list['cp']=$_REQUEST['cp'];
        }
        if(!empty($_REQUEST['type'])){
            $list['type']=$_REQUEST['type'];
        }
        if(!empty($_REQUEST['title'])){
            $list['title']=$_REQUEST['title'];
        }
        $tmp =VideoManager::getAjax($data,$list);
        $res['list'] = $tmp['list'];
        $res['total_num'] = $tmp['count'];
        $res['page_size']=10;
        $res['page_total_num']=ceil($res['total_num']/$res['page_size']);
        //var_dump($res);die;
        echo json_encode($res);
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

    public function topIndexNews($gid)
    {
	$sql4 = "select pic,title,id ,position from yd_ver_ui where gid=$gid and `delFlag`=0  ORDER BY `scort` asc";
        $news = SQLManager::queryAll($sql4);
        if(!empty($news)){
         //   $this->render('index',array('news'=>$news));
	   return $news;	
        }else{
         //   $this->render('index');
	   return null;
        }
    }

    public function actionRankingAddView()
    {
        $gid = $_REQUEST['nid'];
        $sql = "select position from yd_ver_ui where gid = $gid AND `delFlag`=0 order by `position` DESC limit 1 ";
        $res = SQLManager::queryAll($sql);
        $sql2 = "select count(*) from yd_ver_ui where gid=$gid AND `delFlag`=0";
        $res2 = SQLManager::queryAll($sql2);
	$bkimg = VerBkimg::model()->find("gid = $gid");
        if(empty($bkimg)){
           $bkimg = new VerBkimg();
        }else{
           $type = $bkimg->attributes['type'];
        }
        if(empty($res)){
            $position = '1';
        }else{
        if(!empty($res2)){
           $a = $res2[0]['count(*)']%5;
        }
        if($a == 0 ){
            $position = intval($res[0]['position'])+1;
        }else{
            $position = $res[0]['position'];
        }
        }
        $order = trim($_REQUEST['order']);
	$position = !empty($_REQUEST['position'])?$_REQUEST['position']:$position;
        if($type == '3'){
	    $position='1';
	}
	if(empty($_REQUEST['imgFlag'])){
            if(!empty($_REQUEST['appFlag'])){
                $n = $this->renderPartial(
                    'ranking',
                    array(
                        'gid'=>$gid,
                        'position'=>'appTop',
                        'appFlag'=>1,
                        'order'=>$order,
                    ),
                    true
                );
            }else {
                $n = $this->renderPartial(
                    'ranking',
                    array(
                        'gid' => $gid,
                        'position' => $position,
                        'order'=>$order,
                    ),
                    true
                );
            }
        }else{
            $n = $this->renderPartial(
                'ranking',
                array(
                    'gid'=>$gid,
                    'position'=>$position,
                    'imgFlag'=>1,
                    'order'=>$order,
                ),
                true
            );
        }
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionRankingEditView()
    {
        $id = $_REQUEST['id'];
        $sql = "select * from yd_ver_ui where id = $id AND delFlag=0 ";
        $res = SQLManager::queryAll($sql);
        if(empty($_REQUEST['imgFlag'])){
            $n = $this->renderPartial(
                'updateRanking',
                array(
                    'res'=>$res[0],
                    'imgFlag'=>1,
                ),
                true
            );
        }else{
            if(!empty($_REQUEST['appFlag'])){
                $n = $this->renderPartial(
                    'updateRanking',
                    array(
                        'res'=>$res[0],
                        'imgFlag'=>'1',
                        'appFlag'=>'1',
                    ),
                    true
                );
            }else{
                $n = $this->renderPartial(
                    'updateRanking',
                    array(
                        'res'=>$res[0],
                        'imgFlag'=>'',
                    ),
                    true
                );
            }
        }

        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionRankingAdd()
    {
        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        if(empty($_POST['tType'])) $this->die_json(array('code'=>404,'msg'=>'上传类型不能为空'));
        if(empty($_POST['title'])) $this->die_json(array('code'=>404,'msg'=>'标题不能为空'));
        if(empty($_POST['key'])) $this->die_json(array('code'=>404,'msg'=>'图片地址不能为空'));
        if(empty($_POST['position'])) $this->die_json(array('code'=>404,'msg'=>'系统错误'));
        $mvui = new VerUi();
        $mvui->addTime  = time();
        $mvui->title    = trim($_POST['title']);
        $mvui->position = trim($_POST['position']);
        $mvui->type     = trim($_POST['type']);
        $mvui->uType    = trim($_POST['uType']);
        $mvui->tType    = trim($_POST['tType']);
        $mvui->cp       = trim($_POST['cp']);
        $mvui->gid      = trim($_POST['gid']);
        $mvui->action   = trim($_POST['action']);
        $mvui->param    = trim($_POST['param']);
        $mvui->vid      = trim($_POST['vid']);
        $mvui->delFlag  = 0;
        $mvui->scort    = trim($_POST['order']);
        if(strlen($_POST['key'])>1){
            $path = trim(substr($_POST['key'],-36));
            Common::synchroPic($path);
        }
	//$mvui->pic      = 'http://117.144.248.58:8082/file/' . trim(substr($_POST['key'],-36));
        //$mvui->pic      = 'http://117.131.17.46:8086/file/' . trim(substr($_POST['key'],-36));
        $mvui->pic      = 'http://117.131.17.105:8083/file/' . trim(substr($_POST['key'],-36));
//        $mvui->pic      = 'http://localhost:8081/file/' . trim(substr($_POST['key'],-36));
        if(!$mvui->save()){
            LogWriter::logModelSaveError($mvui,__METHOD__,$mvui->attributes);
            $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
        }
        $this->die_json(array('code'=>200));
    }

    public function actionRankingUpdate()
    {
   //     var_dump($_POST);die;
        $id = $_POST['uiId'];
        $mvui = VerUi::model()->findByPk($id);
        $mvui->addTime  = time();
        $mvui->title    = trim($_POST['title']);
        $mvui->position = trim($_POST['position']);
        $mvui->type     = trim($_POST['type']);
        $mvui->uType    = trim($_POST['uType']);
        $mvui->tType    = trim($_POST['tType']);
        $mvui->cp       = trim($_POST['cp']);
//        $mvui->gid      = trim($_POST['gid']);
        $mvui->action   = trim($_POST['action']);
        $mvui->param    = trim($_POST['param']);
        $mvui->vid      = trim($_POST['vid']);
        $mvui->delFlag  = 0;
//        $mvui->scort    = trim($_REQUEST['order']);
	if(strlen($_POST['key'])>1){
            $path = trim(substr($_POST['key'],-36));
            Common::synchroPic($path);
	}
        //$mvui->pic      = 'http://117.144.248.58:8082/file/' . trim(substr($_POST['key'],-36));
        //$mvui->pic      = 'http://117.131.17.46:8086/file/' . trim(substr($_POST['key'],-36));
        $mvui->pic      = 'http://117.131.17.105:8083/file/' . trim(substr($_POST['key'],-36));
        //$mvui->pic      = 'http://localhost:8081/file/' . trim(substr($_POST['key'],-36));
        if(!$mvui->save()){
            LogWriter::logModelSaveError($mvui,__METHOD__,$mvui->attributes);
            $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
        }
        $this->die_json(array('code'=>200));
    }

    public function actionDelRanking()
    {
        $id = $_GET['id'];
        $mvui = VerUi::model()->findByPk($id);
        //var_dump($mvui);die;
        $mvui->delFlag = '1';
        if($mvui->save()){
            echo '200';
        }else{
            echo '500';
        }
    }

    public function actionCheckModuleData()
    {
	$gid = $_REQUEST['gid'];
	$sql = "select id from yd_ver_ui where gid=$gid and delFlag=0";
	$res = SQLManager::queryAll($sql);
	if(!empty($res)){
	    echo '1';	
	}else{
	    echo '2';	
	}
    }

    public function actionDelModuleData()
    {
	$gid = $_REQUEST['gid'];
	$type = $_REQUEST['type'];
	$sql = "update yd_ver_ui set `delFlag`=1 where gid=$gid";
	$sql2 = "update yd_ver_bkimg set type=$type where gid=$gid";
	$res = SQLManager::execute($sql);
	$res2 = SQLManager::execute($sql2);
	if($res>0 && $res2){
	    echo '200';	
	}else{
	    echo '500';	
	}

    }
	
    public function actionGetAjax(){
    	$gid=$_REQUEST['gid'];
        if(!empty($_REQUEST['title']) && empty($_REQUEST['cp'])){
            $tmp = VerSiteListManager::getTitle($_REQUEST['title'],$gid);
        }else if(empty($_REQUEST['title']) && !empty($_REQUEST['cp'])){
            $tmp = VerSiteListManager::getCpRes($_REQUEST['cp'],$gid);
        }else if(!empty($_REQUEST['title']) && !empty($_REQUEST['cp'])){
            $tmp = VerSiteListManager::getCpTitle($_REQUEST['title'],$_REQUEST['cp'],$gid);
        }
        echo json_encode($tmp);
    }
    public function actionAllSubmit(){
        $type = $_REQUEST['type'];
        $gid = $_REQUEST['gid'];
        $time = time();
        if($type=='2'){
            $sql="update yd_ver_site s,yd_ver_content c set s.status='1',s.upTime=$time where s.vid=c.vid and s.gid=$gid and c.flag=0;";
            $res = SQLManager::execute($sql);
        }else if($type=='3'){
            $pid = "select pid from yd_ver_sitelist where id=$gid";
            $list = SQLManager::queryRow($pid);
            $sql="select vid from yd_ver_site where status=1 and gid='{$list['pid']}'";
            $arr = SQLManager::queryAll($sql);
            $sqls="select vid from yd_ver_site where  gid='$gid'";
            $arrs = SQLManager::queryAll($sqls);
            foreach($arr as $k=>$v){
                foreach($arrs as $key=>$val){
                    if($v['vid']==$val['vid']){
                        $res = VerSite::model()->updateAll(array('status'=>1,'upTime'=>$time),'vid=:vid and gid=:gid',array(':gid'=>$gid,':vid'=>$val['vid']));
                    }
                }
            }
        }
    }	
}
