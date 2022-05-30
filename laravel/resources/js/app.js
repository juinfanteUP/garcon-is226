require('./bootstrap');
window.Vue = require('vue').default;


var app = new Vue({
	el: '#app',
	data: {

        // Customer props
        customerList: [],
        searchCustomerItem: '',
        viewCustomer: {},
        customer: { name: '', email: '', contact: '', address: ''},
      
        // Cart props
        cartList: [],
        cartSubTotal: 0,

        // Order props
        orderList: [],
        orderHistoryList: [],
        order: { total: 0, subtotal: 0, cartSubtotal: 0, service_cost: 0, amount_paid: 0, customer_remarks: '' },
        searchOrderItem: '',
        searchMenuItem: '',

        // Menu props
        menuItemList: [],
        selectedMenuItem: {},
        selectedCategory: '',

        // Support props
        isItemCreate: true,
        file: { name: '' },
        loadqueue: [],
	},

	mounted: function mounted() {
		this.getMenuList();
        this.getCustomerList();
        this.getOrderList();
        this.getSelectedCategory();
	},

	computed: {
		resultMenuItemList: function resultMenuItemList() {
			if (this.searchMenuItem) {
				return this.menuItemList.filter((i)=>{
					return this.searchMenuItem.toLowerCase().split(' ').every(function(v) {
						return i.name.toLowerCase().includes(v);
					});
				});
			}

			return this.menuItemList;
		},
        resultMenuGridList: function resultMenuGridList() {
            var list = this.menuItemList;

			if (this.searchMenuItem) {
				list = list.filter((i)=>{
					return this.searchMenuItem.toLowerCase().split(' ').every(function(v) {
						return i.name.toLowerCase().includes(v);
					});
				});
			}

            if (this.selectedCategory){
                list = list.filter((i)=>{
					return this.selectedCategory.toLowerCase().split(' ').every(function(v) {
						return i.category.toLowerCase().includes(v);
					});
				});
            }

			return list;
		},
        resultCustomerList: function resultCustomerList() {
			if (this.searchCustomerItem) {
				return this.customerList.filter((i)=>{
					return this.searchCustomerItem.toLowerCase().split(' ').every(function(v) {
						return i.name.toLowerCase().includes(v);
					});
				});
			}

			return this.customerList;
		},
        resultOrderList: function resultOrderList() {
			if (this.searchOrderItem) {
				return this.orderHistoryList.filter((i)=>{
					return this.searchOrderItem.toLowerCase().split(' ').every(function(v) {
						return i.reference_id.toLowerCase().includes(v);
					});
				});
			}

			return this.orderHistoryList;
		},
        computerChange: function computeChange() {
            this.order.total = this.order.subtotal + (this.order.subtotal * 0.05);
            return this.order.amount_paid >= this.order.total ? this.setPrecision( this.order.amount_paid - this.order.total) : 0.00;
        }
	},
	methods: {


        // ************************ Menu Items Helper ************************ //


		getMenuList: function getMenuList() {		
            var api = `/api/menu/list`;
            var _this = this;

            _this.showLoader();
			axios.get(api).then(function(response) {
                _this.showLoader(false);
				_this.menuItemList = response.data;
                _this.getOrderItemList();

			})["catch"](function(error) {
				console.log(error);
			});
		},

        selectMenuItem: function selectMenuItem(item) {
            this.selectedMenuItem = { picture: item.picture, name: item.name, price: item.price, category: item.category, description: item.description };
            document.getElementById("menuItemModalTrigger").click();
        },

        createMenuItem: function createMenuItem() {
            this.isItemCreate = true;
            this.selectedMenuItem = { picture: "assets/img/placeholder.jpg", name: "", price: 0, category: "Appetizer", description: "" };
            $('#category').val(this.selectedMenuItem.category);
            $('#category').niceSelect('update');

            document.getElementById("menuItemModalTrigger").click();
            this.$forceUpdate();
        },

        editMenuItem: function editMenuItem(item) {
            this.isItemCreate = false;
            $('#category').val(item.category);
            $('#category').niceSelect('update');

            this.selectedMenuItem = { id: item.id, picture: item.picture, name: item.name, price: item.price, category: item.category, description: item.description };
            document.getElementById("menuItemModalTrigger").click();
            this.$forceUpdate();
        },

        removeMenuItem: function removeMenuItem(item) {
            var api = "/api/menu/delete?id=" + item.id;
            var _this = this;

            if(confirm(`Are you sure you want to remove ${item.name}?`)) {
                _this.showLoader();
                hideModal();

                axios.delete(api).then(function(response) {
                    _this.showLoader(false);

                    alert('Menu item deleted successfully!');
                    _this.getMenuList();
                })["catch"](function(error) {
                    console.log(error);
                });
            }
        },

        saveMenuItem: function saveMenuItem() {
            var api = this.isItemCreate ? "/api/menu/add" : "/api/menu/update"; 
            var _this = this;

            this.selectedMenuItem.category = this.selectedCategory;
            if ( this.selectedMenuItem.name == '' ||  this.selectedMenuItem.price <= 0) {
                alert('Please provide the required fields before saving.');
                return;
            }

            if(confirm('Are you sure you want to save this menu item?')){
                _this.showLoader();
                hideModal();
                
                axios.post(api, this.selectedMenuItem ).then(function(response) {
                    _this.showLoader(false);  
                    _this.getMenuList();
                    alert('Menu item has been saved successfully.')
                    
                    // Close modal
                })["catch"](function(error) {
                    console.log(error);
                });
            }        
        },


        resetFilter: function resetFilter() {
            this.searchMenuItem = '';

            $('#category').val('');
            $('#category').niceSelect('update');
            this.$forceUpdate();
        },


        // ************************ Cart Helper ************************ //


        addToCart: function addToCart(item) {
            var ind = _.findIndex(this.cartList, (c) => { return c.id == item.id } );

            if (ind >= 0) {
                this.cartList[ind].quantity++;
            }
            else {
                item.quantity = 1;
                this.cartList.push(item);
            }
            this.updateCartBill();
        },


        removeToCart: function removeToCart(index) {
            this.cartList.splice(index, 1);
            this.updateCartBill();
        },


        updateQuantity: function updateQuantity(item, index, isAdd=true) {
            let qty = isAdd ? (item.quantity+1) : (item.quantity-1);
           
            if(qty==0) {
                this.cartList.splice(index, 1);
            }
            else {
                item.quantity = qty;
            }

            this.updateCartBill();
        },


        updateCartBill: function updateCartBill () {
            let subtotal = 0;
            this.cartList.forEach(c => { subtotal += (c.quantity * c.price) });
            this.order.cartSubtotal = subtotal;
            this.$forceUpdate();
        },


        updateOrderBill: function updateOrderBill () {        
            let subtotal = 0;
            this.orderList.forEach(c => { subtotal += (c.quantity * c.price) });
            this.order.subtotal = subtotal;
            this.order.service_cost = subtotal * 0.05;
            this.order.total = this.order.subtotal + this.order.service_cost;
            this.$forceUpdate();
        },


        // ************************ Order Helper ************************ //


		getOrderItemList: function getOrderItemList() {		
            var api = '/api/order/list';
            var _this = this;

            _this.showLoader();
			axios.get(api).then(function(response) {
                _this.showLoader(false);
				let list = response.data;

                list.forEach(e => {
                    var ind = _.findIndex(_this.menuItemList, (c) => { return c.id == e.menu_id } );
                    if(ind >= 0) {
                        item = _this.menuItemList[ind];
                        item.quantity = e.quantity;
                        _this.orderList.push(item);
                    }
                });

                _this.updateOrderBill();
			})["catch"](function(error) {
				console.log(error);
			});
		},

        placeOrder: function placeOrder() {
            var api = '/api/order/place';
            var _this = this;

            if(confirm('Are you sure you want to place your order?')){
                let params = { 'cartList': _this.cartList };
                _this.showLoader();
                axios.post(api, params).then(function(response) {  
                    _this.showLoader(false);       

                    _this.cartList.forEach(e => {
                        var ind = _.findIndex(_this.menuItemList, (c) => { return c.id == e.menu_id } );
                        if(ind >= 0) {
                            item = _this.menuItemList[ind];
                            item.quantity = e.quantity;
                            _this.orderList.push(item);
                        }
                    });

                    _this.cartList = [];
                    _this.updateCartBill();
                    _this.updateOrderBill();
                    window.location.href = "/orders";
                })["catch"](function(error) {
                    console.log(error);
                });
            }
        },

        handleBillout: function handleBillout() {
            if (this.orderList.length == 0) {
                alert('Please place an order first before billing out.');
                return;
            }

            this.order.amount_paid = 0;
            this.customer = { name: '', email: '', contact: '', address: ''}
            document.getElementById("customerInputTrigger").click();
        },

        billout: function billout() {
            var api = '/api/order/billout';
            var _this = this;

            if (this.customer == '' || this.order.amount_paid < this.order.total ) {
                alert('Please provie the required fields.');
                return;
            }

            if(confirm('Are you sure you want to bill out?')){
                let params = { 'customer': _this.customer, 'order': _this.order };
                _this.showLoader();
                hideModal();
                
                axios.post(api, params).then(function(response) {  
                    _this.showLoader(false);       
                    alert('Billout has been successful! Thanks for ordering and come back again!');
                    _this.cartList = [];
                    _this.orderList = [];
                    _this.updateCartBill();
                    _this.updateOrderBill();
                    window.location.href = "/";
                })["catch"](function(error) {
                    console.log(error);
                });
            }
        },

        getOrderList: function getOrderList() {
            var api = `/api/order/history`;
            var _this = this;

            _this.showLoader();
			axios.get(api).then(function(response) {
                _this.showLoader(false);
				_this.orderHistoryList = response.data;
			})["catch"](function(error) {
				console.log(error);
			});
        },


		// ************************ Customer Helper ************************ //


        getCustomerList: function getCustomerList() {		
            var api = '/api/customer/list';
            var _this = this;

            _this.showLoader();
			axios.get(api).then(function(response) {
                _this.showLoader(false);
				_this.customerList = response.data;

			})["catch"](function(error) {
				console.log(error);
			});
		},

	
        showCustomerDetails: function showCustomerDetails(item) {
            var ind = _.findIndex(this.customerList, (c) => { return item.customer_id == c.id } );
          
            if (ind >= 0) {
                var cus = this.customerList[ind];
                this.viewCustomer = {
                    name: cus.name,
                    contact: cus.contact ?? '---', 
                    address: cus.address ?? '---', 
                    email: cus.email ?? '---',
                    remarks: item.customer_remarks ?? '---',
                    reference_id: item.reference_id,
                    timestamp: item.created_dtm
                };

                this.$forceUpdate();
                document.getElementById("viewCustomerTrigger").click();
                return;
            }

            alert('Customer not found.');
        },


        // ************************ File Helper ************************ //


        handleFileUpload: function handleFileUpload() {
            var _this = this;
			var file = this.$refs.file.files[0];
            var api = "/api/menu/upload";

            if (file?.name != "") 
            {
                let formData = new FormData();
                formData.append('file', file);

                _this.showLoader();
                axios.post(api, formData, {headers: { 'Content-Type': 'multipart/form-data'} })
                .then(function(response) {
                    _this.showLoader(false);
                    _this.selectedMenuItem.picture = response.data;
                    _this.cancelUpload();
                    _this.$forceUpdate();

                }).catch(function(error) {
                    console.log(error);
                });
            } 
		},

		cancelUpload: function cancelUpload() {
			this.$refs.file.value = null;
			this.file = { name: '' };
		},


        // ************************ utility ************************ //


        setPrecision: function setPrecision(value) {
            return !isNaN(value) ? Number(value).toFixed(2) : "0.00";
        },

        getSelectedCategory: function getSelectedCategory() {
            var _this = this;
            setInterval(() => {
                var value = $('#category').val() ?? 'Appetizer';
                _this.selectedCategory = value;
            }, 300);
        },
        
        showLoader: function showLoader(willShow=true){
            var divLoader = document.getElementById("preloader");
            var nodes = divLoader.children;

            if (willShow) this.loadqueue.push(1);
            else this.loadqueue.pop();

            if (this.loadqueue.length > 0) {
                divLoader.style.display = 'block';
            }
            
            if (this.loadqueue.length == 0) {
                $('#preloader').delay(100).fadeOut('slow');    
                for(var i=0; i<nodes.length; i++) nodes[i].style.display = 'none';
            }    
            else {
                divLoader.style.display = 'block';
                for(var i=0; i<nodes.length; i++) nodes[i].style.display = 'block';
            }       
        }
	}
});


// *********** Helper Methods *********** //


function hideModal() {
    var magnificPopup = $.magnificPopup.instance; 
    magnificPopup.close(); 
}


