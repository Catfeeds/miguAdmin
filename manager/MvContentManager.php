<?php


class MvContentManager extends MvUi
{
    public static function getAll($gid)
    {
        $res = array();
        $sql_select = "select id,pic,gid,width,height,tType,cp,`order` from yd_mv_content";
        $sql_where = " where gid=$gid ";
        $sql_order = " order by addTime";
        $sql = $sql_select.$sql_where.$sql_order;
        $res = SQLManager::queryAll($sql);
        return $res;
    }

    public static function getOne($gid,$order)
    {
        $res = array();
        $sql_select = "select id,pic,gid,width,height,tType,cp,action,param,title from yd_mv_content";
        $sql_where = " where gid=$gid AND `order`='$order'";
        $sql_order = " order by addTime";
        $sql = $sql_select.$sql_where.$sql_order;
//        var_dump($sql);die;
        $res = SQLManager::queryAll($sql);

        return $res;
    }

    public static function getFind($id)
    {
        $res = array();
        $sql_select = "select id,pic,gid,width,height,tType,cp,action,param,title,x,y from yd_mv_content";
        $sql_where = " where id=$id";
        $sql = $sql_select.$sql_where;
        $res = SQLManager::queryAll($sql);
        return $res;
    }

    public static function add($data)
    {
        $res      = array();
        $title    = trim($data['title']);
        $position = trim($data['position']);
        $type     = trim($data['type']);
        $Type     = trim($data['tType']);
        $cp       = trim($data['cp']);
        $gid      = trim($data['gid']);
        $epg      = trim($data['epg']);
        $action   = trim($data['action']);
        $param    = trim($data['param']);
        $pic      = trim($data['key']);
        $addTime  = time();
        $upTime   = '0';
        $width    = trim($data['width']);
        $height   = trim($data['height']);
        $x        = trim($data['x']);
        $y        = trim($data['y']);
        $delFlag  = '0';
        $order    = trim($data['order']);
        $sql_insert = "insert into yd_mv_content(`title`,`position`,`type`,`tType`,`cp`,`gid`,`epg`,`action`,`param`,`pic`,`addTime`,`upTime`,`width`,`height`,`x`,`y`,`delFlag`,`order`)";
        $sql_values = " values('$title',$position,$type,$Type,$cp,$gid,'$epg','$action','$param','$pic',$addTime,$upTime,$width,$height,$x,$y,$delFlag,$order)";
        $sql = $sql_insert.$sql_values;
//        var_dump($sql);die;
        $res = SQLManager::execute($sql);
        return $res;
    }

    public static function firstPageUpdate($data)
    {
        $res      = array();
        $title    = trim($data['title']);
        $position = trim($data['position']);
        $type     = trim($data['type']);
        $Type     = trim($data['tType']);
        $cp       = trim($data['cp']);
        $gid      = trim($data['gid']);
        $epg      = trim($data['epg']);
        $action   = trim($data['action']);
        $param    = trim($data['param']);
        $pic      = trim($data['key']);
        $addTime  = time()-1;
        $upTime   = time();
        $width    = trim($data['width']);
        $height   = trim($data['height']);
        $x        = trim($data['x']);
        $y        = trim($data['y']);
        $delFlag  = '0';
        $order    = trim($data['order']);
        $id       = trim($data['id']);
        $sql_update = "update yd_mv_content set ";
        $sql_set = "`title`='$title',`position`='$position',`type`='$type',`tType`='$Type',`cp`='$cp',`gid`='$gid',`action`='$action',`param`='$param',`pic`='$pic',`addTime`='$addTime',`upTime`='$upTime',`width`='$width',`height`='$height',`x`='$x',`y`='$y',`delFlag`='$delFlag',`order`='$order'";
        if($id == '0'){
            $sql_where = ' where `order`='.$order;
        }else{
            $sql_where = " where id=$id";
        }

        $sql = $sql_update.$sql_set.$sql_where;
        $res = SQLManager::execute($sql);
        return $res;
    }

    public static function firstPageDel($id)
    {
        $sql_del = "delete from yd_mv_content";
        $sql_where = " where id=$id";
        $sql = $sql_del.$sql_where;
        $res = SQLManager::execute($sql);
        return $res;
    }

    public static function getEpgContent($gid)
    {
        $res = array();
        $sql_select = "select action,param,`title` as main_title,`type`,`tType`,`width`,`height`,`x`,`y`,`pic`,`order` from yd_mv_content";
        $sql_where = " where gid=$gid order by `order`";
        $sql = $sql_select.$sql_where;
        $res = SQLManager::queryAll($sql);
        foreach ($res as $k => $v) {
            $v['pic'] = str_replace('http://localhost:8081','http://192.168.1.108:8081',$v['pic']);
            $v['jumpId'] = strval(rand(1,100));
            $order = $v['order'];
            if (empty($arr[$order])) {
                $arr[$order]['banner'][] = $v;
            } else {
                $tmp = $arr[$order]['banner'];
                $tmp[] = $v;
                $arr[$order]['banner'] = $tmp;
            }
        }
        foreach ($arr as $k=>$v){
            $newArr[] = $v;
        }
        return $newArr;
    }

    public static function getEpgContentUpdateTime($gid)
    {
        $sql = "select upTime from yd_mv_content where gid=$gid group by upTime order by upTime desc";
        $res = SQLManager::queryAll($sql);
//        var_dump($res[0]['upTime']);die;
        return $res[0]['upTime'];
    }

    public static function getEpgContentTest($gid,$epg)
    {
        $res = array();
        $sql_select = "select id,`title` as main_title,`type`,`tType`,`width`,`height`,`x`,`y`,`pic`,`order` from yd_mv_content";
        $sql_where = " where gid=$gid order by `order`";
        $sql = $sql_select.$sql_where;
        $res = SQLManager::queryAll($sql);
        foreach ($res as $k => $v) {
            $v['pic'] = str_replace('http://localhost:8081','http://192.168.1.108:8081',$v['pic']);
            $order = $v['order'];
            if (empty($arr[$order])) {
                $arr[$order]['banner'][] = $v;
            } else {
                $tmp = $arr[$order]['banner'];
                $tmp[] = $v;
                $arr[$order]['banner'] = $tmp;
            }
        }
        foreach ($arr as $k=>&$v){
            $newArr[] = $v;

        }
        echo json_encode($newArr);die;
        return $arr;
    }


/*SELECT
count(distinct case when status=0 then uid else null end) as onum,
count(distinct case when status=1 then uid else null end) as nnum,
from_unixtime(cTime,'%Y-%m-%d') as datetime,
(select count(distinct(uid)) from qm_js_order where status=0 and cTime<(UNIX_TIMESTAMP(datetime)+86400)) as total,
(select count(distinct(uid)) from qm_js_order where status=1 and cTime<(UNIX_TIMESTAMP(datetime)+86400)) as totals
FROM `qm_js_order` WHERE ( (`cTime` BETWEEN '1486915200' AND '1487260800' ) )
GROUP BY from_unixtime(cTime,'%Y-%m-%d')
ORDER BY datetime desc;*/

}

