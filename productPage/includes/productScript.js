
// Code for holding value of included or not in BUY 1 TAKE 1
$(document).ready(function() 
{
  //add checkbox code
  $('#b1t1Holder').val('----');
  $('#b1t1').change(function() 
  {

    if (!$(this).is(':checked')) 
    {
      $('#b1t1Holder').val('----');
    }
    else
    {
      $('#b1t1Holder').val('Buy 1 Take 1');
    }
  });

  //edit checkbox code
  $('#prodBtHolder').val('----');
  $('#editb1t1').change(function() 
  {
      if (!$(this).is(':checked')) 
      {
        $('#prodBtHolder').val('----');
      }
      else
      {
        $('#prodBtHolder').val('Buy 1 Take 1');
      }
  });

  //delete btn pop up message if no item selected
  $(document).on('click', '#delBtn', function()
  {
    var delID = $('#deleteID').val();

    if(delID == "")
    {
      $('#messageModalText').html("No Item selected.");
      $('#messageModal').modal('toggle');
    }
    else
    {
      $('#deleteModal').modal('toggle');
    }

  });

  // edit product btn code
  $(document).on('click', '#editBtn', function()
  {
    if($('#prodIdHolder').val() == "")
    {
      $('#messageModalText').html("No Item Selected");
      $('#messageModal').modal('toggle');
    }
    else
    {
      $('#editModal').modal('toggle');
    }

  });
});

function catChange()
{
  if($('#prodBtHolder').val() == "----" || $('#prodBtHolder').val() == "")
  {
    $('#editb1t1').prop('checked', false);
  }
  else
  {
    $('#editb1t1').prop('checked', true);
  }
}

// Displaying image/files right after selected
function readURL(input)  
{
  if (input.files && input.files[0]) 
  {
      var reader = new FileReader();

      reader.onload = function (e) {
      $('#imagePreview').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
  }
}    

function readEditURL(input)
{
  if(input.files && input.files[0])
  {
    var reader = new FileReader();

    reader.onload = function(e)
    {
      $('#prodImgEditView').attr('src', e.target.result);
    };
    
    reader.readAsDataURL(input.files[0]);
  }
}

//adding new product/flavors
function addNewProduct()
{
  $('#deleteID').val("");
  $("form").submit(function()
    {
        $.post($(this).atxtr("action"), $(this).serialize());
        return false;
    });
    
    if($('#productImage').val() == "" || $('#productName').val()=="" || $('#productCategory').val()=="" )
    {
      $('#addMessage').html('PLease Fill in the Blanks or Upload an Image').fadeIn(1000).fadeOut(2000);
    }
    else
    {
      var addform = $('#addForm')[0];
      formData = new FormData(addform); 

      $.ajax(
      {
        type: 'post',
        url:'productPage/addNewProduct.php',
        data: formData,
        contentType: false,
        processData: false,

        success: function(data)
        {
            $('#addMessage').html(data).fadeIn(2000).fadeOut(2000);
            $('#addForm').trigger('reset');
            $('#imagePreview').attr('src','productPage/uploads/default.png');
            productLoad();
            $('#prodIdHolder').val("");
        }
     })
  }
}

productLoad();

function productLoad()
{
  
    $.ajax(
      {
        url:'productPage/productLoad.php',
        method: 'post',
        success: function(data)
        {
          try {
            data = $.parseJSON(data);

            if(data.status == "success")
            {
            $('#productDetails').html(data.html);
            }
            else
            {
              $('#messageModalText').html("Unknown Error Occured");
            $('#messageModal').modal('toggle');
            }

          } catch (error) {
            $('#messageModalText').html("Error Occured" + data);
            $('#messageModal').modal('toggle');
          }
          
        }
      })
}

// code for highlighting the selected row and pass details to edit form
selectProd();
function selectProd()
{
  $(document).on('click', '#prodRow', function()
  {   
    var selectedID = $(this).attr('data-id');
    var img = $(this).attr('data-img');
    var name = $(this).attr('data-name');
    var cat = $(this).attr('data-cat');
    var bt = $(this).attr('data-bt');
    var stat = $(this).attr('data-stat');

    $('#deleteID').val(selectedID);
    $('#prodIdHolder').val(selectedID);
    $('#prodImgEditView').attr('src','productPage/uploads/'+img);
    $('#prodNameHolder').val(name);
    $('#prodCatHolder').val(cat);
    $('#prodBtHolder').val(bt);
    $('#prodStatHolder').val(stat);
  
    $('.prodRow').css('background-color','white');
    $(this).css('background-color','lightgreen');
    catChange();
  })
}

// code for editing product
function editProduct()
{
  $('#deleteID').val("");
  $('form').submit(function()
  {
    $.post($(this).attr('action'), $(this).serialize());
    return false;
  })
 
  let newName = $('#prodNameHolder').val();
  let newCat = $('#prodCatHolder').val();
  let newBT = $('#prodBtHolder').val();
  let newStat = $('#prodStatHolder').val();

  if(newName == "" || newCat == "" || newBT == "" || newStat == "")
  {
    $('#editMessage').html("Please fill in the blanks").fadeIn(1000).fadeOut(2000);
  }
  else
  {
    let editForm = $('#editForm')[0];
    let formData = new FormData(editForm);
    $.ajax(
      {
        url: 'productPage/editProduct.php',
        method: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data)
        {
          $('#editMessage').html(data).fadeIn(1000).fadeOut(2000);
          productLoad();
          $('#editForm').trigger('reset');
          $('#prodImgEditView').attr('src','productPage/uploads/default.png');
          $('#editModal').modal('toggle');
          $('.prodRow').css('background-color','white');
          $('#prodIdHolder').val("");
        } 
      })
  }
}


