<form action="" method="post" enctype="multipart/form-data">
    <table class="mtable"  cellpadding="10" cellspacing="0">
        <input type="hidden" name="vgid" value="<?php echo !empty($edit->attributes['pid'])?$edit->attributes['pid']:''?>">
        <input type="hidden" name="vtype" value="<?php echo !empty($edit->attributes['type'])?$edit->attributes['type']:''?>">
        <input type="hidden" name="vprotype" value="<?php echo !empty($edit->attributes['protype'])?$edit->attributes['protype']:'0'?>">
        <input type="hidden" name="vsid" value="<?php echo !empty($edit->attributes['id'])?$edit->attributes['id']:''?>">
        <input type="hidden" name="vsearch" value="<?php echo !empty($edit->attributes['search'])?$edit->attributes['search']:'0'?>">
        <input type="hidden" name="vfilter" value="<?php echo !empty($edit->attributes['filter'])?$edit->attributes['filter']:'0'?>">
        <tr>
            <td width="100" align="right">栏目名称：</td>
            <td><input type="text" name="vname" value="" class="form-input"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" value="保存信息" class="btn classify_btn">
                <input type="button" value="返回列表" class="gray">
            </td>
        </tr>
    </table>
</form>
<script>
    $('.classify_btn').click(function(){
        var G={};
        G.id = $('input[name=vsid]').val();
        G.pid = $('input[name=vgid]').val();
        G.type = $('input[name=vtype]').val();
        G.protype = $('input[name=vprotype]').val();
        G.name = $('input[name=vname]').val();
        G.search = $('input[name=vsearch]').val();
        G.filter = $('input[name=vfilter]').val();
        if(empty(G.name)){
            layer.alert('栏目不能为空');
            return false;
        }
        $.post("<?php echo $this->get_url('station','editadd')?>",G,function(d){
            location.reload();
        })
        return false;
    })
</script>

