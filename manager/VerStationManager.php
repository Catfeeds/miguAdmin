<?php


class VerStationManager extends VerStation
{
   public static function getData($data,$list){
       $res = array();
       $sql_select = " select * from yd_ver_work";
       $sql_count = "select count(id) from yd_ver_work ";
       if(empty($list['flag'])){
          $sql_where = " where flag=1";
       }else{
          $sql_where = " where flag='{$list['flag']}'";
       }
       if(!empty($list['name'])){
          $sql_where .=" and name like '%{$list['name']}%'";
       }
       if(!empty($list['cp'])){
          $sql_where .=" and cp='{$list['cp']}'";
       }
       if(!empty($list['type'])){
          $sql_where .=" and type='{$list['type']}'";
       }
       $sql_order = ' order by addTime desc';	
       $select = $sql_select . $sql_where . $sql_order;
       $co = $sql_count . $sql_where;
       $list = SQLManager::queryAll($select);
       $count = Yii::app()->db->createCommand($co)->queryScalar();
       $alwaysCount = $sql_count;
       $res['alwaysCount'] = Yii::app()->db->createCommand($alwaysCount)->queryScalar();
       $res['count'] = ceil($count/20);
       $res['list']=array();
       foreach($list as $k=>$v){
           $sql1 = "select a.nickname from yd_ver_admin a inner join yd_ver_worker k on k.workid='{$v['id']}' and k.uid = a.id group by a.nickname";
           $data1 = SQLManager::queryAll($sql1);
           $sql2 = "select a.nickname from yd_ver_admin a inner join yd_ver_review_work k on k.workid='{$v['id']}' and k.uid = a.id group by a.nickname";
           $data2= SQLManager::queryAll($sql2);
           if(!empty($data1) || !empty($data2)){
               $data = VerStationManager::unique_arr(array_merge($data1,$data2));
           }
           $res['list'][$k]=$v;
           $res['list'][$k]['user']=$data;
       }
       return $res;

   }

    public static function getStation($flag){
        $res = array();
        $sql_select = " select * from yd_ver_work where flag='$flag'";
        $sql_count = "select count(id) from yd_ver_work where flag='$flag'";
        $list = SQLManager::queryAll($sql_select);
        $count = Yii::app()->db->createCommand($sql_count)->queryScalar();
        $res['count'] = ceil($count/20);
        $res['list']=array();
        foreach($list as $k=>$v){
            $sql1 = "select a.nickname from yd_ver_admin a inner join yd_ver_worker k on k.workid='{$v['id']}' and k.uid = a.id group by a.nickname";
            $data1 = SQLManager::queryAll($sql1);
            $sql2 = "select a.nickname from yd_ver_admin a inner join yd_ver_review_work k on k.workid='{$v['id']}' and k.uid = a.id group by a.nickname";
            $data2= SQLManager::queryAll($sql2);
            if(!empty($data1) || !empty($data2)){
                $data = VerStationManager::unique_arr(array_merge($data1,$data2));
            }
            $res['list'][$k]=$v;
            //$res['list'][$k]['user']=$data;
            $res['list'][$k]['user']=VerGuideManager::String($data);
        }
        return $res;

    }
    
    public static function getDataList($list){
        $res = array();
        $sql_select = " select * from yd_ver_work";
        $sql_count = "select count(id) from yd_ver_work ";
        if(empty($list['flag'])){
            $sql_where = " where flag=1";
        }else{
            $sql_where = " where flag='{$list['flag']}'";
        }
        if(!empty($list['name'])){
            $sql_where .=" and name like '%{$list['name']}%'";
        }
        if(!empty($list['cp'])){
            $sql_where .=" and cp='{$list['cp']}'";
        }
        if(!empty($list['type'])){
            $sql_where .=" and type='{$list['type']}'";
        }
	$sql_order = ' order by addTime desc';
        $select = $sql_select . $sql_where . $sql_order;
        $co = $sql_count . $sql_where;
        $list = SQLManager::queryAll($select);
        $count = Yii::app()->db->createCommand($co)->queryScalar();
        $res['count'] = ceil($count/20);
        $res['list']=array();
	
        foreach($list as $k=>$v){
            $sql1 = "select a.nickname from yd_ver_admin a inner join yd_ver_worker k on k.workid='{$v['id']}' and k.uid = a.id group by a.nickname";
            $data1 = SQLManager::queryAll($sql1);
            $sql2 = "select a.nickname from yd_ver_admin a inner join yd_ver_review_work k on k.workid='{$v['id']}' and k.uid = a.id group by a.nickname";
            $data2= SQLManager::queryAll($sql2);
            if(!empty($data1) || !empty($data2)){
                $data = VerStationManager::unique_arr(array_merge($data1,$data2));
            }else{
		$data = "";	
	    }
            $res['list'][$k]=$v;
            if(!empty($data)){
	    $res['list'][$k]['user']=VerGuideManager::String($data);
        }}
        return $res;

    }

    public static function  unique_arr($array2D,$stkeep=false,$ndformat=true)
    {
        // 判断是否保留一级数组键 (一级数组键可以为非数字)
        if($stkeep) $stArr = array_keys($array2D);

        // 判断是否保留二级数组键 (所有二级数组键必须相同)
        if($ndformat) $ndArr = array_keys(end($array2D));

        //降维,也可以用implode,将一维数组转换为用逗号连接的字符串
        foreach ($array2D as $v){
            $v = join(",",$v);
            $temp[] = $v;
        }

        //去掉重复的字符串,也就是重复的一维数组
        $temp = array_unique($temp);

        //再将拆开的数组重新组装
        foreach ($temp as $k => $v)
        {
            if($stkeep) $k = $stArr[$k];
            if($ndformat)
            {
                $tempArr = explode(",",$v);
                foreach($tempArr as $ndkey => $ndval) $output[$k][$ndArr[$ndkey]] = $ndval;
            }
            else $output[$k] = explode(",",$v);
        }

        return $output;
    }







}
