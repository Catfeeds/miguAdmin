<style type="text/css">
#page{
	text-align: center;
}

</style>
<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<!--<input type="text" name="title"  class="form-input w100" value="" placeholder="请输入标题">-->

<!--<tr>
    <td width="100" align="right">节目类型：</td>
    <td colspan="3">
        <input  type="checkbox" name="type"  value="电影" >电影
        <input  type="checkbox" name="type"  value="综艺" >综艺
        <input  type="checkbox" name="type"  value="新闻" >新闻
        <input  type="checkbox" name="type"  value="电视剧" >电视剧
        <input  type="checkbox" name="type"  value="动漫" >动漫
        <input  type="checkbox" name="type"  value="教育" >教育
        <input  type="checkbox" name="type"  value="体育" >体育
        <input  type="checkbox" name="type"  value="音乐" >音乐
        <input  type="checkbox" name="type"  value="娱乐" >娱乐
        <input  type="checkbox" name="type"  value="健康" >健康
        <input  type="checkbox" name="type"  value="旅游" >旅游
        <input  type="checkbox" name="type"  value="法制" >法制
        <input  type="checkbox" name="type"  value="搞笑" >搞笑
        <input  type="checkbox" name="type"  value="时尚" >时尚
        <input  type="checkbox" name="type"  value="军事" >军事
        <input  type="checkbox" name="type"  value="财经" >财经
        <input  type="checkbox" name="type"  value="曲艺" >曲艺
        <input  type="checkbox" name="type"  value="奥运" >奥运
        <input  type="checkbox" name="type"  value="纪实" >纪实
    </td>
</tr>-->

    <!--<td width="100" align="right">牌照方：</td>
    <td width="400">
        <input  type="checkbox" name="cps"  value="642001" >华数
        <input  type="checkbox" name="cps"  value="BESTVOTT" >百视通
        <input  type="checkbox" name="cps"  value="ICNTV" >未来电视
        <input  type="checkbox" name="cps"  value="youpeng" >南传
        <input  type="checkbox" name="cps"  value="HNBB" >芒果
        <input  type="checkbox" name="cps"  value="CIBN" >国广
        <input  type="checkbox" name="cps"  value="YGYH" >银河
    </td>-->
<div style="height:10px;"></div>
        <input style="float: left;height:30px;width:200px;margin-left: 5px;" type="text" name="title" class="form-input w300" value="">

<input style="float: left;height:30px;width:80px;margin-left: 5px;" type="button" value="查找" class="btn search_btn">


<input style="float: left;height:30px;width:80px;margin-left: 5px;" class="btnall btn" type="button" value="全选">
<input style="float: left;height:30px;width:80px;margin-left: 5px;" class="btnno btn" type="button" value="全不选">
<input style="float: left;height:30px;width:80px;margin-left: 5px;" class="btn btn1 btn-gray btn_add " type="button"  value="添加" name="" style="margin-left:200px">
<div style="height:10px;clear: both"></div>
<div id="fenlei">
<table class="mtable" width="100%" cellspacing="0" cellpadding="10">
    <tr>
        <th>编号</th>
        <th>牌照方</th>
        <th>标题</th>
        <th>语言</th>
        <th>类型</th>
        <th>添加时间</th>
    </tr>
