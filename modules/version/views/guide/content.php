
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
        padding: 5px 0px 5px 4px;
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
        float:left;
        padding: 5px 0px 0px 12px;
    }
     .inputDivTwo{
        float:left;
        padding: 5px 0px 5px 12px;
        width:100%;
        background: #f0fdff;
    }
    td{text-algin:center;}
    .inputDivTwo a{float:left;}
    .tmp{width:100px;display: block;float: left;/*margin-right: 1200px;*/height:30px;}
</style>
<?php
    $adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
    $adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
    $adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
    $adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
    if($_SESSION['auth']==1){
        $sql = "select id,name from yd_ver_station";
    }else{
	$uid=$_SESSION['userid'];
        $sql="select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 8  left join yd_ver_worker as c on c.workid=b.id where c.type = 1 and  c.uid=$uid group
 by a.id";
    }
    $result = SQLManager::queryAll($sql);
?>
<div style='padding: 5px 0px 5px 12px;'>
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;?></span>
</div>
<div class="inputDiv" >
<input type="text" name="title" style="width:120px;height:15px;"  class="form-input" value="<?php echo !empty($_GET['title'])?$_GET['title']:''?>" placeholder="请输入查询条件">

    <span style="font-size:15px;margin-left: 5px;display:block;">站点选择:&nbsp;&nbsp;&nbsp;</span>
        <span style="display:inline-block; width:200px;">
                <input type="hidden" name="" id="child" value="<?php //echo $ids; ?>" />
             <select style="height:20px;display:block;" name="gid" id="gid" class="form-input w200">
                    <option value="0">--请选择--</option>
                 <?php

                 if (!empty($result)) {?>
                     <?php
                     foreach ($result as $k => $v) {
                         ?>
                         <option value="<?php echo $v['id']; ?>" <?php $gid =!empty($_REQUEST['gid'])?$_REQUEST['gid']:''; if($v['id']==$gid){echo 'selected=selected';}?>><?php echo $v['name']; ?></option>
                     <?php } ?>
                 <?php }?>

                </select>
        </span>
  <input style="width：80px;height:20px;margin-left: 5px" class="btn btn_search" value="查询" type="button">
        <!--<input type="button" style='width:30px;height:20px;float:right;margin-right: 10px;' class="btn page_btn" value="go">
            <span style="float:right;font-size:14px">&nbsp;页</span>
            <input type="text" style='width:30px;height:18px;float:right' class="form-input " value="" name="page"  >
             <span style="float:right;font-size:14px">到第&nbsp;</span>-->
            <?php echo $page;?>


</div>

<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<div class="btn-parent inputDivTwo">
    <a href="<?php echo $this->get_url('guide','uploads',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>" class="btn" style="text-align: center;line-height:30px;">
        上传
    </a>
</div>
<div>
    <table style="text-align: center"  id="tb" class="mtable mt10" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th>序号</th>
            <th>站点</th>
            <th>标题</th>
            <th>Url</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        <?php
        if(!empty($list)){
            foreach($list as $k=>$v){?>
                <tr>
                    <input type="hidden" name="id" value="<?php echo $v['id'];?>">
                    <td><?php echo $v['id'];?></td>
                    <td><?php echo $v['name'];?></td>
                    <td><?php echo $v['title'];?></td>
                    <td><?php
				if($v['flag']<6){
					echo "生成中...";
				}else{
					echo $v['url'];
				}
			?></td>
		    <td>
			<?php 
				if($v['flag']==0){
					echo "未通过";
				}elseif($v['flag']==6){
					echo "已通过";
				}else{
					echo '审核中';
				}
			?>
			</td>
                    <td>
			<?php 
				if($v['flag']==0){//未通过
					echo '<a href="javascript:;" class="review">提交审核</a> <a href="javascript:;" class="del">删除</a></td>';
				}elseif($v['flag']==6){
					echo '<a href="javascript:;" class="del">删除</a>';	
				}else{//审核中
					echo '<a href="javascript:;">删除</a></td>';
				}
			?> 
                </tr>
                <?php
            }
        }
        ?>

    </table>

</div>
<script>
    var adminLeftOne = "<?php echo $adminLeftOne;?>";
    var adminLeftTwo = "<?php echo $adminLeftTwo;?>";
    var adminLeftOneName = "<?php echo $adminLeftOneName;?>";
    var adminLeftTwoName = "<?php echo $adminLeftTwoName;?>";
    var one = "<?php echo !empty($_GET['one'])?$_GET['one']:'0';?>";
    var two = "<?php echo !empty($_GET['two'])?$_GET['two']:'0';?>";
    var three = "<?php echo !empty($_GET['three'])?$_GET['three']:'0';?>";
    var siteName = "<?php echo !empty($_GET['siteName'])?$_GET['siteName']:''; ?>";
    var son = "<?php echo !empty($_GET['son'])?$_GET['son']:''; ?>";
    var topName = "<?php echo !empty($_GET['top'])?$_GET['top']:''; ?>";
    var leftNavFlag  = "<?php echo !empty($_GET['leftNavFlag'])?$_GET['leftNavFlag']:'0'; ?>";
    var adminLeftNavFlag  = "<?php echo !empty($_GET['adminLeftNavFlag'])?$_GET['adminLeftNavFlag']:'0'; ?>";
    var fixedUrl = '/adminLeftOne/'+adminLeftOne+'/adminLeftTwo/'+adminLeftTwo+'/adminLeftOneName/'+adminLeftOneName+'/adminLeftTwoName/'+adminLeftTwoName+'/adminLeftNavFlag/'+adminLeftNavFlag+'/one/'+one+'/two/'+two+'/three/'+three+'/siteName/'+siteName+'/son/'+son+'/top/'+topName+'/leftNavFlag/'+leftNavFlag;

    $('.del').click(function(){
        var id = $(this).parent().parent().children('input').val();
        layer.confirm("确定删除此素材？", {
        	title:"消息提示",
            btn: ['删除','取消'] //按钮
            }, function(){
            $.post("/version/guide/delete?mid=<?php echo $this->mid?>",{id:id},function(data){
                if(data.code=='200'){
                    alert(data.msg);
                    location.reload();
                }else{
                    alert(data.msg);
                }
            },'json')
        })
    })

    $('.page_btn').click(function(){
        var num = $('input[name=pagenum]').val();
        var test = window.location.href;
        window.location.href=test+"&page="+num;
    });

    $('.btn_search').click(function(){
        var title = $('input[name=title]').val();
        var gid =$('#gid').val();
        var nid = "<?php echo $_GET['nid']?>";
        var headerUrl = "/version/guide/content/mid/<?php echo $this->mid;?>"+'/nid/'+nid;
        var center = '';
        var url = '';
        if(gid>0){
            center += '/gid/'+gid;
        }
        if(!empty(title)){
            center += '/title/'+title;
        }

        window.location.href = headerUrl+center+fixedUrl;


    })
    $('.review').click(function(){
        var id = $(this).parent().parent().children('input').val();
        $.post("/version/guide/review.html?mid=1&nid=9",{id:id},function(d){
            if(d.code==200){
                location.reload();
            }
        },'json')
    })
</script>
