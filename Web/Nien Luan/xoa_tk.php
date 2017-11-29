<? ob_start(); ?>
<html>

<head>
    <meta charset="utf-8">
    <title>Trang quản trị/xóa tài khoản khách hàng</title>
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

if(isset($_POST['xoa'])){
    require_once("connection.php");
    
        $sql1 = "DELETE FROM khachhang WHERE TENKH ='$TENKH'; "; 
        $sql1 .= "DELETE FROM dangky WHERE TENKH ='$TENKH'; "; 
            if(mysqli_multi_query($conn,$sql1)==TRUE){
                    echo '<script> alert("Xóa tài khoản '.$TENKH.' thành công!!!!")</script>';
                    echo '<script>window.location.assign("captaikhoan.php?select=tatca&tim=Tìm");</script>';
        }
    }
    if(isset($_POST['thoat'])){ 
            header('Location: captaikhoan.php?select=tatca&tim=Tìm');
}
?>
    <br>
    <div class="col-sm-2"></div>
     <div class="col-sm-8">
<form class="panel panel-info" action="xoa_tk.php?TENKH=<?=$TENKH?>" method="post">           
    <!-- Modal content-->
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Xóa tài khoản</center></h4>
      </div>
      <div class="panel-body">
            <div class="form-group">
				    <div class="col-sm-offset-3">
                            <?php echo "Bạn chắc chắn muốn xóa tài khoản khách hàng "."<strong>".$TENKH;"</strong>" ?>
				    </div>
    
          <br><br>

         <div class="form-group col-sm-12">
             <ul class="nav nav-pills col-sm-offset-4">
                 <li><input type="submit" class="btn btn-default"  name="xoa" value="Xóa Tài Khoản" /></li>
                <li><input type="submit" class="btn btn-default"  name="thoat" value="Thoát" /></li>
             </ul>
                
                
          </div>  
      </div>
    
</form>
</div>    
    </body>
</html>    
