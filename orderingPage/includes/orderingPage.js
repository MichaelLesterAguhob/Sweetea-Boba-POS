
$(document).ready(function()
{
    loadProducts();
    loadCategory();
    loadOrderNumber()

    //category click
    $(document).on('click', '#catRow', function()
    {
        var categoryName = $(this).attr('data-cat');

        $('#catHolder').val(categoryName);
        $('#searchInput').val("");
        $('#categoryFooter').css('display', 'block');
        loadProducts();
    }); 
    
    //code for view all button in category
    $(document).on('click', '#viewAll', function()
    {
        $('#catHolder').val("");
        $('#searchInput').val("");
        $('#categoryFooter').css('display', 'none');
        loadProducts();
    });
    
    //code for search button
    $(document).on('click', '#search', function()
    {
        if($('#searchInput').val() == "")
        {
            $('#searchMsg').html("No input to search").fadeIn(1000).fadeOut(1000);
        }
        else
        {
            $('#catHolder').val("");
            $('#categoryFooter').css('display', 'block');
            loadProducts();
        }
    });

    // code if user press and release enter key will trigger the search button
    $("#searchInput").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            
            $('#search').focus();
            $('#search').click();
            $('#searchInput').focus();

        }
    });

    // code if user press any key will trigger the view all button
    $("#searchInput").on('keyup', function (e) {

        if($('#searchInput').val() == "")
        { 
            $('#viewAll').click();
            $('#searchInput').focus();
        }
    });

    //
    $(document).keydown(function(e)
    {
        if(e.keyCode == 32)
        {
            if($('#messageModal').is(':visible'))
            {
                $('#messageModal').modal('toggle');      
            }
            else if($('#placeOrderModal').is(':hidden'))
            {
                $('#placeOrder').click();         
            }

        }
    });

    //
    $('#amountPaid').keydown(function(e)
    {
        if(e.keyCode == 13)
        {
            if($('#placeOrderModal').is(':visible'))
            {
                $('#placeNow').click();            
            } 
                      
        }
    });
    
});


// code for loading products
function loadProducts()
{
    var catHolder = $('#catHolder').val();
    var searchInput = $('#searchInput').val();

    $.ajax(
        {
            url:'orderingPage/loadProducts.php',
            method:'post',
            data:{category:catHolder, searchInput:searchInput},
            success:function(data)
            {
                data = $.parseJSON(data);

                if(data.status == 'success')
                {
                    $('#productsDisplay').html(data.html);
                }
                else
                {
                    $('#productsDisplay').html(data);
                }
            }
        });
}


// codes for loading categories
function loadCategory()
{
    $.ajax(
        {
            url:'orderingPage/loadCategory.php',
            method:'post',
            success: function(data)
            {
                data = $.parseJSON(data);

                if(data.status == 'success')
                {
                    $('#categoryDisplay').html(data.html);
                }
                else
                {
                    $('#categoryDisplay').html(data);
                }
            }
        });
}


// Codes for ordering by clicking a products
$(document).on('click', '#productCardDisplay', function()
{
    $('#qnty').val("1");
    var prodID = $(this).attr('data-id');
    var prodName = $(this).attr('data-name');
    var prodImg = $(this).attr('data-img');
    var prodBt = $(this).attr('data-bt');

    $('#prodImage').attr('src', 'productPage/uploads/' + prodImg);
    $('#prodID').val(prodID);
    $('#prodName').val(prodName);
    $('#b1t1').val(prodBt);
    $('#price').val("");
    
    $('#orderingModal').modal('toggle');
    loadSizePrice();
    loadPairAddOns();

    if($('#b1t1').val() != "BUY 1 TAKE 1")
    {
        $('.pairSelection').css('display', 'none');
        $('#pair').val('');
    }
    else
    {
        $('.pairSelection').css('display', 'block');
        loadPairChoices();
    }
    
});


// loading size and price data on ordering modal
function loadSizePrice()
{
    $.ajax(
        {
            url:'orderingPage/loadSizePrice.php',
            method: 'post',
            success: function(data)
            {
                data = $.parseJSON(data);

                if(data.status == 'success')
                {
                   $('#size').html(data.html);
                }
                else
                {
                    $('#size').html(data);
                }
            }
        });
}

//Load choices for pair
function loadPairChoices()
{
    $.ajax(
        {
            url: 'orderingPage/loadPairChoices.php',
            method:'post',
            success: function(data)
            {
                data = $.parseJSON(data);
                if(data.status == 'success')
                {
                    $('#pair').html(data.html)
                }
                else
                {
                    $('#pair').html(data)
                }
            }
        });
}

