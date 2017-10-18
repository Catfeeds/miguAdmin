<?php //var_dump($Pro);?>
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
.btn{width:70px;
        height:30px;
    }
    #name{
        width:120px;
        height:18px;
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
        height：20px;
    }
    .inputDiv span{
        float: left;
        font-size:14px;
    }
    .inputDiv select{
        float: left;
        height:20px;
        margin-left:5px;
    }
    .inputDivTwo{
        width:100%;
        float:left;
        height:30px;
        background: #f0fdff;
        padding: 5px 0px 5px 12px;
    }
</style>
<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<div style='padding: 5px 0px 5px 12px;'>
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;?></span>
</div>

<div class="inputDiv">
    <span>站点名称：</span>
    <input type="text" name="name" value="<?php echo !empty($_REQUEST['name'])?$_REQUEST['name']:''?>" id="name" autofocus="autofocus"  placeholder="请输入站点名称">
    <span>省份</span>
    <select id="pro">
	<?php foreach($Pro as $v):?>
        <option <?php if(!empty($_REQUEST['province'])){if($_REQUEST['province']==$v['provinceCode']){echo 'selected=selected';}}?> value="<?php echo $v['provinceCode']?>"><?php echo $v['provinceName'];?></option>
        <?php endforeach;?>
    </select>
    <span>牌照方：</span>
    <select name="cp" id="cp" class="form-input w100 field">
        <option value="0">选择CP</option>
        <option <?php $cp=!empty($_REQUEST['cp'])?$_REQUEST['cp']:'';if($cp=='1'){echo "selected=selected"; }  ?> value="1">华数</option>
        <option <?php $cp=!empty($_REQUEST['cp'])?$_REQUEST['cp']:'';if($cp=='2'){echo "selected=selected"; }  ?> value="2">百视通</option>
        <option <?php $cp=!empty($_REQUEST['cp'])?$_REQUEST['cp']:'';if($cp=='3'){echo "selected=selected"; }  ?>  value="3">未来电视</option>
        <option <?php $cp=!empty($_REQUEST['cp'])?$_REQUEST['cp']:'';if($cp=='4'){echo "selected=selected"; }  ?> value="4">南传</option>
        <option <?php $cp=!empty($_REQUEST['cp'])?$_REQUEST['cp']:'';if($cp=='5'){echo "selected=selected"; }  ?> value="5">芒果</option>
        <option <?php $cp=!empty($_REQUEST['cp'])?$_REQUEST['cp']:'';if($cp=='6'){echo "selected=selected"; }  ?> value="6">国广</option>
        <option <?php $cp=!empty($_REQUEST['cp'])?$_REQUEST['cp']:'';if($cp=='7'){echo "selected=selected"; }  ?> value="7">银河</option>
	 <option <?php $cp=!empty($_REQUEST['cp'])?$_REQUEST['cp']:'';if($cp=='poms'){echo "selected=selected"; }  ?> value="poms">咪咕</option>
    </select>
      <input style="width:50px;height:20px;margin-left: 5px;" class="btn btn1 btn-gray audit_search search " type="button" value="查询" name="" style="font-size: 14px;/*margin-right:550px;*/">

</div>

<div class="inputDivTwo">
    <button class="btn addStation">新建站点</button>
</div>
<div>
    <table class="mtable mt10" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th>序号</th>
            <th>站点名称</th>
            <th>牌照方</th>
            <th>userGroup</th>
            <th>epgCode</th>
            <th>省份</th>
            <th>地区</th>
            <th>备注</th>
            <th>操作</th>
        </tr>
        <?php
        if(!empty($list)){
            foreach($list as $k=>$v){ ?>
                <tr>
                    <td align="center"><?php echo $v['id'];?></td>
                    <td align="center"><?php echo $v['name'];?></td>
                    <td align="center">
                        主：
                        <?php
                        $cp = explode('/',trim($v['cp']));
                        if(in_array('1',$cp)){
                            echo '华数';
                        }
                        if(in_array('2',$cp)){
                            echo ' 百视通';
                        }
                        if(in_array('3',$cp)){
                            echo ' 未来电视';
                        }
                        if(in_array('4',$cp)){
                            echo ' 南传';
                        }
                        if(in_array('5',$cp)){
                            echo ' 芒果';
                        }
                        if(in_array('6',$cp)){
                            echo ' 国广';
                        }
                        if(in_array('7',$cp)){
                            echo ' 银河';
                        }
			if(in_array("poms",$cp)){
			    echo "咪咕";
			}
                        ?>
                        次:
                        <?php
                        $cp = explode('/',trim($v['cps']));
                        if(in_array('1',$cp)){
                            echo '华数';
                        }
                        if(in_array('2',$cp)){
                            echo ' 百视通';
                        }
                        if(in_array('3',$cp)){
                            echo ' 未来电视';
                        }
                        if(in_array('4',$cp)){
                            echo ' 南传';
                        }
                        if(in_array('5',$cp)){
                            echo ' 芒果';
                        }
                        if(in_array('6',$cp)){
                            echo ' 国广';
                        }
                        if(in_array('7',$cp)){
                            echo ' 银河';
                        }
			if(in_array("poms",$cp)){
			    echo "咪咕";
			}
                        ?>
                    </td>
                    <td align="center"><?php echo $v['usergroup'];?></td>
                    <td align="center"><?php echo $v['epgcode'];?></td>
                    <td align="center"><?php echo $v['provinceName'];?></td>
                    <td align="center"><?php echo $v['cityName'];?></td>
                    <td align="center"><?php echo $v['mark'];?></td>
                    <td>
                        <a href="#" onclick="update(this)" stationId="<?php echo $v['id'];?>">编辑</a>
                        &nbsp;&nbsp;
                        <a href="#" onclick="del(this)" stationId="<?php echo $v['id'];?>">删除</a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
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
    $('.addStation').click(function()
    {
        var mid = "<?php echo $_GET['mid']?>";
        var my = layer.msg('加载中', {icon: 16,shade:0.3});
        $.getJSON('<?php echo $this->get_url('station','add')?>',function(d){
            if(d.code == 200){
                layer.close(my);
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['930px', '506px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    });

    function update(obj)
    {
        var mid = "<?php echo $_GET['mid']?>";
        var id = $(obj).attr('stationId');
        var my = layer.msg('加载中', {icon: 16,shade:0.3});
        $.getJSON('<?php echo $this->get_url('station','update')?>',{id:id,mid:mid},function(d){
            if(d.code == 200){
                layer.close(my);
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['930px', '506px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    }
    function del(obj){
        var mid = "<?php echo $_GET['mid']?>";
        var id = $(obj).attr('stationId');
        layer.confirm("确定删除此站点吗？", {
        	title:"消息提示",
            btn: ['删除','取消'] //按钮
            }, function(){
            $.getJSON('<?php echo $this->get_url('station','del')?>',{id:id,mid:mid},function(d){
                if(d.code==200){
                    alert('删除成功!')
                    location.reload();
                }else{
                    alert('删除失败!')
                }
            })
        })
    }

    $('.search').click(function(){
        var name = $('input[name=name]').val();
        var cp = $('#cp').val();
	var province=$("#pro").val();
        var mid = <?php echo $_REQUEST['mid']?>;
        var nid = <?php echo $_REQUEST['nid']?>;
        window.location.href="/version/station/index?mid="+mid+"&province="+province+"&name="+name+"&cp="+cp+"&nid="+nid+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
    })
</script>

