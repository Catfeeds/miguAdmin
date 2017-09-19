<form action="" method="post">
	<table class="mtable" width="50%" cellpadding="10" cellspacing="0">
		<tr>
			<td width="200" align="right">epgName：</td>
			<td><input type="text" name="epgName" id="epgName" class="form-input" value="<?php echo !empty($epg->epgName)?$epg->epgName:''?>"></td>
		</tr>
		<tr>
			<td align="right">Epg：</td>
			<td><input type="text" name="epg" id="epg" class="form-input" value="<?php echo !empty($epg->epg)?$epg->epg:''?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" value="保存信息" class="btn">
				<input type="button" value="返回列表" class="gray" onclick="window.location.href='<?php echo $this->get_url('guide','index')?>'">
			</td>
		</tr>
	</table>
</form>
<script type="text/javascript">
	$('#pid').change(function(){
		var v = $(this).val();
		if(empty(v)){
			$('#url').val("javascript:void(0)").attr('readonly',true);
		}else{
			$('#url').val("").attr('readonly',false);
		}
	});
</script>