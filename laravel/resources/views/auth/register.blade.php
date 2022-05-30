@extends('layout.auth')
@section('content')      

<div class="auth-bg">
    <div class="container p-0">
        <div class="row justify-content-center g-0">
            <div class="col-lg-6">
                <div class="authentication-page-content shadow-lg mb-5">
                    <div class="d-flex flex-column h-100 px-4 pt-4">
                        <div class="row justify-content-center">
                            <div class="col-sm-10">

                                <div class="pt-md-5 pt-3">

                                    <div class="text-center mb-5">

                                        <h3 class="m-0">
                                            Registration
                                        </h3>

                                        <p class="text-muted mt-1">Please use an access code to proceed with user registration</p>
                                    </div>

                                    <div>

                                        <!-- User Id -->
                                        <div class="mb-3">
                                            <label for="code" class="form-label">Access Code 
                                                <small class="text-danger" v-show="code == ''">(required)</small>
                                            </label>
                                            <input name="code" v-model="code" maxlength="4" type="text" class="form-control" placeholder="Enter Access Code (Use 0000)">
                                        </div>

                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email 
                                                <small class="text-danger" v-show="email == ''">(required)</small>
                                            </label>
                                            <input name="email" v-model="email" type="text" class="form-control" placeholder="Enter email">
                                        </div>

                                        <!-- Name -->
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name 
                                                <small class="text-danger" v-show="name == ''">(required)</small>
                                            </label>
                                            <input name="name" v-model="name" type="text" class="form-control" placeholder="Enter full name">
                                        </div>

                                        <!-- Password -->
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password
                                                 <small class="text-danger" v-show="password == ''">(required)</small>
                                                </label>
                                            <input name="password" v-model="password" type="password" class="form-control" placeholder="Enter password (min 6 characters)">
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mb-4">
                                            <label for="password_confirmation" class="form-label">Confirm Password 
                                                <small class="text-danger" v-show="password != passwordConfirm">(required)</small>
                                            </label>
                                            <input name="password_confirmation" v-model="passwordConfirm" type="password" class="form-control" placeholder="Confirm password">
                                        </div>


                                        <div class="text-danger text-center pt-2" v-show="error != ''">
                                            @{{ error }}
                                        </div>


                                        <!-- Register Button -->
                                        <div class="text-center my-5">
                                            <button type="button" class="btn-form-func py-2 w-50" @click="register()">
                                                <span class="btn-form-func-content text-center">Sign In</span>
                                                <span class="icon">
                                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>


                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <p class="fs-14 m-0 title text-muted"></p>
                                        </div>
                                    </div>

                                    <!-- Go to Login Button -->
                                    <div class="mt-2 text-center text-muted">
                                        <p class="mt-0">
                                            Already have an admin account ? 
                                            <a href="/login" class="fw-medium text-decoration-underline">Login</a>
                                        </p>
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