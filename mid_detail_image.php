<?php
ob_start();
session_start();
$id=$_SESSION["id"];
$name=$_SESSION["name"];
$authen=$_SESSION["authen"];
$service_no=$_GET['service_no'];
$location=$_GET['loca'];
include("connect_table.php");
$chk_img_no=mysqli_query($con,"SELECT image_name FROM tbl_mid_service_image WHERE service_no='".$service_no."'"); 
/*if($authen==NULL)
{		
	header("location: index.php");	
}*/

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>รูปภาพประกอบ</title>
  </head>
  <body>
    
    <div class="container">

  <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0"><?=$location?></h1>

  <hr class="mt-2 mb-5">

  <div class="row text-center text-lg-left">
<?php
        while($image = mysqli_fetch_array($chk_img_no))
        {

        
?>
        <div class="col-lg-3 col-md-4 col-6">
        <a href="./image_job/<?=$image["image_name"]?>" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="./image_job/<?=$image["image_name"]?>" alt="">
        </a>        
        </div>
<?php
        }
?>
</div>
<a href="./mid_detail.php?service_no=<?=$service_no?>" style="margin-left:30px" class="btn lg_bt btn-success btn-lg" >ย้อนกลับ</a>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>