@extends('layout.admin')
@section('content')

<div class="w-100 overflow-hidden chat-bg main-page">
    <div class="container table-responsive py-5"> 
        <div class="container-fluid">
            <div class="row justify-content-center">

                <!-- Menu list -->
                <div class="col-md-10">          
                    <div class="card mt-3">
                        <div class="card-header"></div>
                        <div class="card-body">
                                  
                            <div class="row">

                                <div class="col-md-5">
                                    <h5 class="card-title pt-1 text-muted">
                                        Menu List
                                    </h5>
                                </div>

                                <div class="col-md-4">
                                    <div class="search-wrap">
                                        <input id="search" type="text" class="form-control" placeholder="Search menu" v-model="searchMenuItem"/>
                                        <i class="icon icon-search"></i>
                                    </div>  
                                </div>

                                <div class="col-md-3">
                                    <button type="button" class="btn-form-func py-2" @click="createMenuItem()">
                                        <span class="btn-form-func-content">Add new item</span>
                                        <span class="icon">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </span>
                                    </button>
                                </div>

                                <div class="col-md-12">

                                    <div class="table-responsive mt-4">
                                        <table class="table table-nowrap align-middle">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Menu Item</th>
                                                    <th>Price</th>
                                                    <th>Category</th>
                                                    <th>Description</th>
                                                    <th colspan="2"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-show ="resultMenuItemList.length == 0">
                                                    <td class="text-center" colspan="6">
                                                        --- Result is empty ---
                                                    </td>
                                                </tr>
                                                <tr v-for="menuItem in resultMenuItemList">
                                                    <td>
                                                        <img :src="menuItem.picture" alt="img" width="100">
                                                    </td>
                                                    <td>@{{ menuItem.name }}</td>
                                                    <td>@{{ menuItem.price }}</td>
                                                    <td>@{{ menuItem.category }}</td>
                                                    <td>@{{ menuItem.description }}</td>
                                                    <td>
                                                        <button type="button" class="btn-form-func py-1 bg-info" @click="editMenuItem(menuItem)">
                                                            <span class="btn-form-func-content">Edit</span>
                                                            <span class="icon">
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                            </span>
                                                        </button>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn-form-func py-1 bg-danger" @click="removeMenuItem(menuItem)">
                                                            <span class="btn-form-func-content">Remove</span>
                                                            <span class="icon">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
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



<a id="menuItemModalTrigger" href="#menuItemModal" class="modal-opener" hidden></a>
<div id="menuItemModal" class="modal-popup zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>@{{ isItemCreate ? 'Create menu item' : 'Edit menu item' }}</h3>
    </div>
    <div class="content pb-1">
     
        <div class="row">

            <div class="col-md-12 mb-4">
                <div class="form-group">
                    <label>Picture</label>
                    <img :src="selectedMenuItem.picture" width="100%">
                </div>

                <input type="file" id="file-uploader" ref="file" v-on:change="handleFileUpload()" hidden/>
                <button type="button" class="btn-form-func btn-sm py-1 bg-secondary" onclick="document.getElementById('file-uploader').click()">
                    <span class="btn-form-func-content text-center">Upload</span>
                    <span class="icon">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                    </span>
                </button>
            </div>


            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        Name 
                        <small class="text-danger" v-show ="selectedMenuItem.name == ''">(Required)</small>
                    </label>
                    <input class="form-control" v-model="selectedMenuItem.name" placeholder="Enter name" name="name" type="text" />
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        Price
                        <small class="text-danger" v-show ="selectedMenuItem.price <= 0">(Required)</small>
                    </label>
                    <input class="form-control" v-model="selectedMenuItem.price" placeholder="Enter price" name="price" type="number" />
                </div>
            </div>

            <div class="col-md-12 pb-3">
                <div class="form-group">
                    <label>Category</label>
                    <select id="category" v-model="selectedCategory" class="wide price-list" name="category">
                        <option value="Appetizer">Appetizer</option>
                        <option value="Main Course">Main Course</option>
                        <option value="Dessert">Dessert</option>
                        <option value="Drinks">Drinks</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>
                        Description <small class="text-muted">(Optional)</small>
                    </label>
                    <textarea rows="3" maxlength="255" v-model="selectedMenuItem.description" placeholder="Enter description" class="form-control" name="description" type="text"></textarea>
                </div>
            </div>

            <div class="col-md-12 my-3">          
                <button type="button" class="btn-form-func py-2" @click="saveMenuItem()">
                    <span class="btn-form-func-content text-center">Save</span>
                    <span class="icon">
                        <i class="fa fa-save" aria-hidden="true"></i>
                    </span>
                </button>
            </div>
        </div>

    </div>
    <div class="footer">
    </div>
</div>


@endsection