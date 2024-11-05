
<?php 

    include_once('includes/connection.php');

    $category = $_POST['category'];
    $searchInput = $_POST['searchInput'];
    $response = "";
    $productsData = '';
    $toSelect = "";

    if($category != "")
    {
        $toSelect = "WHERE category='$category' ";
    }
    else if($searchInput != "")
    {
        $query = "SELECT * FROM product WHERE names LIKE '$searchInput%' ORDER BY ID ASC";
        $result = mysqli_query($con, $query);
        $hasReturn = mysqli_num_rows($result);
        if($hasReturn > 0 )
        {
             $toSelect = "WHERE names LIKE '$searchInput%' ";
        }
        else
        {
            $toSelect = "";          
        }
    }
    else
    {
        $toSelect = "";
    }

    try
    {
        global $con;

        $query = "SELECT * FROM product $toSelect ORDER BY ID ASC";
        $result = mysqli_query($con, $query);

        while($row = mysqli_fetch_assoc($result))
        {
           $productsData .= '
                        <div class="card mb-3 text-dark text-center" style="width: 15rem; max-height: 18rem;" id="productCardDisplay"
                        data-id="'.$row['ID'].'"
                        data-name="'.$row['names'].'"
                        data-img="'.$row['images'].'"
                        data-bt="'.$row['buy1_take1'].'">
                          
                            <div class="card-header" id="productCardHeader"> '.$row['names'].' </div>

                                <div class="header-body p-2">

                                    <img src="productPage/uploads/'.$row['images'].'" alt="milktea" class="productImage">

                                    <p class="card-text">'.$row['buy1_take1'].'</p>

                                </div>

                                <div class="card-footer" id="sizePriceCont">
                            <table id="sizePriceDisplay">';
             
            $spQuery = "SELECT * FROM size_price ORDER BY ID ASC";
            $spResult = mysqli_query($con,$spQuery);

            while($spRow = mysqli_fetch_assoc($spResult))
            {
                $productsData .= '
                                    <tr>
                                    <td class="spSize">'.$spRow['size'].'</td>
                                    <td class="spPrice"> ₱ '.$spRow['price'].'</td>
                                    </tr>
                                ';
            }  

        $productsData .= '</table>';
        $productsData .= '</div>';
        $productsData .= '</div>';

        $response = json_encode(['status' => 'success', 'html' => $productsData]);
        }

        
    }
    catch(Exception $ex)
    {
        $response = "Error Occured " . $ex;
    }
    finally
    {
        echo $response;
    }
    
?>