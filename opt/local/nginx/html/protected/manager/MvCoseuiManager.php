<?php


class MvCoseuiManager extends MvCoseui
{
    /**
     * @return array
     * 获取布局数据
     */
    public static function getAll($cid){
        $res = array();
        $criteria = new CDbCriteria();

        if(!empty($cid)){
            $criteria->addCondition('cid=:cid');
            $criteria->params[':cid'] = $cid;
        }
        $criteria->addNotInCondition('flag',array(3,5,6));
        $criteria->order="pos asc";
        $mvui = self::model()->findAll($criteria);

        if(!empty($mvui)){
            foreach ($mvui as $v) {
                $res[$v['pos']][] = $v->getAttributes();
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

    public static function getList($cid){
        $res = array();
        $sql_select = 'select *';
        $sql_from = ' from yd_mv_seui';
        $sql_where = " where cid='$cid'";
        $sql_order = ' order by pos asc';
        $list = $sql_select . $sql_from . $sql_where .$sql_order  ;
        $res = SQLManager::queryAll($list);
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
            $list = "select s.*,c.gid,g.name,g.pid from yd_mv_ui c,yd_mv_guide g,yd_mv_coseui s where s.Flag in(1,5) and flag=1 and g.pid=$gid and c.gid=g.id group by s.id";
        }else{
            //$list = 'select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(1,5) and flag=1 and c.gid=g.id';
            $list = 'select s.*,c.gid,g.name,g.pid from yd_mv_ui c,yd_mv_guide g,yd_mv_coseui s where  s.flag in(1,5) and c.gid=g.id and s.cid=c.id';
        }
        //$res = array();
        //$list = 'select s.*,c.gid,g.name,g.pid from yd_mv_ui c,yd_mv_guide g,yd_mv_coseui s where  s.flag in(1,5) and c.gid=g.id and s.cid=c.id';
        $tmp = SQLManager::queryAll($list);
        //var_dump($tmp);die;
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
            $list = "select s.*,c.gid,g.name,g.pid from yd_mv_ui c,yd_mv_guide g,yd_mv_coseui s where s.Flag in(2,6) and flag=1 and g.pid=$gid and c.gid=g.id group by s.id";
        }else{
            //$list = 'select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(1,5) and flag=1 and c.gid=g.id';
            $list = 'select s.*,c.gid,g.name,g.pid from yd_mv_ui c,yd_mv_guide g,yd_mv_coseui s where  s.flag in(2,6) and c.gid=g.id and s.cid=c.id';
        }

//        $res = array();
  //      $list = 'select s.*,c.gid,g.name,g.pid from yd_mv_ui c,yd_mv_guide g,yd_mv_coseui s where  s.flag in(2,6) and c.gid=g.id and s.cid=c.id order by s.addTime';
        $tmp = SQLManager::queryAll($list);
        //var_dump($tmp);
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
            $list = "select s.*,c.gid,g.name,g.pid from yd_mv_ui c,yd_mv_guide g,yd_mv_coseui s where s.Flag in(3,7) and flag=1 and g.pid=$gid and c.gid=g.id group by s.id";
        }else{
            //$list = 'select c.*,g.name,g.pid from yd_mv_coui c,yd_mv_guide g where c.delFlag in(1,5) and flag=1 and c.gid=g.id';
            $list = 'select s.*,c.gid,g.name,g.pid from yd_mv_ui c,yd_mv_guide g,yd_mv_coseui s where  s.flag in(3,7) and c.gid=g.id and s.cid=c.id';
        }

//        $res = array();
  //      $list = 'select s.*,c.gid,g.name,g.pid from yd_mv_ui c,yd_mv_guide g,yd_mv_coseui s where  s.flag in(3,7) and c.gid=g.id and s.cid=c.id';
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
