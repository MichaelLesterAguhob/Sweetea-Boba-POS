
<?php 

include_once('includes/connection.php');

$response = "";

try
{
    global $con;
    $query = "SELECT price FROM add_ons";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $price = mysqli_fetch_array($result);
        $response = $price[0];
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
finally
{
    echo $response;
}







?>