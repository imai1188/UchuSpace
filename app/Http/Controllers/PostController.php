<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(5);
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
            'content' => 'required|max:500',
            'spotify_track_id' => 'nullable|string',
        ], [
            'content.required' => '本文は必須項目です。',
            'content.max' => '本文は500文字以内で入力してください。',
        ]);

        $validated['user_id'] = Auth::id();

        // Spotifyの曲情報を取得
        if ($request->spotify_track_id) {
            \Log::info('Spotify Track ID:', [$request->spotify_track_id]); // ここ追加
            $trackInfo = $this->getSpotifyTrackInfo($request->spotify_track_id);
            \Log::info('Track Info:', [$trackInfo]);
            // 曲情報が取得できたらvalidated配列に追加
            if ($trackInfo) {

                $validated['track_name'] = $trackInfo['name'];
                $validated['artist_name'] = $trackInfo['artist'];
                $validated['preview_url'] = $trackInfo['preview_url'];
                $validated['album_image_url'] = $trackInfo['album_image_url'];
            }
        }
        // バリデーションを通過し新しい投稿を作成
        Post::create($validated);

        $request->session()->flash('message', 'Saved');
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
        // ユーザー確認
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // ユーザー確認
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        $validated = $request->validate([
            'content' => 'required|max:500',
            'spotify_track_id' => 'nullable|string',
        ], [
            'content.required' => '本文は必須項目です。',
            'content.max' => '本文は500文字以内で入力してください。',
        ]);

        $validated['user_id'] = Auth::id();

        // トラックIDが入力されていたらSpotifyの曲情報取得
        if ($request->spotify_track_id) {
            $trackInfo = $this->getSpotifyTrackInfo($request->spotify_track_id);
            if ($trackInfo) {
                $validated['spotify_track_id'] = $request->spotify_track_id;
                $validated['track_name'] = $trackInfo['name'];
                $validated['artist_name'] = $trackInfo['artist'];
                $validated['preview_url'] = $trackInfo['preview_url'];
                $validated['album_image_url'] = $trackInfo['album_image_url'];
            }
        }

        $post->update($validated);

        $request->session()->flash('message', 'Updated');
        return back();
    }

    public function delete(Post $post)
    {
        // ユーザー確認
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }
        return view('post.delete', compact('post'));
    }
    public function destroy(Post $post)
    {
        // ユーザー確認
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('message', 'Deleted');
    }

    public function getSpotifyAccessToken()
    {
        $clientId = config('services.spotify.client_id');
        $clientSecret = config('services.spotify.client_secret');

        $response = Http::asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ]);

        $accessToken = $response->json()['access_token'];

        return $accessToken;
    }

    // 曲情報を取ってくる関数
    public function getSpotifyTrackInfo($trackId)
    {
        $accessToken = $this->getSpotifyAccessToken();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get("https://api.spotify.com/v1/tracks/{$trackId}");

        if ($response->successful()) {
            $data = $response->json();
            return [
                'name' => $data['name'],
                'artist' => $data['artists'][0]['name'],
                'preview_url' => $data['preview_url'],
                'album_image_url' => $data['album']['images'][0]['url'] ?? null,
            ];
        }

        return null;
    }
}
