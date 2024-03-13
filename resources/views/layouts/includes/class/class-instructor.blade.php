@if ($rank->hasRank('admin')) 
<a href="{{route('class.single', ['id'=> $row->id, 'tab' => 'remove-instructor', 'select' => 'true'])}}">
    <button class="btn btn-dark float-end mt-2 btn-sm ms-2">
    <i class="bi bi-minus"></i>
        Remove 
    </button>
</a>

<a class="" href="{{route('class.single', ['id'=> $row->id, 'tab' => 'add-instructor', 'select' => 'true'])}}">
    <button class="btn btn-primary float-end mt-2 btn-sm">
    <i class="bi bi-plus"></i>
        Add 
    </button>
</a>
@endif

<div class="card-group">
@if(isset($instructor_rows) && $instructor_rows)
@foreach($instructor_rows as $row)                
    @include('layouts.includes.user-inc')
            
@endforeach
@else
    <h6 class="text-center text-muted m-auto">No instructor were found at this time!</h6>
@endif
</div>