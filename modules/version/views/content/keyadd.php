<style>
.mtable td{
padding:0px;
}
</style>
<form action="" method="post" enctype="multipart/form-data">
    <table class="mtable"  cellpadding="10" cellspacing="0">
        <input type="hidden" name="vid" value="<?php echo !empty($id)?$id:''?>">
        <tr>
            <td width="100" align="right">标签：</td>
            <td style="padding-top:2px;padding-left:5px;height:30px;width:200px;"><input style="height:20px;width:190px;" type="text" name="vname" value="<?php echo !empty($keyword->attributes['keyword'])?$keyword->attributes['keyword']:'';?>" class="form-input"></td>
        </tr>
        <tr>
            <td width="100" align="right">节目类型：</td>
            <td style="padding-top:2px;padding-left:5px;height:30px;width:200px;">
                <select style="height:20px;width:190px;" name="type" class="form-input w100" id="vtype" >
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='0'){echo "selected=selected";}?> value="0">请选择</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='电影'){echo "selected=selected";}?> value="电影" >电影</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='综艺'){echo "selected=selected";}?> value="综艺">综艺</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='新闻'){echo "selected=selected";}?> value="新闻">新闻</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='电视剧'){echo "selected=selected";}?> value="电视剧">电视剧</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='动漫'){echo "selected=selected";}?> value="动漫">动漫</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='教育'){echo "selected=selected";}?> value="教育">教育</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='体育'){echo "selected=selected";}?> value="体育">体育</option>
                    <option  <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='音乐'){echo "selected=selected";}?> value="音乐">音乐</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='娱乐'){echo "selected=selected";}?> value="娱乐">娱乐</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='健康'){echo "selected=selected";}?> value="健康">健康</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='纪实'){echo "selected=selected";}?> value="纪实">纪实</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='旅游'){echo "selected=selected";}?> value="旅游">旅游</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='法制'){echo "selected=selected";}?> value="法制">法制</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='搞笑'){echo "selected=selected";}?> value="搞笑">搞笑</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='时尚'){echo "selected=selected";}?> value="时尚">时尚</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='军事'){echo "selected=selected";}?> value="军事">军事</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='财经'){echo "selected=selected";}?> value="财经">财经</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='曲艺'){echo "selected=selected";}?> value="曲艺">曲艺</option>
                    <option <?php $type = !empty($keyword->attributes['type'])?$keyword->attributes['type']:'';if($type=='奥运'){echo "selected=selected";}?> value="奥运">奥运</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center" height="35">
                <input style="width:80px;height:30px;" type="submit" value="保存信息" class="btn classify_btn">
                <input style="width:80px;height:30px;padding:0px;" type="button" value="返回列表" class="gray">
            </td>
        </tr>
    </table>
</form>
<script>
    $('.classify_btn').click(function(){
        var G={};
        G.id = $('input[name=vid]').val();
        G.type = $('#vtype').val();
        G.name = $('input[name=vname]').val();
        if(empty(G.name)){
            layer.alert('关键词不能为空');
            return false;
        }
        $.post("<?php echo $this->get_url('content','keysub')?>",G,function(d){
            location.reload();
        })
        return false;
    })

    $('.gray').click(function(){
        layer.closeAll();
    })
</script>


