<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<style>
	td {
		padding-left: 10px;
		font-size: 14px;
		height: 30px;
		width: 150px
	}
	.import {
		color: #C53336;
	}
	.main_tb {
		border: 1px solid #C9C9C9;
		border-collapse: collapse;
		margin-left: 10px;
	}
	.main_tb tr {
		border: 1px solid #C9C9C9;
	}
	.main_tb td {
		border: 1px solid #C9C9C9;
	}
	.tb_player tr:nth-child(even) {
		background: #F0FDFF;
	}
<?php
        $template = !empty($arr['templateType'])?$arr['templateType']:'';
        if($template!='E'){
            echo " .dir{color:red}";
        }
    ?>
.active{color:black}
</style>
<div style="margin-top:20px;margin-left:10px;height:20px;width:700px;">

<div style="height:20px;width:300px;float: left">审核>元数据审核>查看</div>
<a onclick="javascript:history.back(1);"href="#">
<div style="line-height:20px;text-align:center;height:20px;width:91px;float: right; background-image: url(/images/u1971.png);">
	<span style="font-size:13px;font-family: '微软雅黑 Bold', '微软雅黑 Regular', '微软黑雅';font-weight: 700;font-style: normal;color:#FFFFFF;">返回</span>
</div>
</a>
</div>
<div class="mt10" style="width:400px">
    <form action="" method="post">
    <input type="hidden" name="vid" value="<?php echo !empty($vid)?$vid:''?>">
    <table  class="main_tb" width="700px;" >
         <tr bgcolor="#A3BAD5">
       	<td colspan="4" style="text-align: center;font-size: 13px;color：#333333">基本信息</td>
       </tr>
        <tr  bgcolor="#F0FDFF">
            <td class="import">资产名称:</td>
            <td colspan="3"><div name="title" style="height:25px;line-height: 25px"><?php echo !empty($arr['title'])?$arr['title']:''?></div></td>
        </tr>
        <tr>
            <td>内容类型:</td>
            <td><div name="ShowType" style="height:25px;line-height: 25px"><?php echo !empty($arr['ShowType'])?$arr['ShowType']:''?></div>
            </td>
             <td class="import">内容提供商:</td>
            <td><div  name='cp'   style="height:25px;line-height: 25px"><?php
			switch(!empty($arr['cp'])?$arr['cp']:'') {
				case '642001' :
					echo '华数';
					break;
				case 'BESTVOTT' :
					echo '百视通';
					break;
				case 'ICNTV' :
					echo '未来电视';
					break;
				case 'youpeng' :
					echo '南传';
					break;
				case 'HNBB' :
					echo '芒果';
					break;
				case 'CIBN' :
					echo '国广';
					break;
				case 'YGYH' :
					echo '银河';
					break;
			}
			?></div></td>

        </tr>
        <tr  bgcolor="#F0FDFF"> 
            <!--<td>节目类型:</td>
            <td><select name="type" class="form-input w100" id="type" onchange="aa()">
                    <option value="0">请选择</option>
                    <option <?php if($arr['type']=='电影'){echo "selected=selected"; } ?> value="电影" >电影</option>
                    <option <?php if($arr['type']=='综艺'){echo "selected=selected"; } ?> value="综艺">综艺</option>
                    <option <?php if($arr['type']=='新闻'){echo "selected=selected"; } ?> value="新闻">新闻</option>
                    <option <?php if($arr['type']=='电视剧'){echo "selected=selected"; } ?> value="电视剧">电视剧</option>
                    <option <?php if($arr['type']=='动漫'){echo "selected=selected"; } ?> value="动漫">动漫</option>
                    <option <?php if($arr['type']=='教育'){echo "selected=selected"; } ?> value="教育">教育</option>
                    <option <?php if($arr['type']=='体育'){echo "selected=selected"; } ?> value="体育">体育</option>
                    <option <?php if($arr['type']=='音乐'){echo "selected=selected"; } ?> value="音乐">音乐</option>
                    <option <?php if($arr['type']=='记录'){echo "selected=selected"; } ?> value="记录">记录</option>
                    <option <?php if($arr['type']=='生活'){echo "selected=selected"; } ?> value="生活">生活</option>
                    <option <?php if($arr['type']=='其他'){echo "selected=selected"; } ?> value="其他">其他</option>
                </select></td>-->
            <td class="import">节目类型:</td>
            <td colspan='3'>
            	<div name="type" style="height:25px;line-height: 25px"><?php
				foreach ($arr['type'] as $key => $value) { echo $value;
				}
			?></div>
            	    </td>
         </tr>
        <tr>
            <td class="import">单集多级选择</td>
            <td><div name="simple_set" style="height:25px;line-height: 25px"><?php
			if ($arr['simple_set'] == '1') {echo '单集';
			} else if ($arr['simple_set'] == '2') { echo '多集';
			}
			?></div></td>
     
            <td class="import">模板选择:</td>
            <td id="template">
               <div name="templateType" style="height:25px;line-height: 25px">
               	<?php
				if ($arr['templateType'] == 'A')
					echo "竖图单片模板(电影)";
				if ($arr['templateType'] == 'B')
					echo "多集数字模板（电视剧）";
				if ($arr['templateType'] == 'C')
					echo "多集标题模板（综艺）";
				if ($arr['templateType'] == 'D')
					echo "横图单片模板";
				if ($arr['templateType'] == 'E')
					echo "无模板（新闻）";
               	?>
               	
               </div>
     
            </td>
        </tr>

        <tr bgcolor="#F0FDFF">
            <td>内容ID:</td>
            <td><?php echo !empty($arr['vid'])?$arr['vid']:''?></td>
            <td>资产ID:</td>
            <td><?php echo !empty($arr['id'])?$arr['id']:''?></td>
        </tr>
        <tr>
            <td>版权开始时间:</td>
            <td><?php echo !empty($arr['startDateTime'])?$arr['startDateTime']:'0'?></td>
            <td>版权结束时间:</td>
            <td><?php echo !empty($arr['endDateTime'])?$arr['endDateTime']:'0'?></td>
        </tr>
        <tr bgcolor="#F0FDFF">
            <td class="import">看点:</td>
            <td colspan="3"><div name="info" ><?php echo !empty($arr['info'])?$arr['info']:''?></div></td>
        </tr>
        <tr>
            <td>优先级:</td>
            <td><?php echo !empty($extra['orders']) ? $extra['orders'] : ''; ?></td>
            <td class="import">首字母:</td>
            <td><?php echo !empty($arr['initial']) ? $arr['initial'] : ''; ?></td>
        </tr>
        <tr  bgcolor="#F0FDFF">
            <td>国家地区:</td>
            <td>
            	 <div name="CountryOfOrigin" style="height:25px;line-height: 25px">
               	<?php
				if ($arr['CountryOfOrigin'] == '1')
					echo "内地";
				if ($arr['CountryOfOrigin'] == '2')
					echo "港台";
				if ($arr['CountryOfOrigin'] == '3')
					echo "韩日";
				if ($arr['CountryOfOrigin'] == '4')
					echo "欧美";
				if ($arr['CountryOfOrigin'] == '5')
					echo "东南亚";
				if ($arr['CountryOfOrigin'] == '99')
					echo "其他";
               	?>
               	
               </div>
     
            </td>
            <td>发行年份:</td>
            <td><?php echo !empty($arr['year'])?$arr['year']:''?></td>
        </tr>
        <tr>
            <td>配音语言:</td>
            <td><?php echo !empty($arr['language'])?$arr['language']:''?></td>
            <td>字幕语言:</td>
            <td><?php echo !empty($extra['subtitles']) ? $extra['subtitles'] : '其他'; ?></td>
        </tr>
        <tr class='fen' bgcolor="#F0FDFF">
            <td class="dir">评分</td>
            <td><?php echo !empty($arr['score'])?$arr['score']:''?></td>
            <td>清晰度</td>
            <td></td>
        </tr>
        <!--<tr>
            <td>标签:</td>
            <td colspan="3"><input type="text" class="form-input w400" name="keyword" value="<?php echo !empty($arr['keyword'])?$arr['keyword']:''?>" style="height:25px;line-height: 25px;"></td>
        </tr>-->
        <tr>
            <td class="dir">标签:</td>
            <td colspan="2" class="keyword"><?php echo !empty($arr['str'])?$arr['str']:''?></td><input type="hidden" class="form-input w400" name="keyword" value="<?php echo !empty($arr['keyword'])?$arr['keyword']:''?>" style="height:25px;line-height: 25px"></td>
            <td></td>
        </tr>
        <tr bgcolor="#F0FDFF">
            <td>关键字:</td>
            <td colspan="3"><?php echo !empty($arr['short'])?$arr['short']:''?></td>
        </tr>
        <tr class="num" >
            <td>更新集数:</td>
            <td ><?php
			if (!empty($list)) {
				$delFlag = 1;
				$r = array_filter($list, function($t) use ($delFlag) {
					return $t['delFlag'] == $delFlag;
				});
				echo count($r);
			} else {
				echo 0;
			}
             ?></td>

            <td>总集数:</td>
            <td ><?php echo !empty($extra['total'])?$extra['total']:'0'?></td>
        </tr>
        <tr class="end" bgcolor="#F0FDFF">
            <td>是否完结:</td>
            <td colspan="3"><?php $end = !empty($extra['end']) ? $extra['end'] : '2';
				if ($end == 1) { echo '是';
				} else if ($end == 2) { echo '否';
				}
			?></td>
        </tr>
        <tr class="bftime" style="bftime">
            <td>播放时间:</td>
            <td><?php echo !empty($extra['bftime'])?$extra['bftime']:''?></td>
            <td>电视台:</td>
            <td><?php echo !empty($extra['tvstation'])?$extra['tvstation']:''?></td>
        </tr>
        <tr class="act" bgcolor="#F0FDFF">
            <td >导演:</td>
            <td colspan="3"><?php echo !empty($arr['director'])?$arr['director']:''?></td>
        </tr>
        <tr class="act" >
            <td >演员:</td>
            <td colspan="3"><?php echo !empty($arr['actor'])?$arr['actor']:''?></td>
        </tr>
        <tr class="pri" style="display:none">
            <td>奖项:</td>
            <td><input type="text" class="form-input w100" name="prize" value="<?php echo !empty($extra['prize'])?$extra['prize']:''?>" style="height:25px;line-height: 25px;"></td>
            <td>票房:</td>
            <td><input type="text" class="form-input w100" name="boxoffice" value="<?php echo !empty($extra['boxoffice'])?$extra['boxoffice']:''?>" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="com" bgcolor="#F0FDFF">
            <td>影评:</td>
            <td colspan="3"><?php echo !empty($extra['comment'])?$extra['comment']:''?></td>
        </tr>
    </table>
    <div style="height:10px;"></div>
    <table width="700px"  cellspacing="0" cellpadding="10" class="main_tb tb_player center media" >
   <tr bgcolor="#A3BAD5">
        <td colspan='6' align='center'>播放文件管理</td>
    </tr>
             <tr>
                    <td colspan='3' align="left">
                    </td>
                    <td colspan='3'></td>
                </tr>
             <tr>
                    <td>序号</td>
                    <td>播放</td>
                    <td>媒体文件名称</td>
                    <td>创建时间</td>
                    <td>发布状态</td>
                    <td></td>
                </tr>
                <?php
            if(!empty($list)){?>
               <?php
                   foreach ($list as $k => $v) {
                    ?>
                    <tr>
                        <input type="hidden" value="<?php echo $v['id'] ?>">
                        <td><input type="text" class="order" value="<?php echo $v['order'] ?>" style="width:20px"></td>
                        <td   class="mrbf mrbf-<?php echo $v['id']?>"><?php
						switch($v['bfflag']) {
							case '0' :
								echo '';
								break;
							case '1' :
								echo '默认播放';
								break;
						}
						?></td>
                        <td><?php echo $v['title']?></td>
                        <td><?php echo date('Y-m-d', $v['cTime']) ?></td>
                        <td><?php
						if ($v['delFlag'] == '0') {
							echo '下线';
						} else {
							echo '上线';
						}
                            ?></td>
                        <td></td>
                    </tr>
                    <?php }
						}
				?>

    </table>
    <div style="height:10px"></div>
    <table width="700px" class="main_tb tb_player picture">
    	   <tr bgcolor="#A3BAD5">
        <td colspan='6' align='center'>图片信息</td>
    </tr>
        <tr>
            <td>图片类型</td>
            <td>图片文件</td>
            <td>创建时间</td>
            <td></td>
        </tr>
        <?php if(!empty($pic)){
            foreach($pic as $key=>$val){?>
               <tr>
                   <input type="hidden" value="<?php echo $val->attributes['id']?>">
                    <td class="typepic"><?php $type = $val -> attributes['type'];
					if ($type == '1') {echo "海报";
					} else if ($type == '2') {echo "推荐图";
					}
 ?></td>
                    <td><a target="_blank" href="/file/<?php echo basename($val->attributes['url'])?>"><?php echo basename($val->attributes['url'])?></a></td>
                    <td><?php echo date('Y-m-d',$val->attributes['cTime'])?></td>
                    <td></td>
                </tr>
            <?php }
					}
		?>
    </table>
    
    </form>
