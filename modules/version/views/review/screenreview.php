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
        padding: 5px 0px 5px 12px;
    }
    .inputDiv input{
        float: left;
    }
    .inputDiv span{
        float: left;
        margin-left:5px;
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
        padding: 5px 0px 5px 12px;
    }
    table th{
        word-break: keep-all;

    }
</style>
<div style='padding: 5px 0px 5px 14px;'>
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;?></span>
</div>
<div class="mt10" style="margin-top:0px;">
    <div class="inputDiv">
        <input style="width:120px;height:18px;" placeholder="请输入查询条件" type="text" name="title" class="form-input w100" value="">
        <span>站点:</span>
        <select name="stationId" id="stationId" style="width:70px;height:20px;"  class="form-input w100">
            <option  value="0">请选择</option>
            <?php
            if($_SESSION['auth'] == 1){
                $sql = "select id,name from yd_ver_station";
            }else{
                $uid = $_SESSION['userid'];
                $sql = "select a.* from yd_ver_station as a left join yd_ver_work as b on a.id=b.stationId and b.flag = 3 left join yd_ver_worker as c on c.workid=b.id where c.type = 1 and  c.uid=$uid group by a.id";
            }
                $stationRes = SQLManager::queryAll($sql);
                if(!empty($stationRes)){
                    foreach($stationRes as $k=>$v){?>
                        <option <?php if(!empty($_REQUEST['stationId']) && $_REQUEST['stationId'] == $v['id']){echo 'selected=selected';}?> value='<?php echo $v['id'];?>'><?php echo $v['name'];?></option>
                    <?php }
                }

            ?>
        </select>
        <span >牌照方:</span><select style="width:70px;height:20px;"  class="form-input w100" id="cp">
            <option  value=""  >请选择</option>
            <option  <?php if(!empty($_REQUEST['cp']) && $_REQUEST['cp'] == '642001'){echo 'selected=selected';}?> value="642001"  >华数</option>
            <option <?php if(!empty($_REQUEST['cp']) && $_REQUEST['cp'] == 'BESTVOTT'){echo 'selected=selected';}?> value="BESTVOTT"  >百视通</option>
            <option <?php if(!empty($_REQUEST['cp']) && $_REQUEST['cp'] == 'ICNTV'){echo 'selected=selected';}?> value="ICNTV"  >未来电视</option>
            <option <?php if(!empty($_REQUEST['cp']) && $_REQUEST['cp'] == 'youpeng'){echo 'selected=selected';}?> value="youpeng"  >南传</option>
            <option <?php if(!empty($_REQUEST['cp']) && $_REQUEST['cp'] == 'HNBB'){echo 'selected=selected';}?> value="HNBB"  >芒果</option>
            <option <?php if(!empty($_REQUEST['cp']) && $_REQUEST['cp'] == 'CIBN'){echo 'selected=selected';}?> value="CIBN"  >国广</option>
            <option <?php if(!empty($_REQUEST['cp']) && $_REQUEST['cp'] == 'YGYH'){echo 'selected=selected';}?> value="YGYH"  >银河</option>
        </select>
        <span >审核状态:</span><select onchange="access_btnChange()" style="width:70px;height:20px;"  class="form-input w100" id="allbtn">
            <option  value="请选择"  >请选择</option>
            <option <?php if(!empty($_REQUEST['allbtn']) && $_REQUEST['allbtn'] == '待审核'){echo 'selected=selected';}?> value="待审核"  >待审核</option>
            <option <?php if(!empty($_REQUEST['allbtn']) && $_REQUEST['allbtn'] == '已通过'){echo 'selected=selected';}?> value="已通过"  >已通过</option>
            <option <?php if(!empty($_REQUEST['allbtn']) && $_REQUEST['allbtn'] =='已驳回'){echo 'selected=selected';}?> value="已驳回"  >已驳回</option>
        </select>
        <input style="width:50px;height:20px;margin-left: 5px;font-size: 14px;" class="btn btn1 btn-gray audit_search search " type="button" value="查询" name="" >
        <!--<input type="button" style='width:30px;height:20px;float:right;margin-right: 10px;' class="btn page_btn" value="go">
        <span style="float:right;font-size:14px">&nbsp;页</span>
        <input type="text" style='width:30px;height:18px;float:right' class="form-input " value="" name="page"  >
         <span style="float:right;font-size:14px">到第&nbsp;</span>-->

    </div>
