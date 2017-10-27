<style>
	.mtable td{
		padding:5px;
	}
	
</style>
<form action="" method="post" enctype="multipart/form-data">
    <table style="width:100%" class="mtable"  cellpadding="10" cellspacing="0">
        <input type="hidden" name="vgid" value="<?php echo !empty($gid)?$gid:''?>">
        <input type="hidden" name="vtype" value="<?php echo !empty($vtype)?$vtype:''?>">
        <input type="hidden" name="vprotype" value="<?php echo !empty($vprotype)?$vprotype:'0'?>">
        <tr>
            <td width="100" align="right">栏目名称：</td>
            <td><input  type="text" name="vname" value="" class="form-input w200"></td>
        </tr>
        <tr style="display:none" class="vse">
            <td width="100" align="right">是否搜索：</td>
            <td><label for="out"><input type="radio" name="vsearch" id="issearch" value="0" > 是</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label for="in"><input type="radio" name="vsearch" id="search" value="1" > 否</label></td>
        </tr>
        <tr style="display:none" class="vse">
            <td width="100" align="right">是否开启筛选：</td>
            <td><label for="out"><input type="radio" name="vfilter" id="isfilter" value="0" > 是</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <label for="in"><input type="radio" name="vfilter" id="filter" value="1" > 否</label></td>
        </tr>
        <tr>

            <td align="center" colspan="2">
                <input style="width:80px;height:30px;padding:0px;float: none" type="submit" value="保存信息" class="btn classify_btn">
                <input style="width:80px;height:30px;padding:0px;float: none" type="button" value="返回列表" class="gray">
            </td>
        </tr>
    </table>
</form>
<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:'';
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
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
    $(function(){
        aa();
    })
    function aa(){
        var type = "<?php echo $vtype?>";
        if(type=='2'){
            $('.vse').hide();
        }else{
            $('.vse').show();
        }
    }
    $('.classify_btn').click(function(){
        var G={};
        G.gid = $('input[name=vgid]').val();
        G.type = $('input[name=vtype]').val();
        G.protype = $('input[name=vprotype]').val();
        G.name = $('input[name=vname]').val();
        G.search = $('input[name=vsearch]:checked').val();
        G.filter = $('input[name=vfilter]:checked').val();
        if(empty(G.name)){
            layer.alert('栏目不能为空');
            return false;
        }
        $.post("<?php echo $this->get_url('station','topsave')?>",G,function(d){
            var json=eval('('+d+')');
	    var nid=json.id;
	    //console.log(nid);
	    window.location.href=top.location.href+"&newid="+nid;
            //location.reload();
        })
        return false;
    })
    $('.gray').click(function(){
       layer.closeAll();
    })
</script>


