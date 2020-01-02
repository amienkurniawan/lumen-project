<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key',function(){
  return str_random(32);
});

$router->get('/foo',function(){
  return "we're in this method get";
});

$router->post('/post',function(){
  return "we're in method post";
});

$router->put('/put',function(){
  return "we're in this method put";
});

$router->patch('/patch',function(){
  return "we're in method patch";
});

$router->delete('/delete',function(){
  return "we're in this method delete";
});

$router->options('/patch',function(){
  return "we're in method options";
});

// route with dynamic parameter
$router->get('/user/{id}',function($id){
  return "user id = ".$id;
});

// route with second and more ReflectionParameter
// yang terpenting adalah urutan dari parameternya bukan nama parameternya
$router->get('posting/{postID}/comment/{commentID}',function($pID,$cID){
  return "post id = ".$pID." dan comment id = ".$cID;
});

//router with options parameter
$router->get('/optionsparam[/{param1}]',function($param1=null){
  return "return options parameter".$param1;
});

// $router->get('/profile',function(){
//   return redirect()->route('route.profile');
// });
//
// $router->get('/profile/route',['as'=>'route.profile',function(){
//   return route('route.profile');
// }]);
$router->get('/admin',function(){
  return redirect()->route('admin.profile');
});

// $router->group(['prefix'=>'admin'],function() use($router){
//   $router->get('home',['as'=>'admin.home',function(){
//     return "home admin";
//   }]);
//   $router->get('profile',['as'=>'admin.profile',function(){
//     return "profile admin";
//   }]);
// });

$router->get('admin/home', ['middleware'=>'age',function(){
  return "old enough";
}]);
$router->get('/fail',function(){
  return "not yet mature";
});

$router->get('/example','ExampleController@key');
$router->post('/postexample','ExampleController@postman');

$router->get('/user/{id}','ExampleController@getUser');
$router->get('/post/cat1/{cat1}/cat2/{cat2}','ExampleController@post');

$router->get('/profile',['as'=>'profile.admin','uses'=>'ExampleController@profile']);
$router->get('/profile/action',['as'=>'profile.admin.action','uses'=>'ExampleController@profileaction']);

$router->get('/foo/bar','ExampleController@foobar');
$router->get('/bar/foo','ExampleController@foobar');

$router->post('/profile/user','ExampleController@profileuser');

$router->get('/response','ExampleController@response');
