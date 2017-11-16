<script charset="utf-8" type="text/javascript" src="/js/jdate/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/js/jdate/jquery.datetimepicker.css" />
<form action="" method="post" enctype="multipart/form-data" onsubmit="return check();">
<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>

<style type="text/css">
.mtable tr:nth-child(odd){
background: #F0FDFF;
}
.mtable td{
padding:5px 10px;
}
</style>

<table style="width:700px;" class="mtable" width="50%" cellspacing="0" cellpadding="10">
    <input type="hidden" name="id" value="<?php echo !empty($message->attributes['id'])?$message->attributes['id']:''?>">
    <input type="hidden" name="adminLeftOneName" value="<?php echo $adminLeftOneName;?>">
    <input type="hidden" name="adminLeftTwoName" value="<?php echo $adminLeftTwoName;?>">
    <input type="hidden" name="adminLeftOne" value="<?php echo $adminLeftOne;?>">
    <input type="hidden" name="adminLeftTwo" value="<?php echo $adminLeftTwo;?>">
    <tr>
    	<th style="background: #A3BAD5;height:30px;" colspan="2">添加消息内容</th>
    </tr>
    <tr>
        <td width="100" align="center">标题：</td>
        <td><input type="text" name="title" id="title" value="<?php echo !empty($message->attributes['title'])?$message->attributes['title']:''?>" class="form-input w300">
        </td>
    </tr>
    <tr>
        <td width="100" align="center">推荐内容：</td>
        <td>
            <select name="type" class="form-input w300" id="type" onchange="aa()">
                <option value="0">请选择</option>
                <option <?php $type= !empty($message->attributes['type'])?$message->attributes['type']:'';if($type=='1'){echo "selected=selected"; }?> value="1" >咪咕</option>
                <option <?php $type= !empty($message->attributes['type'])?$message->attributes['type']:'';if($type=='5'){echo "selected=selected"; }?> value="5" >自有节目</option>
                <!--<option  value="6" >广告位,全屏大图</option>-->
                <option <?php $type= !empty($message->attributes['type'])?$message->attributes['type']:'';if($type=='99'){echo "selected=selected"; }?> value="99" >包名加类名跳转</option>
                <option <?php $type= !empty($message->attributes['type'])?$message->attributes['type']:'';if($type=='100'){echo "selected=selected"; }?> value="100" >action跳转</option>
                <option <?php $type= !empty($message->attributes['type'])?$message->attributes['type']:'';if($type=='101'){echo "selected=selected"; }?> value="101" >包名跳转</option>
                <option <?php $type= !empty($message->attributes['type'])?$message->attributes['type']:'';if($type=='102'){echo "selected=selected"; }?> value="102" >Uri跳转</option>
                <!--<option  value="96" >本地播放</option>-->
                <option <?php $type= !empty($message->attributes['type'])?$message->attributes['type']:'';if($type=='97'){echo "selected=selected"; }?> value="97" >二维码</option>
                <option <?php $type= !empty($message->attributes['type'])?$message->attributes['type']:'';if($type=='98'){echo "selected=selected"; }?> value="98" >其他</option>
            </select>
        </td>
    </tr>
 
    <tr>
        <td width="100" align="center">站点：</td>
        <td>
               <?php

          $uid = $_SESSION['userid'];
        $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 4  left join yd_ver_worker as c on c.workid=b.id where c.type = 1 and  c.uid=$uid group
 by a.id";
        $st = SQLManager::QueryAll($sql);
	
         if($_SESSION['auth']=='1' || empty($st)){ ?>    
	<select name="gid" id="gid" class="form-input w300">
                <option value="0">--请选择--</option>
                <?php
                $sql = "select id,name from yd_ver_station";
                $res = SQLManager::queryAll($sql);
                if (!empty($res)) {?>
                    <?php
                    foreach ($res as $k => $v) {
                        ?>
                        <option value="<?php echo $v['id']; ?>" <?php if($v['id']==$message->attributes['gid']){echo 'selected=selected';}?>><?php echo $v['name']; ?></option>
                    <?php } ?>
                <?php }?>

            </select>
	 <?php }else{ ?>
                <select id="gid" name="gid" class = "form-input w200" >
			<option>请选择</option>
			<?php foreach($st as $k => $v){ ?>
				<option value = "<?php echo $v['id']; ?>" <?php if($v['id']==$message->attributes['gid']){echo 'selected=selected';}?>><?php echo $v['name']; ?></option>
			<?php } ?>
		</select>
        <?php  } ?>
        </td>
    </tr>
       <tr id="show" style="display:none">
        <td width="100" align="center">牌照方：</td>
        <td>
            <select name="cp" class="form-input w300" id="cp">
                <option value="0">请选择</option>
                <option <?php $cp= !empty($message->attributes['cp'])?$message->attributes['cp']:'';if($cp=='1'){echo "selected=selected"; }?> value="1">华数客户端</option>
                <option <?php $cp= !empty($message->attributes['cp'])?$message->attributes['cp']:'';if($cp=='2'){echo "selected=selected"; }?> value="2">百视通客户端</option>
                <option <?php $cp= !empty($message->attributes['cp'])?$message->attributes['cp']:'';if($cp=='3'){echo "selected=selected"; }?> value="3">未来电视</option>
                <option <?php $cp= !empty($message->attributes['cp'])?$message->attributes['cp']:'';if($cp=='4'){echo "selected=selected"; }?> value="4">南传</option>
                <option <?php $cp= !empty($message->attributes['cp'])?$message->attributes['cp']:'';if($cp=='7'){echo "selected=selected"; }?> value="7">银河</option>
            </select>
        </td>
    </tr>
    <tr class="utp" style="display:none">
        <td width="100" align="center">页面类型</td>
        <td><select name="uType" class="form-input w300" id="uType">
                <option value="0">请选择</option>
                <option  value="4" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='4'){echo "selected=selected"; }?>>海报专题</option>
        	<option  value="13" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='13'){echo "selected=selected"; }?>>排行榜专题</option>
        	<option  value="17" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='17'){echo "selected=selected"; }?>>自定义专题</option>
                <option  value="2" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='2'){echo "selected=selected"; }?>>海报栏目</option>
                <option  value="15" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='15'){echo "selected=selected"; }?>>视频栏目</option>
                <option  value="7" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='7'){echo "selected=selected"; }?>>竖图单片详情页</option>
                <option  value="8" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='8'){echo "selected=selected"; }?>>多集数字详情页</option>
                <option  value="9" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='9'){echo "selected=selected"; }?>>多集标题详情页</option>
                <option  value="10" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='10'){echo "selected=selected"; }?>>横图单片详情页</option>
                <option  value="1" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='1'){echo "selected=selected"; }?>>搜索</option>
                <option  value="6" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='6'){echo "selected=selected"; }?>>历史</option>
                <option  value="5" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='5'){echo "selected=selected"; }?>>收藏</option>
                <option  value="11" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='11'){echo "selected=selected"; }?>>设置</option>
                <option  value="16" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='16'){echo "selected=selected"; }?>>本地播放</option>
                <option  value="12" <?php $uType= !empty($message->attributes['uType'])?$message->attributes['uType']:'';if($uType=='12'){echo "selected=selected"; }?>>壁纸</option>
            </select></td>
    </tr>
    <tr class="act" style="display:none">
        <td width="100" align="center">action：</td>
        <td><input type="text" name="action" id="action" value="<?php echo !empty($message->attributes['action'])?$message->attributes['action']:''?>" class="form-input"></td>
    </tr>
    <tr  class="act" style="display:none">
        <td width="100" align="center">param：</td>
        <td><input type="text" name="param" id="param" value="<?php echo !empty($message->attributes['param'])?$message->attributes['param']:''?>" class="form-input"></td>
    </tr>
    <tr  class="upvid" style="display:none">
        <td width="100" align="center">vid：</td>
        <td><input type="text" id="upvid" name="upvid" value="<?php echo !empty($message->attributes['vid'])?$message->attributes['vid']:''?>" class="form-input"></td>
    </tr>
    <tr style="display:none" class="pic">
        <td width="100" align="center">pic：</td>
        <td><input type="text" name="pic" id="pic" value="<?php echo !empty($message->attributes['pic'])?$message->attributes['pic']:''?>" class="form-input w400"></td>
    </tr>
    <tr>
        <td width="100" align="center">内容：</td>
        <td><textarea name="info" class="form-input w400" style="height:200px;resize: none;"><?php echo !empty($message->attributes['info'])?$message->attributes['info']:''?></textarea></td>
    </tr>
    <tr>
        <td width="100" align="center">有效期</td>
        <td><input type="text" name="firstTime" id="firstTime" value="<?php $first=!empty($message->attributes['firstTime'])?$message->attributes['firstTime']:''; if(!empty($first)){echo date("Y-m-d",$first);}?>" class="form-input w100">--<input type="text" name="endTime" id="endTime" value="<?php $end=!empty($message->attributes['endTime'])?$message->attributes['endTime']:''; if(!empty($end)){echo date("Y-m-d",$end);}?>" class="form-input w100"></td>
    </tr>
    <tr>
        <td align="center" colspan="2">
            <input style="width:80px;height:30px;padding:0px" type="submit" value="保存信息" class="btn save">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input style="width:80px;height:30px;padding:0px" type="button" value="取消" class="gray" onclick="window.location.href='<?php echo $this->get_url('content','msgindex',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>'">
        </td>
    </tr>
