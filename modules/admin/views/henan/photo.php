<style type="text/css">
    .up-main li{
        float: left;
        margin-right: 10px;
    }
    .up-h-1,.up-h-2,.up-h-8,.up-h-9{background-color:#fff;width:75px;height:150px;}
    .up-h-8,.up-h-9{width:150px;}
    .up-h-2{margin-top:10px;}
    .mt5{margin-top:10px;}
    .mr5{margin-right:5px;}
    .up-h-3,.up-h-7{width:150px;height:310px;background-color:#fff;}
    .up-h-4{width:310px;height:150px;background-color:#fff;}
    .up-h-5,.up-h-6{width:150px;background-color:#fff;height:150px;}
    <?php echo '#'.$address?>{position: relative;}
    #upload_file{background-color:#000;cursor:pointer;position: absolute;top:0;left:0;}
    #upload_file object{left:0;top:0;}
    .myt{text-align:center;position:relative;
        border: 1px solid #787878;}
    .myt1{text-align:center;position:relative;border: 1px solid #787878;}
    .myt1 span{display: inline-block;width:70px;height:25px;position: absolute;top:0;left:0;}
    .myt span{display: inline-block;width:70px;height:25px;position: absolute;top:0;left:0;}
    <?php echo '#'.$address?> a{
                                  position: absolute;
                                  top: 0;
                                  left: 0;
                                  background-color: #898989;
                                  padding: 5px 10px;
                                  color:white
                              }
    #zuo{
        background-color: #898989;
    }
    #zuo a{
        position: absolute;
        top: 0;
        left: 300;
        background-color: #898989;
        padding: 5px 10px;
        color:white
    }
    #shang{
        background-color: #898989;
    }
    #shang a{
        position: absolute;
        top: 0;
        left: 300;
        background-color: #898989;
        padding: 5px 10px;
        color:white;
    }


</style>
<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<table class="mtable" width="100%" cellspacing="0" cellpadding="10">
    <tr width="900px">
        <?php
        if(count($henan) == 1){
            echo "<td fid='0' id=".$henan[0]['pos']." width='250px'><img src=".$henan[0]['pic']." width='80%'><a pos=".$henan[0]['pos']." href=".'javascript:void(0)'.">点击修改</a></td>";
            echo "<td id='zuo' fid='1' width='200px'><a pos=".$henan[0]['pos']." href=".'javascript:void(0)'.">点击上传</a></td>";
            echo "<td id='shang' fid='2' width='200px'><a pos=".$henan[0]['pos']." href=".'javascript:void(0)'.">点击上传</a></td>";
        }elseif(count($henan) == 2){
            foreach ($henan as $key => $val) {
                echo "<td fid='$key' id=".$val['pos']." width='150px'><img src=".$val['pic']." width='80%'><a pos=".$val['pos']." href=".'javascript:void(0)'.">点击修改</a></td>";
            }

            echo "<td id='shang' width='200px' fid='2'><a pos=".$henan[0]['pos']." href=".'javascript:void(0)'.">点击上传</a></td>";
        }elseif(count($henan)==3){
            foreach ($henan as $key => $val) {
                echo "<td fid='$key' id=".$val['pos']." width='150px'><img src=".$val['pic']." width='80%'><a pos=".$val['pos']." href=".'javascript:void(0)'.">点击修改</a></td>";
            }
        }
        ?>
    </tr>
    <tr>
        <td align="center" colspan="3">
            <input type="button" value="取消" class="gray">
        </td>
    </tr>
</table>
<input type="hidden" name="key" value="<?php echo !empty($ui[$address]['bigImg'])?$ui[$address]['bigImg']:''?>">
<input type="hidden" name="position" value="<?php echo $address;?>">
<input type="hidden" name="type" value="<?php echo $type;?>">

<script type="text/javascript">

    $('.up-main li:last-child').css('margin-right','0');
    $(function(){
        $('.up-main').find('#<?php echo $address?>').find('a').replaceWith('<input type="file" id="upload_file">');
    });
    var start;

    $('#upload_file').uploadify({
        'auto': true,//关闭自动上传
        'buttonImage': '/images/up1.png',
        'width': 70,
        'height': 26,
        'swf': '/js/uploadify/uploadify.swf',
        'uploader': '/upload/img',
        'method': 'post',//方法，服务端可以用$_POST数组获取数据
        'buttonText': '选择图片',//设置按钮文本
        'queueID' : 'queueid',
        'multi': true,//允许同时上传多张图片
        'uploadLimit': 10,//一次最多只允许上传10张图片
        'fileTypeExts': '*',//限制允许上传的图片后缀
        'sizeLimit': 10240000000,//限制上传的图片不得超过200KB
        'onSelect'      : function(file){

            var type = file.type;
            var img = ['.jpg','.jpeg','.png','.gif'];
            var myself = this;


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
            if(value.code == 200){
                $('input[name=key]').val(value.key);
                var l = $('#main').find('#<?php echo $address?>').find('img');
                if(l.length < 1){
                    $('#main').find('#<?php echo $address?>').append('<img src="'+value.url+'" width="100%" height="100%">');
                }else{
                    $(l).attr('src',value.url);
                }
            }else{
                layer.alert(value.msg,{icon:0});
            }
        },
        'onError':function(err){
            layer.alert(err);
        }
    });

    $('.save').click(function(){
        var k = $(this);
        var G = {};
        G.title = $('#title').val();
        G.url = $('#url').val();
        G.position = $('input[name=position]').val();
        G.key = $('input[name=key]').val();
        G.type = $('input[name=type]').val();

        if(empty(G.title)){
            layer.alert('标题不鞥为空',{icon:0});
            return false;
        }
        if(empty(G.url)){
            layer.alert('链接不鞥为空',{icon:0});
            return false;
        }

        if(empty(G.position)){
            layer.alert('系统错误',{icon:0});
            return false;
        }

        if(empty(G.key)){
            layer.alert('系统错误',{icon:0});
            return false;
        }
        if(empty(G.type)){
            layer.alert('系统错误',{icon:0});
            return false;
        }

        var load = layer.load(0, {icon: 16,shade: [0.3,'#000']});
        $.post('/admin/setting/add?mid=<?php echo $this->mid?>',G,function(d){
            if(d.code == 200){
                location.reload();
            }else{
                layer.close(load);
                layer.alert(d.msg);
            }
        },'json')
    });

    function validate_edit_logo() {
        debugger;
        var file = "file:///"+ $('#File1').val();
        if (!/.(gif|jpg|jpeg|png|gif|jpg|png)$/.test(file)) {
            alert("图片类型必须是.gif,jpeg,jpg,png中的一种")
            if (a == 1) {
                return false;
            }
        } else {
            var image = new Image();
            image.src = file;
            var height = image.height;//得到高
            var width = image.width;//得到宽
            var filesize = image.fileSize;//图片大小

            if (width > 80 && height > 80 && filesize > 102400) {
                alert('请上传80*80像素 或者大小小于100k的图片');
                if (a == 1) {
                    return false;
                }
            }
            if (a == 1) {
                $("#img1").attr("src", file);
                return true;

            }
        }
    }
</script>
<script type="text/javascript">
    $('.mtable a').click(function(){
        //alert($(this).html());
        if($(this).html() !== '点击上传'){
            //alert(1);
            var k = $(this);
            var v = $(k).attr('pos');
            
            var fid;
            if($(this).parent().attr('fid')==1 || $(this).parent().attr('fid')==2){
                
                fid = $(this).parent().attr('fid');
            }else{
                fid =0;
            }
            //alert(fid);
            if(empty(v)) return false;
            var my = layer.msg('加载中', {icon: 16,shade:0.3});
            $.getJSON('<?php echo $this->get_url('henan','upload')?>',{val:v,fid:fid},function(d){
                if(d.code == 200){
                    layer.close(my);
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-rim', //加上边框
                        area: ['1030px', '506'], //宽高
                        content: d.msg
                    })
                }else{
                    layer.alert(d.msg,{icon:0});
                }
            })
        }else{
            //alert(2);
            var k = $(this);
            var v = $(k).attr('pos');
            
            var fid;
            if($(this).parent().attr('fid')==1 || $(this).parent().attr('fid')==2){
                
                fid = $(this).parent().attr('fid');
            }else{
                
                fid =0;
            }
            if(empty(v)) return false;
            var my = layer.msg('加载中', {icon: 16,shade:0.3});
            $.getJSON('<?php echo $this->get_url('henan','upload')?>',{val:v,fid:fid},function(d){
                if(d.code == 200){
                    
                    layer.close(my);
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-rim', //加上边框
                        area: ['1030px', '506'], //宽高
                        content: d.msg
                    })
                }else{
                    layer.alert(d.msg,{icon:0});
                }
            })
        }

    });
    $('body').on('click','.gray',function(){
        layer.closeAll();
    });
</script>