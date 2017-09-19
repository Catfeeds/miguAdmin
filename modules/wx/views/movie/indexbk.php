<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php $this->pageTitle= '咪咕专区'?></title>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/wx/js/swiper.min.css">
</head>
<style>
    *{margin: 0;padding: 0;}
    body{
        width: 100%;
    }
    #header ul li{width:50%;float:left;}
    ul{margin: 0;padding-left: 0;}
    ul li{list-style: none;}
    .swiper-container {
        width: 100%;
        height: 100%;
    }
    .swiper-slide {
        text-align: center;
        font-size: 3rem;
        background: #fff;
    }
    img{width: 100%}
    .middle{ overflow: hidden;}
    .middle div{ float: left; width: 30%;margin-bottom: -4%;}
    .middle div:nth-child(3n-1),.middle div:nth-child(3n-2){margin-right: 2%}
    .middle div:nth-child(3n-2){margin-left: 1%}
    .middle div p{font-size: 38px;color: #4c4948}
    a{ text-decoration: none;}
/*	 @media screen and (max-width:320px) {
        #hidden{display:none;background-color:black;height:100%;width:100%;text-align:center;z-index:55;position:absolute;opacity: 0.8;}
        .center{color:white;margin-left:10%;text-align: left;font-size:1.3em}
        .stbid{display:inline-block;width: 83%;height:60px;line-height:40px;outline:0;font-size: 1.3em;padding: 0; margin-left: 4%;border: 0;background-color:white;border-radius:10px;margin-top:50px;color:#39393E;margin-top:5%}
        .false{background:url("<?php echo Yii::app()->request->baseUrl; ?>/images/quxiao.png") repeat-x  center;height:50px;border-radius:10px;background-size: 112% 125%;border:none;width:40.7%;margin-top:5%;}
        .submit{background:url("<?php echo Yii::app()->request->baseUrl; ?>/images/qd1.png") repeat-x  center;height:50px;border-radius:10px;background-size: 112% 125%;border:none;width:40.7%;margin-top:5%;}
        .bottom1{color:white;font-size:0.8em;text-align: left;margin-left:9%}
    }
    @media screen and (min-width:321px) and (max-width:414px){
        #hidden{display:none;background-color:black;height:100%;width:100%;text-align:center;z-index:55;position:absolute;opacity: 0.8;}
        .center{color:white;margin-left:10%;text-align: left;font-size:1.5em}
        .stbid{display:inline-block;width: 83%;height:60px;line-height:40px;outline:0;font-size: 1.5em;padding: 0; margin-left: 4%;border: 0;background-color:white;border-radius:10px;margin-top:50px;color:#39393E;margin-top:5%}
        .false{background:url("<?php echo Yii::app()->request->baseUrl; ?>/images/quxiao.png") repeat-x  center;height:50px;border-radius:10px;background-size: 112% 125%;border:none;width:40.7%;margin-top:5%;}
        .submit{background:url("<?php echo Yii::app()->request->baseUrl; ?>/images/qd1.png") repeat-x  center;height:50px;border-radius:10px;background-size: 112% 125%;border:none;width:40.7%;margin-top:5%;}
        .bottom1{color:white;font-size:1em;text-align: left;margin-left:9%}
    }*/
    @media screen and (min-width:415px){
        #hidden{display:none;background-color:black;height:100%;width:100%;text-align:center;z-index:55;position:absolute;opacity: 0.8;}
        .center{color:white;margin-left:10%;text-align: left;font-size:4.8em}
        .stbid{display:inline-block;width: 83%;height:140px;line-height:40px;outline:0;font-size: 3.8em;padding: 0; margin-left: 4%;border: 0;background-color:white;border-radius:40px;margin-top:50px;color:#39393E;margin-top:5%}
        .false{background:url("<?php echo Yii::app()->request->baseUrl; ?>/images/quxiao.png") repeat-x  center;height:140px;border-radius:40px;background-size: 112% 125%;border:none;width:40.7%;margin-top:5%;}
        .submit{background:url("<?php echo Yii::app()->request->baseUrl; ?>/images/qd1.png") repeat-x  center;height:140px;border-radius:40px;background-size: 112% 125%;border:none;width:40.7%;margin-top:5%;}
        .bottom1{color:white;font-size:3.2em;text-align: left;margin-left:9%}
    }
</style>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/wx/js/swiper.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/wx/js/jquery.min.js"></script>
<body>
<script type="text/javascript">
    $(document).ready(function(){

//        $("#box .boxv").not(":first").hide();
//        $("#list li").click(function(){
//            $(this).addClass("active").siblings().removeClass("active");
//            var index=$(this).index();
//            $("#box .boxv").eq(index).show().siblings().hide();
//        })

    });
</script>

<header id="header">
    <ul id="list">
        <li id="img1"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/tj1.jpg"></li>
        <li id="img2"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/mg.jpg"></li>
    </ul>
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/yy.png" style="position: absolute; z-index: 100;margin-left:-100%;margin-top:8%">
</header>
<div id="box">
    <div class="boxv">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/gd.jpg"></div>
                <div class="swiper-slide"><a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>14))?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/sd.jpg"></a></div>
                <div class="swiper-slide"><a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>15))?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/ny.jpg"></a></div>
            </div>
            <!-- Add Pagination -->
