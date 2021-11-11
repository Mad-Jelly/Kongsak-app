<?php
 
ob_start();
session_start();
$id=$_SESSION["id"];
$name=$_SESSION["name"];
$authen=$_SESSION["authen"];
$year=$_SESSION["year"];
include("connect_table.php");

$all_tech=mysqli_query($con,"SELECT * FROM tbl_mid_tech_onsite_tech");
$all_tech_search=mysqli_query($con,"SELECT * FROM tbl_mid_tech_onsite_tech");
$all_province=mysqli_query($con,"SELECT * FROM tbl_mid_province");
$job_type=mysqli_query($con,"SELECT * FROM tbl_mid_tech_onsite_job_type");

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
<link href="mid-css.css" rel="stylesheet" type="text/css" /> 
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
    echo "<form id=\"form1\" class=\"\"  method=\"post\" >";
    
    ?>
<div class="container-fluid" style="width:1400px">
    <div class="row  pt-5 pl-2 pb-2 bg ">
        <img src="./image/mid.png"  /> 
    </div>
    <div class="row  pt-3 pb-2"  style="background-color: #e3f2fd;">        
        <div class="col-lg h4" >
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
              
                
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
              
               <!--Start link trigger modal -->
              <a href="" class="nav-item nav-link " style="color:blue" data-toggle="modal" data-target="#exampleModal">
                <input class="mt-1" type="image" src="./image/plus.png"  width="18" height="20">
                  เพิ่มข้อมูล
                  </a>  
                 <!-- End link trigger modal -->  
                 <a href="" class="nav-item nav-link " style="color:blue" data-toggle="modal" data-target="#searchModal">
                <input class="mt-1" type="image" src="./image/plus.png"  width="18" height="20">
                  ค้นหาแบบละเอียด
                  </a>  
                
              <!--เริ่มการทำงาน Modal เพิ่มข้อมูล -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลการทำงาน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">   
                                          
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">*เลขที่ใบงาน</label>
                                <input class="form-control log_add_fontsize"  name="txt_job_id" />         
                            </div> 
                            <div class="form-group col-md-12 input-group-lg ">
                                <label class="h5">*ประเภทของใบงาน</label>
                                <select class="custom-select h-auto log_add_fontsize"  name="txt_job_type"> 	
                                    <option value="00">เลือกประเภทใบงาน</option>
                                <?php
                                    while($job = mysqli_fetch_array($job_type))
                                {		
                                        echo '<option value="'.$job["job_type_id"].'">'.$job["job_type_name"].'</option>';    		
                                }?>
                                    </select>  
                            </div>  
                            <div class="form-group col-md-12 input-group-lg ">
                                <label class="h5">*ช่าง</label>
                                <select class="custom-select h-auto log_add_fontsize"  name="txt_tech"> 	
                                    <option value="00">*เลือกช่าง</option>
                                <?php
                                    while($mo_tech = mysqli_fetch_array($all_tech))
                                {		
                                        echo '<option value="'.$mo_tech["tech_id"].'">'.$mo_tech["tech_name"].'</option>';    		
                                }?>
                                    </select>  
                            </div> 
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">*สถานที่</label>
                                <input class="form-control log_add_fontsize"  name="txt_location" />         
                            </div> 
                            <div class="form-group col-md-12 input-group-lg ">
                                <label class="h5">*จังหวัด</label>
                                <select class="custom-select h-auto log_add_fontsize"  name="txt_province"> 	
                                    <option value="00">*เลือกจังหวัด</option>
                                <?php
                                    while($provi = mysqli_fetch_array($all_province))
                                {		
                                        echo '<option value="'.$provi["province_id"].'">'.$provi["province_name"].'</option>';    		
                                }?>
                                    </select>  
                            </div>                                                       
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">*วันที่ออกหน้างาน</label>
                                <input type="date" class="form-control  log_add_fontsize" name="txt_onsite_date" />        
                            </div>                             
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">รายละเอียดงาน</label>                                
                                <textarea class="form-control" id="area" rows="3" style="height:100%;" name="txt_job_detail"></textarea>             
                            </div>                            
                        </div>
                        <div class="modal-footer">                           
                            <button type="submit"  name="btn_modal"  class="btn-lg btn-primary">บันทึกข้อมูล</button>
                        </div>
                        </div>
                    </div>
                </div>
              <!--จบการทำงาน Modal เพิ่มข้อมูล -->

              <!--เริ่มการทำงาน Search Modal-->
              <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog " role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">ค้นหาข้อมูลช่าง</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                                                                                                  
                            <div class="form-group col-md-12 input-group-lg ">
                                <label class="h5">*ช่าง</label>
                                <select class="custom-select h-auto log_add_fontsize"  name="txt_search_tech"> 	
                                    <option value="00">*เลือกช่าง</option>
                                <?php
                                    while($search_tech = mysqli_fetch_array($all_tech_search))
                                {		
                                        echo '<option value="'.$search_tech["tech_id"].'">'.$search_tech["tech_name"].'</option>';    		
                                }?>
                                    </select>  
                            </div>                                                                                
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">*เริ่มตั้งแต่วันที่</label>
                                <input type="date" class="form-control  log_add_fontsize" name="txt_search_onsite_date_start" />        
                            </div>                             
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">*จนถึงวันที่</label>
                                <input type="date" class="form-control  log_add_fontsize" name="txt_search_onsite_date_end" />        
                            </div>                            
                        </div>
                        <div class="modal-footer">                           
                            <button type="submit"  name="btn_modal_search_tech"  class="btn-lg btn-danger">ค้นหา</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!--จบการทำงาน Search Modal-->

              
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
                           // mysqli_close($con);	
                            
                        }
                          
                		        ?>
                
                        
                    </tbody>
                    </table>
        </div>
                
        
