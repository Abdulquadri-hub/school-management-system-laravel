@include('layouts.header')
@include('layouts.nav')

<main id="main" class="main">

<div class="pagetitle">
  <h1>{{$page}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
      <li class="breadcrumb-item">Pages</li>
      <li class="breadcrumb-item"><a href="{{route('lesson')}}">Lessons</a></li>
      <li class="breadcrumb-item active">{{$page}}</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

    <div class="card">
        <div class="card-body">
        <h5 class="card-title">
            {{$page}}
        </h5>
        
        <div class="m-auto p-4" style="max-width: 400px;">
        <form method="post" class="row g-3">
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
                <input type="text" name="class" value="{{old('class')}}" class="form-control" id="" placeholder="Class Name">
            </div>  

            <div class="col-12">
                <a href="{{route('class')}}">
                    <button class="btn btn-secondary float-start btn-sm" type="button">
                        <i class="ri ri-arrow-left-circle-line"></i>
                        Back
                    </button>
                </a>
                <button class="btn btn-primary float-end btn-sm" type="submit">Save</button>
            </div>
        </form>
        </div>

        </div>
    </div>

    </div>
  </div>
</section>


</main><!-- End #main -->

@include('layouts.footer')