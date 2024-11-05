
<div class="container-fluid text-center" id="ordersView">
                     


 <!-- orders javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="orders/includes/orders.js"></script>

</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal">
    <div class="modal-dialog" id="cmDialog">
        <div class="modal-content" id="cmContent">
            <div class="modal-body" id="cmBody">

                <h3 id="confirmMsg" class="text-light mt-3">Prepare this order?</h3>
            
                <input type="hidden" id="orderNoHolder">

                <div id="cmBtn">
                    <button 
                    class="btn btn-lg btn-primary" 
                    id="orderActionConfrim"
                    >Confirm
                    </button>
    
                    <button 
                    class="btn btn-lg btn-warning" 
                    data-bs-dismiss="modal"
                    >Cancel
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Message Modal -->
<div class="modal fade" id="msgModal">
    <div class="modal-dialog" id="cmDialog">
        <div class="modal-content" id="cmContent">
            <div class="modal-body" id="cmBody">

                <h3 id="mmMsg" class="text-light mt-3"></h3>
            

                <div id="cmBtn">
                    <button 
                    class="btn btn-lg btn-success" 
                    data-bs-dismiss="modal"
                    >OKAY
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>