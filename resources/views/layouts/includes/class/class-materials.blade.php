

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">File Name</th>
            <th scope="col">Uploaded By</th>
            <th scope="col">File</th>
            <th scope="col">Date </th>
            <th scope="col">
            <a href="{{route('class.single', ['id'=> $row->id, 'tab' => 'add-materials'])}}">
              <button class="btn btn-primary float-end btn-sm">
                <i class="bi bi-plus"></i>
                  Upload New Material
              </button>
            </a>
            </th>
          </tr>
        </thead>
        <tbody>
          @if(isset($material_rows) && $material_rows)
          @foreach($material_rows as $key => $row)
          <tr>
            <th scope="row">{{$key + 1}}</th>
            <td>{{$row->name}}</td>
            <td>{{ucfirst($row->user->firstname)}} {{ucfirst($row->user->lastname)}}</td>
            <td><object data="{{ asset('storage/' . $row->file) }}" width="40" height="40"></object></td>
            <td>{{date("jS M, Y H:s:i",strtotime($row->created_at))}}</td>
            <td>
                <a href="{{route('class.single', ['id' => $row->class->id, 'tab' => 'delete-material', 'material_id' => $row->id])}}">
                <button class="btn btn-danger float-end me-1  btn-sm">
                    <i class="ri ri-delete-bin-6-fill"></i>
                </button>
                </a>
                
                <a href="{{route('class.single', ['id'=> $row->class->id, 'tab' => 'edit-material', 'material_id' => $row->id])}}">
                <button class="btn btn-info float-end me-1  btn-sm">
                    <i class="ri ri-edit-2-fill"></i>
                </button>
                </a>

                <a href="{{ asset('storage/' . $row->file) }}">
                <button class="btn btn-primary float-end me-1  btn-sm">
                    <i class="ri ri-download-fill"></i>
                </button>
                </a>

            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
    </table>
    </div>