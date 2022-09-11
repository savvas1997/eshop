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
            <h4 class="box-title">Add Product</h4>
            <h6 class="box-subtitle">Bootstrap Form Validation check the <a class="text-warning" href="http://reactiveraven.github.io/jqBootstrapValidation/">official website </a></h6>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col">
                  <form method="post" action="{{route('product-store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-12">	

                        {{-- start 1th row --}}
					
                          <div class="row"> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="brand_id" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Brand</option>
                                            @foreach($brands as $brand)
                                            <option value="{{$brand->id}} " >{{$brand->brand_name_en}}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}" >{{$category->category_name_en}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select SubCategory</option>
                                           
                                        </select>
                                        @error('subcategory_id') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                          </div>
{{-- end 1th row --}}
{{-- start 2th row --}}

                          <div class="row"> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Sub-SubCategory Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subsubcategory_id" required="" class="form-control">
                                            <option value="" selected="" disabled="">Select Sub-SubCategory</option>
                                           
                                        </select>
                                        @error('subsubcategory_id') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                        <h5>Product Name En <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name_en" class="form-control" > 
                                            @error('product_name_en') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                   
                                        <h5>Product Name Gr <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name_gr" class="form-control" > 
                                            @error('product_name_gr') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                
                            </div> 
                          </div>
                        </div>
                        {{-- end 2th row --}}

                        {{-- start 3th row --}}

                          <div class="row"> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                        <h5>Product Code <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_code" class="form-control" > 
                                            @error('product_code') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                        <h5>Product Quantity <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_qty" class="form-control" > 
                                            @error('product_qty') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                        <h5>Product Tags En<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_tags_en" class="form-control" value="Lorem,Ipsum,Amet" 
                                            data-role="tagsinput" placeholder="add tags"> 
                                        
                                            @error('product_tags_en') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                          </div>
                          {{-- end 3th row --}}

                        {{-- start 4th row --}}

                          <div class="row"> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                        <h5>Product Tags GR<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_tags_gr" class="form-control" value="Lorem,Ipsum,Amet" 
                                            data-role="tagsinput" placeholder="add tags"> 
                                        
                                            @error('product_tags_gr') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                    <h5>Product Size EN<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_en" class="form-control" value="Small,Medium,Large" 
                                        data-role="tagsinput" placeholder="add tags"> 
                                    
                                        @error('product_size_en') 
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                    <h5>Product Size EN<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_gr" class="form-control" value="Μικρό,Μεσαιο,Μεγαλο" 
                                        data-role="tagsinput" placeholder="add tags"> 
                                    
                                        @error('product_size_gr') 
                                        <span class="text-danger">{{$message}} </span>
                                    @enderror
                                </div>
                             </div>
                            </div>
                          </div>
                            {{-- end 4th row --}}
                            {{-- start 5th row --}}

                            <div class="row"> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        
                                            <h5>Product Color EN<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="product_color_en" class="form-control" value="Red,Black,Green" 
                                                data-role="tagsinput" placeholder="add tags"> 
                                            
                                                @error('product_color_en') 
                                                <span class="text-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        
                                        <h5>Product Color GR<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_color_gr" class="form-control" value="Κοκκινο,Μπλε,Πρασινο" 
                                            data-role="tagsinput" placeholder="add tags"> 
                                        
                                            @error('product_color_gr') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    
                                        <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="selling_price" class="form-control" > 
                                            @error('selling_price') 
                                            <span class="text-danger">{{$message}} </span>
                                          @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end 5th row --}}

                            {{-- start 6th row --}}

                            <div class="row"> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        
                                            <h5>Product Discount Price<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="discount_price" class="form-control"> 
                                            
                                                @error('discount_price') 
                                                <span class="text-danger">{{$message}} </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        
                                        <h5>Main Thumbnail<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)"> 
                                        
                                            @error('product_thambnail') 
                                            <span class="text-danger">{{$message}} </span>
                                             @enderror
                                            
                                             <img src="" id="mainThumb">

                                         </div>
                                     </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        
                                        <h5>Multiple Image<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="multi_img[]" class="form-control" multiple="" id="multiImg"> 
                                        
                                            @error('multi_img') 
                                            <span class="text-danger">{{$message}} </span>
                                             @enderror
                                            <div class="row" id="preview_img"> </div>
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end 6th row --}}   

                            {{-- start 7th row --}}

                            <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    
                                    <h5>Product Short Description EN<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_descp_en" id="short_descp_en" class="form-control" required="" placeholder="Textarea text"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    
                                <h5>Product Short Description GR<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_descp_gr" id="short_descp_gr" class="form-control" required="" placeholder="Textarea text"></textarea>
                                    </div>
                                </div>

                            </div>
                           
                        </div>
                        {{-- end 7th row --}}

                        {{-- start 8th row --}}

                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    
                                    <h5>Product Long Description EN<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="long_descp_en" id="editor1" rows="10" cols="80" required="" placeholder="Textarea text">

                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    
                                <h5>Product Long Description GR<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="long_descp_gr" id="editor2"  rows="10" cols="80" required="" placeholder="Textarea text"></textarea>
                                    </div>
                                </div>

                            </div>
                        
                        </div>
                        {{-- end 8th row --}}
                        <hr>
                      </div>
                    </div>

                      <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                  <div class="controls">
                                      <fieldset>
                                          <input type="checkbox" id="checkbox_2" name="hot_deals" value="1">
                                          <label for="checkbox_2">Hot Deals</label>
                                      </fieldset>
                                      <fieldset>
                                          <input type="checkbox" id="checkbox_3" name="featured" value="1">
                                          <label for="checkbox_3">Featured</label>
                                      </fieldset>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <div class="controls">
                                      <fieldset>
                                          <input type="checkbox" id="checkbox_4" name="special_offer" value="1">
                                          <label for="checkbox_4">Special Offer</label>
                                      </fieldset>
                                      <fieldset>
                                          <input type="checkbox" id="checkbox_5" name="special_deals" value="1">
                                          <label for="checkbox_5">Special Deals</label>
                                      </fieldset>
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group">
                            
                            <h5>Digital Product <span class="text-danger">pdf,xlx,csv*</span></h5>
                            <div class="controls">
                                <input type="file" name="file" class="form-control" > 
                            
                             </div>
                         </div>

                    </div>

                      <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Product">
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
        $(document).ready(function() {
          $('select[name="category_id"]').on('change', function(){
              var category_id = $(this).val();
              if(category_id) {
                  $.ajax({
                      url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                        $('select[name="subsubcategory_id"]').html('');
                         var d =$('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                            });
                      },
                  });
              } else {
                  alert('danger');
              }
          });

          $('select[name="subcategory_id"]').on('change', function(){
              var subcategory_id = $(this).val();
              if(subcategory_id) {
                  $.ajax({
                      url: "{{  url('/category/sub-subcategory/ajax') }}/"+ subcategory_id,
                      type:"GET",
                      dataType:"json",
                      success:function(data) {
                         var d =$('select[name="subsubcategory_id"]').empty();
                            $.each(data, function(key, value){
                                $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + 
                                    value.subsubcategory_name_en + '</option>');
                            });
                      },
                  });
              } else {
                  alert('danger');
              }
          });

      });
      </script>

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

    <script>
 
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
     
    </script>


@endsection