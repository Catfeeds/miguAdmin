<?php

/**
 * Created by PhpStorm.
 * User: xiangl
 * Date: 2015/8/19 0019
 * Time: 11:48
 */
class GuideController extends MController{
    public function actionDefault(){
        $this->render('default');
    }

    public function actionIndex(){
        $parent = 0;
        if(!empty($_GET['id'])) $parent = intval($_GET['id']);
        $p = MvGuide::model()->findByPk($parent);
        $list = MvGuideManager::getforparent($parent);
        $this->render('index',array('guide'=>$list,'p'=>$p));
    }

    public function actionReport(){
        $page = 10;
        $data = $this->getPageInfo($page);
        $total = MvGuideManager::getTotal();
        //$tmp = MvGuideManager::getVname($data);
        $tmp = MvGuideManager::getProvince($data);
        $province = ProvinceManager::getList();
        $num=$tmp['total'];
        foreach($tmp['list'] as $key=>$val){
            foreach($province as $k=>$v){
                if($val['province']==$v['provinceCode']){
                    $val['pro']=$v['provinceName'];
                }
                $list[$key]=$val;
            }
        }

        $url = $this->createUrl($this->action->id);
        $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage']);
        $this->render('report',array('total'=>$total,'list'=>$list,'num'=>$num,'page'=>$pagination));
    }


    public function actionReports(){
        $page = 10;
        $pro=$_REQUEST['pro'];
        $data = $this->getPageInfo($page);
        $total = MvGuideManager::getPro($pro);
        $tmp = MvGuideManager::getVname($data,$pro);
        $list = $tmp['list'];
        $num=$tmp['total'];
        $url = $this->createUrl($this->action->id);
        $pagination = $this->renderPagination($url,$tmp['count'],$page,$data['currentPage']);
        $this->render('reports',array('total'=>$total,'list'=>$list,'num'=>$num,'page'=>$pagination));
    }


    public function actionContentNum()
    {
        //$data = ActiveOnepicManager::getList();
        //$province = ActiveOnepicManager::getProvinceSelect();
        $city = ActiveOnepicManager::getCitySelect();
        $province = Province::model()->findAll("1=1 order by id asc");
        // var_dump($city);die;
        //$provinceCode = '';
       // $cityCode = $city['CityCode'];
        $p = isset($p) ? $p : '';
        $cityCode = isset($cityCode) ? $cityCode : '';
        $c = isset($c) ? $c : '';
        //$this->render('ContentNum'/*'province'=>$province,'provinceCode'=>$provinceCode,'cityCode'=>$cityCode,'city'=>$city*/);
        $this->render('contentnum',array('province'=>$province,'provinceCode'=>$p,'city'=>$cityCode,'cityCode'=>$c));
    }
    
