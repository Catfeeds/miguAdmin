<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<style>
td{	padding-left:10px;font-size:14px;height:30px;width:150px}
.import{
	color:#C53336;
	}
.main_tb{
	border:1px solid #C9C9C9;
	border-collapse:collapse;
}
.main_tb tr{
	border:1px solid #C9C9C9;
}
.main_tb td{
	border:1px solid #C9C9C9;
}
.tb_player tr:nth-child(even){
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

<div style="height:20px;width:300px;float: left">元数据系统>元数据管理>被编辑的标题</div>
<a onclick="javascript:history.back(1);"href="#">
<div style="line-height:20px;text-align:center;height:20px;width:91px;float: right; background-image: url(/images/u1971.png);">
	<span style="font-size:13px;font-family: '微软雅黑 Bold', '微软雅黑 Regular', '微软黑雅';font-weight: 700;font-style: normal;color:#FFFFFF;">返回</span>
</div>
</a>
</div>
<div class="mt10" style="width:400px;margin-left:10px;">
    <form action="" method="post">
    <input type="hidden" name="vid" value="<?php echo !empty($vid)?$vid:''?>">
    <table class="main_tb" width="700px;" >
       <tr bgcolor="#A3BAD5">
       	<td colspan="4" style="text-align: center;font-size: 13px;color：#333333">基本信息</td>
       </tr>
        <tr bgcolor="#F0FDFF">
            <td class="import">资产名称:</td>
            <td colspan="3"><input  placeholder="请输入资产名称" type="text" name="title" class="form-input" style="width:520px;height:20px;"  value="<?php echo !empty($arr['title'])?$arr['title']:''?>" style="height:25px;line-height: 25px"></td>
        </tr>
        <tr>
            <td>内容类型:</td>
            <td style="width:175px;"><select name="ShowType" class="form-input" style="width:170px;height:20px;" id="ShowType" >
                    <option value="0">请选择</option>
                    <option <?php $ShowType=!empty($arr['ShowType'])?$arr['ShowType']:'';if($ShowType=='Movie'){echo "selected=selected"; }  ?> value="Movie" >Movie</option>
                    <option <?php $ShowType=!empty($arr['ShowType'])?$arr['ShowType']:'';if($ShowType=='Column'){echo "selected=selected"; } ?> value="Column">Column</option>
                    <option <?php $ShowType=!empty($arr['ShowType'])?$arr['ShowType']:'';if($ShowType=='News'){echo "selected=selected"; } ?> value="News">News</option>
                    <option <?php $ShowType=!empty($arr['ShowType'])?$arr['ShowType']:'';if($ShowType=='Series'){echo "selected=selected"; } ?> value="Series">Series</option>
                    <option <?php $ShowType=!empty($arr['ShowType'])?$arr['ShowType']:'';if($ShowType=='Collection'){echo "selected=selected"; } ?> value="Collection">Collection</option>
                   <!-- <option <?php /*$ShowType=!empty($arr['ShowType'])?$arr['ShowType']:'';if($ShowType=='Entertainment'){echo "selected=selected"; } */?> value="Entertainment">Entertainment</option>
                    <option <?php /*$ShowType=!empty($arr['ShowType'])?$arr['ShowType']:'';if($ShowType=='Comic'){echo "selected=selected"; } */?> value="Comic">Comic</option>
                    <option <?php /*$ShowType=!empty($arr['ShowType'])?$arr['ShowType']:'';if($ShowType=='Record'){echo "selected=selected"; } */?> value="Record">Record</option>
                    <option <?php /*$ShowType=!empty($arr['ShowType'])?$arr['ShowType']:'';if($ShowType=='Variety'){echo "selected=selected"; } */?> value="Variety">Variety</option>
                    <option <?php /*$ShowType=!empty($arr['ShowType'])?$arr['ShowType']:'';if($ShowType=='Sports'){echo "selected=selected"; } */?> value="Sports">Sports</option>
                    <option <?php /*$ShowType=!empty($arr['ShowType'])?$arr['ShowType']:'';if($ShowType=='Tourism'){echo "selected=selected"; } */?> value="Tourism">Tourism</option>
                    <option <?php /*$ShowType=!empty($arr['ShowType'])?$arr['ShowType']:'';if($ShowType=='Education'){echo "selected=selected"; } */?> value="Education">Education</option>-->
                </select></td>
             <td class="import">内容提供商:</td>
            <td><input type="text" name='cp' class="form-input w100" placeholder="请输入牌照方名称" style="width:155px;height:20px;" value="<?php  switch(!empty($arr['cp'])?$arr['cp']:''){
              case '642001':echo '华数';break;
                    case 'BESTVOTT':echo '百视通';break;
                    case 'ICNTV':echo '未来电视';break;
                    case 'youpeng':echo '南传';break;
                    case 'HNBB':echo '芒果';break;
                    case 'CIBN':echo '国广';break;
                    case 'YGYH':echo '银河';break;
//		            case 'poms':echo '咪咕';break;
              }?>" style="height:25px;line-height: 25px"></td>

        </tr>
        <tr style="height:90px;"  bgcolor="#F0FDFF">
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
            <div style="height:25px">
            <input  type="checkbox" name="type[]" value="电影" <?php if(in_array('电影',$arr['type'])) echo 'checked';?>>电影			
            <input style="margin-left: 20px"  type="checkbox" name="type[]" value="综艺" <?php if(in_array('综艺',$arr['type'])) echo 'checked';?>>综艺
			<input style="margin-left: 20px"  type="checkbox" name="type[]" value="新闻" <?php if(in_array('新闻',$arr['type'])) echo 'checked';?>>新闻
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="电视剧" <?php if(in_array('电视剧',$arr['type'])) echo 'checked';?>>电视剧
			<input style="margin-left: 6px" type="checkbox" name="type[]" value="动漫" <?php if(in_array('动漫',$arr['type'])) echo 'checked';?>>动漫
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="教育" <?php if(in_array('教育',$arr['type'])) echo 'checked';?>>教育
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="体育" <?php if(in_array('体育',$arr['type'])) echo 'checked';?>>体育
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="音乐" <?php if(in_array('音乐',$arr['type'])) echo 'checked';?>>音乐
			</div>
			 <div style="height:25px">
			<input  type="checkbox" name="type[]" value="娱乐" <?php if(in_array('娱乐',$arr['type'])) echo 'checked';?>>娱乐
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="健康" <?php if(in_array('健康',$arr['type'])) echo 'checked';?>>健康
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="旅游" <?php if(in_array('旅游',$arr['type'])) echo 'checked';?>>旅游
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="法制" <?php if(in_array('法制',$arr['type'])) echo 'checked';?>>法制
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="搞笑" <?php if(in_array('搞笑',$arr['type'])) echo 'checked';?>>搞笑
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="时尚" <?php if(in_array('时尚',$arr['type'])) echo 'checked';?>>时尚
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="军事" <?php if(in_array('军事',$arr['type'])) echo 'checked';?>>军事
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="财经" <?php if(in_array('财经',$arr['type'])) echo 'checked';?>>财经
			</div>
			 <div style="height:25px">
			<input  type="checkbox" name="type[]" value="曲艺" <?php if(in_array('曲艺',$arr['type'])) echo 'checked';?>>曲艺
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="奥运" <?php if(in_array('奥运',$arr['type'])) echo 'checked';?>>奥运
			<input style="margin-left: 20px" type="checkbox" name="type[]" value="纪实" <?php if(in_array('纪实',$arr['type'])) echo 'checked';?>>纪实
            </div>
            </td>
         </tr>
        <tr>
            <td class="import">单集多级选择</td>
            <td>单集：<input type="radio" name="simple_set" value="1" <?php if($arr['simple_set']== '1') echo 'checked';?>>
   多集：<input type="radio" name="simple_set" value="2" <?php if($arr['simple_set']=='2') echo 'checked';?>></td>
 
            <td class="import">模板选择:</td>
            <td id="template">
                <select style="height:20px;width:155px;" class="form-input" name="templateType" id="templateType" onchange="aa()">
                    <option value="0">请选择</option>
                    <option value="A" <?php if($arr['templateType']=='A') echo "selected=selected";?>>竖图单片模板(电影)</option>
                    <option value="B" <?php if($arr['templateType']=='B') echo "selected=selected";?>>多集数字模板（电视
