@extends('admin.admin_master');
@section('admin')


  
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
                     <h3 class="box-title">Edit State</h3>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                        <form method="post" action="{{route('state.update',$states->id)}}">
                            @csrf

                                <div class="form-group">
                                    <h5>Division Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="division_id" required class="form-control">
                                            <option value="" selected="" disabled="">Select Division</option>
                                            @foreach($divisions as $division)
                                            <option value="{{$division->id}}" {{$division->id == $states->division_id ? 'selected' : ''}}>{{$division->division_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('division_id') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>District Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="district_id" required class="form-control">
                                            <option value="" selected="" disabled="">Select District</option>
                                            @foreach($districts as $district)
                                            <option value="{{$district->id}}" {{$district->id == $states->district_id ? 'selected' : ''}}>{{$district->district_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('district_id') 
                                            <span class="text-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>State Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  type="text" name="state_name" class="form-control" required="" value="{{$states->state_name}}" > 
                                        @error('state_name') 
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
  {{-- <script type="text/javascript">
    $(document).ready(function() {
      $('select[name="division_id"]').on('change', function(){
          var division_id = $(this).val();
          if(division_id) {
              $.ajax({
                  url: "{{  url('/shipping/statedistrict/ajax') }}/"+division_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                    $('select[name="district_name"]').html('');
                     var d =$('select[name="division_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="division_id"]').append('<option value="'+ value.id +'">' + value.division_name + '</option>');
                        });
                  },
              });
          } else {
              alert('danger');
          }
      });

     

  });
  </script>  --}}

@endsection