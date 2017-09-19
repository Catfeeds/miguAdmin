<?php
class MovieController extends Controller{

    public function actionIndex(){
        //在这里判断是否绑定
       $openid = $_REQUEST['openid'];
       $arr = Wxbox::model()->find("number ='$openid'");
       $stbid = $arr['stbid'];
       $id = $arr['id'];
       $this->render('index',array('stbid'=>$stbid,'id'=>$id));
    }

    public function actionPush(){

        if(!empty($_GET['param'])){
	        include "XMPP.php";
	        $stbid = $_REQUEST['stbid'];
	        $message = '{cp:"10",action:"com.migu.portal",param:"'.$_REQUEST['param'].'"}';


	        $conn = new XMPPHP_XMPP('imshine.itv.cmvideo.cn', 5222, 'testmiguwechat', 'testmiguwechat', 'xmpphp', 'imshine.itv.cmvideo.cn', $printlog=true,$loglevel=XMPPHP_Log::LEVEL_INFO);
	        try {
	            $conn->connect();
	            $conn->processUntil('session_start');
	            $conn->presence();
	            $conn->message(''.$stbid.'@imshine.itv.cmvideo.cn', $message);
	            $conn->disconnect();
	        }catch(XMPPHP_Exception $e) {
	            die($e->getMessage());
	        }
        }
        $this->render('push');
    }
}
?>