剧）</option>
                    <option value="C" <?php if($arr['templateType']=='C') echo "selected=selected";?>>多集标题模板（综艺
）</option>
                    <option value="D" <?php if($arr['templateType']=='D') echo "selected=selected";?>>横图单片模板</option>
                    <option value="E" <?php if($arr['templateType']=='E') echo "selected=selected";?>>无模板（新闻）</option>
                <select>
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
            <td colspan="3" style="padding-top:5px;"><textarea placeholder="请输入影片看点"  name="info" cols="70" rows="5" class='info' style="border:1px solid #C9C9C9"><?php echo !empty($arr['info'])?$arr['info']:''?></textarea></td>
        </tr>
        <tr>
            <td>优先级:</td>
            <td><select style="width:170px;height:20px;" name="orders" class="form-input w100" id="orders">
                    <option value="0">请选择</option>
                    <option <?php if(!empty($extra['orders'])?$extra['orders']:'0'=='1'){echo "selected=selected"; } ?> value="1" >1</option>
                    <option <?php if(!empty($extra['orders'])?$extra['orders']:'0'=='2'){echo "selected=selected"; } ?> value="2">2</option>
                    <option <?php if(!empty($extra['orders'])?$extra['orders']:'0'=='3'){echo "selected=selected"; } ?> value="3">3</option>
                    <option <?php if(!empty($extra['orders'])?$extra['orders']:'0'=='4'){echo "selected=selected"; } ?> value="4">4</option>
                    <option <?php if(!empty($extra['orders'])?$extra['orders']:'0'=='5'){echo "selected=selected"; } ?> value="5">5</option>
                    <option <?php if(!empty($extra['orders'])?$extra['orders']:'0'=='6'){echo "selected=selected"; } ?> value="6">6</option>
                    <option <?php if(!empty($extra['orders'])?$extra['orders']:'0'=='7'){echo "selected=selected"; } ?> value="7">7</option>
                    <option <?php if(!empty($extra['orders'])?$extra['orders']:'0'=='8'){echo "selected=selected"; } ?> value="8">8</option>
                    <option <?php if(!empty($extra['orders'])?$extra['orders']:'0'=='9'){echo "selected=selected"; } ?> value="9">9</option>
                    <option <?php if(!empty($extra['orders'])?$extra['orders']:'0'=='10'){echo "selected=selected"; } ?> value="10">10</option>
                </select></td>
            <td class="import">首字母:</td>
            <td><input placeholder="请输入资产名称首字母" style="width:155px;height:20px;" type="text" name="initial" class="form-input w100" value="<?php echo !empty($arr['initial'])?$arr['initial']:''?>" style="height:25px;line-height: 25px"></td>
        </tr>
        <tr bgcolor="#F0FDFF">
            <td>国家地区:</td>
            <td><select style="width:170px;height:20px;" name="CountryOfOrigin" class="form-input w100" id="CountryOfOrigin">
                    <option value="0">请选择</option>
                    <option <?php if($arr['CountryOfOrigin']=='1'){echo "selected=selected"; } ?> value="1" >内地</option>
                    <option <?php if($arr['CountryOfOrigin']=='2'){echo "selected=selected"; } ?> value="2">港台</option>
                    <option <?php if($arr['CountryOfOrigin']=='3'){echo "selected=selected"; } ?> value="3">韩日</option>
                    <option <?php if($arr['CountryOfOrigin']=='4'){echo "selected=selected"; } ?> value="4">欧美</option>
                    <option <?php if($arr['CountryOfOrigin']=='5'){echo "selected=selected"; } ?> value="5">东南亚</option>
                    <option <?php if($arr['CountryOfOrigin']=='99'){echo "selected=selected"; } ?> value="99">其他</option>
                </select></td>
            <td>发行年份:</td>
            <td><input placeholder="请输入发行年份" style="width:155px;height:20px;" type="text" name="year" class="form-input w100" value="<?php echo !empty($arr['year'])?$arr['year']:''?>" style="height:25px;line-height: 25px"></td>
        </tr>
        <tr>
            <td>配音语言:</td>
            <td><input placeholder="请输入配音语言" style="width:170px;height:20px;" type="text" class="form-input w100" name="language" value="<?php echo !empty($arr['language'])?$arr['language']:''?>" style="height:25px;line-height: 25px"></td>
            <td>字幕语言:</td>
            <td><select style="width:155px;height:20px;" name="subtitles" class="form-input w100" id="subtitles">
                    <option value="0">请选择</option>
                    <option <?php $subtitles=!empty($extra['subtitles'])?$extra['subtitles']:'其他';if($subtitles=='中文'){echo "selected=selected"; } ?> value="中文" >中文</option>
                    <option <?php $subtitles=!empty($extra['subtitles'])?$extra['subtitles']:'其他';if($subtitles=='英文'){echo "selected=selected"; } ?> value="英文">英文</option>
                    <option <?php $subtitles=!empty($extra['subtitles'])?$extra['subtitles']:'其他';if($subtitles=='日语'){echo "selected=selected"; } ?> value="日语">日语</option>
                    <option <?php $subtitles=!empty($extra['subtitles'])?$extra['subtitles']:'其他';if($subtitles=='法语'){echo "selected=selected"; } ?> value="法语">法语</option>
                    <option <?php $subtitles=!empty($extra['subtitles'])?$extra['subtitles']:'其他';if($subtitles=='其他'){echo "selected=selected"; } ?> value="其他">其他</option>
                </select></td>
        </tr>
        <tr class='fen' bgcolor="#F0FDFF">
            <td class="dir">评分</td>
            <td><input placeholder="请输入评分,格式如6.2" style="width:170px;height:20px;" type="text" class="form-input w100" name="score" value="<?php echo !empty($arr['score'])?$arr['score']:''?>" style="height:25px;line-height: 25px;"></td>
            <td>清晰度</td>
            <td><input placeholder="请输入清晰度" style="width:155px;height:20px;" type="text" class="form-input w100"  style="height:25px;line-height: 25px;"></td>
        </tr>
        <!--<tr>
            <td>标签:</td>
            <td colspan="3"><input type="text" class="form-input w400" name="keyword" value="<?php echo !empty($arr['keyword'])?$arr['keyword']:''?>" style="height:25px;line-height: 25px;"></td>
        </tr>-->
        <tr>
            <td class="import">标签:</td>
            <td colspan="2" class="keyword"><?php echo !empty($arr['str'])?$arr['str']:''?></td><input type="hidden" class="form-input w400" name="keyword" value="<?php echo !empty($arr['keyword'])?$arr['keyword']:''?>" style="height:25px;line-height: 25px"></td>
            <td><input style='height:20px;width:100px;' type="button" class="btn key_btn" value="添加标签"></td>
        </tr>
        <tr bgcolor="#F0FDFF">
            <td>关键字:</td>
            <td colspan="3"><input style="width:520px;height:20px;"  placeholder="请输入关键字并以/分隔,例如：演员1/演员2/演员3" type="text" class="form-input" name="short" value="<?php echo !empty($arr['short'])?$arr['short']:''?>" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="num" >
            <td>更新集数:</td>
            <td ><input style="width:170px;height:20px;" type="text" class="form-input" name="num" value="<?php 
             if(!empty($list)){
                $delFlag = 1;
                $r = array_filter($list, function($t) use ($delFlag) {
                    return $t['delFlag'] == $delFlag;
                });
                echo count($r);
             }else{
                echo 0;
             }
             ?>" style="height:25px;line-height: 25px;"></td>
        
            <td>总集数:</td>
            <td ><input style="width:155px;height:20px;" type="text" class="form-input" name="total" value="<?php echo !empty($extra['total'])?$extra['total']:'0'?>" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="end" bgcolor="#F0FDFF">
            <td>是否完结:</td>
            <td colspan="3"><label for="noCharge"><input type="radio" name="end" id="noCharge" value="1" <?php $end=!empty($extra['end'])?$extra['end']:'2';if($end==1){ echo 'checked="checked"';}?>/>是</label>
                <label for="charge"><input type="radio" name="end" id="charge" value="2" <?php $end=!empty($extra['end'])?$extra['end']:'2';if($end==2){ echo 'checked="checked"';}?>/>否</label></td>
        </tr>
        <tr class="bftime" style="bftime">
            <td>播放时间:</td>
            <td><input placeholder="请输入播放时间" style="width:170px;height:20px;" type="text" class="form-input " name="bftime" value="<?php echo !empty($extra['bftime'])?$extra['bftime']:''?>" style="height:25px;line-height: 25px;"></td>
            <td>电视台:</td>
            <td><input placeholder="请输入电视台" style="width:155px;height:20px;" type="text" class="form-input " name="tvstation" value="<?php echo !empty($extra['tvstation'])?$extra['tvstation']:''?>" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="act" bgcolor="#F0FDFF">
            <td >导演:</td>
            <td colspan="3"><input placeholder="请输入导演名称" style="width:520px;height:20px;" type="text" class="form-input " name="director" value="<?php echo !empty($arr['director'])?$arr['director']:''?>" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="act" >
            <td >演员:</td>
            <td colspan="3"><input placeholder="请输入演员名称并以/分隔 如：演员1/演员2/演员3" style="width:520px;height:20px;" type="text" class="form-input /" name="actor" value="<?php echo !empty($arr['actor'])?$arr['actor']:''?>" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="pri" style="display:none">
            <td>奖项:</td>
            <td><input type="text" class="form-input w100" name="prize" value="<?php echo !empty($extra['prize'])?$extra['prize']:''?>" style="height:25px;line-height: 25px;"></td>
            <td>票房:</td>
            <td><input type="text" class="form-input w100" name="boxoffice" value="<?php echo !empty($extra['boxoffice'])?$extra['boxoffice']:''?>" style="height:25px;line-height: 25px;"></td>
        </tr>
        <tr class="com" bgcolor="#F0FDFF">
            <td>影评:</td>
            <td colspan="3"><input type="text" style="width:520px;height:20px;" class="form-input " name="comment" value="<?php echo !empty($extra['comment'])?$extra['comment']:''?>" style="height:25px;line-height: 25px;"></td>
        </tr>
         <tr bgcolor="#E2EEFB">
       	<td colspan="4" style="text-align: center;font-size: 13px;color：#333333">
       	
       		<input class="btn sub_btn" style="font-size:12px;font-family: '微软雅黑 Bold', '微软雅黑 Regular', '微软黑雅';font-weight: 700;font-style: normal;color:#FFFFFF;height：22px;width:120px;" type="submit"  value="保存基本信息" >
     
       		</td>
       </tr>
    </table>
    <div style="height:10px;"></div>
    <table width="700px" cellspacing="0" cellpadding="10" class="main_tb tb_player center media" >
    <tr bgcolor="#A3BAD5">
        <td colspan='7' align='center'>播放文件管理</td>
    </tr>
             <tr>
                    <td colspan='3' align="left">
                <input style="width:100px;height:20px;" type='button' class='btn coladd' value='添加'>
                    <input style="width:100px;height:20px;" type="button" value="批量上线" class="btn all_submit">
                    <input style="width:100px;height:20px;"	 type="button" value="批量默认播放" class="btn all_bf">
                    </td>
                    <td colspan='4'></td>
                </tr>
             <tr>
                    <td>序号</td>
                    <td>播放</td>
                    <td>媒体文件名称</td>
                    <td>创建时间</td>
