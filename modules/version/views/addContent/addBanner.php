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
    .contentId{display:none;}
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
        .bx-controls{display:none;}
    }
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
<script type="text/javascript" src="/js/jquery.bxslider.min.js"></script>
<ul class='bxslider'>
    <?php
        foreach($list as $k=>$v){
            echo "<li><img src=".$v['pic']." class='m-".$v['width']."-".$v['height']."'  onclick='bannerClick(this)'/><span class='contentId'>".$v['id']."</span></li>";
        }
    ?>
</ul>
<script>
    slider = $('.bxslider').bxSlider();
    slider.startAuto();
    $('.bx-controls').hide();
</script>

<table class="mtable" width="100%" cellspacing="0" cellpadding="10">
    <tr>
        <td width="100" align="right">尺寸：</td>
        <td><?php echo $info['width'];?>X<?php echo $info['height'];?></td>
    </tr>
    <tr>
        <td width="100" align="right">位置：</td>
        <td><?php echo $info['x'];?>X<?php echo $info['y'];?></td>
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
            <input name="id" type="hidden" value="" />
            <select name="tType" class="form-input w300" id="tType" onchange="aa()">
                <option value="0">请选择</option>
                <option  value="1">跳转牌照方客户端</option>
                <option  value="3">应用商城</option>
                <option  value="4">自有节目</option>
                <option  value="5">全屏大图</option>
                <option  value="6">二级专题页</option>
                <option  value="7">咪咕音乐</option>
                <option  value="8">咪咕视讯</option>
                <option  value="9">咪咕学堂</option>
                <option  value="10">糖果乐园</option>
                <option  value="11">咪咕爱唱</option>
                <option  value="12">和动漫</option>
                <option  value="13">电影详情页</option>
                <option  value="14">电视剧详情页</option>
                <option  value="15">综艺详情页</option>
                <option  value="16">新闻详情页</option>
                <option  value="17">分类页</option>
                <option  value="18">设置页</option>
                <option  value="19">壁纸页</option>
                <option  value="20">牌照方</option>
                <option  value="21">第三方</option>
                <option  value="22">咪咕</option>
            </select>
        </td>
    </tr>
    <tr id="show" style="display:none">
        <td width="100" align="right">牌照方：</td>
        <td>
            <select name="cp" class="form-input w300" id="cp">
                <option value="0">请选择</option>
                <option   value="1">华数客户端</option>
                <option   value="2">百视通客户端</option>
                <option   value="3">未来电视</option>
                <option   value="4">南传</option>
                <option   value="5">芒果</option>
                <option   value="6">国广</option>
                <option   value="7">银河</option>
            </select>
        </td>
    </tr>
    <tr>
        <td width="100" align="right">标题：</td>
        <td><input type="text" name="title" id="title" value="" class="form-input">
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
        <td><input type="text" name="action" id="action" value="" class="form-input"></td>
    </tr>
    <tr>
        <td width="100" align="right">param：</td>
        <td><input type="text" name="param" id="param" value="" class="form-input"><input type="submit" name="button" id="pbutton" class="seo-gray" value="搜索" style="float:left;margin-left:650px;margin-top:-35px;display:none"></td>
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

            <div class="up-main" id="main">
                <?php
                echo "<div class='m-".$info['width']."-".$info['height']."' >
                                <input type='file' id='upload_file_new'>
                              </div>";
                ?>
                <span class="infoSpan">请上传宽为<?php echo $info['width']*250+($info['width']-1)*20 ;?>，高为<?php echo $info['height']*105+($info['height']-1)*20;?>的图片！</span>
            </div>
        </td>
    </tr>
    <tr>
        <td align="center" colspan="2">
            <input type="button" value="选择媒资" class="btn meizi">
            <input type="button" value="保存信息" class="btn save">
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
        'buttonText': '上次图片',//设置按钮文本
        'queueID' : 'queueid',
        'multi': false,//允许同时上传多张图片
        'uploadLimit': 10,//一次最多只允许上传10张图片
        'fileTypeExts': '*',//限制允许上传的图片后缀
        'sizeLimit': 102400000000000,//限制上传的图片不得超过200KB
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
                    $('#main').find('.<?php echo "m-".$info['width']."-".$info['height'];?>').append('<img src="'+value.url+'" width="100%" height="100%"  class="upImg">');
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
        $.post('/move/addContent/firstPageAdd?mid=<?php echo $this->mid?>&flag=1',G,function(d){
//            console.log(d);return false;
            if(d.code == 200){
                location.reload();
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
//        alert(picSrc);return false;
        G.id = $('input[name=id]').val();
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
        window.location.href = "/move/addContent/Banner/mid/"+"<?php echo $_GET['mid']?>"+"/gid/"+gid+"/epg/"+epg+"/order/"+order;
    });

    function bannerClick(obj)
    {
        var id = $(obj).next('span').text();
        var nid = <?php echo trim($_GET['nid']);?>;
        var mid = <?php echo trim($_GET['mid']);?>;
        var epg = "<?php echo trim($_GET['epg']);?>";
        var order = "<?php echo trim($_GET['order']);?>";
        var width = "<?php echo trim($_GET['width']);?>";
        var height = "<?php echo trim($_GET['height']);?>";
        var x = "<?php echo trim($_GET['x']);?>";
        var y = "<?php echo trim($_GET['y']);?>";
        window.open('/move/addContent/bannerIndex/mid/'+mid+'/nid/'+nid+'/width/'+width+'/height/'+height+'/x/'+x+'/y/'+y+'/epg/'+epg+'/order/'+order+'/id/'+id+'/');
    }

</script>

<script>



    var p=1;
    $('.one').click(function()
    {
        if($(this).attr('val') == 1){
            p=1;
        }else if($(this).attr('val') == 0 ){
            p = parseInt(p)-1;
            if(p<1){
                p=1;
            }
        }else if($(this).attr('val') == 2){
            p = parseInt(p)+1;
        }else if($(this).attr('val') == 3){
            var goP = $('.pageGo').val();
            p =parseInt(goP);
        }else if($(this).attr('val') == 4){
            var totalPage = $('.totalPage').text();
            p = parseInt(totalPage);
        }

        if( $('.btn').hasClass('seachFlag') == true){
            seach(p);
            $('.nowpage').text("当前第"+p+"页");
            return false;
        }
        $('.choseNum').hide();
        $('.nowpage').text("当前第"+p+"页");
        $.ajax
        ({
            type:'post',
            url:'/move/AddContent/page/mid/<?php echo $_REQUEST['mid'] ;?>/p/'+p,
            success:function(data)
            {
                data = jQuery.parseJSON(data);
                $('.trdata').remove();
                for(var i = 0 ; i<data.length ; i++){
//                       data[i].cp = data[i].cp.substr(5);
                    switch( data[i].cp )
                    {
                        case '642001' : data[i].cp='华数' ; break;
                        case 'BESTVOTT' : data[i].cp='百事通' ; break;
                        case 'ICNTV' : data[i].cp='未来电视' ; break;
                        case 'youpeng' : data[i].cp='南传' ; break;
                        case 'HNBB' : data[i].cp='芒果' ; break;
                        case 'CIBN' : data[i].cp='国广' ; break;
                        case 'YGYH' : data[i].cp='银河' ; break;
                    }
                    $('.mt10').append
                    (
                        "<tr class='trdata' id='"+(i+1)+"'>"+
                        "<td align='center'><label><input type='checkbox' class='chosetr' name='id' value="+data[i].id+" onclick='chose(this)'/></label></td>"+
                        "<td align='center'>"+data[i].id+"</td>"+
                        "<td align='center'>"+data[i].cp+"</td>"+
                        "<td align='center'>"+data[i].title+"</td>"+
                        "<td align='center'>"+data[i].language+"</td>"+
                        "<td align='center'>"+data[i].director+"</td>"+
                        "<td align='center'>"+data[i].actor+"</td>"+
                        "<td align='center'>"+data[i].cate+"</td>"+
                        "</tr>"
                    )

                }
            }
        })
    });


    $('.seach').click(function()
    {
        $('.choseNum').hide();
        $('.btn').addClass('seachFlag');
        $('.pageGo').remove();
        $('.go-page').before(" <input class='pageGo' type='number' name='go'  placeholder='输入要去的页数点击go~~'/>");
        p=1;
        $('.nowpage').text("当前第"+p+"页");
        var keyword = $('#search').val();
        var cp = $('#cp').val();
        var language = $('#language').val();
        if(language == 1){
            language = "";
        }
        var type = $('#type').val();
        if(keyword.length==0 && cp==0 && language==0 && type==0){
            alert('您还没有选择任何搜索条件！');
            return false;
        }

        $.ajax
        ({
            type:'post',
            url:"/move/AddContent/seach/mid/<?php echo $_REQUEST['mid'] ;?>/keyword/"+keyword+"/cp/"+cp+"/language/"+language+"/type/"+type,
            success:function(data)
            {
                data = jQuery.parseJSON(data);
                if(data.res.length == 0){
                    alert('暂时没有符合条件的数据');
                }else{
                    $('.trdata').remove();
                    seachpage = data.seachPage;
                    $('.totalPage').text(seachpage);
                    data = data.res;
                    for(var i = 0 ; i<10 ; i++){
//                        data[i].cp = data[i].cp.substr(5);
                        switch( data[i].cp )
                        {
                            case '642001' : data[i].cp='华数' ; break;
                            case 'BESTVOTT' : data[i].cp='百事通' ; break;
                            case 'ICNTV' : data[i].cp='未来电视' ; break;
                            case 'youpeng' : data[i].cp='南传' ; break;
                            case 'HNBB' : data[i].cp='芒果' ; break;
                            case 'CIBN' : data[i].cp='国广' ; break;
                            case 'YGYH' : data[i].cp='银河' ; break;
                        }
                        $('.mt10').append
                        (
                            "<tr class='trdata' id='"+(i+1)+"'>"+
                            "<td align='center'><label><input type='checkbox'  class='chosetr' name='id' value="+data[i].id+" onclick='chose(this)'/> </label></td>"+
                            "<td align='center'>"+data[i].id+"</td>"+
                            "<td align='center'>"+data[i].cp+"</td>"+
                            "<td align='center'>"+data[i].title+"</td>"+
                            "<td align='center'>"+data[i].language+"</td>"+
                            "<td align='center'>"+data[i].director+"</td>"+
                            "<td align='center'>"+data[i].actor+"</td>"+
                            "<td align='center'>"+data[i].cate+"</td>"+
                            "</tr>"
                        )

                    }
                }
            }

        })
    });

    function seach(p)
    {
        var keyword = $('#search').val();
        var cp = $('#cp').val();
        /*if(cp>0){
         cp = '64200'+cp;
         }*/
        var language = $('#language').val();
        var type = $('#type').val();
        $('.choseNum').hide();
        $.ajax
        ({
            type:'post',
            url:"/move/AddContent/seachPage/mid/<?php echo $_REQUEST['mid'] ;?>/keyword/"+keyword+"/cp/"+cp+"/language/"+language+"/type/"+type+"/p/"+p,
            success:function(data)
            {
                data = jQuery.parseJSON(data);
//                console.log(data);
                if(data.length == 0){
                    alert('暂时没有符合条件的数据');
                }else{
                    $('.trdata').remove();
                    $('.totalPage').text(data.seachPage);
                    for(var i = 0 ; i<data.length ; i++){
//                        data[i].cp = data[i].cp.substr(5);
                        switch( data[i].cp )
                        {
                            case '642001' : data[i].cp='华数' ; break;
                            case 'BESTVOTT' : data[i].cp='百事通' ; break;
                            case 'ICNTV' : data[i].cp='未来电视' ; break;
                            case 'youpeng' : data[i].cp='南传' ; break;
                            case 'HNBB' : data[i].cp='芒果' ; break;
                            case 'CIBN' : data[i].cp='国广' ; break;
                            case 'YGYH' : data[i].cp='银河' ; break;
                        }
                        $('.mt10').append
                        (
                            "<tr class='trdata' id='"+(i+1)+"'>"+
                            "<td align='center'><label><input type='checkbox' class='chosetr' name='id' value="+data[i].id+" onclick='chose(this)' /></label></td>"+
                            "<td align='center'>"+data[i].id+"</td>"+
                            "<td align='center'>"+data[i].cp+"</td>"+
                            "<td align='center'>"+data[i].title+"</td>"+
                            "<td align='center'>"+data[i].language+"</td>"+
                            "<td align='center'>"+data[i].director+"</td>"+
                            "<td align='center'>"+data[i].actor+"</td>"+
                            "<td align='center'>"+data[i].cate+"</td>"+
                            "</tr>"
                        )

                    }
                }
            }

        })
    }


    function chose(obj)
    {
        $(obj).parent().addClass('choseFlag');
        var videoId = $(obj).val();
        /*if( $(obj).hasClass('choseFlag') == true){
         $(obj).removeClass('choseFlag');
         }
         var num = $('.choseFlag').length;
         $('.choseNum').show();
         $('.choseNum').text("已选择 "+num+" 条数据");*/
        $.post('/move/AddContent/choseMeizi?mid=<?php echo $this->mid?>',{id:videoId},function(data)
        {
            $('#title').val(data[0].title);

        },'json')

    }


    function add(obj)
    {
        var idData = new Array();
        var num = $('.choseFlag').length;
        for(var i = 0 ; i<num ; i++){
            idData[i] = $('.choseFlag').eq(i).children('input').val();
        }
        $.post('/wechat/meizi/add?mid=<?php echo $this->mid?>',{id:idData},function(data)
        {
            if(data == 1){
                alert('添加成功！');
                location.reload();
            }
        },'json')

    }


    function cpChose(obj)
    {
        var cp = $(obj).val();
        if(cp == 'BESTVOTT'){
            $('#type').children('option').eq(0).siblings('option').remove();
            $('#type').children('option').eq(0).after
            (

                '<option  value="娱乐">娱乐</option>'+
                '<option  value="少儿">少儿</option>'+
                '<option  value="新闻">新闻</option>'+
                '<option  value="法治">法治</option>'+
                '<option  value="生活">生活</option>'+
                '<option  value="电影">电影</option>'+
                '<option  value="电影">电竞</option>'+
                '<option  value="纪实">纪实</option>'+
                '<option  value="综艺">综艺</option>'+
                '<option  value="财经">财经</option>'+
                '<option  value="音乐">音乐</option>'+
                '<option  value="高清">高清</option>'+
                '<option  value="体育">体育</option>'+
                '<option  value="电视剧">电视剧</option>'

            )

        }else if(cp == '642001'){
            $('#type').children('option').eq(0).siblings('option').remove();
            $('#type').children('option').eq(0).after
            (
                '<option  value="其他栏目">其他栏目</option>'+
                '<option  value="电视剧类节目">电视剧类节目</option>'+
                '<option  value="电影类节目">电影类节目</option>'+
                '<option  value="视频类节目">视频类节目</option>'+
                '<option  value="录制类节目">录制类节目</option>'+
                '<option value=" " \'=""> </option>'
            )
        }else if(cp == 'CIBN'){
            $('#type').children('option').eq(0).siblings('option').remove();
            $('#type').children('option').eq(0).after
            (


                '<option  value="生活">生活</option>'+
                '<option  value="电影">电影</option>'+
                '<option  value="综艺">综艺</option>'+
                '<option  value="电视剧">电视剧</option>'+
                '<option  value="动漫">动漫</option>'+
                '<option  value="记录专题">记录专题</option>'+
                '<option  value="其他栏目">其他栏目</option>'+
                '<option  value="音乐">音乐</option>'+
                '<option  value="新闻资讯">新闻资讯</option>'

            )
        }else if(cp == 'HNNB'){
            $('#type').children('option').eq(0).siblings('option').remove();
            $('#type').children('option').eq(0).after
            (
                '<option value=" 动漫 " \'=""> 动漫 </option>'+
                '<option value=" 电影 " \'=""> 电影 </option>'+
                '<option value=" 纪实 " \'=""> 纪实 </option>'+
                '<option value=" 综艺 " \'=""> 综艺 </option>'+
                '<option value=" 音乐 " \'=""> 音乐 </option>'

            )
        }else{
            $('#type').children('option').eq(0).siblings('option').remove();
        }
    }

    function cpChose1()
    {
        var vs = $('select  option:selected').val();
        if(vs == 'BESTVOTT'){
            $('#type').children('option').eq(0).siblings('option').remove();
            $('#type').children('option').eq(0).after
            (

                '<option  value="娱乐">娱乐</option>'+
                '<option  value="少儿">少儿</option>'+
                '<option  value="新闻">新闻</option>'+
                '<option  value="法治">法治</option>'+
                '<option  value="生活">生活</option>'+
                '<option  value="电影">电影</option>'+
                '<option  value="电影">电竞</option>'+
                '<option  value="纪实">纪实</option>'+
                '<option  value="综艺">综艺</option>'+
                '<option  value="财经">财经</option>'+
                '<option  value="音乐">音乐</option>'+
                '<option  value="高清">高清</option>'+
                '<option  value="体育">体育</option>'+
                '<option  value="电视剧">电视剧</option>'

            )

        }else if(vs == '642001'){
            $('#type').children('option').eq(0).siblings('option').remove();
            $('#type').children('option').eq(0).after
            (
                '<option  value="其他栏目">其他栏目</option>'+
                '<option  value="电视剧类节目">电视剧类节目</option>'+
                '<option  value="电影类节目">电影类节目</option>'+
                '<option  value="视频类节目">视频类节目</option>'+
                '<option  value="录制类节目">录制类节目</option>'+
                '<option value=" " \'=""> </option>'
            )
        }else if(vs == 'CIBN'){
            $('#type').children('option').eq(0).siblings('option').remove();
            $('#type').children('option').eq(0).after
            (


                '<option  value="生活">生活</option>'+
                '<option  value="电影">电影</option>'+
                '<option  value="综艺">综艺</option>'+
                '<option  value="电视剧">电视剧</option>'+
                '<option  value="动漫">动漫</option>'+
                '<option  value="记录专题">记录专题</option>'+
                '<option  value="其他栏目">其他栏目</option>'+
                '<option  value="音乐">音乐</option>'+
                '<option  value="新闻资讯">新闻资讯</option>'

            )
        }else if(vs == 'HNNB'){
            $('#type').children('option').eq(0).siblings('option').remove();
            $('#type').children('option').eq(0).after
            (
                '<option value=" 动漫 " \'=""> 动漫 </option>'+
                '<option value=" 电影 " \'=""> 电影 </option>'+
                '<option value=" 纪实 " \'=""> 纪实 </option>'+
                '<option value=" 综艺 " \'=""> 综艺 </option>'+
                '<option value=" 音乐 " \'=""> 音乐 </option>'

            )
        }else{
            $('#type').children('option').eq(0).siblings('option').remove();
        }
    }

</script>
