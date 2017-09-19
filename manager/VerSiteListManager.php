<?php

/**
 * Created by PhpStorm.
 * User: xzm
 * Date: 2015/12/28
 * Time: 14:41
 */
class VerSiteListManager extends VerSitelist{

    public static function getList($id){
        $res = array();
        $sql = "select * from yd_ver_sitelist where pid=$id";
        //$sql = "select * from yd_wx_guide where pid=42";
        $res = SQLManager::queryAll($sql);
        //var_dump($list);die;
        return $res;
    }

    public static function getDataBK($data,$list,$gid){
        $res = array();
        $sql = "select c.order as orders,c.id as cid,c.status as vstatus,c.cTime as vTime,c.upTime as updateTime,v.* from yd_ver_site c,yd_video v where c.vid=v.id and c.delFlag=0 and c.gid='$gid' order by orders";
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $list = $sql . $sql_limit;
        //var_dump($list);die;
        //$count = "select count(id) from yd_ver_content ";
        $count = "select count(*) from yd_ver_site c,yd_video v where c.vid=v.id and c.delFlag=0 and c.gid='$gid'";
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();
        $res['list'] = SQLManager::queryAll($list);
        //echo '<pre>';
	//var_dump($res['list']);die;	
        $sql2 = "select count(c.id) ,v.id from yd_ver_site c,yd_video v where c.vid=v.id and c.delFlag=0 and c.gid='$gid'";
        $sql3 = "select count(c.id) ,v.id from yd_ver_site c,yd_video v where c.vid=v.id and c.delFlag=0 and c.gid='$gid' and c.status=1";
        $count2 = SQLManager::queryAll($sql2);
        $count3 = SQLManager::queryAll($sql3);
	$res['cou'] = $count2[0]['count(c.id)'];//这个栏目的总条数
	$res['online'] = $count3[0]['count(c.id)'];//已上线总数
        
	//var_dump($res['cou']);die;
	return $res;
    }

     public static function getDatas($data,$list,$gid){
	$res = array();
        //$sql = "select c.vid,c.order as orders,c.id as cid,v.language,c.status as vstatus,c.cTime as vTime,c.upTime as updateTime,v.* from yd_ver_site c,yd_video v where c.vid=v.vid and c.delFlag=0 and c.gid='$gid' order by orders desc,updateTime desc";
        $sql = "select c.vid,c.order as orders,c.id as cid,v.language,c.status as vstatus,c.cTime as vTime,c.upTime as updateTime,v.* from yd_ver_site c,yd_video v where c.vid=v.vid and c.delFlag=0 and c.gid='$gid' ";
        $sql_where = '';
        if(isset($list['status'])){
	        $sql_where .=" and c.status={$list['status']}";
        }

        if(!empty($list['title'])){
            $sql_where .=" and v.title like '%{$list['title']}%'";
        }

        if(isset($list['cp']) && empty($list['title'])){
            $sql_where .= " and v.cp='{$list['cp']}'";
        }

        if(isset($list['cp']) && !empty($list['title'])){
            $sql_where .= " and v.cp='{$list['cp']}'  and v.title like '%{$list['title']}%' ";
        }
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $list = $sql . $sql_where . $sql_limit;
        $count = "select count(*) from yd_ver_site c left join yd_video as v on c.vid=v.vid where c.delFlag=0 and c.gid='$gid' ";
        $count = $count.$sql_where;
	//var_dump($list);die;
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();
        $res['list'] = SQLManager::queryAll($list);
        $sql2 = "select count(c.id) from yd_ver_site c where  c.delFlag=0 and c.gid='$gid'";
        $sql3 = "select count(c.id) from yd_ver_site c where  c.delFlag=0 and c.gid='$gid' and c.status=1";
        $count2 = SQLManager::queryAll($sql2);
        $count3 = SQLManager::queryAll($sql3);
        $res['cou'] = $count2[0]['count(c.id)'];//这个栏目的总条数
        $res['online'] = $count3[0]['count(c.id)'];//已上线总数
        return $res;
    }
 	
