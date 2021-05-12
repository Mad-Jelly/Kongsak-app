<!DOCTYPE html>


<html>
<head>
    <title>imgForm</title>
    <meta charset="UTF-8">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<form class="imgForm" action="test2.php" method="post" enctype="multipart/form-data">
    <input type="file" name="upload" />
    <input type="submit"  name="save"  value="upload" />
</form>
</body>
</html>
<?php
if($_POST){
    $name=rand(0,10000);
    echo $name;
    /*if(isset($_FILES['upload']))
    {
        //$type = strrchr($_FILES['upload']['name'],".");
        $name_file =  $_FILES['upload']['name'];
        $tmp_name =  $_FILES['upload']['tmp_name'];
        $locate_img ="image_job/";
        if(move_uploaded_file($tmp_name,$locate_img.$name_file))
        {
            
            echo '<script type="text/javascript">
                    swal("", "อัพโหลดรูปภาพเรียบร้อยแล้วครับ !!", "success");
                    </script>';               
        }
    }*/
}
