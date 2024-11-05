
$(document).ready(function()
{
    viewOrders();
});

function viewOrders()
{
    $.ajax(
        {
            url:'orders/viewOrders.php',
            method:'post',
            success: function(data)
            {

                data = $.parseJSON(data);
                if(data.status == 'success')
                {
                    $('#ordersView').html(data.html);
                }
                else
                {
                    $('#ordersView').html(data);
                }
            }
        });
}

var minOrderNum = 0;
function minOrderNo()
{
    $.ajax(
        {
            url:'orders/minOrderNo.php',
            method:'post',
            success: function(data)
            {
                minOrderNum = data;
            }
        });
}
minOrderNo();

var PrepareOrCancel = "";

$(document).on('click','#btnPrepare',function()
{   
    var orderNo = $(this).attr('data-order-id');
    minOrderNo();

    if(orderNo == "" || orderNo == 0)
    {
        $('#mmMsg').text('No Order Selected');
        $('#msgModal').modal('toggle');
    }
    else if(parseInt(orderNo) != parseInt(minOrderNum)  )
    {
        $('#mmMsg').text('Prepare the previous orders first');
        $('#msgModal').modal('toggle');
    }
    else
    {
        $('#orderNoHolder').val(orderNo);
        $('#confirmMsg').html('Prepare this order?');
        $('#confirmModal').modal('toggle');
        PrepareOrCancel = "prepare";
    }
});

$(document).on('click','#btnCancelOrder',function()
{
    var orderNo = $(this).attr('data-order-id');
    minOrderNo();

    if(orderNo == "" || orderNo == 0)
    {
        $('#mmMsg').text('No Order Selected');
        $('#msgModal').modal('toggle');
    }
    else if(parseInt(orderNo) != parseInt(minOrderNum)  )
    {
        $('#mmMsg').text('Wait for its turn before you can cancel this order');
        $('#msgModal').modal('toggle');
    }
    else
    {
    $('#orderNoHolder').val(orderNo);
    $('#confirmMsg').html('Cancel this order?');
    $('#confirmModal').modal('toggle');
    PrepareOrCancel = "cancel";
    }
});

//modal confirm button
$(document).on('click','#orderActionConfrim',function()
{
   if(PrepareOrCancel == "prepare")
   {
        prepareOrder();
        
   }
   else if(PrepareOrCancel == "cancel")
   {
        cancelOrder();
        
   }
});

//confrim button functions
function prepareOrder()
{
    var orderToPrepare = $('#orderNoHolder').val();
    
    $.ajax(
        {
            url:'orders/prepare.php',
            method:'post',
            data:{prepare:orderToPrepare},
            success: function(output)
            {
                $('#confirmModal').modal('toggle');
                $('#mmMsg').text(output);
                $('#msgModal').modal('toggle');
                viewOrders();
                minOrderNo();
            }
        });
}

function cancelOrder()
{
    var orderToCancel = $('#orderNoHolder').val();
    
    $.ajax(
        {
            url:'orders/cancel.php',
            method:'post',
            data:{cancelOrder:orderToCancel},
            success: function(data)
            {
                $('#confirmModal').modal('toggle');
                $('#mmMsg').text(data);
                $('#msgModal').modal('toggle');
                viewOrders();
                minOrderNo();
                loadOrderNumber();
            }
        });
}