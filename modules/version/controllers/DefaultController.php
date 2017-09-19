<?php

class DefaultController extends VController
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLogin(){
		try{
			if(Yii::app()->user->getState('admin')){
				$this->redirect($this->createUrl('/version/default/index'));
			}
			$model = new VerAdminForm();
			// print_r($model);
			if(isset($_POST['VerAdminForm']))
			{
				$model->attributes=$_POST['VerAdminForm'];
				if($model->validate() && $model->login()){//$model->validate() &&
					$name = $model['username'];
					$pwd = md5($model['password']);
					Yii::app()->session['username']=$name;
					Yii::app()->session['password']=$pwd;

					$auth = VerAdmin::model()->find("username = '$name' and password = '$pwd'");
					Yii::app()->session['userid']=$auth->attributes['id'];
					Yii::app()->session['nickname']=$auth->attributes['nickname'];
					Yii::app()->session['auth']=$auth->attributes['auth'];
					//$id = $auth['auth'];
					//$group = MvGroup::model()->find("id = '$id'");
					//$arr = explode(',',$group['auth']);
					$arr[0]='1';
					//var_dump($arr);die;
					$url = VerGuide::model()->find("id = '$arr[0]'");
					$aa = $url['url'];
					$ids = $url['id'];
					$this->redirect($this->createUrl('/version/guide/default',array('mid'=>$ids,'nid'=>0,'id'=>0,'pid'=>0)));
				}
				throw new ExceptionEx('登陆失败');
			}
		}catch (ExceptionEx $ex){
			$this->PopMsg($ex->getMessage());
		}catch (Exception $e){
			$this->log($e->getMessage());
		}
		$this->renderPartial('login',array('model'=>$model));
	}

	public function actionCode(){
		Verification::getNew()->get_code();

	}


	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect($this->createUrl('/version/default/login'));
	}
}
