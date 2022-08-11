@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br>
                <img class="card-img-top" style="border-radius: 50%" src="{{(!empty(Auth::user()->profile_photo_path))? url
                ('upload/user_images/'.Auth::user()->profile_photo_path): url('upload/no_image.jpg')}}" height="100%" width="100%"><br><br>
                <ul class="list-group list-group-flush">
                    <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home
                    </a> 
                    <a href="{{route ('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update
                    </a>
                    <a href="{{route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password
                    </a>
                    <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout
                    </a>
                </ul>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-6">
                <div>
                    <h3 class="text-center"><span class="text-primary">Hi...<strong>{{Auth::user()->name}}</strong>
                    Update Your Profile</span></h3>
                <div class="card-body">
                    <form method="post" action="{{route('user.profile.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" >Name <span></span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}" >
                        </div>
                        <div class="form-group">
                            <label class="info-title" >Email <span></span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}">
                        </div>
                        <div class="form-group">
                            <label class="info-title" >Phone <span></span></label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{Auth::user()->phone}}">
                        </div>
                        <div class="form-group">
                            <label class="info-title" >User Image <span></span></label>
                            <input type="file" class="form-control" id="profile_photo_path" name="profile_photo_path" >
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                    </form>

                </div>

                </div>

            </div>
            
        </div>
    </div>

</div>

@endsection