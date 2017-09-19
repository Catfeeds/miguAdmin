<script charset="utf-8" type="text/javascript" src="/js/jdate/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/js/jdate/jquery.datetimepicker.css" />
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
    }
    .inputDiv span{
        float: left;
    }
    .inputDiv select{
        float: left;
        margin-left:5px;
    }
    .inputDivTwo{
        width:100%;
        float:left;
        height:30px;
        background: #f0fdff;
        padding: 5px 0px 7px 12px;
    }
    .dataInfo{float:right;}	
</style>
<div >
    <form action="">
        <?php
        $adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
        $adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
        $adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
        $adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
        ?>
        <div style='padding: 5px 0px 5px 12px;'>
            <span><?php echo $adminLeftOneName;echo '>';?></span>
            <span><?php echo $adminLeftTwoName;?></span>
        </div>
        <div class="inputDiv">

        <input style="width:70px;height:15px;" type="text" name="title"  class="form-input" value="<?php echo !empty($_GET['title'])?$_GET['title']:''?>" placeholder="请输入标题">
        	<span style="float:left;font-size:14px;">&nbsp;&nbsp;&nbsp;CP</span>
        <select name="cp"  style="width:60px;height:20px;"  class="form-input w100" id="cp">
            <option value="0">请选择</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='642001'){echo "selected=selected"; } ?> value="642001" >华数</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='BESTVOTT'){echo "selected=selected"; } ?> value="BESTVOTT">百视通</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='ICNTV'){echo "selected=selected"; } ?> value="ICNTV">未来电视</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='youpeng'){echo "selected=selected"; } ?> value="youpeng">南传</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='HNBB'){echo "selected=selected"; } ?> value="HNBB">芒果</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='CIBN'){echo "selected=selected"; } ?> value="CIBN">国广</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='YGYH'){echo "selected=selected"; } ?> value="YGYH">银河</option>
            <option <?php $cp=!empty($_GET['cp'])?$_GET['cp']:'';if($cp=='poms'){echo "selected=selected"; } ?> value="poms">咪咕</option>
        </select>
        <span style="float:left;font-size:14px;">&nbsp;&nbsp;&nbsp;类型</span>
     
        <select  style="width:60px;height:20px;"  class="form-input w100" id="type"><option value="0">请选择</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='电影'){echo "selected=selected"; } ?> value="电影" >电影</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='综艺'){echo "selected=selected"; } ?> value="综艺">综艺</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='新闻'){echo "selected=selected"; } ?> value="新闻">新闻</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='电视剧'){echo "selected=selected"; } ?> value="电视剧">电视剧</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='动漫'){echo "selected=selected"; } ?> value="动漫">动漫</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='教育'){echo "selected=selected"; } ?> value="教育">教育</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='体育'){echo "selected=selected"; } ?> value="体育">体育</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='音乐'){echo "selected=selected"; } ?> value="音乐">音乐</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='娱乐'){echo "selected=selected"; } ?> value="娱乐">娱乐</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='健康'){echo "selected=selected"; } ?> value="健康">健康</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='纪实'){echo "selected=selected"; } ?> value="纪实">纪实</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='旅游'){echo "selected=selected"; } ?> value="旅游">旅游</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='法制'){echo "selected=selected"; } ?> value="法制">法制</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='搞笑'){echo "selected=selected"; } ?> value="搞笑">搞笑</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='时尚'){echo "selected=selected"; } ?> value="时尚">时尚</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='军事'){echo "selected=selected"; } ?> value="军事">军事</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='财经'){echo "selected=selected"; } ?> value="财经">财经</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='曲艺'){echo "selected=selected"; } ?> value="曲艺">曲艺</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='奥运'){echo "selected=selected"; } ?> value="奥运">奥运</option>
        </select>
        <span style="float:left;font-size:14px;">状态</span>
            
        <select style="width:60px;height:20px;"  name="flag" class="form-input w100" id="flag">
	    <option value='-1'>请选择</option>	
            <option <?php $flag=isset($_GET['flag'])?$_GET['flag']:'';if($flag=='0'){echo "selected=selected"; } ?> value="0">上线</option>
            <option <?php $flag=isset($_GET['flag'])?$_GET['flag']:'';if($flag=='1'){echo "selected=selected"; } ?> value="1" >下线</option>
        </select>
	<span style="float:left;font-size:14px;">资费</span>
	<select style="width:60px;height:20px;"  name="isfree" class="form-input w100" id="free">
		<option value="0">请选择</option>
	 	<option value="nfree">收费</option>
		<option value="free">免费</option>
	<select>
               <span  style="font-size:14px;">&nbsp;时间范围&nbsp;&nbsp;</span>
        <input placeholder="开始时间" style="width:60px;height:18px;" type="text" name="first" id="first" class="form-input w100" value="<?php echo !empty($_GET['first'])?$_GET['first']:''?>">
       	<span  style="font-size:14px;">&nbsp;&nbsp;</span>
        <input placeholder="结束时间" style="width:60px;height:18px;" type="text" name="end" id="end" class="form-input w100" value="<?php echo !empty($_GET['end'])?$_GET['end']:''?>">
