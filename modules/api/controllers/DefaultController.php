<?php

class DefaultController extends PController{
    public function actionIndex(){
        try{
            $this->ReturnData(MSG::SUCCESS,MSG::SUCCESS_INFO);
	}catch (ExceptionEx $ex){
            $this->ReturnData(MSG::ERROR,$ex->getMessage());
	}catch (Exception $e){
            $this->log($e->getMessage());
            $this->ReturnData(MSG::ERROR,MSG::ERROR_INFO);
	}
    }

    public function actionSetContent(){
        header("Content-Type:text/html;Charset=utf-8");
        try{
            $time = time();
            $xm = file_get_contents("php://input"); 
//            $filename = Yii::app()->basePath . '/upload/'.$time.'.xml';
            $filename = '/opt/upload/'.$time.'.xml';
            $fp = fopen($filename, "w");
            if(@fwrite($fp, $xm)){
                echo "success";
            }else{
                echo "fail";
            }
            fclose($fp);
            
            $p = xml_parser_create();
            xml_parse_into_struct($p, $xm, $values, $tags);
            xml_parser_free($p);
            $res = array();
            foreach($tags as $k => $v){
                foreach($v as $n){
                    $res[] = $values[$n];
                }
            }

            $reset = array();
            $option = 0;
            foreach($res as $u=>$s){
                if($s['tag'] == 'ADI:OPENGROUPASSET') $option = 1;
                if($s['tag'] == 'ADI:DROPGROUPASSET') $option = 2;
                if($s['tag'] == 'ADI:REPLACEGROUPASSET') $option = 3;
                
                $title = str_replace('VOD:','',$s['tag']);
                if(strtolower($title) == 'vodrelease'){
                    if(isset($s['attributes']) && is_array($s['attributes'])){
                        $reset['cp'] = $s['attributes']['PROVIDERID'];
                        $reset['vid'] = $s['attributes']['ASSETID'];
                    }
                }
                if(strtolower($title) == 'titlefull'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'classification'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'category'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'lastnamefirst'){
                    if(empty($reset['actor']) && empty($reset['director'])){
                        $reset['actor'] = $s['value'];
                    }
                    if(!empty($reset['actor']) && $s['value'] !== $reset['actor'] && empty($reset['director'])){
                        $reset['director'] = $s['value'];
                    }
                }
                if(strtolower($title) == 'keyword'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'summarymedium'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'summaryshort'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'year'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'language'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'image'){
                    if(isset($s['attributes']) && is_array($s['attributes'])){
                        if(!isset($reset[strtolower($title)][$u])){
                            $reset[strtolower($title)][$u]['title'] = $s['attributes']['FILENAME'];
                            $reset[strtolower($title)][$u]['size'] = $s['attributes']['FILESIZE'];
                            $reset[strtolower($title)][$u]['md5'] = $s['attributes']['MD5CHECKSUM'];
                            $reset[strtolower($title)][$u]['url'] = $s['attributes']['TRANSFERCONTENTURL'];
                        }
                    }
                }
                if(strtolower($title) == 'video'){
                    if(isset($s['attributes']) && is_array($s['attributes'])){
                        if(!isset($reset[strtolower($title)][$u])){
                            $reset[strtolower($title)][$u]['title'] = $s['attributes']['FILENAME'];
                            $reset[strtolower($title)][$u]['size'] = $s['attributes']['FILESIZE'];
                            $reset[strtolower($title)][$u]['md5'] = $s['attributes']['MD5CHECKSUM'];
                            $reset[strtolower($title)][$u]['url'] = $s['attributes']['TRANSFERCONTENTURL'];
                        }
                    }
                }
            }
            
            $condition = 'vid=:vid and cp=:cp';
            $params = array(':vid'=>$reset['vid'],':cp'=>$reset['cp']);
            if($option == 2){
                $video2 = new Video();
                $video2->updateAll(array('status'=>'1'), $condition, $params);
            }elseif(!empty($reset['titlefull'])){
                if($option == 3){
                    $video3 = new Video();
                    $pic3 = new VideoPic();
                    $list3 = new VideoList();
                    $video3->deleteAll($condition, $params);
                    $pic3->deleteAll($condition, $params);
                    $list3->deleteAll($condition, $params);
                }
                $video = new Video();
                $video->vid = $reset['vid'];
                $video->cp = $reset['cp'];
                $video->title = $reset['titlefull'];
                $video->keyword = empty($reset['keyword'])?'':$reset['keyword'];
                $video->year = empty($reset['year'])?'':$reset['year'];
                $video->info = empty($reset['summarymedium'])?'':$reset['summarymedium'];
                $video->short = empty($reset['summaryshort'])?'':$reset['summaryshort'];
                $video->type = $reset['classification'];
                $video->cate = $reset['category'];
                $video->actor = empty($reset['actor'])?'':$reset['actor'];
                $video->director = empty($reset['director'])?'':$reset['director'];
                $video->language = empty($reset['language'])?'':$reset['language'];
                $video->cTime = $time;
                if(!$video->save()){
                    LogWriter::logModelSaveError($video,__METHOD__,$video->attributes);
                    throw new ExceptionEx('信息保存失败');
                }
                if(!empty($reset['image'])){
                    foreach($reset['image'] as $vpic){
                        $pic = new VideoPic();
                        $pic->vid = $reset['vid'];
                        $pic->cp = $reset['cp'];
                        $pic->title = $vpic['title'];
                        $pic->size = $vpic['size'];
                        $pic->md5 = $vpic['md5'];
                        $pic->url = $vpic['url'];
                        $pic->cTime = $time;
                        $pic->save();
                    }
                }
                if(!empty($reset['video'])){
                    foreach($reset['video'] as $vlist){
                        $list = new VideoList();
                        $list->vid = $reset['vid'];
                        $list->cp = $reset['cp'];
                        $list->title = $vlist['title'];
                        $list->size = $vlist['size'];
                        $list->md5 = $vlist['md5'];
                        $list->url = $vlist['url'];
                        $list->cTime = $time;
                        $list->save();
                    }
                }
            } 
        }catch (ExceptionEx $ex){
            $this->ReturnData(MSG::ERROR,$ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
            $this->ReturnData(MSG::ERROR,MSG::ERROR_INFO);
        }
    }
    
    public function actionInputOneContent(){
        header("Content-Type:text/html;Charset=utf-8");
        try{
            $xm = Yii::app()->basePath . '/2015/3000856142.xml';
            $xm = file_get_contents($xm);
            $p = xml_parser_create();
            xml_parse_into_struct($p, $xm, $values, $tags);
            xml_parser_free($p);
            if(sizeof($tags)<2) throw new ExceptionEx('文件内容错误');
            $res = array();
            foreach($tags as $k => $v){
                foreach($v as $n){
                    $res[] = $values[$n];
                }
            }

            $time = time();
            $reset = array();
            $option = 0;
            foreach($res as $u=>$s){
                if($s['tag'] == 'ADI:OPENGROUPASSET') $option = 1;
                if($s['tag'] == 'ADI:DROPGROUPASSET') $option = 2;
                if($s['tag'] == 'ADI:REPLACEGROUPASSET') $option = 3;
                
                $title = str_replace('VOD:','',$s['tag']);
                if(strtolower($title) == 'vodrelease'){
                    if(isset($s['attributes']) && is_array($s['attributes'])){
                        $reset['cp'] = $s['attributes']['PROVIDERID'];
                        $reset['vid'] = $s['attributes']['ASSETID'];
                    }
                }
                if(strtolower($title) == 'titlefull'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'classification'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'category'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'lastnamefirst'){
                    if(empty($reset['actor']) && empty($reset['director'])){
                        $reset['actor'] = $s['value'];
                    }
                    if(!empty($reset['actor']) && $s['value'] !== $reset['actor'] && empty($reset['director'])){
                        $reset['director'] = $s['value'];
                    }
                }
                if(strtolower($title) == 'keyword'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'summarymedium'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'summaryshort'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'year'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'language'){
                    if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                }
                if(strtolower($title) == 'image'){
                    if(isset($s['attributes']) && is_array($s['attributes'])){
                        if(!isset($reset[strtolower($title)][$u])){
                            $reset[strtolower($title)][$u]['title'] = $s['attributes']['FILENAME'];
                            $reset[strtolower($title)][$u]['size'] = $s['attributes']['FILESIZE'];
                            $reset[strtolower($title)][$u]['md5'] = $s['attributes']['MD5CHECKSUM'];
                            $reset[strtolower($title)][$u]['url'] = $s['attributes']['TRANSFERCONTENTURL'];
                        }
                    }
                }
                if(strtolower($title) == 'video'){
                    if(isset($s['attributes']) && is_array($s['attributes'])){
                        if(!isset($reset[strtolower($title)][$u])){
                            $reset[strtolower($title)][$u]['title'] = $s['attributes']['FILENAME'];
                            $reset[strtolower($title)][$u]['size'] = $s['attributes']['FILESIZE'];
                            $reset[strtolower($title)][$u]['md5'] = $s['attributes']['MD5CHECKSUM'];
                            $reset[strtolower($title)][$u]['url'] = $s['attributes']['TRANSFERCONTENTURL'];
                        }
                    }
                }
            }
            
            if(empty($reset['vid']) || empty($reset['cp']) || empty($reset['titlefull']))  throw new ExceptionEx('文件内容错误');
            $condition = 'vid=:vid and cp=:cp';
            $params = array(':vid'=>$reset['vid'],':cp'=>$reset['cp']);

            if($option == 2){
                $video2 = new Video();
                $video2->updateAll(array('status'=>'1'), $condition, $params);
            }else{
                if($option == 3){
                    $video3 = new Video();
                    $pic3 = new VideoPic();
                    $list3 = new VideoList();
                    $video3->deleteAll($condition, $params);
                    $pic3->deleteAll($condition, $params);
                    $list3->deleteAll($condition, $params);
                }
                $video = new Video();
                $video->vid = $reset['vid'];
                $video->cp = $reset['cp'];
                $video->title = $reset['titlefull'];
                $video->keyword = empty($reset['keyword'])?'':$reset['keyword'];
                $video->year = empty($reset['year'])?'':$reset['year'];
                $video->info = empty($reset['summarymedium'])?'':$reset['summarymedium'];
                $video->short = $reset['summaryshort'];
                $video->type = $reset['classification'];
                $video->cate = $reset['category'];
                $video->actor = empty($reset['actor'])?'':$reset['actor'];
                $video->director = empty($reset['director'])?'':$reset['director'];
                $video->language = empty($reset['language'])?'':$reset['language'];
                $video->cTime = $time;
                if(!$video->save()){
                    LogWriter::logModelSaveError($video,__METHOD__,$video->attributes);
                    throw new ExceptionEx('信息保存失败');
                }
                if(!empty($reset['image'])){
                    foreach($reset['image'] as $vpic){
                        $pic = new VideoPic();
                        $pic->vid = $reset['vid'];
                        $pic->cp = $reset['cp'];
                        $pic->title = $vpic['title'];
                        $pic->size = $vpic['size'];
                        $pic->md5 = $vpic['md5'];
                        $pic->url = $vpic['url'];
                        $pic->cTime = $time;
                        $pic->save();
                    }
                }
                if(!empty($reset['video'])){
                    foreach($reset['video'] as $vlist){
                        $list = new VideoList();
                        $list->vid = $reset['vid'];
                        $list->cp = $reset['cp'];
                        $list->title = $vlist['title'];
                        $list->size = $vlist['size'];
                        $list->md5 = $vlist['md5'];
                        $list->url = $vlist['url'];
                        $list->cTime = $time;
                        $list->save();
                    }
                }
            } 
        }catch (ExceptionEx $ex){
            $this->ReturnData(MSG::ERROR,$ex->getMessage());
        }catch (Exception $e){
            var_dump($e->getMessage());
            $this->log($e->getMessage());
            $this->ReturnData(MSG::ERROR,MSG::ERROR_INFO);
        }
    }
    
    public function actionInputManyContent(){
        header("Content-Type:text/html;Charset=utf-8");
        try{
            $dir = Yii::app()->basePath . '/2014/';
            $filenames = scandir($dir);
            foreach ($filenames as $fname){
                $fname_arr = explode('.',$fname);
                if($fname_arr[0] <= 3000778401) continue; 
                $xm = $dir.$fname;
                if(is_file($xm)){
                    $xm = file_get_contents($xm);
                    $p = xml_parser_create();
                    xml_parse_into_struct($p, $xm, $values, $tags);
                    xml_parser_free($p);
                    if(sizeof($tags)<2)  continue;
                    $res = array();
                    foreach($tags as $k => $v){
                        foreach($v as $n){
                            $res[] = $values[$n];
                        }
                    }
                    
                    $time = time();
                    $reset = array();
                    $option = 0;
                    foreach($res as $u=>$s){
                        if($s['tag'] == 'ADI:OPENGROUPASSET') $option = 1;
                        if($s['tag'] == 'ADI:DROPGROUPASSET') $option = 2;
                        if($s['tag'] == 'ADI:REPLACEGROUPASSET') $option = 3;
                
                        $title = str_replace('VOD:','',$s['tag']);
                        if(strtolower($title) == 'vodrelease'){
                            if(isset($s['attributes']) && is_array($s['attributes'])){
                                $reset['cp'] = $s['attributes']['PROVIDERID'];
                                $reset['vid'] = $s['attributes']['ASSETID'];
                            }
                        }
                        if(strtolower($title) == 'titlefull'){
                            if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                        }
                        if(strtolower($title) == 'classification'){
                            if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                        }
                        if(strtolower($title) == 'category'){
                            if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                        }
                        if(strtolower($title) == 'lastnamefirst'){
                            if(empty($reset['actor']) && empty($reset['director'])){
                                $reset['actor'] = $s['value'];
                            }
                            if(!empty($reset['actor']) && $s['value'] !== $reset['actor'] && empty($reset['director'])){
                                $reset['director'] = $s['value'];
                            }
                        }
                        if(strtolower($title) == 'keyword'){
                            if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                        }
                        if(strtolower($title) == 'summarymedium'){
                            if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                        }
                        if(strtolower($title) == 'summaryshort'){
                            if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                        }
                        if(strtolower($title) == 'year'){
                            if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                        }
                        if(strtolower($title) == 'language'){
                            if(isset($s['value'])) $reset[strtolower($title)] = $s['value'];
                        }
                        if(strtolower($title) == 'image'){
                            if(isset($s['attributes']) && is_array($s['attributes'])){
                                if(!isset($reset[strtolower($title)][$u])){
                                    $reset[strtolower($title)][$u]['title'] = $s['attributes']['FILENAME'];
                                    $reset[strtolower($title)][$u]['size'] = $s['attributes']['FILESIZE'];
                                    $reset[strtolower($title)][$u]['md5'] = $s['attributes']['MD5CHECKSUM'];
                                    $reset[strtolower($title)][$u]['url'] = $s['attributes']['TRANSFERCONTENTURL'];
                                }
                            }
                        }
                        if(strtolower($title) == 'video'){
                            if(isset($s['attributes']) && is_array($s['attributes'])){
                                if(!isset($reset[strtolower($title)][$u])){
                                    $reset[strtolower($title)][$u]['title'] = $s['attributes']['FILENAME'];
                                    $reset[strtolower($title)][$u]['size'] = $s['attributes']['FILESIZE'];
                                    $reset[strtolower($title)][$u]['md5'] = $s['attributes']['MD5CHECKSUM'];
                                    $reset[strtolower($title)][$u]['url'] = $s['attributes']['TRANSFERCONTENTURL'];
                                }
                            }
                        }                      
                    }
                    
                    if(empty($reset['vid']) || empty($reset['cp']) || empty($reset['titlefull']))  continue;
                    $condition = 'vid=:vid and cp=:cp';
                    $params = array(':vid'=>$reset['vid'],':cp'=>$reset['cp']);
                    if($option == 2){
                        $video2 = new Video();
                        $video2->updateAll(array('status'=>'1'), $condition, $params);
                    }else{
                        if($option == 3){
                            $video3 = new Video();
                            $pic3 = new VideoPic();
                            $list3 = new VideoList();
                            $video3->deleteAll($condition, $params);
                            $pic3->deleteAll($condition, $params);
                            $list3->deleteAll($condition, $params);
                        }
                        $video = new Video();
                        $video->vid = $reset['vid'];
                        $video->cp = $reset['cp'];
                        $video->title = $reset['titlefull'];
                        $video->keyword = empty($reset['keyword'])?'':$reset['keyword'];
                        $video->year = empty($reset['year'])?'':$reset['year'];
                        $video->info = empty($reset['summarymedium'])?'':$reset['summarymedium'];
                        $video->short = empty($reset['summaryshort'])?'':$reset['summaryshort'];
                        $video->type = $reset['classification'];
                        $video->cate = $reset['category'];
                        $video->actor = empty($reset['actor'])?'':$reset['actor'];
                        $video->director = empty($reset['director'])?'':$reset['director'];
                        $video->language = empty($reset['language'])?'':$reset['language'];
                        $video->cTime = $time;
                        if(!$video->save()){
                            LogWriter::logModelSaveError($video,__METHOD__,$video->attributes);
                            throw new ExceptionEx('信息保存失败');
                        }
                        if(!empty($reset['image'])){
                            foreach($reset['image'] as $vpic){
                                $pic = new VideoPic();
                                $pic->vid = $reset['vid'];
                                $pic->cp = $reset['cp'];
                                $pic->title = $vpic['title'];
                                $pic->size = $vpic['size'];
                                $pic->md5 = $vpic['md5'];
                                $pic->url = $vpic['url'];
                                $pic->cTime = $time;
                                $pic->save();
                            }
                        }
                        if(!empty($reset['video'])){
                            foreach($reset['video'] as $vlist){
                                $list = new VideoList();
                                $list->vid = $reset['vid'];
                                $list->cp = $reset['cp'];
                                $list->title = $vlist['title'];
                                $list->size = $vlist['size'];
                                $list->md5 = $vlist['md5'];
                                $list->url = $vlist['url'];
                                $list->cTime = $time;
                                $list->save();
                            }
                        }
                    } 
                }
            }
        }catch (ExceptionEx $ex){
            $this->ReturnData(MSG::ERROR,$ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
            $this->ReturnData(MSG::ERROR,MSG::ERROR_INFO);
        }
    }
    
    public function actionInputApps(){
        header("Content-Type:text/html;Charset=utf-8");
        //$tmp = file_get_contents("http://117.144.248.60/portal-ott/ott/system/myapp.jsp?areaId=02");
$tmp = file_get_contents("https://117.135.172.156/sns/oauth2/access_token?appid=wx3f9bb59f5ba78010&secret=5f17728db47200477af5b2d9943211b0&code=041a81f46aad9fa40523755fbfca391y&grant_type=authorization_code");
        $res = json_decode($tmp,true);
var_dump($res);die;
        $newlist = $res['newAppList']['contentList'];
        $hotlist = $res['hotAppList']['contentList'];
        $time = time();
        foreach ($newlist as $new){
            $app = new Apps();
            $app->appId = $new['id'];
            $app->name = $new['name'];
            $app->typeId = $new['appType'];
            $app->typeName = $new['appTypeName'];
            $app->pic = $new['imageUrl'];
            $app->url = $new['linkUrl'];
            $app->status = '1';
            $app->cTime = $time;
            if(!$app->save()){
                LogWriter::logModelSaveError($video,__METHOD__,$video->attributes);
                throw new ExceptionEx('信息保存失败');
            }
        }
        foreach ($hotlist as $hot){
            $app = new Apps();
            $app->appId = $hot['id'];
            $app->name = $hot['name'];
            $app->typeId = $hot['appType'];
            $app->typeName = $hot['appTypeName'];
            $app->pic = $hot['imageUrl'];
            $app->url = $hot['linkUrl'];
            $app->status = '2';
            $app->cTime = $time;
            if(!$app->save()){
                LogWriter::logModelSaveError($video,__METHOD__,$video->attributes);
                throw new ExceptionEx('信息保存失败');
            }
        }
    }

    public function actionTest(){
        //$ftp_server = '172.17.92.186';
        //$ftp_user = 'miguftp';
        //$ftp_passwd = 'miguftp2015';
        
        //连接FTP服务器
        //$conn = ftp_connect($ftp_server);
        //使用username和password登录
       // ftp_login($conn, $ftp_user, $ftp_passwd);
        //下载文件
       // ftp_get($conn, '/usr/tmp/test.txt', 'test.txt', FTP_ASCII);
        //上传文件
        //ftp_put($conn, 'test.jpg', '/usr/tmp/xxx.jpg', FTP_BINARY);

        //Common::synchroPic('d22d8040980982f22b8db8a70f76b59f.jpg');

/*        $http_adr = 'http://172.17.90.133:8989/cmcc/interface';
        $data = '<?xml version="1.0" encoding="UTF-8"?>
                    <message module="SCSP" version="1.1">
                        <header action="REQUEST" command="AUTHORIZE"/>
                        <body>
                            <authorize userId="363016321" terminalId="004001FF003182A001E5000763F5602E" contentId="8835439207829435185" subContentId="" systemId="0" copyRightId="699211" consumeLocal="02" consumeScene="01" consumeBehaviour="02"  path="" token="d53725f1d762cc618a66c48c9f9888b4"/>
                        </body>
                    </message>';
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type:text/html;Charset=utf-8',
                'content' => $data
            )
        );
        
        $context = stream_context_create($opts);
        $tmp = file_get_contents($http_adr, false, $context);
        var_dump($tmp);  */

$http_adr = 'http://bngt.itv.cmvideo.cn:8095/scspProxy';
        $data = '<?xml version="1.0" encoding="UTF-8"?>
                    <message module="SCSP" version="1.1">
                        <header action="REQUEST" command="SCSPSTBQUERY"/>
                        <body>
                            <scspSTBQuery stbId ="009901FF0018100000010019F0FFFD83" param=" "/>
                        </body>
                    </message>';
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type:text/html;Charset=utf-8',
                'content' => $data
            )
        );
        $context = stream_context_create($opts);
        $tmp = file_get_contents($http_adr, false, $context);
        var_dump($tmp);
    }

