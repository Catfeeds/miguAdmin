<?php

/**
 * Created by PhpStorm.
 * User: xzm
 * Date: 2015/12/28
 * Time: 14:41
 */
class VerContentManager extends VerContent{



    public static function getData($data,$list){
        $res = array();
        $sql = "select c.id as cid,c.status as vstatus,c.flag as vflag,c.cTime as vTime,v.* from yd_ver_content c,yd_video v where c.vid=v.id and c.delFlag=0";
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $list = $sql . $sql_limit;
        $count = "select count(id) from yd_ver_content";
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();
        $res['list'] = SQLManager::queryAll($sql);
        //var_dump($res['list']);die;
        return $res;
    }


    public static function getList($data){
        $res = array();
        $sql_select = "select * from yd_ver_epg";
        $sql_count = "select count(*) from yd_ver_epg";
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $sql = $sql_select . $sql_limit;
        $res['list'] = SQLManager::queryAll($sql);
        $res['count'] = Yii::app()->db->createCommand($sql_count)->queryScalar();
        return $res;
    }






}
