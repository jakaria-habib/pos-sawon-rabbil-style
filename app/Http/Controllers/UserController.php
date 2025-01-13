<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Exception;
use function PHPUnit\Framework\returnValue;

class UserController extends Controller
{

    public function loginPage()
    {
        return view('pages.auth.login-page');
    }

    public function registrationPage()
    {
        return view('pages.auth.registration-page');
    }

    public function userRegistration(Request $request)
    {
        try
        {
            User::create([
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile' => $request->mobile,
                'password' => $request->password,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'User Registration successful'
            ],200);
        }
        catch (Exception $e)
        {
            return response()->json([
            'status' => 'failed',
            'message' => 'User Registration Failed'
            ],500);
        }

    }

    public function userLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $count = User::where('email','=',$email)->where('password','=',$password)->select('id')->first();

        if($count !== null){
            $token = JWTToken::createToken($email, $count->id);

            return response()->json([
                'status' => 'success',
                'message' => 'user Login successful',
            ],200)->cookie('token', $token, 60*60*24*30);
        }
        else{
            return response()->json([
                'status' => 'unauthorized',
                'message' => 'user unauthorized'
            ]);
        }




    }

    public function userLogout()
    {
        return redirect('/login-page')->cookie('token','',-1);
    }

    public function userProfilePage()
    {
        return view('pages.dashboard.profile-page');
    }

    public function getProfile( Request $request)
    {
        try {
            $email = $request->header('email');
            $data = User::where('email','=',$email)->first();

            return response()->json([
                'status' => 'success',
                'message' => 'successful',
                'data' => $data
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 'fail',
                'message' => 'User Profile is not gotten !!!'
            ]);
        }
    }


    public function userProfileUpdate(Request $request)
    {
        try {
            $email = $request->header('email');
            User::where('email','=',$email)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile' => $request->mobile,
                'password' => $request->password,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'User Updated successfully'
            ]);
        }
        catch (Exception $e)
        {
            return response()->json([
                'status' => 'fail',
                'message' => 'User Updated failed'
            ]);
        }
    }
}
