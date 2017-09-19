<html><head lang="en">
    <meta charset="UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>test</title>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/vcommon.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/video.css" rel="stylesheet">
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
    <!--.hd start-->
    <div class="hd">
        <div class="banner">
            <a href="" title="可爱的你">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/img1.jpg" alt="可爱的你" />
            </a>
        </div>
    </div>
    <!--.hd end-->
    <!--tab start-->
    <div class="tab">
        <!--tab-content start-->
        <div class="tab-content" id="tab-content">
            <div class="tab-content-tit clearfix"></div>
            <ul class="clearfix">
                <li>
                    <a href="<?php echo Yii::app()->createUrl('/weixin/video/detial')?>" title="可爱的你">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/img1.jpg" alt="可爱的你"   />
                        <strong>可爱的你</strong>

                    </a>
                </li>
                <li>
                    <a href="detail-movies-paid.html" title="可爱的你">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/img1.jpg" alt="可爱的你"   />
                        <strong>可爱的你</strong>
                    </a>
                </li>
                <li>
                    <a href="detail-movies-paid.html" title="可爱的你">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/img1.jpg" alt="可爱的你"   />
                        <strong>可爱的你</strong>
                    </a>
                </li>
                <li>
                    <a href="detail-movies-paid.html" title="可爱的你">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/img1.jpg" alt="可爱的你"   />
                        <strong>可爱的你</strong>
                    </a>
                </li>
            </ul>
        </div>
        <!--tab-content end-->
    </div>
    <!--tab end-->

</div>
<!--container end-->

</body>

</html>
