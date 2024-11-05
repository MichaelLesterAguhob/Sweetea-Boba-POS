
<?php 

include_once('includes/connection.php');

$prepare = $_POST['prepare'];
$minOrderId = 0;
$maxOrderId = 0;

$response = "";

try
{
    minOrderId();
    maxOrderId();
    global $con;

    while($minOrderId <= $maxOrderId)
    {
        // selecting the specific order 1 by 1
        $query1 = "SELECT * FROM orders WHERE orderNo = '$prepare' AND ID = '$minOrderId' ";
        $result1 = mysqli_query($con, $query1);
        $row1 = mysqli_fetch_array($result1);

        //assigning the selected order values to variables
        $orderNo = $row1[1];
        $name = $row1[2];
        $price = $row1[3];
        $qnty = $row1[4];
        $addOns = $row1[5];
        $subTotal = $row1[6];
        
        //transfering data into preparing table in database
        $query4 = "INSERT INTO preparing_orders VALUES('', '$orderNo', '$name', '$price', '$qnty', '$addOns', '$subTotal')";
        $result4 = mysqli_query($con, $query4);
       
        //deleting the already transfered data
        $query5 = "DELETE FROM orders WHERE ID = '$minOrderId'";
        $result5 = mysqli_query($con, $query5);

        //adding on minorderId variables to select another record
        $minOrderId ++;
    }
    $response = "Order Moved to Preparing";
}
catch(Exception $ex)
{
    $response = "Error Occured" . $ex;
}
finally
{
    echo $response;
}

// getting minimun order ID
function minOrderId()
{   
    global $con;
    global $prepare;
    global $minOrderId;

    $query2 = "SELECT MIN(ID) FROM orders WHERE orderNo = '$prepare' ";
    $result2 = mysqli_query($con, $query2);
    $row2 = mysqli_fetch_array($result2);

    $minOrderId = $row2[0];
}

// getting maximum order ID
function maxOrderId()
{
    global $con;
    global $prepare;
    global $maxOrderId;

    $query3 = "SELECT MAX(ID) FROM orders WHERE orderNo = '$prepare' ";
    $result3 = mysqli_query($con, $query3);
    $row3 = mysqli_fetch_array($result3);

    $maxOrderId = $row3[0];
}


?>