<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('posts.show', compact('post'));
    }

    public function createForm()
    {
        return view('posts.create');
    }

    public function createProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('posts.create.form')
                ->withErrors($validator)
                ->withInput();
        }

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = Str::slug($request->input('title'));

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverPath = $cover->store('post_covers', 'public');
            $post->cover = $coverPath;
        }

        $post->save();

        return redirect()->route('posts.show', ['slug' => $post->slug]);
    }

    public function editForm($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('posts.edit', compact('post'));
    }

    public function editProcess(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'content' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()
                .route('posts.edit.form', ['slug' => $slug])
                ->withErrors($validator)
                ->withInput();
        }

        $post = Post::where('slug', $slug)->firstOrFail();
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if ($request->hasFile('cover')) {
            if ($post->cover) {
                Storage::disk('public')->delete($post->cover);
            }

            $cover = $request->file('cover');
            $coverPath = $cover->store('post_covers', 'public');
            $post->cover = $coverPath;
        }

        $post->save();

        return redirect()->route('posts.show', ['slug' => $post->slug]);
    }

    public function deleteForm($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('posts.delete', compact('post'));
    }

    public function deleteProcess(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if ($post->cover) {
            Storage::disk('public')->delete($post->cover);
        }

        $post->delete();

        return redirect()->route('home');
    }
}

