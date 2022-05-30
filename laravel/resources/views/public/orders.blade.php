@extends('layout.public')
@section('content')


<div class="sub-header">
    <div class="container">
        <h1>Your order summary</h1>
    </div>
</div>


<div class="order">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" id="mainContent">
               
                <!-- Filter -->
                <div class="row filter-box filters">
                    <div class="filter-box-header">
                        <h3>List of orders</h3>
                    </div>
                    
                   
                    <div class="table-responsive mt-4">
                        <table class="table table-nowrap align-middle text-center">
                            <thead>
                                <tr>
                                    <th colspan="2">Menu</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-show ="orderList.length == 0">
                                    <td class="text-center" colspan="5">
                                        --- Your order list is empty. Please place and order in the menu page ---
                                    </td>
                                </tr>
                                <tr v-for="orderItem in orderList">
                                    <td>
                                        <img :src="orderItem.picture" alt="img" width="100">
                                    </td>
                                    <td>@{{ orderItem.name }}</td>
                                    <td>₱ @{{ orderItem.price }}</td>
                                    <td>@{{ orderItem.quantity }}</td>
                                    <td>₱ @{{  orderItem.price * orderItem.quantity }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Cart Summary -->
            <div class="col-lg-4" id="sidebar">
                <div id="orderContainer" class="theiaStickySidebar">

                    @include('components.order-summary')

                </div>
            </div>
        </div>
    </div>
</div>




<a id="customerInputTrigger" href="#customerInput" class="modal-opener" hidden></a>
<div id="customerInput" class="modal-popup zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Billout</h3>
    </div>
    <div class="content pb-1">
     
        <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                    <label>Total Cost <small class="text-muted">(₱)</small></label>
                    <input class="form-control" v-model="order.total" type="text" value="0" disabled />
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <label>
                        Enter amount you will pay <small class="text-muted">(₱)</small>
                        <small class="text-danger" v-show="order.amount_paid <= order.total ">(required)</small>
                    </label>
                    <input class="form-control" v-model="order.amount_paid" type="number" value="0" placeholder="Enter amount to pay" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Your change <small class="text-muted">(₱)</small></label>
                    <input class="form-control" type="text" v-model="computerChange" disabled />
                </div>
            </div>

            
            <div class="col-md-12">
                <hr>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label>Name <small class="text-danger" v-show="customer.name == ''">(required)</small></label>
                    <input class="form-control" v-model="customer.name" type="text" placeholder="Enter your name" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Contact Number <small>(optional)</small></label>
                    <input class="form-control" v-model="customer.contact" type="text" placeholder="Enter your contact number" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Email <small>(optional)</small></label>
                    <input class="form-control" v-model="customer.email" type="text"  placeholder="Enter your email" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Address <small>(optional)</small></label>
                    <input class="form-control"  v-model="customer.address" type="text" placeholder="Enter your address" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Feedback <small>(optional)</small></label>
                    <textarea rows="3" class="form-control"  v-model="order.customer_remarks" name="description" type="text" placeholder="Enter your feedback"></textarea>
                </div>
            </div>


            <div class="col-md-12 my-3">          
                <button type="button" class="btn-form-func py-2" @click="billout()">
                    <span class="btn-form-func-content text-center">Confirm Billout</span>
                    <span class="icon">
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </span>
                </button>
            </div>
        </div>

    </div>
    <div class="footer">
    </div>
</div>

@endsection
