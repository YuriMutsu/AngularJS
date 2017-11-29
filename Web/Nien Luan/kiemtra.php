

<?php
    session_start();
    if (!isset($_SESSION['tenkh']) || ($_SESSION['QUYENSD']!= 'khach hang' ) ){
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

<?php
    $MASP = $_GET['MASP'];
    $TENKH = $_SESSION['tenkh'];
?>
    
<body>
    
    <?php 
        include("connection.php"); 
            //lay thông tin tu bảng sản phẩm theo masp
                    $TONGTIEN = '';
                    $sql = "SELECT * FROM sanpham WHERE MASP = '$MASP'";
                    $result = mysqli_query($conn,$sql);
                    while($row = mysqli_fetch_array($result))
                    {    
                       // $MASP = $row['MASP'];
                        $TENSP =$row['TENSP'];
                             //$_SESSION['TENSP'] = $TENSP ;
                        $HINHANH = $row['HINHANH'];
                            // $_SESSION['HINHANH'] = $HINHANH ;
                        $DONGIA = $row['DONGIA'];
                             //$_SESSION['DONGIA'] = $DONGIA ;
                        $KHUYENMAI = $row['KHUYENMAI'];
                             //$_SESSION['KHUYENMAI'] = $KHUYENMAI ;
                        $MOTAKM = $row['MOTAKM'];
                            //$_SESSION['MOTAKM'] = $MOTAKM ;
                        
    if(isset($_POST['muangay'])){
            //Lấy thông tin tu form
                    $SOLUONG = $_POST['soluong'];
            //ham lay ngay thang nam hien tai
                    $today = date("Y/m/d");
            if($KHUYENMAI == ''){
                    $TONGTIEN = $SOLUONG * $DONGIA;        
                }else{                
                        $TONGTIEN = $SOLUONG * $DONGIA*$KHUYENMAI;
                }
        //kiem tr so luong nguoi mua
            if($SOLUONG == "" || $SOLUONG <= 0){
                echo '<script> alert("Vui lòng chọn số lượng sản phẩm cần mua!!!!")</script>';
            }else{
    
             //THEM DU LIEU VAO BANG DON DAT HANG
            $sql3 = "INSERT INTO dondathang(NGAYDH,TRIGIA,TINHTRANG) VALUES('$today','$TONGTIEN','chua giao') ";
             
            $result3 = mysqli_query($conn,$sql3);
        
            //lay thong tin dat hang    
            $sql2 = "SELECT * FROM dondathang";
            $result2 = mysqli_query($conn,$sql2);
            
            if(mysqli_num_rows($result2) > 0){
            while($row = mysqli_fetch_assoc($result2))
                    {    
                                
                        $STTDDH = $row['STTDDH'];
                        //$SOLUONG = $_SESSION['SOLUONG'];
                            //unset($_SESSION['SOLUONG']);
                        //$DONGIA = $_SESISON['DONGIA'];
                            //unset($_SESSION['DONGIA']);

            //THEM DU LIEU VAO BANG CHI TIET DAT HANG
            $sql4 = "INSERT INTO chitietdathang(MASP,TENKH,STTDDH,SOLUONG,DONGIA) VALUES('$MASP','$TENKH','$STTDDH','$SOLUONG','$DONGIA') ";
            
            if ($conn->query($sql4) === TRUE) {
                    echo '<script> alert("Đã thêm sản phẩm vào giỏ hàng!!!!")</script>';
                header('Location: trangchu.php');
                    exit();
                
}
            }
        
        } 
        }
}
                    }
//unset($_SESSION['TENSP']);
?>
    
	<!-- Tao mot duong ngang -->
    <div class="container" style = "background-color:'red   '" >

     <div class="row panel panel-default">
            
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
            <table class="col-sm-12 table table-bordered ">
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
                    
                    <div class="panel panel-info">
                    <div class="panel-heading"><center><h4>MUA SẢN PHẨM</h4></center></div>

                    <div class="panel-body">
                    <ul class="nav nav-pills">
                        <li class="col-sm-5">
                               <?php echo "<img height='280' width='390' src='hinhanh/".$HINHANH."'>"; ?>
                            </li>
                            <li class="col-sm-6">
                        <form class="sign-in col-sm-12" action="muasanpham.php?MASP=<?=$MASP?>" method="post">
                            <br>
                                <div class="form-group">
                                    <label class="control-label col-sm-5" for="hoten">Họ tên người mua:</label>
                                        <div class="col-sm-5 ">
                                            <?php echo"".$TENKH ?>
                                        </div>
                                </div><br>
                                <div class="form-group">
                                    <label class="control-label col-sm-5" for="masp">Mã sản phẩm:</label>
                                        <div class="col-sm-5 ">
                                            <?php echo"".$MASP ?>
                                        </div>
                                </div><br>

                            <div class="form-group ">
                                <label class="control-label col-sm-5" for="tensp" > Tên sản phẩm:</label>
                                    <div>
                                       <?php echo"".$_SESSION['TENSP'] ?>
                                    </div>
                                </div>
                            
                            <div class="form-group ">
                                <label class="control-label col-sm-5 " for="dongia" > Giá bán:</label>
                                    <div class="col-sm-5">
                                       <?php echo"".$DONGIA ?>
                                    </div>
                                </div>	<br><br>
				            <div class="form-group ">
                                <label class="control-label col-sm-5 " for="soluong" > Số lượng mua:</label>
                                    <div class="col-xs-4">
                                        <input class="form-control col-xs-4" name="soluong" type="number" >
                                        </input>
                                    </div>
                                </div>	<br><br>
                            <div class="form-group ">
                                <label class="control-label col-sm-5 " for="tongtien" > Tổng tiền:</label>
                                    <div class="col-xs-4">
                                       <?php echo "".$TONGTIEN; ?>
                                    </div>
                                </div>	<br>
                                 <div class="form-group ">
                                <label class="control-label col-sm-7 " for="khuyenmai" > Khuyến Mãi:</label>
                                    <div class="col-xs-4">
                                       <?php echo "".$MOTAKM ?>
                                    </div>
                                </div>
                            <div class="form-group">
                                    <div class="col-sm-offset-4  col-sm-8">
                                         <input class="btn btn-primary" name="muangay" type="submit" value="Mua Ngay" >
                                        </input>

                                    </div>
                                </div>
       
                                
                                
                </form>
                                                   </li>
                     </ul>   
                </div>
                    </  div>



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
