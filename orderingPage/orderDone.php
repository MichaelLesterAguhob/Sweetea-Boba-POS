
<?php 
    include_once('includes/connection.php');

    $response = "";

    $bt = $_POST['bt'];
    $orderNo = $_POST['orderNo'];
    $prodName1 = $_POST['prodName1'];
    $addOnsName1 = $_POST['addOnsName1'];
    $addOns1Tot = (int)$_POST['addOns1Tot'];
    
    $prodName2 = $_POST['prodName2'];
    $addOnsName2 = $_POST['addOnsName2'];
    $addOns2Tot = (int)$_POST['addOns2Tot'];
    
    $size = $_POST['size'];
    $price =  (int)$_POST['price'];
    $qnty = (int)$_POST['qnty'];

    //setting value to input in database
    $addOnsTotal = $addOns1Tot + $addOns2Tot;
    $subTot = $addOnsTotal + ($price * $qnty);


    if($prodName1 != "" && $prodName2 != "")
    {
        $name = "1st: "."\n" . $prodName1 ."\n". "\n". "2nd: "."\n" .$prodName2 . "\n". "--------". "\n" . "Size: "."\n". $size . "\n" ."--------". "\n" . $bt;
    }
    else if($prodName1 != "" && $prodName2 == "")
    {
        $name = $prodName1. "\n"."--------". "\n" . "Size: ".$size;
    }

    $addOns = "";

    if($addOnsName1 != "" && $addOnsName2 == "" && $prodName2 == "")
    {
        $addOns = $addOnsName1 . "\n" ."\n" . "₱" . $addOnsTotal;
    }
    else if($addOnsName1 != "" && $addOnsName2 == "")
    {
        $addOns ="1st: " . $addOnsName1 . "\n" ."\n" . "₱" . $addOnsTotal;
    }
    else if($addOnsName2 != "" && $addOnsName1 == "")
    {
        $addOns = "2nd: " .$addOnsName2 . "\n" ."\n" . "₱" . $addOnsTotal;
    }
    else if($addOnsName1 != "" && $addOnsName2 != "")
    {
        $addOns = "1st: " . $addOnsName1 . "\n" . "\n" ."2nd: ". $addOnsName2 . "\n"."\n" . "₱" . $addOnsTotal;
    }
    else
    {
        $addOns = "NONE";
    }
    
    
    try
    {
   
      global $con;
      
      $query = "INSERT INTO order_temp_storage VALUES('', '$orderNo', '$name', '$price', '$qnty', '$addOns', $subTot)";

      $result = mysqli_query($con, $query);

      if($result)
      {
        $response = "Successfully Saved Order";
      }

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