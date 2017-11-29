
<?php
    session_start();
?>
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
//lay file ket noi
        require_once("connection.php");
    if(isset($_POST['cap'])){
            $MATK = $_POST['matk'];
            
        //kiem tra du lieu nhap vao
        if($MATK == ""){
                echo '<script> alert("Vui lòng nhập mã tài khoản cần cấp!!!!")</script>';
        }else {
                $sql1 = "UPDATE nguoidung SET MATK = '$MATK', TINHTRANG = 'da cap' WHERE TENTK = '$TENTK'";
            if ($conn->query($sql1) === TRUE) {
                echo '<script> alert("Cấp mã tài khoản cho tài khoản '.$TENTK.' thành công!!!!")</script>';
                echo '<script>window.location.assign("captaikhoan_nv.php?select=chuacap&tim=Tìm");</script>';
            }
        }
    }
if(isset($_POST['dong'])){
    //quay lại trang trước đó
    header('Location: captaikhoan_nv.php?select=chuacap&tim=Tìm');
        
}
?>
    <br>
<div class="col-sm-2"></div>
<div class="col-sm-8">    
    <form class="panel panel-info" action="cap_tknv.php?TENTK=<?=$TENTK?>" method="post">           
    <!-- Modal content-->
        <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>Cấp tài khoản nhân viên</center></h4>
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
				    <input type="text" class="form-control"  name="matk" placeholder="Cấp mã tài khoản" />
				    </div>
            </div>
          <br><br>

         <div class="form-group col-sm-12">
             <ul class="nav nav-pills col-sm-offset-4">
                 <li><input type="submit" class="btn btn-default"  name="cap" value="Cấp Tài Khoản" /></li>
                <li><input type="submit" class="btn btn-default"  name="dong" value="Đóng" /></li>
             </ul>
                
                
          </div>  
      </div>
    

    </form>
    </div>
    </body>
</html>