<input class="btn btn1 btn-gray audit_search search " type="button" value="查找" name=""  style="width:50px;height:20px;margin-left: 5px;">
            <?php echo $page;?>

        </div>
<!--        <br>-->
        <div class="inputDivTwo">
        <?php
           if(in_array('1',$res['status']) || $_SESSION['auth']=='1'){
              ?>
        	<input class="btnall btn" type="button" value="全选">
        	<input class="btnno btn" type="button" value="全不选">
        	<input class="btn btn_sub" type="button" value="批量上线">
        	<input class="btn btn_sub" type="button" value="批量下线">
           <?php
           }else if(in_array('3',$res['status'])){
           ?>
        	<input class="btn" type="button" value="全选">
     		<input class="btn" type="button" value="全不选">
        	<input class="btn" type="button" value="批量上线">
        	<input class="btn" type="button" value="批量下线">
           <?php
           }
        ?>
        </div>
        <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
            <tr>
                <th>编号</th>
                <th>牌照方</th>
                <th>资产ID</th>
                <th>标题</th>
		<th>资费类型</th>
                <th>类型</th>
                <th>语言</th>
                <th>状态</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            <?php
		//var_dump($list);
                if(!empty($list)){
                    foreach($list as $k=>$v){
                        ?>
                        <tr>
                            <td><input type="checkbox" name="vid" value="<?php echo $v['vid']?>"></td>
                            <td><?php
                                switch($v['cp']){
                                    case '642001':echo '华数';break;
                                    case 'BESTVOTT':echo '百视通';break;
                                    case 'ICNTV':echo '未来电视';break;
                                    case 'youpeng':echo '南传';break;
                                    case 'HNBB':echo '芒果';break;
                                    case 'CIBN':echo '国广';break;
                                    case 'YGYH':echo '银河';break;
				    case "poms":echo "咪咕";break;
                                }
                                ?></td>
                            <td class="dataid"><?php echo $v['vid']?></td>
                            <td><?php echo $v['title']?></td>
			    <td><?php  if($v['prdpack_id']=="1002381"){echo "收费";}elseif($v['prdpack_id']=="1002261"){echo "免费";}?></td>
                            <td><?php echo $v['type']?></td>
                            <td><?php echo $v['language']?></td>
                            <td><?php switch($v['flag']){
                                    case '0':echo '上线';break;
                                    case '1':echo '下线';break;
                                }?></td>
                            <td><?php echo date('Y-m-d H:i:s',$v['cTime']);?></td>
                            <td>
                                <?php
				    if(in_array('1',$res['status']) || $_SESSION['auth']=='1'){
					?>
                                         <a href="<?php echo Yii::app()->createUrl("/version/review/mvadd",array('mid'=>$_GET['mid'],'vid'=>$v['vid'],'id'=>$v['id']))?>">查看</a>&nbsp;&nbsp;<a class="submit">上线</a>&nbsp;&nbsp;<a class="submit">下线</a>&nbsp;&nbsp;<a class="recall">撤回</a>
                                    <?php
 					}else if(in_array('3',$res['status'])){
					?>
                                          <a href="<?php echo Yii::app()->createUrl("/version/review/mvadd",array('mid'=>$_GET['mid'],'vid'=>$v['vid'],'id'=>$v['id']))?>">查看</a>&nbsp;&nbsp;<a>上线</a>&nbsp;&nbsp;<a>下线</a>&nbsp;&nbsp;<a>撤回</a>
                                     <?php
                                        }
 				?>
                            </td>
                        </tr>
                <?php
                    }
                }
            ?>
        </table>
    </form>
