<?php
class MovieController extends Controller{

    public function actionIndex(){
        //在这里判断是否绑定
        $openid = $_REQUEST['openid'];
        $name = $_REQUEST['name'];
        $arr = Wxbox::model()->find("number ='$openid'");
        $stbid = $arr['stbid'];
        $this->render('index',array('stbid'=>$stbid,'name'=>$name,'openid'=>$openid));
    }

    public function actionPush(){

        if(!empty($_GET['param'])){
            include "XMPP.php";
            $stbid= $_REQUEST['stbid'];
            $param = $_REQUEST['param'];
            $message = '{body:{operation:"3",userId:"投屏",terminalId: "3332",srcJid:"1234@domain.com/ser",sessionId:"cp&=10@@action&=com.migu.portal@@param&='.$param.'"}}';


            $conn = new XMPPHP_XMPP('imshine.itv.cmvideo.cn', 5222, 'testmiguwechat', 'testmiguwechat', 'xmpphp', 'imshine.itv.cmvideo.cn', $printlog=true,$loglevel=XMPPHP_Log::LEVEL_INFO);
            try {
                $conn->connect();
                $conn->processUntil('session_start');
                $conn->presence();
                $conn->message(''.$stbid.'@imshine.itv.cmvideo.cn', $message);
                //$conn->message(''.Yii::app()->session['stbid'].'@imshine.itv.cmvideo.cn', $message);
                $conn->disconnect();
            }catch(XMPPHP_Exception $e) {
                die($e->getMessage());
            }
        }
        $this->render('push');
    }




    public function actionBd(){
        $stbid = strtoupper($_POST['stbid']);
        $data=$this->getStb($stbid);
        if(!empty($data['STBID'])){
            $stbid=$data['STBID'];
        }
        if($data['cp']<0){
            $data['cp']=8;
        }
        $name = isset($_POST['name']) ? $_POST['name']:'';
        $openid = isset($_POST['openid']) ? $_POST['openid']:'';
        $result = yii::app()->db->createCommand()->insert("yd_wxbox", array(
            'name' => $name,
            'number' => $openid,
            'stbid' => $stbid,
            'type' => $data['type'],
            'province' => $data['province'],
            'city' => $data['city'],
            'cp'=>$data['cp']
        ));
    }


    public function actiongetStbs(){
        $stbid=strtoupper($_REQUEST['stbid']);
        $data=$this->getStb($stbid);
        if(empty($data['STBID'])){
            echo json_encode(array('code'=>404,'msg'=>'请绑定正确的序列号'));
        }else{
            echo json_encode($data['STBID']);
        }
    }


    public function getStb($stbid){
        $http_adr = 'http://bngt.itv.cmvideo.cn:8095/scspProxy';
        $data = '<?xml version="1.0" encoding="UTF-8"?>
                    <message module="SCSP" version="1.1">
                        <header action="REQUEST" command="SCSPSTBQUERY"/>
                        <body>
                            <scspSTBQuery stbId ="'.$stbid.'" param=" "/>
                        </body>
                    </message>';
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type:textml;Charset=utf-8',
                'content' => $data
            )
        );
        $context = stream_context_create($opts);
        $tmp = file_get_contents($http_adr, false, $context);
        $p = xml_parser_create();
        xml_parse_into_struct($p, $tmp, $vals, $index);
        xml_parser_free($p);
        $SCSPSTBQUERY = $index['SCSPSTBQUERY'][0];
        $resultDesc['province'] = $vals[$SCSPSTBQUERY]['attributes']['PROVINCEID'];
        $resultDesc['city'] = $vals[$SCSPSTBQUERY]['attributes']['CITY'];
        $resultDesc['type'] = $vals[$SCSPSTBQUERY]['attributes']['ECCODE'];
        $resultDesc['STBID']=$vals[$SCSPSTBQUERY]['attributes']['STBID'];
        $resultDesc['cp'] = $vals[$SCSPSTBQUERY]['attributes']['COPYRIGHTID'];
        $resultDesc['cp'] = $resultDesc['cp']-699210;
        return $resultDesc;
    }

}
?>
