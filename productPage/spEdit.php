
<?php 
    include_once('includes/connection.php');

    $msg = "";

try
{
    global $con;

    $id = $_POST['Id'];
    $size = strtoupper($_POST['size']);
    $price = strtoupper($_POST['price']);

    $query = "UPDATE size_price SET size = '$size', price = '$price' WHERE ID='$id' ";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $msg = "Successfully Updated Details";
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