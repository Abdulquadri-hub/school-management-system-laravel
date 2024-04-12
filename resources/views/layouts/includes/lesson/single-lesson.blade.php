@include('layouts.header')
@include('layouts.nav')

<main id="" class="mt-4">

@if(isset($single_lesson_row) && $single_lesson_row)
<div class="pagetitle">
  <h1>Lesson <i class="bi bi-chevron-right"></i> {{$single_lesson_row->title}}</h1>
  <!-- <nav>
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
  </nav> -->
</div>
<!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">

        <!-- tabs -->
        <div class="mb-5">
           <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link {{ $tab1 == 'overview' ? 'active' : '' }}" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'single-lesson', 'single_lesson_id' => $single_lesson_row->id, 'tab1' => 'overview'])}}">
                      Overview
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link {{ $tab1 == 'single-lesson-test' ? 'active' : '' }}" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'single-lesson', 'tab1' => 'single-lesson-test', 'single_lesson_id' => $single_lesson_row->id])}}">
                        <sup class="badge bg-primary badge-number">3</sup> Tests
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link {{ $tab1 == 'lesson-assignment' ? 'active' : '' }}" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'single-lesson', 'single_lesson_id' => $single_lesson_row->id, 'tab1' => 'lesson-assignment'])}}">
                      <!-- <sup class="badge bg-primary badge-number">3</sup> --> Assignments 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tab1 == 'lesson-assignment-submission' ? 'active' : '' }}" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'single-lesson', 'single_lesson_id' => $single_lesson_row->id, 'tab1' => 'lesson-assignment-submission'])}}">
                      <!-- <sup class="badge bg-primary badge-number">3</sup> --> Assignment Submission
                    </a>
                </li>
           </ul>
        </div>


        @if($tab1 == "single-lesson")
        <div class="">
            {!! $single_lesson_row->content !!} 
        </div>

        @elseif ($tab1 == "lesson-assignment")  

          @include('layouts.includes.lesson.lesson-assignment')

        @elseif ($tab1 == "add-lesson-assignment")  

          @include('layouts.includes.lesson.add-lesson-assignment')

        @elseif ($tab1 == "lesson-assignment-submission")  

          @include('layouts.includes.lesson.lesson-assignment-submission')

        @else 

        <div class="">
            {!! $single_lesson_row->content !!} 
        </div>
          
        @endif
  

        </div>
      </div>

    </div>
  </div>
</section>            
@else
                
@endif


</main>
