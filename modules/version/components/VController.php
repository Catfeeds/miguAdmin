<?php

/**
 * Created by PhpStorm.
 * User: xiangl
 * Date: 2015/8/4 0004
 * Time: 16:08
 */
header("Content-type:text/html;charset=utf-8");
class VController extends Controller{

    public $layout = 'application.modules.version.views.layouts.main';
    public $pageTitle = '移动后台管理系统';
    public $mid = -1;
    public $mvgroup;
    public $verguide;
    public $versitelist;
    public $verstation;

    public function beforeAction($action){
        if(parent::beforeAction($action)){
            $arr = array('login','logout','code','captcha');

            if(in_array($this->action->id,$arr)) return true;
            $admin = Yii::app()->user->getState('admin');
            //var_dump($admin);die;
            if(!$admin){
                $this->redirect($this->createUrl('/version/default/login',array('mid'=>$this->mid)));
            }
            $verguide = VerGuide::model()->findAll();
            //$mvgroup = $this->getMvGroup($admin['auth']);
            //var_dump($mvgroup);die;
            if($verguide){
                $this->verguide = VerGuide::model()->findAll("1=1 order by `order` asc ");
            }
            if(!isset($_GET['mid']) || empty($_GET['mid'])){
                $this->redirect($this->createUrl('/version/default/index',array('mid'=>$this->mid)));
            }
            $this->mid = (int) $_GET['mid'];
        }
        return true;
    }

    private function getMvGroup($id){
        return MvGroup::model()->findByPk($id);
    }
    public function getVerStation(){
        if($_SESSION['auth'] == '1'){
        return VerStation::model()->findAll();
        }else{
            $uid = $_SESSION['userid'];
            $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 3 left join yd_ver_worker as c on c.workid=b.id where c.uid=$uid  group by a.id";
            $res = SQLManager::QueryAll($sql);
	
	       return $res;
        }
    }
    private function getMvAuth($str){
        $criteria = new CDbCriteria();
        $criteria->select = 'id,pid,name,url';
        $criteria->addInCondition('id',explode(',',$str));
        $criteria->order = '`order` asc';
        return MvGuide::model()->findAll($criteria);
    }

    private function check($str,$auth){
        if(!is_array($auth)) return false;
        $return = true;
        foreach($auth as $v){
            if(strtolower($str) === strtolower($v->addres)){
                return $return;
            }
        }
        return false;
    }
    public function getVersitelist(){
        return VerSitelist::model()->findAll();
    }

    public function getSitelist($uid,$flag){
        //$sql="select workud from yd_ver_worker where uid=$uid group by stationId";
        if(!empty($flag)){
        $sql = "select w.stationId from yd_ver_work w inner join yd_ver_worker k on k.workid=w.id and k.uid=$uid and w.flag=6 group by w.stationId";
        	
        }else{
        $sql = "select w.stationId from yd_ver_work w inner join yd_ver_worker k on k.workid=w.id and k.uid=$uid and w.flag=2";
		}
	    $user = SQLManager::queryAll($sql);

        if(!empty($user)){
            if($flag == 6){
                $tmp_list = array();
//                var_dump($user);die;
                foreach ($user as $k=>$v){
                    $tmp = VerStation::model()->findByPk($v['stationId']);
                    $name = $tmp->attributes['name'];
                    $tmp_list[] = $this->getStationList($name);
//                    var_dump($tmp_list);die;
                }
//                var_dump($tmp_list);die;
                /*foreach ($tmp_list as $k=>$v){
                    $a[] = $v['']
                }*/
//                $list = explode(',',$tmp_list['id']);
                $list = VerGuideManager::String($tmp_list);
            }else{
                $list = VerGuideManager::String($user);
            }

			
            return VerSitelist::model()->findAll("id in ($list)");
        }else{
            $list= array();
            return $list;
        }
    }

    public function getStationList($name){
        $sql = "select id from yd_ver_sitelist where name='$name'";
        $list = SQLManager::queryRow($sql);
        $sql_list = "select id from yd_ver_sitelist where pid='{$list['id']}' and name='专题'";
        $tmp = SQLManager::queryRow($sql_list);
        $sqls = "select id from yd_ver_sitelist where pid='{$tmp['id']}'";
        $res = SQLManager::queryAll($sqls);
        return $res;
    }


    public function getMvAdmin(){
        $admin = Yii::app()->user->getState('admin');
        if(empty($admin)){
            return false;
        }
        return $admin;
    }

    public function getAid(){
        $admin = $this->getMvAdmin();
        return $admin['id'];
    }