    public function actionContentData()
    {
        $first = strtotime($_REQUEST['first']);
        $end = strtotime($_REQUEST['end']);
        if(empty($first) && empty($end)){
            $last = date("Ymd",strtotime("-1 day"));
            $first= strtotime($last);
            $now = date("Ymd",strtotime("0 day"));
            $end = strtotime($now)-1;
        }
        $keyword = $_REQUEST['keyword'];
        $p = $_REQUEST['page'];
        $province=$_REQUEST['province'];
        $city=$_REQUEST['city'];
        $data = ActiveOnepicManager::getClick($keyword,$first,$end,$p,$province,$city);
        $max = count($data['res']);
        for($i = 0 ; $i< $max ; $i++){
            $pro = $data['res'][$i]['province'];
            $city = $data['res'][$i]['city'];
            $data['res'][$i]['province'] = ActiveOnepicManager::getProvince($pro);
            $data['res'][$i]['city'] = ActiveOnepicManager::getCity($city);
        }
        $list['list'] = [];
        foreach ($data['res'] as $key => $v) {

               if($v['epg'] == '1'){
                    $v['epg'] = '首页';
               }else if($v['epg'] == '2'){
                    $v['epg'] = '影视';
               }else if($v['epg'] == '3'){
                    $v['epg'] = '教育';
               }else if($v['epg'] == '4'){
                    $v['epg'] = '游戏';
               }else if($v['epg'] == '5'){
                    $v['epg'] = '应用';
               }else if($v['epg'] == '6'){
                    $v['epg'] = '咪咕专区';
               }else if($v['epg'] == '7'){
                    $v['epg'] = '综艺专区';
               }else if($v['epg'] == '8'){
                    $v['epg'] = '华数专区';
               }else if($v['epg'] == '9'){
                    $v['epg'] = '咪咕极光';
               }else if($v['epg'] == '10'){
                    $v['epg'] = '咪咕现场秀';
               }else if($v['epg'] == '11'){
                    $v['epg'] = '咪咕精彩';
               }else if($v['epg'] == '12'){
                    $v['epg'] = '甘肃专区';
               }else if($v['epg'] == '13'){
                    $v['epg'] = '音乐';
               }else if($v['epg'] == '14'){
                    $v['epg'] = '体育';
               }else if($v['epg'] == '15'){
                    $v['epg'] = '南传专区';
               }else if($v['epg'] == '16'){
                    $v['epg'] = '少儿';
               }    

               if($v['cp'] == 1){
                     $v['cp'] =  '华数';
               }else if($v['cp'] == 2){
                     $v['cp'] = '百视通';
               }else if($v['cp'] == 3){
                     $v['cp'] = '未来电视';
               }    

               $list['list'][] = $v;
        }
      $list['count'] = $data['count'];
       // var_dump($list);die;
       echo json_encode($list);

    }

    public function actionOut(){
        $first = strtotime($_REQUEST['first']);
        $end = strtotime($_REQUEST['end']);
        if(empty($first) && empty($end)){
            $last = date("Ymd",strtotime("-1 day"));
            $first= strtotime($last);
            $now = date("Ymd",strtotime("0 day"));
            $end = strtotime($now)-1;
        }
        $keyword = $_REQUEST['keyword'];
        $province=$_REQUEST['province'];
        $city=$_REQUEST['city'];
        $data = ActiveOnepicManager::getClicks($keyword,$first,$end,$province,$city);
        $max = count($data['res']);
        for($i = 0 ; $i< $max ; $i++){
            $pro = $data['res'][$i]['province'];
            $city = $data['res'][$i]['city'];
            $data['res'][$i]['province'] = ActiveOnepicManager::getProvince($pro);
            $data['res'][$i]['city'] = ActiveOnepicManager::getCity($city);
        }
        $arr = [];
        foreach ($data['res'] as $key => $v) {

            if($v['epg'] == '1'){
                $v['epg'] = '首页';
            }else if($v['epg'] == '2'){
                $v['epg'] = '影视';
            }else if($v['epg'] == '3'){
                $v['epg'] = '教育';
            }else if($v['epg'] == '4'){
                $v['epg'] = '游戏';
            }else if($v['epg'] == '5'){
                $v['epg'] = '应用';
            }else if($v['epg'] == '6'){
                $v['epg'] = '咪咕专区';
            }else if($v['epg'] == '7'){
                $v['epg'] = '综艺专区';
            }else if($v['epg'] == '8'){
                $v['epg'] = '华数专区';
            }else if($v['epg'] == '9'){
                $v['epg'] = '咪咕极光';
            }else if($v['epg'] == '10'){
                $v['epg'] = '咪咕现场秀';
            }else if($v['epg'] == '11'){
                $v['epg'] = '咪咕精彩';
            }else if($v['epg'] == '12'){
                $v['epg'] = '甘肃专区';
            }else if($v['epg'] == '13'){
                $v['epg'] = '音乐';
            }else if($v['epg'] == '14'){
                $v['epg'] = '体育';
            }else if($v['epg'] == '15'){
                $v['epg'] = '南传专区';
            }else if($v['epg'] == '16'){
                $v['epg'] = '少儿';
            }

            if($v['cp'] == 1){
                $v['cp'] =  '华数';
            }else if($v['cp'] == 2){
                $v['cp'] = '百视通';
            }else if($v['cp'] == 3){
                $v['cp'] = '未来电视';
            }

            $arr[] = $v;
        }
        //var_dump($list);die;
        $result = $this->Excel($arr);
    }

