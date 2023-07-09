@include('layouts.header')

<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">School Laravel</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your email & password to login</p>
                  </div>

                  <form method="post" class="row g-3">
                    @csrf

                    @if(count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show p-3" role="alert">
                      @foreach($errors->all() as $error)
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      {{$error}}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      @endforeach
                    </div>
                    @endif

                    <div class="col-12">
                      <input type="email" name="email" value="{{old('email')}}" class="form-control" id="yourEmail" placeholder="E-mail">
                    </div>


                    <div class="col-12">
                      <input type="password" value="{{old('password')}}" name="password" class="form-control" id="yourPassword" placeholder="Password">
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="{{url('/register')}}">Create an account</a></p>
                      <p class="small mb-0"><a href="{{url('/forgotpassword')}}">forgot password</a></p>

                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{url('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{url('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{url('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{url('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{url('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{url('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{url('assets/js/main.js')}}"></script>
