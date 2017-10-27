<?php
define('__ROOT__','http://'.$_SERVER["HTTP_HOST"]);
$dirname = dirname(__FILE__).'/db.php';
if(strpos($dirname,'nginx/html') > 0){
	define('DB_NAME','root');
	define('DB_PASS','chinamobile');
	define('DB_STR','mysql:host=172.17.91.195;port=3306;dbname=mobile');
	//define('DB_STR','mysql:host=10.200.18.154;port=3306;dbname=mobile');
	//define('DB_STR','mysql:host=localhost;port=3306;dbname=mobile');
}else{
	define('DB_NAME','root');
	//define('DB_PASS','root');
	define('DB_PASS','');
	//define('DB_STR','mysql:host=127.0.0.1;port=3306;dbname=mobile');
	define('DB_STR','mysql:host=127.0.0.1;port=3306;dbname=html');
}
define('FTP_PATH','http://117.144.248.58:8082/file/');
//define('FTP_PATH','http://pic-portal-v3.itv.cmvideo.cn:8083/file/');
