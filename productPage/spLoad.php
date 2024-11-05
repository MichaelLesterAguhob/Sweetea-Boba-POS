
<?php 
include_once('includes/connection.php');

$response = "";
$spData = '';

try
{
    global $con;

    $query = "SELECT * FROM size_price ORDER BY ID ASC";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result))
    {
        $spData .= '
        <tr id="spRow" class="spRow"
        data-id="'.$row['ID'].'"
        data-size="'.$row['size'].'"
        data-price="'.$row['price'].'">
            <td>'.$row['size'].'</td>
            <td>'.$row['price'].'</td>
        </tr>';
    }
    
    $response = json_encode(['status'=>'success', 'html' => $spData]);
}
catch(Exception $ex)
{
    $response = "Error Occured <br>" . $ex;
}

echo $response;

?>