    public function actionGetWeixin(){
        if (empty($_REQUEST['stbid']))           throw new ExceptionEx('序列号不能为空');
        $appid = "wx3f9bb59f5ba78010";
        $appsecret = "5f17728db47200477af5b2d9943211b0";
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $jsoninfo = json_decode($output, true);
        $access_token = $jsoninfo["access_token"];

        $id = Bdtmp::model()->find("stbid = '".$_REQUEST['stbid']."'");
        if(!$id){
            $tmp = new Bdtmp();
            $tmp->stbid = $_REQUEST['stbid'];
            $tmp->save();
            $id = $tmp->attributes['id'];
        }else{
            $id = $id->attributes['id'];
        }
        //临时
        $qrcode='{"expire_seconds": 1800,"action_name": "QR_SCENE","action_info": {"scene": {"scene_id": '.$id.'}}}';
        
        $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
        $result=$this ->https_post($url,$qrcode);
        $jsoninfo=json_decode($result,true);
        $ticket=$jsoninfo["ticket"];

        $tpurl="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";

        $this->redirect($tpurl);
    }

    public  function https_post($url,$data=null){
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
        if(!empty($data)){
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        }
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        $output=curl_exec($curl);
        curl_close($curl);
        return $output;
    }


   public  function downloadImageFromWeiXin($url){
        $ch=curl_init($url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_NOBODY,0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $package=curl_exec($ch);
        $httpinfo=curl_getinfo($ch);
        curl_close($ch);
        return array_merge(array('body'=>$package,array('header'=>$httpinfo)));
    }






/*

    public function actiongetParameter(){
	echo 1;die();
        $this->valid(); //这个位置
        //$this->responseMsg();

    }

    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //验证签名
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }
    public function responseMsg()
    {
        //微信发送的数据 这里接收
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //提取数据
        if (!empty($postStr)){

            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            switch($RX_TYPE)
            {
                case "text":
                    $resultStr = $this->handleText($postObj);
                    break;
                case "event":
                    $resultStr = $this->handleEvent($postObj);
                    break;
                default:
                    $resultStr = "Unknow msg type: ".$RX_TYPE;
                    break;
            }
            echo $resultStr;
        }else {
            echo "";
            exit;
        }
    }

    public function handleEvent($object)
    {
        $contentStr = "";
        switch ($object->Event)
        {
            case "subscribe":
                $contentStr = "感谢关注";
                if (isset($object->EventKey)){
                    $con=substr($object->EventKey,8);
                    $openid=$object->FromUserName;
                    $appid = "wx3f9bb59f5ba78010";
                    $appsecret = "5f17728db47200477af5b2d9943211b0";
                    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    $jsoninfo = json_decode($output, true);
                    $access_token = $jsoninfo["access_token"];
                    $url="https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    $this->getId($con,$output);
                }
                break;
            case "SCAN":
                echo '';
                die();
            default :
                $contentStr = "Unknow Event: ".$object->Event;
                break;
        }
        $resultStr = $this->responseText($object, $contentStr);
        return $resultStr;
    }
    public function responseText($object, $content, $flag=0)
    {
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>%d</FuncFlag>
                    </xml>";
        $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content, $flag);
        return $resultStr;
    }
    public function handleText($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";
        if(!empty( $keyword ))
        {
            $msgType = "text";
            $contentStr = "该公众号暂时不支持文本消息";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
        }else{
            echo "Input something...";
        }
    }
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = "Qumeng";
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
*/














    public function actiongetId(){
        $id=$_POST['id'];
        $yonghu=$_POST['yonghu'];
        $jsoninfo = json_decode($yonghu, true);
        $openid = $jsoninfo["openid"];
        $nickname = $jsoninfo["nickname"];

//	$id = 43;
//	$openid = 'o2S_xwMXDEwft7CP-eDywP5v2Bto';
//	$nickname = 'Steven';
//file_put_contents("/opt/tmp/test.txt",$_POST);
//$filename = '/opt/tmp/test.txt';
//            $fp = fopen($filename, "w");
//            @fwrite($fp, $id.'//'.$openid);
//            fclose($fp);
        
        $stbid = array_map(create_function('$record','return $record->attributes;'), Bdtmp::model()->findAll("id = ".$id));
        $stbid = isset($stbid[0]['stbid']) ? $stbid[0]['stbid'] : '';
        $arr =   array_map(create_function('$record','return $record->attributes;'), User::model()->findAll("stbid = '".$stbid."'"));
        $type = isset($arr[0]['type'])? $arr[0]['type'] : 'z86';
        $province = isset($arr[0]['province'])? $arr[0]['province'] : '02';
        $city = isset($arr[0]['city'])? $arr[0]['city'] : '02134';
	$cp   = isset($arr[0]['cp'])? $arr[0]['cp'] : '1';

	$res = array_map(create_function('$record','return $record->attributes;'), Wxbox::model()->findAll("number = '".$openid."'"));
        if(!empty($res)){
            $ids = $res[0]['id'];
            $del = Wxbox::model()->deleteByPk($ids);
        }
	
        $wxbox = new Wxbox();
        $wxbox->number   = $openid;
        $wxbox->name     = $nickname;
        $wxbox->type     = $type;
        $wxbox->province = $province;
        $wxbox->city     = $city;
        $wxbox->stbid    = $stbid;
	$wxbox->cp       = $cp;
//var_dump($wxbox);
        if(!$wxbox->save()){
            LogWriter::logModelSaveError($wxbox,__METHOD__,$wxbox->attributes);
            $this->die_json(array('code'=>404,'msg'=>'信息保存失败'));
        }else{
//	echo 1;
            $del = Bdtmp::model()->deleteByPk($id);
            if(!$del){
                $this->die_json(array('code'=>404,'msg'=>'删除失败'));
            }
        }


    }

    public function die_json($arr = array()){
        if(empty($arr)) $arr = array();
        die(json_encode($arr));
    }

}
