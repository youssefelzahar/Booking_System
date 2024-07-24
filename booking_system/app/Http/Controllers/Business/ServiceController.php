<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    //
    public function index(){
        $service= Service::with('business')->paginate(10);
        return response()->json(['result'=>$service,'error'=>null],200);
    }
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'price'=>'required',
            'name'=>'required',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }

        $business=Business::where('user_id',Auth::id())->first();
        $service=new Service();
        $service->name=$request->name;
        $service->description=$request->description;
        $service->price=$request->price;
        $service->business_id=$request->business_id;
        $service->save();
        return response()->json('service is added');


    }

    public function destroy(Request $request,$id){
        $service=Service::findorFail($id);
        $service->delete();
        response()->json('service is deleted');
    }

    public function update(Request $request,$id){
        $service=Service::findorFail($id);
        $validator=Validator::make($request->all(),[
            'price'=>'required',
            'name'=>'required',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        $service->name=$request->name;
        $service->description=$request->description;
        $service->price=$request->price;
        $service->business_id=$request->business_id;
        $service->save();
        return response()->json('service is updated');

    }


}
