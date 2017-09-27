<?php //var_dump($_GET['top']);die;?>
<style>
        .layui-layer-dialog{
	min-width:340px;
}
.layui-layer-dialog .layui-layer-content{
	padding: 30px 20px 40px 70px;
}
.layui-layer-title{
	background:#A3BBD5;
	    padding: 0 20px 0 10px;
	    text-align: center
}
.layui-layer-content{
	background: #F1FDFF;
	
}
.layui-layer-btn{
	background: #F1FDFF;
}
.layui-layer-btn a{
	padding:0px;
	width:90px;
	height:20px;
	line-height:20px;
	background: url("/file/u116.png") no-repeat;
	border-radius: 2px;
}
.layui-layer-btn .layui-layer-btn1{
	background: url("/file/u1971.png") no-repeat;
	border-radius: 2px;
}
    .page{
        width:800px;
    }
    a{text-decoration:none}
    .status_back{
        display:none;
    }
    .yiji{
        width: 90px;
        height: 25px;
        background: inherit;
        background-color: rgba(201, 201, 201, 1);
        box-sizing: border-box;
        border-width: 1px;
        border-style: solid;
        border-color: rgba(161, 161, 161, 1);
        border-radius: 2px;
        -moz-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.349019607843137);
        -webkit-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.349019607843137);
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.349019607843137);
        color: #333333;
    }
    .erji{
        width: 90px;
        height: 25px;
        background: inherit;
        background-color: rgba(242, 242, 242, 1);
        box-sizing: border-box;
        border-width: 1px;
        border-style: solid;
        border-color: rgba(228, 228, 228, 1);
        border-radius: 2px;
        -moz-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.349019607843137);
        -webkit-box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.349019607843137);
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.349019607843137);
        color: #333333;
    }
    .edit{
        border-width: 0px;
        /*position: absolute;
        left: 0px;
        top: 0px;*/
        width: 20px;
        height: 20px;
        margin-top: 3px;
    }
    .dele{
        border-width: 0px;
        /*position: absolute;
        left: 0px;
        top: 0px;*/
        width: 20px;
        height: 20px;
        margin-top: 3px;
    }
    .menubox {
        padding-right: 8px;
        padding-left: 8px;
        margin-right: 15px;
        width:270px;
        min-height: 845px;
        float: left;
        overflow: hidden;
        background: #f7fbfc;
        border-bottom: 1px solid #c2d1d8;
        border-right: 1px solid #c2d1d8;
        -webkit-box-shadow: 1px 1px 0 0 #fff;
        box-shadow: 1px 1px 0 0 #fff;
    }
    .menubox ul li {
        border-bottom: 0px solid #d9e4ea;
    }

    .menubox ul li span {
        display: block;
    }

    .active{
        display:block;
    }
    .cur{
        display:block;
    }
    .edit{
        display:block;
        float:right;
    }
    .dele{
        display:block;
        float:right;
    }
    .inputDiv{width:200%px;}
    /*.inputDiv input{float:left;}*/
    .jiaoFlag{
        font-size:14px;
    }
    /*.down{
        background:#red;
    }*/
    .selected{
        /*background:#ccc;*/
    }
    .stationName{position: relative;}
    .site{margin-top:10px;}
    .one{width:24px;height:23px;}
    .two{width:25px;height:24px;float:left;margin-left:20px;}
    .yijiName{font-size:15px;height: 27px;line-height: 30px;}
    .menus ul li{height:30px;line-height: 30px;font-size: 14px;}
    .search_title {
        width: 64px;
        height: 30px;
    }
    .w100{width:80px;float:left;margin-right:3px;}
    .btn{float:left;margin-right:3px;}
    .page {
        /*float:left;*/
        width: 410px;
        height: 23px;
        line-height: 23px;
        /* margin: 0 auto; */
        text-align: center;
    }
    .admin_border{width:250%;overflow-x: scroll;}
    .inputDivTop{
        width: 66%;
        height:23px;
        float: left;
        background: #A3BAD5;
        padding: 6px 0px 3px 2px;
    }
    .inputDivTwo{padding: 5px 0px 6px 5px;}
    .dataInfo{
        color: black;
        float: right;
        font-size: 13px;
    }
    .page-ul-init li{ height:20px;}
