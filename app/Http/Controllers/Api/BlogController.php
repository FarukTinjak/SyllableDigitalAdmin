<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function get()
    {
        $posts = BlogPost::orderByDesc('created_at')
                    ->get();

        return $posts;
    }

    public function getById($id) {
        $post = BlogPost::find($id);
        if(!$post)
            abort(404);

        return $post;
    }
}
