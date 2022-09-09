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
				  <h3 class="box-title">Pending Reviews</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Summary </th>
                                <th>Comment </th>
                                <th>Product Name </th>
                                <th>User Name </th>
                                <th>Status </th>
							
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($review as $item)
                            <tr>
                               
								
								<td>{{$item->summary}}</td>
								<td>{{$item->comment}}</td>
								
                                <td >{{$item->product->product_name_en}}</td>
								<td >{{$item->user->name}}</td>
                                <td >
                                    @if($item->status == 0)
                                    <span class="badge badge-pill badge-primary">Pending</span>
                                    @elseif($item->status == 1)
                                    <span class="badge badge-pill badge-success">Published</span>

                                    @endif
                                
                                
                                </td>
								<td width="25%">
                                   <a href="{{route('review.approve',$item->id)}}" class="btn btn-danger">Approve</a>
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