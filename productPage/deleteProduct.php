
<?php 
    include_once('includes/connection.php');

    $delID = $_POST['delID'];
    $msg = "";
 
    try
    {
        global $con;

        $quuery = "DELETE FROM product WHERE ID='$delID' ";
        $result = mysqli_query($con, $quuery);

        if($result)
        {
            $msg = "Successfully Deleted Item";
        }
        else
        {
            $msg = "Unknown Error Occured";
        }
        
    }
    catch(Exception $ex)
    {
        echo "Eror Occured <br>" . $ex;
    }
    
    echo $msg;
?>