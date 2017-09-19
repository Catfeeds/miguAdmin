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
    .inputDiv{
           width:100%;
        float:left;

        background: #A3BAD5;
        padding: 5px 0px 5px 12px;
    }
    .inputDiv input{
        float: left;
        height:18px;
        width:120px;
    }
    .inputDiv span{
        float: left;
    }
    .inputDiv select{
        float: left;
        margin-left:5px;
        height:20px;
    }
    .inputDivTwo{
        width:100%;
        float:left;
        height:30px;
        background: #f0fdff;
        padding: 5px 0px 7px 12px;
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
    <form >
   <span> 用户名称:</span>
    <input type="text" placeholder='输入用户名查询' value="<?php echo !empty($_GET['user'])?$_GET['user']:''?>" name='user' class="form-input w100">
      <span>  省份:</span>
     <select name="pro" id="pro" class="form-input w200">
        <?php
        $sql = "select provinceCode,provinceName from yd_province  order by provinceCode asc";
        $test = SQLManager::queryAll($sql);
        if(!empty($test)){
            foreach($test as $k=>$v){
                ?>
                <option <?php $prolist=!empty($_REQUEST['company'])?$_REQUEST['company']:'';if($prolist==$v['provinceCode']){echo "selected=selected"; }  ?> value="<?php echo $v['provinceCode']; ?>"><?php echo $v['provinceName']; ?></option>
                <?php
            }
        }
        ?>
    </select>
      <input style="width:50px;height:20px;margin-left: 5px;" class="btn btn1 btn-gray audit_search search " type="button" value="查询" name="" style="font-size: 14px;/*margin-right:550px;*/">

        </form>
</div>
<div class="inputDivTwo">
    <a href="<?php echo $this->get_url('admin','add',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>" class="btn" style="line-height: 30px;text-align: center;">新建用户</a>
</div>
<div class="mt10">
    <form action="">
        <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>省市</th>
                <th>公司</th>
                <th>联系方式</th>
                <th>操作</th>
            </tr>
            <?php
                if(!empty($list)){
                    foreach($list as $k=>$v){
                        ?>
                        <tr>
                            <input type='hidden' value="<?php echo $v['id'] ?>" name='id'>
                            <td><?php echo $v['id'] ?></td>
                            <td><?php echo $v['nickname'] ?></td>
                             <td>
                                <?php if(!empty($province)){foreach($province as $val){if($v['pro']==$val['provinceCode']) echo $val['provinceName'];}} ?>/<?php if(!empty($city)){foreach($city as $vv){if($v['city']==$vv['cityCode']&&$v['city']!=0 ) echo $vv['cityName']; }} ?>
                            </td>
                           <!-- <td><?php echo $v['pro']?>/<?php echo $v['city'] ?></td>-->
                            <td><?php echo $v['company'] ?></td>
                            <td><?php echo $v['tel'] ?></td>
                            <td><a href="<?php echo $this->get_url('admin','add',array('id'=>$v['id'],'nid'=>$_REQUEST['nid'],'adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>">编辑</a>&nbsp;&nbsp;<a class='del'>删除</a></td>
                        </tr>
                    <?php
                    }
                }
            ?>
        </table>
    </form>
</div>
<script>
    $('.del').click(function(){
        var id = $(this).parent().parent().children('input').val();
        layer.confirm("确定删除此用户吗？", {
        	title:"消息提示",
            btn: ['删除','取消'] //按钮
            }, function(){
            $.post("<?php echo $this->get_url('admin','del')?>",{id:id},function(d){
                if(d.code==200){
                    alert('删除成功');
                    location.reload();
                }else{
                    alert('删除失败')
                }
            },'json')
        })
    })

    var adminLeftOne = "<?php echo $adminLeftOne;?>";
    var adminLeftTwo = "<?php echo $adminLeftTwo;?>";
    var adminLeftOneName = "<?php echo $adminLeftOneName;?>";
    var adminLeftTwoName = "<?php echo $adminLeftTwoName;?>";

    $('.search').click(function(){
        var user = $('input[name=user]').val();
        var company = $('#pro').val();
        var pro = "<?php echo $_SESSION['nickname']?>";
        var nid = "<?php echo $_REQUEST['nid']?>";
        var mid = <?php echo $_REQUEST['mid']?>;
        window.location.href="/version/admin/index?mid="+mid+"&user="+user+"&company="+company+"&pro="+pro+"&nid="+nid+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
    })
</script>


