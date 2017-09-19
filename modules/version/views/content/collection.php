<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<style>
td{     padding-left:10px;font-size:14px;height:30px;width:150px}
.import{
        color:#C53336;
        }
.main_tb{
        border:1px solid #C9C9C9;
        border-collapse:collapse;
        margin-left:10px;
}
.main_tb tr{
        border:1px solid #C9C9C9;
}
.main_tb td{
        border:1px solid #C9C9C9;
}
.tb_player tr:nth-child(even){
background: #F0FDFF;
}
<?php
        $template = !empty($arr['templateType'])?$arr['templateType']:'';
        if($template!='E'){
            echo " .dir{color:red}";
        }
    ?>
.active{color:black}
</style>
<div style="margin-top:20px;margin-left:10px;height:20px;width:700px;">

<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>	
<div style="height:20px;width:300px;float: left"><?php echo $adminLeftOneName;?>><?php echo $adminLeftTwoName;?></div>

</div>
<div class="mt10" style="width:400px">
    <form action="" method="post">
    <input type="hidden" name="vid" value="<?php echo !empty($vid)?$vid:''?>">
    <input type="hidden" name="adminLeftOneName" value="<?php echo $adminLeftOneName;?>">
    <input type="hidden" name="adminLeftTwoName" value="<?php echo $adminLeftTwoName;?>">
    <input type="hidden" name="adminLeftOne" value="<?php echo $adminLeftOne;?>">
    <input type="hidden" name="adminLeftTwo" value="<?php echo $adminLeftTwo;?>">
    <table class="main_tb" width="700px;" >
    	 <tr bgcolor="#A3BAD5">
        <td colspan="4" style="text-align: center;font-size: 13px;color：#333333">基本信息</td>
       </tr>
        <tr bgcolor="#F0FDFF"> 
            <td class="import">资产名称:</td>
            <td colspan="3"><input type="text" name="title" class="form-input w400" value="<?php echo !empty($_REQUEST['title'])?$_REQUEST['title']:''?>" style="height:25px;line-height: 25px"></td>
        </tr>
        <tr>
            <td>内容类型:</td>
            <td style="width:175px;"><select style="width:170px;height:20px;" name="ShowType" class="form-input w100" id="ShowType" >
                    <option value="0">请选择</option>
                    <option value="Movie" >Movie</option>
                    <option value="Column">Column</option>
                    <option value="News">News</option>
                    <option value="Series">Series</option>
                </select></td>
             <td class="import">内容提供商:</td>
            <td><input style="width:155px;height:20px;" placeholder="请输入牌照方名称" type="text" name='cp' class="form-input w100" value="" style="height:25px;line-height: 25px"></td>

        </tr>
        <tr style="height:90px;" bgcolor="#F0FDFF">
            <td class="import">节目类型:</td>
            <td colspan='3'>
            	<div style="height:25px">
                 <input type="checkbox" name="type[]" value="电影" >电影
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="综艺" >综艺
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="新闻" >新闻
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="电视剧" >电视剧
			<input style="margin-left: 6px" type="checkbox" name="type[]" value="动漫" >动漫
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="教育" >教育
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="体育" >体育
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="音乐" >音乐
			 </div>
                         <div style="height:25px">
			<input  type="checkbox" name="type[]" value="娱乐" >娱乐
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="健康" >健康
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="旅游" >旅游
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="法制" >法制
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="搞笑" >搞笑
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="时尚" >时尚
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="军事" >军事
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="财经" >财经
			 </div>
                         <div style="height:25px">
			<input  type="checkbox" name="type[]" value="曲艺" >曲艺
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="奥运" >奥运
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="纪实" >纪实
            </td>
         </tr>
        <tr>
            <td class="import">单集多级选择</td>
            <td>单集：<input type="radio" name="simple_set" value="1" >多集：<input type="radio" name="simple_set" value="2" ></td>
      
            <td class="import">模板选择:</td>
            <td id="template">
                <select style="height:20px;width:155px;"  class="form-input w300" name="templateType" id="templateType" onchange="aa()">
                    <option value="0">请选择</option>
                    <option value="A" >竖图单片模板(电影)</option>
                    <option value="B" >多集数字模板（电视
