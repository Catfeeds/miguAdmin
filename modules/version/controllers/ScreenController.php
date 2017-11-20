<?php
//header("Access-Control-Allow-Origin: *");
class ScreenController extends VController
{
    public function actionIndex()
    {
	//echo FTP_PATH;
        $gid = $_REQUEST['nid'];
        //$sql = "select * from yd_ver_screen_guide where gid = $gid";
        if($_SESSION['auth'] == '1'){
            $sql = "select * from yd_ver_screen_guide where gid = $gid order by `order` asc";
        }else{
            $user_id = $_SESSION['userid'];
            $auth_ids_res = VerDataAuth::model()->find("station_id=$gid and user_id=$user_id and auth_type=1");
            //$sql = "select a.* from yd_ver_screen_guide as a inner join yd_ver_data_auth as b on a.gid=b.station_id where b.user_id=$user_id  and a.id in(b.auth_ids)";
            if(!empty($auth_ids_res)){
                $sql = "select * from yd_ver_screen_guide where id in (".$auth_ids_res->attributes['auth_ids'].")";
            }else{
                $sql = "select * from yd_ver_screen_guide where id in (0)";
            }

        }
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
        $res = VerScreenGuide::model()->findAllByPk($screenId);
        $html = HTML::getTemplate($res[0]['templateId']);
        echo $html;
    }

    public function actionGetMaxOrder()
    {
        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        $screenGuideid = $_REQUEST['guideid'];
        $res = VerScreenContentCopy::model()->findAll(
            array(
                'select'=>'`order`',
                'order'=>'`order` desc',
                'condition'=>'screenGuideid=:screenGuideid',
                'params'=>array(':screenGuideid'=>$screenGuideid),
            ));
        $data = array();
        if(!empty($res)){
            $data['max'] = $res[0]->attributes['order'];
            $data['min'] = $res[count($res)-1]->attributes['order'];
        }

        echo json_encode($data);
    }

