
    @php 
        $image = get_image($row->image,$row->gender);
    @endphp

    <div class="card m-2 shadow" style="max-width: 12rem; min-width:12rem;">
    <div class="card-header">{{str_replace("s", "", $page)}}</div>
    <img src="{{url(''.$image)}}" alt="card-img-top" class="card-img-top">
    <div class="card-body">
    <h5 class="card-title">{{ucfirst($row->firstname)}} {{ucfirst($row->lastname)}}</h5>
    <p class="card-text">{{ucfirst($row->rank)}} </p>
    <a href="{{url('profile/'.$row->user_id)}}" class="btn btn-primary btn-sm">Profile <i class="bi bi-eye"></i></a>

    @if(isset($_GET['select']))
    <button name="selected" value= "<?=$row->user_id?>" href="" class="btn btn-danger btn-sm float-end">Select</button>
    @endif
    </div>
    </div>