</style>
<div class="left">
    <?php
    if($_SESSION['auth']=='1'){
        $nav = $this->getVersitelist();
    }else{
        $uid = $_SESSION['userid'];
        $nav = $this->getSitelist($uid);
    }
    //$nav = $this->getVersitelist();
    $admin = $this->getMvAdmin();
    $adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
    $adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
    $adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
    $adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
    ?>
    <div class="admin_left">
        <div class="menubox">
            <ul id="J_navlist">
                <?php
                //print_r($nav);
                if(!empty($nav)){
                $a = -1;
                foreach($nav as $n){
                if($n->pid == 0 && $n->type==0 && $n->protype==1){
                $a++;
                ?>
                <li class='site cur' >
                    <img src="/file/button/station_true.png" onclick="fun_one(this)" class="one">
                    <a><?php echo $n['name']?></a>
                </li>
                <span>
                            <ul>
                                <?php
                                $datas = VerSiteListManager::getList($n['id']);
                                if(!empty($datas)){
                                foreach($datas as $k=>$v){
                                if($v['name']=='栏目'){
                                ?>
                                <li class="<?php echo !empty($_GET['nid']) && $_GET['nid'] == $n['id']?'thismenu':''?> stationName">
                            <span>
                                <li class="menu">
<!--                                    <span >&nbsp;&nbsp;--><?php //echo $v['name'] ?><!--</span>-->
                                    <a gid="<?php echo $v['id'] ?>" class="guide yiji">添加一级</a>
                                    <ul>
                                <?php
                                $data = VerSiteListManager::getList($v['id']);
                                if(!empty($data)){
                                ?>
                                        <?php
                                        $leftGuideId = -1;
                                        $b = -1;
                                        foreach ($data as $val){
                                        $leftGuideId++;
                                        $b++;
                                        ?>
                                        <li>
                                                               <span>
                                <?php
                                $tmp = VerSiteListManager::getList($val['id']);
                                if (!empty($tmp)){
                                ?>
                                        <li class="menus">
                                           <span class='test active test-<?php echo $_REQUEST['nid']?>' >
                                               <!--&nbsp;&nbsp;&nbsp;&nbsp;--> <img src="/file/button/folder_true.png" onclick="fun_two(this)" class="two">
                                               <?php //echo $val['id'] ?>
                                               <a class='yijiName' href="<?php echo $val['url'] == '#' ? '#' : Yii::app()->createUrl($val['url'], array('mid' => $_GET['mid'], 'nid' => $val['id'], 'type' => $val['type'],'siteName'=>$n['name'],'top' => $val['name'],'pro'=>$admin['nickname'],'one'=>$a,'two'=>$b,'leftNavFlag'=>'1','adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName)) ?>"><?php echo $val['name'] ?></a>                                                &nbsp;&nbsp;
                                               <!--                                                <input type="button" des="--><?php //echo $val['id'] ?><!--" class="dele" value="删">-->
                                               <img src="/file/button/del.png" title="删除" des="<?php echo $val['id'];?>" class="dele" style="visibility:hidden;">
                                                &nbsp;&nbsp;
                                               <!--                                                <input type="button" des="--><?php //echo $val['id'] ?><!--" class="edit" value="编">-->
                                               <img src="/file/button/edit.png" title="编辑" des="<?php echo $val['id']?>" class="edit" style="visibility:hidden;">
                                                                                        <span style="display: block;float: right;margin-right: 20px;"><?php echo $val['id'];?></span>
                                                </span>
                                            <ul>
                                                <?php
                                                $c = -1;
                                                foreach ($tmp as $l) {
                                                $c++;
                                                ?>
                                                <li class='test2'><a <?php if ($_GET['nid'] == $l['id']) {
                                                        echo "class='selected'";
                                                    } ?> onclick='getData(this)'
                                                         href="<?php echo $l['url'] == '#' ? '#' : Yii::app()->createUrl($l['url'], array('mid' => $_GET['mid'],'siteName'=>$n['name'], 'nid' => $l['id'], 'son' => $l['name'], 'pro' => $admin['nickname'], 'top' => $val['name'],'type'=>$l['type'],'one'=>$a,'two'=>$b,'three'=>$c,'leftNavFlag'=>1,'adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName)) ?>">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $l['id'] ?><?php echo $l['name'] ?></a>&nbsp;&nbsp;
                                                    <!--                                                        <input type="button" des="--><?php //echo $l['id'] ?><!--" class="dele" value="删">&nbsp;&nbsp;-->
                                                    <!--                                                        <input type="button" des="--><?php //echo $l['id'] ?><!--" class="edit" value="编"></li>-->
                                                        <img src="/file/button/del.png" title="删除" des="<?php echo $l['id'];?>" class="dele" style="visibility:hidden;">
                                                                                    <img src="/file/button/edit.png" title="编辑" des="<?php echo $l['id'];?>" class="edit" style="visibility:hidden;">
                                                                                    <span style="display: block;float: right;margin-right: 20px;"><?php echo $l['id'];?></span>
                                                    <?php }
                                                    ?>
                                            </ul>
                                        </li>
                                    <?php
                                    } else {
                                        ?>
                                        <li class='test2'>
                                            <a href="<?php echo $val['url'] == '#' ? '#' : Yii::app()->createUrl($val['url'], array('mid' => $_GET['mid'], 'nid' => $val['id'],'type'=>$val['type'], 'epg' => $val['name'], 'pro' => $admin['nickname'],'adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName)) ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $val['id'] ?><?php echo $val['name'] ?></a>&nbsp;&nbsp;
                                            <!--                                            <input type="button" des="--><?php //echo $val['id'] ?><!--" class="dele" value="删">&nbsp;&nbsp;-->
                                            <!--                                            <input type="button" des="--><?php //echo $val['id'] ?><!--" class="edit" value="编">-->
                                            <img src="/file/button/del.png" title="删除" des="<?php echo $val['id'];?>" class="dele" style="visibility:hidden;">
                                                                                    <img src="/file/button/edit.png" title="编辑" des="<?php echo $val['id'];?>" class="edit" style="visibility:hidden;">
                                                                                    <span style="display: block;float: right;margin-right: 20px;"><?php echo $val['id'];?></span>
                                        </li>
                                    <?php }
                                    ?>
                                        <!--                                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a-->
                                        <!--                                                    gid="--><?php //echo $val['id'] ?><!--" class="guide erji">添加二级</a></li>-->
                                         <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img gid="<?php echo $val['id']?>" class="adderji" title="添加二级" src="/file/button/add_garden.png" style="float:right;"></li>
                            </span>

                </li>
                <?php }
                ?>
                <?php
                }
                }
                }
                ?>
            </ul>
            </li>
            <?php
            }else{?>
                <li><a href="<?php echo $v['url'] == '#'?'#':Yii::app()->createUrl($v['url'],array('mid'=>$_GET['mid'],'nid'=>$v['id'],'epg'=>$v['name'],'type'=>$v['type'],'pro'=>$admin['nickname'],'adminLeftNavFlag'=>1,'adminLeftOne'=>$adminLeftOne,'adminLeftTwo'=>$adminLeftTwo,'adminLeftOneName'=>$adminLeftOneName,'adminLeftTwoName'=>$adminLeftTwoName))?>"><?php echo $v['id']?><?php echo $v['name']?></a></li>
            <?php }
            ?>
            </span>
            </li>
            </ul>
            </span>

            <?php
            }
            }
            }else{
                ?>
                <li class="">
                </li>
                <?php
            }?>
            </ul>
            <script type="text/javascript" language="javascript">
                navList(12);
            </script>
        </div>
    </div>
</div>
<div style='margin-top:15px;' class='infoTop'>&nbsp;&nbsp;
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;echo '>';?></span>
    <span><?php if(!empty($_GET['siteName'])){echo $_GET['siteName'];echo '>';}?></span>
    <span><?php if(!empty($_GET['top'])){echo $_GET['top'];}?></span>
    <span><?php if(!empty($_GET['son'])){echo '>'.$_GET['son'];}?></span>
