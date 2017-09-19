<?php

class DefaultController extends MController
{
	public function actionIndex(){
            $this->render('index');
	}
        
        public function actionRegist(){
            $err = 0;
            $uid = 0;
            if(empty($_REQUEST['name']) || empty($_REQUEST['stbid']) || empty($_REQUEST['type']) || empty($_REQUEST['pro']) || empty($_REQUEST['city']) || 
                    empty($_REQUEST['cp']) || empty($_REQUEST['group']) || empty($_REQUEST['pay'])) $err = 1;
            
            if($err == 0){
                $name = $_REQUEST['name'];
                $stbid = $_REQUEST['stbid'];
                $type = $_REQUEST['type'];
                $province = $_REQUEST['pro'];
                $city = $_REQUEST['city'];
                $cp = $_REQUEST['cp'];
                $group = $_REQUEST['group'];
                $pay = $_REQUEST['pay'];
                $muser = $_REQUEST['muser'];
                $mdevice = $_REQUEST['mdevice'];
                
                $criteria = new CDbCriteria();  
                $criteria->select = 'id';
                $criteria->condition = 'name=:name and stbid=:stbid and delFlag=0';
                $criteria->params = array(':name'=>$name,':stbid'=>$stbid);
                $tmp = User::model()->findAll($criteria);
                if(empty($tmp)){
                    $user = new User();
                    $user->name = $name;
                    $user->stbid = $stbid;
                    $user->type = $type;
                    $user->province = $province;
                    $user->city = $city;
                    $user->cp = $cp;
                    $user->group = $group;
                    $user->pay = $pay;
                    $user->mobileUser = $muser;
                    $user->mobileDevice = $mdevice;
                    $user->cTime = time();
                    
                    if($user->save()){
                        $tmp = User::model()->findAll($criteria);
                        $uid = $tmp[0]['id'];
                    }else{
                        $err = 1;
                    }
                }else{
                    $uid = $tmp[0]['id'];
                }
            }
            $res['err'] = $err;
            $res['uid'] = $uid;
            echo json_encode($res);
        }
        
        public function actionLogin(){
            $err = 0;
            if(empty($_REQUEST['uid']) || empty($_REQUEST['type']) || empty($_REQUEST['pro']) || empty($_REQUEST['city']) || 
                    empty($_REQUEST['cp']) || empty($_REQUEST['flag'])) $err = 1;
            
            if($err == 0){
                $active = new Active();
                $active->uid = $_REQUEST['uid'];
                $active->type = $_REQUEST['type'];
                $active->province = $_REQUEST['pro'];
                $active->city = $_REQUEST['city'];
                $active->cp = $_REQUEST['cp'];
                $active->flag = $_REQUEST['flag'];
                $active->cTime = time();
                $active->save();
            }
        }
        
        public function actionEpgActive(){
            $err = 0;
            if(empty($_REQUEST['uid']) || empty($_REQUEST['type']) || empty($_REQUEST['pro']) || empty($_REQUEST['city']) || 
                    empty($_REQUEST['cp']) || !isset($_REQUEST['epg1']) || empty($_REQUEST['epg2'])) $err = 1;
            
            if($err == 0){
                $active = new ActiveEpg();
                $active->uid = $_REQUEST['uid'];
                $active->type = $_REQUEST['type'];
                $active->province = $_REQUEST['pro'];
                $active->city = $_REQUEST['city'];
                $active->cp = $_REQUEST['cp'];
                $active->epg1 = $_REQUEST['epg1'];
                $active->epg2 = $_REQUEST['epg2'];
                $active->cTime = time();
                $active->save();
            }
        }
        
        public function actionPicActive(){
            $err = 0;
            if(empty($_REQUEST['uid']) || empty($_REQUEST['type']) || empty($_REQUEST['pro']) || empty($_REQUEST['city']) || 
                    empty($_REQUEST['cp']) || empty($_REQUEST['epg']) || empty($_REQUEST['pos'])) $err = 1;
            
            if($err == 0){
                $active = new ActivePic();
                $active->uid = $_REQUEST['uid'];
                $active->type = $_REQUEST['type'];
                $active->province = $_REQUEST['pro'];
                $active->city = $_REQUEST['city'];
                $active->cp = $_REQUEST['cp'];
                $active->epg = $_REQUEST['epg'];
                $active->pos = $_REQUEST['pos'];
                $active->cTime = time();
                $active->save();
            }
        }

	public function actionGetEpg(){
            $err = 0;
            $list = array();
            $map1 = array('1'=>'tuijian','2'=>'dianshi','3'=>'yinshi','4'=>'shaoer','5'=>'yingyong','6'=>'jishi');
            $map2 = array(
                'tuijian' => array('h-2','h-4','h-5','h-6','h-8','h-3','h-7'),
                'dianshi' => array('h-2','h-4','h-5','h-8','h-3','h-6','h-7'),
                'yinshi' => array('h-3','h-4','h-7','h-8','h-5','h-6','h-9'),
                'shaoer' => array('h-2','h-4','h-5','h-8','h-3','h-6','h-7','h-9'),
                'yingyong' => array('h-6','h-7','h-8','h-9','h-10','h-11','h-12','h-13','h-14'),
                'jishi' => array('h-2','h-4','h-5','h-8','h-3','h-6','h-7'),
            );
            if(empty($_REQUEST['epg']) || empty($_REQUEST['cp']) || !isset($_REQUEST['pro']) || !isset($_REQUEST['city'])) $err = 1;
            
            if($err==0){
                $epg = trim($_REQUEST['epg']);
                $cp = trim($_REQUEST['cp']);
                $pro = trim($_REQUEST['pro']);
                $city = trim($_REQUEST['city']);
            
                $type = $map1[$epg];
                $criteria = new CDbCriteria();          
                $criteria->select = 'position,title,bigImg,url,tType';
                $criteria->condition = 'type=:type and cp=:cp and provinceCode=:province and cityCode=:city and delFlag=0';
                $criteria->params = array(':type'=>$type,':cp'=>$cp,':province'=>$pro,':city'=>$city);
                $criteria->order = 'position asc,addTime desc';
                $tmp = Ui::model()->findAll($criteria);
                if(empty($tmp)){
                    $criteria->condition = 'type=:type and cp=:cp and provinceCode=:province and cityCode=0 and delFlag=0';
                    $criteria->params = array(':type'=>$type,':cp'=>$cp,':province'=>$pro);
                    $tmp = Ui::model()->findAll($criteria);
                    if(empty($tmp)){
                        $criteria->condition = 'type=:type and cp=:cp and provinceCode=0 and cityCode=0 and delFlag=0';
                        $criteria->params = array(':type'=>$type,':cp'=>$cp);
                        $tmp = Ui::model()->findAll($criteria);
                    }
                }
                if(!empty($tmp)){
                    $tmp_tmp = array();
                    foreach ($tmp as $tt){
                        $pos = $tt['position'];
                        $tmp2 = array();
                        if(empty($tmp_tmp[$pos])){
                            $tmp2[] = array('title'=>$tt['title'],'pic'=>$tt['bigImg'],'url'=>$tt['url'],'tType'=>$tt['tType']);
                            $tmp_tmp[$pos] = array('type'=>$tt['tType'],'info'=>$tmp2);
                        }else{
                            $tmp2 = $tmp_tmp[$pos]['info'];
                            $tmp2[] = array('title'=>$tt['title'],'pic'=>$tt['bigImg'],'url'=>$tt['url'],'tType'=>$tt['tType']);
                            $tmp_tmp[$pos]['info'] = $tmp2;
                        }
                    }
                    $int = 0;
                    foreach ($map2[$type] as $ttt){
                        $int++;
                        $list[$int] = $tmp_tmp[$ttt];
                    }
                }else{
                    $err = 1;
                }
            } 
            $res['err'] = $err;
            $res['list'] = $list;
            echo json_encode($res);
	}
        
        public function actionGetNotice(){
            $err = 0;
            if(empty($_REQUEST['cp']) || !isset($_REQUEST['pro']) || !isset($_REQUEST['city'])) $err = 1;
            
            if($err==0){
                $cp = $_REQUEST['cp'];
                $pro = $_REQUEST['pro'];
                $city = $_REQUEST['city'];
                $time = time();
                
                $criteria = new CDbCriteria();          
                $criteria->select = 'notice';
                $criteria->condition = 'cp=:cp and province=:province and city=:city and sTime<=:time and eTime>=:time and delFlag=0';
                $criteria->params = array(':cp'=>$cp,':province'=>$pro,':city'=>$city,':time'=>$time);
                $tmp = Notice::model()->find($criteria);
                if(empty($tmp)){
                    $criteria->condition = 'cp=:cp and province=:province and city=0 and sTime<=:time and eTime>=:time and delFlag=0';
                    $criteria->params = array(':cp'=>$cp,':province'=>$pro,':time'=>$time);
                    $tmp = Notice::model()->find($criteria);
                    if(empty($tmp)){
                        $criteria->condition = 'cp=:cp and province=0 and city=0 and sTime<=:time and eTime>=:time and delFlag=0';
                        $criteria->params = array(':cp'=>$cp,':time'=>$time);
                        $tmp = Notice::model()->find($criteria);
                    }
                }
            }
            if(empty($tmp)){
                $res['err'] = 0;
                $res['notice'] = '';
            }else{
                $res['err'] = 1;
                $res['notice'] = $tmp['notice'];
            }
            echo json_encode($res);
        }
        
	public function actionError(){
            $this->ReturnDate(MSG::ERROR,MSG::ERROR_INFO);
	}
        