// CODE FOR DELETING ITEM IN PRODUCT
function deleteProduct()
{
 
  var delID = $('#deleteID').val();

    $.ajax(
      {
        url:'productPage/deleteProduct.php',
        method:'post',
        data: {delID:delID},
        success: function(data)
        {
          productLoad();
          $('#deleteModal').modal('toggle');
          $('#messageModalText').html(data);
          $('#messageModal').modal('toggle');
          $('#deleteID').val("");
          $('#prodIdHolder').val("");
        }
      }) 
}


//Code for adding product size and its price
function addSp()
{
  var size = $('#size').val();
  var price = $('#price').val();

  if(size == "" || price == "")
  {
    $('#messageModalText').html("Please Fill in the Blanks.");
    $('#messageModal').modal('toggle');
  }
  else
  {
    $.ajax(
      {
        url:'productPage/spAdd.php',
        method:'post',
        data: {size:size, price:price},
        success:function(data)
        {
          $('#messageModalText').html(data);
          $('#messageModal').modal('toggle');
          $('#spForm').trigger('reset');
          loadSp();
          $('#spIdHolder').val("");
        }
      })
  }
  
}

loadSp();
function loadSp()
{
  $.ajax(
    {
      url:'productPage/spLoad.php',
      method:'post',
      success:function(data)
      {
        try
        {
          data =$.parseJSON(data);

         if(data.status == 'success')
         {
            $('#spView').html(data.html);
         }
         else
         {
            $('#spView').html(data);
         }

        }
        catch
        {
          $('#spView').html(data);
        }
      }
    })
}

spSelect();
function spSelect()
{
  $(document).on('click', '#spRow', function()
  {
    var spID = $(this).attr('data-id');
    var spSize = $(this).attr('data-size');
    var spPrice = $(this).attr('data-price');

    $('#spIdHolder').val(spID);
    $('#sizeHolder').val(spSize);
    $('#priceHolder').val(spPrice);
    
    $('.spRow').css('background-color','white');
    $(this).css('background-color','lightgreen');
  });

};

$(document).on('click', '#spEdit', function()
{
  if($('#spIdHolder').val() == "")
  {
    $('#messageModalText').html("No Selected Size Price Details");
    $('#messageModal').modal('toggle');
  }
  else
  {
    $('#editSpModal').modal('toggle');
  }
});

// code fort editing Size Price Details
function editSp()
{
  var spIdHolder = $('#spIdHolder').val();
  var sizeHolder = $('#sizeHolder').val();
  var priceHolder = $('#priceHolder').val();

  if( sizeHolder == "" || priceHolder == "")
  {
    $('#messageModalText').html("Please Fill in the Blanks");
    $('#messageModal').modal('toggle');
  }
  $.ajax(
    {
      url: 'productPage/spEdit.php',
      method: 'post',
      data: {Id:spIdHolder, size:sizeHolder, price:priceHolder},
      success: function(data)
      {
        $('#spForm').trigger('reset');
        $('#spIdHolder').val("");
        $('#editSpModal').modal('toggle');

        $('#messageModalText').html(data);
        $('#messageModal').modal('toggle');
        loadSp();
      }
    })
}

