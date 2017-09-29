<style>
.mtable td{
	padding:5px;
}
</style>
<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<form action="" method="post">
    <input type="hidden" name="adminLeftOneName" value="<?php echo $adminLeftOneName;?>">
    <input type="hidden" name="adminLeftTwoName" value="<?php echo $adminLeftTwoName;?>">
    <input type="hidden" name="adminLeftOne" value="<?php echo $adminLeftOne;?>">
    <input type="hidden" name="adminLeftTwo" value="<?php echo $adminLeftTwo;?>">
 
<table style="width:900px;" class="mtable mt10" cellpadding="10" cellspacing="0">
         <tr>
    	<th style="background: #A3BAD5;height:30px;" colspan="7">新增用户</th>
    </tr>
        <tr>
            <th>基本信息</th>
            <th colspan="3"></th>
        </tr>
        <tr>
            <td align="right">登录名：</td>
            <td><input placeholder="请输入英文加数字超过6位的账号名作为登陆用" type="text" name="user" id="user" class="form-input w400" value="<?php echo !empty($user->username)?$user->username:''?>"></td>
            <td align="right">用户名：</td>
            <td><input placeholder="请输入用户昵称，可使用中文" type="text" name="nick" id="nick" class="form-input w300" value="<?php echo !empty($user->nickname)?$user->nickname:''?>"></td>
        </tr>
        <tr>
            <td align="right">密码：</td>
            <td><input placeholder="请输入密码(6-18位数字或英文字符)" type="password" name="pass" id="pass" value="" class="form-input w400"></td>
            <td align="right">重复密码：</td>
            <td><input placeholder="请再次输入密码"  type="password" name="rePass" id="rePass" value="" class="form-input w300"></td>
        </tr>
        <tr>
            <td align="right">电子邮件：</td>
            <td><input placeholder="请输入电子邮箱地址，格式XXXXX@XXX.XXX" type="text" name="email" id="email" class="form-input w400" value="<?php echo !empty($user->email)?$user->email:''?>"></td>
            <td align="right">联系电话：</td>
            <td><input placeholder="请输入手机号码" type="text" name="tel" id="tel" class="form-input w300" value="<?php echo !empty($user->tel)?$user->tel:''?>"></td>
        </tr>
        <tr id="addr">
            <td width="100" align="right">地址：</td>
            <td>
                <select name="province[]" onchange="getregin(this)" id="w0" class="form-input" style="width: 140px">
                    <?php
                    if(!empty($provinceCode)){
                        foreach($province as $v){?>
                            <option <?php if($provinceCode==$v['provinceCode']){echo "selected=selected"; } ?> value ="<?php echo $v['provinceCode'];?>_<?php echo $v['provinceName'];?>"><?php echo $v['provinceName'];?></option>
                            <?php
                        }
                    }?>
                    <?php
                       if(empty($provinceCode)){
                        foreach($province as $j){?>
                            <option  value ="<?php echo $j['provinceCode'];?>_<?php echo $j['provinceName'];?>"><?php echo $j['provinceName'];?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <select name="city[]" id="c0" class="form-input"  style="width: 140px">
                    <option value="0">请选择市</option>
                    <?php
                    if(!empty($cityCode)){
                        foreach($limitCity as $vv){?>
                            <option <?php if($cityCode==$vv['cityCode']){echo "selected=selected"; } ?> value ="<?php echo $vv['cityCode'];?>_<?php echo $vv['cityName'];?>"><?php echo $vv['cityName'];?></option>

                            <?php
                        }
                    }
                    ?>

                </select>
            </td>
            <td align="right">公司：</td>
            <td>
                <input placeholder="请输入公司名称" type="text" class="form-input w300" name="company" value="<?php echo !empty($user->company)?$user->company:''?>">
            </td>
        </tr>
        <tr>
            <th>用户权限信息</th>
            <th colspan="3"></th>
        </tr>
        <tr>
            <th>任务名称</th>
            <th colspan="3">职能</th>
        </tr>
        <?php
            if(!empty($res['work'])){
               foreach($res['work'] as $k=>$v){
                        ?><tr>
                    <td><?php echo $v['name']?></td>
                    <td colspan="3"><?php
                        switch($v['type']){
                            case '1':echo '编辑';break;
                            case '2':echo '发布';break;
                            case '3':echo '浏览';break;
                        }
                        ?></td>
                      </tr>
               <?php
                 }
            }
        ?>
        <?php
            if(!empty($res['review'])){
               foreach($res['review'] as $k=>$v){
                        ?>
                    <tr>
                    <td><?php echo $v['name']?></td>
                    <td colspan="3"><?php echo $v['type']?>审</td>
                    </tr>
               <?php
                 }
            }
        ?>
        <tr>
 
            <td colspan="4" align="center">
                <input style="width:100px;height:30px;padding:0px;float:none" type="submit" value="添加/保存用户" class="btn" onclick="return check();" >
                <input style="width:100px;height:30px;padding:0px;float:none" type="button" value="返回列表" class="gray" onclick="window.location.href='<?php echo $this->get_url('admin','index',array('nid'=>$_GET['nid'],'adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName));?>'">
            </td>
        </tr>
    </table>
</form>
<script charset="utf-8" type="text/javascript">
    function check(){
        var name = $('#user').val();
	 
       if(name.match(/^\w{6,20}$/) == null){
            layer.alert('登录名不能为空或者格式错误',{icon:0});
            return false;
        }
 	
        var nick = $('#nick').val();
        if(nick.match(/^.{1,30}$/) == null){
            layer.alert('昵称不能为空或者格式错误');
            return false;
        }
        <?php if(empty($_GET['id'])){?>
        var pass = $('#pass').val();
        if(pass.match(/^[a-zA-Z0-9]{6,18}$/) == null){
            layer.alert('密码不能为空或者格式错误',{icon:0});
            return false;
        }

        var rePass = $('#rePass').val();
        if(rePass.match(/^[a-zA-Z0-9]{6,18}$/) == null){
            layer.alert('重复密码不能为空或者格式错误',{icon:0});
            return false;
        }

        if(pass !== rePass){
            layer.alert('重复密码不一致',{icon:0});
            return false;
        }
        <?php }?>

        var email = $('#email').val();
        if(email.match(/^[a-zA-Z0-9]+@[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)+/) == null){
            layer.alert('邮箱不能为空或者格式错误',{icon:0});
            return false;
        }
        var auth = $('#auth').val();
        //if(empty(auth)){
            //layer.alert('请选择权限组',{icon:0});
            //return false;
        //}
        if($("input[name=company]").val()== ''){
            layer.alert('公司不能为空或者格式错误',{icon:0});
            return false;
        }
        if($("#w0").val()=='0_请选择省份'||$("#c0").val()=='0_全部地级市' ||$("#c0").val()=='' ){
            layer.alert('请完善地址',{icon:0});
            //console.log($("#c0").val());
            return false;
        }
	 
        if($("input[name=tel]").val()== ''){
            layer.alert('电话不能为空或者格式错误',{icon:0});
            return false;
        }else {
            return true;
        }
	 $.post("<?php echo $this->get_url('admin','checkusername')?>",{name:name},function(d){
                if(d == 1){
                        layer.alert('该登名已存在',{icon:0});
            return false;

                }
            },'json')


    }

    function getregin(obj){
        var shengid=obj.value;
        var i = shengid.split('_');//分割
        var ns=obj.id;
        var wz=ns.charAt(ns.length - 1);
        var remo="c"+wz+' '+"option";

        $("#"+remo).remove();

        $.getJSON("/version/admin/getcity?mid=<?php echo $_GET['mid']?>",{id:i[0]},function(data){

            $.each(data,function(i){
                $("#c"+wz).append('<option value="'+data[i]['cityCode']+'_'+data[i]['cityName']+'">'+data[i]['cityName']+'</option>');
//                +'_'+data[i]['cityName']
            });
        });
    };
</script>