</table>
</div>
<div id="page"></div>
<script>

    $('.btnall').click(function(){
        $("#fenlei :checkbox").prop("checked", true);
    })
    $('.btnno').click(function(){
        $("#fenlei :checkbox").prop("checked", false);
    })

    $('.btn_add').click(function(){
        var ids="";
        $("input[name='ajaxvid']:checked").each(function() {

            ids += $(this).val()+' ';

        });
        var gid = "<?php echo $_REQUEST['nid']?>";
        $.post("<?php echo $this->get_url('site','ajaxadd')?>",{ids:ids,gid:gid},function(d){
            location.reload();
        })
    })
    $('.next').click(function(){
        var page = $(this).attr('val');
        getData(page);
    })

    $('.search_btn').click(function(){
        getData(1)
    })

    function getData(page){

        var title = $('input[name=title]').val();
        /*var cps="";
        $("input[name='cps']:checked").each(function() {

            cps += $(this).val()+' ';

        });
        if(empty(cps)){
            layer.alert('请选择牌照方');
            return false;
        }
        //G.type = $('#type').val();
        var type = "";
        $("input[name='type']:checked").each(function() {

            type += $(this).val()+' ';

        });*/
        $.ajax({
                type: 'GET',
                url: '/version/site/firstajax?mid='+"<?php echo $_GET['mid']?>",
                data: {'page': page,title:title },
                dataType: 'json',
                success: function(json) {
                    $("#fenlei").empty();
                    total_num = json.total_num;//总记录数
                    page_size = json.page_size;//每页数量
                    page_cur = page;//当前页
                   page_total_num = json.page_total_num;//总页数
                   var li = '<table class="mtable" width="100%" cellspacing="0" cellpadding="10"><tr><th>编号</th><th>牌照方</th><th>标题</th><th>类型</th><th>语言</th><th>添加时间</th></tr>';
                    var list = json.list;
                    $.each(list, function(index, array) { //遍历返回json
                        switch(array['cp']){
                            case '642001':array['cp']='华数';break;
                            case 'BESTVOTT':array['cp']='百视通';break;
                            case 'ICNTV':array['cp']='未来电视';break;
                            case 'youpeng':array['cp']='南传';break;
                            case 'HNBB':array['cp']='芒果';break;
                            case 'CIBN':array['cp']='国广';break;
                            case 'YGYH':array['cp']='银河';break;
                        }
                        li += "<tr><td><input type='checkbox' class='checkbox' name='ajaxvid' value="+array['vid']+"></td><td>"+array['cp']+"</td><td>"+array['title']+"</td><td>"+array['type']+"</td><td>"+array['language']+"</td><td>"+getLocalTime(array['cTime'])+"</td></tr>";
                    });
                    if(list == '') li +='<tr><td  colspan="6" align="center">暂无数据</td></tr>';
                    li += '</table>';
                    $("#fenlei").append(li);
               },
                complete: function() {
                    getPageBar();//js生成分页，可用程序代替
                },
                error: function() {
                   alert("数据异常,请检查是否json格式");
                }
            });
    }

    function getPageBar() { //js生成分页
           if (page_cur > page_total_num)
               page_cur = page_total_num;//当前页大于最大页数
            if (page_cur < 1)
                page_cur = 1;//当前页小于1
            page_str = "<span>&nbsp;&nbsp;共&nbsp;&nbsp;" + total_num + "&nbsp;&nbsp;条&nbsp;&nbsp;</span><span>" + page_cur + "/" + page_total_num + "</span>";
            if (page_cur == 1) {//若是第一页
                page_str += "<span>&nbsp;&nbsp;首页&nbsp;&nbsp;</span><span>&nbsp;&nbsp;上一页&nbsp;&nbsp;</span>";
           } else {
               page_str += "<span><a href='javascript:void(0)' data-page='1' onclick=getData(1)>&nbsp;&nbsp;首页&nbsp;&nbsp;</a></span><span><a href='javascript:void(0)' data-page='" + (page_cur - 1) + "' onclick=getData("+ (parseInt(page_cur) - 1) +")>&nbsp;&nbsp;上一页&nbsp;&nbsp;</a></span>";
            }
            if (page_cur >= page_total_num) {//若是最后页
                page_str += "<span>&nbsp;&nbsp;下一页&nbsp;&nbsp;</span><span>&nbsp;&nbsp;尾页&nbsp;&nbsp;</span>";
            } else {
                page_str += "<span><a href='javascript:void(0)' data-page='" + (parseInt(page_cur) + 1) + "' onclick=getData("+ (parseInt(page_cur) + 1) +") >&nbsp;&nbsp;下一页&nbsp;&nbsp;</a></span><span><a href='javascript:void(0)' data-page='" + page_total_num + "'  onclick=getData("+ (page_total_num) +")>&nbsp;&nbsp;尾页&nbsp;&nbsp;</a></span>";
           }
            $("#page").html(page_str);
        }
    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
    }
</script>

