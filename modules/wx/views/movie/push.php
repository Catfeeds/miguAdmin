<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php $this->pageTitle= '详情页'?></title>
</head>
<style>
    body{
        background: url("<?php echo Yii::app()->request->baseUrl; ?>/wx/image/gdbxq.jpg") no-repeat;
        background-size: 100% 100%;
        height: 100%;
        width: 100%;
    }
    button{
        width: 26%;
        height: 5%;
        margin-left: 64%;
        margin-top: 5.4rem;
        border-radius: 20px;
        background-color:transparent;
        border:none;
    }
</style>
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
<?php if($_GET['id']==1){?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/gdbxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146575799140956/300/36/840694.page" name="param">
<?php }elseif($_GET['id']==2){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/yygxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146575799140956/281/36/1023105.page" name="param">
<?php }elseif($_GET['id']==3){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/cnxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146575799140956/281/36/901633.page" name="param">
<?php }elseif($_GET['id']==4){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/jfxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146575799140956/281/36/1023205.page" name="param">
<?php }elseif($_GET['id']==5){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/tjxsxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146575799140956/281/36/1019445.page" name="param">
<?php }elseif($_GET['id']==6){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/shwjxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146575799140956/281/36/1018243.page" name="param">
<?php }elseif($_GET['id']==7){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/qrxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146575799140956/281/36/840712.page" name="param">
<?php }elseif($_GET['id']==8){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/hkxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146575799140956/281/36/1017987.page" name="param">
<?php }elseif($_GET['id']==9){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/yrxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146575799140956/300/36/840703.page" name="param">
<?php }elseif($_GET['id']==10){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/tnxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146368123507728/232/36/891713.page" name="param">
<?php }elseif($_GET['id']==11){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/szxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146368123507728/232/36/1015244.page" name="param">
<?php }elseif($_GET['id']==12){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/hyxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146368123507728/232/36/849859.page" name="param">
<?php }elseif($_GET['id']==13){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/qlxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146368123507728/301/36/1014532.page" name="param">
<?php }elseif($_GET['id']==14){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/sdxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146575799140956/300/36/1019273.page" name="param">
<?php }elseif($_GET['id']==15){ ?>
    <script>
        $('body').css('background',"url(<?php echo Yii::app()->request->baseUrl; ?>/wx/image/nyxq.jpg) no-repeat").css('background-size','100% 100%');
    </script>
    <input type="hidden" value="http://migu.itv.cmvideo.cn/content/migu/RDportal139146368123507728/232/36/1014111.page" name="param">
<?php }?>
<input type="hidden" value="<?php echo $_GET['stbid'];?>" name="stbid" id="stbid">
<button onclick="sub()"></button>

</body>
<script>
    function sub(){
        var param = $("input[name=param]").val();
        var stbid = $("#stbid").val();
        $.getJSON("/wx/movie/push?id=<?php echo $_GET['id'];?>",{param:param,stbid:stbid},function(data){});
    }
</script>
</html>