        public function actionGetEpgHenan(){
            $err = 0;
            $list = array();
            $map = array('h-1','h-3','h-6','h-2','h-4','h-5','h-7');
            if(empty($_REQUEST['cp']) || !isset($_REQUEST['pro']) || !isset($_REQUEST['city'])) $err = 1;
            
            if($err==0){
                $cp = trim($_REQUEST['cp']);
                $pro = trim($_REQUEST['pro']);
                $city = trim($_REQUEST['city']);
            
                $criteria = new CDbCriteria();          
                $criteria->select = 'pos,title,pic,url,type';
                $criteria->condition = 'cp=:cp';
                $criteria->params = array(':cp'=>$cp);
                $criteria->order = 'pos asc,upTime desc';
                $tmp = UiHenan::model()->findAll($criteria);
                if(!empty($tmp)){
                    $tmp_tmp = array();
                    foreach ($tmp as $tt){
                        $pos = $tt['pos'];
                        $tmp2 = array();
                        if(empty($tmp_tmp[$pos])){
                            $tmp2[] = array('title'=>$tt['title'],'pic'=>$tt['pic'],'url'=>$tt['url']);
                            $tmp_tmp[$pos] = array('type'=>$tt['type'],'info'=>$tmp2);
                        }else{
                            $tmp2 = $tmp_tmp[$pos]['info'];
                            $tmp2[] = array('title'=>$tt['title'],'pic'=>$tt['pic'],'url'=>$tt['url']);
                            $tmp_tmp[$pos]['info'] = $tmp2;
                        }
                    }
                    $int = 0;
                    foreach ($map as $ttt){
                        $int++;
                        $list[$int] = $tmp_tmp[$ttt];
                    }
                }else{
                    $err = 1;
                }
            } 
            $res['err'] = $err;
            $res['list'] = $list;
            echo json_encode($res);
	}

       
       public function actionGetBackimgs(){
            $page = empty($_REQUEST['pg'])?1:$_REQUEST['pg'];
            $start = ($page-1)*6;
            
            try{
                $sql = 'select title,pic from yd_background order by id asc LIMIT '.$start.',6';
                $res['list'] = SQLManager::queryAll($sql);
                
                $sql = 'select count(id) as cnt from yd_background';
                $cnt = SQLManager::queryRow($sql);
                $res['total'] = ceil($cnt['cnt']/6);
                
                echo json_encode($res);
            } catch (Exception $ex) {
                var_dump($ex);die;
            }
        }


    public function actionSearchContent(){
        if(empty($_REQUEST['kw'])) throw new ExceptionEx('关键字不能为空');

        $title = $_REQUEST['kw'];
        $page  = 20;
        $data = $this->getPageInfo($page);
        $data['title'] = $title;
        $list = VideoManager::getList($data);
        foreach($list['list'] as $key => $val){
            $vid = $val['vid'];
            $cp  = $val['cp'];
            $list['list'][$key]['pics'] = SQLManager::queryAll("select title,size,url from yd_video_pic where vid = '$vid' and cp = '$cp'");
            $list['list'][$key]['videos'] = SQLManager::queryAll("select title,size,url from yd_video_list where vid = '$vid' and cp = '$cp'");
        }
        $res['list'] = $list['list'];
        $res['total'] = ceil($list['count'] / $page);
        echo json_encode($res);
    }
    public function actionGetEpgGansu()
    {
        $err = 0;
        $list = array();
        $map1 = array('1' => 'tuijian', '2' => 'dianshi', '3' => 'yinshi', '4' => 'shaoer', '5' => 'yingyong', '6' => 'jishi');
        $map2 = array(
            'tuijian' => array('h-2', 'h-4', 'h-5', 'h-6', 'h-8', 'h-3', 'h-7'),
            'dianshi' => array('h-2', 'h-4', 'h-5', 'h-8', 'h-3', 'h-6', 'h-7'),
            'yinshi' => array('h-3', 'h-4', 'h-7', 'h-8', 'h-5', 'h-6', 'h-9'),
            'shaoer' => array('h-2', 'h-4', 'h-5', 'h-8', 'h-3', 'h-6', 'h-7', 'h-9'),
            'yingyong' => array('h-6', 'h-7', 'h-8', 'h-9', 'h-10', 'h-11', 'h-12', 'h-13', 'h-14'),
            'jishi' => array('h-2', 'h-4', 'h-5', 'h-8', 'h-3', 'h-6', 'h-7'),
        );
        if (empty($_REQUEST['epg']) || empty($_REQUEST['cp']) || !isset($_REQUEST['pro']) || !isset($_REQUEST['city'])) $err = 1;

        if ($err == 0) {
            $epg = trim($_REQUEST['epg']);
            $cp = trim($_REQUEST['cp']);
            $pro = trim($_REQUEST['pro']);
            $city = trim($_REQUEST['city']);
            $type = $map1[$epg];

            $criteria = new CDbCriteria();
            $criteria->select = 'pos,title,bigImg,url,tType';
            $criteria->condition = 'type=:type and cp=:cp and delFlag=0';
            $criteria->params = array(':type' => $type, ':cp' => $cp);
            $criteria->order = 'pos asc,cTime desc';
            $tmp = UiGansu::model()->findAll($criteria);
            if (empty($tmp)) {
                $criteria->condition = 'type=:type and cp=:cp and delFlag=0';
                $criteria->params = array(':type' => $type, ':cp' => $cp);
                $tmp = UiGansu::model()->findAll($criteria);
                if (empty($tmp)) {
                    $criteria->condition = 'type=:type and cp=:cp and delFlag=0';
                    $criteria->params = array(':type' => $type, ':cp' => $cp);
                    $tmp = UiGansu::model()->findAll($criteria);
                }
            }

            if (!empty($tmp)) {
                $tmp_tmp = array();
                foreach ($tmp as $tt) {
                    $pos = $tt['pos'];
                    $tmp2 = array();
                    if (empty($tmp_tmp[$pos])) {
                        $tmp2[] = array('title' => $tt['title'], 'pic' => $tt['bigImg'], 'url' => $tt['url'], 'tType' => $tt['tType']);
                        $tmp_tmp[$pos] = array('type' => $tt['tType'], 'info' => $tmp2);
                    } else {
                        $tmp2 = $tmp_tmp[$pos]['info'];
                        $tmp2[] = array('title' => $tt['title'], 'pic' => $tt['bigImg'], 'url' => $tt['url'], 'tType' => $tt['tType']);
                        $tmp_tmp[$pos]['info'] = $tmp2;
                    }
                }
                /*var_dump($map2[$type]);
                echo '<pre>';
                print_r($tmp_tmp);
                echo '</pre>';die;*/
                $int = 0;
                foreach ($map2[$type] as $ttt) {
                    $int++;
                    $list[$int] = $tmp_tmp[$ttt];
                }
            } else {
                $err = 1;
            }
        }
        $res['err'] = $err;
        $res['list'] = $list;
        echo json_encode($res);
    }
    public function actionGetWalls(){
        $err = 0;
        $list = array();
        if (!isset($_REQUEST['pro']) || !isset($_REQUEST['city'])) $err = 1;
        if($err == 0){
            $pro = $_REQUEST['pro'];
            $city = $_REQUEST['city'];
            $tmp = MvWallManager::getlists($pro,$city);
            if(!empty($tmp)){
                foreach($tmp as $val){
                    $list[] = $val;
                }
            }else{
                $err = 1;
            }
        }

        $res['err'] = $err;
        $res['list'] = $list;
        echo json_encode($res);
    }

    public function actionGettabs()
    {
        $err = 0;
        $tabs = array();
        $map = array('1'=>'首页','2'=>'影视','3'=>'教育','4'=>'游戏','5'=>'应用','6'=>'咪咕专区','7'=>'综艺专区','8'=>'华数专区','9'=>'咪咕极光','10'=>'咪咕现场秀','11'=>'咪咕精彩','12'=>'甘肃专区','13'=>'音乐','14'=>'体育','15'=>'南传专区');
        if (!isset($_REQUEST['pro']) || !isset($_REQUEST['city'])) $err = 1;
        //var_dump($map);
        if ($err == 0) {
            $pro = $_REQUEST['pro'];
            $city = $_REQUEST['city'];
            $tmp = MvGuideManager::getTab($pro, $city);
            $gongju = MvUiManager::getNew('0', $pro, $city);
            $cp = MvNavManager::getList($pro,$city);
            //var_dump($tmp);die;
            if (!empty($tmp)) {
               foreach($cp as $k=>$v){
                    $cps[] = $v['cp'];
                }

               if($tmp[0]['title']=='工具栏'){
                    $tool['title']=$tmp[0]['title'];
                    if(!empty($gongju)){
                    //$tool['title']=$tmp[0]['title'];
                    foreach($gongju as $val){
                        $tool['content'][]=$val;
                    }
                    }
                    unset($tmp[0]);
                    $res['tool'] = $tool;
                }
                //var_dump($tmp);
                foreach ($tmp as $val) {
                    foreach($map as $key=>$v){
                        if($val['title']==$v){
                            //echo $key;
                            $val['epg']=$key;
                        }
                    }
                    $tabs[]=$val;
                }

            } else {
                $err = 1;
            }


        }
        $res['err'] = $err;
        $res['tabs'] = $tabs;
        $res['cp'] = $cps;
        echo json_encode($res);
    }


    public function actionGetnewepg()
    {
        $err = 0;
        $list = array();
        if (empty($_REQUEST['epg']) || !isset($_REQUEST['pro']) || !isset($_REQUEST['city'])) $err = 1;
        //if(empty($_REQUEST['epg'])) $err=1;
        if ($err == 0) {
            $epg = $_REQUEST['epg'];
            $pro = $_REQUEST['pro'];
            $city = $_REQUEST['city'];
            $tmp = MvUiManager::getNew($epg, $pro, $city);
            if (!empty($tmp)) {
                $tmp_tmp = array();
                foreach ($tmp as $tt) {
                    $pos = $tt['position'];
                    $tmp2 = array();
                    if (empty($tmp_tmp[$pos])) {
                            $tmp2[] = array('title' => $tt['title'], 'pic' => $tt['pic'], 'action' => $tt['action'], 'tType' => $tt['tType'], 'cp' => $tt['cp'], 'param' => $tt['param'],'cid'=>$tt['id']);
                            $tmp_tmp[$pos] = array('type' => $tt['type'], 'info' => $tmp2);


                    } else {
                        $tmp2 = $tmp_tmp[$pos]['info'];
                        $tmp2[] = array('title' => $tt['title'], 'pic' => $tt['pic'], 'action' => $tt['action'], 'tType' => $tt['tType'], 'cp' => $tt['cp'], 'param' => $tt['param'],'cid'=>$tt['id']);
                        $tmp_tmp[$pos]['info'] = $tmp2;


                    }
                }
                foreach ($tmp_tmp as $v) {
                    $list[] = $v;
                }
            } else {
                $err = 1;
            }
        }
        $res['err'] = $err;
        $res['list'] = $list;
        /*echo '<pre>';
        print_r($res);
        echo '</pre>';die;*/
        echo json_encode($res);

    }