//Load choices for pair
function loadPairAddOns()
{
    $.ajax(
        {
            url: 'orderingPage/loadPairAddOns.php',
            method:'post',
            success: function(data)
            {
                data = $.parseJSON(data);
                if(data.status == 'success')
                {
                    $('#AddOns').html(data.html)
                    $('#AddOns2').html(data.html)
                }
                else
                {
                    $('#AddOns').html(data)
                    $('#AddOns2').html(data)
                }
            }
        });
}


//display the price once size is chosen
$(document).on('change', '#size', function()
{
    if($('#size').val() != "ChooseSize")
    {
        var size = $('#size').val();

        $.ajax(
            {
                url:'orderingPage/onChangeSize.php',
                method:'post',
                data:{size:size},
                success: function(price)
                {
                     $('#price').val(price);
                }            
            });
    }
    else
    {
        $('#price').val("");
    }
    // var price = $('option:selected', this).data('id');
    
});


//Preventing quantity to be set less than 1
$(document).on('change', '#qnty', function()
{
    onChangeQuantity();
});


//Handle click on button plus and minus
$('#plus').on('click', function()
{
    if($('#price').val()!="")
    {
        var currentVal = parseInt($('#qnty').val());
        currentVal = currentVal + 1;
        $('#qnty').val(currentVal);
    }
    else
    {
        $('#qntyMessage').attr('class', 'text-warning');
        $('#qntyMessage').html("Choose Size First!").fadeIn(1000).fadeOut(3000);
    }
});

$('#minus').on('click', function()
{
    if($('#price').val()!="")
    {
        var currentVal = parseInt($('#qnty').val());
        currentVal = currentVal - 1;
        $('#qnty').val(currentVal);
        onChangeQuantity();
    }
    else
    {
        $('#qntyMessage').attr('class', 'text-warning');
        $('#qntyMessage').html("Choose Size First!").fadeIn(1000).fadeOut(3000);
    }
});


// function for on change event in quantity
function onChangeQuantity()
{
    if($('#qnty').val() == "" || $('#qnty').val() < 1)
    {
        $('#qnty').val("1");
        $('#qntyMessage').attr('class', 'text-warning');
        $('#qntyMessage').html("Less than 1 quantity is invalid!").fadeIn(1000).fadeOut(3000);
    }
    else if( $('#price').val()=="" )
    {
        $('#qntyMessage').attr('class', 'text-warning');
        $('#qntyMessage').html("Choose Size First!").fadeIn(1000).fadeOut(3000);
    }
}

// first flavor addons event
$(document).on('change', '#AddOns', function()
{
    if($('#AddOns').val() != "NONE")
    {
        getAoPrice("addOns");
    }
    else
    {
        $('#AoPrice').val("");
    }
    
});

// 2nd flavor addons event
$(document).on('change', '#AddOns2', function()
{
    if($('#AddOns2').val() != "NONE")
    {
        getAoPrice("addOns2");
    }
    else
    {
        $('#AoPrice2').val("");
    }
    
});


//addons chosen shows price
function getAoPrice(action)
{
    if(action == "addOns")
    {
        var addOnsName = $('#AddOns').val();
        $.ajax(
            {
                url:'orderingPage/getAoPrice.php',
                method:'post',
                data:{addOnsname:addOnsName},
                success: function(data)
                {
                    $('#AoPrice').val(data);
                }
            });
    }

    else if(action == "addOns2")
    {
        var addOnsName = $('#AddOns2').val();
        $.ajax(
            {
                url:'orderingPage/getAoPrice.php',
                method:'post',
                data:{addOnsname:addOnsName},
                success: function(data)
                {
                    $('#AoPrice2').val(data);
                }
            });
    }
}

//addOns Qnty on change event
function addOnsQntyChange(qntyInputField){

    if(qntyInputField == "1")
    {
        var qnty = $('#AoQnty').val();
        var addOnsName = $('#AddOns').val();

        if(addOnsName == "NONE" && qnty != 0)
        {
            $('#AoQnty').val(0);
            $('#msg1').html("Select Add Ons First!").attr('class', 'text-warning').fadeIn(1000).fadeOut(2000);
            
        }
        else if(addOnsName != "NONE" && qnty <= 0)
        {
            $('#AoQnty').val("1");
            $('#msg1').html("Invalid Quantity!").attr('class', 'text-warning').fadeIn(1000).fadeOut(2000);
        } 
    }
    else if(qntyInputField == "2")
    {
        var qnty = $('#AoQnty2').val();
        var addOnsName = $('#AddOns2').val();

        if(addOnsName == "NONE" && qnty != 0)
        {
            $('#msg2').html("Select Add Ons First!").attr('class', 'text-warning').fadeIn(1000).fadeOut(2000);
            $('#AoQnty2').val(0);
        }
        else if(addOnsName != "NONE" && qnty <= 0)
        {
            $('#AoQnty2').val("1");
            $('#msg2').html("Invalid Quantity!").attr('class', 'text-warning').fadeIn(1000).fadeOut(2000);
        }
    }
    else if(qntyInputField == "none")
    {
        $('#AoQnty').val(0);
    }
    else
    {
        $('#AoQnty2').val(0);
    }
}


