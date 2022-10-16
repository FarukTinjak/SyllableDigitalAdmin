<?php
namespace App\Http\Controllers;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::get();

        return view('dashboard.blog-index')
            ->with('posts', $posts);
    }

    public function create() {
        $post = new BlogPost();

        return view('dashboard.blog-upsert')
            ->with('post', $post);
    }

    public function edit($id) {
        $post = BlogPost::find($id);
        if(!$post)
            abort(404);

        return view('dashboard.blog-upsert')
            ->with('post', $post);
    }
    public function save(Request $request)
    {
        if(($blog_id = (int)$request->post('id')) != 0){
            $blog = BlogPost::find($blog_id);
            if(!$blog)
                return abort(404);
        }
        else {
            $blog = new BlogPost();
        }
        $blog->fill($request->all());
        $blog->slug = Str::slug($blog->title);

        $destinationPath = public_path('uploads/images');

        if($image = $request->file('thumbnail')) {
            $imagePath = (microtime(true) * 10000). '.'. strtolower($image->getClientOriginalExtension());
            $image->move($destinationPath, $imagePath);

                $blog->thumbnail_path = 'uploads/images/' . $imagePath;
        }

        $blog->save();

        return $blog;
    }
    public function delete($id)
    {
        $video = BlogPost::find($id);
        if(!$video)
            return abort(404);

        $video->delete();
        return redirect()->route('dashboard.blog');
    }
}
