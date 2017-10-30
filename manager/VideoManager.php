<?php

/**
 * Created by PhpStorm.
 * User: xzm
 * Date: 2015/12/28
 * Time: 14:41
 */
class VideoManager extends Video{

    public static function getList($data){
        $res = array();
        $sql_count = 'select count(id)';
        $sql_select = 'select vid,cp,title,info,actor,director,cate,type';
        $sql_from = ' from yd_video';
        $sql_where = " where title like '%".$data['title']."%'";
        $sql_order = ' order by cTime desc';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];

        $count = $sql_count . $sql_from . $sql_where;
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();

        $list = $sql_select . $sql_from . $sql_where . $sql_order . $sql_limit;
        $res['list'] = SQLManager::queryAll($list);
        return $res;
    }

    public static function getData($data,$list){
        $res = array();
        $sql_count = 'select count(id)';
        $sql_select = 'select id,ShowType,vid,cp,title,language,info,actor,director,cate,type,cTime,flag,upTime';
        $sql_from = ' from yd_video ';
        $sql_order = ' order by cTime desc';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $sql_where = " where instr(title,'^')=0";
        //$sql_where = " where title not regexp '\n\s*|：|/'";
        if(!empty($list['ShowType'])){
            if($list['ShowType']=='Series'){
               $sql_where .=" and targetgroupassetid='0' ";
            }
            $sql_where .=" and ShowType ='".$list['ShowType']."' ";
        }
        if(!empty($list['cp'])){
            $sql_where .=" and cp='".$list['cp']."' ";
        }
        if(!empty($list['flag'])){
            if($list['flag']!==''){
            $sql_where .=" and flag ='".$list['flag']."' ";
            }
        }
        if(!empty($list['title'])){
            $sql_where .=" and title like '%".$list['title']."%' ";
        }
        if(!empty($list['first'])){
            $sql_where .=" and upTime >'".$list['first']."' ";
        }
        if(!empty($list['timeend'])){
            $sql_where .=" and upTime <'".$list['timeend']."' ";
        }
        $count = $sql_count . $sql_from . $sql_where;
        $list = $sql_select . $sql_from . $sql_where . $sql_order . $sql_limit;
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();


        $res['list'] = SQLManager::queryAll($list);
        return $res;
    }
    
    public static function getContentData($data,$list){
        $res = array();
        $sql_count = 'select count(id)';
        $sql_select = 'select id,ShowType,vid,cp,title,language,info,actor,director,cate,type,cTime,flag,upTime,prdpack_id';
        $sql_from = ' from yd_video ';
        $sql_order = ' order by cTime desc';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $sql_where = " where instr(title,'^')=0";
        //$sql_where = " where title not regexp '\n\s*|：|/'";
        if(!empty($list['ShowType'])){
            if($list['ShowType']=='Series'){
                $sql_where .=" and targetgroupassetid='0' ";
            }
            $sql_where .=" and ShowType ='".$list['ShowType']."' ";
        }
        if(!empty($list['cp'])){
            $sql_where .=" and cp='".$list['cp']."' ";
        }
        if(isset($list['flag'])){
            if($list['flag']!==''){
                if($list['flag']=='0' || $list['flag']=='6'){
                    $sql_where .=" and flag ='".$list['flag']."' ";
                }else{
                    $sql_where .=" and flag in (1,2,3,4,5)";
                }
            }
        }
        if(!empty($list['title'])){
            $sql_where .=" and title like '%".$list['title']."%' ";
        }
        if(!empty($list['first'])){
            $sql_where .=" and upTime >'".$list['first']."' ";
        }
        if(!empty($list['timeend'])){
            $sql_where .=" and upTime <'".$list['timeend']."' ";
        }
	if(!empty($list['isfree'])){
	    if($list['isfree'] == 'free'){
            $sql_where .=" and prdpack_id = '1002261' ";
	    }else if($list['isfree'] == 'nfree'){
	    $sql_where .=" and prdpack_id = '1002381' ";
	    }
        }
        $count = $sql_count . $sql_from . $sql_where;
        $alwaysCount = $sql_count . $sql_from;
	$list = $sql_select . $sql_from . $sql_where . $sql_order . $sql_limit;
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();
	$res['alwaysCount'] = Yii::app()->db->createCommand($alwaysCount)->queryScalar();
	//var_dump($res);die;
        $res['list'] = SQLManager::queryAll($list);
        return $res;
    }

    public static function getReview($data,$list){
        $res = array();
        $sql_count = 'select count(id)';
        $sql_select = 'select id,vid,cp,title,language,info,actor,director,cate,type,upTime,flag';
        $sql_from = " from yd_video ";
        $sql_order = ' order by upTime desc';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        /*if(!empty($list['type'])){
            $sql_where = " where type like '%".$list['type']."%'";
            $count = $sql_count . $sql_from . $sql_where;
            $list = $sql_select . $sql_from . $sql_where . $sql_order . $sql_limit;
        }else{
            $count = $sql_count . $sql_from ;
            $list = $sql_select . $sql_from  . $sql_order . $sql_limit;
        }*/
        //$sql_where=" where title not regexp '\n\s*|：|/'";
        $sql_where=" where 1=1";
        if(!empty($list['review'])){
            foreach($list['review'] as $k=>$v){

                if($k=='0'){
                    $sql_where .=" and (flag = $v";
                }else{
                    $sql_where .=" or flag = $v";
                }

            }
            $sql_where .=")";
        }else{
            if($_SESSION['auth']=='1'){
               $sql_where .=" and flag in (1,2,3,4,5)";
            }
        }
        if(!empty($list['cp'])){
            foreach($list['cp'] as $k=>$v){
                if($k=='0'){
                    $sql_where .=" and (cp='$v'";
                }else{
                    $sql_where .=" or cp='$v'";
                }
            }
            $sql_where .=" )";
        }
        if(!empty($list['first'])){
            $sql_where .=" and upTime > '{$list['first']}'";
        }
        if(!empty($list['end'])){
            $sql_where .=" and upTime < '{$list['end']}'";
        }

        if(!empty($list['title'])){
           $sql_where.=" and title like '%{$list['title']}%'";
        }
        if(!empty($list['type'])){
           $sql_where.=" and type like '%{$list['type']}%'";
        }
        $count = $sql_count . $sql_from . $sql_where;
        $list = $sql_select . $sql_from . $sql_where . $sql_order . $sql_limit;
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();
        $res['list'] = SQLManager::queryAll($list);
	//$alwaysCount = $sql_count . $sql_from. $sql_where;
        //$res['alwaysCount'] = Yii::app()->db->createCommand($alwaysCount)->queryScalar();
        $sql_alawayscount = "select count(l.id) from yd_ver_reject_log l inner join yd_video v on v.vid=l.vid";
        $alwaysCount=Yii::app()->db->createCommand($sql_alawayscount)->queryScalar();
        $sql_video = "select count(id) from yd_video where flag in (1,2,3,4,5)";
        $video = Yii::app()->db->createCommand($sql_video)->queryScalar();
        $res['alwaysCount']=$alwaysCount+$video;
        return $res;
    }

    public static function getVideo($id){
        $res = array();
        $sql = "select l.title,v.id,l.id as lid,l.HDFlag,max(l.flag) as flag,l.videocodec,l.filesize,v.duration,v.bitrate from yd_video v,yd_video_list l where v.vid=l.vid and v.id=$id group by l.assetId";
        $res = SQLManager::queryAll($sql);
        return $res;
    }
    public static function getInfo($data,$title){
        $res = array();
        $sql_count = 'select count(id)';
        $sql_select = 'select id,ShowType,vid,cp,title,language,info,actor,director,cate,type,cTime,flag';
        $sql_from = ' from yd_video ';
        $sql_order = ' order by id desc';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        $sql_where=" where title like '%$title%'";
        $count = $sql_count . $sql_from . $sql_where;
        $list = $sql_select . $sql_from . $sql_where . $sql_order . $sql_limit;
        //var_dump($list);die;
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();


        $res['list'] = SQLManager::queryAll($list);
        return $res;
    }
    public static function getVideoList($vid,$id){
        $res = array();
        $sql = "select vid from yd_video where targetgroupassetid='$vid' order by `order`";
        //$sql = "select v.id,v.title,l.videocodec,l.filesize,v.duration,v.bitrate from yd_video v,yd_video_list l where v.vid=l.vid and v.id=$id and ";
        $tmp = SQLManager::queryAll($sql);
        //var_dump($tmp);die;
        if(!empty($tmp)){
            $list = VideoManager::String($tmp);
            $sqls = "select max(l.flag) as bfflag,v.id,v.title,l.videocodec,l.filesize,v.duration,v.bitrate from yd_video v,yd_video_list l where v.vid=l.vid and (v.vid in ($list) or v.id=$id) group by v.vid,l.assetId";
        }else{
            $sqls = "select max(l.flag) as bfflag,v.id,v.title,l.videocodec,l.filesize,v.duration,v.bitrate from yd_video v,yd_video_list l where v.vid=l.vid and v.id=$id group by l.assetId";
        }
        //echo $sqls;
        $res = SQLManager::queryAll($sqls);
        //var_dump($res);die;
        return $res;
    }

    public static function String($arr){
        $t = '';
        foreach ($arr as $v){
            $v = join(",",$v); //可以用implode将一维数组转换为用逗号连接的字符串，join是别名
            $temp[] = $v;
        }
        foreach($temp as $v){
            $t.="'$v'".",";
        }
        $t=substr($t,0,-1);  //利用字符串截取函数消除最后一个逗号
        return $t;
    }
    public static function getClassify($list){
        $res =array();
        $sql_select = "select v.id from yd_video v inner join yd_video_extra e on ";
        $sql_where = " v.flag='2' and v.vid=e.vid";
/*        if(!empty($list['type'])){
            $sql_where .=" and v.type='{$list['type']}'";
        }
*/
	 if(!empty($list['type'])){
            $arr=explode(' ',trim($_REQUEST['type']));
            foreach($arr as $k=>$v){
                if($k=='0'){
                    $sql_where .= " and (v.type = '$v'";
                }else{
                    $sql_where .= " or v.type = '$v'";
                }
            }
            $sql_where .=")";
        }
        if(!empty($list['cps'])){
            $arr=explode(' ',trim($_REQUEST['cps']));
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
            $arr=explode('/',trim($_REQUEST['keyword']));
            foreach($arr as $k=>$v){
                if($k=='0'){
                    $sql_where .= " and (v.keyword like '%$v%' ";
                }else{
                    $sql_where .= " or v.keyword like '%$v%' ";
                }
            }
            $sql_where .=")";
        }
        /*if(!empty($list['keyword'])){
            $sql_where .=" and v.`keyword` like '%{$list['keyword']}%'";
        }*/
	if(!empty($list['year'])){
            $sql_where .=" and e.`year` like '%{$list['year']}%'";
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
            //$sql_where .=" and e.score=$list['score']";
            $sql_where .=" and e.score >= {$list['score']}";
        }
	if(!empty($list['prize'])){
            $sql_where .=" and e.`prize` like '%{$list['prize']}%'";
        }
        $sql_group = " group by v.vid";
        $list = $sql_select . $sql_where .$sql_group;
//	var_dump($list);die;
        $res = SQLManager::queryAll($list);
        return $res;
    }
    public static function findlist($groupid){
        $res = array();
        $sql = "select v.title,v.cp,v.first_play_time,v.cTime,v.id,v.order,v.flag,v.delFlag,max(l.flag) as bfflag from yd_video v inner join yd_video_list l on (targetgroupassetid='$groupid' or v.vid='$groupid') and v.vid=l.vid group by v.title order by `order`";
        $res = SQLManager::queryAll($sql);
        return $res;
    }
    public static function Classify($list,$pid){
        $sql_select="select s.vid ";
        $sql_from=" from yd_ver_site s inner join yd_video v on s.vid=v.vid and s.gid=$pid inner join yd_video_extra e on e.vid=v.vid";
        $sql_group = " group by s.vid";
        $sql_where='';
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
        if(!empty($list['keyword'])){
            $arr=explode('/',trim($list['keyword']));
            $sql_where .=' and (';
            foreach($arr as $k=>$v){
                //$sql_lab = "select k.id from yd_ver_keyword k inner join yd_ver_sitelist s on s.name=k.type and k.keyword='$v' group by k.id";
                $sql_lab = "select k.id from yd_ver_keyword k where k.keyword='$v' group by k.id";
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
        if(!empty($list['type'])){
            $arr=explode(' ',trim($_REQUEST['type']));
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
            $arr=explode(' ',trim($_REQUEST['cps']));
            foreach($arr as $k=>$v){
                if($k=='0'){
                    $sql_where .= " and (v.cp = '$v'";
                }else{
                    $sql_where .= " or v.cp = '$v'";
                }
            }
            $sql_where .=")";
        }

        /*if(!empty($list['keyword'])){
            $sql_where .=" and v.`keyword` like '%{$list['keyword']}%'";
        }*/
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
            //$sql_where .=" and e.score=$list['score']";
            $sql_where .=" and v.score >= {$list['score']}";
        }
        if(!empty($list['prize'])){
            $sql_where .=" and e.`prize` like '%{$list['prize']}%'";
        }

        if(!empty($list['short'])){
            $sql_where .=" and v.`short` like '%{$list['short']}%'";
        }

        if(!empty($list['fee'])){
	    if($list['fee']==1){
            $sql_where .=" and v.`prdpack_id`='1002381'";}
        }else{
            $sql_where .=" and v.`prdpack_id`='1002261'";
        }

        $sql=$sql_select.$sql_from.$sql_where.$sql_group;
        $res=SQLManager::queryAll($sql);
        return $res;
   }
   public static function getAjax($data,$list){
        $res = array();
        $sql_select = "select * from yd_ver_content c inner join yd_video v on v.vid = c.vid and c.flag=0";
        $sql_where = "";
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        if(!empty($list['type'])){
            $arr=explode(' ',trim($list['type']));
            foreach($arr as $k=>$v){
                if($k=='0'){
                    $sql_where .= " and (v.type like  '%$v%'";
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
        if(!empty($list['title'])){
            $sql_where .=" and v.title like '%".$list['title']."%' ";
        }
        $sql_order = " order by c.cTime desc";
        $sql = $sql_select . $sql_where . $sql_order . $sql_limit;
        $sql_count ="select count(c.vid) from yd_ver_content c inner join yd_video v on v.vid = c.vid and c.flag=0";
        $count = $sql_count . $sql_where;
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();
        $res['list'] = SQLManager::queryAll($sql);
        return $res;
    }
    public static function getFirstAjax($data,$list){
        $res = array();
        $sitelist = VerSitelist::model()->findByPk($list['gid']);
        $id = $sitelist->attributes['pid'];
        $sql_select = "select * from yd_ver_site c inner join yd_video v on v.vid = c.vid and c.status=1 and c.gid=$id";
        $sql_where = "";
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        if(!empty($list['type'])){
            $arr=explode(' ',trim($list['type']));
            foreach($arr as $k=>$v){
                if($k=='0'){
                    $sql_where .= " and (v.type like  '%$v%'";
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
        if(!empty($list['title'])){
            $sql_where .=" and v.title like '%".$list['title']."%' ";
        }
        $sql_order = " order by c.cTime desc";
        $sql = $sql_select . $sql_where . $sql_order . $sql_limit;
        $sql_count ="select count(c.vid) from yd_ver_site c inner join yd_video v on v.vid = c.vid and c.status=1 and c.gid=$id";
        $count = $sql_count . $sql_where;
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();
        $res['list'] = SQLManager::queryAll($sql);
        return $res;
    }
    public static function getWallReview($data,$list){
        $res = array();
	
        $sql_count = 'select count(a.id)';
        $sql_select = 'select a.*,b.name,d.user';
        $sql_from = " from yd_ver_wall as a ";
        //$sql_where = " where";
        $sql_order = ' group by a.id order by a.addTime desc';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
	    $sql_join = ' left join yd_ver_station as b on a.gid=b.id LEFT JOIN yd_ver_work c ON b.id = c.stationId and c.flag = 5 ';
	    $sql_join_log = ' left join yd_ver_wall_reject as d on a.id=d.vid';
      //  $sql_where=" where 1=1";
        if($_SESSION['auth']=='1'){
            if(empty($list['type']) || $list['type'] == 1){
                $sql_where =" where a.flag in (1,2,3,4,5)";
            }else if($list['type'] == 2){
                $sql_where =" where a.flag = 6";
            }else{
                $sql_where =" where a.flag = 0";
            }
        }else{
            if(empty($list['type']) || $list['type'] == 1){
                $sql_where=" where  a.flag in (1,2,3,4,5)";
            }else if($list['type'] == 2){
                $sql_where=" where  a.flag = 6";
            }else{
                $sql_where=" where  a.flag = 0";
            }
        }


	 if(!empty($list['review'])){
            foreach($list['review'] as $k=>$v){

                if($k=='0'){
 //                   $sql_where .=" and (a.flag = $v";
 //               }else{
 //                   $sql_where .=" or a.flag = $v";
 //               }
            if(empty($list['type']) || $list['type'] == 1){
                    $sql_where .=" and ((a.flag = $v";
                 }else if($list['type'] == 2){
                 $sql_where .=" and ((a.flag = 6";
                 }else{

                 $sql_where .=" and ((a.flag = 0";
                }

                           if(!empty($list['gid'][$k])){
            $sql_where .= " and a.gid ='".$list['gid'][$k]['id']."'";
                $sql_where .=")";

        }

               }else{
                if(empty($list['type']) || $list['type'] == 1){
                            $sql_where .=" or (a.flag = $v";
                }else if($list['type'] == 2){
$sql_where .=" or (a.flag = 6";
 }else{
$sql_where .=" or (a.flag = 0";
}
                         if(!empty($list['gid'][$k])){
            $sql_where .= " and a.gid ='".$list['gid'][$k]['id']."'";
                        $sql_where .=")";
        }

                    }

            }
            $sql_where .=")";
        }
	if(!empty($list['stationId'])){
            $sql_where .=" and a.gid=".$list['stationId'];
        }

        if(!empty($list['workid'])){
            $sql_where .=" and a.workid in ({$list['workid']})";
        }
        //if(!empty($list['type'])){
         //   $sql_where = "  a.type like '%".$list['type']."%'";
        //}

        $count = $sql_count . $sql_from . $sql_join . $sql_where;
        $list = $sql_select . $sql_from . $sql_join .$sql_join_log . $sql_where . $sql_order . $sql_limit;
//        echo $list;die;
        //$res['count'
	    $sql = $sql_count . $sql_from ;//var_dump($sql);die;
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();
        $res['alwaysCount'] = Yii::app()->db->createCommand($sql)->queryScalar();
        $res['list'] = SQLManager::queryAll($list);
        return $res;
    }

	 public static function getTopicReview($data,$list){
        $res = array();
        $sql_count = 'select t1.id';
        $sql_select = 'select t1.*,t2.name,t3.name as topname';
        $sql_from = " from yd_ver_topic_review t1 left join yd_ver_sitelist t2 on t1.gid = t2.id left join yd_ver_sitelist t3 on t2.pid = t3.id";
        //$sql_where = " where";

        $sql_limit = ' limit '.$data['start'].','.$data['limit'];

                if(empty($list['type']) || $list['type'] == 1){
                $sql_where =" where t1.flag in (1,2,3,4,5)";
            }else if($list['type'] == 2){
                $sql_where =" where t1.flag = 6";
            }else{
                $sql_where =" where t1.flag = 0";
                }
	if(!empty($list['sitelist']) && !empty($list['typelist'])){
		$sql_where .= " and ( 1 = 2";
		foreach ($list['sitelist'] as $key => $value) {
				$gidlist = "";
				$typelist = "";
			foreach($value as $k1 => $v1){
				$gidlist .= $v1.",";			
			}

			foreach($list['typelist'][$key] as $k1 => $v1){
					$typelist .= $v1.",";
			}
			
			$gidlist =  substr($gidlist,0,strlen($gidlist)-1);
			$typelist =  substr($typelist,0,strlen($typelist)-1);
			$sql_where .= " or ( t1.gid in ($gidlist) and t1.flag in ($typelist) ) ";
			
			
		}
		$sql_where .=")";
	}   

	if(!empty($list['stationId'])){
            $sql_where .=" and t1.gid in (".$list['stationId'].")";
        }
	
		$sql_order = " ORDER BY t1.uptime desc";
        $count = $sql_count . $sql_from  . $sql_where;
        $list = $sql_select . $sql_from  . $sql_where . $sql_order . $sql_limit;
        //echo $list;
        //$res['count'

		$sql = $sql_count . $sql_from ;//var_dump($sql);die;
        $res['count'] = Yii::app()->db->createCommand($count)->queryScalar();
        $res['alwaysCount'] = Yii::app()->db->createCommand($sql)->queryScalar();
        $res['list'] = SQLManager::queryAll($list);
        return $res;
    }
      public static function getMsgReview($data,$list){
        $res = array();
	
        $sql_count = 'select count(a.id)';
        $sql_select = 'select a.*,b.name,d.user';
        
	    $sql_from = " from yd_ver_message as a left join yd_ver_station as b on a.gid=b.id LEFT JOIN yd_ver_work c ON b.id = c.stationId and c.flag = 4";
	    $sql_join = " left join yd_ver_message_reject as d on a.id=d.vid";
        //$sql_where = " where";
        $sql_order = ' group by a.id order by a.cTime desc';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
                    if($_SESSION['auth']=='1'){
		if(empty($list['type']) || $list['type'] == 1){
                $sql_where =" where a.flag in (1,2,3,4,5)";
            }else if($list['type'] == 2){
		$sql_where =" where a.flag = 6";
	    }else{
		$sql_where =" where a.flag = 0";
		}
		}else{
		 if(empty($list['type']) || $list['type'] == 1){
		$sql_where=" where  a.flag in (1,2,3,4,5)";
		}else if($list['type'] == 2){
		$sql_where=" where  a.flag = 6";
		 }else{
		$sql_where=" where  a.flag = 0";
}
		}
          
//	$sql_where=" where  1=1";
        if(!empty($list['review'])){
            foreach($list['review'] as $k=>$v){

                if($k=='0'){
		if(empty($list['type']) || $list['type'] == 1){
                    $sql_where .=" and ((a.flag = $v";
		 }else if($list['type'] == 2){
		 $sql_where .=" and ((a.flag = 6";
		 }else{

		 $sql_where .=" and ((a.flag = 0"; 
		}
    	     	
			   if(!empty($list['gid'][$k])){
            $sql_where .= " and a.gid ='".$list['gid'][$k]['id']."'";
		$sql_where .=")";

        }

	       }else{
                if(empty($list['type']) || $list['type'] == 1){
			    $sql_where .=" or (a.flag = $v";
		}else if($list['type'] == 2){
$sql_where .=" or (a.flag = 6";
 }else{
$sql_where .=" or (a.flag = 0";
}
            		 if(!empty($list['gid'][$k])){
            $sql_where .= " and a.gid ='".$list['gid'][$k]['id']."'";
			$sql_where .=")";
        }

		    }

            }
            $sql_where .=")";
       }         
         if(!empty($list['gud'])){
            $sql_where .= " and a.gid ='".$list['gud']."'";
        }
    
	

        if(!empty($list['workid'])){
            $sql_where .=" and a.workid in ({$list['workid']})";
        }
    //    if(!empty($list['type'])){
      //      $sql_where = "  a.type like '%".$list['type']."%'";
       // }

        $count = $sql_count . $sql_from;
        $whereCount = $sql_count . $sql_from. $sql_where;
        $list = $sql_select . $sql_from . $sql_join . $sql_where . $sql_order . $sql_limit;
    //echo $list;die;
	$res['alwaysCount'] = Yii::app()->db->createCommand($count)->queryScalar();
        $res['count'] = Yii::app()->db->createCommand($whereCount)->queryScalar();
	$res['list'] = SQLManager::queryAll($list);
        return $res;
    }

    public static function getMaterialReview($data,$list){
        $res = array();

        $sql_count = 'select count(a.id)';
        $sql_select = 'select a.*,b.name,b.id as gid,d.id as workid';
        //$sql_from = " from yd_ver_upload as a left join yd_ver_station as b on a.stationId=b.id LEFT JOIN yd_ver_work c ON b.id = c.stationId and c.flag = 8 and a.flag=1";
        $sql_from = " from yd_ver_upload as a left join yd_ver_station as b on a.stationId=b.id";
        $sql_join = " left join yd_ver_work as d on a.stationId=d.stationId where d.flag=8";
	//$sql_join="";
        $sql_order = ' group by a.id order by a.time desc';
        $sql_limit = ' limit '.$data['start'].','.$data['limit'];
        if(empty($list['type']) || $list['type'] == 1){
            $sql_where =" and a.flag in (1,2,3,4,5) and a.reason>0";
        }else if($list['type'] == 2){
            $sql_where =" and a.flag = 6 and a.reason>0";
        }else{
            $sql_where =" and a.flag = 0 and a.reason>0";
        }

        if(!empty($list['stationId'])){
            $sql_where .=" and a.stationId in (".$list['stationId'].")";
        }

        $count = $sql_count . $sql_from;
        $whereCount = $sql_count . $sql_from. $sql_where;
        $list = $sql_select . $sql_from . $sql_join . $sql_where . $sql_order . $sql_limit;
        $res['alwaysCount'] = Yii::app()->db->createCommand($count)->queryScalar();
        $res['count'] = Yii::app()->db->createCommand($whereCount)->queryScalar();
        $res['list'] = SQLManager::queryAll($list);
        return $res;
    }
}