    public static function getStation($list){
        $res = array();
        $sql_select = "select v.vid from yd_ver_content c inner join yd_video v on v.vid=c.vid and c.flag=0";
        $sql_where = '';
        if(!empty($list['type'])){
            $arr=explode(' ',trim($list['type']));
            foreach($arr as $k=>$v){
                if($k=='0'){
                    $sql_where .= " and (v.type like '%$v%'";
                }else{
                    $sql_where .= " or v.type like '%$v%'";
                }
            }
            $sql_where .=")";
        }

        if(!empty($list['cps'])){
            $arr=explode(' ',trim($list['cps']));
            foreach($arr as $k=>$v){
                if($k=='0'){
                    $sql_where .= " and (v.cp = '$v'";
                }else{
                    $sql_where .= " or v.cp = '$v'";
                }
            }
            $sql_where .=")";
        }
        $sql_group = " group by v.vid";
        $sql = $sql_select . $sql_where . $sql_group;
        $res = SQLManager::queryAll($sql);
        return $res;
    }
    /*public static function getDatas($data,$list,$gid){
        $res = array();
        //$sql = "select c.vid,c.order as orders,c.id as cid,v.language,c.status as vstatus,c.cTime as vTime,c.upTime as updateTime,v.* from yd_ver_site c,yd_video v where c.vid=v.vid and c.delFlag=0 and c.gid='$gid' order by orders desc,updateTime desc";
        $sql = "select c.vid,c.order as orders,c.id as cid,v.language,c.status as vstatus,c.cTime as vTime,c.upTime as updateTime,v.* from yd_ver_site c,yd_video v where c.vid=v.vid and c.delFlag=0 and c.gid='$gid' ";
        $sql_where = '';
        if(isset($list['status'])){
	    $sql_where .=" and c.status={$list['status']}";
        }
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $list = $sql . $sql_where . $sql_limit;
        //$count = "select count(id) from yd_ver_content";
        $count = "select count(*) from yd_ver_site c where c.delFlag=0 and c.gid='$gid'";
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();
	//var_dump($list);die;
        $res['list'] = SQLManager::queryAll($list);
        $sql2 = "select count(c.id) from yd_ver_site c where  c.delFlag=0 and c.gid='$gid'";
        $sql3 = "select count(c.id) from yd_ver_site c where  c.delFlag=0 and c.gid='$gid' and c.status=1";
        $count2 = SQLManager::queryAll($sql2);
        $count3 = SQLManager::queryAll($sql3);
        $res['cou'] = $count2[0]['count(c.id)'];//这个栏目的总条数
        $res['online'] = $count3[0]['count(c.id)'];//已上线总数

        //var_dump($res['list']);die;
        //select count(s.id) from yd_ver_site s inner join yd_video v on s.vid = v.id and s.gid in('4','14','15','16','41','48','49','50','51','52','53','54','55','56','57') and s.status='1' inner join yd_video_pic p on p.vid=v.vid and p.type=1
        return $res;
    }*/
    public static function getInsert($vid){
        $res = array();
        $sql = "select id from yd_ver_sitelist where type=2";
        $list = SQLManager::queryAll($sql);
        foreach($list as $k=>$v){
            $sql_select = "select * from yd_ver_category where gid = '{$v['id']}'";
            $tmp = SQLManager::queryRow($sql_select);
            if(!empty($tmp)){
                $list=$tmp;
                $list['vid']=$vid;
                $res = VerSiteListManager::getSearch($list);
                if(!empty($res)){
                    $sitelist = VerSite::model()->find("vid = '{$res['vid']}' and gid='{$v['id']}'");
                    if(empty($sitelist)){
                        $site = new VerSite();
                        $site->vid = $vid;
                        $site->gid = $v['id'];
                        $site->status='0';
                        $site->delFlag='0';
                        $site->order='99';
                        $site->cTime=time();
                        $site->save();
                        if(!$site->save()){
                            var_dump($sitelist->getErrors());
                        }
                        $res = VerSiteListManager::getSecondSearch($res['vid'],$v['id']);
                    }
                }
            }
        }
    }