//addOnsQuantity click
function addOnsQntyClick(action)
{
    if(action == "1")
    {
        var qnty = parseInt($('#AoQnty').val());
        qnty += 1;

        $('#AoQnty').val(qnty);
        addOnsQntyChange('1');
    }

    else if(action == "2")
    {
        var qnty = parseInt($('#AoQnty2').val());
        qnty += 1;

        $('#AoQnty2').val(qnty);
        addOnsQntyChange('2');
    }
}

//  storing add ons on variables once next button is clicked
var flavor1AddOns = "";
var intltot = 0;
var addOns1Total = 0;

var flavor2AddOns = "";
var intltot2 = 0;
var addOns2Total = 0;

function addOnsNext(action)
{
    if(action == "flavor1AddOns")
    {
        var addOnsName1 = $('#AddOns').val();
        var addOnsPrice1 = parseInt($('#AoPrice').val()); 
        var addOnsQnty1 = parseInt($('#AoQnty').val());

        if(addOnsQnty1 != 0 && addOnsName1 != "NONE")
        {
            var total = (addOnsPrice1 * addOnsQnty1);
            intltot += total;

            addOns1Total =  intltot;

            flavor1AddOns += "\n" + addOnsName1 + " x" + addOnsQnty1 + "\n" + "= " + total;

            $('#AoPrice').val("");
            $('#AoQnty').val("0");
            $('#AddOns option')
            .removeAttr('selected')
            .filter('[value=NONE]')
            .attr('selected', true);
        }
        else
        {
            $('#messageModalText').html("Select add ons and set quantity first!");
            $('#messageModal').modal('toggle');
        }
        
        
    }
    else if(action == "flavor2AddOns")
    {
        var addOnsName2 = $('#AddOns2').val();
        var addOnsPrice2 = $('#AoPrice2').val();
        var addOnsQnty2 = $('#AoQnty2').val();

        if(addOnsQnty2 != 0  && addOnsName2 != "NONE")
        {
            var total = (addOnsPrice2 * addOnsQnty2);
            intltot2 += total;

            addOns2Total =  intltot2;

            flavor2AddOns += "\n" + addOnsName2 + " x" + addOnsQnty2 + "\n" + "= " + total;

            $('#AoPrice2').val("");
            $('#AoQnty2').val("0");
            $('#AddOns2 option')
            .removeAttr('selected')
            .filter('[value=NONE]')
            .attr('selected', true);
        }
        else
        {
            $('#messageModalText').html("Select add ons and set quantity first!");
            $('#messageModal').modal('toggle');
        }
    }
}

//Code for order DONE button
function orderDone()
{
    var b1t1 = $('#b1t1').val();
    var orderNo = $('#orderNumber').val();

    var prodName1 = $('#prodName').val();
    var addOnsName1 = flavor1AddOns;
    var addOns1Tot = addOns1Total;

    var prodName2 = $('#pair').val();
    var addOnsName2 = flavor2AddOns;
    var addOns2Tot = addOns2Total;

    var size = $('#size').val();
    var price =$('#price').val();
    var qnty = $('#qnty').val();

    var addOnsPrice = $('#AoPrice').val();
    var addOnsPrice2 = $('#AoPrice2').val();

    if(price != "")
    {
        if(addOnsPrice != '' || addOnsPrice2 != '')
        {
            $('#messageModalText').html("Save AddOns first!"); 
            $('#messageModal').modal('toggle');
        }
        else
        {
            $.ajax(
                {
                    url: 'orderingPage/orderDone.php',
                    method:'post',
                    data: {
                           bt:b1t1, 
                           orderNo:orderNo,
                           prodName1:prodName1,
                           addOnsName1:addOnsName1,
                           addOns1Tot: addOns1Tot,
                           
                           prodName2:prodName2,
                           addOnsName2:addOnsName2,
                           addOns2Tot: addOns2Tot,
    
                           size:size,
                           price:price,
                           qnty:qnty
                          },
                    success: function(data)
                    {
                        $('#size option')
                        .removeAttr('selected')
                        .filter('[value=ChooseSize]')
                        .attr('selected', true);
                        $('#price').val("");
                        $('#qnty').val("1");
    
                        flavor1AddOns = "";
                        addOns1Total = 0;
                        intltot = 0;
                        flavor2AddOns = "";
                        addOns2Total = 0;
                        intltot2 = 0;
    
                        $('#orderingModal').modal('toggle');
                        loadTempOrder()
    
                        $('#messageModalText').html(data);
                        $('#messageModal').modal('toggle');
                        loadTotal();
                    }
                });
        }
    }
    else
    {
        $('#messageModalText').html("Choose Size First!");
        $('#messageModal').modal('toggle');
    }
  
}

