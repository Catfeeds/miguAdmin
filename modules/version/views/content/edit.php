<?php //var_dump($data);die;?>
<script type="text/javascript" src="/js/uploadify/jquery.uploadify.min.js"></script>
<style>
    td{ padding-left:10px;font-size:14px;height:30px;width:150px}
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
    .active{color:black}
</style>
<div style="margin-top:20px;margin-left:10px;height:20px;width:700px;">

    <div style="height:20px;width:300px;float: left">元数据系统>演职员><?php echo $info->name;?></div>
    <a onclick="javascript:history.back(1);"href="#">
        <div style="line-height:20px;text-align:center;height:20px;width:91px;float: right;">
            <span style="font-size:13px;font-family: '微软雅黑 Bold', '微软雅黑 Regular', '微软黑雅';font-weight: 700;font-style: normal;color:#FFFFFF;">返回</span>
        </div>
    </a>
</div>
<div class="mt10" style="width:400px;margin-left:10px;">
    <form action="" method="post">
        <input type="hidden" name="id" id="id" value="<?php echo $info->id?>">
        <table class="main_tb" width="700px;" >
            <tr bgcolor="#A3BAD5">
                <td colspan="4" style="text-align: center;font-size: 13px;color：#333333">基本信息</td>
            </tr>
            <tr bgcolor="#F0FDFF">
                <td>人物ID:</td>
                <td><?php echo $info->starId;?></td>
                <td colspan="2" align="center">头像照片</td>
            </tr>
            <tr>
                <td>姓名</td>
                <td><?php echo $info->name;?></td>
                <td colspan="2" rowspan="5"><img width="80%" src="<?php echo $src->pic;?>"></td>
            </tr>
            <tr>
                <td>别名</td>
                <td><?php echo $info->alias;?></td>
            </tr>
            <tr>
                <td>英文名</td>
                <td><?php echo $info->nameEn;?></td>
            </tr>

            <tr bgcolor="#F0FDFF">
                <td>性别</td>
                <td>
		    <?php
                        if($info->sex==1){
                            echo "男";
                        }else{
                            echo "女";
                        }
                    ?>
		</td>
            </tr>
            <tr>
                <td>职业</td>
                <td>
		    <?php
                        $professon=array();
                        if(strlen($info->professon)>1){
                            $pro=explode(",",$info->professon);
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
                        }else{
                            switch(intval($info->professon)){
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
            </tr>
            <tr bgcolor="#F0FDFF">
                <td>生日</td>
                <td><?php echo $info->birth;?></td>
                <td>星座</td>
                <td><?php echo $info->constellation;?></td>
            </tr>
            <tr>
                <td>出生地</td>
                <td><?php echo $info->birthplace;?></td>
                <td>身高</td>
                <td><?php echo $info->tall;?></td>
            </tr>
            <tr>
                <td>血型</td>
                <td><?php echo $info->blood;?></td>
                <td>体重</td>
                <td><?php echo $info->weight;?></td>
            </tr>
            <tr>
                <td>国籍</td>
                <td><?php echo $info->nationality;?></td>
                <td>名族</td>
                <td><?php echo $info-> nation;?></td>
            </tr>
            <tr  bgcolor="#F0FDFF">
                <td>性取向</td>
                <td><?php echo $info->sexual;?></td>
                <td>经纪公司</td>
                <td><?php echo $info->company;?></td>
            </tr>
            <tr>
                <td>生平简历</td>
                <td colspan="3">
                    <?php echo $info->brief;?>
                </td>
            </tr>
            <tr>
                <td>人物评价</td>
                <td colspan="3">
                    <?php echo $info->evaluate;?>
                </td>
            </tr>
        </table>
        <div style="height:10px;"></div>
	<table class="main_tb" width="700px;" >
            <tr bgcolor="#A3BAD5">
                <th colspan="2" style="text-align: center;font-size: 13px;color：#333333">演职员作品</th>
		<td colspan="6"><?php echo $page?></td>
            </tr>
            <tr>
                <td>编号</td>
                <td>ID</td>
                <td>标题</td>
                <td>类型</td>
                <td>语言</td>
                <td>上映时间</td>
                <td>状态</td>
		<td>审核是否通过</td>
            </tr>
	     <?php for($i=0;$i<count($data);$i++):?>
             	<tr>
		    <td><?php echo $i+1;?></td>
		    <td><?php echo $data[$i]['vid'];?></td>
		    <td><?php echo $data[$i]['title'];?></td>
		    <td><?php echo $data[$i]['type'];?></td>
		    <td><?php echo $data[$i]['language'];?></td>
		    <td><?php echo $data[$i]['first_play_time'];?></td>
		    <td><?php if($data[$i]['isline']==1){echo "上线";}else{echo "下线";}?></td>
		    <td><?php if($data[$i]['flag']==1){echo "通过";}else{echo "未通过";}?></td>
		</tr>
	     <?php endfor;?>
        </table>
</div>
<script>

$(".page_btn").click(function(){
	var adminLeftOne = "<?php echo $_REQUEST['adminLeftOne'];?>";
    	var adminLeftTwo = "<?php echo $_REQUEST['adminLeftTwo'];?>";
    	var adminLeftOneName = "<?php echo $_REQUEST['adminLeftOneName'];?>";
    	var adminLeftTwoName = "<?php echo $_REQUEST['adminLeftTwoName'];?>";
    	var nid="<?php echo $_REQUEST['nid'];?>";
    	var mid = "<?php echo $this->mid?>";
	var id=$("#id").val();
   	 var pro="<?php echo $_REQUEST['pro']?>";
	var page = $('input[name=pagenum]').val();
	window.location.href="/version/content/edit.html?mid="+mid+"&id="+id+"&page="+page+"&nid="+nid+"&pro="+pro+'&adminLeftNavFlag=1&adminLeftOne='+adminLeftOne+'&adminLeftTwo='+adminLeftTwo+'&adminLeftOneName='+adminLeftOneName+'&adminLeftTwoName='+adminLeftTwoName;
    })
</script>
