<?php
class NationController extends MController{

    public function actionDefault(){
        $this->render("default");
    }

    public function actionGongju(){
        $nid=$_GET['nid'];
        $gid=$nid;
        $epg=0;

        $this->render("gongju",array('gid'=>$gid,'epg'=>$epg));
    }

    public function actionEdit(){
        $pos = $_REQUEST['pos'];
        $epg = $_REQUEST['epg'];
        $gid = $_REQUEST['gid'];
        $result = MvUiManager::getTool($gid,$epg,$pos);
        $tType=!empty($result['tType'])?$result['tType']:'';
        $cp = !empty($result['cp'])?$result['cp']:'';
        $id = !empty($result['id'])?$result['id']:'';
        $this->render('edit',array('pos'=>$pos,'epg'=>$epg,'gid'=>$gid,'tool'=>$result,'tType'=>$tType,'cp'=>$cp,'id'=>$id));
    }

    public function actionEdits(){
        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        if(empty($_POST['tType'])) $this->die_json(array('code'=>404,'msg'=>'上传类型不能为空'));
        if(empty($_POST['title'])) $this->die_json(array('code'=>404,'msg'=>'标题不能为空'));

        if(empty($_POST['position'])) $this->die_json(array('code'=>404,'msg'=>'系统错误'));
        //if(empty($_POST['cp'])) $this->die_json(array('code'=>404,'msg'=>'牌照方不能为空'));
        //echo $_POST['key'];
        $mvui = MvUi::model()->findByAttributes(array('position'=>$_POST['position'],'id'=>$_POST['id']));
        //print_r($ui['id']);
        if(!$mvui){
            $mvui = new MvUi();
            $mvui->addTime = time();
        }else{
            $mvui->upTime = time();
        }

        $mvui->title    = trim($_POST['title']);
        $mvui->position = trim($_POST['position']);
        $mvui->tType    = trim($_POST['tType']);
        $mvui->cp       = trim($_POST['cp']);
        $mvui->gid      = trim($_POST['gid']);
        $mvui->epg      = trim($_POST['epg']);
        $mvui->action   = trim($_POST['action']);
        $mvui->param    = trim($_POST['param']);
        //$mvui->pic      = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . trim(substr($_POST['key'],-36));
        if(!$mvui->save()){
            LogWriter::logModelSaveError($mvui,__METHOD__,$mvui->attributes);
            $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
        }

        $this->die_json(array('code'=>200));
    }


    public function actionIndex(){

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
        if($epg=='购物'){
           $epg=16;
        }
        if($epg=='少儿'){
            $epg=17;
        }
        $mvui = MvUiManager::getAll($gid,$epg,99);
        $xiaotu = MvUiManager::getAll($gid,$epg,1);
        //print_r($xiaotu);die();
        $html = HTML::move($mvui,$xiaotu);

        $this->render("index",array('html'=>$html,'mvui'=>$mvui,'xiaotu'=>$xiaotu,'gid'=>$gid,'epg'=>$epg));
    }


