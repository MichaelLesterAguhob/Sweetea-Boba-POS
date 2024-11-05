
<?php 
    include_once('includes/connection.php');
    
    $response = "";
    $addOnsDetails = "";

    try
    {
        global $con;

        $query = "SELECT * FROM add_ons ORDER BY ID ASC";
        $result = mysqli_query($con, $query);

        while($row = mysqli_fetch_assoc($result))
        {
            $addOnsDetails .= '
                <tr id="aoRow" class="aoRow"
                    data-id="'.$row['ID'].'"
                    data-name="'.$row['name'].'"
                    data-price="'.$row['price'].'"
                > 
                    <td>'.$row['name'].'</td>
                    <td>'.$row['price'].'</td>
                </tr>
                ';
        }

        $response = json_encode (['status'=>'success', 'html'=>$addOnsDetails]);

    }
    catch(Exception $ex)
    {
        $response = "Error Occured". $ex;
    }
    finally
    {
        echo $response;
    }

?>