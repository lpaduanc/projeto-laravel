<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            // 'posts' => Post::get(),
            // 'posts' => Post::orderBy('id', 'ASC')->paginate(),
            'posts' => Post::latest()->paginate(),
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $storeUpdatePost)
    {
        $data = $storeUpdatePost->all();

        // $storeUpdatePost->file('image');
        if ($storeUpdatePost->image->isValid()) {
            $imageName = Str::of(
                $storeUpdatePost->title
            )->slug('-').'.'.$storeUpdatePost->image->getClientOriginalExtension();

            $image = $storeUpdatePost->image->storeAs('posts', $imageName);

            $data['image'] = $image;
        }

        Post::create($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post criado com sucesso.');
    }

    public function show($id)
    {
        // $post = Post::where('id', $id);

        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        return view('admin.posts.show', [
            'post' => $post,
        ]);
    }

    public function edit($id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->back();
        }

        return view('admin.posts.edit', [
            'post' => $post,
        ]);
    }

    public function update(StoreUpdatePost $storeUpdatePost, $id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->back();
        }

        $data = $storeUpdatePost->all();

        if ($storeUpdatePost->imag && $storeUpdatePost->image->isValid()) {
            if (Storage::exists($post->image)) {
                Storage::delete($post->image);
            }

            $imageName = Str::of(
                $storeUpdatePost->title
            )->slug('-').'.'.$storeUpdatePost->image->getClientOriginalExtension();

            $image = $storeUpdatePost->image->storeAs('posts', $imageName);

            $data['image'] = $image;
        }

        $post->update($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post atualizado com sucesso.');
    }

    public function destroy($id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        if (Storage::exists($post->image)) {
            Storage::delete($post->image);
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post excluído com sucesso');
    }

    public function search()
    {
        //necessário para preservar a paginação
        $filters = $this->request->except('_token');

        $posts = Post::where('title', "{$this->request->search}")
            ->orWhere('content', 'LIKE', "%{$this->request->search}%")
            ->paginate();

        return view('admin.posts.index', [
            'posts' => $posts,
            'filters' => $filters,
        ]);
    }
}
