<?php
class TopController extends VController
{
    public function actionIndex()
    {
        $gid = $_REQUEST['nid'];
        $sql = "select position from yd_ver_ui where gid=$gid GROUP BY position";
        $res = SQLManager::queryAll($sql);
        $tmp = array();
        foreach ($res as $k=>$v){
	    if($v['position'] != 'appTop'){	
            $sql2 = "select pic,title,id,position from yd_ver_ui where gid=$gid and `delFlag`=0 and position != 'appTop' AND position=".$v['position']." order by `scort` asc";
            $arr = SQLManager::queryAll($sql2);
            $tmp[] = $arr;
	    }	
        }
        $sql3 = "select pic,title,id ,position from yd_ver_ui where gid=$gid and `delFlag`=0 and position='appTop' ORDER BY `scort` asc";
        $list = SQLManager::queryAll($sql3);
        if(!empty($list)){
            $this->render('index',array('list'=>$tmp,'res'=>$list));
        }else{
            $this->render('index',array('list'=>$tmp));
        }

    }

    public function actionRankingAddView()
    {
        $gid = $_REQUEST['nid'];
        $sql = "select position from yd_ver_ui where gid = $gid AND `delFlag`=0 order by `position` DESC limit 1 ";
        $res = SQLManager::queryAll($sql);
        $sql2 = "select count(*) from yd_ver_ui where gid=$gid AND `delFlag`=0";
        $res2 = SQLManager::queryAll($sql2);
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
	//var_dump($_POST);die;
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

}
