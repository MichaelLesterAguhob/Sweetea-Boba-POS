
 

<?php 
include_once('includes/connection.php');

//variables that will contain output
$response = '';
$data = '';

try
{
    global $con;

    // get max orderNo
    $query1 = "SELECT MAX(orderNo) FROM completed_orders";
    $result1 = mysqli_query($con, $query1);
    $maxOrderNo = mysqli_fetch_array($result1);
    $max = $maxOrderNo[0];

    // get min orderNo
    $query2 = "SELECT MIN(orderNo) FROM completed_orders";
    $result2 = mysqli_query($con, $query2);
    $minOrderNo = mysqli_fetch_array($result2); 
    $min = $minOrderNo[0];

    while($min <= $max)
    {
        $total = 0;
        // get min orderNo
        $query3 = "SELECT * FROM completed_orders WHERE orderNo = '$min' ";
        $result3 = mysqli_query($con, $query3);

        $checkMinNo = "SELECT * FROM completed_orders WHERE orderNo = '$min' ";
        $checkMinNoRes = mysqli_query($con, $checkMinNo);
        $cmnrRow = mysqli_fetch_assoc($checkMinNoRes);

        $getDT = "SELECT * FROM orderno WHERE orderNo = '$min' ";
        $getDTRes = mysqli_query($con, $getDT);
        $DateTimeRow = mysqli_fetch_assoc($getDTRes);

        if($cmnrRow > 0)
        {
            //static table data
            $data .='<div class="card" id="billReceipt">
                        <div class="card-header" style="background-color:lightgreen;>
                                <h3 style="text-align:left; ">Order # '.$min.'</h3>
                                <p class="completedText">Completed</p>
                        </div>
    
                        <div class="card-body" id="billReceiptBody">
                            <table style="width:100%; margin:auto;">
                                <tr>
                                    <th class="receiptTh" text-align:center;" colspan="6"><h5><b>SWEETEA BOBA<b></h5></th>
                                </tr>
                                <tr>
                                    <td class="receiptTh" text-align:center;" colspan="6" style="line-height:10px;"><small>Adress</small></td>
                                </tr>
                                <tr>
                                    <td class="receiptTh" text-align:center;" colspan="6" style="line-height:10px;"><small>more address details</small></td>
                                </tr>
                                <tr>
                                    <td class="receiptTh" text-align:center;" colspan="6" style="line-height:10px;">sweateaBoba@gmail.com</td>
                                </tr>
                                <tr>
                                    <td class="receiptTh" text-align:center;" colspan="6" style="line-height:12px;">09123456789</td>
                                </tr>
                                <tr>
                                    <th class="receiptTh" colspan="6" style="line-height:10px;">
                                    ***************************************
                                    </th>
                                </tr>
                                <tr>
                                    <td class="receiptTh" text-align:center;" colspan="6" style="line-height:5px;"> <B> ORDER #'.$min.' <B> </td>
                                </tr>
                                <tr>
                                    <th class="receiptTh" colspan="6" style="line-height:10px;">
                                    ---------------------------------------
                                    </th>
                                </tr>
                                <tr>
                                    <td class="receiptTh" colspan="3" style="line-height:10px; text-align:left;">&nbsp;<B>Date: '.$DateTimeRow['date'].'<B> </td>
                                    <td class="receiptTh" colspan="3" style="line-height:10px; text-align:left;">&nbsp;<B>Time: '.$DateTimeRow['time'].'<B> </td>
                                </tr>
                                <tr>
                                    <th class="receiptTh" colspan="6" style="line-height:5px;">
                                    ---------------------------------------
                                    </th>
                                </tr>
                                <tr>
                                    <th class="receiptTh" style="width:5%; text-align:left;"></th>
                                    <th class="receiptTh" style="width:30%; text-align:left;">Name</th>
                                    <th class="receiptTh" style="width:15%; text-align:left;">Price</th>
                                    <th class="receiptTh" style="width:10%; text-align:left;">Qnty</th>
                                    <th class="receiptTh" style="width:25%; text-align:left;">AddOns</th>
                                    <th class="receiptTh" style="width:15%; text-align:left;">SubTotal</th>
                                </tr>';

                                $num = 1;
                                while($row = mysqli_fetch_assoc($result3)) 
                                {
                                    $data .= '<tr>
                                                        <th class="receiptTd" style="width:5%; text-align:left;">'.$num.'</th>
                                                        <td class="receiptTd" id="tdName" style="width:30%; text-align:left;"><pre>'.$row['name'].'</pre></td>
                                                        <td class="receiptTd" style="width:15%; text-align:center;"><pre>'.$row['price'].'</pre></td>
                                                        <td class="receiptTd" style="width:10%; text-align:left;"><pre>'.$row['qnty'].'</pre></td>
                                                        <td class="receiptTd" style="width:25%; text-align:left;"><pre>'.$row['addOns'].'</pre></td>
                                                        <td class="receiptTd" style="width:15%; text-align:center;"><pre>'.$row['subTotal'].'</pre></td>
                                                    </tr>
                                                    ';
                                    $total += $row['subTotal'];
                                    $num ++;
                                }

                                $query4 = "SELECT * FROM payment WHERE orderNo = '$min' ";
                                $result4 = mysqli_query($con, $query4);
                                $row1 = mysqli_fetch_assoc($result4);
                                $payment = 0;
                                $change = 0;
                    
                                if($row1 > 0) 
                                {
                                    $payment = $row1['paymentAmnt'];
                                    $change = $row1['changeAmnt'];
                                }
                                    $data .= '<tr>
                                                            <th class="receiptTh" colspan="6" style="line-height:5px;">
                                                            ---------------------------------------
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="receiptThBot" style="text-align:left; line-height:1px;" colspan="4" >Total Amount: </th>
                                                            <th style="text-align:left; line-height:1px;" colspan="2">₱'.$total.'</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="receiptThBot" style="text-align:left; line-height:1px;" colspan="4">Payment: </th>
                                                            <th style="text-align:left; line-height:1px;" colspan="2">₱'.$payment.'</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="receiptThBot" style="text-align:left; line-height:1px;" colspan="4">Change: </th>
                                                            <th style="text-align:left; line-height:1px;" colspan="2">₱'.$change.'</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="receiptTh" colspan="6">
                                                            ---------------------------------------
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="receiptTh" colspan="6">
                                                            **************THANK YOU!***************
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th class="receiptTh" colspan="6">
                                                            ---------------------------------------
                                                            </th>
                                                        </tr>
                                                        </table>
                                                    </div>
                                                </div>';
                                
        }
        
        $response = json_encode(['status'=>'success', 'html'=>$data]);
        $min += 1;
         
    }                    
    echo $response;
}
catch(Exception $ex)
{
    echo "Error Occured" . $ex;
}


?>

 
        