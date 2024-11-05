<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>

    <!-- LINKS --> 
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="productPage/css/product.css">
</head>
<body>

    <!-- Navigation Bar -->
    <header>
        <div class="container-fluid"> 
            <div class="navb-logo">
                    <img src="icons/logo.png" alt="Logo">
                    <h2 style="display: inline-flex; color: white;">SWEET TEA BOBA</h2>
                    <!-- <b style="font-siz4: 30px;">Sweet Tea Boba</b> -->
            </div>

            <div class="navb-items">

                <div class="item"> 
                    <a href="orderingPage.php">Home</a>
                </div>

                <div class="item">
                    <a href=""><i class="fa-solid fa-user"></i></a>
                </div>

            </div>

            <!-- Button trigger modal -->
            <div class="mobile-toggler d-lg-none"> 
                <a href="#" data-bs-toggle="modal" data-bs-target="#navModal">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="navModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                         <img src="icons/logo.png" alt="Logo" class="modal-title fs-5">
                         <h2 style="display: inline-flex; color: white;">SWEET TEA BOBA</h2>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="modal-line">
                            <i class="fa-solid fa-shop"></i></i><a href="orderingPage.php">Home</a>
                        </div>
                       
                        <div class="modal-line">
                            <i class="fa-solid fa-user"></i><a href="/about">Account</a>
                        </div>          
                        
                    </div>
                </div>
            </div>
            </div>

        </div>
    </header> 

    <!-- MAIN CONTENT -->

    <!-- Product details and actions -->
    <div class="row m-2">
        <div class="col-lg-9 text-center mt-3 p-2">
            <h4 class="text-center bg-success text-light p-3">Product Details</h4>
            
            <div id="productDetails">
            </div>
        </div>

        <div class="col-lg-3 mt-3 text-center p-2">
            <h4 class="text-center bg-success text-light p-1">Actions</h4>

            <button class="btn btn-primary" style="width: 33%;" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-plus"></i>&nbsp;ADD NEW</button>

            <button 
            class="btn btn-warning" 
            style="width: 24%;"
            id="editBtn">
            <i class="fa-solid fa-pen-to-square"></i>&nbsp;EDIT</button>

            <button class="btn btn-danger" 
                    style="width: 33%;"
                    id="delBtn">
                    <i class="fa-sharp fa-solid fa-trash md-3">
                    </i>
                    &nbsp; DELETE
            </button>
            
            <input type="hidden" name="deleteID" id="deleteID">
        </div>
    </div>   

    <!---------ADD MODAL ----------->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog" id="addModalDialog">
            <div class="modal-content" id="addModalContent">

                <div class="modal-header bg-light mt-2" id="addModalHeader">
                    <h3 class="text-dark mt-1 mb-2">Add New Flavor</h3>
                </div>

                <div class="modal-body">
                
                    <form id="addForm"
                          enctype="multipart/form-data"
                          method="post"
                          >

                          <div class="form-group text-center text-light mb-5">
                                <img src="productPage/uploads/default.png"
                                    alt="default"
                                    style="width:18rem; height:18rem;" 
                                    class="mb-2 border"
                                    id="imagePreview">
                                    <br>
                                <input type="file" 
                                        name="productImage" 
                                        id="productImage"
                                        class="custom-file-input"
                                        accept="image/jpg, image/jpeg, image/png"
                                        onchange="readURL(this);">
                          </div>

                            <p class="text-center text-light" id="addMessage"></p>
                            
                          <div class="form-group text-center mb-2">
                                <input type="text"
                                        class="form-control" 
                                        placeholder="Product/Flavor Name"
                                        name="productName"
                                        id="productName">
                          </div>

                          <div class="form-group text-center mb-3">
                                <input type="text"
                                        class="form-control"
                                        placeholder="Category"
                                        name="productCategory"
                                        id="productCategory">
                          </div>

                          <div class="text-center mb-3">
                                <button type="submit" 
                                        name="addSubmit" 
                                        id="addSubmit"
                                        onclick="addNewProduct();"
                                        class="btn btn-lg btn-success">ADD NOW</button>

                                <button type="button" class="btn btn-lg btn-warning" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                          </div>

                          <div style="display: flex; align-items:center;">

                            <input type="checkbox" name="b1t1" id="b1t1" class="checkbox m-2">
                            <label for="b1t1" class="text-light" style="font-size: 16px;">Include in Buy 1 Take 1?</label>
                            <input type="hidden" name="b1t1Holder" id="b1t1Holder">
                          </div>
                    </form>
                    
                </div> 
            </div>
        </div>
    </div>
    <!-- ========================================================================= -->

    <!-- EDIT MODAL -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog" id="addModalDialog">
            <div class="modal-content" id="addModalContent">

                <div class="modal-header bg-light mt-2 text-center" id="addModalHeader">
                    <h3 class="text-dark mt-1 mb-2 text-center">Edit Product Details</h3>
                </div>

                <div class="modal-body">
                
                    <form id="editForm"
                          enctype="multipart/form-data"
                          method="post"
                          >

                          <div class="form-group text-center text-light mb-5">
                                
                                <img src="productPage/uploads/default.png"
                                    alt="default"
                                    style="width:13rem; height:13rem;" 
                                    class="mb-2 border"
                                    id="prodImgEditView">
                                    <br>

                                <input type="file" 
                                        name="newProdImg" 
                                        id="newProdImg"
                                        class="custom-file-input"
                                        accept="image/jpg, image/jpeg, image/png"
                                        onchange="readEditURL(this);">
                          </div>

                            <p class="text-center text-light" id="editMessage"></p>
                            
                          <div class="form-group text-center mb-2">
                                
                            <!-- Product ID Holder for editing -->
                                <input type="hidden" 
                                        id="prodIdHolder"
                                        name="prodIdHolder" 
                                        class="prodIdHolder">

                            <!-- Product Name holder for editing -->
                                <input type="text"
                                        class="form-control-lg mb-2" 
                                        placeholder="Product/Flavor Name"
                                        name="prodNameHolder"
                                        id="prodNameHolder">

                            <!-- Product Category Holder for editing -->
                                <input type="text"
                                        class="form-control-lg"
                                        placeholder="Category"
                                        name="prodCatHolder"
                                        id="prodCatHolder">
                          </div>

                          <div class="form-group text-center mb-3">

                            <!-- Buy 1 take 1 Holder for editing -->
                                <input type="text"
                                        class="form-control-lg mb-2"
                                              placeholder="Buy 1 Take 1 or Not"
                                        name="prodBtHolder"
                                        id="prodBtHolder"
                                        onchange="catChange();"
                                        readonly>
                            
                            <!-- Status Holder For editing -->
                                <input type="text"
                                        class="form-control-lg mb-2"
                                        placeholder="Status"
                                        name="prodStatHolder"
                                        id="prodStatHolder">
                          </div>

                          <div style="display: flex; align-items:center;" class="mb-3">

                                <input type="checkbox" name="editb1t1" id="editb1t1" class="checkbox m-2">
                                <label for="editb1t1" class="text-light" style="font-size: 16px;">Include in Buy 1 Take 1?</label>

                          </div>

                          <div class="text-center mb-3">

                                <button type="submit"
                                        onclick="editProduct();"
                                        class="btn btn-lg btn-success">Update Now</button>

                                <button type="button" 
                                        class="btn btn-lg btn-warning" 
                                        data-bs-dismiss="modal" 
                                        aria-label="Close">Cancel</button>
                          </div>

                          
                    </form>
                    
                </div> 
            </div>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog text-center " id="delModalDialog">
            <div class="modal-content" id="delModalContent">

                <div class="modal-header bg-light mt-2" id="delModalHeader">
                    <h3 class="mt-1 mb-2 text-danger">ARE YOU SURE YOU WANT TO DELETE THIS PRODUCT?</h3>
                </div>

                <div class="modal-body" id="delModalbody">
                
                    <button type="button" 
                            onclick="deleteProduct();"
                            class="btn btn-lg btn-danger">DELETE</button>
                    <button type="button" 
                            data-bs-dismiss="modal"
                            class="btn btn-lg btn-secondary">CANCEL</button>
                </div> 

            </div>
        </div>
    </div>

    <!-- ================================ -->

     <!-- Price and Add ons -->
    <div class="row mt-5 m-2 mb-5">

        <div class="col-12">

            <!-- Price details and actions -->
            <div class="row">
                <div class="col-lg-4 text-center mt-2 p-2">
                    <h4 class="text-center bg-info text-dark p-3">Size Price Details</h4>
                    
                    <div >
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="bg-secondary text-light">
                            <tr>
                                <th>SIZE</th>
                                <th>PRICE</th>
                            </tr>
                            </thead>

                            <tbody id="spView">
                                
                            </tbody>
                        </table>
                    </div>
                    
                </div>

                <div class="col-lg-3 mt-2 text-center p-2">
                    <h4 class="text-center bg-info text-dark p-1">Actions</h4>

                    <button class="btn btn-primary" 
                            style="width: 33%;"
                            data-bs-toggle="modal"
                            data-bs-target="#spModal"
                            >
                                <i class="fa-solid fa-plus"></i>
                            &nbsp;ADD NEW
                    </button>

                    <button class="btn btn-warning" 
                            style="width: 24%;"
                            id="spEdit">
                        <i class="fa-solid fa-pen-to-square"></i>&nbsp;EDIT
                    </button>

                    <button class="btn btn-danger" 
                    style="width: 33%;"
                    id="spDelete">
                    <i class="fa-sharp fa-solid fa-trash md-3"></i>
                    &nbsp; DELETE</button>

                    <input type="hidden" id="spIdHolder">
                </div>
            </div>

        <!-- ADD SIZE PRICE MODAL-->
            <div class="modal fade" id="spModal">
              <div class="modal-dialog text-center" id="spModalDialog">

                <div class="modal-content text-center" id="spModalContent">

                    <div class="modal-header bg-light mt-2" id="spModalHeader">
                        <h3 class="text-dark text-center">Add Sizes and Prices</h3>
                    </div>

                    <div class="modal-body" id="spModalBody">
                        <form method="post"
                              enctype="multipart/form-data"
                              id="spForm"
                              class="form-group">
                        
                        <div class="form-group mt-2 mb-3">
                            <h4 class="spLbl">Enter Size</h4>
                            <input type="text" id="size" class="form-control-lg">
                        </div>
                        
                        <div class="form-group mt-1 mb-3"> 
                            <h4 class="spLbl">Enter Price</h4>
                            <input type="number" id="price" class="form-control-lg">
                        </div>
                        
                        </form>

                        <div class="form-group mt-2"> 
                            <button 
                                type="button" 
                                id="addSp" 
                                class="btn btn-lg btn-success"
                                onclick="addSp();"
                                >
                                Add Now
                            </button>
                            <button 
                                type="button"
                                class="btn btn-lg btn-warning"
                                data-bs-dismiss="modal"
                                >
                                Cancel
                            </button>
                        </div>
                        
                    </div>

                </div>    
                
               </div>
            </div>

            <!-- edit size price modal -->

            <div class="modal fade" id="editSpModal">
                <div class="modal-dialog text-center" id="spModalDialog">
                    <div class="modal-content" id="spModalContent">

                        <div class="modal-header bg-light mt-2" id="spModalHeader">
                            <h3 class="text-dark text-center">Edit Sizes and Prices</h3>
                        </div>

                        <div class="modal-body" id="spModalBody">

                        <form method="post"
                              enctype="multipart/form-data"
                              id="spForm"
                              class="form-group">
                        
                            <div class="form-group mt-2 mb-3">
                                <h4 class="spLbl">Enter Size</h4>
                                <input type="text" 
                                        id="sizeHolder" 
                                        class="form-control-lg" 
                                        style="text-align: center;">
                            </div>
                        
                            <div class="form-group mt-1 mb-3"> 
                                <h4 class="spLbl">Enter Price</h4>
                                <input type="number" 
                                        id="priceHolder" 
                                        class="form-control-lg" 
                                        style="text-align: center;">
                            </div>
                        
                        </form>

                        <div class="form-group mt-2"> 
                            <button 
                                type="button" 
                                id="editSp" 
                                class="btn btn-lg btn-success"
                                onclick="editSp();"
                                >
                                Edit Now
                            </button>
                            <button 
                                type="button"
                                class="btn btn-lg btn-warning"
                                data-bs-dismiss="modal"
                                >
                                Cancel
                            </button>
                        </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Size Price delete Modal -->
            <div class="modal fade" id="deleteSpModal">
                <div class="modal-dialog text-center" id="spDelModalDialog">
                    <div class="modal-content" id="spDelModalContent">

                        <div class="modal-header bg-light mt-5" id="spModalHeader">
                            <h3 class="text-danger text-center">Are you sure you want to delete this details?</h3>
                        </div>

                        <div class="modal-body" id="spModalBody">

                            <div class="mt-5"> 
                                <button 
                                    type="button" 
                                    id="editSp" 
                                    class="btn btn-lg btn-danger"
                                    onclick="deleteSp();"
                                    >
                                    Delete Now
                                </button>
                                <button 
                                    type="button"
                                    class="btn btn-lg btn-secondary"
                                    data-bs-dismiss="modal"
                                    >
                                    Cancel
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Add Ons details and actions -->
            <div class="row mt-5">
                <div class="col-lg-4 text-center mt-2 p-2">
                    <h4 class="text-center bg-dark text-light p-3">Add Ons Details</h4>
                    <table class="table table-striped table-bordered table-hover">
                       <thead class="bg-secondary text-light">
                            <tr>
                                <th>NAME</th>
                                <th>PRICE</th>
                            </tr>
                       </thead>

                       <tbody id="addOnsView">

                       </tbody>
                        
                    </table>
                </div>

                <div class="col-lg-3 mt-2 text-center p-2">

                    <h4 class="text-center bg-dark text-light p-1">Actions</h4>

                    <button class="btn btn-primary" 
                            style="width: 33%;"
                            data-bs-toggle="modal"
                            data-bs-target="#addAoModal">
                        <i class="fa-solid fa-plus"></i>
                    &nbsp;ADD NEW</button>

                    <button class="btn btn-warning" 
                    style="width: 24%;"
                    id="aoEdit"
                    ><i class="fa-solid fa-pen-to-square"></i>&nbsp;EDIT</button>

                    <button class="btn btn-danger" 
                    style="width: 33%;"
                    id="aoDelete"><i class="fa-sharp fa-solid fa-trash md-3"></i>&nbsp; DELETE</button>

                    <input type="hidden" id="addOnsIdHolder">
                </div>
            </div>
        </div>
    </div>   

       
    <!-- add ons add Modal -->
    <div class="modal fade" id="addAoModal">
        <div class="modal-dialog text-center" id="spModalDialog">
            <div class="modal-content" id="spModalContent">

                <div class="modal-header bg-light mt-2" id="spModalHeader">
                    <h3 class="text-dark text-center">Add New Add Ons Details</h3>
                </div>

                <div class="modal-body" id="spModalBody">

                    <form method="post"
                        enctype="multipart/form-data"
                        id="addOnsForm"
                        class="form-group">
                    
                        <div class="form-group mt-2 mb-3">
                            <h4 class="spLbl">Enter Add ons name</h4>

                            <input type="text" 
                                    id="aoName" 
                                    name="aoName" 
                                    class="form-control-lg">
                        </div>
                        
                        <div class="form-group mt-1 mb-3"> 
                            <h4 class="spLbl">Enter Price</h4>

                            <input type="number" 
                                    id="aoPrice" 
                                    name="aoPrice" 
                                    class="form-control-lg">
                        </div>
                    
                    </form>

                    <div class="mt-5"> 
                        <button 
                            type="button"
                            class="btn btn-lg btn-success"
                            onclick="addNewAo();"
                            >
                            Add Now
                        </button>
                        <button 
                            type="button"
                            class="btn btn-lg btn-warning"
                            data-bs-dismiss="modal"
                            >
                            Cancel
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit ons add Modal -->
    <div class="modal fade" id="editAoModal">
                <div class="modal-dialog text-center" id="spModalDialog">
                    <div class="modal-content" id="spModalContent">

                        <div class="modal-header bg-light mt-2" id="spModalHeader">
                            <h3 class="text-dark text-center">Edit Add Ons Details</h3>
                        </div>

                        <div class="modal-body" id="spModalBody">

                            <form method="post"
                                enctype="multipart/form-data"
                                id="editAddOnsForm"
                                class="form-group">
                            
                                <div class="form-group mt-2 mb-3">
                                    <h4 class="spLbl">Name</h4>
                                    <input type="text" 
                                            id="aoNameHolder" 
                                            name="aoNameHolder"
                                            class="form-control-lg">
                                </div>
                                
                                <div class="form-group mt-1 mb-3"> 
                                    <h4 class="spLbl">Price</h4>
                                    <input type="number"
                                            id="aoPriceHolder" 
                                            name="aoPriceHolder"
                                            class="form-control-lg">
                                </div>
                            
                            </form>

                            <div class="mt-5"> 
                                <button 
                                    type="button"
                                    class="btn btn-lg btn-success"
                                    onclick="editAo();"
                                    >
                                    Update Now
                                </button>
                                <button 
                                    type="button"
                                    class="btn btn-lg btn-warning"
                                    data-bs-dismiss="modal"
                                    >
                                    Cancel
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- add ons delete Modal -->
            <div class="modal fade" id="deleteAoModal">
                <div class="modal-dialog text-center" id="spDelModalDialog">
                    <div class="modal-content" id="spDelModalContent">

                        <div class="modal-header bg-light mt-5" id="spModalHeader">
                            <h3 class="text-danger text-center">Are you sure you want to delete this details?</h3>
                        </div>

                        <div class="modal-body" id="spModalBody">

                            <div class="mt-5"> 
                                <button 
                                    type="button" 
                                    id="editSp" 
                                    class="btn btn-lg btn-danger"
                                    onclick="deleteAo();"
                                    >
                                    Delete Now
                                </button>
                                <button 
                                    type="button"
                                    class="btn btn-lg btn-secondary"
                                    data-bs-dismiss="modal"
                                    >
                                    Cancel
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

    <!-- MESSAGE MODAL -->
    <div class="modal fade" id="messageModal">
        <div class="modal-dialog text-center " 
             id="messageModalDialog">

            <div class="modal-content" id="messageModalContent">

                <div class="modal-body" id="messageModalBody">

                    <h3 class="text-light" 
                    id="messageModalText">
                    </h3>
                    
                </div>

                <div class="modal-footer" id="msgModalFooter">
                    <button class="btn btn-lg btn-success"
                    data-bs-dismiss="modal">OKAY</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Footer -->




    <!-- JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="productPage/includes/productScript.js"></script>
        

</body>
</html>