
<?php 

    include_once('includes/connection.php');

    try
    {
        global $con;

        $size = strtoupper($_POST['size']);
        $price = strtoupper($_POST['price']);
        $msg = "";

        $query = "INSERT INTO size_price VALUES('', '$size', '$price')";
        $result = mysqli_query($con, $query);

        if($result)
        {
            $msg = "Success fully Added";
        }
        else
        {
            $msg = "Unknown Error Occured";
        }
    }
    catch(Exception $ex)
    {
        $msg = "Error Occured <br>" . $ex;
    }
    finally
    {
        echo $msg;
    }
 
?>