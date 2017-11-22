<style>
.mtable td{
	padding:5px;
}
</style>
<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<form action="" method="post">

<table style="width:900px;" class="mtable mt10" cellpadding="10" cellspacing="0">
         <tr>
    	<th style="background: #A3BAD5;height:30px;" colspan="7">编辑工作流</th>
    </tr>
        <input type="hidden" name="wid" value="<?php echo $work->attributes['id']?>">
        <input type="hidden" name="flag" value="<?php echo $work->attributes['flag']?>">
        <input type="hidden" name="adminLeftOneName" value="<?php echo $adminLeftOneName;?>">
        <input type="hidden" name="adminLeftTwoName" value="<?php echo $adminLeftTwoName;?>">
        <input type="hidden" name="adminLeftOne" value="<?php echo $adminLeftOne;?>">
        <input type="hidden" name="adminLeftTwo" value="<?php echo $adminLeftTwo;?>">
        <tr>
            <th colspan="<?php if($work->attributes['flag']==3){echo '6';}else{echo '4';}?>" align="left"><b>任务信息</b></th>
        </tr>
        <tr>
            <td>任务名称</td>
            <td><input type="text" class="form-input w300" name="workname" value="<?php echo $work->attributes['name']?>"></td>
            <td>牌照方</td>
            <td>
                <select name="cp" id="cp" class="form-input w300">
                    <option value="0">--请选择--</option>
                    <option <?php $cp=$work->attributes['cp'];if($cp=='642001'){echo "selected=selected"; }?> value="642001">华数</option>
                    <option <?php $cp=$work->attributes['cp'];if($cp=='BESTVOTT'){echo "selected=selected"; }?> value="BESTVOTT">百视通</option>
                    <option <?php $cp=$work->attributes['cp'];if($cp=='ICNTV'){echo "selected=selected"; }?> value="ICNTV">未来电视</option>
                    <option <?php $cp=$work->attributes['cp'];if($cp=='youpeng'){echo "selected=selected"; }?> value="youpeng">南传</option>
                    <option <?php $cp=$work->attributes['cp'];if($cp=='HNBB'){echo "selected=selected"; }?> value="HNBB">芒果</option>
                    <option <?php $cp=$work->attributes['cp'];if($cp=='CIBN'){echo "selected=selected"; }?> value="CIBN">国广</option>
                    <option <?php $cp=$work->attributes['cp'];if($cp=='YGYH'){echo "selected=selected"; }?> value="YGYH">银河</option>
			<option <?php $cp=$work->attributes['cp'];if($cp=='poms'){echo "selected=selected"; }?> value="poms">咪咕</option>
                </select>
            </td>
            <?php if($work->attributes['flag']==3){echo '<td colspan="2"></td>';}?>
        </tr>
        <tr>
            <td >流模式：</td>
            <td colspan="3">
                <select name="model" id="xuanze" onchange="checks()" class="form-input w300">
                    <option <?php $cp=$work->attributes['type'];if($cp=='0'){echo "selected=selected"; }?> value="0">零审</option>
                    <option <?php $cp=$work->attributes['type'];if($cp=='1'){echo "selected=selected"; }?> value="1">一审</option>
                    <option <?php $cp=$work->attributes['type'];if($cp=='2'){echo "selected=selected"; }?> value="2">二审</option>
                    <option <?php $cp=$work->attributes['type'];if($cp=='3'){echo "selected=selected"; }?> value="3">三审</option>
                    <option <?php $cp=$work->attributes['type'];if($cp=='4'){echo "selected=selected"; }?> value="4">四审</option>
                    <option <?php $cp=$work->attributes['type'];if($cp=='5'){echo "selected=selected"; }?> value="5">五审</option>
                </select>
            </td>
            <?php if($work->attributes['flag']==3){echo '<td colspan="6"></td>';}?>
        </tr>
        <?php
        
            if($work->attributes['flag']=='3'){?>
                <tr>
                    <td>已选屏幕：</td>
                    <td>
                    <select name="station" id="station" onchange="stationGuide(this)" class="form-input w300">
                        <?php
                        $sql = "select id,name from yd_ver_station";
                        $res = SQLManager::queryAll($sql);
                        if (!empty($res)) {?>
                            <?php
                            foreach ($res as $k => $v) {
                                ?>
                                <option value="<?php echo $v['id']; ?>" <?php if($v['id']==$work->attributes['stationId']){echo 'selected=selected';}?>><?php echo $v['name']; ?></option>
                            <?php } ?>
                        <?php }?>

                    </select>
                    </td>
                    <?php if($work->attributes['flag']==3){echo '<td colspan="4"></td>';}?>
                </tr>
        <?php }else if($work->attributes['flag']=='2' || $work->attributes['flag']=='6' ){ 
                 ?>
                <tr>
                    <td>已选站点：</td>
                    <td>
                    	<?php   if($work->attributes['stationId'] == 7 && $work->attributes['flag']=='6'){
                        	echo "通用专题<input type='hidden' name='station' value='7'>";
						}else{ ?>
                    <select name="station" id="station" class="form-input w300">
                        <?php
                        
                      
                        $sql = "select id,name from yd_ver_station";
                        $res = SQLManager::queryAll($sql);
                        if (!empty($res)) {?>
                            <?php
                            foreach ($res as $k => $v) {
                                ?>
                                <option value="<?php echo $v['id']; ?>" <?php if($v['id']==$work->attributes['stationId']){echo 'selected=selected';}?>><?php echo $v['name']; ?></option>
                        	
                            <?php } ?>
                        <?php }?>
						
                    </select>
                    
                    <?php } ?>
                    </td>
                </tr>
             <?php
              }else if($work->attributes['flag'] == '5' || $work->attributes['flag'] == '4'){
                $sql = "select id,name from yd_ver_station";
                $res = SQLManager::queryAll($sql);
                if (!empty($res)) {
                     ?>
                     <tr>
            <td>选择站点</td>
            <td>
                <select name="station" id="station" class="form-input w300">
                    <option value="0">--请选择--</option>
                    <?php
                    foreach ($res as $k => $v) {
                        ?>
                         <option value="<?php echo $v['id']; ?>" <?php if($v['id']==$work->attributes['stationId']){echo 'selected=selected';}?>><?php echo $v['name']; ?></option>
                    <?php } ?>
                </select>
            </td>
    </tr>
	<?php
                   }
             }elseif($work->flag==8) {
                $sql = "select id,name from yd_ver_station";
                $res = SQLManager::queryAll($sql);
                if (!empty($res)) {?>
                    <tr>
                        <td>选择站点</td>
                        <td>
                            <select name="station" id="station" class="form-input w300">
                                <option value="0">--请选择--</option>
                                <?php
                                foreach ($res as $k => $v) {
                                    ?>
                                    <option value="<?php echo $v['id']; ?>" <?php if($v['id']==$work->attributes['stationId']){echo 'selected=selected';}?>><?php echo $v['name']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                <?php
                   }
             }

        ?>

        <?php $sign = $work->attributes['flag'];?>
        <tr>
            <th colspan="<?php if($work->attributes['flag']==3){echo '6';}else{echo '4';}?>" align="left"><b>编辑节点配置</b></th>
        </tr>
        <tr class="editer">
            <td colspan="2" align="center">人员</td>
            <td colspan="2" align="center">操作</td>
            <?php
                if($sign == 3){echo '<td>对应导航</td>';}
            ?>
        </tr>
        <?php
        $station_id = $work->attributes['stationId'];
        if(!empty($worker[1])){

            foreach($worker[1] as $k=>$v){
                $auth_ids_res = VerDataAuth::model()->find("station_id=$station_id and user_id={$v['uid']} and auth_type=1");
                ?>
                <tr >
                    <td colspan='2' align='center'>
                        <input type='hidden' name="editadd[<?php echo $k?>]" value="<?php echo $v['id']?>">
                        <?php if(!empty($auth_ids_res)){?>
                        <input type="hidden" name="editadd_auth_ids[<?php echo $k?>]" value="<?php echo $auth_ids_res->attributes['auth_ids'];?>">
                    <?php }?>
                        <?php echo $v['username']?>
                    </td>
                    <td colspan='2'  align='center' class='del' onclick='del(this)'>删除</td>
                    <?php if($sign == 3){
                        echo "<td colspan='2'>";
                        $guide_res = VerScreenGuide::model()->findAll("gid=$station_id");
                        if(!empty($guide_res) && !empty($auth_ids_res)) {
                            $selected_guide = explode(',', $auth_ids_res->attributes['auth_ids']);
                            foreach ($guide_res as $a => $b) {
                                if (in_array($b->attributes['id'], $selected_guide)) {
                                    ?>
                                    <input type="checkbox" name="guide" id="" onclick="change_guide_auth(this)"
                                           class="guide_checkbox" checked="checked"
                                           value="<?php echo $b->attributes['id'] ?>">
                                <?php } else {
                                    ?>
                                    <input type="checkbox" name="guide" id="" onclick="change_guide_auth(this)"
                                           class="guide_checkbox" value="<?php echo $b->attributes['id'] ?>">

                                <?php } ?>
                                <span><?php echo $b->attributes['title']; ?></span>
                                <?php
                            }
                        }
                        echo "</td>";
                    }
                    ?>
                </tr>
                <?php
            }
        }
        ?>
        <tr class="editadd" id="editadd">
            <td colspan="2" align="center" class="add" onclick="add(this)">添加</td>
            <td colspan="<?php if($work->attributes['flag']==3){echo '4';}else{echo '2';}?>" align="center"></td>
        </tr>
        <?php
            if(!empty($review)){
                foreach($review as $key=>$val){
                    ?>
                    <tr class="first first-<?php echo $key?>">
                        <th colspan="<?php if($work->attributes['flag']==3){echo '6';}else{echo '4';}?>" align="left"><b><?php echo $key?>审节点配置</b></th>
                    </tr>
                    <tr class='first'>
                        <td colspan="2" align="center">人员</td>
                        <td colspan="2" align="center">操作</td>
                        <?php
                        if($sign == 3){echo '<td>对应导航</td>';}
                        ?>
                    </tr>
                    <?php
                        foreach($val as $k=>$v){
                            $auth_ids_res = VerDataAuth::model()->find("station_id=$station_id and user_id={$v['uid']} and auth_type=1");
                            ?>
                            <tr class='first' >
                                <td colspan='2' align='center'>
                                    <input type='hidden' name="first-<?php echo $key?>[]" value="<?php echo $v['id']?>">
                                    <?php if(!empty($auth_ids_res)){?>
                                    <input type="hidden" name="first-<?php echo $key?>_auth_ids[]" value="<?php echo $auth_ids_res->attributes['auth_ids'];?>">
                                <?php } ?>
                                    <?php echo $v['username']?>
                                </td>
                                <td colspan='2'  align='center' class='del'  onclick='del(this)'>删除</td>

                            <?php if($sign == 3){
                                echo "<td colspan='2'>";
                                $guide_res = VerScreenGuide::model()->findAll("gid=$station_id");
                                if(!empty($guide_res) && !empty($auth_ids_res)) {
                                    $selected_guide = explode(',',$auth_ids_res->attributes['auth_ids']);

                                    foreach ($guide_res as $a=>$b){
                                        if(in_array($b->attributes['id'],$selected_guide)){?>
                                            <input type="checkbox" name="guide" id="" onclick="change_guide_auth(this)" class="guide_checkbox" checked="checked"  value="<?php echo $b->attributes['id']?>">
                                        <?php }else{?>
                                            <input type="checkbox" name="guide" id="" onclick="change_guide_auth(this)" class="guide_checkbox" value="<?php echo $b->attributes['id']?>">

                                        <?php } ?>
                                        <span><?php echo $b->attributes['title'];?></span>
                                        <?php
                                    }
                                }
                                echo "</td>";
                            }

                            ?>
                            </tr>
                            <?php
                        }
                    ?>

                    <tr class='first' id="first-<?php echo $key?>" >
                        <td colspan="2" align="center" class="add" onclick="add(this)">添加</td>
                        <td colspan="<?php if($work->attributes['flag']==3){echo '4';}else{echo '2';}?>" align="center"></td>
                    </tr>
                <?php
                }
            }

        ?>

        <tr>
            <th colspan="<?php if($work->attributes['flag']==3){echo '6';}else{echo '4';}?>" align="left"><b>发布节点配置</b></th>
        </tr>
        <tr>
            <td colspan="2" align="center">人员</td>
            <td colspan="2" align="center">操作</td>
            <?php
            if($sign == 3){echo '<td>对应导航</td>';}
            ?>
        </tr>
        <?php
        if(!empty($worker[2])){
            foreach($worker[2] as $k=>$v){
                $auth_ids_res = VerDataAuth::model()->find("station_id=$station_id and user_id={$v['uid']} and auth_type=1");
                ?>
                <tr class="fb">
                    <td colspan='2' align='center'>
                        <input type='hidden' name="fb[<?php echo $k?>]" value="<?php echo $v['id']?>">
                        <?php echo $v['username']?>
                        <?php if(!empty($auth_ids_res)){?>
                        <input type="hidden" name="fb_auth_ids[<?php echo $k?>]" value="<?php echo $auth_ids_res->attributes['auth_ids'];?>">
                    <?php } ?>
                    </td>
                    <td colspan='2'  align='center' class='del' onclick='del(this)'>删除</td>
                    <?php if($sign == 3){
                        echo "<td colspan='2'>";
                        $guide_res = VerScreenGuide::model()->findAll("gid=$station_id");
                    if(!empty($guide_res) && !empty($auth_ids_res)) {
                        $selected_guide = explode(',', $auth_ids_res->attributes['auth_ids']);
                        foreach ($guide_res as $a => $b) {
                            if (in_array($b->attributes['id'], $selected_guide)) {
                                ?>
                                <input type="checkbox" name="guide" id="" onclick="change_guide_auth(this)"
                                       class="guide_checkbox" checked="checked"
                                       value="<?php echo $b->attributes['id'] ?>">
                            <?php } else {
                                ?>
                                <input type="checkbox" name="guide" id="" onclick="change_guide_auth(this)"
                                       class="guide_checkbox" value="<?php echo $b->attributes['id'] ?>">

                            <?php } ?>
                            <span><?php echo $b->attributes['title']; ?></span>
                            <?php
                        }
                    }
                        echo "</td>";
                    }
                    ?>
                </tr>
                <?php
            }
        }
        ?>

        <tr id="fb">
            <td colspan="2" align="center"  class="add" onclick="add(this)">添加</td>
            <td colspan="<?php if($work->attributes['flag']==3){echo '4';}else{echo '2';}?>" align="center"></td>
        </tr>
        <tr>
            <th colspan="<?php if($work->attributes['flag']==3){echo '6';}else{echo '4';}?>" align="left"><b>浏览权限配置</b></th>
        </tr>
        <tr>
            <td colspan="2" align="center">人员</td>
            <td colspan="2" align="center">操作</td>
            <?php
                if($sign == 3){echo '<td>对应导航</td>';}
            ?>
        </tr>
        <?php
        if(!empty($worker[3])){
            foreach($worker[3] as $k=>$v){
                $auth_ids_res = VerDataAuth::model()->find("station_id=$station_id and user_id={$v['uid']} and auth_type=1");
                ?>
                <tr class="see">
                    <td colspan='2' align='center'>
                        <input type='hidden' name="see[<?php echo $k?>]" value="<?php echo $v['id']?>">
                        <?php echo $v['username'];?>
                        <?php if(!empty($auth_ids_res)){?>
                        <input type="hidden" name="see_auth_ids[<?php echo $k?>]" value="<?php echo $auth_ids_res->attributes['auth_ids'];?>">
                    <?php }?>
                    </td>
                    <td colspan='2'  align='center' class='del'onclick='del(this)'>删除</td>

                <?php if($sign == 3){
                    echo "<td colspan='2'>";
                    $guide_res = VerScreenGuide::model()->findAll("gid=$station_id");
                    if(!empty($guide_res) && !empty($auth_ids_res)) {
                        $selected_guide = explode(',', $auth_ids_res->attributes['auth_ids']);
                        foreach ($guide_res as $a => $b) {
                            if (in_array($b->attributes['id'], $selected_guide)) {
                                ?>
                                <input type="checkbox" name="guide" id="" onclick="change_guide_auth(this)"
                                       checked="checked" class="guide_checkbox"
                                       value="<?php echo $b->attributes['id'] ?>">
                            <?php } else {
                                ?>
                                <input type="checkbox" name="guide" id="" onclick="change_guide_auth(this)"
                                       class="guide_checkbox" value="<?php echo $b->attributes['id'] ?>">

                            <?php } ?>
                            <span><?php echo $b->attributes['title']; ?></span>
                            <?php
                        }
                    }
                    echo "</td>";
                }
                ?>
                </tr>
                <?php
            }
        }
        ?>
        <tr id="see">
            <td colspan="2" align="center"  class="add" onclick="add(this)">添加</td>
            <td colspan="<?php if($work->attributes['flag']==3){echo '4';}else{echo '2';}?>" align="center"></td>
        </tr>
        <tr>
            
            <td colspan="4" align="center">
                <input style="width:100px;height:30px;padding:0px;float:none" type="submit" value="添加/保存用户" class="btn user_add">
                <input style="width:100px;height:30px;padding:0px;float:none" type="button" value="返回列表" class="gray" onclick="window.location.href='<?php echo $this->get_url('station','indexlist',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>'">
            </td>
            <td colspan="<?php if($work->attributes['flag']==3){echo '4';}else{echo '2';}?>" align="center"></td>
        </tr>
    </table>
</form>
<script>

    function stationGuide(obj)
    {
        var station_id = $(obj).val();
        var mid = <?php echo $this->mid;?>;
        $.ajax
        ({
            type:'get',
            url:'/version/screen/getStationGuide/mid/'+mid+'/stationId/'+station_id,
            success:function(data)
            {
                data = eval(data);
                $(".guide_checkbox").next('span').remove();
                $(".guide_checkbox").remove();
                $.each(data,function(i)
                {
                    $(".del").after
                    (
                        '<input type="checkbox" name="guide" class="guide_checkbox" onclick="change_guide_auth(this)" value="'+data[i]['id']+'">'+
                        '<span>'+data[i]['title']+'</span>'
                    );
                });
            }
        });
    }

   function change_guide_auth(obj)
   {
       var guide_id = '';
//       $(obj).parent('td').children('input[name="guide"]:checked').each(function()
       $(obj).parent('td').children('.guide_checkbox:checked').each(function()
       {
           guide_id += $(this).val()+',';
       });
       guide_id = guide_id.substring(0, guide_id.length - 1);
       $(obj).parent().parent().children().eq(0).children().eq(1).val(guide_id);
   }



	var num = $('#xuanze').val();
	var x;
	var flag = <?php echo $work->attributes['flag'];?>;
	for(var i=num;i>0;i--){
        x = '#first-'+i;
        if($(x).length == 0){
            if(flag == 3){
                $('.editadd').after(
                    "<tr class='first first-"+i+"'>" +
                        "<th colspan='6' align='left'>"+i+"审节点配置</th>" +
                    "</tr>" +
                    "<tr class='first' >" +
                        "<td colspan='2' align='center'>人员</td>" +
                        "<td colspan='2' align='center'>操作</td>" +
                        "<td colspan='1'>对应导航</td>" +
                    "</tr>" +
                    "<tr class='first' id='first-"+i+"'>" +
                        "<td colspan='2' align='center' class='add' onclick='add(this)'>添加</td>" +
                        "<td colspan='2' align='center'></td>" +
                        "<td colspan='1' align='center'></td>" +
                    "</tr>"
                )
            }else{
                $('.editadd').after(
                    "<tr class='first first-"+i+"'>" +
                        "<th colspan='4' align='left'>"+i+"审节点配置</th>" +
                    "</tr>" +
                    "<tr class='first' >" +
                        "<td colspan='2' align='center'>人员</td>" +
                        "<td colspan='2' align='center'>操作</td>" +
                    "</tr>" +
                    "<tr class='first' id='first-"+i+"'>" +
                        "<td colspan='2' align='center' class='add' onclick='add(this)'>添加</td>" +
                        "<td colspan='2' align='center'></td>" +
                    "</tr>"
                )
            }

        }
	}
    function checks(){
        var num = $('#xuanze').val();
        $('.first').remove();
        var flag = <?php echo $work->attributes['flag'];?>;
        for(var i=num;i>0;i--){
            if(flag == 3){
                $('.editadd').after(
                    "<tr class='first first-"+i+"'>" +
                        "<th colspan='6' align='left'>"+i+"审节点配置</th>" +
                    "</tr>" +
                    "<tr class='first' >" +
                        "<td colspan='2' align='center'>人员</td>" +
                        "<td colspan='2' align='center'>操作</td>" +
                        "<td colspan='1'>对应导航</td>" +
                    "</tr>" +
                    "<tr class='first' id='first-"+i+"'>" +
                        "<td colspan='2' align='center' class='add' onclick='add(this)'>添加</td>" +
                        "<td colspan='2' align='center'></td>" +
                        "<td colspan='1' align='center'></td>" +
                    "</tr>"
                )
            }else{
                $('.editadd').after("<tr class='first first-"+i+"'><th colspan='4' align='left'>"+i+"审节点配置</th></tr><tr class='first' ><td colspan='2' align='center'>人员</td><td colspan='2' align='center'>操作</td></tr><tr class='first' id='first-"+i+"'><td colspan='2' align='center' class='add' onclick='add(this)'>添加</td><td colspan='2' align='center'></td></tr>")
            }

        }
    }

    $('.user_add').click(function(){
        var workname = $('input[name=workname]').val();
        var model = $('#xuanze').val();
        if(empty(workname)){
            layer.alert('请输入任务名');
            return false;
        }
        if(empty(cp)){
            layer.alert('请选择牌照方');
            return false;
        }
    })

    function add(obj){
        fu = $(obj).parent().attr('id');
        var p = 1;
        <?php if($work->attributes['flag'] == '3'){echo 'var stationFlag=1;';}else{echo 'var stationFlag=0;';}?>
        if(stationFlag){
            var stationId = $('#station').val();
            if(empty(stationId)){
                layer.alert('请选择屏幕！');
                return false;
            }
        }else{
            var stationId = 0;
        }
        $.getJSON("<?php echo $this->get_url('station','ajaxlist')?>",{page:p,fu:fu,stationId:stationId},function(d){
            if(d.code==200){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['730px', '550px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(msg);
            }
        })
    }
    $(document).on('click','.btnall',function(){
        $(".content :checkbox").prop("checked", true);
    })
    $(document).on('click','.btnno',function(){
        $(".content :checkbox").prop("checked", false);
    })

    $(document).on('click','.btn_add',function(){
        var ids = {};
        var orders={};
        var els =document.getElementsByName("adminid");
        for (var i = 0, j = els.length; i < j; i++){
            ids[i]=els[i].value;
        }
        var order =document.getElementsByName("username");
        for (var i = 0, j = order.length; i < j; i++){
            orders[i]=order[i].value;
        }

        //var c = $.extend(ids, orders);
        var str = '#'+fu;
        for(var i=0;i<count(ids);i++){
            var li = "<tr><td colspan='2' align='center'><input type='hidden' name="+fu+'[]'+" value="+ids[i]+">"+orders[i]+"</td><td colspan='2'  align='center' class='del' onclick='del(this)'>删除</td></tr>";
            $(str).before(li);
        }

        $('.over').hide();

    })

    $('.close').click(function(){
        $('.over').hide();
    })

    function del(obj){
        if(confirm('你确定删除工作流中的用户吗？')){
            $(obj).parent().remove();
        }
    }


    function count(obj){
        var objType = typeof obj;
        if(objType == "string"){
            return obj.length;
        }else if(objType == "object"){
            var objLen = 0;
            for(var i in obj){
                objLen++;
            }
            return objLen;
        }
        return false;
    }
</script>


