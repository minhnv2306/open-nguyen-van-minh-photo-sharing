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
}
