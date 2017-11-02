<?php
$workerType = Common::getUserInfo();
if(!empty($workerType)){
    foreach ($workerType as $k=>$v){
        $wType[] = $v['type'];
        $stationIdArr[] = $v['stationId'];
    }
}else{
   $faFlag = 1;
   $wType = array();
   $wType = array('0'=>'0');
}


?>
<style>
        .navi_none{
                display:none;
        }
        .white{
                color:white;
        }
    .station_left{
        width:200px;
        height:100%;
        background:#F7FBFC;
        border:1px solid #ccc;
        float:left;
        padding-top:20px;
        padding-left:10px;

    }
    .left-ul li{
        width:160px;
        height:30px;
        word-wrap: break-word;
        overflow:hidden;

        float:left;
        text-align: left;
        padding-left:40px;
        line-height:30px;
    }
    .center{
        float:left;
    }
    .center-ul{
        /*margin-left:20px;*/
        /*margin-bottom:20px;*/
        width:100%;
        height:50px;
        float:left;
        background: #E2EEFB;
        padding-top: 10px;
    }
    .center-ul li{
        width:80px;
        height:27px;
       float:left;
        /*border:1px solid #ccc;*/
        text-align: center;
        margin-left:30px;
        /*background:#E2EEFB ;*/
    }
    .addBtn{
        background: #0aaaf1;
    }
    .main{
        width:4500px;
        height:200%;
    }
    .guideFlag{
        display:block;
    }
    .templateParent{
        background: #4976B7;
    }


   .editUl{
       width:100%;
       background: #A3BAD5;
       padding: 5px 0px 5px 5px;
       height: 30px;
   }
   .editUl ul li{
       width:100px;
       height:30px;
       display: block;
       float: left;

   }
    .updateGuide{
        width:120px;
    }
    .centerTopNav ul li{
        width:100px;
        height:40px;
        display: block;
        float: left;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-top: 1px solid #ccc;
        text-align: center;
        line-height: 40px;
        margin-top: 10px;
    }
    .templateParent{
        padding-left:20px;
        background: #E2EEFB;
    }
</style>
<?php
$verstation = $this->getVerstation();
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<script type="text/javascript" src="/js/jquery.bxslider.min.js"></script>
<div class="main">
<div class="station_left">
    <ul class="left-ul">
        <!--<li>全国</li>-->
         <input type="hidden" id="screenid" value="" />
        <img onclick="chang_left_navi(this)" src="/file/u1855.png"> <div style="display:inline;font-family: 黑体;font-size: 20px;letter-spacing:4px;">商用地区</div>
        <?php
           if(!empty($verstation)){
                    $a = -1;
                
		foreach($verstation as $k=>$v){
                    
               if(!strpos("1".$v['name'],"测试")){
		    $a++;   ?>
                <li class='leftLi'>
                        <a href="<?php echo Yii::app()->createUrl('/version/screen/index',array('mid'=>$_GET['mid'],'nid'=>$v['id'],'epg'=>$_GET['epg'],'leftLiId'=>$a,'adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>" title="<?php echo $v['name'];?>"><?php echo $v['name']; ?></a>
                </li>
             <?php
                }}
           }
        ?>
    </ul>
    <ul class="left-ul">
        <!--<li>全国</li>-->
         <input type="hidden" id="screenid" value="" />
        <img onclick="chang_left_navi1(this)" src="/file/u1855.png"> <div style="display:inline;font-family: 黑体;font-size: 20px;letter-spacing:4px;">测试专区</div>
        <?php
           if(!empty($verstation)){
                   
                foreach($verstation as $k=>$v){
                    
		if(strpos("1".$v['name'],"测试")){
                    $a++;  ?>
                <li class='leftLi'>
                        <a href="<?php echo Yii::app()->createUrl('/version/screen/index',array('mid'=>$_GET['mid'],'nid'=>$v['id'],'epg'=>$_GET['epg'],'leftLiId'=>$a,'adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>" title="<?php echo $v['name'];?>"><?php echo $v['name']?></a>
                </li>
             <?php
                }}
           }
        ?>
    </ul>

</div>
<?php
if(!empty($templateList)){
    $flag =1;
}else{
    $flag =0;
    $templateList = '0';//
}
?>

