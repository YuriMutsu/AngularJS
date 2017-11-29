
<html>
<head>
    
    <meta charset="utf-8">
    
    </head>

<body>
    
    <?php
session_start();
require_once("connection.php");

if(isset($_POST['them'])){
    //lay du lieu tu form
    
        $TENTK = $_POST['tentk'];
        $MATK = $_POST['matk']; 
    //kiem tra ten tai khoan co ton tai
        $sql = "SELECT * FROM nguoidung WHERE TENTK = '$TENTK'";
        $result = $conn->query($sql);

    if($TENTK == ""){
            echo '<script> alert("Nhập tên tài khoản nhân viên!!!!")</script>';
            //echo '<script>window.location.assign("captaikhoan_nv.php?select=tatca&tim=Tìm");</script>';
    }elseif ($result->num_rows > 0) {
            echo '<script> alert("Tên tài khoản đã tồn tại!!!!")</script>';
            //echo '<script>window.location.assign("captaikhoan_nv.php?select=tatca&tim=Tìm");</script>';
    }elseif($TENTK != "" && $MATK!="" ){
                $sql1 = "INSERT INTO nguoidung(TENTK,MATK,QUYENSD,TINHTRANG) VALUES('$TENTK','$MATK','Nhan Vien','da cap')";
            if ($conn->query($sql1) == TRUE){
                        echo '<script> alert("Thêm tài khoản '.$TENTK.' thành công!!!!")</script>';
                        echo '<script>window.location.assign("captaikhoan_nv.php?select=dacap&tim=Tìm");</script>';         
            }
        }else{
                    $sql2 = "INSERT INTO nguoidung(TENTK,QUYENSD) VALUES('$TENTK','Nhan Vien')";
                if ($conn->query($sql2) == TRUE){
                        echo '<script> alert("Thêm tài khoản '.$TENTK.' thành công!!!!")</script>';
                        echo '<script>window.location.assign("captaikhoan_nv.php?select=chuacap&tim=Tìm");</script>';
            
            }
    }
}
?>

    
    </body>

</html>

