<?php
ob_start();
session_start();
$id=$_SESSION["id"];
$name=$_SESSION["name"];
$authen=$_SESSION["authen"];
$year=$_SESSION["year"];
include("connect_table.php");

if($_SESSION["year"]==2020)
{
  $result=mysqli_query($con,"SELECT * FROM view_mid_order_full_process  WHERE end_date IS NOT NULL   ORDER BY open_date");
  $header='รายละเอียดการดำเนินการปี 2563';
}
else
{
  $result=mysqli_query($con,"SELECT * FROM view_mid_order_full_process  WHERE end_date IS NULL OR open_date like'%2021%'  ORDER BY open_date");
  $header='รายละเอียดการดำเนินการปี 2564';
  $_SESSION["year"]=2021;
}


if(isset($_POST['2020']))
{	
  $result=mysqli_query($con,"SELECT * FROM view_mid_order_full_process  WHERE end_date IS NOT NULL   ORDER BY open_date");
  $header='รายละเอียดการดำเนินการปี 2563';
  $_SESSION["year"]=2020;

}
elseif(isset($_POST['2021']))
{	
  $result=mysqli_query($con,"SELECT * FROM view_mid_order_full_process  WHERE end_date IS NULL OR open_date like'%2021%'  ORDER BY open_date");
  $header='รายละเอียดการดำเนินการปี 2564';
  $_SESSION["year"]=2021;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>หน้าหลัก</title>
<link rel="shortcut icon" type="image/x-icon" href="image/icon.ico">
<link href="mid-ins-css.css" rel="stylesheet" type="text/css" /> 
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./data-table-js.js"></script>
<link rel="stylesheet" type="text/css" href="./data-table.css" />

</head>

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


<script>
        $(document).ready(function () {
            $("#myTable").DataTable();
        });
</script>

<body>
    <?php			
    echo "<form id=\"form1\" class=\"form-inline\"  method=\"post\" >";
    ?>
<div class="container-fluid" style="width:1400px">
    <div class="row  pt-5 pl-2 pb-2 bg ">
        <img src="./image/mid.png"  /> 
    </div>
    <div class="row  pt-3 pb-2" style="background-color: #e3f2fd;">        
        <div class="col-lg h4" >
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
              
                <!--<li class="nav-item active pt-2">
                <input class="form-control mr-sm-2" type="search" name="txt_search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" name="btn_search" type="submit">Search</button>
                </li>-->
                <!--<li class="nav-item">
                  <a class="nav-link" href="#"style="color:blue">แสดงทั้งหมด <span class="sr-only">(current)</span></a>
                </li>-->
                <li class="nav-item">
                  <a class="nav-link" href="./mid_home.php"style="color:blue">รายการเข้าซ่อมทั้งหมด</a>
                </li>   
                <li class="nav-item dropdown" style="padding-left:20px">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" style="color:blue;" role="button" aria-haspopup="true" aria-expanded="false">แสดงผลตามปี</a>
                    <div class="dropdown-menu">
                      <input type="submit" class="dropdown-item"  name="2020"  value=" ปี2563"   />    
                      <input type="submit" class="dropdown-item"   name="2021"  value=" ปี2564"  />                      
                    </div>
                </li>
              </ul>
                 <a class="nav-link" href="./mid_order_add_process.php"style="color:blue">
                  <input type="image" src="./image/plus.png" alt="Submit" width="20" height="20">
                  เพิ่มข้อมูล
                  </a>  
                  <a class="nav-link" href="#" OnClick="out()" style="color:blue">ออกจากระบบ
		              <input type="image" src="./image/logout.png" alt="Submit" width="18" height="20"></a> 
                
              
                
              
            </div>
          </nav>
        </div>
        
        
    
    
    
    <!--<div class="col-sm-3">
            <input class="form-control mr-md-2"  type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </div>
        <div class="col-sm-2 pt-2">
        <a href="javascript:window.location.href=window.location.href">แสดงทั้งหมด</a>
        </div>
        <div class="col pt-2">
        <a  href="javascript:window.location.href=window.location.href">รายการเข้าซ่อมทั้งหมด</a>
        </div>
        <div class="col-sm-2  " >
        <a class="nav-link" href="./mid_ins_add_process.php">
		<input type="image" src="./image/plus.png" alt="Submit" width="20" height="20">
		เพิ่มข้อมูล
		</a>  
        </div>
        <div class="col-sm-2  " >
        <a  class="nav-link " href="#" OnClick="out()">ออกจากระบบ
		<input type="image" src="./image/logout.png" alt="Submit" width="18" height="20"></a> 
        </div>-->
        
    </div>
    
        <div class="row bg-main pt-5">
            <div class="col-lg-12 h1 pb-5">
                <?=$header?>
            </div>
        <div class="col-lg-12">
        
                <table  id="myTable"  class=" display " style="width: 100%;">
                    <thead>
                        <tr class="table-primary">
                        <th style="width:20px" scope="col">ลำดับ</th>
                        <th style="width:400px"scope="col">ชื่อสถานที่</th>
                        <th style="width:20px" scope="col">จังหวัด</th>
                        <th style="width:300px" scope="col">สินค้า</th>
                        <th style="width:200px" scope="col">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $runno=0;
                        if(isset($_POST['btn_search']))
                        {
                            $sear = $_POST['txt_search'];
                            $search=mysqli_query($con,"SELECT * FROM view_mid_order_full_process WHERE location like '%$sear%'   ORDER BY open_date");
                            if(mysqli_num_rows($search)==0)
                            {
                              echo '<script type="text/javascript">
                              swal("", "ไม่พบข้อมูลที่ค้นหาครับ!!", "error");
                              </script>';	
                              mysqli_close($con);	
                              echo $sear;
                            }
                            else
                            {
                              while($sea = mysqli_fetch_array($search))
                              {                                                            
                                
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
                            <tr style="font-size:18px;background-color:<?=$stat?>">
                            <td><?=$runno?> </td>                                                
                            <td class="table_in_reserv"><a style="text-decoration:underline" href="./mid_order_detail.php?od_num=<?=$sea["od_num"]?>"><?=$sea["location"]?></a></td>   
                            <td><?=$sea["location_province"]?></td>
                            <td><?=$sea["goods_detail"]?></td>  
                            <td><?=$sea["order_status"]?></td>  
                            </tr>
                            <?php
                            }	                    
                            mysqli_close($con);	
                            
                          }

                        }
                        else
                        {
                          while($sea = mysqli_fetch_array($result))
                            {                                                            
                                
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
                              <tr style="font-size:18px;background-color:<?=$stat?>;height:70px;">
                              <td><?=$runno?> </td>                                                
                              <td class="table_in_reserv"><a style="text-decoration:underline" href="./mid_order_detail.php?od_num=<?=$sea["od_num"]?>&year=<?=$sea["od_num"]?>"><?=$sea["location"]?></a></td>   
                              <td><?=$sea["location_province"]?></td>
                              <td><?=$sea["goods_detail"]?></td>  
                              <td><?=$sea["order_status"]?></td>  
                              </tr>
                            <?php
                            }	                    
                            mysqli_close($con);	
                            
                        }
                          
                		        ?>
                
                        
                    </tbody>
                    </table>
        </div>
                
        
</div>





  

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>