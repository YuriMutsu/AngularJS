<?php
    session_start();
    if (!isset($_SESSION['tenkh'])) {
    echo '<script>alert("Bạn cần phải đăng nhập để tiếp tục!")</script>';   
	   header('Location: dangnhap.php');
        
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
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;
  }
        
  </style>
<style type="text/css">
    
body{
background-color: #F2F2F2;    
    
    }
/*--------------------------------------------------------------
2.0 - SEARCH FORM
--------------------------------------------------------------*/
.searchform {
  background:#f4f4f4;
  background:rgba(244,244,244,.79);
  border: 1px solid #d3d3d3;
    left: 50%;
  padding: 2px 5px;
  position: absolute;
    margin: -22px 0 0 -170px;
    top: 50%;
  width:339px;
  box-shadow:0 4px 9px rgba(0,0,0,.37);
  -moz-box-shadow:0 4px 9px rgba(0,0,0,.37);
  -webkit-box-shadow:0 4px 9px rgba(0,0,0,.37);
  border-radius: 10px;
  -moz-border-radius: 10px;
  -webkit-border-radius: 10px
}
 
.searchform input, .searchform button {
    float: left
}
.searchform input {
    background:#fefefe;
    border: none;
    font:12px/12px 'HelveticaNeue', Helvetica, Arial, sans-serif;
    margin-right: 5px;
    padding: 10px;
    width: 216px;
    box-shadow: 0 0 4px rgba(0,0,0,.4) inset, 1px 1px 1px rgba(255,255,255,.75);
    -moz-box-shadow: 0 0 4px rgba(0,0,0,.4) inset, 1px 1px 1px rgba(255,255,255,.75);
    -webkit-box-shadow: 0 0 4px rgba(0,0,0,.4) inset, 1px 1px 1px rgba(255,255,255,.75);
  border-radius: 9px;
  -moz-border-radius: 9px;
  -webkit-border-radius: 9px
}
    .searchform input:focus {
        outline: none;
        box-shadow:0 0 4px #0d76be inset;
        -moz-box-shadow:0 0 4px #0d76be inset;
        -webkit-box-shadow:0 0 4px #0d76be inset;
    }
    .searchform input::-webkit-input-placeholder {
    font-style: italic;
    line-height: 15px
    }
 
    .searchform input:-moz-placeholder {
      font-style: italic;
    line-height: 15px
    }
 
