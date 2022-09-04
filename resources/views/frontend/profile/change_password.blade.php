@extends('frontend.main_master')
@section('content')
<!-- @php
$user = DB::table('users')->where('id',Auth::user()->id)->first();

@endphp -->
<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')
            <div class="col-md-2">

            </div>
            <div class="col-md-6">
                <div>
                    <h3 class="text-center"><span class="text-primary">Hi...<strong>{{Auth::user()->name}}</strong>
                    Update Your Profile</span></h3>
                <div class="card-body">
                    <form method="post" action="{{route('user.password.update')}}">
                        @csrf
                        <div class="form-group">
                            <label class="info-title" >Current Password <span></span></label>
                            <input type="password" class="form-control" id="current_password" name="oldpassword" >
                        </div>
                        <div class="form-group">
                            <label class="info-title" >New Password <span></span></label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label class="info-title" >Current Password <span></span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
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