    public function actionGetselv(){
        $err = 0;
        $list = array();
        if (empty($_REQUEST['cid']) ) $err = 1;
        if($err==0){
            $cid = $_REQUEST['cid'];
            $tmp = MvSeuiManager::getList($cid);
            if(empty($tmp)){
                $err =1;
            }
        }
        $res['err'] = $err;
        $res['list'] = $tmp;
        echo json_encode($res);
    }
    public function actionIsClean(){
        if (!isset($_REQUEST['pro']) || !isset($_REQUEST['city'])) $res['flag'] = 0;
        $res['flag']=0;
        echo json_encode($res);
    }
    
    public function actionOnePicActive(){
        $err = 0;
        if(empty($_REQUEST['uid']) || empty($_REQUEST['type']) || !isset($_REQUEST['pro']) || !isset($_REQUEST['city']) || empty($_REQUEST['cp']) || empty($_REQUEST['epg']) || empty($_REQUEST['cid']) || empty($_REQUEST['title']) || empty($_REQUEST['vname'])) $err = 1;

        if($err == 0){
            $active = new ActiveOnepic();
            $active->uid = $_REQUEST['uid'];
            $active->type = $_REQUEST['type'];
            $active->province = $_REQUEST['pro'];
            $active->city = $_REQUEST['city'];
            $active->cp = $_REQUEST['cp'];
            $active->epg = $_REQUEST['epg'];
            $active->cid = $_REQUEST['cid'];
            $active->title = $_REQUEST['title'];
            $active->vname = $_REQUEST['vname'];
            $active->cTime = time();
            $active->save();
        }
    }
    public function actionTwoPicActive(){
        $err = 0;
        if(empty($_REQUEST['uid']) || empty($_REQUEST['type']) || !isset($_REQUEST['pro']) || !isset($_REQUEST['city']) || empty($_REQUEST['cp']) || empty($_REQUEST['epg']) || empty($_REQUEST['cid']) || empty($_REQUEST['title']) || empty($_REQUEST['vname']) || empty($_REQUEST['pos'])) $err = 1;

        if($err == 0){
            $active = new ActiveTwopic();
            $active->uid = $_REQUEST['uid'];
            $active->type = $_REQUEST['type'];
            $active->province = $_REQUEST['pro'];
            $active->city = $_REQUEST['city'];
            $active->cp = $_REQUEST['cp'];
            $active->epg = $_REQUEST['epg'];
            $active->cid = $_REQUEST['cid'];
            $active->title = $_REQUEST['title'];
            $active->vname = $_REQUEST['vname'];
            $active->pos = $_REQUEST['pos'];
            $active->cTime = time();
            $active->save();
            var_dump($active->getErrors());
        }
    }
    public function actionUsernum(){
            $err = 0;
            if(empty($_REQUEST['uid']) || empty($_REQUEST['vname']) || empty($_REQUEST['pro']) ) $err = 1;

            if($err == 0){
                $uid = $_REQUEST['uid'];
                $vname = $_REQUEST['vname'];
                $pro = $_REQUEST['pro'];
                $user = MvUser::model()->findByAttributes(array('uid'=>$uid));
                if(empty($user)){
                    $user = new MvUser();
                    $user->cTime = time();
                }else{
                    $user->cTime = time();
                }
                $user->uid = $uid;
                $user->vname = $vname;
                $user->province=$pro;
                    
                if(!$user->save()){
                    $err = 1;
                    var_dump($user->getErrors());
                }
            }
            $res['err'] = $err;
            echo json_encode($res);
    }
    public function actionGettabes()
    {
        $err = 0;
        $tabs = array();
        $map = array('1'=>'首页','2'=>'影视','3'=>'教育','4'=>'游戏','5'=>'应用','6'=>'咪咕专区','7'=>'综艺专区','8'=>'华数专区','9'=>'咪咕极光','10'=>'咪咕现场秀','11'=>'咪咕精彩','12'=>'甘肃专区','13'=>'音乐','14'=>'体育','15'=>'南传专区','16'=>'购物');
        if (!isset($_REQUEST['pro']) || !isset($_REQUEST['city'])) $err = 1;
        if ($err == 0) {
            $pro = $_REQUEST['pro'];
            $city = $_REQUEST['city'];
            $cp = $_REQUEST['cp'];
            $tmp = MvGuideManager::getNew($pro, $city,$cp);
            $gongju = MvUiManager::getCP('0', $pro, $city,$cp);
            $cp = MvNavManager::getList($pro,$city);
            //var_dump($tmp);die;
            if (!empty($tmp)) {
                foreach($cp as $k=>$v){
                    $cps[] = $v['cp'];
                }
                $tool['title']=$tmp[0]['title'];
                foreach($gongju as $val){
                    $tool['content'][]=$val;
                }
                unset($tmp[0]);
                foreach ($tmp as $val) {
                    foreach($map as $key=>$v){
                        if($val['title']==$v){
                            $val['epg']=$key;
                        }
                    }
                    $tabs[]=$val;
                }
            } else {
                $err = 1;
            }


        }
        $res['err'] = $err;
        $res['tabs'] = $tabs;
        $res['tool'] = $tool;
        $res['cp'] = $cps;
        echo json_encode($res);
    }

    public function actionGetnew()
    {
        $err = 0;
        $list = array();
        if (empty($_REQUEST['epg']) || !isset($_REQUEST['pro']) || !isset($_REQUEST['city'])) $err = 1;
        //if(empty($_REQUEST['epg'])) $err=1;
        if ($err == 0) {
            $epg = $_REQUEST['epg'];
            $pro = $_REQUEST['pro'];
            $city = $_REQUEST['city'];
            $gid = $_REQUEST['gid'];
            $tmp = MvUiManager::getGid($epg, $pro, $city,$gid);
            if (!empty($tmp)) {
                $tmp_tmp = array();
                foreach ($tmp as $tt) {
                    $pos = $tt['position'];
                    $tmp2 = array();
                    if (empty($tmp_tmp[$pos])) {
                        $tmp2[] = array('title' => $tt['title'], 'pic' => $tt['pic'], 'action' => $tt['action'], 'tType' => $tt['tType'], 'cp' => $tt['cp'], 'param' => $tt['param'],'cid'=>$tt['id']);
                        $tmp_tmp[$pos] = array('type' => $tt['type'], 'info' => $tmp2);


                    } else {
                        $tmp2 = $tmp_tmp[$pos]['info'];
                        $tmp2[] = array('title' => $tt['title'], 'pic' => $tt['pic'], 'action' => $tt['action'], 'tType' => $tt['tType'], 'cp' => $tt['cp'], 'param' => $tt['param'],'cid'=>$tt['id']);
                        $tmp_tmp[$pos]['info'] = $tmp2;
                    }
                }
                foreach ($tmp_tmp as $v) {
                    $list[] = $v;
                }
            } else {
                $err = 1;
            }
        }
        $res['err'] = $err;
        $res['list'] = $list;
        echo json_encode($res);

    }
    public function actionTgly(){
        $str =array('flag'=>0);
        echo json_encode($str);
    }
    public function actionOnePicActives(){
        $err = 0;
        if(empty($_REQUEST['uid']) || empty($_REQUEST['type']) || !isset($_REQUEST['pro']) || !isset($_REQUEST['city'])  || empty($_REQUEST['epg']) || empty($_REQUEST['cid']) || empty($_REQUEST['title']) || empty($_REQUEST['vname'])) $err = 1;
        if($err == 0){
            $active = new ActiveOnepic();
            $active->uid = $_REQUEST['uid'];
            $active->type = $_REQUEST['type'];
            $active->province = $_REQUEST['pro'];
            $active->city = $_REQUEST['city'];
            $active->cp = $_REQUEST['cp'];
            $active->epg = $_REQUEST['epg'];
            $active->cid = $_REQUEST['cid'];
            $active->pos = $_REQUEST['pos'];
            $active->rand = $_REQUEST['rand'];
            $active->title = $_REQUEST['title'];
            $active->vname = $_REQUEST['vname'];
            $active->cTime = time();
            $active->save();
            var_dump($active->getErrors());
        }
    }

    public function actionTwoPicActives(){
        $err = 0;
        if(empty($_REQUEST['uid']) || empty($_REQUEST['type']) || !isset($_REQUEST['pro']) || !isset($_REQUEST['city']) || empty($_REQUEST['cp']) || empty($_REQUEST['epg']) || empty($_REQUEST['cid']) || empty($_REQUEST['title']) || empty($_REQUEST['vname']) || empty($_REQUEST['pos'])) $err = 1;

        if($err == 0){
            $active = new ActiveTwopic();
            $active->uid = $_REQUEST['uid'];
            $active->type = $_REQUEST['type'];
            $active->province = $_REQUEST['pro'];
            $active->city = $_REQUEST['city'];
            $active->cp = $_REQUEST['cp'];
            $active->epg = $_REQUEST['epg'];
            $active->cid = $_REQUEST['cid'];
            $active->rand = $_REQUEST['rand'];
            $active->title = $_REQUEST['title'];
            $active->vname = $_REQUEST['vname'];
            $active->pos = $_REQUEST['pos'];
            $active->cTime = time();
            $active->save();
            var_dump($active->getErrors());
        }
    }

    public function actionGetGwFtpContent()
    {
        set_time_limit(400);
        date_default_timezone_set('PRC');
        date("Y-m-d H:i:s", time());  //2016-08-11 10:30:32    //输出当前时间
        $todayTime = strtotime(date("Y-m-d"), time()); //获得当日凌晨的时间戳
        $startDate = date('Ymdhis',($todayTime-86400));
        $endDate = date('Ymdhis',$todayTime);
//        $apiUrl = "http://221.181.100.51:8088/poms-admin/json/getContOutputData.html?u=jtcp003dingzhaocai&t=01&s=0&l=100&startDate=$startDate&endDate=$endDate&a=mgjc01&p=94e8cde4612b3fd390677d42e7b22002";
        $apiUrl = "http://172.16.20.142:8088/poms-admin/json/getContOutputData.html?u=jtcp003dingzhaocai&t=01&s=0&l=100&startDate=$startDate&endDate=$endDate&a=mgjc01&p=94e8cde4612b3fd390677d42e7b22002";
        //初始化
        $ch = curl_init();
        //设置选项，包括URL
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,0);   //只需要设置一个秒的数量就可以
        curl_setopt($ch, CURLOPT_HEADER, 0);

