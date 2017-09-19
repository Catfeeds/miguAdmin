<?php
class MvTemplateManager extends MvNav
{
    public static function addTemplate($nid,$templateId)
    {
//        $res = array();
        $sql_insert = 'insert into yd_mv_template';
        $sql_field = '(`nid`,`templateId`)';
        $sql_value = " values($nid,$templateId)";
        $sql = $sql_insert.$sql_field.$sql_value;
        $res = SQLManager::execute($sql);
        return $res;
    }

    public static function selectOne($nid)
    {
        $res = array();
        $sql_select = 'select id,nid,templateId from yd_mv_template';
        $sql_where = ' where nid='.$nid;
        $sql_order = ' order by id desc limit 1';
        $sql = $sql_select.$sql_where.$sql_order;
        $res = SQLManager::queryAll($sql);
//        var_dump($res);die;
        return $res;
    }


}
