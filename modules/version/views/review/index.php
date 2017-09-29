<?php
$admin = $this->getMvAdmin();
?>
<?php
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>

<style>
 .page{
		height:20px;

		line-height: 20px;
	}
	.page ul li {
		line-height: 20px;
		height:20px;
	}
    .inputDiv{
          width:100%;
        float:left;
  		
        background: #A3BAD5;
    	padding: 5px 0px 5px 4px;
    }
    .inputDiv input{
        float: left;
        height:18px;
        width:120px;
    }
    .inputDiv span{
        float: left;
    }
    .inputDiv select{
        float: left;
        margin-left:5px;
        height:20px;
    }
    .inputDivTwo{
        width:100%;
        float:left;
        height:30px;
        background: #f0fdff;
        padding: 5px 0px 5px 12px;
    }
</style>
<script charset="utf-8" type="text/javascript" src="/js/jdate/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/js/jdate/jquery.datetimepicker.css" />
<div style='padding: 5px 0px 5px 12px;'>
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;?></span>
</div>
<div >
    <div class="inputDiv">

        <input type="text" name="title"  class="form-input w100" value="<?php echo !empty($_GET['title'])?$_GET['title']:''?>" placeholder="请输入标题">
<span style="font-size:14px;">&nbsp;&nbsp;&nbsp;CP</span>
        <select name="cp" class="form-input w100" id="cp">
            <option value="0">请选择</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='642001'){echo "selected=selected"; } ?> value="642001" >华数</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='BESTVOTT'){echo "selected=selected"; } ?> value="BESTVOTT">百视通</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='ICNTV'){echo "selected=selected"; } ?> value="ICNTV">未来电视</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='youpeng'){echo "selected=selected"; } ?> value="youpeng">南传</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='HNBB'){echo "selected=selected"; } ?> value="HNBB">芒果</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='CIBN'){echo "selected=selected"; } ?> value="CIBN">国广</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='YGYH'){echo "selected=selected"; } ?> value="YGYH">银河</option>
        </select>
	<span style="float:left;font-size:14px;">&nbsp;&nbsp;&nbsp;类型</span>
     
        <select name="type" id="type" class="form-input w100">
            <option value="0">请选择</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='电影'){echo "selected=selected"; }  ?> value="电影" >电影</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='综艺'){echo "selected=selected"; }  ?> value="综艺">综艺</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='新闻'){echo "selected=selected"; }  ?>value="新闻">新闻</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='电视剧'){echo "selected=selected"; }  ?>value="电视剧">电视剧</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='动漫'){echo "selected=selected"; }  ?>value="动漫">动漫</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='教育'){echo "selected=selected"; }  ?>value="教育">教育</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='体育'){echo "selected=selected"; }  ?>value="体育">体育</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='音乐'){echo "selected=selected"; }  ?>value="音乐">音乐</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='娱乐'){echo "selected=selected"; }  ?>value="娱乐">娱乐</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='健康'){echo "selected=selected"; }  ?>value="健康">健康</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='纪实'){echo "selected=selected"; }  ?>value="纪实">纪实</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='旅游'){echo "selected=selected"; }  ?>value="旅游">旅游</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='法制'){echo "selected=selected"; }  ?>value="法制">法制</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='搞笑'){echo "selected=selected"; }  ?>value="搞笑">搞笑</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='时尚'){echo "selected=selected"; }  ?>value="时尚">时尚</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='军事'){echo "selected=selected"; }  ?>value="军事">军事</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='财经'){echo "selected=selected"; }  ?>value="财经">财经</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='曲艺'){echo "selected=selected"; }  ?>value="曲艺">曲艺</option>
            <option <?php $test=!empty($_REQUEST['type'])?$_REQUEST['type']:'';if($test=='奥运'){echo "selected=selected"; }  ?>value="奥运">奥运</option>
        </select>
	<span style="float:left;font-size:14px;">&nbsp;&nbsp;&nbsp;状态</span>
     
        <?php
        if(in_array('1',$res['status']) || $admin['nickname']=='管理员01'){
           $allbtn=!empty($_REQUEST['allbtn'])?$_REQUEST['allbtn']:'';
          ?>
                <select name="allbtn" id="allbtn" class="form-input w100">
                <option value="0">请选择</option>
                <option class="btn allbtn chose" type="button" <?php if($allbtn=='未审核'){ echo 'selected=selected';} ?> value="未审核">未审核</option>
                <option class="btn access_btn btn_acc gray" type="button" <?php if($allbtn=='已通过'){ echo 'selected=selected';} ?> value="已通过">已通过</option>
                <option class="btn access_btn no_acc gray" type="button" <?php if($allbtn=='驳回'){ echo 'selected=selected';} ?> value="驳回">驳回</option>
</select>
        <?php
        }else if(in_array('3',$res['status'])){
            $allbtn=!empty($_REQUEST['allbtn'])?$_REQUEST['allbtn']:'';
          ?>
                <select name="allbtn" id="allbtn" class="form-input w100">
                <option value="0">请选择</option>
                <option class="btn allbtn chose" type="button" <?php if($allbtn=='未审核'){ echo 'selected=selected';} ?> value="未审核">未审核</option>
                <option class="btn access_btn btn_acc gray" type="button" <?php if($allbtn=='已通过'){ echo 'selected=selected';} ?> value="已通过">已通过</option>
                <option class="btn access_btn no_acc gray" type="button" <?php if($allbtn=='驳回'){ echo 'selected=selected';} ?> value="驳回">驳回</option>
</select>
        <?php


        }else{
            $allbtn=!empty($_REQUEST['allbtn'])?$_REQUEST['allbtn']:'';
          ?>
                <select name="allbtn" id="allbtn" class="form-input w100">
                <option value="0">请选择</option>
                <option class="btn allbtn chose" type="button" <?php if($allbtn=='未审核'){ echo 'selected=selected';} ?> value="未审核">未审核</option>
                <option class="btn access_btn btn_acc gray" type="button" <?php if($allbtn=='已通过'){ echo 'selected=selected';} ?> value="已通过">已通过</option>
                <option class="btn access_btn no_acc gray" type="button" <?php if($allbtn=='驳回'){ echo 'selected=selected';} ?> value="驳回">驳回</option>
</select>
        <?php

        }
        ?>

       <span  style="font-size:14px;">&nbsp;&nbsp;&nbsp;时间范围&nbsp;&nbsp;</span>
          
        <input placeholder="开始时间" style="width:70px;height:18px;"  type="text" name="first" id="first" class="form-input w100" value="<?php echo !empty($_GET['first'])?$_GET['first']:''?>">
