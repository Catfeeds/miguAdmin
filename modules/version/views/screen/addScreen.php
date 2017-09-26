<style>
  .up-main{
		height:103px;
		position:relative;
	}
	.uploadify{
		position:absolute;
		z-index:9999;
		left:-85px;
		top:35px;
	}
	.up-main img{
	position: absolute;
	top:0px;		
	max-height:103px;

	}
.topDiv{
        width:100%;
        height:50px;
        float:left;
    }
    .uploadPic{
        padding-top:20px;
        width:100%;
        height:80px;
        float:left;
    }
    .name{
        width:100px;
        text-align: center;
        float:left;
        height:50px;
        line-height:50px;

    }
    .insertName{
        width:200px;
        float:left;
        height:50px;
    }
    .t-name{
        width:200px;
        height:35px;
        border:1px solid #ccc;
    }
    #template{
        width:200px;
        float:left;
    }
    .foot{
      padding:5px 0px;

        margin:0 auto;
    }
    #main{
      
    }
    #main-false{
     }
    
    #main-three{

    }
</style>
<form action="" method="post" enctype="multipart/form-data">
<table style="width:900px;" class="mtable" width="50%" cellspacing="0" cellpadding="10">
  <tr>
        <th style="background: #A3BAD5;height:30px;" colspan="3">添加导航屏幕</th>
    </tr>
<tr><td width="100" align="center">
<div class="topDiv">
    <div class="name">名称：</div>
</td><td colspan="2">
    <div class="insertName">
        <input style="width:400px;margin:7px;" class="form-input" type="text" name="name" id="title" class='t-name' placeholder="输入新建屏幕对应名称">
    </div>
</div>
</td></tr>
<tr><td width="100" align="center">
<div>
    <div class="name">默认焦点：</div>
</td><td colspan="2">
    <div>
        是：<input type="radio" name="focus" value="1" >
        否：<input type="radio" name="focus" value="0" >
    </div>
</div>
</td></tr>
<tr><td width="100" height="103" align="center">
<div class="uploadPic">
    <div class="name">选中：</div>
</td><td width="100"></td><td width="700">
    <div class="up-main" id="main">
        <input type="file" name="pic_true" id="upload_file_true" placeholder="选择图片" value="">
    </div>
</div>
</td></tr>
<tr><td width="100" align="center">
<div class="uploadPic">
    <div class="name">未选中：</div>
</td><td></td><td>
    <div class="up-main" id="main-false">
        <input type="file" name="pic_false" id="upload_file_false" placeholder="选择图片" value="">
    </div>
</div>
</td></tr>
<tr><td width="100" align="center">
<div class="uploadPic">
    <div class="name">焦点下移：</div>
</td><td></td><td>
    <div class="up-main" id="main-three">
        <input type="file" name="pic_three" id="upload_file_three" placeholder="选择图片" value="">
    </div>
</div>
</td></tr>
    <tr>
        <td>站点引用：</td>
        <td>
            <select style="width:200px;margin:7px;"  name="station" onchange="stationGuide(this)"  id="station" class="form-input w200 field" <!--disabled="disabled"-->>
                <option value="0">--------------请选择站点-------------</option>
                <?php
                    $station_res = $this->getAllStation();
                    foreach ($station_res as $k=>$v){ ?>
                        <option value="<?php echo $v['id'];?>" onclick='changeGudei(this)'><?php echo $v['name']?></option>
                   <?php }
                ?>
            </select>
        </td>

        <td>
            <select style="width:200px;margin:7px;"  name="guide" onchange="selectGuide(this)" id="guide" class="form-input w200 field" <!--disabled="disabled"-->>
                <option value="0">--------------请选择屏幕-------------</option>
            </select>
            <input type="radio" name="copyFlag" id="copyFlag" onclick="return checkCopy()" flag="0">站点引用
        </td>

    </tr>
<tr><td width="100" align="center">

<div>
    <div class="name">屏幕模板：</div>
</td><td colspan="2">
    <select style="width:200px;margin:7px;"  name="template" onchange="showTemplate()"  id="template" class="form-input w200 field">
        <option value="0">--------------请选择-------------</option>
        <option onclick="showTemplate(this)" value="1" >1</option>
        <option value="2" onclick='showTemplate(this)'>2</option>
        <option value="3" onclick="showTemplate(this)">3</option>
        <option value="4" onclick="showTemplate(this)">4</option>
        <option value="5" onclick="showTemplate(this)">5</option>
        <option value="6" onclick="showTemplate(this)">6</option>
        <option value="7" onclick="showTemplate(this)">7</option>
        <option value="8" onclick="showTemplate(this)">8</option>
        <option value="9" onclick="showTemplate(this)">9</option>
        <option value="10" onclick="showTemplate(this)">10</option>
	<option value="11" onclick="showTemplate(this)">11河南模板</option>
	<?php foreach($data as $v):?>
            <option value="<?php echo $v['id']+11?>" onclick="showTemplate(this)"><?php echo $v['name']?></option>
        <?php endforeach;?>
    </select>
        <input style="margin-top: 16px;margin-left: 230px;" type="radio" name="editSelf" id="editSelf" onclick="return checkeditSelf()" flag="0" >自行编辑

        <div class="templatePic">
    <img src="/file/template/t01.png" alt="" width='600px' height='300px'>
