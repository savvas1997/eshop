@extends('frontend.main_master')
@section('content')

<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common.user_sidebar')
            <div class="col-md-2">
   
            </div>
            <div class="col-md-6">
                <div>
                    <h3 class="text-center"><span class="text-primary">Hi...<strong>{{Auth::user()->name}}</strong>
                    Welcome to our Shop</span></h3>
                </div>

            </div>
            
        </div>
    </div>

</div>

@endsection