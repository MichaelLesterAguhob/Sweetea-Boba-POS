
<?php 

    include_once('includes/connection.php');
    $msg = "";
    $addOnsName = strtoupper($_POST['aoName']);
    $addOnsPrice = strtoupper($_POST['aoPrice']);

    try
    {
        global $con;

        $query = "INSERT INTO add_ons VALUES('', '$addOnsName', '$addOnsPrice')";
        $result = mysqli_query($con, $query);

        if($result)
        {
            $msg = "Successfully Added";
        }   
        else
        {
            $msg = "Unknown Error Occured";
        }

    }
    catch(Exception $ex)
    {
        $msg = "Error Occured" . $ex;
    }
    finally
    {
        echo $msg;
    }
?>