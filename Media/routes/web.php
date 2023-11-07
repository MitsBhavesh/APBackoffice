<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\index;
use App\Http\Controllers\Home;
use App\Http\Controllers\Post;
use App\Http\Controllers\Video;
use App\Http\Controllers\News;
use App\Http\Controllers\Help_disk;
use App\Http\Controllers\Edit_profile;
use App\Http\Controllers\Update;
use App\Http\Controllers\Res;
use App\Http\Controllers\Add_image;
use App\Http\Controllers\Login;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Notification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');



Route::get('/',[Home::class,'index']);
Route::get('/Login',[Login::class,'index']);
Route::post('/LoginProcess',[Login::class,'GETdata']);

Route::group(['middleware' => ['checkLogin']], function () {

Route::get('/Notification',[Notification::class,'index']);
Route::get('/post',[Post::class,'index']);
Route::get('/Logout',[Logout::class,'index']);
Route::get('/video',[Video::class,'index']);
Route::get('/news',[News::class,'index']);
Route::get('/help_disk',[Help_disk::class,'index']);
Route::get('/edit_profile',[Edit_profile::class,'index']);
Route::get('/update',[Update::class,'index']);
Route::get('/Res',[Res::class,'index']);
Route::post('/updatedata',[update::class,'updatedata']);

// Route::get('/Update',[Edit_profile::class,'Update']);
Route::post('/edit',[Edit_profile::class,'Update']);
// Route::get('/deleterecord',[Add_image::class,'viewrecord']);
Route::get('/Add_image',[Add_image::class,'index']);
Route::post('/Add_images',[Add_image::class,'insert']); 
Route::get('/Add_images',[Add_image::class,'insert']); 

});

// Route::get('insert','StudInsertController@insertform');
// Route::post('create','StudInsertController@insert');