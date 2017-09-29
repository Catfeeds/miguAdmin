<style>
    .center{
        width:200px;
        height:300px;
        float:left;
        margin-left: 10px;
    }
    .topPic{
        width:200px;
        height:115px;
        float:left;
        position: relative;
    }
    .topPic img{
        width:200px;
        height:115px;
    }
    .edit{
        width:80px;
        height:40px;
        color:white;
        position: absolute;
        top:0px;
        left:-13px;
        text-align: center;
        line-height: 40px;
	z-index:100;
    }
    .del{
        width:80px;
        height:40px;
        color:white;
        position: absolute;
        top:0px;
        left:130px;
        text-align: center;
        line-height: 40px;
	z-index:100;
    }
    ul{
        display:block;
        float:left;
    }
    .lit{
        width:200px;
        height:60px;
        margin-top:5px;
        display: block;
        float:left;
        position: relative;
    }
    .lit img{
        width:200px;
        height:60px;

    }
    .top_app{
        width:200px;
        height:50px;
        text-align: center;
        line-height: 50px;
        font-size: 30px;
        background: #0b93d5;
    }
    .title{
        width:200px;
        height:50px;
        font-size: 30px;
        position: absolute;
        top:20px;
        text-align: center;
        line-height: 50px;
    }
    body{
        width:200%;
        height:200%;
        overflow: auto;
    }
   .appImg{
	width: 99px;
    height: 60px;
    position: absolute;
    top: 1px;
    left: 8px;
    z-index:1;	
   }	
   .appImg img{
	width: 99px;
    height: 60px;
   }
   .appTitle{
      width: 100px;
    height: 50px;
    position: absolute;
    top: 0px;
    left: 100px;
    text-align: center;
    line-height: 50px;
    font-size: 30px;	
   }		
</style>

<body>
<?php
    if(!empty($list)){
        foreach ($list as $k=>$v) {?>
            <div class="center">
                <div class="topPic">
                    <span class="edit" onclick="edit(this)" uiId="<?php echo $v[0]['id'] ?>">修改</span>
                    <span class="del" onclick="del(this)" uiId="<?php echo $v[0]['id'] ?>">删除</span>
                    <img src="<?php echo $v[0]['pic'] ?>" alt="" imgFlag="1">
                </div>
                <ul>
            <?php foreach ($v as $key=>$val) {
                    if($key>0){
            ?>
                        <li class="lit" style="background:#223C61;">
                            <span class="edit" onclick="edit(this)" uiId="<?php echo $val['id'] ?>">修改</span>
                            <span class="del" onclick="del(this)" uiId="<?php echo $val['id'] ?>">删除</span>
                            <span class="title"><?php echo $val['title']; ?></span>
                        </li>
            <?php
                    }
                }
            ?>
                </ul>
            </div>
            <?php
            }
        }
?>

<?php
    if(!empty($res)){?>
<div class="center">
    <div class="top_app">
        应用排行榜
    </div>
    <ul>
        <?php foreach ($res as $k=>$v){?>
            <li class="lit" style='background: #223C61;'>
                <span class="edit" onclick="edit(this)" appFlag="1"  uiId="<?php echo $v['id'] ?>">修改</span>
                <span class="del" onclick="del(this)" uiId="<?php echo $v['id'] ?>">删除</span>
                <span class="appImg">
                <img src="<?php echo $v['pic'];?>" alt="" appFlag="1"  order="1">
            </span>
                <span class="appTitle"><?php echo $v['title']?></span>
            </li>
        <?php }?>
        <?php
    echo "</ul>
</div>";
    }
?>


<div class="center">
    <div class="topPic">
        <span class="edit" onclick="edit(this)">修改</span>
        <span class="del" onclick="del(this)">删除</span>
        <img src="../../file/3.png" alt="" onclick="add(this)" imgFlag="1" order="1">
    </div>
    <ul>
        <li class="lit">
            <span class="edit" onclick="edit(this)">修改</span>
            <span class="del" onclick="del(this)">删除</span>
            <img src="../../file/3.png" alt="" onclick="add(this)" order="2">
        </li>
        <li class="lit">
            <span class="edit" onclick="edit(this)">修改</span>
            <span class="del" onclick="del(this)">删除</span>
            <img src="../../file/3.png" alt="" onclick="add(this)" order="3">
        </li>
        <li class="lit">
            <span class="edit" onclick="edit(this)">修改</span>
            <span class="del" onclick="del(this)"> 删除</span>
            <img src="../../file/3.png" alt="" onclick="add(this)" order="4">
        </li>
        <li class="lit">
            <span class="edit" onclick="edit(this)">修改</span>
            <span class="del" onclick="del(this)">删除</span>
            <img src="../../file/3.png" alt="" onclick="add(this)" order="5">
        </li>
    </ul>
</div>


