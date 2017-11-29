

<?php
    session_start();
    if (!isset($_SESSION['tenkh']) || ($_SESSION['QUYENSD']!= 'khach hang' ) ){
    echo '<script>alert("Bạn cần phải đăng nhập để tiếp tục!")</script>';   
        echo '<script>window.location.assign("dangnhap.php");</script>';
        redirect_to('dangnhap.php');       
}
?>

<!DOCTYPE html>
<html lang="en">

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

<?php
    $MASP = $_GET['MASP'];
    $TENKH = $_SESSION['tenkh'];
?>
    
<body>
    
    <?php 
        include("connection.php"); 
            //lay thông tin tu bảng sản phẩm theo masp
                    $TONGTIEN = '';
                        $i = 0;
                    $sql = "SELECT * FROM sanpham WHERE MASP = '$MASP'";
                    $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result))
                {    
                        $TENSP =$row['TENSP'];
                        $HINHANH = $row['HINHANH'];
                        $DONGIA = $row['DONGIA'];
                        $KHUYENMAI = $row['KHUYENMAI'];
                        $MOTAKM = $row['MOTAKM'];
                        $MOTA = $row['MOTA'];
                        
if(isset($_POST['muangay'])){
        //Lấy thông tin tu form
                $SOLUONG = $_POST['soluong'];
        //ham lay ngay thang nam hien tai
                $today = date("Y/m/d");
    if($KHUYENMAI == ''){
                $TONGTIEN = $SOLUONG * $DONGIA;        
    }else{                
                $TONGTIEN = $SOLUONG * $DONGIA*(1-$KHUYENMAI);
        }
        //kiem tr so luong nguoi mua
            if($SOLUONG == "" || $SOLUONG <= 0){
                    echo '<script> alert("Vui lòng chọn số lượng sản phẩm cần mua!!!!")</script>';
            }else{
                    $sql = "SELECT * FROM dangsanpham WHERE MASP = '$MASP'";
                    $result = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_array($result)){
                            $MASP = $row['MASP']; 
                        $sql = "UPDATE sanpham SET TINHTRANG = 'da ban' WHERE MASP ='$MASP' ";
                            mysqli_query($conn,$sql);
                }
                
             //THEM DU LIEU VAO BANG DON DAT HANG
                $sql3 = "INSERT INTO dondathang(NGAYDH,TRIGIA,TINHTRANG) VALUES('$today','$TONGTIEN','chua giao'); ";

                $sql3 .= "INSERT INTO chitietdathang(MASP,TENKH,SOLUONG,DONGIA) VALUES('$MASP','$TENKH','$SOLUONG','$DONGIA'); "; 
            if ($conn->multi_query($sql3) === TRUE) {
                    echo '<script> alert("Đã thêm sản phẩm '.$TENSP.' vào giỏ hàng!!!!")</script>';
                    echo '<script>window.location.assign("sanpham.php");</script>';            
                }
            }
        } 
    }
