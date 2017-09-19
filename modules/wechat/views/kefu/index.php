<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl . "/css/wx/index.css"?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl . "/css/wx/public.css"?>"/>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/wx/jquery.js"?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/wx/myString.js"?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/wx/function.js"?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/wx/PublicUser.js"?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl . "/js/wx/WechatWatchGroups_Index.js"?>"></script>
<script charset="utf-8" type="text/javascript" src="/js/jdate/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/js/jdate/jquery.datetimepicker.css" />
<style>
    .admin_border{
        min-height:500px;
        height:500px;
    }
</style>
    <form method="post" action="" >
        <table class="mtable center" cellpadding="10" cellspacing="0" width="100%">
            <tr>
                <th width="10%">编号</th>
                <th width="10%">客服</th>
               <!-- <th width="45%">对话内容</th>-->
                <th width="25%">操作时间</th>
                <th width="20%">操作</th>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <select class="form-control mselect cid" name="worker" >
                        <option value="0" >全部</option>
                        <option value="kf2017@MobileBox2015" >客服1</option>
                        <option value="kf2004@MobileBox2015" >客服2</option>
                        <option value="kf2014@MobileBox2015" >客服4</option>
                        <option value="kf2010@MobileBox2015" >客服5</option>
                        <option value="kf2011@MobileBox2015" >客服6</option>
                        <option value="kf2018@MobileBox2015" >客服9</option>
                    </select>
                </td>
                <!--<td>
                    <input class="form-input keyword" type="text" placeholder="请输入关键字" name="keyword" value="">
                </td>-->
                <td>
                    <input type="text" name="first" id="first" class="form-input w100" value="<?php echo !empty($_GET['first'])?$_GET['first']:''?>">
                    --
                    <input type="text" name="end" id="end" class="form-input w100" value="<?php echo !empty($_GET['end'])?$_GET['end']:''?>">
                </td>
                <td>
                    <input class="btn btn1 btn-gray audit_search  " type="submit"  value="查找" name="" style="font-size: 14px">
                    <input class="btn btn2 btn-gray audit_search  " type="submit"  value="导出" name="" style="font-size: 14px">
                </td>
            <tr>
        </table>
    </form>
    <div class="table">

    </div>

<script>
    $('#first,#end').datetimepicker({
        lang:'ch',
        validateOnBlur:false,
        timepicker:false,
        format:'Y-m-d',
        formatDate: 'Y-m-d',
        maxDate:'<?php echo date('Y-m-d',strtotime('0 day'))?>'
    });
    $('.btn1').click(function(){
        getData(1);
        return false;
        $.post('/admin/kefu/history?mid=<?php echo $this->mid?>',G,function(d){
            if(d.code == '404'){
                alert(d.msg);
            }else{

            }
        },'json')
        return false;
    })

    var page_cur = 1; //当前页
    var total_num, page_size, page_total_num;//总记录数,每页条数,总页数

    function getData(page) { //获取当前页数据
        worker = $('select').val();
        keyword = $('input[name=keyword]').val();
        first = $('input[name=first]').val();
        end = $('input[name=end]').val();
        var my = layer.msg('加载中', {icon: 16,shade:0.3});
        $.ajax({
            type: 'GET',
            url: '/wechat/kefu/history?mid='+"<?php echo $_GET['mid'];?>"+'&worker='+worker+'&first='+first+'&end='+end,
            data: {'page': page - 1},
            dataType: 'json',
            success: function(json) {
                $('.table').empty();
                if(json.code==404){
                    layer.close(my);
                    alert(json.msg);
                    total_num = json.total_num;//总记录数
                    page_size = json.page_size;//每页数量
                    page_cur = page;//当前页
                    page_total_num = json.page_total_num;//总页数
                    var li ='';
                    li += '<tr class="add"><td  colspan="8" align="center">暂无数据</td></tr>';
                    $('.table').html(li);
                }else {
                    total_num = json.total_num;//总记录数
                    page_size = json.page_size;//每页数量
                    page_cur = page;//当前页
                    page_total_num = json.page_total_num;//总页数
                    var list = json.list;
                    //var li = '';
                    //var li = '<table class="mtable center tbadd" cellpadding="10" cellspacing="0" width="100%"><tr><td colspan="4">客服回复数：</td><td colspan="4">'+total_num+'</td></tr><tr><th>序号</th><th>客服</th><th>text</th><th>时间</th></tr>';
                    var li = '<table class="mtable center tbadd" cellpadding="10" cellspacing="0" width="100%" height="300px"><tr><td colspan="4">客服回复数：</td><td colspan="4">'+total_num+'</td></tr><tr><th>编号</th><th>日期</th><th>录单时间</th><th>微信昵称</th><th>省份</th><th>地市</th><th>用户描述</th><th>客服工号</th></tr>';
                    $.each(list, function (index, array) { //遍历返回json
                        li += "<tr class='add'><td><" + array['id'] + "></td><td>" + array['time'] + "</td><td>" + array['ctime'] + "</td><td>" + array['openid'] + "</td><td>" + array['province'] + "</td><td>" + array['city'] + "</td><td width='30%'>" + array['text'] + "</td><td>" + array['worker'] + "</td></tr>";
                        //li += "<tr class='add'><td><" + array['id'] + "></td><td>" + array['worker'] + "</td><td width='40%'>" + array['text'] + "</td><td>" + array['time'] + "</td></tr>";
                    });
                    li +='</table>';
                    layer.close(my);
                    $('.table').html(li);
                }
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
        page_str = "<tr class='add'><td colspan='8'><span>共" + total_num + "条</span><span>" + page_cur + "/" + page_total_num + "</span>";
        if (page_cur == 1) {//若是第一页
            page_str += "<span>首页</span><span>上一页</span>";
        } else {
            page_str += "<span><a href='javascript:void(0)' data-page='1' onclick=getData(1)>首页</a></span><span><a href='javascript:void(0)' data-page='" + (page_cur - 1) + "' onclick=getData("+ (parseInt(page_cur) - 1) +")>上一页</a></span>";
        }
        if (page_cur >= page_total_num) {//若是最后页
            page_str += "<span>下一页</span><span>尾页</span>";
        } else {
            page_str += "<span><a href='javascript:void(0)' data-page='" + (parseInt(page_cur) + 1) + "' onclick=getData("+ (parseInt(page_cur) + 1) +") >下一页</a></span><span><a href='javascript:void(0)' data-page='" + page_total_num + "'  onclick=getData("+ (page_total_num) +")>尾页</a></span></td></tr>";
        }
        $(".tbadd tbody").append(page_str);
    }

    $('.btn2').click(function(){
        worker = $('select').val();
        first = $('input[name=first]').val();
        end = $('input[name=end]').val();
        window.location.href = '/wechat/kefu/out?mid=<?php echo $this->mid?>&worker='+worker+'&first='+first+'&end='+end;
        return false;
    })
</script>
