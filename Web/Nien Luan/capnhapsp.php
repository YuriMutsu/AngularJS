<?php
    session_start();
?>
<html>
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
        
<?php
    require_once("connection.php");
    require_once("functions.php");
$MASP = $_GET['MASP'];
//$TENSP = $DONGIA = $MOTA = $KHUYENMAI =$MOTAKM = $HINHANH='';
    $sql = "SELECT * from sanpham where MASP='$MASP'";
        $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row= $result->fetch_array()){
            
            $TENSP =$row['TENSP'];
                    $_SESSION['TENSP'] = $TENSP;
            $DONGIA =$row['DONGIA'];
                      $_SESSION['DONGIA'] = $DONGIA;
            $MOTA =$row['MOTA'];
                     $_SESSION['MOTA'] = $MOTA;
            $KHUYENMAI =$row['KHUYENMAI'];
                       $_SESSION['KHUYENMAI']= $KHUYENMAI;
            $MOTAKM =$row['MOTAKM'];
                       $_SESSION['MOTAKM']= $MOTAKM;
            $HINHANH =$row['HINHANH'];
                       $_SESSION['HINHANH'] = $HINHANH;
        }
    }
//XỬ LÝ KHI NHẤN NÚT XÓA SẢN PHẨM
    if(isset($_POST['xoa'])){
        //xoa sản phẩm trong bảng sản phẩm và bảng đăng sản phẩm nếu có
            $sql = "select * from dangsanpham where MASP ='$MASP'";
            $result = $conn->query($sql);
    if($num = $result->num_rows > 0){
            //xoa masp trong hay bảng san pham và đăng sản phẩm
                    $sql  = "DELETE FROM dangsanpham WHERE MASP ='$MASP';";
                    $sql .= "DELETE FROM sanpham WHERE MASP ='$MASP';";
            if($conn->multi_query($sql) == TRUE){
                    echo '<script> alert("Xóa sản phẩm người dùng đăng có mã '.$MASP.' thành công")</script>';
                    echo '<script>window.location.assign("capnhap_sanpham.php?select=tatca&tim=Tìm");</script>';
                    }
            }else{
                    $sql = "DELETE FROM sanpham WHERE MASP ='$MASP'";
            if($conn->query($sql) == TRUE){
                 echo '<script> alert("Xóa sản phẩm có mã '.$MASP.' thành công")</script>';
                 echo '<script>window.location.assign("capnhap_sanpham.php?select=tatca&tim=Tìm");</script>';
            }  
        }
    }
//XỬ LÝ HI NHẤN NÚT THOÁT
    if(isset($_POST['thoat'])){
        redirect_to('capnhap_sanpham.php?select=tatca&tim=Tìm');     
    }
            
//XỬ LÝ KHI NHẤN NÚT CẬP NHẬP
    
    if(!isset($_POST['capnhap'])){
    
            $TENSP = $_SESSION['TENSP'];
            $DONGIA =$_SESSION['DONGIA'];
            $MOTA = $_SESSION['MOTA'];
            $KHUYENMAI = $_SESSION['KHUYENMAI'];
            $MOTAKM =  $_SESSION['MOTAKM'];
            $HINHANH =$_SESSION['HINHANH'];

    } elseif(isset($_POST['capnhap'])){
            //lấy dữ liệu từ form    
                $tensp     = $_POST['tensp'];
                $dongia    = $_POST['dongia'];
                $mota      = $_POST['mota'];
                $khuyenmai  = $_POST['khuyenmai'];
                $motakm    = $_POST['motakm'];
                $hinhanh = $_FILES['file']['name'];
        if($tensp == '' || $dongia == '' || $khuyenmai == ''){
                echo '<script>alert("Nhập thông tin cần cập nhập!")</script>';
        }elseif(empty($hinhanh) || $tensp == ''){
                    
                $tensp     = $_SESSION['TENSP'];
                $dongia    =    $_POST['dongia'];
                $mota      =  $_POST['mota'];
                $khuyenmai = $_POST['khuyenmai'];
                $motakm     = $_POST['motakm'];
                $hinhanh =  $_SESSION['HINHANH'];
            
               $sql ="UPDATE sanpham SET TENSP = '$tensp' ,DONGIA= '$dongia' , 
                        MOTA= '$mota',KHUYENMAI='$khuyenmai' ,HINHANH ='$hinhanh',MOTAKM='$motakm'  WHERE MASP='$MASP' ";
                
                if(mysqli_query($conn, $sql) == TRUE){
                          echo '<script>alert("Cập nhập sản phẩm có mã '.$MASP.' thành công!")</script>';
                          echo '<script>window.location.assign("capnhap_sanpham.php?select=tatca&tim=Tìm");</script>';           
                }
        }elseif(empty($hinhanh) || $dongia == ''){
                
                $tensp     = $_POST['tensp'];
                $dongia    =    $_SESSION['DONGIA'];
                $mota      =  $_POST['mota']; 
                $khuyenmai = $_POST['khuyenmai'];
                $motakm     = $_POST['motakm'];
                $hinhanh =  $_SESSION['HINHANH'];
            
               $sql ="UPDATE sanpham SET TENSP = '$tensp' ,DONGIA= '$dongia' , 
                MOTA= '$mota',KHUYENMAI='$khuyenmai' ,HINHANH ='$hinhanh',MOTAKM='$motakm'  WHERE MASP='$MASP' ";
                
                if(mysqli_query($conn, $sql) == TRUE){
                          echo '<script>alert("Cập nhập sản phẩm có mã '.$MASP.' thành công!")</script>';
                          echo '<script>window.location.assign("capnhap_sanpham.php?select=tatca&tim=Tìm");</script>';          
                    }
                }elseif(($_FILES['file']['type']  == "image/jpeg")
                ||($_FILES['file']['type']  == "image/png" )
                ||($_FILES['file']['type']  == "image/gif") ){  
                $hinhanh = $_FILES['file']['name'];
                $tensp     = $_POST['tensp'];
                $dongia    = $_POST['dongia'];
                $mota      = $_POST['mota'];
                $khuyenmai  = $_POST['khuyenmai'];
                $motakm    = $_POST['motakm'];
            
            $target= "hinhanh/".basename($_FILES['file']['name']);
            $hinhanh = $_FILES['file']['name'];
        
                $sql ="UPDATE sanpham SET TENSP = '$tensp' ,DONGIA= '$dongia' , 
                MOTA= '$mota',KHUYENMAI='$khuyenmai' ,HINHANH ='$hinhanh',MOTAKM='$motakm' WHERE MASP='$MASP' ";  
         if(move_uploaded_file($_FILES['file']['tmp_name'],$target)){
                
        // thực thi câu $sql với biến conn lấy từ file connection.php

                if(mysqli_query($conn, $sql) == TRUE){
                      echo '<script>alert("Cập nhập sản phẩm có mã '.$MASP.' thành công!")</script>';
                      echo '<script>window.location.assign("capnhap_sanpham.php?select=tatca&tim=Tìm");</script>';          
                }
            }    
        } 
    }    
