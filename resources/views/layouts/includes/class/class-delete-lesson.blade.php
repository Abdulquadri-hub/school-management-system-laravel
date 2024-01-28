@if ($lesson_row)
<div class="m-auto p-4" style="max-width: 500px;">
        <form method="post" class="row g-3">
            @csrf

            <div class="col-12">
                <h5 class="card-title">Lesson Title</h5>
                <input type="text" readonly name="title" value="{{old('title', $lesson_row->title)}}" class="form-control" id="" placeholder="Lesson Title">
            </div>  

            <div class="col-12">
                <a href="{{route('class.single', ['id'=> $row->id, 'tab' => 'lessons'])}}">
                    <button class="btn btn-secondary float-start btn-sm" type="button">
                        <i class="ri ri-arrow-left-circle-line"></i>
                        Back
                    </button>
                </a>
                <button class="btn btn-danger float-end btn-sm" type="submit">Delete</button>
            </div>
        </form>
    </div>

@else
   <tr>
    <td class="text-primary">No lesson data for this class</td>
   </tr>
@endif
