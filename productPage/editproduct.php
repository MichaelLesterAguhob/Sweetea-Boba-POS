
<?php 
    include_once('includes/connection.php');
 
    global $con;

    $prodId = $_POST['prodIdHolder'];
    $newProdName = strtoupper($_POST['prodNameHolder']); 
    $newProdCat = strtoupper($_POST['prodCatHolder']); 
    $newProdBt = strtoupper($_POST['prodBtHolder']); 
    $newProdStat = strtoupper($_POST['prodStatHolder']);
    $message = "";

    try
    {
        // if no new image uploaded, execute this code
        if($_FILES['newProdImg']['size'] == 0)
        {
            $query = "UPDATE product SET names ='$newProdName', category='$newProdCat',buy1_take1='$newProdBt', stat='$newProdStat' WHERE ID='$prodId' ";
            $result = mysqli_query($con, $query);

            $message = "Successfully Updated Details";
        }   
        //if has new image uploaded execute this code
        else
        {
            move_uploaded_file($_FILES['newProdImg']['tmp_name'],'uploads/'.$_FILES['newProdImg']['name']);

            $newImg = $_FILES['newProdImg']['name'];
            $query = "UPDATE product SET names ='$newProdName', images='$newImg', category=' $newProdCat',buy1_take1='$newProdBt', stat='$newProdStat' WHERE ID='$prodId' ";
            $result = mysqli_query($con, $query);

            $message = "Successfully Updated Details";
        }

    }
    catch(Exception $ex)
    {
        echo("Error Occured <br>" . $ex);
    }
    echo($message);
?>