
<html>

<head>
    <meta charset="utf-8">
    <title>Trang quản trị/Cấp tài khoản nhân viên</title>
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
    <form class="panel panel-info" action="caplai_tknv.php?TENTK=<?=$TENTK?>" method="post">           
    <!-- Modal content-->
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cập Nhập tài khoản nhân viên</h4>
      </div>
            <div class="panel-body">
            <div class="form-group">
				<label class="col-sm-3 col-sm-offset-2 control-label" for="tentk">Tên tài khoản</label>
				    <div class="col-sm-5">
                           <h4><strong><?php echo "".$TENTK; ?></strong></h4>
				    </div>
            </div><br>
          
            <div class="form-group">
				<label class="col-sm-2 col-sm-offset-2 control-label" for="sotaikhoan">Mã tài khoản</label>
				    <div class="col-sm-6">
				    <input type="text" class="form-control"  name="matk" placeholder="Cấp mã tài khoản mới" />
				    </div>
            </div>
          <br><br>

         <div class="form-group col-sm-12">
             <ul class="nav nav-pills col-sm-offset-4">
                 <li><input type="submit" class="btn btn-default col-sm-offset-1"  name="caplai" value="Cấp Tài Khoản" /></li>
                <li><input type="submit" class="btn btn-default col-sm-offset-4"  name="thoat" value="Thoát" /></li>
             </ul>
                
                
          </div>  
      </div>
    <?php
//cấp lại tài khoản
if(isset($_POST['caplai'])){
    require_once("connection.php");
    
    //lay du lieu tu form

    $MATK = $_POST['matk'];
    
    //kiem tra du lieu nhập vao
    if($MATK == ""){
        echo '<script> alert("vui lòng nhập mã tài khoản mới!!!!")</script>';
    }else{

        //cap nhap lai cac bảng
        $sql = "UPDATE nguoidung SET MATK = '$MATK',TINHTRANG='da cap' WHERE TENTK ='$TENTK' "; 
         
        if( $conn->query($sql) > 0){
                echo '<script> alert("Cấp nhập tài khoản '.$TENTK. ' thành công!!!!")</script>';
                echo '<script>window.location.assign("captaikhoan_nv.php?select=dacap&tim=Tìm");</script>';
        }
    }
}
     
if(isset($_POST['thoat'])){
    //tro ve trang cap tai khoan nhan viên
    header('Location: captaikhoan_nv.php?select=tatca&tim=Tìm');

}


?>

    </form>
</div>    
</body>
</html>