</div>
<div class="inputDivTwo" style="margin-top:0px;">
    <input class="btnall btn" type="button" value="全选">
    <input class="btnno btn" type="button" value="全不选">
    <input class="btn sub_btn" type="button" value="批量通过">
    <input type="button" class="btn sub_btn" value="批量驳回">
</div>
<div class="fenlei">
    <table width="100%" cellspacing="0" cellpadding="10" class="mtable center media">
        <tr>
            <th></th>
            <th>提审时间</th>
            <th>提审人</th>
            <th>提审动作</th>
            <th>站点</th>
            <th>导航</th>
            <th>标题</th>
            <th>图片</th>
            <th>action</th>
            <th>param</th>
            <th>推荐内容</th>
            <th>页面类型</th>
            <th>ID</th>
	    <th>审核</th>
        </tr>
        <?php
        if(!empty($list)){
            foreach($list as $k=>$v){
                $quote_res = $this->GetQuoteInfo($v['screenGuideid']);
                $copyGuides = array();
                if($quote_res){
                    foreach ($quote_res as $key=>$val){
                        $copyGuides[] = $val->attributes['pasteGuideId'];
                    }
                }
                if($v['pic'] == '/file/3.png'){
                    $first_pic = $v['pic'];
                    $tmp_pic = VerScreenContent::model()->find("id={$v['sid']}");
                    $v['pic'] = $tmp_pic->attributes['pic'];
                }
//                var_dump($v);die;
                ?>
                <tr class="tr_list">
                    <td><input type="checkbox" name="id" value="<?php echo $v['id']?>"  <?php if(in_array($v['screenGuideid'],$copyGuides)){echo "disabled=disabled";}?> screenGuidid="<?=$v['screenGuideid']?>" onclick="checkQuote(this)" ></td>
                    <td><?php echo date("Y-m-d h:i:s",$v['add_time'])?></td>
		    <td><?php echo $v['username'];?></td>
                    <td><?php
                            if(isset($first_pic) && $first_pic == '/file/3.png'){
                                echo '删除';
                            }else{
                                echo '编辑';
                            }

                        ?>
                    </td>
                    <td><?php echo $v['name']?></td>
                    <td><?php echo $v['gtitle']?></td>
                   <!-- <td><?php echo $v['x']?>×<?php echo $v['y']?>;<br><?php echo $v['width']?>×<?php echo $v['height']?></td>-->
                    <td><?php echo $v['title']?></td>
                    <td class="img"><img src="<?php echo $v['pic']?>" width="100px"></td>
                    <td><div style="width:200px;word-wrap:break-word;"><?php echo $v['action']?></div></td>
                    <td><div style="width:200px;word-wrap:break-word;"><?php echo $v['param']?></div></td>
                    <td><?php echo $v['tType']?></td>
                    <td><?php echo $v['uType']?></td>
                    <td><?php echo $v['cid']?></td>
                    <td>
			<?php
				if($v['review_flag'] == 3){
					echo $v['review_times'].'审提审';
				}elseif($v['review_flag'] == 1){
					echo $v['review_times'].'审通过';
				}elseif($v['review_flag'] == 2){
					echo $v['review_times'].'审驳回';
				}elseif($v['review_flag'] == 4){
					echo $v['review_times'].'审发布';
				}
				//echo $v['review_times'];
			?>
		    </td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
<script>
    <?php if($readFlag=='2'){echo "var readFlag='2';";}else{echo "var readFlag='1';";}?>

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

    function checkQuote(obj)
    {
        var copyGuideId = $(obj).attr('screenguidid');
        var pic = $(obj).parent().parent().children().eq(5).children('img').attr('src');
        var mid = <?=$this->mid;?>;
        var pasteGuideIds = new Array();
        $.ajax
        ({
            type:'get',
            url:"/version/review/GetQuoteInfo/mid/"+mid+"/guideId/"+copyGuideId,
            success:function(data)
            {
                data = eval(data);
                if(!empty(data)){
                    $.each(data,function (i) {
                        pasteGuideIds.push(data[i]['pasteGuideId']);
                    })
                }

            },
            async:false
        });
        if(!empty(pasteGuideIds)){
            for(var i = 0 ; i<pasteGuideIds.length ; i++){
                for(var j = 0 ; j<$('.tr_list').length ; j++){
                    var tmp_pasteGuide = $('.tr_list').eq(j).children().eq(0).children('input').attr('screenguidid');
                    var tmp_pic =  $('.tr_list').eq(j).children().eq(5).children('img').attr('src');
                    if(pasteGuideIds[i] == tmp_pasteGuide && pic == tmp_pic){
                        var checked_status = $('.tr_list').eq(j).children().eq(0).children('input').prop('checked');
                        if(empty(checked_status) || checked_status == undefined){
                            $('.tr_list').eq(j).children().eq(0).children('input').prop("checked",true);
                        }else if(checked_status){
                            $('.tr_list').eq(j).children().eq(0).children('input').prop('checked',false);
                        }
                    }
                }
            }
        }
    }

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
    $('.search').click(function(){
        var title = $('input[name=title]').val();
        var cp = $('#cp').val();
        var stationId =$('#stationId').val();
        var nid = "<?php echo $_GET['nid']?>";
        var allbtn = $('#allbtn').val();
	var headerUrl = "/version/review/screenreview/mid/<?php echo $this->mid;?>"+'/nid/'+nid;	
	var center = '';
	var url = '';
	if(stationId>0){
            center += '/stationId/'+stationId;
        }
	if(!empty(cp)){
	    center += '/cp/'+cp;		
	}
	if(!empty(title)){
	    center += '/title/'+title;	
	}
	if(allbtn != '请选择'){
	    center += '/allbtn/'+allbtn;	
	}
	
	window.location.href = headerUrl+center+fixedUrl;
    });

    $(document).on('click','.img',function(){
        var img = $(this).children('img').attr('src');
        $.getJSON('<?php echo $this->get_url('review','pic')?>',{img:img},function(d){
            if(d.code == 200){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['630px', '550px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    });

    $('.btnall').click(function(){
        $(".center :checkbox").prop("checked", true);
    });
    $('.btnno').click(function(){
        $(".center :checkbox").prop("checked", false);
    });

    $('.sub_btn').click(function(){
        var text = $(this).val();
        if(text=='批量通过'){
            var flag=1;
        }else{
            var flag=2;
        }
        var ids="";
        $("input[name='id']:checked").each(function() {

            ids += $(this).val()+' ';

        });
        //console.log(ids);//return false;
        $.post("<?php echo $this->get_url('review','contentaccess')?>",{id:ids,flag:flag},function(){
            location.reload();
        })
    });

    $('.access_btn').click(function(){
        var text = $(this).val();
        if(text=='已通过'){
            var flag=1;
        }else{
            var flag=2;
        }
        var url = '/version/review/accessdata?mid='+"<?php echo $_GET['mid']?>"+"&flag="+flag;
        ajax(url);
    });

    $('.allbtn').click(function(){
        var url = '/version/review/reviewdata?mid='+"<?php echo $_GET['mid']?>";
        //ajax(url);
        window.location.reload();
    });



    function ajax(url){
        $.ajax({
            type: 'GET',
            url: url,
            /*data: {'page': 1 },*/
            dataType: 'json',
            success: function(json) {
                //console.log(json);
                $('.fenlei').empty();
                var li = '';

                li += '<table width="100%" cellspacing="0" cellpadding="10" class="mtable center media"><tr><th></th><th>提审时间</th><th>站点</th><th>屏幕名称</th><th>位置尺寸</th><th>图片</th><th>标题</th><th>推荐内容</th><th>页面类型</th><th>ID</th><th>牌照方</th><th>action</th><th>param</th></tr>';
                $.each(json, function(index, array) {
                    li += "<tr><td><input type='checkbox' name='id' value="+array['id']+"></td><td>" + getLocalTime(array['addTime']) + "</td><td>" + array['name']+"</td><td>"+array['gtitle']+ "</td><td>" + array['x']+"×"+array['y']+";"+ array['width']+"×"+array['height']+ "</td><td class='img'><img src=" + array['pic'] + " width='100px'></td><td>" + array['title'] + "</td><td>" + array['tType'] + "</td><td>" + array['uType'] + "</td><td>" + array['cid'] + "</td><td>" + array['cp'] + "</td><td>" + array['action'] + "</td><td>" + array['param'] + "</td></tr>";
                })
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

    if(readFlag=='2'){
        $('.mt10').hide();
    }else{
        $('.mt10').show();
    }

    function btnShow(flag)
    {
        if(flag == '2'){
            $('.mt10').hide();
            //return false;
        }else{
            $('.mt10').show();
            //return false;
        }
    }

    <?php if($_SESSION['auth']=='1'){echo "$('.mt10').show();";}?>
</script>

