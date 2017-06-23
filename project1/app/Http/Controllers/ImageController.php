<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Like $like)
    {
        //
        $images = Image::orderBy('created_at', 'desc')
            ->get();
        return view('home1', [
            'images' => $images,
            'like' => $like
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        Image::create([
            'scope' => $request->scope,
            'description' => $request->description,
            'path' => $request->path,
            'user_id' => Auth::user()->id,
            'like'  => '0',
        ]);
        return redirect('home');
    }
    public function destroy(Request $request)
    {
        //
        $imageId = $request->imageId;
        $image = Image::find($imageId);
        // Kiểm tra sở hữu ảnh
        if ($image && $image->user_id === Auth::user()->id) {
            // Xóa dữ liệu ảnh trong Image, Comment và Like
            $image->delete();
            Comment::where('user_id', Auth::user()->id);
            Like::where('user_id', Auth::user()->id);
            return redirect('home');

        }
        else {
            return redirect('/error');
        }
    }
    /* Phương thức di chuyển ảnh vào thư mục images trước khi đăng*/
    public function moveImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:png,jpeg,jpg,gif|max:10240'
        ]);

        $file = $request->file('image');
        $destinationPath = config('app.storeimage');

        $file->move($destinationPath, $file->getClientOriginalName());
        return view('postimage', [
            'path' => $file->getClientOriginalName()
        ]);
    }
    public function storeImage(Request $request)
    {
        $images = Image::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('storeimage', [
            'images' => $images
        ]);
    }
    /* Phương thức show thông tin ảnh trước khi chỉnh sửa */
    public function showImage(Request $request)
    {
        $imageId = $request->id;
        // Chỉ được phép chỉnh sửa nếu ảnh đúng là của user
        $image = Image::find($imageId);
        if ($image && $image->user_id === Auth::user()->id) {
            return view('editimage', [
                'image' => $image
            ]);
        } else {
            return redirect('/error');
        }
    }
    /* Phương thức cập nhật thông tin ảnh */
    public function updateImage(Request $request)
    {
        $scope = $request->scope;
        $description = $request->description;
        $imageId = $request->imageId;
        // Chỉ cập nhật nếu ảnh đúng là của user
        $image = Image::find($imageId);
        if ($image && $image->user_id === Auth::user()->id) {
            $image->scope = $request->scope;
            $image->description = $request->description;
            $image->save();
            return redirect('storeimage');
        } else {
            return redirect('/error');
        }
    }
    /* Phuowng thức show ảnh trước khi xóa */
    public function isDeleteImage(Request $request)
    {
        $imageId = $request->id;
        $image = Image::find($imageId);

        // Kiểm tra quyền sở hữu ảnh ^^
        if ($image && $image->user_id === Auth::user()->id) {
            return view('deleteimage', [
                'image' => $image
            ]);
        }
        else {
            return redirect('/error');
        }
    }
}
