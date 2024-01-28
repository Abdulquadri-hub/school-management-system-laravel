@include('layouts.header')
@include('layouts.nav')

<main id="main" class="main">

@if(isset($row) && $row)
<div class="pagetitle">
  <h1>{{$page}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
      <li class="breadcrumb-item">Pages</li>
      <li class="breadcrumb-item"><a href="{{route('class')}}">Lessons</a></li>
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
            <a href="{{route('class.add')}}">
            <button class="btn btn-primary float-end btn-sm">
                <i class="bi bi-plus"></i>
                Add New
            </button>
            </a>
        </h5>

        <!-- message -->
        @include("layouts.includes.messages")

        <div class="table-responsive">
          <table class="table table-striped">
              <tr>
                <th>Created By: <a href="{{route('profile', [$row->user_id])}}">{{ucfirst($row->user->firstname)}} {{ucfirst($row->user->lastname)}}</a></th>
                <th>Class: 
                  <a href="{{route('class.single', [$row->class->id])}}">{{ucfirst($row->class->class)}}</a>
                </th>
                <th>Date: <span class="text-primary">{{date("jS M, Y H:s:i",strtotime($row->created_at))}}</span></th>
              </tr>
          </table>
        </div>

        <!-- tabs -->
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'lessons'])}}">Lessons</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'enrolled-students'])}}">Enrolled Students</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'assignments'])}}">Assignents</a>
          </li>
        </ul>

        </div>
      </div>

    </div>
  </div>
</section>            
@else
                
@endif


</main>

@include('layouts.footer')