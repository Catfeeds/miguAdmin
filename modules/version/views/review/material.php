<?php
$admin = $this->getMvAdmin();
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
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
        height:18px;
        width:170px;
    }
    .inputDiv span{
        float: left;
    }
    .inputDiv select{
        float: left;
        margin-left:5px;
        height:20px;
    }
    .inputDivTwo{
        width:100%;
        float:left;
        height:30px;
        background: #f0fdff;
        padding: 5px 0px 5px 12px;
    }
</style>
<div style='padding: 5px 0px 5px 12px;'>
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;?></span>
</div>
<div>
    <div class="inputDiv">

        <span style="float:left;font-size:14px;">&nbsp;&nbsp;&nbsp;站点</span>
        <select name="type" id="gid" class="form-input w200">
            <option value="0">请选择</option>
            <?php
            if($_SESSION['auth'] == 1){
                $sql = "select id,name from yd_ver_station";
            }else{
                $uid = $_SESSION['userid'];
                $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 8  left join yd_ver_worker as c on c.workid=b.id where c.type = 1 and  c.uid=$uid group by a.id";
            }
            $result = SQLManager::queryAll($sql);
            ?>
            <?php if(!empty($result)):?>
                <?php foreach($result as $v):?>
                    <option value="<?php echo $v['id']?>" <?php if(!empty($_REQUEST['gid'])&&$_REQUEST['gid']==$v['id']){echo "selected=selected";}?>><?php echo $v['name']?></option>
                <?php endforeach;?>
            <?php endif;?>
        </select>

	    <span style="float:left;font-size:14px;">&nbsp;&nbsp;&nbsp;审核状态:</span>
        <select name="type" id="type" class="form-input w100">
            <option value="1" <?php if(!empty($_REQUEST['type']) && $_REQUEST['type'] == '1'){ echo "selected=selected";}?>>未审核</option>
            <option value="2" <?php if(!empty($_REQUEST['type']) && $_REQUEST['type'] == '2'){ echo "selected=selected";}?>>已通过</option>
            <option value="3" <?php if(!empty($_REQUEST['type']) && $_REQUEST['type'] == '3'){ echo "selected=selected";}?>>已驳回</option>
        </select>

	    <input style="width:50px;height:20px;margin-left: 5px;font-size: 14px;" class="btn btn1 btn-gray audit_search search " type="button" value="查询" name="">

        <?php //echo $page;?>

    </div>

    <div class="inputDivTwo">
        <input class="btnall btn" type="button" value="全选">
        <input class="btnno btn" type="button" value="全不选">
        <input class="btn sub_btn" type="button" value="批量通过">
        <input class="btn allreject" type="button" value="批量驳回">
    </div>

    <form action="">
        <div class="fenlei">
            <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
                <tr>
                    <th></th>
                    <th>站点</th>
                    <th>名称</th>
                    <th>url</th>
                    <th>审核</th>
                    <th>提交审核时间</th>
                </tr>
                <?php if(!empty($list)):?>
                    <?php foreach($list as $v):?>
                        <tr>
                            <td><input type="checkbox" name="id" value="<?php echo $v['id']?>" workid="<?php echo $v['workid'];?>" gid="<?php echo $v['gid'];?>"></td>
                            <td><?php echo $v['name'];?></td>
                            <td><?php echo $v['title'];?></td>
                            <td><?php echo $v['url'];?></td>
                            <td>
                                <?php
                                    if($v['flag']==0){
                                        echo "未通过";
                                    }elseif($v['flag']==6){
                                        echo "已通过";
                                    }else{
                                        echo "审核中";
                                    }
                                ?>
                            </td>
                            <td><?php echo date("Y-m-d H:i:s",$v['time']);?></td>
                        </tr>
                    <?php endforeach;?>
                <?php else:?>
                    <tr>
                        <td colspan="7">暂无数据</td>
                    </tr>
                <?php endif;?>
            </table>
        </div>
    </form>
