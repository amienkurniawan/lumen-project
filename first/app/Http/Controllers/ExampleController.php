<?php

namespace App\Http\Controllers;
use \Illuminate\Http\Request;
use Illuminate\Http\Response;
class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //   $this->middleware('age',[
      //     'except'=>['getUser']
      // ]);
    }

    public function key(){
      return str_random(32);
    }
    public function postman(){
      return "ini dari post";
    }
    public function getUser($id){
      return "user Id = ".$id;
    }
    public function post($cat1,$cat2){
      return "Cat 1 = ".$cat1." Cat 2 = ".$cat2;
    }
    public function profile(){
      return "ini link profile ke action ".route('profile.admin.action');
    }
    public function profileaction(){
      return "ini profile link ". route('profile.admin');
    }
    public function foobar(Request $request){
      if($request->is('foo/bar')){
        return "Success";
      }else{
        return "Fail";
      }
    }
    public function profileuser(Request $request){
      return $request->except(['username','password']);
    }
    public function response(){
      $data['username'] = "amien";
      $data['status'] = true;
      return response()->json($data,201);
    }
}
