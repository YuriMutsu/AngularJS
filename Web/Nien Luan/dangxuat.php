<?php
    session_start();
    if(isset($_SESSION['username'])){
    
        unset($_SESSION['username']); //xóa session   
    
    }
    session_destroy();
header('Location:trangchu.php');
?>