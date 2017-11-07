<style>
    .center{
        margin-left:50px;
    }
    aa{
        width:200px;
        height:50px;
    }
    .mtable td{
    	padding:5px;
    }
</style>
<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<table style="width:100%;" class="mtable mt10" cellpadding="10" cellspacing="0">

<div class="center">
<!--<tr>
    <td>选择省份</td>
    <td><select name="province" onchange="getregin()" id="province" class="form-input w200">
                          <option value="0" >请选择省份</option>
        <?php
        if(!empty($province)){
            foreach($province as $v){?>
                <option <?php if($provinceCode==$v['provinceCode']){echo "selected=selected"; } ?> value ="<?php echo $v['provinceCode']?>_<?php echo $v['provinceName']?>"><?php echo $v['provinceName']?></option>
                <?php
            }
        }
        ?>
    </select>
    </td>
    <td>选择地区</td>
    <td><select name="city" id="city"  class="form-input w200">
        <option value="0">请选择市</option>
        <?php
        if(!empty($city)){
            foreach($city as $vv){?>
                <option <?php if($cityCode==$vv['cityCode']){echo "selected=selected"; } ?> value ="<?php echo $vv['cityCode']?>_<?php echo $vv['cityName']?>"><?php echo $vv['cityName']?></option>

                <?php
            }
        }
        ?>
    </select>
    </td>
