<script charset="utf-8" type="text/javascript" src="/js/jdate/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/js/jdate/jquery.datetimepicker.css" />


<style>
 .layui-layer-dialog{
	min-width:340px;
}
.layui-layer-dialog .layui-layer-content{
	padding: 30px 20px 40px 70px;
}
.layui-layer-title{
	background:#A3BBD5;
	    padding: 0 20px 0 10px;
	    text-align: center
}
.layui-layer-content{
	background: #F1FDFF;
	
}
.layui-layer-btn{
	background: #F1FDFF;
}
.layui-layer-btn a{
	padding:0px;
	width:90px;
	height:20px;
	line-height:20px;
	background: url("/file/u116.png") no-repeat;
	border-radius: 2px;
}
.layui-layer-btn .layui-layer-btn1{
	background: url("/file/u1971.png") no-repeat;
	border-radius: 2px;
}
.page{
                height:20px;

                line-height: 20px;
        }
        .page ul li {
                line-height: 20px;
                height:20px;
        }
    .inputDiv input{float: left;}
    .inputDiv select{float: left;}
    .inputDiv span{
        float: left;

        line-height: 20px;
      }
    .inputDiv{
              width:100%;
        float:left;

        background: #A3BAD5;
        padding: 5px 0px 5px 4px;
    }
    .inputDivTwo{
        float:left;
        padding: 5px 0px 5px 12px;
        width:100%;
        background: #f0fdff;
    }
    .inputDivTwo a{float:left;}
    .tmp{width:100px;display: block;float: left;margin-right: 700px;height:30px;}
    .newbtn{text-align: center;line-height: 30px;}
    .search_btn{/*margin-right: 1200px;*/margin-left: 10px;}
        table th{
        word-break: keep-all;

    }
        .mtable td{
                padding：0px 0px 0px 0px;
        }
     table td{
        word-break: keep-all;
    }
</style>
<?php
    $adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
    $adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
    $adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
    $adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<div style='padding: 5px 0px 5px 15px;'>
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;?></span>
</div>
<div class="inputDiv">
    <input style="width:120px;height:18px;"  type="text" id="title" placeholder="请输入查询条件" class="form-input" value="<?php echo !empty($_GET['title'])?$_GET['title']:'';?>">

    <span style="font-size:15px;margin-left: 5px">站点</span>
    <select style="height:20px;width:80px" class="form-input" id="station">
        <option value="0">请选择</option>
        <?php
        $defaultId = !empty($_GET['stationId'])?$_GET['stationId']:'0';
        if($_SESSION['auth'] == 1){
            $sql = "select id,name from yd_ver_station";
        }else{
            $uid = $_SESSION['userid'];
            $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 4  left join yd_ver_worker as c on c.workid=b.id where c.type = 1 and  c.uid=$uid group
 by a.id";
        }
        $ress = SQLManager::queryAll($sql);
        if(!empty($ress)){
            foreach ($ress as $k=>$v){
                if($defaultId>0){
                    if($defaultId == $v['id']){
                        echo "<option value=".$v['id']."  selected = selected>".$v['name']."</option>";
                    }else{
                        echo "<option value=".$v['id'].">".$v['name']."</option>";
                    }
                }else{
                    echo "<option value=".$v['id'].">".$v['name']."</option>";
                }
            }
        }
        ?>
    </select>
    <input style="width：80px;height:20px;margin-left: 5px" type="button" class="btn search_btn" value="查询">
  <!--<input type="button" style='width:30px;height:20px;float:right;margin-top:0px;margin-right: 10px;' class="btn page_btn" value="go">
            <span style="float:right;font-size:14px">&nbsp;页</span>
            <input type="text" style='width:30px;height:18px;float:right' class="form-input " value="" name="page"  >
             <span style="float:right;font-size:14px">到第&nbsp;</span>-->
            <?php echo $page;?>
</div>

