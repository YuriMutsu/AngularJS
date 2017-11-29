
<html>

<head>
   <meta charset="utf-8">
  <title>Trang quản trị/Xóa tài khoản nhân viên</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link style="text/css" href="css/font.css" rel="stylesheet">
</head>
<body>

<?php
$TENTK = $_GET['TENTK'];
?>
    <br>
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
<form class="panel panel-info" action="xoa_tknv.php?TENTK=<?=$TENTK?>" method="post">           
    <!-- Modal content-->
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Xóa tài khoản nhân viên</center></h4>
      </div>
    <div class="panel-body">
            <div class="form-group">
				    <div class="col-sm-offset-3">
                            <?php echo "Bạn chắc chắn muốn xóa tài khoản nhân viên ".$TENTK; ?>
				    </div>
    
          <br><br>

         <div class="form-group col-sm-12">
             <ul class="nav nav-pills col-sm-offset-4">
                 <li><input type="submit" class="btn btn-default"  name="xoa" value="Xóa Tài Khoản" /></li>
                <li><input type="submit" class="btn btn-default"  name="thoat" value="Thoát" /></li>
             </ul>
                
                
          </div>  
      </div>
    </div>
    </form>
    </div>
    
    <?php
// xóa tài khoản
if(isset($_POST['xoa'])){
    require_once("connection.php");
        //cap nhap lai cac bảng
        $sql = "DELETE FROM nguoidung WHERE TENTK ='$TENTK' "; 
        if($conn->query($sql) > 0){
                echo '<script> alert("Xóa tài khoản '.$TENTK.' thành công!!!!")</script>';
                echo '<script>window.location.assign("captaikhoan_nv.php?select=tatca&tim=Tìm");</script>';
        }else{
            echo '<script> alert("Lỗi!!!Xóa tài khoản '.$TENTK. ' thất bại!!!!")</script>';
        }
    }
if(isset($_POST['thoat'])){
        header("Location: captaikhoan_nv.php?select=tatca&tim=Tìm");
}
?>
 
    </body>

</html>