<input type="button" value="查看大图" class="btn checkImg">
</div>
</div>
</td></tr>
<tr>
<td colspan="3" style="text-align: center">
<div class="foot">
    <input style="width:80px;height:30px;padding:0px" type="button" value="保存信息" class="btn save">
    <input style="width:80px;height:30px;padding:0px" type="button" value="取消" class="gray">
</div>
</td>
</tr>
</table>
</form>
<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<script>

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
                    $('#main').append('<img src="'+value.url+'"  class="upImg">');
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
                    $('#main-false').append('<img src="'+value.url+'"  class="upImg">');
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

    $('#upload_file_three').uploadify
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
                var l = $('#main-three').find('img');
                if(l.length < 1){
                    $('#main-three').append('<img src="'+value.url+'"  class="upImg">');
                }else{
                    $(l).attr('src',value.url);
                }
            }else{
                layer.alert(value.msg,{icon:0});
            }
            //$('#upload_file_three').hide();
        },
        'onError':function(err)
        {
            layer.alert(err);
        }

    });

    function showTemplate(obj)
    {

        var templateId = $('#template  option:selected').val();
	       
	switch (templateId)
        {
            case '1' :
                $('.templatePic').children('img').attr('src','/file/template/t01.png');
                break;
            case '2' :
                $('.templatePic').children('img').attr('src','/file/template/t02.png');
                break;
            case '3' :
                $('.templatePic').children('img').attr('src','/file/template/t03.png');
                break;
            case '4' :
                $('.templatePic').children('img').attr('src','/file/template/t04.png');
                break;
            case '5' :
                $('.templatePic').children('img').attr('src','/file/template/t05.png');
                break;
            case '6' :
                $('.templatePic').children('img').attr('src','/file/template/t06.png');
                break;
            case '7' :
                $('.templatePic').children('img').attr('src','/file/template/t07.png');
                break;
            case '8' :
                $('.templatePic').children('img').attr('src','/file/template/t08.png');
                break;
            case '9' :
                $('.templatePic').children('img').attr('src','/file/template/t09.png');
                break;
            case '10' :
                $('.templatePic').children('img').attr('src','/file/template/t10.jpg');
                break;
	    case '11' :
                $('.templatePic').children('img').attr('src','/file/template/t11.jpg');
                break;	
	    <?php foreach($data as $v):?>
                case <?php echo "'".($v['id']+11)."'"?>:
                    $('.templatePic').children('img').attr('src','<?php echo $v["pic"]?>');
                    break;
            <?php endforeach;?>

        }
        $('#editSelf').attr('checked','checked');
        $('#editSelf').attr('flag','1');
    }

    $('.save').click(function()
    {
        var k = $(this);
        var G = {};
        var pic_true = $('#main').children('img').attr('src');
        var pic_false = $('#main-false').children('img').attr('src');
        var pic_three = $('#main-three').children('img').attr('src');
        G.pic_true = pic_true;
        G.pic_false = pic_false;
        G.pic_three = pic_three;
        var templateId = $('#template  option:selected').val();
        G.templateId  = templateId;
        G.title  = $('#title').val();
        G.gid    = <?php echo $_GET['nid'] ;?>;
        G.focus = $("input[name=focus]:checked").val();
        if(G.focus==undefined){
            G.focus=0;
        }
        //复制屏幕
        var copyFlag = $('#copyFlag').attr('flag');
        if(copyFlag == 1){
            G.templateId = $('#guide option:selected').attr('templateId');
        }

        if(empty(G.title)){
            layer.alert('标题不能为空',{icon:0});
            return false;
        }
        if(empty(G.pic_true)){
            layer.alert('选中图片不能为空',{icon:0});
            return false;
        }
        if(empty(G.pic_false)){
            layer.alert('未选中图片不能为空',{icon:0});
            return false;
        }
        if(empty(G.templateId)){
            layer.alert('屏幕模板不能为空',{icon:0});
            return false;
        }
        var load = layer.load(0, {icon: 16,shade: [0.3,'#000']});
        $.ajax
        ({
            type:'post',
            async:false,
            data:G,
            url:'/version/Screen/AddData?mid=<?php echo $this->mid?>',
            dataType:'json',
            success:function(d)
            {
                if(d.code == 200){
                    var copyFlag = $('#copyFlag').attr('flag');
                    if(copyFlag == 1){
                        var pasteGuideId = d.guideId;
                        var copyGuideId = $('#guide').val();
                        var res = copyAction(copyGuideId,pasteGuideId);
//                        console.log(res);
                        if(res ==200){
                            layer.alert("复制成功");
                            layer.close(load);
                            window.location.href=opener.location.href;
                        }
                    }else{
                        layer.close(load);
                        window.location.href=opener.location.href;
                    }
                    var nid = "<?php echo trim($_GET['nid']);?>";
                }else{
                    layer.close(load);
                    layer.alert(d.msg);
                }
            }
        });
    });

    $('.gray').click(function(){
         window.close();
    })
	$('.addtem').click(function(){
         window.open("/version/template/test/mid/<?php echo $this->mid;?>")
    })
	$(".checkImg").click(function(){
        var src=$(".templatePic").children().eq(0).attr("src");
        window.open(src);
    })

    function changeGudei(obj)
    {
        var station_id = $(obj).val();
        var mid = <?php echo $this->mid;?>;
        $.ajax
        ({
            type:'get',
            url:'/version/screen/getStationGuide/mid/'+mid+'/stationId/'+station_id,
            success:function(data)
            {
                data = eval(data);
                $("#guide").children().remove();
                $.each(data,function(i){
                    $("#guide").append
                    (
                        '<option value="'+data[i]['id']+'">'+data[i]['title']+'</option>'
                    );
                });
            }
        });
    }
    
    function stationGuide(obj)
    {
        var station_id = $(obj).val();
        var mid = <?php echo $this->mid;?>;
        $.ajax
        ({
            type:'get',
            url:'/version/screen/getStationGuide/mid/'+mid+'/stationId/'+station_id,
            success:function(data)
            {
                data = eval(data);
                $("#guide").children().remove();
                $.each(data,function(i)
                {
                    $("#guide").append
                    (
                        '<option templateId="'+data[i]['templateId']+'" value="'+data[i]['id']+'">'+data[i]['title']+'</option>'
                    );
                });
            },
            async:false
        });
        selectGuide();
    }

    function checkCopy()
    {
        var station_id = $('#station').val();
        var guide_id = $('#guide').val();
        var editSelf_flag = $('#editSelf').attr('flag');
        if(editSelf_flag == 1){
            $('#editSelf').attr('flag','0');
            $('#editSelf').attr("checked",false);
            $('#station').removeAttr('disabled');
            $('#guide').removeAttr('disabled');
        }
        if(station_id == 0){
            layer.alert("请选择站点");
            return false;
        }

        if(guide_id == 0){
            layer.alert("请选择对应站点下屏幕");
            return false;
        }

        $('#copyFlag').attr('flag','1');
        $('#template').attr('disabled','disabled');
    }

    function checkeditSelf()
    {
        var copyFlag = $('#copyFlag').attr('flag');
        if(copyFlag == 1){
            $('#copyFlag').attr('flag','0');
            $('#copyFlag').attr("checked",false);
            $('#template').removeAttr('disabled');
        }
        $('#station').attr('disabled','disabled');
        $('#guide').attr('disabled','disabled');
        $('#editSelf').attr('flag','1');
    }

    function copyAction(copyGuideId,pasteGuideId)
    {
        var mid = <?php echo $this->mid;?>;
        var status = 0;
        $.ajax
        ({
            type:'get',
            url:'/version/screen/CopyScreenContent/mid/'+mid+'/copyGuideId/'+copyGuideId+'/pasteGuideId/'+pasteGuideId,
            success:function(data)
            {
                if(data == 200){
                    status = 200;
                }else{
                    status = 500;
                }
            },
            async:false
        });
        return status;
    }

    function selectGuide()
    {
        var selected = $('#guide option:selected').attr('templateid');
        if(selected == undefined){
            selected = $('#guide').children().eq(0).attr('templateid');
        }
        if(selected<10){
            $('.templatePic').children('img').attr('src','/file/template/t0'+selected+'.png');
        }else if(selected==10 || selected==11){
            $('.templatePic').children('img').attr('src','/file/template/t'+selected+'.png');
        }else{
            var pic_src = showTemplatePic(selected);
            $('.templatePic').children('img').attr('src',pic_src);
        }

    }

    function showTemplatePic(selected)
    {
        var mid = <?php echo $this->mid;?>;
        var pic_src = '';
        $.ajax
        ({
            type:'get',
            async:false,
            url:'/version/screen/showTemplatePic/mid/'+mid+'/templateId/'+selected,
            success:function(data)
            {
                pic_src = data;
            }
        });
        return pic_src;
    }

</script>


