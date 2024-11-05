
<?php 

    include_once('includes/connection.php');

    $msg = "";
    $id = $_POST['id'];

    try
    {
        global $con;;

        $query = "DELETE FROM size_price WHERE ID='$id'";
        $result = mysqli_query($con, $query);
        
        if($result)
        {
            $msg = "Successfully Deleted Details";
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
        echo $msg;;
    }


?>