        //执行并获取HTML文档内容
        $output = curl_exec($ch);
        //释放curl句柄
        curl_close($ch);

        $data = json_decode($output);
//        $data = json_decode('{"returnCode":"000000","pth":"\/output\/full\/2017-06-05\/2017-06-05_PROGRAM.txt"}');

        if($data->returnCode == '000000'){
            $path = $data->pth;
        }else{
            return;
        }
        $str = $path;
//        $str = '/output/full/2017-06-05/2017-06-05_PROGRAM.txt';
        $pos = strrpos($str,'/');
        $last_str = substr($str,$pos);
        $ftp_user = 'mgjc01';
        $ftp_password = '3edc#EDC';
        $ftp_url = '172.16.20.136';
        $conn = ftp_connect($ftp_url) or die("Could not connect");
        ftp_login($conn,$ftp_user,$ftp_password);
//        ftp_get($conn,'/tmp'.$last_str,$path,FTP_BINARY,0);
        ftp_get($conn,Yii::app()->basePath.'/gwApiTxtContent'.$last_str,$path,FTP_BINARY,0);
        ftp_close($conn);
    }
 
        

     public function getGwDataImg($mss_id,$imgInfo)
    {
        $ftp_user = 'mgjc01';
        $ftp_password = '3edc#EDC';
        $ftp_url = '172.16.20.136';
        $conn = ftp_connect($ftp_url) or die("Could not connect");
        ftp_login($conn,$ftp_user,$ftp_password);
//        $mss_id = '3013496520';
        $ftp_img_path = '';
        $ftp_img_path .= '/image/';
        $ftp_img_path .= substr($mss_id,0,4);
        $ftp_img_path .= '/'.substr($mss_id,4,3);
        $ftp_img_path .= '/'.substr($mss_id,7,3).'/';
        foreach ($imgInfo as $k=>$v){
	    //var_dump($v);die;	
            $ftpImg = $v['dpfilename'];
            ftp_get($conn,'/tmp/gwXmlImg/'.$mss_id.'_'.$ftpImg,$ftp_img_path.$ftpImg,FTP_BINARY,0);
        }
                ftp_close($conn);
    }

    public function actionNewSetContent(){
        header("Content-type: text/html; charset=utf-8");
        //header("Content-Type:text/html;Charset=utf-8");
        //try{
        $time = time();
        //var_dump($xm);die;
        //$xm = file_get_contents("php://input");

        /*$filename = Yii::app()->basePath . '/upload/'.$time.'.xml';
        $fp = fopen($filename, "w");
        if(@fwrite($fp, $xm)){
            echo "success";
        }else{
            echo "fail";
        }
        fclose($fp);*/
        $xm = '<?xml version="1.0" encoding="UTF-8" ?>
<content>
	<version><![CDATA[1.0.0.0]]></version>
	<contid><![CDATA[626892327]]></contid>	
	<name><![CDATA[上海王]]></name>	
	<name1><![CDATA[]]></name1>
	<name2><![CDATA[]]></name2>
	<levelval><![CDATA[]]></levelval>
	<rankval><![CDATA[]]></rankval>
	<createtime><![CDATA[2017-05-04 10:26:57]]></createtime>
	<updatetime><![CDATA[2017-05-23 12:41:52]]></updatetime>
	<publishtime><![CDATA[2017-05-23 12:41:52]]></publishtime>	
	<ispublished><![CDATA[1]]></ispublished>
	<issupwap><![CDATA[1]]></issupwap>
	<issuprms><![CDATA[1]]></issuprms>
	<issuph264><![CDATA[1]]></issuph264>
	<issupwww><![CDATA[1]]></issupwww>
	<issuprchd><![CDATA[1]]></issuprchd>
	<isupdating><![CDATA[]]></isupdating>
	<PRDPACK_ID><![CDATA[1002601]]></PRDPACK_ID>
	<BC_ID><![CDATA[699004]]></BC_ID>
	<SP_ID><![CDATA[699013]]></SP_ID>
	<PRODUCT_ID><![CDATA[]]></PRODUCT_ID>
	<AccessPlatFormType><![CDATA[89]]></AccessPlatFormType>
	
	<!-- 促销 -->
	<salesPromotions>
	</salesPromotions>
	
	<!--客户端类型 促销 -->
	<clientTypeSales>
	</clientTypeSales>
	
	
	<!-- 渠道计费 -->
	<channelPkgsProduct>
	</channelPkgsProduct>
	<!-- 电影票 -->
	<tickets>
	</tickets>
	
	<!--流量限免 -->
    <freeFlow>
    </freeFlow>
    
    <!--角标-->
    <footers>
	</footers>
	
	<!--只输出节目单中不能回看的节目-->
	<playBill>
	</playBill>
	
	
	
	
	<fields>
		<SubSerial_IDS><![CDATA[]]></SubSerial_IDS>
		<SubAlbum_IDS><![CDATA[]]></SubAlbum_IDS>
		<IsSubAlbum><![CDATA[0]]></IsSubAlbum>
		<Album_IDS><![CDATA[]]></Album_IDS>
		<DISPLAYFILELISTS><![CDATA[/image/5500/085/803]]></DISPLAYFILELISTS>
		<MMS_ID><![CDATA[5500085803]]></MMS_ID>
		<CDuration><![CDATA[6430]]></CDuration>
		<CPID><![CDATA[699007]]></CPID>
		<ECID><![CDATA[]]></ECID>
		<UDID><![CDATA[]]></UDID>
		<AssetID><![CDATA[5100066486]]></AssetID>
		<Assist><![CDATA[]]></Assist>
		<Author><![CDATA[]]></Author>
		<CATEGORY><![CDATA[1]]></CATEGORY>
		<COPYRIGHTID><![CDATA[0000000000000003]]></COPYRIGHTID>
		<CopyRightType><![CDATA[1]]></CopyRightType>
		<CreateTime><![CDATA[2016-08-25 10:58:26]]></CreateTime>
		<ModifyTime><![CDATA[2017-05-19 09:17:14]]></ModifyTime>
		<CreatorID><![CDATA[10025141]]></CreatorID>
		<Detail><![CDATA[电影讲述了20世纪初上海滩十里洋场，黑帮势力的角逐纷争。纷杂乱世中，奇女子筱月桂(余男 饰）与三代上海王之间充满传奇色彩的爱恨情仇。]]></Detail>
		<TwDetail><![CDATA[]]></TwDetail>
		<DirectRecFlag><![CDATA[]]></DirectRecFlag>
		<DISPLAYTYPE><![CDATA[1000]]></DISPLAYTYPE>
		<DisplayName><![CDATA[电影]]></DisplayName>
		<FORMTYPE><![CDATA[8]]></FORMTYPE>
		<MediaLevel><![CDATA[]]></MediaLevel>
		<N_CPID><![CDATA[699007]]></N_CPID>
		<Name><![CDATA[上海王]]></Name>
		<Sequence><![CDATA[837513]]></Sequence>
		<SerialContentID><![CDATA[]]></SerialContentID>
		<SerialCount><![CDATA[]]></SerialCount>
		<SerialSequence><![CDATA[]]></SerialSequence>
		<SerialTrailingSequence><![CDATA[]]></SerialTrailingSequence>
		<SHORTNAME><![CDATA[上海王]]></SHORTNAME>
		<TYPE><![CDATA[7]]></TYPE>
		<LiveType><![CDATA[]]></LiveType>
		<MTV_ID><![CDATA[]]></MTV_ID>
		<HasMedia><![CDATA[1]]></HasMedia>
		<MiguRank><![CDATA[]]></MiguRank>
		<doubanID><![CDATA[]]></doubanID>
		<Recommendation><![CDATA[影视]]></Recommendation>
		
		<KeywordsCopy><![CDATA[]]></KeywordsCopy>
		<RecommendationCopy><![CDATA[]]></RecommendationCopy>
		<DetailCopy><![CDATA[]]></DetailCopy>
		<NameCopy><![CDATA[]]></NameCopy>
		
		<ContentLevel><![CDATA[B]]></ContentLevel>
		<TvEndDate><![CDATA[]]></TvEndDate>
		
		<ContentLists>
		</ContentLists>
		
		<SCENEFILES>
		</SCENEFILES>
		<!-- 版权 -->
		<CopyRight>
			<CopyRightObjectID><![CDATA[100018681]]></CopyRightObjectID>  
			<N_CPID><![CDATA[699007]]></N_CPID> 
		  	<Name><![CDATA[上海王]]></Name>  
		  	<BeginDate><![CDATA[2017-04-19 00:00:00]]></BeginDate>  
		  	<EndDate><![CDATA[2018-04-18 23:59:00]]></EndDate>  
		  	<Area><![CDATA[1]]></Area>
		  	<BlackArea><![CDATA[]]></BlackArea>    
		  	<Terminal><![CDATA[2]]></Terminal>  
		  	<Integrity><![CDATA[3]]></Integrity>  
		  	<Scarcity><![CDATA[3]]></Scarcity>  
		  	<Way><![CDATA[3]]></Way>  
		  	<Publish><![CDATA[1]]></Publish>  
		  	<Clarity><![CDATA[]]></Clarity>  
		  	<Support><![CDATA[]]></Support>  
		  	<Scope><![CDATA[2]]></Scope>  
		  	<Output><![CDATA[0]]></Output>  
		  	<Chain><![CDATA[]]></Chain>
		  	<FeeType><![CDATA[2]]></FeeType>  
		  	<CopyRightUDID><![CDATA[]]></CopyRightUDID>
		  	<Optimal><![CDATA[0]]></Optimal>
		  	<Score><![CDATA[69]]></Score>
		  	<File><![CDATA[]]></File>
		  	<NeedDRM><![CDATA[1]]></NeedDRM>
		  	<authorizationWay><![CDATA[1]]></authorizationWay>
		  	<miguPublish><![CDATA[1]]></miguPublish>
		  	<bcLicense><![CDATA[1]]></bcLicense>
		  	<influence><![CDATA[1]]></influence>
		  	<oriPublish><![CDATA[3]]></oriPublish>
		  	<WorksType><![CDATA[1]]></WorksType>
		  	<RightType><![CDATA[1]]></RightType>
		  	<AuditionRecordsNum><![CDATA[]]></AuditionRecordsNum>
		  	<BusinessLicense><![CDATA[]]></BusinessLicense>
		</CopyRight>
		<!-- 关键字 -->
		<KEYWORDS>
        	<keyword>
        		<primaryKey><![CDATA[1]]></primaryKey>
				<keywordName><![CDATA[老上海,黑帮,争斗]]></keywordName>  
			</keyword>
		</KEYWORDS>
		
		<LABELS>
		</LABELS>
		
		<!-- 媒体文件 -->
		<mediafiles>
			<mediafile>
				<mediaFileID><![CDATA[5000977122]]></mediaFileID>
				<mediaFileName><![CDATA[5100066486_5000977122_54.mp4]]></mediaFileName>
				<sourceFileName><![CDATA[]]></sourceFileName>
				<visitPath><![CDATA[rtsp://172.16.10.205/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977122_54.mp4]]></visitPath>
				<mediaType><![CDATA[10]]></mediaType>
				<mediaSize><![CDATA[285845576]]></mediaSize>
				<duration><![CDATA[6430]]></duration>
				<mediaUsageCode><![CDATA[54]]></mediaUsageCode>
				<mediaCodeFormat><![CDATA[04]]></mediaCodeFormat>
				<mediaContainFormat><![CDATA[04]]></mediaContainFormat>
				<mediaCodeRate><![CDATA[50]]></mediaCodeRate>
				<mediaNetType><![CDATA[01]]></mediaNetType>
				<mediaMimeType><![CDATA[03]]></mediaMimeType>
				<mediaResolution><![CDATA[08]]></mediaResolution>
				<mediaProfile><![CDATA[04]]></mediaProfile>
				<mediaLevel><![CDATA[11]]></mediaLevel>
				<mediaFilePath><![CDATA[/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977122_54.mp4]]></mediaFilePath>
				<mediaFilePreviewPath><![CDATA[]]></mediaFilePreviewPath>
				<mediaFileAction><![CDATA[0]]></mediaFileAction>
			</mediafile>
			<mediafile>
				<mediaFileID><![CDATA[5000977123]]></mediaFileID>
				<mediaFileName><![CDATA[5100066486_5000977123_55.mp4]]></mediaFileName>
				<sourceFileName><![CDATA[]]></sourceFileName>
				<visitPath><![CDATA[rtsp://172.16.10.205/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977123_55.mp4]]></visitPath>
				<mediaType><![CDATA[10]]></mediaType>
				<mediaSize><![CDATA[535825504]]></mediaSize>
				<duration><![CDATA[6430]]></duration>
				<mediaUsageCode><![CDATA[55]]></mediaUsageCode>
				<mediaCodeFormat><![CDATA[04]]></mediaCodeFormat>
				<mediaContainFormat><![CDATA[04]]></mediaContainFormat>
				<mediaCodeRate><![CDATA[75]]></mediaCodeRate>
				<mediaNetType><![CDATA[07]]></mediaNetType>
				<mediaMimeType><![CDATA[03]]></mediaMimeType>
				<mediaResolution><![CDATA[20]]></mediaResolution>
				<mediaProfile><![CDATA[04]]></mediaProfile>
				<mediaLevel><![CDATA[11]]></mediaLevel>
				<mediaFilePath><![CDATA[/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977123_55.mp4]]></mediaFilePath>
				<mediaFilePreviewPath><![CDATA[]]></mediaFilePreviewPath>
				<mediaFileAction><![CDATA[0]]></mediaFileAction>
			</mediafile>
			<mediafile>
				<mediaFileID><![CDATA[5000977124]]></mediaFileID>
				<mediaFileName><![CDATA[5100066486_5000977124_56.mp4]]></mediaFileName>
				<sourceFileName><![CDATA[]]></sourceFileName>
				<visitPath><![CDATA[rtsp://172.16.10.205/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977124_56.mp4]]></visitPath>
				<mediaType><![CDATA[10]]></mediaType>
				<mediaSize><![CDATA[1209926510]]></mediaSize>
				<duration><![CDATA[6430]]></duration>
				<mediaUsageCode><![CDATA[56]]></mediaUsageCode>
				<mediaCodeFormat><![CDATA[04]]></mediaCodeFormat>
				<mediaContainFormat><![CDATA[04]]></mediaContainFormat>
				<mediaCodeRate><![CDATA[150]]></mediaCodeRate>
				<mediaNetType><![CDATA[03]]></mediaNetType>
				<mediaMimeType><![CDATA[03]]></mediaMimeType>
				<mediaResolution><![CDATA[11]]></mediaResolution>
				<mediaProfile><![CDATA[05]]></mediaProfile>
				<mediaLevel><![CDATA[14]]></mediaLevel>
				<mediaFilePath><![CDATA[/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977124_56.mp4]]></mediaFilePath>
				<mediaFilePreviewPath><![CDATA[]]></mediaFilePreviewPath>
				<mediaFileAction><![CDATA[0]]></mediaFileAction>
			</mediafile>
			<mediafile>
				<mediaFileID><![CDATA[5000977126]]></mediaFileID>
				<mediaFileName><![CDATA[5100066486_5000977126_58.mp4]]></mediaFileName>
				<sourceFileName><![CDATA[]]></sourceFileName>
				<visitPath><![CDATA[rtsp://172.16.10.205/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977126_58.mp4]]></visitPath>
				<mediaType><![CDATA[10]]></mediaType>
				<mediaSize><![CDATA[248682571]]></mediaSize>
				<duration><![CDATA[6430]]></duration>
				<mediaUsageCode><![CDATA[58]]></mediaUsageCode>
				<mediaCodeFormat><![CDATA[22]]></mediaCodeFormat>
				<mediaContainFormat><![CDATA[22]]></mediaContainFormat>
				<mediaCodeRate><![CDATA[75]]></mediaCodeRate>
				<mediaNetType><![CDATA[01]]></mediaNetType>
				<mediaMimeType><![CDATA[03]]></mediaMimeType>
				<mediaResolution><![CDATA[20]]></mediaResolution>
				<mediaProfile><![CDATA[13]]></mediaProfile>
				<mediaLevel><![CDATA[00]]></mediaLevel>
				<mediaFilePath><![CDATA[/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977126_58.mp4]]></mediaFilePath>
				<mediaFilePreviewPath><![CDATA[]]></mediaFilePreviewPath>
				<mediaFileAction><![CDATA[0]]></mediaFileAction>
			</mediafile>
			<mediafile>
				<mediaFileID><![CDATA[5000977127]]></mediaFileID>
				<mediaFileName><![CDATA[5100066486_5000977127_59.mp4]]></mediaFileName>
				<sourceFileName><![CDATA[]]></sourceFileName>
				<visitPath><![CDATA[rtsp://172.16.10.205/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977127_59.mp4]]></visitPath>
				<mediaType><![CDATA[10]]></mediaType>
				<mediaSize><![CDATA[490892272]]></mediaSize>
				<duration><![CDATA[6430]]></duration>
				<mediaUsageCode><![CDATA[59]]></mediaUsageCode>
				<mediaCodeFormat><![CDATA[22]]></mediaCodeFormat>
				<mediaContainFormat><![CDATA[22]]></mediaContainFormat>
				<mediaCodeRate><![CDATA[150]]></mediaCodeRate>
				<mediaNetType><![CDATA[07]]></mediaNetType>
				<mediaMimeType><![CDATA[03]]></mediaMimeType>
				<mediaResolution><![CDATA[11]]></mediaResolution>
				<mediaProfile><![CDATA[13]]></mediaProfile>
				<mediaLevel><![CDATA[00]]></mediaLevel>
				<mediaFilePath><![CDATA[/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977127_59.mp4]]></mediaFilePath>
				<mediaFilePreviewPath><![CDATA[]]></mediaFilePreviewPath>
				<mediaFileAction><![CDATA[0]]></mediaFileAction>
			</mediafile>
			<mediafile>
				<mediaFileID><![CDATA[5000977128]]></mediaFileID>
				<mediaFileName><![CDATA[5100066486_5000977128_60.mp4]]></mediaFileName>
				<sourceFileName><![CDATA[]]></sourceFileName>
				<visitPath><![CDATA[rtsp://172.16.10.205/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977128_60.mp4]]></visitPath>
				<mediaType><![CDATA[10]]></mediaType>
				<mediaSize><![CDATA[1264733271]]></mediaSize>
				<duration><![CDATA[6430]]></duration>
				<mediaUsageCode><![CDATA[60]]></mediaUsageCode>
				<mediaCodeFormat><![CDATA[22]]></mediaCodeFormat>
				<mediaContainFormat><![CDATA[22]]></mediaContainFormat>
				<mediaCodeRate><![CDATA[200]]></mediaCodeRate>
				<mediaNetType><![CDATA[03]]></mediaNetType>
				<mediaMimeType><![CDATA[03]]></mediaMimeType>
				<mediaResolution><![CDATA[13]]></mediaResolution>
				<mediaProfile><![CDATA[13]]></mediaProfile>
				<mediaLevel><![CDATA[00]]></mediaLevel>
				<mediaFilePath><![CDATA[/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977128_60.mp4]]></mediaFilePath>
				<mediaFilePreviewPath><![CDATA[]]></mediaFilePreviewPath>
				<mediaFileAction><![CDATA[0]]></mediaFileAction>
			</mediafile>
			<mediafile>
				<mediaFileID><![CDATA[5000977125]]></mediaFileID>
				<mediaFileName><![CDATA[5100066486_5000977125_63.mp4]]></mediaFileName>
				<sourceFileName><![CDATA[]]></sourceFileName>
				<visitPath><![CDATA[rtsp://172.16.10.205/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977125_63.mp4]]></visitPath>
				<mediaType><![CDATA[10]]></mediaType>
				<mediaSize><![CDATA[2012976611]]></mediaSize>
				<duration><![CDATA[6430]]></duration>
				<mediaUsageCode><![CDATA[63]]></mediaUsageCode>
				<mediaCodeFormat><![CDATA[04]]></mediaCodeFormat>
				<mediaContainFormat><![CDATA[04]]></mediaContainFormat>
				<mediaCodeRate><![CDATA[200]]></mediaCodeRate>
				<mediaNetType><![CDATA[03]]></mediaNetType>
				<mediaMimeType><![CDATA[03]]></mediaMimeType>
				<mediaResolution><![CDATA[13]]></mediaResolution>
				<mediaProfile><![CDATA[05]]></mediaProfile>
				<mediaLevel><![CDATA[14]]></mediaLevel>
				<mediaFilePath><![CDATA[/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977125_63.mp4]]></mediaFilePath>
				<mediaFilePreviewPath><![CDATA[]]></mediaFilePreviewPath>
				<mediaFileAction><![CDATA[0]]></mediaFileAction>
			</mediafile>
			<mediafile>
				<mediaFileID><![CDATA[5000977129]]></mediaFileID>
				<mediaFileName><![CDATA[5100066486_5000977129_72.mp4]]></mediaFileName>
				<sourceFileName><![CDATA[]]></sourceFileName>
				<visitPath><![CDATA[rtsp://172.16.10.205/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977129_72.mp4]]></visitPath>
				<mediaType><![CDATA[10]]></mediaType>
				<mediaSize><![CDATA[167894496]]></mediaSize>
				<duration><![CDATA[6430]]></duration>
				<mediaUsageCode><![CDATA[72]]></mediaUsageCode>
				<mediaCodeFormat><![CDATA[32]]></mediaCodeFormat>
				<mediaContainFormat><![CDATA[32]]></mediaContainFormat>
				<mediaCodeRate><![CDATA[50]]></mediaCodeRate>
				<mediaNetType><![CDATA[01]]></mediaNetType>
				<mediaMimeType><![CDATA[03]]></mediaMimeType>
				<mediaResolution><![CDATA[08]]></mediaResolution>
				<mediaProfile><![CDATA[13]]></mediaProfile>
				<mediaLevel><![CDATA[00]]></mediaLevel>
				<mediaFilePath><![CDATA[/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977129_72.mp4]]></mediaFilePath>
				<mediaFilePreviewPath><![CDATA[]]></mediaFilePreviewPath>
				<mediaFileAction><![CDATA[0]]></mediaFileAction>
			</mediafile>
			<mediafile>
				<mediaFileID><![CDATA[5000977130]]></mediaFileID>
				<mediaFileName><![CDATA[5100066486_5000977130_91.mp4]]></mediaFileName>
				<sourceFileName><![CDATA[]]></sourceFileName>
				<visitPath><![CDATA[rtsp://172.16.10.205/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977130_91.mp4]]></visitPath>
				<mediaType><![CDATA[10]]></mediaType>
				<mediaSize><![CDATA[2013502427]]></mediaSize>
				<duration><![CDATA[6430]]></duration>
				<mediaUsageCode><![CDATA[91]]></mediaUsageCode>
				<mediaCodeFormat><![CDATA[30]]></mediaCodeFormat>
				<mediaContainFormat><![CDATA[30]]></mediaContainFormat>
				<mediaCodeRate><![CDATA[160]]></mediaCodeRate>
				<mediaNetType><![CDATA[03]]></mediaNetType>
				<mediaMimeType><![CDATA[03]]></mediaMimeType>
				<mediaResolution><![CDATA[11]]></mediaResolution>
				<mediaProfile><![CDATA[05]]></mediaProfile>
				<mediaLevel><![CDATA[14]]></mediaLevel>
				<mediaFilePath><![CDATA[/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977130_91.mp4]]></mediaFilePath>
				<mediaFilePreviewPath><![CDATA[]]></mediaFilePreviewPath>
				<mediaFileAction><![CDATA[0]]></mediaFileAction>
			</mediafile>
			<mediafile>
				<mediaFileID><![CDATA[5000977131]]></mediaFileID>
				<mediaFileName><![CDATA[5100066486_5000977131_92.mp4]]></mediaFileName>
				<sourceFileName><![CDATA[]]></sourceFileName>
				<visitPath><![CDATA[rtsp://172.16.10.205/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977131_92.mp4]]></visitPath>
				<mediaType><![CDATA[10]]></mediaType>
				<mediaSize><![CDATA[3218116441]]></mediaSize>
				<duration><![CDATA[6430]]></duration>
				<mediaUsageCode><![CDATA[92]]></mediaUsageCode>
				<mediaCodeFormat><![CDATA[30]]></mediaCodeFormat>
				<mediaContainFormat><![CDATA[30]]></mediaContainFormat>
				<mediaCodeRate><![CDATA[210]]></mediaCodeRate>
				<mediaNetType><![CDATA[03]]></mediaNetType>
				<mediaMimeType><![CDATA[03]]></mediaMimeType>
				<mediaResolution><![CDATA[13]]></mediaResolution>
				<mediaProfile><![CDATA[05]]></mediaProfile>
				<mediaLevel><![CDATA[14]]></mediaLevel>
				<mediaFilePath><![CDATA[/depository/asset/zhengshi/5100/066/486/5100066486/media/5100066486_5000977131_92.mp4]]></mediaFilePath>
				<mediaFilePreviewPath><![CDATA[]]></mediaFilePreviewPath>
				<mediaFileAction><![CDATA[0]]></mediaFileAction>
			</mediafile>
		</mediafiles>

		<!-- 图片文件 -->
		<displayFileLists>
        	<displayFile>
        		<dpFileID><![CDATA[1196927]]></dpFileID>
        		<dpFileName><![CDATA[11_JZ_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196928]]></dpFileID>
        		<dpFileName><![CDATA[12_JZ_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196929]]></dpFileID>
        		<dpFileName><![CDATA[13_JZ_sc.png]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196930]]></dpFileID>
        		<dpFileName><![CDATA[01_HB_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196931]]></dpFileID>
        		<dpFileName><![CDATA[14_HB_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1139095]]></dpFileID>
        		<dpFileName><![CDATA[e0b6954f053c24140edadd8a7c64581994005_H32_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[96]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1139096]]></dpFileID>
        		<dpFileName><![CDATA[f300df0f6a88f61262e6b9014a17537a2069821_V34_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[97]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1139097]]></dpFileID>
        		<dpFileName><![CDATA[f300df0f6a88f61262e6b9014a17537a2069821_V23_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[98]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1139098]]></dpFileID>
        		<dpFileName><![CDATA[893eaba3f52ff277d6babf611cfb52941374728_H53_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[0]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1139099]]></dpFileID>
        		<dpFileName><![CDATA[893eaba3f52ff277d6babf611cfb52941374728_H43_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[0]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1139100]]></dpFileID>
        		<dpFileName><![CDATA[893eaba3f52ff277d6babf611cfb52941374728_S11_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[0]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196918]]></dpFileID>
        		<dpFileName><![CDATA[02_JZ_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196919]]></dpFileID>
        		<dpFileName><![CDATA[03_JZ_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196920]]></dpFileID>
        		<dpFileName><![CDATA[04_JZ_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196921]]></dpFileID>
        		<dpFileName><![CDATA[05_JZ_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196922]]></dpFileID>
        		<dpFileName><![CDATA[06_JZ_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196923]]></dpFileID>
        		<dpFileName><![CDATA[07_JZ_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196924]]></dpFileID>
        		<dpFileName><![CDATA[08_JZ_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196925]]></dpFileID>
        		<dpFileName><![CDATA[09_JZ_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[1196926]]></dpFileID>
        		<dpFileName><![CDATA[10_JZ_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[00]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[11_JZ_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[11_JZ_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[11_JZ_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[11_JZ_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[11_JZ_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[11_JZ_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[11_JZ_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[11_JZ_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[11_JZ_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[11_JZ_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[12_JZ_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[12_JZ_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[12_JZ_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[12_JZ_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[12_JZ_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[12_JZ_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[12_JZ_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[12_JZ_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[12_JZ_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[12_JZ_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[01_HB_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[01_HB_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[01_HB_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[01_HB_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[01_HB_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[01_HB_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[01_HB_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[01_HB_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[01_HB_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[01_HB_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[14_HB_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[14_HB_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[14_HB_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[14_HB_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[14_HB_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[14_HB_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[14_HB_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[14_HB_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[14_HB_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[14_HB_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[699007_sc.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[96]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[699007_HSJ1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[96]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[699007_HSJ720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[96]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[TV_CONTENT.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[97]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[V_CONTENT.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[97]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[699007_HSJ1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[97]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[699007_HSJ720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[98]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[02_JZ_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[02_JZ_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[02_JZ_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[02_JZ_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[02_JZ_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[02_JZ_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[02_JZ_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[02_JZ_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[02_JZ_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[02_JZ_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[03_JZ_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[03_JZ_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[03_JZ_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[03_JZ_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[03_JZ_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[03_JZ_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[03_JZ_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[03_JZ_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[03_JZ_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[03_JZ_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[04_JZ_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[04_JZ_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[04_JZ_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[04_JZ_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[04_JZ_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[04_JZ_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[04_JZ_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[04_JZ_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[04_JZ_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[04_JZ_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[05_JZ_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[05_JZ_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[05_JZ_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[05_JZ_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[05_JZ_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[05_JZ_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[05_JZ_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[05_JZ_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[05_JZ_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[05_JZ_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[06_JZ_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[06_JZ_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[06_JZ_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[06_JZ_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[06_JZ_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[06_JZ_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[06_JZ_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[06_JZ_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[06_JZ_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[06_JZ_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[07_JZ_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[07_JZ_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[07_JZ_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[07_JZ_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[07_JZ_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[07_JZ_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[07_JZ_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[07_JZ_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[07_JZ_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[07_JZ_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[08_JZ_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[08_JZ_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[08_JZ_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[08_JZ_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[08_JZ_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[08_JZ_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[08_JZ_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[08_JZ_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[08_JZ_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[08_JZ_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[09_JZ_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[09_JZ_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[09_JZ_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[09_JZ_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[09_JZ_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[09_JZ_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[09_JZ_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[09_JZ_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[09_JZ_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[09_JZ_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[10_JZ_1080H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[10_JZ_1080V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[10_JZ_720H.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[10_JZ_720V.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[10_JZ_1080LF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[10_JZ_1080SF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[10_JZ_720DLF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[10_JZ_720DSF.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[10_JZ_1080Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
        	<displayFile>
        		<dpFileID><![CDATA[]]></dpFileID>
        		<dpFileName><![CDATA[10_JZ_720Y.jpg]]></dpFileName>
        		<dpFileDetail><![CDATA[00]]></dpFileDetail>
        		<dpFileType><![CDATA[03]]></dpFileType>
        		<dpUsageCode><![CDATA[99]]></dpUsageCode>
        		<dpUseType><![CDATA[00]]></dpUseType>
        		<dpAdapType><![CDATA[00]]></dpAdapType>
        		<pixel><![CDATA[]]></pixel>
        	</displayFile>
    	</displayFileLists>

		<!-- 内容展示类型属性 -->
		<propertyFileLists>
        	<propertyFile>
        		<propertyKey><![CDATA[豆瓣评分]]></propertyKey>
        		<propertyValue><![CDATA[6.0]]></propertyValue>
        		<propertyItem><![CDATA[6.0]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[外文名称]]></propertyKey>
        		<propertyValue><![CDATA[Lord of Shanghai]]></propertyValue>
        		<propertyItem><![CDATA[Lord of Shanghai]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[国内首映时间]]></propertyKey>
        		<propertyValue><![CDATA[2017-02-17]]></propertyValue>
        		<propertyItem><![CDATA[2017-02-17]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[主演]]></propertyKey>
        		<propertyValue><![CDATA[多布杰]]></propertyValue>
        		<propertyItem><![CDATA[11686]]></propertyItem>
        		<propertyShow><![CDATA[GeneralLu]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[主演]]></propertyKey>
        		<propertyValue><![CDATA[秦昊]]></propertyValue>
        		<propertyItem><![CDATA[84944]]></propertyItem>
        		<propertyShow><![CDATA[黄佩玉]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[主演]]></propertyKey>
        		<propertyValue><![CDATA[胡军]]></propertyValue>
        		<propertyItem><![CDATA[9965]]></propertyItem>
        		<propertyShow><![CDATA[常力雄]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[主演]]></propertyKey>
        		<propertyValue><![CDATA[余男]]></propertyValue>
        		<propertyItem><![CDATA[4721]]></propertyItem>
        		<propertyShow><![CDATA[筱月桂]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[所属片名]]></propertyKey>
        		<propertyValue><![CDATA[上海王]]></propertyValue>
        		<propertyItem><![CDATA[上海王]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[导演]]></propertyKey>
        		<propertyValue><![CDATA[胡雪桦]]></propertyValue>
        		<propertyItem><![CDATA[89936]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[上映时间]]></propertyKey>
        		<propertyValue><![CDATA[2017-02-17]]></propertyValue>
        		<propertyItem><![CDATA[2017-02-17]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[编剧]]></propertyKey>
        		<propertyValue><![CDATA[胡雪桦]]></propertyValue>
        		<propertyItem><![CDATA[89936]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[评分]]></propertyKey>
        		<propertyValue><![CDATA[6.0]]></propertyValue>
        		<propertyItem><![CDATA[6.0]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[内容类型]]></propertyKey>
        		<propertyValue><![CDATA[剧情]]></propertyValue>
        		<propertyItem><![CDATA[11268]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[播出年代]]></propertyKey>
        		<propertyValue><![CDATA[2017]]></propertyValue>
        		<propertyItem><![CDATA[2017]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[电影形式]]></propertyKey>
        		<propertyValue><![CDATA[长片]]></propertyValue>
        		<propertyItem><![CDATA[11449]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[内容形态]]></propertyKey>
        		<propertyValue><![CDATA[全片]]></propertyValue>
        		<propertyItem><![CDATA[]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[字幕语言]]></propertyKey>
        		<propertyValue><![CDATA[简体中文]]></propertyValue>
        		<propertyItem><![CDATA[]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[字幕语言]]></propertyKey>
        		<propertyValue><![CDATA[英文]]></propertyValue>
        		<propertyItem><![CDATA[]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[语言]]></propertyKey>
        		<propertyValue><![CDATA[国语]]></propertyValue>
        		<propertyItem><![CDATA[]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[国家及地区]]></propertyKey>
        		<propertyValue><![CDATA[内地]]></propertyValue>
        		<propertyItem><![CDATA[]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
        	<propertyFile>
        		<propertyKey><![CDATA[播出平台]]></propertyKey>
        		<propertyValue><![CDATA[院线]]></propertyValue>
        		<propertyItem><![CDATA[]]></propertyItem>
        		<propertyShow><![CDATA[]]></propertyShow>
        	</propertyFile>
    	</propertyFileLists>
    	
    	<!--运营参数信息-->
		<BarrageActivity>
				<filmId><![CDATA[]]></filmId>
				<activityId><![CDATA[]]></activityId>
				<activityName><![CDATA[]]></activityName>
				<barrageFlag><![CDATA[2]]></barrageFlag>
		</BarrageActivity>
	</fields>

</content>';
        $p = xml_parser_create();
        xml_parse_into_struct($p, $xm, $values, $tags);
        xml_parser_free($p);
        if(!empty($tags)){
//            echo '|0';
        }else{
//            echo '|1';
        }
        $res = array();
        foreach($tags as $k => $v){
            foreach($v as $n){
                $res[] = $values[$n];
            }
        }
//        print_r($res);die
//        var_dump($res);die;
        $reset = array();
        $option = 0;
        foreach($res as $u=>$s){
            if($s['tag'] == 'ADI:OPENGROUPASSET') $option = 1;
            if($s['tag'] == 'ADI:DROPGROUPASSET') $option = 2;
            if($s['tag'] == 'ADI:REPLACEGROUPASSET') $option = 3;
            $title = str_replace('VOD:','',$s['tag']);
//            print_r($title);die;
            if(strtolower($title) == 'shortname'){  //video->title
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'detail'){     //video->info
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'begindate'){  //video->startDateTime
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'enddate'){    //video->endDateTime
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'keywordname'){    //video->keyword
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'cpid'){     //video->cp   播放链接spid
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'recommendation'){
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'displayname'){    //video->type
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'assetid'){    //videoList->assetid;播放链接assertID
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'contid'){     //videoList->contid    播放链接ProgramID
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'product_id'){//videoList->product_id
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'prdpack_id'){ //videoList->prdpack_id
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'mms_id'){     //video->vid;播放链接sid
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }
            if(strtolower($title) == 'serialcontentid'){     //videoList->serialcontentid;
                if(empty($reset[$title])){
                    $reset[strtolower($title)]=$s['value'];
                }
            }

            //视频文件
            if(strtolower($title) == 'mediafileid') {
                if (!empty($s['value'])) {
                    $reset['mediafile'][$this->getKey($reset, 'mediafileid', 'mediafile')]['mediafileid'] = $s['value'];
                }
            }
            if(strtolower($title) == 'visitpath'){
                if(!empty($s['value'])){
                    $reset['mediafile'][$this->getKey($reset,'visitpath','mediafile')]['visitpath']=$s['value'];
                }
            }
            if(strtolower($title) == 'mediafilepath'){
                if(!empty($s['value'])){
                    $reset['mediafile'][$this->getKey($reset,'mediafilepath','mediafile')]['mediafilepath']=$s['value'];
                }
            }
            if(strtolower($title) == 'mediasize'){  //videoList->size;
                if(empty($reset['value'])){
                    $reset['mediafile'][$this->getKey($reset,'mediasize','mediafile')]['mediasize']=$s['value'];
                }
            }
            if(strtolower($title) == 'mediacoderate'){  //videoList->bitrate;视频码率
                if(empty($reset['value'])){
                    $reset['mediafile'][$this->getKey($reset,'mediacoderate','mediafile')]['mediacoderate']=$s['value'];
                }
            }
            if(strtolower($title) == 'duration'){  //videoList->bitrate;视频码率
                if(empty($reset['value'])){
                    $reset['mediafile'][$this->getKey($reset,'duration','mediafile')]['duration']=$s['value'];
                }
            }


            //图片
            if(strtolower($title) == 'dpfileid'){  //videoList->dpfileid;
                if(empty($reset['value'])){
                    $reset['displayfile'][$this->getKey($reset,'dpfileid','displayfile')]['dpfileid']=$s['value'];
                }
            }
            if(strtolower($title) == 'dpfilename'){  //videoList->dpfilename;
                if(empty($reset['value'])){
                    $reset['displayfile'][$this->getKey($reset,'dpfilename','displayfile')]['dpfilename']=$s['value'];
                }
            }
            if(strtolower($title) == 'dpfiledetail'){  //videoList->dpfilename;
                if(empty($reset['value'])){
                    $reset['displayfile'][$this->getKey($reset,'dpfiledetail','displayfile')]['dpfiledetail']=$s['value'];
                }
            }
            if(strtolower($title) == 'dpfiletype'){  //videoList->dpfilename;
                if(empty($reset['value'])){
                    $reset['displayfile'][$this->getKey($reset,'dpfiletype','displayfile')]['dpfiletype']=$s['value'];
                }
            }
            if(strtolower($title) == 'dpusagecode'){  //videoList->dpfilename;
                if(empty($reset['value'])){
                    $reset['displayfile'][$this->getKey($reset,'dpusagecode','displayfile')]['dpusagecode']=$s['value'];
                }
            }
            if(strtolower($title) == 'dpusetype'){  //videoList->dpfilename;
                if(empty($reset['value'])){
                    $reset['displayfile'][$this->getKey($reset,'dpusetype','displayfile')]['dpusetype']=$s['value'];
                }
            }



            if(strtolower($title) == 'propertykey'){  //videoList->dpfilename;
                if(empty($reset['value'])){
                    $reset['propertyfile'][$this->getKey($reset,'propertykey','propertyfile')]['propertykey']=$s['value'];
                }
            }

            if(strtolower($title) == 'propertyvalue'){  //videoList->dpfilename;
                if(empty($reset['value'])){
                    $reset['propertyfile'][$this->getKeyTwo($reset,'propertyvalue','propertyfile')]['propertyvalue']=$s['value'];
                }
            }


        }
        if(!empty($reset['propertyfile'])){
            foreach($reset['propertyfile'] as $a=>$b){
                if($b['propertykey'] == '主演'){
                    $actor[] = $b['propertyvalue'];
                }
                if($b['propertykey'] == '评分'){
                    $score = $b['propertyvalue'];
                }
                if($b['propertykey'] == '导演'){
                    $director = $b['propertyvalue'];
                }
                if($b['propertykey'] == '国家及地区'){
                    $CountryOfOrigin = $b['propertyvalue'];
                }
                if($b['propertykey'] == '语言'){
                    $language = $b['propertyvalue'];
                }
                if($b['propertykey'] == '播出年代'){
                    $year = $b['propertyvalue'];
                }
                if($b['propertykey'] == '内容类型'){
                    $cate = $b['propertyvalue'];
                }
            }
            if(!empty($actor)){
                $actor = implode(',',$actor);
            }
        }

        if(!empty($reset['mms_id']) && !empty($reset['displayfile'])){
            $mss_id = $reset['mms_id'];
            $this->getGwDataImg($mss_id,$reset['displayfile']);
        }
        die;
        //var_dump($reset);//die;
        if(!empty($reset['shortname'])){
            $pin = new PinYin();
            $initial = $pin->encode($reset['shortname']);
            //var_dump($reset);
            $video = new Video();
            $pa = "/^(?!\D+$)(?![^a-z]+$)[a-zA-Z\d]{6,}$/";
            preg_match($pa, $reset['mms_id'], $match);
            /*if(!empty($match)){
                $response="<?xml version='1.0' encoding='utf-8'?>
	            <SyncContentsResult serialNo='{$reset['serialNo']}' TimeStamp=''>
	                <Assets>
		                <Asset ID='{$reset['vid']}' type='{$reset['showtype']}' op='{$option}' result='1' desc=''>
		                </Asset>
	                </Assets>
                </SyncContentsResult>";
                echo $response;
                return true;
            }*/
            $video->vid     = $reset['mms_id'];
            $video->cp      = $reset['cpid'];
            $video->title   = $reset['shortname'];
            $video->initial = strtoupper($initial);
            $video->keyword = empty($reset['keywordname'])?'':$reset['keywordname'];
            $video->info    = empty($reset['detail'])?'null':$reset['detail'];
            $video->short   = empty($reset['detail'])?'':$reset['detail'];
            $video->type    = empty($reset['displayname'])?'n':$reset['displayname'];
            $video->actor   = !isset($actor) ? '' :$actor;
            $video->score   = !isset($score) ? '' :$score;
            $video->director = !isset($director) ? '' :$director;
            $video->language = !isset($language) ? '' :$language;
            $video->year    = !isset($year) ? '' :$year;
            $video->cate    = !isset($cate) ? $reset['recommendation'] :$cate;
            $video->CountryOfOrigin = '100';
            $video->region = !isset($CountryOfOrigin) ? '' :$CountryOfOrigin;
            $video->bitrate = empty($reset['bitrate'])?'':$reset['bitrate'];
            $video->duration = empty($reset['duration'])?'':$reset['duration'];
            $video->ShowType = empty($reset['showtype'])?'0':$reset['showtype'];
            $video->targetgroupassetid= '0';
            $video->IsAdvertise = empty($reset['isadvertise'])?'0':$reset['isadvertise'];
            $video->startDateTime= empty($reset['begindate'])?'0':$reset['begindate'];
            $video->endDateTime = empty($reset['enddate'])?'0':$reset['enddate'];
            $video->cTime   = $time;
            $video->upTime  = '0';
            $video->gwFlag  = '1';
            //var_dump($video);die;
            /*if(!$video->save()){
                var_dump($video->getErrors());
                LogWriter::logModelSaveError($video,__METHOD__,$video->attributes);
                //throw new ExceptionEx('信息保存失败');
            }else{
                $response="<?xml version='1.0' encoding='utf-8'?>
	            <SyncContentsResult serialNo='{$reset['serialNo']}' TimeStamp=''>
	                <Assets>
		                <Asset ID='{$reset['vid']}' currentID='{}' type='{$reset['showtype']}' op='{$option}' result='0' desc=''>
		                </Asset>
	                </Assets>
                </SyncContentsResult>";
                echo $response;

            }*/
            /*if(!empty($reset['image'])){
                foreach($reset['image'] as $vpic){
                    $pic = new VideoPic();
                    $pic->vid = $reset['vid'];
                    $pic->cp = $reset['cp'];
                    $pic->title = $vpic['title'];
                    $pic->size = $vpic['size'];
                    $pic->md5 = !empty($vpic['md5'])?$vpic['md5']:'1';
                    $pic->url = $vpic['url'];
                    $pic->cTime = $time;
                    if(!$pic->save()){
                        var_dump($pic->getErrors());
                        LogWriter::logModelSaveError($pic,__METHOD__,$pic->attributes);
                        //throw new ExceptionEx('信息保存失败');
                    }
                }
            }*/
            if(!empty($reset['mediafile'])){
                foreach($reset['mediafile'] as $vlist){
                    $list = new VideoList();
                    $list->vid = $reset['mms_id'];
                    $list->cp = $reset['cpid'];
                    $list->title = $reset['shortname'];
                    $list->size = '0';
                    //$list->md5 = !empty($vlist['md5'])?$vlist['md5']:'1';
                    $list->md5 = '1';
                    $list->url = '';
                    $list->assetId =$reset['assetid'];
                    $list->HDFlag ='';
                    $list->videocodec='';
                    $list->filesize     =!empty($vlist['mediasize'])?$vlist['mediasize']:'0';
                    $list->visitpath    =!empty($vlist['visitpath'])?$vlist['visitpath']:'0';
                    $list->mediafilepath=!empty($vlist['mediafilepath'])?$vlist['mediafilepath']:'0';
                    $list->mediacoderate=!empty($vlist['mediacoderate'])?$vlist['mediacoderate']:'0';
                    $list->contid       =!empty($reset['contid'])?$reset['contid']:'0';
                    $list->product_id   =!empty($vlist['product_id'])?$vlist['product_id']:'0';
                    $list->prdpack_id   =!empty($vlist['prdpack_id'])?$vlist['prdpack_id']:'0';
                    $list->duration     =!empty($vlist['duration'])?$vlist['duration']:'0';
                    $list->serialcontentid=!empty($vlist['serialcontentid'])?$vlist['serialcontentid']:'0';
                    $list->cTime        = $time;
                    /*if(!$list->save()){
                        var_dump($list->getErrors());
                        LogWriter::logModelSaveError($list,__METHOD__,$list->attributes);
                        //throw new ExceptionEx('信息保存失败');
                    }*/
                }
            }
        }
    }

   public function getKey($reset,$name,$parent){
        if(!empty($reset[$parent])){
            $num=0;
            foreach($reset[$parent] as $k=>$v){
                if(!empty($v[$name])){
                    $num=$k+1;
                }
            }
            return $num;
        }else{
            return $num=0;
        }
    }

    public function getKeyTwo($reset,$name,$parent){
        if(!empty($reset[$parent])){
            $num=0;
            foreach($reset[$parent] as $k=>$v){
                if(!empty($v[$name])){
                    $num=$k+1;
                }
            }
            return $num;
        }else{
            return $num=0;
        }
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
            }
        }
    }

    public function actionCopyScreenContent()
    {
	
        $sid = $_REQUEST['sid'];
        $copySid = $_REQUEST['copySid'];
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

    public function actionTestRow()
    {
	 //$sql2 = "select id from yd_ver_screen_content where screenGuideid=110 and `order`=3";
         //   $sid = SQLManager::queryRow($sql2);
	//var_dump($sid['id']);die;
	echo '1';
    }
    public function actionHnLog(){//河南专题编排日志
	include('BILogConfig.php');
        $spid=80000000;
	$sql="select * from yd_special_topic";
        $result=SQLManager::queryAll($sql);
	$vidlist=array();
	for($i=0;$i<count($result);$i++){
            if($result[$i]['tType']==1){//自有节目
                $arr=$result[$i]['cid'];//内容id	
		$stationname=$this->Getpid($result[$i]['sid']);//顶级分类名称
		$vidlist[]=array($arr,$stationname,$result[$i]['sid']);
            }
        }
	//var_dump($vidlist);die;
        for($j=0;$j<count($vidlist);$j++){
	    if(!empty($vidlist[$j][0])){
            $sql1="select * from yd_video where vid={$vidlist[$j][0]}";
            $tmp=SQLManager::queryAll($sql1);
	    $data[]=array("video"=>$tmp,"stationname"=>$vidlist[$j][1]);
	    //$sql2="select * from yd_ver_station where name=";
	    }
        }
	//var_dump($data);die;
	if(!empty($data)){
            for($k=0;$k<count($data);$k++){
		//if(count($data[$k]['video'])!==0)
		if(!empty($data[$k]['video'][0])){
		//$sql="select id from yd_var_station where name={$data[$k]['stationname']}";
		//$res=SQLMaanager::queryRow($sql);
		//var_dump($data);die;
                switch($data[$k]['video'][0]['cp']){
                    case '642001':$cp ='699211';break;
                    case 'BESTVOTT':$cp ='699212';break;
                    case 'ICNTV':$cp ='699213';break;
                    case 'youpeng':$cp ='699214';break;
                    case 'HNBB':$cp ='699215';break;
                    case 'CIBN':$cp ='699216';break;
                    case 'YGYH':$cp ='699217';break;
                }
                $str = $spid . '|' .$data[$k]['video']['0']['vid']. '|' .'7' .'|' . $data[$k]['video'][0]['title'] .'|' .$data[$k]['video'][0]['id'] .'|'.'7'.'|'.''.'|'.'1'.'|'.$cp .'|' .$data[$k]['stationname']['id'] . '|' .$data[$k]['stationname']['name'];
                $fileName = date("Ymd",strtotime("0 day"));
                $fileName='/opt/modules/nginx/html/web/data/henan/80000000-10003-'.SERVER_LOCAL.'-'.SERVER_ID.'-'.$fileName.'.dat';
                //判断文件是否存在 如果不存在就创建
                if(!file_exists($fileName)) {
                    $file = fopen("$fileName",'a+');
                    fwrite($file,$str."\r\n");
                    fclose($file);
                }else{
                    $file = fopen("$fileName",'a+');
                    fwrite($file,$str."\r\n");
                    fclose($file);
                }
                }
            }
        }
        }

	public function GetPid($sid){	
	    $sql="select * from yd_ver_sitelist where id=$sid";
            $result=SQLManager::queryRow($sql);
	    //return $sql;
	    if(empty($result)){
		return false;
            }elseif(!empty($result)&&intval($result['pid'])!=0){	
               	return $this->GetPid(intval($result['pid']));	
	    }else{
		return $result;
		//var_dump($result);
	    }
   	}
}