剧）</option>
                    <option value="C" >多集标题模板（综艺
）</option>
                    <option value="D" >横图单片模板</option>
                    <option value="E" >无模板（新闻）</option>
                <select>
            </td>
        </tr>

        <tr bgcolor="#F0FDFF">
            <td>内容ID:</td>
            <td></td>
            <td>资产ID:</td>
            <td></td>
        </tr>
        <tr>
            <td>版权开始时间:</td>
            <td></td>
            <td>版权结束时间:</td>
            <td></td>
        </tr>
        <tr bgcolor="#F0FDFF">
            <td class="import">看点:</td>
            <td colspan="3" style="padding-top:5px;"><textarea placeholder="请输入影片看点" name="info" cols="70" rows="5" class='info' style="border:1px solid #C9C9C9"></textarea></td>
        </tr>
        <tr>
            <td>优先级:</td>
            <td><select style="width:170px;height:20px;" name="orders" class="form-input w100" id="orders">
                    <option value="0">请选择</option>
                    <option value="1" >1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select></td>
            <td class="import">首字母:</td>
            <td><input placeholder="请输入资产名称首字母" style="width:155px;height:20px;" type="text" name="initial" class="form-input w100" value="" style="height:25px;line-height: 25px"></td>
        </tr>
        <tr bgcolor="#F0FDFF">
            <td >国家地区:</td>
            <td><select style="width:170px;height:20px;" name="CountryOfOrigin" class="form-input w100" id="CountryOfOrigin">
                    <option value="0">请选择</option>
                    <option value="1" >内地</option>
                    <option value="2">港台</option>
                    <option value="3">韩日</option>
                    <option value="4">欧美</option>
                    <option value="5">东南亚</option>
                    <option value="99">其他</option>
                </select></td>
            <td>发行年份:</td>
            <td><input placeholder="请输入发行年份" style="width:155px;height:20px;" type="text" name="year" class="form-input w100" value="" style="height:25px;line-height: 25px"></td>
        </tr>
        <tr>
            <td>配音语言:</td>
            <td><input placeholder="请输入配音语言" style="width:170px;height:20px;" type="text" class="form-input w100" name="language" value="" style="height:25px;line-height: 25px"></td>
            <td>字幕语言:</td>
            <td><select style="width:155px;height:20px;" name="subtitles" class="form-input w100" id="subtitles">
                    <option value="0">请选择</option>
                    <option value="中文" >中文</option>
                    <option value="英文">英文</option>
                    <option value="日语">日语</option>
                    <option value="法语">法语</option>
                    <option value="其他">其他</option>
                </select></td>
        </tr>
        <tr class='fen' bgcolor="#F0FDFF">
            <td class="dir">评分</td>
            <td><input placeholder="请输入评分,格式如6.2" style="width:170px;height:20px;" type="text" class="form-input w100" name="score" value="" style="height:25px;line-height: 25px;"></td>
            <td>清晰度</td>
            <td><input placeholder="请输入清晰度" style="width:155px;height:20px;" type="text" class="form-input w100"  style="height:25px;line-height: 25px;"></td>
        </tr>
        <!--<tr>
            <td>标签:</td>
            <td colspan="3"><input type="text" class="form-input w400" name="keyword" value="<?php echo !empty($arr['keyword'])?$arr['keyword']:''?>" style="height:25px;line-height: 25px;"></td>
        </tr>-->
        <tr>
            <td class="dir">标签:</td>
            <td colspan="2" class="keyword"></td><input type="hidden" class="form-input w400" name="keyword" value="" style="height:25px;line-height: 25px"></td>
            <td><input style='height:20px;width:100px;' type="button" class="btn key_btn" value="添加标签"></td>
        </tr>
        <tr bgcolor="#F0FDFF">
            <td>关键字:</td>
            <td colspan="3"><input placeholder="请输入关键字并以/分隔,例如：演员1/演员2/演员3" style="width:520px;height:20px;" type="text" class="form-input w400" name="short" value="" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="num" >
            <td>更新集数:</td>
            <td><input style="width:170px;height:20px;" type="text" class="form-input w400" name="num" value="" style="height:25px;line-height: 25px;"></td>
    
            <td>总集数:</td>
            <td ><input style="width:170px;height:20px;" type="text" class="form-input w400" name="total" value="" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="end" bgcolor="#F0FDFF">
            <td>是否完结:</td>
            <td colspan="3"><label for="noCharge"><input type="radio" name="end" id="noCharge" value="1" />是</label>
                <label for="charge"><input type="radio" name="end" id="charge" value="2" />否</label></td>
        </tr>
        <tr class="bftime" style="bftime">
            <td>播放时间:</td>
            <td><input placeholder="请输入播放时间" style="width:170px;height:20px;" type="text" class="form-input w100" name="bftime" value="" style="height:25px;line-height: 25px;"></td>
            <td>电视台:</td>
            <td><input placeholder="请输入电视台" style="width:155px;height:20px;"  type="text" class="form-input w100" name="tvstation" value="" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="act" bgcolor="#F0FDFF">
            <td >导演:</td>
            <td colspan="3"><input placeholder="请输入导演名称" style="width:520px;height:20px;" type="text" class="form-input w100" name="director" value="" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="act" >
            <td >演员:</td>
            <td colspan="3"><input placeholder="请输入演员名称并以/分隔 如：演员1/演员2/演员3" style="width:520px;height:20px;" type="text" class="form-input w400" name="actor" value="" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="pri" style="display:none">
            <td>奖项:</td>
            <td><input type="text" class="form-input w100" name="prize" value="" style="height:25px;line-height: 25px;"></td>
            <td>票房:</td>
            <td><input type="text" class="form-input w100" name="boxoffice" value="" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="com" bgcolor="#F0FDFF">
            <td >影评:</td>
            <td colspan="3"><input style="width:520px;height:20px;" type="text" class="form-input w100" name="comment" value="" style="height:25px;line-height: 25px;"></td>
        </tr>
          <tr bgcolor="#E2EEFB">
        <td colspan="4" style="text-align: center;font-size: 13px;color：#333333">
           <input type="submit" style="font-size:12px;font-family: '微软雅黑 Bold', '微软雅黑 Regular', '微软黑雅';font-weight: 700;font-style: normal;color:#FFFFFF;height：22px;width:120px;" class="btn sub_btn" value="保存基本信息" >
        </td>
       </tr>
    </table>

