require('./bootstrap');
window.Vue = require('vue').default;



var app = new Vue({
	el: '#app',
	data: {
        email: '',
        name : '',
        password: '',
        passwordConfirm: '',
        code: '',
        error: '',
        loadqueue: []
	},

	methods: {
		login: function login() {		
            var api = `/api/login`;
            var _this = this;

            if( this.email == '' || this.password == '') {
                alert('Please provide the required fields');
                return;
            }

            _this.showLoader();
			axios.post(api, { email: this.email, password: this.password }).then(function(response) {
                _this.showLoader(false);
                console.log(response);
                window.location.href = '/admin-menu';

			})["catch"](function(error) {
				console.log(error);
			});
		},

		register: function register() {		
            var api = `/api/register`;
            var _this = this;
            _this.error = '';

            if( this.email == '' || this.password == '' || this.name == ''  || this.code == '') {
                return;
            }
            else if (this.password != this.passwordConfirm) {
                _this.error = 'Confirmation password does not match.';
                return;
            }
            else if (this.password.length < 6) {
                _this.error = 'Password must be at least 6 characters';
                return;
            }
            else if (this.code != '0000') {
                _this.error = 'Access code is incorrect.';
                return;
            }

           if (confirm('Are you sure you want to register a new user?')) {
                _this.showLoader();
                axios.post(api, { email: this.email, password: this.password, name: this.name }).then(function(response) {
                    _this.showLoader(false);
                    console.log(response);
                    alert('User has been created successfully!');
                    window.location.href = '/login';

                })["catch"](function(error) {
                    console.log(error);
                });
           }
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
