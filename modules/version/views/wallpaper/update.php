<script charset="utf-8" type="text/javascript" src="/js/jdate/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/js/jdate/jquery.datetimepicker.css" />	
<style>
#main .upImg{
    	margin-top:5px;
    	width:150px;
    	height:86px;
    }
    #main-false .upImg{
    	margin-top:5px;
    	width:214px;
    	height:123px;
    }
   .hidden{
		       display:none;
   }
   .mtable td{
   		padding:5px;
   }
</style>
<div class="hidden"><?php echo !empty($wallpaper->id)?$wallpaper->id:''?></div>
<form action="" method="post" enctype="multipart/form-data">
 <table style="width:900px;" class="mtable mt10" cellpadding="10" cellspacing="0">
         <tr>
    	<th style="background: #A3BAD5;height:30px;" colspan="7">添加壁纸</th>
    </tr>
       <tr>
            <td width="100" align="right">当前标题：</td>
            <td class="oldTitle"><?php echo !empty($wallpaper->title)?$wallpaper->title:''?></td>
            <td width="100" align="right">修改为：</td>
            <td><input class="form-input w200" type="text" name="title" id="title" value="" placeholder="输入新的标题"></td>
        </tr>
        <tr>
            <td width="100" align="right">当前缩略图为：</td>
            <td width="100" align="right">
                <img class='oldThum' src="<?php echo !empty($wallpaper->thum)?$wallpaper->thum:''?>" alt="" width="150px" height="86px">
            </td>
            <td width="100" align="right">修改缩略图为：</td>
            <td>
                <div class="up-main" id="main">
                    <input type="file" name="pic_true" id="upload_file_true" placeholder="选择图片" value="">
                </div>
            </td>
        </tr>
        <tr>
            <td width="100" align="right">当前壁纸图片：</td>
            <td>
                <img class="oldPic" time="<?php echo $wallpaper->pic_time?>" src="<?php echo !empty($wallpaper->pic)?$wallpaper->pic:''?>" alt="" width="214px" height="123px">
            </td>
            <td width="120" align="right">修改前壁纸图片：</td>
            <td>
                <div class="up-main" id="main-false">
                    <input type="file" name="pic_false" id="upload_file_false" placeholder="选择图片" value="">
                </div>
            </td>
        </tr>
        <tr>

            <td width="100" align="right">站点:</td>
            <td colspan="3">
		<?php

          $uid = $_SESSION['userid'];
        $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 5  left join yd_ver_worker as c on c.workid=b.id where c.type = 1 and  c.uid=$uid group
 by a.id";
        $st = SQLManager::QueryAll($sql);
         if($_SESSION['auth']=='1' || empty($st)){ ?>
        <select name="gid" id="gid" class="form-input w300" onchange="getcity()">
                <option value="0">--请选择--</option>
                <?php
                $sql = "select id,name from yd_ver_station";
                $res = SQLManager::queryAll($sql);
                if (!empty($res)) {?>
                    <?php
                    foreach ($res as $k => $v) {
                        ?>
                        <option <?php if($v['id']==$wallpaper->attributes['gid']){echo 'selected=selected';}?> value="<?php echo $v['id']; ?>" ><?php echo $v['name']; ?></option>
                    <?php } ?>
                <?php }?>
            </select>
         <?php }else{ ?>
                <select id="gid" name="gid" onchange="getcity()" class = "form-input w200" >
                        <option>请选择</option>
                        <?php foreach($st as $k => $v){ ?>
                                <option <?php if($v['id']==$wallpaper->attributes['gid']){echo 'selected=selected';}?> value = "<?php echo $v['id']; ?>" ><?php echo $v['name']; ?></option>
                        <?php } ?>
                </select>
        <?php  } ?>

            </td>
        </tr>
<tr style="display:none;" class="city">
	<td align="center">省市:</td>
	<td colspan="3"></td>
