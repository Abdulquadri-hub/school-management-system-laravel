@if ($rank->hasRank('admin'))
<a href="{{route('class.single', ['id'=> $row->id, 'tab' => 'remove-enrolled-student', 'select' => 'true'])}}">
    <button class="btn btn-outline-dark float-end mt-2 btn-sm ms-2">
    <i class="bi bi-minus"></i>
        Remove Enrolled Student
    </button>
</a>
@endif

<div class="card-group">
@if(isset($enrolled_student_rows) && $enrolled_student_rows)
@foreach($enrolled_student_rows as $row)                
    @include('layouts.includes.user-inc')
            
@endforeach
@else
    <h6 class="text-center text-muted m-auto mt-5">No Enrolled Student were found at this time!</h6>
@endif
</div>