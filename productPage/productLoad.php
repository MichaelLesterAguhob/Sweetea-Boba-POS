
<?php 
    include_once('includes/connection.php');
        try
        {
            global $con;
            $productDetails = '';
            // set static data
            $productDetails .='<table class="table table-striped table-bordered table-hover">
                                <thead class="bg-dark text-light">
                                    <tr>
                                        <th class="hideId">ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Buy1 Take1</th>
                                        <th>Status</th> 
                                    </tr>
                                </thead>
                                </tbody>';
            $query = "SELECT * FROM product ORDER BY ID DESC";
            $result = mysqli_query($con, $query);

            while($row = mysqli_fetch_assoc($result))
            {
                $productDetails .='
                                <tr id="prodRow"
                                    data-id="'.$row['ID'].'"
                                    data-img="'.$row['images'].'"
                                    data-name="'.$row['names'].'"
                                    data-cat="'.$row['category'].'"
                                    data-bt="'.$row['buy1_take1'].'"
                                    data-stat="'.$row['stat'].'"
                                    class="prodRow">
                                    <td class="hideId">'.$row['ID'].'</td>

                                    <td><img src="productPage/uploads/'.$row['images'].'" class="displayedImage"></td>

                                    <td>'.$row['names'].'</td>

                                    <td>'.$row['category'].'</td>

                                    <td>'.$row['buy1_take1'].'</td>
                                    
                                    <td>'.$row['stat'].'</td>
                                </tr>'; 
            }
            $productDetails .="</tbody>";
            $productDetails .="</table>";
            echo json_encode(['status'=>'success', 'html' => $productDetails]);
        }
        catch(Exception $ex)
        {
            echo ($ex); 
        }
        
?>