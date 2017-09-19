<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
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
    <?php
    if(!empty($list)){
        foreach($list as $l){?>
            <tr>
                <input type="hidden" value="<?php echo $l['vid']?>">
                <td><input type="checkbox" class="checkbox" name="id" value="<?php echo $l['id']?>"></td>
                <td><?php
                    switch(substr($l['cp'],-1)){
                        case '1':echo '华数';break;
                        case '3':echo '未来电视';break;
                        case '7':echo '银河';break;
                    }
                    ?></td>
                <td><?php echo $l['title']?></td>
                <td><?php echo $l['type']?></td>
                <td><?php echo $l['language']?></td>
                <td><?php echo date('Y/m/d H:i',$l['cTime'])?></td>
            </tr>
            <?php
        }
    }
    ?>
</table>
</div>
<div id="page">
    <span>共<?php echo $pagenum;?>条</span><?php echo $data['prePage']?>/<?php echo ceil($pagenum/10);?><a val="1" class="next">首页</a><a val="<?php echo $data['prePage']?>" class="next">上一页</a><a val="<?php echo $data['nextPage']?>" class="next">下一页</a><a val="<?php echo ceil($pagenum/10);?>" class="next">尾页</a>
</div>
<script>
    /*$('.next').click(function(){
        var page = $(this).attr('val');
        var my = layer.msg('加载中', {icon: 16,shade:1});
        $.getJSON('<?php //echo $this->get_url('guide','siteadd')?>',{page:page},function(d){
            if(d.code == 200){
                layer.closeAll();
                layer.close(my);
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['1030px', '650px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })*/
    $('.next').click(function(){
        var page = $(this).attr('val');
        getData(page);
    })

    function getData(page){
        $.ajax({
                type: 'GET',
                url: '/version/guide/ajax?mid='+"<?php echo $_GET['mid']?>",
                data: {'page': page },
                dataType: 'json',
                success: function(json) {
                    $("#fenlei").empty();
                    total_num = json.total_num;//总记录数
                    page_size = json.page_size;//每页数量
                    page_cur = page;//当前页
                   page_total_num = json.page_total_num;//总页数
                   var li = '<table class="mtable" width="100%" cellspacing="0" cellpadding="10"><tr><th>编号</th><th>牌照方</th><th>标题</th><th>语言</th><th>类型</th><th>添加时间</th></tr>';
                    var list = json.list;
                    $.each(list, function(index, array) { //遍历返回json
                        array['cp']=array['cp'].substr(array['cp'].length-1,1);
                        switch(array['cp']){
                            case '1':array['cp']='华数';break;
                            case '3':array['cp']='未来电视';break;
                            case '7':array['cp']='银河';break;
                        }
                        li += "<tr><td>"+array['id']+"</td><td>"+array['cp']+"</td><td>"+array['title']+"</td><td>"+array['type']+"</td><td>"+array['language']+"</td><td>"+getLocalTime(array['cTime'])+"</td></tr>";
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
            page_str = "<span>共" + total_num + "条</span><span>" + page_cur + "/" + page_total_num + "</span>";
            if (page_cur == 1) {//若是第一页
                page_str += "<span>首页</span><span>上一页</span>";
           } else {
               page_str += "<span><a href='javascript:void(0)' data-page='1' onclick=getData(1)>首页</a></span><span><a href='javascript:void(0)' data-page='" + (page_cur - 1) + "' onclick=getData("+ (parseInt(page_cur) - 1) +")>上一页</a></span>";
            }
            if (page_cur >= page_total_num) {//若是最后页
                page_str += "<span>下一页</span><span>尾页</span>";
            } else {
                page_str += "<span><a href='javascript:void(0)' data-page='" + (parseInt(page_cur) + 1) + "' onclick=getData("+ (parseInt(page_cur) + 1) +") >下一页</a></span><span><a href='javascript:void(0)' data-page='" + page_total_num + "'  onclick=getData("+ (page_total_num) +")>尾页</a></span>";
           }
            $("#page").html(page_str);
        }
    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
    }
</script>