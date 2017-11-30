
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang đăng ký</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>   
  <link style="text/css" href="css/font.css" rel="stylesheet">
</head>

<body>
    
<?php
    if(isset($_POST['thoat'])){
    header('Location:trangchu.php');} 
    if(isset($_POST['dangky'])){
        include("\kei noi\connection.php");  
        $tenkh      = $_POST["hoten"];
        $diachi      = $_POST["diachi"];
        $sdt      = $_POST["sdt"];
        $email     = $_POST["email"];
        //lay du lieu tu csdl ra để sánh
            $sql = "select * from khachhang where email = '$email' ";
			$query = mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($query);
        //kiem tra thong tin nhap vào
        if ($tenkh == "" || $email == "" || $diachi =="" || $sdt== "") {
                echo '<script> alert("Điền đầy đủ thông tin!!!!")</script>';
		}elseif ($num_rows != 0) {                  
                echo '<script>alert("Email đã tồn tại. Vui lòng đăng ký email khác!!!!"); </script>'; 
            //kiem tra email
        }elseif(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)){              
                echo '<script> alert("Email không hợp lê!!!!")</script>';    
        } else{ //luu thong tin vao csdl
            $sql = "INSERT INTO khachhang(tenkh,diachi,sdt,email)
                    VALUES('$tenkh','$diachi ','$sdt','$email ')";
                mysqli_query($conn,$sql);    
        //them makh vao bang dang ky
        $today = date("Y/m/d");
        $makh = null;
        //lay makh tu bang kh
            $sql1 = "select * from khachhang where email = '$email' ";
            $result = $conn->query($sql1);
        //neu tim thay makh thi luu vao bang dang ky
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    $TENKH = $row["TENKH"] ;   
                    $sql1= "insert into dangky(TENKH,NGAYDK)
                        values('$TENKH','$today')";
                mysqli_query($conn,$sql1);  
                    echo '<script> alert("Đăng ký thành công!!!!")</script>';
                    echo '<script>window.location.assign("trangchu.php");</script>';
                }        
            }
        }
    }
?>
    
	<!-- Tao mot duong ngang -->
    <div class="container">
     <div class="row panel panel-info">       
         		<div class="panel-heading">
         			<div class="col-sm-9">
                        <a href="\Nien Luan\trangchu.php"><h3>HỆ THỐNG QUẢN LÍ BÁN HÀNG ONLINE</h3></a>
                	</div>
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <?php if (!isset($_SESSION['username'])): ?>
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
                                <?=$this->$_SESSION['username']?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="dangxuat.php"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
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
              <div class="col-sm-4">
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
					<div class="panel-heading">
						<h3 class="panel-title"><center><h4>Đăng ký thành viên</h4></center></h3>
					</div>
					<div class="panel-body">
						<form id="signupForm" method="post" class="form-horizontal" action="dangky.php">

							<div class="form-group">
								<label class="col-sm-4 control-label" for="hoten">Họ Tên*</label>
								<div class="col-sm-5">
									<input type="text" class="form-control"  name="hoten" placeholder="Họ tên khách hàng" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="Địa Chỉ">Địa Chỉ</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="diachi" name="diachi" placeholder="Địa chỉ" />
								</div>
							</div>
                            
                            <div class="form-group">
								<label class="col-sm-4 control-label" for="sdt">Số Điện Thoại:</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="sdt" name="sdt" placeholder="SĐT" />
								</div>
							</div>
                            
							<div class="form-group">
								<label class="col-sm-4 control-label" for="email">Email</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="email" placeholder="Hộp thư điện tử" />
								</div>
							</div>


							<div class="form-group">
								<div class="col-sm-9 col-sm-offset-4">
									<input type="submit" class="btn btn-primary col-sm-offset-2" name="dangky" value="Đăng Ký"></input>
                                    <input type="submit" class="btn btn-primary" name="thoat" value="Thoát"></input>
								</div>
							</div>

						</form>
					</div>
				</div>   

                
            </div>

        
        
        </div>
                 
           </div>
  

            </div>
            </table>
          
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