</div>
<div>
<script>
    var adminLeftOne = "<?php echo $adminLeftOne;?>";
    var adminLeftTwo = "<?php echo $adminLeftTwo;?>";
    var adminLeftOneName = "<?php echo $adminLeftOneName;?>";
    var adminLeftTwoName = "<?php echo $adminLeftTwoName;?>";
    
    $('.page_btn').click(function(){
        var num = $('input[name=pagenum]').val();
        var test = window.location.href;
        window.location.href=test+"&page="+num;
    });
		
    $('#first,#end').datetimepicker({
        lang:'ch',
        validateOnBlur:false,
        timepicker:false,
        format:'Y-m-d',
        formatDate: 'Y-m-d',
        maxDate:'<?php echo date('Y-m-d',strtotime('1 day'))?>'
    });
    $('.search').click(function(){
        //alert(1)
        var title = $('input[name=title]').val();
        var cp = $('#cp').val();
        var type = $('#type').val();
        var mid = "<?php echo $this->mid?>";
        var first = $('input[name=first]').val();
        var end = $('input[name=end]').val();
        var flag = $('#flag').val();
        var isfree = $("#free option:selected").val();
	if(flag < 0){
	   window.location.href="/version/content/contentindex?mid="+mid+"&isfree="+isfree+"&type="+type+"&cp="+cp+"&title="+title+"&first="+first+"&end="+end+"&pro="+pro+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;	
	}else{
	   window.location.href="/version/content/contentindex?mid="+mid+"&type="+type+"&cp="+cp+"&title="+title+"&first="+first+"&end="+end+"&flag="+flag+"&pro="+pro+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;	
	}
        var pro = "<?php echo $_REQUEST['pro']?>";
        //var nid = "<?php echo !empty($_REQUEST['nid'])?$_REQUEST['nid']:''?>";
        //window.location.href="/version/content/contentindex?mid="+mid+"&type="+type+"&cp="+cp+"&title="+title+"&first="+first+"&end="+end+"&flag="+flag+"&pro="+pro+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
    })
     $('.submit').click(function(){
        var dataid = $(this).parent().parent().children('.dataid').html();
        var text = $(this).html();
        if(text=='上线'){
            var flag=0;
        }else{
            var flag=1;
        }
        $.post("<?php echo $this->get_url('content','datasub')?>",{vid:dataid,flag:flag},function(d){
            if(d.code==200){
                location.reload();
            }
        },'json')
    })

    $('.btn_sub').click(function(){
        var text = $(this).val();
        if(text=='批量上线'){
            var flag = 0;
        }else{
            var flag = 1;
        }
        var ids="";
        $("input[name='vid']:checked").each(function() {

            ids += $(this).val()+' ';

        });
        $.post("<?php echo $this->get_url('content','allsub')?>",{ids:ids,flag:flag},function(d){
            setTimeout(location.reload(),2000);
        })
    })

    $('.recall').click(function(){
        var dataid = $(this).parent().parent().children('.dataid').html();
	if(confirm('你确定撤回此条数据吗？')){
            $.post("<?php echo $this->get_url('content','recall')?>",{vid:dataid},function(d){
                if(d.code==200){
                    alert("撤回成功");
                    location.reload();
                }
            },'json')
        }    
    })

    $('.btnall').click(function(){
        $(".center :checkbox").prop("checked", true);
    })

    $('.btnno').click(function(){
        $(".center :checkbox").prop("checked", false);
    })
</script>



