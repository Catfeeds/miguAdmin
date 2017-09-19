<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:'';
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
//var_dump($data);
?>
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
    .inputDiv{
        width:100%;
        float:left;

        background: #A3BAD5;
        padding: 5px 0px 5px 12px;
    }
    .inputDiv input{
        float: left;
    }
    .inputDiv span{
        float: left;
    }
    .inputDiv select{
        float: left;
        margin-left:5px;
    }
    .inputDivTwo{
        width:100%;
        float:left;
        height:30px;
        padding: 5px 0px 6px 12px;
    }
    .mt10{
        float:left;
    }
    .page_btn{width: 44px;
        height: 24px;

    }
    .inputDivTwo{
        float:left;
        padding: 5px 0px 5px 12px;
        width:100%;
        background: #f0fdff;
    }
    .inputDivTwo a{float:left;}
</style>
<div style='padding: 5px 0px 5px 14px;'>
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;?></span>
</div>
<div class="inputDiv" >
    <input type="text" class="title" name="title" style="width:120px;height:15px;"  class="form-input" value="" placeholder="请输入查询条件">
    <input style="width：80px;height:20px;margin-left: 5px" id='button' class="btn btn_search" value="查询" type="button">
	<?php echo $page;?>
</div>
<div class="inputDivTwo">
    <a style="line-height: 30px;text-align: center;" href="<?php echo  $this->get_url('template', 'test',array('nid'=>$_GET['nid'],'adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>" class="btn">新建模板</a>
</div>
<div style='width:100%;' >
<table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
    <tr>
        <th>ID</th>
        <th>模板名称</th>
        <th>缩略图</th>
        <th>操作</th>
    </tr>
    <?php foreach($data as $v):?>
    <tr>
        <td gid="<?php echo $v['id']?>" class="gid"><?php echo $v['id']?></td>
        <td><?php echo $v['name']?></td>
        <td><img width="214px" height="123px" src="<?php echo $v['pic']?>"  class="img"></td>
        <td><a href="#" class="del">删除</a></td>
    </tr>
    <?php endforeach;?>
</table>
</div>
<script>
    $('.del').click(function(){
	var id = $(this).parent().siblings(".gid").attr("gid");	
        layer.confirm("确定删除此模板吗？", {
            title:"消息提示",
            btn: ['删除','取消'] //按钮
        }, function(){
            $.post("/version/template/del.html?mid=<?php echo $_REQUEST['mid']?>&nid=<?php echo $_REQUEST['nid']?>",{id:id},function(d){
                if(d.code==200){
                    alert('删除成功');
                    location.reload();
                }else{
                    alert('删除失败')
                }
            },'json')
        })
    })
    

    $(".btn_search").click(function(){
        var adminLeftOne = "<?php echo $adminLeftOne;?>";
        var adminLeftTwo = "<?php echo $adminLeftTwo;?>";
        var adminLeftOneName = "<?php echo $adminLeftOneName;?>";
        var adminLeftTwoName = "<?php echo $adminLeftTwoName;?>";
        var title=$(".title").val();
        var mid = <?php echo $_REQUEST['mid']?>;
        var nid = <?php echo $_REQUEST['nid']?>;
        window.location.href="/version/template/default.html?mid="+mid+"&title="+title+"&nid="+nid+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
    })

	$(".img").click(function(){
		var src=$(this).attr("src");
		window.open(src);
	})
</script>
