<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class AuthController extends Controller
{
   public function login(Request $request){
    	$this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', '=', $request->email)->firstOrFail();
    	$status = "error";
    	$message = "";  
    	$data = null;
    	$code = 401;
    	if($user){
    		if(Hash::check($request->password, $user->password)){
    		$user->generateToken();
    		$status = 'success';
    		$message = 'Login Sukses';
    		$data = $user->toArray();
    		$code = 200;
    		} else {
    		$message = "Login gagal, password salah";
    		} 
    	}else {
    		$message = "Login gagal, username salah";
    	}
    	return response()->json([
    		'status' => $status,
    		'message' => $message,
    		'data' => $data
    	], $code);
    }

      public function register(Request $request){
        $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        ]);
        $status = "error";
        $message = "";
        $data = null;
        $code = 400;
        if ($validator->fails()) {
        $errors = $validator->errors();
        $message = $errors;
        } else {
        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'roles' => json_encode(['CUSTOMER']),
        ]);
        if ($user) {
            $user->generateToken();
            $status = "success";
            $message = "register successfully";
            $data = $user->toArray();
            $code = 200;
            } else {
            $message = 'register failed';
            }
        }
        return response()->json([
        'status' => $status,
        'message' => $message,
        'data' => $data
        ], $code);
    }


    public function editProfile(Request $request, $id){

        $input = $request->all();

        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        $status = "error"; 
        $message = ""; 
        $data = null; 
        $code = 400;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'password' => 'required|string|min:6',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $status = "error"; 
        $message = ""; 
        $data = null; 
        $code = 400;

        if($validator->fails()){
            $errors = $validator->errors();
            $message = $errors;
                  
        }else{
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $plainPassword = $request->input('password');
                $user->password = Hash::make($plainPassword);
                $user->address = $request->input('address');
                $user->phone = $request->input('phone');
            if ($user->save()) {
                $user->generateToken();
                $status = "success"; 
                $message = "edit profile successfully"; 
                $data = $user->toArray(); 
                $code = 200; 
            } else{
                $message = 'edit profile failed';
            }
                
        }
        return response()->json([ 
            'status' => $status, 
            'message' => $message, 
            'data' => $data 
        ], $code);
    }


    public function logout(Request $request){
        $user = Auth::user();
        if($user){
            $user->api_token = null;
            $user->save();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'logout berhasil',
            'data' => null
        ],200);
    }
}
