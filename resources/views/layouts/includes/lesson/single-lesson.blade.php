@include('layouts.header')
@include('layouts.nav')

<main id="" class="mt-4">

@if(isset($single_lesson_row) && $single_lesson_row)
<!-- <div class="pagetitle">
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
</div> -->
<!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">

        <h5 class="card-title">
            Single Lesson 
            #{{$single_lesson_row->title}} 
        </h5>

        <!-- tabs -->
        <div class="mb-5">
           <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link {{ $tab1 == 'overview' ? 'active' : '' }}" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'single-lesson',  'tab1' => 'overview', 'single_lesson_id' => $single_lesson_row->id])}}">
                      Overview
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link {{ $tab1 == 'single-lesson-test' ? 'active' : '' }}" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'single-lesson', 'tab1' => 'single-lesson-test', 'single_lesson_id' => $single_lesson_row->id])}}">
                        <sup class="badge bg-primary badge-number">3</sup> Tests
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link {{ $tab1 == 'lesson-assignment' ? 'active' : '' }}" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'single-lesson', 'tab1' => 'lesson-assignment','single_lesson_id' => $single_lesson_row->id])}}">
                      <sup class="badge bg-primary badge-number">3</sup> Assignments
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
