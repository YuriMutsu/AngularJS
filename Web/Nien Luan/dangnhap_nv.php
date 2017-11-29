
<?php
//khai báo sử dụng session
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang đăng nhập nhân viên</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link style="text/css" href="css/font.css" rel="stylesheet">    
    
</head>

<body>
    
<?php
    if(isset($_POST['dangnhap'])){
        require_once("connection.php");        
               //lay dữ liêu từ form
                $tentk      = $_POST["tendn"];
                $matk       = $_POST["password"];
                $quyensd   = "Nhan Vien";
               
            $sql = "select * from nguoidung where TENTK = '$tentk' and MATK = '$matk' and QUYENSD = '$quyensd' ";
            $query = mysqli_query($conn,$sql);
            $num_rows = mysqli_num_rows($query);
              
           //kiem tra du lieu nhap vao
        if ($tentk == "" || $matk =="") {
                echo '<script> alert("Tên tài khoản hoặc password bạn không được để trống!!!!")</script>';
		}elseif ($num_rows ==0) {
                echo '<script>alert("Tên đăng nhập hoặc mật khẩu không đúng!!!!"); </script>';          
			} else{           
           //so sanh ten tai khoan va password
                $sql = "select * from nguoidung where TENTK = '$tentk' and MATK = '$matk' and QUYENSD = '$quyensd'";
                $query = mysqli_query($conn,$sql);          
            if ($query->num_rows > 0) {
            // output data of each row
            while($row = $query->fetch_assoc()) {
                    $tentk = $row["TENTK"] ;
                    $quyensd = $row['QUYENSD'];
                //lấy tentk va quyen để lưu vào sesion
                        $_SESSION['tenkh'] = $tentk;
                        $_SESSION['QUYENSD'] = "Nhan Vien";
                    echo '<script>alert("Đăng Nhập tài khoản nhân viên thành công!!!!"); </script>';
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
                    <?php if (!isset($_SESSION['username'])): ?>
                        <li><a href="dangky.php">Đăng Ký</a></li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle glyphicon glyphicon-use" data-toggle="dropdown" role="button" aria-expanded="false">
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
                    <div class="panel panel-info">
            
		<div class ="panel-heading">
		<center><h4>ĐĂNG NHẬP TÀI KHOẢN NHÂN VIÊN</h4></center>
		</div>
		
		<div class="panel-body">
		<form class="sign-in col-sm-8" action="dangnhap_nv.php" method="post">

			<div class="form-group ">
				<label class="control-label col-sm-3 col-sm-offset-3 " for="tendn" > Tên Đăng Nhập:</label>
				 <div class="col-sm-6">
                                <input type="text" class="form-control" name="tendn" placeholder="Nhâp vào tên đănh nhập">
                            </div>
			</div>	<br><br>			
		 <div class="form-group">
                            <label class="control-label col-sm-3 col-sm-offset-3" for="password">Mât khâu:</label>
                                <div class="col-sm-6 ">
                                    <input type="password" class="form-control" name="password" placeholder="Nhâp vào mât khâu">
                                </div>
                        </div>	<br><br>				

                        <div class="form-group">
                            <div class="col-sm-offset-8 ">
                                 <input class="btn btn-primary" name="dangnhap" type="submit" value="Đăng Nhập" >
                                </input>
                            </div>
                        </div>
		</form>
                
		</div>
            </div>

            </th>
            </table>
          
        </div>
                 
      
     
          
    <hr/>	<!-- Tao mot duong ngang -->
     

    <footer>
        <div class="col-sm-6">
            <p>© Bản quyền thuộc .</p>
        </div>

    </footer>
  </div>
</body>

</html>
