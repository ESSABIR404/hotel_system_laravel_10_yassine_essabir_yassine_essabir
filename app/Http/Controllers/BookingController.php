<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Booking;
use DB;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    // view page all Booking
    public function allbooking()
    {
        $allBookings = Booking::with('customer', 'room')->get();
        // Assuming 'Booking' is the name of your model, adjust accordingly.
    
        return view('formbooking.allbooking', compact('allBookings'));
    }
    

    // Booking add
    public function bookingAdd()
    {
        $data = DB::table('room_types')->get();
        $rooms = DB::table('rooms')->get();
        $customers = DB::table('customers')->get();
        $user = DB::table('users')->get();
        return view('formbooking.bookingadd',compact('data','rooms','customers','user'));
    }
    
    
    // Booking edit
    public function bookingEdit($id)
    {
        $data = DB::table('room_types')->get();
        $rooms = DB::table('rooms')->get();
        $customers = DB::table('customers')->get();
        $user = DB::table('users')->get();
        $bookingEdit = DB::table('bookings')->where('id',$id)->first();
        return view('formbooking.bookingedit',compact('bookingEdit','user','customers','rooms'));
    }

 // Booking save record
 public function saveRecord(Request $request)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'total_numbers' => 'required',
        'date' => 'required|date',
        'time' => 'required',
        'arrival_date' => 'required',
        'depature_date' => 'required',
        'message' => 'nullable',
        'id_users' => 'required|exists:users,id',
        'id_rooms' => 'required|exists:rooms,id',
        'id_customers' => 'required|exists:customers,id',
    ]);

    // Check for validation errors
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    DB::beginTransaction();
    try {
        $booking = new Booking;

        // Set Booking properties
        $booking->total_numbers = $request->total_numbers;
        $booking->date = $request->date;
        $booking->time = $request->time;
        $booking->arrival_date = $request->arrival_date;
        $booking->departure_date = $request->depature_date;
        $booking->message = $request->message;

        // Set foreign key values
        $booking->id_users = $request->id_users;
        $booking->id_rooms = $request->id_rooms;
        $booking->id_customers = $request->id_customers;

        // Save the Booking
        $booking->save();

        // Commit the transaction
        DB::commit();

        
        

        Toastr::success('Create new booking successfully :)', 'Success');
        return redirect()->route('form/allbooking');
    } catch (\Exception $e) {
        // Rollback the transaction on exception
        DB::rollback();

        // Log the exception message
        \Log::error('Add Booking Exception: ' . $e->getMessage());

        // Debugging statements
        dd('Error saving record. Exception: ' . $e->getMessage());

        Toastr::error('Add Booking fail :(', 'Error');
        return redirect()->back();
    }
}
 

    // update record
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the input data
            $validator = Validator::make($request->all(), [
                'total_numbers' => 'required',
                'date' => 'required|date',
                'time' => 'required',
                'arrival_date' => 'required',
                'departure_date' => 'required',
                'message' => 'nullable',
                'id_users' => 'required|exists:users,id',
                'id_rooms' => 'required|exists:rooms,id',
                'id_customers' => 'required|exists:customers,id',
            ]);

            if ($validator->fails()) {
                Toastr::error('Validation error: ' . implode(', ', $validator->errors()->all()), 'Error');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Retrieve the existing booking
            $booking = Booking::find($request->id);

            if (!$booking) {
                Toastr::error('Booking not found', 'Error');
                return redirect()->back();
            }

            // Apply the updates
            $booking->update([
                'total_numbers' => $request->total_numbers,
                'date' => $request->date,
                'time' => $request->time,
                'arrival_date' => $request->arrival_date,
                'departure_date' => $request->departure_date,
                'message' => $request->message,
                'id_users' => $request->id_users,
                'id_rooms' => $request->id_rooms,
                'id_customers' => $request->id_customers,
            ]);

            DB::commit();
            Toastr::success('Booking updated successfully :)', 'Success');
            return redirect()->route('form/allbooking');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Update Booking failed: ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }

    // delete record Booking
    public function deleteRecord(Request $request)
{
    DB::beginTransaction();
    try {
        $id = $request->id;

        // Assurez-vous que l'id est valide avant de supprimer
        if (!Booking::find($id)) {
            Toastr::error('Booking not found :(', 'Error');
            return redirect()->back();
        }

        Booking::destroy($id);

        DB::commit();
        Toastr::success('Booking deleted successfully :)', 'Success');
        return redirect()->back();
    } catch (\Exception $e) {
        DB::rollback();
        Toastr::error('Booking delete failed: ' . $e->getMessage(), 'Error');
        return redirect()->back();
    }
}


}
