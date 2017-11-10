<style>
    .fa{
        width:1000px;
        height:500px;
        background:url(/file/template/has_guide.jpg)no-repeat;
        background-size:990px 540px ;
        padding-left:<?php echo ($info->attributes['h_coord'])/2?>px;
        padding-top: <?php echo ($info->attributes['v_coord'])/2?>px;
    }
</style>
<div class="fa">
    <?php
        echo $html;
    ?>
</div>
<div>
    <input class="btn sub_btn" type="button" value="有导航">
</div>
<script>
    $('.templateParent').attr('style','position:relative;/*width:700px;height: 420px;*/float: left;');
    $('.plus_button').remove();
    var circular = <?php echo $info->attributes['circular']?>;
    if(circular == 2){
        var max = $('.templateParent').children('div').find('div').length;
        for(var i = 0 ; i< max ; i++){
            var str = $('.templateParent').children('div').find('div').eq(i).attr('style');
            var tmp = str.replace(/border-radius: 8px/g, "border-radius: 0px");
            $('.templateParent').children('div').find('div').eq(i).attr('style',tmp);
        }
    }

    $('.sub_btn').click(function()
    {
        if($(this).val() == '有导航'){
            $(this).val('无导航');
//            $('.fa').css('padding-top','65');
            $('.fa').css({"background":"url(/file/template/no_guide.jpg)no-repeat","background-size":"990px 540px "});
        }else{
            $(this).val('有导航');
            $('.fa').css({"background":"url(/file/template/has_guide.jpg)no-repeat","background-size":"990px 540px "});
//            $('.fa').css('padding-top','85');
        }
    })
</script>