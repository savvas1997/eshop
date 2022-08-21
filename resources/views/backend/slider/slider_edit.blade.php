@extends('admin.admin_master');
@section('admin')


  
  <!-- Content Wrapper. Contains page content -->
  
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<!-- Main content -->
		<section class="content">
		  <div class="row">

			<!-- /.col -->

            {{-- Add Brand  --}}
            <div class="col-12">

                <div class="box">
                   <div class="box-header with-border">
                     <h3 class="box-title">Edit Slider</h3>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                        <form method="post" action="{{route('slider.update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$sliders->id}}"> 
                            <input type="hidden" name="old_image" value="{{$sliders->slider_img}}"> 
                                <div class="form-group">
                                    <h5>Slider Title ENGLISH <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  type="text" name="title_en" class="form-control"  value="{{$sliders->title_en}}"> 
                                        @error('title_en') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Slider Title GREEK <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="title_gr" class="form-control"   value="{{$sliders->title_gr}}">
                                        @error('title_gr') 
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror 
                                </div>
                                </div>
                                <div class="form-group">
                                    <h5>Slider Description <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="description" class="form-control"   value="{{$sliders->description}}">
                                        @error('description') 
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror 
                                </div>
                                </div>
                                <div class="form-group">
                                    <h5>Slider IMAGE <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="slider_img" class="form-control"  value=""> 
                                        @error('slider_img') 
                                        <span class="text-danger">{{$message}} </span>
                                        @enderror 
                                    </div>
                                </div>
                            
                               <div class="text-xs-right">
                                  <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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