</div>
<?php
      
        if(isset($_POST['btn_modal']))
        {
          if($authen==NULL)
          {		
            header("location: index.php");	
          }

          $job_id=$_POST['txt_job_id'];
          $job_type=$_POST['txt_job_type'];
          $tech=$_POST['txt_tech'];
          $location=$_POST['txt_location'];
          $province=$_POST['txt_province'];
          $onsite_date=$_POST['txt_onsite_date'];
          $service_detail=$_POST['txt_job_detail']; 
          if($job_id!="" & $job_type!="" &$tech!="" & $province!="" & $onsite_date!="")
          {          
            $chk_job_sub_id=mysqli_query($con,"SELECT job_sub_id FROM tbl_mid_tech_onsite WHERE job_id='".$job_id."'");
            while($chk_job = mysqli_fetch_array($chk_job_sub_id))
            {
              $job_sub_id = $chk_job['job_sub_id'];
              
            }
            echo $job_sub_id;
            if(empty($job_sub_id))
            {
              $job_sub_id=1;                    
            }           
            else
            {
              $job_sub_id=$job_sub_id+1;
              
            } 
                      
            $insert_job="INSERT INTO tbl_mid_tech_onsite
            (
              job_id,
              job_sub_id,
              location,
              province_id,
              tech_id,
              service_detail,
              onsite_date,
              open_person,
              open_date

            )
            VALUES('".$job_id."','".$job_sub_id."','".$location."','".$province."','".$tech."',
                  '".$service_detail."','".$onsite_date."','".$id."',NOW())";

              $objQuery = mysqli_query($con,$insert_job);	               
              if($objQuery)
              {                                                           		                                             
                  echo '<script type="text/javascript">
                  swal
                  ({
                      title: "บันทึกข้อมูลเรียบร้อยแล้วครับ?",                        
                      icon: "success",
                      successMode: true,
                  })
                  .then(willDelete => {
                      if (willDelete) {
                          location = location;
                          close();
                      }
                  })
                  </script>';
                          echo "<script>
                          </script>"; 
                          mysqli_close($con);  
              }
              elseif (!$objQuery) 
              {
                  echo
                  '<script type="text/javascript">
                  swal("", "เกิดข้อผิดพลาด !!", "error");
                  </script>';	
                  $message  = 'Invalid query: ' . mysqli_error() . "\n";
                  $message .= 'Whole query: ' . $update;
                  die($message);
              }
              else
              {	    
                  echo   
                  '<script type="text/javascript">
                  swal("", "เกิดข้อผิดพลาด !!", "error");
                  </script>';		
              }
                                  
          }
          else
          {
            echo   
                  '<script type="text/javascript">
                  swal("", "กรุณากรอกข้อมูลให้ครบถ้วนด้วยครับ!!", "error");
                  </script>';		
          }
        }

          
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>