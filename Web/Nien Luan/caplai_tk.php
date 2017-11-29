<html>

<head>
    <meta charset="utf-8">
    <title>Trang quản trị/Cập nhập tài khoản</title>
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
?>
    <br>
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
<form class="panel panel-info" action="caplai_tk.php?TENKH=<?=$TENKH?>" method="post">           
    <!-- Modal content-->
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cấp lại tài khoản</h4>
      </div>
      <div class="panel-body">
            <div class="form-group">
				<label class="col-sm-3 col-sm-offset-2 control-label" for="tenkh">Tên Khách Hàng</label>
				    <div class="col-sm-5">
                           <h4> <?php echo "".$TENKH; ?></h4>
				    </div>
            </div><br><br>
          
            <div class="form-group">
				<label class="col-sm-2 col-sm-offset-2 control-label" for="sotaikhoan">Số tài khoản</label>
				    <div class="col-sm-6">
				    <input type="text" class="form-control"  name="sotaikhoan" placeholder="Cấp số tài khoản" />
				    </div>
            </div>
          <br><br>

         <div class="form-group col-sm-12">
             <ul class="nav nav-pills col-sm-offset-4">
                 <li><input type="submit" class="btn btn-default col-sm-offset-1"  name="caplai" value="Cấp Tài Khoản" /></li>
                <li><input type="submit" class="btn btn-default col-sm-offset-3"  name="dong" value="Hủy" /></li>
             </ul>
                
                
          </div>  
      </div>
    
    <?php
if(isset($_POST['caplai'])){
    require_once("connection.php");
    
    //lay du lieu tu form
        $stk = $_POST['sotaikhoan'];
    //lay makh tu bang khch hang
    
    if($stk == ""){
        echo '<script> alert("Nhập số tài khoản mới!!!!")</script>';
    }else{
     
        $sql1 = "UPDATE khachhang SET SOTAIKHOAN = '$stk' WHERE TENKH ='$TENKH'; "; 
        $sql1 .= "UPDATE dangky SET TINHTRANG = 'DA CAP' WHERE TENKH ='$TENKH'; ";
        $num = mysqli_multi_query($conn,$sql1);
        
        if($num > 0){
                echo '<script> alert("Cấp lại tài khoản '.$TENKH.' thành công!!!!")</script>';
                echo '<script>window.location.assign("captaikhoan.php?select=tatca&tim=Tìm");</script>';
                
        }
    }
}
if(isset($_POST['dong'])){
    header('Location: captaikhoan.php?select=tatca&tim=Tìm');
    exit();
}

?>
</form>
    </div>    
    </body>
</html>    