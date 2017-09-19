<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title><?php $this->pageTitle= '云消息'?></title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.min.js"></script>
    <style>
        *{margin: 0;padding: 0;}
        body{height:100%;}

            header{width:6.4rem;text-align: center;line-height: 2rem;height:2rem;}
            header div{padding:0;}
            header p{font-size: 0.35rem;margin: 0;}
            section{width:6.4rem;text-align: center;height:3rem;}
            #center{margin: 2% 0.64rem 0 0.64rem;}
            #center{ border: 2px #385D8A solid;border-radius: 5%;width:5.12rem;background-color:#333237;height:3.5rem }
            #text{margin: 5% 5% 0 5%;width: 89%;height: 2.5rem;BORDER-BOTTOM-STYLE: none; BORDER-LEFT-STYLE: none; BORDER-RIGHT-STYLE: none; BORDER-TOP-STYLE: none;resize : none;font-size:1.5em;background-color:#333237;color:#FFFFFF}
            /*footer{margin-top:20%;}*/
            .footer{position: absolute;bottom: 0}
            #btn{background:url("<?php echo Yii::app()->request->baseUrl; ?>/images/send.png") repeat-x  center;height:1rem;border-radius:10px;background-color: #037BC3;background-size: 100% 100%;border:none;}
        
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
<body onload="myfunction()">
<header>
    <div><p>本消息将发送至您的魔百和上</p></div>
</header>
<section>
    <form name="form1" method="post">
        <div id="center">
            <textarea id="text" name="info" cols="30" rows="15" placeholder="请输入信息：" style="font-size:20px;background-color:#333237;color:#FFFFFF"></textarea>
        </div>
        <input type="hidden" name="img" value="<?php echo !empty(Yii::app()->session['user']['image'])?Yii::app()->session['user']['image']:''?>">
        <input type="hidden" name="number" value="<?php echo !empty($list[0]['number'])?$list[0]['number']:'' ?>">
        <input type="hidden" name="name" value="<?php echo !empty($list[0]['name'])?$list[0]['name']:'' ?>">
        <input type="hidden" name="stbid" value="<?php echo !empty($list[0]['stbid'])?$list[0]['stbid']:'' ?>">
        <div style="margin-top:2%">
            <input type="button" id="btn" value="" onclick="aa()" style="width:80%;">
        </div>
    </form>
</section>
<footer>
    <div class="footer"><a href="http://portal.itv.cmvideo.cn:8081/wx/demo/bd"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/stbbd.png" style="width:100%"></a></div>
</footer>
</body>
<script type="text/javascript">
    function aa(){
        var k = $(this);
        var G = {};
        G.stbid =$('input[name=stbid]').val();
        G.info = $('#text').val();
        G.img = $('input[name=img]').val();
        G.name = $('input[name=name]').val();
        G.number = $('input[name=number]').val();
        if(G.info ==''){
            alert('请输入内容');
            return false;
        }
        if(G.stbid==''){
            alert('请先绑定设备');
            return false;
        }
        alert("发送成功");
        /*document.form1.action ="/wx/message/add";
        document.form1.submit();*/
        $.post('/wx/message/add',G,function(){

        },'json')
        $('textarea').val(''); 
    }
    function myfunction(){
        document.getElementById("text").value="";
    }
    var HEIGHT = $('body').height();
    $(window).resize(function() {
        //alert(1);
        $('body').height(HEIGHT);
    });
</script>
</html>
