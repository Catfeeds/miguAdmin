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
        border-radius: 8px;
    }
    .topinput{
    	padding:5px;
    	height:20px;
    	width:30px;
    }
    td{text-align:center}
</style>

<?php
    //最小单元格
    $width = !empty($_GET['width'])?$_GET['width']:250;//apk端 宽250	
    $height = !empty($_GET['height'])?$_GET['height']:105;//apk端 高105
    $cellspacing = !empty($_GET['cellspacing'])?$_GET['cellspacing']:20;//apk端 间距20
    $max_line = !empty($_GET['max_line'])?$_GET['max_line']:10;//最大列数目
    $max_column = !empty($_GET['max_column'])?$_GET['max_column']:6;//最大行数目
?>
<form  method="get">
单元格宽度<input id="width" class="form-input topinput" type="text" name="width" value="<?php echo $width; ?>" />px&nbsp;&nbsp;
单元格高度<input id="height" class="form-input topinput" type="text" name="height" value="<?php echo $height; ?>" />px&nbsp;&nbsp;
单元格间距<input class="form-input topinput" type="text" name="cellspacing" value="<?php echo $cellspacing; ?>" />px&nbsp;&nbsp;
列数<input class="form-input topinput" type="text" name="max_line" value="<?php echo $max_line; ?>" />&nbsp;&nbsp;
行数<input class="form-input topinput" type="text" name="max_column" value="<?php echo $max_column; ?>" />&nbsp;&nbsp;
<input type="hidden" value="-1" name="mid">
<input type="submit" class="btn" value="生成模板" />
</form>
<table id="template_table" cellspacing="<?php echo $cellspacing/2;?>" style="width:<?php echo ($max_line*$width)/2+(($max_line-1)*$cellspacing)/2;?>px;padding-left:45px" background="http://117.144.248.58:8082/file/1507791890767920.jpg">

    <?php
        for($a = 0 ; $a<$max_column ; $a++){
            echo "<tr>";
            for($b = 0 ; $b<$max_line ;$b++){
                $x = $b*($width+$cellspacing);
                $y = ($height+$cellspacing)*$a;
                $style_x = ($width/2)."px";
                $style_y = ($height/2)."px";
			
                echo "<td style='width:$style_x;height:$style_y;border:1px solid #ccc;border-radius: 8px;'>".$x."x".$y."</td>";
            }
            echo "</tr>";
        }
    ?>

</table>
<form action="" method="post" id="form1" enctype="multipart/form-data">
模板名称：<input id="name" name="name" type="text" class="form-input w150" /><br/>
上传缩略图：<input id="pic" type="file" class="form-input w400" value="" name="url"> <br/>
<input type="hidden" name="html" id="html" />

<input type="hidden" name="cellspacing"  value="<?php echo $cellspacing; ?>"/>
<input type="hidden" name="width" value="<?php echo $width; ?>"/>
<input type="hidden" name="cols"  value="<?php echo $max_line; ?>"/>
<input type="hidden" name="rows"  value="<?php echo $max_column; ?>"/>
<input type="hidden" name="height"  value="<?php echo $height; ?>"/>
<input type="button" value="保存模板" class="btn submit_btn" style="">
</form>
<script>
    //需要的样式
    document.write('<style>.cannotselect{-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;-khtml-user-select:none;user-select:none;}td.selected{background:#0094ff;color:#fff}</style>');


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
		    var total_h=52.5*(MMRC.endRowIndex - MMRC.startRowIndex+1)+(MMRC.endRowIndex - MMRC.startRowIndex)*10;
		    var total_w=125*(MMRC.endCellIndex - MMRC.startCellIndex + 1)+(MMRC.endCellIndex - MMRC.startCellIndex)*10;
		    firstTD.height(total_h);
		    firstTD.width(total_w);
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
    		alert("请填入模板名称"); 
    		return false;
    	}
    	if(document.getElementById("pic").value == null || document.getElementById("pic").value == '')
    	{
    		alert("请上传一张图片作为模板缩略图"); 
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
</script>

