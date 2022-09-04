@extends('admin.admin_master');
@section('admin')


  
  <!-- Content Wrapper. Contains page content -->
  
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<!-- Main content -->

        <!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Order Details</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Order Details</li>
								
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<section class="content">
		  <div class="row">

		<!--Bordered box!-->
         <div class="col-md-6 col-12">
            <div class="box box-bordered border-primary">
              <div class="box-header with-border">
                <h4 class="box-title"><strong>Shipping Details</strong> </h4>
              </div>
              <table class="table">
                <tr>
                    <th>Shipping Name:  </th>
                    <th>{{$order->name}} </th>
                </tr>
                <tr>
                    <th>Shipping Phone: </th>
                    <th>{{$order->phone}} </th>
                </tr>
                <tr>
                    <th>Shipping Email: </th>
                    <th>{{$order->email}} </th>
                </tr>
                <tr>
                    <th>Division: </th>
                    <th>{{$order->division->division_name}} </th>
                </tr>
                <tr>
                    <th>District: </th>
                    <th>{{$order->district->district_name}} </th>
                </tr>
                <tr>
                    <th>State </th>
                    <th>{{$order->state->state_name}} </th>
                </tr>
                <tr>
                    <th>Post Code </th>
                    <th>{{$order->post_code}} </th>
                </tr>
                <tr>
                    <th>Order Date </th>
                    <th>{{$order->order_date}} </th>
                </tr>
            </table>
            </div>
          </div>

          <!--Bordered box!-->
         <div class="col-md-6 col-12">
            <div class="box box-bordered border-primary">
              <div class="box-header with-border">
                <h4 class="box-title"><strong>Order Details</strong> <span class="text-danger">Invoice : {{$order->invoice_no}}</span> </h4>
                
              </div>
              
              <table class="table">
                <tr>
                    <th>Name:  </th>
                    <th>{{$order->user->name}} </th>
                </tr>
                <tr>
                    <th>Phone: </th>
                    <th>{{$order->user->phone}} </th>
                </tr>
                <tr>
                    <th>Payment Type: </th>
                    <th>{{$order->payment_method}} </th>
                </tr>
                <tr>
                    <th>Transaction ID: </th>
                    <th>{{$order->transaction_id}} </th>
                </tr>
                <tr>
                    <th>Invoice: </th>
                    <th class="text-danger"> {{$order->invoice_no}} </th>
                </tr>
                <tr>
                    <th>Order Total </th>
                    <th>{{$order->amount}} €</th>
                </tr>
                <tr>
                    <th>Order </th>
                    <th><span class="badge badge-pill badge-warning" style="background: #418DB9">{{$order->status}}</span> </th>
                </tr>
               
                <tr>
                    <th> </th>
                    <th>
                        @if($order->status == 'Pending')
                            <a href="{{route('pending-confirm',$order->id)}}" class="btn btn-block btn-success" id="confirm">Confirmed Order</a>
                        @elseif($order->status == 'confirm')
                        <a href="{{route('confirm.processing',$order->id)}}" class="btn btn-block btn-success" id="processing">Processing Order</a>
                        @elseif($order->status == 'processing')
                        <a href="{{route('processing.picked',$order->id)}}" class="btn btn-block btn-success" id="picked">Picked Order</a>
                        @elseif($order->status == 'picked')
                        <a href="{{route('picked.shipped',$order->id)}}" class="btn btn-block btn-success" id="shipped">Shipp Order</a>
                        @elseif($order->status == 'shipped')
                        <a href="{{route('shipped.delivered',$order->id)}}" class="btn btn-block btn-success" id="delivered">Delivered Order</a>

                        @endif
                    </th>
                </tr>

            </table>
            </div>
          </div>

          <!--Bordered box!-->
         <div class="col-md-12 col-12">
            <div class="box box-bordered border-primary">
              <div class="box-header with-border">
              </div>
              <table class="table">
                <tr>
                    <td width="10%">
                        <label for="">Image </label>
                    </td>
                    <td width="20%">
                        <label for="">Product Name </label>
                    </td>
                    <td width="10%">
                        <label for="">Product Code </label>
                    </td>
                    <td width="10%">
                        <label for="">Color </label>
                    </td>
                    <td width="10%">
                        <label for="">Size </label>
                    </td>
                    <td width="10%">
                        <label for="">Quantity </label>
                    </td>
                    <td width="10%">
                        <label for="">Price </label>
                    </td>
                </tr>
                @foreach($order_item as $order)
                <tr>
                    <td width="10%">
                        <label for=""><img src="{{asset($order->product->product_thambnail)}}" height="50px;" width="50px;"></label>
                    </td>
                    <td width="20%">
                        <label for="">{{$order->product->product_name_en}} </label>
                    </td>
                    <td width="10%">
                        <label for="">{{$order->product->product_code}} </label>
                    </td>
                    <td width="10%">
                        <label for="">{{$order->color}} </label>
                    </td>
                    <td width="10%">
                        <label for="">{{$order->size}} </label>
                    </td>
                    <td width="10%">
                        <label for="">{{$order->qty}} </label>
                    </td>
                    <td width="10%">
                        <label for="">{{$order->price}} ({{$order->price * $order->qty}}) €</label>
                    </td>
                    
                    
                </tr>
                @endforeach
            </table>
            </div>
          </div>


		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  
  <!-- /.content-wrapper -->


@endsection