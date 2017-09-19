<?php
class ScreenController extends VController
{
    public function actionIndex()
    {
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
        $this->render('addScreen');
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
        Common::synchroPic($pic_true);
        //$model->pic_true = 'http://117.131.17.46:8086/file/' . $pic_true;
        $model->pic_true = 'http://117.131.17.105:8083/file/' . $pic_true;
        //$model->pic_true = trim($_POST['pic_true']);
        //$model->pic_false = trim($_POST['pic_false']);
        //$model->pic_three = trim($_POST['pic_three']);
        $pic_false = trim($_POST['pic_false']);
        $pic_false = basename($pic_false);
        Common::synchroPic($pic_false);
        //$model->pic_false = 'http://117.131.17.46:8086/file/' . $pic_false;
        $model->pic_false = 'http://117.131.17.105:8083/file/' . $pic_false;
        $pic_three = trim($_POST['pic_three']);
        $pic_three = basename($pic_three);
        Common::synchroPic($pic_three);
        //$model->pic_three = 'http://117.131.17.46:8086/file/' . $pic_three;
        $model->pic_three = 'http://117.131.17.105:8083/file/' . $pic_three;

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
        Common::synchroPic($pic);
        //$model->pic = 'http://117.131.17.46:8086/file/' . $pic;
        $model->pic = 'http://117.131.17.105:8083/file/' . $pic;
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
        $screenGuideId = $_GET['screenGuideId'];
        $templateList = VerScreenContentManager::getAllCopy($screenGuideId);
        if(!empty(VerScreenContentCopy::model()->findAll("screenGuideid=$screenGuideId and delFlag=1"))){
            $flag='1';
        }else if(!empty(VerScreenContentCopy::model()->findAll("screenGuideid=$screenGuideId and delFlag=2 and flag=100"))){
            $flag='2';
        }else{
            $flag='0';
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
        $this->render('updateGuideContent',array('list'=>$list));

    }

    public function actionDoUpdateGuide()
    {
        /*$id = trim($_REQUEST['id']);
        if(!empty($_REQUEST['title'])){
            $title = trim($_REQUEST['title']);
            $sql = "update yd_ver_screen_guide set `title`='$title' where id=$id";
            $res = SQLManager::execute($sql);
            if($res>0){
                echo '200';
            }else{
                echo '500';
            }
        }

        if(!empty($_REQUEST['pic_false'])){
            //$pic_false = trim($_REQUEST['pic_false']);
            $pic = trim($_POST['pic_false']);
            $pic = basename($pic);
            Common::synchroPic($pic);
            //$pic ='http://117.144.248.58:8082/file/' . $pic; 
            //$pic ='http://117.131.17.46:8086/file/' . $pic; 
            $pic ='http://117.131.17.105:8083/file/' . $pic; 
            $sql = "update yd_ver_screen_guide set `pic_false`='$pic' where id=$id";
            $res = SQLManager::execute($sql);
            if($res>0){
                echo '200';
            }else{
                echo '500';
            }
        }

        if(!empty($_REQUEST['pic_true'])){
            //$pic_true = trim($_REQUEST['pic_true']);
            $pic = trim($_POST['pic_true']);
            $pic = basename($pic);
            Common::synchroPic($pic);
            $pic ='http://117.131.17.46:8086/file/' . $pic;
            $pic ='http://117.131.17.105:8083/file/' . $pic;
            $sql = "update yd_ver_screen_guide set `pic_true`='$pic' where id=$id";
            $res = SQLManager::execute($sql);
            if($res>0){
                echo '200';
            }else{
                echo '500';
            }
        }
	
	if(!empty($_REQUEST['templateId'])){
            $templateId = trim($_REQUEST['templateId']);
	    $sql_delContent = "update yd_ver_screen_content set `delFlag`=1 where `screenGuideid`=$id";
            $res2 = SQLManager::execute($sql_delContent);	
            $sql = "update yd_ver_screen_guide set `templateId`=$templateId where id=$id";
            $res = SQLManager::execute($sql);
            if($res>0){
                echo '200';
            }else{
                echo '500';
            }
        }*/
	//var_dump($_REQUEST);die;
	$id = trim($_REQUEST['id']);
        $title = trim($_REQUEST['title']);
        //$pic_false = trim($_REQUEST['pic_false']);
        $pic_false = trim($_REQUEST['pic_false']);
        $pic_false = basename($pic_false);
        Common::synchroPic($pic_false);
        //$pic_false ='http://117.144.248.58:8082/file/' . $pic_false;
        //$pic_false ='http://117.131.17.46:8086/file/' . $pic_false;
        $pic_false ='http://117.131.17.105:8083/file/' . $pic_false;
        //$pic_true = trim($_REQUEST['pic_true']);
        $pic_true = trim($_REQUEST['pic_true']);
        $pic_true = basename($pic_true);
        Common::synchroPic($pic_true);
        //$pic_true ='http://117.144.248.58:8082/file/' . $pic_true;
        //$pic_true ='http://117.131.17.46:8086/file/' . $pic_true;
        $pic_true ='http://117.131.17.105:8083/file/' . $pic_true;
        //$pic_three = trim($_REQUEST['pic_three']);
        $pic_three = trim($_REQUEST['pic_three']);
        $pic_three = basename($pic_three);
        Common::synchroPic($pic_three);
        //$pic_three ='http://117.144.248.58:8082/file/' . $pic_three;
        //$pic_three ='http://117.131.17.46:8086/file/' . $pic_three;
        $pic_three ='http://117.131.17.105:8083/file/' . $pic_three;
        $templateId = trim($_REQUEST['templateId']);
        $oldTemplateId = trim($_REQUEST['oldTemplateId']);
        $focus = trim($_REQUEST['focus']);
	//var_dump($_RE)
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
            $res = VerScreenContentCopy::model()->findByPk($v->attributes['id']);
            if($v->flag=='2' || $v->flag=='100'){
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
                $res->sid = $content->attributes['id'];
            }else if($v->flag=='5'){
                $result = VerScreenContent::model()->deleteByPk($v->attributes['sid']);
                $res->flag = '8';
                $res->delFlag = '0';
                $res->sid = $content->attributes['id'];
            }
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
                $res = VerScreenContentCopy::model()->updateAll(array('delFlag'=>1), "delFlag in (0,1,2,3,4,5) and flag in (1,6) and screenGuideid = " . $guideid);
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

    	

    /*CREATE TABLE `yd_ver_screen_guide` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `gid` varchar(11) NOT NULL ,
    `siteId` int(10) NOT NULL ,
    `templateId` int(10) NOT NULL ,
    `title` varchar(250) NOT NULL ,
    `pic_true` varchar(200) NOT NULL ,
    `pic_false` varchar(200) NOT NULL ,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;*/

    /*CREATE TABLE `yd_ver_screen_content` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(300) NOT NULL DEFAULT '0' COMMENT '����',
    `type` varchar(5) NOT NULL DEFAULT '' COMMENT 'ͼƬ���� 1��Сͼ��99����ͼ',
    `tType` varchar(5) NOT NULL DEFAULT '' COMMENT '�ϴ�����',
    `param` varchar(200) NOT NULL DEFAULT '' COMMENT '��תʱ���Ĳ���',
    `action` varchar(255) NOT NULL DEFAULT '' COMMENT '��ת��action��',
    `pic` varchar(600) NOT NULL DEFAULT '' COMMENT 'ͼƬ��ַ',
    `cp` varchar(2) NOT NULL DEFAULT '' COMMENT '���շ�',
    `epg` varchar(1) DEFAULT '' COMMENT '�����ʶ',
    `addTime` int(11) NOT NULL DEFAULT '0' COMMENT '���ʱ��',
    `upTime` int(11) NOT NULL DEFAULT '0' COMMENT '����ʱ��',
    `screenGuideid` int(11) NOT NULL DEFAULT '' COMMENT '����id',
    `cid` int(12) NOT NULL DEFAULT '0' COMMENT '����id',
    `width` int(2) DEFAULT '1' COMMENT '��С��Ԫ���',
    `height` int(2) DEFAULT '1' COMMENT '��С��Ԫ���',
    `x` varchar(10) DEFAULT '0' COMMENT '�������ԭ���X����',
    `y` varchar(10) DEFAULT '0' COMMENT '�������ԭ���Y����',
    `delFlag` int(1) DEFAULT '0' COMMENT '����״̬1����,0������',
    `order` int(10) DEFAULT '0' COMMENT 'ǰ����ʾ��������',
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='������Ϣ��';*/

}

