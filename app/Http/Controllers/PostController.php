<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $posts = Post::with('user')->get();  // 投稿とそのユーザー情報を一度に取得
        $posts = Post::with('user')->paginate(10);  // 1ページに10件ずつ表示
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|max:500'
        ], [
            'content.required' => '本文は必須項目です。',
            'content.max' => '本文は500文字以内で入力してください。',
        ]);

        $validated['user_id'] = Auth::id();
        // バリデーションを通過したデータを使って新しい投稿を作成
        $post = Post::create($validated);

        $post = Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);
        $request->session()->flash('message', '保存しました');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|max:500'
        ], [
            'content.required' => '本文は必須項目です。',
            'content.max' => '本文は500文字以内で入力してください。',
        ]);

        $validated['user_id'] = Auth::id();
        $post->update($validated);

        $request->session()->flash('message', '更新しました');
        return back();
    }

    public function delete(Post $post)
    {
        return view('post.delete', compact('post'));
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
