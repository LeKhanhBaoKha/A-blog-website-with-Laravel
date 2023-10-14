<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
class Post
{
    public static function find($slug)
    {
        //B2:kiểm tra đường dẫn có tồn tại ko
        if (file_exists($path = resource_path("posts/{$slug}.html")) == false) {
            // dd('file does not exist');
            //return redirect('/');
            throw new ModelNotFoundException();
            // abort(404);
        }

        //B3: có thì lấy nội dung
        //nếu như có 10000 người truy cập thì phải lấy nội dung 10000 lần dùng cache
        return $post = cache()->remember("posts.{$slug}", 1200, fn () =>  file_get_contents($path));
    }

    public static function All(){
        $files = File::files(resource_path("posts/"));
        return array_map(fn($file) => $file->getContents(), $files);
    }
}
