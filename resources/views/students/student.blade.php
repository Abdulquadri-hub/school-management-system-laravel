@include('layouts.header')
@include('layouts.nav')

<main id="main" class="main">

<div class="pagetitle">
  <h1>{{$page}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
      <li class="breadcrumb-item">Pages</li>
      <li class="breadcrumb-item"><a href="{{url('/schools')}}">School</a></li>
      <li class="breadcrumb-item active">{{$page}}</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{$page}}
            </h5>

            <!-- message -->
             @include("layouts.includes.messages")

            <div class="m-auto p-4" style="max-width: 1000px;">
                <nav class="navbar navbar-light bg-light">
                <form class="search-form d-flex align-items-center" method="post">
                <div class="input-group">
                    <button class="input-group-text" id="basic-addon1">
                        <i class="bi bi-search">&nbsp</i>
                    </button>
                    <input type="text" class="form-control" name="find" placeholder="Search a students" title="Enter search keyword">
                </div>
                </form>

                <a href="{{url('/register?mode=students')}}">
                    <button class="btn btn-sm btn-primary">
                        <i class="bi bi-plus"></i>
                        Add New
                    </button>
                </a>
                </nav>
                
                <div class="card-group justify-content-center">
                    @if(isset($rows) && $rows)
                    @foreach($rows as $row) 
                    
                        @include('layouts.includes.user-inc')
            
                    @endforeach
                    @else
                        <h6>No Student were found at this time!</h6>
                    @endif
                </div>

                <!-- pagination -->
            </div>
        </div>
    </div>
    </div>

  </div>
</section>

</main>

@include('layouts.footer')