<?php


/**
* 
*/
class DemoController extends Controller{
    public function actionDemo(){
        if(empty(Yii::app()->session['user'])){
            $user_info = $_REQUEST;
            Yii::app()->session['user'] = $user_info;
            $sql = "select * from yd_wxbox where number = '{$user_info['openid']}'";
            $list = Yii::app()->db->createCommand($sql)->queryAll();
            if(!empty($list)){
                Yii::app()->session['stbid'] = $list[0]['stbid'];
            }
        }else{
            $openid=Yii::app()->session['user']['openid'];
            $sql = "select * from yd_wxbox where number = '$openid'";
            $list = Yii::app()->db->createCommand($sql)->queryAll();
            if(empty($list)){
                //$this->render('demo');
            }else{
                Yii::app()->session['stbid'] = $list[0]['stbid'];
            }
        }
        $this->render('demo',array('list'=>$list));
    }


    public function actionDemos(){
        //var_dump(Yii::app()->session['stbid']);die;
        include "XMPP.php";
        $ope = isset($_GET['ope']) ? $_GET['ope'] : '';
        $stbid = isset($_GET['stbid'])?$_GET['stbid']:'';
        $message = '{body:{operation:"5",keycode:"'.$ope.'"}}';
        //var_dump($message);
        var_dump(Yii::app()->session['stbid']);
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
    public function actiongetStbs(){
        $stbid=strtoupper($_REQUEST['stbid']);
        $data=$this->getStb($stbid);
        if(empty($data['STBID'])){
            echo json_encode(array('code'=>404,'msg'=>'请绑定正确的序列号'));
        }else{
            echo json_encode($data['STBID']);
        }
    }

    public function ActionBd()
    {
//        echo $_GET['openid'];die();
        if (empty($_POST)) {
            if (empty(Yii::app()->session['user'])) {
                $user_info = $_REQUEST;
                Yii::app()->session['user'] = $user_info;
                $sql = "select * from yd_wxbox where number = '{$user_info['openid']}'";
                //$sql = "select * from yd_wxbox where number = 'o2S_xwEP0gz3pmEsl-jWNDPw3ARs'";
                $list = Yii::app()->db->createCommand($sql)->queryAll();
                if (empty($list)) {
                    $this->render('bd', array('list' => $list));
                } else {
                    $this->render('rebd', array('list' => $list));
                }

            } else {
                $openid = Yii::app()->session['user']['openid'];
                //$sql = "select * from yd_wxbox where number = 'o2S_xwEP0gz3pmEsl-jWNDPw3ARs'";
                $sql = "select * from yd_wxbox where number = '{$openid}'";
                $list = Yii::app()->db->createCommand($sql)->queryAll();
                if (empty($list)) {
                    $this->render('bd', array('list' => $list));
                } else {
                    $this->render('rebd', array('list' => $list));
                }
            }
        }else{
            if (empty($_POST['id'])){
                $stbid = strtoupper($_POST['stbid']);
                $data=$this->getStb($stbid);
                if(!empty($data['STBID'])){
                $stbid=$data['STBID'];
                }
                if($data['cp']<0){
                    $data['cp']=8;
                }
                Yii::app()->session['stbid'] = $stbid;
                $name = Yii::app()->session['user']['nickname'];
                $openid = Yii::app()->session['user']['openid'];
                $result = yii::app()->db->createCommand()->insert("yd_wxbox", array(
                    'name' => $name,
                    'number' => $openid,
                    'stbid' => $stbid,
                    'type' => $data['type'],
                    'province' => $data['province'],
                    'city' => $data['city'],
                    'cp'=>$data['cp']
                ));
                //$sql = "select * from yd_wxbox where number = 'o2S_xwEP0gz3pmEsl-jWNDPw3ARs'";
                $sql = "select * from yd_wxbox where number = '$openid'";
                $list = Yii::app()->db->createCommand($sql)->queryAll();
                $this->render('rebd', array('list' => $list));
            }else {
                if (empty($_POST['stbid'])) {
                    $sql = "select * from yd_wxbox where id = '{$_POST['id']}'";
                    $list = Yii::app()->db->createCommand($sql)->queryAll();
                    $this->render('bd', array('list' => $list));
                } else {
                    $openid = Yii::app()->session['user']['openid'];
                    $stbid=strtoupper($_POST['stbid']);
                    $data=$this->getStb($stbid);
                    if(!empty($data['STBID'])){
                    $stbid=$data['STBID'];
                    }else{
                       echo json_encode(array('code'=>404,'msg'=>'请绑定正确的序列号'));die;
                    }
                    if($data['cp']<0){
                          $cp=8;
                    }else{

                    $cp = $data['cp'];
                    }

                    Yii::app()->db->createCommand()->update('yd_wxbox', array(
                        'stbid' =>$stbid,'cp'=>$cp), 'id=:id', array(
                        ':id' => $_POST['id']));
                    //$sql = "select * from yd_wxbox where number = 'o2S_xwEP0gz3pmEsl-jWNDPw3ARs'";
                    $sql = "select * from yd_wxbox where number = '$openid'";
                    $list = Yii::app()->db->createCommand($sql)->queryAll();
                    Yii::app()->session['stbid'] = $list[0]['stbid'];
                    $this->render('rebd', array('list' => $list));
                }
            }
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
    
    public function ActionGsbd(){
        //$code = !empty($_REQUEST['code'])?$_REQUEST['code']:'0';
        //echo $code;
        if (empty($_POST)) {
           if (empty(Yii::app()->session['gsuser'])) {
                $code = !empty($_REQUEST['code'])?$_REQUEST['code']:'';
                $user_info = $this->WeixinUser($code);
                //var_dump($user_info);die;
                Yii::app()->session['gsuser'] = $user_info;
                $sql = "select * from yd_wxbox where number = '{$user_info['openid']}'";
                $list = Yii::app()->db->createCommand($sql)->queryAll();
                if (empty($list)) {
                    $this->render('gsbd', array('list' => $list));
                } else {
                    $this->render('gsrebd', array('list' => $list));
                }
           }else{
                $openid = Yii::app()->session['gsuser']['openid'];
                $sql = "select * from yd_wxbox where number = '{$openid}'";
                $list = Yii::app()->db->createCommand($sql)->queryAll();
                if (empty($list)) {
                    $this->render('gsbd', array('list' => $list));
                } else {
                    $this->render('gsrebd', array('list' => $list));
                }

            }

        } else {
            if (empty($_POST['id'])) {
                $stbid = strtoupper($_POST['stbid']);
                Yii::app()->session['gsstbid'] = $stbid;
                $name = Yii::app()->session['gsuser']['nickname'];
                $openid = Yii::app()->session['gsuser']['openid'];
                $data=$this->getStb($stbid);
                if(!empty($data['STBID'])){
                $stbid=$data['STBID'];
                }
                if($data['cp']<0){
                    $data['cp']=8;
                }
                $result = yii::app()->db->createCommand()->insert("yd_wxbox", array(
                    'name' => $name,
                    'number' => $openid,
                    'stbid' => $stbid,
                    'type' => $data['type'],
                    'province' => $data['province'],
                    'city' => $data['city'],
                    'cp'=>$data['cp']
                ));
                $sql = "select * from yd_wxbox where number = '$openid'";
                $list = Yii::app()->db->createCommand($sql)->queryAll();
                $this->render('gsrebd', array('list' => $list));
            } else {
                if (empty($_POST['stbid'])) {
                    $sql = "select * from yd_wxbox where id = '{$_POST['id']}'";
                    $list = Yii::app()->db->createCommand($sql)->queryAll();
                    $this->render('gsbd', array('list' => $list));
                } else {
                    $openid = Yii::app()->session['gsuser']['openid'];
                    $stbids=strtoupper($_POST['stbid']);
                    $data=$this->getStb($stbids);
                    if(!empty($data['STBID'])){
                        $stbid=$data['STBID'];
                    }
                    if($data['cp']<0){
                        $cp=8;
                    }else{

                        $cp = $data['cp'];
                    }
                    Yii::app()->db->createCommand()->update('yd_wxbox', array(
                        'stbid' =>$stbid,'cp'=>$cp),  'id=:id', array(
                        ':id' => $_POST['id']));
                    $sql = "select * from yd_wxbox where number = '$openid'";
                    $list = Yii::app()->db->createCommand($sql)->queryAll();
                    //Yii::app()->session['gsstbid'] = $list[0]['stbid'];
                    $this->render('gsrebd', array('list' => $list));
                }
            }
        }
    }
    public function actionGsdemo(){
        if(empty(Yii::app()->session['gsuser'])){
            $code = !empty($_REQUEST['code'])?$_REQUEST['code']:'';
            $user_info = $this->WeixinUser($code);
            Yii::app()->session['gsuser'] = $user_info;
            $sql = "select * from yd_wxbox where number = '{$user_info['openid']}'";
            $list = Yii::app()->db->createCommand($sql)->queryAll();
            if(!empty($list)){
                Yii::app()->session['gsstbid'] = $list[0]['stbid'];
            }
         }else{
            $openid=Yii::app()->session['gsuser']['openid'];
            $sql = "select * from yd_wxbox where number = '$openid'";
            $list = Yii::app()->db->createCommand($sql)->queryAll();
            if(empty($list)){
               //$this->render('gsdemo');
            }else{
                Yii::app()->session['gsstbid'] = $list[0]['stbid'];
            }
        }
        $this->render('gsdemo',array('list'=>$list));
    }



}
