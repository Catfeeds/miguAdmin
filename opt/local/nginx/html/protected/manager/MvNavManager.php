<?php
class MvNavManager extends MvNav{
    public static function getList($pro,$city){
      if($pro==0 && $city==0){
         /*$sql_selet = "select cp ";
                $sql_from = " from yd_mv_nav";
                $sql_where = " where province=0 and city=0";
                $sql_group = " group by cp";
                $list = $sql_selet . $sql_from .$sql_where . $sql_group;
                //echo $list;
                $count = SQLManager::queryALL($list);*/
         $count = array(array('cp'=>'1'),array('cp'=>'2'),array('cp'=>'3'),array('cp'=>'4'),array('cp'=>'5'));
      }else{
        $sql_selet = "select cp ";
        $sql_from = " from yd_mv_nav";
        $sql_where = " where province='$pro' and city='$city'";
        $sql_group = " group by cp";
        $list = $sql_selet . $sql_from .$sql_where . $sql_group;
        //echo $list;
        $count = SQLManager::queryALL($list);
        if(empty($count)){
            $sql_selet = "select cp ";
            $sql_from = " from yd_mv_nav";
            $sql_where = " where province='$pro' and city='0'";
            $sql_group = " group by cp";
            $list = $sql_selet . $sql_from .$sql_where . $sql_group;
            //echo $list;
            $count = SQLManager::queryALL($list);
            if(empty($count)){
               /*$sql_selet = "select cp ";
                $sql_from = " from yd_mv_nav";
                $sql_where = " where province=0 and city=0";
                $sql_group = " group by cp";
                $list = $sql_selet . $sql_from .$sql_where . $sql_group;
                //echo $list;
                $count = SQLManager::queryALL($list);*/
                $count = array(array('cp'=>'1'),array('cp'=>'2'),array('cp'=>'3'),array('cp'=>'4'),array('cp'=>'5'));

            }
        }
        }
        return $count;
    }
}
?>

