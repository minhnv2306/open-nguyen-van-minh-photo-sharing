<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    public function getImage(Image $image, Like $like)
    {
        // Get all images in database
        $images = $image->getImage();
        // Get all images what user liked
        if (Auth::check()) {
            $userId = Auth::user()->id;
            $tablelike = $like->getLikeByUserId($userId);
        }
        else {
            $tablelike = null;
        }
        return view('home1', [
            'images' => $images,
            'tablelike' => $tablelike
        ]);
    }
}
