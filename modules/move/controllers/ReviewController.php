<?php

/**
 * Created by PhpStorm.
 * User: xiangl
 * Date: 2015/8/19 0019
 * Time: 11:48
 */
class ReviewController extends MController{
    public function actionIndex(){
        //$list = MvCoui::model()->findAll("delFlag not in(0)");
        $user = $_REQUEST['pro'];
        $list = MvCoseuiManager::getReview($user);
        $aclist = MvCoseuiManager::getAcreview($user);
        $nolist = MvCoseuiManager::getNoreview($user);
        $this->render('index',array('list'=>$list,'aclist'=>$aclist,'nolist'=>$nolist));
    }

    public function actionSubmit(){
        $cid = $_REQUEST['cid'];
        if(!empty($cid)){
            $res = MvCoseui::model()->updateAll(array('flag'=>2),'cid=:cid and flag=:flag',array(':cid'=>$cid,':flag'=>1));
            $result = MvCoseui::model()->updateAll(array('flag'=>6),'cid=:cid and flag=:flag',array(':cid'=>$cid,':flag'=>5));
            $coui = MvCoseui::model()->findAll("cid=$cid and flag=2");
            Yii::app()->db->createCommand()->delete('{{mv_seui}}', "cid=$cid");
            foreach($coui as $k=>$v){
                $ui = new MvSeui();
                $ui->title =$v->attributes['title'];
                $ui->type =$v->attributes['type'];
                $ui->tType =$v->attributes['tType'];
                $ui->param =$v->attributes['param'];
                $ui->action =$v->attributes['action'];
                $ui->pic =$v->attributes['pic'];
                $ui->cp =$v->attributes['cp'];
                $ui->pos =$v->attributes['pos'];
                $ui->upTime =$v->attributes['upTime'];
                $ui->cid =$v->attributes['cid'];
                $ui->save();
            }
            if(!$res && !$result){
                echo json_encode(array('code'=>404,'msg'=>'审核失败'));
            }else{
                echo json_encode(array('code'=>200,'msg'=>'审核通过'));
            }
        }

    }

    public function actionNoaccess(){
        $cid = $_REQUEST['cid'];
        //echo 200;die;
        //$message = $_REQUEST['message'];
        if(!empty($cid)){
            $res = MvCoseui::model()->updateAll(array('flag'=>3),'cid=:cid and flag=:flag',array(':cid'=>$cid,':flag'=>1));
            $result = MvCoseui::model()->updateAll(array('flag'=>7),'cid=:cid and flag=:flag',array(':cid'=>$cid,':flag'=>5));
        }
        if(!$res && !$result){
            echo json_encode(array('code'=>404,'msg'=>'驳回失败'));
        }else{
            echo json_encode(array('code'=>200,'msg'=>'驳回成功'));
        }
    }

    public function actionAllPost(){
        if(empty($_REQUEST['cid'])) $this->die_json(array('code'=>404,'msg'=>'参数不能为空'));
        $arr=explode(' ',trim($_REQUEST['cid']));
        $arr = array_unique($arr);
        //var_dump($arr);die;
        foreach($arr as $key=>$val){

                $res = MvCoseui::model()->updateAll(array('flag'=>2),'cid=:cid and flag=:flag',array(':cid'=>$val,':flag'=>1));

                $result = MvCoseui::model()->updateAll(array('flag'=>6),'cid=:cid and flag=:flag',array(':cid'=>$val,':flag'=>5));

        }
        foreach($arr as $key=>$val){
            $coui = MvCoseui::model()->findAll("cid=$val and flag=2");
            Yii::app()->db->createCommand()->delete('{{mv_seui}}', "cid=$val");
            foreach($coui as $k=>$v){
                $ui = new MvSeui();
                $ui->title =$v->attributes['title'];
                $ui->type =$v->attributes['type'];
                $ui->tType =$v->attributes['tType'];
                $ui->param =$v->attributes['param'];
                $ui->action =$v->attributes['action'];
                $ui->pic =$v->attributes['pic'];
                $ui->cp =$v->attributes['cp'];
                $ui->pos =$v->attributes['pos'];
                $ui->upTime =$v->attributes['upTime'];
                $ui->cid =$v->attributes['cid'];
                $ui->save();
            }
        }

        if(!$res){
            echo json_encode(array('code'=>404,'msg'=>'审核失败'));
        }else{
            echo json_encode(array('code'=>200,'msg'=>'审核通过'));
        }
    }

    /*public function actionRelease(){
        $gid =$_REQUEST['gid'];
        $resulst = MvCoui::model()->updateAll(array('delFlag'=>3),'gid=:gid and delFlag=:delFlag',array(':gid'=>$gid,':delFlag'=>2));
        $resulst = MvCoui::model()->updateAll(array('flag'=>0),'gid=:gid',array(':gid'=>$gid));
        $coui = MvCoui::model()->findAll("gid=$gid and delFlag not in(4,5,6,7)");
        Yii::app()->db->createCommand()->delete('{{mv_ui}}', "gid=$gid");
        foreach($coui as $k=>$v){
            $ui = new MvUi();
            $ui->title =$v->attributes['title'];
            $ui->type =$v->attributes['type'];
            $ui->tType =$v->attributes['tType'];
            $ui->param =$v->attributes['param'];
            $ui->action =$v->attributes['action'];
            $ui->pic =$v->attributes['pic'];
            $ui->cp =$v->attributes['cp'];
            $ui->epg =$v->attributes['epg'];
            $ui->position =$v->attributes['position'];
            $ui->upTime =$v->attributes['upTime'];
            $ui->gid =$v->attributes['gid'];
            if(!$ui->save()){
                LogWriter::logModelSaveError($ui,__METHOD__,$ui->attributes);
                var_dump($ui->getErrors());
                $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
            }
        }
    }

    public function actionFlag(){
        $gid =$_REQUEST['gid'];
        $user = $_REQUEST['user'];
        $resulst = MvCoui::model()->updateAll(array('flag'=>1),'gid=:gid',array(':gid'=>$gid));
        $res = MvCoui::model()->updateAll(array('user'=>$user),'gid=:gid and delFlag=:delFlag',array(':gid'=>$gid,':delFlag'=>1));
    }*/
}