</div>
<div style="height:10px"></div>
 <table width="700px" class="main_tb tb_player picture">
    	   <tr bgcolor="#A3BAD5">
        <td colspan='6' align='center'>审核信息</td>
    </tr>
        <tr>
            <td width="100" align="right">提审人：</td>
            <td><?php echo $tmp->attributes['user']?></td>
        </tr>
        <tr>
            <td width="100" align="right">提审时间：</td>
            <td><?php echo date('Y-m-d H:i:s',$tmp->attributes['addTime'])?></td>
        </tr>
        <tr>
            <td width="100" align="right">1审操作：</td>
            <td><?php echo date('Y-m-d H:i:s',$tmp->attributes['addTime1'])?><?php
                if(!empty($tmp->attributes['message1'])){
                    echo '理由:';
                    echo $tmp->attributes['message1'];
                }
                ?></td>
        </tr>
        <tr>
            <td width="100" align="right">2审操作：</td>
            <td><?php echo date('Y-m-d H:i:s',$tmp->attributes['addTime2'])?><?php
                if(!empty($tmp->attributes['message2'])){
                    echo '理由:';
                    echo $tmp->attributes['message2'];
                }
                ?></td>
        </tr>
        <tr>
            <td width="100" align="right">3审操作：</td>
            <td><?php echo date('Y-m-d H:i:s',$tmp->attributes['addTime3'])?><?php
                if(!empty($tmp->attributes['message3'])){
                    echo '理由:';
                    echo $tmp->attributes['message3'];
                }
                ?></td>
        </tr>
        <tr>
            <td width="100" align="right">4审操作：</td>
            <td><?php echo date('Y-m-d H:i:s',$tmp->attributes['addTime4'])?><?php
                if(!empty($tmp->attributes['message4'])){
                    echo '理由:';
                    echo $tmp->attributes['message4'];
                }
                ?></td>
        </tr>
        <tr>
            <td width="100" align="right">5审操作：</td>
            <td><?php echo date('Y-m-d H:i:s',$tmp->attributes['addTime5'])?><?php
                if(!empty($tmp->attributes['message5'])){
                    echo '理由:';
                    echo $tmp->attributes['message5'];
                }
                ?></td>
        </tr>
    </table>
