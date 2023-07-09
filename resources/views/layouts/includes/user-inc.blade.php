
    @php 
        $image = (new Image_crop())->get_image($row->image,$row->gender);
    @endphp

    <div class="card m-2 shadow" style="max-width: 12rem; min-width:12rem;">
    <div class="card-header">{{str_replace("s", "", $page)}}</div>
    <img src="" alt="card-img-top" class="card-img-top">
    <div class="card-body">
    <h5 class="card-title">name</h5>
    <p class="card-text">rank</p>
    <a href="{{url('school/profile')}}" class="btn btn-primary btn-sm">Profile <i class="bi bi-eye"></i></a>

    @if(isset($_GET['select']))
    <button name="selected" value= "<?=$row->user_id?>" href="" class="btn btn-danger float-end">Select</button>
    @endif;
    </div>
    </div>