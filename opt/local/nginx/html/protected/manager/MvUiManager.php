<?php


class MvUiManager extends MvUi
{
    /**
     * @return array
     * 获取布局数据
     */
    public static function getAll($gid,$epg,$type){//$cp = '',$type = '',$provinceCode = '0',$cityCode = '0'
        $res = array();
        $criteria = new CDbCriteria();
         if(!empty($gid)){
             $criteria->addCondition('gid=:gid');
             $criteria->params[':gid'] = $gid;
         }
        if(!empty($epg)){
            $criteria->addCondition('epg=:epg');
            $criteria->params[':epg'] = $epg;
        }
        if(!empty($type)){
            $criteria->addCondition('type=:type');
            $criteria->params[':type'] = $type;
        }
        $criteria->order="SUBSTRING(position ,2) asc";
        $mvui = self::model()->findAll($criteria);

        if(!empty($mvui)){
            foreach ($mvui as $v) {
                $res[$v['position']][] = $v->getAttributes();
            }
        }

        return $res;
    }
    
    public static function getTool($gid,$epg,$pos){//$cp = '',$type = '',$provinceCode = '0',$cityCode = '0'
        $res = array();
        $criteria = new CDbCriteria();
         if(isset($gid)){
             $criteria->addCondition('gid=:gid');
             $criteria->params[':gid'] = $gid;
         }
        if(isset($epg)){
            $criteria->addCondition('epg=:epg');
            $criteria->params[':epg'] = $epg;
        }
        if(!empty($pos)){
            $criteria->addCondition('position=:position');
            $criteria->params[':position'] = $pos;
        }
        $criteria->order="SUBSTRING(position ,2) asc";
        $mvui = self::model()->findAll($criteria);
        if(!empty($mvui)){
            foreach ($mvui as $v) {
                $res= $v->getAttributes();
            }
        }
        return $res;
    }

    public static function getKey($key,$arr){
        if(array_key_exists($key,$arr)){
            return $arr[$key];
        }
        return '';
    }

    public static function getList($epg,$pro,$city){
        $res = array();
        $sql_select = 'select u.*';
        $sql_from = ' from yd_mv_ui u,yd_mv_guide g';
        $sql_where = " where u.epg='$epg' and u.gid=g.id and g.province='$pro' and g.city='$city'";
        $sql_order = ' order by u.position asc';
        $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
        $res = SQLManager::queryAll($list);
        if(empty($res)){
            $sql_select = 'select u.*';
            $sql_from = ' from yd_mv_ui u,yd_mv_guide g';
            $sql_where = " where u.epg='$epg' and u.gid=g.id and g.province='$pro' and g.city=0";
            $sql_order = ' order by u.position asc';
            $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
            $res = SQLManager::queryAll($list);
            if(empty($res)){
                $sql_select = 'select u.*';
                $sql_from = ' from yd_mv_ui u,yd_mv_guide g';
                $sql_where = " where u.epg='$epg' and u.gid=g.id and g.province=0 and g.city=0 ";
                $sql_order = ' order by u.position asc';
                $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
                $res = SQLManager::queryAll($list);
            }
        }
        return $res;
    }
    public static function getCp($epg,$pro,$city,$cp){
        $res = array();
        $sql_select = 'select u.*';
        $sql_from = ' from yd_mv_ui u,yd_mv_nav n,yd_mv_guide g';
        $sql_where = " where u.epg='$epg' and u.gid=g.id and n.gid=g.pid and n.cp='$cp' and n.province='$pro' and n.city='$city'";
        $sql_order = ' group by u.id order by u.position asc';
        $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
        //echo $list;
        $res = SQLManager::queryAll($list);
        //var_dump($res);die;
        if(empty($res)){
            $sql_select = 'select u.*';
            $sql_from = ' from yd_mv_ui u,yd_mv_nav n,yd_mv_guide g';
            $sql_where = " where u.epg='$epg' and u.gid=g.id and n.gid=g.pid and n.cp='$cp' and n.province='$pro' and n.city=0";
            $sql_order = ' group by u.id order by u.position asc';
            $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
            //echo $list;
            $res = SQLManager::queryAll($list);
            //var_dump($res);die;
            if(empty($res)){
                $sql_select = 'select u.*';
                $sql_from = ' from yd_mv_ui u,yd_mv_guide g';
                $sql_where = " where u.epg='$epg' and u.gid=g.id and g.pid=2 ";
                $sql_order = ' group by u.id order by u.position asc';
                $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
                //echo $list;
                $res = SQLManager::queryAll($list);
                //var_dump($res);
            }
        }
        return $res;
    }

}
