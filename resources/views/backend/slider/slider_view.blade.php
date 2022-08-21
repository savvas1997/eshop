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
				  <h3 class="box-title">Slider List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
                                <th>Slider Image</th>
								<th>Slider Title EN</th>
								<th>Slider Title GR</th>
								<th>Slider Description</th>
								<th>Slider Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($sliders as $item)
                            <tr>
                                <td><img src="{{asset($item->slider_img)}}" style="width: 70px; height:40px;"></td>
								<td>
                                    @if($item->title_en == NULL)
                                        <span class="badge badge-pill badge-danger">No Title</span>
                                    @else
                                    {{$item->title_en}}
                                    @endif
                                </td>
								<td>
                                    @if($item->title_en == NULL)
                                    <span class="badge badge-pill badge-danger">No Title</span>
                                    @else
                                    {{$item->title_gr}}
                                    @endif
                                </td>
								<td>{{$item->description}}</td>
								<td>
                                    @if($item->status ==1)
										<span class="badge badge-pill badge-success">Active</span>
										@else
										<span class="badge badge-pill badge-danger">InActive</span>

									@endif    
                                </td>
								<td width="30%">
                                    <a href="{{route('edit.slider',$item->id)}}" class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil" ></i></a>
                                    <a href="{{route('slider.delete',$item->id)}}" id="delete" class="btn btn-danger btn-sm" title="Delete Data"><i class="fa fa-trash" ></i></a>
                                    @if($item->status ==1)
									<a href="{{route('slider.inactive',$item->id)}}" class="btn btn-danger btn-sm" title="InActive Now"><i class="fa fa-arrow-down" ></i></a>
									@else
									<a href="{{route('slider.active',$item->id)}}" class="btn btn-success btn-sm" title="Active Now"><i class="fa fa-arrow-up" ></i></a>

								@endif
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

            {{-- Add Slider  --}}
            <div class="col-4">

                <div class="box">
                   <div class="box-header with-border">
                     <h3 class="box-title">ADD Slider</h3>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                        <form method="post" action="{{route('slider.store')}}" enctype="multipart/form-data">
                            @csrf
                        
                                <div class="form-group">
                                    <h5>Slider Title ENGLISH <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  type="text" name="title_en" class="form-control"  > 
                                        @error('title_en') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Slider Title GREEK <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="title_gr" class="form-control" >
                                        @error('title_gr') 
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror 
                                </div>
                                </div>
                                <div class="form-group">
                                    <h5>Slider Description <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="description" class="form-control" >
                                        @error('description') 
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror 
                                </div>
                                </div>
                                <div class="form-group">
                                    <h5>Slider IMAGE <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="slider_img" class="form-control" required="" > 
                                        @error('slider_img') 
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