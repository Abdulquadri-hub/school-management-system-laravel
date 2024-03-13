@include('layouts.header')
@include('layouts.nav')

<main id="main" class="main">

<div class="pagetitle">
  <h1>{{$page}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
      <li class="breadcrumb-item">Pages</li>
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
            <a href="{{route('class')}}">
            <button class="btn btn-primary float-end btn-sm">
                <i class="bi bi-plus"></i>
                Enroll
            </button>
            </a>
        </h5>

        <!-- message -->
        @include("layouts.includes.messages")

        <div class="row">
        @if(isset($rows) && $rows)
          @foreach($rows as $key => $row)
          <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">{{ ucfirst($row->class) }}</h5>
              @if ($rank->hasRank('student'))
                @if ($row->enrolled == 1)
                  <h5>Enrolled</h5>
                @endif
              @endif
              

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <a href="{{route('class.single', [$row->id])}}">
                  <button class="btn btn-outline-primary">
                      <i class="ri ri-eye-fill"></i>
                  </button>
                  </a>
                </div>
              </div>
            </div>

          </div>
          </div>
          @endforeach
        @else 
          <tr class="text-center text-muted m-auto">You are not enrolled for any class!</tr>
        @endif
        </div>

        </div>
      </div>

    </div>
  </div>
</section>

</main>

@include('layouts.footer')