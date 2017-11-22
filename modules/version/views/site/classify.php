<div class="mt10">
    <form action="">
        <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
            <input type="hidden" name="gid" value="<?php echo $gid?>">
            <tr>
                <td>节目类型</td>
                <td style="text-align: left" width="300x">
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="电影" >电影
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="综艺" >综艺
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="新闻" >新闻
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="电视剧" >电视剧<br>
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="动漫" >动漫
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="教育" >教育
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="体育" >体育
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="音乐" >音乐<br>
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="娱乐" >娱乐
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="健康" >健康
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="旅游" >旅游
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="法制" >法制<br>
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="搞笑" >搞笑
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="时尚" >时尚
                <input style="margin-left: 20px" type="checkbox" name="type"  value="军事" >军事
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="财经" >财经<br>
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="曲艺" >曲艺
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="奥运" >奥运
                <input style="margin-left: 20px"  type="checkbox" name="type"  value="纪实" >纪实
                </td>
                <td>内容提供商</td>
                <td>
			<p><input type="checkbox" value="642001" name="cps">华数</p>
			<p><input type="checkbox" value="BESTVOTT" name="cps">百视通</p>
			<p><input type="checkbox" value="ICNTV" name="cps">未来电视</p>
			<p><input type="checkbox" value="youpeng" name="cps">南传</p>
			<p><input type="checkbox" value="HNBB" name="cps">芒果</p>
			<p><input type="checkbox" value="CIBN" name="cps">国广</p>
			<p><input type="checkbox" value="YGYH" name="cps">银河</p>
<!--			<p><input type="checkbox" value="poms" name="cps">咪咕</p></td>-->
            </tr>
            <tr>
                <td>优先级</td>
                <td>
                    <select name="order" class="form-input w300" id="orders">
                        <option value="0">请选择</option>
                        <option  value="1" >1</option>
                        <option  value="2">2</option>
                        <option  value="3">3</option>
                        <option  value="4">4</option>
                        <option  value="5">5</option>
                        <option  value="6">6</option>
                        <option  value="7">7</option>
                        <option  value="8">8</option>
                        <option  value="9">9</option>
                        <option  value="10">10</option>
                    </select>
                </td>
                <td>单集多级选择</td>
                <td>单集：<input type="checkbox" value="1"  name="simple_set">
                多集：<input type="checkbox" value="2"  name="simple_set" >
                </td>
            </tr>
            <tr>
                <td>评分</td>
                <td><input type="text" value="" name="score" class="form-input w300"></td>
                <td>清晰度</td>
                <td><input type="text" name="hdflag" class="form-input w300" value=""></td>
            </tr>
            <tr>
                <td>国家地区</td>
                <td>
                    <select name="CountryOfOrigin" class="form-input w300" id="CountryOfOrigin">
                        <option value="0">请选择</option>
                        <option  value="1" >内地</option>
                        <option  value="2">港台</option>
                        <option  value="3">韩日</option>
                        <option  value="4">欧美</option>
                        <option  value="5">东南亚</option>
                        <option  value="99">其他</option>
                    </select>
                </td>
                <td>发行年份</td>
                <td><input type="text" name="year" class="form-input w300" value=""></td>
            </tr>
            <tr>
                <td>配音语言</td>
                <td><input type="text" name="language" value="" class="form-input w300"></td>
                <td>关键字</td>
                <td><input type="text" name="short" value=""  class="form-input w300"></td>
            </tr>
            <tr>
                <td>是否完结</td>
                <td>
                    <select name="end" class="form-input w300" id="end">
			<option value="-1">请选择</option>
                        <option value="0">否</option>
                        <option  value="1" >是</option>
                    </select>
                </td>
                <td>标签(多关键字用/分割)</td>
                <td><input type="text" name="keyword" class="form-input w300" value=""></td>
            </tr>
            <tr>
                <td>导演</td>
                <td><input type="text" name="director" value="" class="form-input w300"></td>
                <td>演员</td>
                <td><input type="text" name="actor" class="form-input w300" value=""></td>
            </tr>
            <tr>
                <td>奖项</td>
                <td><input type="text" name="prize" value="" class="form-input w300"></td>
                <td>票房</td>
                <td><input type="text" name="boxoffice" class="form-input w300" value=""></td>
            </tr>
	    <tr>
		<!--<td>是否免费</td>
		<td>
		    <select name="isfree" class="form-input w300" id="fee">
                        <option value="-1">请选择</option>
                        <option value="0">否</option>
                        <option value="1" >是</option>
                    </select>
		</td>-->
	    </tr>
            <tr>
                <td align="center" colspan="4">
                    <input style="width:80px;height:30px;padding:0px;float: none" type="button" value="保存信息" class="btn save_btn">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input style="width:80px;height:30px;padding:0px" type="button" value="取消" class="gray">
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
        if(empty(G.type)){
            layer.alert('请选择分类');
            return false;
        }
        G.simple_set="";
        $("input[name='simple_set']:checked").each(function() {

            G.simple_set += $(this).val()+' ';

        });
        G.gid = "<?php echo $_REQUEST['nid']?>";
        //G.type = $('#type').val();
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
        G.gid = $('input[name=gid]').val();
	    G.fee=$("#fee").val();
        //	console.log(G);return false;
        $.post("<?php echo $this->get_url('site','categoryAdd')?>",G,function(d){
	    if(d == 200){
		 alert('添加成功！')
		 location.reload();
            }else{
	//	alert('121');
	    }	
            //location.reload();
        })
    })

    $('.gray').click(function(){
        layer.closeAll();
    })
</script>


