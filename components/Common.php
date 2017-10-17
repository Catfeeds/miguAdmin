<?php

/**
 * Created by PhpStorm.
 * User: xiangl
 * Date: 2015/8/10 0010
 * Time: 13:37
 */
class Common
{
	public static function getStr($end=32){
		static $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
		$s = '';
		while(strlen($s) <= $end){
			$s .= mb_strcut($str,rand(1,strlen($str)),1,'utf-8');
		}
		return $s;
	}

	function encode($string = '', $skey = 'cxphp') {
		$strArr = str_split(base64_encode($string));
		$strCount = count($strArr);
		foreach (str_split($skey) as $key => $value)
			$key < $strCount && $strArr[$key].=$value;
		return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
	}
	/**
	 * 简单对称加密算法之解密
	 * @param String $string 需要解密的字串
	 * @param String $skey 解密KEY
	 * @author Anyon Zou <zoujingli@qq.com>
	 * @date 2013-08-13 19:30
	 * @update 2014-10-10 10:10
	 * @return String
	 */
	function decode($string = '', $skey = 'cxphp') {
		$strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
		$strCount = count($strArr);
		foreach (str_split($skey) as $key => $value)
			$key <= $strCount && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
		return base64_decode(join('', $strArr));
	}

        /**
	 * 通过ftp方式实现图片同步
	 * @param String $img 需要同步的图片文件名
	 * @return null
	 */
        public static function synchroPic($img){
            $ftp_server = array('10.200.17.144','10.200.17.156');
            $ftp_user = 'miguftp';
            $ftp_passwd = 'miguftp!QAZ0147';
            $img = trim($img);
            //echo $img;
            foreach($ftp_server as $ftp){
                $conn = ftp_connect($ftp);
                ftp_login($conn, $ftp_user, $ftp_passwd);
		//ftp_put($conn, $img, Yii::app()->basePath.'/../file/'.$img, FTP_BINARY);
		//ftp_put($conn, $img, '/opt/local/nginx/html/file/'.$img, FTP_BINARY);
		if(ftp_size($conn,$img) == '-1'){
		    //ftp_delete($conn,'/opt/local/nginx/html/file/'.$img);
		    ftp_put($conn, $img, '/opt/local/nginx/html/file/'.$img, FTP_BINARY);	
		}else{
		    //ftp_put($conn, $img, '/opt/local/nginx/html/file/'.$img, FTP_BINARY);	
		}
	    }

//            @unlink(Yii::app()->basePath.'/../file/'.$img);
        }
        public static function getUser($username,$flag){
			//var_dump($username);
			$user = VerAdmin::model()->find("nickname='$username'");
			$sql = "select w.cp,k.type from yd_ver_work w inner join yd_ver_worker k on w.id=k.workid and k.uid='{$user->attributes['id']}' and w.flag=$flag";
                        $tmp = SQLManager::queryAll($sql);
			$type=array();
			$cp=array();
			if(!empty($tmp)){
				foreach($tmp as $k=>$v){
					$type[$k]=$v['type'];
					$cp[$k]=$v['cp'];
				}
			}
			$cp = array_unique($cp);
			//$review = VerReviewWork::model()->findAll("uid='{$user->attributes['id']}'");
			$sql = "select w.cp,k.type as status from yd_ver_work w inner join yd_ver_review_work k on w.id=k.workid and k.uid='{$user->attributes['id']}' and w.flag=$flag";
			$tmlplist = SQLManager::queryAll($sql);
			$review = array();
                        $cp2 = array();
			if(!empty($tmlplist)){
				foreach($tmlplist as $k=>$v){
					$review[$k]=$v['status'];
                                         $cp2[$k]=$v['cp'];
				}
			}
			$cp2 = array_unique($cp2);
                        $cp = array_merge($cp,$cp2);
			$res['status']=$type;
			$res['review']=$review;
			$res['cp']=$cp;
			return $res;
		}

		public static function workid($username,$flag){
			$user = VerAdmin::model()->find("nickname='$username'");
			//var_dump($user);die;
			$sql = "select w.type from yd_ver_work w inner join yd_ver_review_work k on w.id=k.workid and k.uid='{$user->attributes['id']}' and w.flag=$flag";
			$tmp = SQLManager::queryRow($sql);
			$res = $tmp['type'];
			return $res;
		}

        public static function EditWorkid($username,$flag){
            $user = VerAdmin::model()->find("nickname='$username'");
            //var_dump($user);die;
            $sql = "select w.id from yd_ver_work w inner join yd_ver_worker k on w.id=k.workid and k.uid='{$user->attributes['id']}' and w.flag=$flag";
            $tmp = SQLManager::queryRow($sql);
            $res = $tmp['id'];
            return $res;
        }
	
     //session  存入uid
    public static function getUserInfo()
    {
        $userInfo = array();
        $userInfo['uid']        = $_SESSION['userid'];
        $userInfo['username']   = $_SESSION['username'];
        $uid = $userInfo['uid'];
        $sql = "select a.type,a.uid,b.stationId from yd_ver_worker as a left join yd_ver_work as b on a.workid=b.id where a.uid=$uid";
        $res = SQLManager::queryAll($sql);
        return $res;
    }