</tr>-->
    <tr id="sf">
        <td align="center">省份数：</td>
        <td>
            <select class="form-input w200" name="xuanze" id="xuanze" onchange="checks()">
                <option value="0">--请选择--</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
            </select>
        </td>
    </tr>
        <span class="s">
            <tr id="addr">
                <td width="145" align="center">地址：</td>
                <td>
                    <select name="province[]" onchange="getregin(this)" id="w0" class="form-input proadd" style="width: 140px">
                        <!--                    <option value="0">请选择省份</option>-->
                        <?php
                        if(!empty($province)){
                            foreach($province as $v){?>
                                <option <?php if($provinceCode==$v['provinceCode']){echo "selected=selected"; } ?> value ="<?php echo $v['provinceCode']?>_<?php echo $v['provinceName']?>"><?php echo $v['provinceName']?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <select name="city[]" id="c0" class="form-input cityadd"  style="width: 140px">
                        <option value="0">请选择市</option>
                        <?php
                        if(!empty($city)){
                            foreach($city as $vv){?>
                                <option <?php if($cityCode==$vv['cityCode']){echo "selected=selected"; } ?> value ="<?php echo $vv['cityCode']?>_<?php echo $vv['cityName']?>"><?php echo $vv['cityName']?></option>

                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
        </span>
<tr>
    <td align="center">主牌照方：</td>
    <td colspan="3">
        <input type="checkbox" name="cp" id="cp" value="1">华数
        <input type="checkbox" name="cp" id="cp" value="2">百视通
        <input type="checkbox" name="cp" id="cp" value="3">未来电视
        <input type="checkbox" name="cp" id="cp" value="4">南传
        <input type="checkbox" name="cp" id="cp" value="5">芒果
        <input type="checkbox" name="cp" id="cp" value="6">国广
        <input type="checkbox" name="cp" id="cp" value="7">银河
        <input type="checkbox" name="cp" id="cp" value="poms">咪咕
    </td>
</tr>
<tr>
        <td align="center">次牌照方：</td>
        <td colspan="3">
            <input type="checkbox" name="cps" id="cps" value="1">华数
            <input type="checkbox" name="cps" id="cps" value="2">百视通
            <input type="checkbox" name="cps" id="cps" value="3">未来电视
            <input type="checkbox" name="cps" id="cps" value="4">南传
            <input type="checkbox" name="cps" id="cps" value="5">芒果
            <input type="checkbox" name="cps" id="cps" value="6">国广
            <input type="checkbox" name="cps" id="cps" value="7">银河
            <input type="checkbox" name="cps" id="cps" value="poms">咪咕
        </td>
    </tr>
<tr>
    <td align="center">站点名称：</td>
    <td><input type="text" name="title" id="title" class="aa  form-input w300" placeholder="输入站点名称"></td>
</tr>
<tr class="">
        <td align="right">模板选择：</td>
        <td>
            <select  class="form-input w100" name="tmp" id="tmp">
                <option value="1">有导航</option>
                <option value="2">无导航</option>
            </select>
        </td>
    </tr>
    <tr class="">
        <td   align="right">顶部导航：</td>
        <td>
            <select  class="form-input w100" name="topguide" id="topguide">
                <option value="1">显示</option>
                <option value="2">不显示</option>
            </select>
        </td>
    </tr>
    <tr class="">
        <td   align="right">消息：</td>
        <td>
            <select  class="form-input w100" name="message" id="message">
                <option value="1">显示</option>
                <option value="2">不显示</option>
            </select>
        </td>
    </tr>
   <!-- <tr class="">
        <td   align="right">图片是否圆角：</td>
        <td>
            <select  class="form-input w100" name="circular" id="circular">
                <option value="1">是</option>
                <option value="2">否</option>
            </select>
        </td>
    </tr>-->
<tr>
    <td align="center">备注：</td>
    <td><input type="text" name="mark" id="mark" class="aa  form-input w300" placeholder="输入备注信息"></td>
</tr>
    <tr class="pic">
        <td align="center">logo:</td>
        <input type="hidden" value="" name="pic">
        <td><input type="file" id="pic_true"></td>
    </tr>
<tr>
    <td align="center">userGroup:</td>
    <td><input type="text" name="usergroup" id="usergroup" class="aa form-input w300" placeholder="输入userGroup"></td>
</tr>
<tr>
    <td align="center">epgCode:</td>
    <td><input type="text" name="epgcode" id="epgcode" class="aa  form-input w300" placeholder="输入epgCode"></td>
</tr>
<tr>
    <td colspan="2" align="center"><input style="width:80px;height:30px;padding:0px" type="button" value="保存信息" class="btn save">
    	<input style="width:80px;height:30px;padding:0px" type="button" value="返回列表" class="gray"></td>
</tr>
</div>
</table>
<script>
    function checks(obj){
        var num=$("#xuanze").val();
        $('.addr').remove();
        for (var i=1;i<num;i++){
            //这里可以用ajax获取省的数据 然后组装成 append里面的数据
            // $(".s").append("<select class='aa' name='province[]' style='width: 200px;height: 33px;'><option>省</option> </select>");
            //alert(i);
            $("#addr").after("<tr class='addr'><td width='100' align='right'>地址:</td><td><select onchange='getregin(this)' id=w"+i+" name='province[]' class='form-input aa proadd' style='width: 140px;height: 33px;'></select><select id=c"+i+" name='city[]' class='form-input cc cityadd' style='width: 140px;height: 33px;'></select></td></tr>");
            //console.log("#w"+i);
            $.ajax({
                type: "POST",
                url: '/version/guide/getpro?mid=<?php echo $_GET['mid']?>',
                async : false,//是否为同步
                dataType: "json",
                success: function(data){
                    var weizhi=i;
                    //console.log("#w"+i);
                    $.each(data,function(i){
                        $("#w"+weizhi).append("<option value="+data[i]["provinceCode"]+'_'+data[i]['provinceName']+">"+data[i]["provinceName"]+"</option>");
                    });
                    $("#c"+weizhi).append('<option>请选择市</option>');
                }
            });
        }
    }
</script>
<script>

    var start;
    $('#pic_true').uploadify({
        'auto': true,//关闭自动上传
        'buttonImage': '/images/up1.png',
        'width': 70,
        'height': 26,
        'swf': '/js/uploadify/uploadify.swf',
        'uploader': '/upload/img',
        'method': 'post',//方法，服务端可以用$_POST数组获取数据
        'buttonText': '选择图片',//设置按钮文本
        'queueID': 'queueid',
        'multi': true,//允许同时上传多张图片
        'uploadLimit': 10,//一次最多只允许上传10张图片
        'fileTypeExts': '*',//限制允许上传的图片后缀
        'sizeLimit': 10240000000,//限制上传的图片不得超过200KB
        'onSelect'      : function(file){

            var type = file.type;
            var img = ['.jpg','.jpeg','.png','.gif'];
            var myself = this;
            //layer.alert(file.name);

            if(!in_array(type,img)){
                myself.cancelUpload();
                layer.alert("这不是图片");
                return false;
            }
        },
        'onUploadStart' :function(file){
            start = layer.load(0, {icon: 16,shade: [0.3,'#000']});
        },
        'onUploadSuccess' : function(file, data, response) {//每次成功上传后执行的回调函数，从服务端返回数据到前端
            layer.close(start);
            var value = eval('('+data+')');
            $('input[name=pic]').val(value.key);
            $('.test').empty();
            var li = '<tr class="test"><td>图片</td><td><img width="200px" src='+value.url+'></td></tr>';
            $('.pic').after(li);
        },
        'onUploadProgress':function(file, bytesUploaded, bytesTotal, totalBytesUploaded, totalBytesTotal){
            $('input[name=size]').val(bytesUploaded)
        }
    })


    $('.gray').click(function()
    {
        //window.history.go(-1);
    });
    function getregin(obj){
        var shengid=obj.value;
        var i = shengid.split('_');//分割
        var ns=obj.id;
        var wz=ns.charAt(ns.length - 1);
        var remo="c"+wz+' '+"option";

        $("#"+remo).remove();

        $.getJSON("/version/guide/getcity?mid=<?php echo $_GET['mid']?>",{id:i[0]},function(data){

            $.each(data,function(i){
                $("#c"+wz).append('<option value="'+data[i]['cityCode']+'_'+data[i]['cityName']+'">'+data[i]['cityName']+'</option>');
//                +'_'+data[i]['cityName']
            });
        });
    };


    $('.save').click(function()
    {
        var k = $(this);
        var G = {};
        G.name  = $('#title').val();
        G.mark  = $('#mark').val();
        G.pro = '';
        $('.proadd option:selected').each(function(){
            proadd = ($(this).val()).split('_');
            G.pro += proadd[0]+' ';
        })
        G.city = '';
        $('.cityadd option:selected').each(function(){
            cityadd = ($(this).val()).split('_');
            G.city += cityadd[0]+' ';
        })
        G.cp="";
        $("input[name='cp']:checked").each(function() {
            G.cp += $(this).val()+'/';
        });
        G.cps="";
        $("input[name='cps']:checked").each(function() {
            G.cps += $(this).val()+'/';
        });
        G.usergroup = $('#usergroup').val();
        G.epgcode = $('#epgcode').val();
        G.gid    = <?php echo $_GET['nid'] ;?>;
        G.pic = $('input[name=pic]').val();
 	G.message=$('#message').val();//消息1.显示2.不显示
        G.topguide=$('#topguide').val();//顶部导航1.显示2.不显示
        G.tmp=$('#tmp').val();//模板 1.默认2.河南
	G.circular=$("#circular").val();//圆角设置1圆角2直角
//        console.log(G);return false;
        if(empty(G.name)){
            layer.alert('标题不能为空',{icon:0});
            return false;
        }
        if(empty(G.cp)){
            layer.alert('主牌照方不能为空',{icon:0});
            return false;
        }
        if(empty(G.pro)){
            layer.alert('省市不能为空',{icon:0});
            return false;
        }
                //console.log(G);
        //return false;
        var load = layer.load(0, {icon: 16,shade: [0.3,'#000']});
        $.post('/version/station/doAdd?mid=<?php echo $this->mid?>',G,function(d){
//            console.log(d);return false;
            if(d== 200){
                alert('添加成功');
                location.reload();
            }else{
                layer.close(load);
                layer.alert(d.msg);
            }
        },'json')
    });
    $('.gray').click(function(){
	layer.closeAll();
    })
</script>


