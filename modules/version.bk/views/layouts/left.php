<?php
$auth['list']='';
if($_SESSION['auth']=='1'){
   $nav = $this->verguide;
}else{
   $uid = $_SESSION['userid'];
   $auth = $this->getAuth($uid);
   $nav=$auth['data'];
}
$admin = $this->getMvAdmin();
//var_dump($nav);die;
?>
<style>
    /*.menu ul li{height:30px;line-height: 30px;}*/
    .admin_left_li{height:30px;line-height: 30px;font-size: 15px;}
    .admin_left_one{width:30px;height:25px;}
    #menubox ul li {
         border-bottom: 0px solid #d9e4ea;
    }

</style>
<div class="admin_left"  >
    <div id="menubox" style="padding-left: 10px;">
        <ul id="J_navlist">
            <?php
            //print_r($nav);
            if(!empty($nav)){
                $a = - 1;
                foreach($nav as $v){
                    if($v->pid == 0 && $v->status==0){
                        $a++;
                        ?>
                        <li class="<?php echo !empty($_GET['nid']) && $_GET['nid'] == $v['id']?'thismenu':''?>">
                            <span>
                                <?php
                                    $data = VerGuideManager::getGuideCopy($v['id'],$auth['list']);
                                    if(!empty($data)){?>
                                        <li class="menu">
                                            <span>
                                                <?php
                                                    switch($v['id'])
                                                    {
                                                        case 3:
                                                            $src="/file/button/u194.png";
                                                            break;
                                                        case 10:
                                                            $src="/file/button/nav_false.png";
                                                            break;
                                                        case 31:
                                                            $src="/file/button/u223.png";
                                                            break;
                                                        case 35:
                                                            $src="/file/button/station_false.png";
                                                            break;
                                                        case 37:
                                                            $src="/file/button/u214.png";
                                                            break;
                                                        case 42:
                                                            $src="/file/button/u214.png";
                                                            break;
                                                        case 44:
                                                            $src="/file/button/u203.png";
                                                            break;
                                                        case 48:
                                                            $src="/file/button/u236.png";
                                                            break;
                                                        default:
                                                            $src="/file/button/station_false.png";
                                                        break;
                                                    }
                                                ?>
                                                <img src="<?php echo $src;?>" alt="" onclick="admin_left_one(this)" class="admin_left_one" guideId="<?php echo $v['id'];?>">
                                                <?php echo $v['name'];?>
                                            </span>
                                            <ul >
                                                <?php
                                                $b = -1;
                                                    foreach($data as $val){
                                                        $b++;
                                                        ?>
                                                           <li>
                                                               <span>
                                <?php
                                    $tmp = VerGuideManager::getGuideCopy($val['id'],$auth['list']);
                                    if(!empty($tmp)){?>
                                        <li class="menu">
                                            
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $val['name']?></span>
                                            <ul>
                                                <?php
                                                    foreach($tmp as $l){
                                                        ?>
                                                           <li >
                                                               <a href="<?php echo $l['url'] == '#'?'#':Yii::app()->createUrl($l['url'],array('mid'=>$_GET['mid'],'nid'=>$l['id'],'epg'=>$l['name'],'pro'=>$admin['nickname']))?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $l['name']?></a>
                                                           </li>
                                                    <?php }
                                                ?>
                                            </ul>
                                        </li>
                                    <?php
                                        }else{?>
                                        <li class="admin_left_li">
                                            <a href="<?php echo $val['url'] == '#'?'#':Yii::app()->createUrl($val['url'],array('mid'=>$_GET['mid'],'nid'=>$val['id'],'epg'=>$val['name'],'pro'=>$admin['nickname'],'adminLeftNavFlag'=>1,'adminLeftOne'=>$a,'adminLeftTwo'=>$b,'adminLeftOneName'=>$v['name']))?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $val['name'];?></a>
                                        </li>
                                   <?php }
                                ?>
                            </span>

                                                           </li>
                                                    <?php }
                                                ?>
                                            </ul>
                                        </li>
                                    <?php
                                        }else{?>
                                        <li>
                                            <?php

                                            switch($v['id'])
                                            {
                                                case 3:
                                                    $src="/file/button/u194.png";
                                                    break;
                                                case 10:
                                                    $src="/file/button/nav_false.png";
                                                    break;
                                                case 31:
                                                    $src="/file/button/u223.png";
                                                    break;
                                                case 35:
                                                    $src="/file/button/station_false.png";
                                                    break;
                                                case 37:
                                                    $src="/file/button/u214.png";
                                                    break;
                                                case 42:
                                                    $src="/file/button/u214.png";
                                                    break;
                                                case 44:
                                                    $src="/file/button/u203.png";
                                                    break;
                                                case 48:
                                                    $src="/file/button/u236.png";
                                                    break;
                                                default:
                                                    $src="/file/button/station_false.png";
                                                    break;
                                            }

                                            ?>
                                            <img src="<?php echo $src;?>" alt="" guideId="<?php echo $v['id'];?>" class="admin_left_one">
                                            <a href="<?php echo $v['url'] == '#'?'#':Yii::app()->createUrl($v['url'],array('mid'=>$_GET['mid'],'nid'=>$v['id'],'epg'=>$v['name'],'pro'=>$admin['nickname'],'adminLeftNavFlag'=>1,'adminLeftOne'=>$a,'adminLeftTwo'=>$b))?>">
                                                <?php echo $v['name'];?>
                                            </a>
                                        </li>
                                   <?php }
                                ?>
                            </span>
                        </li>
                    <?php
                    }
                }
            }else{
                ?>
                <li class="">
                </li>
            <?php
            }?>
        </ul>
        <script type="text/javascript" language="javascript">
            navList(12);
        </script>
    </div>
    <div class="left_ico left_active"><a href="#"></a></div>
</div>
<script type="text/javascript">
    window.onload = function(){
        $('li.thismenu div.submenu').show();
    };
    $('.left_ico').click(function(){
        $(this).toggleClass('left_active');
        $("#menubox").toggle();
    });
    function reurl(obj){
        var url = obj.value;
        window.location.href=url;
    }

    $('a').css('text-decoration','none');

    function admin_left_one(obj)
    {
        if($(obj).parent('span').next('ul').css('display')=='block'){
            $(obj).parent('span').next('ul').slideUp(100).children('li');
        }else{
            $(obj).parent('span').next('ul').slideDown(100).children('li');
        }

    }

    var adminLeftNavFlag = "<?php echo !empty($_GET['adminLeftNavFlag'])?$_GET['adminLeftNavFlag']:'0';?>";
    if(adminLeftNavFlag == '0'){
        var max = $('.admin_left_one').length;
        for(var i = 0 ; i<max;i++){
            $('.admin_left_one').eq(i).parent('span').next('ul').slideUp(100).children('li');
        }
    }else{
        var oneId = "<?php echo !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'0';?>";
        var twoId = "<?php echo !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'0';?>";
        var max = $('.admin_left_one').length;
        for(var i = 0 ; i<max; i++){
            if(i == oneId){
                $('.admin_left_one').eq(i).parent('span').next('ul').slideDown(100).children('li');
                var maxTwo = $('.admin_left_li').length;
                for(var j = 0 ; j<maxTwo ; j++){
                    if(j == twoId){
                        $('.admin_left_one').eq(i).parent().next('ul').find('.admin_left_li').eq(twoId).css('background','#A3BAD5');
                    }
                }
            }else{
                $('.admin_left_one').eq(i).parent('span').next('ul').slideUp(100).children('li');
            }

        }
    }
</script>