//loading data from temporary order storage
function loadTempOrder()
{
    $.ajax(
        {
            url: 'orderingPage/loadTempOrder.php',
            method: 'post',
            success: function(data)
            {
                data = $.parseJSON(data);
                if(data.status == 'success')
                {
                    $('#ordersSummary').html(data.html);
                }
                else
                {
                    $('#messageModalText').html(data);
                    $('#messageModal').modal('toggle');
                }
            }
        });
}

//loading max order number
function loadOrderNumber()
{
    $.ajax(
        {
            url:'orderingPage/loadOrderNumber.php',
            mmethod:'post',
            success: function(data)
            {
                $('#orderNumber').val(data);
            }
        });
}

//load total of current order
function loadTotal()
{
    $.ajax(
        {
            url:'orderingPage/loadTotal.php',
            mmethod:'post',
            success: function(data)
            {
                $('#orderTotal').val(data);
            }
        });
}

$(document).on('click', '#placeOrder', function()
{
        $('#placeOrderModal').modal('toggle');
       
        setTimeout(
            function() 
            {
                $('#amountPaid').val('');;
                $('#amountPaid').focus();
            }, 200);
        
        
});

//place order code
function placeOrder()
{
    var orderNo = $('#orderNumber').val();
    var orderTotal = parseInt($('#orderTotal').val());
    var payment = parseInt($('#amountPaid').val());

    if(orderTotal != '0' && orderTotal != '')
    {
        if(payment >= orderTotal && payment != 0 && payment != '')
        {
            $.ajax(
                {
                    url:'orderingPage/placeOrder.php',
                    method:'post',
                    data:{orderNo:orderNo, orderTotal:orderTotal, payment:payment},
                    success: function(data)
                    {
                        $('#messageModalText').html(data);
                        $('#messageModal').modal('toggle');
                        
                        $('#orderTotal').val('0');
                        $('#amountPaid').val('0');
                        loadTempOrder();
                        loadOrderNumber();
                        minOrderNo();
                    }
                });
        }
        else
        {
            $('#messageModalText').html("Payment < Total Bill");
            $('#messageModal').modal('toggle');
        }
    }
    else
    {
        $('#messageModalText').html("No order(s) yet");
        $('#messageModal').modal('toggle');
    }
    
}

//cancelling current orders
$('#CCOrder').on('click',function()
{
    var orderTotal = parseInt($('#orderTotal').val());

    if(orderTotal != 0 && orderTotal != '')
    {
        cancelCurrentOrderNow();
    }
    else
    {
        $('#cancelOrderModal').modal('toggle');
        $('#messageModalText').html("No order(s) yet");
        $('#messageModal').modal('toggle');
    }

});

function cancelCurrentOrderNow()
{
    $.ajax(
        {
            url:'orderingPage/cancelCurrentOrder.php',
            method:'',
            success: function(data)
            {
                $('#cancelOrderModal').modal('toggle');
                $('#messageModalText').html(data);
                $('#messageModal').modal('toggle');
                loadTempOrder();
                loadOrderNumber();
                $('#orderTotal').val('0');
                $('#amountPaid').val('0');
            }
        });
}



