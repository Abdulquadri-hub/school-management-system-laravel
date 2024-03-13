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
      <li class="breadcrumb-item">
          @if ($rank->hasRank('instructor')) 
          <a href="{{route('class')}}"> 
            Classes  
          </a>
          @elseif($rank->hasRank())
          <a href="{{route('myclass')}}"> 
            MyClasses
            </a>
          @else
          <a href="{{route('class')}}"> 
            Classes  
          </a>
          @endif
        
      </li>
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
                <th>Created By: <a href="{{route('profile', [$row->user_id])}}">{{ucfirst($row->firstname)}} {{ucfirst($row->lastname)}}</a></th>
                <th>Date: <span class="text-primary">{{date("jS M, Y H:s:i",strtotime($row->created_at))}}</span></th>
              </tr>
          </table>
        </div>

        <!-- tabs -->
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link {{  $tab == 'instructors' ? 'active' : '' }}" aria-current="page" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'instructors'])}}">Instructors</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $tab == 'enrolled-students' ? 'active' : '' }}" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'enrolled-students'])}}">Enrolled Students</a><a href="{{route('class.single', ['id'=> $row->id, 'tab' => 'enrolled-students'])}}">
          </li>
          <li class="nav-item">
            <a class="nav-link {{  $tab == 'lessons' ? 'active' : '' }}" aria-current="page" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'lessons'])}}">Lessons</a>
          </li>
        </ul>

  
        @if($tab == "lessons")
          @include('layouts.includes.lesson.lesson')

        @elseif ($tab == "enrolled-students")  
          @include('layouts.includes.class.class-enrolled-student')

        @elseif ($tab == "remove-enrolled-student")  
          @include('layouts.includes.class.class-unenroll-student')

        @elseif($tab == "add-lesson")
          @include('layouts.includes.lesson.add-lesson')

        @elseif($tab == "edit-lesson")
          @include('layouts.includes.lesson.edit-lesson')

        @elseif($tab == "delete-lesson")
          @include('layouts.includes.lesson.delete-lesson')

        @elseif($tab == "single-lesson")
          @include('layouts.includes.lesson.single-lesson')

        @elseif($tab == "instructors")
          @include('layouts.includes.class.class-instructor')

        @elseif($tab == "add-instructor")
          @include('layouts.includes.class.class-add-instructor')

        @elseif($tab == "remove-instructor")
          @include('layouts.includes.class.class-remove-instructor')

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