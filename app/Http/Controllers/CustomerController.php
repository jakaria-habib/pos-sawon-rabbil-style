<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnValue;

class CustomerController extends Controller
{

    function customerPage()
    {
        return view('pages.dashboard.customer-page');
    }


    function customerCreate(Request $request){

        try {
            $name = $request->input('name');
            $email = $request->input('email');
            $mobile = $request->input('mobile');
            $user_id = $request->header('id');

            Customer::create([
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'user_id' => $user_id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Customer created successfully',
            ]);
        }
        catch (Exception $exception){
            return response()->json([
                'status' => 'failed',
                'message' => 'Customer created Failed',
            ]);
        }
    }

    function customerList(Request $request){

        $user_id = $request->header('id');
        return Customer::where('user_id',$user_id)->get();
    }


    function customerByID(Request $request){

        $customerId = $request->input('id');
        $user_id = $request->header('id');

        return Customer::where('id',$customerId)->where('user_id',$user_id)->first();

    }

    function customerUpdate(Request $request){

        $customer_id = $request->input('id');
        $user_id = $request->header('id');

        return Customer::where('id',$customer_id)->where('user_id',$user_id)->update([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'mobile'=> $request->input('mobile'),
        ]);
    }


    function customerDelete(Request $request)
    {
        $user_id =$request->header('id');
        $customer_id =$request->input('customer_id');
        return Customer::where('id',$customer_id)->where('user_id',$user_id)->delete();
    }














}
