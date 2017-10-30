<?php

class MessageManager extends Message{
    public static function getList($data,$list){
        $res = array();
        $sql_count = 'select count(id)';
        $sql_select = 'select *';
        $sql_from = ' from yd_ver_message ';
        $sql_order = ' order by cTime desc';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        if(!empty($list['title'])){
            $sql_where =" title like '%".$list['title']."%' ";
        }
        $count = $sql_count . $sql_from ;
        $list = $sql_select . $sql_from . $sql_order . $sql_limit;
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();


        $res['list'] = SQLManager::queryAll($list);
        return $res;
    }

    public static function getMsgList($data,$list){
        $res = array();
        $sql_count = 'select count(m.id)';
        $sql_select = 'select m.*,s.name';
        $sql_from = ' from yd_ver_message m inner join yd_ver_station s';
        //$sql_order = ' order by cTime desc';
        $sql_order = ' order by id desc';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $sql_where = ' on m.gid=s.id ';
        if(!empty($list['title'])){
            $sql_where .=" and m.info like '%".$list['title']."%' ";
        }
	if(!empty($list['stationId'])){
            $sql_where .=" and s.id = ".$list['stationId']." ";
        }
	if(!empty($list['uid'])){
            $sql_where .=" and s.id in (".$list['uid'].")";
        }

        $sql_group = " group by m.id";
        $count = $sql_count . $sql_from . $sql_where .$sql_group;
        $list = $sql_select . $sql_from . $sql_where . $sql_group . $sql_order . $sql_limit;
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();
        $res['list'] = SQLManager::queryAll($list);
	$sql_group = " group by m.id";
        $sql_where = ' on m.gid=s.id ';
        $alwaysCount = $sql_count . $sql_from . $sql_group;
        $res['alwaysCount'] = Yii::app()->db->createCommand($alwaysCount)->queryScalar();
        return $res;
    }


    public static function getData($pro,$city,$usergroup,$epgcode){
        $res = array();
        $time = time();
        $gid = 1;
        $sql_select = "select * from yd_ver_message";
        $sql_where = " where gid=$gid and $time < endTime and $time > firstTime";
        $sql_order = " order by cTime desc";
        $sql = $sql_select . $sql_where . $sql_order;
        $res = SQLManager::queryRow($sql);
        return $res;
    }
}
