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
				  <h3 class="box-title">Blog Category List <span class="badge badge-pill badge-danger">{{count($blogcategory)}}</span></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								
                                <th>Blog Category EN</th>
								<th>Blog Category GR</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($blogcategory as $item)
                            <tr>
								<td>{{$item->blog_category_name_en}}</td>
								<td>{{$item->blog_category_name_gr}}</td>
								<td>
                                    <a href="{{route('edit.blogcategory',$item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil" ></i></a>
                                    <a href="{{route('delete.blogcategory',$item->id)}}" id="delete" class="btn btn-danger" title="Delete Data"><i class="fa fa-trash" ></i></a>
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
                     <h3 class="box-title">ADD Blog Category </h3>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                        <form method="post" action="{{route('bogcategory.store')}}">
                            @csrf
                        
                                <div class="form-group">
                                    <h5>Blog Category ENGLISH <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  type="text" name="blog_category_name_en" class="form-control" required="" > 
                                        @error('blog_category_name_en') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Blog Category GREEK <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="blog_category_name_gr" class="form-control" required="" >
                                        @error('blog_category_name_gr') 
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