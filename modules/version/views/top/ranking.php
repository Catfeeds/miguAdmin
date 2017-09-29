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
    <?php //echo '#'.$address?>{position: relative;}
    #upload_file{background-color:#000;cursor:pointer;position: absolute;top:0;left:0;}
    #upload_file object{left:0;top:0;}
    .myt{text-align:center;position:relative;
        border: 1px solid #787878;}
    .myt1{text-align:center;position:relative;border: 1px solid #787878;}
    .myt1 span{display: inline-block;width:70px;height:25px;position: absolute;top:0;left:0;}
    .myt span{display: inline-block;width:70px;height:25px;position: absolute;top:0;left:0;}
    #page span {margin: 5px;}
    <?php if(!empty($appFlag)){?>
    #upImg{width:89px;height:89px;border:1px solid #ccc;position: relative}
    <?php }else{ ?>
    #upImg{width:375px;height:500px;border:1px solid #ccc;position: relative}
    <?php } ?>

    #upImg a{display:block;float:left;position: absolute;top:0px;}
    .charging{display: none;}
    <!--    --><?php
//      if($ui[$address][0]['tType']== 1 || $ui[$address][0]['tType']==3){
//       echo '#title{width:800px;};
//          #ybutton{display:block;}
//       ';
//       }else{
//       echo '#title{width:100%;};
//          #ybutton{display:none;}
//       ';
//      }
//    ?>
</style>
<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<table class="mtable" width="100%" cellspacing="0" cellpadding="10">
    <tr>
        <td width="100" align="right">标题：</td>
        <td><input type="text" name="title" id="title" value="" class="form-input w300">
        </td>
    </tr>
    <tr>
        <td width="100" align="right">类型：</td>
        <td>
            <select name="uptype" class="form-input w300" id="uptype">
                <option value="0">请选择</option>
                <option value="1" >图片</option>
                <option value="2" >视频</option>
            </select>
        </td>
    </tr>
    <tr>
        <td width="100" align="right">推荐内容：</td>
        <td>
            <select name="tType" class="form-input w300" id="tType" onchange="aa()">
                <option  value="0">请选择</option>
                <option  value="1" >咪咕</option>
                <option  value="2" >应用</option>
                <option  value="3" >牌照方</option>
                <option  value="4" >第三方</option>
            </select>
        </td>
    </tr>
    <tr id="show" style="display:none">
        <td width="100" align="right">牌照方：</td>
        <td>
            <select name="cp" class="form-input w300" id="cp">
                <option value="0">请选择</option>
                <option value="1">华数客户端</option>
                <option value="2">百视通客户端</option>
                <option value="3">未来电视</option>
                <option value="4">南传</option>
                <option value="5">芒果</option>
                <option value="6">国广</option>
                <option value="7">银河</option>
            </select>
        </td>
    </tr>
    <tr class="utp" style="display:none">
        <td width="100" align="right">页面类型</td>
        <td><select name="uType" class="form-input w300" id="uType">
                <option value="0">请选择</option>
                <option value="1">搜索</option>
                <option value="2">栏目</option>
                <!--<option  value="3">详情</option>-->
                <option value="4">专题</option>
                <option value="5">收藏</option>
                <option value="6">历史</option>
                <option value="A">电影详情页</option>
                <option value="B">电视剧详情页</option>
                <option value="D">单片横图模板</option>
                <option value="C">综艺详情页</option>
                <option value="E">无模板详情页</option>
                <option value="11">设置</option>
                <option value="12">壁纸</option>
            </select></td>
    </tr>
    <tr class="act" style="display:none">
        <td width="100" align="right">action：</td>
        <td><input type="text" name="action" id="action" value="" class="form-input"></td>
    </tr>

    <tr class="act" style="display:none">
        <td width="100" align="right">param：</td>
        <td><input type="text" name="param" id="param" value="" class="form-input"><input type="submit" name="button" id="pbutton" class="seo-gray" value="搜索" style="float:left;margin-left:650px;margin-top:-35px;display:none"></td>
    </tr>
    <tr  class="upvid" style="display:none">
        <td width="100" align="right">vid：</td>
        <td><input type="text" id="upvid" name="upvid" value="" class="form-input"></td>
    </tr>
    <?php
        if(empty($imgFlag)){?>
            <tr>
                <td align="right" valign="top">图片上传：</td>
                <td>
                    <div class="up-main" id="main">
                        <?php if(!empty($appFlag)){?>
                            <span>请上传89X89的图片</span>
                        <?php }else{?>
                            <span>请上传357X520的图片</span>
                        <?php }?>

                        <div id="upImg">
                            <a href=""></a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php
        }
    ?>

    <tr>
        <td align="center" colspan="2">
            <input type="button" value="保存信息" class="btn save">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" value="取消" class="gray">
        </td>
    </tr>
</table>

<input type="hidden" name="gids" id="gids" value="<?php echo $gid;?>">

<script type="text/javascript">
    function aa(){
        var zhi = $('#tType').val();
        switch(zhi){
            case '1':
                $('#show').hide();
                $('.act').hide();
                $('.utp').show();
                $('.upvid').show();
                break;
            case '2':
                $('#show').hide();
                $('.upvid').hide();
                $('.utp').hide();
                $('.act').show();
                break;
            case '3':
                $('#show').show();
                $('.upvid').hide();
                $('.utp').hide();
                $('.act').show();
                break;
            case '4':
                $('#show').hide();
                $('.upvid').hide();
                $('.utp').hide();
                $('.act').show();
                break;
        }

    }
    $('.up-main li:last-child').css('margin-right','0');
    $(function(){
        $('.up-main').find('#upImg').find('a').replaceWith('<input type="file" id="upload_file">');
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
        'multi': false,//允许同时上传多张图片
        'uploadLimit': 10,//一次最多只允许上传10张图片
        'fileTypeExts': '*',//限制允许上传的图片后缀
        'sizeLimit': 10240000000,//限制上传的图片不得超过200KB
        'onSelect'      : function(file){

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
        'onUploadStart' :function(file){
            start = layer.load(0, {icon: 16,shade: [0.3,'#000']});
        },
        'onUploadSuccess' : function(file, data, response) {//每次成功上传后执行的回调函数，从服务端返回数据到前端
            layer.close(start);
            var value = eval('('+data+')');
            if(value.code == 200){
                $('input[name=key]').val(value.key);
                var l = $('#main').find('#upImg').find('img');
                if(l.length < 1){
                    $('#main').find('#upImg').append('<img src="'+value.url+'" width="100%" height="100%" id="tupian">');
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
    $(function(){
        aa();
    });

    $('.save').click(function(){
        var k = $(this);
        var G = {};
        //G.title = $('#title').val();
        // G.url = $('#url').val();
        G.position = '<?php echo $position;?>';
        G.order = "<?php echo $order ; ?>";
        //G.key = $('input[name=key]').val();
        if($('#upImg').length>0){
            G.key = $('#tupian').attr('src');
        }else{
            G.key = '1';
        }

        G.uType = $('#uType').val();
        //G.tType = $('#tType').val();
//        G.id = $('input[name=id]').val();
        G.type   = $('#uptype').val();
        G.tType  = $('#tType').val();
        G.title  = $('#title').val();
        G.action = $('#action').val();
        G.param  = $('#param').val();
        G.cp     = $('#cp').val();
        G.vid    = $('#upvid').val();
        G.gid    = $('#gids').val();
//        console.log(G);return false;
        if(empty(G.tType)){
            layer.alert('上传类型不能为空',{icon:0});
            return false;
        }
        if(empty(G.title)){
            layer.alert('标题不鞥为空',{icon:0});
            return false;
        }
        if(empty(G.position)){
            layer.alert('系统错误1',{icon:0});
            return false;
        }
        if(empty(G.key)){
            layer.alert('系统错误2',{icon:0});
            return false;
        }
        if(empty(G.type)){
            layer.alert('系统错误3',{icon:0});
            return false;
        }

        var load = layer.load(0, {icon: 16,shade: [0.3,'#000']});
        $.post('<?php echo $this->get_url('top','RankingAdd')?>',G,function(d){
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

    $('body').on('click','.gray',function(){
        layer.closeAll();
    });


</script>

