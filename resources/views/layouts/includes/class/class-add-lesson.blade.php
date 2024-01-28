    <div class="m-auto p-4" style="max-width: 500px;">
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
                <h5 class="card-title">Lesson Title</h5>
                <input type="text" name="title" value="{{old('title')}}" class="form-control" id="" placeholder="Lesson Title">
            </div>  

            <div class="col-12">
                <div class="">
                    <div class="">
                        <h5 class="card-title">Lesson Content</h5>
                        <textarea name="content" class="form-control" placeholder="Lesson Content here..."></textarea>
                    </div>
                </div>           
            </div>

            <div class="col-12">
                <a href="{{route('class.single', ['id'=> $row->id, 'tab' => 'lessons'])}}">
                    <button class="btn btn-secondary float-start btn-sm" type="button">
                        <i class="ri ri-arrow-left-circle-line"></i>
                        Back
                    </button>
                </a>
                <button class="btn btn-primary float-end btn-sm" type="submit">Save</button>
            </div>
        </form>
    </div>

<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  });
</script>