



<html>

<head>
    
    <meta charset="utf-8">
    <title>Trang Xuất đơn đặt hàng</title>
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
if(isset($_POST['xuat'])){
    require_once("connection.php");
    $today = date("Y/m/d");
    
            $sql = "SELECT * FROM chitietdathang WHERE STTDDH ='$STTDDH'";
            $result = $conn->query($sql);
        while($row = $result->fetch_array()){
                $MASP = $row['MASP'];
                $TENKH = $row['TENKH'];
                $SOLUONG = $row['SOLUONG'];
                $DONGIA = $row['DONGIA']; 
        $sql1= "SELECT * FROM dondathang  WHERE STTDDH ='$STTDDH'";
        $result1 = $conn->query($sql1);
        while($row = $result1->fetch_array()){
                
                $TRIGIA = $row['TRIGIA'];
        $sql2  = "UPDATE dondathang SET TINHTRANG = 'DA GIAO' WHERE STTDDH ='$STTDDH' ";
        if($conn->query($sql2) == TRUE){ 
                    $sql1 = "INSERT INTO hoadon(NGAYGH,TONGTIEN) VALUES('$today','$TRIGIA');";           
                    $sql1 .= "INSERT INTO chitiethd(TENKH,MASP,STTDDH,SOLUONG,DONGIA) VALUES('$TENKH','$MASP',$STTDDH,'$SOLUONG','$DONGIA');";                       
                    if($conn->multi_query($sql1) > 0){
                        //header('Location: xuathoadon.php?select=chuagiao&tim=Tìm');
                        echo '<script> alert("In hóa đơn cho đơn đặt hàng '.$STTDDH.' thành công!!!!")</script>';
                        echo '<script>window.location.assign("xuathoadon.php?select=chuagiao&tim=Tìm");</script>';   
                    }
            }
        }
    }
}
    if(isset($_POST['thoat'])){
        header('Location: xuathoadon.php?select=chuagiao&tim=Tìm');
}

?>
    <div class="col-sm-2"></div>
    <div class="col-sm-8"> 
<form class="panel panel-info" action="xuat_ddh.php?STTDDH=<?=$STTDDH?>" method="post">           
    <!-- Modal content-->
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Cập Nhập Đơn Đặt Hàng</center></h4>
      </div>
    <div class="panel-body">
            <div class="form-group">
				    <div class="col-sm-offset-3">
                            <?php echo "Bạn có muốn in hóa đơn cho đơn đặt hàng số ".$STTDDH; ?>
				    </div>
          <br><br>
         <div class="form-group col-sm-12">
             <ul class="nav nav-pills col-sm-offset-4">
                 <li><input type="submit" class="btn btn-default col-sm-offset-2"  name="xuat" value="In hóa đơn" /></li>
                <li><input type="submit" class="btn btn-default col-sm-offset-5"  name="thoat" value="Hủy" /></li>
             </ul>   
          </div>  
      </div>
    </div>
    </form>
</div>
</body>
</html>

