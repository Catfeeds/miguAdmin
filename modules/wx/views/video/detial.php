<html><head lang="en">
    <meta charset="UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>test</title>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/vcommon.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/video.css" rel="stylesheet">
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.min.js"></script>
    <style>
        body{background:url("<?php echo Yii::app()->request->baseUrl; ?>/images/test.jpg");background-size:100% 100%;}
        .btn{
            height:2.5rem;border-radius:10px;border:none;width:2.2rem;background-color: #99CCFF;font-size: 0.5rem;background:url("<?php echo Yii::app()->request->baseUrl; ?>/images/bf.png");margin-left:3.8rem;margin-top:1.6rem;background-size:100% 100%;
        }
    </style>
</head>
<script type="text/javascript">
    (function (doc, win) {
        var docEl = doc.documentElement,
            resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
            recalc = function () {
                var clientWidth = docEl.clientWidth;
                if (!clientWidth) return;
                if(clientWidth>=640){
                    docEl.style.fontSize = '100px';
                }else{
                    docEl.style.fontSize = 100 * (clientWidth / 640) + 'px';
                }
            };

        if (!doc.addEventListener) return;
        win.addEventListener(resizeEvt, recalc, false);
        doc.addEventListener('DOMContentLoaded', recalc, false);
    })(document, window);
</script>
<body>
<div class="container">
    <!--.video-detail start-->
    <div class="video-detail">
        <!--.video-poster start-->
        <div class="video-poster">
            <!--<img src="<?php /*echo Yii::app()->request->baseUrl; */?>/images/img1.jpg" alt="可爱的你" />
            <a href="" title="可爱的你"></a>-->
        </div>
        <!--.video-poster end-->
        <!--.video-desc start-->
        <input type="hidden" name="stbid" value="<?php echo !empty($stbid)?$stbid:''?>">
        <input type="hidden" name="url" value="BESTV_POSITION_LAUNCHER_V_TP|1|4771516$12243453|2225739|SMG_YUEME_MOVIENEW#YUEME_MOVIE_TJ#">
        <div style="width:6.4rem;">
            <input type="button" class="btn" value="" style="disabled">
        <div>
        <!--.video-poster end-->
    </div>
    <!--.video-detail end-->
</div>
<!--container end-->


</body>
<script>
    $('.btn').click(function(){
        var G = {};
        G.stbid =$('input[name=stbid]').val();
        if(G.stbid==''){
            alert('请先去绑定设备');
            return false;
        }
        G.url =$('input[name=url]').val();
        $(this).attr("disabled", true);
        $.post('/wx/video/add',G,function(d){

        })
    })
</script>
</html>
