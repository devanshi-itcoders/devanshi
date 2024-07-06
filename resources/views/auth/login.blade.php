@extends('layouts.guest')

<head>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css" rel="stylesheet" />

</head>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>
@section('content')
   
    <section class="vh-100" style="background-color: #424242;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">

                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0">{{ env('APP_NAME') }}</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account
                                        </h5>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="email"  onclick="myFunction(this)"
                                                class="form-control form-control-lg 
                                         @error('email') is-invalid active @enderror"
                                                name="email" value="{{ old('email') }}" required autocomplete="email">
                                            <label class="form-label" for="form2Example17">Email address</label>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert" style="margin-left: 2%;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>



                                        <div class="form-outline mb-4">
                                            <input type="password" id="password" 
                                                class="form-control form-control-lg 
                                          @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password" />
                                            <label class="form-label" for="password">Password</label>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert" style="margin-left: 2%;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="">
                                         
                                              <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                      {{ old('remember') ? 'checked' : '' }}>
          
                                                  <label class="form-check-label" for="remember">
                                                      {{ __('Remember Me') }}
                                                  </label>
                                              </div>
                                          
                                      </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a class="small text-muted" href="{{ route('password.request') }}">Forgot
                                                password?</a>
                                        @endif
                                        {{-- <p class="mb-5 pb-lg-2" style="color: #393f81;"> <a
                                                href="#!" style="color: #393f81;"></a></p> --}}
                                       <div style="margin-top: 1rem">
                                        <a href="#!" class="small text-muted">Terms of use.</a>
                                        <a href="#!" class="small text-muted">Privacy policy</a>
                                      </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
