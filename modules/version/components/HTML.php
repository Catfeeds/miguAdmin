<?php
/*created by PhpStorm.
 * User: xiangl
 * Date: 2015/8/20 0020
 * Time: 9:49
 */
class HTML
{
    public static function news()
    {
	$html = '<style>.newsCenter{
        width:200px;
        height:300px;
        float:left;
        margin-left: 10px;
    }
	 .newsTitle{
        width:200px;
        height:50px;
        font-size: 20px;
        position: absolute;
        top:20px;
        text-align: center;
        line-height: 50px;
        z-index:1;
    }
     .editTop{
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
    .delTop{
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
    .lit{
	border:1px solid #ccc;
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
</style>';
	$html .= '<div class="newsCenter">
            <ul>
                <li class="lit">
                    <span class="editTop" onclick="editNews(this)">修改</span>
                    <!--<span class="delTop" onclick="delNews(this)">删除</span>-->
                    <img src="/file/3.png" style="position:relative;z-index:9999" alt="" appFlag="1" onclick="addNews(this)" order="5">
                </li>
            </ul>
        </div>';
	return $html;
	
    }
	
    public static function top()
    {
	$html = '
<style>
    .centerTop{
        width:200px;
        height:300px;
        float:left;
        margin-left: 10px;
    }
    .centerTopApp{
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
    .editTop{
        width:80px;
        height:40px;
        color:black;
        position: absolute;
        top:0px;
        left:-13px;
        text-align: center;
        line-height: 40px;
        z-index:100;
    }
    .delTop{
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
    topUl{
        display:block;
        float:left;
    }
    .lit{
	border:1px solid #ccc;	
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
        font-size: 20px;
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
    font-size: 15px;
   }
</style>
';
	$html .= '<div class="centerTop">
    <div class="topPic">

        <img src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="addTop(this)" imgFlag="1" order="1">
        <img style="position:absolute;top:30px;left:60px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
    </div>
    <ul>
        <li class="lit">

            <img src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="addTop(this)" order="2">
                  <img style="position:absolute;top:12px;left:60px;width:30px;height:30px;border-radius:10px;" src="/file/u1892.png">
  
        </li>
        <li class="lit">

            <img src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="addTop(this)" order="3">
                       <img style="position:absolute;top:12px;left:60px;width:30px;height:30px;border-radius:10px;" src="/file/u1892.png">
  
        </li>
        <li class="lit">

            <img src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="addTop(this)" order="4">
                       <img style="position:absolute;top:12px;left:60px;width:30px;height:30px;border-radius:10px;" src="/file/u1892.png">
  
        </li>
        <li class="lit">

            <img src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="addTop(this)" order="5">
                       <img style="position:absolute;top:12px;left:60px;width:30px;height:30px;border-radius:10px;" src="/file/u1892.png">
  
        </li>
    </ul>
</div>


<div class="centerTopApp">
    <div class="top_app">
       应用排行榜
    </div>
    <ul>
        <li class="lit">

            <span>
                <img src="/file/3.png" style="position:relative;z-index:9999" alt="" appFlag="1" onclick="addTop(this)" order="1">
                           <img style="position:absolute;top:12px;left:60px;width:30px;height:30px;border-radius:10px;" src="/file/u1892.png">
  
            </span>
        </li>
        <li class="lit">

            <img src="/file/3.png" style="position:relative;z-index:9999" alt="" appFlag="1" onclick="addTop(this)" order="2">
                       <img style="position:absolute;top:12px;left:60px;width:30px;height:30px;border-radius:10px;" src="/file/u1892.png">
  
        </li>
        <li class="lit">

            <img src="/file/3.png" style="position:relative;z-index:9999" alt="" appFlag="1" onclick="addTop(this)" order="3">
                       <img style="position:absolute;top:12px;left:60px;width:30px;height:30px;border-radius:10px;" src="/file/u1892.png">
  
        </li>
        <li class="lit">

            <img src="/file/3.png" style="position:relative;z-index:9999" alt="" appFlag="1" onclick="addTop(this)" order="4">
                       <img style="position:absolute;top:12px;left:60px;width:30px;height:30px;border-radius:10px;" src="/file/u1892.png">
  
        </li>
        <li class="lit">

            <img src="/file/3.png" style="position:relative;z-index:9999" alt="" appFlag="1" onclick="addTop(this)" order="5">
                       <img style="position:absolute;top:12px;left:60px;width:30px;height:30px;border-radius:10px;" src="/file/u1892.png">
  
        </li>
    </ul>
</div>';
	return $html;
    }
	
    public static function operating($val){
        $html = '
		<table class="mtable mt10" align="center" cellpadding="10" cellspacing="0" width="99%">
			<tr>
				<td align="right" width="100">昵称：</td>
				<td>'.$val['nickname'].'</td>
			</tr>
			<tr>
				<td align="right">用户组：</td>
				<td>'.$val['name'].'</td>
			</tr>
			<tr>
				<td align="right">操作：</td>
				<td>'.$val['edit'].'</td>
			</tr>
			<tr>
				<td align="right">操作内容：</td>
				<td>'.$val['content'].'</td>
			</tr>
			<tr>
				<td align="right">操作时间：</td>
				<td>'.date('Y-m-d H:i:s',$val['oTime']).'</td>
			</tr>
		</table>
		';
        return $html;
    }

    public static function data($mvui){
        $html = '
			<style type="text/css">
				.ui-a{background-color:#898989;height:320px;text-align: center;width:175px;}
				#b-2{background-color:#898989;height:320px;text-align: center;width:175px;}
				#h-8,#h-9,#h-10{height:100px;background-color:#898989;text-align: center;width: 175px;}
				#h-9,#h-10{margin-top:10px;}

                .ui-s:nth-child(3n){margin-bottom: 0px;}
                .ui-s{text-align: center; width:175px; background-color: #898989;height:100px; margin-bottom: 10px;}
                .ui-s a{position: absolute;top:0;left:0;background-color:#898989;padding:5px 10px;}
                .ui-s a img{position: absolute;top:0;left:0;background-color:#898989;}
                .ui-s{position: relative;}
			</style>
		';

        //ar_dump($mvui);die;
        $datu=count($mvui);


        $zong=($datu*200+175+20).'px';

        $html .= '<div class="modules" id="dddd" style="margin-top:20px;overflow-x: scroll;width: 100%"><div id="cccc" style="width:'.$zong.';height:400px;overflow:auto">';
        //print_r($mvui);
        $html .= '<div id="aaaa">';
        foreach($mvui as $key => $val){
	if($val[0]['type']<>3){
            $html .='<div class="fl model1 mr10">
				<div id="'.$val[0]['position'].'" class="ui-a '.'m'.$val[0]['position'].'" >';
            $arr = MvUiManager::getKey($val[0]['position'],$mvui);
            $html .='<ul>';
            $html .= empty($arr)?'':'<li><img src="'.$arr[0]['pic'].'" width="175px" height="320px">';
            $html .= '<a href="javascript:void(0)" style="" dss="'.$val[0]['id'].'" pos="'.$val[0]['position'].'">'.(empty($arr)?'点击上传':'点击修改').'</a>';
            $html .= '<a href="javascript:void(0)"  gid="'.$val[0]['gid'].'" class="del" dss="'.$val[0]['id'].'" pos="'.$val[0]['position'].'" style="margin-left: 131px">删除</a>';
            $html .= '</li></ul>';
            $html .= '</div>
			</div>';
        }
}


        foreach($mvui as $key=>$val){
            $shuzu=$key;
        }
        if(!empty($shuzu)){
            $barr=explode('-',$shuzu);
	   if(!empty($barr[1])){
            $ba = $barr[1];
         }else{ $ba = 0;}   //$b=$barr[1]+1;

	

            $max = 9999;
            $len = strlen($max);
            for($i=$ba+1; $i<=9999;$i++){
                $len2=$len-strlen($i);
                $s='';
                for($j=0;$j<$len2;$j++){
                    $s.='0';
                }
                $b=$s.$i;
//                echo $b;
                break;
            }

        }else{
            $b='0001';
        }
//style="background:url(../../file/4.png)"
        $html .='<div class="fl model1 mr10" >
				<div id=b-'.$b.' class="ui-a">';
        $arr = MvUiManager::getKey("b-$b",$mvui);
        $html .='<ul>';
        $html .= empty($arr)?'':'<li><img src="'.$arr[0]['pic'].'" width="175px" height="320px">';
        $html .= '<a href="javascript:void(0)" style="" pos=b-'.$b.'>'.(empty($arr)?'':'').'<div style="width:139px;height:210px;"><img style="width:30px;height:30px;border-radius:10px;position:absolute;top:90px;left:60px;" src="/file/u1892.png"></div>';
        $html .= '</li></ul>';
        $html .= '</div>
			</div>';
        $html .= '</div>';


        //x小图

        $html .='<script>

                 // var aaaa = document.getElementById("aaaa").offsetWidth;
                 // var bbbb = document.getElementById("bbbb").offsetWidth;
                //  var s=aaaa+bbbb;
                    //alert(aaaa);
                   // alert(bbbb);
                   //alert(typeof(aaaa));
                //  document.getElementById("cccc").style.width=s+50+"px";
                 // document.getElementById("dddd").style.width=s+50+"px";

                 // alert(s+"px");

                 </script>';



        $html .='</div><div style="clear:both"></div></div>';


        return $html;
    }

    public static function move($mvui,$xiaotu){
        $html = '
			<style type="text/css">
				.ui-a{background-color:#898989;height:320px;text-align: center;width:175px;}
				#b-2{background-color:#898989;height:320px;text-align: center;width:175px;}
				#h-8,#h-9,#h-10{height:100px;background-color:#898989;text-align: center;width: 175px;}
				#h-9,#h-10{margin-top:10px;}
				
                .ui-s:nth-child(3n){margin-bottom: 0px;}
                .ui-s{text-align: center; width:175px; background-color: #898989;height:100px; margin-bottom: 10px;}
                .ui-s a{position: absolute;top:0;left:0;background-color:#898989;padding:5px 10px;}
                .ui-s a img{position: absolute;top:0;left:0;background-color:#898989;}
                .ui-s{position: relative;}
			</style>
		';


        $datu=count($mvui);
        $xt=count($xiaotu);
        $xiao=ceil($xt/3);
        //大图的宽度是175
        //小图的也是175
        //总宽度就是
        if($xt%3==0){
            $zong=($datu*175+175+$xiao*175+175+300).'px';
        }else{
            $zong=($datu*175+175+$xiao*175+300).'px';
        }


        // print_r($mvui);die();
        $html .= '<div class="modules" id="dddd" style="margin-top:20px;overflow-x: scroll;width: 100%"><div id="cccc" style="width:'.$zong.';height:400px;">';
        //print_r($mvui);
        $html .= '<div id="aaaa">';
        foreach($mvui as $key => $val){

            $html .='<div class="fl model1 mr10">
				<div id="'.$val[0]['position'].'" class="ui-a" >';
            $arr = MvUiManager::getKey($val[0]['position'],$mvui);
            $html .='<ul>';
            $html .= empty($arr)?'':'<li><img src="'.$arr[0]['pic'].'" width="175px" height="320px">';
            $html .= '<a href="javascript:void(0)" style="" pos="'.$val[0]['position'].'">'.(empty($arr)?'点击上传':'点击修改').'</a>';
            $html .= '<a href="javascript:void(0)" epg="'.$val[0]['epg'].'" gid="'.$val[0]['gid'].'" class="del" dss="'.$val[0]['id'].'" pos="'.$val[0]['position'].'" style="margin-left: 131px">删除</a>';
            $html .= '</li></ul>';
            $html .= '</div>
			</div>';
        }



        foreach($mvui as $key=>$val){
            $shuzu=$key;
        }
        if(!empty($shuzu)){
            $barr=explode('-',$shuzu);
            $ba = $barr[1];
            //$b=$barr[1]+1;


            $max = 9999;
            $len = strlen($max);
            for($i=$ba+1; $i<=9999;$i++){
                $len2=$len-strlen($i);
                $s='';
                for($j=0;$j<$len2;$j++){
                    $s.='0';
                }
                $b=$s.$i;
//                echo $b;
                break;
            }

        }else{
            $b='0001';
        }
//style="background:url(../../file/4.png)"
        $html .='<div class="fl model1 mr10" >
				<div id=b-'.$b.' class="ui-a">';
        $arr = MvUiManager::getKey("b-$b",$mvui);
        $html .='<ul>';
        $html .= empty($arr)?'':'<li><img src="'.$arr[0]['pic'].'" width="175px" height="320px">';
        $html .= '<a href="javascript:void(0)" style="" pos=b-'.$b.'>'.(empty($arr)?'':'').'<img src="../../file/4.png"></a>';
        $html .= '</li></ul>';
        $html .= '</div>
			</div>';
        $html .= '</div>';


        //x小图
        $html .='<div class="box" id="bbbb">';
        $i=0;
        foreach($xiaotu as $key => $val) {
            if($i%3==0){
                $html.='<div style="float:left; margin-right: 10px;height:320px" >';
            }
            $html .= '<div id="'.$val[0]['position'].'" class="ui-s">';
            $arr = MvUiManager::getKey($val[0]['position'],$xiaotu);
            $html .=empty($arr)?'': '<img src="'.$arr[0]['pic'].'"  alt="" width="175px" height="100px">';
            $html .= '<a href="javascript:void(0)" style="" pos="'.$val[0]['position'].'">'.(empty($arr)?'点击上传':'点击修改').'</a>';
            $html .= '<a href="javascript:void(0)" class="ss" xss="'.$val[0]['id'].'" style="margin-left: 131px">删除</a>';
            $html .= '</div>';
            $i++;
            if($i%3==0){
                $html .='</div>';
            }
        }
//        $datu = count($mvui);
//        $xt   = count($xiaotu);
//        $xiao = ceil($xt/3);
//        echo $xiao;
        $html .='<script>

                 // var aaaa = document.getElementById("aaaa").offsetWidth;
                 // var bbbb = document.getElementById("bbbb").offsetWidth;
                //  var s=aaaa+bbbb;
                    //alert(aaaa);
                   // alert(bbbb);
                   //alert(typeof(aaaa));
                //  document.getElementById("cccc").style.width=s+50+"px";
                 // document.getElementById("dddd").style.width=s+50+"px";

                 // alert(s+"px");

                 </script>';

        // print_r($xiaotu);

        foreach($xiaotu as $k=>$v){
            $shuzus=$k;
        }
        //   print_r($shuzus);
        if(!empty($shuzus)){
            $barrs=explode('-',$shuzus);
            //$s=$barrs[1]+1;
            $bas = $barrs[1];


            $max = 9999;
            $len = strlen($max);
            for($i=$bas+1; $i<=9999;$i++){
                $len2=$len-strlen($i);
                $ss='';
                for($j=0;$j<$len2;$j++){
                    $ss.='0';
                }
                $s=$ss.$i;
                break;
            }
        }else{
            $s='0001';
        }
        //echo $s;
        $html.='<div  height="320px" style="float:left;">';
        $html .= '<div id=s-'.$s.'  class="ui-s" style="">';
        $arr = MvUiManager::getKey("s-$s",$xiaotu);
        $html .=empty($arr)?'': '<img src="'.$arr[0]['pic'].'"  alt=""  width="175px" height="100px">';
        $html .= '<a href="javascript:void(0)" style="" pos=s-'.$s.'>'.(empty($arr)?'':'').'<img src="/file/3.png" style="position:relative;z-index:9999">      <img style="position:absolute;top:30px;left:60px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 </a>';
        $html .= '</div>';
        $html .='</div>';

        $html .='</div></div>';


        return $html;
    }

    public static function moveThree($mvui,$xiaotu){
        $html = '
			<style type="text/css">
				.ui-a{background-color:#898989;height:320px;text-align: center;width:175px;}
				#b-2{background-color:#898989;height:320px;text-align: center;width:350px;}
				#h-8,#h-9,#h-10{height:100px;background-color:#898989;text-align: center;width: 175px;}
				#h-9,#h-10{margin-top:10px;}
                .ui-s:nth-child(3n){margin-bottom: 0px;}
                .ui-s{text-align: center; width:175px; background-color: #898989;height:100px; margin-bottom: 10px;}
                .ui-d{text-align: center; width:350px; background-color: #898989;height:200px; margin-bottom: 10px;}
                .ui-f{text-align: center; width:350px; background-color: #898989;height:100px; margin-bottom: 10px;}
                .ui-s a{position: absolute;top:0;left:0;background-color:#898989;padding:5px 10px;}
                .ui-s a img{position: absolute;top:0;left:0;background-color:#898989;}
                .ui-s{position: relative;}
			</style>
		';


        $datu=count($mvui);
        $xt=count($xiaotu);
        $xiao=ceil($xt/3);
        //大图的宽度是175
        //小图的也是175
        //总宽度就是
        if($xt%3==0){
            $zong=($datu*175+175+$xiao*175+175+300+350).'px';
        }else{
            $zong=($datu*175+175+$xiao*175+300+350).'px';
        }


        // print_r($mvui);die();
        $html .= '<div class="modules" id="dddd" style="margin-top:20px;overflow-x: scroll;width: 100%"><div id="cccc" style="width:'.$zong.';height:400px;">';
        //print_r($mvui);

        //x小图
        $html .='<div class="box" id="bbbb">';
        $i=0;
        foreach($xiaotu as $key => $val) {
            if($i%3==0){
                $html.='<div style="float:left; margin-right: 10px;height:320px" >';
            }
            $html .= '<div id="'.$val[0]['position'].'" class="ui-s">';
            $arr = MvUiManager::getKey($val[0]['position'],$xiaotu);
            $html .=empty($arr)?'': '<img src="'.$arr[0]['pic'].'"  alt="" width="175px" height="100px">';
            $html .= '<a href="javascript:void(0)" style="" pos="'.$val[0]['position'].'">'.(empty($arr)?'点击上传':'点击修改').'</a>';
            $html .= '<a href="javascript:void(0)" class="ss" xss="'.$val[0]['id'].'" style="margin-left: 131px">删除</a>';
            $html .= '</div>';
            $i++;
            if($i%3==0){
                $html .='</div>';
            }
        }
//        $datu = count($mvui);
//        $xt   = count($xiaotu);
//        $xiao = ceil($xt/3);
//        echo $xiao;
        $html .='<script>

                 // var aaaa = document.getElementById("aaaa").offsetWidth;
                 // var bbbb = document.getElementById("bbbb").offsetWidth;
                //  var s=aaaa+bbbb;
                    //alert(aaaa);
                   // alert(bbbb);
                   //alert(typeof(aaaa));
                //  document.getElementById("cccc").style.width=s+50+"px";
                 // document.getElementById("dddd").style.width=s+50+"px";

                 // alert(s+"px");

                 </script>';

        // print_r($xiaotu);

        foreach($xiaotu as $k=>$v){
            $shuzus=$k;
        }
        //   print_r($shuzus);
        if(!empty($shuzus)){
            $barrs=explode('-',$shuzus);
            //$s=$barrs[1]+1;
            $bas = $barrs[1];
            $max = 9999;
            $len = strlen($max);
            for($i=$bas+1; $i<=9999;$i++){
                $len2=$len-strlen($i);
                $ss='';
                for($j=0;$j<$len2;$j++){
                    $ss.='0';
                }
                $s=$ss.$i;
                break;
            }
        }else{
            $s='0001';
        }
        //echo $s;
        $html .='<div  height="320px" style="float:left;">';
        $html .= '<div id=s-'.$s.'  class="ui-s" style="">';
        $arr   = MvUiManager::getKey("s-$s",$xiaotu);
        $html .=empty($arr)?'': '<img src="'.$arr[0]['pic'].'"  alt=""  width="175px" height="100px">';
        $html .= '<a href="javascript:void(0)" style="" pos=s-'.$s.'>'.(empty($arr)?'':'').'<img src="/file/3.png" style="position:relative;z-index:9999">      <img style="position:absolute;top:30px;left:60px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 </a>';
        $html .= '</div>';
        $html .='</div>';

        //4个最小图
        $html .='<div class="box" id="eeee">';
        $i=0;
        foreach($xiaotu as $key => $val) {
            if($i%3==0){
                $html.='<div style="float:left; margin-right: 10px;height:320px" >';
            }
            $html .= '<div id="'.$val[0]['position'].'" class="ui-d">';
            $arr = MvUiManager::getKey($val[0]['position'],$xiaotu);
            $html .= empty($arr)?'': '<img src="'.$arr[0]['pic'].'"  alt="" width="175px" height="200px">';
            $html .= '<a href="javascript:void(0)" style="" pos="'.$val[0]['position'].'">'.(empty($arr)?'点击上传':'点击修改').'</a>';
            $html .= '<a href="javascript:void(0)" class="ss" xss="'.$val[0]['id'].'" style="margin-left: 131px">删除</a>';
            $html .= '</div>';
            $i++;
            if($i%3==0){
                $html .='</div>';
            }
        }
        $html .='<script>

                 // var aaaa = document.getElementById("aaaa").offsetWidth;
                 // var bbbb = document.getElementById("bbbb").offsetWidth;
                //  var s=aaaa+bbbb;
                    //alert(aaaa);
                   // alert(bbbb);
                   //alert(typeof(aaaa));
                //  document.getElementById("cccc").style.width=s+50+"px";
                 // document.getElementById("dddd").style.width=s+50+"px";

                 // alert(s+"px");

                 </script>';

        // print_r($xiaotu);

        foreach($xiaotu as $k=>$v){
            $shuzus=$k;
        }
        //   print_r($shuzus);
        if(!empty($shuzus)){
            $barrs=explode('-',$shuzus);
            //$s=$barrs[1]+1;
            $bas = $barrs[1];
            $max = 9999;
            $len = strlen($max);
            for($i=$bas+1; $i<=9999;$i++){
                $len2=$len-strlen($i);
                $ss='';
                for($j=0;$j<$len2;$j++){
                    $ss.='0';
                }
                $s=$ss.$i;
                break;
            }
        }else{
            $s='0001';
        }
        //echo $s;
        $html .='<div  height="320px" style="float:left;">';
        $html .= '<div id=s-'.$s.'  class="ui-d" style="float:left">';
        $arr   = MvUiManager::getKey("s-$s",$xiaotu);
        $html .=empty($arr)?'': '<img src="'.$arr[0]['pic'].'"  alt=""  width="175px" height="100px">';
        $html .= '<a href="javascript:void(0)" style="" pos=s-'.$s.'>'.(empty($arr)?'':'').'<img src="/file/3.png" style="position:relative;z-index:9999">      <img style="position:absolute;top:30px;left:60px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 </a>';
        $html .= '</div>';
        $html .= '</div>';

        //2个最小图
        $html .='<div class="box" id="ffff">';
        $i=0;
        foreach($xiaotu as $key => $val) {
            if($i%3==0){
                $html.='<div style="float:left; margin-right: 10px;height:320px" >';
            }
            $html .= '<div id="'.$val[0]['position'].'" class="ui-f">';
            $arr = MvUiManager::getKey($val[0]['position'],$xiaotu);
            $html .= empty($arr)?'': '<img src="'.$arr[0]['pic'].'"  alt="" width="175px" height="100px">';
            $html .= '<a href="javascript:void(0)" style="" pos="'.$val[0]['position'].'">'.(empty($arr)?'点击上传':'点击修改').'</a>';
            $html .= '<a href="javascript:void(0)" class="ss" xss="'.$val[0]['id'].'" style="margin-left: 131px">删除</a>';
            $html .= '</div>';
            $i++;
            if($i%3==0){
                $html .='</div>';
            }
        }

        // print_r($xiaotu);

        foreach($xiaotu as $k=>$v){
            $shuzus=$k;
        }
        //   print_r($shuzus);
        if(!empty($shuzus)){
            $barrs=explode('-',$shuzus);
            //$s=$barrs[1]+1;
            $bas = $barrs[1];
            $max = 9999;
            $len = strlen($max);
            for($i=$bas+1; $i<=9999;$i++){
                $len2=$len-strlen($i);
                $ss='';
                for($j=0;$j<$len2;$j++){
                    $ss.='0';
                }
                $s=$ss.$i;
                break;
            }
        }else{
            $s='0001';
        }
        //echo $s;
        $html .='<div  height="320px" style="float:left;">';
        $html .= '<div id=s-'.$s.'  class="ui-f" style="float:left">';
        $arr   = MvUiManager::getKey("s-$s",$xiaotu);
        $html .= empty($arr)?'': '<img src="'.$arr[0]['pic'].'"  alt=""  width="175px" height="100px">';
        $html .= '<a href="javascript:void(0)" style="" pos=s-'.$s.'>'.(empty($arr)?'':'').'<img src="/file/3.png" style="position:relative;z-index:9999">      <img style="position:absolute;top:30px;left:60px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 </a>';
        $html .= '</div>';
        $html .= '</div>';

        //大图
        $html .= '<div id="aaaa">';
        foreach($mvui as $key => $val){

            $html .='<div class="fl model1 mr10" >
				<div id="'.$val[0]['position'].'" class="ui-a" >';
            $arr = MvUiManager::getKey($val[0]['position'],$mvui);
            $html .='<ul>';
            $html .= empty($arr)?'':'<li><img src="'.$arr[0]['pic'].'" width="175px" height="320px">';
            $html .= '<a href="javascript:void(0)" style="" pos="'.$val[0]['position'].'">'.(empty($arr)?'点击上传':'点击修改').'</a>';
            $html .= '<a href="javascript:void(0)" epg="'.$val[0]['epg'].'" gid="'.$val[0]['gid'].'" class="del" dss="'.$val[0]['id'].'" pos="'.$val[0]['position'].'" style="margin-left: 131px">删除</a>';
            $html .= '</li></ul>';
            $html .= '</div>
			</div>';
        }



        foreach($mvui as $key=>$val){
            $shuzu=$key;
        }
        if(!empty($shuzu)){
            $barr=explode('-',$shuzu);
            $ba = $barr[1];
            //$b=$barr[1]+1;
            $max = 9999;
            $len = strlen($max);
            for($i=$ba+1; $i<=9999;$i++){
                $len2=$len-strlen($i);
                $s='';
                for($j=0;$j<$len2;$j++){
                    $s.='0';
                }
                $b=$s.$i;
//                echo $b;
                break;
            }

        }else{
            $b='0001';
        }
//style="background:url(../../file/4.png)"
        $html .='<div class="fl model1 mr10" >
				<div id=b-'.$b.' class="ui-a">';
        $arr = MvUiManager::getKey("b-$b",$mvui);
        $html .='<ul>';
        $html .= empty($arr)?'':'<li><img src="'.$arr[0]['pic'].'" width="175px" height="320px">';
        $html .= '<a href="javascript:void(0)" style="" pos=b-'.$b.'>'.(empty($arr)?'':'').'<img src="../../file/4.png"></a>';
        $html .= '</li></ul>';
        $html .= '</div>
			</div>';
        $html .= '</div>';



        $html .='</div></div>';


        return $html;
    }

    public static function moves($mvui,$xiaotu){
        $html = '
			<style type="text/css">
				.ui-a{background-color:#898989;height:320px;text-align: center;width:175px;}
				#b-2{background-color:#898989;height:320px;text-align: center;width:175px;}
				#h-8,#h-9,#h-10{height:100px;background-color:#898989;text-align: center;width: 175px;}
				#h-9,#h-10{margin-top:10px;}

                .ui-s:nth-child(3n){margin-bottom: 0px;}
                .ui-s{text-align: center; width:175px; background-color: #898989;height:100px; margin-bottom: 10px;}
                .ui-s a{position: absolute;top:0;left:0;background-color:#898989;padding:5px 10px;}
                .ui-s a img{position: absolute;top:0;left:0;background-color:#898989;}
                .ui-s{position: relative;}
			</style>
		';


        $datu=count($mvui);
        $xt=count($xiaotu);
        $xiao=ceil($xt/3);

        //大图的宽度是175
        //小图的也是175
        //总宽度就是
        if($xt%3==0){
            $zong=($datu*175+175+$xiao*175+175+300).'px';
        }else{
            $zong=($datu*175+175+$xiao*175+300).'px';
        }


        // print_r($mvui);die();
        $html .= '<div class="modules" id="dddd" style="margin-top:20px;overflow-x: scroll;width: 100%"><div id="cccc" style="width:'.$zong.';height:400px;">';
        //print_r($mvui);
        $html .= '<div id="aaaa">';
        foreach($mvui as $key => $val){

            $html .='<div class="fl model1 mr10">
				<div id="'.$val[0]['position'].'" class="ui-a" >';
            $arr = MvUiManager::getKey($val[0]['position'],$mvui);
            $html .='<ul>';
            $html .= empty($arr)?'':'<li><img src="'.$arr[0]['pic'].'" width="175px" height="320px">';
            $html .= '<a href="javascript:void(0)" style="" pos="'.$val[0]['position'].'">'.(empty($arr)?'点击上传':'点击修改').'</a>';
            //$html .= '<a href="javascript:void(0)" epg="'.$val[0]['epg'].'" gid="'.$val[0]['gid'].'" class="del" dss="'.$val[0]['id'].'" pos="'.$val[0]['position'].'" style="margin-left: 131px">删除</a>';
            $html .= '</li></ul>';
            $html .= '</div>
			</div>';
        }

        foreach($mvui as $key=>$val){
            $shuzu=$key;
        }
        if(!empty($shuzu)){
            $barr=explode('-',$shuzu);
            $ba = $barr[1];
            //$b=$barr[1]+1;


            $max = 9999;
            $len = strlen($max);
            for($i=$ba+1; $i<=9999;$i++){
                $len2=$len-strlen($i);
                $s='';
                for($j=0;$j<$len2;$j++){
                    $s.='0';
                }
                $b=$s.$i;
//                echo $b;
                break;
            }

        }else{
            $b='0001';
        }
//style="background:url(../../file/4.png)"
        $html .='<div class="fl model1 mr10" >
				<div id=b-'.$b.' class="ui-a">';
        $arr = MvUiManager::getKey("b-$b",$mvui);
        $html .='<ul>';
        $html .= empty($arr)?'':'<li><img src="'.$arr[0]['pic'].'" width="175px" height="320px">';
        $html .= '<a href="javascript:void(0)" style="" pos=b-'.$b.'>'.(empty($arr)?'':'').'<img src="../../file/4.png"></a>';
        $html .= '</li></ul>';
        $html .= '</div>
			</div>';
        $html .= '</div>';


        //x小图
        $html .='<div class="box" id="bbbb">';
        $i=0;
        foreach($xiaotu as $key => $val) {
            if($i%3==0){
                $html.='<div style="float:left; margin-right: 10px;height:320px" >';
            }
            $html .= '<div id="'.$val[0]['position'].'" class="ui-s">';
            $arr = MvUiManager::getKey($val[0]['position'],$xiaotu);
            $html .=empty($arr)?'': '<img src="'.$arr[0]['pic'].'"  alt="" width="175px" height="100px">';
            $html .= '<a href="javascript:void(0)" style="" pos="'.$val[0]['position'].'">'.(empty($arr)?'点击上传':'点击修改').'</a>';
            //$html .= '<a href="javascript:void(0)" class="ss" xss="'.$val[0]['id'].'" style="margin-left: 131px">删除</a>';
            $html .= '</div>';
            $i++;
            if($i%3==0){
                $html .='</div>';
            }
        }
//        $datu = count($mvui);
//        $xt   = count($xiaotu);
//        $xiao = ceil($xt/3);
//        echo $xiao;
        $html .='<script>

                 // var aaaa = document.getElementById("aaaa").offsetWidth;
                 // var bbbb = document.getElementById("bbbb").offsetWidth;
                //  var s=aaaa+bbbb;
                    //alert(aaaa);
                   // alert(bbbb);
                   //alert(typeof(aaaa));
                //  document.getElementById("cccc").style.width=s+50+"px";
                 // document.getElementById("dddd").style.width=s+50+"px";

                 // alert(s+"px");

                 </script>';

        // print_r($xiaotu);

        foreach($xiaotu as $k=>$v){
            $shuzus=$k;
        }
        //   print_r($shuzus);
        if(!empty($shuzus)){
            $barrs=explode('-',$shuzus);
            //$s=$barrs[1]+1;
            $bas = $barrs[1];


            $max = 9999;
            $len = strlen($max);
            for($i=$bas+1; $i<=9999;$i++){
                $len2=$len-strlen($i);
                $ss='';
                for($j=0;$j<$len2;$j++){
                    $ss.='0';
                }
                $s=$ss.$i;
                break;
            }
        }else{
            $s='0001';
        }
        //echo $s;
        $html.='<div  height="320px" style="float:left;">';
        $html .= '<div id=s-'.$s.'  class="ui-s" style="">';
        $arr = MvUiManager::getKey("s-$s",$xiaotu);
        $html .=empty($arr)?'': '<img src="'.$arr[0]['pic'].'"  alt=""  width="175px" height="100px">';
        $html .= '<a href="javascript:void(0)" style="" pos=s-'.$s.'>'.(empty($arr)?'':'').'<img src="/file/3.png" style="position:relative;z-index:9999">      <img style="position:absolute;top:30px;left:60px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
 </a>';
        $html .= '</div>';
        $html .='</div>';

        $html .='</div></div>';


        return $html;
    }

    public static function selv($mvui){

        $html='<style type="text/css">
                #h-1,#h-2,#h-3,#h-4,#h-5,#h-6,#h-7,#h-8,#h-9,#h-10,#h-11,#h-12,#h-13,#h-14,#h-15,#h-16,#h-17,#h-18,#h-19,#h-20{width:200px;height:110px;margin-top:5px}
            </style>';

        $html .='     <div class="modules" style="margin-top:5px;">
                <div class="fl mr10">
                    <div id="h-1" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-1',$mvui);
        // print_r($arr);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-1">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-1" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-2" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-2',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-2">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-2" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
        <div id="h-3" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-3',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-3">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-3" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-4" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-4',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-4">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-4" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-5" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-5',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-5">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-5" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            </div>
            <div class="fl mr10">
                <div id="h-6" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-6',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-6">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-6" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-7" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-7',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-7">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-7" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-8" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-8',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-8">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-8" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-9" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-9',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-9">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-9" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-10" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-10',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-10">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-10" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            </div>
            <div class="fl mr10">
                <div id="h-11" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-11',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-11">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-11" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-12" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-12',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-12">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-12" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-13" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-13',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-13">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-13" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-14" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-14',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-14">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-14" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-15" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-15',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-15">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-15" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            </div>
            <div class="fl mr10">
                <div id="h-16" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-16',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-16">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-16" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-17" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-17',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-17">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-17" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-18" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-18',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-18">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-18" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-19" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-19',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-19">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-19" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>
            <div id="h-20" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-20',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-20">'.(empty($arr)?'点击上传':'点击修改').'</a>';
        $html .=empty($arr[0]['id'])?'':'<a href="javascript:void(0)" class="del" pos="h-20" del="'.$arr[0]["id"].'">删除</a>';
        $html .= '</div>
            <div class="clear"></div>';

        $html .= '
            </div>';
        return $html;
    }

    public static function selvs($mvui){

        $html='<style type="text/css">
                #h-1,#h-2,#h-3,#h-4,#h-5,#h-6,#h-7,#h-8,#h-9,#h-10,#h-11,#h-12,#h-13,#h-14,#h-15,#h-16,#h-17,#h-18,#h-19,#h-20{width:200px;height:110px;margin-top:5px}
            </style>';

        $html .='     <div class="modules" style="margin-top:5px;">
                <div class="fl mr10">
                    <div id="h-1" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-1',$mvui);
        // print_r($arr);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-1">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-2" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-2',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-2">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
        <div id="h-3" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-3',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-3">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-4" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-4',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-4">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-5" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-5',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-5">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            </div>
            <div class="fl mr10">
                <div id="h-6" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-6',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-6">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-7" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-7',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-7">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-8" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-8',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-8">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-9" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-9',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-9">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-10" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-10',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-10">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            </div>
            <div class="fl mr10">
                <div id="h-11" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-11',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-11">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-12" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-12',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-12">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-13" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-13',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-13">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-14" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-14',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-14">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-15" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-15',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-15">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            </div>
            <div class="fl mr10">
                <div id="h-16" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-16',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-16">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-17" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-17',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-17">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-18" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-18',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-18">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-19" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-19',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-19">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>
            <div id="h-20" class=" ui-a">';
        $arr = MvSeuiManager::getKey('h-20',$mvui);
        $html .= empty($arr)?'':'<img src="'.$arr[0]['pic'].'" width="100%" height="100%">';
        $html .= '<a href="javascript:void(0)" style="" pos="h-20">'.(empty($arr)?'点击上传':'点击修改').'</a>';

        $html .= '</div>
            <div class="clear"></div>';

        $html .= '
            </div>';
        return $html;
    }


    public static function getTemplate($templateId)
    {
	 	if($templateId <= 11){
            $html = "<style>
        .m-1{ position:relative; background:#666666;   width:125px;  height:52.5px;  border:1px solid #ccc;  border-radius: 8px;  margin-bottom: 10px;  float:left;  }
        .m-1-2{  position:relative;background:#666666;  width:125px;  height:115px;  margin-bottom: 20px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  }
        .m-1-3{  position:relative;background:#666666;  width:128px;  height:182.5px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  margin-bottom: 20px;  }
        .m-2-3{  position:relative;background:#666666;  width:280px;  height:182.5px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  margin-bottom: 20px;  }
        .m-2-6{  position:relative;background:#666666;  width:280px;  height:390px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  }
        .m-2-4{  position:relative;background:#666666;  width:280px;  height:250px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  margin-bottom: 20px;  }
        .m-3-4{  position:relative;background:#666666;  width:420px;  height:250px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  margin-bottom: 20px;  }
        .m-2-2{  position:relative;background:#666666;  width:280px;  height:115px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  }
        .m-4-4{  position:relative; width:580px;  height:250px;  border:1px solid #ccc;  border-radius: 8px;  float:left;  }
        .parent-1{ position:relative; width:125px;  height:390px;  float:left;  margin-right: 20px;  }
        .parent-1-2{ position:relative; width:280px;  height:390px;  float:left;  margin-right: 20px;  }
        .parent-1-3{ position:relative; width:420px;  height:390px;  float:left;  margin-right: 20px;  }
        .parent-1-4{ position:relative; width:580px;  height:390px;  float:left;  margin-right: 20px;  }
        .fill-1-3{  width:19px;  height:182.5px;  float: left;  }
        .fill-1-2{  width:19px;  height:115.5px;  float: left;  }
        .fill-1-4{  width:280px;  height:20px;  float:left  }
        .fill-1-5{  width:580px;  height:20px;  float:left;  }
        .fill-1-6{  width:15px;  height:115.5px;  float: left;  }
        .clickImg-1-1{  width:125px;  height:52.5px;  border:1px solid #ccc;  text-align: center;  }
        .clickImg-1-2{  width:125px;  height:115px;  text-align: center;  }
        .clickImg-1-3{  width:128px;  height:182.5px;  text-align: center;  }
        .clickImg-2-3{  width:280px;  height:182.5px;  text-align: center;  }
        .clickImg-2-6{  width:280px;  height:390px;  text-align: center;  }
        .clickImg-2-4{  width:280px;  height:250px;  text-align: center;  }
        .clickImg-3-4{  width:420px;  height:250px;  text-align: center;  }
        .clickImg-2-2{  width:280px;  height:115px;  text-align: center;  }
        .clickImg-4-4{  width:580px;  height:250px;  text-align: center;  }
        .half-1{   width:60px;height:52px;border:1px solid #ccc;border-radius: 8px;float:left;margin-top:3px;}
        .clickImg-half-1{  width:60px;height:52px;text-align: center;}
        .m-1-1{background:#666666; position:relative; width:125px; height:52.5px; border:1px solid #ccc; border-radius:8px; float:left;}  	
                    </style>" ;
            switch($templateId)
    {
        case 1 :
            $html .= '<div class="templateParent" style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
    <div class="parent-1">
        <div class="m-1-2 order-1" size-w="1" size-h="2" x="0" y="0" order="1">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-2 order-2" size-w="1" size-h="2" x="0" y="250" order="2">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-2 order-3" size-w="1" size-h="2" x="0" y="500" order="3">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-6 order-4" size-w="2" size-h="6" x="270" y="0" order="4">
            <img class="clickImg-2-6" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-3 order-5" size-w="2" size-h="3" x="810" y="0" order="5">
            <img class="clickImg-2-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-6" size-w="1" size-h="3" x="810" y="375" order="6">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="fill-1-3"></div>
        <div class="m-1-3 order-7" size-w="1" size-h="3" x="1080" y="375" order="7">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3 order-8" size-w="1" size-h="3" x="1350" y="0" order="8">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-9" size-w="1" size-h="3" x="1350" y="375" order="9">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>
    <div class="parent-1" >
        <div class="m-1-3 order-10" size-w="1" size-h="3" x="1620" y="0" order="10">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-11" size-w="1" size-h="3" x="1620" y="375" order="11">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-12" size-w="1" size-h="3" x="1890" y="0" order="12">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-13" size-w="1" size-h="3" x="1890" y="375" order="13">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-14" size-w="1" size-h="3" x="2160" y="0" order="14">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-15" size-w="1" size-h="3" x="2160" y="375" order="15">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-16" size-w="1" size-h="3" x="2430" y="0" order="16">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-17" size-w="1" size-h="3" x="2430" y="375" order="17">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>
</div>';
            break;
        case 2 :
            $html .= '<div class="templateParent" style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
    <div class="parent-1">
        <div class="m-1-2 order-18" size-w="1" size-h="2" x="0" y="0" order="18">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1 order-19" size-w="1" size-h="1" x="0" y="250" order="19">
            <img class="clickImg-1-1" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1 order-20" size-w="1" size-h="1" x="0" y="375" order="20">
            <img class="clickImg-1-1" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1 order-21" size-w="1" size-h="1" x="0" y="500" order="21">
            <img class="clickImg-1-1" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1 order-22" size-w="1" size-h="1" x="0" y="625" order="22">
            <img class="clickImg-1-1" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-3 order-23" size-w="2" size-h="3" x="270" y="0" order="23">
            <img class="clickImg-2-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-24" size-w="1" size-h="3" x="270" y="375" order="24">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <span class="fill-1-3"></span>
        <div class="m-1-3 order-25" size-w="1" size-h="3" x="540" y="375" order="25">
              <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3 order-26" size-w="1" size-h="3" x="810" y="0" order="26">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-27" size-w="1" size-h="3" x="810" y="375" order="27">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-28" size-w="1" size-h="3" x="1080" y="0" order="28">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-29" size-w="1" size-h="3" x="1080" y="375" order="29">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-30" size-w="1" size-h="3" x="1350" y="0" order="30">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-31" size-w="1" size-h="3" x="1350" y="375" order="31">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-32" size-w="1" size-h="3" x="1620" y="0" order="32">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-33" size-w="1" size-h="3" x="1620" y="375" order="33">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-34" size-w="1" size-h="3" x="1890" y="0" order="34">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-35" size-w="1" size-h="3" x="1890" y="375" order="35">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-36" size-w="1" size-h="3" x="2160" y="0" order="36">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-37" size-w="1" size-h="3" x="2160" y="375" order="37">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-38" size-w="1" size-h="3" x="2430" y="0" order="38">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
        <div class="m-1-3 order-39" size-w="1" size-h="3" x="2430" y="375" order="39">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                  <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
 
        </div>
    </div>
</div>';
            break;
        case 3:
            $html .= '<div class="templateParent" style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
    <div class="parent-1">
        <div class="m-1-2 order-40" size-w="1" size-h="2" x="0" y="0" order="40">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
        	<img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        	    
        </div>
        <div class="m-1 order-41" size-w="1" size-h="1" x="0" y="250" order="41">
            <img class="clickImg-1-1" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
        	<img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        	
        </div>
        <div class="m-1 order-42" size-w="1" size-h="1" x="0" y="375" order="42">
            <img class="clickImg-1-1" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
            
        </div>
        <div class="m-1 order-43" size-w="1" size-h="1" x="0" y="500" order="43">
            <img class="clickImg-1-1" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
            
        </div>
        <div class="m-1 order-44" size-w="1" size-h="1" x="0" y="625" order="44">
            <img class="clickImg-1-1" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1-3">
        <div class="m-3-4 order-45" size-w="3" size-h="4" x="270" y="0" order="45">
            <img class="clickImg-3-4" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-2 order-46" size-w="1" size-h="2" x="270" y="500" order="46">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-2"></span>
        <div class="m-1-2 order-47" size-w="1" size-h="2" x="540" y="500" order="47">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-2"></span>
        <div class="m-1-2 order-48" size-w="1" size-h="2" x="810" y="500" order="48">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3 order-49" size-w="1" size-h="3" x="1080" y="0" order="49">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-50" size-w="1" size-h="3" x="1080" y="375" order="50">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-51" size-w="1" size-h="3" x="1350" y="0" order="51">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-52" size-w="1" size-h="3" x="1350" y="375" order="52">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-53" size-w="1" size-h="3" x="1620" y="0" order="53">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-54" size-w="1" size-h="3" x="1620" y="375" order="54">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-55" size-w="1" size-h="3" x="1890" y="0" order="55">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-56" size-w="1" size-h="3" x="1890" y="375" order="56">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-57" size-w="1" size-h="3" x="2160" y="0" order="57">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-58" size-w="1" size-h="3" x="2160" y="375" order="58">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-59" size-w="1" size-h="3" x="2430" y="0" order="59">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-60" size-w="1" size-h="3" x="2430" y="375" order="60">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
</div>';
            break;
        case 4:
            $html .= '<div class="templateParent" style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
    <div class="parent-1">
        <div class="m-1-3 order-61" size-w="1" size-h="3" x="0" y="0" order="61">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1 order-62" size-w="1" size-h="1" x="0" y="375" order="62">
            <img class="clickImg-1-1" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1 order-63" size-w="1" size-h="1" x="0" y="500" order="63">
            <img class="clickImg-1-1" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1 order-64" size-w="1" size-h="1" x="0" y="625" order="64">
            <img class="clickImg-1-1" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-3 order-65" size-w="2" size-h="3" x="270" y="0" order="65">
            <img class="clickImg-2-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-66" size-w="1" size-h="3" x="270" y="375" order="66">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-3"></span>
        <div class="m-1-3 order-67" size-w="1" size-h="3" x="540" y="375" order="67">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-6 order-68" size-w="2" size-h="6" x="810" y="0" order="68">
            <img class="clickImg-2-6" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3 order-69" size-w="1" size-h="3" x="1350" y="0" order="69">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-70" size-w="1" size-h="3" x="1350" y="375" order="70">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-71" size-w="1" size-h="3" x="1620" y="0" order="71">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-72" size-w="1" size-h="3" x="1620" y="375" order="72">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-73" size-w="1" size-h="3" x="1890" y="0" order="73">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-74" size-w="1" size-h="3" x="1890" y="375" order="74">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-75" size-w="1" size-h="3" x="2160" y="0" order="75">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-76" size-w="1" size-h="3" x="2160" y="375" order="76">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-77" size-w="1" size-h="3" x="2430" y="0" order="77">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-78" size-w="1" size-h="3" x="2430" y="375" order="78">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
</div>';
            break;
        case 5:
            $html .= '<div class="templateParent" style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">

    <div class="parent-1-2">
        <div class="m-2-6 order-79" size-w="2" size-h="6" x="0" y="0" order="79">
            <img class="clickImg-2-6" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-3 order-80" size-w="2" size-h="3" x="540" y="0" order="80">
            <img class="clickImg-2-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-81" size-w="1" size-h="3" x="540" y="375" order="81">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-3"></span>
        <div class="m-1-3 order-82" size-w="1" size-h="3" x="810" y="375" order="82">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3 order-83" size-w="1" size-h="3" x="1080" y="0" order="83">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-84" size-w="1" size-h="3" x="1080" y="375" order="84">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3 order-85" size-w="1" size-h="3" x="1350" y="0" order="85">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-86" size-w="1" size-h="3" x="1350" y="375" order="86">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
</div>';
            break;
        case 6:
            $html .= '<div class="templateParent" style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
    <div class="parent-1">
        <div class="m-1-2 order-87" size-w="1" size-h="2" x="0" y="0" order="87">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-2 order-88" size-w="1" size-h="2" x="0" y="250" order="88">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-2 order-89" size-w="1" size-h="2" x="0" y="500" order="89">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1-2" >
        <div class="m-2-4 order-90" size-w="2" size-h="4" x="270" y="0" order="90">
            <img class="clickImg-2-4" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-2-2 order-91" size-w="2" size-h="2" x="270" y="500" order="91">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-2 order-92" size-w="2" size-h="2" x="810" y="0" order="92">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2 order-93" size-w="2" size-h="2" x="810" y="250" order="93">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2 order-94" size-w="2" size-h="2" x="810" y="500" order="94">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-2 order-95" size-w="1" size-h="2" x="1350" y="0" order="95">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-2 order-96" size-w="1" size-h="2" x="1350" y="250" order="96">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-2 order-97" size-w="1" size-h="2" x="1350" y="500" order="97">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>
</div>';
            break;
        case 7:
            $html .= '<div class="templateParent" style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
    <div class="parent-1-2">
        <div class="m-2-4 order-98" size-w="2" size-h="4" x="0" y="0" order="98">
            <img class="clickImg-2-4" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-2-2 order-99" size-w="2" size-h="2" x="0" y="500" order="99">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-2 order-100" size-w="2" size-h="2" x="540" y="0" order="100">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2 order-101" size-w="2" size-h="2" x="540" y="250" order="101">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2 order-102" size-w="2" size-h="2" x="540" y="500" order="102">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-2 order-103" size-w="2" size-h="2" x="1080" y="0" order="103">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2 order-104" size-w="2" size-h="2" x="1080" y="250" order="104">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2 order-105" size-w="2" size-h="2" x="1080" y="500" order="105">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

</div>';
            break;
        case 8:
            $html .= '<div class="templateParent" style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">

    <div class="parent-1-2">
        <div class="m-2-4 order-106" size-w="2" size-h="4" x="0" y="0" order="106">
            <img class="clickImg-2-4" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-2-2 order-107" size-w="2" size-h="2" x="0" y="500" order="107">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
<!--	<div class="m-1-2" size-w="1" size-h="2" x="0" y="500" order="137">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="fill-1-2"></div>
        <div class="m-1-2" size-w="1" size-h="2" x="270" y="500" order="138">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>-->
    </div>

    <div class="parent-1-2">
        <div class="m-2-2 order-108" size-w="2" size-h="2" x="540" y="0" order="108">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2 order-109" size-w="2" size-h="2" x="540" y="250" order="109">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="fill-1-4"></div>
        <div class="m-2-2 order-110" size-w="2" size-h="2" x="540" y="500" order="110">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-2 order-111" size-w="1" size-h="2" x="1080" y="0" order="111">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-2 order-112" size-w="1" size-h="2" x="1080" y="250" order="112">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-2 order-113" size-w="1" size-h="2" x="1080" y="500" order="113">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-2 order-114" size-w="1" size-h="2" x="1350" y="0" order="114">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-2 order-115" size-w="1" size-h="2" x="1350" y="250" order="115">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-2 order-116" size-w="1" size-h="2" x="1350" y="500" order="116">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img  style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>


</div>';
            break;
        case 9:
            $html .= '<div class="templateParent" style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">

    <div class="parent-1-2">
        <div class="m-2-6 order-117" size-w="2" size-h="6" x="0" y="0" order="117">
            <img class="clickImg-2-6" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-6 order-118" size-w="2" size-h="6" x="540" y="0" order="118">
            <img class="clickImg-2-6" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3 order-119" size-w="1" size-h="3" x="1080" y="0" order="119">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-120" size-w="1" size-h="3" x="1080" y="375" order="120">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3 order-121" size-w="1" size-h="3" x="1350" y="0" order="121">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-3 order-122" size-w="1" size-h="3" x="1350" y="375" order="122">
            <img class="clickImg-1-3" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

</div>';
            break;
        case 10:
            $html .='<div class="templateParent" style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">

    <div class="parent-1-4">
        <div class="m-4-4 order-123" size-w="4" size-h="4" x="0" y="0" order="123">
            <img class="clickImg-4-4" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-5"></span>
        <div class="m-2-2 order-124" size-w="2" size-h="2" x="0" y="500" order="124">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-6"></span>
        <div class="m-2-2 order-125" size-w="2" size-h="2" x="540" y="500" order="125">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-4 order-126" size-w="2" size-h="4" x="1080" y="0" order="126">
            <img class="clickImg-2-4" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <div class="m-1-2 order-127" size-w="1" size-h="2" x="1080" y="500" order="127">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-2"></span>
        <div class="m-1-2 order-128" size-w="1" size-h="2" x="1350" y="500" order="128">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-2 order-129" size-w="2" size-h="2" x="1620" y="0" order="129">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2 order-130" size-w="2" size-h="2" x="1620" y="250" order="130">
            <img class="clickImg-2-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-4"></span>
        <div class="m-1-2 order-131" size-w="1" size-h="2" x="1620" y="500" order="131">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
        </div>
        <span class="fill-1-2"></span>
        <div class="m-1-2 order-132" size-w="1" size-h="2" x="1890" y="500" order="132">
            <img class="clickImg-1-2" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
            <!--<div class="half-1 order-133" size-w="0.5" size-h="1" order="133">
                <img src="/file/3.png" style="position:relative;z-index:9999" alt="" class="clickImg-half-1" onclick="add(this)">
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
            </div>
            
            <div class="half-1 order-134" size-w="0.5" size-h="1" order="134">
                <img src="/file/3.png" style="position:relative;z-index:9999" alt="" class="clickImg-half-1" onclick="add(this)">
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
            </div>
            
            <div class="half-1 order-135" size-w="0.5" size-h="1" order="135">
                <img src="/file/3.png" style="position:relative;z-index:9999" alt="" class="clickImg-half-1" onclick="add(this)">
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
            </div>
            
            <div class="half-1 order-136" size-w="0.5" size-h="1" order="136">
                <img src="/file/3.png" style="position:relative;z-index:9999" alt="" class="clickImg-half-1" onclick="add(this)">
            <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
            </div>-->
        </div>
    </div>

</div>';
            break;
          case 11 ://河南
            	$html.='<div class="templateParent" style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
           <div class="parent-1-2">
                <div class="m-2-4 order-133" size-w="405" size-h="420" x="129" y="0" order="133">
                    <img class="clickImg-2-4 clickImg-405-420" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
                <div class="m-2-2 order-134" size-w="405" size-h="285" x="129" y="435" order="134">
                    <img class="clickImg-2-2 clickImg-405-285" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
                <div class="m-1-1 order-135" style="margin-right:20px;border-radius:8px;margin-top:20px" size-w="195" size-h="135" x="129" y="735" order="135">
                    <img class="clickImg-1-1 clickImg-195-135" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
                <div class="m-1-1 order-136" style="margin-top:20px" size-w="195" size-h="135" x="339" y="735" order="136">
                    <img class="clickImg-1-1 clickImg-195-135" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
           </div>
      
	   <div class="parent-1-4">
                <div class="m-4-4 order-137" style="background:#666666;margin-bottom:20px" size-w="825" size-h="420" x="549" y="0" order="137">
                    <img class="clickImg-4-4 clickImg-825-420" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
                <div class="m-2-2 order-138" size-w="405" size-h="285" x="549" y="435" order="138">
                    <img class="clickImg-2-2 clickImg-405-285" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
                <div class="m-2-2 order-139" size-w="405" size-h="285" x="969" y="435" order="139">
                    <img class="clickImg-2-2 clickImg-405-285" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
                <div class="m-1-1 order-140" style="margin-right:20px;border-radius:8px;margin-top:20px"  size-w="195" size-h="135" x="549" y="735" order="140">
                    <img class="clickImg-1-1 clickImg-195-135" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
                <div class="m-1-1 order-141" style="margin-right:20px;border-radius:8px;margin-top:20px" style="margin-right:20px;border-radius:8px" size-w="195" size-h="135" x="759" y="735" order="141">
                    <img class="clickImg-1-1 clickImg-195-135" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
                <div class="m-1-1 order-142" style="margin-right:20px;border-radius:8px;margin-top:20px" size-w="195" size-h="135" x="969" y="735" order="142">
                    <img class="clickImg-1-1 clickImg-195-135" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
                <div class="m-1-1 order-143" size-w="195" size-h="135" x="1179" y="735" order="143" style="margin-top:20px">
                    <img class="clickImg-1-1 clickImg-195-135" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
           </div>

	   <div class="parent-1-2">
                <div class="m-2-4 order-144" size-w="405" size-h="420" x="1389" y="0" order="144">
                    <img class="clickImg-2-4 clickImg-405-420" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
                <div class="m-2-2 order-145" size-w="405" size-h="285" x="1389" y="435" order="145">
                    <img class="clickImg-2-2 clickImg-405-285" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
                <div class="m-1-1 order-146" style="margin-right:20px;border-radius:8px;margin-top:20px" size-w="195" size-h="135" x="1389" y="735" order="146">
                    <img class="clickImg-1-1 clickImg-195-135" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
                <div class="m-1-1 order-147" style="margin-top:20px" size-w="195" size-h="135" x="1599" y="735" order="147">
                    <img class="clickImg-1-1 clickImg-195-135" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
           </div></div>
            ';
            break;
    }
        }else{
            $html = "";
            $id = $templateId - 11;
            $sql = "select t1.colw,t1.roww,t1.cellspacing,t1.cols as allw,t1.rows as allh,t2.*  from yd_ver_template t1 left join yd_ver_template_detail t2 on t1.id = t2.tem_id where t1.id = $id";
            $res = SQLManager::queryAll($sql);

            $width = ($res[0]['allw']*$res[0]['colw'] + ($res[0]['allw']-1)*$res[0]['cellspacing'])/2 + 50;
            $height = ($res[0]['allh']*$res[0]['roww'] + ($res[0]['allh']-1)*$res[0]['cellspacing'])/2 + 50;

            $html = '<div class="templateParent" style="position:relative;height: '.$height.'px;width:'.$width.'px;overflow-y: scroll;overflow-x: scroll;float: left;"><div>';
            if(!empty($res)){
                foreach ($res as $key => $value) {
                    $order = $value['id'] + 147;
                    $width1 = $value['width']/2;
                    $height1 = $value['height']/2;
                    //$position_x=preg_match("/\d+/",$value['x'],$match);
                    //var_dump($match);die;
                    $x = intval($value['x'])/2;
                    $y = intval($value['y'])/2;
                    /*$html .= '<div class="order-'.$order.'" style="border:1px solid #ccc;  border-radius: 8px;position:absolute;top:'.$y.'px;left:'.$x.'px;margin-left:5px;margin-top:5px;background:#ccc;width:'.$width1.'px;height:'.$height1.'px;" size-w="'.$value['colw'].'" size-h="'.$value['roww'].'" x="'.$value['x'].'" y="'.$value['y'].'" order="'.$order.'">
                                <img class="clickImg-'.$value['colw'].'-'.$value['roww'].'" style="width:'.$width1.'px;height:'.$height1.'px;" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                                <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                            </div>';*/
                     $html .= '<div class="order-'.$order.'" style="border:1px solid #ccc;  border-radius: 8px;position:absolute;top:'.$y.'px;left:'.$x.'px;margin-left:5px;margin-top:5px;background:#ccc;width:'.$width1.'px;height:'.$height1.'px;" size-w="'.$value['width'].'" size-h="'.$value['height'].'" x="'.$value['x'].'" y="'.$value['y'].'" order="'.$order.'">
                                <img class="clickImg-'.$value['width'].'-'.$value['height'].'" style="width:'.$width1.'px;height:'.$height1.'px;" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)"/>
                                <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" 
            src="/file/u1892.png">
                            </div>';
                }
                $html .= "</div></div>";
	        }
        }
        return $html;
    }

//河南
public static function henan(){
        $html='<style></style>';
        $html.='<div class="templateParent" style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
           <div class="parent-1-2">
                <div class="m-2-4 order-1" size-w="825" size-h="429" x="129" y="171" order="1">
                    <img class="clickImg-2-4 clickImg-825-429" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>

                <div class="m-1-2 order-2" size-w="405" size-h="285" x="129" y="615" order="2" style="margin-right:6px">
                    <img class="clickImg-1-2 clickImg-405-285" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>

                <div class="m-1-2 order-3" size-w="405" size-h="285" x="549" y="615" order="3">
                    <img class="clickImg-1-2 clickImg-405-285" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
           </div>

          <div class="parent-1-2" style="width:282px">
                <div class="m-2-3 order-4" size-w="492" size-h="357" x="969" y="171" order="4">
                    <img class="clickImg-2-3 clickImg-492-357" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>

                <div class="m-2-3 order-5" size-w="492" size-h="357" x="969" y="543" order="5">
                    <img class="clickImg-2-3 clickImg-492-357" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
           </div>

           <div class="parent-1-1">
                <div class="m-1-1 order-6" size-w="318" size-h="171" x="1476" y="171" order="6">
                    <img class="clickImg-1-1 clickImg-318-171" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>

                <div class="m-1-1 order-7" size-w="318" size-h="171" x="1476" y="357" order="7">
                    <img class="clickImg-1-1 clickImg-318-171" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>

              <div class="m-1-1 order-8" size-w="318" size-h="171" x="1476" y="543" order="8">
                    <img class="clickImg-1-1 clickImg-318-171" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>

               <div class="m-1-1 order-9" size-w="318" size-h="171" x="1476" y="729" order="9">
                    <img class="clickImg-1-1 clickImg-318-171" src="/file/3.png" style="position:relative;z-index:9999" alt="" onclick="add(this)" />
                    <img style="position:absolute;top:50%;left:50%;margin-left:-15px;margin-top:-15px;width:30px;height:30px;border-radius:10px;" class="plus_button" src="/file/u1892.png">
                </div>
           </div>

       </div>
        ';
        return $html;
    }


    public static function choseTemplate()
    {
        $html = '<style>
    .topDiv{width:1080px;height:80px;}
    .template{width:201px;height:40px;margin-bottom:10px;border: 1px solid #000000;display: block;float: left;text-align: center;}
    .template:hover{background: #ff2222;}
    .hidden{display:none;}
        </style>'
        ;

        $html .= '<div class="topDiv">
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板一
        <span class="hidden">1</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板二
        <span class="hidden">2</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板三
        <span class="hidden">3</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板四
        <span class="hidden">4</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板五
        <span class="hidden">5</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板六
        <span class="hidden">6</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板七
        <span class="hidden">7</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板八
        <span class="hidden">8</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板九
        <span class="hidden">9</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板十
        <span class="hidden">10</span>
    </span>
</div>';
        return $html;
    }

}