<!--		    <td>播出时间</td>-->
                    <td>发布状态</td>
                    <td>操作</td>
                </tr>
                <?php
            if(!empty($list)){?>
               <?php
                   foreach ($list as $k => $v) {
                    ?>
                    <tr>
                        <input type="hidden" value="<?php echo $v['id'] ?>">
                        <td><input type="text" class="order" value="<?php echo $v['order'] ?>" style="width:20px"></td>
                        <td   class="mrbf mrbf-<?php echo $v['id']?>"><?php switch($v['bfflag']){
                            case '0':echo '';break;
                            case '1':echo '默认播放';break;
                        }?></td>
                        <td><input type="text" class="title" value="<?php echo $v['title']?>" style="width:200px"></td>
                        <td><div style="width：150px;"><?php echo date('Y-m-d', $v['cTime']) ?></div></td>
<!--			<td>--><?php // if($v['cp'] == 'poms'){echo $v['first_play_time'];}else{ echo $playtime;};?><!--</td>-->
                        <td><?php
                                if ($v['delFlag'] == '0') {
                                    echo '下线';
                                } else {
                                    echo '上线';
                                }
                            ?></td>
                        <td><?php
                            if($v['delFlag']=='0'){
                                echo '<a class="submit">上线</a>';
                            }else{
                                echo '<a class="submit">下线</a>';
                            }
                            ?>&nbsp;<a class="del">删除</a></td>
                    </tr>
                    <?php
                }
            }?>

    </table>
    <div style="height:10px"></div>
    <table width="700px" class="main_tb tb_player picture">
    	   <tr bgcolor="#A3BAD5">
        <td colspan='6' align='center'>图片信息</td>
    </tr>
        <tr>
          
            <td colspan="4">
                <div>
                    <input style="width:100px;height:20px" type="button" class="upload btn" value="图片上传">
                </div>
            </td>
        </tr>
        <tr>
            <td>图片类型</td>
            <td>图片文件</td>
            <td>创建时间</td>
            <td>操作</td>
        </tr>
        <?php if(!empty($pic)){
            foreach($pic as $key=>$val){?>
               <tr>
                   <input type="hidden" value="<?php echo $val->attributes['id']?>">
                    <td class="typepic"><select name="pictype" onchange="repic(this)" class="form-input w100" id="pictype">
                            <option value="0">请选择</option>
                            <option <?php $type=$val->attributes['type'];if($type=='1'){echo "selected=selected"; } ?> value="<?php echo $val->attributes['id']?>_1" >海报</option>
                            <option <?php $type=$val->attributes['type'];if($type=='2'){echo "selected=selected"; } ?> value="<?php echo $val->attributes['id']?>_2">推荐图</option>
                        </select></td>
                    <td><?php echo basename($val->attributes['url'])?></td>
                    <td><?php echo date('Y-m-d',$val->attributes['cTime'])?></td>
                    <td><a class="delete">删除</a></td>
                </tr>
            <?php
            }
        }?>
         <tr bgcolor="#E2EEFB">
       	<td colspan="4" style="text-align: center;font-size: 13px;color：#333333">
       	
       		<input class="btn" style="font-size:12px;font-family: '微软雅黑 Bold', '微软雅黑 Regular', '微软黑雅';font-weight: 700;font-style: normal;color:#FFFFFF;height：22px;width:120px;" type="submit"  value="保存资产信息" >
     
       		</td>
       </tr>
    </table>

    </form>