    public function actionUpload(){
        if(empty($_GET['val']) || empty($_GET['gid']) || empty($_GET['epg'])){
            $this->die_json(array('code'=>404,'msg'=>'请选择要设置的位置'));
        }
        $mvui = MvUiManager::getAll($_GET['gid'],$_GET['epg'],99);
        $xiaotu = MvUiManager::getAll($_GET['gid'],$_GET['epg'],1);
        $html = HTML::moves($mvui,$xiaotu);

        
        $fid = isset($_GET['fid'])?$_GET['fid']:'';
        $t = isset($_GET['val'])?trim($_GET['val']):'';
        $substr = substr($t,0,1);
        if($substr=='b'){
            $type = '99';
        }elseif($substr=='s'){
            $type = '1';
        }
        if($type==99){
            //大图
           // print_r($mvui[$t][$fid]);
            if(empty($mvui[$t][$fid])){
                $cp = '';
                $id = '';
                $tType = '';

            }else{
                $tType = $mvui[$t][$fid]['tType'];
                $cp = $mvui[$t][$fid]['cp'];
                $id = $mvui[$t][$fid]['id'];
            }
//            $h = "650px";
//            $w = "350px";
        }elseif($type==1){
            //小图
            if(empty($xiaotu[$t][$fid])){
                $cp = '';
                $id = '';
                $tType = '';

            }else{
                $tType = $xiaotu[$t][$fid]['tType'];
                $cp = $xiaotu[$t][$fid]['cp'];
                $id = $xiaotu[$t][$fid]['id'];
            }
//            $h = "200px";
//            $w = "350px";
        }
       $gid = $_GET['gid'];
        $ars = array_map(create_function('$record','return $record->attributes;'),MvNav::model()->findAll("gid = $gid group by `cp`"));
        //print_r($ars);
        foreach($ars as $key=>$val){
            $cpnew[]=$val['cp'];
        }
        $cpnew = isset($cpnew)?$cpnew:'';
        $n = $this->renderPartial(
            'upload',
            array(
                'address'=>trim($_GET['val']),
                'fid'=>$fid,
                'ui'=>$mvui,
                'xiaotu'=>$xiaotu,
                'html'=>$html,
                'id' =>$id,
                'gid'=>$_GET['gid'],
                'tType'=>$tType,
                'cp' =>$cp,
                'type'=>$type,
                'epg'=>$_GET['epg'],
		'cpnew'=>$cpnew,
//                'h'=>$h,
//                'w'=>$w
                //'position'=>$position
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }



    public function actionPhoto(){
        if(empty($_GET['val']) || empty($_GET['gid']) || empty($_GET['epg'])){
            $this->die_json(array('code'=>404,'msg'=>'请选择要设置的位置'));
        }
       // print_r($_GET['epg']);die();

        $mvui = MvUiManager::getAll($_GET['gid'],$_GET['epg'],99);
        $xiaotu = MvUiManager::getAll($_GET['gid'],$_GET['epg'],1);
       // print_r($mvui);die();
        $html = HTML::move($mvui,$xiaotu);

        $t = isset($_GET['val']) ? trim($_GET['val']) : '';

        $mvui = $mvui["$t"];
       // print_r($mvui);die();
        $n = $this->renderPartial(
            'photo',
            array(
                'address'=>trim($_GET['val']),
                'ui'=>$mvui,
                'xiaotu'=>$xiaotu,
                'html'=>$html,
                'gid' =>$_GET['gid'],
                'epg' =>$_GET['epg']
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
        //if(empty($_POST['cp'])) $this->die_json(array('code'=>404,'msg'=>'牌照方不能为空'));
        //echo $_POST['key'];
        $mvui = MvUi::model()->findByAttributes(array('position'=>$_POST['position'],'type'=>$_POST['type'],'id'=>$_POST['id']));
        //print_r($ui['id']);
        if(!$mvui){
            $mvui = new MvUi();
            $mvui->addTime = time();
        }else{
            $mvui->upTime = time();
        }
        $img = substr($_POST['key'],-36);
        //Common::synchroPic($img);
        $mvui->title    = trim($_POST['title']);
        $mvui->position = trim($_POST['position']);
        $mvui->type     = trim($_POST['type']);
        $mvui->tType    = trim($_POST['tType']);
        $mvui->cp       = trim($_POST['cp']);
        $mvui->gid      = trim($_POST['gid']);
        $mvui->epg      = trim($_POST['epg']);
        $mvui->action   = trim($_POST['action']);
        $mvui->param    = trim($_POST['param']);
        //$mvui->pic      = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . trim(substr($_POST['key'],-36));
        //$mvui->pic      = 'http://192.168.1.107/file/' . trim(substr($_POST['key'],-36));
        $mvui->pic   = 'http://117.144.248.58:8081/file/'.trim($img);
        //初始化
        $url = "http://117.144.248.58:8082/curl.php?img=".$trim($img);
　　    $ch = curl_init();
　　    //设置选项，包括URL
　　    curl_setopt($ch, CURLOPT_URL,$url);
　　    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
　　    curl_setopt($ch, CURLOPT_HEADER, 0);
　　    //执行并获取HTML文档内容
　　    $output = curl_exec($ch);
　　    //释放curl句柄
　　    curl_close($ch);
        if(!$mvui->save()){
            LogWriter::logModelSaveError($mvui,__METHOD__,$mvui->attributes);
            $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
        }



        $this->die_json(array('code'=>200));
    }

    public function actionSelv(){
        $cid=$_REQUEST['cid'];
        $mvui = MvSeuiManager::getAll($cid);

        //print_r($mvui);die();
        $html = HTML::selv($mvui);

        $n = $this->renderPartial(
            'selv',
            array(
                'address'=>99,
                'ui'=>$mvui,
                'html'=>$html,
                'cid'=>$cid
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionUploads(){

        $cid = $_REQUEST['cid'];
        $mvui = MvSeuiManager::getAll($cid);
        // print_r($mvui);die();
        $html = HTML::selvs($mvui);
        /*echo '<pre>';
        print_r($html);
        echo '</pre>';die;*/
        $fid = isset($_GET['fid'])?$_GET['fid']:'';
        $t = isset($_GET['val'])?trim($_GET['val']):'';
        $type=99;
        if(empty($mvui[$t][$fid])){
            $cp = '';
            $id = '';
            $tType = '';

        }else{
            $tType = $mvui[$t][$fid]['tType'];
            $cp = $mvui[$t][$fid]['cp'];
            $id = $mvui[$t][$fid]['id'];
        }
        $n = $this->renderPartial(
            'uploads',
            array(
                'address'=>trim($_GET['val']),
                'fid'=>$fid,
                'ui'=>$mvui,
                'html'=>$html,
                'id' =>$id,
                'cid'=>$cid,
                'tType'=>$tType,
                'cp' =>$cp,
                'type'=>$type,
            ),
            true
        );
        die(json_encode(array('code'=>200,'msg'=>$n)));
    }

    public function actionAdds(){

        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        if(empty($_POST['tType'])) $this->die_json(array('code'=>404,'msg'=>'上传类型不能为空'));
        if(empty($_POST['title'])) $this->die_json(array('code'=>404,'msg'=>'标题不能为空'));

        if(empty($_POST['key'])) $this->die_json(array('code'=>404,'msg'=>'图片地址不能为空'));
        if(empty($_POST['position'])) $this->die_json(array('code'=>404,'msg'=>'系统错误'));
        //if(empty($_POST['cp'])) $this->die_json(array('code'=>404,'msg'=>'牌照方不能为空'));
        //echo $_POST['key'];
        $mvui = MvSeui::model()->findByAttributes(array('pos'=>$_POST['position'],'type'=>$_POST['type'],'id'=>$_POST['id']));

        //print_r($ui['id']);
        if(!$mvui){
            $mvui = new MvSeui();
            $mvui->addTime = time();
        }else{
            $mvui->upTime = time();
        }
        $img = substr($_POST['key'],-36);
        Common::synchroPic($img);

        $mvui->cid = trim($_POST['cid']);
        $mvui->title    = trim($_POST['title']);
        $mvui->type     = trim($_POST['type']);
        $mvui->tType    = trim($_POST['tType']);
        $mvui->cp       = trim($_POST['cp']);
        $mvui->pos      = trim($_POST['position']);
        $mvui->action   = trim($_POST['action']);
        $mvui->param    = trim($_POST['param']);
        //$mvui->pic      = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . trim(substr($_POST['key'],-36));
        //$mvui->pic      = 'http://192.168.1.107/file/' . trim(substr($_POST['key'],-36));
        $mvui->pic   = 'http://117.144.248.58:8081/file/'.trim($img);
        if(!$mvui->save()){
            LogWriter::logModelSaveError($mvui,__METHOD__,$mvui->attributes);
            $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
        }



        $this->die_json(array('code'=>200));

    }

    public function actionDel(){
        if(empty($_REQUEST['id'])) $this->die_json(array('code'=>404,'msg'=>'参数不能为空'));
        $id = $_REQUEST['id'];
        Yii::app()->db->createCommand()->delete('{{mv_seui}}', "cid=$id");
        $del = MvUi::model()->deleteByPk($_REQUEST['id']);
        if(!$del){
            $this->die_json(array('code'=>404,'msg'=>'删除失败'));
        }
        $this->die_json(array('code'=>200,'msg'=>'删除成功'));
    }

    public function actionDels(){
        $id = $_REQUEST['id'];
        Yii::app()->db->createCommand()->delete('{{mv_seui}}', "cid=$id");
        //$dels = MvSeui::model()->deleteAll($criteria);

        $mvui = MvUiManager::getAll($_GET['gid'],$_GET['epg'],99);
        $fid = isset($_GET['fid'])?$_GET['fid']:'';
        $t = isset($_GET['val'])?trim($_GET['val']):'';
       // print_r($mvui[$t][$fid]['id']);
        $id=$mvui[$t][$fid]['id'];

        $del = MvUi::model()->deleteByPk($id);

        if(!$del){
            $this->die_json(array('code'=>404,'msg'=>'删除失败'));
        }
        $this->die_json(array('code'=>200,'msg'=>'删除成功'));
    }

    public function actionSedel(){
        if(empty($_REQUEST['id'])) $this->die_json(array('code'=>404,'msg'=>'参数不能为空'));
        $del = MvSeui::model()->deleteByPk($_REQUEST['id']);
        if(!$del){
            $this->die_json(array('code'=>404,'msg'=>'删除失败'));
        }
        $this->die_json(array('code'=>200,'msg'=>'删除成功'));
    }

    public function actionTodel(){
        $id = $_REQUEST['id'];
        Yii::app()->db->createCommand()->delete('{{mv_seui}}', "cid=$id");
        $epg = $_REQUEST['epg'];
        $pos = $_REQUEST['pos'];
        $gid = $_REQUEST['gid'];
        $result=Yii::app()->db->createCommand()->delete('{{mv_ui}}', "gid='$gid' and epg='$epg' and position='$pos'");
        if(!$result){
            $this->die_json(array('code'=>404,'msg'=>'删除失败'));
        }
        $this->die_json(array('code'=>200,'msg'=>'删除成功'));
    }
}
