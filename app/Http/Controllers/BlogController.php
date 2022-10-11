<?php
namespace App\Http\Controllers;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::get();

        return view('dashboard.blog-index')
            ->with('posts', $posts);
    }
}