.searchform button {
    background: rgb(52,173,236);
    background: -moz-linear-gradient(top, rgba(52,173,236,1) 0%, rgba(38,145,220,1) 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(52,173,236,1)), color-stop(100%,rgba(38,145,220,1)));
    background: -webkit-linear-gradient(top, rgba(52,173,236,1) 0%,rgba(38,145,220,1) 100%);
    background: -o-linear-gradient(top, rgba(52,173,236,1) 0%,rgba(38,145,220,1) 100%);
    background: -ms-linear-gradient(top, rgba(52,173,236,1) 0%,rgba(38,145,220,1) 100%);
    background: linear-gradient(to bottom, rgba(52,173,236,1) 0%,rgba(38,145,220,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#34adec', endColorstr='#2691dc',GradientType=0 );
    border: none;
    color:#fff;
    cursor: pointer;
    font: 13px/13px 'HelveticaNeue', Helvetica, Arial, sans-serif;
    padding: 10px;
    width:106px;
    box-shadow: 0 0 2px #2692dd inset;
    -moz-box-shadow: 0 0 2px #2692dd inset;
    -webkit-box-shadow: 0 0 2px #2692dd inset;
  border-radius: 9px;
  -moz-border-radius: 9px;
  -webkit-border-radius: 9px;
}
    .searchform button:hover {
        opacity:.9;
    }  

    div table ul {
    
    border-top: 1px;
    
    }
    div#bg{position:fixed;top:0;left:0;width:100%;height:100%;z-index:-1;} 
   div{
    
     background-image:'C:\xampp\htdocs\hinhanh\nenweb.jpg';
    
    }
    div p a:hover {
        background-color:aliceblue; 
       
    }
    
    div ul#sp{
    list-style : none;
    
    }
    ul{
    padding-left:2px;
        list-style : none;
    }
    ul li{
      list-style : none;
margin: auto;
        border-bottom: 1px;
    }
    </style>    
    
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
                $sql = "INSERT INTO sanpham (MASP, TENSP, DONGIA,MOTA,HINHANH)
                        VALUES('$masp', '$tensp', '$dongia', '$mota','$hinhanh');";
                    mysqli_query($conn,$sql);
        
            if(move_uploaded_file($_FILES['file']['tmp_name'],$target)){

                $sql = "INSERT INTO dangsanpham (MASP,TENKH,NGAYDANG) 
                        VALUES('$masp','$tenkh','$today');";
                
        // thực thi câu $sql với biến conn lấy từ file connection.php

                if(mysqli_query($conn, $sql) == TRUE){
                  echo '<script>alert("Đăng sản phẩm thành công!")</script>';
                  //header('Location: trangchu.php');
                }else{
                    echo '<script>alert("Đăng sản phẩm không thành công!");</script>';
                  header('Location: dangsanpham.php');
                }            
        }
           }else{
        
         echo '<script>alert("File bạn chọn không phải là ảnh!");</script>';
}
    }
    ?>
    
     
	<!-- Tao mot duong ngang -->
    <div class="container">
     <div class="row panel panel-default">
            
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
                   
                     <form class="form-inline" role="form">

                    <div class="input-group has-success">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-search"> </span>
                        </span>
                            <input type="search" class="form-control" width="100%" placeholder="Tìm sản phẩm theo tên hay nhãn hiệu">
                    </div>
                      </form>
                </div>
                    
                <div class="col-sm-8">
                 <div class="col-sm-2">
                   <form class="form-inline" role="form">
                        <div class="input-group has-success">
                            <ul>
                                <li><center><img src="icon/home.png" height="30" ></center> </li>
                                <li><a href="trangchu.php">TRANG CHỦ</a></li>
                            </ul>
                    </div>
                      </form>
                </div>
                <div class="col-sm-2">
                   <form class="form-inline" role="form">
                        <div class="input-group has-success">
                            <ul>
                                <li><center><img src="icon/shopping_cart.png" height="30" ></center> </li>
                                <li><a href="giohang.php">GIỎ HÀNG</a></li>
                            </ul>
                    </div>
                      </form>
                </div>               
                <div class="col-sm-2">
                   <form class="form-inline" role="form">
                        <div class="input-group has-success">
                            <ul>
                                <li><center><img src="icon/writing.jpg" height="30" ></center> </li>
                                <li><a href="dangsanpham.php">ĐĂNG BÀI</a></li>
                            </ul>
                    </div>
                      </form>
                </div>
                <div class="col-sm-2">
                   <form class="form-inline" role="form">
                        <div class="input-group has-success">
                            <ul>
                                <li><center><img src="icon/sale.png" height="30" ></center> </li>
                                <li><a href="khuyenmai.php">KHUYẾN MÃI</a></li>
                            </ul>
                    </div>
                      </form>
                </div>
                <div class="col-sm-2">
                   <form class="form-inline" role="form">
                        <div class="input-group has-success">
                            <ul>
                                <li><center><img src="icon/icon_55-512.png" height="30" ></center> </li>
                                <li><a href="sanpham.php">SẢN PHẨM</a></li>
                            </ul>
                    </div>
                      </form>
                </div>
                </div>
                
        </div>
                </div>
        
        <div class="row">
            <table class="col-sm-12 table table-bordered">
                <th class="col-sm-2">
                    <ul class="list-group">

                    <?php if (!isset($_SESSION['tenkh'])): ?>
                        <li class="list-group-item list-group-item-action list-group-item-info"><a href="capnhap.php">Cập nhập sản phẩm</a></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><a href="captaikhoan.php">Cấp tài khoản</a></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><a href="doimatkhau.php">Đổi Mật khẩu</a></li>
                     <?php elseif ($_SESSION['QUYENSD'] == "Administrator"): ?>
                        <li class="list-group-item list-group-item-action list-group-item-info"><a href="capnhap.php">Cập nhập sản phẩm</a></li>
                        <li class="list-group-item list-group-item-action list-group-item-info"><a href="captaikhoan.php">Cấp tài khoản</a></li>
                            <li class="list-group-item"><a href="captaikhoan.php">Cấp tài khoản khách hàng</a></li>
                            <li class="list-group-item"><a href="captaikhoan.php">Cấp tài khoản nhân viên</a></li>
                    <li class="list-group-item  list-group-item-action list-group-item-info"><a href="doimatkhau_qtv.php">Đổi Mật khẩu</a></li>
                    <?php elseif($_SESSION['QUYENSD'] == "Nhan Vien"): ?>
                        <li class="list-group-item list-group-item-action list-group-item-info"><a href="doimatkhau_nv.php">Đổi Mật khẩu</a></li>
                    <?php else:   ?>
                    <li class="list-group-item list-group-item-action list-group-item-info"><a href="doimatkhau.php">Đổi Mật khẩu</a></li>
                        <?php endif ?>
                </ul>

                </th>
                <th class="col-sm-9" >

				<div class="panel panel-info col-sm-9 col-sm-offset-1">
					<div class="panel-heading">
						<h4><center>ĐĂNG SẢN PHẨM</center></h>
					</div>
					<div class="panel-body">
						<form id="dangsanpham" method="post" class="form-dangsanpham" action="register.php" enctype="multipart/form-data" >
                            <div class="form-gourp" >
                            <label class="col-sm-4 control-label" for="gender">Gender:</label>
                                <input type="radio" name="gender" value="Anh">Anh<b>/</b>
                                <input type="radio" name="gender" value="Chi">Chị
                                <br><br>
                            </div>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="tenkh">Họ Tên của bạn*</label>
								<div class="col-sm-5">
									<?php echo $_SESSION['tenkh']; ?>
								</div>
							</div><br><br>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="sdt">SDT*</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="sdt" placeholder="Số điện thoại" />
								</div>
							</div><br><br>
                            
                            <div class="form-group">
								<label class="col-sm-4 control-label" for="masp">Mã Sản phẩm*</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="masp" name="masp" placeholder="Mã Sản phẩm" />
								</div>
							</div><br><br>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="tensp">Tên Sản phẩm*</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="tensp" placeholder="Tên Sản phẩm" />
								</div>
							</div><br><br>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="dongia">Giá bán</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="dongia" placeholder="Gía bán sản phẩm" />
								</div>
							</div><br><br>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="hinhanh">Chọn hình ảnh</label>
								<div class="col-sm-5">
							       
                                        <input type="file" name="file" >
   
								</div>
							</div><br><br>

							<div class="form-group">
								<label class="col-sm-4 control-label" for="mota">Mô tả</label>
								<div class="col-sm-5">
									<textarea name="mota" rows="4" cols="30%"></textarea>
								</div>
							</div>

                            <br>
							<div class="form-group">
								<div class="col-sm-9 col-sm-offset-5">
									<input type="submit" class="btn btn-primary" name="xacnhan" value="Xác Nhận"></input>
                                
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