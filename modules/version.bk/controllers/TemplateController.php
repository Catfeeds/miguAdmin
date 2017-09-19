<?php
class TemplateController extends VController
{
    public function actionIndex()
    {
//        $guideModel = new MvGuide();
        $this->render('index');

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



}
