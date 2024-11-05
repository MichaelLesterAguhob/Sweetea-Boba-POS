
$(document).ready(function()
{
    viewPreparingOrders();

}); 
 
function viewPreparingOrders() 
{
    $.ajax(
        {
            url:'preparingOrders/viewPreparingOrders.php',
            method:'post',
            success: function(data)
            {

                data = $.parseJSON(data);
                if(data.status == 'success')
                {
                    $('#preparingOrdersView').html(data.html);
                }
                else
                {
                    $('#preparingOrdersView').html(data);
                }
            }
        });
}


$(document).on('click', '#btnOrderDone', function()
{
    var toComplete = $(this).attr('data-order-id');
    $('#toCompleteNo').val(toComplete);
    $('#confirmPrepModal').modal('toggle');
});


$(document).on('click', '#orderCompleted', function()
{
    var completedNo = $('#toCompleteNo').val();
    $('#confirmPrepModal').modal('toggle');

    $.ajax(
        {
            url:'preparingOrders/orderCompleted.php',
            method:'post',
            data:{completedOrder:completedNo},
            success: function(data)
            {
                viewPreparingOrders();
                viewCompletedOrders();
                $('#prepModalMsg').html(data);
                $('#prepMsgModal').modal('toggle');
            }
        });
});


