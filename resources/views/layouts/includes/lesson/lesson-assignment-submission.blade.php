<div class="row mt-5">
        @if(isset($lesson_assignment_submissions ) && $lesson_assignment_submissions )
          @foreach($lesson_assignment_submissions  as $key => $row)
        <div class="col-xxl-4 col-md-12">
          <div class="card info-card sales-card">

            <div class="card-body">
              
              <h5 class="card-title">
                <th scope="row">#{{$key + 1}}</th> {{ "Assignment Submission" }}
              </h5>

              <h5 class="">
                  {{ucfirst($row->firstname)}} {{ucfirst($row->lastname)}}
              </h5>

              <h6 class="">
                  Rank | {{ucfirst($row->rank)}}
              </h6>

              <h6 class="mt-2 mb-2">
                Submitted at | 
                {{date("jS M, Y H:s:i",strtotime($row->created_at))}}
              </h6>

              <h6 class="mt-2 mb-2">
                Grade |  {{$row->grade . "%" ?? "No Grade"}}
              </h6>

              <hr>

              <h6 class="mt-2 mb-3" style="width: 200x; height:100x;">
                {!! $row->assignment_link !!} 
              </h6>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                @if ($rank->hasRank('instructor')) 
                <!-- <a href="{{route('class.single', ['id'=> $row->classid, 'tab' => 'single-lesson','single_lesson_id' => $single_lesson_row->id, 'tab1' => 'delete-lesson-assignment', 'asgn_id' => $row->id])}}">
                <button class="btn btn-danger float-end me-1  btn-sm">
                    <i class="ri ri-delete-bin-6-fill"></i>
                </button>
                </a> -->
                
                <!-- <a href="{{route('class.single', ['id'=> $row->classid, 'tab' => 'single-lesson','single_lesson_id' => $single_lesson_row->id, 'tab1' => 'grade-lesson-assignment', 'asgn_id' => $row->id])}}"> -->
                <button class="btn btn-info float-end me-1  btn-sm" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                    <i class="ri ri-edit-2-fill"></i> Grade
                </button>
                <div class="modal fade" id="verticalycentered" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Grade</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post">
          @csrf
        <div class="modal-body">
          <input type="text" name="assignment_sub_id" hidden value="{{ucfirst($row->assignment_sub_id)}}" class="form-control" placeholder = "Grade">
          <input type="text" name="assignment_id" hidden value="{{ucfirst($row->assignment_id)}}" class="form-control" placeholder = "Grade">
          <input type="text" name="grade" value="" class="form-control" placeholder = "Grade">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm btn-outline-dark">Save</button>
        </div>
        </form>
      </div>
    </div>
</div>
                <!-- </a> -->
              <!-- 
                <a href="{{route('class.single', ['id'=> $row->classid, 'tab' => 'single-lesson', 'single_lesson_id' => $single_lesson_row->id, 'tab1' => 'single-lesson-assignment', 'asgn_id' => $row->id, 'read-asgn' => 'true'])}}">
                <button class="btn btn-primary float-end me-1  btn-sm">
                    <i class="ri ri-eye-fill"></i>
                </button>
                </a> -->
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
        <p class="text-center text-muted m-auto">No assignment was found for this lesson at this time!</p>
        @endif
</div>