// CODE FOR DELETE SIZE PRICE DETAILS
$(document).on('click', '#spDelete', function()
{ 
  if($('#spIdHolder').val() == "")
  {
    $('#messageModalText').html("No Selected Size Price Details");
    $('#messageModal').modal('toggle');
  }
  else
  {
    $('#deleteSpModal').modal('toggle');
  }

});

function deleteSp()
{
  var id = $('#spIdHolder').val();

  $.ajax(
    {
      url:'productPage/spDelete.php',
      method:'post',
      data: {id:id},
      success: function(data)
      {
        $('#deleteSpModal').modal('toggle');
        $('#messageModalText').html(data);
        $('#messageModal').modal('toggle');
        loadSp();
        $('#spIdHolder').val("");
        $('#sizeHolder').val("");
        $('#priceHolder').val("");
      }
    });
}

// CODE FOR ADD ONS

// add add ons details

function addNewAo()
{
  var addOnsForm = $('#addOnsForm')[0];
  var formData = new FormData(addOnsForm);

  if($('#aoName').val() == "" || $('#aoPrice').val() == "")
  {
    $('#messageModalText').html("Please Fill in the Blanks");
    $('#messageModal').modal('toggle');
  }
  else
  {
    $.ajax(
      {
        url:'productPage/aoAddNew.php',
        method:'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data)
        {
          $('#messageModalText').html(data);
          $('#messageModal').modal('toggle');
          $('#addOnsForm').trigger('reset');
          $('#addOnsIdHolder').val("");
          addOnsLoad();
        }
      });
  }
}

// Load Add Ons Details
addOnsLoad();
function addOnsLoad()
{
  $.ajax(
    {
      url:'productPage/aoLoad.php',
      method:'post',
      success: function(data)
      {
        data = $.parseJSON(data);
        if(data.status == 'success')
        {
          $('#addOnsView').html(data.html)
        }
        else
        {
          $('#addOnsView').html(data)
        }
      }
    })
}


// Add ons Row Selection
$(document).on('click','#aoRow', function()
{
  var id = $(this).attr('data-id');
  var name = $(this).attr('data-name');
  var price = $(this).attr('data-price');

  $('#addOnsIdHolder').val(id);
  $('#aoNameHolder').val(name);
  $('#aoPriceHolder').val(price);

  $('.aoRow').css('background-color', 'white');
  $(this).css('background-color', 'lightgreen');
});


//add ons edit btn
$(document).on('click', '#aoEdit', function()
{
  var id = $('#addOnsIdHolder').val();

  if(id == "")
  {
    $('#messageModalText').html("No Selected Add Ons Details.");
    $('#messageModal').modal('toggle');
  }
  else
  {
    $('#editAoModal').modal('toggle');
  }

});

// code for editing Add ons Details
function editAo()
{
  var id = $('#addOnsIdHolder').val();
  var name = $('#aoNameHolder').val();
  var price = $('#aoPriceHolder').val();

  $.ajax(
    {

      url:'productPage/aoEdit.php',
      method:'post',
      data:{id:id, name:name, price:price},
      success: function(data)
      {
        $('#editAoModal').modal('toggle');
        $('#messageModalText').html(data);
        $('#messageModal').modal('toggle');
        $('#addOnsIdHolder').val("");
        $('#editAddOnsForm').trigger('reset');
        addOnsLoad();
      }

    });
}

$(document).on('click','#aoDelete', function()
{
  var id = $('#addOnsIdHolder').val();
  if(id == "")
  { 
    $('#messageModalText').html("No Selected Add Ons Details.");
    $('#messageModal').modal('toggle');
  }
  else
  {
    $('#deleteAoModal').modal('toggle');
  }
});

// code for deleting add ons details
function deleteAo()
{
  var id = $('#addOnsIdHolder').val();

  $.ajax(
    {
      url:'productPage/aoDelete.php',
      method:'post',
      data:{id:id},
      success:function(data)
      {
        $('#deleteAoModal').modal('toggle');
        $('#messageModalText').html(data);
        $('#messageModal').modal('toggle');
        $('#addOnsIdHolder').val("");
        $('#editAddOnsForm').trigger('reset');
        addOnsLoad();
      }

    })
}