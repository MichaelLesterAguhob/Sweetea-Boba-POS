
<?php

include_once('includes/connection.php');

$response = "";
$data = '<option value="ChooseSize">ChooseSize</option>';

try
{
    global $con;

    $query = "SELECT * FROM size_price";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result))
    {
        $data .= '

            <option id="prodSP" data-price="'.$row['price'].'">
            '.$row['size'].'
            </option>
            
        
        ';
    }

    $response = json_encode(['status' => 'success', 'html' => $data]);
}
catch(Exception $ex)
{
    $response = "Error Occured" . $ex;
}

echo $response;



?>