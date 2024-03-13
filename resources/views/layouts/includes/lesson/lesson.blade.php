
@if ($rank->hasRank('instructor')) 
  <a href="{{route('class.single', ['id'=> $row->id, 'tab' => 'add-lesson'])}}">
      <button class="btn btn-primary float-end btn-sm mt-2">
        <i class="bi bi-plus"></i>
          Add New
      </button>
  </a>
@endif




    <div class="row mt-5">
        @if(isset($lessons_rows) && $lessons_rows)
          @foreach($lessons_rows as $key => $row)
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
                <a href="{{route('class.single', ['id' => $row->classid, 'tab' => 'delete-lesson', 'lesson_id' => $row->id])}}">
                <button class="btn btn-danger float-end me-1  btn-sm">
                    <i class="ri ri-delete-bin-6-fill"></i>
                </button>
                </a>
                
                <a href="{{route('class.single', ['id'=> $row->classid, 'tab' => 'edit-lesson', 'lesson_id' => $row->id])}}">
                <button class="btn btn-info float-end me-1  btn-sm">
                    <i class="ri ri-edit-2-fill"></i>
                </button>
                </a>

              @endif
                <a href="{{route('class.single', ['id'=> $row->classid, 'tab' => 'single-lesson', 'single_lesson_id' => $row->id, 'read' => 'true'])}}">
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
        <p class="text-center text-muted m-auto">No Lesson was found for this class at this time!</p>
        @endif
        </div>