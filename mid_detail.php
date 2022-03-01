<?php
ob_start();
session_start();
$id=$_SESSION["id"];
$name=$_SESSION["name"];
$authen=$_SESSION["authen"];
$service_no=$_GET['service_no'];
include("connect_table.php");
$result=mysqli_query($con,"SELECT * FROM view_mid_full_service WHERE service_no='".$service_no."'");
$process=mysqli_query($con,"SELECT pc.process_id,pc.service_no,pc.process_detail,tech.tech_name,pc.repair_no,pc.repair_date 
 FROM tbl_mid_process pc,tbl_mid_technician tech where pc.tech_id=tech.tech_id AND service_no='".$service_no."' ORDER BY open_date");
$chk_img_no=mysqli_query($con,"SELECT image_no FROM tbl_mid_service_image WHERE service_no='".$service_no."'"); 
if($authen==NULL)
{		
	header("location: index.php");	
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายละเอียด</title>
<link rel="shortcut icon" type="image/x-icon" href="image/icon.ico">
<link href="mid-css.css" rel="stylesheet" type="text/css" /> 
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/Javascript">
   function edit()
{
 	var url = "./mid_edit_detail.php?service_no=<?=$service_no?>";
	myRef = window.open(url ,'mywin','left=20,top=20,width=1400,height=540,toolbar=1,resizable=0');
	myRef.focus()   
}
</script>

<script type="text/Javascript">
   function popup()
{
 	var url = "./mid_open_process.php?service_no=<?=$service_no?>";
	myRef = window.open(url ,'mywin','left=20,top=20,width=1200,height=480,toolbar=1,resizable=0');
	myRef.focus()
}
</script>
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
    <?="<form id=\"form1\"  method=\"post\" enctype=\"multipart/form-data\" > "?>
<div class="all">
    <br />
    <div class="header-padding">
        &nbsp;&nbsp;&nbsp;
        <img src="./image/mid.png" />	
    </div>

    <ul class="nav nav-pills disabled" style="background-color: #e3f2fd;font-size:20px">	
    <li class="nav-item">
        <a class="nav-link" href="#" OnClick="edit()">แก้ไขรายละเอียด</a>
        </li>	
        <li class="nav-item" style="padding-left:920px">
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
        <h1>รายละเอียด</h1>
        <br />
        <?php
        while($detail = mysqli_fetch_array($result))
            {
                $end=$detail["end_date"];                
                $date=date('Ym');	
                $end_war = date('Ym', strtotime($detail["end_waranty_date"]));
                if($end_war<$date)
                {
                $color="#ffb6b0";			
                }
                elseif($end_war>$date)
					{
						$color="#b4d3b3";
					}	  	                            
        ?>
                <table align="center" border="1" style="font-size:20px" class="table-sm">
                    <tr>
                    <td align="right" style="font-weight:bolder" width="180px">ชื่อสถานที่ : </td>
                    <td colspan="" align="left" width="350px"><?=$detail["location"]?></td>
                   
                    <td align="right" style="font-weight:bolder" width="150px">จังหวัด : </td>
                    <td colspan="" align="left" width="250px"><?=$detail["province_name"]?></td>
                    </tr>
                    <tr>
                    <td align="right" style="font-weight:bolder" width="150px">รุ่นเครื่อง : </td>
                    <td colspan="1" align="left"><?=$detail["model_name"]?></td>
                    <td align="right" style="font-weight:bolder" width="150px">SN : </td>
                    <td colspan="2" align="left"><?=$detail["sn"]?></td>
                    </tr>
                    <tr>
                    <td align="right" style="font-weight:bolder" width="150px">ผู้ติดต่อ : </td>
                    <td colspan="" align="left"><?=$detail["contact_person"]?></td>
                    <td align="right" style="font-weight:bolder" width="150px">โทรศัพท์ : </td>
                    <td colspan="2" align="left"><?=$detail["telephone"]?></td>
                    </tr>
                    <tr>
                    <td align="right" style="font-weight:bolder" width="150px">ผู้ติดตั้ง : </td>
                    <td colspan="6" align="left"><?=$detail["tech_name"]?></td>        
                    </tr>
                    <tr>
                    <td align="right" style="font-weight:bolder" width="">วันที่เริ่มรับประกัน : </td>
                    <td colspan="" align="left"><?=$detail["st_waranty_date"]?></td>
                    <td align="right" style="font-weight:bolder" width="180px">วันที่หมดประกัน : </td>
                    <td colspan="2" align="left" style="background-color:<?=$color?>"><?=$detail["end_waranty_date"]?></td>
                    </tr>
                    <tr>
                    <td align="right" style="font-weight:bolder" width="">เพิ่มรูปภาพ : </td>
                    <td colspan="3" align="left"><input type="file" name="upload" />
                    <input type="submit"  name="save"  value="อัพโหลดรูปภาพ" />
                    </td>
                    </tr>
                   
                </table>
                
            <?php
             $locate=$detail["location"];
            }
            
                    echo "</form>
                    <br /><br />"; 
                    $pro_num=0;
                    if(empty($end))
                    {
                        echo "<input class=\"btn lg_bt btn-lg\" type=\"button\" name=\"bt_oplog\" value=\"การดำเนินงาน\"  onclick=\"popup();\"/>";
                        echo"<a href=\"./mid_detail_image.php?service_no=".$service_no."&loca=".$locate."\" style=\"margin-left:30px\" class=\"btn lg_bt btn-success btn-lg\" >รูปภาพเพิ่มเติม</a>";
                       // echo "<input style=\"margin-left:30px\" class=\"btn lg_bt btn-success btn-lg\" type=\"button\" name=\"bt_oplog\" value=\"ภาพประกอบ\" href=\"./mid_detail_image.php\"";
                        echo" <br /><br /><br />" ;
                    }
                    
                    if(mysqli_num_rows($process)==0)
                    {
                
                    }	
                   else
                   {
                        
                        echo "<table align=\"center\"  border=\"1\" class=\"table-sm\">
                            <tr align=\"center\" style=\"font-size:22px\">
                            <th colspan=\"2\" width=\"60px\">ลำดับ.</th>
                            <th width=\"450px\" >รายละเอียด</th>
                            <th width=\"200px\">ช่าง</th>
                            <th width=\"150px\">เลขที่ใบซ่อม</th>
                            <th width=\"150px\">วันที่เข้าซ่อม</th>
                            </tr>";
                        while($pro = mysqli_fetch_array($process))
                        {    
                            $pro_num++;
                        echo"
                            <tr align=\"center\" style=\"padding-bottom:13px;padding-top:13px;font-size:20px\">
                            <td colspan=\"2\">".$pro_num."</td>
                            <td width=\"450px\" >".$pro["process_detail"]."</td>
                            <td width=\"100px\">".$pro["tech_name"]."</td>
                            <td width=\"150px\">".$pro["repair_no"]."</td>
                            <td width=\"150px\">".$pro["repair_date"]."</td>
                            </tr>";
                                
                        }
                                
                            echo "</table>";
                            echo "<br/><br/>";				
                            //mysqli_close($con);
                   }	
                    
             ?>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<?php

if($_POST){
    $ran_name=rand(0,10000);
    
    if(isset($_FILES['upload']))
    {
        $type = strrchr($_FILES['upload']['name'],".");
        $name_file =  $service_no.'_'.$ran_name.$type;
        $tmp_name =  $_FILES['upload']['tmp_name'];
        $locate_img ="./image_job/";
        if(move_uploaded_file($tmp_name,$locate_img.$name_file))
        {
            if(mysqli_num_rows($chk_img_no))
            {					
                while($chk_img = mysqli_fetch_array($chk_img_no))
                {
                    $img_no=$chk_img["image_no"]+1;                                                                                              
                }            		
            }
            else
            {
                $img_no=1;
            }
            $insert_img="INSERT INTO tbl_mid_service_image
                (
                    image_no,
                    image_name,
                    service_no,                    
                    open_id,
                    open_date                    
                )            
                VALUES
                (
                    '".$img_no."',
                    '".$name_file."',                    
                    '".$service_no."',
                    '".$id."',
                    NOW()                    
                )";
            $objQuery1 = mysqli_query($con,$insert_img);
            mysqli_close($con);	
            /*if(!$objQuery1)
                {
                    echo
                '<script type="text/javascript">
                swal("", "เกิดข้อผิดพลาด !!", "error");
                </script>';	
                $message  = 'Invalid query: ' . mysqli_error() . "\n";
                $message .= 'Whole query: ' . $insert_img;
                die($message);
                }*/

            echo '<script type="text/javascript">
                    swal("", "อัพโหลดรูปภาพเรียบร้อยแล้วครับ !!", "success");
                    </script>';               
        }
        else {
            echo '<script type="text/javascript">
                    swal("", "เกิดข้อผิดพลาด !!", "error");
                    </script>';      
        }
    }
}

?>    

