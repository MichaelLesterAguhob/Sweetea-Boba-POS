
<?php 
    include_once('includes/connection.php');

    $response = "";
    $minTempOrderIdNum = 0;

    date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d');
    $time = date("h:i a");

    // Saving order total, payment and change into database (payment table)
    $orderNum = $_POST['orderNo'];
    $orderTotal = $_POST['orderTotal'];
    $payment = $_POST['payment'];

    $orderTot = $payment - $orderTotal;

    $query0 = "INSERT INTO orderno VALUES('', '$orderNum', '$currentDate', '$time')";
    $result0 = mysqli_query($con, $query0);

    $query4 = "INSERT INTO payment VALUES('', '$orderNum', '$orderTotal', '$payment', '$orderTot')";
    $result4 = mysqli_query($con, $query4);
     
        try
        {
            global $con;
            global $minTempOrderIdNum;
            global $response;

            $orderNo = 0;
            $name = "";
            $price = 0;
            $qnty = 0;
            $addOns = "";
            $subTotal = 0;

            $pymntRcrdd = 0;
            // getting the lowest id number in temporary storage
            getMinTempOrderIdNum();
    
            while($minTempOrderIdNum > 0)
            {
                $query = "SELECT * FROM order_temp_storage WHERE ID = '$minTempOrderIdNum' ";
                $result = mysqli_query($con, $query);
        
                while($row = mysqli_fetch_assoc($result))
                {
                    $orderNo = $row['orderNo'];
                    $name = $row['name'];
                    $price = $row['price'];
                    $qnty = $row['qnty'];
                    $addOns = $row['addOns'];
                    $subTotal = $row['subTotal'];
                }
        
                $query2 = "INSERT INTO orders VALUES('', '$orderNo', '$name', '$price', '$qnty', '$addOns', '$subTotal')";
                $result2 = mysqli_query($con, $query2);
                
                if($result2)
                {
                    $query3 = "DELETE FROM order_temp_storage WHERE ID = '$minTempOrderIdNum' ";
                    $result3 = mysqli_query($con, $query3);
                }
                else
                {
                    $response = "Unknown Error Occured";
                }
                getMinTempOrderIdNum();
            }

            $response = "Successfully Placed Order(s)";
        }

        catch(Exception $ex)
        {
            $response = "Error Occured".$ex;
        }
        finally
        {
            echo $response;
        }

    function getMinTempOrderIdNum()
    {
        global $con;
        global $minTempOrderIdNum;

        $query = "SELECT MIN(ID) FROM order_temp_storage";
        $result = mysqli_query($con, $query);

        if($result)
        {
            $data = mysqli_fetch_array($result);
            $minTempOrderIdNum = $data[0];
        }
        else
        {
            $minTempOrderIdNum = 0;
        }
    }
?>