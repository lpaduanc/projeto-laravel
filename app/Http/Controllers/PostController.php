<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        return view ('admin.posts.index', [
            'posts' => Post::get(),
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $storeUpdatePost)
    {
        Post::create($storeUpdatePost->all());

        return redirect()->route('posts.index');
    }

    public function destroy()
    {

    }
}
