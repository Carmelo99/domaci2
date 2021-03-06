<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FitnessTrainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:55',
            'email' => 'required|email|unique:fitness_trainers',
            'certification'=>'required|max:7',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $trainer = FitnessTrainer::create([
            'username' => $request->username,
            'email' => $request->email,
            'certification'=>$request->certification,
            'password' => Hash::make($request->password)
        ]);

        $accessToken = $trainer->createToken('authToken')->accessToken;

        return response()->json([ 'fitness_trainer' => $trainer, 'access_token' => $accessToken,'token_type'=>'Bearer']);


    }


    public function login(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'username'=>'required|max:55',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()]);
        }

        if (!auth()->attempt($data)) {
            return response()->json(['message' => 'Login credentials are invaild'],401);
        }

        $trainer = FitnessTrainer::where('email',$request['email'])->firstOrFail();

        $accessToken = $trainer->createToken('authToken')->accessToken;

        return response()->json(['message'=>'Welcome '.$trainer->username.' to Your profile','access_token'=>$accessToken,'token_type'=>'Bearer']);
    }










}
