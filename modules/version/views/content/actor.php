<?php
//var_dump($data);die;
$admin = $this->getMvAdmin();
$adminLeftOneName = !empty($_GET['adminLeftOneName'])?$_GET['adminLeftOneName']:'';
$adminLeftTwoName = !empty($_GET['epg'])?$_GET['epg']:$_GET['adminLeftTwoName'];
$adminLeftOne = !empty($_GET['adminLeftOne'])?$_GET['adminLeftOne']:'';
$adminLeftTwo = !empty($_GET['adminLeftTwo'])?$_GET['adminLeftTwo']:'';
//var_dump($data);
$nationality=!empty($_GET['nationality'])?$_GET['nationality']:0;
//var_dump($nationality);die;
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

<div style='padding: 5px 0px 0px 12px;'>
    <span><?php echo $adminLeftOneName;echo '>';?></span>
    <span><?php echo $adminLeftTwoName;?></span>
</div>
<div class="mt10">
    <form action="" method="post">
        <div class="inputDiv">
            <input type="text" name="title" style="width:125px;height:18px;"  class="form-input" value="" placeholder="请输入查询条件">
            <span style="font-size:14px;">职业</span>
            <select name="occupation" style="width:70px;height:20px;"  class="form-input" id="occupation">
		<?php $occupation=!empty($_GET['occupation'])?$_GET['occupation']:0;?>
                <option value="0" <?php if($occupation==0){echo "selected=selected";}?>>请选择</option>
                <option value="1" <?php if($occupation==1){echo "selected=selected";}?>>导演</option>
                <option value="2" <?php if($occupation==2){echo "selected=selected";}?>>演员</option>
                <option value="3" <?php if($occupation==3){echo "selected=selected";}?>>编剧</option>
                <option value="4" <?php if($occupation==4){echo "selected=selected";}?>>制片</option>
                <option value="5" <?php if($occupation==5){echo "selected=selected";}?>>配音</option>
                <option value="6" <?php if($occupation==6){echo "selected=selected";}?>>主持人</option>
                <option value="7" <?php if($occupation==7){echo "selected=selected";}?>>主播</option>
                <option value="8" <?php if($occupation==8){echo "selected=selected";}?>>模特</option>
                <option value="9" <?php if($occupation==9){echo "selected=selected";}?>>运动员</option>
                <option value="10"<?php if($occupation==10){echo "selected=selected";}?>>歌手</option>
            </select>
            <span style="float:left;font-size:14px;">性别</span>
            <select name="sex" style="width:70px;height:20px;"  class="form-input" id="sex">
		<?php $sex=isset($_GET['sex'])?$_GET['sex']:-1;?>
                <option value="-1" title="ShowType">请选择</option>
		<option value="1" <?php if($sex==1){echo "selected=selected";}?>>男</option>
		<option value="0" <?php if($sex==0){echo "selected=selected";}?>>女</option>
            </select>
            <span style="float:left;font-size:14px;">国籍</span>
            <select name="nationality" style="width:70px;height:20px;"  class="form-input" id="nationality">
		<?php //$nationality=isset($_GET['nationality'])?$_GET['nationality']:0;?>
                <option value="0" <?php if($nationality===0){echo "selected=selected";}?>>请选择</option>
                <option value="中国" <?php if($nationality==="中国"){echo "selected=selected";}?>>中国</option>
                <option value="港台" <?php if($nationality==="港台"){echo "selected=selected";}?>>港台</option>
                <option value="英国" <?php if($nationality==="英国"){echo "selected=selected";}?>>英国</option>
                <option value="美国" <?php if($nationality==="美国"){echo "selected=selected";}?>>美国</option>
                <option value="德国" <?php if($nationality==="德国"){echo "selected=selected";}?>>德国</option>
                <option value="法国" <?php if($nationality==="法国"){echo "selected=selected";}?>>法国</option>
	        <option value="韩国" <?php if($nationality==="韩国"){echo "selected=selected";}?>>韩国</option>
                <option value="荷兰" <?php if($nationality==="荷兰"){echo "selected=selected";}?>>荷兰</option>
                <option value="澳大利亚" <?php if($nationality==="澳大利亚"){echo "selected=selected";}?>>澳大利亚</option>
                <option value="加拿大"<?php if($nationality==="加拿大"){echo "selected=selected";}?>>加拿大</option>
                <option value="日本" <?php if($nationality==="日本"){echo "selected=selected";}?>>日本</option>
                <option value="马来西亚" <?php if($nationality==="马来西亚"){echo "selected=selected";}?>>马来西亚</option>
                <option value="瑞典" <?php if($nationality==="瑞典"){echo "selected=selected";}?>>瑞典</option>
                <option value="印尼" <?php if($nationality==="印尼"){echo "selected=selected";}?>>印尼</option>
                <option value="西班牙" <?php if($nationality==="西班牙"){echo "selected=selected";}?>>西班牙</option>
                <option value="葡萄牙" <?php if($nationality==="葡萄牙"){echo "selected=selected";}?>>葡萄牙</option>
                <option value="新加坡" <?php if($nationality==="新加坡"){echo "selected=selected";}?>>新加坡</option>
                <option value="泰国" <?php if($nationality==="泰国"){echo "selected=selected";}?>>泰国</option>
                <option value="爱尔兰" <?php if($nationality==="爱尔兰"){echo "selected=selected";}?>>爱尔兰</option>
                <option value="伊朗" <?php if($nationality==="伊朗"){echo "selected=selected";}?>>伊朗</option>
                <option value="印度" <?php if($nationality==="印度"){echo "selected=selected";}?>>印度</option>
                <option value="意大利" <?php if($nationality==="意大利"){echo "selected=selected";}?>>意大利</option>
                <option value="丹麦" <?php if($nationality==="丹麦"){echo "selected=selected";}?>>丹麦</option>
                <option value="马罗尼亚" <?php if($nationality==="罗马尼亚"){echo "selected=selected";}?>>马罗尼亚</option>
                <option value="越南" <?php if($nationality==="越南"){echo "selected=selected";}?>>越南</option>
                <option value="芬兰" <?php if($nationality==="芬兰"){echo "selected=selected";}?>>芬兰</option>
                <option value="瑞士" <?php if($nationality==="瑞士"){echo "selected=selected";}?>>瑞士</option>
                <option value="挪威" <?php if($nationality==="挪威"){echo "selected=selected";}?>>挪威</option>
                <option value="巴西" <?php if($nationality==="巴西"){echo "selected=selected";}?>>巴西</option>
                <option value="尼泊尔" <?php if($nationality==="尼泊尔"){echo "selected=selected";}?>>尼泊尔</option>
                <option value="埃及" <?php if($nationality==="埃及"){echo "selected=selected";}?>>埃及</option>
                <option value="土耳其" <?php if($nationality==="土耳其"){echo "selected=selected";}?>>土耳其</option>
                <option value="俄罗斯" <?php if($nationality==="俄罗斯"){echo "selected=selected";}?>>俄罗斯</option>
                <option value="以色列" <?php if($nationality==="以色列"){echo "selected=selected";}?>>以色列</option>
                <option value="黎巴嫩" <?php if($nationality==="黎巴嫩"){echo "selected=selected";}?>>黎巴嫩</option>
            </select>

            <input style="width:50px;height:20px;margin-left: 5px;" class="btn btn1 btn-gray audit_search search " type="button" value="查询" name="" style="font-size: 14px;/*margin-right:550px;*/">

	    <?php /*$this->widget('CLinkPager',array(
                'header' => '',
                'firstPageLabel' => '首页',
                'lastPageLabel' => '最后一页',
                'prevPageLabel' => '上一页',
                'nextPageLabel' => '下一页',
                'pages' => $page,
                'maxButtonCount'=>3,
            ));*/?>
		<?php echo $page;?>

        </div>

        <table width="100%" cellspacing="0" cellpadding="10" class="mtable center">
            <tr>
		<th></th>
                <th>演员ID</th>
                <th>姓名</th>
                <th>英文名</th>
                <th>职业</th>
                <th>性别</th>
                <th>国籍</th>
                <th>操作</th>
            </tr>
	    <?php foreach($data as $v):?>
                <tr>
                    <td></td>
                    <td><?php echo $v['id']?></td>
                    <td><?php echo $v['name']?></td>
                    <td><?php echo $v['nameEn']?></td>
                    <td>
			<?php
			    $professon=array();
                            if(strlen($v['professon'])>1){
                                $pro=explode(",",$v['professon']);
                                for($i=0;$i<count($pro);$i++){
                                    switch(intval($pro[$i])){
                                        case 1:
                                            $professon[$i]="导演";
                                            break;
                                        case 2:
                                            $professon[$i]="演员";
                                            break;
                                        case 3:
                                            $professon[$i]="编剧";
                                            break;
                                        case 4:
                                            $professon[$i]="制片";
                                            break;
                                        case 5:
                                            $professon[$i]="配音";
                                            break;
                                        case 6:
                                            $professon[$i]="主持人";
                                            break;
                                        case 7:
                                            $professon[$i]="主播";
                                            break;
                                        case 8:
                                            $professon[$i]="模特";
                                            break;
                                        case 9:
                                            $professon[$i]="运动员";
                                            break;
                                        case 10:
                                            $professon[$i]="歌手";
                                            break;
                                    }
                                }
                                echo implode(",",$professon);
                            }else {
                                switch(intval($v['professon'])){
                                    case 1;
                                        $professon="导演";
                                        break;
                                    case 2;
                                        $professon="演员";
                                        break;
                                    case 3;
                                        $professon="编剧";
                                        break;
                                    case 4;
                                        $professon="制片";
                                        break;
                                    case 5;
                                        $professon="配音";
                                        break;
                                    case 6;
                                        $professon="主持人";
                                        break;
                                    case 7;
                                        $professon="主播";
                                        break;
                                    case 8;
                                        $professon="模特";
                                        break;
                                    case 9;
                                        $professon="运动员";
                                        break;
                                    case 10;
                                        $professon="歌手";
                                        break;
                                }
                                echo $professon;
                            }
                        ?>
		    </td>
                    <td>
			<?php
                            if($v['sex']==1){
                                echo "男";
                            }else{
                                echo "女";
                            }
                        ?>
		    </td>
                    <td><?php echo $v['nationality']?></td>
                    <td><a href="#" gid="<?php echo $v['id'];?>"class="add">查看</a></td>
                </tr>
            <?php endforeach;?>
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
    var nid="<?php echo $_REQUEST['nid'];?>";
    var mid = "<?php echo $this->mid?>";
    var pro="<?php echo $_REQUEST['pro']?>";
    $('.add').click(function(){
        var id = $(this).attr("gid");
        url="/version/content/edit.html?nid="+nid+"&pro="+pro+"&id="+id+"&mid="+mid+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
        window.open(url);
    })
    $(".search").click(function(){
        var title= $('input[name=title]').val();
        var occupation=$("#occupation").val();
        var sex=$("#sex").val();
        var nationality=$("#nationality").val();
        window.location.href="/version/content/actor?mid="+mid+"&nid="+nid+"&occupation="+occupation+"&nationality="+nationality+"&title="+title+"&sex="+sex+"&pro="+pro+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
    })
    $(".page_btn").click(function(){
	var title= $('input[name=title]').val();
        var occupation=$("#occupation").val();
        var sex=$("#sex").val();
        var nationality=$("#nationality").val();
	var page = $('input[name=pagenum]').val();
	window.location.href="/version/content/actor.html?mid="+mid+"&occupation="+occupation+"&page="+page+"&nid="+nid+"&nationality="+nationality+"&title="+title+"&sex="+sex+"&pro="+pro+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
    })
</script>
