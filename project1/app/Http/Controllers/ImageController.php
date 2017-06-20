<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    /* Phương thức lấy toàn bộ ảnh và các ảnh đã like của người dùng */
    public function getImage(Image $image, Like $like)
    {
        // Get all images in database
        $images = $image->getImage();
        // Get all images what user liked
        return view('home1', [
            'images' => $images,
            'like' => $like
        ]);
    }
    /* Phương thức di chuyển ảnh vào thư mục images */
    public function moveImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:png,jpeg,jpg,gif|max:10240'
        ]);

        $file = $request->file('image');

        // Move Uploaded File
        $destinationPath = 'images';
        $file->move($destinationPath, $file->getClientOriginalName());
        return view('postimage', [
            'path' => $file->getClientOriginalName()
        ]);
    }
    /* Phương thức đăng ảnh */
    public function postImage(Request $request, Image $image)
    {
        $scope = $request->scope;
        $description = $request->description;
        $path = $request->path;
        $userId = Auth::user()->id;
        if ($image->postImage($scope, $description, $path, $userId)) {
            return redirect('home');
        }
    }
}
