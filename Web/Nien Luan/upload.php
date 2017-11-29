

<html>

<body>

    <table border="1">
    
        <tr>
            <td>ID</td>
            <td>Hinh</td>
            <td>Mo ta</td>
    <?php
require_once('connection.php');

$sql = "select * from hinhanh";
$result = mysqli_query($conn,$sql);

if($result->num_rows > 0){

    while($row=$result->fetch_assoc()){
        
        echo "<tr>";
        echo "<td>$row[id]</td>";
        echo "<td> $row[hinh]  </td>";
        echo "</tr>";
        
        
    }
}
            
            ?>
            
        </tr>
    
    </table>
    
</body>
</html>