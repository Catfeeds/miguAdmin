<style type="text/css">
    .interpret{
        /*width: 97.8%;
        height: 35px;
        line-height: 35px;
        margin-left: 15px;
        background: #f9f9f9;
        border: 1px solid #e4e3e3;
        border-top: none;
        padding: 10px 0 10px 8px;*/
    }
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
    /*.main{float:left}*/
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
    #pageType{display:none;}
    .page2{display:none;}
    .typeUrl{display:none;}
    #url{display:none;}
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
<!--<pre>-->
<?php //var_dump($list);die;?>
<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>

<!--<div class="adddiv">
    <div class="choseNum">已选择 1 条数据</div>
    <a  class="add" onclick="add(this)">导入</a>
</div>-->

<table class="mtable" width="100%" cellspacing="0" cellpadding="10">
    <tr>
        <td width="100" align="right">尺寸：</td>
        <td><?php echo $_GET['width'];?>X<?php echo $_GET['height'];?></td>
    </tr>
    <tr>
        <td width="100" align="right">位置：</td>
        <td><?php echo $_GET['x'];?>X<?php echo $_GET['y'];?></td>
    </tr>
    <tr>
        <td width="100" align="right">类型：</td>
        <td>
            <select name="contentType" id="contentType" class="form-input w300">
                <option value="1">图片</option>
                <option value="2">视频</option>
            </select>
            (不同类型，需要配置的数据不同)
        </td>
    </tr>
    <tr>
        <td width="100" align="right">上传类型：</td>
        <td>
            <input name="id" type="hidden" value="<?php if(!empty($list[0]['id'])){
                echo $list[0]['id'];
            };?>" />
            <select name="tType" class="form-input w300" id="tType" onchange="aa()">
                <option value="0">请选择</option>
                <option <?php if($list[0]['tType']==1){echo "selected=selected"; } ?> value="1">跳转牌照方客户端</option>
                <option <?php if($list[0]['tType']==3){echo "selected=selected"; } ?> value="3">应用商城</option>
                <option <?php if($list[0]['tType']==4){echo "selected=selected"; } ?> value="4">自有节目</option>
                <option <?php if($list[0]['tType']==5){echo "selected=selected"; } ?> value="5">全屏大图</option>
                <option <?php if($list[0]['tType']==6){echo "selected=selected"; } ?> value="6">二级专题页</option>
                <option <?php if($list[0]['tType']==7){echo "selected=selected"; } ?> value="7">咪咕音乐</option>
                <option <?php if($list[0]['tType']==8){echo "selected=selected"; } ?> value="8">咪咕视讯</option>
                <option <?php if($list[0]['tType']==9){echo "selected=selected"; } ?> value="9">咪咕学堂</option>
                <option <?php if($list[0]['tType']==10){echo "selected=selected"; } ?> value="10">糖果乐园</option>
                <option <?php if($list[0]['tType']==11){echo "selected=selected"; } ?> value="11">咪咕爱唱</option>
                <option <?php if($list[0]['tType']==12){echo "selected=selected"; } ?> value="12">和动漫</option>
                <option <?php if($list[0]['tType']==13){echo "selected=selected"; } ?> value="13">电影详情页</option>
                <option <?php if($list[0]['tType']==14){echo "selected=selected"; } ?> value="14">电视剧详情页</option>
                <option <?php if($list[0]['tType']==15){echo "selected=selected"; } ?> value="15">综艺详情页</option>
                <option <?php if($list[0]['tType']==16){echo "selected=selected"; } ?> value="16">新闻详情页</option>
                <option <?php if($list[0]['tType']==17){echo "selected=selected"; } ?> value="17">分类页</option>
                <option <?php if($list[0]['tType']==18){echo "selected=selected"; } ?> value="18">设置页</option>
                <option <?php if($list[0]['tType']==19){echo "selected=selected"; } ?> value="19">壁纸页</option>
