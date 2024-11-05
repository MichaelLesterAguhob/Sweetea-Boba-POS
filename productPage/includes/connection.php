<?php 

    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "ordering_billing_system_db";

    $con = mysqli_connect($serverName, $userName, $password, $dbName);

    if($con->connect_error)
    {
        echo ('PLease check your connection'); 
        die();
    }

?>