<div class="btn-parent inputDivTwo">
<?php
if(in_array('1',$res['status']) || $_SESSION['auth']=='1'){ 
?>
   <a href="<?php echo $this->get_url('content','message',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>" class="btn newbtn">新建消息</a>
<?php } ?>
</div>
<div class="mt10">
    <form action="">
        <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
            <tr>
                <th>序号</th>
                <th>名称</th>
                <th>内容</th>
                <th>站点</th>
                <th>状态</th>
                <th>有效期</th>
                <th>操作</th>
            </tr>
            <?php
		 $uid = $_SESSION['userid'];
        $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 4  left join yd_ver_worker as c on c.workid=b.id where c.type = 1 and  c.uid=$uid group
 by a.id";
        $st = SQLManager::QueryAll($sql);
		$gid = array();
	if(!empty($st)){
		foreach($st as $k => $v){
		  $gid[] = $v['id'];
		}
	}
           if(!empty($list)){
               foreach($list as $h=>$l){
                   if($l['flag'] == '6' && $l['delFlag'] == '1'){

                   }else {
                       ?>
                       <tr>
                           <input type="hidden" name="id" value="<?php echo $l['id'] ?>">
                           <td><?php echo $l['id'] ?></td>
                           <td><?php echo $l['title'] ?></td>
                           <td>
                               <div style="width:300px;word-wrap:break-word;"><?php echo $l['info'] ?></div>
                           </td>
                           <td><?php echo $l['name'] ?></td>
                           <td><?php
                               if ($l['flag'] == '0') {
                                   echo '未通过';
                               } else if ($l['flag'] == '6' && $l['delFlag'] == '0') {
                                   echo '通过';
                               } else if ($l['delFlag'] == '1') {
                                   echo '删除消息审核中';
                               } else {
                                   echo '审核中';
                               }

                               ?></td>
                           <td><?php
                               if (!empty($l['firstTime'])) {
                                   echo date("Y-m-d", $l['firstTime']);
                               } ?>---<?php if (!empty($l['endTime'])) {
                                   echo date("Y-m-d", $l['endTime']);
                               } ?></td>
                           <td>
                               <?php


                               if ((in_array('1', $res['status']) || $_SESSION['auth'] == '1') && (in_array($l['gid'], $gid) || $_SESSION['auth'] == '1')) {
                                   if ($l['flag'] == '0') {
                                       ?>
                                       <a href="<?php echo $this->get_url('content', 'message', array('id' => $l['id'], 'adminLeftNavFlag' => 1, 'adminLeftOne' => $adminLeftOne, 'adminLeftTwo' => $adminLeftTwo, 'adminLeftOneName' => $adminLeftOneName, 'adminLeftTwoName' => $adminLeftTwoName)) ?>">编辑</a>
                                       <a class="review">提交审核</a>&nbsp;<a class="del">删除</a>
                                       <?php
                                   } else if ($l['flag'] == '6') {
                                       ?>
                                       <a href="<?php echo $this->get_url('content', 'message', array('id' => $l['id'], 'adminLeftNavFlag' => 1, 'adminLeftOne' => $adminLeftOne, 'adminLeftTwo' => $adminLeftTwo, 'adminLeftOneName' => $adminLeftOneName, 'adminLeftTwoName' => $adminLeftTwoName)) ?>">编辑</a>&nbsp;
                                       <a class="del">删除</a>
                                       <?php
                                   }
                               }
                               ?>
                           </td>
                       </tr>
                       <?php
                   }
                }
            }
            ?>
        </table>
    </form>
</div>

<script>
    $('.del').click(function(){
        var id = $(this).parent().parent().children('input').val();
        layer.confirm("确定删除此条消息并提审？", {
        	title:"消息提示",
            btn: ['删除','取消'] //按钮
            }, function(){
            $.post("<?php echo $this->get_url('content','msgdel')?>",{id:id},function(d){
                if(d.code==200){
                    layer.alert(d.msg);
                    location.reload();
                }else{
                    layer.alert(d.msg)
                }
            },'json')
        })
    })

    $('.page_btn').click(function(){
        var num = $('input[name=pagenum]').val();
        var test = window.location.href;
        window.location.href=test+"&page="+num;
    });

    $('.search_btn').click(function()
    {
        var title = $('#title').val();
        var stationId = $('#station').val();
        var test = window.location.href;
        if(empty(title) && stationId>0){
            window.location.href = test+"&stationId="+stationId;
        }else if(!empty(stationId) && !empty(title)){
            window.location.href = test+'&title='+title+"&stationId="+stationId;
        }else if(empty(stationId) && !empty(title)){
            window.location.href = test+'&title='+title;
        }else{
            window.location.href ="<?php echo $this->get_url('content','msgindex',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>";
        }

    })
    $('.review').click(function(){
        var id = $(this).parent().parent().children('input').val();
        $.post("<?php echo $this->get_url('message','review')?>",{id:id},function(d){
            if(d.code==200){
                location.reload();
            }
        },'json')
    })
</script>

