<div class="btn-parent">
    <a href="<?php echo Yii::app()->createUrl('/version/guide/epgadd',array('mid'=>$this->mid))?>" class="btn">新建EPG</a>
</div>
<div class="mt10">
    <form action="">
        <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
            <tr>
                <th>编号</th>
                <th>标题</th>
                <th>epg</th>
                <th>操作</th>
            </tr>
            <?php
            if(!empty($list)){
                foreach($list as $l){?>
                        <tr>
                            <input type="hidden" value="<?php echo $l['id']?>">
                            <td><?php echo $l['id']?></td>
                            <td><?php echo $l['epgName']?></td>
                            <td><?php echo $l['epg']?></td>
                            <td><a class="del">删除</a></td>
                        </tr>
                    <?php
                }
            }
            ?>
        </table>
    </form>
</div>
<script>
    $('.del').click(function(){
        var id= $(this).parent().siblings().val();
        $.post("<?php echo $this->get_url('guide','epgdel')?>",{id:id},function(d){
            if(d.code==200){
                alert(d.msg);
                location.reload();
            }else{
                alert(d.msg);
            }
        },'json')
    })
</script>
