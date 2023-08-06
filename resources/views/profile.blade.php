@include('layouts.header')
@include('layouts.nav')


<main id="main" class="main">

<div class="pagetitle">
  <h1>{{$page}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
      <li class="breadcrumb-item">Pages</li>
      <li class="breadcrumb-item"><a href="{{url('/users')}}">Users</a></li>
      <li class="breadcrumb-item active">{{$page}}</li>
    </ol>
  </nav>
</div>

@if(isset($row) && $row)
<section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            @php 
                $image = get_image($row->image,$row->gender);
            @endphp

              <img src="{{url(''.$image)}}" alt="Profile" class="rounded-circle">
              <h2>{{ucfirst($row->firstname)}} {{ucfirst($row->lastname)}}</h2>
              <h3>{{strtoupper($row->rank)}}</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                <a href="{{url('/profile/'.$row->user_id. '?tab=view')}}">
                  <button class="nav-link" data-bs-toggle="" data-bs-target="">Overview</button>
                </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('/profile/'.$row->user_id. '?tab=edit')}}">
                    <button class="nav-link" data-bs-toggle="" data-bs-target="">
                    Edit Profile
                   </button>
                    </a>
                </li>

                <li class="nav-item">
                <a href="{{url('/profile/'.$row->user_id. '?tab=class')}}">
                  <button class="nav-link" data-bs-toggle="" data-bs-target="">Class</button>
                </a>
                </li>

                <li class="nav-item">
                <a href="{{url('/profile/'.$row->user_id. '?tab=test')}}">
                  <button class="nav-link" data-bs-toggle="" data-bs-target="#profile-test">Test</button>
                </a>
                </li>

                <li class="nav-item">
                <a href="{{url('/profile/'.$row->user_id . '?tab=change-password')}}">
                  <button class="nav-link" data-bs-toggle="" data-bs-target="#profile-change-password">Change Password</button>
                </a>
                </li>
                
              </ul>
            
              <div class="tab-content pt-2">

              @if($tab == 'view' || $tab == "")

                <div class="active profile-overview" >
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{ucfirst($row->firstname)}} {{ucfirst($row->lastname)}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{strtolower($row->email)}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8">{{ucfirst($row->gender)}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Rank</div>
                    <div class="col-lg-9 col-md-8">{{ucfirst($row->rank)}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date Created</div>
                    <div class="col-lg-9 col-md-8">{{get_date($row->created_at)}}</div>
                  </div>

                </div>

              @elseif($tab === 'edit')
                <!-- edit Profile -->
                <div class="pt-3">
                  <!-- Profile Edit Form -->
                  <form method="post",  enctype="multipart/form-data">
                  @csrf

                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img id="preview" src="{{url(''.$image)}}" class="image-fluid rounded-circle w-50" alt="Profile">
                        <!--  -->
                      <div class="pt-2">
                        <input type="file" onchange="showPreview(event)" id="selectImage" hidden class="form-control image-js">
                          <label for="selectImage" id="selectImage" class="btn btn-primary btn-sm" title="Upload new profile image">
                            <i class="bi bi-upload"  id="upload"></i>
                          </label>
                        <button class="btn btn-danger btn-sm" title="Remove my profile image" >
                            <i class="bi bi-trash"></i>
                        </button>
                      </div>
                      </div>
                    </div>

                    @if(count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show p-2" role="alert">
                      @foreach($errors->all() as $error)
                      <i class="bi bi-exclamation-octagon me-1"></i>
                      {{$error}}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      @endforeach
                    </div>
                    @endif

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstname" type="text" class="form-control" id="fullName" value="{{$row->firstname}}">
                      </div>
                    </div>

                    <!-- firstname -->
                    <div class="row mb-3">
                      <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastname" type="text" class="form-control" id="lastname" value="{{$row->lastname}}">
                      </div>
                    </div>

                    <!-- lastname -->
                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="text" class="form-control" id="company" value="{{$row->email}}">
                      </div>
                    </div>

                    <!-- Rank -->
                    <div class="row mb-3">
                      <label for="rank" class="col-md-4 col-lg-3 col-form-label">Rank</label>
                      <div class="col-md-8 col-lg-9">
                      <select class="form-select" name="rank">
                        <option selected value = "{{$row->rank}}">{{$row->rank}}</option>
                        <option value="lecturer">Lecturer</option>
                        <option value="parent">Parent</option>
                        <option value="admin">Admin</option>
                        <option value="reception">Reception</option>
                        <option value="super admin">Super Admin</option>
                      </select>
                      </div>
                    </div>

                    <!-- gender -->
                    <div class="row mb-3">
                      <label for="rank" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                      <div class="col-md-8 col-lg-9">
                      <select class="form-select" name="gender">
                        <option selected value = "{{$row->gender}}">{{$row->gender}}</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-sm btn-primary shadow">Save Changes</button>
                    </div>
                  </form>

                </div>

              @elseif($tab == 'class')

              <div class="pt-3">
                  <!-- class Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

              </div>

              @elseif($tab == 'test')

                <div class="pt-3">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

              @elseif($tab == 'change-password')

                <div class="pt-3">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              @endif

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
      </section>

    @else
        <h6>This user profile is not found at this time!</h6>
    @endif

</main>

@include('layouts.footer')

<script>

function showPreview(event){
  if(event.target.files.length > 0){
    var src = URL.createObjectURL(event.target.files[0]);
    var preview = document.getElementById("preview");
    preview.src = src;
  }
}

</script>