    public static function getSearch($list){
        $res = array();
        $sql_select = "select vid from yd_video v where vid='{$list['vid']}'";
        $sql_where = '';
        if(!empty($list['type'])){
            $arr=explode(' ',trim($list['type']));
            foreach($arr as $k=>$v){
                if($k=='0'){
                    $sql_where .= " and (type like '%$v%'";
                }else{
                    $sql_where .= " or type like '%$v%'";
                }
            }
            $sql_where .=")";
        }

        if(!empty($list['cp'])){
            $arr=explode(' ',trim($list['cp']));
            foreach($arr as $k=>$v){
                if($k=='0'){
                    $sql_where .= " and (cp = '$v'";
                }else{
                    $sql_where .= " or cp = '$v'";
                }
            }
            $sql_where .=")";
        }
        $sql_group = " group by v.vid";
        $sql = $sql_select . $sql_where . $sql_group;
        $res = SQLManager::queryRow($sql);
        //echo $sql;
        //var_dump($res);die;
        return $res;
    }
    public static function getSecond($gid){
        $res = array();
        $sql = "select id from yd_ver_sitelist where pid='$gid'";
        $list = SQLManager::queryAll($sql);
        foreach($list as $k=>$v){
            
            $sql_select = "select * from yd_ver_category where gid = '{$v['id']}'";
            $tmp = SQLManager::queryRow($sql_select);
            if(!empty($tmp)){
                Yii::app()->db->createCommand()->delete('{{ver_site}}', "gid={$v['id']}");
                $list=$tmp;
                $res = VideoManager::Classify($list,$gid);
                if(!empty($res)){
                    foreach($res as $key=>$val){
                        $sitelist = VerSite::model()->find("vid = '{$val['vid']}' and gid='{$v['id']}'");
                    	if(empty($sitelist)){
                            $site = new VerSite();
                            $site->vid = $val['vid'];
                            $site->gid = $v['id'];
                            $site->status='0';
                            $site->delFlag='0';
                            $site->order='99';
                            $site->cTime=time();
                            $site->save();
                            if(!$site->save()){
                                var_dump($sitelist->getErrors());
                            }
                        }
                    }
                }
            }
        }
    }

