<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordering Page</title>

    <!-- LINKS --> 
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="orderingPage/css/style.css">

    <!-- orders - preparing - completed - css -->
    <link rel="stylesheet" href="orders/css/orders.css">
    <link rel="stylesheet" href="preparingOrders/css/preparingOrders.css">
    <link rel="stylesheet" href="completedOrders/css/completedOrders.css">
</head>
<body>

    <!-- Navigation Bar -->
    <header>
        <div class="container-fluid">
            <div class="navb-logo">
                    <img src="icons/logo.png" alt="Logo">
                    <h2 style="display: inline-flex; color: white;">SWEETEA BOBA</h2>
                    <!-- <b style="font-siz4: 30px;">Sweet Tea Boba</b> -->
            </div>

            <div class="navb-items">
                <div class="item"> 
                    <a onclick="showOrders(1);" id="ordersNav">Order(s)</a>
                    <a onclick="backToOrdering(1);" id="backToHome" ><i class="fa-sharp fa-solid fa-left-long"></i> Back</a>
                </div>

                <div class="item">
                    <a onclick="showOrders(3);" id="preparingNav">Preparing</a>
                    <a onclick="backToOrdering(3);" id="backToHome3" ><i class="fa-sharp fa-solid fa-left-long"></i> Back</a>
                </div>

                <div class="item">
                    <a onclick="showOrders(5);" id="completedNav">Completed</a>
                    <a onclick="backToOrdering(5);" id="backToHome5" ><i class="fa-sharp fa-solid fa-left-long"></i> Back</a>
                </div>
             
                <div class="item">
                    <a target="_self" href="product.php">Product</a>
                </div>

                <div class="item">
                    <a href="/about"><i class="fa-solid fa-user"></i></a>
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
                         <h2 style="display: inline-flex; color: white;">SWEETEA BOBA</h2>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="modal-line">
                            <i class="fa-regular fa-note-sticky fa-beat"></i>
                            <a  onclick="showOrders(2);" 
                                id="ordersNav2" 
                                class="text-light"
                                >Order(s)</a>                        
                            <a onclick="backToOrdering(2);" 
                            id="backToHome2"
                            class="text-light"
                            ><i class="fa-sharp fa-solid fa-left-long"></i> Back
                            </a>
                        </div>
                        
                        <div class="modal-line">
                            <i class="fas fa-spinner fa-spin"></i>
                            <a onclick="showOrders(4);" 
                                id="preparingNav2" 
                                class="text-light"
                                >Preparing Order(s)</a>                        
                            <a onclick="backToOrdering(4);" 
                                id="backToHome4"
                                class="text-light">
                                <i class="fa-sharp fa-solid fa-left-long"></i> Back
                            </a>
                        </div>
                       
                        <div class="modal-line">
                            <i class="fa-sharp fa-solid fa-clipboard-check fa-bounce"></i>
                            <a onclick="showOrders(6);" 
                                id="completedNav2" 
                                class="text-light"
                                >Completed Order(s)</a>                        
                            <a onclick="backToOrdering(6);" 
                                id="backToHome6"
                                class="text-light">
                                <i class="fa-sharp fa-solid fa-left-long"></i> Back
                            </a>
                        </div>

                        <div class="modal-line">
                            <i class="fas fa-store"></i>
                            <a href="product.php">Products</a>
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
    
            <!--||||||||||||||||||||||||  MAIN CONTENT ||||||||||||||||||||||-->

    <div class="container-fluid mt-3" >

        <div id="orders">
            <?php include 'orders.php';?>
        </div>

        <div id="preparingOrders">
            <?php include 'preparingOrders.php';?>
        </div>

        <div id="completedOrders">
            <?php include 'completedOrders.php';?>
        </div>

        <div class="row" id="orderingDisplay">
        
            <!--||||||||||||||||||||||||  CATEGORY ||||||||||||||||||||||-->
            <div class="col-lg-2 text-center mb-5" id="category">
       
                <div class="card mb-3 text-dark text-center " style="width: 80%;">

                    <div class="card-header bg-secondary text-light">
                        <h3 id="catLbl">Category</h3>
                    </div>

                    <div class="header-body" id="catHeaderbody">
                        <table class="table table-striped table-bordered table-hover" > 
                            <tbody id="categoryDisplay">
                             <!-- Code for category load from database -->
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer" id="categoryFooter" style="display: none;">
                         <button class="btn btn-success btn-lg" id="viewAll">View All</button>
                    </div>
                    
                </div>

                <div class="form-group" id="searchBox">

                    <p id="searchMsg"></p>
                    <input type="text" 
                            class="form-control" 
                            placeholder="Search here..." 
                            id="searchInput"
                            onkeypress="">
                    
                    <button class="btn btn-primary mt-2" 
                            style="display:inline-flex;"
                            id="search">
                            <i class="fa-solid fa-magnifying-glass"></i>&nbsp;Search
                    </button>

                </div>

                <input type="hidden" id="catHolder">
                <input type="hidden" id="orderNumber">
                
            </div>
            <!-- ==================================================================== -->


            <!--||||||||||||||||||||||||  PRODUCTS DISPLAY ||||||||||||||||||||||-->
            <div class="col-lg-7 mb-5">
                <h3 class="text-center p-2 bg-secondary text-light" 
                    id="milktealbl">
                    Milk Tea
                </h3>

                <div id="productsDisplay" >
                    <!-- Products displayed here -->
                </div>
              
            </div>
            <!-- ==================================================================== -->   

            <!--|||||||||||||||||||||||| Modal Pop up once product is clicked ||||||||||||||||||||||-->
            <div class="modal fade" id="orderingModal">
                <div class="modal-dialog" id="orderingModalDialog">
                    <div class="modal-content" id="orderingModalContent">

                        <div class="modal-header bg-light text-dark mt-2" 
                             id="orderingModalHeader">
                            <h3 class="modalHeaderText" style="font-weight: bolder;">Make Order(s)</h3>
                        </div>

                        <div class="modal-body" id="orderingModalBody">
                            <div style="text-align: center;" class="mb-3">
                                
                                <img class="border" 
                                     src="icons/logo.png" 
                                     alt="product image" 
                                     id="prodImage">
                                <br>
                                
                                <input type="text"
                                       id="b1t1"
                                       class="form-control-sm mb-2" 
                                       disabled>
                            </div>

                            <form method="post"
                                  enctype="multipart/form-data"
                                  id="orderingForm"
                                  class="form-group"
                                  >
                                <input type="hidden" id="prodID" class="md-3">
                                  
                                <label for="prodName">Product Name</label>
                                <input type="text"
                                        id="prodName"
                                        class="form-control-lg mb-2"
                                        style="font-weight: bolder;"
                                        readonly>

                            <!-- add ons row for selected flavor-->    
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <label for="AddOns" style="width: 100%;">Add Ons</label>
                                        <select id="AddOns" class="form-control" onchange="addOnsQntyChange('none');">
                                        <!-- Code for load addons here -->
                                        </select>
                                    </div>

                                    <div class="col-6">
                                        <label for="AoPrice" >Price</label>
                                        <br>
                                        <input type="text" id="AoPrice" class="form-control" readonly>
                                    </div> 
                                </div>

                                <div class="row mb-2">
                                    <div class="col-6">
                                        <label for="AoQnty">AddOns Qnty</label>
                                        <br>
                                        <input type="number" 
                                                id="AoQnty" 
                                                class="form-control" 
                                                value="0" 
                                                onclick="addOnsQntyClick('1');"
                                                onchange="addOnsQntyChange('1');"
                                                >
                                    </div>
                                    
                                    
                                    <div class="col-6">
                                        <label for="AoBtn" >Save AddOns</label>
                                        <br>
                                        <button type="button" 
                                                id="AoBtn" 
                                                class="btn btn-success btn-md"
                                                style="width: 100%;"
                                                onclick="addOnsNext('flavor1AddOns');">Save
                                        </button>
                                    </div>
                                </div>
                                  
                               <hr style="color: white; height:2px;"> 
                               <p id="msg1"></p>
                            
                                <!-- =================== select pair flavor ======================-->
                                <div class="pairSelection">
                                    <h5 class="text-light" style="font-weight: bolder;">Choose Pair:</h5>
                                    <select id="pair" class="form-control-lg" >
                                        <!-- code for load flavor choice here -->
                                    </select>

                                    <!-- add ons row for selected pair flavor-->
                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <label for="AddOns2" style="width: 100%;">Add Ons</label>
                                            <select id="AddOns2" class="form-control" onchange="addOnsQntyChange('none2');">
                                                <!-- Code for load addons here -->  
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <label for="AoPrice2" >Price</label>
                                            <br>
                                            <input type="text" id="AoPrice2" class="form-control" readonly>
                                        </div>    
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <label for="AoQnty2">AddOns Qnty</label> 
                                            <br>
                                            <input type="number" 
                                                    id="AoQnty2" 
                                                    class="form-control" 
                                                    value="0" 
                                                    onclick="addOnsQntyClick('2');"
                                                    onchange="addOnsQntyChange('2');"
                                                    >
                                        </div>
                                
                                            
                                        <div class="col-6">
                                            <label for="AoBtn2" >Save AddOns</label>
                                            <br>
                                            <button type="button" 
                                                    id="AoBtn2" 
                                                    class="btn btn-success btn-md"
                                                    style="width: 100%;"
                                                    onclick="addOnsNext('flavor2AddOns');">Save
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <hr style="color: white; height:2px;">
                                <p id="msg2"></p>

                                <!-- ============================= -->
                                <div class="row">
                                    <div class="col-7">
                                        <label for="size">Size</label>
                                        <select 
                                                name="size" 
                                                id="size" 
                                                class="form-select form-select-lg"
                                                >
                                        </select>
                                    </div>

                                    <div class="col-5">
                                        <label for="price">Price</label>
                                        <input class="form-control form-control-lg" 
                                                type="text" 
                                                id="price"
                                                readonly>
                                    </div>
                                </div>

                                <div class="row">
                                        <p class="text-success" id="qntyMessage"></p>   
                                    <div class="col-7">
                                        <label for="qnty">Quantity</label>
                                        <input type="number"
                                                id="qnty"
                                                class="form-control-lg" 
                                                value="1">
                                    </div>

                                    <div class="col-4" id="qntybtn">
                                        <button type="button" 
                                        class="btn btn-lg btn-success"
                                        id="plus"> + 
                                        </button> &nbsp;
                                        <button type="button" 
                                                class="btn btn-lg btn-warning"
                                                id="minus"> - 
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-5 btnCont">
                                    <button type="button"
                                    class="btn btn-lg btn-success" 
                                    style="width:90%;"
                                    onclick="orderDone();">DONE</button>
                                </div>
                                
                                <div class="row mt-3 mb-5 btnCont">
                                    <button type="button" id="cancel" class="btn btn-lg btn-danger" style="width:90%;" data-bs-dismiss="modal">CANCEL</button>
                                </div>
                                 
                            </form>
                        </div>

                    </div>

                </div>

            </div>

        <!--||||||||||||||||||||||||  ORDERS SUMMARY ||||||||||||||||||||||-->
        <div class="col-lg-3">
            <h3 class="text-center p-2 bg-secondary text-light">Order(s)</h3>
 
            <div class="row mb-1">

            <div class="col-6 text-center">
                <label for="orderTotal">Total</label>
                <input type="text" 
                        id="orderTotal" 
                        class="form-control-lg"
                        value="0"
                        readonly
                        >
            </div>

            <div class="col-6 text-center">
                <button type="button" 
                id="placeOrder" 
                class="btn btn-lg btn-success mt-4" 
                >Place Order</button>
            </div>
                
                
            </div>

            <div class="ordersSummary">
                <table class="table table-striped table-bordered table-hover" > 
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 30%;">NAME</th>   
                            <th style="width: 20%;">PRICE</th>
                            <th style="width: 10%;">QTY</th>
                            <th style="width: 20%;">ADD ONS</th>
                            <th style="width: 20%;">SUB TOTAL</th>    
                        </tr>
                    </thead>

                    <tbody id="ordersSummary">   
                        <!-- code here to display orders -->
                    </tbody>
                </table>
            </div>
            <button 
            id="cancelCurrentOrder" 
            class="btn btn-danger btn-lg mb-2"
            data-bs-toggle="modal"
            data-bs-target="#cancelOrderModal"
            >Cancel Order
        </button>
        </div>

        <!-- place order modal -->
        <div class="modal fade text-center" id="placeOrderModal">
            <div class="modal-dialog" id="messageModalDialog">
                <div class="modal-content text-center" id="messageModalContent">
                    
                    <div class="modal-body text-center" id="messageModalBody" style="display: block;">
                        <h3 class="text-light"> Enter Payment</h3>  <br>
                        
                        <input type="number" class="form-control-lg" id="amountPaid" value="0">
                    </div>

                    <div class="modal-footer" id="messageModalFooter">
                        <button type="button" 
                        class="btn btn-lg btn-success" 
                        id="placeNow"
                        onclick="placeOrder();"
                        data-bs-dismiss="modal">PLaceOrder</button>
                         
                    </div>
                </div>
            </div>
        </div>

        <!-- Message Modal -->
        <div class="modal fade" id="messageModal">
            <div class="modal-dialog" id="messageModalDialog">
                <div class="modal-content text-center" id="messageModalContent">
                    
                    <div class="modal-body" id="messageModalBody">
                        <p id="messageModalText" class="text-light"></p>
                    </div>

                    <div class="modal-footer" id="messageModalFooter">
                        <button type="button" class="btn btn-lg btn-success" data-bs-dismiss="modal">Okay</button>
                    </div>
                </div>
            </div>
        </div>
       
        <!-- Cancel Curent Order Modal -->
        <div class="modal fade" id="cancelOrderModal">
            <div class="modal-dialog" id="messageModalDialog">
                <div class="modal-content text-center" id="messageModalContent">
                    
                    <div class="modal-body" id="messageModalBody">
                        <h3 class="text-danger p-3" style="background-color: aliceblue;">Cancel this current order(s)?</h3>
                    </div>

                    <div class="modal-footer" id="messageModalFooter">
                        
                        <button 
                        type="button" 
                        class="btn btn-lg btn-danger" 
                        id="CCOrder"
                        >
                        Confirm
                        </button>

                        <button 
                        type="button" 
                        class="btn btn-lg btn-success" 
                        data-bs-dismiss="modal"
                        >
                        Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>


      </div>   

    </div>
      

    <!-- JAVASCRIPT -->
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="orderingPage/includes/orderingPage.js"></script>

</body>
</html>