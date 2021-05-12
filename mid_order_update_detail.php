<?php
ob_start();
session_start();
$odnum=$_GET['od_num'];
$id=$_SESSION["id"];
$name=$_SESSION["name"];
$authen=$_SESSION["authen"];
include("connect_table.php");
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
</head>
<body>
<?php			
    echo "<form id=\"form1\" class=\"\"  method=\"post\" >";
    ?>
<div class="container bg-main">  
<div class="form-row pt-3 " align="left">
            <div class="form-group col-md-6 input-group-lg">
                <label class="h5">เลขที่ OD</label>
                <input class="form-control log_add_fontsize" name="txt_odnum" placeholder="*เลขที่ OD"/>           
            </div>            
            <div class="form-group col-md-6 input-group-lg">
                <label class="h5">เลขที่ PO</label>
                <input class="form-control log_add_fontsize" name="txt_ponum" placeholder="*เลขที่ PO"/>           
            </div>              
            <div class="form-group col-md-8 input-group-lg">
                <label class="h5">ผู้ซื้อ</label>
                <input class="form-control log_add_fontsize" name="txt_buyer"  placeholder="ผู้ซื้อ">     
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
            <div class="form-group col-md-8 input-group-lg">
                <label class="h5">สถานที่ติดตั้ง</label>
                <input class="form-control log_add_fontsize" name="txt_location"  placeholder="สถานที่ติดตั้ง">     
            </div>  
            <div class="form-group col-md-4 input-group-lg">
            <label class="h5">จังหวัด</label>
            <select class="custom-select h-auto log_add_fontsize"  name="txt_location_province">	
                <option value="">*เลือกจังหวัด</option>
            <?php
                while($province1 = mysqli_fetch_array($all_provi1))
            {		
                    echo '<option value="'.$province1["province_id"].'">'.$province1["province_name"].'</option>';      		
            }?>	
                </select>  
            </div>                   
        <div class="form-group col-md-12  pt-3 pb-5" style="margin: 0 auto">
            <button name="bt_add" value="comfirm" type="submit" class="btn btn-success btn-lg"  >บันทึกข้อมูล</button>
        </div> 
    </div>     
    
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