    public static function getSecondSearch($vid,$gid){
        $res = array();
        $sql = "select id from yd_ver_sitelist where pid='$gid'";
        $list = SQLManager::queryAll($sql);
        foreach($list as $k=>$v){
            $sql_select = "select * from yd_ver_category where gid = '{$v['id']}'";
            $tmp = SQLManager::queryRow($sql_select);
            if(!empty($tmp)){
                $data=$tmp;
                $res = VerSiteListManager::getSecondClassify($data,$v['id'],$vid);
                if(!empty($res)){
                    $sitelist = VerSite::model()->find("vid = '{$res['vid']}' and gid='{$v['id']}'");
                    if(empty($sitelist)){
                        $site = new VerSite();
                        $site->vid = $res['vid'];
                        $site->gid = $v['id'];
                        $site->status='0';
                        $site->delFlag='0';
                        $site->order='99';
                        $site->cTime=time();
                        $site->save();
                        if(!$site->save()){
                            var_dump($sitelist->getErrors());
                        }
                    }
                }
            }
        }
    }
    public static function getSecondClassify($list,$pid,$vid){
        $sql_select="select v.vid ";
        //$sql_from=" from yd_ver_site s inner join yd_video v on s.vid=v.vid and s.gid=$pid inner join yd_video_extra e on e.vid=v.vid";
        $sql_from = " from yd_video v inner join yd_video_extra e on v.vid=e.vid and v.vid=$vid";
        $sql_group = " group by v.vid";
        $sql_where='';
        if(!empty($list['type'])){
            $arr=explode(' ',trim($list['type']));
            foreach($arr as $k=>$v){
                if($k=='0'){
                    $sql_where .= " and (v.type like '%$v%'";
                }else{
                    $sql_where .= " or v.type like '%$v%'";
                }
            }
            $sql_where .=")";
        }
        if(!empty($list['cp'])){
            $arr=explode(' ',trim($list['cp']));
            foreach($arr as $k=>$v){
                if($k=='0'){
                    $sql_where .= " and (v.cp = '$v'";
                }else{
                    $sql_where .= " or v.cp = '$v'";
                }
            }
            $sql_where .=")";
        }

        if(!empty($list['keyword'])){
            $arr=explode('/',trim($list['keyword']));
            $sql_where .=' and (';
            foreach($arr as $k=>$v){
                $sql_lab = "select k.id from yd_ver_keyword k inner join yd_ver_sitelist s on s.name=k.type and k.keyword='$v' group by k.id";
                $lab = SQLManager::queryAll($sql_lab);
                if($k=='0'){
                    foreach($lab as $key=>$val){
                    if($key==0){
                        $sql_where .=' v.keyword like '.'"%'."'{$val['id']}'".'%" ';
                    }else{
                        $sql_where .= ' or v.keyword like '.'"%'."'{$val['id']}'".'%" ';
                    }
                }

                    //$sql_where .= ' and (v.keyword like '.'"%'."'$labid'".'%" ';
                }else{
                    //$sql_where .=' or v.keyword like '.'"%'."'$labid'".'%" ';
                    foreach($lab as $key=>$val){
                        $sql_where .= ' or v.keyword like '.'"%'."'{$val['id']}'".'%" ';
                    }
                }

            }
            $sql_where .=")";
        }
        if(!empty($list['simple_set'])){
            $arr=explode(' ',trim($list['simple_set']));
            foreach($arr as $k=>$v){
                if($k=='0'){
                    $sql_where .= " and (v.simple_set = '$v'";
                }else{
                    $sql_where .= " or v.simple_set = '$v'";
                }
            }
            $sql_where .=")";
        }

        if(!empty($list['year'])){
            $sql_where .=" and v.`year` like '%{$list['year']}%'";
        }
        if(!empty($list['actor'])){
            $sql_where .=" and v.`actor` like '%{$list['actor']}%'";
        }
        if(!empty($list['boxoffice'])){
            $sql_where .=" and e.`boxoffice` like '%{$list['boxoffice']}%'";
        }
        if(!empty($list['CountryOfOrigin'])){
            $sql_where .=" and v.`CountryOfOrigin`  like '%{$list['CountryOfOrigin']}%'";
        }
        if(!empty($list['director'])){
            $sql_where .=" and v.`director` like '%{$list['director']}%'";
        }
        if( !empty($list['end']) ){
            if($list['end'] == -1){
                $sql_where .= ' ';
            }else{
                $sql_where .=" and e.`end` = {$list['end']}";
            }
        }
        if(!empty($list['orders'])){
            $sql_where .=" and e.`orders` like '%{$list['orders']}%'";
        }
        if(!empty($list['language'])){
            $sql_where .=" and v.`language` like '%{$list['language']}%'";
        }
        if(!empty($list['score'])){
            $sql_where .=" and v.score >= {$list['score']}";
        }
        if(!empty($list['prize'])){
            $sql_where .=" and e.`prize` like '%{$list['prize']}%'";
        }
        if(!empty($list['short'])){
            $sql_where .=" and v.`short` like '%{$list['short']}%'";
        }

        $sql=$sql_select.$sql_from.$sql_where.$sql_group;
        $res=SQLManager::queryRow($sql);
        return $res;
    }

    public static function getTitle($title,$gid){
        $res = array();
        $sql="select s.vid,s.order as orders,s.id as cid,v.language,s.status as vstatus,s.cTime as vTime,v.* from yd_ver_site s inner join yd_video v on s.vid=v.vid and v.title like '%$title%' and s.gid=$gid";
        $res = SQLManager::queryAll($sql);
        return $res;
    }

    public static function getCpRes($cp,$gid)
    {
        $res = array();
        $sql="select s.vid,s.order as orders,s.id as cid,v.language,s.status as vstatus,s.cTime as vTime,v.* from yd_ver_site s inner join yd_video v on s.vid=v.vid and v.cp='$cp' and s.gid=$gid";
        $res = SQLManager::queryAll($sql);
        return $res;
    }

    public static function getCpTitle($title,$cp,$gid)
    {
        $res = array();
        $sql="select s.vid,s.order as orders,s.id as cid,v.language,s.status as vstatus,s.cTime as vTime,v.* from yd_ver_site s inner join yd_video v on s.vid=v.vid and v.title like '%$title%' and s.gid=$gid and v.cp='$cp'";
        $res = SQLManager::queryAll($sql);
        return $res;
    }	
}