    public function getAuth($uid){
        $res = array();
        $sql = "select w.flag,w.stationId from yd_ver_work w inner join yd_ver_worker k on k.workid = w.id and k.uid=$uid";
 	
	$work = SQLManager::queryAll($sql);
       
	$sqls = "select w.flag,w.stationId from yd_ver_work w inner join yd_ver_review_work k on k.workid = w.id and k.uid=$uid group by w.flag";
        $review = SQLManager::queryAll($sqls);
	$list = '';
        if(!empty($work)){
            foreach($work as $k=>$v){
                if($v['flag']=='1'){
                    $list .=",3,8,37,38";
                }else if($v['flag']=='2'){
                    $list .=",31,32";
                }else if($v['flag']=='6' && $v['stationId']<>'7'){
                    $list .=",31,39";
                }else if($v['flag']=='6' && $v['stationId']=='7'){
                    $list .=",37,33";
                }else if($v['flag']=='3'){
                    $list .= ",10,30";
                }else if($v['flag']=='4'){
                    $list .= ",10,9";
                }
				else if($v['flag']=='5'){
                    $list .= ",10,34";
                }
			
            }
        }
	
        if(!empty($review)){
            foreach($review as $k=>$v){
                if($v['flag']=='1'){
                    $list .=",48,19";
                }else if($v['flag']=='2'){

                }else if($v['flag']=='3'){
                    $list .= ",48,40";
                }else if($v['flag']=='5'){
                    $list .= ",48,46";
                }else if($v['flag']=='4'){
                    $list .= ",48,47";
                }else if($v['flag']=='6'){
                    $list .= ",48,49";
                }
            }
        }
        $list = trim($list,',');
        $res['list']=$list;
	
        if(!empty($list)){
           $res['data']=VerGuide::model()->findAll(" id in ($list) order by `order` asc ");
        }else{
           $res['data']='';
        }
        return $res;
    }

    public function die_json($arr = array()){
        if(empty($arr)) $arr = array();
        die(json_encode($arr));
    }

    public function get_url($controller,$action,$data=array()){
        $model = $this->module->id;
        if(empty($controller))  $controller = $this->id;
        if(empty($action))      $action = $this->action->id;
        if(!isset($data['mid']))$data['mid'] = $this->mid;
        if(!isset($data['nid']) && isset($_GET['nid'])) $data['nid'] = $_GET['nid'];
        return $this->createUrl('/' . $model . '/' . $controller . '/' . $action , $data);
    }

    function array_column($input, $columnKey, $indexKey = NULL)
    {
        $columnKeyIsNumber = (is_numeric($columnKey)) ? TRUE : FALSE;
        $indexKeyIsNull = (is_null($indexKey)) ? TRUE : FALSE;
        $indexKeyIsNumber = (is_numeric($indexKey)) ? TRUE : FALSE;
        $result = array();

        foreach ((array)$input AS $key => $row)
        {
            if ($columnKeyIsNumber)
            {
                $tmp = array_slice($row, $columnKey, 1);
                $tmp = (is_array($tmp) && !empty($tmp)) ? current($tmp) : NULL;
            }
            else
            {
                $tmp = isset($row[$columnKey]) ? $row[$columnKey] : NULL;
            }
            if ( ! $indexKeyIsNull)
            {
                if ($indexKeyIsNumber)
                {
                    $key = array_slice($row, $indexKey, 1);
                    $key = (is_array($key) && ! empty($key)) ? current($key) : NULL;
                    $key = is_null($key) ? 0 : $key;
                }
                else
                {
                    $key = isset($row[$indexKey]) ? $row[$indexKey] : 0;
                }
            }

            $result[$key] = $tmp;
        }

        return $result;
    }


    public function getAllStation()
    {
        $res = VerStation::model()->findAll(
            array(
                'select' =>array('name','id'),
                'order' => 'id ASC',
            ));
        return $res;
    }

    public function recordReview($type,$bind_id,$review_times,$review_flag,$message)
    {
        $model = new VerReviewRecord();
        $model->user_id = $_SESSION['userid'];
        $model->add_time = time();
        $model->type = $type;
        $model->bind_id = $bind_id;
        $model->review_times = $review_times;
        $model->review_flag = $review_flag;
        $model->message = $message;
        $model->save();
    }

    public function GetReviewInfo($type,$bind_id)
    {
//        $vid = Yii::app()->request->getParam('vid');
       $sql = "select a.*,b.username from yd_ver_review_record as a left join yd_ver_admin as b on a.user_id=b.id where a.type=$type and a.bind_id=$bind_id";
       $res = SQLManager::queryAll($sql);
       return $res;
    }

}


