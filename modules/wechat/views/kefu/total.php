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
<form method="post" action="" >
    <table class="mtable center" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th width="10%">编号</th>
            <th width="25%">回复时间</th>
            <th width="10%">操作</th>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="text" name="first" id="first" class="form-input w100" value="<?php echo !empty($_GET['first'])?$_GET['first']:''?>">
                --
                <input type="text" name="end" id="end" class="form-input w100" value="<?php echo !empty($_GET['end'])?$_GET['end']:''?>">
            </td>
            <td>
                <input class="btn btn-gray audit_search  " type="submit"  value="查找" name="" style="font-size: 14px">
            </td>
        <tr>
    </table>
</form>
<script>
    $('#first,#end').datetimepicker({
        lang:'ch',
        validateOnBlur:false,
        timepicker:false,
        format:'Y-m-d',
        formatDate: 'Y-m-d',
        maxDate:'<?php echo date('Y-m-d',strtotime('0 day'))?>'
    });
    $('.btn').click(function(){
        var G = {}
        G.first = $('input[name=first]').val();
        G.end = $('input[name=end]').val();
        $.post('/admin/kefu/count?mid=<?php echo $this->mid?>',G,function(d){
            var list = d;
            var li = '<tr><th>&nbsp;</th><th>客服</th><th>回复总数</th></tr>';
            $.each(list, function (index, array) { //遍历返回json
                li += "<tr class='add'><td><" + array['id'] + "></td><td>" + array['worker'] + "</td><td>" + array['num'] + "</td></tr>";
            });
            $('tbody').append(li);
        },'json')
        return false;
    })

</script>
