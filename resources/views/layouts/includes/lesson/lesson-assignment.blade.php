@if ($rank->hasRank('instructor')) 
  <a href="{{route('class.single', ['id'=> $row->id, 'tab' => 'single-lesson','single_lesson_id' => $single_lesson_row->id, 'tab1' => 'add-lesson-assignment'])}}">
      <button class="btn btn-primary float-end btn-sm">
        <i class="bi bi-plus"></i>
          Add New
      </button>
  </a>
@endif

<main id="" class="mt-4">

@if(isset($assignment) && $assignment)
<!-- <div class="pagetitle">
  <h1> Assignment <i class="bi bi-chevron-right"></i> {{$assignment->title}}</h1>
</div> -->
<!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="">
        <div class="card-body">
            {!! $assignment->description !!} 
 
            
            
            <form action="" method="post" class="row">
              @csrf
              <p class="text-muted mb-2">Github link to your assignment</p>
              <div class="col-7">
                <input type="text" hidden name="assignment_id" value="{{ $assignment->assignment_id }}">
                <input type="text" name="assignment_link" class="form-control" placeholder="abdulquadri.github.com/assignment-link">
              </div>
              <div class="col-5">
                <button class="btn btn-outline-dark">Submit</button>
              </div>
            </form>

        </div>
        
      </div>

    </div>
  </div>
</section>            
@else
                
@endif


</main>