<!--               <option --><?php //if($list[0]['tType']==13){echo "selected=selected"; } ?><!--< value="17">轮播</option>-->
                <option <?php if($list[0]['tType']==20){echo "selected=selected"; } ?> value="20">牌照方</option>
                <option <?php if($list[0]['tType']==21){echo "selected=selected"; } ?> value="21">第三方</option>
                <option <?php if($list[0]['tType']==22){echo "selected=selected"; } ?> value="22">咪咕</option>

            </select>

        </td>

    </tr>
    <tr id="show" style="display:none">
        <td width="100" align="right">牌照方：</td>
        <td>
            <select name="cp" class="form-input w300" id="cp">
                <option value="0">请选择</option>
                <?php if(empty($cpnew)){?>
                    <option  <?php if($list[0]['cp']==1){echo "selected=selected"; } ?> value="1">华数客户端</option>
                    <option  <?php if($list[0]['cp']==2){echo "selected=selected"; } ?> value="2">百视通客户端</option>
                    <option  <?php if($list[0]['cp']==3){echo "selected=selected"; } ?> value="3">未来电视</option>
                    <option  <?php if($list[0]['cp']==4){echo "selected=selected"; } ?> value="4">南传</option>
                    <option  <?php if($list[0]['cp']==5){echo "selected=selected"; } ?> value="5">芒果</option>
                    <option  <?php if($list[0]['cp']==6){echo "selected=selected"; } ?> value="6">国广</option>
                    <option  <?php if($list[0]['cp']==7){echo "selected=selected"; } ?> value="7">银河</option>
                <?php }else{ ?>
                    <option style="<?php if(!in_array(1,$cpnew)){echo 'display:none'; } ?>" <?php if($list[0]['cp']==1){echo "selected=selected"; } ?> value="1">华数客户端</option>
                    <option style="<?php if(!in_array(2,$cpnew)){echo 'display:none'; } ?>" <?php if($list[0]['cp']==2){echo "selected=selected"; } ?> value="2">百视通客户端</option>
                    <option style="<?php if(!in_array(3,$cpnew)){echo 'display:none'; } ?>" <?php if($list[0]['cp']==3){echo "selected=selected"; } ?> value="3">未来电视</option>
                    <option style="<?php if(!in_array(4,$cpnew)){echo 'display:none'; } ?>" <?php if($list[0]['cp']==4){echo "selected=selected"; } ?> value="4">南传</option>
                    <option style="<?php if(!in_array(5,$cpnew)){echo 'display:none'; } ?>" <?php if($list[0]['cp']==5){echo "selected=selected"; } ?> value="4">芒果</option>
                    <option style="<?php if(!in_array(6,$cpnew)){echo 'display:none'; } ?>" <?php if($list[0]['cp']==6){echo "selected=selected"; } ?> value="4">国广</option>
                    <option style="<?php if(!in_array(5,$cpnew)){echo 'display:none'; } ?>" <?php if($list[0]['cp']==7){echo "selected=selected"; } ?> value="7">银河</option>
                <?php } ?>
            </select>
        </td>
    </tr>
    <tr>
        <td width="100" align="right">标题：</td>
        <td><input type="text" name="title" id="title" value="<?php if(!empty($list[0]['title'])){
                echo $list[0]['title'];
            }else{ echo '';} ?>" class="form-input">
                       <!--<input type="submit" name="button" id="ybutton" class="seo-gray" value="搜索" style="float:right;">-->
        </td>
    </tr>
    <tr class="fenlei" style="display:none">
          <td width="100"></td>
           <td id="fenlei" align="center"></td>
    </tr>
    <tr class="page" style="display:none">
    <td colspan="2" align="center"><div id="page"></div></td>
       </tr>
    <tr>
        <td width="100" align="right">action：</td>
        <td><input type="text" name="action" id="action" value="<?php if(!empty($list[0]['action'])){
                echo $list[0]['action'];
            }else{ echo '';} ?>" class="form-input"></td>
    </tr>
    <tr>
        <td width="100" align="right">param：</td>
        <td><input type="text" name="param" id="param" value="<?php if(!empty($list[0]['param'])){
                echo $list[0]['param'];
            }else{ echo '';} ?>" class="form-input"><input type="submit" name="button" id="pbutton" class="seo-gray" value="搜索" style="float:left;margin-left:650px;margin-top:-35px;display:none"></td>
    </tr>
    <tr class="page2">
        <td width="100" align="right">页面类型：</td>
        <td align="left">
            <select name="pageType" id="pageType"  class="form-input w300">
                <option value="1">收藏</option>
                <option value="2">历史</option>
                <option value="3">搜索</option>
                <option value="4">栏目</option>
                <option value="5">详情</option>
                <option value="6">专题</option>
            </select>
        </td>
    </tr>
    <tr class="typeUrl">
        <td width="100" align="right">链接/ID：</td>
        <td>
            <input type="text" name="url" id="url" placeholder="根据页面类型，此处填写对应的链接或ID" class="form-input">
        </td>
    </tr>
    <tr>

        <td align="right" valign="top">图片上传：</td>
        <td>
            <?php
            if(!empty($list[0]['pic'])){
                echo "<div class='m-".$info['width']."-".$info['height']."'>
                                <img src=".$list[0]['pic']." class='m-".$info['width']."-".$info['height']." hasPic'>
                              </div>";
            }
            ?>
            <div class="up-main" id="main">

                <?php //echo $html;?>
                <?php
                    if(empty($list[0]['cp']) && empty($list[0]['tType'])){
                        echo "<div class='m-".$info['width']."-".$info['height']."' >
                                <input type='file' id='upload_file_new'>
                              </div>";
                    }else{
                        echo "<div class='m-".$info['width']."-".$info['height']."'>
                                重新选择图片
                                <input type='file' id='upload_file_new'>
                              </div>";
                    }

                ?>
                <span class="infoSpan">请上传宽为<?php echo $info['width']*250+($info['width']-1)*20 ;?>，高为<?php echo $info['height']*105+($info['height']-1)*20;?>的图片！</span>
            </div>
        </td>
    </tr>
    <tr>
        <td align="center" colspan="2">
            <?php if(empty($list[0]['cp']) && empty($list[0]['tType'])){?>
                <input type="button" value="选择媒资" class="btn meizi">
                <input type="button" value="保存信息" class="btn save">
            <?php }else{?>
                <input type="button" value="选择媒资" class="btn meizi">
                <input type="button" value="保存修改信息" class="btn update">
                <input type="button" value="删除此条数据" class="btn del"/>
                <input type="button" value="添加或查看轮播" class="btn addBanner"/>
            <?php }?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="button" value="取消" class="gray">

        </td>
    </tr>
