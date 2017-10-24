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
        <select name="type" id="type" class="form-input w100">
            <option value="0">请选择</option>
<!--            --><?php //foreach($station as $v):?>
<!--                <option value="--><?php //echo $v['id'];?><!--">--><?php //echo $v['name'];?><!--</option>-->
<!--            --><?php //endforeach;?>
        </select>
	<span style="float:left;font-size:14px;">&nbsp;&nbsp;&nbsp;审核状态:</span>
	<select name="type" id="type" class="form-input w100">
            <option value="0">请选择</option>
            <option value="0">待审核</option>
            <option value="0">未通过</option>
            <option value="6">已通过</option>
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
                    <th>操作</th>
                </tr>
                <?php if(!empty($list)):?>
                    <?php foreach($list as $v):?>
                        <tr>
                            <td><input type="checkbox" name="id" value="<?php echo $v['id']?>"></td>
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
                            <td><a href="<?php echo $v['url'];?>" target="_blank">查看</a>&nbsp;<a href="javascript:;" class="pass" gid="<?php echo $v['id'];?>">通过</a>&nbsp;<a href="javascript:;" class="reject" gid="<?php echo $v['id'];?>">驳回</a></td>
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
    $('.btnall').click(function(){//全选
        $(".center :checkbox").prop("checked", true);
    });

    $('.btnno').click(function(){//全不选
        $(".center :checkbox").prop("checked", false);
    });

    $('.sub_btn').click(function(){//批量通过
        var arr=[];
        $("input[name='id']:checked").each(function(i) {
            arr[i] = $(this).val();
        });
        if(arr.length==0){
            layer.alert("未选中，无法提交",{icon:2});
            return false;
        }
        var ids=arr.join(",");//获取选中的id
	$.post("/version/review/materaccess?mid=<?php echo $this->mid?>",{id:ids},function(data){
            location.reload();
        },'json');
    })

    $(".allreject").click(function(){//批量驳回
        var arr=[];
        $("input[name='id']:checked").each(function(i) {
            arr[i] = $(this).val();
        });
        if(arr.length==0){
            layer.alert("未选中，无法提交",{icon:2});
            return false;
        }
        var ids=arr.join(",");//获取选中的id
	$.post("/version/review/materreject?mid=<?php echo $this->mid?>",{id:ids},function(data){
            location.reload();
        },'json');
    })

    $(".pass").click(function(){//通过
        var id=$(this).attr("gid");
	$.post("/version/review/materaccess?mid=<?php echo $this->mid?>",{id:id},function(data){
            location.reload();
        },'json');
    })

    $(".reject").click(function(){//驳回
        var id=$(this).attr("gid");
	$.post("/version/review/materreject?mid=<?php echo $this->mid?>",{id:id},function(data){
            location.reload();
        },'json');
    })
</script>
