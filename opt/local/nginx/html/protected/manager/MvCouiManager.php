<?php


class MvCouiManager extends MvCoui
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
        $criteria->addNotInCondition('delFlag',array(4,5,6));
        //$criteria->addCondition('delFlag=:delFlag');
        //$criteria->params[':delFlag'] = 0;
        $criteria->order="SUBSTRING(position ,2) asc";
        $mvui = self::model()->findAll($criteria);

        if(!empty($mvui)){
            foreach ($mvui as $v) {
                $res[$v['position']][] = $v->getAttributes();
            }
        }

        return $res;
    }

    public static function getAlls($gid,$epg,$type){//$cp = '',$type = '',$provinceCode = '0',$cityCode = '0'
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
        $criteria->addNotInCondition('delFlag',array(4,5,6));
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
        //var_dump($key);
        if(array_key_exists($key,$arr)){
            return $arr[$key];
        }
        return '';
    }

    public static function getLists($epg,$pro,$city){
        $res = array();
        $sql_select = 'select u.*';
        $sql_from = ' from yd_mv_ui u,yd_mv_nav n,yd_mv_guide g';
        $sql_where = " where u.epg='$epg' and u.gid=g.id and n.gid=g.pid and n.province='$pro' and n.city='$city'";
        $sql_order = ' group by u.id order by u.position asc ';
        //$sql_order=' order by cast(substring(u.position,2,len(u.position)-1) as int) ';
        $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
        //echo $list;
        $res = SQLManager::queryAll($list);
        //var_dump($res);die;
        if(empty($res)){
            $sql_select = 'select u.*';
            $sql_from = ' from yd_mv_ui u,yd_mv_nav n,yd_mv_guide g';
            $sql_where = " where u.epg='$epg' and u.gid=g.id and n.gid=g.pid and n.province='$pro' and n.city=0";
            $sql_order = ' group by u.id order by u.position asc ';
            //$sql_order=' order by cast(substring(u.position,2,len(u.position)-1) as int) ';
            $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
            //echo $list;
            $res = SQLManager::queryAll($list);
            //var_dump($res);die;
            if(empty($res)){
                $sql_select = 'select u.*';
                $sql_from = ' from yd_mv_ui u,yd_mv_guide g';
                $sql_where = " where u.epg='$epg' and u.gid=g.id and g.pid=2 ";
                $sql_order = ' group by u.id order by u.position asc ';
                //$sql_order=' order by cast(substring(u.position,2,len(u.position)-1) as int) ';
                $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
                //echo $list;
                $res = SQLManager::queryAll($list);
                //var_dump($res);
            }
             }
        return $res;
    }

    public static function getListAll($epg,$pro,$city,$cp){
        $res = array();
        $sql_select = 'select u.*';
        $sql_from = ' from yd_mv_ui u,yd_mv_nav n,yd_mv_guide g';
        $sql_where = " where u.epg='$epg' and u.gid=g.id and n.gid=g.pid and n.province='$pro' and n.city='$city' and u.cp='$cp'";
        $sql_order = ' order by u.position asc ';
        //$sql_order=' order by cast(substring(u.position,2,len(u.position)-1) as int) ';
        $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
        //echo $list;
        $res = SQLManager::queryAll($list);
        //var_dump($res);die;
        if(empty($res)){
            $sql_select = 'select u.*';
            $sql_from = ' from yd_mv_ui u,yd_mv_nav n,yd_mv_guide g';
            $sql_where = " where u.epg='$epg' and u.gid=g.id and n.gid=g.pid and n.province='$pro' and n.city=0 and u.cp='$cp'";
            $sql_order = ' order by u.position asc ';
            //$sql_order=' order by cast(substring(u.position,2,len(u.position)-1) as int) ';
            $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
            //echo $list;
            $res = SQLManager::queryAll($list);
            //var_dump($res);die;
            if(empty($res)){
                $sql_select = 'select u.*';
                $sql_from = ' from yd_mv_ui u,yd_mv_guide g';
                $sql_where = " where u.epg='$epg' and u.gid=g.id and g.pid=2 and u.cp='$cp'";
                $sql_order = ' order by u.position asc ';
                //$sql_order=' order by cast(substring(u.position,2,len(u.position)-1) as int) ';
                $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
                //echo $list;
                $res = SQLManager::queryAll($list);
                //var_dump($res);
            }
        }
        return $res;
    }

    public static function getYcp($epg,$cp){
        $sql_select = "select u.*";
        $sql_from =" from yd_mv_nav n,yd_mv_ui u";
        $sql_where = " where u.epg='$epg' and n.cp='$cp' and n.gid=u.gid";
        $list = $sql_select . $sql_from . $sql_where;
        $res = SQLManager::queryAll($list);
        if(empty($res)){
            $sql_select = "select u.*";
            $sql_from =" from yd_mv_nav n,yd_mv_ui u";
            $sql_where = " where u.epg='$epg' and n.gid=25 group by u.id";
            $list = $sql_select . $sql_from . $sql_where;
            $res = SQLManager::queryAll($list);
        }
        return $res;
    }

    public static function getGids($epg, $gid)
    {
        $res = array();
        $sql_select = 'select u.*';
        $sql_from = ' from yd_mv_ui u,yd_mv_guide g';
        $sql_where = " where u.epg='$epg' and u.gid=g.id and g.id='$gid'";
        $sql_order = ' order by u.position asc';
        $list = $sql_select . $sql_from . $sql_where . $sql_order;
        //echo $list;
        $res = SQLManager::queryAll($list);
        //var_dump($res);die;
        if (empty($res)) {
            $sql_select = 'select u.*';
            $sql_from = ' from yd_mv_ui u,yd_mv_guide g';
            $sql_where = " where u.epg='$epg' and u.gid=g.id and g.pid=2";
            $sql_order = ' order by u.position asc';
            $list = $sql_select . $sql_from . $sql_where . $sql_order;
            //echo $list;
            $res = SQLManager::queryAll($list);
            //var_dump($res);die;
        }
        return $res;
    }

    public static function getCp($epg, $pro, $city, $cp)
    {
        $res = array();
        $sql_select = 'select u.*';
        $sql_from = ' from yd_mv_ui u,yd_mv_nav n,yd_mv_guide g';
        $sql_where = " where u.epg='$epg' and u.gid=g.id and n.gid=g.pid and n.cp='$cp' and n.province='$pro' and n.city='$city'";
        $sql_order = ' group by u.id order by u.position asc';
        $list = $sql_select . $sql_from . $sql_where . $sql_order;
        //echo $list;
        $res = SQLManager::queryAll($list);
        //var_dump($res);die;
        if (empty($res)) {
            $sql_select = 'select u.*';
            $sql_from = ' from yd_mv_ui u,yd_mv_nav n,yd_mv_guide g';
            $sql_where = " where u.epg='$epg' and u.gid=g.id and n.gid=g.pid and n.cp='$cp' and n.province='$pro' and n.city=0";
            $sql_order = ' group by u.id order by u.position asc';
            $list = $sql_select . $sql_from . $sql_where . $sql_order;
            //echo $list;
            $res = SQLManager::queryAll($list);
            //var_dump($res);die;
            if (empty($res)) {
                $sql_select = 'select u.*';
                $sql_from = ' from yd_mv_ui u,yd_mv_guide g';
                $sql_where = " where u.epg='$epg' and u.gid=g.id and g.pid=2 ";
                $sql_order = ' group by u.id order by u.position asc';
                $list = $sql_select . $sql_from . $sql_where . $sql_order;
                //echo $list;
                $res = SQLManager::queryAll($list);
                //var_dump($res);
            }
        }
        return $res;
    }

    public static function getGid($epg, $pro, $city, $gid)
    {
        $res = array();
        $sql_select = 'select u.*';
        $sql_from = ' from yd_mv_ui u,yd_mv_guide g';
        $sql_where = " where u.epg='$epg' and u.gid=g.id and g.id='$gid'";
        $sql_order = ' order by u.position asc';
        $list = $sql_select . $sql_from . $sql_where . $sql_order;
        //echo $list;
        $res = SQLManager::queryAll($list);
        //var_dump($res);die;
        if (empty($res)) {
            $sql_select = 'select u.*';
            $sql_from = ' from yd_mv_ui u,yd_mv_guide g';
            $sql_where = " where u.epg='$epg' and u.gid=g.id and g.pid=2";
            $sql_order = ' order by u.position asc';
            $list = $sql_select . $sql_from . $sql_where . $sql_order;
            //echo $list;
            $res = SQLManager::queryAll($list);
            //var_dump($res);die;
        }
        return $res;
    }


    public static function getReview($user){
        $user = explode('_',$user);
        $pro=!empty($user[1])?$user[1]:'';
        $cp=!empty($user[2])?$user[2]:'';
        $res = array();
        if(!empty($pro)){
            if($cp==1){
                $sql = "select min(gid) as gid from yd_mv_nav where province=$pro and cp=1";
            }else{
                $sql = "select min(gid) as gid from yd_mv_nav where province=$pro and cp=2";
            }
                $gid = SQLManager::queryRow($sql);
                $gid=$gid['gid'];
                $list = "select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(1,5) and flag=1 and g.pid=$gid and c.gid=g.id group by c.id";
        }else{
              if(!empty($cp)){
                  switch($cp){
                       case '1':$gid="296,297,298,299,300";break;
                       case '2':$gid="301,302,303,304,305";break;
                       case '3':$gid="306,307,308,309,310";break;
                       case '4':$gid="311,312,313,314,315";break;
                       case '5':$gid="296,297,298,299,300";break;
                       case '6':$gid="296,297,298,299,300";break;
                       case '7':$gid="296,297,298,299,300";break;
                  }
                  $list = "select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(1,5) and flag=1 and c.gid=g.id and c.gid in($gid) group by c.id";
              }else{
                  $list = 'select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(1,5) and flag=1 and c.gid=g.id';
               }
                    //$gid="296,297,298,299,300";
                    //$list = "select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(1,5) and flag=1 and c.gid in($gid) and g.id in($gid) group by c.id";
             //$list = 'select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(1,5) and flag=1 and c.gid=g.id';
        }
        $tmp = SQLManager::queryAll($list);
        foreach($tmp as $k=>$v){
            $pid = $v['pid'];
            $list = "select name from yd_mv_guide  where id='$pid'";
            //var_dump($list);
            $name = SQLManager::queryRow($list);
            $res[]=$v;
            $res[$k]['gname']=$name['name'];
        }
        //var_dump($res);die;
        return $res;
    }

    public static function getAcreview($user){
        $user = explode('_',$user);
        $pro=!empty($user[1])?$user[1]:'';
        $cp=!empty($user[2])?$user[2]:'';
        $res = array();
        if(!empty($pro)){
            if($cp==1){
                $sql = "select min(gid) as gid from yd_mv_nav where province=$pro and cp=1";
            }else{
                $sql = "select min(gid) as gid from yd_mv_nav where province=$pro and cp=2";
            }
                $gid = SQLManager::queryRow($sql);
                $gid=$gid['gid'];
                $list = "select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(3,6) and flag=1 and g.pid=$gid and c.gid=g.id group by c.id";
        }else{
             $list = 'select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(3,6) and flag=1 and c.gid=g.id';
        }
        //$res = array();
        //$list = 'select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(3,6) and c.gid=g.id order by c.addTime';
        $tmp = SQLManager::queryAll($list);
        foreach($tmp as $k=>$v){
            $pid = $v['pid'];
            $list = "select name from yd_mv_guide  where id='$pid'";
            //var_dump($list);
            $name = SQLManager::queryRow($list);
            $res[]=$v;
            $res[$k]['gname']=$name['name'];
        }
        //var_dump($res);die;
        return $res;
    }

    public static function getNoreview($user){
        $user = explode('_',$user);
        $pro=!empty($user[1])?$user[1]:'';
        $cp=!empty($user[2])?$user[2]:'';
        $res = array();
        if(!empty($pro)){
            if($cp==1){
                $sql = "select min(gid) as gid from yd_mv_nav where province=$pro and cp=1";
            }else{
                $sql = "select min(gid) as gid from yd_mv_nav where province=$pro and cp=2";
            }
                $gid = SQLManager::queryRow($sql);
                $gid=$gid['gid'];
                $list = "select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(4,7) and flag=1 and g.pid=$gid and c.gid=g.id group by c.id";
        }else{
             $list = 'select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(4,7) and flag=1 and c.gid=g.id';
        }

        //$res = array();
        //$list = 'select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(4,7) and c.gid=g.id';
        $tmp = SQLManager::queryAll($list);
        foreach($tmp as $k=>$v){
            $pid = $v['pid'];
            $list = "select name from yd_mv_guide  where id='$pid'";
            //var_dump($list);
            $name = SQLManager::queryRow($list);
            $res[]=$v;
            $res[$k]['gname']=$name['name'];
        }
        //var_dump($res);die;
        return $res;
    }

    public static function getDelreview(){
        $res = array();
        $list = 'select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag=5 and c.gid=g.id';
        $tmp = SQLManager::queryAll($list);
        foreach($tmp as $k=>$v){
            $pid = $v['pid'];
            $list = "select name from yd_mv_guide  where id='$pid'";
            //var_dump($list);
            $name = SQLManager::queryRow($list);
            $res[]=$v;
            $res[$k]['gname']=$name['name'];
        }
        //var_dump($res);die;
        return $res;
    }


}
