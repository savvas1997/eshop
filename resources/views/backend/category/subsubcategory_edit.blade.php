@extends('admin.admin_master');
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    

  
  <!-- Content Wrapper. Contains page content -->
  
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<!-- Main content -->
		<section class="content">
		  <div class="row">


            {{-- Add Brand  --}}
            <div class="col-12">

                <div class="box">
                   <div class="box-header with-border">
                     <h3 class="box-title">Edit Sub-SubCategory</h3>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                        <form method="post" action="{{route('subsubcategory.update')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$subsubcategory->id}}">
                                <div class="form-group">
                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" required class="form-control">
                                            <option value="" selected="" disabled="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                 {{$category->id == $subsubcategory->category_id ? 'selected' : ''}}>
                                                 {{$category->category_name_en}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category_id') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" required class="form-control">
                                            <option value="" selected="" disabled="">Select SubCategory</option>
                                            @foreach($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}"
                                                 {{$subcategory->id == $subsubcategory->subcategory_id ? 'selected' : ''}}>
                                                 {{$subcategory->subcategory_name_en}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('sybcategory_id') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <h5>Sub-SubCategory Name ENGLISH <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  type="text" name="subsubcategory_name_en" class="form-control" required="" value="{{$subsubcategory->subsubcategory_name_en}}"> 
                                        @error('subsubcategory_name_en') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Sub-SubCategory Name GREEK <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="subsubcategory_name_gr" class="form-control" required="" value="{{$subsubcategory->subsubcategory_name_gr}}">
                                        @error('subsubcategory_name_gr') 
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror 
                                </div>
                                </div>
                               
                               <div class="text-xs-right">
                                  <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Sub-SubCateogry">
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