<!--	<div style="height:10px"></div>-->
<!--	<table width="700px" class="main_tb tb_player picture">-->
<!--		<tr bgcolor="#A3BAD5"><td align="center">资费信息</td></tr>-->
<!--		<tr><td align="center">--><?php //if($fee==1002381){echo "收费";}else{echo "免费";}?><!--</td></tr>-->
<!--	</table>-->
       <div style="height:10px"></div>
    <table width="700px" class="main_tb tb_player picture">
           <tr bgcolor="#A3BAD5">
        <td colspan='7' align='center'>审核记录</td>
    </tr>   <tr>
            <td>提交人</td>
            <td>提交时间</td>
            <td>状态</td>
            <td>审核人</td>
            <td>审核时间</td>
            <td>审核类型</td>
            <td>驳回理由</td>
        </tr>
        <?php
             if(!empty($reject)){
             ?>
        <tr>
            <td width="100" align="right"><?php echo $reject->attributes['user']?></td>
            <td width="100" align="right"><?php echo date("Y-m-d H:i:s",$reject->attributes['addTime'])?></td>
            <td width="100"align="right" ><?php echo '未通过'?></td>
            <td width="100"align="right" ><?php 
                        if(empty($reject->attributes['user5'])){
                            if(empty($reject->attributes['user4'])){
  				if(empty($reject->attributes['uer3'])){
					if(empty($reject->attributes['user2'])){
						echo $reject->attributes['user1'];
                        	        }else{
					 	echo $reject->attributes['user2'];
                                        }
                                }else{
 					echo $reject->attributes['user3'];
                                }
                            }else{
					echo $reject->attributes['user4'];
                            }
                        }else{
					echo $reject->attributes['user5'];
                         }

                        ?></td>
            <td width="100"align="right"><?php
                        if(empty($reject->attributes['addTime5'])){
                            if(empty($reject->attributes['addTime4'])){
                                if(empty($reject->attributes['addTime3'])){
                                        if(empty($reject->attributes['addTime2'])){
                                                echo date("Y-m-d H:i:s",$reject->attributes['addTime1']);
                                        }else{
                                                echo date("Y-m-d H:i:s",$reject->attributes['addTime2']);
                                        }
                                }else{
                                        echo date("Y-m-d H:i:s",$reject->attributes['addTime3']);
                                }
                            }else{
                                        echo date("Y-m-d H:i:s",$reject->attributes['addTime4']);
                            }
                        }else{
                                        echo date("Y-m-d H:i:s",$reject->attributes['addTime5']);
                         }

                        ?></td>
            <td width="100"align="right"><?php
 				echo '驳回';
                        ?></td>
            <td width="100" align="right"><?php
                      if($reject->attributes['flag']=='2'){
                        if(empty($reject->attributes['message5'])){
                            if(empty($reject->attributes['message4'])){
                                if(empty($reject->attributes['message3'])){
                                        if(empty($reject->attributes['message2'])){
                                                echo $reject->attributes['message1'];
                                        }else{
                                                echo $reject->attributes['message2'];
                                        }
                                }else{
                                        echo $reject->attributes['message3'];
                                }
                            }else{
                                        echo $reject->attributes['message4'];
                            }
                        }else{
                                        echo $reject->attributes['message5'];
                         }
                        }
                        ?></td>
        </tr>
         <?php   
            }
         ?>
    </table>
