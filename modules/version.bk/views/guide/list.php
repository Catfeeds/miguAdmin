<div class="mt10">
    <div>
        <input type="button" class="btn add" value="添加">
    </div>
    <form action="">
        <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
            <input type="hidden" name="gid" value="<?php echo $gid?>">
            <tr>
                <th>编号</th>
                <th>牌照方</th>
                <th>标题</th>
                <th>语言</th>
                <th>计费说明</th>
                <th>编入时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            <?php
            if(!empty($list)){
                foreach($list as $l){?>
                    <tr>
                        <input type="hidden" value="<?php echo $l['cid']?>">
                        <td><input type="checkbox" class="checkbox" name="id" value="<?php echo $l['cid']?>"></td>
                        <td><?php
                            switch(substr($l['cp'],-1)){
                                case '1':echo '华数';break;
                                case '3':echo '未来电视';break;
                                case '7':echo '银河';break;
                            }
                            ?></td>
                        <td><?php echo $l['title']?></td>
                        <td><?php echo $l['language']?></td>
                        <td><?php echo '免费'?></td>
                        <td><?php echo date('Y-m-d H:i',$l['vTime'])?></td>
                        <td><?php
                                switch($l['vflag']){
                                    case '0':echo '编入';break;
                                    case '1':echo '未编入';break;
                                }
                            ?></td>
                        <td><a class="noadd"><?php
                            switch($l['vflag']){
                                case '0':echo '不编入';break;
                                case '1':echo '编入';break;
                            }
                            ?></a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </form>
</div>
<div><?php echo $page;?></div>
<script>
    $('.noadd').click(function(){
        var id = $(this).parent().parent().children('input').val();
        var flag = $(this).html();
        if(flag=='不编入'){
            flag = 1;
        }else{
            flag=0
        }
        $.post("<?php echo $this->get_url('guide','noadd')?>",{id:id,flag:flag},function(d){
            location.reload();
        })
    })

    $('.add').click(function(){
        var my = layer.msg('加载中', {icon: 16,shade:0.3});
        $.getJSON('<?php echo $this->get_url('guide','siteadd')?>',function(d){
            if(d.code == 200){
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
    })




</script>