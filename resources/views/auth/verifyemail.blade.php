@include('layouts.header')

<main id="main" class="main">

<div class="pagetitle">
  <h1>{{$page}}</h1>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
    <div class="card">
       <div class="card-body">

           <div class="m-auto p-4" style="max-width: 1000px;">
            @if($row)

                @if ($success)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                        {{ $success }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card-group justify-content-center">
                    <a href="{{url('/login')}}">
                      <button  class="btn btn-outline-dark">Login</button>  
                    </a>  
                </div>

            @else

                @if ($error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                        {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card-group justify-content-center">
                    <form action="" method="post">
                        @csrf
                        <button type="submit" name="generate-token" class="btn btn-outline-dark">Generate A New Token</button>
                    </form>    
                </div>

            @endif

            </div>
        </div>
    </div>
    </div>

  </div>
</section>

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
