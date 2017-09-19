<style>
    .test{
        width:150px;
        height:70px;
        margin-top:20px;
        margin-left: 10px;
        display:block;
        float:left;
        border:2px solid #ccc;
        text-align: center;
    }

</style>
<form method="post" action="" id="form">
<?php
    for($i = 1 ; $i<31; $i++){
        echo "<input class='test' type='text' name='item' value=".$i.">";
    }

?>
    <input class="btn btn2 btn-gray audit_search  " type="submit"  value="保存" name="" style="font-size: 14px">
</form>



<script>
    var arr = new Array();
    $('.btn').click(function()
    {
        var a = $('form').serialize();
        console.log(a);
        return false;
    });


//    console.log(arr);
</script>
