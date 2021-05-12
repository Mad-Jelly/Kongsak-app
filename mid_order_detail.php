<?php
ob_start();
session_start();
$odnum=$_GET['od_num'];
$id=$_SESSION["id"];
$name=$_SESSION["name"];
$authen=$_SESSION["authen"];
include("connect_table.php");
if($authen==NULL)
{		
	header("location: index.php");	
}

$all_tech=mysqli_query($con,"SELECT * FROM tbl_mid_technician");
$all_tech1=mysqli_query($con,"SELECT * FROM tbl_mid_technician");
$all_tech2=mysqli_query($con,"SELECT * FROM tbl_mid_technician");

$all_de=mysqli_query($con,"SELECT * FROM view_mid_order_full_process WHERE od_num='".$odnum."'");
$all_pro=mysqli_query($con,"SELECT lp.process_num,lp.od_num,lp.process_detail,lt.tech_name,lp.process_date,lp.open_person,lp.end_date,lp.remark
FROM tbl_mid_order_process lp,tbl_mid_technician lt 
WHERE lp.tech_id = lt.tech_id  AND lp.od_num='".$odnum."'");

$all_pro2=mysqli_query($con,"SELECT * FROM tbl_mid_order_process WHERE od_num='".$odnum."'");
$all_goods=mysqli_query($con,"SELECT * FROM tbl_mid_order_goods WHERE od_num='".$odnum."'");
$all_goods2=mysqli_query($con,"SELECT * FROM tbl_mid_order_goods WHERE od_num='".$odnum."'");

$remark=mysqli_query($con,"SELECT goods_number FROM tbl_mid_order_goods WHERE od_num='".$odnum."'");

$edit_good=mysqli_query($con,"SELECT goods_number FROM tbl_mid_order_goods WHERE od_num='".$odnum."'");

$edit_process=mysqli_query($con,"SELECT process_num FROM tbl_mid_order_process WHERE od_num='".$odnum."'");

while($all_dt = mysqli_fetch_array($all_de))
{
    $od=$all_dt['od_num'];
    $po=$all_dt['po_num'];
    $buyer=$all_dt['buyer_name'];
    $buyer2=$all_dt['buyer_province'];
    $b_location=$all_dt['location'];
    $b_location2=$all_dt['location_province'];
    $contact=$all_dt['contact_person'];
    $phone=$all_dt['telephone_number'];
    $mail=$all_dt['email'];
    $tech_id=$all_dt['tech_id'];
    $tech=$all_dt['tech_name'];
    $check_num=$all_dt['check_num'];
    $ins_sche=$all_dt['ins_schedule'];
    $scien=$all_dt['science_num'];
    $goods=$all_dt['goods_detail'];
    $end_date=$all_dt['end_date'];
    $tech_team=$all_dt['tech_team'];
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
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
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <?php			
    echo "<form id=\"form1\" class=\"\"  method=\"post\" >";
    ?>
<div class="container" style="width:1400px">        
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
            <div class="navbar-nav mr-auto nav">      

                  <!-- link trigger modal -->
                <a href="" class="nav-item nav-link " style="color:blue" data-toggle="modal" data-target="#exampleModal">
                <input class="mt-1" type="image" src="./image/plus.png"  width="18" height="20">
                เพิ่มข้อมูลใบสั่งซื้อ/แก้ไขข้อมูล
                </a>               
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูลใบสั่งซื้อ/แก้ไขข้อมูล</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                   
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">ผู้ติดต่อ</label>
                                <input class="form-control log_add_fontsize"  name="txt_contact" value="<?=$contact?>"/>         
                            </div>   
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">เบอร์โทรศัพท์</label>
                                <input class="form-control log_add_fontsize"  name="txt_phone" value="<?=$phone?>"/>         
                            </div>   
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">E-mail</label>
                                <input class="form-control log_add_fontsize"  name="txt_email" value="<?=$mail?>"/>         
                            </div>   
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">เลขที่ใบตรวจเช็ค</label>
                                <input class="form-control log_add_fontsize"  name="txt_check_num" value="<?=$check_num?>"/>         
                            </div>
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">ผู้ตรวจสอบสถานที่</label>
                                <select class="custom-select h-auto log_add_fontsize"  name="txt_tech" value="<?=$tech?>"> 	
                                    <option value="<?=$tech_id?>"><?=$tech?></option>
                                <?php
                                    while($mo_tech = mysqli_fetch_array($all_tech))
                                {		
                                        echo '<option value="'.$mo_tech["tech_id"].'">'.$mo_tech["tech_name"].'</option>';      		
                                }?>	
                                    </select>  
                            </div> 
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">กำหนดการติดตั้ง</label>
                                <input type="date" class="form-control  log_add_fontsize" name="txt_ins_date" value="<?=$ins_sche?>"/>        
                            </div>  
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">เลขที่ขอตรวจกรมวิทย์</label>
                                <input class="form-control log_add_fontsize"  name="txt_sci" value="<?=$scien?>"/>           
                            </div> 
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">รายละเอียดสินค้า</label>                                
                                <textarea class="form-control" id="area" rows="3" style="height:100%;" name="txt_goods_detail"><?=$goods?></textarea>             
                            </div>
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">รายชื่อทีมช่าง</label>
                                <input class="form-control log_add_fontsize"  name="txt_tech_team" value="<?=$tech_team?>"/>           
                            </div>  
                        </div>
                        <div class="modal-body">                           
                            <button type="submit"  name="btn_modal"  class="btn-lg btn-primary">บันทึกข้อมูล</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-nav ml-auto nav">      
                <a class="nav-item nav-link" href="./mid_order_home.php" style="color:blue"><input type="image" src="./image/back.png" alt="Submit" width="20" height="20"> ย้อนกลับ</a>      
                <a class="nav-item nav-link" style="color:blue" href="#" OnClick="out()">ออกจากระบบ
                    <input class="mt-1" type="image" src="./image/logout.png" alt="Submit" width="18" height="20">
                </a> 
            </div>
            </div>
        </nav>
    </div>
    </div>              
    <div class="row bg-main pl-5 pr-5 ">
        <div class="col-lg-12 h1 pt-5">
            รายละเอียดใบสั่งซื้อสินค้า
        </div>      
        <div class="form-row pt-3 " align="left">
            <div class="form-group col-md-6 input-group-lg">
                <label class="h5">เลขที่ OD</label>
                <input class="form-control bg-light log_add_fontsize " name="txt_odnum" value="<?=$od?>" readonly/>           
            </div>            
            <div class="form-group col-md-6 input-group-lg">
                <label class="h5">เลขที่ PO</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$po?>" readonly/>           
            </div> 
            <div class="form-group col-md-8 input-group-lg">
                <label class="h5">ผู้ซื้อ</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$buyer?>" readonly/>           
            </div>
            <div class="form-group col-md-4 input-group-lg">
                <label class="h5">จังหวัด</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$buyer2?>" readonly/>           
            </div> 
            <div class="form-group col-md-8 input-group-lg">
                <label class="h5">สถานที่ติดตั้ง</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$b_location?>" readonly/>           
            </div>
            <div class="form-group col-md-4 input-group-lg">
                <label class="h5">จังหวัด</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$b_location2?>" readonly/>           
            </div> 
            <div class="form-group col-md-4 input-group-lg">
                <label class="h5">ผู้ติดต่อ</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$contact?>" readonly/>           
            </div>
            <div class="form-group col-md-4 input-group-lg">
                <label class="h5">เบอร์โทรศัพท์</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$phone?>" readonly/>           
            </div>
            <div class="form-group col-md-4 input-group-lg">
                <label class="h5">E-mail</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$mail?>" readonly/>           
            </div>  
            <div class="form-group col-md-6 input-group-lg">
                <label class="h5">เลขที่ใบตรวจเช็ค</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$check_num?>" readonly/>           
            </div>
            <div class="form-group col-md-6 input-group-lg">
                <label class="h5">ผู้ตรวจสอบสถานที่</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$tech?>" readonly/>           
            </div> 
            <div class="form-group col-md-6 input-group-lg">
                <label class="h5">กำหนดการติดตั้ง</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$ins_sche?>" readonly/>           
            </div>
            <div class="form-group col-md-6 input-group-lg">
                <label class="h5">เลขที่ขอตรวจกรมวิทยาศาสตร์</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$scien?>" readonly/>           
            </div> 
            <div class="form-group col-md-12 input-group-lg">
                <label class="h5">รายละเอียดสินค้า</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$goods?>" readonly/>           
            </div>
            <div class="form-group col-md-12 input-group-lg">
                <label class="h5">รายชื่อทีมช่าง</label>
                <input class="form-control bg-light log_add_fontsize" name="txt_ponum" value="<?=$tech_team?>" readonly/>           
            </div>
        </div>
        <div class="col-lg-12 h1 pt-2">
        <hr>
            รายละเอียดสินค้า
        </div> 
        <div class="col-lg-12 h5 pt-4">
            <div class="table-responsive-lg ">
                <table class="table" border='1'>
            <?php
                if(mysqli_num_rows($all_goods)==0)                
                {
                }
                else
                {
                    echo' <thead>
                    <tr class="table-primary">
                    <th style="width:px" scope="col">ลำดับ</th>
                    <th style="width:px"scope="col">รายการสินค้า</th>                        
                    <th style="width:px" scope="col">จำนวน</th>
                    <th style="width:px" scope="col">หมายเหตุ</th>
                    </tr>
                     </thead>';                     
                     while($goods=mysqli_fetch_array($all_goods))
                    {
                        $c=0;
                        $i=0;
                        $s=0;
                        $html = $goods["goods_detail"];
                        $needle = "+";
                        $lastPos = 0;
                        $positions = array();
                        if($lastPos = strpos($html, $needle, $lastPos)!== false)
                        {
                                while (($lastPos = strpos($html, $needle, $lastPos))!== false) 
                                {
                                    $positions[] = $lastPos;
                                    $lastPos = $lastPos + strlen($needle);
                                }
                            echo'<tr align=left>
                            <td>'.$goods["goods_number"].'</td>';
                            echo'<td>';
                            foreach ($positions as $value)
                            {
                                $i=$value;
                                $s=$i-$c;
                                    if($i==$value)
                                    {
                                        echo substr($html,$c,$s);
                                        echo"</br>";            
                                    }
                                    $c=$value;         
                            }
                            echo substr($html,$i); 
                            echo '</td>';
                            echo '<td>'.$goods["goods_quantity"].'</td>
                            <td>'.$goods["remark"].'</td>
                            </tr>';       
                        }
                        else
                        {
                            echo'<tr align=left>
                            <td>'.$goods["goods_number"].'</td>
                            <td>'.$html.'</td>
                            <td>'.$goods["goods_quantity"].'</td>
                            <td>'.$goods["remark"].'</td>
                            </tr>';       
                        }                                                                    
                    }
                }                
            ?>
                </table>
            </div>
            <?php
              if($end_date==NULL)
              {
                  echo'<button type="button" class="btn-lg btn-success mt-3" data-toggle="modal" data-target="#add_goods">
                  เพิ่มรายละเอียดสินค้า
                  </button>                  
                  <div class="modal fade" id="add_goods" tabindex="-1" role="dialog" aria-labelledby="add_goodsLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h3 class="modal-title" id="add_goodsLabel">เพิ่มรายละเอียดสินค้า</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body" align=left>
                              <div class="form-group col-lg-12 input-group-lg">
                                  <label class="h5">รายการสินค้า</label>                                 
                                  <textarea class="form-control" id="area" rows="3" style="height:100%;" name="txt_good_de"></textarea>        
                              </div>                               
                              <div class="form-group col-md-12 input-group-lg">
                                  <label class="h5">จำนวน</label>
                                  <input  class="form-control  log_add_fontsize" name="txt_quan"/>        
                              </div>  
                              <div class="form-group col-md-12 input-group-lg">
                                  <label class="h5">หมายเหตุ</label>
                                  <input class="form-control log_add_fontsize"  name="txt_remark"/>           
                              </div>  
                              <div class="modal-body ">                           
                              <button type="submit"  name="btn_add_goods"  class="btn-lg btn-success">บันทึกข้อมูล</button>
                              </div>
                          </div>                    
                          </div>
                      </div>
                  </div>'  ;  

                  echo'<button type="button" class="ml-4 btn-lg btn-primary mt-3" data-toggle="modal" data-target="#add_remark">
                  เพิ่มเติมหมายเหตุ
                  </button>                  
                  <div class="modal fade" id="add_remark" tabindex="-1" role="dialog" aria-labelledby="add_goodsLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h3 class="modal-title" id="add_goodsLabel">เพิ่มรายละเอียดหมายเหตุ</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>                          
                          <div class="form-group col-md-12 input-group-lg mt-3 " align="left">
                          <label class="h5">ลำดับหมายเหตุ</label>
                          <select class="custom-select h-auto log_add_fontsize"  name="txt_goods_number"> 	
                              <option value="">เลือกลำดับหมายเหตุ</option>';                        
                              while($remark_no = mysqli_fetch_array($remark))
                          {		
                                  echo '<option value=';
                                  echo $remark_no["goods_number"];
                                  echo ">";
                                  echo $remark_no["goods_number"];
                                  echo'</option> ';     		
                          }
                          echo'
                              </select>  
                      </div> 
                      <div class="form-group col-md-12 input-group-lg" align="left">
                          <label class="h5">รายละเอียดหมายเหตุ</label>
                          <textarea class="form-control" id="area" rows="3" style="height:100%;" name="txt_goods_remark"></textarea>          
                      </div>   
                      <div class="modal-body " align="left">                           
                            <button type="submit"  name="btn_add_remark"  class="btn-lg btn-primary">บันทึกหมายเหตุ</button>
                      </div>
                          </div>
                      </div>
                  </div>'  ;      
                                        
              }
              if($authen==5&$end_date==NULL)
              {
                echo'<button type="button" class="ml-4 btn-lg btn-danger mt-3" data-toggle="modal" data-target="#edit">
                  แก้ไขรายละเอียดสินค้า
                  </button>                  
                  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="add_goodsLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                          <div class="modal-header">
                              <h3 class="modal-title" id="add_goodsLabel">แก้ไขรายละเอียดสินค้า</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>                          
                          <div class="form-group col-md-12 input-group-lg mt-3 " align="left">
                          <label class="h5">ลำดับสินค้า</label>
                          <select class="custom-select h-auto log_add_fontsize"  name="txt_edit_goods_number"> 	
                              <option value="">เลือกลำดับสินค้า</option>';                        
                              while($edit = mysqli_fetch_array($edit_good))
                          {		
                                  echo '<option value=';
                                  echo $edit["goods_number"];
                                  echo ">";
                                  echo $edit["goods_number"];
                                  echo'</option> ';     		
                          }
                          echo'
                              </select>  
                      </div> 
                      <div class="form-group col-md-12 input-group-lg" align="left">
                          <label class="h5">รายละเอียดการแก้ไข</label>
                          <textarea class="form-control" id="area" rows="3" style="height:100%;" name="txt_edit_goods_detail"></textarea>          
                      </div>   
                      <div class="form-group col-md-12 input-group-lg" align="left">
                        <label class="h5">จำนวน</label>
                        <input class="form-control log_add_fontsize"  name="txt_edit_goods_qty"/>           
                     </div>    
                      <div class="modal-body " align="left">                           
                            <button type="submit"  name="btn_edit_goods"  class="btn-lg btn-danger">บันทึกการแก้ไข</button>
                      </div>
                          </div>
                      </div>
                  </div>'  ;       
              }
            ?>
            <!---------------------------------------------------- Modal Add Goods ----------------------------------------------------->
            <!-- link trigger modal --
            <button type="button" class="btn-lg btn-success mt-3" data-toggle="modal" data-target="#add_goods">
                เพิ่มรายละเอียดสินค้า
                </button>
                <!-- Modal --
                <div class="modal fade" id="add_goods" tabindex="-1" role="dialog" aria-labelledby="add_goodsLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="add_goodsLabel">เพิ่มรายละเอียดสินค้า</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" align=left>
                            <div class="form-group col-lg-12 input-group-lg">
                                <label class="h5">รายการสินค้า</label>                                 
                                <textarea class="form-control" id="area" rows="3" style="height:100%;" name="txt_good_de"></textarea>        
                            </div>                               
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">จำนวน</label>
                                <input  class="form-control  log_add_fontsize" name="txt_quan"/>        
                            </div>  
                            <div class="form-group col-md-12 input-group-lg">
                                <label class="h5">หมายเหตุ</label>
                                <input class="form-control log_add_fontsize"  name="txt_remark"/>           
                            </div>  
                            <div class="modal-body ">                           
                            <button type="submit"  name="btn_add_goods"  class="btn-lg btn-success">บันทึกข้อมูล</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
             <!---------------------------------------------------- Modal Add Goods ----------------------------------------------------->


        </div>
       
        <div class="col-lg-12 h1 pt-3">
        <hr style="bold">
            การดำเนินงาน
        </div> 
        <div class="col-lg-12 h5 pt-4">
            <div class="table-responsive-lg ">
                <table class="table" border='1'>
                <thead>
                <?php
                $goods_no=0;
                if(mysqli_num_rows($all_pro)==0)
                {

                }
                else
                {
                    echo'<tr class="table-primary">
                        <th style="width:px" scope="col">ลำดับ</th>
                        <th style="width:px"scope="col">รายละเอียด</th>                        
                        <th style="width:px" scope="col">ช่าง</th>
                        <th style="width:px" scope="col">วันที่</th>
                        </tr>';
                        while($process = mysqli_fetch_array($all_pro))
                        {
                            $goods_no++;
                            echo'<tr align=left>
                            <td>'.$process["process_num"].'</td>
                            <td>'.$process["process_detail"].'</td>
                            <td>'.$process["tech_name"].'</td>
                            <td>'.$process["process_date"].'</td>
                            </tr>';                                                                      
                        }
                }
                ?>                                                                    
                </thead>
                </table>
            </div>
            <?php
            if($authen==5|($authen==9&$end_date==NULL))

            {
                echo'<button type="button" class="btn-lg btn-warning mb-3 mt-2" data-toggle="modal" data-target="#Process">
                รายละเอียดการดำเนินการ
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="Process" tabindex="-1" role="dialog" aria-labelledby="#Process" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="ProcessLabel">รายละเอียดการดำเนินการ</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" align=left>
                                    <div class="form-group col-md-12 input-group-lg">
                                        <label class="h5">รายละเอียดการดำเนินงาน</label>
                                        <textarea class="form-control" id="area" rows="3" style="height:100%;" name="txt_process_de"></textarea>          
                                    </div>   
                                    <div class="form-group col-md-12 input-group-lg">
                                        <label class="h5">ผู้ดำเนินการ</label>
                                        <select class="custom-select h-auto log_add_fontsize"  name="txt_process_tech"> 	
                                            <option value="">ช่างผู้ดำเนินการ</option>';                                
                                           while($pro_tech = mysqli_fetch_array($all_tech1))
                                        {		
                                                echo '<option value=';
                                                echo $pro_tech["tech_id"];
                                                echo ">";
                                                echo $pro_tech["tech_name"];
                                                echo'</option> ';     		
                                        }
                                        echo'
                                            </select>  
                                    </div> 
                                    <div class="form-group col-md-12 input-group-lg">
                                        <label class="h5">วันที่เข้าดำเนินการ</label>
                                        <input type="date" class="form-control  log_add_fontsize" name="txt_process_date"/>        
                                    </div>  
                                    <div class=" ml-3 mt-4 mb-2 custom-control custom-checkbox checkbox-xl">
                                        <input type="checkbox" class="custom-control-input h3" style="width:150px;"  name="chk_end_process" id="checkbox-3">
                                        <label class="custom-control-label" for="checkbox-3">จบการดำเนินงาน</label>
                                    </div>
                                    <div class="modal-body">                           
                                        <button type="submit"  name="btn_add_process"  class="btn-lg btn-warning">บันทึกข้อมูล</button>
                                        <hr>
                                    </div>                           
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            elseif($authen==9&$end_date!=NULL)
            {

            }
            if($authen==5)
            {
                echo'<button type="button" class="btn-lg btn-secondary mb-3 mt-2" data-toggle="modal" data-target="#edit_process">
                แก้ไขรายละเอียดการดำเนินการ
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="edit_process" tabindex="-1" role="dialog" aria-labelledby="#Process" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="ProcessLabel">แก้ไขรายละเอียดการดำเนินการ</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" align=left>
                                <div class="form-group col-md-12 input-group-lg mt-3 " align="left">
                                    <label class="h5">ลำดับการดำเนินการ</label>
                                    <select class="custom-select h-auto log_add_fontsize"  name="txt_edit_process_number"> 	
                                        <option value="">เลือกลำดับการดำเนินการ</option>';                        
                                        while($edit_pro = mysqli_fetch_array($edit_process))
                                    {		
                                            echo '<option value=';
                                            echo $edit_pro["process_num"];
                                            echo ">";
                                            echo $edit_pro["process_num"];
                                            echo'</option> ';     		
                                    }
                                    echo'
                                        </select>  
                                </div> 
                                    <div class="form-group col-md-12 input-group-lg">
                                        <label class="h5">รายละเอียดการดำเนินงาน</label>
                                        <textarea class="form-control" id="area" rows="3" style="height:100%;" name="txt_edit_process_detail"></textarea>          
                                    </div>   
                                    <div class="form-group col-md-12 input-group-lg">
                                        <label class="h5">ผู้ดำเนินการ</label>
                                        <select class="custom-select h-auto log_add_fontsize"  name="txt_edit_process_tech"> 	
                                            <option value="">ช่างผู้ดำเนินการ</option>';                                
                                           while($edit_tech = mysqli_fetch_array($all_tech2))
                                        {		
                                                echo '<option value=';
                                                echo $edit_tech["tech_id"];
                                                echo ">";
                                                echo $edit_tech["tech_name"];
                                                echo'</option> ';     		
                                        }
                                        echo'
                                            </select>  
                                    </div> 
                                    <div class="form-group col-md-12 input-group-lg">
                                        <label class="h5">วันที่เข้าดำเนินการ</label>
                                        <input type="date" class="form-control  log_add_fontsize" name="txt_edit_process_date"/>        
                                    </div>                                      
                                    <div class="modal-body">                           
                                        <button type="submit"  name="btn_edit_process"  class="btn-lg btn-secondary">บันทึกข้อมูล</button>
                                        <hr>
                                    </div>                           
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            
            ?>


            <!---------------------------------------------------- Modal Process ----------------------------------------------------->
            <!-- link trigger modal --
            <button type="button" class="btn-lg btn-warning mb-3 mt-2" data-toggle="modal" data-target="#Process">
            รายละเอียดการดำเนินการ
                </button>
                <!-- Modal --
                <div class="modal fade" id="Process" tabindex="-1" role="dialog" aria-labelledby="#Process" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title" id="ProcessLabel">รายละเอียดการดำเนินการ</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" align=left>
                                <div class="form-group col-md-12 input-group-lg">
                                    <label class="h5">รายละเอียดการดำเนินงาน</label>
                                    <textarea class="form-control" id="area" rows="3" style="height:100%;" name="txt_process_de"></textarea>          
                                </div>   
                                <div class="form-group col-md-12 input-group-lg">
                                    <label class="h5">ผู้ตรวจสอบสถานที่</label>
                                    <select class="custom-select h-auto log_add_fontsize"  name="txt_process_tech">--> 	
                                        <!--<option value="<?=$tech_id?>"><?=$tech?></option>
                                   <?php
                                        while($pro_tech = mysqli_fetch_array($all_tech1))
                                    {		
                                            echo '<option value="'.$pro_tech["tech_id"].'">'.$pro_tech["tech_name"].'</option>';      		
                                    }?>	
                                        </select>  
                                </div> 
                                <div class="form-group col-md-12 input-group-lg">
                                    <label class="h5">วันที่เข้าดำเนินการ</label>
                                    <input type="date" class="form-control  log_add_fontsize" name="txt_process_date"/>        
                                </div>  
                                <div class="modal-body">                           
                                    <button type="submit"  name="btn_modal"  class="btn-lg btn-warning">บันทึกข้อมูล</button>
                                    <hr>
                                </div>                           
                            </div>
                        </div>
                    </div>
                </div>
             <!---------------------------------------------------- Modal Process ----------------------------------------------------->



        </div>     
    </div>
    <?php

    if(isset($_POST['btn_modal']))
    {
        //echo $_POST['txt_contact'];
        if($authen==NULL)
        {		
            header("location: index.php");	
        }

        $update="UPDATE tbl_mid_order
        SET 
        contact_person='".$_POST['txt_contact']."',
        telephone_number='".$_POST['txt_phone']."',
        email='".$_POST['txt_email']."',
        check_num='".$_POST['txt_check_num']."',
        location_inspector='".$_POST['txt_tech']."',
        ins_schedule='".$_POST['txt_ins_date']."',
        science_num='".$_POST['txt_sci']."' ,
        goods_detail='".$_POST['txt_goods_detail']."' ,
        tech_team='".$_POST['txt_tech_team']."'       
        WHERE od_num='".$odnum."'"; 

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
    elseif(isset($_POST['btn_add_goods']))
    {    
        if($authen==NULL)
        {		
            header("location: index.php");	
        }  
        if($_POST['txt_good_de']=='' | $_POST['txt_quan']=='')
        {
            echo'<script type="text/javascript">
                swal("", "กรุณากรอกข้อมูลสินค้าให้ครบถ้วนด้วยครับ !!", "error");
                </script>';
        }           
        else
        {
            if(mysqli_num_rows($all_goods2))
            {					
                while($chk_good = mysqli_fetch_array($all_goods2))
                {
                    $goods_num=$chk_good["goods_number"]+1;                                                                                              
                }            		
            }
            else
            {
                $goods_num=1;
            }
            $insert_goods="INSERT INTO tbl_mid_order_goods
                (
                    goods_number,
                    od_num,
                    goods_detail,
                    goods_quantity,
                    open_person,
                    open_date,
                    remark
                )            
                VALUES
                (
                    '".$goods_num."',
                    '".$odnum."',
                    '".$_POST['txt_good_de']."',
                    '".$_POST['txt_quan']."',
                    '".$id."',
                    NOW(),
                    '".$_POST['txt_remark']."'
                )";

                $objQuery = mysqli_query($con,$insert_goods);	
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
                            location = location;
                            close();
                        }
                    })
                    </script>';                                               
                            mysqli_close($con);                                                     
                }
                elseif(!$objQuery1)
                {
                    echo
                '<script type="text/javascript">
                swal("", "เกิดข้อผิดพลาด !!", "error");
                </script>';	
                $message  = 'Invalid query: ' . mysqli_error() . "\n";
                $message .= 'Whole query: ' . $insert_goods;
                die($message);
                }
        }
        
    }
    elseif(isset($_POST['btn_add_process']))
    {   
        if($authen==NULL)
        {		
            header("location: index.php");	
        } 
        if($_POST['txt_process_de']=='' | $_POST['txt_process_tech']==''| $_POST['txt_process_date']=='')
        {
            echo'<script type="text/javascript">
                swal("", "กรุณากรอกข้อมูลการดำเนินงานให้ครบถ้วนด้วยครับ !!", "error");
                </script>';
        }   
        else
        {
            if(mysqli_num_rows($all_pro2))
            {
                while($chk_pro = mysqli_fetch_array($all_pro2))
                {
                    $pro_num=$chk_pro["process_num"]+1;                                                                                              
                }
            }
            else
            {
                $pro_num=1;

            }
            $insert_process="INSERT INTO tbl_mid_order_process
                (
                    process_num,
                    od_num,
                    process_detail,
                    tech_id,
                    process_date,
                    open_person              
                )            
                VALUES
                (
                    '".$pro_num."',
                    '".$odnum."',
                    '".$_POST['txt_process_de']."',
                    '".$_POST['txt_process_tech']."',
                    '".$_POST['txt_process_date']."',
                    '".$id."'                
                )";

                $objQuery = mysqli_query($con,$insert_process);	
                $update="UPDATE tbl_mid_order SET order_status='".$_POST['txt_process_de']."' WHERE od_num ='".$odnum."'";
                $objQuery = mysqli_query($con,$update);

                if(!empty($_POST['chk_end_process']))
                {
                    $update="UPDATE tbl_mid_order SET end_date=NOW() WHERE od_num ='".$odnum."'";
                    mysqli_query($con, $update) ;
                }
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
                            location = location;
                            close();
                        }
                    })
                    </script>';                                               
                            mysqli_close($con);                                                     
                }
                elseif(!$objQuery)
                {
                        echo
                    '<script type="text/javascript">
                    swal("", "เกิดข้อผิดพลาด !!", "error");
                    </script>';	
                    $message  = 'Invalid query: ' . mysqli_error() . "\n";
                    $message .= 'Whole query: ' . $insert_process;
                    die($message);
                }
        }  
    }
    elseif(isset($_POST['btn_add_remark']))
    {
        if($authen==NULL)
        {	
            header("location: index.php");	
        } 
        if($_POST['txt_goods_remark']=='' | $_POST['txt_goods_number']=='')
        {
            echo'<script type="text/javascript">
                swal("", "กรุณากรอกข้อมูลหมายเหตุให้ครบถ้วนด้วยครับ !!", "error");
                </script>';
        }
        else
        {
            $update="UPDATE tbl_mid_order_goods SET remark='".$_POST['txt_goods_remark']."' WHERE od_num ='".$odnum."' AND goods_number='".$_POST['txt_goods_number']."'";
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
                             location = location;
                             close();
                            }
                        })
                    </script>';                                               
                    mysqli_close($con);                                                     
            }
            elseif(!$objQuery)
            {
                echo
                '<script type="text/javascript">
                swal("", "เกิดข้อผิดพลาด !!", "error");
                </script>';	
                $message  = 'Invalid query: ' . mysqli_error() . "\n";
                $message .= 'Whole query: ' . $insert_process;
                die($message);
            }
        }   
    }
    elseif(isset($_POST['btn_edit_goods']))
    {
        if($authen==NULL)
        {	
            header("location: index.php");	
        } 
        if($_POST['txt_edit_goods_number']=='' | $_POST['txt_edit_goods_detail']==''| $_POST['txt_edit_goods_qty']=='')
        {
            echo'<script type="text/javascript">
                swal("", "กรุณากรอกข้อมูลการแก้ไขสินค้าให้ครบถ้วนด้วยครับ !!", "error");
                </script>';
        }
        else
        {
            $update="UPDATE tbl_mid_order_goods SET goods_detail='".$_POST['txt_edit_goods_detail']."', goods_quantity='".$_POST['txt_edit_goods_qty']."' WHERE od_num ='".$odnum."' AND goods_number='".$_POST['txt_edit_goods_number']."'";
            $objQuery = mysqli_query($con,$update);        
            if($objQuery)
            {
               echo '<script type="text/javascript">
                    swal
                    ({
                        title: "แก้ไขข้อมูลสินค้าเรียบร้อยแล้วครับ?",                        
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
                    mysqli_close($con);                                                     
            }
            elseif(!$objQuery)
            {
                echo
                '<script type="text/javascript">
                swal("", "เกิดข้อผิดพลาด !!", "error");
                </script>';	
                $message  = 'Invalid query: ' . mysqli_error() . "\n";
                $message .= 'Whole query: ' . $insert_process;
                die($message);
            }
        }
    }
    elseif(isset($_POST['btn_edit_process']))
    {
        if($authen==NULL)
        {	
            header("location: index.php");	
        } 
        if($_POST['txt_edit_process_number']=='' | $_POST['txt_edit_process_detail']==''| $_POST['txt_edit_process_tech']==''| $_POST['txt_edit_process_date']=='')
        {
            echo'<script type="text/javascript">
                swal("", "กรุณากรอกข้อมูลการแก้ไขการดำเนินงานให้ครบถ้วนด้วยครับ !!", "error");
                </script>';
        }
        else
        {
            $update="UPDATE tbl_mid_order_process SET process_detail='".$_POST['txt_edit_process_detail']."', tech_id='".$_POST['txt_edit_process_tech']."' , process_date='".$_POST['txt_edit_process_date']."'
            WHERE od_num ='".$odnum."' AND process_num='".$_POST['txt_edit_process_number']."'";
            $objQuery = mysqli_query($con,$update);        
            if($objQuery)
            {
               echo '<script type="text/javascript">
                    swal
                    ({
                        title: "แก้ไขข้อมูลการดำเนินงานเรียบร้อยแล้วครับ",                        
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
                    mysqli_close($con);                                                     
            }
            elseif(!$objQuery)
            {
                echo
                '<script type="text/javascript">
                swal("", "เกิดข้อผิดพลาด !!", "error");
                </script>';	
                $message  = 'Invalid query: ' . mysqli_error() . "\n";
                $message .= 'Whole query: ' . $insert_process;
                die($message);
            }
        }
    }
    ?>
</form>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>