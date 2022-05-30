@extends('layout.public')
@section('content')


<div class="sub-header">
    <div class="container">
        <h1>Select your order</h1>
    </div>
</div>



<div class="order">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" id="mainContent">
               
                <!-- Filter -->
                <div class="row filter-box filters">
                    <div class="filter-box-header">
                        <h3>Filters</h3>
                        <span class="filter-box-link isotope-reset" @click="resetFilter()">
                            Reset Filters
                        </span>
                    </div>
                    
                    <div class="col-md-6 col-sm-6">
                        <select id="category" class="wide price-list" name="category">
                            <option value="">Show all</option>
                            <option value="Appetizer">Appetizer</option>
                            <option value="Main Course">Main Course</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Drinks">Drinks</option>
                        </select>
                    </div>
                
                    <div class="col-md-6 col-sm-6">
                        <div class="search-wrap">
                            <input id="search" v-model="searchMenuItem" type="text" class="form-control" placeholder="Search..." />
                            <i class="icon icon-search"></i>
                        </div>
                    </div>
                </div>

             
                <!-- Menu Item EntityList -->
                <div class="row grid" >               
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 isotope-item" v-for="item in resultMenuGridList">
                        <div class="item-body">
                            <figure>
                                <img :src="item.picture" class="img-fluid lazy" alt="">
                                <a href="javascript:" class="item-body-link" @click="selectMenuItem(item)" title="Click to see details">
                                    <div class="item-title">
                                        <h3>@{{ item.name }}</h3>
                                    </div>
                                </a>
                            </figure>
                            <ul>
                                <li>
                                    <span class="">
                                        ₱ @{{ setPrecision(item.price) }}
                                    </span>
                                </li>
                                <li>
                                    <a href="javascript:" class="add-options-item-to-cart" @click="addToCart(item)">
                                        Add to order <i class="icon icon-plus add-icon"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Cart Summary -->
            <div class="col-lg-4" id="sidebar">
                <div id="orderContainer" class="theiaStickySidebar">

                    @include('components.cart-summary')

                </div>
            </div>
        </div>
    </div>
</div>


<a id="menuItemModalTrigger" href="#menuItemModal" class="modal-opener" hidden></a>
<div id="menuItemModal" class="modal-popup zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>@{{ selectedMenuItem.name }}</h3>
    </div>
    <div class="content pb-1">
        <figure>
            <img :src="selectedMenuItem.picture" alt="" class="img-fluid">
        </figure>
        <h6 class="mb-1">₱ @{{ setPrecision(selectedMenuItem.price) }}</h6>
        <p class="mt-3">@{{ selectedMenuItem.description }}</p>
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-4 pr-0">
                <button type="button" class="btn-modal-close">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
