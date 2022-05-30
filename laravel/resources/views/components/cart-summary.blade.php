<form method="POST" id="orderForm" name="orderForm" onsubmit="return confirmGuestOrder(event);">

    <!-- Step 1: Order Summary -->
    <div id="#orderSummaryStep" class="step">
        <div class="order-header">
            <h3>Cart Summary</h3>
        </div>
    
        <div class="order-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="order-list">
                        <ul id="itemList">
                            
                            <li class="my-2" v-for="(cartItem, index) in cartList">
                                <div class="order-list-img">
                                    <img :src="cartItem.picture" alt="">
                                </div>
                                <div class="order-list-details">
                                  <h4>
                                        @{{ cartItem.name }}
                                  </h4>
                                  <div class="qty-buttons">
                                    <input type="button" value="+" class="qtyplus" name="plus" @click="updateQuantity(cartItem, index, true)">
                                    <input type="text" name="qty" v-model="cartItem.quantity" value="1" max="99" min="1" class="qty form-control">
                                    <input type="button" value="-" class="qtyminus" name="minus" @click="updateQuantity(cartItem, index, false)">
                                  </div>
                                  <div class="order-list-price">₱ @{{ setPrecision(cartItem.price * cartItem.quantity) }}</div>
                                  <div class="order-list-delete">
                                    <a href="javascript:;" @click="removeToCart(index)" >
                                      <i class="icon icon-trash"></i>
                                    </a>
                                  </div>
                                </div>
                            </li>

                            <li class="my-2" v-show="cartList.length == 0">
                                <div class="order-list-img">
                                    <img src="assets/img/emptycart.jpg" alt="Your cart is empty" />
                                </div>
                                <div class="order-list-details">
                                    <h4>Your cart is empty
                                        <br />
                                        <small>Start adding items</small>
                                    </h4>
                                </div>
                            </li>
    
                        </ul>
                    </div>
                </div>
            </div>
    
    
            <div class="row total-container">
                <div class="col-md-12 p-0">
                    <span class="totalTitle">
                        Total
                    </span>
                    <span class="totalValue float-right">
                        ₱ @{{ setPrecision(order.cartSubtotal) }}
                    </span>
                </div>
            </div>
    
            <!-- Submit button -->
            <div class="row" v-show="cartList.length > 0">
                <div class="col-md-12">
                    <button type="button" class="btn-form-func py-2 mt-2" @click="placeOrder()">
                        <span class="btn-form-func-content">Place Order</span>
                        <span class="icon"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </div>


</form>