</div>
<script>
    var adminLeftOne = "<?php echo $adminLeftOne;?>";
    var adminLeftTwo = "<?php echo $adminLeftTwo;?>";
    var adminLeftOneName = "<?php echo $adminLeftOneName;?>";
    var adminLeftTwoName = "<?php echo $adminLeftTwoName;?>";
    var one = "<?php echo !empty($_GET['one'])?$_GET['one']:'0';?>";
    var two = "<?php echo !empty($_GET['two'])?$_GET['two']:'0';?>";
    var three = "<?php echo !empty($_GET['three'])?$_GET['three']:'0';?>";
    var siteName = "<?php echo !empty($_GET['siteName'])?$_GET['siteName']:''; ?>";
    var son = "<?php echo !empty($_GET['son'])?$_GET['son']:''; ?>";
    var topName = "<?php echo !empty($_GET['top'])?$_GET['top']:''; ?>";
    var leftNavFlag  = "<?php echo !empty($_GET['leftNavFlag'])?$_GET['leftNavFlag']:'0'; ?>";
    var adminLeftNavFlag  = "<?php echo !empty($_GET['adminLeftNavFlag'])?$_GET['adminLeftNavFlag']:'0'; ?>";
    var fixedUrl = '/adminLeftOne/'+adminLeftOne+'/adminLeftTwo/'+adminLeftTwo+'/adminLeftOneName/'+adminLeftOneName+'/adminLeftTwoName/'+adminLeftTwoName+'/adminLeftNavFlag/'+adminLeftNavFlag+'/one/'+one+'/two/'+two+'/three/'+three+'/siteName/'+siteName+'/son/'+son+'/top/'+topName+'/leftNavFlag/'+leftNavFlag;
    $('.btnall').click(function(){//全选
        $(".center :checkbox").prop("checked", true);
    });

    $('.btnno').click(function(){//全不选
        $(".center :checkbox").prop("checked", false);
    });

    $('.sub_btn').click(function(){//批量通过
        var arr=[];
	var gid=[];
	var workid=[];
        $("input[name='id']:checked").each(function(i) {
            gid[i]=$(this).attr("gid");
            arr[i]=$(this).val();
            workid[i]=$(this).attr("workid");
        });
        if(arr.length==0){
            layer.alert("未选中，无法提交",{icon:2});
            return false;
        }
	//console.log(arr,gid);return false;
        var ids=arr.join(",");//获取选中的id
	$.post("/version/review/materaccess?mid=<?php echo $this->mid?>",{id:ids,gid:gid,workid:workid},function(data){
            if(data.code==200){
                location.reload();
            }else{
                layer.alert("切换用户试一试",{icon:2})
            }
        },'json');
    })

    $(".allreject").click(function(){//批量驳回
        var arr=[];
	var gid=[];
        var workid=[];
        $("input[name='id']:checked").each(function(i) {
            gid[i]=$(this).attr("gid");
            arr[i]=$(this).val();
            workid[i]=$(this).attr("workid");
        });
        if(arr.length==0){
            layer.alert("未选中，无法提交",{icon:2});
            return false;
        }
        var ids=arr.join(",");//获取选中的id
	$.post("/version/review/materreject?mid=<?php echo $this->mid?>",{id:ids,gid:gid,workid:workid},function(data){
            location.reload();
        },'json');
    })

    $(".pass").click(function(){//通过
        var id=$(this).attr("gid");
	$.post("/version/review/materaccess?mid=<?php echo $this->mid?>",{id:id},function(data){
            if(data.code==200){
                location.reload();
            }else{
                layer.alert("切换用户试一试",{icon:2})
            }
        },'json');
    })

    $(".reject").click(function(){//驳回
        var id=$(this).attr("gid");
	$.post("/version/review/materreject?mid=<?php echo $this->mid?>",{id:id},function(data){
            location.reload();
        },'json');
    })

    $('.audit_search').click(function(){
        var gid=$("#gid").val();
        var type=$("#type").val();
        var nid = "<?php echo $_GET['nid']?>";
        var headerUrl = "/version/review/material/gid/"+gid+"/mid/<?php echo $this->mid;?>/type/"+type+"/nid/"+nid+fixedUrl;
        window.location.href=headerUrl;
    })
</script>