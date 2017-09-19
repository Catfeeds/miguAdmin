<?php

/**
 * Created by PhpStorm.
 * User: xzm
 * Date: 2015/12/28
 * Time: 14:41
 */
class ContentDataManager extends Video{


    public static function getData($data,$list){
        $res = array();
        $sql_select = "select v.id,v.vid,v.cp,v.title,v.language,v.type,v.prdpack_id,c.cTime,c.flag from yd_ver_content c inner join yd_video v on v.vid=c.vid ";
        $sql_order = ' order by c.cTime desc';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $sql_where = " ";
        if(!empty($list['type'])){
            $sql_where .=" and v.type like '%{$list['type']}%'";
        }
        if(!empty($list['cp'])){
            $sql_where .=" and v.cp='".$list['cp']."' ";
        }
        if(!empty($list['title'])){
            $sql_where .=" and v.title like '%".$list['title']."%' ";
        }
        if(!empty($list['first'])){
            $sql_where .=" and c.cTime >{$list['first']}";
        }
        if(!empty($list['end'])){
            $sql_where .=" and c.cTime <{$list['end']}";
        }
        if(isset($list['flag'])){
            $sql_where .=" and c.flag ={$list['flag']}";
        }
	if(!empty($list['isfree'])){
	    $sql_where .=" and v.prdpack_id = {$list['isfree']}";
	}
        $sql_count = " select count(c.id) from yd_ver_content c inner join yd_video v on v.vid=c.vid";
        //$sql_count = " select count(c.id) from yd_ver_content c ";
        $count = $sql_count .$sql_where ;
        $sql_online = " where c.flag=0";
        $sql_offline = " where c.flag=1";
        $online = $count .  $sql_online;
        $offline = $count .  $sql_offline;
        $list = $sql_select . $sql_where . $sql_order . $sql_limit;
        //$list = $sql_select . $sql_where  . $sql_limit;
        $res['list'] = SQLManager::queryAll($list);
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();
        $res['online'] = Yii::app()->db->createCommand($online)->queryScalar();
        $res['offline'] = Yii::app()->db->createCommand($offline)->queryScalar();
	$alwaysCount = $sql_count ;
        $res['alwaysCount'] = Yii::app()->db->createCommand($alwaysCount)->queryScalar();
        return $res;
    }


}
