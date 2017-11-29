

<?php
    session_start();
//session_destroy();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang chủ</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link style="text/css" href="css/font.css" rel="stylesheet">
</head>

<body>
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
                        <li><a href="dangky.php"> Đăng Ký</a></li>
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
     <div class="row panel panel-info">           
        <div class="col-sm-12"> 
            <div class="row" height = "50" >                    
                    <form class = " panel panel-info" action="khuyến mãi.php" method="post">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                 <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                </ol>
                                <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                        <a href="khuyenmai.php" title="Khuyến mãi các sản phẩm giảm giá lên đến 50%">
                                                <img src="hinhanh/Sale-Banner-1920-x-600-FINAL.jpg" height="30%" width = "100%" > 
                                        </a>
                                </div>
                                <div class="item">
                                        <a href="khuyenmai_LT.php"  title="Mua laptop giá sốc, nhận ngay ưu đãi cực lớn">
                                                <img src="hinhanh/TBG-offer-homepage-banner-1920X600-1018-en.jpg" alt="2" 
                                                         height="30%" width = "100%">
                                        </a>                                                                                                    
                                </div>
                                <div class="item">
                                        <a href="muasanpham.php?MASP=DT01" title="Đặt hàng ngay Sony XZ để có gái tốt nhất thị trường">
                                                <img src="hinhanh/Banner-XZ.jpg" alt="2" 
                                                         height="30%" width = "100%">
                                        </a>                                                                                                    
                                </div>    
                            </div>
                            <!-- Left and right controls -->
                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                </a>
                            </div>
                    </form>
            </div>
    </div>
  
        <div class="panel-heading"> <h5>Các Sản Phẩm Bán Chạy</h5></div>
        <table class ="panel-body" align="center" border="1"> 
            <tr align="center"> 
                     
            </tr> 
<?php 
include("\kei noi\connection.php"); 
$d = 0;
$sql = "SELECT * FROM sanpham where TINHTRANG IS NULL";
    $result = mysqli_query($conn,$sql);

  while($row = mysqli_fetch_array($result))    
 { 
      $KHUYENMAI = $row['KHUYENMAI'];
      $KM = $KHUYENMAI *100 ;
      $d = $d+1;
            echo "<td>";
                echo "<table class='col-sm-12'   >";
                    echo "<tr style='margin:4px' >";
                         echo " <a href='muasanpham.php?MASP=$row[MASP]'>";
                        echo "<img height='230' width='280' src='hinhanh/".$row['HINHANH']."'>";
                        echo "</a>";       
                    echo"</tr>";
                    echo "<tr>";
                        echo "<th>";
                            echo "<h5 style='margin: 20px'> $row[TENSP]</h5>";
                            echo "<h5 style='margin: 20px'>Mã Sản Phẩm: $row[MASP]</h5>";
                            echo "<h5 style='margin: 20px; color:red'>Khuyến mãi: ".$KM."%</h5>";
                            echo "<h5 style='margin: 20px;color:red'>Giá bán: $row[DONGIA] đ</h5>";
                        echo "</th>";
                        echo "<th>";
                            echo"<br>";  echo"<br>";  echo"<br>";  echo"<br>";  
                            echo " <a class='btn btn-danger' href='muasanpham.php?MASP=$row[MASP]'>Mua  Ngay</a>";
                        echo "</th>";
                    echo '</tr>';  
                echo '</table>';
               echo"</td>";
   ?>
<?php
if($d % 4 == 0)
   echo "</tr>";
  }?>

</tr></table>
        
<div class="panel-heading"><h5> Các Sản Phẩm Người dùng đăng</h5></div>
        <table align="center" border="1"> 
                <tr align="center"> 
                     
                </tr> 
<?php 
include("\kei noi\connection.php"); 
        $d=0;
        $sql = "SELECT *  FROM dangsanpham";
        $result = mysqli_query($conn,$sql);
        $MASP = '';
while($row = mysqli_fetch_array($result))
    { 
            $MASP = $row['MASP'];
            $sql1 = "SELECT * FROM sanpham WHERE MASP ='$MASP'";
            $result1 = mysqli_query($conn,$sql1);
        while($row = mysqli_fetch_array($result1))  
        { 
            $TINHTRANG =$row['TINHTRANG'];
            if($TINHTRANG == ''){
            
            $d = $d+1;
             echo "<td>";
                echo "<table class='col-sm-12'   >";
                    echo "<tr style='margin:4px' >";
                         echo " <a href='muasanpham.php?MASP=$row[MASP]'>";
                        echo "<img height='230' width='280' src='hinhanh/".$row['HINHANH']."'>";
                        echo "</a>";       
                    echo"</tr>";
                    echo "<tr>";
                        echo "<th>";
                            echo "<h5 style='margin: 20px'> $row[TENSP]</h5>";
                            echo "<h5 style='margin: 20px'>Mã Sản Phẩm: $row[MASP]</h5>";
                            echo "<h5 style='margin: 20px; color:red'>Khuyến mãi: ".$KM."%</h5>";
                            echo "<h5 style='margin: 20px;color:red'>Giá bán: $row[DONGIA] đ</h5>";
                        echo "</th>";
                        echo "<th>";
                            echo"<br>";  echo"<br>";  echo"<br>";  echo"<br>";  
                            echo " <a class='btn btn-danger' href='muasanpham.php?MASP=$row[MASP]'>Mua  Ngay</a>";
                        echo "</th>";
                    echo '</tr>';  
                echo '</table>';
               echo"</td>";  
            }else{
            
            $d = $d+1;
            echo "<td>";
                echo "<table class='col-sm-12'   >";
                    echo "<tr style='margin:4px' >";
                         echo " <a href='muasanpham.php?MASP=$row[MASP]'>";
                        echo "<img height='230' width='280' src='hinhanh/".$row['HINHANH']."'>";
                        echo "</a>";       
                    echo"</tr>";
                    echo "<tr>";
                        echo "<th>";
                            echo "<h5 style='margin: 20px'> $row[TENSP]</h5>";
                            echo "<h5 style='margin: 20px'>Mã Sản Phẩm: $row[MASP]</h5>";
                            echo "<h5 style='margin: 20px; color:red'>Khuyến mãi: ".$KM."%</h5>";
                            echo "<h5 style='margin: 20px;color:red'>Giá bán: $row[DONGIA] đ</h5>";
                        echo "</th>";
                        echo "<th>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
                            echo " <button class='btn btn-default' style='color:red'>ĐÃ BÁN</button>";
                        echo "</th>";
                        echo '</tr>';  
                        echo '</table>';
               echo"</td>";
            
            }
   ?>
<?php
if($d % 4 == 0)
   echo "</tr>";
 }
                
  }?>                      
</tr></table>
                        
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
