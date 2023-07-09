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
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form method="post" enctype="multipart/form-data" class="row g-3">
                    @csrf

                    @if(count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show p-4" role="alert">
                      @foreach($errors->all() as $error)
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      {{$error}}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      @endforeach
                    </div>
                    @endif

                    <div class="col-12">
                      <input type="text" name="firstname" value="{{old('firstname')}}" class="form-control" id="firstname" placeholder="First Name">
                      <div class="invalid-feedback">Please, enter your first name!</div>
                    </div>

                    <div class="col-12">
                      <input type="text" name="lastname" value="{{old('lastname')}}" class="form-control" id="lastname" placeholder="Last Name">
                      <div class="invalid-feedback">Please, enter your last name!</div>
                    </div>

                    <div class="col-12">
                      <input type="email" name="email" value="{{old('email')}}" class="form-control" id="yourEmail" placeholder="E-mail">
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                      <select class="form-select" name="gender" id="validationCustom04">
                        <option selected disabled value>Gender</option>
                        <option  value="male">Male</option>
                        <option value="female">female</option>
                      </select>
                      <div class="invalid-feedback">Please enter a valid gender!</div>
                    </div>

                    <?php if($mode  == 'students'): ?>
                    <div class="col-12">
                      <input type="text" readonly name="rank" value="student" class="form-control" id="" placeholder="">
                    </div>
                    <?php endif; ?>

                    <div class="col-12">
                      <select class="form-select" name="rank" id="validationCustom04">
                        <option selected disabled value>Rank</option>
                        <option value="student">Student</option>
                        <option value="lecturer">Lecturer</option>
                        <option value="parent">Parent</option>
                        <option value="admin">Admin</option>
                        <option value="reception">Reception</option>
                        <option value="super admin">Super Admin</option>
                      </select>
                      <div class="invalid-feedback">Please enter a valid gender!</div>
                    </div>

                    <div class="col-12">
                      <input type="password" value="{{old('password')}}" name="password" class="form-control" id="yourPassword" placeholder="Password">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="{{url('/login')}}">Log in</a></p>
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