    public function actionAddData()
    {
        $model = new VerScreenGuide();
        $model->templateId = trim($_POST['templateId']);
        $model->siteId = 1;
        $model->gid = trim($_POST['gid']);
        $pic_true = trim($_POST['pic_true']);
        $pic_true = basename($pic_true);
	    $model->pic_true=FTP_PATH.$pic_true;
        $pic_false = trim($_POST['pic_false']);
        $pic_false = basename($pic_false);
	    $model->pic_false=FTP_PATH.$pic_false;
        $pic_three = trim($_POST['pic_three']);
        $pic_three = basename($pic_three);
	    $model->pic_three=FTP_PATH.$pic_three;
        $model->title = trim($_POST['title']);
        $model->focus = trim($_POST['focus']);
        if($model->save()){
            $guideId = $model->attributes['id'];
            $this->die_json(array('code'=>200,'guideId'=>$guideId));
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
        if(!empty($_REQUEST['onlineFlag'])){
            if(!empty($info['id'])){
                $screenContent = VerScreenContentManager::getIdOneOnline($info['id']);
            }else{
                $screenContent = VerScreenContentManager::getOneOnline($info['screenGuideId'],$info['order']);
            }
        }else{
            if(!empty($info['id'])){
                $screenContent = VerScreenContentManager::getIdOne($info['id']);
            }else{
                $screenContent = VerScreenContentManager::getOne($info['screenGuideId'],$info['order']);
            }
        }

        $this->render('updateScreenContent',array('screenContent'=>$screenContent));
    }

    public function actionFirstPageAdd()
    {

        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        $copyGuideId = trim($_POST['screenGuideId']);
        $quote_res = $this->getQuoteInfo($copyGuideId);
	//var_dump($quote_res);die;
        if($quote_res){
            $guides = $quote_res.','.$copyGuideId;
            $code = '200';
	    $guides = explode(',',$guides);	
            foreach ($guides as $k=>$v){
                $model = new VerScreenContentCopy();
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
                $pic = trim($_POST['key']);
                $pic = basename($pic);
                $model->pic=FTP_PATH.$pic;
                $model->screenGuideid = $v;
                $model->videoUrl = trim($_POST['videoUrl']);
                $model->delFlag = 0;
                $model->flag = 1;
                if(!$model->save()){
                    $code = '404';
                }
            }
            if($code == '200'){
                $this->die_json(array('code'=>200));
            }else{
                $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
            }
        }else{
            $model = new VerScreenContentCopy();
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
            $pic = trim($_POST['key']);
            $pic = basename($pic);
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

    }

    public function actionFirstPageUpdate()
    {
        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        $data = $_POST;
        $quote_res = $this->getQuoteInfo($data['screenGuideId']);
        if($quote_res){
            $this->ChangeQuoteScreenContent($data,1);
        }

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
	    $sql = "select id,screenGuideid from yd_ver_screen_content_copy where id=$id";
        $result = VerScreenContentCopy::model()->updateAll(array('flag'=>6),'id=:id',array(':id'=>$id));
        $tmp = SQLManager::queryAll($sql);
        $screenGuideid = $tmp[0]['screenGuideid'];
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
		    $type = $res[0]['type'];
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
        $list = SQLManager::queryAll($sql);
        $this->render('updateGuide',array('list'=>$list));
    }

    public function actionUpdateGuide()
    {
        $id = $_REQUEST['id'];
        $sql = "select * from yd_ver_screen_guide where id=$id";
        $list = SQLManager::queryAll($sql);
        if($list[0]['templateId']>11){
           $sql = "select a.* ,b.name AS template_name,b.id as template_id ,b.pic from yd_ver_screen_guide as a LEFT JOIN yd_ver_template as b on (a.templateId-11)=b.id where a.id=$id";
           $list = SQLManager::queryAll($sql);
        }
	    $template="select * from yd_ver_template";
        $data=SQLManager::queryAll($template);
        $quote = "select c.id as stationId,c.name,a.copyGuideId,a.pasteGuideId,a.status from yd_ver_screen_quote as a left join yd_ver_screen_guide as b on a.copyGuideId=b.id left join yd_ver_station as c on c.id=b.gid WHERE a.pasteGuideId=$id AND a.status=1 order by a.id desc ";
        $quote_res = SQLManager::queryRow($quote);
        if(!empty($quote_res)){
            $station_guide = VerScreenGuide::model()->findAll(
                array(
                    'select' =>array('title','id','templateId'),
                    'order' => '`order` asc',
                    'condition' => 'gid=:gid',
                    'params' => array(':gid'=>$quote_res['stationId']),
                ));
        }else{
            $station_guide = array();
            $quote_res = array();
        }
        $this->render('updateGuideContent',array('list'=>$list,"template"=>$data,'quote_res'=>$quote_res,'station_guide'=>$station_guide));
    }

    public function actionDoUpdateGuide()
    {

	    $id = trim($_REQUEST['id']);
        $title = trim($_REQUEST['title']);
        $pic_false = trim($_REQUEST['pic_false']);
        $pic_false = FTP_PATH.basename($pic_false);
        $res=VerScreenGuide::model()->findByPk($id);
        $pic_f=$res->pic_false;
        $pic_t=$res->pic_true;
        $pic_h=$res->pic_three;
        $pic_true = trim($_REQUEST['pic_true']);
        $pic_true = FTP_PATH.basename($pic_true);
        $pic_three = trim($_REQUEST['pic_three']);
        $pic_three = FTP_PATH.basename($pic_three);
        $templateId = trim($_REQUEST['templateId']);
        $oldTemplateId = trim($_REQUEST['oldTemplateId']);
        $focus = trim($_REQUEST['focus']);
        if($oldTemplateId == $templateId){
	        $sql = "update yd_ver_screen_guide set `title`='$title',`pic_true`='$pic_true',`pic_false`='$pic_false',`focus`='$focus',`pic_three`='$pic_three' WHERE id=$id";
            $res = SQLManager::execute($sql);
            if($res>0){
                echo '200';
            }else{
                if(!empty($_REQUEST['copyFlag']) && $_REQUEST['copyFlag'] == 1 && $_REQUEST['copyGuideId'] != $_REQUEST['a']){
                    $sql_delContent = "delete from yd_ver_screen_content where `screenGuideid`=$id";
                    $sql_delContent_copy = "delete from yd_ver_screen_content_copy  where `screenGuideid`=$id";
                    $res2 = SQLManager::execute($sql_delContent);
                    $res3 = SQLManager::execute($sql_delContent_copy);
                    echo '200';
                }else if(!empty($_REQUEST['copyFlag']) && $_REQUEST['copyFlag'] == 1 && $_REQUEST['copyGuideId'] == $_REQUEST['a']){
                    echo '200';
                }else if(!empty($_REQUEST['copyFlag']) && $_REQUEST['copyFlag'] == 2){
                    echo '200';
                }else{
                    echo '500';
                }
            }
        }else if($oldTemplateId != $templateId){
            $sql_delContent = "delete from yd_ver_screen_content where `screenGuideid`=$id";
            $sql_delContent_copy = "delete from yd_ver_screen_content_copy  where `screenGuideid`=$id";
            $res2 = SQLManager::execute($sql_delContent);
            $res3 = SQLManager::execute($sql_delContent_copy);
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
        if($res>-1){
            echo '200';
        }else{
            echo '500';
        }
    }

    public function actionSubmit()
    {
        $guide = $_REQUEST['guideid'];
        $quote_res = $this->getQuoteInfo($guide);
        if($quote_res){
            $guides = $quote_res.','.$guide;
            $list   = VerScreenContentCopy::model()->findAll("screenGuideid in ($guides) and flag in(5,10,20,30,40,50,100)");
            $guides_arr = explode(',',$guides);
            foreach ($guides_arr as $a=>$b){
                $result = VerScreenContentCopy::model()->updateAll(
                    array('delFlag'=>0),
                    'screenGuideid=:screenGuideid',
                    array(':screenGuideid'=>$b)
                );
            }
        }else{
            $list   = VerScreenContentCopy::model()->findAll("screenGuideid=$guide and flag in(5,10,20,30,40,50,100)");
            $result = VerScreenContentCopy::model()->updateAll(
                array('delFlag'=>0),
                'screenGuideid=:screenGuideid',
                array(':screenGuideid'=>$guide)
            );
        }

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
                    $res->sid = $content->attributes['id'];
                }
            }

            $review_flag = 4;   //提交审核
            $review_times = 1;
            $review_message = '发布';
            $bind_id = $content->attributes['id'];
            $review_type = 3;   //EPG屏幕数据
            $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);


	//else if($v->flag=='5'){
        //        $result = VerScreenContent::model()->deleteByPk($v->attributes['sid']);
        //        $res->flag = '8';
        //        $res->delFlag = '0';
        //        $res->sid = $content->attributes['id'];
        //    }
            $res->save();
        }
    }

    public function actionSubReview()
    {
        $guideid = $_REQUEST['guideid'];
        $quote_res = $this->getQuoteInfo($guideid);
        if($quote_res){
            $guides = $quote_res.','.$guideid;
            $result = VerScreenContentCopy::model()->findAll("screenGuideid in ($guides)");
        }else{
            $result = VerScreenContentCopy::model()->findAll("screenGuideid=$guideid");
        }
        $res = 0;
//        echo '<pre>';
//        var_dump($result);die;
        foreach($result as $k=>$v){
	        $flag = $v->attributes['flag'];
//	        var_dump($flag);
            if($flag=='1' || $flag=='6' || $flag=='5' || $flag=='10' || $flag=='20' || $flag=='30' || $flag=='40' || $flag=='50'){

                $res = VerScreenContentCopy::model()->updateAll(array('delFlag'=>1,'addTime'=>time()), "delFlag in (0,1,2,3,4,5) and flag in (1,6) and screenGuideid = " . $v->attributes['screenGuideid']);
//                var_dump($res);//die;

                $review_flag = 3;   //提交审核
                $review_times = 1;
                $review_message = '提审';
                $bind_id = $v->attributes['id'];
                $review_type = 3;   //EPG屏幕数据
                $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);
            }
        }

        if($res>0){
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
        $copyGuideId = $sid;
        $pasteGuideId = $copySid;
        $sql = "select * from yd_ver_screen_content_copy where screenGuideid=$sid";
        $res = SQLManager::queryAll($sql);
        foreach ($res as $k=>$v){
            $model = new VerScreenContentCopy();
            $model->title = $v['title'];
            $model->type  = $v['type'];
            $model->tType = $v['tType'];
            $model->param = $v['param'];
            $model->action = $v['action'];
            $model->pic = $v['pic'];
            $model->cp  = $v['cp'];
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
            $sql2 = "select id from yd_ver_screen_content where screenGuideid=$copySid and `order`=".$v['order']." order by id asc";
            //$sid = SQLManager::queryRow($sql2);
            $sid = SQLManager::queryAll($sql2);
            if(count($sid)==1){
                $model->sid = $sid[0]['id'];
            }else if(count($sid)>1){
                $tmp_model = VerScreenContentCopy::model()->findAll(
                    array(
                        'select'=>"`order`,`id`",
                        'condition' => 'screenGuideid=:screenGuideid and `order`=:order',
                        'params' => array(':screenGuideid'=>$copySid,':order'=>$v['order']),
                    ));
                if(empty($tmp_model)){
                    $model->sid = $sid[0]['id'];
                }else{
                    $model->sid = $sid[count($tmp_model)]['id'];
                }
            }
            //$model->sid = $v['sid'];
            $model->videoUrl = $v['videoUrl'];
            $model->save();
        }
        $screen_quote_model = VerScreenQuote::model()->find("`copyGuideId`=$copyGuideId and `pasteGuideId`=$pasteGuideId and `status`=1 order by id desc ");
        if(empty($screen_quote_model)){
            $screen_quote_model = new VerScreenQuote();
        }
        $screen_quote_model->copyGuideId = $copyGuideId;
        $screen_quote_model->pasteGuideId = $pasteGuideId;
        $screen_quote_model->status = 1;
        if($screen_quote_model->save()){
            return '200';
        }else{
            var_dump($screen_quote_model->getErrors());
            return '500';
        }
    }

    public function actionCopyScreenContent()
    {
        $sid = $_REQUEST['copyGuideId'];
        $copySid = $_REQUEST['pasteGuideId'];
        $sql = "select * from yd_ver_screen_content where screenGuideid=$sid";
        $res = SQLManager::queryAll($sql);
        foreach ($res as $k=>$v){
            $insert_sql = "insert into `yd_ver_screen_content`(`title`,`type`,`tType`,`param`,`action`,`pic`,`cp`,`epg`,`addTime`,`upTime`,`screenGuideid`,`cid`,`width`,`height`,`x`,`y`,`delFlag`,`order`,`uType`,`videoUrl`)";
            $insert_values = "  values('".$v['title']."','".$v['type']."','".$v['tType']."','".$v['param']."','".$v['action']."','".$v['pic']."','".$v['cp']."','".$v['epg']."','".$v['addTime']."','".$v['upTime']."','".$copySid."','".$v['cid']."','".$v['width']."','".$v['height']."','".$v['x']."','".$v['y']."','".$v['delFlag']."','".$v['order']."','".$v['uType']."','".$v['videoUrl']."')";
            $execute_sql = $insert_sql . $insert_values;
            $res = SQLManager::execute($execute_sql);
        }

        $code = $this->CopyScreenContentCopy($sid,$copySid);
        if($code == 200){
            echo '200';
        }else{
            echo '500';
        }
        //echo json_encode(array('code'=>$code));
    }

    public function actionGetStationGuide()
    {
        $station_id = $_REQUEST['stationId'];
        $res = VerScreenGuide::model()->findAll(
            array(
                'select' =>array('title','id','templateId'),
                'order' => '`order` asc',
                'condition' => 'gid=:gid',
                'params' => array(':gid'=>$station_id),
            ));

        $stuList = array();
        if (!empty($res)) {
            $stuList = json_decode(CJSON::encode($res),true);
        }
        echo json_encode($stuList);
    }

    public function actionUnbindCopy()
    {
        $copyGuideId  = $_REQUEST['copyGuideId'];
        $pasteGuideId = $_REQUEST['pasteGuideId'];
        $model = VerScreenQuote::model()->find("`copyGuideId`=$copyGuideId and `pasteGuideId`=$pasteGuideId and `status`=1 ");
        if(!empty($model)){
            $model->status = 2;
            if($model->save()){
                echo '200';
            }else{
                echo '500';
            }
        }else{
            echo '500';
        }
    }

    public function actionGetQuoteInfo()
    {
        $pasteGuideId = $_REQUEST['guideId'];
        $res = VerScreenQuote::model()->find("`pasteGuideId`=$pasteGuideId and `status`=1");
        if(!empty($res)){
            echo '1';
        }else{
            echo '2';
        }
    }

    public function getQuoteInfo($guideId)
    {
        $res = VerScreenQuote::model()->findAll("`copyGuideId`=$guideId and `status`=1");
        if(!empty($res)){
            $quote_ids = array();
            foreach ($res as $k=>$v){
                $quote_ids[] = $v->attributes['pasteGuideId'];
            }
            $quote_ids = implode(',',$quote_ids);
            return $quote_ids;
        }else{
            return false;
        }
    }

