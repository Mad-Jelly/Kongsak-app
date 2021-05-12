<?php

ob_start();
session_start();
$id=$_SESSION["id"];
$name=$_SESSION["name"];
$authen=$_SESSION["authen"];
include("connect_table.php");
if($authen==NULL)
{		
	header("location: index.php");	
}
/*if($authen==5)
{		
	echo '<script language="javascript">';
	echo 'alert("สวัสดี '.$name.'   เจอกันอีกแล้วน้า")';
	echo '</script>';	
}*/
$all_provi=mysqli_query($con,"SELECT * FROM tbl_mid_province");
$all_model=mysqli_query($con,"SELECT * FROM tbl_mid_model ");
$all_user=mysqli_query($con,"SELECT * FROM tbl_mid_technician");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>เพิ่มข้อมูล</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
<link href="mid-css.css" rel="stylesheet" type="text/css" /> 
<link rel="shortcut icon" type="image/x-icon" href="image/icon.ico">
</head>
<body>
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script language="JavaScript">
	function out()
	{
		if(confirm('ต้องการออกจากระบบหรือไม่?')==true)
		{			
			window.location = 'index.php';
		}
		else
		{

		}
	}
</script>


<?="<form id=\"form1\"  method=\"post\" onsubmit=\"return confirm('ยืนยันการดำเนินการหรือไม่');\"> "?>
<div class="all">
<br />
<div class="header-padding">
&nbsp;&nbsp;&nbsp;
<img src="./image/mid.png" />	
</div>
<ul class="nav nav-pills disabled" style="background-color: #e3f2fd;font-size:20px">
	
	<li class="nav-item" style="padding-left:1090px">
		<a class="nav-link" href="./mid_home.php">
		<input type="image" src="./image/back.png" alt="Submit" width="20" height="20">
		ย้อนกลับ
		</a>  
	</li>  
	<li>
		<span class="log_add_fontsize">/</span>
	</li>
	<li class="nav-item " style="padding-left:px">  
	<a  class="nav-link " href="#" OnClick="out()">ออกจากระบบ
	<input type="image" src="./image/logout.png" alt="Submit" width="18" height="20"></a> 
	</li>  
	</ul>
<div class="content-body">
<br />
<h1>เพิ่มข้อมูล</h1>
<br>    
<div class="container" align="left">
    <div class="form-row" align="left">
    	<div class="form-group col-md-8 input-group-lg">
            <label class="h5">ชื่อสถานที่</label>
            <input class="form-control log_add_fontsize" name="txt_location" placeholder="*ชื่อสถานที่"/>           
        </div>            
        <div class="form-group col-md-4">
         <label class="h5">จังหวัด</label>
            <select class="custom-select h-auto log_add_fontsize"  name="province">	
            <option value="">*เลือกจังหวัด</option>
        <?php
            while($province = mysqli_fetch_array($all_provi))
        {		
            	echo '<option value="'.$province["province_id"].'">'.$province["province_name"].'</option>';      		
	    }?>	
            </select>
        </div>
        <div class="form-group col-md-4">
         <label class="h5">รุ่นเครื่อง</label>
            <select class="custom-select h-auto log_add_fontsize"  name="model">	
            <option value="">*เลือกรุ่นเครื่อง</option>
        <?php
            while($model = mysqli_fetch_array($all_model))
        {		
            	echo '<option value="'.$model["model_id"].'">'.$model["model_name"].'</option>';      		
	    }?>	
            </select>
        </div>
        <div class="form-group col-md-4 input-group-lg">
            <label class="h5">S/N</label>
            <input class="form-control log_add_fontsize" name="txt_sn"  placeholder="หมายเลข SN">     
        </div>  
        <div class="form-group col-md-4 input-group-lg">
        <label class="h5">ผู้ติดตั้ง</label>
            <select class="custom-select h-auto log_add_fontsize"  name="tech">	
            <option value="">*เลือกผู้ติดตั้ง</option>
        <?php
            while($tech = mysqli_fetch_array($all_user))
        {		
            	echo '<option value="'.$tech["tech_id"].'">'.$tech["tech_name"].'</option>';      		
	    }?>	
            </select>     
        </div>  
        <div class="form-group col-md-3 input-group-lg">
            <label class="h5">ผู้ติดต่อ</label>
            <input class="form-control log_add_fontsize" name="txt_contact" placeholder="ผู้ติดต่อ"/>           
        </div>          
        <div class="form-group col-md-3 input-group-lg">
            <label class="h5">หมายเลขโทรศัพท์</label>
            <input class="form-control log_add_fontsize" name="txt_phone" placeholder="หมายเลขโทรศัพท์"/>           
        </div>          
        <div class="form-group col-md-3 input-group-lg">
         <label class="h5">วันเริ่มรับประกัน</label>
      	 <input type="date" class="form-control  log_add_fontsize" name="st_war_date" placeholder="">
    	</div>
        <div class="form-group col-md-3 input-group-lg">
        <label class="h5">วันหมดประกัน</label>
      	 <input type="date" class="form-control  log_add_fontsize" name="end_war_date" placeholder="">      
        </div>          
    </div> 
