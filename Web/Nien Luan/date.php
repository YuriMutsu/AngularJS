<?php
include('connection.php');
//session_start();
 $stk = '123456';
$tenkh = 'Tran Thanh Tai';
        
        //lay nakh tu bang kh
       $sql1 = "select tenkh from khachhang where TENKH = '$tenkh' and SOTAIKHOAN = '$stk'  ";
                        $result = $conn->query($sql1);
            echo '<script>alert("Đăng Nhập thành công!!!!") </script>';
        //neu tim thay makh thi luu vao bang dang ky
                    if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
             
                    $tenkh = $row["tenkh"] ;
                //Lưu vào session để xử lí sau này
                //$_SESSION['tenkh'] = $tenkh;
                
                echo "".$_SESSION['tenkh'];
                
 
    }
                        
            }
?>