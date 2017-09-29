<script charset="utf-8" type="text/javascript" src="/js/jdate/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/js/jdate/jquery.datetimepicker.css" />
<div style="height:10px"></div>
<div>
    用户名称:
    <input type="text" value="" name='usernames' class="form-input w150">
    公司:
    <input type="text" value="" name='company' class="form-input w150">
    <input type="button"  class="btn btn_search" value="查询用户">
</div>
<div class="mt10">
    <form action="">
        <input type="hidden" name="fu" value="<?php echo $fu?>">
        <div class="fenlei" style="height:400px;overflow:auto">
        <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>省市</th>
                <th>公司</th>
                <th>联系方式</th>
            </tr>
            <?php
            if(!empty($list)){
                foreach($list as $k=>$v){
                    ?>
                    <tr>
                        <td><input  type="checkbox" name="adminid" value="<?php echo $v['id']?>"></td>
                        <td><input class="form-input" type='text' name='username' value="<?php echo $v['nickname']?>" ></td>
                        <td><?php echo $v['pro']?>/<?php echo $v['city'] ?></td>
                        <td><?php echo $v['company'] ?></td>
                        <td><?php echo $v['tel'] ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
        </div>
        <table style="width:100%">
           
        <tr>
     <td colspan="5" align="center">
                    <input style="width:80px;height:30px;padding:0px" type="button" value="添加" class="btn useradd">
                    <input style="width:80px;height:30px;padding:0px" type="button" value="取消" class="gray cancel" >
                </td>
            </tr>
            </table>
    </form>
</div>
<script>
    /*$('.useradd').click(function(){
        var ids="";
        $("input[name='adminid']:checked").each(function() {

            ids += $(this).val()+' ';

        });
        $.post("<?php echo $this->get_url('station','ajaxadd')?>",{id:ids},function(d){

        })
    })*/
    $(document).off("click").on('click','.useradd',function(){
        var fu = $('input[name=fu]').val();
        var newid = "";
        var order="";
        $("input[name='adminid']:checked").each(function() {

            newid+= $(this).val()+' ';
            order +=$(this).parent().next().children('input').val()+' ';
        });
        var ids = trim(newid).split(' ');
        var orders = trim(order).split(' ');
        //return false;
        //var c = $.extend(ids, orders);
        if(!empty(ids)){
        var str = '#'+fu;
        for(var i=0;i<count(ids);i++){
            var li = "<tr><td colspan='2' align='center'><input type='hidden' name="+fu+'[]'+" value="+ids[i]+">"+orders[i]+"</td><td colspan='2'  align='center' class='del' onclick='del(this)'>删除</td></tr>";
            $(str).before(li);
        }
        }
        layer.closeAll();

    })
    $('.cancel').click(function(){
        layer.closeAll();
    })
    
    $('.btn_search').click(function(){
        var usernames = $('input[name=usernames]').val();
        var company = $('input[name=company]').val();
        var mid = <?php echo $_REQUEST['mid']?>;
        url = "/version/station/getlist?usernames="+usernames+"&company="+company+"&mid="+mid;
        ajax(url);
    })

    function ajax(url){
        $.ajax({
            type: 'GET',
            url: url,
            /*data: {'page': 1 },*/
            dataType: 'json',
            success: function(json) {
                //console.log(json);
                $('.fenlei').empty();
                var li = '';
                li += '<table width="100%" cellspacing="0" cellpadding="10" class="mtable center"><tr><th>ID</th><th>用户名</th><th>省市</th><th>公司</th><th>联系方式</th></tr>';
                    $.each(json, function(index, array) {
                        li += "<tr><td><input type='checkbox' name='adminid' value="+array['id']+"></td><td><input class='form-input' type='text' name='username' value="+array['nickname']+" ></td><td>"+array['pro']+"/"+array['city']+"</td><td>"+array['company']+"</td><td>"+array['tel']+"</td></tr>";
                    })
                li +='</table>';
                $('.fenlei').append(li);
            },
            complete: function() {
                //getPageBar();//js生成分页，可用程序代替
            },
            error: function() {
                alert("数据异常,请检查是否json格式");
            }
        });
    }

    function trim(ver)
    {
        return ver.replace(/^\s+/, '').replace(/\s+$/, '');
    }
</script>