</table>

<script>
    $('.meizi').click(function(){
//        var G= {};
//        G.cid = '<?php //echo !empty($id) ? $id :''?>//';
        var mid = "<?php echo $_GET['mid']?>";
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
    function aa()
    {
        var zhi = $("#tType").val();

        if(zhi == 0){
            $('#title').css('width','100%');
            $('#ybutton').css('display','none');
            $('#fenlei').empty();
            $('#page').empty();
            $('.fenlei').css('display','none');
            $('.page').css('display','none');
            $(".charging").hide();
            $("#aaa").text("URL：");
        }
        if(zhi==1){
            $("#show").show();
            $("#yingyong").hide();
            //$("#dianbo").show();
            $("#dian").removeAttr("checked");
            $("#hui").removeAttr("checked");
            $('#title').css('width','800px');
            $('#ybutton').css('display','block');
            $('#fenlei').empty();
            $('#page').empty();
            $('.fenlei').css('display','none');
            $('.page').css('display','none');
            $(".charging").hide();
            $("#aaa").text("URL：");
            $('#param').css('width','100%');
            $('#pbutton').css('display','none');
        }
        if(zhi==3){
            $("#yingyong").show();
            $("#huibo").hide();
            $("#dianbo").hide();
            $("#show").hide();
            $('#title').css('width','800px');
            $('#ybutton').css('display','block');
            $('#fenlei').empty();
            $('#page').empty();
            $('.fenlei').css('display','none');
            $('.page').css('display','none');
            $(".charging").hide();
            $("#aaa").text("URL：");
            $('#param').css('width','100%');
            $('#pbutton').css('display','none');
        }
        if(zhi==2){
            $("#show").hide();
            $("#yingyong").hide();
            $("#dianbo").hide();
            $("#huibo").hide();
            $('#title').css('width','100%');
            $('#ybutton').css('display','none');
            $('#fenlei').empty();
            $('#page').empty();
            $('.fenlei').css('display','none');
            $('.page').css('display','none');
            $(".charging").hide();
            $("#aaa").text("URL：");
            $('#param').css('width','100%');
            $('#pbutton').css('display','none');
        }
        if(zhi==4){
            $("#show").hide();
            $("#yingyong").hide();
            $("#dianbo").hide();
            $("#huibo").hide();
            $('#title').css('width','100%');
            $('#ybutton').css('display','none');
            $('#fenlei').empty();
            $('#page').empty();
            $('.fenlei').css('display','none');
            $('.page').css('display','none');
            $(".charging").hide();
            $("#aaa").text("URL：");
            $('#param').css('width','100%');
            $('#pbutton').css('display','none');
        }
        if(zhi == 5){
            $("#show").hide();
            $("#yingyong").hide();
            $(".charging").show();
            $("#aaa").text("资产ID：");
            $('#ybutton').css('display','none');
            $('#param').css('width','100%');
            $('#pbutton').css('display','none');
        }
        if(zhi == 6){
            $("#show").hide();
            $('#title').css('width','100%');
            $('#ybutton').css('display','none');
            $('#param').css('width','600px');
            $('#pbutton').css('display','block');
        }
        if(zhi == 22){
            $('#pageType').show();
            $('.page2').show();
            $('.typeUrl').show();
            $("#url").show();
            $('#action').parent().parent().hide();
            $('#param').parent().parent().hide();
        }
    }

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
                var l = $('#main').find('.<?php echo "m-".$info['width']."-".$info['height'];?>').find('img');
                if(l.length < 1){
                    $('#main').find('.<?php echo "m-".$info['width']."-".$info['height'];?>').append('<img src="'+value.url+'" width="100%" height="100%" class="upImg">');
                }else{
                    $(l).attr('src',value.url);
                }
            }else{
                layer.alert(value.msg,{icon:0});
            }
            $('#upload_file_new').hide();
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
        G.position = '0';
        var picSrc = $('.upImg').attr('src');
//        console.log($('.upImg'));
        G.key = picSrc;
//        G.id = $('input[name=id]').val();
        G.type  = '0';
        G.tType  = $('#tType').val();
        G.title  = $('#title').val();
        G.action = '0';
        G.param  = '0';
        G.cp     = $('#cp').val();
        G.gid    = <?php echo $info['nid'] ;?>;
        G.epg    = "<?php echo $info['epg'] ;?>";
        G.width  = "<?php echo $_GET['width']?>";
        G.height  = "<?php echo $_GET['height']?>";
        G.x  = "<?php echo $_GET['x']?>";
        G.y  = "<?php echo $_GET['y']?>";
        G.order  = "<?php echo $_GET['order']?>";
        console.log(G);//return false;
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
        $.post('/move/addContent/firstPageAdd?mid=<?php echo $this->mid?>&flag=1',G,function(d){
//            console.log(d);return false;
            if(d.code == 200){
                location.reload();
                var mid = "<?php echo trim($_GET['mid']);?>";
                var nid = "<?php echo trim($_GET['nid']);?>";
                var epg = "<?php echo trim($_GET['epg']);?>";
            }else{
                layer.close(load);
                layer.alert(d.msg);
            }
        },'json')
    });

    $('.update').click(function()
    {
        var k = $(this);
        var G = {};
        G.position = '0';
        var picSrc = $('.upImg').attr('src');
        G.key = picSrc;
        G.id = $('input[name=id]').val();
        G.id = <?php echo !empty($_GET['id'])?$_GET['id']:'0';?>;
        G.type  = '0';
        G.tType  = $('#tType').val();
        G.title  = $('#title').val();
        G.action = '0';
        G.param  = '0';
        G.cp     = $('#cp').val();
        G.gid    = <?php echo $info['nid'] ;?>;
        G.epg    = "<?php echo $info['epg'] ;?>";
        G.width  = "<?php echo $_GET['width']?>";
        G.height  = "<?php echo $_GET['height']?>";
        G.x  = "<?php echo $_GET['x']?>";
        G.y  = "<?php echo $_GET['y']?>";
        G.order  = "<?php echo $_GET['order']?>";
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
        $.post('/move/addContent/firstPageUpdate?mid=<?php echo $this->mid?>&flag=1',G,function(d){
//            console.log(d);return false;
            if(d.code == 200){
                location.reload();

            }else{
                layer.close(load);
                layer.alert(d.msg);
            }
        },'json')
    });

    $('.del').click(function()
    {
        var id = $('input[name=id]').val();
        $.get('/move/addContent/firstPageDel?mid=<?php echo $this->mid?>&flag=1&id='+id,function(d){
//            console.log(d);return false;
            if(d.code == 200){
                location.reload();

            }else{
                layer.close(load);
                layer.alert(d.msg);
            }
        },'json')
    });

    $('.addBanner').click(function()
    {
        var order = "<?php echo $_GET['order'] ; ?>";
        var gid = "<?php echo $_GET['nid'] ;?>";
        var epg = "<?php echo $info['epg'] ;?>";
        var width  = "<?php echo $_GET['width']?>";
        var height  = "<?php echo $_GET['height']?>";
        var x  = "<?php echo $_GET['x']?>";
        var y  = "<?php echo $_GET['y']?>";
//        var img = ".m-"+width+"-"+height;
        var picSrc = $('.hasPic').attr('src');
//        console.log($(img));
//        return false;
        window.location.href = "/move/addContent/Banner/mid/"+"<?php echo $_GET['mid']?>"+"/nid/"+gid+"/epg/"+epg+"/order/"+order+'/width/'+width+'/height/'+height+'/x/'+x+'/y/'+y+"/";
    });


</script>
