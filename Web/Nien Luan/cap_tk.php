<?php
    session_start();
?>
<html>

<head>
    <meta charset="utf-8">
    <title>Trang bán hàng trực tuyến</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link style="text/css" href="css/font.css" rel="stylesheet">
    
</head>
<body>

<?php
$TENKH = $_GET['TENKH'];

//kiem tra neu la tai khoản nhân vien, chưa cấp
require_once("connection.php");

if(isset($_POST['cap'])){
    //lay du lieu tu form
    $stk = $_POST['sotaikhoan'];
    if($stk == ""){
            echo '<script> alert("Nhập số tài khoản cần cấp!!!!")</script>';   
    }else{
            $TENTK = $_SESSION['tenkh'];
        //cap nhap lai cac bảng
        $sql1 = "UPDATE khachhang SET SOTAIKHOAN = '$stk' WHERE TENKH ='$TENKH'; "; 
        $sql1 .= "UPDATE dangky SET TINHTRANG = 'da cap',TENTK ='$TENTK'  WHERE TENKH ='$TENKH'; "; 
          
        if($conn->multi_query($sql1) > 0){
            //unset($_SESSION['TENKH']);
                echo '<script> alert("Cấp mật khẩu cho tài khoản '.$TENKH.' thành công!!!!")</script>';
                echo '<script>window.location.assign("captaikhoan.php?select=chuacap&tim=Tìm");</script>';
        }
    }
}
if(isset($_POST['huy'])){
        header('Location: captaikhoan.php?select=chuacap&tim=Tìm');
}
?>

    <br>
<div class="col-sm-2"></div>
<div class="col-sm-8">
<form class="panel panel-info" action="cap_tk.php?TENKH=<?=$TENKH?>" method="post">           
    <!-- Modal content-->
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cấp tài khoản</h4>
      </div>
            <div class="panel-body">
            <div class="form-group">
				<label class="col-sm-3 col-sm-offset-2 control-label" for="tenkh">Tên Khách Hàng</label>
				    <div class="col-sm-5">
                            <?php echo "".$TENKH; ?>
				    </div>
            </div><br>
          
            <div class="form-group">
				<label class="col-sm-2 col-sm-offset-2 control-label" for="sotaikhoan">Số tài khoản</label>
				    <div class="col-sm-6">
				    <input type="text" class="form-control"  name="sotaikhoan" placeholder="Cấp số tài khoản" />
				    </div>
            </div>
          <br><br>

         <div class="form-group col-sm-12">
             <ul class="nav nav-pills col-sm-offset-4">
                 <li><input type="submit" class="btn btn-default"  name="cap" value="Cấp Tài Khoản" /></li>
                <li><input type="submit" class="btn btn-default"  name="huy" value="Hủy" /></li>
             </ul>
                
                
          </div>  
      </div>
    

</form>
    </div>    
    </body>
</html>  
    



