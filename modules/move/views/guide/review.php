<style>
    .chose{background-color: #0a0a0a}
</style>
<div>
    <input type="button" class="btn chose" value="待审核">
    <input type="button" class="btn acbtn gray" value="已通过">
    <input type="button" class="btn nobtn gray" value="不通过">
    <input type="button" class="btn btnall" value="全选" style="margin-left:100px">
    <input type="button" class="btn btnno" value="全不选">
    <input type="button" class="btn all" value="通过" style="float:right">
</div>
<div>
<div class="div1" style="display:block">
    <table id="tb" class="mtable mt10" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th>选择</th>
            <th>时间</th>
            <th>提交者</th>
            <th>标签</th>
            <th>导航</th>
            <th>类型</th>
            <th>操作类型</th>
            <th>标题</th>
            <th>action</th>
            <th>param</th>
            <th>图片</th>
            <th>通过</th>
            <th>不通过</th>
        </tr>
        <?php
            if(!empty($list)){
                foreach($list as $k=>$v){?>
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="id" value="<?php echo $v['gid']?>"></td>
                        <td><?php echo date('y-m-d h:i:s',$v['addTime']);?></td>
                        <td><?php echo $v['user'];?></td>
                        <td><?php echo $v['gname'];?></td>
                        <td><?php echo $v['name'];?></td>
                        <td><?php
                                if($v['tType']=='1'){
                                    echo '跳转牌照方客户端';
                                }else if($v['tType']=='3'){
                                    echo '应用商城';
                                }else if($v['tType']=='4'){
                                    echo '自有节目';
                                }else if($v['tType']=='5'){
                                    echo '全屏大图';
                                }else if($v['tType']=='6'){
                                    echo '二级专题页';
                                }else if($v['tType']=='7'){
                                    echo '咪咕音乐';
                                }else if($v['tType']=='8'){
                                    echo '咪咕视讯';
                                }else if($v['tType']=='9'){
                                    echo '咪咕学堂';
                                }else if($v['tType']=='10'){
                                    echo '糖果乐园';
                                }else if($v['tType']=='11'){
                                    echo '咪咕爱唱';
                                }else if($v['tType']=='12'){
                                    echo '和动漫';
                                }
                            ?></td>
                        <td><?php
                            switch($v['delFlag']){
                                case '1':echo '操作';break;
                                case '5':echo '删除';break;
                            }
                            ?></td>
                        <td><?php echo $v['title'];?></td>
                        <td><?php echo $v['action'];?></td>
                        <td width="200px"><a href="http://<?php echo $v['param'];?>"><marquee><?php echo $v['param'];?></marquee></a></td>
                        <td><?php
                                if($v['type']=='99'){
                                    echo '<img src="'.$v['pic'].'" width="100px" height="140px">';
                                }else{
                                    echo '<img src="'.$v['pic'].'" width="140px" height="100px">';
                                }
                            ?></td>
                        <td class="access">通过</td>
                        <td class="noac">不通过</td>
                        <input type="hidden" name="id" value="<?php echo $v['gid']?>">
                    </tr>
                <?php
                }
            }else{?>
                <tr>
                    <td colspan="12" align="center">暂无数据</td>
                </tr>
        <?php   }
        ?>

    </table>
</div>
<div class="div2" style="display:none">
    <table class="mtable mt10" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th>时间</th>
            <th>提交者</th>
            <th>标签</th>
            <th>导航</th>
            <th>类型</th>
            <th>操作类型</th>
            <th>标题</th>
            <th>action</th>
            <th>param</th>
            <th>图片</th>
        </tr>
        <?php
        if(!empty($aclist)){
            foreach($aclist as $k=>$v){?>
                <tr>
                    <td><?php echo date('y-m-d h:i:s',$v['addTime']);?></td>
                    <td><?php echo $v['user'];?></td>
                    <td><?php echo $v['gname'];?></td>
                    <td><?php echo $v['name'];?></td>
                    <td><?php
                        if($v['tType']=='1'){
                            echo '跳转牌照方客户端';
                        }else if($v['tType']=='3'){
                            echo '应用商城';
                        }else if($v['tType']=='4'){
                            echo '自有节目';
                        }else if($v['tType']=='5'){
                            echo '全屏大图';
                        }else if($v['tType']=='6'){
                            echo '二级专题页';
                        }else if($v['tType']=='7'){
                            echo '咪咕音乐';
                        }else if($v['tType']=='8'){
                            echo '咪咕视讯';
                        }else if($v['tType']=='9'){
                            echo '咪咕学堂';
                        }else if($v['tType']=='10'){
                            echo '糖果乐园';
                        }else if($v['tType']=='11'){
                            echo '咪咕爱唱';
                        }else if($v['tType']=='12'){
                            echo '和动漫';
                        }
                        ?></td>
                    <td><?php
                            switch($v['delFlag']){
                                case '3':echo '操作';break;
                                case '6':echo '删除';break;
                            }
                            ?></td>
                    <td><?php echo $v['title'];?></td>
                    <td><?php echo $v['action'];?></td>
                    <td><a href="http://<?php echo $v['param'];?>"><?php echo $v['param'];?></a></td>
                    <td><?php
                        if($v['type']=='99'){
                            echo '<img src="'.$v['pic'].'" width="100px" height="140px">';
                        }else{
                            echo '<img src="'.$v['pic'].'" width="140px" height="100px">';
                        }
                        ?></td>
                </tr>
                <?php
            }
        }else{?>
            <tr>
                <td colspan="12" align="center">暂无数据</td>
            </tr>
        <?php   }
        ?>

    </table>
</div>
    <div class="div3" style="display:none">
        <table class="mtable mt10" cellpadding="10" cellspacing="0" width="100%">
            <tr>
                <th>时间</th>
                <th>提交者</th>
                <th>标签</th>
                <th>导航</th>
                <th>类型</th>
                <th>操作类型</th>
                <th>标题</th>
                <th>action</th>
                <th>param</th>
                <th>图片</th>
            </tr>
            <?php
            if(!empty($nolist)){
                foreach($nolist as $k=>$v){?>
                    <tr>
                        <td><?php echo date('y-m-d h:i:s',$v['addTime']);?></td>
                        <td><?php echo $v['user'];?></td>
                        <td><?php echo $v['gname'];?></td>
                        <td><?php echo $v['name'];?></td>
                        <td><?php
                            if($v['tType']=='1'){
                                echo '跳转牌照方客户端';
                            }else if($v['tType']=='3'){
                                echo '应用商城';
                            }else if($v['tType']=='4'){
                                echo '自有节目';
                            }else if($v['tType']=='5'){
                                echo '全屏大图';
                            }else if($v['tType']=='6'){
                                echo '二级专题页';
                            }else if($v['tType']=='7'){
                                echo '咪咕音乐';
                            }else if($v['tType']=='8'){
                                echo '咪咕视讯';
                            }else if($v['tType']=='9'){
                                echo '咪咕学堂';
                            }else if($v['tType']=='10'){
                                echo '糖果乐园';
                            }else if($v['tType']=='11'){
                                echo '咪咕爱唱';
                            }else if($v['tType']=='12'){
                                echo '和动漫';
                            }
                            ?></td>
                        <td><?php
                            switch($v['delFlag']){
                                case '4':echo '操作';break;
                                case '7':echo '删除';break;
                            }
                            ?></td>
                        <td><?php echo $v['title'];?></td>
                        <td><?php echo $v['action'];?></td>
                        <td><a href="http://<?php echo $v['param'];?>"><?php echo $v['param'];?></a></td>
                        <td><?php
                            if($v['type']=='99'){
                                echo '<img src="'.$v['pic'].'" width="100px" height="140px">';
                            }else{
                                echo '<img src="'.$v['pic'].'" width="140px" height="100px">';
                            }
                            ?></td>
                    </tr>
                    <?php
                }
            }else{?>
                <tr>
                    <td colspan="12" align="center">暂无数据</td>
                </tr>
            <?php   }
            ?>

        </table>
    </div>
</div>
<div class="over" style="display:none;position: absolute;left:400px;top:300px;background-color: gray;width:400px;height:300px" >
    <input type="text" class="form-input w300" name="message" value="" style="margin-top:100px;margin-left:55px">
    <input type="button" value="提交" class="btn sub">
</div>
<script>
    $('.access').click(function(){
        var gid = $(this).next().next().val();
        $.post('/move/guide/submit?mid=<?php echo $this->mid?>',{gid:gid},function(e){
            alert(e.msg);
            location.reload();
        },'json')
    })

    $('.btnall').click(function(){
        $(".div1 :checkbox").prop("checked", true);
    })
    $('.btnno').click(function(){
        $(".div1 :checkbox").prop("checked", false);
    })

    $('.noac').click(function(){
        $('.over').show();
        gid = $(this).next().val();
    })

    $('.sub').click(function(){
        var message = $('input[name=message]').val();
        $.post('/move/guide/noaccess?mid=<?php echo $this->mid?>',{message:message,gid:gid},function(e){
            alert(e.msg);
            location.reload();
        },'json')
    })
    $('.all').click(function(){
        var ids="";
        $("input[name='id']:checked").each(function() {

            ids += $(this).val()+' ';

        });
        $.post('/move/guide/allpost?mid=<?php echo $this->mid?>',{gid:ids},function(e){
            alert(e.msg);
            location.reload();
        },'json')
    })
    $('.chose').click(function(){
        $(this).removeClass('gray');
        $('.nobtn').addClass('gray');
        $('.acbtn').addClass('gray');
        $('.div1').show();
        $('.over').hide();
        $('.div2').hide();
        $('.div3').hide();
    })
    $('.acbtn').click(function(){
        $(this).removeClass('gray');
        $('.nobtn').addClass('gray');
        $('.chose').addClass('gray');
        $('.div1').hide();
        $('.over').hide();
        $('.div2').show();
        $('.div3').hide();
    })
    $('.nobtn').click(function(){
        $(this).removeClass('gray');
        $('.chose').addClass('gray');
        $('.acbtn').addClass('gray');
        $('.div1').hide();
        $('.over').hide();
        $('.div2').hide();
        $('.div3').show();
    })
</script>
<script type="text/javascript">
    function hb(){
        var tb = document.getElementById("tb");
        var count = <?php echo count($list)?>;
        for(var i=1;i<count;i++){
            var name = tb.rows[1].cells[4].innerHTML;
            var title = tb.rows[1].cells[3].innerHTML;
            var j =i+1;
            var name1 = tb.rows[j].cells[4].innerHTML;
            var title1 = tb.rows[j].cells[3].innerHTML;
            if(name==name1 && title==title1){
                tb.rows[j].removeChild(tb.rows[j].cells[12]);
                tb.rows[1].cells[12].rowSpan = (tb.rows[1].cells[12].rowSpan | 0) + 1;
                tb.rows[j].removeChild(tb.rows[j].cells[11]);
                tb.rows[1].cells[11].rowSpan = (tb.rows[1].cells[11].rowSpan | 0) + 1;
                tb.rows[j].removeChild(tb.rows[j].cells[4]);
                tb.rows[1].cells[4].rowSpan = (tb.rows[1].cells[4].rowSpan | 0) + 1;
                tb.rows[j].removeChild(tb.rows[j].cells[0]);
                tb.rows[1].cells[0].rowSpan = (tb.rows[1].cells[0].rowSpan | 0) + 1;
            }
        }

    }

    hb();

</script>
