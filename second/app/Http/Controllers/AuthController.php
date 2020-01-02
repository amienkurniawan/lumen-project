<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function login(Request $request){
      $email = $request->input('email');
      $password = $request->input('password');

      $user = User::where('email',$email)->first();

      // belom dicek apakah $user itu ada atau tidak

      if(Hash::check($password,$user->password)){
        $apiToken = base64_encode(str_random(40));
        $user->update([
          'api_token'=>$apiToken
        ]);
        return response()->json([
          'success'=>true,
          'message'=>'login success!',
          'data'=>[
            'user'=>$user,
            'api_token'=>$apiToken
          ]
        ],201);
      }else{
        return response()->json([
          'success'=>false,
          'message'=>'login failed!',
          'data'=>''
        ],401);
      }
    }
    public function register(Request $request){
      $data['name'] = $request->input('name');
      $data['email'] = $request->input('email');
      $data['password'] = Hash::make($request->input('password'));

      $register = User::create($data);
//201 succes make new resource 400 error request failed
      if($register){
        return response()->json([
          'success'=>true,
          'message'=>'user success registered',
          'data'=>$register
      ],201);
      }else{
        return response()->json([
          'success'=>true,
          'message'=>'user failed registered',
          // 'data'=>$register
      ],400);
      }
    }

}