<div class="center">
    <div class="top_app">
       应用排行榜
    </div>
    <ul>
        <li class="lit">
            <span class="edit" onclick="edit(this)">修改</span>
            <span class="del" onclick="del(this)">删除</span>
            <span>
                <img src="../../file/3.png" alt="" appFlag="1" onclick="add(this)" order="1">
            </span>
        </li>
        <li class="lit">
            <span class="edit" onclick="edit(this)">修改</span>
            <span class="del" onclick="del(this)">删除</span>
            <img src="../../file/3.png" alt="" appFlag="1" onclick="add(this)" order="2">
        </li>
        <li class="lit">
            <span class="edit" onclick="edit(this)">修改</span>
            <span class="del" onclick="del(this)">删除</span>
            <img src="../../file/3.png" alt="" appFlag="1" onclick="add(this)" order="3">
        </li>
        <li class="lit">
            <span class="edit" onclick="edit(this)">修改</span>
            <span class="del" onclick="del(this)">删除</span>
            <img src="../../file/3.png" alt="" appFlag="1" onclick="add(this)" order="4">
        </li>
        <li class="lit">
            <span class="edit" onclick="edit(this)">修改</span>
            <span class="del" onclick="del(this)">删除</span>
            <img src="../../file/3.png" alt="" appFlag="1" onclick="add(this)" order="5">
        </li>
    </ul>
</div>
</body>
<script>

    function add(obj)
    {
        var gid = "<?php echo $_GET['nid']?>";
        var mid = "<?php echo $this->mid?>";
        var order = $(obj).attr('order');
        if($(obj).attr('imgFlag') == '1'){
            $.getJSON('<?php echo $this->get_url('top','rankingAddView')?>', {gid: gid,mid:mid,order:order}, function (d)
            {
                if (d.code == 200) {
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-rim', //加上边框
                        area: ['730px', '556px'], //宽高
                        content: d.msg
                    })
                } else {
                    layer.alert(d.msg, {icon: 0});
                }
            });
        }else if($(obj).attr('appFlag') == '1'){
            $.getJSON('<?php echo $this->get_url('top','rankingAddView')?>', {gid: gid,mid:mid,appFlag:1,order:order}, function (d)
            {
                if (d.code == 200) {
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-rim', //加上边框
                        area: ['730px', '556px'], //宽高
                        content: d.msg
                    })
                } else {
                    layer.alert(d.msg, {icon: 0});
                }
            });
        }else{
            var imgFlag = 1;
            $.getJSON('<?php echo $this->get_url('top','rankingAddView')?>', {gid: gid,mid:mid,imgFlag:imgFlag,order:order}, function (d)
            {
                if (d.code == 200) {
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-rim', //加上边框
                        area: ['730px', '556px'], //宽高
                        content: d.msg
                    })
                } else {
                    layer.alert(d.msg, {icon: 0});
                }
            });
        }
    }

    function edit(obj)
    {
        var mid = "<?php echo $this->mid;?>";
        var id = $(obj).attr('uiId');
        var imgFlag = $(obj).parent('div').find('img').attr('imgFlag');
        if(imgFlag){
	    //alert('2');	
            $.getJSON('<?php echo $this->get_url('top','rankingEditView')?>', {id:id,mid:mid}, function (d)
            {
                if (d.code == 200) {
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-rim', //加上边框
                        area: ['730px', '556px'], //宽高
                        content: d.msg
                    })
                } else {
                    layer.alert(d.msg, {icon: 0});
                }
            });
        }else if($(obj).attr('appFlag') == '1'){
            //alert('1');return false;	
	    $.getJSON('<?php echo $this->get_url('top','rankingEditView')?>', {id:id,mid:mid,imgFlag:1,appFlag:1}, function (d)
            {
                if (d.code == 200) {
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-rim', //加上边框
                        area: ['730px', '556px'], //宽高
                        content: d.msg
                    })
                } else {
                    layer.alert(d.msg, {icon: 0});
                }
            });
        }else{
	    //alert('3');return false;	
            $.getJSON('<?php echo $this->get_url('top','rankingEditView')?>', {id:id,mid:mid,imgFlag:1}, function (d)
            {
                if (d.code == 200) {
                    layer.open({
                        type: 1,
                        skin: 'layui-layer-rim', //加上边框
                        area: ['730px', '556px'], //宽高
                        content: d.msg
                    })
                } else {
                    layer.alert(d.msg, {icon: 0});
                }
            });
        }
    }

    function del(obj)
    {
        var mid = "<?php echo $this->mid;?>";
        var id = $(obj).attr('uiId');
        var imgFlag = $(obj).parent('div').find('img').attr('imgFlag');
        var $_this = $(obj);
        $.ajax
        ({
            type:"get",
            url:"/version/top/delRanking/mid/"+mid+'/id/'+id,
            success:function(data)
            {
                if(data == '200'){
                    if(imgFlag){
                        $_this.parent().children('img').attr('src','../../file/3.png')
                    }else{
                        $_this.parent().children('span').eq(2).remove();
                        $_this.parent().append("<img src='../../file/3.png'  onclick='add(this)' style='width:200px;height:60px;'>");
                    }
                }
            },
            error:function()
            {
                alert('删除失败，请再试一次。');
            }
        })

    }

</script>