    public function Excel($arr){
        Yii::$enableIncludePath = false;
        Yii::import('application.extensions.PHPExcel.PHPExcel', 1);
        $fileName=date("Ymdhis", time());
        //引入PHPExcel库文件（路径根据自己情况）
        //include 'PHPExcel.php';
        //创建对象
        $excel = new PHPExcel();

        //Excel表格式,这里简略写了8列
        $letter = array('A','B','C','D','E','F','G','H');
        //表头数组
        $tableheader = array('省','市','牌照方','导航编号','导航名称','海报标题','统计日期','点击量');
        //填充表头信息
        for($i = 0;$i < count($tableheader);$i++) {
            $excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
        }

        // var_dump($arr);die;
        //填充表格信息
        for ($i = 2;$i <= count($arr) + 1;$i++) {
            $j = 0;
            foreach ($arr[$i - 2] as $key=>$value) {
                $excel->getActiveSheet()->setCellValue("$letter[$j]$i","$value");
                $j++;
            }
        }
        //创建Excel输入对象
        $write = new PHPExcel_Writer_Excel5($excel);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:charset/UTF-8");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        header('Content-Disposition:attachment;filename="'.$fileName.'.xls"');
        header("Content-Transfer-Encoding:binary");
        $write->save('php://output');
    }

