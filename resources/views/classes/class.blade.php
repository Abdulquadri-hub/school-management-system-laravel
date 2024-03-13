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

            @if ($rank->hasRank('instructor'))
              <a href="{{route('class.add')}}">
                <button class="btn btn-primary float-end btn-sm">
                <i class="bi bi-plus"></i>
                Add New
                </button>
              </a>
            @endif
        </h5>

        <!-- message -->
        @include("layouts.includes.messages")

        <div class="row">
        @if(isset($rows) && $rows)
        @foreach($rows as $key => $row)
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">

            <div class="card-body">
              
              <h5 class="card-title">
                <th scope="row">#{{$key + 1}}</th> {{ ucfirst($row->class) }}
              </h5>

              <h5 class="mt-2">
                {{ucfirst($row->firstname)}} {{ucfirst($row->lastname)}}
              </h5>

              <h6 class="mt-2 mb-4">
                {{date("jS M, Y H:s:i",strtotime($row->created_at))}}
              </h6>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                  @if ($rank->hasRank('instructor'))

                    <a href="{{route('class.single', [$row->id])}}">
                      <button class="btn btn-outline-primary float-end me-1  btn-sm">
                        <i class="ri ri-eye-fill"></i>
                      </button>
                    </a>
                    
                    <a href="{{route('class.edit', [$row->id])}}">
                      <button class="btn btn-outline-info float-end me-1  btn-sm">
                        <i class="ri ri-edit-2-fill"></i>
                      </button>
                    </a>
  
                    <a href="{{route('class.delete', [$row->id])}}">
                      <button class="btn btn-outline-danger float-end me-1  btn-sm">
                        <i class="ri ri-delete-bin-6-fill"></i>
                      </button>
                    </a>

                  @endif
                  
                  @if ($rank->hasRank('student'))
                      <a href="{{route('class.enroll', [$row->id])}}">
                        <button class="btn btn-outline-dark float-end me-1  btn-sm">
                        <i class="bi bi-plus"></i>
                          Enroll
                        </button>
                      </a>
                  @endif
                  
  
                </div>
                <div class="ps-3">

                </div>
              </div>
            </div>

          </div>
        </div>
        @endforeach
        @else 
        <p class="text-center text-muted m-auto">No class found at this time!</p>
        @endif
        </div>
        
        </div>
      </div>

    </div>
  </div>
</section>

</main>

@include('layouts.footer')