?>
    
	<!-- Tao mot duong ngang -->
    <div class="container" style = "background-color:'red   '" >

     <div class="row panel panel-info">          
            <div class="panel-heading">

         			<div class="col-sm-6">
                        <a href="/"><h3>HỆ THỐNG QUẢN LÍ BÁN HÀNG ONLINE</h3></a>
                	</div>
               
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                 <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <?php if (!isset($_SESSION['tenkh'])): ?>
                        <li><a class="glyphicon glyphicon-user-add" href="dangky.php">Đăng Ký</a></li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-expanded="false">
                                Đăng Nhập <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="dangnhap.php">Khách hàng</a>
                                </li>
                                <li>
                                    <a href="dangnhap_nv.php">Nhân viên</a>
                                </li>
                                <li>
                                    <a href="dangnhap_qtv.php">Quản trị</a>
                                </li>
                            </ul>
                     </li>
                    <?php else: ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle glyphicon glyphicon-user" data-toggle="dropdown" role="button" aria-expanded="false">
                                <?php  echo "".$_SESSION['tenkh']; ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="dangxuat.php"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Đăng Xuất
                                    </a>

                                    <form id="logout-form" action="dangxuat.php" method="POST" style="display: none;">
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
				
                         </div>   
            <div class="panel-body" > 
                <div class="col-sm-4 ">
                    <br><br><br>
                       <form class="searchform cf" action="timkiem.php" method="get">
                        <input type="text" name="search" placeholder="Nhập những gì bạn muốn tìm">
                        <button type="submit" name="ok" value="search">Search</button>
                    </form>
                </div>            
                <div class="col-sm-8">
                
                <div class="col-sm-2">
                   <form class="form-inline" role="form">
                        <div class="input-group has-success">
                            <ul>
                                 <li><a href="trangchu.php"><center><img src="icon/home.png" height="30" ></center>TRANG CHỦ</a> </li>
                            </ul>
                    </div>
                  </form>
                </div>
                <div class="col-sm-2">
                    
                   <form class="form-inline" role="form">
                        <div class="input-group has-success">
                            <ul >
                                <?php if (!isset($_SESSION['tenkh'])): ?>
                                     <li><a href="giohang.php"><center><img src="icon/shopping_cart.png" height="30" ></center>GIỎ HÀNG</a> </li>
                                <?php elseif ($_SESSION['QUYENSD'] == "Administrator"): ?>
                                    <li><a href="captaikhoan_nv.php"><center><img src="icon/operator.png" height="30" ></center>CẤP TKNV</a> </li>
                                <?php elseif ($_SESSION['QUYENSD'] == "Nhan Vien"): ?>
                                    <li><a href="hoadon.php"><center><img src="icon/bills.png" height="30" ></center>HÓA ĐƠN</a> </li>
                                <?php else:   ?>
                                    <li><a href="giohang.php"><center><img src="icon/shopping_cart.png" height="30" ></center>GIỎ HÀNG</a> </li>
                                <?php endif ?>
                            </ul>
                    </div>
                  </form>
                </div>             
                <div class="col-sm-2">
                   <form class="form-inline" role="form">
                        <div class="input-group has-success">
                            <ul >
                                <?php if (!isset($_SESSION['tenkh'])): ?>
                                     <li><a href="dangsanpham.php"><center><img src="icon/writing.jpg" height="30" ></center>ĐĂNG BÀI</a> </li>
                                <?php elseif ($_SESSION['QUYENSD'] == "Administrator"): ?>
                                     <li><a href="captaikhoan.php"><center><img src="icon/edit_user-512.png" height="30" ></center>CẤP TKKH</a> </li>
                                <?php elseif ($_SESSION['QUYENSD'] == "Nhan Vien"): ?>
                                     <li><a href="xuathoadon.php"><center><img src="icon/Korawan_M_business2_10-512.png" height="30" ></center>IN HÓA ĐƠN</a> </li>
                                <?php else:   ?>
                                     <li><a href="dangsanpham.php"><center><img src="icon/writing.jpg" height="30" ></center>ĐĂNG BÀI</a> </li>
                                <?php endif ?>
                            </ul>
                        
                    </div>
                  </form>
                </div>
                <div class="col-sm-2">
                   <form class="form-inline" role="form">
                        <div class="input-group has-success">
                            <ul>
                                 <li><a href="khuyenmai.php"><center><img src="icon/sale.png" height="30" ></center>KHUYẾN MÃI</a> </li>
                            </ul>
                    </div>
                  </form>
                </div>
                <div class="col-sm-2">
                  <form class="form-inline" role="form">
                    <div class="input-group has-success">
                        <ul>
                                <?php if (!isset($_SESSION['tenkh'])): ?>
                                        <li><a href="sanpham.php"><center><img src="icon/icon_55-512.png" height="30" ></center>SẢN PHẨM</a> </li>
                                <?php elseif ($_SESSION['QUYENSD'] == "Administrator"): ?>
                                        <li><a href="capnhap_sanpham.php"><center><img src="icon/icon_55-512.png" height="30" ></center>SẢN PHẨM</a></li>
                                <?php else:   ?>
                                        <li><a href="sanpham.php"><center><img src="icon/icon_55-512.png" height="30" ></center>SẢN PHẨM</a> </li>
                                <?php endif ?>
                            </ul>
                    </div>
                      </form>
                </div>
                <div >
                   <form class="form-inline" role="form">
                        <div class="input-group has-success">
                            <ul>               
                                <?php if (!isset($_SESSION['tenkh'])): ?>
                                    <li><a href="doimatkhau.php"><center><img src="icon/changepass.png" height="30" ></center>ĐỔI MẬT KHẨU</a> </li>
                                <?php elseif ($_SESSION['QUYENSD'] == "Administrator"): ?>
                                    <li><a href="doimatkhau_qtv.php"><center><img src="icon/changepass.png" height="30" ></center>ĐỔI MẬT KHẨU</a> </li>
                                 <?php elseif ($_SESSION['QUYENSD'] == "Nhan Vien"): ?>
                                    <li><a href="doimatkhau_nv.php"><center><img src="icon/changepass.png" height="30" ></center>ĐỔI MẬT KHẨU</a> </li>
                                <?php else:   ?>
                                         <li><a href="doimatkhau.php"><center><img src="icon/changepass.png" height="30" ></center>ĐỔI MẬT KHẨU</a> </li>
                                <?php endif ?>
                            </ul>
                    </div>
                  </form>
                </div>
 
   
                </div>
                
        </div>
                </div>
        <div class="row panel panel-info">
                    
                    <div class="panel-heading"><center><h4>MUA SẢN PHẨM</h4></center></div>

                    <div class="panel-body">
                    <ul class="nav nav-pills">
                        <li class="col-sm-3">
                            <table border="2">
                                <th>
                                    <?php echo "<img height='400' width=480' src='hinhanh/".$HINHANH."'>"; ?>
                                </th>
                            </table>
                            </li>
                            <li class="col-sm-7">
                        <form  class="sign-in col-sm-offset-5 col-sm-10" action="muasanpham.php?MASP=<?=$MASP?>" method="post">
                            <br>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="hoten">Họ tên người mua:</label>
                                        <div class="col-sm-5 ">
                                            <strong><?php echo"".$TENKH ?></strong>
                                        </div>
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="masp">Mã sản phẩm:</label>
                                        <div class="col-sm-5 ">
                                            <?php echo"".$MASP ?>
                                        </div>
                                </div><br>

                            <div class="form-group ">
                                <label class="control-label col-sm-4" for="tensp" > Tên sản phẩm:</label>
                                    <div>
                                       <strong><?php echo"".$TENSP ?></strong>
                                    </div>
                                </div>
                            
                            <div class="form-group ">
                                <label class="control-label col-sm-4 " for="dongia" > Giá bán:</label>
                                    <div class="col-sm-5">
                                       <?php echo"".$DONGIA." đ" ?>
                                    </div>
                                </div>	<br><br>
				            <div class="form-group ">
                                <label class="control-label col-sm-4 " for="soluong" > Số lượng mua:</label>
                                    <div class="col-xs-4">
                                        <input class="form-control col-xs-4" name="soluong" type="number" >
                                        </input>
                                    </div>
                                </div>	<br><br>
                            <div class="form-group ">
                                <label class="control-label col-sm-4 " for="tongtien" > Tổng tiền:</label>
                                    <div class="col-xs-4">
                                       <?php echo "".$TONGTIEN; ?>
                                    </div>
                                </div>	<br>
                                 <div class="form-group ">
                                <label class="control-label col-sm-4 " for="khuyenmai" > Giảm giá:</label>
                                    <div class="col-xs-4">
                                       <?php echo "".$KHUYENMAI ?>
                                    </div>
                                </div><BR>
                                <div class="form-group ">
                                <label class="control-label col-sm-4 " for="motakm" >Khuyến mãi:</label>
                                    <div>
                                       <?php echo "".$MOTAKM ?>
                                    </div>
                                </div><BR>
                                <div class="form-group ">
                                <label class="control-label col-sm-4 " for="motakm" >Mô tả sản phẩm:</label>
                                    <div>
                                       <?php echo "".$MOTA ?>
                                    </div>
                                </div><BR>
                            <div class="form-group">
                                    <div class="col-sm-offset-4  col-sm-8">
                                         <input class="btn btn-primary" name="muangay" type="submit" value="Thêm vào giỏ hàng" >
                                        </input>

                                    </div>
                                </div>
       
                                
                                
                </form>
                                                   </li>
                     </ul>   
                </div>
                    </  div>



                    </div>
                    </table>

                </div>
                 
  </div>
          
    <hr/>	<!-- Tao mot duong ngang -->
     

    <footer>
        <div class="col-sm-6">
            <p>© Bản quyền thuộc .</p>
        </div>
        <div class="col-sm-6 col-sm-6">
            <ul class="nav nav-pills">
                <li><a href="trangchu.php">Trang chủ</a></li>
                <li><a href="sanpham.php">Sản Phẩm</a></li>
                <li><a href="contact.html">Liên hệ</a></li>
            </ul>
        </div>
    </footer>

</div>
</body>

</html>
