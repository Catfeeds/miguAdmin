<?php

class StationManager extends VerStation{

    public static function getAll($p){
        $res = array();
        //$page = 10*($p-1);
        //$sql_select = " select * from yd_ver_admin";
       // $sql_limit = " limit $page,10";
        //$sql = $sql_select . $sql_limit;
        $sql_select = " select a.id,a.nickname,p.provinceName as pro,c.cityName as city,a.company,a.tel from yd_ver_admin a inner join yd_province p on a.pro=p.provinceCode inner join yd_city c on a.city=c.cityCode group by a.id";
       
        $res = SQLManager::queryAll($sql_select);
        return $res;
    }
    
    public static function getList($list){
        $res = array();
        //$sql_select = " select * from yd_ver_admin";
        $sql_select = " select a.id,a.nickname,p.provinceName as pro,c.cityName as city,a.company,a.tel from yd_ver_admin a inner join yd_province p on a.pro=p.provinceCode inner join yd_city c on a.city=c.cityCode";
        $group = " group by a.id";
        $sql_where = ' where a.delFlag=0';
        if(!empty($list['company'])){
            $sql_where .= " and a.company like '%{$list['company']}%'";
        }
        if(!empty($list['usernames'])){
            $sql_where .=" and a.nickname like '%{$list['usernames']}%'";
        }
        if(!empty($list)){
            $sql=$sql_select . $sql_where .$group;
        }else{
            $sql = $sql_select . $group;
        }
        $res = SQLManager::queryAll($sql);
        return $res;
    }


}
