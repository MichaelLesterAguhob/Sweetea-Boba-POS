
<?php 
include_once('includes/connection.php');
global $con;
$response = '';

$cancelOrder = $_POST['cancelOrder'];

try
{
    $query = "DELETE FROM orders WHERE orderNo = '$cancelOrder' ";
    $result = mysqli_query($con, $query);

    $query1 = "DELETE FROM orderno WHERE orderNo = '$cancelOrder' ";
    $result1 = mysqli_query($con, $query1);
    
    $query2 = "DELETE FROM payment WHERE orderNo = '$cancelOrder' ";
    $result2 = mysqli_query($con, $query2);

    if($result && $result1 && $result2)
    {
        $response = "Sucessfully Cancelled Order";
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