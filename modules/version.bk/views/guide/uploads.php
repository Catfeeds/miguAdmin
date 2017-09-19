<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<!-- 单集视频 start -->
<form action="" method="post" enctype="multipart/form-data">
     <input type="hidden" name="adminLeftOneName" value="<?php echo $adminLeftOneName;?>">
    <input type="hidden" name="adminLeftTwoName" value="<?php echo $adminLeftTwoName;?>">
    <input type="hidden" name="adminLeftOne" value="<?php echo $adminLeftOne;?>">
    <input type="hidden" name="adminLeftTwo" value="<?php echo $adminLeftTwo;?>">

<form action="" method="post" enctype="multipart/form-data">
<table style="width:900px;" class="mtable mt10" cellpadding="10" cellspacing="0">
         <tr>
    	<th style="background: #A3BAD5;height:30px;" colspan="7">添加素材</th>
    </tr>
	<tr>
            <td width="200" align="right">选择站点</td>
            <td>
                <select name="stationId" id="stationId" class="form-input w200" name="stationId">
                    <option value="0">--请选择--</option>
                    <?php
                    $sql = "select id,name from yd_ver_station";
                    $result = SQLManager::queryAll($sql);
                    if (!empty($result)) {?>
                        <?php
                        foreach ($result as $k => $v) {
                            ?>
                            <option value="<?php echo $v['id']; ?>" <?php $gid =!empty($_REQUEST['gid'])?$_REQUEST['gid']:''; if($v['id']==$gid){echo 'selected=selected';}?>><?php echo $v['name']; ?></option>
                        <?php } ?>
                    <?php }?>

                </select>
            </td>
        </tr>
        <tr>
            <td width="200" height="40" align="center">内容名称：</td>
            <td><input style="width:400px;margin:7px;" type="text" name="title" id="title" class="form-input" value=""></td>
        </tr>
<tr class="video_upload">
    <td align="right" valign="top">上传视频/图片：</td>
    <td>
        <div>
            <input style="display:none" name="url" class='url' type="text"/>
            <input type="file" id="video_is_upload"/>
            <script type="text/javascript">
                $('#video_is_upload').uploadify({
                    'auto'          : true,//关闭自动上传
                    'buttonImage'   : '/images/02.png',
                    'width'         : 98,
                    'height'        : 36,
                    'swf'           : '/js/uploadify/uploadify.swf',
                    'uploader'      : '/version/guide/video?mid=1',
                    'method'        : 'post',//方法，服务端可以用$_POST数组获取数据
                    'buttonText'    : '选择图片',//设置按钮文本
                    'multi'         : false,//允许同时上传多张图片
                    'uploadLimit'   : 1,//一次最多只允许上传10张图片
                    'fileTypeExts'  : '*',//限制允许上传的图片后缀
                    'sizeLimit'     : 10240000000,//限制上传的图片不得超过200KB
                    'onSelect'      : function(){
                        var no_img = $('.no_video');
                        if(no_img.length <= 0){
                            var myself = this;
                            myself.cancelUpload();
                            alert("如需上传多个视频请选择多集视频");
                        }
                    },
                    'onUploadSuccess' : function(file, data, response) {//每次成功上传后执行的回调函数，从服务端返回数据到前端
                        $('input[name=url]').val(data);
                        $('.url').show();
                    }
                })
            </script>
        </div>
        <div class="returnVideo no_video"></div>
    </td>
</tr>
    <tr>
      
        <td colspan="2" style="text-align: center;padding:5px">
            <input style="width:80px;height:30px;padding:0px" type="submit" value="保存信息" class="btn">
            <input style="width:80px;height:30px;padding:0px" type="button" value="返回列表" class="gray" onclick="window.location.href='<?php echo $this->get_url('guide','content',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>'">
        </td>
    </tr>
    </table>
<!-- 单集视频 end -->
</form>
<script>
    /*$('.btn').click(function(){
       var title = $('input[name=title]').val();
       if(empty(title)){
           alert('请输入标题');
           return false;
       }
    })*/
    $('.btn').click(function(){
       var title = $('input[name=title]').val();
       var stationId = $('#stationId').val();
       if(stationId <= 0){
           layer.alert('请选择站点');
           return false;
       }
       if(empty(title)){
           layer.alert('请输入标题');
           return false;
       }

    })	
</script>

