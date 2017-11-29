

<?php
    ob_start();

    session_start();
    if (!isset($_SESSION['tenkh'])) {
        echo '<script>alert("Bạn cần phải đăng nhập để tiếp tục!")</script>';  
        echo '<script>window.location.assign("dangnhap.php");</script>';           
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang khách hàng/đổi mật khẩu</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <link style="text/css" href="css/font.css" rel="stylesheet">    
    
</head>

<body>
    
    <?php
//doi mat khau la cập nhập lại số tai khoan trong csdl
 
   
    if(isset($_POST['doimatkhau'])){
        require_once("connection.php");
        //include('location.php');
        
        //láy dữ liệu từ form
        $sotaikhoan         =   $_POST["matkhaucu"];
        $matkhaumoi         =   $_POST["matkhaumoi"];
        $nhaplaimatkhau     =   $_POST["nhaplaimatkhau"];
        
        //lay sotaikhoan ra để so sánh
        $sql = "select sotaikhoan from khachhang where sotaikhoan = '$sotaikhoan' ";
			$query = mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($query); 
        
        //kiểm tra dư liệu nhập có đầy đủ
        if($sotaikhoan == "" || $matkhaumoi == "" || $nhaplaimatkhau == ""){
            
            echo '<script> alert("Điền đầy đủ thông tin!!!!")</script>';
        }elseif($num_rows == 0){
            
            echo '<script> alert("Mật khẩu sai!!!!")</script>';
            //kiem tra mật khẩu cũ có trùng khớp
        
        }elseif($matkhaumoi != $nhaplaimatkhau){
            
            echo '<script> alert("Nhập lại mật khẩu không đúng!!!!")</script>';
        
        }else{
            //cập nhập lại số tài khoản(password) cho khách hàng
            
            $sql = "UPDATE khachhang SET sotaikhoan = '$matkhaumoi' where sotaikhoan = '$sotaikhoan' ";
            $result = mysqli_query($conn, $sql);
            
            if($result > 0){
                echo '<script> alert("Đổi mật khẩu thành công!!!!")</script>';
                echo '<script>window.location.assign("trangchu.php");</script>';
            }
        
        }
    
    }
    if(isset($_POST['thoat'])){
    
    header('Location: trangchu.php');    
        
    }
    ob_end_flush();

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

                	<div class="panel panel-info">
		<div class ="panel-heading">
		 <center><h4>ĐỔI MẬT KHẨU NGƯỜI DÙNG</h4></center>
		</div>
		
		<div class="panel-body">
		<form class="form-horizontal col-sm-8 col-sm-offset-1" action="doimatkhau.php" method="post">
            <br>
			<div class="form-group ">
				<label class="control-label col-sm-5 " for="matkhaucu" > Nhập mật khẩu cũ:</label>
				 <div class="col-sm-7">
                                <input type="password" class="form-control" name="matkhaucu" placeholder="Nhâp mật khẩu cũ">
                            </div>
			</div>				
		 <div class="form-group">
                            <label class="control-label col-sm-5" for="matkhaumoi">Nhập mât khẩu mới:</label>
                                <div class="col-sm-7 ">
                                    <input type="password" class="form-control" name="matkhaumoi" placeholder="Nhập mật khẩu mới">
                                </div>
                        </div>	
            <div class="form-group">
                            <label class="control-label col-sm-5" for="nhaplaimatkhau">Nhập lại mật khẩu:</label>
                                <div class="col-sm-7 ">
                                    <input type="password" class="form-control" name="nhaplaimatkhau" placeholder="Nhập lại mật khẩu">
                                </div>
                        </div>	

               

                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-6">
                                <input type="submit" class="btn btn-primary" name="doimatkhau" value="Đổi mật khẩu"></input>
                                <input type="submit" class="btn btn-primary" name="thoat" value="Thoát"></input>
                                 
                                
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