<!--            <div class="swiper-pagination"></div>-->
        </div>
        <div class="middle" style="padding-top: 1%;padding-left: 4%">
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>1,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/gdb.jpg">
                <p>滚蛋吧肿瘤君</p></a>
            </div>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>2,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/yyg.jpg">
                <p>有一个地方只...</p></a>
            </div>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>3,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/cn.jpg">
                <p>超能陆战队</p></a>
            </div>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>4,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/jf.jpg">
                <p>飓风营救3</p></a>
            </div>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>5,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/tjxs.jpg">
                <p>天将雄狮</p></a>
            </div>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>6,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/shwj.jpg">
                <p>生化危机2...</p></a>
            </div>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>7,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/qr.jpg">
                <p>前任2：备胎...</p></a>
            </div>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>8,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/hk.jpg">
                <p>黑客帝国3</p></a>
            </div>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>9,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/yr.jpg">
                <p>蚁人</p></a>
            </div>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>10,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/tn.jpg">
                <p>头脑特工队</p></a>
            </div>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>11,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/sz.jpg">
                <p>睡在我上铺的...</p></a>
            </div>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>12,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/hy.jpg">
                <p>荒野猎人</p></a>
            </div>
            <div>
                <a href="<?php echo Yii::app()->createUrl('/wx/movie/push',array('id'=>13,'stbid'=>$stbid))?>">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/wx/image/ql.jpg">
                <p>神战：权利之眼</p></a>
            </div>
        </div>
    </div>
    <div class="boxv">
        22
        <!--<div class="swiper-container">-->
        <!--<div class="swiper-wrapper">-->
        <!--<div class="swiper-slide"><img src="image/gd1.jpg"></div>-->
        <!--<div class="swiper-slide"><img src="image/gd1.jpg"></div>-->
        <!--<div class="swiper-slide"><img src="image/gd1.jpg"></div>-->
        <!--</div>-->
        <!--&lt;!&ndash; Add Pagination &ndash;&gt;-->
        <!--<div class="swiper-pagination"></div>-->
        <!--</div>-->
        <!--<div class="middle" style="padding-top: 1%;padding-left: 4%">-->
        <!--<div>-->
        <!--<img src="image/qqhcs.jpg">-->
        <!--<p>青丘狐传说</p>-->
        <!--</div>-->
        <!--<div>-->
        <!--<img src="image/fkdwc.jpg">-->
        <!--<p>疯狂动物城</p>-->
        <!--</div>-->
        <!--<div>-->
        <!--<img src="image/kldj.jpg">-->
        <!--<p>恐龙当家</p>-->
        <!--</div>-->
        <!--<div>-->
        <!--<img src="image/shj.jpg">-->
        <!--<p>山海经</p>-->
        <!--</div>-->
        <!--<div>-->
        <!--<img src="image/rx.jpg">-->
        <!--<p>热血</p>-->
        <!--</div>-->
        <!--<div>-->
        <!--<img src="image/mjzx.jpg">-->
        <!--<p>面具之下</p>-->
        <!--</div>-->
        <!--</div>-->
    </div>
</div>
<input type="hidden" name="tbid" value="<?php echo !empty($stbid)?$stbid:''; ?>">
<div id="hidden" style="position: absolute;z-index:9999999;top: 0;">
    <form action="" method="post" style="margin-top:22%">
        <input type="hidden" name="id" value="<?php echo !empty($id)?$id:'' ?>">
        <div class="center" >请输入魔百和盒子的序列号：</div>
        <input type="text" placeholder="请输入设备号：" class="stbid" name="stbid" ><br/>
        <input type="button" class="false" value="">
        <input type="submit"  class="submit" value=""><br>
        <div class="bottom1">魔百和盒子的序列号位置:设置>设备信息>序列号</div><br/>
        <div class="bottom1 bdz" style="display:none" >绑定中....</div>
    </form>
</div>
<script>
    window.onload = function() {
        var stbid =$('input[name=tbid]').val();
        if(stbid == ''){
            $('#hidden').css('display','block');
            return false;
        }
    };
    $('.submit').click(function(){
        $('.bdz').css('display','block');
        $('.submit').attr("disabled", true);
        var k = $(this);
        var G = {};
        var stbid =$('input[name=stbid]').val();
        var id = $('input[name=id]').val();
        if(G.stbid==''){
            sAlert('序列号不能为空');
            return false;
        }
        var isStbid = /^[a-zA-Z0-9]{8,32}$/;
        if(!isStbid.test($('.stbid').val())){
            sAlert('请输入正确的8位序列号');
            $('.bdz').css('display','none');
            $('.submit').attr("disabled", false);
            return false;
        }
        $.post('/wx/demo/getStbs',{stbid:stbid} ,function(d){
            if(d.code==404){
                sAlert(d.msg);
                $('.bdz').css('display','none');
                $('.submit').attr("disabled", false);
                return false;
            }else{
                $.post("/wx/demo/bd",{id:id,stbid:stbid},function(data){
                    sAlert('绑定成功');
                    location.reload();
                })
            }
        },'json');
        return false;
    })
</script>s
<script>
    var Swiper = new Swiper('.swiper-container',{
        pagination: '.swiper-pagination',//分页器容器
        paginationClickable:true,//设置为true时，点击分页器的指示点分页器会控制Swiper切换。
        //mousewheelControl : true,//开启鼠标控制Swiper切换
        //切换方式
        //effect : 'slide',//切换方式 位移切换（不设置默认）
        //effect : 'cube',//切换方式  方块
        //effect : 'fade',//切换方式 淡入
        effect : 'coverflow',//切换方式 （3D流）
        followFinger : false, //false，拖动slide时它不会动，当你释放时slide才会切换。
        loop : true
    });

    //自动切换至下一个
    //setInterval("Swiper.slideNext()", 3000);
    //自动切换至前一个
    setInterval("Swiper.slidePrev()", 3000);
</script>
</body>
</html>
