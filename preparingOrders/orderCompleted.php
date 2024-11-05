
<?php 
include_once('includes/connection.php');

global $con;
$response = "";
$completedOrder = $_POST['completedOrder'];

try
{
    $qryMinId = "SELECT MIN(ID) FROM preparing_orders WHERE orderNo = '$completedOrder'";
    $resultMinId = mysqli_query($con, $qryMinId);
    $minId = mysqli_fetch_array($resultMinId);

    $qryMaxId = "SELECT MAX(ID) FROM preparing_orders WHERE orderNo = '$completedOrder'";
    $resultMaxId = mysqli_query($con, $qryMaxId);
    $maxId = mysqli_fetch_array($resultMaxId);

    while($minId[0] <= $maxId[0])
    {
        $query= "SELECT * FROM preparing_orders WHERE ID='$minId[0]' AND orderNo='$completedOrder' ";
        $result = mysqli_query($con, $query);

        $orderNo = 0;
        $name = "";
        $price = 0;
        $qnty = 0;
        $addOns = "";
        $subTotal = 0;

        //getting data with lowest ID and specific orderNo from preparing orders 
        while($row = mysqli_fetch_assoc($result))
        {
            $orderNo = $row['orderNo'];
            $name = $row['name'];
            $price = $row['price'];
            $qnty = $row['qnty'];
            $addOns = $row['addOns'];
            $subTotal = $row['subTotal'];
        }

        //transfering data to completed table in database
        $query2 = "INSERT INTO completed_orders VALUES('','$orderNo','$name','$price','$qnty','$addOns','$subTotal')";
        $result2 = mysqli_query($con, $query2);
        if($result2)
        {
            $query3= "DELETE FROM preparing_orders WHERE ID='$minId[0]' AND orderNo='$completedOrder' ";
            $result3 = mysqli_query($con, $query3);
        }

        $minId[0] += 1;
    }
    $response = "Order Completed";
}
catch(Exception $ex)
{
    $response = "Error Occured" . $ex;
}

echo $response;

?>