<script type="text/javascript">
     $('.key_btn').click(function(){
        var p =1;
        $.getJSON('<?php echo $this->get_url('content','keylist')?>',{p:p},function(d){
            if(d.code == 200){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['830px', '550px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })
     $('.all_bf').click(function(){
        var vid = "<?php echo $_REQUEST['vid']?>";
        if(confirm("批量设置默认播放会刷新页面！！")){
            $.post("<?php echo $this->get_url('content','allplay')?>",{vid:vid},function(d){
                location.reload();
            })
        }

    })
     $('.title').blur(function(){
        var title = $(this).val();
        var id = $(this).parent().parent().children('input').val();
        $.post("<?php echo $this->get_url('content','changetitle')?>",{id:id,title:title},function(d){
            location.reload();
        })
    })
     $('.sub_btn').click(function(){
        var title = $('input[name=title]').val();
        var cp = $('input[name=cp]').val();
        var simple_set = $('input[name=simple_set]:checked').val();
        var templateType = $('#templateType').val();
        var info = $('.info').val();
        var score = $('input[name=score]').val();
        var keyword = $('.keyword').html();
        var initial = $('input[name=initial]').val();
        var type = {};
        $("input[name='type']:checked").each(function() {

            type += $(this).val()+' ';

        });


        if(empty(title)){
            alert("资产名称不能为空");
            return false;
        }
        if(empty(cp)){
            alert("牌照方不能为空");
            return false;
        }
        if(empty(simple_set)){
            if(simple_set!=0){
                alert("单集多集为空");
                return false;
            }
        }
        if(empty(info)){
            alert("看点不能为空");
            return false;
        }
        if(empty(templateType)){
            alert("模板不能为空");
            return false;
        }
        if(templateType!='E'){
           if(empty(score)){
            alert("评分不能为空");
            return false;
        }
        if(empty(keyword)){
            alert("标签不能为空");
            return false;
        }
        if(empty(initial)){
            alert("首字母不能为空");
            return false;
        }
        }
        if(empty(type)){
            alert("类型不能为空");
            return false;
        }
        /*var simple_set = $('input[name=simple_set]:checked').val();
        if(simple_set=='1'){
            var text = '';
            $(".mrbf").each(function(){
                if($(this).text()=='默认播放'){
                     text = $(this).text();
                    return false;
                }
            });
            if(text!='默认播放'){
                return false;
            }
        }else{
            var text = '';
            $(".mrbf").each(function(){
                if($(this).text()=='默认播放'){
                    if($(this).parent().children().children('a').html()=='下线'){
                        text = $(this).text();
                        return false;
                    }
                }else{
                    text = $(this).text();
                    return true;
                 }
            });
            if(text!='默认播放'){
                return false;
            }
        }*/
    })
     $('.all_submit').click(function(){
        var vid = "<?php echo $_REQUEST['vid']?>";
        $.post("<?php echo $this->get_url('content','allsubmit') ?>",{vid:vid},function(d){
            location.reload();
        })
    })
    for(i=1;i<11;i++){
        var str = '.key'+i;
        if(empty($(str).val())){
           var i = i;
            break;
        }
    }
    console.log(i)
    var start;
    $('#pic_true').uploadify({
        'auto': true,//关闭自动上传
        'buttonImage': '/images/up1.png',
        'width': 70,
        'height': 26,
        'swf': '/js/uploadify/uploadify.swf',
        'uploader': '/upload/img',
        'method': 'post',//方法，服务端可以用$_POST数组获取数据
        'buttonText': '选择图片',//设置按钮文本
        'queueID': 'queueid',
        'multi': true,//允许同时上传多张图片
        'uploadLimit': 10,//一次最多只允许上传10张图片
        'fileTypeExts': '*',//限制允许上传的图片后缀
        'sizeLimit': 10240000000,//限制上传的图片不得超过200KB
        'onSelect'      : function(file){

            var type = file.type;
            var img = ['.jpg','.jpeg','.png','.gif'];
            var myself = this;
            //layer.alert(file.size);


            if(!in_array(type,img)){
                myself.cancelUpload();
                layer.alert("这不是图片");
                return false;
            }
        },
        'onUploadStart' :function(file){
            start = layer.load(0, {icon: 16,shade: [0.3,'#000']});
        },
        'onUploadSuccess' : function(file, data, response) {//每次成功上传后执行的回调函数，从服务端返回数据到前端
            layer.close(start);
            var value = eval('('+data+')');
            var name = "input[name="+'key'+i+']';
            $(name).val(value.url);
            i++;
        },
    })
    $('.media td').dblclick(function(){
        var id = $(this).siblings('input').val();
        $.getJSON("<?php echo $this->get_url('content','alert')?>",{id:id},function(d){
            if(d.code==200){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['830px', '350px'], //宽高
                    content: d.msg
                })
            }else{
                alert(msg);
            }
        })
    })
    $('.upload').click(function(){
        var vid = "<?php echo $_REQUEST['vid']?>";
        var cp  = $('input[name=cp]').val();
        var title  = $('input[name=title]').val();
        var my = layer.msg('加载中', {icon: 16,shade:0.3});
        $.getJSON('<?php echo $this->get_url('content','upload')?>',{vid:vid,cp:cp,title:title},function(d){
            if(d.code == 200){
                layer.close(my);
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['530px', '350px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })
    $('.submit').click(function(){
        var info = $('.info').val();
        var ShowType = $('#ShowType').val()
        var id = $(this).parent().parent().children('input').val();
        var msg= $(this).html();
        if(msg == '上线'){
            flag = 1;
        }else{
            flag = 0;
        }
        $.post("<?php echo $this->get_url('content','submit')?>",{id:id,flag:flag,info:info,ShowType:ShowType},function(d){
            location.reload();
        })
    })
    $('.del').click(function(){
        var id = $(this).parent().parent().children('input').val();
        $.post("<?php echo $this->get_url('content','del')?>",{id:id},function(d){
            location.reload();
        })
    })
    $('.order').blur(function(){
        var order = $(this).val();
        var id = $(this).parent().parent().children('input').val();
        $.post("<?php echo $this->get_url('content','order')?>",{id:id,order:order},function(d){
            //location.reload();
        })
    })
    /*function repic(obj){
        var flag = obj.value;
        var vid = "<?php echo $_REQUEST['vid']?>";
        $.post("<?php echo $this->get_url('content','pictype') ?>",{vid:vid,flag:flag},function(d){
            location.reload();
        })
    }*/
    $('.delete').click(function(){
        var id = $(this).parent().parent().children('input').val();
        $.post("<?php echo $this->get_url('content','delete')?>",{id:id},function(d){
            location.reload();
        })
    })
    /*function aa(){
        var type = $("#type").val();
        var showtype=$('#ShowType').val();
        switch(type){
            case '电影':
                $('.act').hide();
                $('.pri').hide();
                $('.com').hide();
                $('.num').hide();
                $('.end').hide();
                $('.total').hide();
                $('.bftime').hide();
                $('.act').show();
                $('.pri').show();
                $('.com').show();
                break;
            case '综艺':
                $('.act').hide();
                $('.pri').hide();
                $('.com').hide();
                $('.num').hide();
                $('.total').hide();
                $('.bftime').hide();
                $('.end').hide();
                $('.num').show();
                break;
            case '新闻':
                $('.act').hide();
                $('.pri').hide();
                $('.total').hide();
                $('.com').hide();
                $('.num').hide();
                $('.end').hide();
                $('.end').show();
                $('.num').show();
                $('.fen').hide();
                $('.bftime').show();
                break;
            case '电视剧':
            case '动漫':
            case '教育':
            case '体育':
            case '音乐':
            case '记录':
            case '其他':
                $('.act').hide();
                $('.pri').hide();
                $('.com').hide();
                $('.num').hide();
                $('.end').hide();
                $('.bftime').hide();
                $('.act').show();
                $('.pri').show();
                $('.com').show();
                $('.total').show();
                $('.end').show();
                $('.num').show();
                break;
            default :
                switch(showtype){
                    case 'Movie':
                       $('.act').hide();
                       $('.pri').hide();
                       $('.com').hide();
                       $('.num').hide();
                       $('.bftime').hide();
                       $('.total').hide();
                       $('.end').hide();
                       $('.act').show();
                       $('.pri').show();
                       $('.com').show();
                       break;
                     case 'News':
                        $('.act').hide();
                        $('.pri').hide();
                        $('.com').hide();
                        $('.num').hide();
                        $('.end').hide();
                        $('.total').hide();
                        $('.end').show();
                        $('.num').show();
                        $('.fen').hide();
                        $('bftime').show();
                        break;
                     case 'Column':
                        $('.act').hide();
                        $('.pri').hide();
                        $('.com').hide();
                        $('.num').hide();
                        $('.total').hide();
                        $('.bftime').hide();
                        $('.end').hide();
                        $('.num').show();
                        break;
                     case 'Series':
                     case 'Collection':
                        $('.act').hide();
                        $('.pri').hide();
                        $('.com').hide();
                        $('.num').hide();
                        $('.end').hide();
                        $('.total').show();
                        $('.bftime').hide();
                        $('.end').show();
                        $('.act').show();
                        $('.pri').show();
                        $('.com').show();
                        $('.num').show();
                        break;
                     default :
                        $('.act').hide();
                        $('.pri').hide();
                        $('.com').hide();
                        $('.num').hide();
                        $('.end').hide();
                        $('.total').hide();
                        $('.bftime').hide();
                        $('.act').show();
                        $('.pri').show();
                        $('.com').show();
                        $('.num').show();
                        break;


                }
                break;

        }
    }*/
    function aa(){
        var templateType = $('#templateType').val();
        if(templateType=='E'){
            $('.dir').addClass('active');
        }else{
            $('.dir').removeClass('active');
        }
    }

    $(function(){
        aa();
    })
    $('.coladd').click(function(){
        var vid = "<?php echo $_REQUEST['vid']?>";
        $.getJSON('<?php echo $this->get_url('content','coladd')?>',{vid:vid},function(d){
            if(d.code == 200){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['730px', '550px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })
    /*$('.picture td').dblclick(function(){
        var id = $(this).siblings('input').val();
        $.getJSON("<?php echo $this->get_url('content','pic')?>",{id:id},function(d){
            if(d.code==200){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['530px', '600px'], //宽高
                    content: d.msg
                })
            }else{
                alert(msg);
            }
        })
    })*/
    function removeByValue(arr, val) {
                        for(var i=0; i<arr.length; i++) {
                                if(arr[i] == val) {
                                        arr.splice(i, 1);
                                }
                        }
                }
                $(function(){
                        var Arr = new Array;
                        $("input[name='type[]']:checked").each(function(){
                                        Arr.push($(this).val());
            })
                        $(document).on('click',"input[name='type[]']",function(){
                                if($(this).attr("checked")){
                                        $(this).removeAttr("checked");
                                        removeByValue(Arr,$(this).val());
                                }else{
                                        $(this).attr("checked",true);
                                        Arr.push($(this).val());
                                }       })
                })
      $('.save_btn').click(function(){
         var title = $('input[name=title]').val();
        var cp = $('input[name=cp]').val();
        var simple_set = $('input[name=simple_set]:checked').val();
        var templateType = $('#templateType').val();
        var info = $('.info').val();
        var score = $('input[name=score]').val();
        var keyword = $('.keyword').html();
        var initial = $('input[name=initial]').val();
        var type = {};
        $("input[name='type']:checked").each(function() {

            type += $(this).val()+' ';

        });


        if(empty(title)){
            alert("资产名称不能为空");
            return false;
        }
        if(empty(cp)){
            alert("牌照方不能为空");
            return false;
        }
        if(empty(simple_set)){
            if(simple_set!=0){
                alert("单集多集为空");
                return false;
            }
        }
        if(empty(info)){
            alert("看点不能为空");
            return false;
        }
        if(empty(templateType)){
            alert("模板不能为空");
            return false;
        }
        if(templateType!='E'){
            if(empty(score)){
                alert("评分不能为空");
                return false;
            }
            if(empty(keyword)){
                alert("标签不能为空");
                return false;
            }
            if(empty(initial)){
                alert("首字母不能为空");
                return false;
            }
        }
        if(empty(type)){
            alert("类型不能为空");
            return false;
        }
        var text='';
            $(".mrbf").each(function(){
                if($(this).text()=='默认播放'){
                    if($(this).parent().children().children('a').html()=='下线'){
                        text = $(this).text();
                        return false;
                    }
                }else{
                    text = $(this).text();
                    return false;
                }
            });
            if(text!='默认播放'){
               alert('请设置默认播放以及上线');
                return false;
            }
        var pictype='';
        $(".typepic").each(function() {
            var pic = $(this).children().val().split('_');
            console.log(pic)
            pictype +=pic[1];
            if(pictype==1){
                return false;
            }

        });
        console.log(pictype)
        if(pictype!=1){
            alert("请选择海报图");
            return false;
        }
        //window.location.href="/version/content/index?mid="+"<?php echo $this->mid?>";
      })
</script>

