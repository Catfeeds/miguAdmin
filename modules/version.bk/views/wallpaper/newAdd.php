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
    .uploadPic1{
        width:100%;
        height:100px;
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
       width:300px;
        margin:0 auto;
    }
    #main{
        float:left;
    }
    #main-false{
        float: left;
    }
    .upImg{
        display:block;
        float:left;
	margin-top:5px;
    }
    #main-false{
        float:left;
    }
    #main{
        float:left;
    }
    .aa{
        width:250px;
        height:30px;
    }
</style>
<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>



<table style="width:900px;" class="mtable mt10" cellpadding="10" cellspacing="0">
         <tr>
    	<th style="background: #A3BAD5;height:30px;" colspan="7">编辑导航栏</th>
    </tr>
        <tr><td width="100" align="center">
<form action="" method="post" enctype="multipart/form-data">
    <div class="topDiv">
        <div class="name">名称：</div>
</td><td>
        <div class="insertName">
            <input style="width:400px;margin:7px;" class="form-input" type="text" name="name" id="title" class='t-name' placeholder="输入新建屏幕对应名称">
        </div>
    </div>
 </td></tr>
<tr><td width="100" align="center">
    <div class="uploadPic1">
        <div class="name">缩略图：</div>
        </td><td>
        <div class="up-main" id="main">
            <input type="file" name="pic_true" id="upload_file_true" placeholder="选择图片" value="">
        </div>
    </div>
     </td></tr>
<tr><td width="100" align="center">
    <div class="uploadPic">
        <div class="name">壁纸大图：</div>
             </td><td>
        <div class="up-main" id="main-false">
            <input type="file" name="pic_false" id="upload_file_false" placeholder="选择图片" value="">
        </div>
    </div>
         </td></tr>
<tr><td width="100" align="center">
    <div>
        <div>站点:</div>
         </td><td>
        <div>
            <select style="width:200px;margin:7px;" name="gid" id="gid" class="form-input w300">
                <option value="0">--请选择--</option>
                <?php
                $sql = "select id,name from yd_ver_station";
                $res = SQLManager::queryAll($sql);
                if (!empty($res)) {?>
                    <?php
                    foreach ($res as $k => $v) {
                        ?>
                        <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                    <?php } ?>
                <?php }?>

            </select>
        </div>
    </div>
             </td></tr>
<tr><td colspan="2" >

    <div class="foot">
        <input style="width:80px;height:30px;padding:0px" type="button" value="保存信息" class="btn save">
        <input style="width:80px;height:30px;padding:0px" type="button" value="取消" class="gray">
    </div>
</td></tr></table>
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
                    $('#main').append('<img src="'+value.url+'" width="150px" height="86px" class="upImg">');
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
                    $('#main-false').append('<img src="'+value.url+'" width="214px" height="123px" class="upImg">');
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
        var k = $(this);
        var G = {};
        var pic_true = $('#main').children('img').attr('src');
        var pic_false = $('#main-false').children('img').attr('src');
        G.thum = pic_true;
        G.pic = pic_false;
        G.title  = $('#title').val();
        G.gid =  $('#gid').val();
//        G.gid    = <?php //echo $_GET['nid'] ;?>//;
//        console.log(G);return false;
        if(empty(G.title)){
            layer.alert('标题不能为空',{icon:0});
            return false;
        }
        if(empty(G.thum)){
            layer.alert('缩略图不能为空',{icon:0});
            return false;
        }
        if(empty(G.pic)){
            layer.alert('壁纸大图不能为空',{icon:0});
            return false;
        }
        if(empty(G.gid)){
            layer.alert('站点不能为空',{icon:0});
            return false;
        }
//                console.log(G);return false;
        var load = layer.load(0, {icon: 16,shade: [0.3,'#000']});
//        return false;
        $.post('/version/wallpaper/doNewAdd?mid=<?php echo $this->mid?>',G,function(d){
//            console.log(d);return false;
            if(d== 200){
                //location.reload();
                alert('添加成功');
                window.history.go(-1);
            }else{
                layer.close(load);
                layer.alert(d.msg);
            }
        },'json')
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
    }
 
   $('.gray').click(function()
   {
	window.history.go(-1);
   })
</script>

