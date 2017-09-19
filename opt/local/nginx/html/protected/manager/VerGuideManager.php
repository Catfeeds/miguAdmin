<?php

/**
 * Created by PhpStorm.
 * User: xiangl
 * Date: 2015/8/19 0019
 * Time: 12:50
 */
class VerGuideManager extends VerGuide{
    public static function getList(){
        $res = array();
        $all = VerGuide::model()->findAll();
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
        $sql_select = 'select pid,name,module,url,status,id from yd_ver_guide';
        return SQLManager::queryAll($sql_select);
    }

    public static function getforparent($id=0){
        $sql_select = 'select name,url,id,module,pid from yd_ver_guide where pid='.intval($id).' order by `order` asc';
        $res = SQLManager::queryAll($sql_select);
        //var_dump($res);
        return $res;
        //return SQLManager::queryAll($sql_select);
    }


    public static function getData($pro,$city,$cp,$usergroup,$epgcode){
        $res = array();
        $sql_select ="select * from yd_ver_nav where usergroup='$usergroup'";
        $list = SQLManager::queryRow($sql_select);
        if(empty($list)){
            $sql_select ="select * from yd_ver_nav where epgcode='$epgcode'";
            $list = SQLManager::queryRow($sql_select);
            if(empty($list)){
                $sql_select ="select * from yd_ver_nav where province='$pro' and city='$city' and cp='$cp'";
                $list = SQLManager::queryRow($sql_select);
                if(empty($list)){
                    $sql_select ="select * from yd_ver_nav where province='0' and city='0'";
                    $list = SQLManager::queryRow($sql_select);
                }
            }
        }
        $gid = $list['gid'];
        $sql = "select g.id as gid,g.name as title,g.ico_true,g.ico_false,`order`,e.epg from yd_ver_guide g,yd_ver_epg e where pid='$gid' and g.name=e.epgName";
        $result = SQLManager::queryAll($sql);
        return $result;
    }



    public static function getGuide($id){
        $sql = "select * from yd_ver_guide where pid=$id and status='0'";
        //$sql = "select * from yd_ver_guide where pid=42";
        $list = SQLManager::queryAll($sql);
        return $list;
    }

    public static function getGuideCopy($id,$list){
        if($_SESSION['auth']=='1'){
            $sql = "select * from yd_ver_guide where pid=$id and status='0' order by `order` asc";
        }else{
            $sql = "select * from yd_ver_guide where pid=$id and status='0' and id in ($list) order by `order` asc";
        }
        //$sql = "select * from yd_ver_guide where pid=42";
        $list = SQLManager::queryAll($sql);
        return $list;
    }


    public static function String($arr){
        $t = '';
	//var_dump($arr);die;
        foreach ($arr as $v){
	    if(count($v)>1){
               $v = join(",",$v); //可以用implode将一维数组转换为用逗号连接的字符串，join是别名
            }   
            $temp[] = $v;
        }
        //var_dump($temp);die;
	   foreach($temp as $v){
			if( is_array( $v ) ){
			foreach($v as $v1){
				 $t.="'$v1'".",";
			}
			}else{
         		 $t.="'$v'".",";
			}
        }
        
        //var_dump($t);
        $t=substr($t,0,-1);  //利用字符串截取函数消除最后一个逗号
        return $t;
	}
    






}
