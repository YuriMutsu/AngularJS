<html>

<body>
    
<?php
    require_once("connection.php");
    $sql = "select * from khachhang";
    $result = mysqli_query($conn,$sql);
?>
        <form method="get"  >
                        <div class="panel-body">
                        <div class="from-group col-sm-4">
                             <label for="sel1">Chọn loại giỏ hàng:</label>
                                    <select class="form-control " name="select" id='sel1'>
                                        <option value="">--Chọn--</option>
                                        <option value="tatca">Tất cả</option>
                                            <?php while($row = mysqli_fetch_array($result)):;?>
                                        <option value="<?php echo $row[1]; ?>"><?php echo $row[1];?></option>
                                            <?php endwhile; ?>    
                                    </select> 
                            <br>

                            <input class="btn btn-info" type="submit" name="tim" value="Tìm" />
            </div>
                            <br>
 
    <table class="col-sm-11 table table-striped table table-bordered">
                <tr>
                     
                    <th>STT Hóa đơn</th>
                    <th>STT ĐĐH</th>    
                    <th>Tên Sản phẩm</th>
                    <th>Ngày Lập</th>
                    <th>Số Lượng</th>
                    <th>Tổng tiền</th>
                    <th>Cập nhập hóa đơn</th>
                                  
                </tr>
   <?php
                         
                require_once "connection.php";
                    $error = array();
                    $select = "";

                if(isset($_GET['select']) && ($_GET['select']=='') ){
                
                        echo '<script>alert("Vui lòng chọn loại giỏ hàng!!!!");</script>';
                }else{
     
        //LẤY ĐƠN ĐẶT HÀNG CHƯA GIAO
        if(isset($_GET["select"]) && isset($_GET["tim"]) && $_GET['select']=="$row[1]" ){
                    
            $_GET['select'] = $row[1];
            $TENKH = $_GET['select'];
            echo '<script>alert("ten khach hang là '.$TENKH.'!!!!");</script>';
                            
                        }          
                
                    
        //LẤY TẤT CẢ ĐƠN ĐẶT HÀNG ĐÃ GIAO HOẶC CHƯA GIAO
        if(isset($_GET["select"]) && isset($_GET["tim"]) && $_GET['select']=='tatca' ){          
            require_once "connection.php";
                      //lay makh trong bang dang ký
                            $sql = "SELECT * FROM chitiethd,hoadon WHERE chitiethd.STTHD = hoadon.STTHD";
                            $result= $conn->query($sql);
            if ($result->num_rows > 0){
                while ($row = mysqli_fetch_array($result))
                             {   
                                $STTHD = $row['STTHD'];
                                $STTDDH = $row['STTDDH'];
                                $NGAYGH = $row['NGAYGH'];
                                $TRIGIA = $row['TONGTIEN'];
                                $TENKH = $row['TENKH'];
                                $MASP = $row['MASP'];
                                $SOLUONG = $row['SOLUONG'];
                                $DONGIA = $row['DONGIA'];
                            $sql1 = "SELECT * FROM sanpham where MASP = '$MASP'";
                            $result1= $conn->query($sql1);
                    if ($result1 ->num_rows > 0){
                        while ($row = mysqli_fetch_array($result1)){                 
                                echo "<tr>" ;
                                    echo "<td>" . $STTHD ."</td>";
                                    echo "<td>" . $STTDDH ."</td>";
                                    echo "<td>" . $TENKH ."</td>";
                                    echo "<td>$row[TENSP]</td>";
                                    echo "<td>" . $NGAYGH ."</td>";
                                    echo "<td>" . $SOLUONG ."</td>";
                                    echo "<td>" . $TRIGIA ."</td>";
                                        }
                                    }
                                }
                            }
                        }
                    }                                      
                ?>     
    </table>
                            
                                   </form>
    </body>

</html>