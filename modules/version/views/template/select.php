<style>
    .m-1{
        width:125px;
        height:52.5px;
        border:1px solid #ccc;
        border-radius: 8px;
        margin-bottom: 10px;
        float:left;
    }
    .m-1-2{
        width:125px;
        height:115px;
        margin-bottom: 20px;
        border:1px solid #ccc;
        border-radius: 8px;
        float:left;
    }
    .m-1-3{
        width:128px;
        height:182.5px;
        border:1px solid #ccc;
        border-radius: 8px;
        float:left;
        margin-bottom: 20px;
        /*margin-right:10px;*/
    }
    .m-2-3{
        width:280px;
        height:182.5px;
        border:1px solid #ccc;
        border-radius: 8px;
        float:left;
        margin-bottom: 20px;
    }
    /*.m-2-3{
        width:280px;
        height:125.5px;
        border:1px solid #ccc;
        border-radius: 8px;
        float:left;
        margin-bottom: 20px;
    }*/
    .m-2-6{
        width:280px;
        height:390px;
        border:1px solid #ccc;
        border-radius: 8px;
        float:left;
    }
    .m-2-4{
        width:280px;
        height:250px;
        border:1px solid #ccc;
        border-radius: 8px;
        float:left;
        margin-bottom: 20px;
    }
    .m-3-4{
        width:420px;
        height:250px;
        border:1px solid #ccc;
        border-radius: 8px;
        float:left;
        margin-bottom: 20px;
    }
    .m-2-2{
        width:280px;
        height:115px;
        border:1px solid #ccc;
        border-radius: 8px;
        float:left;
    }
    .m-4-4{
        width:580px;
        height:250px;
        border:1px solid #ccc;
        border-radius: 8px;
        float:left;
    }
    .parent-1{
        width:125px;
        height:390px;
        float:left;
        margin-right: 20px;
    }
    .parent-1-2{
        width:280px;
        height:390px;
        float:left;
        margin-right: 20px;
    }
    .parent-1-3{
        width:420px;
        height:390px;
        float:left;
        margin-right: 20px;
    }
    .parent-1-4{
        width:580px;
        height:390px;
        float:left;
        margin-right: 20px;
    }
    .fill-1-3{
        width:20px;
        height:182.5px;
        float: left;
    }
    .fill-1-2{
        width:19px;
        height:115.5px;
        float: left;
    }
    .fill-1-4{
        width:280px;
        height:20px;
        float:left
    }
    .fill-1-5{
        width:580px;
        height:20px;
        float:left;
    }
    .fill-1-6{
        width:15px;
        height:115.5px;
        float: left;
    }
    .clickImg-1{
        width:125px;
        height:52.5px;
        border:1px solid #ccc;
        text-align: center;
    }
    .clickImg-1-2{
        width:125px;
        height:115px;
        text-align: center;
    }
    .clickImg-1-3{
        width:128px;
        height:182.5px;
        text-align: center;
    }
    .clickImg-2-3{
        width:280px;
        height:182.5px;
        text-align: center;
    }
    .clickImg-2-6{
        width:280px;
        height:390px;
        text-align: center;
    }
    .clickImg-2-4{
        width:280px;
        height:250px;
        text-align: center;
    }
    .clickImg-3-4{
        width:420px;
        height:250px;
        text-align: center;
    }
    .clickImg-2-2{
        width:280px;
        height:115px;
        text-align: center;
    }
    .clickImg-4-4{
        width:580px;
        height:250px;
        text-align: center;
    }
    .hidden{
        display:none;
    }
    .topDiv{
        width:1080px;
        height:80px;
    }
    .template{
        width:201px;
        height:40px;
        margin-bottom:10px;
        border: 1px solid #000000;
        display: block;
        float: left;
        text-align: center;
    }
    .template:hover{
        background: #ff2222;
    }
    .half-1{
        width:60px;
        height:52px;
        border:1px solid #ccc;
        border-radius: 8px;
        float:left;
        margin-top:3px;
    }
    .clickImg-half-1{
        width:60px;
        height:52px;
        text-align: center;
    }
</style>
<div class="topDiv">
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板一
        <span class="hidden">1</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板二
        <span class="hidden">2</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板三
        <span class="hidden">3</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板四
        <span class="hidden">4</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板五
        <span class="hidden">5</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板六
        <span class="hidden">6</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板七
        <span class="hidden">7</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板八
        <span class="hidden">8</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板九
        <span class="hidden">9</span>
    </span>
    <span class="template" onclick="choseTemplate(this)">
        选择前端显示模板十
        <span class="hidden">10</span>
    </span>
</div>
<!--  模板1    -->
<h2>模板1</h2>
<div style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
    <div class="parent-1">
        <div class="m-1-2" size-w="1" size-h="2">
            <img class='clickImg-1-2' src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-6" size-w="2" size-h="6">
            <img class='clickImg-2-6' src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-3" size-w="2" size-h="3">
            <img class="clickImg-2-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="fill-1-3"></div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1" >
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
</div>

