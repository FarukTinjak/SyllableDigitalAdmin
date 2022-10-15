<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class ImagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function uploadImageFile(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $image = $request->file('image');
        $response = [
            "success" => !!$image
        ];
        if($image) {

            $imagepath = (microtime(true) * 10000). '.'. strtolower($image->getClientOriginalExtension());
            $destinationPath = public_path('uploads/images');
            $image->move($destinationPath, $imagepath);

            $response["file"] = [
                "url" => url( '/uploads/images/'. $imagepath)
            ];
        }

        return $response;
    }

}
