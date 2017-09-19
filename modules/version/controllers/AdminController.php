<?php

class AdminController extends VController
{
    public function actionIndex()
    {
        $province = Province::model()->findAll("1=1 order by provinceCode asc");
        $city= City::model()->findAll("1=1 order by cityCode asc");
        //$list = VerAdmin::model()->findAll();
        $sql_select= "select * from yd_ver_admin";
        $sql_where = " where delFlag=0";
        if(!empty($_REQUEST['user'])){
           $sql_where .=" and nickname like '%{$_REQUEST['user']}%'"; 
        }
        if(!empty($_REQUEST['company'])){
	    $sql_where .=" and pro='{$_REQUEST['company']}'";
        }
        $sql = $sql_select . $sql_where;        
        $list = SQLManager::queryAll($sql); 
        //$this->render('index',array('list'=>$list));
        $this->render('index',array('list'=>$list,'city'=>$city,'province'=>$province));
    }
    public function actionCheckusername(){
	$username = $_REQUEST['name'];
	$sql = "SELECT * FROM yd_ver_admin where username = '$username'";
	$res =SQLManager::queryAll($sql);
	if(!empty($res)){ echo 1; }else{ echo 2;}
    }
    public function actionAdd(){
        try{
            $res= array();
            if(!empty($_REQUEST['id'])){
                $user = VerAdmin::model()->findByPk($_REQUEST['id']);
                $sql = "select w.cp,k.type,w.flag,w.name from yd_ver_work w inner join yd_ver_worker k on w.id=k.workid and k.uid='{$_REQUEST['id']}'";
                $res['work'] = SQLManager::queryAll($sql);
                $sqls = "select w.cp,k.type,w.flag,w.name from yd_ver_work w inner join yd_ver_worker k on w.id=k.workid and k.uid='{$_REQUEST['id']}'";
                $res['review'] = SQLManager::queryAll($sqls);
            }else{
                $user = new VerAdmin();
            }
            if(!empty($_POST)){
                $user->nickname =$_POST['nick'];
                $user->username =$_POST['user'];
                $user->password =md5($_POST['pass']);
                $user->email =$_POST['email'];
                $user->tel =$_POST['tel'];
                $user->company =$_POST['company'];
                $se=explode('_',$_POST['province'][0]);
                $user->pro =$se[0];
                $city=explode('_',$_POST['city'][0]);
                $user->city =$city[0];
                $user->addTime =time();
		$adminLeftOneName = !empty($_POST['adminLeftOneName'])?$_POST['adminLeftOneName']:'';
                $adminLeftTwoName = !empty($_POST['epg'])?$_GET['epg']:$_POST['adminLeftTwoName'];
                $adminLeftOne = !empty($_POST['adminLeftOne'])?$_POST['adminLeftOne']:'';
                $adminLeftTwo = !empty($_POST['adminLeftTwo'])?$_POST['adminLeftTwo']:'';
                if(!$user->save()){
                    var_dump($user->getErrors());
                    LogWriter::logModelSaveError($user,__METHOD__,$user->attributes);
                    throw new ExceptionEx('信息保存失败');
                }
                $this->PopMsg('保存成功');
                $this->redirect($this->get_url('admin','index',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName)));
            }
        }catch (ExceptionEx $ex){
            $this->PopMsg($ex->getMessage());
        }catch (Exception $e){
            $this->log($e->getMessage());
        }
        //$province = Province::model()->findAll("1=1 order by provinceCode asc");
        //$p = isset($p) ? $p : '';
        //$cityCode = isset($cityCode) ? $cityCode : '';
        //$c = isset($c) ? $c : '';
        //$this->render('add',array('user'=>$user,'province'=>$province,'provinceCode'=>$p,'city'=>$cityCode,'cityCode'=>$c));
	$province = Province::model()->findAll("1=1 order by provinceCode asc");
        $cityCode= City::model()->findAll("1=1 order by cityCode asc");

        $p=$user->pro;
        $c=$user->city;
	 $city= City::model()->findAll("provinceId='$p' order by id desc");
        $this->render('add',array('user'=>$user,'province'=>$province,'provinceCode'=>$p,'city'=>$cityCode,'cityCode'=>$c,'limitCity'=>$city,'res'=>$res));
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
    public function actionDel(){
        $id = $_REQUEST['id'];
        $res = VerAdmin::model()->deleteByPk($id);
        if($res){
            echo json_encode(array('code'=>200));
        }else{
            echo json_encode(array('code'=>404));
        }
    }

}
