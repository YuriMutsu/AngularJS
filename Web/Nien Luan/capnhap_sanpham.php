
<?php
    session_start();
    if (!isset($_SESSION['tenkh']) || ($_SESSION['QUYENSD']!= 'Administrator' ) ){
    echo '<script>alert("Bạn cần phải đăng nhập để tiếp tục!")</script>';   
	   header('Location: dangnhap_qtv.php');
        
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Trang quản trị/Cập nhập sản phẩm</title>
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
		<div class ="panel-heading">
		 <center><h4>CẬP NHẬP SẢN PHẨM</h4></center>
		</div>
		
		<div class="panel-body">
		
        
        <!--FROM LAY SAN PHAM -->
        
        <form method="get" >
                        <div class="from-group col-sm-4">
                             <label for="sel1">Chọn loại sản phẩm</label>
                                    <select class="form-control " name="select" id='sel1'>
                                        <option value="">--Chọn--</option>
                                        <option value="khachhang" >Người dùng đăng</option>
                                        <option value="hethong">Hệ thống</option>
                                        <option value="tatca">Tất cả</option>
      </select> 
                            <br>

                            <input class="btn btn-info" type="submit" name="tim" value="Tìm" />
            </div>
                            <br><br><br><br><br><br><br>
        </form>
                <!--TABLE LẤY DANH SÁCH CÁC SAN PHAM -->
        <table class="table col-sm-9" 
               align="center" border="1">
                    <tr>
                        
                        <th><center>MÃ SẢN PHẨM</center></th>
                        <th><center>TÊN SẢN PHẨM</center></th>
                        <th><center>ĐƠN GIÁ</center></th>
                        <th><center>MÔ TẢ</center></th>
                        <th><center>KHUYẾN MÃI</center></th>
                        <th><center>MÔ TẢ KHUYẾN MÃI</center></th>
                        <th colspan="2"><center>CẬP NHẬP</center></th>
        
                    </tr>
    <!--CODE LẤY SẢN PHẨM-->        
      
            <?php       
                require_once "connection.php";
                    $select = "";

               if(isset($_GET['select']) && ($_GET['select']=='')){    
                  echo '<script>alert("Vui lòng chọn loại sản phẩm!!!!");</script>';        
            }else{
                
                   //LẤY SẢN PHẨM KHÁCH HÀNG ĐĂNG
                if(isset($_GET["select"]) && isset($_GET["tim"]) && $_GET['select']=='khachhang' ){
                    
                     //lay makh trong bang dang ký
                            $sql = "SELECT MASP FROM dangsanpham";
                            $result = $conn->query($sql);
                        
                    if ($result->num_rows > 0){
                        while ($row = mysqli_fetch_assoc($result))
                             {
                            
                                $MASP = $row['MASP'];   
                        $sql1 = "SELECT * FROM sanpham where MASP = '$MASP'";
                        $result1= $conn->query($sql1);
                    if ($result1 ->num_rows > 0){
                        while ($row = mysqli_fetch_array($result1))
                            
                             {
                                    echo "<tr>";
                                    echo "<td>$row[MASP]</td>";
                                    echo "<td>$row[TENSP]</td>";
                                    echo "<td>$row[DONGIA]</td>";
                                    echo "<td>$row[MOTA]</td>";
                                    echo "<td>$row[KHUYENMAI]</td>";
                                    echo "<td>$row[MOTAKM]</td>";
                                    echo "<td><a class='btn btn-info' href='capnhapsp.php?MASP=$row[MASP]'>Cập Nhập</a></td>";
                                    echo "</tr>";
                            
                                        }
                                }
                            }
                        }
                    }
                   //LẤY SẢN PHẨM DO HỆ THỐNG ĐĂNG
        if(isset($_GET["select"]) && isset($_GET["tim"]) && $_GET['select']=='hethong' ){
     
                        $sql1 = "SELECT * FROM sanpham WHERE MASP NOT IN(SELECT MASP FROM dangsanpham)";
                        $result1= $conn->query($sql1);
                    if ($result1 ->num_rows > 0){
                        while ($row = mysqli_fetch_array($result1))
                             {
                                    echo "<tr>";
                                    echo "<td>$row[MASP]</td>";
                                    echo "<td>$row[TENSP]</td>";
                                    echo "<td>$row[DONGIA]</td>";
                                    echo "<td>$row[MOTA]</td>";
                                    echo "<td>$row[KHUYENMAI]</td>";
                                    echo "<td>$row[MOTAKM]</td>";
                                    echo "<td><a class='btn btn-info' href='capnhapsp.php?MASP=$row[MASP]'>Cập Nhập</a></td>";
                                    echo "</tr>";
                                   }
                             }
                        }           
                   
                   //LẤY TẤT CẢ SẢN PHẨM TRONG CSDL
        if(isset($_GET["select"]) && isset($_GET["tim"]) && $_GET['select']=='tatca' ){
     
                        $sql1 = "SELECT * FROM sanpham";
                        $result1= $conn->query($sql1);
                    if ($result1 ->num_rows > 0){
                        while ($row = mysqli_fetch_array($result1))
                             {
                                    echo "<tr>";
                                    echo "<td>$row[MASP]</td>";
                                    echo "<td>$row[TENSP]</td>";
                                    echo "<td>$row[DONGIA]</td>";
                                    echo "<td>$row[MOTA]</td>";
                                    echo "<td>$row[KHUYENMAI]</td>";
                                    echo "<td>$row[MOTAKM]</td>";
                                    echo "<td><a class='btn btn-info' href='capnhapsp.php?MASP=$row[MASP]'>Cập Nhập</a></td>";
                                    echo "<td><a class='btn btn-success' href='themsp.php'>Thêm</a></td>";
                                    echo "</tr>";
                                        }
                                }
                            }
               }              
        ?>    
            
       
        </table>
        
        <div>       
            <a class="btn btn-danger" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#XOASPKHModal">Xóa Tất Cả SPKH</a>
            <a class="btn btn-danger" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#XOASPHTModal">Xóa Tất Cả SPHT</a>
            <a class="btn btn-danger" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Xóa Tất Cả</a>
                            <span>Cảnh báo: <span style="color:red">KHÔNG</span> thể khôi phục khi xóa tất cả!</span>
                </div>
        
		</div>
	</div>

</div>
            </table>
           
        </div>
                 
  <!--MODAL XÓA TẤT CẢ-->
<form action="capnhap_sanpham.php" method="post">                
        <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

                <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>CẢNH BÁO</center></h4>
            </div>
        <div class="modal-body">
            <center><H5>BẠN CÓ CHẮC CHẮN MUỐN <STRONG>XÓA HẾT</STRONG> CÁC SẢN PHẨM KHỎI CƠ SỞ DỮ LIỆU.</H5></center>
            </div>
        <div class="modal-footer">
            <ul class="nav nav-pills col-sm-offset-4">
                 <li><input type="submit" class="btn btn-default" name="all" value="Xóa tất cả"> </li>
            <li><button type="button" class="btn btn-default col-sm-offset-2" data-dismiss="modal">Hủy</button></li>
             </ul>           
      </div>
    </div>
  </div>
</div>                      
</form>
    
<form action="capnhap_sanpham.php" method="post">                
        <div id="XOASPKHModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

                <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>CẢNH BÁO</center></h4>
            </div>
        <div class="modal-body">
                <center><H5>BẠN CÓ CHẮC CHẮN MUỐN <STRONG>XÓA HẾT CÁC SẢN PHẨM KHÁCH HÀNG</STRONG> ĐĂNG KHỎI CƠ SỞ DỮ LIỆU.</H5></center>
            </div>
        <div class="modal-footer">
            <ul class="nav nav-pills col-sm-offset-4">
                 <li><input type="submit" class="btn btn-default" name="allspkh" value="Xóa tất cả"> </li>
            <li><button type="button" class="btn btn-default col-sm-offset-2" data-dismiss="modal">Hủy</button></li>
             </ul>           
      </div>
    </div>
  </div>
</div>                      
</form>
    
<form action="capnhap_sanpham.php" method="post">                
        <div id="XOASPHTModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

                <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>CẢNH BÁO</center></h4>
            </div>
        <div class="modal-body">
                <center><H5>BẠN CÓ CHẮC CHẮN MUỐN <STRONG>XÓA HẾT CÁC SẢN PHẨM HỆ THỐNG</STRONG> KHỎI CSDL?.</H5></center>
            </div>
        <div class="modal-footer">
            <ul class="nav nav-pills col-sm-offset-4">
                 <li><input type="submit" class="btn btn-default" name="allspht" value="Xóa tất cả"> </li>
            <li><button type="button" class="btn btn-default col-sm-offset-2" data-dismiss="modal">Hủy</button></li>
             </ul>           
      </div>
    </div>
  </div>
</div>                      
</form>    
<?php
    require_once('connection.php');

//KHI ADMIN NHAN NUT XAC NHAN XOA TẤT CẢ
if(isset($_POST['all'])){
    //xóa tất cả các đơn đặt hàng trừ hóa đơn
            $sql = "DELETE FROM sanpham";
    if($conn->multi_query($sql) == TRUE){
                 $sql1 = "DELETE FROM dangsanpham";
            if($conn->multi_query($sql1) == TRUE){
                echo '<script>alert("Đã xóa tất cả các sản phẩm ra khỏi CSDL!!!!");</script>';
        }  
    }
}


//XÓA TẤT CẢ SẢN PHẨM KHÁCH HÀNG ĐĂNG
if(isset($_POST['allspkh'])){
    //xóa tất cả các đơn đặt hàng trừ hóa đơn
            $sql = "DELETE FROM sanpham WHERE MASP IN(SELECT MASP FROM dangsanpham)";
    if($conn->query($sql) == TRUE){
        
        $sql1 = "DELETE FROM dangsanpham";
                if($conn->query($sql1) == TRUE){
                echo '<script>alert("Đã xóa tất cả các sản phẩm KHÁCH HÀNG ĐĂNG ra khỏi CSDL!!!!");</script>';
        }  
    }
}
//XÓA TẤT CẢ SẢN PHẨM HỆ THỐNG TRỪ SẢN PHẨM KH
if(isset($_POST['allspht'])){
    //xóa tất cả các đơn đặt hàng trừ hóa đơn
            $sql = "DELETE FROM sanpham WHERE MASP NOT IN (SELECT MASP FROM dangsanpham)";
    if($conn->query($sql) == TRUE){
                echo '<script>alert("Đã xóa tất cả các sản phẩm HỆ THỐNG ra khỏi CSDL!!!!");</script>';
        }  
    }

?>          
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
