@extends('admin.admin_master');
@section('admin')


  
  <!-- Content Wrapper. Contains page content -->
  
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Coupon List <span class="badge badge-pill badge-danger">{{count($coupons)}}</span></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								
                                <th>Coupon Name </th>
                                <th>Coupon Discount </th>
                                <th>Coupon Validity </th>
                                <th>Coupon Status </th>
							
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($coupons as $item)
                            <tr>
                               
								
								<td>{{$item->coupon_name}}</td>
								<td>{{$item->coupon_discount}}</td>
								<td width="30%">
                                    {{Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y')}}
                                </td>
                                <td >
									{{-- {{$item->status}} --}}
									@if($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
										<span class="badge badge-pill badge-success">Valid</span>
										@else
										<span class="badge badge-pill badge-danger">InValid</span>

									@endif
								</td>
								<td width="25%">
                                    <a href="{{route('edit.coupon',$item->id)}}" class="btn btn-info" title="Edit Coupon"><i class="fa fa-pencil" ></i></a>
                                    <a href="{{route('coupon.delete',$item->id)}}" id="delete" class="btn btn-danger" title="Delete Data"><i class="fa fa-trash" ></i></a>
                                </td>
							</tr>
							
                            @endforeach
							
						</tbody>
						
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
		         
			</div>
			<!-- /.col -->

            {{-- Add Brand  --}}
            <div class="col-4">

                <div class="box">
                   <div class="box-header with-border">
                     <h3 class="box-title">ADD Coupon</h3>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                        <form method="post" action="{{route('coupon.store')}}">
                            @csrf
                        
                                <div class="form-group">
                                    <h5>Coupon Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  type="text" name="coupon_name" class="form-control" required="" > 
                                        @error('coupon_name') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Coupon Discount(%) <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  type="text" name="coupon_discount" class="form-control" required="" > 
                                        @error('coupon_discount') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Coupon Validity Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  type="date" name="coupon_validity" class="form-control" required="" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" > 
                                        @error('coupon_validity') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                               <div class="text-xs-right">
                                  <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                               </div>
                               
                           </form>
                       </div>
                   </div>
                   <!-- /.box-body -->
                 </div>
                    
               </div>

		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  
  <!-- /.content-wrapper -->


@endsection