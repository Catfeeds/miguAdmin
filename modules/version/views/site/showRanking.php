<style type="text/css">
.up-main{

                position:relative;
        }
        .uploadify{
                position:absolute;
                top:-72px;
                left:0px;
                z-index: 9999;
        }
        .uploadify-button{
                border-radius: 0px;

        }
.oldUpImg img{
        max-width:270px;
        max-height: 177px;
    }
    #upImg img{
        max-width:270px;
        max-height: 177px;
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
<table class="mtable" width="100%" cellspacing="0" cellpadding="10" style='overflow-y:scroll;'>
    <tr>
        <td width="100" align="right">标题：</td>
        <td><?php  echo !empty($res['title'])?$res['title']:''; ?>
        </td>
    </tr>
    <tr>
        <td width="100" align="right">类型：</td>
        <td>

             <?php $uptype = !empty($res['type'])?$res['type']:'';if($uptype=='1'){echo "图片"; }?>
             <?php $uptype = !empty($res['type'])?$res['type']:'';if($uptype=='2'){echo "视频"; }?>
             <?php $uptype = !empty($res['type'])?$res['type']:'';if($uptype=='3'){echo "在线视频"; }?>
       </td>
    </tr>
    <tr>
        <td width="100" align="right">推荐内容：</td>
        <td>
       
              <?php $tType = !empty($res['tType'])?$res['tType']:'';if($tType=='1'){echo "咪咕"; }?> 
               <?php $tType = !empty($res['tType'])?$res['tType']:'';if($tType=='5'){echo "自有节目"; }?> 
               <?php $tType = !empty($res['tType'])?$res['tType']:'';if($tType=='6'){echo "广告位，全屏大图"; }?> 
              <?php $tType = !empty($res['tType'])?$res['tType']:'';if($tType=='99'){echo "包名加类名跳转"; }?> 
               <?php $tType = !empty($res['tType'])?$res['tType']:'';if($tType=='100'){echo "action跳转<"; }?> 
             <?php $tType = !empty($res['tType'])?$res['tType']:'';if($tType=='101'){echo "包名跳转"; }?> 
               <?php $tType = !empty($res['tType'])?$res['tType']:'';if($tType=='102'){echo "Uri跳转"; }?>
    
        </td>
    </tr>
    <tr id="show" style="display:none">
        <td width="100" align="right">牌照方：</td>
        <td>
         
              <?php $cp = !empty($res['cp'])?$res['cp']:'';if($cp=='1'){echo "华数客户端"; }?> 
              <?php $cp = !empty($res['cp'])?$res['cp']:'';if($cp=='2'){echo "百视通客户端"; }?>
              <?php $cp = !empty($res['cp'])?$res['cp']:'';if($cp=='3'){echo "未来电视"; }?> 
              <?php $cp = !empty($res['cp'])?$res['cp']:'';if($cp=='4'){echo "南传"; }?> 
              <?php $cp = !empty($res['cp'])?$res['cp']:'';if($cp=='5'){echo "芒果"; }?> 
              <?php $cp = !empty($res['cp'])?$res['cp']:'';if($cp=='6'){echo "国广"; }?> 
              <?php $cp = !empty($res['cp'])?$res['cp']:'';if($cp=='7'){echo "银河"; }?> 
       
        </td>
    </tr>
    <tr class="utp">
        <td width="100" align="right">页面类型</td>
        <td>
				 <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='4'){echo "海报专题"; }?>
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='13'){echo "排行榜专题"; }?> 
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='17'){echo "自定义专题"; }?>
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='2'){echo "海报栏目"; }?> 
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='15'){echo "视频栏目"; }?> 
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='A'){echo "竖图单片详情页"; }?> 
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='B'){echo "多集数字详情页"; }?> 
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='C'){echo "多集标题详情页"; }?> 
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='D'){echo "横图单片详情页"; }?> 
                <!--  value="3">详情</option>-->
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='1'){echo "搜索"; }?> 
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='6'){echo "历史"; }?> 
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='5'){echo "收藏"; }?> 
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='11'){echo "设置"; }?> 
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='16'){echo "本地播放"; }?> 
              <?php $uType = !empty($res['uType'])?$res['uType']:'';if($uType=='12'){echo "壁纸"; }?>
                <!-- <?php //$uType = !empty($res['uType'])?$res['uType']:'';if($uType=='E'){echo ""; }?> value="E">无模板详情页</option>-->

      </td>
    </tr>
    <tr class="act">
        <td width="100" align="right">action：</td>
        <td><?php echo !empty($res['action'])?$res['action']:'';?></td>
    </tr>

    <tr class="act">
        <td width="100" align="right">param：</td>
        <td><?php echo !empty($res['param'])?$res['param']:'';?></td>
    </tr>
    <tr  class="upvid">
        <td width="100" align="right">vid：</td>
        <td><?php echo !empty($res['vid'])?$res['vid']:''; ?></td>
    </tr>

    <?php
        if(!empty($imgFlag)){?>
            <tr class="oldUpImg">
                <td width="100" align="right">图片：</td>
		
                <td><img src="<?php echo !empty($res['pic'])?$res['pic']:''; ?>" alt=""></td>
            </tr>
           
        <?php
        }
    ?>

</table>

<input type="hidden" name="gids" id="gids" value="<?php echo $res['id'];?>">

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
            case '5':
                $('#show').hide();
                $('.upvid').hide();
                $('.utp').hide();
                $('.act').show();
                break;
            case '6':
                $('#show').hide();
                $('.upvid').hide();
                $('.utp').hide();
                $('.act').show();
                break;
             case '99':
                $('#show').hide();
                $('.upvid').hide();
                $('.utp').hide();
                $('.act').show();
                break;
             case '100':
                $('#show').hide();
                $('.upvid').hide();
                $('.utp').hide();
                $('.act').show();
                break;
             case '101':
                $('#show').hide();
                $('.upvid').hide();
                $('.utp').hide();
                $('.act').show();
                break;
             case '102':
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
<?php
        if(!empty($imgFlag)){?>
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
                var l = $('#main-updateRanking').find('#upImg').find('img');
                if(l.length < 1){
                    $('#main-updateRanking').find('#upImg').append('<img src="'+value.url+'" width="100%" height="100%" id="tupian">');
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
<?php }?>
    $(function(){
        aa();
    });

    $('.save').click(function(){
        var k = $(this);
        var G = {};
        //G.title = $('#title').val();
        // G.url = $('#url').val();
        G.position = '<?php echo $res['position'];?>';

        //G.key = $('input[name=key]').val();
        if($('#upImg').length>0){
            G.key = $('#tupian').attr('src');
        }else{
            G.key = '1';
        }
        if(empty(G.key)){
            G.key = $('.oldUpImg').children('td').eq(1).children('img').attr('src');
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
        G.uiId    = $('#gids').val();
        //console.log(G);return false;
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
        $.post('<?php echo $this->get_url('site','RankingUpdate')?>',G,function(d){
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

