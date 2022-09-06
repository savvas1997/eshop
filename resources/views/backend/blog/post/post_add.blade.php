@extends('admin.admin_master');
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="container-full">
      <!-- Content Header (Page header) -->
      <!-- Main content -->
      <section class="content">

       <!-- Basic Forms -->
        <div class="box">
          <div class="box-header with-border">
            <h4 class="box-title">Add Blog Post</h4>
            <h6 class="box-subtitle"><a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/"></a></h6>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">
                  <form method="post" action="{{route('post-store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-12">	
{{-- start 2th row --}}

                          <div class="row"> 
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    
                                        <h5>Post Title En <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="title_en" class="form-control" > 
                                            @error('title_en') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                   
                                        <h5>Post Title Gr <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="title_gr" class="form-control" > 
                                            @error('title_gr') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                
                            </div> 
                          </div>
                        </div>
                        {{-- end 2th row --}}


                            {{-- start 6th row --}}

                            <div class="row"> 

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Blog Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" required="" class="form-control">
                                                <option value="" selected="" disabled="">Select Blog Category</option>
                                                @foreach($blogcategory as $category)
                                                <option value="{{$category->id}} " >{{$category->blog_category_name_en}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id') 
                                                <span class="text-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        
                                        <h5>Main Thumbnail<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="image" class="form-control" onChange="mainThamUrl(this)"> 
                                        
                                            @error('image') 
                                            <span class="text-danger">{{$message}} </span>
                                             @enderror
                                            
                                             <img src="" id="mainThumb">

                                         </div>
                                     </div>

                                </div>
                                
                            </div>
                            {{-- end 6th row --}}   

                          

                        {{-- start 8th row --}}

                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    
                                    <h5>Post Details EN<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="details_en" id="editor1" rows="10" cols="80" required="" placeholder="Textarea text">

                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    
                                <h5>Post Details GR<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="details_gr" id="editor2"  rows="10" cols="80" required="" placeholder="Textarea text"></textarea>
                                    </div>
                                </div>

                            </div>
                        
                        </div>
                        {{-- end 8th row --}}
                        <hr>
                      </div>
                    </div> 
                      
                      <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Post">
                    </div>
                  </form>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>

      <script type="text/javascript">
            function mainThamUrl(input){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#mainThumb').attr('src',e.target.result).width(80).height(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>



@endsection