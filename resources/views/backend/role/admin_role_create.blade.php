@extends('admin.admin_master');
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container-full">
    <!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
         <div class="box">
           <div class="box-header with-border">
             <h4 class="box-title">Create Admin User</h4>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form method="post" action="{{route('admin.user.store')}}" enctype="multipart/form-data">
                    @csrf
                     <div class="row">
                       <div class="col-12">						
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Admin User Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control"  > </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Admin Email <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" name="email" class="form-control"  > </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Admin User Phone <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="phone" class="form-control"  > </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Admin Password <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="password" class="form-control"  > </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Admin Profile Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="profile_photo_path" class="form-control"  id="image"> </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img id="showImage" src="{{url('upload/no_image.jpg')}}" style="height: 100px; width:100px;">
                                </div>
                            </div> 

                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           <fieldset>
                                               <input type="checkbox" id="checkbox_2" name="brand" value="1">
                                               <label for="checkbox_2">Brand</label>
                                           </fieldset>
                                           <fieldset>
                                               <input type="checkbox" id="checkbox_3" name="category" value="1">
                                               <label for="checkbox_3">Category</label>
                                           </fieldset>
                                           <fieldset>
                                            <input type="checkbox" id="checkbox_4" name="product" value="1">
                                            <label for="checkbox_4">Product</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_5" name="slider" value="1">
                                            <label for="checkbox_5">Slider</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_6" name="coupons" value="1">
                                            <label for="checkbox_6">Coupons</label>
                                        </fieldset>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_7" name="shipping" value="1">
                                            <label for="checkbox_7">Shipping</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_8" name="blog" value="1">
                                            <label for="checkbox_8">Blog</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_9" name="setting" value="1">
                                            <label for="checkbox_9">Setting</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_10" name="returnorder" value="1">
                                            <label for="checkbox_10">Return Orders</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_11" name="review" value="1">
                                            <label for="checkbox_11">Reviews</label>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                               <div class="col-md-4">
                                   <div class="form-group">
                                       <div class="controls">
                                           <fieldset>
                                               <input type="checkbox" id="checkbox_12" name="orders" value="1">
                                               <label for="checkbox_12">Orders</label>
                                           </fieldset>
                                           <fieldset>
                                               <input type="checkbox" id="checkbox_13" name="stock" value="1">
                                               <label for="checkbox_13">Stock</label>
                                           </fieldset>
                                           <fieldset>
                                            <input type="checkbox" id="checkbox_14" name="reports" value="1">
                                            <label for="checkbox_14">Reports</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_15" name="alluser" value="1">
                                            <label for="checkbox_15">All Users</label>
                                        </fieldset>
                                        <fieldset>
                                            <input type="checkbox" id="checkbox_16" name="adminuserrole" value="1">
                                            <label for="checkbox_16">Admin User Role</label>
                                        </fieldset>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           
                           
                           
                       
                       <div class="text-xs-right">
                          <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add AdminUser">
                       </div>
                       </div>
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

    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    })

</script>
  @endsection