</div>
<div class="mt10" style="float:left;width:1280px;/*overflow-x: scroll;*/">
    <div class="inputDiv">
        <div class="inputDivTop">
            <input  style="width:100px;height:18px;" type="text" name="titleSearch" value="<?php echo !empty($_GET['title'])?$_GET['title']:'';?>" class="form-input w100" placeholder="输入标题查找">
            <select class="form-input w100" id="s_btnchange" style="width:70px;height:20px;" <!--onchange="s_btnchange()-->">
                <option  value="0" <?php $status = !empty($_REQUEST['status'])?$_REQUEST['status']:''; if($status =='3'){echo 'selected=selected';}?>>选择状态</option>
                <option  value="1" <?php $status = !empty($_REQUEST['status'])?$_REQUEST['status']:''; if($status =='1'){echo 'selected=selected';}?>>筛选上线</option>
                <option  value="2" <?php $status = isset($_REQUEST['status'])?$_REQUEST['status']:''; if($status =='0'){echo 'selected=selected';}?>>筛选下线</option>
            </select>

            <!--<select class="form-input w100" id="cp" style="width:70px;height:20px;">
                <option  value="0">选择CP</option>
                <?php
                $sql = "select cp from yd_video group by cp";
                $resCp = SQLManager::queryAll($sql);
                $selectedCp = !empty($_GET['cp'])?$_GET['cp']:'0';
                if(!empty($resCp)){
                    foreach ($resCp as $k=>$v){
                        switch ($v['cp'])
                        {
                            case '642001':$cpName = '华数';break;
                            case 'BESTVOTT':$cpName = '百视通';break;
                            case 'ICNTV':$cpName = '未来电视';break;
                            case 'youpeng':$cpName = '南传';break;
                            case 'HNBB':$cpName = '芒果';break;
                            case 'CIBN':$cpName = '国广';break;
                            case 'YGYH':$cpName = '银河';break;
			    case "poms":$cpName="咪咕";break;
                        }
                        if($selectedCp == $v['cp']){
                            echo "<option value='".$v['cp']."' selected=selected>".$cpName."</option>";
                        }else{
                            echo "<option value='".$v['cp']."'>".$cpName."</option>";
                        }
                    }
                }
                ?>
            </select>-->
		<?php
			$selectedCp = !empty($_GET['cp'])?$_GET['cp']:'0';
		?>
		<select class="form-input w100" id="cp" style="width:70px;height:20px;">
			<option value="0" <?php if($selectedCp=="0"){echo "selected=selected";}?>>选择CP</option>
			<option value="642001" <?php if($selectedCp=="642001"){echo "selected=selected";}?>>华数</option>
			<option value="BESTVOTT" <?php if($selectedCp=="BESTVOTT"){echo "selected=selected";}?>>百事通</option>
			<option value="ICNTV" <?php if($selectedCp=="ICNTV"){echo "selected=selected";}?>>未来电视</option>
			<option value="youpeng" <?php if($selectedCp=="youpeng"){echo "selected=selected";}?>>南传</option>
			<option value="HNBB" <?php if($selectedCp=="HNBB"){echo "selected=selected";}?>>芒果</option>
			<option value="CIBN" <?php if($selectedCp=="CIBN"){echo "selected=selected";}?>>国广</option>
			<option value="YGYH" <?php if($selectedCp=="YGYH"){echo "selected=selected";}?>>银河</option>
			<option value="poms" <?php if($selectedCp=="poms"){echo "selected=selected";}?>>咪咕</option>
		</select>

            <input type="button" class="btn search_title" value="查找" style="width:50px;height:20px;margin-left: 5px;">
            <!--<span class="dataInfo"><?php //echo $cou;?></span>-->
            <!--<span class="dataInfo">条数:</span>-->
            <!--<span class="dataInfo" style="margin-right: 10px;"><?php //echo $onlie;?></span>-->
            <!--<span class="dataInfo">上线:</span>-->
            <!--<input type="button" class="btn page_btn" value="go" style='float:right'>
            <input type="text" class="form-input w100" value="" name="pagenum" placeholder="输入页码跳转" style='float:right;height: 20px;margin-top: 6px;'>-->
            <?php echo $page;?>

            <!--<span class="dataInfo">总条数:</span>
            <span class="dataInfo"><?php //echo $cou;?></span>
            <span class="dataInfo">已上线:</span>
            <span class="dataInfo"><?php //echo $onlie;?></span>-->

        </div>


        <div style="width:66%;height: 30px;float:left;margin-top:0px;background:#f0fdff;border:#ccc" class="inputDivTwo">
            <?php
            if(in_array('2',$res['status']) || $_SESSION['auth']=='1'){
                ?>
                <input style='width:70px;height:30px;' value='保存排序' type='button' class='btn btn_order'>
                <input style='width:70px;height:30px;' value='全选' type='button' class='btn allTrue'>
                <input style='width:70px;height:30px;' value='反选' type='button' class='btn allNotTrue'>
                <input style='width:70px;height:30px;' value='上线' type='button' class='btn allOnline'>
                <input style='width:70px;height:30px;' value='下线' type='button' class='btn allNotOnline'>
                <input style='width:70px;height:30px;' value='全部上线' type='button' class='btn allSubmit'>
                <?php
            }else if(in_array('3',$res['status'])){
                ?>
                <input style='width:70px;height:30px;' value='保存排序' type='button' class='btn'>
                <input style='width:70px;height:30px;' value='全选' type='button' class='btn'>
                <input style='width:70px;height:30px;' value='反选' type='button' class='btn'>
                <input style='width:70px;height:30px;' value='上线' type='button' class='btn'>
                <input style='width:70px;height:30px;' value='下线' type='button' class='btn'>
                <input style='width:70px;height:30px;' value='全部上线' type='button' class='btn'>
                <?php
            }
            ?>

            <?php
            if(!empty($_REQUEST['type'])){
                if($_REQUEST['type']=='2'){
                    ?>
                    <?php
                    if(in_array('1',$res['status']) || $_SESSION['auth']=='1'){
                        ?>
                        <input type="button" style='width:70px;height:30px;' class="btn first_add" value="添加">
                        <input type="button" style='width:70px;height:30px;' class="btn shai_btn" value="筛选条件">
                        <?php
                    }else if(in_array('3',$res['status'])){
                        ?>
                        <input type="button" style='width:70px;height:30px;' class="btn" value="添加">
                        <input type="button" style='width:70px;height:30px;' class="btn" value="筛选条件">
                        <?php
                    }
                    ?>
                    <?php
                }else{
                    ?>
                    <?php
                    if(in_array('1',$res['status']) || $_SESSION['auth']=='1' ){
                        ?>
                        <input type="button" style='width:70px;height:30px;' class="btn add" value="添加">
                        <input type="button" style='width:70px;height:30px;'class="btn classify_btn" value="分类条件">
                        <select class="form-input w100" id="change" onchange="change()">
                            <option <?php if($type=='0'){echo "selected=selected";}?> value="0">竖版</option>
                            <option <?php if($type=='1'){echo "selected=selected";}?> value="1">横版</option>
                            <option <?php if($type=='2'){echo "selected=selected";}?> value="2">文字版</option>
			    <option value="3" <?php if($type=='3'){echo "selected=selected";}?>>公网列表</option>
			    <option value="4" <?php if($type=='4'){echo "selected=selected";}?>>公网列表(带推荐位)</option>
			    <option value="5" <?php if($type=='5'){echo "selected=selected";}?>>公网列表(少儿)</option>
                        </select>
                        <?php
                    }else if(in_array('3',$res['status'])){
                        ?>
                        <input type="button" style='width:70px;height:30px;' class="btn" value="添加" >
                        <input type="button" style='width:70px;height:30px;' class="btn" value="分类条件" id="">
                        <select class="form-input w100" id="change">
                            <option <?php if($type=='0'){echo "selected=selected";}?> value="0">竖版</option>
                            <option <?php if($type=='1'){echo "selected=selected";}?> value="1">横版</option>
                            <option <?php if($type=='2'){echo "selected=selected";}?> value="2">文字版</option>
			    <option value="3" <?php if($type=='3'){echo "selected=selected";}?>>公网列表</option>
                            <option value="4" <?php if($type=='4'){echo "selected=selected";}?>>公网列表(带>推荐位)</option>
                            <option value="5" <?php if($type=='5'){echo "selected=selected";}?>>公网列表(少>儿)</option>
                        </select>
                        <?php
                    }
                    ?>
                    <?php
                }
            }else{
                ?>
                <?php
                if(in_array('1',$res['status']) || $_SESSION['auth']=='1'){
                    ?>

                    <input type="button" style='width:70px;height:30px;' class="btn add" value="添加">
                    <input type="button" style='width:70px;height:30px;'class="btn classify_btn" value="分类条件">
                    <select class="form-input w100" id="change" onchange="change()">
                        <option <?php if($type=='0'){echo "selected=selected";}?> value="0">竖版</option>
                        <option <?php if($type=='1'){echo "selected=selected";}?> value="1">横版</option>
                        <option <?php if($type=='2'){echo "selected=selected";}?> value="2">文字版</option>
		  	<option value="3" <?php if($type=='3'){echo "selected=selected";}?>>公网列表</option>
                            <option value="4" <?php if($type=='4'){echo "selected=selected";}?>>公网列表(带>推荐位)</option>
                            <option value="5" <?php if($type=='5'){echo "selected=selected";}?>>公网列表(少>儿)</option>
                    </select>
                    <?php
                }else  if(in_array('3',$res['status'])){
                    ?>

                    <input type="button" style='width:70px;height:30px;' class="btn" value="添加">
                    <input type="button" style='width:70px;height:30px;'class="btn" value="分类条件">
                    <select class="form-input w100" id="change">
                        <option <?php if($type=='0'){echo "selected=selected";}?> value="0">竖版</option>
                        <option <?php if($type=='1'){echo "selected=selected";}?> value="1">横版</option>
                        <option <?php if($type=='2'){echo "selected=selected";}?> value="2">文字版</option>
			<option value="3" <?php if($type=='3'){echo "selected=selected";}?>>公网列表</option>
                            <option value="4" <?php if($type=='4'){echo "selected=selected";}?>>公网列表(带>推荐位)</option>
                            <option value="5" <?php if($type=='5'){echo "selected=selected";}?>>公网列表(少>儿)</option>
                    </select>
                    <?php
                }
                ?>

                <?php
            }
            ?>

            &nbsp;&nbsp;&nbsp;&nbsp;


        </div>

    </div>

    <form action="" class='content'>
        <table width="66%" cellspacing="0" cellpadding="10" class="mtable center" style="overflow-x: scroll">
            <input type="hidden" name="gid" value="<?php echo $gid?>">
            <tr>
                <th></th>
                <th>编号</th>
                <th>牌照方</th>
                <th>资产ID</th>
                <th>标题</th>
                <th>语言</th>
                <th>计费说明</th>
                <th>编入时间</th>
                <th>发布时间</th>
                <!--<th>状态码</th>-->
                <th>状态</th>
                <!--<th>操作</th>-->
            </tr>
            <?php
            if(!empty($list)){
                foreach($list as $l){?>
                    <tr class='trData <?php
                    if($l['vstatus'] == '0'){
                        echo " downS' style='color:red;'";
                    }else{
                        echo " up";
                    }
                    ?>'>
                        <input type="hidden" value="<?php echo $l['cid']?>">
                        <td><input type="checkbox" class="checkbox" name="id" value="<?php echo $l['cid']?>"></td>
                        <td><input type="text" class="order" name="order" value="<?php echo $l['orders']?>" style="width:20px"></td>
                        <td>
                            <?php
                            switch($l['cp']){
                                case '642001':echo '华数';break;
                                case 'BESTVOTT':echo '百视通';break;
                                case 'ICNTV':echo '未来电视';break;
                                case 'youpeng':echo '南传';break;
                                case 'HNBB':echo '芒果';break;
                                case 'CIBN':echo '国广';break;
                                case 'YGYH':echo '银河';break;
				case "poms":echo "咪咕";break;
                            }
                            ?>
                        </td>
                        <td class='changevid'><?php echo $l['vid']?></td>
                        <td><?php echo $l['title']?></td>
                        <td><?php echo $l['language']?></td>
                        <td><?php if($l['prdpack_id']=="1002381"){echo "收费";}elseif($l['prdpack_id']=="1002261"){echo "免费";}?></td>
                        <td><?php echo date('Y-m-d H:i',$l['vTime'])?></td>
                        <td><?php if(!empty($l['updateTime'])){
                                echo date('Y-m-d H:i',$l['updateTime']);
                            }?></td>
                        <!--<td><?php //echo $l['vstatus'];?></td>-->
                        <td class="shaixuan"><?php
				//echo $l['vstatus'];
                            if($l['vstatus']==0){
                                echo '已下线';
                            }else if($l['vstatus']==1){
                                echo '已上线';
                            }
                            ?></td>
<!--                        <td>--><?php
//                            if(in_array('2',$res['status']) || $_SESSION['auth']=='1'){
//				if($l['vstatus']==0){
//                                echo "<a class='status_true'>上线&nbsp;</a><a onclick=\"alert('下线失败！')\">下线&nbsp;</a>";
//				}else if($l['vstatus']==1){
//                                echo "<a onclick=\"alert('上线失败！')\">上线&nbsp;</a><a class='status_false'>下线&nbsp;</a>";
//                                }
//                            }else{
//                                echo "<a>上线&nbsp;</a><a>下线&nbsp;</a>";
//                            }
//                            ?>
<!--                        </td>-->
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </form>
</div>
<script>
    <?php
    if(empty($_GET['leftNavFlag'])){
        echo "$('.mt10').hide();$('.infoTop').hide();";
    }
    ?>
    $('.inputDivTwo').children('input').eq(6).css('float','right');
    $('.inputDivTwo').children('input').eq(7).css('float','right');
    $('.allSubmit').click(function(){
        var gid = "<?php echo $_REQUEST['nid'];?>";
        var type = "<?php echo !empty($_REQUEST['type'])?$_REQUEST['type']:'';?>";
        $.post("<?php echo $this->get_url('site','allsubmit')?>",{gid:gid,type:type},function(d){
            alert('除内容库、一级分类下线项目，其余均已上线成功！');
            setTimeout(location.reload(),2000);
        })
    });

    $('.page_btn').click(function(){
        var num = $('input[name=pagenum]').val();
        var test = window.location.href;
        window.location.href=test+"&page="+num;
    });

    $('.selected').parent('li').css('background','#A3bAD5');
    function getData(obj)
    {
        var url = $(obj).attr('href');

    }

    $('.test').mousemove(function()
    {
        $(this).children('img').eq(1).css({"visibility":"visible"});
        $(this).children('img').eq(2).css({"visibility":"visible"});
    });

    $('.test').mouseout(function()
    {
        $(this).children('img').eq(1).css({"visibility":"hidden"});
        $(this).children('img').eq(2).css({"visibility":"hidden"});;
    });

    $('.test2').mousemove(function()
    {
        $(this).children('img').eq(0).css({"visibility":"visible"});
        $(this).children('img').eq(1).css({"visibility":"visible"});
    });

    $('.test2').mouseout(function()
    {
        $(this).children('img').eq(0).css({"visibility":"hidden"});
        $(this).children('img').eq(1).css({"visibility":"hidden"});
    });
    function yiji()
    {
        var maxAddYiJi = $('.menu').find('.yiji').length;
//            console.log(maxAddYiJi);
        if(maxAddYiJi>0){
            for(var i = 0 ; i<maxAddYiJi; i++){
                var gid = $('.menu').find('.yiji').eq(i).attr('gid');
                $('.stationName').eq(i).append('<img gid="'+gid+'" title="添加一级" class="addyiji" style="position: absolute;top:-19px;left:250px;" src="/file/button/add_garden.png">');
                $('.stationName').eq(i).children('span').eq(0).remove();
            }
            $('.menu').find('.yiji').remove();
        }
    }
    yiji();

    $('a').css('text-decoration','none');


    function fun_one(obj)
    {
        var $_this = $(obj).parent().next('span').children('ul').find('.menu').children('ul');
        if($_this.css('display')=='block'){
            $(obj).attr('src','/file/button/station_false.png');
            $_this.slideUp(200).children('li');
        }else{
            $_this.slideDown(200).children('li');
            $(obj).attr('src','/file/button/station_true.png');
        }
    }

    function fun_two(obj)
    {
        var $_this = $(obj).parent().next('ul');
        if($_this.css('display')=='block'){
            $(obj).attr('src','/file/button/folder_false.png');
            $_this.slideUp(100).children('li');
        }else{
            $(obj).attr('src','/file/button/folder_true.png');
            $_this.slideDown(100).children('li');
        }
    }

    var leftNavFlag = "<?php echo !empty($_GET['leftNavFlag'])?$_GET['leftNavFlag']:'0';?>";
    if(leftNavFlag=='0'){
        var max = $('.one').length;
        for(var i = 0 ; i<max ; i++){
            var $_thisOne = $('.one').eq(i).parent().next('span').children('ul').find('.menu').children('ul');
            $('.one').eq(i).attr('src','/file/button/station_false.png');
            $_thisOne.slideUp(100).children('li');

            var maxTwo = $('.one').eq(i).parent().next('span').children().find('.menu').find('.two').length;
            var $_this = $('.one').eq(i).parent().next('span').children().find('.menu').find('.two');
            for(var j = 0 ; j< maxTwo ; j++){
                $_this.attr('src','/file/button/folder_false.png');
                $_this.parent().next('ul').slideUp(100).children('li');
            }
        }
    }else{
        var oneId = "<?php echo !empty($_GET['one'])?$_GET['one']:'0';?>";
        var twoId = "<?php echo !empty($_GET['two'])?$_GET['two']:'0';?>";
        var threeId = "<?php echo !empty($_GET['three'])?$_GET['three']:'0';?>";
        var max = $('.one').length;
        for(var i = 0 ; i<max ; i++){
            var $_thisOne = $('.one').eq(i).parent().next('span').children('ul').find('.menu').children('ul');
            if(i == oneId){
                $('.one').eq(oneId).attr('src','/file/button/station_true.png');
                $_thisOne.slideDown(100).children('li');

            }else{
                $('.one').eq(i).attr('src','/file/button/station_false.png');
                $_thisOne.slideUp(100).children('li');
            }

            var $_this = $('.one').eq(i).parent().next('span').children().find('.menu').find('.two');
            var maxTwo = $('.one').eq(i).parent().next('span').children().find('.menu').find('.two').length;
            for(var j = 0 ; j< maxTwo ; j++){
               var obj = $_this[j]
		if(j == twoId){
		  
                    $_this.eq(j).attr('src','/file/button/folder_true.png');
                    $_this.eq(j).parent().next('ul').slideDown(100).children('li');
                }else{
                    $_this.eq(j).attr('src','/file/button/folder_false.png');
                    $_this.eq(j).parent().next('ul').hide();
                }
            }
        }
        <?php if(!isset($_GET['three'])){
        echo "$('.one').eq(oneId).parent().next('span').children().find('.menu').find('.two').eq(twoId).parent('span').css('background','#A3bAD5');";
    }?>



        checkTwo(twoId);
    }

    function checkTwo(twoId)
    {
        $('.selected').parent().parent('ul').slideDown(100).children('li');
        $('.selected').parent().parent('ul').prev('span').find('.two').attr('src','/file/button/folder_true.png');
    }

    $('.down').css('color','red');
    $('.checkbox').click(function()
    {
        var flag = $(this).attr('flag');
        if(flag && flag==1){
            $(this).attr('flag','0');
        }else{
            $(this).attr('flag','1');
        }
    })

    <?php
    $adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
    $adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
    $adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
    $adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
    ?>
    var adminLeftOne = "<?php echo $adminLeftOne;?>";
    var adminLeftTwo = "<?php echo $adminLeftTwo;?>";
    var adminLeftOneName = "<?php echo $adminLeftOneName;?>";
    var adminLeftTwoName = "<?php echo $adminLeftTwoName;?>";
    //$('.allTrue').click(function()
    $(document).on('click','.allTrue',function()
    {
        $(".mtable :checkbox").prop("checked", true);
        $(".mtable :checkbox").attr('flag','1');
    })

    //$('.allNotTrue').click(function()
    $(document).on('click','.allNotTrue',function()
    {
        $(".mtable :checkbox").each(function ()
        {
            $(this).prop("checked", !$(this).prop("checked"));
            //$(".mtable :checkbox").attr('flag','1');
            if($(this).prop("checked")){
                $(this).attr('flag','1');
            }else{
                $(this).attr('flag','0');
            }
        })
    })

    //$('.allOnline').click(function()
    $(document).on('click','.allOnline',function()
    {
        var flag = "<?php if(in_array('2',$res['status'])){echo 1;}?>";
        var auth = "<?php echo $admin['auth']?>";
        if(auth!='1'){
            if(flag!=1){
                return false;
            }
        }
        var maxTr = $('.trData').length;
        for(var i = 0; i < maxTr ; i++){
            var flag = $('.trData').eq(i).children('td').eq(0).children('input').attr('flag');
            if(flag == 1){
                var id = $('.trData').eq(i).children('td').eq(0).children('input').val();
                var vid = $('.trData').eq(i).children('td').eq(3).html();
                var type = "<?php echo !empty($_REQUEST['type'])?$_REQUEST['type']:'';?>";
                var status = 1;
                var mid = "<?php echo $this->mid;?>";
                $.ajax
                ({
                    type:'get',
                    url:'/version/site/changeStatus/mid/'+mid+'/id/'+id+'/status/'+status+'/vid/'+vid+'/type/'+type,
                    success:function(data)
                    {
                        if(data == 200){
                            window.location.reload();
                        }

                    }
                })
            }
        }
        setTimeout(alert('除内容库、一级分类下线项目，其余均已上线成功！'),2000)
    })

    //$('.allNotOnline').click(function()
    $(document).on('click','.allNotOnline',function()
    {
        var flag = "<?php if(in_array('2',$res['status'])){echo 1;}?>";
        var auth = "<?php echo $admin['auth']?>";
        if(auth!='1'){
            if(flag!=1){
                return false;
            }
        }
        var maxTr = $('.trData').length;
        for(var i = 0; i < maxTr ; i++){
            var flag = $('.trData').eq(i).children('td').eq(0).children('input').attr('flag');
            //alert(flag);return false;
            if(flag == 1){
                var id = $('.trData').eq(i).children('td').eq(0).children('input').val();
                var vid = $('.trData').eq(i).children('td').eq(3).html();
                var type = "<?php echo !empty($_REQUEST['type'])?$_REQUEST['type']:'';?>";
                var status = 0;
                var mid = "<?php echo $this->mid;?>";
                $.ajax
                ({
                    type:'get',
                    url:'/version/site/changeStatus/mid/'+mid+'/id/'+id+'/status/'+status+'/vid/'+vid+'/type/'+type,
                    success:function(data)
                    {
                        if(data == 200){
                            window.location.reload();
                        }

                    }
                })
            }
        }
        setTimeout(alert('除内容库、一级分类下线项目，其余均已下线成功！'),2000);
    })
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
    var fixedUrl = '/adminLeftOne/'+adminLeftOne+'/adminLeftTwo/'+adminLeftTwo+'/adminLeftOneName/'+adminLeftOneName+'/adminLeftTwoName/'+adminLeftTwoName+'/adminLeftNavFlag/'+adminLeftNavFlag+'/one/'+one+'/two/'+two+'/three/'+three+'/siteName/'+siteName+'/son/'+son+'/top/'+topName+'/leftNavFlag/'+leftNavFlag
    //$('.status_true').click(function()
    $(document).on('click','.status_true',function()
    {
        var flag = "<?php if(in_array('2',$res['status'])){echo 1;}?>";
        var auth = "<?php echo $admin['auth']?>"
        if(auth!='1'){
            if(flag!=1){
                return false;
            }
        }
        var status = 1;
        var id = $(this).parent().parent('tr').children('input').val();
        var vid = $(this).parent().parent('tr').children('.changevid').html();
        var type = "<?php echo !empty($_REQUEST['type'])?$_REQUEST['type']:'';?>";
        var mid = "<?php echo $this->mid;?>";
        var $_this = $(this);
        
	$.ajax
        ({
            type:'get',
            url:'/version/site/changeStatus/mid/'+mid+'/id/'+id+'/status/'+status+'/vid/'+vid+'/type/'+type,
            success:function(data)
            {  
                if(data == 200){
		    alert("上线成功！");
                    $_this.parent().parent().children('td').eq(9).text('已上线');
                    //$_this.parent().parent().removeClass('down');
	            window.location.reload()
                }else{
                    alert("未在内容库或一级分类上线");
		    window.location.reload()
                }
                //$_this.parent().find('.status_back').show();
            }
        })
    })

    //$('.status_false').click(function()
    $(document).on('click','.status_false',function()
    {
        var flag = "<?php if(in_array('2',$res['status'])){echo 1;}?>";
        var auth = "<?php echo $admin['auth']?>"
        if(auth!='1'){
            if(flag!=1){
                return false;
            }
        }
        var status = 0;
        var id = $(this).parent().parent('tr').children('input').val();
        var vid = $(this).parent().parent('tr').children('.changevid').html();
        var type = "<?php echo !empty($_REQUEST['type'])?$_REQUEST['type']:'';?>";
        var mid = "<?php echo $this->mid;?>";
        var $_this = $(this);
        $.ajax
        ({
            type:'get',
            url:'/version/site/changeStatus/mid/'+mid+'/id/'+id+'/status/'+status+'/vid/'+vid+'/type/'+type,
            success:function(data)
            {
                if(data == 200){
		    alert("下线成功！")
                    $_this.parent().parent().children('td').eq(9).text('已下线');
		     window.location.reload()
                }else{
                    alert("下线失败！");
		     window.location.reload()
                }
                //$_this.parent().find('.status_back').show();
            }
        })
    })

    $('.status_back').click(function()
    {
        var status = $(this).parent().parent().children('td').eq(8).text();
        if(status == '已上线' || status == '上线'){
            status=0;
        }else if(status == '已下线' || status == '下线'){
            status=1;
        }
        var id = $(this).parent().parent('tr').children('input').val();
        var mid = "<?php echo $this->mid;?>";
        var $_this = $(this);
        $.ajax
        ({
            type:'get',
            url:'/version/site/changeStatus/mid/'+mid+'/id/'+id+'/status/'+status,
            success:function(data)
            {
                if(data == 200 && status == 0){
                    $_this.parent().parent().children('td').eq(8).text('已下线');
                    //$_this.parent().parent().removeClass('down');
                }else if(data == 200 && status == 1){
                    $_this.parent().parent().children('td').eq(8).text('已上线');
                }
            }
        })
    })

    $('.dele').click(function(){
        var auth = "<?php echo $_SESSION['auth']?>";
        var flag = "<?php if(in_array('1',$res['status'])){echo 1;}?>";
        if(auth=='1' || flag=='1'){

        }else{
            return false;
        }
        var id = $(this).attr('des');
        layer.confirm("删除会清空数据！", {
        	title:"消息提示",
            btn: ['删除','取消'] //按钮
            }, function(){
            $.post("<?php echo $this->get_url('site','delsite')?>",{id:id},function(d){
                if(d.code==200){
                    alert(d.msg);
                    location.reload();
                    //window.location.href="/version/site/index.html?mid=-1&nid=32";
                }else{
                    alert(d.msg)
                }
            },'json')
        })
    })
    $('.edit').click(function(){
        var auth = "<?php echo $_SESSION['auth']?>";
        var flag = "<?php if(in_array('1',$res['status'])){echo 1;}?>";
        if(auth=='1' || flag=='1'){

        }else{
            return false;
        }
        var id = $(this).attr('des');
        $.post("<?php echo $this->get_url('site','edit')?>",{id:id},function(d){
            if(d.code == 200){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['530px', '330px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        },'json')
    })
    $('.noadd').click(function(){
        var id = $(this).parent().parent().children('input').val();
        var flag = $(this).html();
        if(flag=='不编入'){
            flag = 1;
        }else{
            flag=0
        }
        $.post("<?php echo $this->get_url('site','noadd')?>",{id:id,flag:flag},function(d){
            location.reload();
        })
    })

    $('.add').click(function(){
        var gid = "<?php echo $_REQUEST['nid']?>";
        var my = layer.msg('加载中', {icon: 16,shade:0.3});
        $.getJSON('<?php echo $this->get_url('site','siteadd')?>',{gid:gid},function(d){
            if(d.code == 200){
                layer.close(my);
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['1030px', '650px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })

    $('.classify_btn').click(function(){
        var gid = "<?php echo $_REQUEST['nid']?>";
        $.getJSON('<?php echo $this->get_url('site','classify')?>',{gid:gid},function(d){
            if(d.code == 200){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['1030px', '650px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })

    function change(obj){
        var id = $('input[name=gid]').val();
        var flag = $('#change').val();
        $.post("<?php echo $this->get_url('site','change')?>",{id:id,flag:flag},function(d){
            console.log(d);
            if(d.code==200){
                alert(d.msg);
                location.reload();
            }else{
                alert(d.msg);
            }
        },'json')
    }

    $('.btn_order').click(function(){
        var ids = {};
        var orders={};
        var els =document.getElementsByName("id");
        for (var i = 0, j = els.length; i < j; i++){
            ids[i]=els[i].value;
        }
        var order =document.getElementsByName("order");
        for (var i = 0, j = order.length; i < j; i++){
            orders[i]=order[i].value;
        }
        $.post("<?php echo $this->get_url('site','order')?>",{id:ids,order:orders},function(d){
            location.reload();
        })
    })

    $('.guide').click(function(){
        var auth = "<?php echo $_SESSION['auth']?>";
        var flag = "<?php if(in_array('1',$res['status'])){echo 1;}?>";
        if(auth=='1' || flag=='1'){

        }else{
            return false;
        }

        var gid = $(this).attr('gid');
        $.getJSON('<?php echo $this->get_url('site','guide')?>', {gid: gid}, function (d) {
            if (d.code == 200) {
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['630px', '506px'], //宽高
                    content: d.msg
                })
            } else {
                layer.alert(d.msg, {icon: 0});
            }
        });
    })


    $('.adderji').click(function(){
        var auth = "<?php echo $_SESSION['auth']?>";
        var flag = "<?php if(in_array('1',$res['status'])){echo 1;}?>";
        if(auth=='1' || flag=='1'){

        }else{
            return false;
        }

        var gid = $(this).attr('gid');
        $.getJSON('<?php echo $this->get_url('site','guide')?>', {gid: gid}, function (d) {
            if (d.code == 200) {
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['630px', '506px'], //宽高
                    content: d.msg
                })
            } else {
                layer.alert(d.msg, {icon: 0});
            }
        });
    })

    $('.addyiji').click(function(){
        var auth = "<?php echo $_SESSION['auth']?>";
        var flag = "<?php if(in_array('1',$res['status'])){echo 1;}?>";
        if(auth=='1' || flag=='1'){

        }else{
            return false;
        }

        var gid = $(this).attr('gid');
        $.getJSON('<?php echo $this->get_url('site','guide')?>', {gid: gid}, function (d) {
            if (d.code == 200) {
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['630px', '506px'], //宽高
                    content: d.msg
                })
            } else {
                layer.alert(d.msg, {icon: 0});
            }
        });
    })

    $('.shai_btn').click(function(){
        var gid = "<?php echo $_REQUEST['nid'];?>";
        $.getJSON('<?php echo $this->get_url('site','station')?>', {gid: gid}, function (d) {
            if (d.code == 200) {
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['830px', '200px'], //宽高
                    content: d.msg
                })
            } else {
                layer.alert(d.msg, {icon: 0});
            }
        });
    })
    $(function(){
        var gid = "<?php echo $_REQUEST['nid']?>";
        var str = '.test-'+gid;
        $('.test').remove('active');
        $(str).addClass('active');
    })
    $('.first_add').click(function(){
        var my = layer.msg('加载中', {icon: 16,shade:0.3});
        $.getJSON('<?php echo $this->get_url('site','firstadd')?>',function(d){
            if(d.code == 200){
                layer.close(my);
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['1060px', '450px'], //宽高
                    content: d.msg
                })
            }else{
                layer.alert(d.msg,{icon:0});
            }
        })
    })



    $('.s_btn').click(function(){
        var text = $(this).val();
        var test = window.location.href;
        if(text=='1'){
            //var test = window.location.href;
            window.location.href=test+"&status="+1+"&page=1"
        }else{
            window.location.href=test+"&status="+0+"&page=1"
        }
    })
    $('.search_title').click(function(){
        var title = $('input[name=titleSearch]').val();
        var cp = $('#cp').val();
        var status = $('#s_btnchange').val();
        var nid = "<?php echo $_GET['nid']?>";
        var gid = "<?php echo $_REQUEST['nid']?>";
	var type = "<?php echo !empty($_GET['type'])?$_GET['type']:''; ?>";
        var headerUrl = "/version/site/index/mid/<?php echo $this->mid;?>"+"/gid/"+gid+'/nid/'+nid+'/type/'+type;
        var centerUrl = '';
        if(!empty(title)){
           centerUrl += "/title/"+title;
        }
        if(cp != '0'){
           centerUrl += "/cp/"+cp;
        }
        if(status == '1'){
           centerUrl += "/status/"+1;
        }/*else if(status == '0'){
           centerUrl += "/status/"+3;
        }*/else if(status == '2'){
           centerUrl += "/status/"+0;
        }

        window.location.href = headerUrl+centerUrl+fixedUrl;
        return false;
        $.ajax
        ({
            type:'post',
            //url:"/version/site/getAjax/mid/<?php echo $this->mid;?>/title/"+title+"/gid/"+gid,
            url:url,
            dataType:'json',
            success:function(data)
            {
                console.log(data);
                $('.content').empty();
                var li = '<table width="66%" cellspacing="0" cellpadding="10" class="mtable center" id="tableSort"><input type="hidden" name="gid" value="<?php echo $gid?>"><tr><th></th><th>编号</th><th>牌照方</th><th>资产ID</th><th>标题</th><th>语言</th><th>计费说明</th><th data-type="date">编入时间</th><th>发布时间</th><th>状态</th><th>操作</th></tr>';
                $.each(data, function(index, array) { //遍历返回json
                    switch(array['cp']){
                        case '642001':array['cp']='华数';break;
                        case 'BESTVOTT':array['cp']='百视通';break;
                        case 'ICNTV':array['cp']='未来电视';break;
                        case 'youpeng':array['cp']='南传';break;
                        case 'HNBB':array['cp']='芒果';break;
                        case 'CIBN':array['cp']='国广';break;
                        case 'YGYH':array['cp']='银河';break;
                    }
                    var up='';
                    var status='';
                    switch(array['vstatus']){
                        case '0':up='down';status='已下线';break;
                        case '1':up='up';status='已上线';break;
                    }
                    var updateTime='';
                    if(empty(array['upTime'])){
                        updateTime='未发布';
                    }else{
                        updateTime=getLocalTime(array['upTime']);
                    }
                    if(array['vstatus'] == '0'){
                        var str = " downS' "+'style="color:red;"';
                    }else{
                        var str = ' up';
                    }
                    li +="<tr class='trData"+str+"'><input type='hidden' value="+array['cid']+"><td><input type='checkbox' class='checkbox' name='id' value="+array['cid']+"></td><td><input type='text' class='order' name='order' value="+array['orders']+" style='width:20px'></td><td>"+array['cp']+"</td><td class='changevid'>"+array['vid']+"</td><td>"+array['title']+"</td><td>"+array['language']+"</td><td>免费</td><td>"+getLocalTime(array['vTime'])+"</td><td>"+updateTime+"</td><td class='shaixuan'>"+status+"</td><td><a class='status_true'>上线&nbsp;</a><a class='status_false'>下线&nbsp;</a><a class='status_back'>&nbsp;撤回</a></td>";
                });
                li +='</table>';
                $('.content').append(li);
            }
        })
    })
    function getLocalTime(nS) {
        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/:\d{1,2}$/,' ');
    }
    $('.page-ul-init').children('li').css({'height':'20px','line-height':'20px'});
</script>

