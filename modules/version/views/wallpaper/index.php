<?php
//var_dump($list);
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
.cc{color:#ccc}
.cc img{opacity:0.5}
</style>
<?php
    $adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
    $adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
    $adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
    $adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<div style='padding: 5px 0px 5px 14px;'>
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;?></span>
</div>
<div class="inputDiv" >
<input type="text" name="title" style="width:120px;height:15px;"  class="form-input" value="<?php echo !empty($_GET['title'])?$_GET['title']:''?>" placeholder="请输入查询条件">

    <span style="font-size:15px;margin-left: 5px">站点选择:</span>
        <span style="display:inline-block;">
                <input type="hidden" name="" id="child" value="<?php //echo $ids; ?>" />
             <select style="height:20px;" name="gid" id="gid" class="form-input w100">
                    <option value="0">请选择</option>
                 <?php
                 if($_SESSION['auth'] == 1){
                     $sql = "select id,name from yd_ver_station";
                 }else{
                     $uid = $_SESSION['userid'];
                     $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 5  left join yd_ver_worker as c on c.workid=b.id where c.type = 1 and  c.uid=$uid group
 by a.id";
                 }
                 $result = SQLManager::queryAll($sql);
                 if (!empty($res)) {?>
                     <?php
                     foreach ($result as $k => $v) {
                         ?>
                         <option value="<?php echo $v['id']; ?>" <?php $gid =!empty($_REQUEST['gid'])?$_REQUEST['gid']:''; if($v['id']==$gid){echo 'selected=selected';}?>><?php echo $v['name']; ?></option>
                     <?php } ?>
                 <?php }?>

                </select>
        </span>
	<span style="font-size:15px;margin-left: 5px">类型:</span>
	<span style="display:inline-block;">
	<select id="type" class="form-input w100" style="height:20px">
		<option value="0">请选择</option>
		<option value="1" <?php if(!empty($_GET['type'])&&$_GET['type']==1){echo "selected=selected";}?>>普通类型</option>
		<option value="2" <?php if(!empty($_GET['type'])&&$_GET['type']==2){echo "selected=selected";}?>>强制类型</option>
	</select></span>
	<span style="font-size:15px;margin-left: 5px">省份:</span>
	<?php 
                        $sql="select * from yd_province order by provinceCode asc";
			$sql_c="select * from yd_city";
			$city=SQLManager::queryAll($sql_c);
                        $province=SQLManager::queryAll($sql);
                ?>
        <span style="display:inline-block;">
        <select class="form-input w100 code" style="height:20px" onchange="getcity()">
		<?php foreach($province as $v):?>
			<option value="<?php echo $v['provinceCode'];?>" <?php $gid =!empty($_REQUEST['province'])?$_REQUEST['province']:''; if($v['provinceCode']==$gid){echo 'selected=selected';}?>><?php echo $v['provinceName'];?></option>
		<?php endforeach;?>
        </select></span>
	<span style="font-size:15px;margin-left: 5px">地市:</span>
        <span style="display:inline-block;">
        <select class="form-input w100 city" style="height:20px">
                <option value="">请选择</option>
        </select></span>
  <input style="width：80px;height:20px;margin-left: 5px" id='button' class="btn btn_search" value="查询" type="button">
        
            <?php echo $page;?>


</div>
<div class="inputDivTwo">
    <?php
   
    if(in_array('1',$res['status']) || $_SESSION['auth']=='1'){
        ?>
        <a style="line-height: 30px;text-align: center;" href="<?php echo $this->get_url('wallpaper', 'newAdd',array('nid'=>$_GET['nid'],'adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName)) ?>" class="btn" >添加壁纸</a>
        <?php
    }

    ?>
</div>

<div style='width:100%;' >
    <table width="1280px" cellspacing="0" cellpadding="10" class="mtable center">
        <tr>
            <th>编号</th>
	    <th>站点</th>
            <th>标题</th>
	    <th>壁纸类型</th>
	    <th>省份</th>
	    <th>市</th>
            <th>缩略图</th>
            <th>有效期</th>
            <th>审核</th>
            <th>操作</th>
        </tr>
        <?php
	  $uid = $_SESSION['userid'];

        $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 5  left join yd_ver_worker as c on c.workid=b.id where c.type = 1 and  c.uid=$uid group
 by a.id";
        $st = SQLManager::QueryAll($sql);
                $gid = array();
        if(!empty($st)){
                foreach($st as $k => $v){
                  $gid[] = $v['id'];
                }
        }
        if(!empty($list)){

            foreach($list as $l){?>
                <tr id="<?php echo $l->id;?>">
                    <input type="hidden" name="id" value="<?php echo $l->id?>">
		    <td><?php echo $l->id?></td>
                    <td><?php
			foreach($result as $k => $v){
				if($l->gid == $v['id']){ echo $v['name']; }
			}
 		   ?></td>
                   <td><?php echo $l->title;?></td>
		    <td><?php if($l->type==1){echo "强制壁纸";}else{echo "普通壁纸";}?></td>
		    <td>
			<?php
                            $p=explode("/",$l->province);
                            for($j=0;$j<count($p);$j++){
                                for($m=0;$m<count($province);$m++){
                                    if($p[$j]===$province[$m]['provinceCode']){
                                        echo $province[$m]['provinceName'];
                                    }
                                }
                            }

                        ?>
		    </td>
		    <td>
		    <?php
                        $c=explode("/",$l->city);
                        for($j=0;$j<count($c);$j++){
                            for($m=0;$m<count($city);$m++){
                                if($c[$j]==$city[$m]['cityCode'] && $p[$j]==$city[$m]['provinceId']){
                                    echo $city[$m]['cityName'];
                                }
                            }
                        }
                    ?>
		    </td>
                    <td><img src="<?php echo $l->thum?>" width="150px" height="86px"></td>
                    <!--<td><img src="<?php echo $l->pic?>" width="214px" height="123px"></td>-->
		   <td 
			<?php 
				if(!empty($l->startTime)&&!empty($l->endTime)&&$l->endTime<strtotime(date('Ymd',time()))){
					echo "class='cc'>".date("Y-m-d",$l->startTime);
				}elseif(!empty($l->startTime)){
					echo ">".date("Y-m-d",$l->startTime);
				}else{
					echo ">-";
				}
			?>~
			<?php 
				if(!empty($l->endTime)){
					echo date("Y-m-d",$l->endTime);
				}else{
					echo "-";
				}
			?>
			</td>
                    <td>
                        <?php
                        /*switch($l->flag){
                            case '0':echo '未通过';break;
                            case '1':
                            case '2':
                            case '3':
                            case '4':
                            case '5':
                                echo '审核中';break;
                            case '6':echo '已通过';break;
                        }*/
                        if ($l->flag == '0') {
                            echo '未通过';
                        } else if ($l->flag == '6' && $l->delFlag == '0') {
                            echo '通过';
                        } else if ($l->delFlag == '1') {
                            echo '删除壁纸审核中';
                        } else {
                            echo '审核中';
                        }
                        ?>
                    </td>
                    <td>
                        <?php
			
                        if((in_array('1',$res['status']) || $_SESSION['auth']==1)&&(in_array($l->gid,$gid)|| $_SESSION['auth']=='1')){
                            if($l->flag=='0'){
                                ?>
                                <a href="<?php echo $this->get_url('wallpaper','update',array('id'=>$l->id,'nid'=>$_GET['nid'],'adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>">编辑</a>
                                &nbsp;<a class="review">提交审核</a>
                                <a href="javascript:void(0)" gid="<?php echo $l->id?>" class="del">删除</a>
                                <?php
                            }else if($l->flag=='6'){
                                ?>
                                <a href="<?php echo $this->get_url('wallpaper','update',array('id'=>$l->id,'nid'=>$_GET['nid'],'adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>">编辑</a>
                                <a href="javascript:void(0)" gid="<?php echo $l->id?>" class="del">删除</a>
                                <?php
                            }
                        }
                        ?>

                    </td>
                </tr>
                <?php
            }
        }else{?>
            <tr>
                <td colspan="10" align="center">暂无数据</td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
<div>

</div>


<script type="text/javascript" charset="utf-8">
	

    $('.page_btn').click(function(){
        var num = $('input[name=pagenum]').val();
        var test = window.location.href;
        window.location.href=test+"&page="+num;
    });

    $('.del').click(function(){
        var k = $(this);
        var v = $(k).attr('gid');
        if(empty(v)) return false;
        layer.confirm("你确定删除该壁纸并提交审核吗？", {
        	title:"消息提示",
            btn: ['删除','取消'] //按钮
            }, function(){
            $.post('/version/wallpaper/del?mid=<?php echo $_GET['mid']?>',{id:v},function(d){
                if(d.code == 200){
                    layer.alert(d.msg,{icon:1});
                    location.reload();
//                    $(k).parent().parent().remove();


                }else{
                    layer.alert(d.msg,{icon:0});
                }
            },'json');
            $("#"+v).remove();
        })
    });

    function getregin(){
        var shengid=$("#province").val();

        var i = shengid.split('_');//分割
        $("#city option").remove();

        $.getJSON("/version/wallpaper/getcity?mid=<?php echo $_GET['mid']?>",{id:i[0]},function(data){

            $.each(data,function(i){
                $("#city").append('<option value="'+data[i]['cityCode']+'_'+data[i]['cityName']+'">'+data[i]['cityName']+'</option>');
//                +'_'+data[i]['cityName']
            });
        });
    };

    <?php
    $adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
    $adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
    $adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
    $adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
    ?>

    $('.review').click(function(){
        var id = $(this).parent().parent().children('input').val();
        $.post("<?php echo $this->get_url('wallpaper','review')?>",{id:id},function(d){
            if(d.code==200){
                location.reload();
            }
        },'json')
    })

	function getcity(){
		var provinceCode=$(".code option:selected").val();
		$(".city").children().remove();
		$.getJSON("/version/wallpaper/getcity?mid=1",{id:provinceCode},function(data){
			$.each(data,function(i){
				$(".city").append('<option value="'+data[i]['cityCode']+'">'+data[i]['cityName']+'</option>');
			})
		});
	}
	getcity();
	
	$('.btn_search').click(function(){
	var adminLeftOne = "<?php echo $adminLeftOne;?>";
        var adminLeftTwo = "<?php echo $adminLeftTwo;?>";
        var adminLeftOneName = "<?php echo $adminLeftOneName;?>";
        var adminLeftTwoName = "<?php echo $adminLeftTwoName;?>";
	var nid="<?php echo $_REQUEST['nid'];?>";
        var title = $('input[name=title]').val();
        var gid=$("#gid").val();
        var type=$("#type").val();
        var province=$(".code").val();
        var city=$(".city").val();
        var mid = "<?php echo $_REQUEST['mid']?>";
	//console.log(type);return false;
        window.location.href="/version/wallpaper/index?mid="+mid+"&nid="+nid+"&title="+title+"&gid="+gid+"&type="+type+"&province="+province+"&city="+city+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
    })
	$(".cc").siblings("td").addClass("cc");
</script>