<div class="center">
    <div class="editUl">
        <ul>
            <!--不用遍历出来-->
            <!--<li class="test">
                <input type="button" value="添加" class="btn addBtn">
            </li>-->
            <li>
                <input type="button" value="编辑导航栏" class="btn updateGuide">
            </li>
                 <?php if($_SESSION['auth'] == 1  &&empty($list) && 1 == 0){ ?>
                <li  style="margin-left: 40px">
                <input type="button" value="引用其他屏幕" class="btn aaa" style="width:120px;">
                 </li>

                <?php  } ?>
        </ul>
    </div>
    <div class="centerTopNav statusFlag" statusFlag="1">
        <ul>
            <li class="screenEdit" activeFlag="1">编辑</li>
            <li class="screenRelease" activeFlag="2">待发布</li>
            <li class="screenOnline" activeFlag="3">现网</li>
        </ul>
    </div>
    <ul class="center-ul">
        <?php

            if(!empty($list)){
            foreach($list as $k=>$v) {
                if ($k == 0) { ?>
                    <li  style="position:relative" onclick="guideShow(this)"  class='bg active'>
                        <img src="/file/u4122.png" alt="" width="80px" height="27px"
                             guideId="<?php echo $v['id']; ?>" class='guideFlag'>
<div class="nv_button white" style="overflow:hidden;line-height:27px;width:80px;height:27px;position:absolute;top:0px;left: 0px;text-align: center"><?php echo $v['title']; ?></div>

                        <img src="/file/u4124.png" alt="" width="80px" height="27px"
                             guideId="<?php echo $v['id']; ?>" style="display:none">
                    </li>
                    <?php
                } else {
                    ?>
                    <li onclick="guideShow(this)"  class='bg' style="position:relative">
                        <img src="/file/u4122.png" alt="" width="80px" height="27px"
                             guideId="<?php echo $v['id']; ?>" style="display:none;">
                  <div class="nv_button" style="overflow:hidden;line-height:27px;width:80px;height:27px;position:absolute;top:0px;left: 0px;text-align: center"><?php echo $v['title']; ?></div>
     <img src="/file/u4124.png" alt="" width="80px" height="27px"
                             guideId="<?php echo $v['id']; ?>">
                    </li>
                <?php
                }
            }
        }
                ?>


    </ul>
    <?php
    if(!empty($html)){
        //echo $html;
    }

    ?>
<!--    <input type="button" value="切换审核内容" class="btn content_btn" style="margin-top: 560px;/*margin-left:-100%*/;">-->
    <div>
        <input type="button" value="提交审核" class="btn submit_btn" style="margin-top: 635px;">
    </div>

