<script charset="utf-8" type="text/javascript" src="/js/jdate/jquery.datetimepicker.js"></script>
<link rel="stylesheet" href="/js/jdate/jquery.datetimepicker.css" />
<div class="mt10">
    <form action="">
        <input type="text" name="title"  class="form-input w100" value="<?php echo !empty($_GET['title'])?$_GET['title']:''?>" placeholder="请输入标题">
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
        <select class="form-input w100" id="type"><option value="0">请选择</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='电影'){echo "selected=selected"; } ?> value="电影" >电影</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='综艺'){echo "selected=selected"; } ?> value="综艺">综艺</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='新闻'){echo "selected=selected"; } ?> value="新闻">新闻</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='电视剧'){echo "selected=selected"; } ?> value="电视剧">电视剧</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='动漫'){echo "selected=selected"; } ?> value="动漫">动漫</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='教育'){echo "selected=selected"; } ?> value="教育">教育</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='体育'){echo "selected=selected"; } ?> value="体育">体育</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='音乐'){echo "selected=selected"; } ?> value="音乐">音乐</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='娱乐'){echo "selected=selected"; } ?> value="娱乐">娱乐</option>
            <option <?php $type=!empty($_GET['type'])?$_GET['type']:'';if($type=='监控'){echo "selected=selected"; } ?> value="监控">监控</option>
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
        <select name="flag" class="form-input w100" id="flag">
            <option value="0">上线</option>
            <option value="1" >下线</option>
        </select>
        <input class="btn btn1 btn-gray audit_search search " type="button" value="查找" name="" >
        <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
            <tr>
                <th>编号</th>
                <th>牌照方</th>
                <th>资产ID</th>
                <th>标题</th>
                <th>类型</th>
                <th>语言</th>
                <th>状态</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            <?php
                if(!empty($list)){
                    foreach($list as $k=>$v){
                        ?>
                        <tr>
                            <td><?php echo $v['id']?></td>
                            <td><?php
                                switch($v['cp']){
                                    case '642001':echo '华数';break;
                                    case 'BESTVOTT':echo '百视通';break;
                                    case 'ICNTV':echo '未来电视';break;
                                    case 'youpeng':echo '南传';break;
                                    case 'HNBB':echo '芒果';break;
                                    case 'CIBN':echo '国广';break;
                                    case 'YGYH':echo '银河';break;
                                }
                                ?></td>
                            <td><?php echo $v['vid']?></td>
                            <td><?php echo $v['title']?></td>
                            <td><?php echo $v['type']?></td>
                            <td><?php echo $v['language']?></td>
                            <td><?php echo $v['flag']?></td>
                            <td><?php echo $v['cTime']?></td>
                            <td>上线</td>
                        </tr>
                <?php
                    }
                }
            ?>
        </table>
    </form>
</div>
<div><?php echo $page;?>
<script>
    $('.search').click(function(){
        //alert(1)
        var title = $('input[name=title]').val();
        var cp = $('#cp').val();
        var type = $('#type').val();
        var mid = "<?php echo $this->mid?>";
        //var nid = "<?php echo !empty($_REQUEST['nid'])?$_REQUEST['nid']:''?>";
        window.location.href="/version/contentdata/index?mid="+mid+"&type="+type+"&cp="+cp+"&title="+title;
    })
</script>

