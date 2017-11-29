<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Trang admin/Thêm sản phẩm</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link style="text/css" href="css/font.css" rel="stylesheet">
</head>
<body>
    
        <!-PHP XỬ LÝ THEM SẢN PHẨM->
<?php
        if(isset($_POST['them'])){
        require_once("connection.php");
        
//lay du lieu tu form        
        $tenkh = $_SESSION['tenkh'];
        $masp      = $_POST['masp'];
        $tensp     = $_POST['tensp'];
        $dongia    = $_POST['dongia'];
        $mota      = $_POST['mota'];
        $khuyenmai      = $_POST['khuyenmai'];
        $motakm      = $_POST['motakm'];
        $hinhanh = $_FILES['file']['name'];
        
        //lay du lieu tu csdl ra để so sánh
        $sql1 = "SELECT MASP FROM SANPHAM where MASP = '$masp'";
        $query1 = mysqli_query($conn,$sql1);
        $num_rows = mysqli_num_rows($query1);
        

        //kiem tra du lieu nhap vao
        if ($masp == "" || $tensp == "" || $dongia == "") {
            echo '<script>alert("Nhập đầy đủ thông tin!")</script>';
		}elseif($num_rows != 0) {
            //kiem tra ma san pham co ton tai ?       
            echo '<script>alert("Mã sản phẩm '.$masp.' đã tồn tại!")</script>';
            
            //kiem tra co phai file anh
        }elseif(empty($hinhanh)){
        
            echo '<script>alert("Vui lòng chọn hình ảnh cho sản phẩm!")</script>';
        
        }elseif(($_FILES['file']['type']  == "image/jpeg")
                ||($_FILES['file']['type']  == "image/png" )
                ||($_FILES['file']['type']  == "image/gif") ){  
            
            $target= "hinhanh/".basename($_FILES['file']['name']);
            $hinhanh = $_FILES['file']['name'];
                 
        //them thong tin san pham vao bang sản phẩm
                $sql = "INSERT INTO sanpham (MASP, TENSP, DONGIA,MOTA,HINHANH,KHUYENMAI,MOTAKM)
                        VALUES('$masp', '$tensp', '$dongia', '$mota','$hinhanh','$khuyenmai','$motakm');";
                    //mysqli_query($conn,$sql);
            if(move_uploaded_file($_FILES['file']['tmp_name'],$target)){
                
        // thực thi câu $sql với biến conn lấy từ file connection.php

                if(mysqli_query($conn, $sql) == TRUE){
                          echo '<script>alert("Thêm sản phẩm có mã '.$masp.' vào CSDL thành công!")</script>';
                          echo '<script>window.location.assign("capnhap_sanpham.php?select=tatca&tim=Tìm");</script>';            
                }
            }
           }else{
        
         echo '<script>alert("File '.$hinhanh.' bạn chọn không phải là ảnh!");</script>';
}
    }
?>
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
<form action="themsp.php" method="post" class="panel panel-info" enctype="multipart/form-data">           
            <div class="panel-heading"><h4>Thêm sản phẩm</h4></div>
      <div class="modal-body">         
			<div class="form-group ">
				<label class="control-label col-sm-3 col-sm-offset-1 " for="masp" > Mã Sản Phẩm:</label>
				 <div class="col-sm-5">
                            <input type="text" class="form-control" name="masp" placeholder="Nhập vào mã sản phẩm mới" >
                            </div></div><br><br>		
		 <div class="form-group">
                <label class="control-label col-sm-3 col-sm-offset-1 " for="tensp">Tên sản phẩm:</label>
                    <div class="col-sm-5 ">
                                    <input type="text" class="form-control" name="tensp" placeholder="Nhập tên sản phẩm mới">
                    </div></div><br><br>
            <div class="form-group">
                            <label class="control-label col-sm-3 col-sm-offset-1 " for="dongia">Đơn giá:</label>
                                <div class="col-sm-5 ">
                                    <input type="text" class="form-control" name="dongia" placeholder="Đơn giá mới">
                                </div>
                        </div><br><br>	
								<div class="form-group">
								<label class="col-sm-3 col-sm-offset-1  control-label" for="hinh">Chọn hình ảnh</label>
								<div class="col-sm-5">
							       
                                        <input type="file" name='file'>
								</div>
            </div><br>
               <div class="form-group ">
				<label class="col-sm-3 col-sm-offset-1  " for="khuyenmai" >Khuyến mãi:</label>
				 <div class="col-sm-5">
                            <input type="text" class="form-control" name="khuyenmai" placeholder="Nhập vào mã giá trị khuyến mãi" >
                            </div>
			</div><br>	<br>  
                <div class="form-group">
								<label class="col-sm-3 col-sm-offset-1  control-label" for="motakm">Khuyến mãi kèm theo</label><br>
                            <div class="col-sm-5">
									<textarea name="motakm" rows="5" cols="40"></textarea>
								</div>
								
							</div><br><br><br><br><br>
                <div class="form-group">
								<label class="col-sm-3 col-sm-offset-1  control-label" for="mota">Mô tả sản phẩm</label><br>
                            <div class="col-sm-5">
									<textarea name="mota" rows="5" cols="40"></textarea>
								</div>
								
                    </div><br><br><br><br><br>
            <div class="form-group col-sm-offset-5">
                 <input type="submit" class="btn btn-default"  name="them" value="Thêm sản phẩm" />
                <input type="submit" class="btn btn-default" name="thoat" value="Thoát">
             </ul>       
          </div>
    </div>

</form>   
    </div>

</body>
</html>     