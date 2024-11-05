
<?php

include_once('includes/connection.php');

$response = "";
$data = '<option id="pairOpt">SAME FLAVOR</option>';

try
{
    global $con;

    $query = "SELECT names FROM product";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result))
    {
        $data .= '       
            <option id="pairOpt">'.$row['names'].'</option> 
        ';
    }

    $response = json_encode(['status' => 'success', 'html' => $data]);
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