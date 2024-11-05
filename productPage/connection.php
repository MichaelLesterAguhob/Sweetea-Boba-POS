
<?php

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "ordering_billing_system_db";

    $con = mysqli_connect($server, $username, $password, $database);

    if($con->connect_error)
    {
        die("connecion erro" . $con->connect_error);
    }

    
?>