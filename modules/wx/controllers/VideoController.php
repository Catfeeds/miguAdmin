<?php
    class VideoController extends Controller{
        public function actionIndex(){
            $this->render('index');
        }


        public function actionDetial(){
            $user_info = $_GET;
            $sql = "select stbid from yd_wxbox where number = '{$user_info['openid']}'";
            //$sql = "select stbid from yd_wxbox where number ='o2S_xwEP0gz3pmEsl-jWNDPw3ARs'";
            $list = Yii::app()->db->createCommand($sql)->queryAll();
            if($list){
                $stbid = $list[0]['stbid'];
            }else{
                $stbid ='';
            }
            $this->render('detial',array('stbid'=>$stbid));
        }

        public function actionAdd(){
            $wxvideo = new WxVideo();
            $stbid=$_POST['stbid'];
            //$data = $this->getStb($stbid);
            $url = $_POST['url'];
            $wxvideo->stbid=$stbid;
            $wxvideo->cp=2;
            $wxvideo->url=$url;
            if(!$wxvideo->save()){
                var_dump($wxvideo->getErrors());
            };
        }

        public function actionGetvideo(){
            if(empty($_REQUEST['stbid'])) die(json_encode(array('flag'=>0)));
            $stbid=$_REQUEST['stbid'];
            //$stbid='004001FF002008A0000100227E02C0F2';
            $info = WxVideoManager::getVideo($stbid);
            if(empty($info)){
                echo json_encode(array('flag' => 0));
            }else{
                echo json_encode(array('flag'=>1,'list'=>$info[0]));
            }

        }

        public function actionDel(){
            if(empty($_REQUEST['id'])) die(json_encode(array('flag'=>0)));
            $id = $_REQUEST['id'];
            //$id = 1;
            $wxvideo = WxVideo::model()->deleteByPk($id);
            if($wxvideo){
                echo json_encode(array('flag' => 1));
            }else{
                echo json_encode(array('flag' => 0));
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
            $resultDesc['cp'] = $vals[$SCSPSTBQUERY]['attributes']['COPYRIGHTID'];
            $resultDesc['cp'] = $resultDesc['cp']-699210;
            return $resultDesc;
        }
    }
?>
