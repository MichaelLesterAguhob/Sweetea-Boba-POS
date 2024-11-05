
<?php 

    include_once('includes/connection.php');

    $response = "";

    try
    {
        global $con;

        $query = "SELECT MAX(orderNo) FROM orders";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);

        $query1 = "SELECT MAX(orderNo) FROM orderno";
        $result1 = mysqli_query($con, $query1);
        $row1 = mysqli_fetch_array($result1);

        //orders is empty
        if($row[0] <= 0)
        {
            //orderno has content
            if($row1[0] > 0)
            {
                $response = $row1[0] + 1;
            }
            //orderno is empty
            else
            {
                $response = 1;
            }
        }
        //orders has content
        else if($row[0] > 0)
        {
            //if orders max no is > orderno max no
            if($row[0] > $row1[0])
            {
                $response = $row[0] + 1;
            }

            //if orders max no is < orderno max no
            else if($row[0] < $row1[0])
            {
                $response = $row1[0] + 1;
            }

            //if orders max no is = orderno max no
            else if($row[0] = $row1[0])
            {
                $response = $row[0] + 1;
            }
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