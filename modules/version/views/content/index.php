<?php


$admin = $this->getMvAdmin();
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
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
    table th{
    	word-break: keep-all;
    
    }
 	.mtable td{
 		padding：0px 0px 0px 0px;
 	}
     table td{     	
    	word-break: keep-all;
    }
</style>
<?php
    $adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
    $adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
    $adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
    $adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
?>
<div style='padding: 5px 0px 0px 12px;'>
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;?></span>
</div>
<div class="mt10">
    <form action="">
        <div class="inputDiv">
            <input type="text" name="title" style="width:60px;height:18px;"  class="form-input" value="<?php echo !empty($_GET['title'])?$_GET['title']:''?>" placeholder="请输入查询条件">
          	<span style="font-size:14px;">CP</span>
           <select name="cp" style="width:60px;height:20px;"  class="form-input" id="cp">
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
            	<span style="float:left;font-size:14px;">类型</span>
            <select name="ShowType" style="width:60px;height:20px;"  class="form-input" id="ShowType">
                <option value="0" title="ShowType">请选择</option>
                <option <?php $ShowType=!empty($_GET['ShowType'])?$_GET['ShowType']:'';if($ShowType=='Movie'){echo "selected=selected"; } ?> value="Movie" >Movie</option>
                <option <?php $ShowType=!empty($_GET['ShowType'])?$_GET['ShowType']:'';if($ShowType=='Column'){echo "selected=selected"; } ?> value="Column">Column</option>
                <option <?php $ShowType=!empty($_GET['ShowType'])?$_GET['ShowType']:'';if($ShowType=='News'){echo "selected=selected"; } ?> value="News">News</option>
                <option <?php $ShowType=!empty($_GET['ShowType'])?$_GET['ShowType']:'';if($ShowType=='Series'){echo "selected=selected"; } ?> value="Series">Series</option>
                <option <?php $ShowType=!empty($_GET['ShowType'])?$_GET['ShowType']:'';if($ShowType=='Collection'){echo "selected=selected"; } ?> value="Collection">Collection</option>
		<option <?php $ShowType=!empty($_GET['ShowType'])?$_GET['ShowType']:'';if($ShowType=='Entertainment'){echo "selected=selected"; } ?> value="Entertainment">Entertainment娱乐</option>
                <option <?php $ShowType=!empty($_GET['ShowType'])?$_GET['ShowType']:'';if($ShowType=='Comic'){echo "selected=selected"; } ?> value="Comic">Comic动漫</option>
                <option <?php $ShowType=!empty($_GET['ShowType'])?$_GET['ShowType']:'';if($ShowType=='Record'){echo "selected=selected"; } ?> value="Record">Record记录</option>
                <option <?php $ShowType=!empty($_GET['ShowType'])?$_GET['ShowType']:'';if($ShowType=='Variety'){echo "selected=selected"; } ?> value="Variety">Variety综艺</option>
                <option <?php $ShowType=!empty($_GET['ShowType'])?$_GET['ShowType']:'';if($ShowType=='Sports'){echo "selected=selected"; } ?> value="Sports">Sports体育</option>
                <option <?php $ShowType=!empty($_GET['ShowType'])?$_GET['ShowType']:'';if($ShowType=='Tourism'){echo "selected=selected"; } ?> value="Tourism">Tourism旅游</option>
                <option <?php $ShowType=!empty($_GET['ShowType'])?$_GET['ShowType']:'';if($ShowType=='Education'){echo "selected=selected"; } ?> value="Education">Education教育</option>
            </select>
            <span style="float:left;font-size:14px;">状态</span>
            <select name="flag" style="width:60px;height:20px;"  class="form-input" id="flag">
                <option value="">请选择</option>
                <option <?php if(isset($_GET['flag'])){
                          if($_GET['flag']=='0'){
                              echo "selected=selected";
                          }
            } ?> value="0">不通过</option>
                <option <?php $flag=!empty($_GET['flag'])?$_GET['flag']:'';if($flag=='1'){echo "selected=selected"; } ?> value="1" >审核中</option>
                <option <?php $flag=!empty($_GET['flag'])?$_GET['flag']:'';if($flag=='6'){echo "selected=selected"; } ?> value="6">通过</option>
            </select>
	    <span style="float:left;font-size:14px;">资费</span>
	    <select id="isfree" class="form-input isfree" style="width:60px;height:20px">
		<option value="0">请选择</option>
		<option value="free"  <?php $isfree=!empty($_GET['isfree'])?$_GET['isfree']:'';if($isfree=='free'){echo "selected=selected"; } ?>>免费</option>
		<option value="nfree" <?php $isfree=!empty($_GET['isfree'])?$_GET['isfree']:'';if($isfree=='nfree'){echo "selected=selected"; } ?>>收费</option>
	    </select>
            <span  style="font-size:14px;">时间范围</span>
            <input placeholder="开始时间" style="width:60px;height:18px;"  type="text" name="first" id="first" class="form-input " value="<?php echo !empty($_GET['first'])?$_GET['first']:''?>">
          	<span  style="font-size:14px;">&nbsp;&nbsp;</span>
            <input placeholder="结束时间" style="width:60px;height:18px;"  type="text" name="timeend" id="timeend" class="form-input " value="<?php echo !empty($_GET['timeend'])?$_GET['timeend']:''?>">
            <input style="width:50px;height:20px;margin-left: 5px;" class="btn btn1 btn-gray audit_search search " type="button" value="查询" name="" style="font-size: 14px;/*margin-right:550px;*/">
	    <!--<input type="button" style='width:30px;height:20px;float:right;margin-right: 10px;' class="btn page_btn" value="go">
	    <span style="float:right;font-size:14px">&nbsp;页</span>
	    <input type="text" style='width:30px;height:18px;float:right' class="form-input " value="" name="page"  >
	     <span style="float:right;font-size:14px">到第&nbsp;</span>-->
            <?php echo $page;?>
        </div>

        <div class="inputDivTwo">
            <input style="width:150px;height:25px" class="form-input " type="text" value="" name="collection"  >
            <input class="btn collection_add" type="button" value="添加栏目集" name="collection_add" style="font-size: 14px;width:85px;">
            <input class="btnall btn" type="button" value="全选">
            <input class="btnno btn" type="button" value="全不选">
            <input class="btn sub_btn" type="button" value="提交审核">
        </div>









    <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
        <tr>
            <th>编号</th>
            <th>资产ID</th>
            <th>牌照方</th>
            <th>标题</th>
	        <th>资费类型</th>
            <th>类型</th>
            <th>语言</th>
            <th>状态</th>
            <th>添加时间</th>
            <th>最后修改时间</th>
            <th>操作</th>
        </tr>
        <?php
	//var_dump($list);
        if(!empty($list)){
            foreach($list as $l){?>
                <tr>
                    <input type="hidden" value="<?php echo $l['vid']?>">
                    <td><input type="checkbox" class="checkbox" name="id" value="<?php echo $l['id']?>"></td>
                    <td><?php echo $l['vid']?></td>
                    <td><?php
                        switch($l['cp']){
                            case '642001':echo '华数';break;
                            case 'BESTVOTT':echo '百视通';break;
                            case 'ICNTV':echo '未来电视';break;
                            case 'youpeng':echo '南传';break;
                            case 'HNBB':echo '芒果';break;
                            case 'CIBN':echo '国广';break;
                            case 'YGYH':echo '银河';break;
			                case 'poms':echo "咪咕";break;
                        }
                        ?></td>
                    <td><?php echo $l['title']?></td>
                    <?php $cps = array('642001','BESTVOTT','ICNTV','youpeng','HNBB','YGYH');?>
		    <td><?php
                if($l['prdpack_id']==1002381 && $l['cp']=='poms'){
                    echo "收费";
                }else if(in_array($l['cp'],$cps)){
                    echo "";
                }else{
                    echo "免费";
                }?></td>
                    <td><?php switch($l['ShowType']){
                            case 'Movie':echo '电影';break;
                            case 'Column':echo '栏目';break;
                            case 'News':echo '新闻';break;
                            case 'Series':echo '电视剧';break;
                            case 'Entertainment':echo '娱乐';break;
                            case 'Comic':echo '动漫';break;
                            case 'Record':echo '记录';break;
                            case 'Variety':echo '综艺';break;
                            case 'Sports':echo '体育';break;
                            case 'Tourism':echo '旅游';break;
                            case 'Education':echo '教育';break;
                            } 
                            ?></td>
                    <td><?php echo $l['language']?></td>
                    <td><?php switch($l['flag']){
                             case '0':echo '不通过';break;
                             case '1':
                             case '2':
                             case '3':
                             case '4':
                             case '5':
                                 echo '审核中';break;
                             case '6':echo '通过';break;
                        }?></td>
                    <td><?php echo date('Y-m-d H:i',$l['cTime'])?></td>
                    <td><?php 
                        if(empty($l['upTime'])){
                           echo '';
                        }else{
                            echo date('Y-m-d H:i',$l['upTime']);
                        }
                    ?></td>
                    <td>
                        <?php
                            if(in_array('1',$res['status']) || $_SESSION['auth']=='1'){
                                if($l['flag']=='0'){
                                echo '<a href="#" class="add">编辑</a>&nbsp;';
                                    echo "<a href='javascript:void(0)' gid='{$l['id']}' class='review'>提交审核</a>";
                                }elseif($l['flag']=='2'){
                                    echo "<a href='javascript:void(0)' gid='{$l['id']}' class='access'>入库</a>";
                                }elseif($l['flag']=='3'){
                                    echo "<a href='javascript:void(0)' gid='{$l['id']}' class='fff'>下线</a>";
                                }
                            }else{
                                if($l['flag']=='0'){
                                echo '<a href="#">编辑</a>&nbsp;';
                                    echo "<a  gid='{$l['id']}' >提交审核</a>";
                                }elseif($l['flag']=='2'){
                                    echo "<a  gid='{$l['id']}' >入库</a>";
                                }elseif($l['flag']=='3'){
                                    echo "<a  gid='{$l['id']}'>下线</a>";
                                }
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

    <div style="float:right;margin-top:-60px;margin-right:30px">

    </div>
</div>
<script>
    var adminLeftOne = "<?php echo $adminLeftOne;?>";
    var adminLeftTwo = "<?php echo $adminLeftTwo;?>";
    var adminLeftOneName = "<?php echo $adminLeftOneName;?>";
    var adminLeftTwoName = "<?php echo $adminLeftTwoName;?>";
//    var adminLeftUrlFlag = "+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName";
    $('.btnall').click(function(){
        $(".center :checkbox").prop("checked", true);
    })
    $('.btnno').click(function(){
        $(".center :checkbox").prop("checked", false);
    })
    $('#first,#timeend').datetimepicker({
        lang:'ch',
        validateOnBlur:false,
        timepicker:false,
        format:'Y-m-d',
        formatDate: 'Y-m-d',
        maxDate:'<?php echo date('Y-m-d',strtotime('1 day'))?>'
    });
    $('.add').click(function(){
        var vid = $(this).parent().parent().children('input').val();
        var id = $(this).parent().siblings().children('input').val();
        var mid = "<?php echo $this->mid?>";
        url="/version/content/add?vid="+vid+"&id="+id+"&mid="+mid+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
        window.open(url);
    })
    $('.see').click(function(){
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
    $('.search').click(function(){
        var title = $('input[name=title]').val();
        var cp = $('#cp').val();
        var ShowType = $('#ShowType').val();
        var flag = $('#flag').val();
        var first = $('input[name=first]').val();
        var timeend = $('input[name=timeend]').val();
        var mid = "<?php echo $this->mid?>";
        var pro="<?php echo $_SESSION['nickname']?>";
	var isfree = $("#isfree option:selected").val();
        //var nid = "<?php echo !empty($_REQUEST['nid'])?$_REQUEST['nid']:''?>";
        window.location.href="/version/content/index?mid="+mid+"&isfree="+isfree+"&ShowType="+ShowType+"&cp="+cp+"&title="+title+"&flag="+flag+"&first="+first+"&timeend="+timeend+"&pro="+pro+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
    })

    $('.review').click(function(){
        var gid = $(this).attr('gid');
        var username = "<?php echo  $admin['nickname']?>";
        $.post("<?php echo $this->get_url('review','add')?>",{gid:gid,username:username},function(d){
            location.reload();
        })
    })

    $('.access').click(function(){
        var gid = $(this).attr('gid');
        $.post("<?php echo $this->get_url('content','access')?>",{gid:gid},function(d){
            location.reload();
        })
    })

    $('.page_btn').click(function(){
	var title = $('input[name=title]').val();
        var cp = $('#cp').val();
        var ShowType = $('#ShowType').val();
        var page = $('input[name=pagenum]').val();
        switch(cp){
            case '华数':cp='642001';break;
            case '百视通':cp='BESTVOTT';break;
            case '未来电视':cp='ICNTV';break;
            case '南传':cp='youpeng';break;
            case '芒果':cp='HNBB';break;
            case '国广':cp='CIBN';break;
            case '银河':cp='YGYH';break;
	    case "咪咕":cp="poms";break;
        }
	var isfree = $("#isfree option:selected").val();
        var flag = $('#flag').val();
        var first = $('input[name=first]').val();
        var timeend = $('input[name=timeend]').val();
        var mid = "<?php echo $this->mid?>";
        //var nid = "<?php echo !empty($_REQUEST['nid'])?$_REQUEST['nid']:''?>";

        window.location.href="/version/content/index?mid="+mid+"&isfree="+isfree+"&ShowType="+ShowType+"&cp="+cp+"&title="+title+"&page="+page+"&flag="+flag+"&first="+first+"&timeend="+timeend+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
    })
    $('.collection_add').click(function(){
        var title = $('input[name=collection]').val();
        if(empty(title)){
            layer.alert('标题不能为空',{icon:0});
            return false;
        }
        var mid = "<?php echo $this->mid?>";
        url="/version/content/collection?mid="+mid+"&title="+title+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
        window.open(url);
    })
    $('.sub_btn').click(function(){
        var ids="";
        $("input[name='id']:checked").each(function() {

            ids += $(this).val()+' ';

        });
         var username = "<?php echo  $admin['nickname']?>";
        $.post("<?php echo $this->get_url('content','subrev')?>",{ids:ids,username:username},function(d){
            location.reload();
        })
    })
</script>


