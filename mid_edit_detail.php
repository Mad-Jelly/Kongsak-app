<?php

ob_start();
session_start();
$id=$_SESSION["id"];
$name=$_SESSION["name"];
$authen=$_SESSION["authen"];
$service_no=$_GET['service_no'];
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

$edit_de=mysqli_query($con,"SELECT
tbl_mid_service.service_no,
tbl_mid_service.sn,
tbl_mid_service.model_id,
tbl_mid_model.model_name,
tbl_mid_service.location,
tbl_mid_service.province_id,
tbl_mid_province.province_name,
tbl_mid_service.tech_id,
tbl_mid_technician.tech_name,
tbl_mid_service.contact_person,
tbl_mid_service.telephone,
tbl_mid_service.st_waranty_date,
tbl_mid_service.end_waranty_date
FROM
tbl_mid_service
INNER JOIN tbl_mid_model ON tbl_mid_service.model_id = tbl_mid_model.model_id
INNER JOIN tbl_mid_technician ON tbl_mid_service.tech_id = tbl_mid_technician.tech_id
INNER JOIN tbl_mid_province ON tbl_mid_service.province_id = tbl_mid_province.province_id
WHERE service_no='".$service_no."'");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>แก้ไขข้อมูล</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
<link href="mid-css.css" rel="stylesheet" type="text/css" /> 
<link rel="shortcut icon" type="image/x-icon" href="image/icon.ico">
</head>
<body>
<?php
while($edit = mysqli_fetch_array($edit_de))
{
    $e_sn=$edit["sn"];
    $e_model_id=$edit["model_id"];
    $e_model_na=$edit["model_name"];
    $e_loca=$edit["location"];
    $e_prov_id=$edit["province_id"]; 
    $e_prov_na=$edit["province_name"]; 
    $e_tech_id=$edit["tech_id"];
    $e_tech_na=$edit["tech_name"];
    $e_contact=$edit["contact_person"];
    $e_tele=$edit["telephone"];
    $e_st_waran=$edit["st_waranty_date"];
    $e_ed_waran=$edit["end_waranty_date"];
}

?>


<?="<form id=\"form1\"  method=\"post\" onsubmit=\"return confirm('ยืนยันการดำเนินการหรือไม่');\"> "?>
<div class="all">
    <div align="center"><br><br><h1>แก้ไขข้อมูล</h1></div>
    <br>    
    <div class="container" align="left">
        <div class="form-row" align="left">
            <div class="form-group col-md-8 input-group-lg">
                <label class="h5">ชื่อสถานที่</label>
                <input class="form-control log_add_fontsize" value="<?=$e_loca?>" name="txt_location" placeholder="*ชื่อสถานที่"/>           
            </div>            
            <div class="form-group col-md-4">
            <label class="h5">จังหวัด</label>
                <select class="custom-select h-auto log_add_fontsize"  name="province">	
                <option value="<?=$e_prov_id?>"><?=$e_prov_na?></option>
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
                <option value="<?=$e_model_id?>"><?=$e_model_na?></option>
            <?php
                while($model = mysqli_fetch_array($all_model))
            {		
                    echo '<option value="'.$model["model_id"].'">'.$model["model_name"].'</option>';      		
            }?>	
                </select>
            </div>
            <div class="form-group col-md-4 input-group-lg">
                <label class="h5">S/N</label>
                <input class="form-control log_add_fontsize" value="<?=$e_sn?>" name="txt_sn"  placeholder="หมายเลข SN">     
            </div>  
            <div class="form-group col-md-4 input-group-lg">
            <label class="h5">ผู้ติดตั้ง</label>
                <select class="custom-select h-auto log_add_fontsize"  name="tech">	
                <option value="<?=$e_tech_id?>"><?=$e_tech_na?></option>
            <?php
                while($tech = mysqli_fetch_array($all_user))
            {		
                    echo '<option value="'.$tech["tech_id"].'">'.$tech["tech_name"].'</option>';      		
            }?>	
                </select>     
            </div>  
            <div class="form-group col-md-3 input-group-lg">
                <label class="h5">ผู้ติดต่อ</label>
                <input class="form-control log_add_fontsize" value="<?=$e_contact?>"  name="txt_contact" placeholder="ผู้ติดต่อ"/>           
            </div>          
            <div class="form-group col-md-3 input-group-lg">
                <label class="h5">หมายเลขโทรศัพท์</label>
                <input class="form-control log_add_fontsize" value="<?=$e_tele?>" name="txt_phone" placeholder="หมายเลขโทรศัพท์"/>           
            </div>          
            <div class="form-group col-md-3 input-group-lg">
            <label class="h5">วันเริ่มรับประกัน</label>
            <input type="date" class="form-control  log_add_fontsize" value="<?=$e_st_waran?>" name="st_war_date" placeholder="">
            </div>
            <div class="form-group col-md-3 input-group-lg">
            <label class="h5">วันหมดประกัน</label>
            <input type="date" class="form-control  log_add_fontsize" value="<?=$e_ed_waran?>" name="end_war_date" placeholder="">      
            </div>          
        </div> 
</div>
<br />
       <div align="center"> <button  name="bt_edit" value="comfirm" type="submit" class="btn btn-success btn-lg"  >ยืนยัน</button><br><br><br></div>
</div>
</div>
<?="</form>"?>
<?php
if(isset($_POST['bt_edit']))
{
		
        if($_POST['txt_location']!="" & $_POST['province']!="" & $_POST['model']!="" & $_POST['tech']!="" & $_POST['st_war_date']!="" 
        & $_POST['end_war_date']!="")
		{
            $insert="INSERT INTO tbl_mid_edit(service_no,user_id,edit_date) VALUES('".$service_no."','".$id."',NOW())";	
            $ins = mysqli_query($con,$insert);	
            if($ins)
            {               
                
                                                                                                							
            }
            elseif (!$ins) 
            {
                $message  = 'Invalid query: ' . mysqli_error() . "\n";
                $message .= 'Whole query: ' . $ins;
                die($message);
            }


            $update="UPDATE tbl_mid_service 
                SET 
                    sn='".$_POST['txt_sn']."',
                    model_id='".$_POST['model']."',
                    location='".$_POST['txt_location']."',
                    province_id='".$_POST['province']."',
                    tech_id='".$_POST['tech']."',
                    contact_person='".$_POST['txt_contact']."',
                    telephone='".$_POST['txt_phone']."',
                    st_waranty_date='".$_POST['st_war_date']."',
                    end_waranty_date='".$_POST['end_war_date']."'
                    WHERE service_no='".$service_no."'";                    
                
                $objQuery = mysqli_query($con,$update);	               
                if($objQuery)
                {               
                    
                    		                                             
                    echo '<script language="javascript">';
                    echo 'alert("อัปเดดข้อมูลเรียบร้อยแล้วครับ")';
                    echo '</script>';
                    mysqli_close($con);
                    echo "<script>window.opener.location.reload();</script>"; 
                    echo "<script>window.close();</script>";                   							
                }
                elseif (!$objQuery) 
                {
                    $message  = 'Invalid query: ' . mysqli_error() . "\n";
                    $message .= 'Whole query: ' . $update;
                    die($message);
                }
                else
                {	
                   
                    echo '<script language="javascript">';
                    echo 'alert("เกิดข้อผิดพลาด")';
                    echo '</script>';			
                }
            /*if($_POST['txt_sn']=="")
            {
                $update="UPDATE tbl_mid_service 
                SET 
                    sn='".$_POST['txt_sn']."',
                    model_id='".$_POST['model']."',
                    location='".$_POST['txt_location']."',
                    province_id='".$_POST['province']."',
                    tech_id='".$_POST['tech']."',
                    contact_person='".$_POST['txt_contact']."',
                    telephone='".$_POST['txt_phone']."',
                    st_waranty_date='".$_POST['st_war_date']."',
                    end_waranty_date='".$_POST['end_war_date']."'
                    WHERE service_no='".$service_no."'";                    
                
                $objQuery = mysqli_query($con,$update);	

                if($objQuery)
                {                                                            
                    echo '<script language="javascript">';
                    echo 'alert("อัปเดดข้อมูลเรียบร้อยแล้วครับ")';
                    echo '</script>';
                    mysqli_close($con);
                    echo "<script>window.opener.location.reload();</script>"; 
                    echo "<script>window.close();</script>";                   							
                }
                elseif (!$objQuery) 
                {
                    $message  = 'Invalid query: ' . mysqli_error() . "\n";
                    $message .= 'Whole query: ' . $update;
                    die($message);
                }
                else
                {	
                   
                    echo '<script language="javascript">';
                    echo 'alert("เกิดข้อผิดพลาด")';
                    echo '</script>';			
                }
            }
            else
            {
                $chk_sn=mysqli_query($con,"SELECT service_no,sn FROM tbl_mid_service WHERE sn='".$_POST['txt_sn']."'");
                if(mysqli_num_rows($chk_sn))
                {					
                    echo "<script type='text/javascript'>alert('หมายเลข SN นี้ได้ถูกลงทะเบียนแล้ว');</script>";		
                    mysqli_close($con);							 
                }
                else
                {			
                    $update="UPDATE tbl_mid_service 
                    SET 
                        sn='".$_POST['txt_sn']."',
                        model_id='".$_POST['model']."',
                        location='".$_POST['txt_location']."',
                        province_id='".$_POST['province']."',
                        tech_id='".$_POST['tech']."',
                        contact_person='".$_POST['txt_contact']."',
                        telephone='".$_POST['txt_phone']."',
                        st_waranty_date='".$_POST['st_war_date']."',
                        end_waranty_date='".$_POST['end_war_date']."'
                        WHERE service_no='".$service_no."'";                    
                    
                    $objQuery = mysqli_query($con,$update);	
    
                    if($objQuery)
                    {                                                            
                        echo '<script language="javascript">';
                        echo 'alert("อัปเดดข้อมูลเรียบร้อยแล้วครับ")';
                        echo '</script>';
                        mysqli_close($con);
                        echo "<script>window.opener.location.reload();</script>"; 
                        echo "<script>window.close();</script>";                   							
                    }
                    elseif (!$objQuery) 
                    {
                        $message  = 'Invalid query: ' . mysqli_error() . "\n";
                        $message .= 'Whole query: ' . $update;
                        die($message);
                    }
                    else
                    {	
                       
                        echo '<script language="javascript">';
                        echo 'alert("เกิดข้อผิดพลาด")';
                        echo '</script>';			
                    }
                }   
            }*/
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("กรุณากรอกข้อมูลให้ครบถ้วนด้วยครับ")';
			echo '</script>';	
		}
}	

?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>