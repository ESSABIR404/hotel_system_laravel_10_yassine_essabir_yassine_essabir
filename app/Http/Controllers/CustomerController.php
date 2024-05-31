<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    // view page all customer
    public function allCustomers()
    {
        $allCustomers = DB::table('customers')->get();
        return view('formcustomers.allcustomers',compact('allCustomers'));
    }

    // add Customer
    public function addCustomer()
    {
        
        $user = DB::table('users')->get();
        return view('formcustomers.addcustomer',compact('user'));
    }
    // save record
    public function saveCustomer(Request $request)
    {
       
        $request->validate([
           
            
            
        ]);

        DB::beginTransaction();
        try {

           
            $customer = new Customer;
            $customer->id_users         = $request->name;
           
            $customer->CIN_Customer        = $request->CIN_Customer;
            $customer->first_name        = $request->first_name;
            $customer->last_name        = $request->last_name;
            $customer->date  = $request->date;
            $customer->time  = $request->time;
            $customer->email       = $request->email;
            $customer->ph_number   = $request->ph_number;
            $customer->message     = $request->message;
            $customer->save();
           
            DB::commit();
            Toastr::success('Create new customer successfully :)','Success');
            return redirect()->route('form/allcustomers/page');
            
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Customer fail :)','Error');
            return redirect()->back();
        }
    }

    // customer edit
    public function updateCustomer($id)
    {
        $customerEdit = DB::table('customers')->where('id',$id)->first();
        $user = DB::table('users')->get();
        return view('formcustomers.editcustomer',compact('customerEdit','user'));
    }

    // update record
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the input data
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'CIN_Customer' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'date' => 'required|date',
                'time' => 'required',
                'email' => 'required|email',
                'ph_number' => 'required',
                'message' => 'nullable',
                'id' => 'required|exists:customers,id',
            ]);
    
            if ($validator->fails()) {
                Toastr::error('Validation error: ' . implode(', ', $validator->errors()->all()), 'Error');
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            // Retrieve the existing customer
            $customer = Customer::where('id', $request->id)->first();
    
            if (!$customer) {
                Toastr::error('Customer not found', 'Error');
                return redirect()->back();
            }
    
            // Apply the updates
            $customer->id_users = $request->name;
            $customer->CIN_Customer = $request->CIN_Customer;
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->date = $request->date;
            $customer->time = $request->time;
            $customer->email = $request->email;
            $customer->ph_number = $request->ph_number;
            $customer->message = $request->message;
    
            $customer->save();
    
            DB::commit();
            Toastr::success('Updated customer successfully :)', 'Success');
            return redirect()->route('form/allcustomers/page');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Update customer failed: ' . $e->getMessage(), 'Error');
            return redirect()->back();
        }
    }
    
    // delete record
    public function deleteRecord(Request $request)
    {
        try {

            Customer::destroy($request->id);
            
            Toastr::success('Customer deleted successfully :)','Success');
            return redirect()->back();
        
        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Customer delete fail :)','Error');
            return redirect()->back();
        }
    }

}
