<form method="POST" id="orderForm" name="orderForm" onsubmit="return confirmGuestOrder(event);">

    <div id="#orderSummaryStep" class="step">
        <div class="order-header">
            <h3>Order Summary</h3>
        </div>
    
        <div class="order-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="order-list">
                        <ul id="itemList">
                            
                            <li id="cartItem16">
                                <div class="order-list-details">
                                  <p class="m-0">
                                        Inclusive tax (12%)
                                  </p>
                                  <div class="order-list-price">₱ @{{ setPrecision(order.subtotal * 0.12) }}</div>
                                </div>
                            </li>

                            <li id="cartItem16">
                                <div class="order-list-details">
                                  <p class="m-0">
                                        Service  (5%)
                                  </p>
                                  <div class="order-list-price">₱ @{{ setPrecision(order.subtotal * 0.05) }}</div>
                                </div>
                            </li>

                            <li id="cartItem16">
                                <div class="order-list-details">
                                  <p class="m-0">
                                        Subtotal total
                                  </p>
                                  <div class="order-list-price">₱ @{{ setPrecision(order.subtotal * 0.88) }}</div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
    
    
            <div class="row total-container mt-3">
                <div class="col-md-12 p-0">
                    <span class="totalTitle">
                        Total
                    </span>
                    <span class="totalValue float-right">
                        ₱ @{{ setPrecision(order.total) }}
                    </span>
                </div>
            </div>

    
            <!-- Submit button -->
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn-form-func py-2 mt-2" @click="handleBillout()">
                        <span class="btn-form-func-content">Bill out</span>
                        <span class="icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </div>


</form>

