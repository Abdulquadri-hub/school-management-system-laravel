

    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Created By</th>
            <th scope="col">Content</th>
            <th scope="col">Date </th>
            <th scope="col">
            <a href="{{route('class.single', ['id'=> $row->id, 'tab' => 'add-lesson'])}}">
              <button class="btn btn-primary float-end btn-sm">
                <i class="bi bi-plus"></i>
                  Add New
              </button>
            </a>
            </th>
          </tr>
        </thead>
        <tbody>
          @if(isset($lesson_rows) && $lesson_rows)
          @foreach($lesson_rows as $key => $row)
          <tr>
            <th scope="row">{{$key + 1}}</th>
            <td>{{$row->title}}</td>
            <td>{{ucfirst($row->user->firstname)}} {{ucfirst($row->user->lastname)}}</td>
            <td>{{substr($row->content, 0, 30)}}...</td>
            <td>{{date("jS M, Y H:s:i",strtotime($row->created_at))}}</td>
            <td>
                <a href="{{route('class.single', ['id' => $row->class->id, 'tab' => 'delete-lesson', 'lesson_id' => $row->id])}}">
                <button class="btn btn-danger float-end me-1  btn-sm">
                    <i class="ri ri-delete-bin-6-fill"></i>
                </button>
                </a>
                
                <a href="{{route('class.single', ['id'=> $row->class->id, 'tab' => 'edit-lesson', 'lesson_id' => $row->id])}}">
                <button class="btn btn-info float-end me-1  btn-sm">
                    <i class="ri ri-edit-2-fill"></i>
                </button>
                </a>

                <a href="{{route('lesson.single', [$row->id])}}">
                <button class="btn btn-primary float-end me-1  btn-sm">
                    <i class="ri ri-eye-fill"></i>
                </button>
                </a>

            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
    </table>
    </div>