    public function actionAdd(){
        try{
                $guide = new MvGuide();
                $guide->addTime = time();

            if(!empty($_POST)){
                $post = $_POST;
                if(empty($post['name'])) throw new ExceptionEx('请输入导航名称');
                if(empty($post['uType']))throw new ExceptionEx('请选择链接类型');
                if(empty($post['url'])) throw new ExceptionEx('请输入链接');
                if(!empty($_GET['id']) && $_GET['id'] == $post['pid']){
                    throw new ExceptionEx('自己不能作为自己的父类');
                }

                $sql = 'select `order` from yd_mv_guide order by `order` desc limit 1';
                $return = Yii::app()->db->createCommand($sql)->queryRow();

                $vip = isset($post['vip'])? $post['vip']:'0';
                $guide -> vip = $vip;


                $guide->pid = intval($post['pid']);
                $guide->name = trim($post['name']);
                $guide->uType = intval($post['uType']);
                $guide->url = trim($post['url']);
                $guide->module = $this->module->id;

                if(!empty($_FILES['ico_true']['tmp_name'])){
                    $filename = 'ico_true';
                    $path = $this->up($filename);
                    $guide ->ico_true    = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . $path;
                    //$guide ->ico_true    = 'http://192.168.1.110/file/' . $path;
                }

                if(!empty($_FILES['ico_false']['tmp_name'])){
                    $filenames = 'ico_false';
                    $path = $this->up($filenames);
                    $guide ->ico_false   = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . $path;
                    //$guide ->ico_false   = 'http://192.168.1.110/file/' . $path;
                }
                if($guide->isNewRecord){
                    $guide->order = $return['order']+1;
                }
                if(!$guide->save()){
                    LogWriter::logModelSaveError($guide,__METHOD__,$guide->attributes);
                    throw new ExceptionEx('信息保存失败');
                }
                //添加到yd_mv_nav
                if(!empty($_POST['province']) && empty($_GET['id'])){
                    $gid = $guide->attributes['id'];
                    $count = count($_POST['province']);
                    // print_r($count);die();


                    $sheng=$_POST['province'];
                    $shi=$_POST['city'];

//                    print_r($cp);
//                    echo "<hr />";

//                    for($i=0;$i<count($sheng);$i++){
//                        $nav = new MvNav();
//                        $nav -> gid = $gid;
//                        $se=explode('_',$sheng[$i]);
//                        $nav -> province = $se[0];
//
//                        $s=explode('_',$shi[$i]);
//                        $nav -> city = $s[0];
//                        $nav -> save();
//                        if(!$nav->save()){
//                            LogWriter::logModelSaveError($nav,__METHOD__,$nav->attributes);
//                            throw new ExceptionEx('信息保存失败s');
//                        }
//                    }
                    $cp = $_POST['cp'];
                    for($i=0;$i<count($sheng);$i++){
                        for($c=0;$c<count($cp);$c++){
                            $nav = new MvNav();
                            $nav -> gid = $gid;
                            $se=explode('_',$sheng[$i]);
                            $nav -> province = $se[0];

                            $s=explode('_',$shi[$i]);
                            $nav -> city = $s[0];
                            $nav -> cp =$cp[$c];
                                //echo $cp[$c];
                            $nav -> save();
                            if(!$nav->save()){
                                LogWriter::logModelSaveError($nav,__METHOD__,$nav->attributes);
                                throw new ExceptionEx('信息保存失败s');
                            }
                        }
//                        die();
                    }
                }
                //判断是不是左侧的导航
                $diqus=array(
                    '1'=>'首页',
                    '2'=>'影视',
                    '3'=>'教育',
                    '4'=>'游戏',
                    '5'=>'应用',
                    '6'=>'咪咕专区',
                    '7'=>'综艺专区',
                    '8'=>'华数专区',
                    '9'=>'咪咕极光',
                    '10'=>'咪咕现场秀',
                    '11'=>'咪咕精彩',
                    '12'=>'甘肃专区',
                    '13'=>'音乐',
                    '14'=>'体育',
                    '15'=>'南传专区',
                    '16'=>'购物',
                );
                $ziname=$post['name'];
                if(in_array("$ziname", $diqus)){
                    $key = array_search("$ziname", $diqus);
                    $auth = MvGuide::model()->find("name = '全国'");
                    $id=$auth->id;
                    $ss = MvGuide::model()->find("pid = '$id' and name='$ziname'");
                    $sname=$ss->name;
                    $sid=$ss->id;
                    $epgid = array_search("$sname", $diqus);
                    $shujuall = array_map(create_function('$record','return $record->attributes;'),MvUi::model()->findAll("gid = '$sid' and epg='$epgid'"));

                    foreach($shujuall as $k=>$v){
                        $ui = new MvUi();
                        $ui->title    = $v['title'];
                        $ui->type = $v['type'];
                        $ui->tType      = $v['tType'];
                        $ui->param   = $v['param'];
                        $ui->action     = $v['action'];
                        $ui->pic  = $v['pic'];
                        $ui->cp = $v['cp'];
                        $ui->epg = $epgid;
                        $ui->addTime  = $v['addTime'];
                        $ui->upTime      = $v['upTime'];
                        $ui->position    = $v['position'];
                        $ui->gid       = $gid;
                        $ui->save();
                    }
                }
                $this->PopMsg('保存成功');
                $this->redirect($this->get_url('guide','index'));
            }
        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
        }

        $province = Province::model()->findAll("1=1 order by id asc");
        $p = isset($p) ? $p : '';
        $cityCode = isset($cityCode) ? $cityCode : '';
        $c = isset($c) ? $c : '';


        $parent = MvGuide::model()->findAllByAttributes(array('pid'=>0));

        $this->render('add',array('guide'=>$guide,'parent'=>$parent,'province'=>$province,'provinceCode'=>$p,'city'=>$cityCode,'cityCode'=>$c));
    }
    //修改
    public function actionUpdate(){
        try{
            if(!empty($_GET['id'])){
                $guide = MvGuide::model()->findByPk($_GET['id']);

                $id = $_GET['id'];
                $arr = array_map(create_function('$record','return $record->attributes;'),MvNav::model()->findAll("gid = $id group by `province`"));
                $cou = count($arr);
                $ars = array_map(create_function('$record','return $record->attributes;'),MvNav::model()->findAll("gid = $id group by `cp`"));
                $cous = count($ars);
                $cityar=$arr;
                foreach($cityar as $key=>$val){
                   $cityarr[]= array_map(create_function('$record','return $record->attributes;'),City::model()->findAll("provinceId = $val[province]"));
                }
                $cityarr = isset($cityarr) ? $cityarr : '';
            }
            if(!empty($_POST)){
                $post = $_POST;
                if(empty($post['name'])) throw new ExceptionEx('请输入导航名称');
                if(empty($post['uType']))throw new ExceptionEx('请选择链接类型');
                if(empty($post['url'])) throw new ExceptionEx('请输入链接');
                if(!empty($_GET['id']) && $_GET['id'] == $post['pid']){
                    throw new ExceptionEx('自己不能作为自己的父类');
                }
                $sql = 'select `order` from yd_mv_guide order by `order` desc limit 1';
                $return = Yii::app()->db->createCommand($sql)->queryRow();

                $vip = isset($post['vip'])? $post['vip']:'0';
                $guide -> vip = $vip;


                $guide->pid = intval($post['pid']);
                $guide->name = trim($post['name']);
                $guide->uType = intval($post['uType']);
                $guide->url = trim($post['url']);
                $guide->module = $this->module->id;

                if(!empty($_FILES['ico_true']['tmp_name'])){
                    $filename = 'ico_true';
                    $path = $this->up($filename);
                    $guide ->ico_true    = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . $path;
                    //$guide ->ico_true    = 'http://192.168.1.110/file/' . $path;
                }

                if(!empty($_FILES['ico_false']['tmp_name'])){
                    $filenames = 'ico_false';
                    $path = $this->up($filenames);
                    $guide ->ico_false   = 'http://' . $_SERVER['HTTP_HOST'] . '/file/' . $path;
                    //$guide ->ico_false   = 'http://192.168.1.110/file/' . $path;
                }
                if($guide->isNewRecord){
                    $guide->order = $return['order']+1;
                }
                if(!$guide->save()){
                    LogWriter::logModelSaveError($guide,__METHOD__,$guide->attributes);
                    throw new ExceptionEx('信息保存失败');
                }
                //添加到yd_mv_nav
                //先删除
                $gid=$_GET['id'];
                $sql = "DELETE from yd_mv_nav where gid=$gid";
                $rows=Yii::app()->db->createCommand($sql)->query();
                //MvNav::model()->deleteAll("gid in($gid)");

                if(!empty($_POST['province'])){

                    $count = count($_POST['province']);
                    // print_r($count);die();

                    $sheng=$_POST['province'];
                    $shi=$_POST['city'];


//                    for($i=0;$i<count($sheng);$i++){
//                        $nav = new MvNav();
//                        $nav -> gid = $gid;
//                        $se=explode('_',$sheng[$i]);
//                        $nav -> province = $se[0];
//
//                        $s=explode('_',$shi[$i]);
//                        $nav -> city = $s[0];
//                        $nav -> save();
//                        if(!$nav->save()){
//                            LogWriter::logModelSaveError($nav,__METHOD__,$nav->attributes);
//                            throw new ExceptionEx('信息保存失败s');
//                        }
//                    }
                    $cp = $_POST['cp'];
                    for($i=0;$i<count($sheng);$i++){
                        for($c=0;$c<count($cp);$c++){
                            $nav = new MvNav();
                            $nav -> gid = $gid;
                            $se=explode('_',$sheng[$i]);
                            $nav -> province = $se[0];

                            $s=explode('_',$shi[$i]);
                            $nav -> city = $s[0];
                            $nav -> cp =$cp[$c];
                            //echo $cp[$c];
                            $nav -> save();
                            if(!$nav->save()){
                                LogWriter::logModelSaveError($nav,__METHOD__,$nav->attributes);
                                throw new ExceptionEx('信息保存失败s');
                            }
                        }
                    }
                }
                else{
                    $cp = $_POST['cp'];
                    for($c=0;$c<count($cp);$c++){
                        $nav = new MvNav();
                        $nav -> gid = $gid;
                        $nav -> province = 0;
                        $nav -> city = 0;
                        $nav -> cp =$cp[$c];
                        //echo $cp[$c];
                        $nav -> save();
                        if(!$nav->save()){
                            LogWriter::logModelSaveError($nav,__METHOD__,$nav->attributes);
                            throw new ExceptionEx('信息保存失败ss');
                        }
                    }
                }

                $this->PopMsg('保存成功');
                $this->redirect($this->get_url('guide','index'));
            }
        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
        }

        $province = Province::model()->findAll("1=1 order by id asc");

        $p = isset($p) ? $p : '';
        $cityCode = isset($cityCode) ? $cityCode : '';
        $c = isset($c) ? $c : '';


        $parent = MvGuide::model()->findAllByAttributes(array('pid'=>0));

        $this->render('update',array('guide'=>$guide,'parent'=>$parent,'province'=>$province,'provinceCode'=>$p,'city'=>$cityCode,'cityCode'=>$c,'cou'=>$cou,'arr'=>$arr,'cityarr'=>$cityarr,'cous'=>$cous,'ars'=>$ars));
    }

