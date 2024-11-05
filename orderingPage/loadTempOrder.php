
<?php 

include_once('includes/connection.php');
$response = "";
$data = "";

try
{
    global $con;

    $query = "SELECT * FROM order_temp_storage ORDER BY ID ASC";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result))
    {
        $data .= '
                <tr '.$row['ID'].'>
                <td style="width: 30%;"><pre>'.$row['name'].'</pre></td>
                <td style="width: 20%;"><pre>'.$row['price'].'</pre></td>
                <td style="width: 10%;"><pre>'.$row['qnty'].'</pre></td>
                <td style="width: 20%;"><pre>'.$row['addOns'].'</pre></td>
                <td style="width: 20%;"><pre>'.$row['subTotal'].'</pre></td>
                </tr>
                ';
    }

    $response = json_encode(['status' => 'success', 'html' => $data]);

}
catch(Exception $ex)
{
    $response = "Error Occured" + $ex;
}
finally
{
    echo $response;
}




?>