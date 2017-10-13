<style type="text/css">
    .page {
        margin-left: 11px;
        margin-top: 2px;
    }
    .page {
        width: 99%;
        height: 37px;
        line-height: 37px;
        margin: 0 auto;
        text-align: center;
    }
    .m-page {
        margin: 20px auto;
        text-align: center;
        clear: both;
        overflow: hidden;
    }
    .page ul li {
        float: left;
        line-height: 37px;
        height: 37px;
        font-size: 15px;
    }
    .pageGo{
        width:180px;
        height:33px;
        /*background:#52CAF4;*/
        border:1px solid #ccc;
    }
    label{
        width:10%;
        height:10%;
        display:block;

    }
    #search{
        width:200px;
    }
    .adddiv{
        margin-top: 1rem;
    }
    .add {
        background-color: #0099CC;
        padding: 8px 20px;
        display: inline-block;
        border-radius: 4px;
        border: 1px solid #6699CC;
        color: #fff;
        font-family: "microsoft yahei";
        font-size: 18px;
        background-image: -moz-linear-gradient(top, #00CCFF,#0099CC);
        background-image: -webkit-gradient(linear,left top,left bottom, color-stop(0, #00CCFF), color-stop(1, #0099CC));
        cursor: pointer;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00CCFF', endColorstr='#0099CC', GradientType='0');
        /*display: block;*/
        float: left;
        margin-left: 1rem;
    }
    .choseNum{

        background-color: #0099CC;
        padding: 8px 20px;
        display: none;
        border-radius: 4px;
        border: 1px solid #6699CC;
        color: #fff;
        font-family: "microsoft yahei";
        font-size: 18px;
        background-image: -moz-linear-gradient(top, #00CCFF,#0099CC);
        background-image: -webkit-gradient(linear,left top,left bottom, color-stop(0, #00CCFF), color-stop(1, #0099CC));
        cursor: pointer;
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00CCFF', endColorstr='#0099CC', GradientType='0');
        /*display: block;*/
        float: left;
    }

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
    #upload_file{background-color:#000;cursor:pointer;/*position: absolute;*/top:0;left:0;}
    #upload_file object{left:0;top:0;}
    .myt{text-align:center;position:relative;
        border: 1px solid #787878;}
    .myt1{text-align:center;position:relative;border: 1px solid #787878;}
    .myt1 span{display: inline-block;width:70px;height:25px;position: absolute;top:0;left:0;}
    .myt span{display: inline-block;width:70px;height:25px;position: absolute;top:0;left:0;}
    #page span {margin: 5px;}
    .infoSpan{float:left;margin-left:100px;}
    .charging{display: none;}
    .m-1{    width:125px;  height:52.5px;  border:1px solid #ccc;  border-radius: 8px;  margin-bottom: 10px;  float:left;  }
    .m-1-2{  width:125px;  height:115px;  margin-bottom: 20px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  }
    .m-1-3{  width:128px;  height:182.5px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  margin-bottom: 20px;  }
    .m-2-3{  width:280px;  height:182.5px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  margin-bottom: 20px;  }
    .m-2-6{  width:280px;  height:390px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  }
    .m-2-4{  width:280px;  height:250px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  margin-bottom: 20px;  }
    .m-3-4{  width:420px;  height:250px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  margin-bottom: 20px;  }
    .m-2-2{  width:280px;  height:115px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  }
    .m-4-4{  width:580px;  height:250px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  }
    .m-825-429{width:580px;  height:250px;  border:1px solid #ccc;  border-radius: 8px;  float:left; }
    .m-405-285 {width:280px;  height:115px;  border:1px solid #ccc;  border-radius: 8px;  float:left;}
    .m-492-357{width:280px;  height:115px;  border:1px solid #ccc;  border-radius: 8px;  float:left;}
    .m-318-171{ width:250px;  height:100px;  border:1px solid #ccc;  border-radius: 8px;  margin-bottom: 10px;  float:left;  }
    #pageType{;}
    .page2{;}
    .typeUrl{;}
    #url{;}
    td{height:10px;}
</style>


<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>


<table class="mtable" width="100%" cellspacing="0" cellpadding="10">
    <input type="hidden" name="id" value="<?php echo $screenContent->id;?>">
    <tr>
        <td width="100" align="right">尺寸：</td>
        <td><?php echo $screenContent->width;?>X<?php echo $screenContent->height;?></td>
    </tr>
    <tr>
        <td width="100" align="right">位置：</td>
        <td><?php echo $screenContent->x;?>X<?php echo $screenContent->y;?></td>
    </tr>
    <tr>
        <td width="100" align="right">类型：</td>
        <td>
             <?php if($screenContent->type==1){
                    echo '图片';
                }?><?php if($screenContent->type==2){
                    echo '视频';
                }?>
            (不同类型，需要配置的数据不同)
        </td>
    </tr>

    <tr>
        <td width="100" align="right">标题：</td>
        <td><?php echo $screenContent->title ?>
        </td>
    </tr>
    <tr>
        <td width="100" align="right">推荐内容：</td>
        <td>
        

              <?php if($screenContent->tType==1){echo '咪咕';}?>
               <?php if($screenContent->tType==5){echo '自有节目';}?>
                <!--<option value="6" <?php //if($screenContent[0]['tType']==6){echo 'selected';}?>>广告位,全屏大图</option>-->
               <?php if($screenContent->tType==99){echo '包名加类名跳转';}?>
               <?php if($screenContent->tType==100){echo 'action跳转';}?>
          <?php if($screenContent->tType==101){echo '包名跳转';}?>
          <?php if($screenContent->tType==102){echo 'Uri跳转';}?>
                <!--<option value="96" <?php if($screenContent->tType==96){echo 'selected';}?>>本地播放</option>-->
        <?php if($screenContent->tType==97){echo '二维码';}?>
          <?php if($screenContent->tType==98){echo '其他';}?>
     
        </td>
    </tr>
<!--    <tr id="show" style="">-->
<!--        <td width="100" align="right">牌照方：</td>-->
<!--        <td>-->
<!--            <select name="cp" class="form-input w300" id="cp">-->
<!--                <option  value="0">请选择</option>-->
<!--                <option  --><?php //if($screenContent[0]['cp']==1){echo 'selected';}?><!-- value="1">华数客户端</option>-->
<!--                <option  --><?php //if($screenContent[0]['cp']==2){echo 'selected';}?><!-- value="2">百视通客户端</option>-->
<!--                <option  --><?php //if($screenContent[0]['cp']==3){echo 'selected';}?><!-- value="3">未来电视</option>-->
<!--                <option  --><?php //if($screenContent[0]['cp']==4){echo 'selected';}?><!-- value="4">南传</option>-->
<!--                <option  --><?php //if($screenContent[0]['cp']==5){echo 'selected';}?><!-- value="5">芒果</option>-->
<!--                <option  --><?php //if($screenContent[0]['cp']==6){echo 'selected';}?><!-- value="6">国广</option>-->
<!--                <option  --><?php //if($screenContent[0]['cp']==7){echo 'selected';}?><!-- value="7">银河</option>-->
<!--            </select>-->
<!--        </td>-->
<!--    </tr>-->
    <tr class="utp" style="">
        <td width="100" align="right">页面类型</td>
        <td>
             <?php if($screenContent->uType==4){echo '海报专题';}?>
             <?php if($screenContent->uType==13){echo '排行榜专题';}?>
              <?php if($screenContent->uType==17){echo '河南专题';}?>
              <?php if($screenContent->uType==2){echo '海报栏目';}?>
               <?php if($screenContent->uType==15){echo '视频栏目';}?>
                <?php if($screenContent->uType==7){echo '竖图单片详情页';}?>
               <?php if($screenContent->uType==8){echo '多集数字详情页';}?>
            <?php if($screenContent->uType==10){echo '多集标题详情页';}?>
              <?php if($screenContent->uType==9){echo '横图单片详情页';}?>
              <?php if($screenContent->uType==1){echo '搜索';}?>
                <?php if($screenContent->uType==6){echo '历史';}?>
               <?php if($screenContent->uType==5){echo '收藏';}?>
               <?php if($screenContent->uType==11){echo '设置';}?>
               <?php if($screenContent->uType==16){echo '本地播放';}?>
             <?php if($screenContent->uType==12){echo '壁纸';}?>
      
        </td>
    </tr>
    <tr class="act" style="">
        <td width="100" align="right">action：</td>
        <td><?php echo $screenContent->action ?></td>
    </tr>

    <tr class="act" style="">
        <td width="100" align="right">param：</td>
        <td><?php echo $screenContent->param ?></td>
    </tr>
    <tr  class="upvid" style="">
        <td width="100" align="right">vid：</td>
        <td><?php echo $screenContent->cid ?></td>
    </tr>
    <tr  class="videoUrl" style="">
        <td width="100" align="right">videoUrl：</td>
        <td><?php echo $screenContent->videoUrl ?></td>
    </tr>
    <tr>
        <td width="100" align="right">当前图片为：</td>
        <td><div class="m-<?php echo $_GET['width']?>-<?php echo $_GET['height']?>">
        <img src="<?php echo $screenContent->picSrc;?>" class="m-<?php echo $_GET['width']?>-<?php echo $_GET['height']?> oldPic"></div>
        </td>
</tr>
    <tr>
        <td align="center" colspan="2">
            <input type="button" value="为此推荐位添加轮播图" class="btn addBanner">
            <input type="button" value="保存信息" class="btn save">
            <input type="button" value="删除此条数据" class="btn del">
            <input type="button" value="取消" class="gray" >

        </td>
    </tr>
</table>

<script>
    var tType = "<?php echo $screenContent->tType;?>";
    if(tType == 1){
        $("#show").show();
    }else if(tType == 22){
        $('.page2').show();
    }

    $('.meizi').click(function(){
//        var G= {};
//        G.cid = '<?php //echo !empty($id) ? $id :''?>//';
        var mid = "<?php echo $this->mid;?>";
        var my = layer.msg('加载中', {icon: 16,shade:0.3});
        $.getJSON('<?php echo $this->get_url('addContent','meizi')?>',function(d){
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
    });
</script>
<script>
    function bb()
    {
        var zhi = $("#uptype").val();
        if(zhi == '2'){
            $('.videoUrl').show();
        }else{
            $('.videoUrl').hide();
        }
    }
    bb();

    function aa()
    {
        var zhi = $("#tType").val();
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
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
            case '10':
            case '96':
            case '97':
            case '98':
            case '99':
            case '100':
            case '101':
            case '102':
                $('#show').hide();
                $('.upvid').hide();
                $('.utp').hide();
                $('.act').show();
                break;
        }

    }
    aa();

    $('#upload_file_new').uploadify
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
                <?php if($screenContent->height == 1){?>
                var l = $('#main').find('.<?php echo "m-".$screenContent->width;?>').find('img');
                <?php }else{?>
                var l = $('#main').find('.<?php echo "m-".$screenContent->width."-".$screenContent->height;?>').find('img');
                <?php }?>
                if(l.length < 1){
                    <?php if($screenContent->height == 1){?>
                    $('#main').find('.<?php echo "m-".$screenContent->width?>').append('<img src="'+value.url+'" width="100%" height="100%" class="upImg">');
                    <?php }else{?>
                    $('#main').find('.<?php echo "m-".$screenContent->width."-".$screenContent->height;?>').append('<img src="'+value.url+'" width="100%" height="100%" class="upImg">');
                    <?php }?>
                }else{
                    $(l).attr('src',value.url);
                }
            }else{
                layer.alert(value.msg,{icon:0});
            }
//            $('#upload_file_new').hide();
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
        if($('#main').children('div').children('img').length>0){
            var picSrc = $('.upImg').attr('src');
        }else{
            var picSrc = $('.oldPic').attr('src');
        }
        G.key = picSrc;
        G.uType  = $('#uType').val();   //选择咪咕后
        G.type   = $('#uptype').val();  //图片视频
        G.tType  = $('#tType').val();   //推荐内容
        G.title  = $('#title').val();
        G.action = $('#action').val();
        G.param  = $('#param').val();
        G.cp     = $('#cp').val();
        G.cid    = $('#upvid').val();
        G.videoUrl    = $('#videoUrl').val();
//        G.screenGuideId  = "<?php //echo $screenContent[0]['screenGuideId'] ;?>//";
//        G.epg    = "<?php //echo $screenContent[0]['epg'] ;?>//";
        G.width  = "<?php echo $screenContent->width?>";
        G.height  = "<?php echo $screenContent->height?>";
        G.x  = "<?php echo $screenContent->x?>";
        G.y  = "<?php echo $screenContent->y?>";
        G.order  = "<?php echo $screenContent->order?>";
        G.id = $('input[name=id]').val();
         G.nid="<?php echo $screenContent->sid?>";
//        console.log(G);return false;
        if(empty(G.tType)){
            layer.alert('上传类型不能为空',{icon:0});
            return false;
        }
        if(empty(G.title)){
            layer.alert('标题不能为空',{icon:0});
            return false;
        }
        if(empty(G.key)){
            layer.alert('系统错误2',{icon:0});
            return false;
        }

        var load = layer.load(0, {icon: 16,shade: [0.3,'#000']});
        $.post('/version/station/updatecontent?mid=<?php echo $this->mid?>',G,function(d){
            if(d.code == 200){
                alert('修改成功');
                //location.reload();
                window.close();
            }else{
                layer.close(load);
                layer.alert(d.msg);
            }
        },'json')
    });

    $('.gray').click(function()
    {
        window.close();
        //window.location.reload();
    });

    $('.del').click(function()
    {
        var id = $('input[name=id]').val();
        if(confirm('你确定删除此条数据吗？')){
           var k = $(this);
        var G = {};
        if($('#main').children('div').children('img').length>0){
            var picSrc = $('.upImg').attr('src');
        }else{
            var picSrc = $('.oldPic').attr('src');
        }
        G.key = picSrc;
        G.uType  = $('#uType').val();   //选择咪咕后
        G.type   = '3';  //图片视频
        G.tType  = $('#tType').val();   //推荐内容
        G.title  = $('#title').val();
        G.action = $('#action').val();
        G.param  = $('#param').val();
        G.cp     = $('#cp').val();
        G.cid    = $('#upvid').val();
        G.videoUrl    = $('#videoUrl').val();
//        G.screenGuideId  = "<?php //echo $screenContent[0]['screenGuideId'] ;?>//";
//        G.epg    = "<?php //echo $screenContent[0]['epg'] ;?>//";
        G.width  = "<?php echo $screenContent->width?>";
        G.height  = "<?php echo $screenContent->height?>";
        G.x  = "<?php echo $screenContent->x?>";
        G.y  = "<?php echo $screenContent->y?>";
        G.order  = "<?php echo $screenContent->order?>";
        G.id = $('input[name=id]').val();
         G.nid="<?php echo $screenContent->sid?>";
//        console.log(G);return false;


        var load = layer.load(0, {icon: 16,shade: [0.3,'#000']});
        $.post('/version/station/updatecontent?mid=<?php echo $this->mid?>',G,function(d){
            if(d.code == 200){
                alert('删除成功');
                //location.reload();
                window.close();
            }else{
                layer.close(load);
                layer.alert(d.msg);
            }
        },'json')
    }


    });
    $('.addBanner').click(function()
    {
        var order = "<?php echo $screenContent->order ; ?>";
//        var gid = "<?php //echo $screenContent[0]['screenGuideId'] ;?>//";
//        var epg = "<?php //echo $screenContent[0]['epg'] ;?>//";
        var width  = "<?php echo $screenContent->width?>";
        var height  = "<?php echo $screenContent->height?>";
        var x  = "<?php echo $screenContent->x?>";
        var y  = "<?php echo $screenContent->y?>";
        var nid="<?php echo $screenContent->sid?>";
        var picSrc = $('.hasPic').attr('src');
        window.location.href = "/version/station/Banner/mid/"+"<?php echo $this->mid;?>"+"/order/"+order+'/width/'+width+'/height/'+height+'/x/'+x+'/y/'+y+'/nid/'+nid;
    });
</script>