</div>
<script type="text/javascript">
     $('.key_btn').click(function(){
        var p =1;
        $.getJSON('<?php echo $this->get_url('content','keylist')?>',{p:p},function(d){
            if(d.code == 200){
                layer.open({
                    type: 1,
                    title:"添加标签",
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
        var type = '';
        $("input[name='type[]']:checked").each(function() {

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
        if(empty(initial)){
            alert("首字母不能为空");
            return false;
        }
        }
        if(empty(keyword)){
            alert("标签不能为空");
            return false;
        }
        if(!type){
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
        if(confirm("是否确认全部上线")){
        $.post("<?php echo $this->get_url('content','allsubmit') ?>",{vid:vid},function(d){
            location.reload();
        })
        }
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
        'sizeLimit': '10MB',//限制上传的图片不得超过200KB
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
               		title:"添加标签",
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
                    title:"上传图片",
                    skin: 'layui-layer-rim', //加上边框
                    area: ['700px', '460px'], //宽高
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
	if(confirm('你确定删除播放文件吗？')){
            $.post("<?php echo $this->get_url('content','del')?>",{id:id},function(d){
                location.reload();
            })
        }
        /*$.post("<?php echo $this->get_url('content','del')?>",{id:id},function(d){
            location.reload();
        })*/
    })
    $('.order').blur(function(){
        var order = $(this).val();
        var id = $(this).parent().parent().children('input').val();
        $.post("<?php echo $this->get_url('content','order')?>",{id:id,order:order},function(d){
            //location.reload();
        })
    }) 
    function repic(obj){
        var flag = obj.value;
        var vid = "<?php echo $_REQUEST['vid']?>";
        $.post("<?php echo $this->get_url('content','pictype') ?>",{vid:vid,flag:flag},function(d){
            location.reload();
        })
    }
    $('.delete').click(function(){
        var id = $(this).parent().parent().children('input').val();
	if(confirm('你确定删除海报吗？')){
            $.post("<?php echo $this->get_url('content','delete')?>",{id:id},function(d){
                location.reload();
            })
        }
        /*$.post("<?php echo $this->get_url('content','delete')?>",{id:id},function(d){
            location.reload();
        })*/
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
        console.log(templateType)
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
                    title:"添加媒体文件",
                    skin: 'layui-layer-rim', //加上边框
                    area: ['730px', '550px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })
    $('.picture td').dblclick(function(){
        var id = $(this).siblings('input').val();
        $.getJSON("<?php echo $this->get_url('content','pic')?>",{id:id},function(d){
            if(d.code==200){
                layer.open({
                    type: 1,
                    title:"添加标签",
                    skin: 'layui-layer-rim', //加上边框
                    area: ['530px', '600px'], //宽高
                    content: d.msg
                })
            }else{
                alert(msg);
            }
        })
    })
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
				}	})
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
        var type = '';
        $("input[name='type[]']:checked").each(function() {

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
            if(empty(initial)){
                alert("首字母不能为空");
                return false;
            }
        }
            if(empty(keyword)){
                alert("标签不能为空");
                return false;
            }
        if(!type){
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

