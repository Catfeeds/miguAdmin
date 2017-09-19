<?php
$admin = $this->getMvAdmin();
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
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
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
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
            </select>
            <span style="float:left;font-size:14px;">省份</span>
            <select name="province" style="width:100px;height:20px;"  class="form-input" id="province">
                <option value="0" title="ShowType">请选择</option>
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
            <input class="btn del" type="button" value="删除" name="del" style="font-size: 14px;width:85px;">
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
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </form>
</div>

