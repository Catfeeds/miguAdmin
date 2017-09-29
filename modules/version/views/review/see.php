<?php
$admin = $this->getMvAdmin();
?>
<form action="" method="post" enctype="multipart/form-data">
    <table class="mtable"  cellpadding="10" cellspacing="0">
        <tr>
            <td width="100" align="right">提审人：</td>
            <td><?php echo $tmp['user']?></td>
        </tr>
        <tr>
            <td width="100" align="right">提审时间：</td>
            <td><?php echo date('Y-m-d h:i:s',$tmp['addTime'])?></td>
        </tr>
        <tr>
            <td width="100" align="right">vid：</td>
            <td><?php echo $tmp['vid']?></td>
        </tr>
        <tr>
            <td width="100" align="right">标题：</td>
            <td><?php echo $tmp['title']?></td>
        </tr>
        <tr>
            <td width="100" align="right">牌照方：</td>
            <td><?php echo $tmp['cp']?></td>
        </tr>
        <tr>
            <td width="100" align="right">1审操作：</td>
            <td><?php echo date('Y-m-d h:i:s',$tmp['addTime1'])?><?php
                if(!empty($tmp['message1'])){
                    echo '驳回理由:';
                    echo $tmp['message1'];
                }
                ?></td>
        </tr>
        <tr>
            <td width="100" align="right">2审操作：</td>
            <td><?php echo date('Y-m-d h:i:s',$tmp['addTime2'])?><?php
                if(!empty($tmp['message2'])){
                    echo '驳回理由:';
                    echo $tmp['message2'];
                }
                ?></td>
        </tr>
        <tr>
            <td width="100" align="right">3审操作：</td>
            <td><?php echo date('Y-m-d h:i:s',$tmp['addTime3'])?><?php
                if(!empty($tmp['message3'])){
                    echo '驳回理由:';
                    echo $tmp['message3'];
                }
                ?></td>
        </tr>
        <tr>
            <td width="100" align="right">4审操作：</td>
            <td><?php echo date('Y-m-d h:i:s',$tmp['addTime4'])?><?php
                if(!empty($tmp['message4'])){
                    echo '驳回理由:';
                    echo $tmp['message4'];
                }
                ?></td>
        </tr>
        <tr>
            <td width="100" align="right">5审操作：</td>
            <td><?php echo date('Y-m-d h:i:s',$tmp['addTime5'])?><?php
                if(!empty($tmp['message5'])){
                    echo '驳回理由:';
                    echo $tmp['message5'];
                }
                ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="button" value="返回列表" class="gray">
            </td>
        </tr>
    </table>
</form>
<script>
</script>

