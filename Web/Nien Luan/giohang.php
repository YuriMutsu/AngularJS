

<?php
    session_start();
    if (!isset($_SESSION['tenkh']) || ($_SESSION['QUYENSD']== 'Administrator' ) ){
    echo '<script>alert("Bạn cần phải đăng nhập để tiếp tục!")</script>';   
	   header('Location: dangnhap.php');      
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang khách hàng/Xem giỏ hàng</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link style="text/css" href="css/font.css" rel="stylesheet">
    
</head>

<body>
	<!-- Tao mot duong ngang -->
    <div class="container">
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
                <div class=" " >
                    
                        <form method="get" class="panel panel-info" >
                        <div  class="panel-heading" ><center><h4>THÔNG TIN GIỎ HÀNG KHÁCH HÀNG</h4></center></div>
                        <div class="panel-body">
                        <div class="from-group col-sm-4">
                             <label for="sel1">Chọn loại giỏ hàng:</label>
                                    <select class="form-control " name="select" id='sel1'>
                                        <option value="">--Chọn--</option>
                                        <option value="dagiao">Đã giao hàng</option>
                                        <option value="chuagiao">Chưa giao hàng</option>
                                        <option value="dadang">Đã đăng bán</option>
                                        <option value="tatca">Tất cả</option>
                                        
                                
      </select> 
                            <br>

                            <input class="btn btn-info" type="submit" name="tim" value="Tìm" />
            </div>
                            <br>
        </form>
             
                        <br><br><br><br><br>
        <table class="col-sm-11 table table-striped table table-bordered">
                <tr>
                    <th>Tên khách hàng</th>
                    <th>Tên Sản phẩm</th>
                    <th>Ngày Đặt/Đăng</th>
                    <th>Số Lượng</th>
                    <th>Đơn Giá</th>
                    <th>Tổng tiền</th>
                    <th>Tình trạng</th>
                                  
                </tr>

   <?php
                         
                require_once "connection.php";
                    $error = array();
                    $select = "";
            $TENKH = $_SESSION['tenkh'];
                if(isset($_GET['select']) && ($_GET['select']=='') ){
                
                        echo '<script>alert("Vui lòng chọn loại giỏ hàng!!!!");</script>';
                }else{
     
                //LAY SAN PHAM CHUA GIAO HANG
                if(isset($_GET["select"]) && isset($_GET["tim"]) && $_GET['select']=='chuagiao' ){
                    
                     //lay makh trong bang dang ký
                            $sql = "SELECT * FROM dondathang WHERE TINHTRANG = 'chua giao'";
                            $result = $conn->query($sql);

                    $makh=$tenkh = "";
                    if ($result->num_rows > 0){
                        while ($row = mysqli_fetch_assoc($result))
                             {
                            
                            $STTDDH = $row['STTDDH'];
                            $NGAYDH = $row['NGAYDH'];
                            $TRIGIA= $row['TRIGIA'];
                            $TINHTRANG = 'CHUA GIAO';
                    $sql1 = "SELECT * FROM chitietdathang WHERE STTDDH = '$STTDDH' and TENKH = '$TENKH' ";
                    $result1= $conn->query($sql1);
                    if ($result1 ->num_rows > 0){
                        while ($row = mysqli_fetch_array($result1))
                            
                             {
                                    $SOLUONG = $row['SOLUONG'];
                                    $DONGIA = $row['DONGIA'];
                                    $MASP =  $row['MASP'];
                                    $TENKH = $row['TENKH'];
                            
                            $sql2 = "SELECT * FROM sanpham WHERE MASP = '$MASP'";
                            $result2= $conn->query($sql2);
                            if ($result2 ->num_rows > 0){
                                    while ($row = mysqli_fetch_array($result2))
                                {
                                        echo '<tr>' ;
                                        echo '<td>' . $TENKH . '</td>';
                                        echo '<td>' . $row['TENSP'] . '</td>';
                                        echo '<td>' . $NGAYDH. '</td>';
                                        echo '<td>'. $SOLUONG .'</td>';
                                        echo '<td>'. $DONGIA .'</td>';
                                        echo '<td>'. $TRIGIA .'</td>';
                                        echo '<td>'. $TINHTRANG .'</td>';
                                        echo "</tr>";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                if(isset($_GET["select"]) && isset($_GET["tim"]) && $_GET['select']=='dadang' ){
                    
                     //lay makh trong bang dang ký
                            $sql = "SELECT * FROM dangsanpham WHERE TENKH = '$TENKH'";
                            $result = $conn->query($sql);

                    if ($result->num_rows > 0){
                        while ($row = mysqli_fetch_assoc($result))
                             {  
                            $MASP = $row['MASP'];
                            $NGAYDANG = $row['NGAYDANG'];
                    $sql1 = "SELECT * FROM sanpham WHERE MASP = '$MASP' ";
                    $result1= $conn->query($sql1);
                    if ($result1 ->num_rows > 0){
                        while ($row = mysqli_fetch_array($result1))                    
                             {
                                $TINHTRANG = $row['TINHTRANG'];
                                if($TINHTRANG == ''){
                                    $TINHTRANG = 'CHUA BAN';
                                      
                                }else{
                                      $TINHTRANG = $row['TINHTRANG'];
                                }
                                    echo '<tr>' ;
                                        echo '<td>' . $TENKH . '</td>';
                                        echo '<td>' . $row['TENSP'] . '</td>';
                                        echo '<td>' . $NGAYDANG. '</td>';
                                        echo '<td>'; echo '</td>';
                                        echo '<td>'. $row['DONGIA'] .'</td>';
                                        echo '<td>'; echo '</td>';
                                        echo '<td>'. $TINHTRANG .'</td>';
                                        echo "</tr>";
                                        }
                                    }
                                }
                            }
                        }
                    }    
            
        //LẤY TẤT CẢ SẢN PHẨM TRONG ĐƠN ĐẶT HÀNG
if(isset($_GET["select"]) && isset($_GET["tim"]) && $_GET['select']=='tatca' ){
                    
                     //lay makh trong bang dang ký
                    $sql1 = "SELECT * FROM chitietdathang,dondathang 
                            WHERE chitietdathang.STTDDH = dondathang.STTDDH and TENKH = '$TENKH'";
                                //GROUP BY chitietdathang.STTDDH";
                    $result1= $conn->query($sql1);
                    if ($result1 ->num_rows > 0){
                        while ($row = mysqli_fetch_array($result1))
                            
                             {    
                                    $NGAYDH = $row['NGAYDH'];
                                    $TRIGIA= $row['TRIGIA'];
                                    $TINHTRANG = $row['TINHTRANG'];
                                    $SOLUONG = $row['SOLUONG'];
                                    $DONGIA = $row['DONGIA'];
                                    $MASP =  $row['MASP'];
                                    $TENKH = $row['TENKH'];
                            
                            $sql2 = "SELECT * FROM sanpham WHERE MASP = '$MASP'";
                            $result2= $conn->query($sql2);
                            if ($result2 ->num_rows > 0){
                                while ($row = mysqli_fetch_array($result2))
                                    {
                                        echo '<tr>' ;
                                        echo '<td>' . $TENKH . '</td>';
                                        echo '<td>' . $row['TENSP'] . '</td>';
                                        echo '<td>' . $NGAYDH. '</td>';
                                        echo '<td>'. $SOLUONG .'</td>';
                                        echo '<td>'. $DONGIA .'</td>';
                                        echo '<td>'. $TRIGIA .'</td>';
                                        echo '<td>'. $TINHTRANG .'</td>';
                                        echo "</tr>";
                                        }
                                    }
                                }
                            }
                        } 

            //LẤY SẢN PHẨM ĐÃ GIAO HÀNG-> XUẤT HÓA ĐƠN
                if(isset($_GET["select"]) && isset($_GET["tim"]) && $_GET['select']=='dagiao' ){
                    
                    require_once "connection.php";
                      //lay makh trong bang dang ký
                            $sql = "SELECT * FROM dondathang WHERE TINHTRANG = 'DA GIAO'";
                            $result = $conn->query($sql);
                    if ($result->num_rows > 0){
                        while ($row = mysqli_fetch_assoc($result))
                             {
                            
                            $STTDDH = $row['STTDDH'];
                            $NGAYDH = $row['NGAYDH'];
                            $TRIGIA = $row['TRIGIA'];
                            $TINHTRANG = $row['TINHTRANG'];
                        
                        $sql1 = "SELECT * FROM chitietdathang where STTDDH = '$STTDDH'  AND TENKH = '$TENKH'";
                    $result1= $conn->query($sql1);
                    if ($result1 ->num_rows > 0){
                        while ($row = mysqli_fetch_array($result1))
                        
                             {

                                $TENKH = $row['TENKH'];
                                $MASP = $row['MASP'];
                                $SOLUONG = $row['SOLUONG'];
                                $DONGIA = $row['DONGIA'];
                            $sql2 = "SELECT * FROM sanpham where MASP = '$MASP'";
                            $result2= $conn->query($sql2);
                            if ($result2 ->num_rows > 0){
                                while ($row = mysqli_fetch_array($result2)){
                         
                                  echo "<tr>" ;
                                    echo "<td>" . $TENKH ."</td>";
                                    echo "<td>$row[TENSP]</td>";
                                    echo "<td>" . $NGAYDH ."</td>";
                                    echo "<td>" . $SOLUONG ."</td>";
                                    echo "<td>" . $DONGIA ."</td>";
                                    echo "<td>" . $TRIGIA ."</td>";
                                    echo "<td>" . $TINHTRANG ."</td>";
                                        }
                    }
                        }

                        }
                }
                    }
                }

?>
                 
  
                        
                
  </table>
                        
                    </div>   
                 
 
                        
                            
            </div>
            </table>

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
