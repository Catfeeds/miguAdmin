<style>
#main div{
		
		position:relative;
	}
	.uploadify{
		position:absolute;
		z-index:9999;
		top:-33px;
	}
	#main img{
	position: absolute;
	top:0px;		

	}
#main-1 img{
    position: absolute;
    top: 510px;
}
	.mtable td{
		padding:5px;
	}
    td{
        width: 15%;
    }
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
.m-270-280{  width:270px;  height:280px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  }
    .m-270-190{  width:270px;  height:190px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  }
    .m-130-90{  width:195px;  height:134px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  }
    .m-550-280{width:550px;  height:280px;  border:1px solid #ccc;  border-radius: 8px;  float:left; }
    .m-405-285{width:280px;  height:125px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  margin-bottom: 20px;}
    .m-195-135{width:125px;  height:52.5px;  border:1px solid #ccc;  border-radius: 8px;  margin-bottom: 10px;  float:left;}
    .m-405-420{width:280px;  height:115px;  border:1px solid #ccc;  border-radius: 8px;  float:left;}
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

<table style="width:900px;" class="mtable mt10" cellpadding="10" cellspacing="0">
         <tr>
    	<th style="background: #A3BAD5;height:30px;" colspan="7">添加推荐内容</th>
    </tr>
    <tr>
        <td width="100" align="right">尺寸：</td>
        <td><?php echo $_GET['width'];?>X<?php echo $_GET['height'];?></td>
    </tr>
    <tr>
        <td width="100" align="right">位置：</td>
        <td><?php echo $_GET['x'];?>X<?php echo $_GET['y'];?></td>
    </tr>
    <tr>
        <td width="100" align="right">标题：</td>
        <td><input type="text" name="title" id="title" value="" class="form-input w300">
        </td>
    </tr>
    <tr>
        <td width="100" align="right">类型：</td>
        <td>
            <select name="uptype" class="form-input w300" id="uptype" onchange="bb()">
                <option  value="0">请选择</option>
                <option  value="1" >图片</option>
                <option  value="2" >视频</option>
                <option  value="3" >在线视频</option>
            </select>
            (不同类型，需要配置的数据不同)
        </td>
    </tr>
    <tr>
        <td width="100" align="right">推荐内容：</td>
        <td>
            <select name="tType" class="form-input w300" id="tType" onchange="aa()">
                <option value="0">请选择</option>
                <option  value="1" >咪咕</option>
                <option  value="5" >自有节目</option>
                <!--<option  value="6" >广告位,全屏大图</option>-->
                <option  value="99" >包名加类名跳转</option>
                <option  value="100" >action跳转</option>
                <option  value="101" >包名跳转</option>
                <option  value="102" >Uri跳转</option>
                <!--<option  value="96" >本地播放</option>-->
                <option  value="97" >二维码</option>
                <option  value="98" >其他</option>
            </select>
        </td>
    </tr>
    <tr id="show" style="display:none">
        <td width="100" align="right">牌照方：</td>
        <td>
            <select name="cp" class="form-input w300" id="cp">
                <option  value="0">请选择</option>
                <option  value="1">华数客户端</option>
                <option  value="2">百视通客户端</option>
                <option  value="3">未来电视</option>
                <option  value="4">南传</option>
                <option  value="5">芒果</option>
                <option  value="6">国广</option>
                <option  value="7">银河</option>
            </select>
        </td>
    </tr>
    <tr class="utp" style="display:none">
        <td width="100" align="right">页面类型</td>
        <td><select name="uType" class="form-input w300" id="uType">
                <option  value="0">请选择</option>
<option  value="4">海报专题</option>
		<option  value="13">排行榜专题</option>
		<option  value="17">自定义专题</option>
		<option  value="2">海报栏目</option>
		<option  value="15">视频栏目</option>
		<option  value="7">竖图单片详情页</option>
		<option  value="8">多集数字详情页</option>
		<option  value="10">多集标题详情页</option>
		<option  value="9">横图单片详情页</option>
		<option  value="1">搜索</option>
		<option  value="6">历史</option>
		<option  value="5">收藏</option>
		<option  value="11">设置</option>
		<option  value="16">本地播放</option>
		<option  value="12">壁纸</option>
		<!--<option  value="3">详情</option>-->
		<!--<option  value="14">无模板详情页</option>-->
               
            </select>
        </td>
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
    <tr  class="videoUrl" style="display:none">
        <td width="100" align="right">videoUrl：</td>
        <td><input type="text" id="videoUrl" name="videoUrl" value="" class="form-input"></td>
    </tr>
    
    <tr>
        <td align="right" valign="top">未选中图片上传：</td>
        <td></td>
    </tr>
    <tr>
        <td align="right" valign="top">未选中图片预览：</td>
        <td>
            <div class="up-main" id="main">
                <?php
                    echo "<div class='m-".$_GET['width']."-".$_GET['height']."' >
                                <input type='file' id='upload_file_new'>
                              </div>";
                ?>
                <?php
                    $pk_id = $_REQUEST['screenGuideId'];
                    $tmp_res = VerScreenGuide::model()->findByPk($pk_id);
                    if($tmp_res->attributes['templateId']<11){?>
                        <span class="infoSpan">请上传宽为<?php echo $_GET['width']*250+($_GET['width']-1)*20 ;?>，高为<?php echo $_GET['height']*105+($_GET['height']-1)*20;?>的图片！</span>
                    <?php }else{?>
                        <span class="infoSpan">请上传宽为<?php echo $_GET['width']?>，高为<?php echo $_GET['height']?>的图片！</span>
                    <?php }
                ?>
            </div>
        </td>
    </tr>



    <!--   选中图片上传区域    -->
    <tr>
        <td align="right" valign="top" style="position: relative;">选中图片上传：</td>
        <td></td>
    </tr>
    <tr>
        <td align="right" valign="top">选中图片预览：</td>
        <td>
            <div class="up-main-1" id="main-1">
                <?php
                echo "<div class='m-".$_GET['width']."-".$_GET['height']."' >
                                <input type='file' id='upload_file_new_no_select'>
                      </div>";
                ?>
                <?php
                $pk_id = $_REQUEST['screenGuideId'];
                $tmp_res = VerScreenGuide::model()->findByPk($pk_id);
                if($tmp_res->attributes['templateId']<11){?>
                    <span class="infoSpan">请上传宽为<?php echo $_GET['width']*250+($_GET['width']-1)*20 ;?>，高为<?php echo $_GET['height']*105+($_GET['height']-1)*20;?>的图片！</span>
                <?php }else{?>
                    <span class="infoSpan">请上传宽为<?php echo $_GET['width']?>，高为<?php echo $_GET['height']?>的图片！</span>
                <?php }
                ?>
            </div>
        </td>
    </tr>

    <tr>
        <td align="center" colspan="2">
                <input style="width:80px;height:30px;padding:0px" type="button" value="保存信息" class="btn save">
            <input style="width:80px;height:30px;padding:0px" type="button" value="取消" class="gray" onclick="window.close();">

        </td>
    </tr>
</table>
<script>



    function bb()
    {
        var zhi = $("#uptype").val();
        if(zhi == '2' || zhi == '3'){
            $('.videoUrl').show();
        }else{
	    $('.videoUrl').hide();
	}
    }

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
                var l = $('#main').find('.<?php echo "m-".$_GET['width']."-".$_GET['height'];?>').find('img');
                if(l.length < 1){
                    $('#main').find('.<?php echo "m-".$_GET['width']."-".$_GET['height'];?>').append('<img src="'+value.url+'" width="<?php echo $_GET['width']/2 ;?>px" height="<?php echo $_GET['height']/2 ;?>px" class="upImg">');
                }else{
                    $(l).attr('src',value.url);
                }
            }else{
                layer.alert(value.msg,{icon:0});
            }
            $('#upload_file_new').width(<?php echo ($_REQUEST['width']/2)?>);
            $('#upload_file_new').height(<?php echo ($_REQUEST['height']/2)?>);
        },
        'onError':function(err)
        {
            layer.alert(err);
        }

    });

    $('#upload_file_new_no_select').uploadify
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
                var l = $('#main-1').find('.<?php echo "m-".$_GET['width']."-".$_GET['height'];?>').find('img');
                if(l.length < 1){
                    $('#main-1').find('.<?php echo "m-".$_GET['width']."-".$_GET['height'];?>').append('<img src="'+value.url+'" width="<?php echo $_GET['width']/2 ;?>px" height="<?php echo $_GET['height']/2 ;?>px" class="upImg_1">');
                }else{
                    $(l).attr('src',value.url);
                }
            }else{
                layer.alert(value.msg,{icon:0});
            }
            $('#upload_file_new_no_select').width(<?php echo ($_REQUEST['width']/2)?>);
            $('#upload_file_new_no_select').height(<?php echo ($_REQUEST['height']/2)?>);
        },
        'onError':function(err)
        {
            layer.alert(err);
        }

    });

    var a = document.getElementById('upload_file_new_no_select');
    a.style.position = "relative";
    a.style.top = "-33px";

    $('.save').click(function()
    {
        var k = $(this);
        var G = {};
        var picSrc = $('.upImg').attr('src');
        var no_select_pic = $('.upImg_1').attr('src');
        if(empty(no_select_pic) || no_select_pic == undefined){
            G.no_select_pic = 0;
        }else{
            G.no_select_pic = no_select_pic;
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
        G.screenGuideId  = <?php echo $_GET['screenGuideId'] ;?>;
        G.epg    = "<?php echo $_GET['epg'] ;?>";
        G.width  = "<?php echo $_GET['width'];?>";
        G.height  = "<?php echo $_GET['height'];?>";
        G.x  = "<?php echo $_GET['x']?>";
        G.y  = "<?php echo $_GET['y']?>";
        G.order  = "<?php echo $_GET['order']?>";
        G.videoUrl = $('#videoUrl').val();
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
            layer.alert('系统错误1',{icon:0});
            return false;
        }
        if(empty(G.type)){
            layer.alert('系统错误2',{icon:0});
            return false;
        }
        var load = layer.load(0, {icon: 16,shade: [0.3,'#000']});
        $.post('<?php echo $this->get_url('screen','firstPageAdd')?>',G,function(d){
            if(d.code == 200){
//                location.reload();
                alert('添加成功');
                window.close();
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
        var gid = "<?php echo $_GET['screenGuideId'] ;?>";
        var epg = "<?php echo $_GET['epg'] ;?>";
        var width  = "<?php echo $_GET['width'];?>";
        var height  = "<?php echo $_GET['height']?>";
        var x  = "<?php echo $_GET['x'];?>";
        var y  = "<?php echo $_GET['y'];?>";
//        var img = ".m-"+width+"-"+height;
        var picSrc = $('.hasPic').attr('src');
//        console.log($(img));
//        return false;
        window.location.href = "/version/screen/Banner/mid/"+"<?php echo $this->mid?>"+"/nid/"+gid+"/epg/"+epg+"/order/"+order+'/width/'+width+'/height/'+height+'/x/'+x+'/y/'+y+"/";
    });


</script>


