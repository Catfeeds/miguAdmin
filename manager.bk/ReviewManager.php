<?php

/**
 * Created by PhpStorm.
 * User: xzm
 * Date: 2015/12/28
 * Time: 14:41
 */
class ReviewManager extends VerScreenContent{

    public static function getData($flag){
        $res = array();
        $sql="select p.*,g.title as gtitle,s.name from yd_ver_screen_content_log p inner join yd_ver_screen_guide g on p.screenGuideid=g.id and p.delFlag=$flag inner join yd_ver_station s on s.id=g.gid order by addTime desc";
        //echo $sql;
        $res = SQLManager::queryAll($sql);
        //var_dump($res);
        return $res;
    }
    public static function getList($vid){
        $res = array();
        $sql="select * from yd_video v inner join yd_ver_reject r on v.vid=r.vid and v.vid='$vid'";
        $res=SQLManager::queryRow($sql);
        return $res;
    }

    public static function getLog($flag){
        $res = array();
        $sql="select v.* from yd_ver_reject_log l inner join yd_video v on l.flag = '$flag' and v.vid=l.vid";
        $res = SQLManager::queryAll($sql);
        return $res;
    }

    public static function getContentLog($data,$flag,$list){
        $res = array();
        $sql="select v.* from yd_ver_reject_log l inner join yd_video v on ";
        $sql_where =" l.flag = '$flag' and v.vid=l.vid";
        if(!empty($list['type'])){
            $sql_where .= " and v.type like '%{$list['type']}%'";
        }
        if(!empty($list['title'])){
            $sql_where .= " and v.title like '%{$list['title']}%'";
        }
        if(!empty($list['first'])){
            $sql_where .=" and v.upTime > '{$list['first']}'";
        }
        if(!empty($list['end'])){
            $sql_where .=" and v.upTime < '{$list['end']}'";
        }
        if(!empty($list['cp'])){
            $sql_where .=" and (";
            foreach($list['cp'] as $k=>$v){
               if($k=='0'){
                   $sql_where .=" v.cp='$v'";
               }else{
                   $sql_where .=" or v.cp='$v'";
               }
            }
            $sql_where .=" )";
        }
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $sql=$sql . $sql_where . $sql_limit;
        $sql_count = "select count(l.id) from yd_ver_reject_log l inner join yd_video v on ";
        $count = $sql_count . $sql_where;
        $res['list'] = SQLManager::queryAll($sql);
        $res['count']=Yii::app()->db->createCommand($count)->queryScalar();
        $sql_alawayscount = "select count(l.id) from yd_ver_reject_log l inner join yd_video v on v.vid=l.vid";
        $alwaysCount=Yii::app()->db->createCommand($sql_alawayscount)->queryScalar();
        $sql_video = "select count(id) from yd_video where flag in (1,2,3,4,5)";
        $video = Yii::app()->db->createCommand($sql_video)->queryScalar();
        $res['alwaysCount']=$alwaysCount+$video;
        return $res;
    }


    public static function getAll(){
        $res = array();
        $sql="select * from yd_video where flag=";

    }
}
