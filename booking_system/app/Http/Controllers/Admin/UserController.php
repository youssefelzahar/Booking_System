<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class UserController extends Controller
{
    //

    public function index(){
        $user=User::paginate(10);
        return view('users',compact('user'));
  }

  public function create(){
    
    return view('create_user');
} 


  public function store(Request $request){
      $validator=Validator::make($request->all(),[
          'name'=>'required',
          'email'=>'required',
          'password'=>'required',
          'role'=>'required'
      ]);

      if($validator->fails()){
          return response()->json($validator->errors()->toJson());
      }
      User::create(array_merge($validator->validated()));
      return redirect()->back();

  }
  public function update(Request $request,$id){
      $user=User::findorFail($id);

      $validator=Validator::make($request->all(),[
          'name'=>'required',
          'email'=>'required',
          'password'=>'required',
          'role'=>'required'
      ]);

      if($validator->fails()){
          return response()->json($validator->errors()->toJson());
      }

      $user->update(array_merge($validator->validated()));
      return redirect()->back();
  }

  public function destroy($id){
      $user=User::findorFail($id);
     $user->delete();
     return redirect()->back();
    }
}
