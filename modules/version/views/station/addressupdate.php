<form action="" method="post" enctype="multipart/form-data">
<table style="width:900px;" class="mtable mt10" cellpadding="10" cellspacing="0">
    <tr>
        <td align="center">选择站点:</td>
        <td>
            <select class="form-input w200 station">
                <option value="<?php echo $info->stationId;?>"><?php echo $info->name;?></option>
            </select>
        </td>
    </tr>
    <tr>
        <td align="center">站点ID:</td>
        <td class="showStationId"><?php echo $info->stationId?></td>
    </tr>

	<?php
                $stationId=$info->stationId;
                $province=$info->province;//省份
                $city=$info->city;

                $ptmp=explode("/",$province);
                $ctmp=explode("/",$city);
                for($i=0;$i<count($ptmp);$i++){//地址表中的省份
                    $p_model=Province::model()->findByAttributes(array("provinceCode"=>$ptmp[$i]));
                    $provinceName[$i]=$p_model->provinceName;
                    $provinceCode[$i]=$p_model->provinceCode;
                    $c_model=City::model()->findByAttributes(array("cityCode"=>$ctmp[$i],"provinceId"=>$ptmp[$i]));
                    $cityName[$i]=$c_model->cityName;
                    $cityCode[$i]=$c_model->cityCode;
                }
                for($m=0;$m<count($provinceName);$m++){
                    $newArr[]=array("provinceName"=>$provinceName[$m],"provinceCode"=>$provinceCode[$m],"cityName"=>$cityName[$m],"cityCode"=>$cityCode[$m],"checked"=>"");
                }
                $data=VerStation::model()->findByPk($stationId);//站点下的省份
                $p=$data->province;
                $c=$data->city;
                $p_tmp=explode(" ",$p);
                $c_tmp=explode(" ",$c);

                for($j=0;$j<count($p_tmp);$j++){
                    $pro_tmp=Province::model()->findByAttributes(array("provinceCode"=>$p_tmp[$j]));
                    $proName[$j]=$pro_tmp->provinceName;
                    $proCode[$j]=$pro_tmp->provinceCode;
                    $city_tmp=City::model()->findByAttributes(array("cityCode"=>$c_tmp[$j],"provinceId"=>$p_tmp[$j]));
                    $cName[$j]=$city_tmp->cityName;
                    $cCode[$j]=$city_tmp->cityCode;
                }
                for($n=0;$n<count($proName);$n++){
                    $Arr[]=array("provinceName"=>$proName[$n],"provinceCode"=>$proCode[$n],"cityName"=>$cName[$n],"cityCode"=>$cCode[$n],"checked"=>"");
                }
                for($k=0;$k<count($newArr);$k++){
                    for($l=0;$l<count($Arr);$l++){
                        if($newArr[$k]==$Arr[$l]){
				$Arr[$l]['checked']="checked";
                        }
                    }
                }

		 for($u=0;$u<count($Arr);$u++){
                    echo "<tr><td align='center'>省市</td><td>".$Arr[$u]['provinceName'].$Arr[$u]['cityName']."<input name='city' style='margin-left: 120px;' type='checkbox' value='".$Arr[$u]['provinceCode']."-".$Arr[$u]['cityCode']."'".$Arr[$u]['checked'].">选择省市</td></tr>";
                }
            ?>

    <tr>
        <td align="center">web服务器IP:</td>
        <td>
            <input name="web" class="form-input w400" type="text" value="<?php echo $info->web_ip?>" placeholder="请输入web服务器IP">
        </td>
    </tr>
    <tr>
        <td align="center">图片服务器IP:</td>
        <td>
            <input name="img" class="form-input w400" type="text" value="<?php echo $info->img_ip?>" placeholder="请输入图片服务器IP">
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <input type="button" class="update btn" value="修改">
            <input type="button" class="cancel btn" value="取消">
        </td>
    </tr>
</table>
</form>
<script>
    $(".update").click(function(){
        var code=[];
        var id="<?php echo $_REQUEST['id'];?>";
        var G={};
        var web=$("input[name='web']").val();
        var img=$("input[name='img']").val();
        $("input[name='city']:checked").each(function(){
            code.push($(this).val());
        });
        if(code.length==0){
            layer.alert('请选择省市',{icon:0});
            return false;
        }
        if(empty(web)){
            layer.alert('请填写web服务器IP',{icon:0});
            return false;
        }
        if(empty(img)){
            layer.alert('请填写图片服务器IP',{icon:0});
            return false;
        }
	if(isValidIP(web)==false){
            layer.alert('请输入正确格式的IP',{icon:0});
            return false;
        }
        if(isValidIP(img)==false){
            layer.alert('请输入正确格式的IP',{icon:0});
            return false;
        }
        G.code=code;
        G.web=web;
        G.img=img;
        G.id=id;
	//console.log(G);return false;
        $.post('/version/station/doaddressupdate?mid=1',G,function(d){
            if(d.code== 200){
                alert('修改成功',{icon:0});
                window.history.go(-1);
            }else{
		alert('修改失败',{icon:0});
                location.reload();
            }
        },'json')
    })
    $(".cancel").click(function(){
	window.history.go(-1);
    })
    function isValidIP(ip) {
        var reg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5]):\d{0,6}$/
        return reg.test(ip);
    }
</script>
