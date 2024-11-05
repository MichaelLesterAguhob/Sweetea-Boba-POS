
<?php 
include_once('includes/connection.php');
global $con;
$response = '';

try
{
    $query = "DELETE FROM order_temp_storage";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $response = "Cancelled Successfully";
    }
    else
    {
        $response = "Unknown Error Occured";
    }

}
catch(Exception $ex)
{
    $response = "Error Occured" . $ex;
}

echo $response;

?>