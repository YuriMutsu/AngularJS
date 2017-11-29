
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang quên mật khẩu</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link style="text/css" href="css/font.css" rel="stylesheet">

</head>

<body>
    
    <?php
        include("connection.php");
        require_once("functions.php");

         if(isset($_POST['llmk'])){
        
        $TENKH  = $_POST["tenkh"];
        $EMAIL  = $_POST["email"];
        
        //kiểm tra xem tên khách hàng có tồn tại
            $sql = "select * from khachhang where TENKH = '$TENKH'";
			$query = mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($query);
        
        //kiem tra xem ten khach hàng có trùng email đăng ký     
            $sql1 = "select * from khachhang where TENKH = '$TENKH' AND EMAIL = '$EMAIL'";
			$query1 = mysqli_query($conn,$sql1);
			$num_rows1 = mysqli_num_rows($query1);     
           
        if ($TENKH == ""){
                echo '<script> alert("Vui lòng nhập tên khách hàng cần lấy lại mật khẩu!!!!")</script>';
		}elseif($EMAIL == ""){
                echo '<script> alert("Vui lòng cung cấp email đã đăng ký tài khoản '.$TENKH.'!!!!")</script>';
        }elseif ($num_rows ==0) {
                echo '<script>alert("Khách hàng '.$TENKH.' chưa đăng ký tài khoản!!!!"); </script>';
        } elseif($num_rows1 ==0){
                echo '<script>alert("Email này không phải email đăng ký tài khoản '.$TENKH.'!!!!"); </script>';
        }else{
                  $sql2 = "select * from khachhang where TENKH = '$TENKH' AND EMAIL = '$EMAIL'";
			     $query2 = mysqli_query($conn,$sql2);
            
        //neu tim thay makh thi luu vao bang dang ky
                    if ($query2->num_rows > 0) {
            // output data of each row
            while($row = $query2->fetch_assoc()) {
                    $SOTAIKHOAN = $row["SOTAIKHOAN"] ;
                
                //Lưu vào session để xử lí sau này
                echo '<script>alert("Số tài khoản của khách hàng '.$TENKH.' là '.$SOTAIKHOAN.' "); </script>';
                echo '<script>window.location.assign("dangnhap.php");</script>';
                }                
            }
        }
    }
         if(isset($_POST['thoat'])){
                redirect_to('trangchu.php');
         }
    ?>
	<!-- Tao mot duong ngang -->
    <div class="container">
     <div class="row panel panel-info">         
            <div class="panel-heading">

         			<div class="col-sm-9">
                        <a href="trangchu.php"><h3>HỆ THỐNG QUẢN LÍ BÁN HÀNG ONLINE</h3></a>
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
                        <li><a href="dangky.php">Đăng Ký</a></li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
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
        
        <div class="row">
        
        <div class="panel panel-info" >
                  
		<div class =" panel-heading">
		<center><h4>LẤY LẠI MẬT KHẨU NGƯỜI DÙNG NGƯỜI DÙNG</h4></center>
		</div>
		
		<div class="panel-body">
				<form class="sign-in col-sm-offset-1 col-sm-8" action="quenmatkhau.php" method="post">

                     <div class="form-group ">
                    <label class="control-label col-sm-4 col-sm-offset-1 " for="tenkh" > Tên Đăng Nhập:</label>
                     <div class="col-sm-6">
                                    <input type="text" class="form-control" name="tenkh" placeholder="Nhâp vào tên khách hàng">
                                </div>
</div>	<br><br>			
                     <div class="form-group">
                                <label class="control-label col-sm-offset-1 col-sm-4" for="email">Email đăng ký:</label>
                                    <div class="col-sm-6 ">
                                        <input type="text" class="form-control" name="email" placeholder="Nhâp vào email đăng ký">
                                    </div>
</div>	<br><br>				
                     <div class="form-group">
                            <div class="col-sm-offset-5  col-sm-8">
                                 <input class="btn btn-primary" name="llmk" type="submit" value="Lấy lại mật khẩu" >
                                </input>
                            
                            <input class="btn btn-primary" name="thoat" type="submit" value="Thoát">   
                                </input>
                            </div>
                        </div>

            </form>
		</div>
            </div>

            </div>
         
    <hr/>	<!-- Tao mot duong ngang -->
    
    <footer>
        <div class="col-sm-6">
            <p>© Bản quyền thuộc .</p>
        </div>
        <div class="col-sm-6 col-sm-6">
            <ul class="nav nav-pills">
                <li><a href="index.html">Trang chủ</a></li>
                <li><a href="sanpham.html">Sản Phẩm</a></li>
                <li><a href="contact.html">Liên hệ</a></li>
            </ul>
        </div>
    </footer>
  </div>
</body>

</html>
