<?php var_dump($info);?>
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

    <tr class="province">

    </tr>

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
            <input type="button" class="add btn" value="修改">
            <input type="button" class="cancel btn" value="取消">
        </td>
    </tr>
</table>
</form>