<span  style="font-size:14px;">&nbsp;&nbsp;</span>
        <input placeholder="结束时间" style="width:70px;height:18px;" type="text" name="timeend" id="timeend" class="form-input w100" value="<?php echo !empty($_GET['timeend'])?$_GET['timeend']:''?>">
<input style="width:50px;height:20px;margin-left: 5px;" class="btn btn1 btn-gray audit_search search " type="submit" value="查询" name="" style="font-size: 14px;/*margin-right:550px;*/">
	    <!--<input type="button" style='width:30px;height:20px;float:right;margin-right: 10px;' class="btn page_btn" value="go">
	    <span style="float:right;font-size:14px">&nbsp;页</span>
	    <input type="text" style='width:30px;height:18px;float:right' class="form-input " value="" name="page"  >
	     <span style="float:right;font-size:14px">到第&nbsp;</span>-->
            <?php echo $page;?>

    </div>



    <div class="inputDivTwo">
        <input class="btnall btn" type="button" value="全选">
        <input class="btnno btn" type="button" value="全不选">
        <input class="btn sub_btn" type="button" value="批量通过">
        <input class="btn allreject" type="button" value="批量驳回">
    </div>

    <form action="">
        <div class="fenlei">
            <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
                <tr>
                    <th>编号</th>
                    <th>牌照方</th>
                    <th>标题</th>
                    <th>语言</th>
                    <th>类型</th>
                    <th>审核</th>
                    <th>提交审核时间时间</th>
                    <th>操作</th>
                </tr>
                <?php
                if(!empty($list)){
                    foreach($list as $l){?>
                        <tr>
                            <input type="hidden" name='vid' value="<?php echo $l['vid']?>">
                            <td><input type="checkbox" class="checkbox" name="id" value="<?php echo $l['id']."_".$l['vid']?>"></td>
                            <td><?php
                                switch($l['cp']){
                                    case '642001':echo '华数';break;
                                    case 'BESTVOTT':echo '百视通';break;
                                    case 'ICNTV':echo '未来电视';break;
                                    case 'youpeng':echo '南传';break;
                                    case 'HNBB':echo '芒果';break;
                                    case 'CIBN':echo '国广';break;
                                    case 'YGYH':echo '银河';break;
                                }
                                ?></td>
                            <td><?php echo $l['title']?></td>
                            <td><?php echo $l['type']?></td>
                            <td><?php echo $l['language']?></td>
                            <td><?php echo $l['flag']?></td>
                            <td><?php echo date('Y-m-d H:i',$l['upTime'])?></td>
                            <td><a href="<?php echo Yii::app()->createUrl("/version/content/mvadd",array('mid'=>$_GET['mid'],'vid'=>$l['vid'],'id'=>$l['id']))?>">查看</a>
                                <?php
                                echo "<a href='javascript:void(0)' gid='{$l['id']}' class='review'>通过</a>&nbsp;";
                                echo "<a href='javascript:void(0)' gid='{$l['id']}' class='reject'>驳回</a>";
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }else{?>
                    <tr>
                        <td colspan="8" align="center">暂无数据</td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </form>
</div>
<div></div>
<script>
    $('#first,#timeend').datetimepicker({
        lang:'ch',
        validateOnBlur:false,
        timepicker:false,
        format:'Y-m-d',
        formatDate: 'Y-m-d',
        maxDate:'<?php echo date('Y-m-d',strtotime('1 day'))?>'
    });

    $('.chose').click(function(){
        $('.allbtn').removeClass('gray').addClass('chose');
        $('.btn_acc').removeClass('chose').addClass('gray');
        $('.no_acc').removeClass('chose').addClass('gray');
    })

    $('.btn_acc').click(function(){
        $('.allbtn').removeClass('chose').addClass('gray');
        $('.btn_acc').removeClass('gray').addClass('chose');
        $('.no_acc').removeClass('chose').addClass('gray');
    })

    $('.no_acc').click(function(){
        $('.allbtn').removeClass('chose').addClass('gray');
        $('.btn_acc').removeClass('chose').addClass('gray');
        $('.no_acc').removeClass('gray').addClass('chose');
    })
    $('.review').click(function(){
        var flag = "<?php if(in_array('3',$res['status'])){echo 1;}?>";
        var username="<?php echo $admin['nickname']?>";
        if(username!='管理员01'){
            if(flag==1){
                return false;
            }
        }
        var gid = $(this).attr('gid');
        var vid = $(this).parent().parent().children('input').val();
        $.post("<?php echo $this->get_url('review','access')?>",{gid:gid,vid:vid,nickname:username},function(d){
            location.reload();
        })
    })

    $('.reject').click(function(){
        var type = "<?php if(in_array('3',$res['status'])){echo 1;}?>";
        var username="<?php echo $admin['nickname']?>";
        if(username!='管理员01'){
            if(type==1){
                return false;
            }
        }
        var gid = $(this).attr('gid');
        var flag=1;
        $.getJSON('<?php echo $this->get_url('review','rejectview')?>',{gid:gid,flag:flag},function(d){
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

    $('.allreject').click(function(){
        var flag = "<?php if(in_array('3',$res['status'])){echo 1;}?>";
        var username="<?php echo $admin['nickname']?>";
        if(username!='管理员01'){
            if(flag==1){
                return false;
            }
        }
        var ids="";
        $("input[name='id']:checked").each(function() {

            ids += $(this).val()+' ';

        });
        var flag=2;
        $.getJSON('<?php echo $this->get_url('review','rejectview')?>',{gid:ids,flag:flag},function(d){
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

    $('.btnall').click(function(){
        $(".center :checkbox").prop("checked", true);
    })
    $('.btnno').click(function(){
        $(".center :checkbox").prop("checked", false);
    })

    $('.sub_btn').click(function(){
        var flag = "<?php if(in_array('3',$res['status'])){echo 1;}?>";
        var username="<?php echo $admin['nickname']?>";
        console.log(username)
        if(username!='管理员01'){
            if(flag==1){
                return false;
            }
        }
        var ids="";
        $("input[name='id']:checked").each(function() {

            ids += $(this).val()+' ';

        });
        var username = "<?php echo $admin['nickname']?>";
        $.post("<?php echo $this->get_url('review','allsub')?>",{ids:ids,username:username},function(d){
            setTimeout(location.reload(),2000);
        })
    })
    $(document).on('click','.see',function(){
        var vid = $(this).parent().parent().children('input').val();
        $.getJSON('<?php echo $this->get_url('review','see')?>',{vid:vid},function(d){
            if(d.code == 200){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['530px', '306px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })
    $('.access_btn').click(function(){

        var text = $(this).val();
        if(text=='已通过'){
            var flag=1;
        }else{
            var flag=2;
        }
        var url = '/version/review/accesslog?mid='+"<?php echo $_GET['mid']?>"+"&flag="+flag;
        ajax(url,type=1);
    })

    function access_btnChange()
    {
        var text = $('#allbtn').val();
//        alert(text);return false;
        if(text=='已通过'){
            var flag=1;
        }else if(text=='未审核'){
	    window.location.reload();return false;	
	}else{
            var flag=2;
        }
	//alert(flag);return false;
        var url = '/version/review/accesslog?mid='+"<?php echo $_GET['mid']?>"+"&flag="+flag;
        ajax(url,type=1);
    }

    $('.allbtn').click(function(){
        var username = "<?php echo $admin['nickname']?>";
        var url = '/version/review/Accesslog?mid='+"<?php echo $_GET['mid']?>"+"&username="+username;
        ajax(url,type=2);
    })

    function ajax(url,type){
        $.ajax({
            type: 'GET',
            url: url,
            /*data: {'page': 1 },*/
            dataType: 'json',
            success: function(json) {
                //console.log(json);
                $('.fenlei').empty();
                var li = '';
                //var btn = $('.chose').val();
		var btn = $('#allbtn').val();
                if(btn=='驳回'){
                    flag='1';
                }else{
                    flag='2';
                }
                li += '<table width="100%" cellspacing="0" cellpadding="10" class="mtable center"><tr><th>编号</th><th>牌照方</th><th>标题</th><th>语言</th><th>类型</th><th>状态</th><th>添加时间</th><th>操作</th></tr>';
                if(type==1){
                    $.each(json, function(index, array) {
                        switch(array['cp']){
                            case '642001':array['cp']='华数';break;
                            case 'BESTVOTT':array['cp']='百视通';break;
                            case 'ICNTV':array['cp']='未来电视';break;
                            case 'youpeng':array['cp']='南传';break;
                            case 'HNBB':array['cp']='芒果';break;
                            case 'CIBN':array['cp']='国广';break;
                            case 'YGYH':array['cp']='银河';break;
                        }
                        if(flag=='1'){
                            li += "<tr><input type='hidden' name='vid' value='"+array['vid']+"'><td><input type='checkbox' class='checkbox' name='id' value='"+array['vid']+"'></td><td>"+array['cp']+"</td><td>"+array['title']+"</td><td>"+array['language']+"</td><td>"+array['type']+"</td><td>不通过</td><td>"+getLocalTime(array['cTime'])+"</td><td><a class='see'>查看</a></td></tr>";

                        }else{
                            li += "<tr><input type='hidden' name='vid' value='"+array['vid']+"'><td><input type='checkbox' class='checkbox' name='id' value='"+array['vid']+"'></td><td>"+array['cp']+"</td><td>"+array['title']+"</td><td>"+array['language']+"</td><td>"+array['type']+"</td><td>通过</td><td>"+getLocalTime(array['cTime'])+"</td><td><a class='see'>查看</a></td></tr>";

                        }
                    })
                }else{
                    $.each(json, function(index, array) {
                        switch(array['cp']){
                            case '642001':array['cp']='华数';break;
                            case 'BESTVOTT':array['cp']='百视通';break;
                            case 'ICNTV':array['cp']='未来电视';break;
                            case 'youpeng':array['cp']='南传';break;
                            case 'HNBB':array['cp']='芒果';break;
                            case 'CIBN':array['cp']='国广';break;
                            case 'YGYH':array['cp']='银河';break;
                        }
                        li += "<tr><input type='hidden' name='vid' value='"+array['vid']+"'><td><input type='checkbox' class='checkbox' name='id' value='"+array['vid']+"'></td><td>"+array['cp']+"</td><td>"+array['title']+"</td><td>"+array['language']+"</td><td>"+array['type']+"</td><td>通过</td><td>"+getLocalTime(array['cTime'])+"</td><td><a class='see'>查看</a><a gid='"+array['id']+"' class='review'>通过</a><a gid='"+array['id']+"' class='reject'>驳回</a></td></tr>";
                    })
                }

                li +='</table>';
                $('.fenlei').append(li);
            },
            complete: function() {
                //getPageBar();//js生成分页，可用程序代替
            },
            error: function() {
                alert("数据异常,请检查是否json格式");
            }
        });
    }

    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
    }
    $('.search').click(function(){
        var title = $('input[name=title]').val();
        var cp = $('#cp').val();
        var type = $('#type').val();
        var allbtn = $('#allbtn').val();
        var first = $('input[name=first]').val();
        var end = $('input[name=timeend]').val();
        var url = window.location.href;
        window.location.href=url+"&first="+first+"&timeend="+end+"&title="+title+"&cp="+cp+"&type="+type+"&allbtn="+allbtn;
    })
    $('.page_btn').click(function(){
        var num = $('input[name=pagenum]').val();
        var test = window.location.href;
        window.location.href=test+"&page="+num;
    });
</script>


