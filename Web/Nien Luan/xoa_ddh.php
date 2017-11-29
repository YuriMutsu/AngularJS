
<html>

<head>
    <meta charset="utf-8">
    <title>Trang Xóa đơn đặt hàng</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link style="text/css" href="css/font.css" rel="stylesheet">
</head>
<body>
    
<?php
// xóa cấp tài khoản
$STTDDH = $_GET['STTDDH']; 
    require_once("connection.php");
    require_once("functions.php");
    if(isset($_POST['xoa'])){
        //cap nhap lai cac bảng
            $sql1 = "DELETE FROM dondathang WHERE STTDDH ='$STTDDH'; "; 
            $sql1 .= "DELETE FROM chitietdathang WHERE STTDDH ='$STTDDH'; ";
            $num = mysqli_multi_query($conn,$sql1);
        if($num > 0){
                echo '<script> alert("Xóa đơn đặt hàng số '.$STTDDH.' thành công!!!!")</script>';
                echo '<script>window.location.assign("xuathoadon.php?select=tatca&tim=Tìm");</script>';
        }
}
if(isset($_POST['thoat'])){
    redirect_to('xuathoadon.php?select=tatca&tim=Tìm');
}
?>
<div class="col-sm-2"></div>
<div class="col-sm-8"> 
    <form class="panel panel-info" action="xoa_ddh.php?STTDDH=<?=$STTDDH?>" method="post">           
    <!-- Modal content-->
        <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Cập Nhập Đơn Đặt Hàng</center></h4>
      </div>
         <div class="panel-body">
            <div class="form-group">
				    <div>
                           <center><strong> <?php echo "Bạn chắc chắn muốn xóa đơn đặt hàng ".$STTDDH; ?></strong></center>
				    </div><br><br>
         <div class="form-group col-sm-12">
             <ul class="nav nav-pills col-sm-offset-4">
                <li><input type="submit" class="btn btn-default"  name="xoa" value="Xóa đơn đặt hàng" /></li>
                <li><input type="submit" class="btn btn-default"  name="thoat" value="Hủy" /></li>  
             </ul>      
          </div>  
      </div>
</div>
    </form>
</div>
</body>
</html>