</form>    
<script>
    $('.sub_btn').click(function(){
        var title = $('input[name=title]').val();
        var cp = $('input[name=cp]').val();
        var simple_set = $('input[name=simple_set]:checked').val();
        var templateType = $('#templateType').val();
        var info = $('.info').val();
        var score = $('input[name=score]').val();
        var keyword = $('.keyword').html();
        var initial = $('input[name=initial]').val();
        var type = '';
        $("input[name='type[]']:checked").each(function() {

            type += $(this).val()+' ';

        });


        if(empty(title)){
            alert("资产名称不能为空");
            return false;
        }
        if(empty(cp)){
            alert("牌照方不能为空");
            return false;
        }
        if(empty(simple_set)){
            if(simple_set!=0){
                alert("单集多集为空");
                return false;
            }
        }
        if(empty(info)){
            alert("看点不能为空");
            return false;
        }
        if(empty(templateType)){
            alert("模板不能为空");
            return false;
        }
        if(templateType!='E'){
            if(empty(score)){
                alert("评分不能为空");
                return false;
            }
            if(empty(initial)){
                alert("首字母不能为空");
                return false;
            }
        }
            if(empty(keyword)){
                alert("标签不能为空");
                return false;
            }
        if(!type){
            alert("类型不能为空");
            return false;
        }

    })
    $('.key_btn').click(function(){
        var p =1;
        $.getJSON('<?php echo $this->get_url('content','keylist')?>',{p:p},function(d){
            if(d.code == 200){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['830px', '550px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })
    function aa(){
        var templateType = $('#templateType').val();
        if(templateType=='E'){
            $('.dir').addClass('active');
        }else{
            $('.dir').removeClass('active');
        }
    }
</script>

