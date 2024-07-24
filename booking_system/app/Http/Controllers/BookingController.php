<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
class BookingController extends Controller

{
    //

    public function index(){
        $booking=Booking::with('service')->paginate(10);
        return response()->json($booking);
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'time'=>'required',
            'service_id'=>'required',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson());
        }

        $booking = new Booking();
            $booking->user_id = Auth::id();
            $booking->service_id = $request->service_id;
          
            $booking->time = $request->time;
            $booking->save();

        return response()->json('booking is added');    
    }

    public function destroy($id,Request $request){
        $booking=Booking::finforFail($id);
        $booking->delete();
        response()->json('booking is deleted');
    }
}
