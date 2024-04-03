@include('layouts.head')


<body class="bg-gradient-primary">

    <div class="container ">

        <div class="col-lg-5 col-md-9 mx-auto  pt-5">

            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body p-0">
                    {{-- <div class="row"> --}}
                    {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> --}}
                    {{-- <div class="col-lg-6"> --}}
                    <div class="p-4">

                        <h5 class=" font-weight-bolder text-gray-900">DASHDATA IMS</h5>
                        <h6>Login into your account</h6>

                        @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                            </div>
                        @endif

                        <form action="/login" class="mt-4" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text"
                                    class="form-control form-control-user @error('nip') is-invalid @enderror"
                                    id="nip" name="nip" placeholder="Enter your NIP" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control form-control-user" id="password"
                                    name="password" placeholder="">
                            </div>
                            <div class="form-group ">
                                <div class="custom-control custom-checkbox  ">
                                    <input type="checkbox" class="custom-control-input " id="customCheck">
                                    <label class="custom-control-label " for="customCheck">Remember
                                        me</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign
                                In</button>

                        </form>
                        {{-- <hr> --}}
                        {{-- <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div> --}}

                        {{-- <small>Dashdata 2024</small> --}}

                    </div>
                    {{-- @include('layouts.footer') --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                </div>
            </div>

            {{-- </div> --}}
            {{-- <div class="container"> --}}

            <!-- Outer Row -->
            {{-- <div class="row justify-content-center">

            <div class=" col-lg-4 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-4">
                            <h1 class="h5 text-gray-900 mb-3">Dashdata</h1>

                            <form class="user">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleInputPassword" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div>
                                <a href="index.html" class="btn btn-primary btn-user btn-block">
                                    Login
                                </a>
                                <hr>

                            </form>

                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div> --}}

        </div>
</body>
