@extends('layout.admin')
@section('content')


<div class="w-100 overflow-hidden chat-bg main-page">
    <div class="container table-responsive py-5"> 
        <div class="container-fluid">
            <div class="row justify-content-center">

                <!-- Customer list -->
                <div class="col-md-10">          
                    <div class="card mt-3">
                        <div class="card-header"></div>
                        <div class="card-body">
                                  
                            <div class="row">

                                <div class="col-md-6">
                                    <h5 class="card-title pt-1 text-muted">
                                        Customer History List
                                    </h5>
                                </div>

                                <div class="col-md-6">                                                  
                                    <div class="search-wrap">
                                        <input id="search" type="text" class="form-control" placeholder="Search customer" v-model="searchCustomerItem"/>
                                        <i class="icon icon-search"></i>
                                    </div>      
                                </div>

                                <div class="col-md-12">

                                    <div class="table-responsive mt-4">
                                        <table class="table table-nowrap align-middle">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Contact</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Timestamp</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-show ="resultCustomerList.length == 0">
                                                    <td class="text-center" colspan="5">
                                                        --- Result is empty ---
                                                    </td>
                                                </tr>
                                                <tr v-for="customer in resultCustomerList">
                                                    <td>@{{ customer.name }}</td>
                                                    <td>@{{ customer.contact }}</td>
                                                    <td>@{{ customer.email }}</td>
                                                    <td>@{{ customer.address }}</td>
                                                    <td>@{{ customer.created_dtm }}</td>                            
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



@endsection