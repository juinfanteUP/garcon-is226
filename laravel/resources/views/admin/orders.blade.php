@extends('layout.admin')
@section('content')

<div class="w-100 overflow-hidden chat-bg main-page">
    <div class="container table-responsive py-5"> 
        <div class="container-fluid">
            <div class="row justify-content-center">

                <!-- Order list -->
                <div class="col-md-10">          
                    <div class="card mt-3">
                        <div class="card-header"></div>
                        <div class="card-body">
                                  
                            <div class="row">

                                <div class="col-md-6">
                                    <h5 class="card-title pt-1 text-muted">
                                        Order History List
                                    </h5>
                                </div>

                                <div class="col-md-6">
                                    <div class="search-wrap">
                                        <input id="search" type="text" class="form-control" placeholder="Search order" v-model="searchOrderItem"/>
                                        <i class="icon icon-search"></i>
                                    </div>                      
                                </div>

                                <div class="col-md-12">

                                    <div class="table-responsive mt-4">
                                        <table class="table table-nowrap align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Order Reference</th>
                                                    <th>Service Charge (5%)</th>
                                                    <th>Inclusive Tax (12%)</th>
                                                    <th>Subtotal Amount</th>
                                                    <th>Total Amount</th>
                                                    <th>Timestamp</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-show ="resultOrderList.length == 0">
                                                    <td class="text-center" colspan="7">
                                                        --- Result is empty ---
                                                    </td>
                                                </tr>
                                                <tr v-for="orderItem in resultOrderList">
                                                    <td>@{{ orderItem.reference_id }}</td>
                                                    <td>@{{ setPrecision(orderItem.subtotal * 0.05) }}</td>
                                                    <td>@{{ setPrecision(orderItem.subtotal * 0.12) }}</td>
                                                    <td>@{{ setPrecision(orderItem.subtotal * 0.88) }}</td>
                                                    <td>@{{ setPrecision(Number(orderItem.subtotal) + Number(orderItem.service_cost)) }}</td>
                                                    <td>@{{ orderItem.created_dtm }}</td>                            
                                                    <td class="text-center mx-3">
                                                        <button type="button" class="btn-form-func py-1" @click="showCustomerDetails(orderItem)">
                                                            <span class="btn-form-func-content text-center">View Customer</span>
                                                            <span class="icon">
                                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                            </span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- View customer -->
<a id="viewCustomerTrigger" href="#viewCustomerModal" class="modal-opener" hidden></a>
<div id="viewCustomerModal" class="modal-popup zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h4>View Custoemr Details</h4>
    </div>
    <div class="content pb-1">
    
        <div class="mx-5 my-3">
            <h6 class="">Order Details: </h6>
            <p class="m-0 mb-1 px-2">Reference: @{{ viewCustomer.reference_id }}</p>
            <p class="m-0 mb-1 px-2">Timestamp: @{{ viewCustomer.timestamp }}</p>
        </div>

        <div class="mx-5 my-3">
            <h6 class="">Customer details: </h6>
            <p class="m-0 mb-1 px-2">Name: @{{ viewCustomer.name }}</p>
            <p class="m-0 mb-1 px-2">Contact: @{{ viewCustomer.contact }}</p>
            <p class="m-0 mb-1 px-2">Email: @{{ viewCustomer.email }}</p>
            <p class="m-0 mb-1 px-2">Address: @{{ viewCustomer.address }}</p>
            <p class="m-0 mb-1 px-2">Remarks: @{{ viewCustomer.remarks }}</p>
        </div>
    </div>
    <div class="footer">
    </div>
</div>

@endsection