<!--  模板2    -->
<h2>模板2</h2>
<div style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
    <div class="parent-1">
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1" size-w="1" size-h="1">
            <img class="clickImg-1" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1" size-w="1" size-h="1">
            <img class="clickImg-1" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1" size-w="1" size-h="1">
            <img class="clickImg-1" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1" size-w="1" size-h="1">
            <img class="clickImg-1" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-3" size-w="2" size-h="3">
            <img class="clickImg-2-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-3"></span>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
</div>

<!--  模板3    -->
<h2>模板3</h2>
<div style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
    <div class="parent-1">
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1" size-w="1" size-h="1">
            <img class="clickImg-1" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1" size-w="1" size-h="1">
            <img class="clickImg-1" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1" size-w="1" size-h="1">
            <img class="clickImg-1" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1" size-w="1" size-h="1">
            <img class="clickImg-1" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-3">
        <div class="m-3-4" size-w="3" size-h="4">
            <img class="clickImg-3-4" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-2"></span>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-2"></span>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
</div>

<!--  模板4    -->
<h2>模板4</h2>
<div style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1" size-w="1" size-h="1">
            <img class="clickImg-1" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1" size-w="1" size-h="1">
            <img class="clickImg-1" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1" size-w="1" size-h="1">
            <img class="clickImg-1" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-3" size-w="2" size-h="3">
            <img class="clickImg-2-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-3"></span>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-6" size-w="2" size-h="6">
            <img class='clickImg-2-6' src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
</div>

<!--  模板5    -->
<h2>模板5</h2>
<div style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">

    <div class="parent-1-2">
        <div class="m-2-6" size-w="2" size-h="6">
            <img class='clickImg-2-6' src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-3" size-w="2" size-h="3">
            <img class="clickImg-2-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-3"></span>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
</div>

<!--  模板6    -->
<h2>模板6</h2>
<div style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">
    <div class="parent-1">
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2" >
        <div class="m-2-4" size-w="1" size-h="2">
            <img class="clickImg-2-4" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>
</div>

<!--  模板7    -->
<h2>模板7</h2>
<div style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">

    <div class="parent-1-2">
        <div class="m-2-4" size-w="1" size-h="2">
            <img class="clickImg-2-4" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

</div>

<!--  模板8    -->
<h2>模板8</h2>
<div style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">

    <div class="parent-1-2">
        <div class="m-2-4" size-w="1" size-h="2">
            <img class="clickImg-2-4" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="fill-1-4"></div>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>


</div>
<!--  模板9   -->
<h2>模板9</h2>
<div style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">

    <div class="parent-1-2">
        <div class="m-2-6" size-w="2" size-h="6">
            <img class="clickImg-2-6" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-6" size-w="2" size-h="6">
            <img class="clickImg-2-6" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1">
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-3" size-w="1" size-h="3">
            <img class="clickImg-1-3" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

</div>

<!--  模板10   -->
<h2>模板10</h2>
<div style="height: 450px;width:2280px;overflow-y: scroll;overflow-x: scroll;float: left;">

    <div class="parent-1-4">
        <div class="m-4-4" size-w="4" size-h="4">
            <img class="clickImg-4-4" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-5"></span>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)"/>
        </div>
        <span class="fill-1-6"></span>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)"/>
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-4" size-w="2" size-h="4">
            <img class="clickImg-2-4" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-2"></span>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
    </div>

    <div class="parent-1-2">
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-4"></span>
        <div class="m-2-2" size-w="2" size-h="2">
            <img class="clickImg-2-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-4"></span>
        <div class="m-1-2" size-w="1" size-h="2">
            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />
        </div>
        <span class="fill-1-2"></span>
        <div class="m-1-2" size-w="1" size-h="2">
<!--            <img class="clickImg-1-2" src="../../file/3.png" alt="" onclick="add(this)" />-->
            <div class="half-1">
                <img src="../../file/3.png" alt="" class="clickImg-half-1">
            </div>
            <div class="half-1">
                <img src="../../file/3.png" alt="" class="clickImg-half-1">
            </div>
            <div class="half-1">
                <img src="../../file/3.png" alt="" class="clickImg-half-1">
            </div>
            <div class="half-1">
                <img src="../../file/3.png" alt="" class="clickImg-half-1">
            </div>
        </div>
    </div>

</div>


<script>
    function add(obj)
    {
        alert($(obj).attr('class'));
        alert($(obj).parent('div').attr('size-w'));
        alert($(obj).parent('div').attr('size-h'));
    }

    function choseTemplate(obj)
    {
        var templateId = $(obj).children('span').text();
        alert(templateId);
    }
</script>
