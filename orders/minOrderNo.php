
<?php
include_once('includes//connection.php');
global $con;
$response = 0;

try
{
    $isMinOrNo = "SELECT MIN(orderNo) FROM orders ";
    $isMinOrNoRes = mysqli_query($con, $isMinOrNo);
    $minOrNo = mysqli_fetch_array($isMinOrNoRes);
    $response = $minOrNo[0];
}
catch(Exception $ex)
{
    $response = "Error Occured" . $ex;
}
finally
{
    echo $response;
}


?>