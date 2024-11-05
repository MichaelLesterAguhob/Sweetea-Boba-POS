
<?php 

include_once('includes/connection.php');

$response = "";
$data = '<option id="pairAddonsOpt" value="NONE">NONE</option>';

try
{
    global $con;

    $query = "SELECT * FROM add_ons";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($result))
    {
        $data .= '
        
        <option id="AddOnsOpt">'.$row['name'].'</option>

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






// 
// 



?>