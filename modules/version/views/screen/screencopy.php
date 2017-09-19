
<form action="" method="post" enctype="multipart/form-data">
    <table class="mtable"  cellpadding="10" cellspacing="0">
        <input type="hidden" name="nid" value="<?php echo $nid; ?>">
        <tr>
            <td width="150" align="right">选择要复制的屏幕：</td>
            <td><select id="station" class="form-input w200">
                <option value="0">请选择</option>
                <?php $sql = "select * from yd_ver_station where id <> $nid";
                                          $res = SQLManager::QueryAll($sql);
                                          foreach($res as $key => $value){ ?>
                                                <option value = "<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                        <?php } ?>
            </select></td>
        </tr>
        <tr>

            <td colspan="2"  style="text-align: center">
                <input style="width:80px;height:30px;padding:0px" type="button" value="保存信息" class="btn classify_btn">
                <input style="width:80px;height:30px;padding:0px" type="button" value="返回列表" class="gray">
            </td>
        </tr>
    </table>
</form>
<script>
    $('.classify_btn').click(function(){


        nid = $("#station").val();

         copyId= $('input[name=nid]').val();
        if(empty(nid)){
                alert("请选择要复制的屏幕！");
                return false;
        }

        if(empty(copyId)){
                alert("系统错误，请刷新页面后重试！");
                return false;
        }
  if(confirm("是否确认要复制屏幕？")){
        $.post("<?php echo $this->get_url('screen','copyscreenguide')?>",{nid:nid,copyId:copyId},function(){
            location.reload();
        })
       }
    })
    $('.gray').click(function(){
       layer.closeAll();
   })
</script>

