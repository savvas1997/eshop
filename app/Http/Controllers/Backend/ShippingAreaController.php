<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShipState;



class ShippingAreaController extends Controller
{
    //
    public function shippingview(){

        $divisions = ShipDivision::orderBy('id','DESC')->get();
        return view('backend.ship.division.view_division',compact('divisions'));

    }
    public function divisionstore(Request $request){
        $request->validate([
            'division_name' => 'required',
           
        ]);

        
        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Division Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function editdivision($id){

        $divisions = ShipDivision::findOrFail($id);

        return view('backend.ship.division.division_edit',compact('divisions'));

    }

    public function divisionupdate(Request $request,$id){

            $request->validate([
                'division_name' => 'required',
            
            ]);

            
            ShipDivision::findOrFail($id)->update([
                'division_name' => $request->division_name,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Division Updated Successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('manage.division')->with($notification);
    }

    public function deletedivision($id){

        ShipDivision::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    
    }


    public function districtview(){

        $districts = ShipDistrict::with('division')->orderBy('id','DESC')->get();
        $divisions = ShipDivision::orderBy('id','DESC')->get();

        return view('backend.ship.district.view_district',compact('districts','divisions'));

    }

    public function districtstore(Request $request){
        $request->validate([
            'district_name' => 'required',
            'division_id' => 'required',
           
        ]);

        
        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'District Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



    public function editdistrict($id){

        $districts = ShipDistrict::findOrFail($id);
        $divisions = ShipDivision::orderBy('division_name','DESC')->get();

        return view('backend.ship.district.district_edit',compact('districts','divisions'));

    }


    public function districtupdate(Request $request,$id){

        $request->validate([
            'district_name' => 'required',
            'division_id' => 'required',
        ]);

        
        ShipDistrict::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'District Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.district')->with($notification);
}



        public function deletedistrict($id){

            ShipDistrict::findOrFail($id)->delete();

            $notification = array(
                'message' => 'District Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);


        }

        //////     SHIP STATE ////////////////////////

        public function stateview(){

            $districts = ShipDistrict::orderBy('id','DESC')->get();
            $divisions = ShipDivision::orderBy('id','DESC')->get();
            $states = ShipState::with('division','district')->orderBy('id','DESC')->get();
    
            return view('backend.ship.state.view_state',compact('districts','divisions','states'));
    
        }

        public function statestore(Request $request){
            
            $request->validate([
                'district_id' => 'required',
                'division_id' => 'required',
                'state_name' => 'required',
               
            ]);
    
            
            ShipState::insert([
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'state_name' => $request->state_name,
                'created_at' => Carbon::now()
            ]);
    
            $notification = array(
                'message' => 'State Inserted Successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }

        // public function GetDistrict($category_id){
        //     $subcat = ShipDistrict::where('division_id',$category_id)->orderBy('district_name','ASC')->get();
        //     return json_encode($subcat);
        // }
        public function editstate($id){

            $districts = ShipDistrict::orderBy('id','DESC')->get();
            $divisions = ShipDivision::orderBy('id','DESC')->get();
            $states = ShipState::findOrFail($id);

            return view('backend.ship.state.edit_state',compact('districts','divisions','states'));
    
        }
    
    
        public function stateupdate(Request $request,$id){
    
            $request->validate([
                'district_id' => 'required',
                'division_id' => 'required',
                'state_name' => 'required',
            ]);
    
            
            ShipState::findOrFail($id)->update([
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'state_name' => $request->state_name,
                'created_at' => Carbon::now()
            ]);
    
            $notification = array(
                'message' => 'State Updated Successfully',
                'alert-type' => 'info'
            );
    
            return redirect()->route('manage.state')->with($notification);
    }
    
    
    
            public function deletestate($id){
    
                ShipState::findOrFail($id)->delete();
    
                $notification = array(
                    'message' => 'State Deleted Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
    
    
            }

}
