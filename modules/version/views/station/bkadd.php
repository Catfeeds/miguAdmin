<form action="" method="post" enctype="multipart/form-data" xmlns="http://www.w3.org/1999/html">
    <table style="width:100%" cellspacing="0" cellpadding="10" class="mtable center" width="600px">
        <input type="hidden" value="<?php echo $_REQUEST['nid']?>" name="gid">
        <tr>
            <td>专题模板</td>
            <td>
                <select name="type" class="form-input w100" id="type" onchange="selectType(this)">
                    <option value="0">请选择</option>
                    <option   value="1" >海报专题</option>
                    <option   value="2" >排行榜专题</option>
                    <option   value="4" >自定义模板专题</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>背景图</td>
            <td>
                <input type="file" class="form-input w400" value="" name="url">
		<input type="text" class="form-input w400" value="" name="urls">
            </td>
        </tr>



        <tr>
            <td colspan="2" align="center"><input style="width:80px;height:30px;padding:0px;float: none" class="btn" type="submit" value="保存">
		    <input style="width:80px;height:30px;padding:0px;float: none" class="btn grey" type="button" value="取消"></td>
        </tr>

        <div class="my_template" style="display: none;">
            <span class="name">模板：</span>
            <select style="width:100px;margin:7px;"  name="template_id" onchange="showTemplate()"  id="template" class="form-input w200 field">
                <option value="0">--------------请选择-------------</option>
                <option onclick="showTemplate(this)" value="1" selected="selected">1</option>
                <option value="2" onclick='showTemplate(this)'>2</option>
                <option value="3" onclick="showTemplate(this)">3</option>
                <option value="4" onclick="showTemplate(this)">4</option>
                <option value="5" onclick="showTemplate(this)">5</option>
                <option value="6" onclick="showTemplate(this)">6</option>
                <option value="7" onclick="showTemplate(this)">7</option>
                <option value="8" onclick="showTemplate(this)">8</option>
                <option value="9" onclick="showTemplate(this)">9</option>
                <option value="10" onclick="showTemplate(this)">10</option>
                <option value="11" onclick="showTemplate(this)">11</option>
                <?php
                $data = VerTemplate::model()->findAll();
                ?>
                <?php foreach($data as $v):?>
                    <option value="<?php echo $v->attributes['id']+11?>" onclick="showTemplate(this)"><?php echo $v->attributes['name']?></option>
                <?php endforeach;?>
            </select>
            <div class="templatePic">
                <img src="/file/template/t01.png" alt="" width='600px' height='300px'>
            </div>
        </div>
    </table>
    <form>
<script>
$('.grey').click(function(){
layer.closeAll();
})

function selectType(obj)
{
    var option_id = $('#type option:selected').val();
    if(option_id == 4){
        $('.my_template').show();
    }else{
        $('.my_template').hide();
    }
}

function showTemplate(obj)
{

    var templateId = $('#template  option:selected').val();

    switch (templateId)
    {
        case '1' :
            $('.templatePic').children('img').attr('src','/file/template/t01.png');
            break;
        case '2' :
            $('.templatePic').children('img').attr('src','/file/template/t02.png');
            break;
        case '3' :
            $('.templatePic').children('img').attr('src','/file/template/t03.png');
            break;
        case '4' :
            $('.templatePic').children('img').attr('src','/file/template/t04.png');
            break;
        case '5' :
            $('.templatePic').children('img').attr('src','/file/template/t05.png');
            break;
        case '6' :
            $('.templatePic').children('img').attr('src','/file/template/t06.png');
            break;
        case '7' :
            $('.templatePic').children('img').attr('src','/file/template/t07.png');
            break;
        case '8' :
            $('.templatePic').children('img').attr('src','/file/template/t08.png');
            break;
        case '9' :
            $('.templatePic').children('img').attr('src','/file/template/t09.png');
            break;
        case '10' :
            $('.templatePic').children('img').attr('src','/file/template/t10.jpg');
            break;
        case '11' :
            $('.templatePic').children('img').attr('src','/file/template/t11.jpg');
            break;
    <?php foreach($data as $v):?>
        case <?php echo "'".($v->attributes['id']+11)."'"?>:
            $('.templatePic').children('img').attr('src','<?php echo $v->attributes["pic"]?>');
            break;
    <?php endforeach;?>

    }

}
</script>
