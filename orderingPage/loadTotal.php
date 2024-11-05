
<?php 
    include_once('includes/connection.php');

    $response = "";

    try
    {
        global $con;

        $query = "SELECT SUM(subTotal) FROM order_temp_storage";
        $result = mysqli_query($con, $query);

        if($result)
        {
            $data = mysqli_fetch_array($result);
            $response = $data[0];
        }

    }
    catch(Exception $ex)
    {
        $response = "Error occured" . $ex;
    }
    finally
    {
        echo $response;
    }
?>