// code for showing page content when navigation is clicked
function showOrders(action)
{
    //orders nav
    if(action == 1 || action == 2)
    {
        //hide other content
        $('#orderingDisplay').css('display', 'none');
        $('#preparingOrders').css('display', 'none');
        $('#completedOrders').css('display', 'none');
        
        //hide nav self name
        $('#ordersNav').css('display', 'none');
        $('#ordersNav2').css('display', 'none');
        
        //show self content 
        $('#orders').css('display', 'flex');
        $('#backToHome').css('display', 'flex');
        $('#backToHome2').css('display', 'flex');

        //show other nav names
        $('#preparingNav').css('display', 'flex');
        $('#preparingNav2').css('display', 'flex');
        $('#completedNav').css('display', 'flex');
        $('#completedNav2').css('display', 'flex');
        
        //hide other nav back
        $('#backToHome3').css('display', 'none');
        $('#backToHome4').css('display', 'none');
        $('#backToHome5').css('display', 'none');
        $('#backToHome6').css('display', 'none');

        viewOrders();

        //modal navigation
        if(action == 2)
        {
            $('#navModal').modal('toggle');
        }
    }

    //==================================================
    //preparing orders nav
    else if(action == 3 || action == 4)
    {   
        //hide other content
        $('#orderingDisplay').css('display', 'none');
        $('#orders').css('display', 'none');
        $('#completedOrders').css('display', 'none');
        
        //hide nav self name
        $('#preparingNav').css('display', 'none');
        $('#preparingNav2').css('display', 'none');
        
        //show self content
        $('#preparingOrders').css('display', 'flex');
        $('#backToHome3').css('display', 'flex');
        $('#backToHome4').css('display', 'flex');

        //show other nav names
        $('#ordersNav').css('display', 'flex');
        $('#ordersNav2').css('display', 'flex');
        $('#completedNav').css('display', 'flex');
        $('#completedNav2').css('display', 'flex');
        
        //hide other nav back
        $('#backToHome').css('display', 'none');
        $('#backToHome2').css('display', 'none');
        $('#backToHome5').css('display', 'none');
        $('#backToHome6').css('display', 'none');
        
        viewPreparingOrders();

        //modal navigation
        if(action == 4)
        {
            $('#navModal').modal('toggle');
        }
    }

    //==================================================
    //completed orders nav
    else if(action == 5 || action == 6)
    {   
        //hide other content
        $('#orderingDisplay').css('display', 'none');
        $('#orders').css('display', 'none');
        $('#preparingOrders').css('display', 'none');
        
        //hide nav self name
        $('#completedNav').css('display', 'none');
        $('#completedNav2').css('display', 'none');
        
        //show self content
        $('#completedOrders').css('display', 'flex');
        $('#backToHome5').css('display', 'flex');
        $('#backToHome6').css('display', 'flex');

        //show other nav names
        $('#ordersNav').css('display', 'flex');
        $('#ordersNav2').css('display', 'flex');
        $('#preparingNav').css('display', 'flex');
        $('#preparingNav2').css('display', 'flex');
        
        //hide other nav back
        $('#backToHome').css('display', 'none');
        $('#backToHome2').css('display', 'none');
        $('#backToHome3').css('display', 'none');
        $('#backToHome4').css('display', 'none');
        
        //modal navigation
        if(action == 6)
        {
            $('#navModal').modal('toggle');
        }
    }
}


function backToOrdering(action)
{   
    // orders back nav
    if(action == 1 || action == 2)
    {
        //show home content
        $('#orderingDisplay').css('display', 'flex');

        //show nav names
        $('#ordersNav').css('display', 'flex');
        $('#ordersNav2').css('display', 'flex');

        //hide self content
        $('#orders').css('display', 'none');
        $('#backToHome').css('display', 'none');
        $('#backToHome2').css('display', 'none');

        //modal navigation
        if(action == 2)
        {
            $('#navModal').modal('toggle');
        }
    }

    //====================================================
    //preparing orders back nav
    else if(action == 3 || action == 4)
    {
        //show home content
        $('#orderingDisplay').css('display', 'flex');

        //show nav names
        $('#preparingNav').css('display', 'flex');
        $('#preparingNav2').css('display', 'flex');

        //hide self content
        $('#preparingOrders').css('display', 'none');
        $('#backToHome3').css('display', 'none');
        $('#backToHome4').css('display', 'none');

        //modal navigation
        if(action == 4)
        {
            $('#navModal').modal('toggle');
        }
    }

    //====================================================
    //completed orders back nav
    else if(action == 5 || action == 6)
    {
        //show home content
        $('#orderingDisplay').css('display', 'flex');

        //show nav names
        $('#completedNav').css('display', 'flex');
        $('#completedNav2').css('display', 'flex');

        //hide self content
        $('#completedOrders').css('display', 'none');
        $('#backToHome5').css('display', 'none');
        $('#backToHome6').css('display', 'none');

        //modal navigation
        if(action == 6)
        {
            $('#navModal').modal('toggle');
        }
    }
}