    public function actionDel(){
        try{
            if(empty($_GET['id'])) throw new ExceptionEx('参数错误');
            $id = intval($_GET['id']);
            $ex = MvGuide::model()->exists('pid=:id',array(':id'=>$id));
            if($ex){
                throw new ExceptionEx('该分类下含有子类,请先处理子类');
            }

            $del = MvGuide::model()->deleteByPk($id);
            if(!$del){
                throw new ExceptionEx('系统繁忙,删除失败');
            }

        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
            $this->PopMsg('系统繁忙,请稍后再试');
        }
        $this->redirect($this->getPreUrl());
    }


    //读取出符合条件的所有的市
    public function actionGetcity(){
        $id=$_GET['id'];
        $city = array_map(create_function('$record','return $record->attributes;'),City::model()->findAll("provinceId = '$id' order by id desc"));

        echo json_encode($city);
    }

    public function actionGetpro(){
        $pro = array_map(create_function('$record','return $record->attributes;'),Province::model()->findAll("1=1 order by id asc"));
//print_r($pro);
        echo json_encode($pro);
    }

    public function up($filename){
        if (!empty($filename)) {
            if ($_FILES[$filename]["error"] > 0) {
                $this->error('上传文件错误! 错误代码:' . $_FILES[$filename]['error'], '', 3);
            }
            $dir = Yii::app()->basePath . '/../file/';
            //echo $dir;die();
            $name = date('YmdHis') . mt_rand(0000, 9999);
            //$expand_arr = explode('/',$_FILES['media']['type']);
            //$expand = '.'.$expand_arr[1];
            $expand = '.' . pathinfo($_FILES[$filename]['name'], PATHINFO_EXTENSION);
            if (is_uploaded_file($_FILES[$filename]["tmp_name"])) {
                if (move_uploaded_file($_FILES[$filename]["tmp_name"], $dir . $name . $expand)) {
                    $path = $name . $expand;
                    //$path = isset($name) ? $name . $expand : '';
                } else {
                    $this->error('上传服务器临时错误');
                }
            } else {
                $this->error('非法上传方法');
            }
        }
        return $path;
    }

}
