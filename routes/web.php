<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

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

Route::get('/', function () {
    return view('posts', ['posts' => Post::All()]);
});

// Route::get('post', function(){
//     return view('post');
// });

Route::get('posts/{post}', function($slug){
    // nội dung sau posts sẽ là {post} và đc lưu trong biến $slug

    //find a post by its slug and pass it to a view called "post"
    return view('post', ['post' => Post::find($slug)]);
})->where('post', '^[a-zA-Z_-]+$');