    public static function getWorkInfo()
    {
        $uid = $_SESSION['userid'];
        $sql = "select a.type,b.type as maxLength,b.stationId from yd_ver_review_work as a left join yd_ver_work as b on b.id=a.workid  where a.uid=$uid and b.flag=3";  //确定当前用户是几审用户以及此工作流需要几审
       // $sql = "select a.type,b.type as maxLength,b.stationId from yd_ver_review_work as a left join yd_ver_work as b on b.id=a.workid  where a.uid=7";  //测试调试用
        $res = SQLManager::queryAll($sql);
        return $res;
    }


    public static function getWork($type,$nid){
	if($type=='2'){
           $sql="select pid from yd_ver_sitelist where id=$nid";
           $list = SQLManager::queryRow($sql);
           $gid= !empty($list['pid'])?$list['pid']:"0";
           $sql="select pid from yd_ver_sitelist where id=$gid";
           $list = SQLManager::queryRow($sql);
           $gid=!empty($list['pid'])?$list['pid']:"0";

        }else{
           $sql="select pid from yd_ver_sitelist where id=$nid";
           
	   $list = SQLManager::queryRow($sql);
           
	   $gid=!empty($list['pid'])?$list['pid']:"0";
           $sql="select pid from yd_ver_sitelist where id=$gid";
           $list = SQLManager::queryRow($sql);
           $gid=!empty($list['pid'])?$list['pid']:"0";
           $sql="select pid,name from yd_ver_sitelist where id=$gid";
           $list = SQLManager::queryRow($sql);
           $gid=!empty($list['pid'])?$list['pid']:"0";
           $gid = VerStation::model()->find("name='{$list['name']}'");
           $gid = $gid->attributes['id'];
        }
        $uid = $_SESSION['userid'];
        $sql = "select w.cp,k.type from yd_ver_work w inner join yd_ver_worker k on k.workid=w.id and w.stationId=$gid and k.uid=$uid";
        $tmp = SQLManager::queryAll($sql);
                        $type=array();
                        $cp=array();
                        if(!empty($tmp)){
                                foreach($tmp as $k=>$v){
                                        $type[$k]=$v['type'];
                                        $cp[$k]=$v['cp'];
                                }
                        }
                        $cp = array_unique($cp);
        $res['status']=$type;
        $res['cp']=$cp;
        return $res;   
    }
    
    public static function fspost($img){
           $host = '10.200.85.109';
           $port = 8080;
           $errno = '';
           $errstr = '';
           $timeout = 30;
           $url = '/curl.php';
           $param = array(
              'img' => $img
           );
           $url = $url.'?'.http_build_query($param);
           // create connect
           $fp = fsockopen($host, $port, $errno, $errstr, $timeout);
           if(!$fp){
                return false;
           }
           // send request
           $out = "GET ${url} HTTP/1.1\r\n";
           $out .= "Host: ${host}\r\n";
           $out .= "Connection:close\r\n\r\n";
           fwrite($fp, $out);

           usleep(2000);

           fclose($fp);

        }
      
        public static function getStation($username,$flag){
		//var_dump($username);
		$user = VerAdmin::model()->find("nickname='$username'");
		$sql = "select w.cp,k.type,w.stationId from yd_ver_work w inner join yd_ver_worker k on w.id=k.workid and k.uid='{$user->attributes['id']}' and w.flag=$flag";
		$tmp = SQLManager::queryAll($sql);
		$type=array();
		$cp=array();
		$stationId=array();
		if(!empty($tmp)){
			foreach($tmp as $k=>$v){
				$type[$k]=$v['type'];
				$cp[$k]=$v['cp'];
				$stationId[$k]=$v['stationId'];
			}
		}
		$cp = array_unique($cp);
		$stationId = array_unique($stationId);
		//$review = VerReviewWork::model()->findAll("uid='{$user->attributes['id']}'");
		$sql = "select w.cp,k.type,w.stationId as status from yd_ver_work w inner join yd_ver_review_work k on w.id=k.workid and k.uid='{$user->attributes['id']}' and w.flag=$flag";
		$tmlplist = SQLManager::queryAll($sql);
		$review = array();
		$cp2 = array();
		$stationId2=array();
		if(!empty($tmlplist)){
			foreach($tmlplist as $k=>$v){
				$review[$k]=$v['status'];
				$cp2[$k]=$v['cp'];
				//$stationId2[$k]=$v['stationId'];
			}
		}
		$cp2 = array_unique($cp2);
		$stationId2 = array_unique($stationId2);
		$cp = array_merge($cp,$cp2);
		$stationId = array_merge($stationId,$stationId2);
		$res['status']=$type;
		$res['review']=$review;
		$res['cp']=$cp;
		$res['stationId']=$stationId;
		return $res;
	}

}
