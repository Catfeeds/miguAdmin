<script charset="utf-8" type="text/javascript" src="/js/jdate/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/js/jdate/jquery.datetimepicker.css" />
<?php
    $adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
    $adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
    $adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
    $adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<style>
.layui-layer-dialog{
	min-width:340px;
}
.layui-layer-dialog .layui-layer-content{
	padding: 30px 20px 40px 30px;
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

    }
    .inputDivTwo{
        width:100%;
        float:left;
        height:30px;
        background: #f0fdff;
        padding: 5px 0px 7px 12px;
    }
    .inputDivTwo input{float:left;}		
</style>
<div style='padding: 5px 0px 5px 12px;'>
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;?></span>
</div>
<div >
    <form action="">
	<div class='inputDiv'>
                    <input type="text" name="title" style="width:120px;height:18px;" id='title' class="form-input" value="<?php echo !empty($_GET['title'])?$_GET['title']:''?>" placeholder="请输入查询条件">
        <span style="font-size:15px;margin-left: 5px">节目类型:&nbsp;&nbsp;&nbsp;</span>
        <select style="height:20px;width:80px" name="type" class="form-input" id="type">
            <option value="0">请选择</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='电影'){echo "selected=selected"; }  ?> value="电影" >电影</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='综艺'){echo "selected=selected"; }  ?> value="综艺">综艺</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='新闻'){echo "selected=selected"; }  ?>value="新闻">新闻</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='电视剧'){echo "selected=selected"; }  ?>value="电视剧">电视剧</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='动漫'){echo "selected=selected"; }  ?>value="动漫">动漫</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='教育'){echo "selected=selected"; }  ?>value="教育">教育</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='体育'){echo "selected=selected"; }  ?>value="体育">体育</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='音乐'){echo "selected=selected"; }  ?>value="音乐">音乐</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='娱乐'){echo "selected=selected"; }  ?>value="娱乐">娱乐</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='健康'){echo "selected=selected"; }  ?>value="健康">健康</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='纪实'){echo "selected=selected"; }  ?>value="纪实">纪实</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='旅游'){echo "selected=selected"; }  ?>value="旅游">旅游</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='法制'){echo "selected=selected"; }  ?>value="法制">法制</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='搞笑'){echo "selected=selected"; }  ?>value="搞笑">搞笑</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='时尚'){echo "selected=selected"; }  ?>value="时尚">时尚</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='军事'){echo "selected=selected"; }  ?>value="军事">军事</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='财经'){echo "selected=selected"; }  ?>value="财经">财经</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='曲艺'){echo "selected=selected"; }  ?>value="曲艺">曲艺</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='奥运'){echo "selected=selected"; }  ?>value="奥运">奥运</option>
        </select>
        <input style="width：80px;height:20px;margin-left: 5px" class="btn btn_search" value="查询" type="button">
	<!--<input type="button" style='width:30px;height:20px;float:right;margin-right: 10px;' class="btn page_btn" value="go">
	    <span style="float:right;font-size:14px">&nbsp;页</span>
	    <input type="text" style='width:30px;height:18px;float:right' class="form-input " value="" name="page"  >
	     <span style="float:right;font-size:14px">到第&nbsp;</span>-->
            <?php echo $page;?>
	
	</div>
	<div class='inputDivTwo'>
           <input class="btn keyadd" value="新建标签" type="button" style="float: left;">
	</div>
        <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
            <tr>
                <th>编号</th>
                <th>节目类型</th>
                <th>关键字</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            <?php
                if(!empty($list)){
                    foreach( $list as $k=>$v){
                        ?>
                        <tr>
                            <input type="hidden" value="<?php echo $v['id']?>" name="id">
                            <td><?php echo $v['id']?></td>
                            <td><?php echo $v['type']?></td>
                            <td><?php echo $v['keyword']?></td>
                            <td><?php echo date('Y-m-d',$v['cTime'])?></td>
                            <td><a class="edit">编辑</a>&nbsp;<a class="del">删除</a></td>
                        </tr>
                    <?php
                    }
                }
            ?>
        </table>
        <div><?php /*echo $page*/?></div>
    </form>
</div>
<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<script>
    var adminLeftOne = "<?php echo $adminLeftOne;?>";
    var adminLeftTwo = "<?php echo $adminLeftTwo;?>";
    var adminLeftOneName = "<?php echo $adminLeftOneName;?>";
    var adminLeftTwoName = "<?php echo $adminLeftTwoName;?>";
    $('.keyadd').click(function(){
        $.getJSON('<?php echo $this->get_url('content','keyadd')?>',function(d){
            if(d.code == 200){
                layer.open({
                    type: 1,
		    title: '添加标签',
                    skin: 'layui-layer-rim', //加上边框
                    area: ['300px', '140px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })

    $('.edit').click(function(){
        var id = $(this).parent().parent().children('input').val();
        $.getJSON('<?php echo $this->get_url('content','keyadd')?>',{id:id},function(d){
            if(d.code == 200){
                layer.open({
                    type: 1,
		    title: '编辑标签',
                    skin:'layui-layer-rim', //加上边框
                    area: ['300px', '140px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })

    $('.btn_search').click(function(){
        var type = $('#type').val();
        var mid = "<?php echo $this->mid?>";
	var title = $('#title').val();
	if(!empty(title)){
	   window.location.href="/version/content/keyword?mid="+mid+"&title="+title+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
	   return true; 	
	}
	
        window.location.href="/version/content/keyword?mid="+mid+"&type="+type+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
    })

    $('.page_btn').click(function(){
        var page = $('input[name=pagenum]').val();
	var type = $('#type').val();
        var mid = "1";
        window.location.href="/version/content/keyword?mid="+mid+"&page="+page+"&type="+type+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
    })	
  
    $('.del').click(function(){
        var id = $(this).parent().siblings('input').val();
	layer.confirm('你确定删除此标签？', {
  	       title:"消息提示",title:"消息提示",
		btn: ['删除','取消'] //按钮
            }, function(){
	    $.post('<?php echo $this->get_url('content','keydel')?>',{id:id},function(d){
                if(d.code==200){
                   alert(d.msg);
                   location.reload();
                }else{
                   alert(d.msg);
                }
            },'json')	
        }, function(){
	   layer.close;	
          });
        return false;
	if(confirm('你确定删除此标签？')){
        $.post('<?php echo $this->get_url('content','keydel')?>',{id:id},function(d){
            if(d.code==200){
                alert(d.msg);
                location.reload();
            }else{
                alert(d.msg);
            }
        },'json')
	}
    })
</script>


