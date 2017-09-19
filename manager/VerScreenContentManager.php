<?php
class VerScreenContentManager extends MvUi
{
    public static function getAll($gid)
    {
        $res = array();
        $sql_select = "select cid,id,pic,screenGuideId,width,height,tType,type,cp,uType,`order`,videoUrl from yd_ver_screen_content";
        $sql_where = " where screenGuideId=$gid and `delFlag`=0 ";
        $sql_order = " order by addTime";
        $sql = $sql_select.$sql_where.$sql_order;
        $res = SQLManager::queryAll($sql);
        return $res;
    }

    public static function getAllCopy($gid)
    {
        $res = array();
        $sql_select = "select cid,id,pic,screenGuideId,width,height,tType,type,cp,uType,`order`,videoUrl from yd_ver_screen_content_copy";
        $sql_where = " where screenGuideId=$gid and delFlag in (0,1,2,3) and flag not in (8)";
        $sql_order = " order by addTime ";
        $sql = $sql_select.$sql_where.$sql_order;
        $res = SQLManager::queryAll($sql);
        return $res;
    }

    public static function getOne($screenGuideId,$order)
    {
        $res = array();
        $sql_select = "select cid,id,pic,screenGuideId,width,height,tType,type,cp,action,uType,param,title,x,y,`order`,epg,videoUrl from yd_ver_screen_content_copy";
        $sql_where = " where `screenGuideId`=$screenGuideId AND `order`='$order'";
        $sql_order = " order by addTime";
        $sql = $sql_select.$sql_where.$sql_order;
        $res = SQLManager::queryAll($sql);
        return $res;
    }
    
    public static function getIdOne($id)
    {
        $res = array();
        $sql_select = "select cid,id,pic,screenGuideId,width,height,tType,type,cp,action,param,uType,title,x,y,`order`,epg,videoUrl from yd_ver_screen_content_copy";
        $sql_where = " where `id`=$id ";
        $sql = $sql_select.$sql_where;
        $res = SQLManager::queryAll($sql);
        if(empty($res)){
           $sql_select = "select cid,id,pic,screenGuideId,width,height,tType,type,cp,action,param,uType,title,x,y,`order`,epg,videoUrl from yd_ver_screen_content_copy";
        $sql_where = " where `id`=$id ";
        $sql = $sql_select.$sql_where;
        $res = SQLManager::queryAll($sql);
        }
        return $res;
    }	
	
    public static function updateData($data)
    {
    	$title    = trim($data['title']);
        $type     = trim($data['type']);
        $Type     = trim($data['tType']);
        if($Type>1){
           $uType    = '0';
        }else{
           $uType    = trim($data['uType']);
        }
        $cp       = trim($data['cp']);
        $gid      = trim($data['screenGuideId']);
        $epg      = trim($data['epg']);
	if(empty($epg)){
		$epg = '0';
	}
        $action   = trim($data['action']);
        $param    = trim($data['param']);
        //$pic      = trim($data['key']);
	if($data['key'] <> '/file/3.png'){
	    $pic = basename($data['key']);
	    $screenContent = VerScreenContentCopy::model()->findByPk($data['id']);
	    //$pic = 'http://pic-portal-v3.itv.cmvideo.cn:8083/file/'.$pic;
	    $pic = FTP_PATH.$pic;
	    if($screenContent->attributes['pic']==$pic){

	    }else{
               //Common::synchroPic(basename($data['key']));
	    }	
        }else{
	    $pic = '/file/3.png';
	}
	$upTime   = time();
        $width    = trim($data['width']);
        $height   = trim($data['height']);
        $x        = trim($data['x']);
        $y        = trim($data['y']);
        $delFlag  = '0';
        $order    = trim($data['order']);
        $id       = trim($data['id']);
        $cid      = trim($data['cid']);
        $videoUrl = trim($data['videoUrl']);
        $flag = '1';
        $sql_update = "update yd_ver_screen_content_copy set ";
        $sql_set = " `title`='$title',`flag`=$flag,`type`='$type',`tType`='$Type',`cp`='$cp',`screenGuideId`='$gid',`action`='$action',`param`='$param',`pic`='$pic',`upTime`='$upTime',`width`='$width',`height`='$height',`x`='$x',`y`='$y',`delFlag`='$delFlag',`order`='$order',`uType`='$uType',`cid`='$cid',`epg`=$epg,`videoUrl`='$videoUrl' ";
        $sql_where = " where id=$id";
        $sql  = $sql_update.$sql_set.$sql_where;
		if($pic = "/file/3.png"){
                        $sql_insert = "insert into yd_ver_screen_content_del select * from yd_ver_screen_content_copy where id=$id";
                        $res1 = SQLManager::execute($sql_insert);
                }
        $res = SQLManager::execute($sql);
        return $res;
    }

}

