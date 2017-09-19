<style>
.mtable td{
	padding:5px;
}
</style>
<form action="" method="post" enctype="multipart/form-data">
    <table width="100%" class="mtable"  cellpadding="10" cellspacing="0">
        <input type="hidden" name="vgid" value="<?php echo !empty($edit->attributes['pid'])?$edit->attributes['pid']:''?>">
        <input type="hidden" name="vtype" value="<?php echo !empty($edit->attributes['type'])?$edit->attributes['type']:''?>">
        <input type="hidden" name="vprotype" value="<?php echo !empty($edit->attributes['protype'])?$edit->attributes['protype']:'0'?>">
        <input type="hidden" name="vsid" value="<?php echo !empty($edit->attributes['id'])?$edit->attributes['id']:''?>">
        <tr>
            <td width="100" align="right">栏目名称：</td>
            <td><input  type="text" name="vname" value="<?php echo !empty($edit->attributes['name'])?$edit->attributes['name']:''?>" class="form-input w200"></td>
        </tr>
        <tr style="display:none" class="vse">
            <td width="100" align="right">是否搜索：</td>
            <td><label for="out"><input type="radio" name="vsearch" id="issearch" value="0" <?php $search= !empty($edit->attributes['search'])?$edit->attributes['search']:'0';if($search=='0'){echo "checked";}?> > 是</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label for="in"><input type="radio" name="vsearch" id="search" value="1" <?php $search=!empty($edit->attributes['search'])?$edit->attributes['search']:'0'; if($search=='1'){echo "checked";}?> > 否</label></td>
        </tr>
        <tr style="display:none" class="vse">
            <td width="100" align="right">是否开启筛选：</td>
            <td><label for="out"><input type="radio" name="vfilter" id="isfilter" value="0" <?php $filter=!empty($edit->attributes['filter'])?$edit->attributes['filter']:'0'; if($filter=='0'){echo "checked";}?> > 是</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label for="in"><input type="radio" name="vfilter" id="filter" value="1" <?php $filter=!empty($edit->attributes['filter'])?$edit->attributes['filter']:'0'; if($filter=='1'){echo "checked";}?> > 否</label></td>
        </tr>
        <tr>

            <td colspan="2" align="center">
                <input style="width:80px;height:30px;padding:0px;float:none" type="submit" value="保存信息" class="btn classify_btn">
                <input style="width:80px;height:30px;padding:0px;float:none" type="button" value="返回列表" class="gray">
            </td>
        </tr>
    </table>
</form>
<script>

    $(function(){
        aa();
    })
    function aa(){
        var type = $('input[name=vtype]').val();
        if(type=='3'){
            $('.vse').hide();
        }else{
            $('.vse').show();
        }
    }
    $('.classify_btn').click(function(){
        var G={};
        G.id = $('input[name=vsid]').val();
        G.pid = $('input[name=vgid]').val();
        G.type = $('input[name=vtype]').val();
        G.protype = $('input[name=vprotype]').val();
        G.name = $('input[name=vname]').val();
        G.search = $('input[name=vsearch]:checked').val();
        G.filter = $('input[name=vfilter]:checked').val();
        if(empty(G.name)){
            layer.alert('栏目不能为空');
            return false;
        }
        $.post("<?php echo $this->get_url('site','editadd')?>",G,function(d){
            location.reload();
        })
        return false;
    })
    $('.gray').click(function(){
        layer.closeAll();
    })
</script>


