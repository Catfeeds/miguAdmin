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
            );
            if(empty($_REQUEST['epg']) || empty($_REQUEST['cp']) || empty($_REQUEST['pro']) || empty($_REQUEST['city'])) $err = 1;
            
            if($err==0){
                $epg = trim($_REQUEST['epg']);
                $cp = trim($_REQUEST['cp']);
                $pro = trim($_REQUEST['pro']);
                $city = trim($_REQUEST['city']);
            
//                if($epg==5){
//                    $criteria = new CDbCriteria();          
//                    $criteria->select = 'pos,title,pic,url,type';
//                    $criteria->condition = 'epg=:epg and cp=:cp and province=:province and city=:city and delFlag=0';
//                    $criteria->params = array(':epg'=>$epg,':cp'=>$cp,':province'=>$pro,':city'=>$city);
//                    $criteria->order = 'pos asc,cTime asc';
//                    $tmp = Epg::model()->findAll($criteria);
//                    if(empty($tmp)){
//                        $criteria->condition = 'epg=:epg and cp=:cp and province=:province and city=0 and delFlag=0';
//                        $criteria->params = array(':epg'=>$epg,':cp'=>$cp,':province'=>$pro);
//                        $tmp = Epg::model()->findAll($criteria);
//                        if(empty($tmp)){
//                            $criteria->condition = 'epg=:epg and cp=:cp and province=0 and city=0 and delFlag=0';
//                            $criteria->params = array(':epg'=>$epg,':cp'=>$cp);
//                            $tmp = Epg::model()->findAll($criteria);
//                        }
//                    }
//                    if(!empty($tmp)){
//                        foreach ($tmp as $tt){
//                            $p = $tt['pos'];
//                            $tmp2 = array();
//                            if(empty($list[$p])){
//                                $tmp2[] = array('title'=>$tt['title'],'pic'=>$tt['pic'],'url'=>$tt['url']);
//                                $list[$p] = array('type'=>$tt['type'],'info'=>$tmp2);
//                            }else{
//                                $tmp2 = $list[$p]['info'];
//                                $tmp2[] = array('title'=>$tt['title'],'pic'=>$tt['pic'],'url'=>$tt['url']);
//                                $list[$p]['info'] = $tmp2;
//                            }
//                        }
//                    }else{
//                        $err = 1;
//                    }
//                }else{
                    $type = $map1[$epg];
                    $criteria = new CDbCriteria();          
                    $criteria->select = 'position,title,bigImg,url,tType';
                    $criteria->condition = 'type=:type and cp=:cp and provinceCode=:province and cityCode=:city and delFlag=0';
                    $criteria->params = array(':type'=>$type,':cp'=>$cp,':province'=>$pro,':city'=>$city);
                    $criteria->order = 'position asc,addTime asc';
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
                                $tmp2[] = array('title'=>$tt['title'],'pic'=>$tt['bigImg'],'url'=>$tt['url']);
                                $tmp_tmp[$pos] = array('type'=>$tt['tType'],'info'=>$tmp2);
                            }else{
                                $tmp2 = $tmp_tmp[$pos]['info'];
                                $tmp2[] = array('title'=>$tt['title'],'pic'=>$tt['bigImg'],'url'=>$tt['url']);
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
//            }
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

}
