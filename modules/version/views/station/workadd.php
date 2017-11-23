<style>
.mtable td{
	padding:5px;
}
    /*.guide_td{display: none;}*/
    /*.guide_checkbox{display: none;}*/
</style>
<?php
    $adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
    $adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
    $adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
    $adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<form action="" method="post">
    <input type="hidden" name="flag" value="<?php echo !empty($_REQUEST['flag'])?$_REQUEST['flag']:'0';?>">
     <input type="hidden" name="adminLeftOneName" value="<?php echo $adminLeftOneName;?>">
    <input type="hidden" name="adminLeftTwoName" value="<?php echo $adminLeftTwoName;?>">
    <input type="hidden" name="adminLeftOne" value="<?php echo $adminLeftOne;?>">
    <input type="hidden" name="adminLeftTwo" value="<?php echo $adminLeftTwo;?>">
 
<table style="width:900px;" class="mtable mt10" cellpadding="10" cellspacing="0">
         <tr>
    	<th style="background: #A3BAD5;height:30px;" colspan="7">添加工作流</th>
    </tr>  
        <tr>
            <th colspan="<?php if($_REQUEST['flag']==3){echo '6';}else{echo '4';}?>" align="left"><b>任务信息</b></th>
        </tr>
        <tr>
            <td>任务名称</td>
            <td><input type="text" class="form-input w300" name="workname" value=""></td>
            <td>牌照方</td>
            <td>
                <select name="cp" id="cp" class="form-input w300">
                    <option value="0">--请选择--</option>
                    <option value="642001">华数</option>
                    <option value="BESTVOTT">百视通</option>
                    <option value="ICNTV">未来电视</option>
                    <option value="youpeng">南传</option>
                    <option value="HNBB">芒果</option>
                    <option value="CIBN">国广</option>
                    <option value="YGYH">银河</option>
		    <option value="poms">咪咕</option>
                </select>
            </td>
            <?php if($_REQUEST['flag'] == 3){
                echo ' <td colspan="2"></td>';
            }?>
        </tr>
        <?php
            if($_REQUEST['flag'] == '3') {
		$work_sql = "select stationId from yd_ver_work where flag=3";
                $work_res = SQLManager::queryAll($work_sql);
                foreach ($work_res as $a=>$b){
                    $tmp[] = $b['stationId'];
                }
                $arr = implode(',',$tmp);
                $sql = "select id,name from yd_ver_station where id not in ($arr)";
                $res = SQLManager::queryAll($sql);
                if (!empty($res)) {
                    ?>
        <tr>
            <td>选择屏幕</td>
            <td>
                <select name="station" id="station" class="form-input w300" onchange="stationGuide(this)">
                    <option value="0">--请选择--</option>
                    <?php
                    foreach ($res as $k => $v) {
                        ?>
                        <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                    <?php } ?>
                </select>
            </td>
            <?php if($_REQUEST['flag'] == 3){
                echo ' <td colspan="1"></td>';
            }?>
            <?php if($_REQUEST['flag']==3){echo '<td colspan="4"></td>';}?>
    </tr>
                <?php }
            }else if($_REQUEST['flag'] == '2' || $_REQUEST['flag'] == '6'){
		        $tmp=array();
                $work_sql = "select stationId from yd_ver_work where flag=".$_REQUEST['flag'];
                $work_res = SQLManager::queryAll($work_sql);
                foreach ($work_res as $a=>$b){
                    $tmp[] = $b['stationId'];
                }
                $arr = implode(',',$tmp);
		//var_dump($tmp);die;
		/*if(!empty($tmp)){
                $arr = implode(',',$tmp);
                $sql="select id,name from yd_ver_sitelist where pid=0 and type=0 and id not in($arr)";
		}else{
                $sql="select id,name from yd_ver_sitelist where pid=0 and type=0 ";
		}*/
                $sql = "select id,name from yd_ver_station where id not in ($arr)";
		        $res=SQLManager::queryAll($sql);
                if(!empty($res)){
                       ?>
        <tr>
            <td>选择站点</td>
            <td>
                <select name="station" id="station" class="form-input w300">
                    <option value="0">--请选择--</option>
                    <?php
                    foreach ($res as $k => $v) {
                        ?>
                        <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                        
                        
                        
                    <?php } ?>
                </select>
            </td>
    </tr>
             <?php
                }
             }else if($_REQUEST['flag'] == '5' || $_REQUEST['flag'] == '4'){
                $work_sql = "select stationId from yd_ver_work where flag=".$_REQUEST['flag'];
                $work_res = SQLManager::queryAll($work_sql);
                foreach ($work_res as $a=>$b){
                    $tmp[] = $b['stationId'];
                }
                $arr = implode(',',$tmp);
                $sql = "select id,name from yd_ver_station where id not in ($arr)";
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
                        <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                    <?php } ?>
                    
                 
                </select>
            </td>
    </tr>
	<?php
                   }
             }elseif($_REQUEST['flag']==8){
                $work_sql = "select stationId from yd_ver_work where flag=".$_REQUEST['flag'];
                $work_res = SQLManager::queryAll($work_sql);
                foreach ($work_res as $a=>$b){
                    $tmp[] = $b['stationId'];
                }
		if(!empty($tmp)){
                $arr = implode(',',$tmp);
                $sql = "select id,name from yd_ver_station where id not in ($arr)";
		}else{
		$sql = "select * from yd_ver_station";
		}
                $res = SQLManager::queryAll($sql);
                if (!empty($res)) {?>
                    <tr>
                        <td>选择站点</td>
                        <td>
                            <select name="station" id="station" class="form-input w300" >
                                <option value="0">--请选择--</option>
                                <?php
                                foreach ($res as $k => $v) {
                                    ?>
                                    <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>

                <?php
                   }
             }
        ?>
        <tr>
            <td>流模式：</td>
            <td colspan="3">
                <select name="model" id="xuanze" onchange="checks()" class="form-input w300">
                    <option value="0">零审</option>
                    <option value="1">一审</option>
                    <option value="2">二审</option>
                    <option value="3">三审</option>
                    <option value="4">四审</option>
                    <option value="5">五审</option>
                </select>
            </td>
            <?php if($_REQUEST['flag'] == 3){
                echo ' <td colspan="3"></td>';
            }?>

        </tr>
        <tr>
            <th colspan="<?php if($_REQUEST['flag']==3){echo '6';}else{echo '4';}?>" align="left"><b>编辑节点配置</b></th>
        </tr>
        <tr class="editer ">
            <td colspan="2" align="center">人员</td>
            <td colspan="2" align="center">操作</td>
            <?php if($_REQUEST['flag'] == 3){?>
                <td class="guide_td">勾选对应导航权限</td>
            <?php } ?>
        </tr>
        <tr class="editadd guide" id="editadd">
            <td colspan="2" align="center" class="add" onclick="add(this)">添加</td>
            <td colspan="2" align="center"></td>
            <?php if($_REQUEST['flag'] == 3){
                echo '<td colspan="1"></td>';
            }?>
        </tr>

        <!--<tr class="first first-1">
            <th colspan="4" align="left"><b>1审节点配置</b></th>
        </tr>
        <tr class='first'>
            <td colspan="2" align="center">人员</td>
            <td colspan="2" align="center">操作</td>
        </tr>
        <tr class='first' id="first" >
            <td colspan="2" align="center" class="add" onclick="add(this)">添加</td>
            <td colspan="2" align="center"></td>
        </tr>-->
        <tr>
            <th colspan="<?php if($_REQUEST['flag']==3){echo '6';}else{echo '4';}?>" align="left"><b>发布节点配置</b></th>
        </tr>
        <tr>
            <td colspan="2" align="center">人员</td>
            <td colspan="2" align="center">操作</td>
            <?php if($_REQUEST['flag'] == 3){?>
            <td class="guide_td">勾选对应导航权限</td>
            <?php } ?>
        </tr>
        <tr id="fb" class="guide">
            <td colspan="2" align="center"  class="add" onclick="add(this)">添加</td>
            <td colspan="2" align="center"></td>
            <?php if($_REQUEST['flag'] == 3){
                echo '<td colspan="1"></td>';
            }?>
        </tr>
        <tr>
            <th colspan="<?php if($_REQUEST['flag']==3){echo '6';}else{echo '4';}?>" align="left"><b>浏览权限配置</b></th>
        </tr>
        <tr>
            <td colspan="2" align="center">人员</td>
            <td colspan="2" align="center">操作</td>
            <?php if($_REQUEST['flag'] == 3){?>
                <td class="guide_td">勾选对应导航权限</td>
            <?php } ?>
        </tr>
        <tr id="see" class="guide">
            <td colspan="2" align="center"  class="add" onclick="add(this)">添加</td>
            <td colspan="2" align="center"></td>
            <?php if($_REQUEST['flag'] == 3){
                echo '<td colspan="1"></td>';
            }?>
        </tr>
        <tr>
   
            <td colspan="4" align="center">
                <input style="width:100px;height:30px;padding:0px;float:none" type="submit" value="添加/保存用户" class="btn user_add">
                <input style="width:100px;height:30px;padding:0px;float:none" type="button" value="返回列表" class="gray" onclick="window.location.href='<?php echo $this->get_url('station','indexlist',array('adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>'">
            </td>
            <?php if($_REQUEST['flag'] == 3){
                echo '<td colspan="1"></td>';
            }?>

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
                $(".del").after("<td colspan='1'></td>");
                $.each(data,function(i)
                {
                    $(".del").next().append
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
        $(obj).parent().parent().children().eq(0).children().eq(0).val(guide_id);
    }

    function checks(){
        var num = $('#xuanze').val();
        var flag = <?php echo $_REQUEST['flag'];?>;
        $('.first').remove();
        if(flag == 3){
            for(var i=num;i>0;i--){
                $('.editadd').after
                (
                    "<tr class='first first-"+i+"'>" +
                      "<th colspan='6' align='left'>"+i+"审节点配置</th>" +
                    "</tr>" +
                    "<tr class='first' >" +
                        "<td colspan='2' align='center'>人员</td>" +
                        "<td colspan='2' align='center'>操作</td>" +
                        "<td colspan='1' >勾选对应导航权限</td>" +
                    "</tr>" +
                    "<tr class='first' id='first-"+i+"'>" +
                        "<td colspan='2' align='center' class='add' onclick='add(this)'>添加</td>" +
                        "<td colspan='2' align='center'></td>" +
                        "<td colspan='1' align='center'></td>" +
                    "</tr>"
                )
            }
        }else{
            for(var i=num;i>0;i--){
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

        <?php if($_REQUEST['flag'] == '3'){echo 'var stationFlag=1;';}?>
        if(stationFlag){
            var stationId = $('#station').val();
            if(empty(stationId)){
                layer.alert('请选择屏幕！');
                return false;
            }
        }
    })

    /*$(document).on('click','.add',function(){
        fu = $(this).parent().attr('id');
        var p = 1;
        $.getJSON("<?php //echo $this->get_url('station','ajaxlist')?>",{page:p},function(d){
            if(d.code==200){
                $('.content').empty();
                var list = d.list;
                var li = "<div>用户名称:<input type='text' value='' class='form-input w100'>省市:<input type='text' value='' class='form-input w100'>公司: <input type='text' value='' class='form-input w100'><input type='button' class='search btn' value='查询'></div>";
                li +="<table width='750px'  cellspacing='0' cellpadding='10' class='mtable center'><tr><th>ID</th><th>用户名</th><th>省市</th><th>公司</th><th>权限</th><th>操作</th></tr>";
                $.each(list, function (index, array) { //遍历返回json
                    li +="<tr><td><input type='checkbox' name='adminid' value="+array['id']+"></td><td><input type='text' name='username' value="+array['username']+" ></td><td>"+array['pro']+"</td><td>"+array['company']+"</td><td>--</td><td class='del'>删除</td></tr>";
                });
                li +="</table>";
                li +="<div><input type='button' class='btn btnall' value='全选'><input type='button' class='btn  btnno' value='反选'>";
                li +="<span>共页</span><a>上一页</a><a>下一页</a></div>";
                li +="<input type='button' value='添加' class='btn btn_add'><input type='button' value='取消' class='btn'>";
                $('.content').append(li);
                $('.over').show();
            }else{
                layer.alert(d.msg)
            }
        })
    })*/
    //$(document).off("click").on('click','.add',function(){
    //$('.add').click(function(){
    function add(obj){
        <?php if($_REQUEST['flag'] == '3'){echo 'var stationFlag=1;';}else{echo 'var stationFlag=0;';}?>
        if(stationFlag){
            var stationId = $('#station').val();
            if(empty(stationId)){
                layer.alert('请选择屏幕！');
                return false;
            }
        }else{
            var stationId = 0;
        }

        fu = $(obj).parent().attr('id');
        var p = 1;
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

    /*$(document).on('click','.del',function(){
        $(this).parent().remove();
    })*/

    function del(obj){
       $(obj).parent().remove();
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


