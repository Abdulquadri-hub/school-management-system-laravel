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
      <li class="breadcrumb-item"><a href="{{route('class')}}">Classes</a></li>
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

        <!-- message -->
        @include("layouts.includes.messages")

        <div class="table-responsive">
          <table class="table table-striped">
              <tr>
                <th>Created By: <a href="{{route('profile', [$row->user_id])}}">{{ucfirst($row->user->firstname)}} {{ucfirst($row->user->lastname)}}</a></th>
                <th>Date: <span class="text-primary">{{date("jS M, Y H:s:i",strtotime($row->created_at))}}</span></th>
              </tr>
          </table>
        </div>

        <!-- tabs -->
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link {{  $tab == 'lessons' ? 'active' : '' }}" aria-current="page" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'lessons'])}}">Lessons</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $tab == 'enrolled-students' ? 'active' : '' }}" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'enrolled-students'])}}">Enrolled Students</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $tab == 'materials' ? 'active' : '' }}" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'materials'])}}">Materials</a>
          </li>
        </ul>

  
        @if($tab == "lessons")
          @include('layouts.includes.class.class-lesson')

        @elseif ($tab == "enrolled-students")  
          @include('layouts.includes.class.class-lesson')

        @elseif($tab == "add-lesson")
          @include('layouts.includes.class.class-add-lesson')

        @elseif($tab == "edit-lesson")
          @include('layouts.includes.class.class-edit-lesson')

        @elseif($tab == "delete-lesson")
          @include('layouts.includes.class.class-delete-lesson')

        @elseif($tab == "materials")
          @include('layouts.includes.class.class-materials')

        @elseif($tab == "add-materials")
          @include('layouts.includes.class.class-add-materials')

        @else 
          
        @endif
        </div>
      </div>

    </div>
  </div>
</section>            
@else
                
@endif


</main>

@include('layouts.footer')