</div>
</div>
<script>
 <?php
        $stationId = $_GET['nid'];
        $uid = $_SESSION['userid'];
        $sql = "select a.type,a.uid ,b.stationId from yd_ver_worker as a left join yd_ver_work as b on a.workid=b.id where a.uid=$uid and b.stationId=$stationId";
        $res = SQLManager::queryAll($sql);
        //var_dump($wType);
         if(!empty($wType)){
           if(!in_array('1',$wType)){
               echo "var wTypeFlag=1;";  //没有编辑权限
           }else if(in_array($stationId,$stationIdArr) ){
                foreach($res as $a=>$b){
                        if(in_array('1',$b)){
                            echo "var wTypeFlag=2;";  //有编辑权限
                        }
                }
           }else{
               echo "var wTypeFlag=1;";  //没有编辑权限
           }

           if(!in_array('2',$wType)){
               echo "var fTypeFlag=1;"; //没有发布权限
           }else if(in_array($stationId,$stationIdArr)){
		        foreach($res as $a=>$b){
                        if(in_array('2',$b)){
                            echo "var fTypeFlag=2;";  //有编辑权限
                        }
                }
               //echo "var fTypeFlag=2;"; //有发布权限
           }else{
               echo "var fTypeFlag=1;"; //没有发布权限
           }
       }else{
           echo "var wTypeFlag=1;";  //没有编辑权限
           echo "var fTypeFlag=1;"; //没有发布权限
       }

       if($_SESSION['auth'] == '1'){
          echo "var fTypeFlag=2;"; //有发布权限
          echo "var wTypeFlag=2;";  //有编辑权限
       }

       if(!isset($_GET['leftLiId'])){
           echo "$('.center').hide();";
       }
    ?>
     <?php
    $adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
    $adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
    $adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
    $adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
    ?>
    var adminLeftOne = "<?php echo $adminLeftOne;?>";
    var adminLeftTwo = "<?php echo $adminLeftTwo;?>";
    var adminLeftOneName = "<?php echo $adminLeftOneName;?>";
    var adminLeftTwoName = "<?php echo $adminLeftTwoName;?>";
    var one = "<?php echo !empty($_GET['one'])?$_GET['one']:'0';?>";
    var two = "<?php echo !empty($_GET['two'])?$_GET['two']:'0';?>";
    var three = "<?php echo !empty($_GET['three'])?$_GET['three']:'0';?>";
    var siteName = "<?php echo !empty($_GET['siteName'])?$_GET['siteName']:''; ?>";
    var son = "<?php echo !empty($_GET['son'])?$_GET['son']:''; ?>";
    var topName = "<?php echo !empty($_GET['top'])?$_GET['top']:''; ?>";
    var leftNavFlag  = "<?php echo !empty($_GET['leftNavFlag'])?$_GET['leftNavFlag']:'0'; ?>";
    var adminLeftNavFlag  = "<?php echo !empty($_GET['adminLeftNavFlag'])?$_GET['adminLeftNavFlag']:'0'; ?>";
    var fixedUrl = '/adminLeftOne/'+adminLeftOne+'/adminLeftTwo/'+adminLeftTwo+'/adminLeftOneName/'+adminLeftOneName+'/adminLeftTwoName/'+adminLeftTwoName+'/adminLeftNavFlag/'+adminLeftNavFlag+'/one/'+one+'/two/'+two+'/three/'+three+'/siteName/'+siteName+'/son/'+son+'/top/'+topName+'/leftNavFlag/'+leftNavFlag;
    $('.centerTopNav').children('ul').children('li').click(function()
    {
        var flag = $(this).attr('activeFlag');
        $(this).css('background','#E2EEFB');
        $(this).siblings().css('background','white');
        $('.center-ul').css('background','##E2EEFB');
        $('.templateParent').css('background','##E2EEFB');
        var guideId = $('.active').children('img').eq(0).attr('guideId');
        if(flag == '1'){    //编辑
            $('.centerTopNav').attr('statusFlag','1');//编辑
            bbb(guideId);
        }else if(flag == '2'){
            $('.centerTopNav').attr('statusFlag','2');//待发布
            bbb(guideId);
        }else if(flag == '3'){
            $('.centerTopNav').attr('statusFlag','3');//现网
            getOnlineContent(guideId);
        }
    });

    function getTemplateHtml(guideId)
    {
         var mid = "<?php echo $this->mid;?>";
//         $('.templateParent').remove();
         $.ajax
         ({
             type:'get',
             url:'/version/screen/getTemplateHtml/mid/'+mid+'/guideId/'+guideId,
             success:function(data)
             {
                 $('.center-ul').after(data);
             }
         })
    }

    function index()
    {
        var $_this = $('.centerTopNav').children('ul').children('li').eq(0);
        $_this.css('background','#E2EEFB');
        $_this.siblings().css('background','white');
        $('.center-ul').css('background','##E2EEFB');
        $('.templateParent').css('background','##E2EEFB');
        var guideId = $('.active').children('img').eq(0).attr('guideId');
        $('.centerTopNav').addClass('statusFlag');
        $('.centerTopNav').attr('statusFlag','1');//编辑
        $('.centerTopNav').attr('statusFlag','1');//编辑
        bbb(guideId);

        var screenGuideId = $('.active').children('img').eq(0).attr('guideid');
        var quote_flag = checkQuote(screenGuideId);
        if(quote_flag == 1 /*&& (statusFlag==1 ||statusFlag==2)*/){
            //layer.alert('此屏幕内容是引用屏幕不能被编辑');
            $('.content_btn').hide();
            $('.submit_btn').hide();
        }else{
            $('.content_btn').show();
            $('.submit_btn').show();
        }
    }
    index();

    function leftLi()
    {
        var heightLi = "<?php echo !empty($_GET['leftLiId'])?$_GET['leftLiId']:'' ;?>";
        $('.leftLi').eq(heightLi).css('background','#A3BAD5');
    }

    $('a').css('text-decoration','none');

    leftLi();

    $('.bx-pager-item').css('display','none');

    $('.addBtn').click(function()
    {
        if(wTypeFlag != 2){
            layer.alert('你现在还没有编辑屏幕的权限');
            return false;
        }
        //window.location.href = "/version/screen/addScreen/mid/<?php //echo $this->mid;?>/nid/<?php //echo $_GET['nid']?>";
        window.open("/version/screen/addScreen/mid/<?php echo $this->mid;?>/nid/<?php echo $_GET['nid']?>");
    });

    $('.updateGuide').click(function()
    {
       var auth = "<?php echo $_SESSION['auth']?>";
       if(auth == '1'){

           window.open("/version/screen/updateGuideView/mid/<?php echo $this->mid;?>/nid/<?php echo $_GET['nid']?>"+fixedUrl);
       }else{
           layer.alert('你现在还没有编辑屏幕的权限');
           return false;
       }
       /*if(wTypeFlag != 2){
           layer.alert('你现在还没有编辑屏幕的权限');
            return false;
        }*/

    });


    function guideShow(obj)
    {
        var screenGuideId = $(obj).children('img').eq(0).attr('guideid');
        var quote_flag = checkQuote(screenGuideId);
        if(quote_flag == 1 /*&& (statusFlag==1 ||statusFlag==2)*/){
            //layer.alert('此屏幕内容是引用屏幕不能被编辑');
            $('.content_btn').hide();
            $('.submit_btn').hide();
        }else{
            $('.content_btn').show();
            $('.submit_btn').show();
        }

        $('.bg').removeClass('active');
        $('.nv_button').removeClass('white');
        $(obj).addClass('active');
        $(obj.children).each(function(){
                        if(this.tagName == 'DIV'){
                                $(this).addClass('white');
                        }
                        })


        var screenId = $(obj).children('img').attr('guideId');

        var statusFlag = $('.centerTopNav').attr('statusFlag'); //编辑|待发布|现网
        for(var i = 0 ; i<$(obj).parent().children('li').length ; i++){
            if($(obj).parent().children('li').eq(i).children('img').hasClass('guideFlag')){
                $(obj).parent().children('li').eq(i).children('img').removeClass('guideFlag');
                $(obj).parent().children('li').eq(i).children('img').eq(0).hide();
                $(obj).parent().children('li').eq(i).children('img').eq(1).show();
            }
        }
        $(obj).children('img').eq(0).addClass('guideFlag');
        $(obj).children('img').eq(0).show();
        $(obj).children('img').eq(1).hide();

        if(statusFlag == '1'){
            bbb(screenId);
        }else if(statusFlag == '2'){
            bbb(screenId);
        }else if(statusFlag == '3'){
            getOnlineContent(screenId);
        }


    }

    function getOnlineContent(screenId)
    {
        $.ajax
        ({
            type:'get',
//            async:false,
            url:"/version/screen/GetHasScreen/mid/<?php echo $this->mid;?>/screenId/"+screenId,
            success:function(data)
            {
                $('.templateParent').remove();
                $('.center-ul').after(data);
                getScreenContent(screenId);
            }
        })
    }

    var flag = <?php echo $flag;?>;
    if(flag == 1){
        showData();
    }
    function showData()
    {
        var data=<?php echo $templateList;?>;
        var l= data.length;
        l= data.length;
//        console.log(data);
        for(var i = 0 ; i<data.length ; i++){
            var order = '.order-'+data[i]['order'];
              if(i>=1){
                //if(data[i]['order'] == data[i-1]['order']){
                        $(order).find(".plus_button").remove()
                //}
            }
            var width = $(order).css('width');
            var height = $(order).css('height');
            var w = $(order).attr('size-w');
            var h = $(order).attr('size-h');//console.log(w);
            $(order).find('.clickImg-'+w+'-'+h).remove();
            $(order).append("<li><img style='display:block;float:left;position:relative;z-index:1' src='"+data[i]['pic']+"' width='"+w+"' height='"+h+"'  id='"+data[i]['id']+"'></li>");
        }
        banner(l);
    }

    function getScreenContent(screenId)
    {
        $.ajax
        ({
            type:'post',
            dataType:'json',
            url:"/version/screen/getScreenContent/mid/<?php echo $this->mid;?>/screenGuideId/"+screenId,
            success:function(data)
            {
               flag= data.flag;
               data = data.list;
               if(data.length>0){
                   var data = eval(data);
                   showDataAgain(data);
               }
               var statusFlag = $('.centerTopNav').attr('statusFlag'); //编辑|待发布|现网
               if(statusFlag == '3' || statusFlag == '2'){
                  // $('.plus_button').remove();
                }

                if(flag=='1'){
                    $('.submit_btn').val('审核中');
               }else if(flag=='2'){
                    <?php if(!isset($faFlag)){echo "$('.submit_btn').val('发布');";}?>
                    <?php if(in_array('2',$wType)){echo "$('.submit_btn').val('发布');";}?>
                    <?php if($_SESSION['auth']=='1'){echo "$('.submit_btn').val('发布');";}?>
               }else{
                    $('.submit_btn').val('提交审核');
               }
                $('.content_btn').val('切换审核内容');
            }
        })

    }

    function showDataAgain(data)
    {
//        var data=<?php //echo $templateList;?>//;
        var l= data.length;
        l= data.length;
//        console.log(data);
        for(var i = 0 ; i<data.length ; i++){
            var order = '.order-'+data[i]['order'];
              if(i>=1){
                if(data[i]['order'] == data[i-1]['order']){
                        $(order).find(".plus_button").remove()
                }
            }
            var width = $(order).css('width');
            var height = $(order).css('height');
            var w = $(order).attr('size-w');
            var h = $(order).attr('size-h');
            $(order).find('.clickImg-'+w+'-'+h).remove();
            $(order).append("<li><img style='display:block;float:left;position:relative;z-index:1' src='"+data[i]['pic']+"' width='"+width+"' height='"+height+" 'onclick='add(this)' id='"+data[i]['id']+"' ></li>");
        }
        banner(l);
    }

    function showDataAgainCopy(data)
    {
        var l= data.length;
        l= data.length;
        for(var i = 0 ; i<data.length ; i++){
            var order = '.order-'+data[i]['order'];

            if(i>=1){
                if(data[i]['order'] == data[i-1]['order']){
                        $(order).find(".plus_button").remove()
                }
            }

            var width = $(order).css('width');
            var height = $(order).css('height');
            var w = $(order).attr('size-w');
            var h = $(order).attr('size-h');
            $(order).find('.clickImg-'+w+'-'+h).remove();

            $(order).append("" +
                "<li>" +
                "<img  style='display:block;float:left;position:relative;z-index:1' src='"+data[i]['pic']+"' width='"+width+"' height='"+height+"' onclick='add(this)' id='"+data[i]['id']+"'>" +
                "</li>");
        }
        banner(l);
    }

    function banner(l)
    {
        var guideid = $('.active').children('img').eq(0).attr('guideid');
        var info = getMaxOrder(guideid);
        info = JSON.parse(info);
        for(var i = (info.min)-1 ; i<(info.max)+1 ; i++){
            if($('.order-'+i).find('li').length>1){
                var aa = $('.order-'+i).html();
                var bb = $('.order-'+i);
                bb.children().remove();
                bb.append("<ul class='"+i+"-bxslider'></ul>");
                var str = "."+i+'-bxslider';
                bb.find(str).append(aa);
                $(str).children('img').eq(0).remove();
                slider = $(str).bxSlider();
                slider.startAuto();
            }
        }
        $('.bx-controls').hide();
    }

    function getMaxOrder(guideid)
    {
        var mid = <?php echo $this->mid;?>;
        var d = 1;
        $.ajax
        ({
            type:'get',
            async:false,
            url:'/version/screen/getMaxOrder/mid/'+mid+'/guideid/'+guideid,
            success:function(data)
            {
                d = data;
            }
        })
        return d;
    }

    function checkQuote(guideId)
    {
        var mid = <?php echo $this->mid;?>;
        var status = 0;
        $.ajax
        ({
            type:'get',
            url:'/version/screen/GetQuoteInfo/mid/'+mid+'/guideId/'+guideId,
            async:false,
            success:function(data)
            {
                if(data == 1){
                    status = 1;
                }
            }
        });
        return status;
    }



    function add(obj)
    {
        var statusFlag = $('.centerTopNav').attr('statusFlag'); //编辑|待发布|现网
        if(statusFlag == 3){
            onlineFlag=1;
        }else{
            onlineFlag=0;
        }

        var screenGuideId = $('.guideFlag').attr('guideId');
        var quote_flag = checkQuote(screenGuideId);
        if(quote_flag == 1 && (statusFlag==1 ||statusFlag==2)){
            layer.alert('此屏幕内容是引用屏幕不能被编辑');
            return false;
        }

        if(wTypeFlag == 1){
           layer.alert('你目前没有编辑屏幕的权限！');
            return false;
        }
         var reviewFlag = checkReviewDatacopy();
         if(reviewFlag=='2'){
               var releaseFlag = checkReviewsTimes();
                 var auth = "<?php echo $_SESSION['auth'];?>";
                 if(releaseFlag == '1'){
                        //return true;
                 }else{
                     layer.alert('现在有数据还在工作流审核环节中暂且不能编辑！');
                        return false;
                 }
         }
        if($('.submit_btn').val() == '发布'){
            layer.alert('发布新数据之后才可以继续编辑');
            return false;
        }
        var mid = "<?php echo $_GET['mid']?>";
        var screenGuideId = $('.guideFlag').attr('guideId');
        var epg = "<?php echo $_GET['epg']?>";
        var order = $(obj).parent('div').attr('order');


        if($(obj).parent().is('div')){
            var width = $(obj).parent('div').attr('size-w');
            var height = $(obj).parent('div').attr('size-h');
            var x = $(obj).parent('div').attr('x');
            var y = $(obj).parent('div').attr('y');
            var order = $(obj).parent('div').attr('order');
            window.open('/version/screen/addScreenContent/mid/'+mid+'/screenGuideId/'+screenGuideId+'/width/'+width+'/height/'+height+'/x/'+x+'/y/'+y+'/epg/'+epg+'/order/'+order+'/onlineFlag/'+onlineFlag+fixedUrl);
        }else if($(obj).parent().parent().is('ul')){
            var width = $(obj).parent().parent().parent().parent().parent().attr('size-w');
            var height = $(obj).parent().parent().parent().parent().parent().attr('size-h');
            var x = $(obj).parent().parent().parent().parent().parent().attr('x');
            var y = $(obj).parent().parent().parent().parent().parent().attr('y');
            var order = $(obj).parent().parent().parent().parent().parent().attr('order');
            var id = $(obj).attr('id');
            window.open('/version/screen/updateScreenContent/mid/'+mid+'/screenGuideId/'+screenGuideId+'/width/'+width+'/height/'+height+'/x/'+x+'/y/'+y+'/epg/'+epg+'/order/'+order+'/onlineFlag/'+onlineFlag+"/id/"+id+fixedUrl);
        }else if($(obj).parent().is('li')){
            var width = $(obj).parent().parent('div').attr('size-w');
            var height = $(obj).parent().parent('div').attr('size-h');
            var x = $(obj).parent().parent('div').attr('x');
            var y = $(obj).parent().parent('div').attr('y');
            var order = $(obj).parent().parent('div').attr('order');
            var id = $(obj).attr('id');
            window.open('/version/screen/updateScreenContent/mid/'+mid+'/screenGuideId/'+screenGuideId+'/width/'+width+'/height/'+height+'/x/'+x+'/y/'+y+'/epg/'+epg+'/order/'+order+'/onlineFlag/'+onlineFlag+'/id/'+id+fixedUrl);
        }
    }

    function getScreenContentInfo(screenGuideId,order)
    {
        var mid = "<?php echo $_GET['mid']?>";
        $.ajax
        ({
            type:'get',
            url:'/version/screen/getScreenContentInfo/mid/'+mid+'/order/'+order+'/screenGuideId/'+screenGuideId,
            success:function(data)
            {
                //console.log(data);
            }
        })
    }


    $('.content_btn').click(function(){
        var restr = $(this).attr('des');
        var screenId = $('.active').children('img').attr('guideId');
        var str = 'cur-' + screenId;
        $(this).attr('des',str);

        if(restr!=str){
            bbb(screenId);
            $(this).val('切换现网内容');
        }else{
            aaa(screenId);
            $(this).attr('des','2');
            $(this).val('切换审核内容')
        }
    });

    $('.submit_btn').click(function(){

        var text = $(this).val();
        var screenId = $('.active').children('img').attr('guideId');
        if(text=='提交审核'){
            if(wTypeFlag == 1){
                layer.alert('你目前没有提交屏幕审核的权限！');
                return false;
            }
            $.post("<?php echo $this->get_url('screen','subreview')?>",{guideid:screenId},function(d){
                if(d.code==200){
                    $('.submit_btn').val('审核中');
                    //window.location.reload();
                }else{
                    $('.submit_btn').val('提交审核');
                }
            },'json')
            //$(this).val('审核中');
        }else if(text=='发布'){
            if(fTypeFlag == 1){
                layer.alert('你目前没有发布的权限！');
                return false;
            }
            var reviewFlag = checkReviewDatacopy();
            if(reviewFlag=='2'){
                var releaseFlag = checkReviewsTimes();

                var auth = "<?php echo $_SESSION['auth'];?>";
                if(releaseFlag == '1'){
                        //return true;
                }else{
                        layer.alert('数据还在工作流审核环节中暂且不能发布！');
                        return false;
                }
            }
            //alert('2');return false;
            $.post("<?php echo $this->get_url('screen','submit')?>",{guideid:screenId},function(data){
                //alert(data);
            });
            $(this).val('提交审核');
        }
        //$.post("<?php echo $this->get_url('screen','subreview')?>",{guideid:screenId},function(){

        //})
    });

    function getScreenContentCopy(screenId)
    {
        document.getElementById("screenid").value = screenId;
        $.ajax
        ({
            type:'post',
//            async:false,
            url:"/version/screen/getScreenContentCopy/mid/<?php echo $this->mid;?>/stationId/<?php echo $_GET['nid'];?>/screenGuideId/"+screenId,
            dataType:'json',
            success:function(data)
            {
                flag= data.flag;
                data = data.list;


                if(data.length>0){
                    var data = eval(data);

                    if(flag=='1'){
                        $('.submit_btn').val('审核中');
                        showDataAgain(data);

                    }else if(flag=='2'){
                        $('.submit_btn').val('发布');
                        //showDataAgain(data);
                        showDataAgainCopy(data);
                    }else{

                        $('.submit_btn').val('提交审核');
                        showDataAgainCopy(data);

                    }
                }
            }
        })
    }

    function aaa(screenId){
        $.ajax
        ({
            type:'get',
//            async:false,
            url:"/version/screen/GetHasScreen/mid/<?php echo $this->mid;?>/screenId/"+screenId,
            success:function(data)
            {
                $('.templateParent').remove();
                for(var i = 0 ; i<$('.active').parent().children('li').length ; i++){
                    if($('.active').parent().children('li').eq(i).children('img').hasClass('guideFlag')){
                        $('.active').parent().children('li').eq(i).children('img').removeClass('guideFlag');
                        $('.active').parent().children('li').eq(i).children('img').eq(0).hide();
                        $('.active').parent().children('li').eq(i).children('img').eq(1).show();
                    }
                }
                $('.active').children('img').eq(0).addClass('guideFlag');
                $('.active').children('img').eq(0).show();
                $('.active').children('img').eq(1).hide();
                $('.center-ul').after(data);
                getScreenContent(screenId);
            }
        })
    }

    function bbb(screenId){
        $.ajax
        ({
            type:'post',
//            async:false,
            url:"/version/screen/GetHasScreen/mid/<?php echo $this->mid;?>/screenId/"+screenId,
            success:function(data)
            {
                $('.templateParent').remove();
                for(var i = 0 ; i<$('.active').parent().children('li').length ; i++){
                    if($('.active').parent().children('li').eq(i).children('img').hasClass('guideFlag')){
                        $('.active').parent().children('li').eq(i).children('img').removeClass('guideFlag');
                        $('.active').parent().children('li').eq(i).children('img').eq(0).hide();
                        $('.active').parent().children('li').eq(i).children('img').eq(1).show();
                    }
                }

                $('.active').children('img').eq(0).addClass('guideFlag');
                $('.active').children('img').eq(0).show();
                $('.active').children('img').eq(1).hide();
                $('.center-ul').after(data);
                getScreenContentCopy(screenId);
                var statusFlag = $('.centerTopNav').attr('statusFlag'); //编辑|待发布|现网
                if(statusFlag == '3' || statusFlag == '2'){
                  // $('.plus_button').remove();
                }
           }
        })
    }

    function getDaiFaBu(guideId)
    {
        $.ajax
        ({
            type:'get',
//            async:false,
            url:"/version/screen/GetHasScreen/mid/<?php echo $this->mid;?>/screenId/"+guideId,
            success:function(data)
            {
                $('.templateParent').remove();
                for(var i = 0 ; i<$('.active').parent().children('li').length ; i++){
                    if($('.active').parent().children('li').eq(i).children('img').hasClass('guideFlag')){
                        $('.active').parent().children('li').eq(i).children('img').removeClass('guideFlag');
                        $('.active').parent().children('li').eq(i).children('img').eq(0).hide();
                        $('.active').parent().children('li').eq(i).children('img').eq(1).show();
                    }
                }
                $('.active').children('img').eq(0).addClass('guideFlag');
                $('.active').children('img').eq(0).show();
                $('.active').children('img').eq(1).hide();
                $('.center-ul').after(data);
                getScreenContentCopyDai(guideId);
            }
        })
    }

 function getScreenContentCopyDai(screenId)
 {
     $.ajax
     ({
         type:'post',
         url:"/version/screen/GetScreenContentCopyDai/mid/<?php echo $this->mid;?>/screenGuideId/"+screenId,
         dataType:'json',
         success:function(data)
         {

             flag= data.flag;
             data = data.list;
             if(data.length>0){
                 var data = eval(data);
                 if(flag=='1'){
                     $('.submit_btn').val('审核中');
                     showDataAgain(data);
                 }else if(flag=='2'){
                     $('.submit_btn').val('发布');
                     //showDataAgain(data);
                     showDataAgainCopy(data);
                 }else{
                     $('.submit_btn').val('提交审核');
                     showDataAgainCopy(data);
                 }
             }
         }
     })
 }

    function checkReviewsTimes()
    {
        var screenId = document.getElementById("screenid").value
        var stationId = "<?php echo $_GET['nid'];?>";
        var mid = "<?php echo $this->mid;?>";
        var d = null;
        $.ajax
        ({
            type:'get',
            async: false,
            url:"/version/review/GetReviewTimes/mid/"+mid+"/stationId/"+stationId+"/screenGuideId/"+screenId,
            success:function(data)
            {
                d = data;
            }
        });
        return d;
    }


    function checkReviewData()
    {
        var mid = "<?php echo $this->mid;?>";
        var stationId = "<?php echo $_GET['nid'];?>";
        var d = null;
        $.ajax
        ({
            type:'get',
            async: false,
            url:"/version/review/CheckReviewData/mid/"+mid+"/stationId/"+stationId,
            success:function(data)
            {
                d = data;
            }
        })
        return d;
    }


    function checkReviewDatacopy()
    {
        var mid = "<?php echo $this->mid;?>";
        var stationId = $('.active').children('img').attr('guideId');
        var d = null;
        $.ajax
        ({
            type:'get',
            async: false,
            url:"/version/review/CheckReviewDataCopy/mid/"+mid+"/stationId/"+stationId,
            success:function(data)
            {
                d = data;
            }
        })
        return d;
    }

    function chang_left_navi(e){
            if($(e).attr('src') == '/file/u1855.png'){
                    $(e).attr('src','/file/u1857.png');

            $(e.parentNode.children).each(function(){
                    if(this.tagName == 'LI'){
                            $(this).addClass("navi_none");
                    }
                    })
            }else{
                    $(e).attr('src','/file/u1855.png');
                    $(e.parentNode.children).each(function(){
                    if(this.tagName == 'LI'){
                            $(this).removeClass("navi_none");
                    }
                    })
            }

    }
    function chang_left_navi1(e){
            if($(e).attr('src') == '/file/u1855.png'){
                    $(e).attr('src','/file/u1857.png');
                    $(e.parentNode.children).each(function(){
                        if(this.tagName == 'LI'){
                                $(this).addClass("navi_none");
                        }
                    })
            }else{
                    $(e).attr('src','/file/u1855.png');
                    $(e.parentNode.children).each(function(){
                        if(this.tagName == 'LI'){
                                $(this).removeClass("navi_none");
                        }
                    })
            }

    }

    $('.aaa').click(function(){
        $.getJSON('<?php echo $this->get_url('screen','copyscreen')?>',{nid:<?php echo $_GET['nid']; ?>},function(d){
            if(d.code == 200){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['330px', '136px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })
</script>

