
<?php 
    include_once('includes/connection.php');

    $response = "";

    try
    {
        global $con;

        $id = $_POST['id'];
        $name = strtoupper($_POST['name']);
        $price = strtoupper($_POST['price']);
    
        $query = "UPDATE add_ons SET name='$name', price='$price' WHERE ID='$id'";
        $result = mysqli_query($con, $query);

        if($query)
        {
             $response = "Successfully Updated";
        }
        else
        {
            $response = "Unknown Error Occured";
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