//    public function actionChangeQuoteScreenContent()
    public function ChangeQuoteScreenContent($data,$flag)
    {
        //$pasteGuideId = $_REQUEST['pasteGuideId'];
//        $id = $_REQUEST['id'];
        //flag   1:修改，2：添加，3：删除

        $id = $data['id'];
        $copy_res = VerScreenContentCopy::model()->find(
            array(
                'select' =>array('screenGuideid','`order`','pic'),
                'condition' => 'id=:id',
                'params' => array(':id'=>$id),
            )
        );
        $copyGuideId  = $copy_res->attributes['screenGuideid'];
        $copyOrder    = $copy_res->attributes['order'];
        $pic    = $copy_res->attributes['pic'];
        $copyOrder_res = VerScreenContentCopy::model()->findAll(
            array(
                "select"=>array('screenGuideid','`order`','id','pic'),
                "order"=>"id asc",
                "condition"=>'screenGuideid=:screenGuideid and `order`=:order',
                "params"=>array(":screenGuideid"=>$copyGuideId,":order"=>$copyOrder)
            )
        );
        if(!empty($copyOrder_res)){
            if(count($copyOrder_res)==1){
                $copyGuideId = $copyOrder_res[0]->attributes['screenGuideid'];
                $order = $copyOrder_res[0]->attributes['order'];
                $quote_res = VerScreenQuote::model()->findAll("`copyGuideId`=$copyGuideId and `status`=1");
                $this->doChangeQuoteScreenContent($quote_res,$order,$flag,$data);
            }else{
                foreach ($copyOrder_res as $k=>$v){
                    if($v->attributes['id'] == $id){
                        $offset = $k;
                    }
                }
                $copyGuideId = $copyOrder_res[$offset]->attributes['screenGuideid'];
                $order = $copyOrder_res[$offset]->attributes['order'];
                $quote_res = VerScreenQuote::model()->findAll("`copyGuideId`=$copyGuideId and `status`=1");
                //var_dump($quote_res);die;
                $this->doChangeQuoteScreenContentBanner($quote_res,$order,$pic,$flag,$data);
            }
        }

    }

    public function doChangeQuoteScreenContent($quote_res,$order,$flag,$data)
    {
        if(empty($quote_res)){
            return;
        }
//        var_dump($quote_res);die;
        foreach ($quote_res as $k=>$v){
            $screenGuideid = $v->attributes['pasteGuideId'];
            $model = VerScreenContentCopy::model()->find("`screenGuideid`=$screenGuideid and `order`=$order");
//            var_dump($model);die;
            if($flag ==1 && !empty($model)){
                $data['id'] = $model->attributes['id'];
                $data['screenGuideId'] = $model->attributes['screenGuideid'];
                VerScreenContentManager::updateData($data);
            }
        }
    }

    public function doChangeQuoteScreenContentBanner($quote_res,$order,$pic,$flag,$data)
    {
        if(empty($quote_res)){
            return;
        }
        $ids = array();
        $screenGuideids = array();
        foreach ($quote_res as $k=>$v){
            $screenGuideid = $v->attributes['pasteGuideId'];
            $res = VerScreenContentCopy::model()->findAll(
                array(
                    "select"=>"id,`order`,screenGuideid,pic",
                    "order"=>"id asc",
                    "condition"=>'screenGuideid=:screenGuideid and `order`=:order',
                    "params"=>array(":screenGuideid"=>$screenGuideid,":order"=>$order)
                )
            );
            foreach ($res as $key=>$val){
                if($val->attributes['pic'] == $pic){
                    $ids[] = $val->attributes['id'];
                    $screenGuideids[] = $val->attributes['screenGuideid'];
                }
            }
        }
//        var_dump($ids);die;
        foreach ($ids as $a=>$b){
            if($flag == 1){
                $data['id'] = $b;
                $data['screenGuideId'] = $screenGuideids[$a];
                VerScreenContentManager::updateData($data);
            }
        }

    }

    public function actionShowTemplatePic()
    {
        $templateId = $_REQUEST['templateId']-11;
        $res = VerTemplate::model()->findByPk($templateId);
        echo $res->attributes['pic'];
    }



    /*
     * 屏幕引用绑定关系表
        CREATE TABLE `yd_ver_screen_quote` (
          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `copyGuideId` int(10) NOT NULL DEFAULT '0' COMMENT '选中复制的导航id',
          `pasteGuideId` int(10) NOT NULL DEFAULT '0' COMMENT '进行粘贴的导航id',
          `status` int(1) NOT NULL DEFAULT '1' COMMENT '两个导航之间的绑定关系是否有效  1有效；2无效',
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8
    */

    /*
     * 站点各种数据的对应用户权限关系表
        CREATE TABLE `yd_ver_data_auth` (
          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户id',
          `station_id` int(10) NOT NULL DEFAULT '0' COMMENT '对应站点id',
          `auth_ids` varchar(255) NOT NULL DEFAULT '' COMMENT '有权限显示的数据id',
          `add_time` int(10) NOT NULL DEFAULT 0 COMMENT '添加这条数据的时间',
          `auth_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '数据的种类，1->屏幕导航',
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8
    */

    /*
     * 糖果乐园当贝支付回调存数据表
        CREATE TABLE `qm_dangbei_order` (
          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `datastr` text COMMENT '当贝返回主体json',
          `sign` varchar(32) NOT NULL DEFAULT '0' COMMENT '签名',
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8
    */

    /*
     * 壁纸消息等审核驳回记录表
        CREATE TABLE `yd_ver_review_record` (
          `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
          `type` int(10) NOT NULL DEFAULT '0' COMMENT '记录的种类 1：消息；2：壁纸 自定义',
          `bind_id` int(10) NOT NULL DEFAULT 0 COMMENT '关联壁纸、消息等表的主键id',
          `user_id` int(10) NOT NULL DEFAULT 0 COMMENT '审核或驳回人信息',
          `review_times` int(10) NOT NULL DEFAULT 0 COMMENT '表示是几审的操作',
          `review_flag` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1：通过；2：驳回；3：提审',
          `message` varchar(255) not null default '0' comment '通过或驳回是的消息 通过即默认为通过，驳回则为输入的驳回理由',
          `add_time` int(11) NOT NULL DEFAULT 0 COMMENT '添加这条数据的时间',
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8
    */

    /*
     * 测试文件权限
     * */

    /*
     * yd_ver_review_record表type字段及对应bind_id对应表主键
     * 1->消息->yd_ver_message
     * 2->壁纸->yd_ver_wall
     * 3->epg屏幕->yd_ver_screen_content_copy
     * 4->专题背景图->yd_ver_bkimg
     * 5->yd_ver_ui专题->yd_ver_ui
     * 6->yd_special_topic河南专题->yd_special_topic
     * 7->素材->yd_ver_upload
     * */
}



