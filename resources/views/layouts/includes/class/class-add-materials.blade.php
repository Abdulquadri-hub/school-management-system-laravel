<div class="m-auto p-4" style="max-width: 500px;">
        <form method="post" class="row g-3" enctype="multipart/form-data">
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
                <h5 class="card-title">File Name</h5>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="File Name">
            </div>  

            <div class="col-12">
                <h5 class="card-title">Upload Material For This Class/Course</h5>
                <input type="file" name="file" value="{{old('file')}}" class="form-control">
            </div>  

            <div class="col-12">
                <a href="{{route('class.single', ['id'=> $row->id, 'tab' => 'materials'])}}">
                    <button class="btn btn-secondary float-start btn-sm" type="button">
                        <i class="ri ri-arrow-left-circle-line"></i>
                        Back
                    </button>
                </a>
                <button class="btn btn-primary float-end btn-sm" type="submit">Upload</button>
            </div>
        </form>
    </div>