</div>
<br />
<button name="bt_add" value="comfirm" type="submit" class="btn btn-success btn-lg"  >ยืนยัน</button>

</div>
</div>

<?="</form>"?>
<?php
if(isset($_POST['bt_add']))
{
		
        if($_POST['txt_location']!="" & $_POST['province']!="" & $_POST['model']!="" & $_POST['tech']!="" & $_POST['st_war_date']!="" 
        & $_POST['end_war_date']!="")
		{
            if($_POST['txt_sn']=="")
            {
                if($id==NULL)
                {	                    	
                    header("location: index.php");	
                }
                else
                 {
                    $insert="INSERT INTO tbl_mid_service(
                        sn,
                        model_id,
                        location,
                        province_id,
                        tech_id,
                        contact_person,
                        telephone,
                        st_waranty_date,
                        end_waranty_date,
                        open_person,
                        open_date) 
                    VALUES(
                    '".$_POST['txt_sn']."',
                    '".$_POST['model']."',
                    '".$_POST['txt_location']."',
                    '".$_POST['province']."',
                    '".$_POST['tech']."',
                    '".$_POST['txt_contact']."',
                    '".$_POST['txt_phone']."',
                    '".$_POST['st_war_date']."',
                    '".$_POST['end_war_date']."',
                    '".$id."',
                    NOW()
                    )";
                    $objQuery = mysqli_query($con,$insert);	
                                    
                    if($objQuery)
                    {                                                            
                        echo '<script type="text/javascript">
                            swal("", "บันทึกข้อมูลเรียบร้อยแล้วครับ !!", "success");
                            </script>';
                        mysqli_close($con);		                    							
                    }
                    else
                    {			
                        echo '<script language="javascript">';
                        echo 'alert("เกิดข้อผิดพลาด")';
                        echo '</script>';			
                    }
                }                
            }
            else
            {
                $chk_sn=mysqli_query($con,"SELECT sn FROM tbl_mid_service WHERE sn='".$_POST['txt_sn']."'AND end_date IS NULL");
                if(mysqli_num_rows($chk_sn))
                {					
                    echo "<script type='text/javascript'>alert('หมายเลข SN นี้ได้ถูกลงทะเบียนแล้ว');</script>";		
                    mysqli_close($con);							 
                }
                else
                {			
                    if($id==NULL)
                    {	                    	
                        header("location: index.php");	
                    }
                    else 
                    {
                        $insert="INSERT INTO tbl_mid_service(
                            sn,
                            model_id,
                            location,
                            province_id,
                            tech_id,
                            contact_person,
                            telephone,
                            st_waranty_date,
                            end_waranty_date,
                            open_person,
                            open_date) 
                        VALUES(
                        '".$_POST['txt_sn']."',
                        '".$_POST['model']."',
                        '".$_POST['txt_location']."',
                        '".$_POST['province']."',
                        '".$_POST['tech']."',
                        '".$_POST['txt_contact']."',
                        '".$_POST['txt_phone']."',
                        '".$_POST['st_war_date']."',
                        '".$_POST['end_war_date']."',
                        '".$id."',
                        NOW()
                        )";
                        $objQuery = mysqli_query($con,$insert);	
                                        
                        if($objQuery)
                        {                                                                
                            echo '<script type="text/javascript">
                            swal("", "บันทึกข้อมูลเรียบร้อยแล้วครับ !!", "success");
                            </script>';
                            mysqli_close($con);		                    							
                        }
                        else
                        {			
                            echo '<script language="javascript">';
                            echo 'alert("เกิดข้อผิดพลาด")';
                            echo '</script>';			
                        }
                    }                    
                }   
            }
		}
		else
		{
			 echo '<script type="text/javascript">
             swal("", "กรุณากรอกข้อมูลให้ครบถ้วนด้วยครับ !!", "error");
             </script>';
		}
}	
elseif(isset($_POST['bt_logout']))
{
	
	session_start();
	session_destroy();	
	header("location: index.php");	
}
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>