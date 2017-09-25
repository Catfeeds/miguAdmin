<style>

</style>

<table style="width:900px;" class="mtable mt10" cellpadding="10" cellspacing="0">
         <tr>
    	<th style="background: #A3BAD5;height:30px;" colspan="7">编辑导航栏</th>
    </tr>
        <tr>
        	<td colspan="7" style="text-align: left;padding:5px;">
	<input type="button" value="添加导航" class="btn addBtn">
        <input type="button" value="保存排序" class="btn save-order">
	<input type="button" value="取消" class="btn goBack">
        	</td>
	</tr>
        <tr>
            <th>勾选</th>
            <th>编号</th>
            <th>焦点</th>
            <th>标题</th>
            <th>排序</th>
            <th>重新排序</th>
            <th>操作</th>
        </tr>

        <?php
        if(!empty($list)){
            $num=1;
            foreach($list as $key=>$val){
                ?>
                <tr class="trdata" id="<?php echo $num++?>">
                    <td align="center" style='width:50px;'><label><input type="checkbox" class='chosetr' name="id" onclick='chose(this)' value="<?php echo $val['id'] ;?>"/></label></td>
                    <td align="center"><?php echo $val['id']?></td>
                    <td align="center"><?php switch($val['focus']){
                           case '0':echo '焦点默认未选中';break;
                           case '1':echo '焦点默认选中';break;
                       }?></td>
                    <td align="center"><?php echo $val['title']?></td>
                    <td align="center"><?php echo $val['order']?></td>
                    <td style="padding:5px"> <input class = "form-input" type="text" name="order" id="order" value="" placeholder="输入新的排序数值"> </td>
                    <td align="center">
                        <a  class="update">编辑屏幕</a>
                        <a  class="del">删除</a>
                    </td>
                </tr>
            <?php }
        }

        ?>
        
        </tr>
</table>
<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
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
    $('.update').click(function()
    {
        var id = $(this).parent().parent().children().eq(1).text();
        var mid = "<?php echo $_GET['mid']?>";
        window.location.href = "/version/screen/updateGuide/mid/"+mid+'/id/'+id+fixedUrl;
    });

    $('.goBack').click(function()
    {
	    window.close();
    })

    $('.addBtn').click(function()
    {
        /*if(wTypeFlag != 2){
            alert('你现在还没有编辑屏幕的权限');
            return false;
        }*/
        //window.location.href = "/version/screen/addScreen/mid/<?php //echo $this->mid;?>/nid/<?php //echo $_GET['nid']?>";
        window.open("/version/screen/addScreen/mid/<?php echo $this->mid;?>/nid/<?php echo $_GET['nid']?>"+fixedUrl);
    });
	
    $('.save-order').click(function()
    {
        var max = $('.trdata').length;
        mid = <?php echo $this->mid;?>;
        var flag =0;
        for(var i = 0 ; i<max ;i++){
            var id = $('.mtable').find('.trdata').eq(i).children('td').eq(1).text();
            var order = $('.mtable').find('.trdata').eq(i).children('td').eq(5).children('input').val();
            if(order == ''){
                order = $('.mtable').find('.trdata').eq(i).children('td').eq(4).text();
//                return true;
            }else{
                $.ajax
                ({
                    type:'get',
                    url:'/version/screen/updateScreeGuideOrder/mid/'+mid+'/id/'+id+'/order/'+order,
                    success:function (data)
                    {
                        if(data == '500'){
//                            alert('修改排序失败');
                        }else if(data == 200){
                            flag = 1;
                        }
                    }
                })
            }
        }
//         if(flag == 1){
            layer.alert('修改排序成功');
            window.location.reload();
//        }

    })

     $('.del').click(function()
    {
         if(confirm('删除导航后所有的数据会清空，点确认删除，取消放弃')){
            var id = $(this).parent().parent().children().eq(1).text();
            var mid = "<?php echo $_GET['mid']?>";
            $.ajax
            ({
                type:'get',
                url:'/version/screen/deleteScreeGuide/mid/'+mid+'/id/'+id,
                success:function(data)
                {
                    if(data == 200){
                        layer.alert('删除导航成功！');
                        window.location.reload();
                    }
                }
            })
        }
    })	
</script>




