<?php
class AddContentController extends VController
{
    public function actionIndex()
    {
        $info = $_GET;
        $epg = $_GET['epg'];
        $gid = $_GET['nid'];
        $order = $_GET['order'];
        if(empty($gid) || empty($epg)){
            $this->die_json(array('code'=>404,'msg'=>'请选择要设置的位置'));
        }
        $list = MvContentManager::getOne($gid,$order);
        $ars = array_map(create_function('$record','return $record->attributes;'),MvNav::model()->findAll("gid = $gid group by `cp`"));
        foreach($ars as $key=>$val){
            $cpnew[]=$val['cp'];
        }
        $cpnew = isset($cpnew)?$cpnew:'';
        if(empty($list)){
            $list[0]['cp'] = '';
            $list[0]['tType'] = '';
        }

        $meiziList = MeiziManager::getList();
        $totalpage = MeiziManager::getTotalPage();
        $fieldCp = MeiziManager::getCpinfo();
        $fieldType = MeiziManager::getTypeinfo();
        $fieldLanguage = MeiziManager::getLanguageinfo();

        $this->render('index',array('info'=>$info,'gid'=>$gid,'epg'=>$epg,'list'=>$list,'cpnew'=>$cpnew,'meiziList'=>$meiziList,'total'=>$totalpage,'fieldCp'=>$fieldCp,'fieldType'=>$fieldType,'fieldLanguage'=>$fieldLanguage));
    }

    public function actionBannerIndex()
    {
        $id = $_GET['id'];
        $info = $_GET;
        $epg = $_GET['epg'];
        $gid = $_GET['nid'];
        $order = $_GET['order'];
        if(empty($id)){
            $this->die_json(array('code'=>404,'msg'=>'请选择要设置的位置'));
        }
        $list = MvContentManager::getFind($id);
        $ars = array_map(create_function('$record','return $record->attributes;'),MvNav::model()->findAll("gid = $gid group by `cp`"));
        foreach($ars as $key=>$val){
            $cpnew[]=$val['cp'];
        }
        $cpnew = isset($cpnew)?$cpnew:'';
        if(empty($list)){
            $list[0]['cp'] = '';
            $list[0]['tType'] = '';
        }

        $meiziList = MeiziManager::getList();
        $totalpage = MeiziManager::getTotalPage();
        $fieldCp = MeiziManager::getCpinfo();
        $fieldType = MeiziManager::getTypeinfo();
        $fieldLanguage = MeiziManager::getLanguageinfo();

        //$this->render('index',array('info'=>$info,'gid'=>$gid,'epg'=>$epg,'list'=>$list,'cpnew'=>$cpnew));
        $this->render('index',array('info'=>$info,'gid'=>$gid,'epg'=>$epg,'list'=>$list,'cpnew'=>$cpnew,'meiziList'=>$meiziList,'total'=>$totalpage,'fieldCp'=>$fieldCp,'fieldType'=>$fieldType,'fieldLanguage'=>$fieldLanguage));
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

    public function actionFirstPageAdd()
    {

        if(!Yii::app()->request->isAjaxRequest){
            $this->redirect($this->getPreUrl());
        }
        if(empty($_POST['tType'])) $this->die_json(array('code'=>404,'msg'=>'上传类型不能为空'));
        if(empty($_POST['title'])) $this->die_json(array('code'=>404,'msg'=>'标题不能为空'));
        if(empty($_POST['key'])) $this->die_json(array('code'=>404,'msg'=>'图片地址不能为空'));
        $data = $_POST;
        $res = MvContentManager::add($data);
        if($res>0){
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
        if(empty($_POST['tType'])) $this->die_json(array('code'=>404,'msg'=>'上传类型不能为空'));
        if(empty($_POST['title'])) $this->die_json(array('code'=>404,'msg'=>'标题不能为空'));
        if(empty($_POST['key'])) $this->die_json(array('code'=>404,'msg'=>'图片地址不能为空'));
        $data = $_POST;
        $res = MvContentManager::firstPageUpdate($data);
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
        if(empty($_GET['id'])) $this->die_json(array('code'=>404,'msg'=>'未能获取数据id请再试一次'));
        $id = $_GET['id'];
        $res = MvContentManager::firstPageDel($id);
        if($res>0){
            $this->die_json(array('code'=>200));
        }else{
            $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
        }
    }

    public function actionBanner()
    {
        $info = $_GET;
        $list = MvContentManager::getOne($info['nid'],$info['order']);
        $meiziList = MeiziManager::getList();
        $totalpage = MeiziManager::getTotalPage();
        $fieldCp = MeiziManager::getCpinfo();
        $fieldType = MeiziManager::getTypeinfo();
        $fieldLanguage = MeiziManager::getLanguageinfo();
        $this->render('addBanner',array('info'=>$info,'list'=>$list,'meiziList'=>$meiziList,'total'=>$totalpage,'fieldCp'=>$fieldCp,'fieldType'=>$fieldType,'fieldLanguage'=>$fieldLanguage));
    }

    public function actionPage()
    {
        $p = $_REQUEST['p'];
        $pagesize = 10;
        $list = MeiziManager::getPageList($p,$pagesize);
        echo json_encode($list);
    }

    public function actionSeach()
    {
        $keyword = $_REQUEST['keyword'];
        $cp = $_REQUEST['cp'];
        $language = $_REQUEST['language'];
        $type = $_REQUEST['type'];
        $list = MeiziManager::getSeach($keyword,$cp,$language,$type);
//        var_dump($list);die;
        echo json_encode($list);
    }

    public function actionSeachPage()
    {
        $keyword = $_REQUEST['keyword'];
        $cp = $_REQUEST['cp'];
        $language = $_REQUEST['language'];
        $type = $_REQUEST['type'];
        $p = $_REQUEST['p'];
        $pagesize = 10;
        $list = MeiziManager::getSeachPage($keyword,$cp,$language,$type,$p,$pagesize);
        echo json_encode($list);
    }

    public function actionAdd()
    {
        $id = $_REQUEST['id'];
        $list  = array();
        for($i = 0 ; $i<count($id) ; $i++){
            $list[] =  MeiziManager::getAddinfo($id[$i]);
        }
        for($j = 0 ; $j<count($list) ; $j++){
            $res = MeiziManager::doInsert($list[$j]);
        }
        echo json_encode($res);
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

}
