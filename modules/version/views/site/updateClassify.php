<style>
.mtable td{
	padding:5px;
}

</style>
<div class="mt10">
    <form action="">
        <table width="100%" cellspacing="0" cellpadding="10" class="mtable">
            <input type="hidden" name="gid" value="<?php echo $gid?>">
            <input type="hidden" name="cateId" value="<?php echo $res[0]['id'];?>">
            <tr>
                <td>节目类型</td>
                <td style="text-align: left" width="300x">
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('电影',$type)){echo 'checked';}}?> value="电影" >电影
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('综艺',$type)){echo 'checked';}}?> value="综艺" >综艺
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('新闻',$type)){echo 'checked';}}?> value="新闻" >新闻
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('电视剧',$type)){echo 'checked';}}?> value="电视剧" >电视剧<br/>
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('动漫',$type)){echo 'checked';}}?> value="动漫" >动漫
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('教育',$type)){echo 'checked';}}?> value="教育" >教育
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('体育',$type)){echo 'checked';}}?> value="体育" >体育
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('音乐',$type)){echo 'checked';}}?> value="音乐" >音乐<br/>
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('娱乐',$type)){echo 'checked';}}?> value="娱乐" >娱乐
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('健康',$type)){echo 'checked';}}?> value="健康" >健康
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('旅游',$type)){echo 'checked';}}?> value="旅游" >旅游
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('法制',$type)){echo 'checked';}}?> value="法制" >法制<br/>
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('搞笑',$type)){echo 'checked';}}?> value="搞笑" >搞笑
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('时尚',$type)){echo 'checked';}}?> value="时尚" >时尚
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('军事',$type)){echo 'checked';}}?> value="军事" >军事
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('财经',$type)){echo 'checked';}}?> value="财经" >财经<br/>
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('曲艺',$type)){echo 'checked';}}?> value="曲艺" >曲艺
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('奥运',$type)){echo 'checked';}}?> value="奥运" >奥运
                <input style="margin-left: 20px" type="checkbox" name="type" <?php if(!empty($type)){if(in_array('纪实',$type)){echo 'checked';}}?> value="纪实" >纪实
                </td>
                <td>内容提供商</td>
                <td style="text-align: left">
			<input style="margin-left: 20px" type="checkbox" value="642001" <?php if(!empty($cp)){if(in_array('642001',$cp)){echo 'checked';}}?> name="cps">华数	
			<input style="margin-left: 20px" type="checkbox" value="BESTVOTT" <?php if(!empty($cp)){if(in_array('BESTVOTT',$cp)){echo 'checked';}}?> name="cps">百视通
			<input style="margin-left: 6px" type="checkbox" value="ICNTV" <?php if(!empty($cp)){if(in_array('ICNTV',$cp)){echo 'checked';}}?> name="cps">&nbsp;未来电视
			<input style="margin-left: 20px" type="checkbox" value="youpeng" <?php if(!empty($cp)){if(in_array('youpeng',$cp)){echo 'checked';}}?>  name="cps">南传<br/>
			<input style="margin-left: 20px" type="checkbox" value="HNBB" <?php if(!empty($cp)){if(in_array('HNBB',$cp)){echo 'checked';}}?>  name="cps">芒果
			<input style="margin-left: 20px" type="checkbox" value="CIBN" <?php if(!empty($cp)){if(in_array('CIBN',$cp)){echo 'checked';}}?>  name="cps">国广
			<input style="margin-left: 20px" type="checkbox" value="YGYH" <?php if(!empty($cp)){if(in_array('YGYH',$cp)){echo 'checked';}}?>  name="cps">银河
	 		<input style="margin-left: 20px" type="checkbox" value="poms" <?php if(!empty($cp)){if(in_array('poms',$cp)){echo 'checked';}}?>  name="cps">咪咕

		</td>
            </tr>
            <tr>
                <td>优先级</td>
                <td>
                    <select name="order" class="form-input w300" id="orders">
                        <option value="0">请选择</option>
                        <option  value="1" <?php if($res[0]['orders']=='1'){echo 'selected';}?> >1</option>
                        <option  value="2" <?php if($res[0]['orders']=='2'){echo 'selected';}?> >2</option>
                        <option  value="3" <?php if($res[0]['orders']=='3'){echo 'selected';}?> >3</option>
                        <option  value="4" <?php if($res[0]['orders']=='4'){echo 'selected';}?> >4</option>
                        <option  value="5" <?php if($res[0]['orders']=='5'){echo 'selected';}?> >5</option>
                        <option  value="6" <?php if($res[0]['orders']=='6'){echo 'selected';}?> >6</option>
                        <option  value="7" <?php if($res[0]['orders']=='7'){echo 'selected';}?> >7</option>
                        <option  value="8" <?php if($res[0]['orders']=='8'){echo 'selected';}?> >8</option>
                        <option  value="9" <?php if($res[0]['orders']=='9'){echo 'selected';}?> >9</option>
                        <option  value="10" <?php if($res[0]['orders']=='10'){echo 'selected';}?> >10</option>
                    </select>
                </td>
                <td>单集多级选择</td>
                <td>单集：<input type="checkbox" value="1" <?php if(!empty($simple_set)){if(in_array('1',$simple_set)){echo 'checked';}}?> name="simple_set">
                多集：<input type="checkbox" value="2" <?php if(!empty($simple_set)){if(in_array('2',$simple_set)){echo 'checked';}}?>  name="simple_set" >
                </td>
            </tr>
            <tr>
                <td>评分</td>
                <td><input type="text" value="<?php echo $res[0]['score']; ?>" name="score" class="form-input w300"></td>
                <td>清晰度</td>
                <td><input type="text" name="hdflag" class="form-input w300" value="<?php  echo $res[0]['hdflag'];?>"></td>
            </tr>
            <tr>
                <td>国家地区</td>
                <td>
                    <select name="CountryOfOrigin" class="form-input w300" id="CountryOfOrigin">
                        <option value="0">请选择</option>
                        <option  value="1" <?php if($res[0]['CountryOfOrigin']=='1'){echo 'selected';}?> >内地</option>
                        <option  value="2" <?php if($res[0]['CountryOfOrigin']=='2'){echo 'selected';}?> >港台</option>
                        <option  value="3" <?php if($res[0]['CountryOfOrigin']=='3'){echo 'selected';}?> >韩日</option>
                        <option  value="4" <?php if($res[0]['CountryOfOrigin']=='4'){echo 'selected';}?> >欧美</option>
                        <option  value="5" <?php if($res[0]['CountryOfOrigin']=='5'){echo 'selected';}?> >东南亚</option>
                        <option  value="99" <?php if($res[0]['CountryOfOrigin']=='99'){echo 'selected';}?> >其他</option>
                    </select>
                </td>
                <td>发行年份</td> 
                <td><input type="text" name="year" class="form-input w300" value="<?php echo $res[0]['year'];?>"></td>
            </tr>
            <tr>
                <td>配音语言</td>
                <td><input type="text" name="language" value="<?php echo $res[0]['language'];?>" class="form-input w300"></td>
            <td>关键字</td>
                <td><input type="text" name="short" value="<?php echo $res[0]['short']?>" class="form-input w300"></td>
            </tr>
            <tr>
                <td>是否完结</td>
                <td>
                    <select name="end" class="form-input w300" id="end">
        		<option value="-1">请选择</option>
	                <option value="0"  <?php if($res[0]['end']=='0'){echo 'selected';}?> >否</option>
                        <option  value="1" <?php if($res[0]['end']=='1'){echo 'selected';}?> >是</option>
                    </select>
                </td>
                <td>标签</td>
                <td><input type="text" name="keyword" class="form-input w300" value="<?php echo $res[0]['keyword'];?>"></td>
            </tr>
            <tr>
                <td>导演</td>
                <td><input type="text" name="director" value="<?php echo $res[0]['director'];?>" class="form-input w300"></td>
                <td>演员</td>
                <td><input type="text" name="actor" class="form-input w300" value="<?php echo $res[0]['actor'];?>"></td>
            </tr>
            <tr>
                <td>奖项</td>
                <td><input type="text" name="prize" value="<?php echo $res[0]['prize'];?>" class="form-input w300"></td>
                <td>票房</td>
                <td><input type="text" name="boxoffice" class="form-input w300" value="<?php echo $res[0]['boxoffice'];?>"></td>
            </tr>
	    <tr>
		<td>是否收费</td>
		<td><select name="isfree"  class="form-input w300" id="fee">
			<option value="-1"<?php if($res[0]['is_free']==-1){echo "selected";}?>>请选择</option>
			<option value="1" <?php if($res[0]['is_free']==1){echo "selected";}?>>是</option>
			<option value="0" <?php if($res[0]['is_free']==0){echo "selected";}?>>否</option>
		</select></td>
		<td></td>
	    </tr>
            <tr>
                <td align="center" colspan="4">
                	<div>
                    <input style="width:80px;height:30px;padding:0px;float: none" type="button" value="保存修改信息" class="btn save_btn">
                    <input style="width:80px;height:30px;padding:0px" type="button" value="取消" class="gray">
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
    $('.save_btn').click(function(){
        var G={};
        G.cps="";
        $("input[name='cps']:checked").each(function() {

            G.cps += $(this).val()+' ';

        });
        if(empty(G.cps)){
            layer.alert('请选择牌照方');
            return false;
        }
	 G.type = "";
        $("input[name='type']:checked").each(function() {

            G.type += $(this).val()+' ';

        });
        G.simple_set="";
        $("input[name='simple_set']:checked").each(function() {

            G.simple_set += $(this).val()+' ';

        });
        if(empty(G.type)){
            layer.alert('请选择分类');
            return false;
        }
        G.gid = "<?php //echo $_REQUEST['nid']?>";
        G.orders = $('#orders').val();
        G.short=$('input[name=short]').val();
        G.CountryOfOrigin = $('#CountryOfOrigin').val();
        G.end = $('#end').val();
        G.score = $('input[name=score]').val();
        G.hdflag = $('input[name=hdflag]').val();
        G.year = $('input[name=year]').val();
        G.language = $('input[name=language]').val();
        G.keyword = $('input[name=keyword]').val();
        G.director = $('input[name=director]').val();
        G.actor = $('input[name=actor]').val();
        G.boxoffice = $('input[name=boxoffice]').val();
        G.prize = $('input[name=prize]').val();
        G.id = $('input[name=cateId]').val();
        G.gid = $('input[name=gid]').val();
	G.fee=$("#fee").val();
//	console.log(G);return false;
        $.post("<?php echo $this->get_url('site','categoryUpdate')?>",G,function(d){
	    if(d == 200){
		 layer.alert('修改成功!');
		 location.reload();
            }else{
//		alert('121');
	    }	
            //location.reload();
        })
    })

    $('.gray').click(function(){
        layer.closeAll();
    })
</script>


