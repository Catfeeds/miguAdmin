<?php

class MessageController extends VController
{
	public function actionReview()
	{
		try{
			$username = $_SESSION['nickname'];
			$flag=4;

			$review_flag = 3;   //提交审核
			$review_times = 1;
			$review_message = '提审';
			$bind_id = $_REQUEST['id'];
			$review_type = 1;   //消息
			$this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);

			$workid = Common::EditWorkid($username,$flag);
			$reject = VerMessageReject::model()->find("vid = '{$_REQUEST['id']}' and flag=$flag");
			if(empty($reject)){
				$reject = new VerMessageReject();
			}
			$reject->user = $username;
			$reject->addTime=time();
			$reject->vid=$_REQUEST['id'];
			$reject->flag='4';
			$reject->save();
			$result = VerMessage::model()->updateAll(array('flag'=>1,'workid'=>$workid,'cTime'=>time()),'id=:id',array(':id'=>$_REQUEST['id']));
			if($result){
				echo json_encode(array('code'=>200));
			}else{
				echo json_encode(array('code'=>404));
			}
		}catch (ExceptionEx $ex){
			$this->PopMsg($ex->getMessage());
		}catch (Exception $e){
			$this->log($e->getMessage());
		}
	}

	public function actionAccess(){
		try {
			$username=$_SESSION['nickname'];
			$flag= '4';
			$res  = Common::workid($username,$flag);
			$tmp = VerMessage::model()->findByPk($_REQUEST['gid']);
			$this->AccessReject($_REQUEST['gid'],$flag);
			$this->rejectlog($_REQUEST['gid'],1);
			if($tmp->attributes['flag']==$res || $tmp->attributes['flag']=='5'){
				$result = VerMessage::model()->updateAll(array('flag'=>6),'id=:id',array(':id'=>$_REQUEST['gid']));
			}else{
				$flag=$tmp->attributes['flag']+1;
				$result = VerMessage::model()->updateAll(array('flag'=>$flag),'id=:id',array(':id'=>$_REQUEST['gid']));
			}

            $review_flag = 1;   //审核通过
            $review_times = $tmp->attributes['flag'];
            $review_message = '通过';
            $bind_id = $_REQUEST['gid'];
            $review_type = 1;   //消息
            $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);


			if($result){
				echo json_encode(array('code'=>200));
			}else{
				echo json_encode(array('code'=>404));
			}

		}catch (ExceptionEx $ex){
			$this->PopMsg($ex->getMessage());
		}catch (Exception $e){
			$this->log($e->getMessage());
		}
	}


	public function actionAllAccess(){
		$username = $_SESSION['nickname'];
		$flag=4;
		$res  = Common::workid($username,$flag);
		$arr=explode(' ',trim($_REQUEST['ids']));
		foreach($arr as $k=>$v){
			$tmp = VerMessage::model()->findByPk($v);
			$this->AccessReject($v,$flag);
			$this->rejectlog($v,1);
                       	$sql = "select c.type from yd_ver_message as a left join yd_ver_station as b on a.gid=b.id left join yd_ver_work c on b.id = c.stationId and c.flag = 4 where a.id = ".$tmp->attributes['id'];
			 $AA =  SQLManager::QueryAll($sql);
			if(empty($AA)){ $AA['0']['type'] = "";}
			if($tmp->attributes['flag'] == 0 || $tmp->attributes['flag'] == 6){return false;}	
			if($tmp->attributes['flag']== $AA['0']['type'] || $tmp->attributes['flag']=='5'){
				$result = VerMessage::model()->updateAll(array('flag'=>6),'id=:id',array(':id'=>$v));
			}else{
				$newflag=$tmp->attributes['flag']+1;
				$result = VerMessage::model()->updateAll(array('flag'=>$newflag),'id=:id',array(':id'=>$v));
			}

            $review_flag = 1;   //审核通过
            $review_times = $tmp->attributes['flag'];
            $review_message = '通过';
            $bind_id = $v;
            $review_type = 1;   //消息
            $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);
		}
	}

	public function actionRejectView(){
		$gid = $_REQUEST['gid'];
		$flag = $_REQUEST['flag'];
		$n = $this->renderPartial(
				'rejectview',
				array(
						'gid'=>$gid,
						'flag'=>$flag,
				),
				true
		);
		die(json_encode(array('code'=>200,'msg'=>$n)));
	}


	public function actionReject(){
		$username = $_SESSION['nickname'];
		$message = $_REQUEST['message'];
		if($_REQUEST['flag']=='1'){
			$tmp = VerMessage::model()->findByPk($_REQUEST['gid']);
			$reject = VerMessageReject::model()->find("vid = '{$_REQUEST['gid']}'");
			if(empty($reject)){
				$reject = new VerMessageReject();
			}
			switch($tmp->attributes['flag']){
				case '1':$reject->message1=$message;$reject->addTime1  = time();$reject->user1=$username;break;
				case '2':$reject->message2=$message;$reject->addTime2  = time();$reject->user2=$username;break;
				case '3':$reject->message3=$message;$reject->addTime3  = time();$reject->user3=$username;break;
				case '4':$reject->message4=$message;$reject->addTime4  = time();$reject->user4=$username;break;
				case '5':$reject->message5=$message;$reject->addTime5  = time();$reject->user5=$username;break;
			}

            $review_flag = 2;   //驳回
            $review_times = $tmp->attributes['flag'];
            $review_message = $message;
            $bind_id = $_REQUEST['gid'];
            $review_type = 1;   //消息
            $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);


			$reject->delFlag='0';
			$reject->vid  = $_REQUEST['gid'];
			$reject->save();
			$this->rejectlog($_REQUEST['gid'],2);
			$resulst = VerMessage::model()->updateAll(array('flag'=>0),'id=:id',array(':id'=>$_REQUEST['gid']));
		}else{
			$arr = explode(' ',trim($_REQUEST['gid']));
			foreach($arr as $k=>$v){
				$tmp = VerMessage::model()->findByPk($v);
				$reject = VerMessageReject::model()->find("vid = '{$v}'");
				if(empty($reject)){
					$reject = new VerMessageReject();
				}
				switch($tmp->attributes['flag']){
					case '1':$reject->message1=$message;$reject->addTime1  = time();$reject->user1=$username;break;
					case '2':$reject->message2=$message;$reject->addTime2  = time();$reject->user2=$username;break;
					case '3':$reject->message3=$message;$reject->addTime3  = time();$reject->user3=$username;break;
					case '4':$reject->message4=$message;$reject->addTime4  = time();$reject->user4=$username;break;
					case '5':$reject->message5=$message;$reject->addTime5  = time();$reject->user5=$username;break;
				}

                $review_flag = 2;   //驳回
                $review_times = $tmp->attributes['flag'];
                $review_message = $message;
                $bind_id = $v;
                $review_type = 1;   //消息
                $this->recordReview($review_type,$bind_id,$review_times,$review_flag,$review_message);


				$reject->delFlag='0';
				$reject->vid  = $v;
				$reject->save();
				$this->rejectlog($v,2);
				$resulst = VerMessage::model()->updateAll(array('flag'=>0),'id=:id',array(':id'=>$v));
			}
		}
	}

	public function AccessReject($gid,$flag){
		$tmp = VerMessage::model()->findByPk($gid);
		$message = '通过';
		$reject = VerMessageReject::model()->find("vid = '$gid' and flag='$flag'");
		if(empty($reject)){
			$reject = new VerMessageReject();
		}
		switch($tmp->attributes['flag']){
			case '1':$reject->message1=$message;$reject->addTime1  = time();$reject->user1=$_SESSION['nickname'];break;
			case '2':$reject->message2=$message;$reject->addTime2  = time();$reject->user2=$_SESSION['nickname'];break;
			case '3':$reject->message3=$message;$reject->addTime3  = time();$reject->user3=$_SESSION['nickname'];break;
			case '4':$reject->message4=$message;$reject->addTime4  = time();$reject->user4=$_SESSION['nickname'];break;
			case '5':$reject->message5=$message;$reject->addTime5  = time();$reject->user5=$_SESSION['nickname'];break;
		}
		$reject->delFlag='0';
		$reject->vid  = $gid;
		$reject->save();
	}


	public function rejectlog($vid,$flag){
		$tmp = VerMessageReject::model()->find("vid='$vid'");
		$reject = new VerMessageLog();
		$reject->user = $tmp->attributes['user'];
		$reject->user1 = $tmp->attributes['user1'];
		$reject->user2 = $tmp->attributes['user2'];
		$reject->user3 = $tmp->attributes['user3'];
		$reject->user4 = $tmp->attributes['user4'];
		$reject->user5 = $tmp->attributes['user5'];
		$reject->flag = $flag;
		$reject->message1 = $tmp->attributes['message1'];
		$reject->message2 = $tmp->attributes['message2'];
		$reject->message3 = $tmp->attributes['message3'];
		$reject->message4 = $tmp->attributes['message4'];
		$reject->message5 = $tmp->attributes['message5'];
		$reject->vid = $tmp->attributes['vid'];
		$reject->addTime = time();
		$reject->addTime1 = $tmp->attributes['addTime1'];
		$reject->addTime2 = $tmp->attributes['addTime2'];
		$reject->addTime3 = $tmp->attributes['addTime3'];
		$reject->addTime4 = $tmp->attributes['addTime4'];
		$reject->addTime5 = $tmp->attributes['addTime5'];
		$reject->save();
	}

}

