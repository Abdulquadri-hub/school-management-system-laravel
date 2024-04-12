<div class="row mt-5">
        @if(isset($assignments) && $assignments)
          @foreach($assignments as $key => $row)
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">

            <div class="card-body">
              
              <h5 class="card-title">
                <th scope="row">#{{$key + 1}}</th> {{ ucfirst($row->title) }}
              </h5>

              <h5 class="">
                  {{ucfirst($row->firstname)}} {{ucfirst($row->lastname)}}
              </h5>

              <h6 class="">
                  {{ucfirst($row->rank)}}
              </h6>

              <h6 class="mt-2 mb-2">
                {{date("jS M, Y H:s:i",strtotime($row->created_at))}}
              </h6>

              <hr>

              <h6 class="mt-2 mb-3" style="width: 200x; height:100x;">
                {!! substr($row->content, 0, 550) !!} ...
              </h6>

              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">

                @if ($rank->hasRank('instructor')) 
                <a href="{{route('class.single', ['id'=> $row->classid, 'tab' => 'single-lesson','single_lesson_id' => $single_lesson_row->id, 'tab1' => 'delete-lesson-assignment', 'asgn_id' => $row->id])}}">
                <button class="btn btn-danger float-end me-1  btn-sm">
                    <i class="ri ri-delete-bin-6-fill"></i>
                </button>
                </a>
                
                <a href="{{route('class.single', ['id'=> $row->classid, 'tab' => 'single-lesson','single_lesson_id' => $single_lesson_row->id, 'tab1' => 'edit-lesson-assignment', 'asgn_id' => $row->id])}}">
                <button class="btn btn-info float-end me-1  btn-sm">
                    <i class="ri ri-edit-2-fill"></i>
                </button>
                </a>

              @endif
                <a href="{{route('class.single', ['id'=> $row->classid, 'tab' => 'single-lesson', 'single_lesson_id' => $single_lesson_row->id, 'tab1' => 'single-lesson-assignment', 'asgn_id' => $row->id, 'read-asgn' => 'true'])}}">
                <button class="btn btn-primary float-end me-1  btn-sm">
                    <i class="ri ri-eye-fill"></i>
                </button>
                </a>

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