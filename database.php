<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_password ="";
    $db_name = "new";
    $conn ="";
    try{
    $conn = mysqli_connect( $db_server,$db_user,$db_password,$db_name);
    }
    catch(mysqli_sql_exception){
        
        echo "not connected";
    
    }
    if($conn){
        echo "connected";
    }
   
?>