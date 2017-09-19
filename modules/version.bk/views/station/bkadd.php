<form action="" method="post" enctype="multipart/form-data">
    <table style="width:100%" cellspacing="0" cellpadding="10" class="mtable center" width="600px">
        <input type="hidden" value="<?php echo $_REQUEST['nid']?>" name="gid">
        <tr>
            <td>专题模板</td>
            <td>
                <select name="type" class="form-input w100" id="type">
                    <option value="0">请选择</option>
                    <option   value="1" >模板1</option>
                    <option   value="2" >排行榜</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>背景图</td>
            <td>
                <input type="file" class="form-input w400" value="" name="url">
		<input type="text" class="form-input w400" value="" name="urls">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input style="width:80px;height:30px;padding:0px;float: none" class="btn" type="submit" value="保存">
		<input style="width:80px;height:30px;padding:0px;float: none" class="btn grey" type="button" value="取消"></td>
        </tr>
    </table>
    <form>
<script>
$('.grey').click(function(){
layer.closeAll();
})
</script>