</tr>
	<tr>
            <td>壁纸类型：</td>
            <td>
                <select class = "form-input w200 wall" onchange="show()">
                    <option value="0" <?php if($wallpaper->type==0){echo "selected=selected";}?>>普通壁纸</option>
                    <option value="1" <?php if($wallpaper->type==1){echo "selected=selected";}?>>强制壁纸</option>
                </select>
            </td>
            <td colspan="3"></td>
        </tr>
        <tr style="display: none;" class="time">
            <td>选择时间：</td>
            <td>
                <input type="text" name="first" id="first" class="form-input w100" value="<?php if(empty($wallpaper->startTime)){echo '';}else{echo date('Y-m-d',$wallpaper->startTime);}?>">~
                <input type="text" name="end" id="end" class="form-input w100" value="<?php if(empty($wallpaper->startTime)){echo '';}else{echo date('Y-m-d',$wallpaper->endTime);}?>">
            </td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="4" align="center">
                <input style="width:80px;height:30px;padding:0px" type="button" value="保存信息" class="btn save">
                <input style="width:80px;height:30px;padding:0px" type="button" value="返回列表" class="gray">
            </td>
        </tr>

    </table>

    </table>
    <table style="width:900px;" class="mtable mt10" cellpadding="10" cellspacing="0">
        <tr>
            <th style="background: #A3BAD5;height:30px;" colspan="7">审核纪录</th>
        </tr>
        <tr>
            <td>审核工作流</td>
            <td>审核人</td>
            <td>审核时间</td>
            <td>审核消息</td>
        </tr>
        <?php
        $res = $this->GetReviewInfo(2,$_GET['id']);
        if(!empty($res)){
            ?>
            <?php
            foreach ($res as $k => $v) {
                ?>
                <tr class="reject">
                    <td><?php echo $v['review_times']; ?>审</td>
                    <td><?php echo $v["username"]; ?></td>
                    <td><?php echo date("Y-m-d H:i:s", $v["add_time"]); ?></td>
                    <td><?php echo $v["message"]; ?></td>
                </tr>
                <?php
            }?>


        <?php }
        ?>
    </table>
