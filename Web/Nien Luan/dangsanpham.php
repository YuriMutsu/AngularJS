<?php
    session_start();
    if (!isset($_SESSION['tenkh'])|| $_SESSION['QUYENSD']!= "khach hang") {
    echo '<script>alert("Bạn cần phải đăng nhập tài khoản khách hàng để tiếp tục!")</script>';  
      echo '<script>window.location.assign("dangnhap.php");</script>';  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang khách hàng/đăng sản phẩm</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link style="text/css" href="css/font.css" rel="stylesheet">
    
</head>

<body>
    

    <?php
//lấy ngày hiện tại
    $today = date("Y/m/d");
    
    if(isset($_POST['xacnhan'])){
    
        require_once("connection.php");
        
//lay du lieu tu form        
        $tenkh = $_SESSION['tenkh'];
        $sdt       = $_POST['sdt'];
        $masp      = $_POST['masp'];
        $tensp     = $_POST['tensp'];
        $dongia    = $_POST['dongia'];
        $mota      = $_POST['mota'];
        $khuyenmai      = $_POST['khuyenmai'];
        $hinhanh = $_FILES['file']['name'];
        
        //lay du lieu tu csdl ra để so sánh
        $sql1 = "SELECT MASP FROM SANPHAM where MASP = '$masp'";
        $query1 = mysqli_query($conn,$sql1);
        $num_rows = mysqli_num_rows($query1);
        //kiem tra du lieu nhap vao
        if ($tenkh == "" || $sdt == ""||$masp == "" || $tensp == "" || $dongia == "") {
            echo '<script>alert("Nhập đầy đủ thông tin!")</script>';
		}elseif(empty($hinhanh)){
        
            echo '<script>alert("Vui lòng chọn hình ảnh cho sản phẩm!")</script>';
        
        }elseif($num_rows != 0) {
            //kiem tra ma san pham co ton tai ?       
            echo '<script>alert("Mã sản phẩm đã tồn tại!")</script>';
            
            //kiem tra co phai file anh
        }elseif(($_FILES['file']['type']  == "image/jpeg")
                ||($_FILES['file']['type']  == "image/png" )
                ||($_FILES['file']['type']  == "image/gif") ){  
            
            $target= "hinhanh/".basename($_FILES['file']['name']);
            $hinhanh = $_FILES['file']['name'];
                 
        //them thong tin san pham vao bang sản phẩm
                $sql = "INSERT INTO sanpham (MASP, TENSP, DONGIA,MOTA,HINHANH,MOTAKM)
                        VALUES('$masp', '$tensp', '$dongia', '$mota','$hinhanh','$khuyenmai');";
                    mysqli_query($conn,$sql);
        
            if(move_uploaded_file($_FILES['file']['tmp_name'],$target)){

                $sql = "INSERT INTO dangsanpham (MASP,TENKH,NGAYDANG) 
                        VALUES('$masp','$tenkh','$today');";
                
        // thực thi câu $sql với biến conn lấy từ file connection.php

                if(mysqli_query($conn, $sql) == TRUE){
                  echo '<script>alert("Đăng sản phẩm thành công!")</script>';
                  echo '<script>window.location.assign("trangchu.php");</script>';
                }else{
                    echo '<script>alert("Đăng sản phẩm không thành công!");</script>';
                  echo '<script>window.location.assign("dangsanpham.php");</script>';
                }            
        }
           }else{
         echo '<script>alert("File bạn chọn không phải là ảnh!");</script>';
}
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
                        <li><a href="dangnhap.php">Đăng Nhập</a></li>
                        
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
                <div class="col-sm-4">
                   <br><br><br>
                    <form class="searchform cf" action="timkiem.php" method="get">
                        <input type="text" name="search" placeholder="Nhập những gì bạn muốn tìm">
                        <button type="submit" name="ok" value="search">Tìm</button>
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
                <div class=" panel panel-info" >
					<div class="panel-heading">
						<h4><center>ĐĂNG SẢN PHẨM</center></h>
					</div>
					<div class="panel-body">
						<form id="dangsanpham" method="post" class="form-dangsanpham" action="dangsanpham.php" enctype="multipart/form-data" >
                            <div class="form-gourp" >
                            <label class="col-sm-2 col-sm-offset-3 control-label" for="gender">Giới tính:</label>
                                <input type="radio" name="gender" value="Anh">Anh<b>/</b>
                                <input type="radio" name="gender" value="Chi">Chị
                                <br><br>
                            </div>

							<div class="form-group">
								<label class="col-sm-2 col-sm-offset-3 control-label" for="tenkh">Họ Tên của bạn</label>
								<div class="col-sm-4">
									<strong><?php echo $_SESSION['tenkh']; ?></strong>
								</div>
							</div><br><br>

							<div class="form-group">
								<label class="col-sm-2 col-sm-offset-3 control-label" for="sdt">SDT*</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="sdt" placeholder="Số điện thoại" />
								</div>
							</div><br><br>
                            
                            <div class="form-group">
								<label class="col-sm-2 col-sm-offset-3 control-label" for="masp">Mã Sản phẩm*</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="masp" name="masp" placeholder="Mã Sản phẩm" />
								</div>
							</div><br><br>

							<div class="form-group">
								<label class="col-sm-2 col-sm-offset-3 control-label" for="tensp">Tên Sản phẩm*</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="tensp" placeholder="Tên Sản phẩm" />
								</div>
							</div><br><br>

							<div class="form-group">
								<label class="col-sm-2 col-sm-offset-3 col-sm-4 control-label" for="dongia">Giá bán*</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="dongia" placeholder="Gía bán sản phẩm" />
								</div>
							</div><br><br>

							<div class="form-group">
								<label class="col-sm-2 col-sm-offset-3 control-label" for="hinhanh">Chọn hình ảnh*</label>
								<div class="col-sm-4">
							       
                                        <input type="file" name="file" >
   
								</div>
							</div><br><br>

							<div class="form-group">
								<label class="col-sm-2 col-sm-offset-3 control-label" for="mota">Mô tả</label>
								<div class="col-sm-5">
									<textarea name="mota" rows="4" cols="40%"></textarea>
								</div>
							</div>
                            <div class="form-group">
								<label class="col-sm-2 col-sm-offset-3 control-label" for="km">Khuyến mãi(nếu có)</label>
								<div class="col-sm-5">
									<textarea name="khuyenmai" rows="4" cols="40%"></textarea>
								</div>
							</div>

                            <br><br><br><br>
							<div class="form-group">
								<div class="col-sm-9 col-sm-offset-5">
									<input type="submit" class="btn btn-primary" name="xacnhan" value="Xác Nhận"></input>
                                
								</div>
							</div>

						</form>
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