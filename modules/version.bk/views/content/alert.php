<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<form action="" method="post" enctype="multipart/form-data">
    <table class="mtable" width="100%" cellspacing="0" cellpadding="10">
        <tr>
            <th>类别</th>
            <th>媒体文件名称</th>
            <th>视频时长（s）</th>
            <th>速率(bps)</th>
            <th>大小(kb)</th>
            <th>格式</th>
            <th>分辨率</th>
        </tr>
        <?php if(!empty($tmp)){
            foreach($tmp as $k=>$v) {
                ?>
                 <tr>
                    <input type="hidden" name="alvid" value="<?php echo $v['lid']?>">
                    <td des="<?php echo $v['id']?>"><?php
                            switch($v['flag']){
                                case '0':echo '<a class="bofang">设为默认播放</a>';break;
                                case '1':echo '<a class="bofang">默认播放</a>';break;
                            }
                        ?></td>
                    <td><?php echo $v['title']?></td>
                    <td><?php echo $v['duration']?></td>
                    <td><?php echo $v['bitrate']?></td>
                    <td><?php echo $v['filesize']?></td>
                    <td><?php echo $v['videocodec']?></td>
                    <td><?php switch($v['HDFlag']){
                            case '0':echo '高清';break;
                            case '1':echo '标清';break;
                            case '2':echo '流畅';break;
                            case '3':echo '超高清';break;
                        }?></td>
                </tr>
                <?php
            }
        }?>
    </table>
</form>
<script>
    $('.bofang').click(function(){
        var id = $(this).parent().parent().children('input').val();
        var des = $(this).parent().attr('des');
        var str = '.mrbf-'+des;
        $.post("<?php echo $this->get_url('content','bofang')?>",{id:id},function(d){
           //location.reload();
           if(d.code==200){
                $(str).html('默认播放');
            }
            layer.closeAll();
           //layer.closeAll();
        },'json')
    })
</script>

