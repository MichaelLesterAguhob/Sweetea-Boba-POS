
<?php 

include_once('includes/connection.php');


$response = "";

try
{   global $con;

    $size = $_POST['size'];
    $query = "SELECT price FROM size_price WHERE size='$size' ";
    $result = mysqli_query($con, $query);
    

    if($result)
    {
        $price = mysqli_fetch_array($result);
        $response = $price[0];
    }

}
catch(Exception $ex)
{
    $response = "Error Occured" . $ex;
}

echo $response;


?>