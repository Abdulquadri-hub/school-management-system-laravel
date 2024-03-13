<div class="m-auto p-4" style="max-width: 400px;">
        <form method="post" class="row g-3">
            @csrf

            @if(count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show p-4" role="alert">
                @foreach($errors->all() as $error)
                <i class="bi bi-exclamation-octagon me-1"></i>
                {{$error}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                @endforeach
            </div>
            @endif

            <div class="col-12">
                <input type="text" name="instructor" value="{{old('instructor')}}" class="form-control" id="" placeholder="Search for instructor">
            </div>  

            <div class="col-12">
                <a href="{{route('class.single', ['id'=> $row->id, 'tab' => 'instructors'])}}">
                    <button class="btn btn-secondary float-start btn-sm" type="button">
                        <i class="ri ri-arrow-left-circle-line"></i>
                        Back
                    </button>
                </a>
                <button name="search" class="btn btn-primary float-end btn-sm" type="submit">search</button>
            </div>

            @if(isset($rows) && $rows)
            @foreach($rows as $row)               
                @include('layouts.includes.user-inc')
            
            @endforeach
            @else
                <h6 class="text-center text-muted">No instructor were found at this time!</h6>
            @endif
        </form>
        </div>
