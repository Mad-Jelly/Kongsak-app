<?php
session_start();
session_destroy();
ob_start();
include("connect_table.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
<link rel="shortcut icon" type="image/x-icon" href="image/icon.ico">

<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url("image/head_bg.jpg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.card-signin {
  border: 0;
  border-radius: 1rem;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

</style>

<title>ลงชื่อเข้าใช้</title>
</head>
<body>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="bg">
    <div class="container">
        <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center"><img src="image/mid.png" /></h5>
                <form class="form-signin" method="post">
                <div class="form-label-group">
                    <input type="text" id="txt_user" name="txt_user" class="form-control" placeholder="User Name" required autofocus>            
                </div>
                <br>
                <div class="form-label-group">
                    <input type="password" id="txt_password" name="txt_password" class="form-control" placeholder="Password" required>               
                </div>  
                <br>            
                <button class="btn btn-lg btn-primary btn-block text-uppercase" name="login" value="Login"  type="submit">Sign in</button>                 
                </form>
                <H1>Master Is HERE</H1>
            </div>
            </div>
        </div>
        </div>
    </div>       
</div> 
</body>
</html>

<?php

if(isset($_POST['login']))
{
	$id=$_POST['txt_user'];
	$pass=$_POST['txt_password'];
	$login=mysqli_query($con,"SELECT * FROM `tbl_mid_user` WHERE user_id = '".mysqli_real_escape_string($con,$id)."' AND user_password = '".mysqli_real_escape_string($con,$pass)."'");
	if($id==""||$pass=="")
	{		
		echo '<script type="text/javascript">
             swal("", "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง !!", "error");
             </script>';		
	}
	else
	{
		
		if(!mysqli_num_rows($login))
		{		
			echo '<script type="text/javascript">
             swal("", "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง !!", "error");
             </script>';				 
		}
		else
		{
			$row=mysqli_fetch_array($login);
			session_start();
			$_SESSION["id"]=$row["user_id"];			
			$_SESSION["name"]=$row["user_name"];
			$_SESSION["authen"]=$row["user_authen"];			
			session_write_close();
			mysqli_close($con);	
			header("Location: mid_home.php");		
		}
	}
}
?>