</table>
    <table style="width:900px;" class="mtable mt10" cellpadding="10" cellspacing="0">
        <tr>
            <th style="background: #A3BAD5;height:30px;" colspan="7">审核纪录</th>
        </tr>
        <tr>
            <td>审核工作流</td>
            <td>审核人</td>
            <td>审核时间</td>
            <td>审核消息</td>
        </tr>
        <?php
        $bind_id = !empty($_REQUEST['id'])?$_REQUEST['id']:'0';
        $res = $this->GetReviewInfo(1,$bind_id);
        if(!empty($res)){
            ?>
            <?php
            foreach ($res as $k => $v) {
                ?>
                <tr class="reject">
                    <td><?php echo $v['review_times']; ?>审</td>
                    <td><?php echo $v["username"]; ?></td>
                    <td><?php echo date("Y-m-d H:i:s", $v["add_time"]); ?></td>
                    <td><?php echo $v["message"]; ?></td>
                </tr>
                <?php
            }?>


        <?php }
        ?>
    </table>
</form>
<script>

    $('#firstTime,#endTime').datetimepicker({
        lang:'ch',
        validateOnBlur:false,
        timepicker:false,
        format:'Y-m-d',
        formatDate: 'Y-m-d',
    });

   function check(){
   // $('.save').click(function(){
        var G = {};
        var first = $('input[name=firstTime]').val();
        if (empty(first)) {
            layer.alert("请填写有效期！");
            return false;
        }
        var timeend = $('input[name=endTime]').val();
        if (empty(timeend)) {
            layer.alert("请填写有效期！");
            return false;
        }
        var stationId=$("#gid").val();//选中的站点
        if(empty(stationId)){
            layer.alert("请选择站点");
            return false;
        }
        G.stationId=stationId;
        G.firstTime=first;
        G.endTime=timeend;
	//console.log(G);return false;
        $.post('/version/content/message.html?mid=<?php echo $_REQUEST['mid']?>',G,function(d){
            if(d== 321){
                layer.alert("添加失败");
                return false;
            }
            return true;
        },'json')
    //})

    }

    $(function(){
        aa();
    })
    function aa(){
        var zhi = $('#type').val();
        switch(zhi){
            case '1':
                $('#show').hide();
                $('.act').hide();
                $('.utp').show();
                $('.upvid').show();
                break;
            case '2':
                $('#show').hide();
                $('.utp').hide();
                $('.upvid').hide();
                $('.act').show();
                break;
            case '3':
                $('#show').show();
                $('.utp').hide();
                $('.upvid').hide();
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
                $('.utp').hide();
                $('.upvid').hide();
                $('.act').show();
                break;
        }

    }
</script>

