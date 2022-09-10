@extends('admin.admin_master');
@section('admin')


  
  <!-- Content Wrapper. Contains page content -->
  
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Total Admin User</h3>
                  <a href="{{route('add.admin')}}" class="btn btn-danger" style="float:right;">Add Admin User</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								
                                <th>Image </th>
                                <th>Name </th>
                                <th>Email </th>
                                <th>Phone </th>
                                <th>Access </th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($adminuser as $item)
                            <tr>
                               
								
								<td><img src={{asset($item->profile_photo_path)}} width="60px;" height="60px;"></td>
								<td>{{$item->name}}</td>
								<td >{{$item->email}}</td>
                                <td >{{$item->phone}}</td>
                                <td>
                                    @if($item->brand == 1)
                                        <span class="badge badge-primary">Brand</span>
                                    @else


                                    @endif
                                    @if($item->category == 1)
                                        <span class="badge badge-warning">category</span>
                                    @else


                                    @endif
                                    @if($item->product == 1)
                                        <span class="badge badge-primary">Product</span>
                                    @else


                                    @endif
                                    @if($item->slider == 1)
                                        <span class="badge badge-warning">Slider</span>
                                    @else


                                    @endif
                                    @if($item->coupons == 1)
                                        <span class="badge badge-primary">Coupons</span>
                                    @else


                                    @endif
                                    @if($item->shipping == 1)
                                        <span class="badge badge-warning">Shipping</span>
                                    @else


                                    @endif
                                    @if($item->blog == 1)
                                        <span class="badge badge-primary">Blog</span>
                                    @else


                                    @endif
                                    
                                    @if($item->setting == 1)
                                        <span class="badge badge-primary">Setting</span>
                                    @else


                                    @endif
                                    @if($item->returnorder == 1)
                                        <span class="badge badge-secondary">Return Order</span>
                                    @else


                                    @endif
                                    @if($item->review == 1)
                                        <span class="badge badge-warning">Review</span>
                                    @else


                                    @endif
                                    @if($item->orders == 1)
                                        <span class="badge badge-secondary">Orders</span>
                                    @else


                                    @endif
                                    @if($item->stock == 1)
                                        <span class="badge badge-warning">Stock</span>
                                    @else


                                    @endif
                                    @if($item->reports == 1)
                                        <span class="badge badge-secondary">Reports</span>
                                    @else


                                    @endif
                                    @if($item->alluser == 1)
                                    <span class="badge badge-info">AllUsers</span>
                                    @else


                                    @endif
                                    @if($item->adminuserrole == 1)
                                        <span class="badge badge-secondary">AdminUserRole</span>
                                    @else


                                    @endif

                                </td>
								<td width="25%">
            <a href="{{route('edit.admin.user',$item->id)}}" class="btn btn-info" title="Edit"><i class="fa fa-pencil" ></i></a>
            <a href="{{route('delete.admin.user',$item->id)}}" id="delete" class="btn btn-danger" title="Delete"><i class="fa fa-trash" ></i></a>
        
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


		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  
  <!-- /.content-wrapper -->


@endsection