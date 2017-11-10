<?php
$circular = !empty($_GET['circular'])?$_GET['circular']:1;//直圆角

?>
<style>
    /*#template_table td{
        width:125px;
        height:52.5px;
        border:1px solid #ccc;
        border-radius: 8px;
    }*/
    .t_td{
        width:125px;
        height:52.5px;
        border:1px solid #ccc;
    <?php
         if($circular == 1){
             echo "border-radius: 8px;";
         }else{
             echo "border-radius: 0px;";
         }
     ?>
    }
    .topinput{
    	padding:5px;
    	height:20px;
    	width:30px;
    }
    td{text-align:center;background-color: #9a9797;color: white;}
.cannotselect{-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;-khtml-user-select:none;user-select:none;}
td.selected{background-color:#0094ff;color:#fff}
table{table-layout:fixed;word-break:break-all;}
    .my_td{
        <?php
            if($circular == 1){
                echo "border-radius: 8px;";
            }else{
                echo "border-radius: 0px;";
            }
        ?>

    }
</style>

<?php
    //最小单元格
    $width = !empty($_GET['width'])?$_GET['width']:250;//apk端 宽250	
    $height = !empty($_GET['height'])?$_GET['height']:105;//apk端 高105
    $cellspacing = !empty($_GET['cellspacing'])?$_GET['cellspacing']:20;//apk端 间距20
    $max_line = !empty($_GET['max_line'])?$_GET['max_line']:10;//最大列数目
    $max_column = !empty($_GET['max_column'])?$_GET['max_column']:6;//最大行数目
    $h_coord = !empty($_GET['h_coord'])?$_GET['h_coord']:0;//起始横坐标
    $v_coord = !empty($_GET['v_coord'])?$_GET['v_coord']:0;//起始纵坐标

?>
<div>
    有导航建议起始点x为110，y为70，无导航建议起始点x为0，y为0
</div>
<br>
<form  method="get">
起始坐标<input type="number" id="" class="form-input w100" name="h_coord" value="<?php echo $h_coord;?>" placeholder="横坐标">
--<input type="number" id="" class="form-input w100" name="v_coord" value="<?php echo $v_coord;?>" placeholder="纵坐标">&nbsp;&nbsp;
单元格宽度<input id="width" class="form-input topinput" type="text" name="width" value="<?php echo $width; ?>" />px&nbsp;&nbsp;
单元格高度<input id="height" class="form-input topinput" type="text" name="height" value="<?php echo $height; ?>" />px&nbsp;&nbsp;
单元格间距<input class="form-input topinput" type="text" name="cellspacing" value="<?php echo $cellspacing; ?>" />px&nbsp;&nbsp;
列数<input class="form-input topinput" type="text" name="max_line" value="<?php echo $max_line; ?>" />&nbsp;&nbsp;
行数<input class="form-input topinput" type="text" name="max_column" value="<?php echo $max_column; ?>" />&nbsp;&nbsp;
圆直角选择
    <select onchange="circular_change()" style="width:70px;height:20px;"  class="form-input w100" id="circular" name="circular">
        <option value="1" <?php if($circular==1){echo 'selected=selected';}; ?>  >圆角</option>
        <option value="2" <?php if($circular==2){echo 'selected=selected';}; ?>  >直角</option>
    </select>
<input type="hidden" value="-1" name="mid">
<input type="submit" class="btn" value="生成模板" />
</form>
<div style="background:url(/file/template/template_add_bg.jpg) no-repeat;width:1920px;padding-left:<?php echo $h_coord/2;?>px;padding-top:<?php echo $v_coord/2;?>px;min-height:394px;background-size: 960px 540px">
<table id="template_table" cellspacing="<?php echo $cellspacing/2;?>" style="width:<?php echo ($max_line*$width)/2+(($max_line-1)*$cellspacing)/2;?>px;">

    <?php
        for($a = 0 ; $a<$max_column ; $a++){
            echo "<tr>";
            for($b = 0 ; $b<$max_line ;$b++){
                $x = $b*($width+$cellspacing);
                $y = ($height+$cellspacing)*$a;
                $style_x = ($width/2)."px";
                $style_y = ($height/2)."px";
			
                echo "<td class='my_td' style='width:$style_x;height:$style_y;border:1px solid #9e9d9d;'>".$x."x".$y."</td>";
            }
            echo "</tr>";
        }
    ?>

</table>
</div>
<form action="" method="post" id="form1" enctype="multipart/form-data">
模板名称：<input id="name" name="name" type="text" class="form-input w150" /><br/>
上传缩略图：<input id="pic" type="file" class="form-input w400" value="" name="url"> <br/>
<input type="hidden" name="html" id="html" />

<input type="hidden" name="h_coord"  value="<?php echo $h_coord; ?>"/>
<input type="hidden" name="v_coord"  value="<?php echo $v_coord; ?>"/>
<input type="hidden" name="cellspacing"  value="<?php echo $cellspacing; ?>"/>
<input type="hidden" name="width" value="<?php echo $width; ?>"/>
<input type="hidden" name="cols"  value="<?php echo $max_line; ?>"/>
<input type="hidden" name="rows"  value="<?php echo $max_column; ?>"/>
<input type="hidden" name="height"  value="<?php echo $height; ?>"/>
<input type="hidden" name="circular"  value="<?php echo $circular; ?>"/>
<input type="button" value="保存模板" class="btn submit_btn" style="">
</form>
<script>
    //需要的样式
    //document.write('<style>.cannotselect{-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;-khtml-user-select:none;user-select:none;}td.selected{background:#0094ff;color:#fff}</style>');


    //jQuery表格单元格合并插件，功能和excel单元格合并功能一样，并且可以保留合并后的所有单元格内容到第一个单元格中
    $.fn.tableMergeCells = function () {
        //***请保留原作者相关信息
        //***power by showbo,http://www.w3dev.cn
        return this.each(function () {
            var tb = $(this), startTD, endTD, MMRC = { startRowIndex: -1, endRowIndex: -1, startCellIndex: -1, endCellIndex: -1 };
            //初始化所有单元格的行列下标内容并存储到dom对象中
            tb.find('tr').each(function (r) { $('td', this).each(function (c) { $(this).data('rc', { r: r, c: c }); }) });
            //添加表格禁止选择样式和事件
            tb.addClass('cannotselect').bind('selectstart', function () { return false });
            //选中单元格处理函数
            function addSelectedClass() {
                var selected = false,  rc,t;
                tb.find('td').each(function () {
                    rc = $(this).data('rc');
                    //判断单元格左上坐标是否在鼠标按下和移动到的单元格行列区间内
                    selected = rc.r >= MMRC.startRowIndex && rc.r <= MMRC.endRowIndex && rc.c >= MMRC.startCellIndex && rc.c <= MMRC.endCellIndex;
                    if (!selected && rc.maxc) {//合并过的单元格，判断另外3（左下，右上，右下）个角的行列是否在区域内
                        selected =
                            (rc.maxr >= MMRC.startRowIndex && rc.maxr <= MMRC.endRowIndex && rc.c >= MMRC.startCellIndex && rc.c <= MMRC.endCellIndex) ||//左下
                            (rc.r >= MMRC.startRowIndex && rc.r <= MMRC.endRowIndex && rc.maxc >= MMRC.startCellIndex && rc.maxc <= MMRC.endCellIndex) ||//右上
                            (rc.maxr >= MMRC.startRowIndex && rc.maxr <= MMRC.endRowIndex && rc.maxc >= MMRC.startCellIndex && rc.maxc <= MMRC.endCellIndex);//右下

                    }
                    if (selected)  this.className = 'selected';
                });
                var rangeChange = false;
                tb.find('td.selected').each(function () { //从已选中单元格中更新行列的开始结束下标
                    rc = $(this).data('rc');
                    t = MMRC.startRowIndex;
                    MMRC.startRowIndex = Math.min(MMRC.startRowIndex, rc.r);
                    rangeChange = rangeChange || MMRC.startRowIndex != t;

                    t = MMRC.endRowIndex;
                    MMRC.endRowIndex = Math.max(MMRC.endRowIndex, rc.maxr || rc.r);
                    rangeChange = rangeChange || MMRC.endRowIndex != t;

                    t = MMRC.startCellIndex;
                    MMRC.startCellIndex = Math.min(MMRC.startCellIndex, rc.c);
                    rangeChange = rangeChange || MMRC.startCellIndex != t;

                    t = MMRC.endCellIndex;
                    MMRC.endCellIndex = Math.max(MMRC.endCellIndex, rc.maxc || rc.c);
                    rangeChange = rangeChange || MMRC.endCellIndex != t;
                });
                //注意这里如果用代码选中过合并的单元格需要重新执行选中操作
                if (rangeChange) addSelectedClass();
            }
            function onMousemove(e) {//鼠标在表格单元格内移动事件
                e = e || window.event;
                var o = e.srcElement || e.target;
                if (o.tagName == 'TD') {
                    endTD = o;
                    var sRC = $(startTD).data('rc'), eRC = $(endTD).data('rc'), rc;
                    MMRC.startRowIndex = Math.min(sRC.r, eRC.r);
                    MMRC.startCellIndex = Math.min(sRC.c, eRC.c);
                    MMRC.endRowIndex = Math.max(sRC.r, eRC.r);
                    MMRC.endCellIndex = Math.max(sRC.c, eRC.c);
                    tb.find('td').removeClass('selected');
                    addSelectedClass();
                }
            }
            function onMouseup(e) {//鼠标弹起事件
                tb.unbind({ mouseup: onMouseup, mousemove: onMousemove });
         
                //if (startTD && endTD && startTD != endTD && confirm('确认合并？！')) {//开始结束td不相同确认合并
		if (startTD && endTD && confirm('确认合并？！')) {
                    var tds = tb.find('td.selected'), firstTD = tds.eq(0), index = -1, t, addBR
                        , html = tds.filter(':gt(0)').map(function () {
                        t = this.parentNode.rowIndex;
                        addBR = index != -1 && index != t;
                        index = t;
                        return (addBR ? '<br>' : '') + this.innerHTML
			//return (addBR ? endTD.innerHTML : '') ;
                    }).get().join(",");
                    tds.filter(':gt(0)').remove(); 
		    firstTD.append(','+ html.replace(/,(<br>)/g, '$1'));
		    var width=(MMRC.endCellIndex - MMRC.startCellIndex + 1)*<?php echo $width;?>+(MMRC.endCellIndex - MMRC.startCellIndex)*<?php echo $cellspacing;?>;
		    var height=(MMRC.endRowIndex - MMRC.startRowIndex + 1)*<?php echo $height?>+(MMRC.endRowIndex - MMRC.startRowIndex)*<?php echo  $cellspacing;?>;
		    //获取单元格右侧横坐标
			var tmp=firstTD.text().split("x");
			var x=parseInt(tmp[0])+width;
		    	//去除内容
			var text=firstTD.html();
			if(text.charAt(text.length-1)==","){
				text=text.substr(0,text.length-1);
			}
			firstTD.html("<p style='display:none'>"+text+"</p>");
		    //显示宽高
		    firstTD.append("宽高："+width+"x"+height);
		    var total_h=<?php echo $height/2;?>*(MMRC.endRowIndex - MMRC.startRowIndex+1)+(MMRC.endRowIndex - MMRC.startRowIndex)*<?php echo $cellspacing/2;?>;
		    var total_w=<?php echo $width/2;?>*(MMRC.endCellIndex - MMRC.startCellIndex + 1)+(MMRC.endCellIndex - MMRC.startCellIndex)*<?php echo $cellspacing/2;?>;
		    firstTD.height(total_h);
		    firstTD.width(total_w);

		    var sign =  $('#circular').val();
            if(sign == 2){
                firstTD.css('border-radius','0px');
            }else{
                firstTD.css('border-radius','8px');
            }
                    //更新合并的第一个单元格的缓存rc数据为所跨列和行
                    var rc = firstTD.attr({ colspan: MMRC.endCellIndex - MMRC.startCellIndex + 1, rowspan: MMRC.endRowIndex - MMRC.startRowIndex + 1 }).data('rc');
                    rc.maxc = rc.c + MMRC.endCellIndex - MMRC.startCellIndex; rc.maxr = rc.r + MMRC.endRowIndex - MMRC.startRowIndex;
                    firstTD.data('rc', rc);
		//添加背景色
		/*if(x<1620){
			firstTD.attr('bgcolor','#FF0000');
		}else{
			firstTD.attr('bgcolor','#0000FF');
		}*/
                }
                tb.find('td').removeClass('selected');
                startTD = endTD = null;
            }
            function onMousedown(e) {
                var o = e.target;
                if (o.tagName == 'TD') {
                    startTD = o;
                    tb.bind({ mouseup: onMouseup, mousemove: onMousemove });
                }
            }
            tb.mousedown(onMousedown);
        });
    };

	$("td").dblclick(function(e){

});


    $('table').tableMergeCells();

    function create(obj)
    {
//        console.log();
    }

    $('.submit_btn').click(function()
    {
//var html=$('#template_table').html();
//console.log(html);return false;
    	if(document.getElementById("name").value == null || document.getElementById("name").value == '')
    	{
    		layer.alert("请填入模板名称");
    		return false;
    	}
    	if(document.getElementById("pic").value == null || document.getElementById("pic").value == '')
    	{
    		layer.alert("请上传一张图片作为模板缩略图");
    		return false;
    	}
    	document.getElementById("html").value = $('#template_table').html();
    	$("#form1").submit();
        
    })

	function preview(){
        var tableInfo = "";
        var tableObj = document.getElementById("template_table");
        for (var i = 0; i < tableObj.rows.length; i++) {    //遍历Table的所有Row
            if(tableObj.rows[i].cells.length==0){

            }else{
		
                var html=tableObj.rows[i].innerHTML;
                if(tableObj.rows[i].cells.attr("colspan")&&tableObj.rows[i].cells.attr("rowspan")){
                    tableObj.rows[i].innerHTML=$(this).attr("colspan")*<?php echo $width;?>+"x"+$(this).attr("rowspan")*<?php echo $height;?>
                }else{
                    tableObj.rows[i].innerHTML=<?php echo $width?>+"x"+<?php echo $height?>;
                }
            }
        }
    }

    function circular_change()
    {
        var circular = $('#circular').val();
        if(circular == 2){
            $('.my_td').css('border-radius','0px');
        }else{
            $('.my_td').css('border-radius','8px');
        }
    }
</script>