?>
    
<div class="col-sm-2"></div>
        <div class="col-sm-8">
<form class="panel panel-info" id="capnhapsp" action="capnhapsp.php?MASP=<?=$MASP?>" method="post" enctype="multipart/form-data">
    <div class="panel-heading">CẬP NHẬP SẢN PHẨM</div>
            <div class="panel-body">
			<div class="form-group ">
				<label class="control-label col-sm-offset-2 col-sm-3 " for="masp" > Mã Sản Phẩm:</label>
				 <div class="col-sm-5">
                            <input type="text" class="form-control" name="masp" placeholder="Nhập vào mã sản phẩm mới" 
                                   value=" <?php echo $MASP; ?>">
                            </div>
			</div><br>	<br>		
		 <div class="form-group">
                            <label class="control-label col-sm-offset-2 col-sm-3" for="tensp">Tên sản phẩm:</label>
                                <div class="col-sm-5 ">
                                    <input type="text" class="form-control" onclick="" name="tensp" placeholder="Nhập tên sản phẩm mới" 
                                           value=" <?php echo $TENSP; ?>">
                                </div>
                        </div><br>	<br>
            <div class="form-group">
                            <label class="control-label  col-sm-offset-2 col-sm-3" for="dongia">Đơn giá:</label>
                                <div class="col-sm-5 ">
                                    <input type="text" class="form-control" onclick="" name="dongia" placeholder="Đơn giá mới" value=" <?php echo $DONGIA; ?>">
                                </div>
                        </div><br><br>	
								<div class="form-group">
								<label class="col-sm-3 col-sm-offset-2 control-label" for="file">Chọn hình ảnh</label>
								<div class="col-sm-5">
							       
                                        <input type="file" name='file'>
   
								</div>
            </div><br>
               <div class="form-group ">
				<label class="control-label col-sm-offset-2 col-sm-3 " for="khuyenmai" >Khuyến mãi:</label>
				 <div class="col-sm-5">
                            <input type="text" class="form-control" name="khuyenmai" placeholder="Nhập vào mã giá trị khuyến mãi" 
                                   value=" <?php echo $KHUYENMAI; ?>">
                            </div>
			</div><br>	<br>  
                <div class="form-group">
								<label class="col-sm-3 col-sm-offset-2 control-label" for="motakm">Khuyến mãi kèm theo</label><br>
                            <div class="col-sm-5">
									<textarea name="motakm" rows="5" cols="40"></textarea>
								</div>
								
							</div><br><br><br><br><br>
                <div class="form-group">
								<label class="col-sm-3 col-sm-offset-2 control-label" for="mota">Mô tả sản phẩm</label><br>
                            <div class="col-sm-5">
									<textarea name="mota" rows="5" cols="40"></textarea>
								</div>
								
							</div><br><br><br><br><br><br>

                        <div class="form-group">
                            <div class=" col-sm-12 col-sm-offset-5">
                                <a href="themsp.php" class="btn btn-primary">Thêm</a>
                                <input class="btn btn-success" type="submit" name="capnhap" value="Cập Nhập" >
                                <input class="btn btn-danger" type="submit" name="xoa" value="Xóa">             
                                <input class="btn btn-default" type="submit" name="thoat" value="Thoát">
                            </div>
                        </div><br>
                <div>
                    <a class="btn btn-danger" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Xóa Tất Cả</a>
                            <span>Cảnh báo: <span style="color:red">KHÔNG</span> thể khôi phục khi xóa tất cả!</span>
                </div>
</div>

<!--MODAL XÓA TẤT CẢ-->
<form action="capnhapsp.php" method="post">                
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
    
<?php
    require_once('connection.php');

//KHI ADMIN NHAN NUT XAC NHAN XOA TẤT CẢ
if(isset($_POST['all'])){
    //xóa tất cả các đơn đặt hàng trừ hóa đơn
            $sql = "DELETE FROM sanpham";
            $sql .="DELETE FROM dangsanpham";
    if($conn->multi_query($sql) == TRUE){
                echo '<script>alert("Đã xóa tất cả các sản phẩm ra khỏi CSDL!!!!");</script>';
        }  
    }
?>

		</form>
        </div>
    </body>
</html>        