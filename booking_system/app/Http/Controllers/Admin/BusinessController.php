<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Business;
use App\Models\User;
class BusinessController extends Controller
{
    //

    public function index(){
          $businesses=Business::paginate(10);
          return view('business',compact('businesses'));
        }

        public function create(){
            $users=User::all();
              return view('create_business',compact('users')
            );
        } 

    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'opening_hours'=>'required',
            'user_id'=>'required',
            'status'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }
        Business::create(array_merge($validator->validated()));
        return redirect()->back();

    }
    public function update(Request $request,$id){
        $business=Business::findorFail($id);

        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'opening_hours'=>'required',
            'user_id'=>'required',
            'status'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }

        $business->update(array_merge($validator->validated()));
        return redirect()->back();
    }

    public function destroy($id){
        $business=Business::findorFail($id);
       $business->delete();
       return redirect()->back();
    }

    public function edite($id){
        $business=Business::find($id);
        return view('edite_business',compact('business'));


    }
}
