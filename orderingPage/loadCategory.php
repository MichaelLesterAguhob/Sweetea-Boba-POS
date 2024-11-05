
<?php 
    include_once('includes/connection.php');

    $response = "";
    $categoryData = "";

    try
    {
        global $con;

        $query = "SELECT DISTINCT category FROM product ORDER BY ID ASC";
        $result = mysqli_query($con, $query);

        while($row = mysqli_fetch_assoc($result))
        {
            $categoryData .= '
                            
                        <tr class="catRow" id="catRow" data-cat="'.$row['category'].'">
                            <td>'.$row['category'].'</td>
                        </tr>
            
                        ';
        }

        $response = json_encode(['status'=>'success', 'html'=> $categoryData]);
    }
    catch(Exception $ex)
    {
        $response = "Error Occured" .$ex ;
    }

    echo $response;

?>