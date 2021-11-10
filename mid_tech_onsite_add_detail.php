<?php
ob_start();
session_start();
$id=$_SESSION["id"];
$name=$_SESSION["name"];
$authen=$_SESSION["authen"];
if($authen==NULL)
{		
	header("location: index.php");	
}

include("connect_table.php");
$all_provi=mysqli_query($con,"SELECT * FROM tbl_mid_province");
$all_provi1=mysqli_query($con,"SELECT * FROM tbl_mid_province");
$all_model=mysqli_query($con,"SELECT * FROM tbl_mid_model ");
$all_user=mysqli_query($con,"SELECT * FROM tbl_mid_technician");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>หน้าหลัก</title>
<link rel="shortcut icon" type="image/x-icon" href="image/icon.ico">
<link href="mid-ins-css.css" rel="stylesheet" type="text/css" /> 
<link href="mid-css.css" rel="stylesheet" type="text/css" /> 
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 


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



</head>
<body>
    <?php			
    echo "<form id=\"form1\" class=\"\"  method=\"post\" >";
    ?>
<div class="container">         
    <div class="row  pt-5 pl-2 pb-2 bg ">
        <img src="./image/mid.png"  /> 
    </div>             
    <div class="row pt-3 pb-2 h4"  style="background-color: #e3f2fd;">  
    <div class="col-lg">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto nav">      
                <a class="nav-item nav-link" href="./mid_tech_onsite_home.php" style="color:blue"><input type="image" src="./image/back.png" alt="Submit" width="20" height="20"> ย้อนกลับ</a>      
                <a class="nav-item nav-link" style="color:blue" href="#" OnClick="out()">ออกจากระบบ
                    <input class="mt-1" type="image" src="./image/logout.png" alt="Submit" width="18" height="20">
                </a> 
                </div>
                
            </div>
        </nav>
    </div>
    </div>
            
        

    <div class="row bg-main pl-5 pr-5 ">
        <div class="col-lg h1 pt-5">
            รายละเอียดการเข้าหน้างาน
        </div>
        <div class="form-row pt-3 " align="left">
            <div class="form-group col-md-6 input-group-lg">
                <label class="h5">เลขที่ใบงาน</label>
                <input class="form-control log_add_fontsize" name="txt_job_id" placeholder="*เลขที่ใบงาน"/>           
            </div>            
            <div class="form-group col-md-6 input-group-lg">
            <label class="h5">ช่างดำเนินงาน</label>
            <select class="custom-select h-auto log_add_fontsize"  name="txt_buyer_province">	
                <option value="">*เลือกช่างดำเนินงาน</option>
            <?php
                while($tech = mysqli_fetch_array($all_user))
            {		
                    echo '<option value="'.$tech["tech_id"].'">'.$tech["tech_name"].'</option>';      		
            }?>	
                </select>  
            </div>             
            <div class="form-group col-md-8 input-group-lg">
                <label class="h5">สถานที่</label>
                <input class="form-control log_add_fontsize" name="txt_buyer"  placeholder="สถานที่">     
            </div>  
            <div class="form-group col-md-4 input-group-lg">
            <label class="h5">จังหวัด</label>
            <select class="custom-select h-auto log_add_fontsize"  name="txt_buyer_province">	
                <option value="">*เลือกจังหวัด</option>
            <?php
                while($province = mysqli_fetch_array($all_provi))
            {		
                    echo '<option value="'.$province["province_id"].'">'.$province["province_name"].'</option>';      		
            }?>	
                </select>  
            </div>
                        
            <div class="form-group col-md-12 input-group-lg">
                <label class="h5">รายละเอียดการดำเนินงาน</label>
                <input class="form-control log_add_fontsize" name="txt_goods_detail" placeholder="รายละเอียดการดำเนินงาน"/>              
            </div>                   
        </div>         
        <div class="form-group col-md-12  pt-3 pb-5" style="margin: 0 auto">
            <button name="bt_add" value="comfirm" type="submit" class="btn btn-success btn-lg"  >บันทึกข้อมูล</button>
        </div> 
    </div>
    
  </div>
</form>
</div>
<?php
    $od=$_POST['txt_odnum'];
    $po=$_POST['txt_ponum'];
    $buyer=$_POST['txt_buyer'];
    $buyer2=$_POST['txt_buyer_province'];
    $b_location=$_POST['txt_location'];
    $b_location2=$_POST['txt_location_province'];
    
    
        if(isset($_POST['bt_add']))
        {
            if($authen==NULL)
            {		
                header("location: index.php");	
            }
            if($od!="" & $po!="" & $buyer!="" & $buyer2!="" & $b_location!="" & $b_location2!="" & $goods!="")
            {
                $chk_od=mysqli_query($con,"SELECT od_num FROM tbl_mid_order WHERE od_num='".$od."'AND end_date IS NULL");
                if(mysqli_num_rows($chk_od))
                {					
                    echo '<script type="text/javascript">
                    swal("", "หมายเลข OD นี้ถูกลงทะเบียนแล้วครับ !!", "error");
                    </script>';
                    mysqli_close($con);							 
                }
                else
                {
                    
                    $insert="INSERT INTO tbl_mid_order
                    (
                        od_num,
                        po_num,
                        buyer_name,
                        buyer_province,
                        location,
                        location_province,
                        contact_person,
                        telephone_number,
                        email,
                        goods_detail,
                        open_person,
                        open_date,
                        order_status,
                        location_inspector

                    )
                    VALUES('".$od."','".$po."','".$buyer."','".$buyer2."','".$b_location."',
                    '".$b_location2."','".$contact."','".$phone."','".$mail."','".$goods."','".$id."',NOW(),'ลงทะเบียนใบสั่งซื้อ','99')";                 

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
                            echo '<script type="text/javascript">
                                swal("", "เกิดข้อผิดพลาด !!", "error");
                                </script>';
                            mysqli_close($con);			
                        }
                }
            
            }
            else
            {
                echo '<script type="text/javascript">
                swal("", "กรุณาข้อมูลให้ครบถ้วนด้วยครับ !!", "error");
                </script>';
            }
       }
            
?>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>