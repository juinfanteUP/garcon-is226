@extends('layout.auth')
@section('content')


<div class="auth-bg">
    <div class="container p-0">
        <div class="row justify-content-center g-0">
            <div class="col-lg-6">
                <div class="authentication-page-content shadow-lg">
                    <div class="d-flex flex-column h-100 px-4 pt-4">
                        <div class="row justify-content-center">
                            <div class="col-sm-10">

                                <div class="py-md-5 py-3">

                                    <div class="text-center mb-5">

                                        <div class="pb-3">
                                            <img src="/assets/img/garcon-md.png" width="128" alt="logo">
                                        </div>

                                        <h3 class="m-0">
                                            Garçon Application
                                        </h3>

                                        <p class="text-muted mt-1">Admin Portal</p>
                                    </div>

                                    <div>

                                        <!-- User Id -->
                                        <div class="mb-3">
                                            <label for="tenantId" class="form-label">Email</label>
                                            <input name="email" v-model="email" type="text" class="form-control" id="email" placeholder="Enter Email">
                                        </div>


                                        <!-- Password -->
                                        <div class="mb-3">
                                            <label for="userpassword" class="form-label">
                                                Password
                                            </label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input name="password" type="password" v-model="password" class="form-control pe-5" placeholder="Enter Password" id="password-input">
                                            </div>
                                        </div>


                                        <!-- Login Button -->
                                        <div class="text-center my-5">
                                            <button type="button" class="btn-form-func py-2 w-50" @click="login()">
                                                <span class="btn-form-func-content text-center">Sign In</span>
                                                <span class="icon">
                                                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>


                                    <!-- Go to Register Button -->
                                    <div class="my-4 text-center">
                                        <div class="signin-other-title">
                                            <p class="fs-14 m-0 title text-muted">New User? Don't have an account?</p>
                                        </div>
                                    </div>
                                    <div class=" text-center text-muted">
                                        <p>
                                            <a href="/register" class="fw-medium text-decoration-underline">
                                                Register Account
                                            </a>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- Footer -->
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="text-center text-muted p-4">
                                    <p class="mb-0 small">&copy; 2022 Developed by Dave Infante</p>
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