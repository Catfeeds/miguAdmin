<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<form action="" method="post" enctype="multipart/form-data">
    <table  class="mtable" width="100%" cellspacing="0" cellpadding="10">
        <tr>
            <td style="text-align: center" width="30%">上传类型</td>
            <td width="70%">
                <select name="tType" class="form-input w100" id="tType">
                    <option value="0">请选择</option>
                    <option  value="1" >海报</option>
                    <option  value="2">推荐图</option>
                </select>
            </td>
        </tr>
        <tr class="pic">
            <td style="text-align: center"v>图片上传</td>
            <td><div style="width:550px;"><input type="file" id="pic_true"></div></td>
        </tr>
        
        
        
        
        <tr>
            <td align="center" colspan="2">
                <input type="button" value="保存信息" class="btn save">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" value="取消" class="gray">
            </td>
        </tr>
    </table>
</form>
<input type="hidden" name="url" value="">
<input type="hidden" name="vid" value="<?php echo !empty($vid)?$vid:''?>">
<input type="hidden" name="size" value="">
<input type="hidden" name="cps" value="<?php echo !empty($cp)?$cp:''?>">
<input type="hidden" name="titles" value="<?php echo !empty($title)?$title:''?>">
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
            if(file.size>500000){
                myself.cancelUpload();
                layer.alert("请上传500K以下的图");
                return false;
            }
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
            $('input[name=url]').val(value.key);
            $('.urladd').empty();
            var li = '<tr class="urladd" style="text-align:center"><td>图片预览</td><td><img width="200px" src='+value.url+'></td></tr>';
            $('.pic').after(li);
        },
        'onUploadProgress':function(file, bytesUploaded, bytesTotal, totalBytesUploaded, totalBytesTotal){
            $('input[name=size]').val(bytesUploaded)
        }
    })

    $('.gray').click(function(){
        layer.closeAll();
    })

    $('.save').click(function(){
        var G = {};
        G.type  = $('#tType').val();
        G.size  = $('input[name=size]').val();
        G.vid = $('input[name=vid]').val();
        G.cp = $('input[name=cps]').val();
        G.title = $('input[name=titles]').val();
        G.url = $('input[name=url]').val();
        if(empty(G.type)){
            layer.alert('上传类型不能为空',{icon:0});
            return false;
        }
        $.post("<?php echo $this->get_url('content','picadd')?>",G,function(d){
            location.reload();
        })
    })
</script>

