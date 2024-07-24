<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    //
   public function index(){
     $reviews=Review::with('user')->paginate(10);
     return response()->json(['result'=>$reviews,'error'=>null],200);
   }

   public function store(Request $request){
     $validator=Validator::make($request->all(),
     [
        'review'=>'required',
        'stars'=>'required',
        'business_id'=>'required',
        'user_id'=>'required'

     ]
   );

     if($validator->fails()){
        return response()->json($validator->errors()->toJson());
     }

     $reviews=new Review();
      $reviews->user_id=Auth::id();
      $reviews->review=$request->review;
      $reviews->business_id=$request->business_id;
      $reviews->stars=$request->stars;

      $reviews->save();

      return response()->json(['result'=>['messge'=>'review is added'],'error'=>null],200);



   }

   public function destroy(Request $request,$id){
      $reviews=Review::findorFail($id);
      $reviews->delete();
      return response()->json('review is deleted');
   }

   
   public function update(Request $request,$id){
    
    $reviews=Review::find($id);
     $reviews->user_id=Auth::id();
     $reviews->review=$request->review;
     $reviews->business_id=$request->business_id;
     $reviews->stars=$request->stars;

     $reviews->save();

     return response()->json(['result'=>['messge'=>'review is updated'],'error'=>null],200);



  }

}
