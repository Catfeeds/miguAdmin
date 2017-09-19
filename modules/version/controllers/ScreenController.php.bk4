<?php
class ScreenController extends VController
{
    public function actionIndex()
    {
	//echo FTP_PATH;
        $gid = $_REQUEST['nid'];
        //$sql = "select * from yd_ver_screen_guide where gid = $gid";
        $sql = "select * from yd_ver_screen_guide where gid = $gid order by `order` asc";
        $list = SQLManager::queryAll($sql);
        if(empty($list)){
            $this->render('index');
        }else{
                 $html = HTML::getTemplate($list[0]['templateId']);
                 //var_dump($html);die;
             $templateList = VerScreenContentManager::getAll($list[0]['id']);
                 $templateList = json_encode($templateList);
                $this->render('index',array('list'=>$list,'html'=>$html,'templateList'=>$templateList));
        }
    }

    public function actionAddScreen()
    {
	$sql="select * from yd_ver_template";
        $res=SQLManager::queryAll($sql);
        $this->render('addScreen',array("data"=>$res));
    }
     public function actionCopyScreen(){
        $nid = $_REQUEST['nid'];
        $n = $this->renderPartial(
            'screencopy',
            array(
                'nid'=>$nid,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }
    public function actionDeleteScreeGuide()
    {
        $id = $_REQUEST['id'];
        $sql = "delete from yd_ver_screen_guide where id=$id";
        $res = SQLManager::execute($sql);
        if($res>0){
            echo '200';
        }else{
            echo '500';
        }
    }

    public function actionGetHasScreen()
    {
        $screenId = $_REQUEST['screenId'];
        $model = new VerScreenGuide();
        $res = $model->findAllByPk($screenId);
        $html = HTML::getTemplate($res[0]['templateId']);
        echo $html;
    }

    public function actionAddData()
    {
        $model = new VerScreenGuide();
	//var_dump($_POST);die;
        $model->templateId = trim($_POST['templateId']);
        $model->siteId = 1;
        $model->gid = trim($_POST['gid']);
        $pic_true = trim($_POST['pic_true']);
        $pic_true = basename($pic_true);
        //Common::synchroPic($pic_true);
        //$model->pic_true = 'http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $pic_true;
	$model->pic_true=FTP_PATH.$pic_true;
        //$model->pic_true = trim($_POST['pic_true']);
        //$model->pic_false = trim($_POST['pic_false']);
        //$model->pic_three = trim($_POST['pic_three']);
        $pic_false = trim($_POST['pic_false']);
        $pic_false = basename($pic_false);
        //Common::synchroPic($pic_false);
        //$model->pic_false = 'http://117.131.17.46:8086/file/' . $pic_false;
	$model->pic_false=FTP_PATH.$pic_false;
        //$model->pic_false = 'http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $pic_false;
        $pic_three = trim($_POST['pic_three']);
        $pic_three = basename($pic_three);
        //Common::synchroPic($pic_three);
        //$model->pic_three = 'http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $pic_three;
	$model->pic_three=FTP_PATH.$pic_three;
        $model->title = trim($_POST['title']);
        $model->focus = trim($_POST['focus']);
        if($model->save()){
            $templateModel = new MvTemplate();
            $templateModel->nid = trim($_POST['gid']);
            $templateModel->templateId = trim($_POST['templateId']);
            $templateModel->save();
            $this->die_json(array('code'=>200));
        }else{
            $this->die_json(array('code'=>500));
        }
    }

    public function actionAddScreenContent()
    {
	    $this->render('addScreenContent');
        /*$mid = $_REQUEST['mid'];
        $epg = $_REQUEST['epg'];
        $width = $_REQUEST['width'];
        $height = $_REQUEST['height'];
        $x = $_REQUEST['x'];
        $y = $_REQUEST['y'];
        $order = $_REQUEST['order'];
        $screenGuideId = $_REQUEST['screenGuideId'];

        $n = $this->renderPartial(
            'addScreenContent',
            array(
                'mid'=>$mid,
                'epg'=>$epg,
                'width'=>$width,
                'height'=>$height,
                'x'=>$x,
                'y'=>$y,
                'order'=>$order,
                'screenGuideId'=>$screenGuideId,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
	*/
    }

    public function actionUpdateScreenContent()
    {
        $info = $_REQUEST;
        //var_dump($info);die;
        if(!empty($info['id'])){
            $screenContent = VerScreenContentManager::getIdOne($info['id']);
        }else{
                $screenContent = VerScreenContentManager::getOne($info['screenGuideId'],$info['order']);
            }
        $this->render('updateScreenContent',array('screenContent'=>$screenContent));
        /*$n = $this->renderPartial(
                'updateScreenContent',
                array(
                    'screenContent'=>$screenContent,
                ),
                true
            );
            die(json_encode(array('code'=>200,'msg'=>$n)));
        */
    }

    public function actionFirstPageAdd()
    {

        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        $model = new VerScreenContentCopy();
	//echo '<pre>';
	//var_dump($_POST);die;
        $model->title = trim($_POST['title']);
        $model->action = trim($_POST['action']);
        $model->param = trim($_POST['param']);
        $model->addTime = time();
        $model->upTime = time();
        $model->cp = trim($_POST['cp']);
        $model->cid = trim($_POST['cid']);
        $model->width = trim($_POST['width']);
        $model->height = trim($_POST['height']);
        $model->x = trim($_POST['x']);
        $model->y = trim($_POST['y']);
        $model->order = trim($_POST['order']);
        $model->type = trim($_POST['type']);
        $model->tType = trim($_POST['tType']);
        $model->uType = trim($_POST['uType']);
        //$model->pic = trim($_POST['key']);
        $pic = trim($_POST['key']);
	
        $pic = basename($pic);
        //Common::synchroPic($pic);
	
        //$model->pic = 'http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $pic;
        $model->pic=FTP_PATH.$pic;
	$model->screenGuideid = trim($_POST['screenGuideId']);
        $model->videoUrl = trim($_POST['videoUrl']);
        $model->delFlag = 0;
        $model->flag = 1;
        if($model->save()){
            $this->die_json(array('code'=>200));
        }else{
            $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
        }

    }

    public function actionFirstPageUpdate()
    {
        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        $data = $_POST;
        $res = VerScreenContentManager::updateData($data);
        if($res>0){
            $this->die_json(array('code'=>200));
        }else{
            $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
        }


    }

    public function actionFirstPageDel()
    {
        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        $id = $_REQUEST['id'];
        $model = new VerScreenContent();
        //$res = $model->deleteByPk($id);
	    $sql = "select id,screenGuideid from yd_ver_screen_content_copy where id=$id";
        $result = VerScreenContentCopy::model()->updateAll(array('flag'=>6),'id=:id',array(':id'=>$id));
        $tmp = SQLManager::queryAll($sql);
        $screenGuideid = $tmp[0]['screenGuideid'];
        //$res = $model->deleteByPk($id);
        $result = VerScreenContentCopy::model()->updateAll(array('upTime'=>time()),'screenGuideid=:screenGuideid',array(':screenGuideid'=>$screenGuideid));
        if($result>0){
            $this->die_json(array('code'=>200));
        }else{
            $this->die_json(array('code'=>404,'msg'=>'删除失败'));
        }

    }
	
    public function actionGetScreenContent()
    {
        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        $screenGuideId = $_GET['screenGuideId'];
        $templateList = VerScreenContentManager::getAll($screenGuideId);
        //var_dump($templateList);die;
	if(!empty(VerScreenContentCopy::model()->findAll("screenGuideid=$screenGuideId and delFlag=1"))){
            $flag='1';
        }else if(!empty(VerScreenContentCopy::model()->findAll("screenGuideid=$screenGuideId and delFlag=2"))){
            $flag='2';
        }else{
            $flag='0';
        }
        $res['flag']=$flag;
        $res['list']=$templateList;
        echo json_encode($res);
        //echo json_encode($templateList);

    }
    
    public function actionGetScreenContentCopy()
    {
        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
	$stationid = $_GET['stationId'];
		$sql = "select type from yd_ver_work where stationId = $stationid";
		$res = SQLManager::queryAll($sql);
		if(!empty( $res[0]['type'])){
		$type =  $res[0]['type'];
		}else{
		 $type="999";
		}
		
        $screenGuideId = $_GET['screenGuideId'];
        $templateList = VerScreenContentManager::getAllCopy($screenGuideId);
         $e = VerScreenContentCopy::model()->findAll("screenGuideid=$screenGuideId and delFlag=1 and flag<>20");
       
	if(!empty(VerScreenContentCopy::model()->findAll("screenGuideid=$screenGuideId and delFlag=1"))){
            if($type == 1 && empty($e)){
        		$flag = '2';
        	}else{
        		 $flag='1';
        	}
        }else if(!empty(VerScreenContentCopy::model()->findAll("screenGuideid=$screenGuideId and delFlag=2 and flag=100"))){
            $flag='2';
        }else{
		
            if($type == 0){
        		$flag = '2';
        	}else{
        		  $flag='0';
        	}
        }
	
        $res['flag']=$flag;
        $res['list']=$templateList;
        //echo json_encode($templateList);
        echo json_encode($res);

    }
    public function actionMeizi()
    {
        $meiziList = MeiziManager::getList();
        $totalpage = MeiziManager::getTotalPage();
        $fieldCp = MeiziManager::getCpinfo();
        $fieldType = MeiziManager::getTypeinfo();
        $fieldLanguage = MeiziManager::getLanguageinfo();
        $n = $this->renderPartial(
            'meizi',
            array(
                'meiziList'=>$meiziList,
                'totalpage'=>$totalpage,
                'fieldCp'=>$fieldCp,
                'fieldType'=>$fieldType,
                'fieldLanguage'=>$fieldLanguage,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }
	
    public function actionChoseMeizi()
    {
        $id = $_POST['id'];
        if(!empty($id)){
            $meiZiInfo =  MeiziManager::getAddinfo($id);
        }else{
            $this->die_json(array('code'=>404,'msg'=>'未能获取数据id请再试一次'));
        }
        echo json_encode($meiZiInfo);
    }

    public function actionBanner()
    {
        $info = $_GET;
        $list = VerScreenContentManager::getOne($info['screenGuideId'],$info['order']);
        /*$meiziList = MeiziManager::getList();
        $totalpage = MeiziManager::getTotalPage();
        $fieldCp = MeiziManager::getCpinfo();
        $fieldType = MeiziManager::getTypeinfo();
        $fieldLanguage = MeiziManager::getLanguageinfo();
	*/
	$this->render('addBanner',array('info'=>$info));
        //$this->render('addBanner',array('info'=>$info,'list'=>$list,'meiziList'=>$meiziList,'total'=>$totalpage,'fieldCp'=>$fieldCp,'fieldType'=>$fieldType,'fieldLanguage'=>$fieldLanguage));
    }
	
    public function actionUpdateGuideView()
    {
        $gid = $_GET['nid'];
        $model = new VerScreenGuide();
        $sql = "select * from yd_ver_screen_guide where `gid`=$gid order by `order` asc";
        //$sql = "select * from yd_ver_screen_guide where `gid`=14 order by `order` asc";
        $list = SQLManager::queryAll($sql);
//        echo '<pre>';
//        var_dump($list);die;
        $this->render('updateGuide',array('list'=>$list));
    }

    public function actionUpdateGuide()
    {
        $id = $_REQUEST['id'];
        $sql = "select * from yd_ver_screen_guide where id=$id";
        $list = SQLManager::queryAll($sql);
	$template="select * from yd_ver_template";
        $data=SQLManager::queryAll($template);
        $this->render('updateGuideContent',array('list'=>$list,"template"=>$data));

    }

    public function actionDoUpdateGuide()
    {
	//var_dump($_REQUEST);die;
	$id = trim($_REQUEST['id']);
        $title = trim($_REQUEST['title']);
        //$pic_false = trim($_REQUEST['pic_false']);
        $pic_false = trim($_REQUEST['pic_false']);
        $pic_false = FTP_PATH.basename($pic_false);
        $res=VerScreenGuide::model()->findByPk($id);
        $pic_f=$res->pic_false;
        $pic_t=$res->pic_true;
        $pic_h=$res->pic_three;
        /*if(!empty($pic_f)){
            if(basename($pic_f)!==$pic_false)
                //Common::synchroPic($pic_false);
            $pic_false =FTP_PATH . $pic_false;
        }*/
        //Common::synchroPic($pic_false);
        //$pic_false ='http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $pic_false;
        //$pic_true = trim($_REQUEST['pic_true']);
        $pic_true = trim($_REQUEST['pic_true']);
        $pic_true = FTP_PATH.basename($pic_true);
        /*if(!empty($pic_t)){
            if(basename($pic_t)!==$pic_true)
                //Common::synchroPic($pic_true);
            $pic_true =FTP_PATH . $pic_true;
        }*/
        //Common::synchroPic($pic_true);
        //$pic_true ='http://117.144.248.58:8082/file/' . $pic_true;
        //$pic_true ='http://117.131.17.46:8086/file/' . $pic_true;
        //$pic_true ='http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $pic_true;
        //$pic_three = trim($_REQUEST['pic_three']);
        $pic_three = trim($_REQUEST['pic_three']);
        $pic_three = FTP_PATH.basename($pic_three);
        /*if(!empty($pic_h)){
            if(basename($pic_h)!==$pic_three)
                //Common::synchroPic($pic_three);
                $pic_three =FTP_PATH . $pic_three;
        }*/

        //Common::synchroPic($pic_three);
        //$pic_three ='http://117.144.248.58:8082/file/' . $pic_three;
        //$pic_three ='http://117.131.17.46:8086/file/' . $pic_three;
        //$pic_three ='http://pic-portal-v3.itv.cmvideo.cn:8083/file/' . $pic_three;
        $templateId = trim($_REQUEST['templateId']);
        $oldTemplateId = trim($_REQUEST['oldTemplateId']);
        $focus = trim($_REQUEST['focus']);
        if($oldTemplateId == $templateId){
	    $sql = "update yd_ver_screen_guide set `title`='$title',`pic_true`='$pic_true',`pic_false`='$pic_false',`focus`='$focus',`pic_three`='$pic_three' WHERE id=$id";	
            //$sql = "update yd_ver_screen_guide set `title`='$title',`pic_true`='$pic_true',`pic_false`='$pic_false',`focus`='$focus' WHERE id=$id";
            $res = SQLManager::execute($sql);
            if($res>0){
                echo '200';
            }else{
                echo '500';
            }
        }else if($oldTemplateId != $templateId){
            $sql_delContent = "delete from yd_ver_screen_content where `screenGuideid`=$id";
            $sql_delContent_copy = "delete from yd_ver_screen_content_copy  where `screenGuideid`=$id";
            $res2 = SQLManager::execute($sql_delContent);
            $res3 = SQLManager::execute($sql_delContent_copy);
            //$sql = "update yd_ver_screen_guide set `title`='$title',`pic_true`='$pic_true',`pic_false`='$pic_false',`templateId`='$templateId',`focus`='$focus' WHERE id=$id";
            $sql = "update yd_ver_screen_guide set `title`='$title',`pic_true`='$pic_true',`pic_false`='$pic_false',`templateId`='$templateId',`focus`='$focus',`pic_three`='$pic_three' WHERE id=$id";
	    $res = SQLManager::execute($sql);
            if($res>0){
                echo '200';
            }else{
                echo '500';
            }
        }
    }

    public function actionUpdateScreeGuideOrder()
    {
        $id = trim($_REQUEST['id']);
        $order = trim($_REQUEST['order']);
        $sql = "update yd_ver_screen_guide set `order`=$order where id=$id";
        $res = SQLManager::execute($sql);
//        var_dump($res);die;
        if($res>-1){
            echo '200';
        }else{
            echo '500';
        }
    }

    public function actionSubmit(){
        $guide = $_REQUEST['guideid'];
        $list = VerScreenContentCopy::model()->findAll("screenGuideid=$guide and flag in(5,10,20,30,40,50,100)");
        $result = VerScreenContentCopy::model()->updateAll(array('delFlag'=>0),'screenGuideid=:screenGuideid',array(':screenGuideid'=>$guide));
        foreach($list as $k=>$v){
            if(!empty($v->attributes['sid'])){
                $content = VerScreenContent::model()->findByPk($v->attributes['sid']);
            }else{
                $content = new VerScreenContent();
            }
	    if($content == null){
		$content = new VerScreenContent();
	    } 	
            $res = VerScreenContentCopy::model()->findByPk($v->attributes['id']);
            if($v->flag=='2' || $v->flag=='100'){
		if($v->pic == '/file/3.png'){
                        $result = VerScreenContent::model()->deleteByPk($v->attributes['sid']);
                        $res->flag = '8';
                $res->delFlag = '0';
                $res->sid = $content->attributes['id'];
                                }else{
                $content->title=$v->attributes['title'];
                $content->type=$v->attributes['type'];
                $content->tType=$v->attributes['tType'];
                $content->param=$v->attributes['param'];
                $content->action=$v->attributes['action'];
                $content->pic=$v->attributes['pic'];
                $content->cp=$v->attributes['cp'];
                $content->epg=$v->attributes['epg'];
                $content->screenGuideid=$v->attributes['screenGuideid'];
                $content->cid=$v->attributes['cid'];
                $content->width=$v->attributes['width'];
                $content->height=$v->attributes['height'];
                $content->x=$v->attributes['x'];
                $content->y=$v->attributes['y'];
                $content->order=$v->attributes['order'];
                $content->upTime=time();
                $content->uType=$v->attributes['uType'];
                $content->videoUrl=$v->attributes['videoUrl'];
                $content->save();
                $res->flag = '3';
                $res->delFlag = '0';
                $res->sid = $content->attributes['id'];}
            }
	//else if($v->flag=='5'){
        //        $result = VerScreenContent::model()->deleteByPk($v->attributes['sid']);
        //        $res->flag = '8';
        //        $res->delFlag = '0';
        //        $res->sid = $content->attributes['id'];
        //    }
            $res->save();
        }
    }

    public function actionSubReview(){
        $guideid = $_REQUEST['guideid'];
        $result = VerScreenContentCopy::model()->findAll("screenGuideid=$guideid");
	//echo '<pre>';
	//var_dump($result);die;
        foreach($result as $k=>$v){
	    $flag = $v->attributes['flag'];
            if($flag=='1' || $flag=='6' || $flag=='5' || $flag=='10' || $flag=='20' || $flag=='30' || $flag=='40' || $flag=='50'){
            //if($flag=='1' || $flag=='6' || $flag=='5'){
                $res = VerScreenContentCopy::model()->updateAll(array('delFlag'=>1,'addTime'=>time()), "delFlag in (0,1,2,3,4,5) and flag in (1,6) and screenGuideid = " . $guideid);
            }
        }
	//var_dump($res);die;
        if(!$res){
            echo json_encode(array('code'=>200));
        }else{
            echo json_encode(array('code'=>404));
        }
        //$result = VerScreenContentCopy::model()->updateAll(array('delFlag'=>1),'screenGuideid=:screenGuideid',array(':screenGuideid'=>$guideid));
        //$result = VerScreenContentCopy::model()->updateAll(array('delFlag'=>1), "delFlag in (0,1,2,3,4,5) and screenGuideid = " . $guideid);
    }

    public function actionCopyScreenGuide()
    {

        $nid = $_REQUEST['nid'];
        $copyId = $_REQUEST['copyId'];
        $sql = "select * from yd_ver_screen_guide where gid=$nid";
        $res = SQLManager::queryAll($sql);
        if(!empty($res)){
//            $model = new VerScreenGuide();
            foreach ($res as $k=>$v){
                $insert_sql = "insert into `yd_ver_screen_guide` (`gid`,`siteId`,`templateId`,`title`,`pic_true`,`pic_false`,`order`,`focus`,`pic_three`) ";
                $insert_values = "  values('".$copyId."','".$v['siteId']."','".$v['templateId']."','".$v['title']."','".$v['pic_true']."','".$v['pic_false']."','".$v['order']."','".$v['focus']."','".$v['pic_three']."')";
                $execute_sql = $insert_sql . $insert_values;
                $res = SQLManager::execute($execute_sql);

                                $copySid =  Yii::app()->db->getLastInsertID();
                                $sid = $v['id'];
                                $this->CopyScreenContent($sid,$copySid);
            }
        }
    }

    public function CopyScreenContent($sid,$copySid)
    {
    //   $sid = $_REQUEST['sid'];
    //    $copySid = $_REQUEST['copySid'];
        $sql = "select * from yd_ver_screen_content where screenGuideid=$sid";
        $res = SQLManager::queryAll($sql);
        foreach ($res as $k=>$v){
            $insert_sql = "insert into `yd_ver_screen_content`(`title`,`type`,`tType`,`param`,`action`,`pic`,`cp`,`epg`,`addTime`,`upTime`,`screenGuideid`,`cid`,`width`,`height`,`x`,`y`,`delFlag`,`order`,`uType`,`videoUrl`)";
            $insert_values = "  values('".$v['title']."','".$v['type']."','".$v['tType']."','".$v['param']."','".$v['action']."','".$v['pic']."','".$v['cp']."','".$v['epg']."','".$v['addTime']."','".$v['upTime']."','".$copySid."','".$v['cid']."','".$v['width']."','".$v['height']."','".$v['x']."','".$v['y']."','".$v['delFlag']."','".$v['order']."','".$v['uType']."','".$v['videoUrl']."')";
            $execute_sql = $insert_sql . $insert_values;
            $res = SQLManager::execute($execute_sql);
        }

        $this->CopyScreenContentCopy($sid,$copySid);
    }

    public function CopyScreenContentCopy($sid,$copySid)
    {
        $sql = "select * from yd_ver_screen_content_copy where screenGuideid=$sid";
        $res = SQLManager::queryAll($sql);
        foreach ($res as $k=>$v){
            $model = new VerScreenContentCopy();
            $model->title = $v['title'];
            $model->type = $v['type'];
            $model->tType = $v['tType'];
            $model->param = $v['param'];
            $model->action = $v['action'];
            $model->pic = $v['pic'];
            $model->cp = $v['cp'];
            $model->epg = $v['epg'];
            $model->addTime = $v['addTime'];
            $model->upTime = $v['upTime'];
            $model->screenGuideid = $copySid;
            $model->cid = $v['cid'];
            $model->width = $v['width'];
            $model->height = $v['height'];
            $model->x = $v['x'];
            $model->y = $v['y'];
            $model->delFlag = $v['delFlag'];
            $model->order = $v['order'];
            $model->uType = $v['uType'];
            $model->user = $v['user'];
            $model->flag = $v['flag'];
            $sql2 = "select id from yd_ver_screen_content where screenGuideid=$copySid and `order`=".$v['order'];
            $sid = SQLManager::queryRow($sql2);
            $model->sid = $sid['id'];
            //$model->sid = $v['sid'];
            $model->videoUrl = $v['videoUrl'];
            $model->save();
        }
    }	

}


