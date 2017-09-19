<?php
$admin = $this->getMvAdmin();
$gu = $this->mvgroup;
//var_dump($gu);die;
?>
<style>
//.admin_logo{background:url('../../file/button/logo.png');}
</style>
<div class="admin_top">
	<div class="wr">
		<div class="top_logo left">
			<a href="#" class="admin_logo" title="后台logo">
			<img src='/file/button/logo.png' style=" width: 174px; height: 54px;">	
			</a>
			<p class="logo-line"></p>
			<h2>后台管理系统</h2>
		</div>
		<div class="top_nav">
			<div class="t_toolbar">
				您好！<?php echo $admin['nickname']?> |
				<a href="<?php echo Yii::app()->createUrl('/version/default/logout')?>">[退出]</a>
			</div>
			<ul>
				<?php 
				if(!empty($gu)){
					foreach($gu as $n){
						if($n->pid == 0){
						?>
						<li class="<?php echo !empty($_GET['mid']) && $_GET['mid'] == $n['id']?'active':''?>">
							<a href="<?php echo Yii::app()->createUrl('/version/content/index', array('mid' => $n['id'],'pro'=>$admin['nickname'])); ?>" class="<?php echo $this->mid == $n['id']?'a_menu':''?>"><?php echo $n['name']?></a>
						</li>
				<?php   }
					}
				}?>
			</ul>
		</div>
	</div>
</div>