</form>
<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript">
//    var remove_arr = new Array();
//    for(var i = 0 ; i < $('.reject').length ; i++){
//        var tmp = $('.reject').eq(i).children();
//        if(tmp.eq(1).text() == 0 && tmp.eq(3).text() == 0){
//            console.log(i);
//            remove_arr.push(i);
//            $('.reject').eq(i).addClass('remove_flag');
//        }
//    }
//    $('.remove_flag').remove();


    $('#first,#end').datetimepicker({
        lang:'ch',
        validateOnBlur:false,
        timepicker:false,
        format:'Y-m-d',
        formatDate: 'Y-m-d'
    });

    function show(){
        if($(".wall").val()==1){
	    $(".city").show();
            $(".time").show();
        }else{
	    $(".city").hide();
            $(".time").hide();
        }
    }

    show();

    $('.gray').click(function()
    {
         window.history.go(-1);
    });

    $('#upload_file_true').uploadify
    ({
        'auto': true,//关闭自动上传
        'buttonImage': '/images/up1.png',
        'width': 70,
        'height': 26,
        'swf': '/js/uploadify/uploadify.swf',
        'uploader': '/upload/img',
        'method': 'post',//方法，服务端可以用$_POST数组获取数据
        'buttonText': '选择图片',//设置按钮文本
        'queueID' : 'queueid',
        'multi': false,//允许同时上传多张图片
        'uploadLimit': 10,//一次最多只允许上传10张图片
        'fileTypeExts': '*',//限制允许上传的图片后缀
        'sizeLimit': 1024000000000,//限制上传的图片不得超过200KB
        'onSelect'      : function(file)
        {
            var type = file.type;
            var img = ['.jpg','.jpeg','.png','.gif'];
            var myself = this;
            //layer.alert(file.size);
            if(!in_array(type,img)){
                myself.cancelUpload();
                layer.alert("这不是图片");
                return false;
            }
        },
        'onUploadStart' :function(file)
        {
            start = layer.load(0, {icon: 16,shade: [0.3,'#000']});
        },
        'onUploadSuccess' : function(file, data, response)
        {//每次成功上传后执行的回调函数，从服务端返回数据到前端
            layer.close(start);
            var value = eval('('+data+')');
            if(value.code == 200){
                $('input[name=key]').val(value.key);
                var l = $('#main').find('img');
                if(l.length < 1){
                    $('#main').append('<img src="'+value.url+'" width="100px" height="100px" class="upImg">');
                }else{
                    $(l).attr('src',value.url);
                }
            }else{
                layer.alert(value.msg,{icon:0});
            }
            //$('#upload_file_true').hide();
        },
        'onError':function(err)
        {
            layer.alert(err);
        }

    });

    $('#upload_file_false').uploadify
    ({
        'auto': true,//关闭自动上传
        'buttonImage': '/images/up1.png',
        'width': 70,
        'height': 26,
        'swf': '/js/uploadify/uploadify.swf',
        'uploader': '/upload/img',
        'method': 'post',//方法，服务端可以用$_POST数组获取数据
        'buttonText': '选择图片',//设置按钮文本
        'queueID' : 'queueid',
        'multi': false,//允许同时上传多张图片
        'uploadLimit': 10,//一次最多只允许上传10张图片
        'fileTypeExts': '*',//限制允许上传的图片后缀
        'sizeLimit': 1024000000000,//限制上传的图片不得超过200KB
        'onSelect'      : function(file)
        {
            var type = file.type;
            var img = ['.jpg','.jpeg','.png','.gif'];
            var myself = this;
            //layer.alert(file.size);
            if(!in_array(type,img)){
                myself.cancelUpload();
                layer.alert("这不是图片");
                return false;
            }
        },
        'onUploadStart' :function(file)
        {
            start = layer.load(0, {icon: 16,shade: [0.3,'#000']});
        },
        'onUploadSuccess' : function(file, data, response)
        {//每次成功上传后执行的回调函数，从服务端返回数据到前端
            layer.close(start);
            var value = eval('('+data+')');
            if(value.code == 200){
                $('input[name=key]').val(value.key);
                var l = $('#main-false').find('img');
                if(l.length < 1){
                    $('#main-false').append('<img src="'+value.url+'" width="200px" height="200px" class="upImg">');
                }else{
                    $(l).attr('src',value.url);
                }
            }else{
                layer.alert(value.msg,{icon:0});
            }
            //$('#upload_file_false').hide();
        },
        'onError':function(err)
        {
            layer.alert(err);
        }

    });

    $('.save').click(function()
    {
	//alert('1');return false;
        var k = $(this);
        var G = {};
        var id = "<?php echo $_GET['id'];?>";
        G.id = id;
        if($('#main').children('img').length>0){
            var pic_true = $('#main').children('img').attr('src');
        }else{
            var pic_true = $('.oldThum').attr('src');
        }
        if($('#main-false').children('img').length>0){
            var pic_false = $('#main-false').children('img').attr('src');
		var pic_time= 0;
        }else{
            var pic_false = $('.oldPic').attr('src');
		var pic_time=$(".oldPic").attr('time');
        }
        if($('#title').val().length>=1){
            G.title  = $('#title').val();
        }else{
            G.title = $('.oldTitle').text();
        }
        G.gid  = $('#gid').val();
        G.thum = pic_true;
        G.pic = pic_false;
	    if($(".wall").val()==0){
            G.start=0;
            G.end=0;
        }else{
            G.start=$("#first").val();
            G.end=$("#end").val();
        }
        G.type=$(".wall").val();
	G.pic_time=pic_time;
	var code=[];
	$('input[name="code"]:checked').each(function(){
            code.push($(this).val());
        })
        G.Code=code;
        if($(".wall").val()==1&&empty(G.Code)){
            layer.alert('请选择省市',{icon:0});
            return false;
        }else if($(".wall").val()==1&&code.length>0){
            //code.push("0-0");
            G.Code=code;
        }else{
            code=["0-0"];
            G.Code=code;
        }
        //console.log(G);return false;
	var load = layer.load(0, {icon: 16,shade: [0.3,'#000']});
	//console.log(G);return false;
        $.post('/version/wallpaper/DoUpdate?mid=<?php echo $this->mid?>',G,function(d){
//            console.log(d);return false;
            if(d == 200){
                alert('修改成功');
                window.history.go(-1);
            }else if(d==500){
                //layer.close(load);
                layer.alert(d.msg);
            }else{
		alert("错误！");
		loaction.reload();
	    }
        },'json')
    });

   /* $('#pid').change(function()
    {
        var v = $(this).val();
        if(empty(v)){
            $('#url').val("javascript:void(0)").attr('readonly',true);
        }else{
            $('#url').val("").attr('readonly',false);
        }
    });*/


    function getregin()
    {
        var shengid=$("#province").val();

        var i = shengid.split('_');//分割
        $("#city option").remove();

        $.getJSON("/version/wallpaper/getcity?mid=<?php echo $_GET['mid']?>",{id:i[0]},function(data){

            $.each(data,function(i){
                $("#city").append('<option value="'+data[i]['cityCode']+'_'+data[i]['cityName']+'">'+data[i]['cityName']+'</option>');
//                +'_'+data[i]['cityName']
            });
        });
    }

	function getcity(){
        if($("#gid option:selected").val()!=0&&$(".wall").val()>0){
            var stationId=$("#gid option:selected").val();
	    var id="<?php echo $_REQUEST['id'];?>";
            $(".city").children().eq(1).html("");
            $.getJSON("/version/wallpaper/city.html?mid=1",{stationId:stationId,id:id},function(data){
                $.each(data,function(v,k){
                    $(".city").children().eq(1).append("<input type='hidden' name='province' value='"+k.provinceCode+"'><span style='margin-right:100px'>"+k.provinceName+"--"+k.cityName+"</span>"+"<input type='checkbox' class='c_val'  name='code'"+k.checked+"  value='"+k.provinceCode+"-"+k.cityCode+"'>选择省市<br>");

                })
            })
            $(".city").show();

        }else{
            $(".city").hide();
        }
    }

	getcity();
</script>

