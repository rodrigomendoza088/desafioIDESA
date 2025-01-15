<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    //
    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' =>'required|unique:users',
            'email' =>'required|email|unique:users',
            'password' =>'required|string|min:4|confirmed'
        ]);
        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de datos',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registrado'], 200);
    }
    //
     public function login(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'email' =>'required',
            'password' =>'required'
        ]);
         if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de datos',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            $data = [
                'message' => 'Error en la validacion de datos',
                'error' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 401);
        }

        //$token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'welcome '.$user->name, 'status' => 200], 200);
    }
}
