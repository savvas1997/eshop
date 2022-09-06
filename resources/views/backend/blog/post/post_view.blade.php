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
				  <h3 class="box-title">Blog Post List <span class="badge badge-pill badge-danger">{{count($blogpost)}}</span></h3>
                  <a href="{{route('add.post')}}" class="btn btn-success" style="float: right;">Add Post</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
                                <th>Blog Post Category</th>
								<th>Blog Post Image</th>
                                <th>Blog Post title EN</th>
								<th>Blog Post title GR</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($blogpost as $item)
                            <tr>
								<td>{{$item->blogpostcategory->blog_category_name_en}}</td>
                                <td><img src="{{asset($item->image)}}" style="width:60px; height:60px;"></td>
								<td>{{$item->title_en}}</td>
								<td>{{$item->title_gr}}</td>
								<td width="20%">
                                    <a href="{{route('edit.blogpost',$item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil" ></i></a>
                                    <a href="{{route('delete.blopost',$item->id)}}" id="delete" class="btn btn-danger" title="Delete Data"><i class="fa fa-trash" ></i></a>
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