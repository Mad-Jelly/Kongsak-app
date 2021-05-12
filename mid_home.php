<?php
ob_start();
session_start();
$id=$_SESSION["id"];
$name=$_SESSION["name"];
$authen=$_SESSION["authen"];
include("connect_table.php");
$result=mysqli_query($con,"SELECT * FROM view_mid_full_service  ORDER BY service_no");
if($authen==NULL)
{		
	header("location: index.php");	
}

if(isset($_POST['logout']))
{
	session_destroy();	
	header("location: index.php");	
}
$head='รายละเอียดการซ่อมทั้งหมด';

$_SESSION["year"]=date("Y");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>หน้าหลัก</title>
<link rel="shortcut icon" type="image/x-icon" href="image/icon.ico">
<link href="mid-css.css" rel="stylesheet" type="text/css" /> 
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />



</head>
<body style="background-color:#F9F9F9">

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

<script>
        $(document).ready(function () {
            $("#myTable").DataTable();
        });
</script>

<?php
				//echo "<form id=\"form1\"  method=\"post\" onsubmit=\"return confirm('ยืนยันการดำเนินการใช่หรือไม?');\">";
				echo "<form id=\"form1\"  method=\"post\" >";
				?>

<div class="all">
<br />
	<div class="header-padding">
		&nbsp;&nbsp;&nbsp;
        <img src="./image/mid.png" />                      
    </div>
            
	<ul class="nav nav-pills disabled" style="background-color: #e3f2fd;font-size:20px">
	<!--<li class="nav-item" style="padding-left:20px">
			<div  class="input-group-lg">    		        
				<input class="form-control log_add_fontsize textBox_img" name="txt_search" placeholder="*ค้นจากชื่อสถานที่"/>        
				
			</div>     
	</li>	
    <li class="nav-item">--->
      <a class="nav-link" style="margin-left:px;" href="javascript:window.location.href=window.location.href"></a>
    </li>
	<li class="nav-item h3" style="padding-left:10px">
      <a class="nav-link" href="./mid_order_home.php">รายละเอียดการสั่งซื้อ</a>
    </li>
	
	<?php
	if($authen==1)
	{		
		echo '<li class="nav-item" style="padding-left:800px;margin-left:200px;">
		<a  class="nav-link " href="#" OnClick="out()">ออกจากระบบ
		<input type="image" src="./image/logout.png" alt="Submit" width="18" height="20"></a> 		
		</a>  
	</li>  
	<li>		
	</li>';
	}
	else
	{
	echo '<li class="nav-item h3" style="margin-left:650px">
		<a class="nav-link" href="./mid_add_service.php">
		<input type="image" src="./image/plus.png" alt="Submit" width="20" height="20">
		เพิ่มข้อมูล
		</a>  
	</li>  
	<li>
		<span class="log_add_fontsize">/</span>
	</li>';

	echo '<li class="nav-item h3" style="padding-left:px">  
		<a  class="nav-link " href="#" OnClick="out()">ออกจากระบบ
		<input type="image" src="./image/logout.png" alt="Submit" width="18" height="20"></a> 
	</li>'  ;
		
	}
	?>	
	</ul>
	  
        
	<div class="content-body">
    
<br />
		<h1><?=$head?></h1>
		<br>
		<h1>MASTER IS HERE</h1>
<br />		
<table id="myTable" class="display" style="width: 100%;">
        <thead>
            <tr>
			<tr class="table-primary">
			<th width="70px" style="font-size:20px">ลำดับ</th>			
			<th style="width:400px;font-size:20px">สถานที่</th>
			<th style="width:150px;font-size:20px">จังหวัด</th>			
			<th style="width:170px;font-size:20px">รุ่นเครื่อง</th>
            <th style="width:150px;font-size:20px">S/N</th>
			<th style="width:170px;font-size:20px">วันหมดประกัน</th>
			</tr>
            </tr>
        </thead>
        <tbody>
			<?php
			if($_POST['txt_search'])
			{			
				$sear = $_POST['txt_search'];
				$search=mysqli_query($con,"SELECT * FROM view_mid_full_service WHERE location like '%$sear%'   ORDER BY service_no");
				if(mysqli_num_rows($search)==0)
				{
					echo '<script language="javascript">';
					echo 'alert("ไม่พบข้อมูลที่ค้นหา")';
					echo '</script>';
				}
				else
				{
					while($sea = mysqli_fetch_array($search))
					{ 
                        $date=date('ym');	
                        $end_war = date("ym", strtotime($sea["end_waranty_date"]));
                        if($end_war<$date)
                        {
                       	 	$color="#ffb6b0";			
						}
						
						$runno++;
			?>
						<tr style="font-size:18px;background-color:#FFF689">
                        <td><?=$runno?> </td>                                                
                        <td class="table_in_reserv"><a style="text-decoration:underline" href="mid_detail.php?service_no=<?=$sea["service_no"]?>"><?=$sea["location"]?></a></td>   
                        <td><?=$sea["province_name"]?></td>
                        <td><?=$sea["model_name"]?></td>  
                        <td><?=$sea["sn"]?></td>                       
                        <td style="background-color:<?=$color?>"><?=$sea["end_waranty_date"]?></td> 
                       
			<?php
                    }	                    
                    mysqli_close($con);	
                		
                }	
                						
            }
			
			else
            {
                while($re = mysqli_fetch_array($result))
                { 
                    $date=date('Ym');	
                    $end_war = date('Ym', strtotime($re["end_waranty_date"]));
                    if($end_war<$date)
                    {			
                    	$color="#ffb6b0";			
					}	
					elseif($end_war>$date)
					{
						$color="#b4d3b3";
					}	                    
                    $runno++;
                    if($runno%2!=0)
					{
						$stat="#F9F9F9";
					}
					else
					{
						$stat="";
					}
                    ?>

                    <tr style="font-size:22px;background-color:<?=$stat?>;height:70px;">
                    <td><?=$runno?> </td>  
                    <td><a style="text-decoration:underline" href="mid_detail.php?service_no=<?=$re["service_no"]?>"><?=$re["location"]?></a></td>                                                         
                    <td><?=$re["province_name"]?></td>
                    <td><?=$re["model_name"]?></td>   
                    <td><?=$re["sn"]?></td>                          
                    <td style="background-color:<?=$color?>"><?=$re["end_waranty_date"]?></td>                
                    <?php
                }	
                mysqli_close($con);				                			
            }			
			?>    
			 <?php	           
			echo "</form>";			            
            ?>         
        </tbody>
		</table>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

