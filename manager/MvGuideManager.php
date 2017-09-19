<?php

/**
 * Created by PhpStorm.
 * User: xiangl
 * Date: 2015/8/19 0019
 * Time: 12:50
 */
class MvGuideManager extends MvGuide{
    public static function getList(){
        $res = array();
        $all = MvGuide::model()->findAll();
//        var_dump($all);die();
        if(!empty($all)){
            foreach($all as $key=>$n){
                if($n->pid == 0){
                    $tmp['id'] = $n->id;
                    $tmp['name'] = $n->name;
                    $res[$n->id] = $tmp;
                }elseif(array_key_exists($n->pid,$res)){//array_key_exists() 函数判断某个数组中是否存在指定的 key，如果该 key 存在，则返回 true，否则返回 false。
                    $tm['id'] = $n->id;
                    $tm['name'] = $n->name;
                    $res[$n->pid]['node'][] = $tm;
                }
            }
        }

        return $res;
    }
    public static function lists(){
        $sql_select = 'select pid,name,module,url,status,id from yd_mv_guide';
        return SQLManager::queryAll($sql_select);
    }
    
    /*public static function getTotal(){
        $sql_select='select count(id) as total';
        $sql_from=' from yd_user ';
        //$sql_group=' group by uid';
        $list = $sql_select . $sql_from ;
        //echo $list;
        $res = SQLManager::queryRow($list);
        //var_dump($res);die;
        return $res;
    }

    public static function getVname($data){
        $sql_select='select vname,count(*) as num';
        $sql_from=' from yd_mv_user';
        $sql_group=' group by vname';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $list = $sql_select . $sql_from . $sql_group .$sql_limit;
        $total = $sql_select . $sql_from;
        $count = $sql_select . $sql_from . $sql_group;
        $res['list'] = SQLManager::queryAll($list);
        $res['total']=SQLManager::queryRow($total);
        $res['count']=count(SQLManager::queryAll($count));
        //var_dump($res);die;
        return $res;
    }*/
    public static function getTotal(){
    $sql_select='select count(id) as total';
    $sql_from=' from yd_user ';
    //$sql_group=' group by uid';
    $list = $sql_select . $sql_from ;
    //echo $list;
    $res = SQLManager::queryRow($list);
    //var_dump($res);die;
    return $res;
}
    public static function getPro($pro){
        $sql_select='select count(id) as total';
        $sql_from=" from yd_mv_user where province='$pro'";
        //$sql_group=' group by uid';
        $list = $sql_select . $sql_from ;
        //echo $list;
        $res = SQLManager::queryRow($list);
        //var_dump($res);die;
        return $res;
    }

    public static function getVname($data,$pro){
        $sql_select='select vname,count(*) as num';
        $sql_from=" from yd_mv_user where province='$pro'";
        $sql_group=' group by vname';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $list = $sql_select . $sql_from . $sql_group .$sql_limit;
        $total = $sql_select . $sql_from;
        $count = $sql_select . $sql_from . $sql_group;
        $res['list'] = SQLManager::queryAll($list);
        $res['total']=SQLManager::queryRow($total);
        $res['count']=count(SQLManager::queryAll($count));
        //var_dump($res);die;
        return $res;
    }

    public static function getProvince($data){
        $sql_select='select count(*) as num,province';
        $sql_from=' from yd_mv_user';
        $sql_group=' group by province';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $list = $sql_select . $sql_from . $sql_group .$sql_limit;
        $total = $sql_select . $sql_from;
        $count = $sql_select . $sql_from . $sql_group;
        $res['list'] = SQLManager::queryAll($list);
        $res['total']=SQLManager::queryRow($total);
        $res['count']=count(SQLManager::queryAll($count));
        //var_dump($res);die;
        return $res;
    }
    
    public static function getforparent($id=0){
        $sql_select = 'select name,url,id,module,pid from yd_mv_guide where pid='.intval($id).' order by `order` asc';
        return SQLManager::queryAll($sql_select);
    }
    public static function getNew($pro,$city,$cp){
        $res = array();
        if($pro == 0 && $city==0){
            $id=2;
        }else{
            $sql = "select n.gid,g.id from yd_mv_nav n,yd_mv_guide g where n.province='$pro' and n.city='$city' and g.pid=0 and cp='$cp' group by n.id";
            //var_dump($sql);die;
            $res = SQLManager::queryRow($sql);
            $id = $res['gid'];
            //var_dump($res);
            if(empty($res)){
                $sql = "select n.gid,g.id from yd_mv_nav n,yd_mv_guide g where n.province='$pro' and n.city=0 and g.pid=0 and cp='$cp' group by n.id";
                //var_dump($sql);die;
                $res = SQLManager::queryRow($sql);
                $id = $res['gid'];
                //var_dump($res);
                if(empty($res)){
                    $id=2;
                }
            }

        }
        if(!empty($id)){
            $sql_select = 'select id as gid,`ico_true`,`ico_false`,`order`,vip,name as title';
            $sql_from = ' from yd_mv_guide';
            $sql_where = " where pid=$id";
            $sql_order = ' order by `order` asc';

            $list = $sql_select . $sql_from . $sql_where .$sql_order;

            $res = SQLManager::queryAll($list);
            if(empty($res)){
                $sql_select = 'select id as gid,`ico_true`,`ico_false`,`order`,vip,name as title';
                $sql_from = ' from yd_mv_guide';
                $sql_where = " where pid=2";
                $sql_order = ' order by `order` asc';

                $list = $sql_select . $sql_from . $sql_where .$sql_order;

                $res = SQLManager::queryAll($list);
            }

        }else{
            $res='';
        }


        return $res;
    }

}
