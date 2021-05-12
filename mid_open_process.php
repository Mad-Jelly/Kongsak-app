<?php
ob_start();
session_start();
$id=$_SESSION["id"];
$name=$_SESSION["name"];
$authen=$_SESSION["authen"];
$service_no=$_GET['service_no'];
if($authen==NULL)
{
	header("index.php");
}
include("connect_table.php");
date_default_timezone_set('Asia/Bangkok');
$all_tech=mysqli_query($con,"SELECT * FROM tbl_mid_technician");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>รายละเอียดการดำเนินการ</title>
<link href="mid-css.css" rel="stylesheet" type="text/css" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
<link rel="shortcut icon" type="image/x-icon" href="image/icon.ico"> 

</head>
<body>
<form id="input"     method="post" onsubmit="return confirm('ยืนยันการอัปเดดข้อมูลหรือไม่?');">
<div align="center" class="addlog">
<br /><br />
<div  style="font-size:30px;font-weight:800">รายละเอียดการดำเนินการ</div>
<br />
<div class="container" align="left">
    <div class="form-row" align="left">

            <div class="form-group col-md-4 input-group-lg">
                <label class="h5">เลขที่ใบซ่อม</label>
                <input class="form-control log_add_fontsize" name="txt_repair"  placeholder="เลขที่ใบซ่อม">     
            </div> 

            <div class="form-group col-md-4 input-group-lg">
            <label class="h5">ผู้เข้าซ่อม</label>
                <select class="custom-select h-auto log_add_fontsize"  name="tech">	
                <option value="">*เลือกผู้เข้าซ่อม</option>
            <?php
                while($tech = mysqli_fetch_array($all_tech))
            {		
                    echo '<option value="'.$tech["tech_id"].'">'.$tech["tech_name"].'</option>';      		
            }?>	
                </select>     
            </div>  

            <div class="form-group col-md-4 input-group-lg">
            <label class="h5">วันที่เข้าซ่อม</label>
            <input type="date" class="form-control  log_add_fontsize" name="repair_date" placeholder="">
            </div>

            <div class="form-group col-lg-12 ">
            <label class="h5">รายละเอียดการซ่อม</label>
            <textarea class="form-control" name="txt_process" rows="3"></textarea>
            </div>
    </div>
    
    <input type="checkbox" name="close" style="height:25px;width:25px"  value="close"><span style=" font-size:25px">ถอดการติดตั้ง</span>
    <br />
    <div align="center">
    <button name="bt_add" value="comfirm" type="submit" style="font-size:20px;height:35px;width:150px">ยืนยัน</button>
    </div>
</div>    
<br><br>
</div>       

<!--<input type="button" onclick="closePopupWindow()" value="55555555" />-->
<br /><br />
</div>
</form>
</body>
</html>
<?php
$log_number=0;
if(isset($_POST['bt_add']))
{
	if($_POST['txt_process']!=NULL & $_POST['tech']!=NULL & $_POST['txt_repair']!=NULL & $_POST['repair_date']!=NULL)
	{
        $process_id=mysqli_query($con,"SELECT MAX(process_id) AS process_id,repair_no FROM tbl_mid_process WHERE service_no='".$service_no."'");
		while($process = mysqli_fetch_array($process_id))		
		{
            $process_number = $process['process_id'];
            $chk_no=$process['repair_no'];
		}
		if(empty($process_number))
		{
			$procmess_number=1;
		}
		else
		{
			$process_number+=1;
        }	
        if($chk_no==$_POST['txt_repair'])
        {
            echo '<script language="javascript">';
            echo 'alert("เลขซ่อมซ้ำครับ")';
            echo '</script>';	
        }
       else
       {
           if(!empty($_POST['close']))
           {
                $insert="INSERT INTO tbl_mid_process(process_id,service_no,process_detail,tech_id,repair_no,repair_date,open_person,open_date) 
                VALUES('".$process_number."','".$service_no."','".$_POST['txt_process']."','".$_POST['tech']."','".$_POST['txt_repair']."','".$_POST['repair_date']."','".$id."',NOW())";
                $objQuery = mysqli_query($con,$insert);			
                if($objQuery)
                {
                    
                }
                else
                {
                    echo '<script language="javascript">';
                    echo 'alert("เกิดข้อผิดพลาด")';
                    echo '</script>';			
                }

                $update="UPDATE tbl_mid_service SET  end_date=NOW() WHERE service_no='".$service_no."'";
                $objQuery = mysqli_query($con,$update);			
                if($objQuery)
                {
                    echo '<script type="text/javascript">
                    swal
                    ({
                        title: "อัปเดดข้อมูลเรียบร้อยแล้วครับ?",                        
                        icon: "success",
                        successMode: true,
                    })
                    .then(willDelete => {
                        if (willDelete) {
                            close();
                        }
                    })
                    </script>';
                    mysqli_close($con);
                    echo "<script>window.opener.location.reload();</script>"; 
                   // echo "<script>window.close();</script>";
                }
                else
                {
                    echo '<script language="javascript">';
                    echo 'alert("close_เกิดข้อผิดพลาด")';
                    echo '</script>';			
                }                
           }
           else
           {
                $insert="INSERT INTO tbl_mid_process(process_id,service_no,process_detail,tech_id,repair_no,repair_date,open_person,open_date) 
                VALUES('".$process_number."','".$service_no."','".$_POST['txt_process']."','".$_POST['tech']."','".$_POST['txt_repair']."','".$_POST['repair_date']."','".$id."',NOW())";
                $objQuery = mysqli_query($con,$insert);			
                if($objQuery)
                {
                    echo '<script type="text/javascript">
                    swal
                    ({
                        title: "อัปเดดข้อมูลเรียบร้อยแล้วครับ?",                        
                        icon: "success",
                        successMode: true,
                    })
                    .then(willDelete => {
                        if (willDelete) {
                            close();
                        }
                    })
                    </script>';
                    mysqli_close($con);
                    echo "<script>window.opener.location.reload();</script>"; 
                   // echo "<script>window.close();</script>";
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
	else
	{
        echo '<script type="text/javascript">
        swal("", "กรุณากรอกข้อมูลให้คบถ้วนด้วยครับ!!", "error");
        </script>';	
										
    }
}

?>
