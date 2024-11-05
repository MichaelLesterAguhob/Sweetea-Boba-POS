<?php 
include_once ('includes/connection.php'); 

try 
{   
    global $con;
    $prodName = strtoupper($_POST['productName']);
    $category = strtoupper($_POST['productCategory']);
    $b1t1 = strtoupper($_POST['b1t1Holder']);
    $stat = "AVAILABLE";

    move_uploaded_file($_FILES['productImage'] ['tmp_name'],'uploads/' . $_FILES['productImage']['name']);
   
    $image = $_FILES['productImage']['name'];
    $query = "INSERT INTO product (names, images, category, buy1_take1, stat) VALUES ('$prodName', '$image', '$category', '$b1t1', '$stat')";
    $result = mysqli_query($con, $query);

    if($result)
    { 
            echo "Successfully Added"; 
    }
    else
    {
        echo ('Unknown Error Occured in Query');
    }
    
}
catch (Exception $ex)
{
    echo "Unknown Error Occured" . $ex;
}

?>