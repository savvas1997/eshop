@extends('frontend.main_master')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


@section('title')
My Cart Page 
@endsection


<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="home.html">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb --> 



<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	

	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		

                <div class="col-md-6 col-sm-6 already-registered-login">
					<h4 class="checkout-subtitle"><b>Shipping Address<b></h4>
					<form class="register-form" action="{{route('checkout.store')}}" method="POST">

                        @csrf

						<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Shipping User Name <span>*</span></label>
					    <input type="text" name="shipping_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Full Name" value="{{Auth::user()->name}}" required="">
					  </div>

                      <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Shipping Email <span>*</span></label>
					    <input type="email" name="shipping_email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Email" value="{{Auth::user()->email}}" required="">
					  </div>

                      <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Shipping Phone <span>*</span></label>
					    <input type="text" name="shipping_phone" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Phone" value="{{Auth::user()->phone}}" required="">
					  </div>
                      
                      <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Postal Code <span>*</span></label>
					    <input type="text" name="post_code" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="Post Code" required="">
					  </div>

                   
				</div>	

				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login">
					
					<div class="form-group">
                        <h5>Division Select <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="division_id" required="" class="form-control">
                                <option value="" selected="" disabled="">Select Division</option>
                                @foreach($divisions as $item)
                                <option value="{{$item->id}}" >{{$item->division_name}}</option>
                                @endforeach
                            </select>
                            @error('division_id') 
                                <span class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>District Select <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="district_id" required="" class="form-control">
                                <option value="" selected="" disabled="">Select District</option>
                                
                            </select>
                            @error('district_id') 
                                <span class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>State Select <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="states_id" required="" class="form-control">
                                <option value="" selected="" disabled="">Select State</option>
                               
                            </select>
                            @error('division_id') 
                                <span class="text-danger">{{$message}} </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Notes <span>*</span></label>
					    <textarea class="form-control" cols="30" rows="5" placeholder="Notes" name="notes"></textarea>
					  </div>
					
					
				</div>	
				<!-- already-registered-login -->		

			</div>			
		</div>
		<!-- panel-body  -->

	</div><!-- row -->
</div>
<!--????D checkout-step-01  -->
				
					  	
					</div><!-- /.checkout-steps -->
				</div>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
		    	<h4 class="unicase-checkout-title">Your Checkout Progress</h4>
		    </div>
		    <div class="">
				<ul class="nav nav-checkout-progress list-unstyled">
                    @foreach ($carts as $item)
                        <li>
                            <strong>
                                Image:
                            </strong>
                            <img src="{{asset($item->options->image)}}" style="height: 50px; width:50px;">
                        
                            <strong>
                                Qty:
                            </strong>
                           ( {{$item->qty}} )
                            
                       
                            <strong>
                                Color:
                            </strong>
                            {{$item->options->color}}
                            
                        
                            <strong>
                                Color:
                            </strong>
                            {{$item->options->size}}
                            
                        </li>
                        <br>
                    @endforeach
					<hr>
                        <li> 
                            @if(Session::has('coupon'))
                            <strong> SubTotal: </strong>{{$cartTotal}} <hr>
                            <strong>Coupon Name: </strong> {{session()->get('coupon')['coupon_name']}}
                            ( {{session()->get('coupon')['coupon_discount']}} %)
                            <hr>
                            <strong>Coupon Discount: </strong> {{session()->get('coupon')['discount_amount']}} ???
                            <hr>
                            <strong>GrandTotal: </strong> {{session()->get('coupon')['total_amount']}} ???
                            <hr>
                            @else
                            <strong> SubTotal: </strong>{{$cartTotal}} <hr>
                            <strong> GrandTotal: </strong>{{$cartTotal}} <hr>
                            @endif
                        </li>

				</ul>		
			</div>
		</div>
	</div>
</div> 
<!-- checkout-progress-sidebar -->				</div>




<div class="col-md-4">
    <!-- checkout-progress-sidebar -->
    <div class="checkout-progress-sidebar ">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4 class="unicase-checkout-title">Select Payment Method</h4>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Stripe</label>
                        <input type="radio" name="payment_method" value="stripe">
                        <img src="{{asset('frontend/assets/images/payments/4.png')}}">

                    </div>

                    <div class="col-md-4">
                        <label for="">Cart</label>
                        <input type="radio" name="payment_method" value="cart">
                        <img src="{{asset('frontend/assets/images/payments/3.png')}}">

                    </div>

                    <div class="col-md-4">
                        <label for="">Cash</label>
                        <input type="radio" name="payment_method" value="Cash">
                        <img src="{{asset('frontend/assets/images/payments/2.png')}}">

                    </div>

                   
                </div> 
                <hr>
                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment Step</button>

            </div>
        </div>
    </div> 
<!-- checkout-progress-sidebar -->				
</div>

</form>



			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">

	
	
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	
    </div><!-- /.container -->
</div><!-- /.body-content -->



<script type="text/javascript">
    $(document).ready(function() {
      $('select[name="division_id"]').on('change', function(){
          var division_id = $(this).val();
          if(division_id) {
              $.ajax({
                  url: "{{  url('/district-get/ajax') }}/"+division_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                    
                    $('select[name="states_id"]').empty();

                    var d =$('select[name="district_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                        });
                  },
              });
          } else {
              alert('danger');
          }
      });

      $('select[name="district_id"]').on('change', function(){
          var district_id = $(this).val();
          if(district_id) {
              $.ajax({
                  url: "{{  url('/state-get/ajax') }}/"+ district_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                     var d =$('select[name="states_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="states_id"]').append('<option value="'+ value.id +'">' + 
                                value.state_name + '</option>');
                        });
                  },
              });
          } else {
              alert('danger');
          }
      });

  });
  </script>

@endsection