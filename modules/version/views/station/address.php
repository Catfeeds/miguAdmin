<?php
$admin = $this->getMvAdmin();
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:'';
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<script charset="utf-8" type="text/javascript" src="/js/jdate/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/js/jdate/jquery.datetimepicker.css" />
<style>
    .page{
        height:20px;

        line-height: 20px;
    }
    .page ul li {
        line-height: 20px;
        height:20px;
    }
    .inputDiv{
        width:100%;
        float:left;

        background: #A3BAD5;
        padding: 5px 0px 5px 4px;
    }
    .inputDiv input{
        float: left;
    }
    .inputDiv span{
        float: left;
    }
    .inputDiv select{
        float: left;
        margin-left:5px;
    }
    .inputDivTwo{
        width:100%;
        float:left;
        height:30px;
        background: #f0fdff;
        padding: 5px 0px 7px 12px;
    }
    table th{
        word-break: keep-all;

    }
    .mtable td{
        padding：0px 0px 0px 0px;
    }
    table td{
        word-break: keep-all;
    }
</style>
<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:'';
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<div style='padding: 5px 0px 0px 12px;'>
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;?></span>
</div>
<div class="mt10">
    <form action="">
        <div class="inputDiv">
            <input type="text" name="title" style="width:120px;height:18px;"  class="form-input" value="<?php echo !empty($_GET['title'])?$_GET['title']:''?>" placeholder="请输入查询条件">
            <span style="font-size:14px;">站点</span>
            <select onchange="" name="station" style="width:120px;height:20px;"  class="form-input" id="station">
                <option value="0">请选择</option>
		<?php $station=VerStation::model()->findAll();?>
                <?php foreach($station as $v):?>
                    <option <?php if(!empty($_GET['stationId'])&&$_GET['stationId']==$v['id']){echo "selected=selected";}?> value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
                <?php endforeach;?>
            </select>
            <span style="float:left;font-size:14px;">省份</span>
            <select onchange="getcity()" name="province" style="width:100px;height:20px;"  class="form-input" id="province">
                <option value="0" title="ShowType">请选择</option>
		<?php
                    $province=Province::model()->findAll();
                    foreach($province as $k){
			if(!empty($_GET['province'])&&$_GET['province']==$k['provinceCode']){
                            echo '<option selected=selected value="'.$k['provinceCode'].'">'.$k['provinceName'].'</option>';
                        }else{
                            echo '<option  value="'.$k['provinceCode'].'">'.$k['provinceName'].'</option>';
                        }
                    }
                ?>
            </select>
            <span style="float:left;font-size:14px;">地市</span>
            <select name="city" style="width:100px;height:20px;"  class="form-input" id="city">
                <option value="">请选择</option>
            </select>
            <input style="width:50px;height:20px;margin-left: 5px;" class="btn btn1 btn-gray audit_search search " type="button" value="查询" name="" style="font-size: 14px;/*margin-right:550px;*/">
            <?php //echo $page;?>
        </div>
	<?php if($_SESSION['auth']=='1'):?>
        <div class="inputDivTwo">
            <input class="btn add" type="button" value="添加" name="add" style="font-size: 14px;width:85px;">
        </div>
        <?php endif;?>
        <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
            <tr>
                <th>编号</th>
                <th>站点名称</th>
                <th>站点ID</th>
                <th>省份</th>
                <th>地市</th>
                <th>web服务器IP</th>
                <th>图片服务器IP</th>
                <th>操作</th>
            </tr>
		<?php if(!empty($data)):?>
                <?php foreach($data as $v):?>
            <tr>
                <td><?php echo $v['id']?></td>
                <td><?php echo $v['name']?></td>
                <td><?php echo $v['stationId']?></td>
                <td>
		    <?php 
                        $province=$v['province'];
                        $tmp=explode("/",$province);
                        for($i=0;$i<count($tmp);$i++){
                            $match=Province::model()->findByAttributes(array("provinceCode"=>$tmp[$i]));
                            $pro[$i]=$match->provinceName;
                        }
                        echo join("/",$pro);
                    ?>
		</td>
                <td>
		    <?php
                    $city=$v['city'];
                    $ctmp=explode("/",$city);
                    for($i=0;$i<count($ctmp);$i++){
                        $match_c=City::model()->findByAttributes(array("cityCode"=>$ctmp[$i],"provinceId"=>$tmp[$i]));
                        $c[$i]=$match_c->cityName;
                    }
                    echo join("/",$c);
                    ?>
		</td>
                <td><?php echo $v['web_ip']?></td>
                <td><?php echo $v['img_ip']?></td>
                <td><a gid=<?php echo $v['id']?> class="href" href="javascript:;">编辑</a>&nbsp;<a href="javascript:;" gid="<?php echo $v['id']?>" class="del">删除</a></td>
            </tr>
                <?php endforeach;?>
            <?php else:?>
            <tr>
                <td colspan="8">暂无数据</td>
            </tr>
            <?php endif;?>
        </table>
    </form>
</div>
<script>
    var nid="<?php echo $_GET['nid'];?>";
    var mid ="<?php echo $_GET['mid'];?>";
    var adminLeftOne = "<?php echo $adminLeftOne;?>";
    var adminLeftTwo = "<?php echo $adminLeftTwo;?>";
    var adminLeftOneName = "<?php echo $adminLeftOneName;?>";
    var adminLeftNavFlag  = "<?php echo !empty($_GET['adminLeftNavFlag'])?$_GET['adminLeftNavFlag']:'0'; ?>";
    var fixedUrl = '/mid/'+mid+'/nid/'+nid+'/adminLeftOne/'+adminLeftOne+'/adminLeftTwo/'+adminLeftTwo+'/adminLeftOneName/'+adminLeftOneName+'/adminLeftNavFlag/'+adminLeftNavFlag;
    $(".add").click(function(){
        window.location.href="/version/station/addressadd"+fixedUrl;
    })

    $(".href").click(function(){
	var id=$(this).attr("gid");
	window.location.href="/version/station/addressupdate/id/"+id+fixedUrl;
    })
    $(".search").click(function(){
        var title=$("input[name='title']").val();
        var province=$("#province option:selected").val();
        var stationId=$("#station option:selected").val();
        window.location.href="/version/station/address.html?title="+title+"&province="+province+"&stationId="+stationId+"&mid="+mid+"&nid="+nid+"&adminLeftOne="+adminLeftOne+"&adminLeftTwo="+adminLeftTwo+"&adminLeftOneName="+adminLeftOneName+"&adminLeftNavFlag="+adminLeftNavFlag;
    })
    function getcity(){
        var province=$("#province option:selected").val();
	$("#city").children().remove();
        $.getJSON("/version/wallpaper/getcity?mid=1",{id:province},function(data){
            $.each(data,function(i){
                $("#city").append('<option value="'+data[i]['cityCode']+'">'+data[i]['cityName']+'</option>');
            })
        });
    }
    $(".del").click(function(){
        var id=$(this).attr("gid");
        $.post('/version/station/addressdel?mid=1',{id:id},function(d){
            if(d.code== 200){
                alert('删除成功');
                location.reload();;
            }else{
                alert('删除失败');
                location.reload();
            }
        },'json')
    })
</script>

