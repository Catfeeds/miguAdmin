<?php
$admin = $this->getMvAdmin();
?>
<form action="" method="post" enctype="multipart/form-data">
    <table class="mtable"  cellpadding="10" cellspacing="0">
        <input type="hidden" name="vgid" value="<?php echo $gid?>">
        <input type="hidden" name="vflag" value="<?php echo $flag?>">
        <tr>
            <td width="100" align="right">驳回理由：</td>
            <td><input type="text" name="vname" value="" class="form-input"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="button" value="保存信息" class="btn classify_btn">
                <input type="button" value="返回列表" class="gray">
            </td>
        </tr>
    </table>
</form>
<script>
    $('.classify_btn').click(function(){
        var G = {}
        G.gid = $('input[name=vgid]').val();
        G.flag = $('input[name=vflag]').val();
        G.username = "<?php echo $admin['nickname']?>";
        G.message = $('input[name=vname]').val();
        $.post("<?php echo $this->get_url('wallpaper','reject')?>",G,function(){
            location.reload();
        })
    })
    $('.gray').click(function(){
       layer.closeAll();
   })
</script>


