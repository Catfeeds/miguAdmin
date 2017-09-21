<?php
    $criteria=new CDbCriteria;
    $stationId=array();
    $has=VerAddress::model()->findAll();
    foreach($has as $k){
        $stationId[]=$k['stationId'];//已经配置过IP的站点
    }
    $criteria->addNotInCondition('id',$stationId);
    $station=VerStation::model()->findAll($criteria);
?>
<form action="' method="post" enctype="multipart/form-data">
<table style="width:900px;" class="mtable mt10" cellpadding="10" cellspacing="0">
    <tr>
        <td align="center">选择站点:</td>
        <td>
            <select onchange="getStationId()" class="form-input w200 station" name="station" id="station">
                <option value="0">请选择</option>
		<?php foreach($station as $v):?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                <?php endforeach;?>
            </select>
        </td>
    </tr>
    <tr class="set">
        <td align="center">站点ID:</td>
        <td class="showStationId"></td>
    </tr>
    <tr>
        <td align="center">web服务器IP:</td>
        <td>
            <input type="text" value="" name='web' class="form-input w400" placeholder="请输入web服务器IP">
        </td>
    </tr>
    <tr>
        <td align="center">图片服务器IP:</td>
        <td>
            <input type="text" value="" name='img' class="form-input w400" placeholder="请输入图片服务器IP">
        </td>
    </tr>
    <tr>
	<td colspan="2" align="center">
		<input type="button" class="btn add" value="保存">
		<input type="button" class="btn cancel" value="取消">
	</td>
    </tr>
</table>
</form>
<script>
    function getStationId(){
        var stationId=$(".station option:selected").val();//选择的站点id
        $(".showStationId").html("");
	$(".showStationId").html(stationId);
	$.getJSON("/version/station/getinfo.html?mid=1",{stationId:stationId},function(data){
		$(".province").html("");
		$.each(data,function(v,k){
                $(".set").after("<tr class='province'><td align='center'>省市</td><td>"+ k.name+"<input type='checkbox' name='code' value='"+k.Code+"' style='margin-left:120px'>选择省市</td></tr>");
            })
        })
    }
	$(".add").click(function(){
        var web=$("input[name='web']").val();
        var img=$("input[name='img']").val();
	var name=$(".station option:selected").text();
	var stationId=$(".station option:selected").val();
        var code=[];
	var G={};
	$('input[name="code"]:checked').each(function(){
            code.push($(this).val());
        })
        if(empty(web)){
            layer.alert('web服务器IP不能为空',{icon:0});
            return false;
        }
        if(empty(img)){
            layer.alert('图片服务器IP不能为空',{icon:0});
            return false;
        }
        if(code.length==0){
            layer.alert('请选择省市',{icon:0});
            return false;
        }
	G.web=web;
        G.img=img;
        G.stationId=stationId;
        G.code=code;
        G.name=name;
	//console.log(G);return false;
        $.post('/version/station/doaddressadd?mid=1',G,function(d){
            if(d.code== 200){
                alert('添加成功');
                window.history.go(-1);
            }else{
                layer.close(load);
                layer.alert(d.msg);
            }
        },'json')
    })
</script>
