<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    
    public function index()
    {
        $cat = Category::all();
        return view('pages.addPost', compact('cat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'mimes:jpg,png,jpeg|max:1024',
            'category' => 'nullable'
        ]);

        if(isset($request->thumbnail)){
            $random_num = Str::random(10);
            $time = time();
            $request->thumbnail->storeAs('public/thumbnail', $time.'_'.$random_num.'.jpg');
            $image = $time.'_'.$random_num.'.jpg';
        }
        else{
            $image = 'thumbnail.jpg';
        }

        if(!isset($request->category)){
            $category = 1;
        }
        else{
            $category = $request->category;
        }

        $slug = Str::slug($request->title, '-').'-'.Str::random(10);

        Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'user_id' => Auth::user()->id,
            'content' => $request->content,
            'thumbnail' => $image,
            'category' => $category
        ]);

        return redirect()->route('dashboard')->with('success', 'Post berhasil ditambahkan');
    }

    
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('pages.show', compact('post'));
    }

    
    public function edit($id)
    {
        $data = Post::find($id);
        $cat = Category::all();
        return view('pages.editPost', compact('data','cat'));
    }

    
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'mimes:jpg,png,jpeg|max:1024',
            'category' => 'nullable'
        ]);

        if(isset($request->thumbnail)){
            $random_num = Str::random(10);
            $time = time();
            $request->thumbnail->storeAs('public/thumbnail', $time.'_'.$random_num.'.jpg');
            $image = $time.'_'.$random_num.'.jpg';
        }
        else{
            $image = $post->thumbnail != 'thumbnail.jpg' ? $post->thumbnail : 'thumbnail.jpg';
        }

        if(!isset($request->category)){
            $category = 1;
        }
        else{
            $category = $request->category;
        }

        $slug = Str::slug($request->title, '-').'-'.Str::random(10);
        
        $post->title = $request->title;
        $post->content = $request->content;
        $post->slug = $slug;
        $post->thumbnail = $image;
        $post->category = $request->category;
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Post berhasil diupdate');
    }

    
    public function destroy($id)
    {
        Post::destroy($id);

        return redirect()->route('dashboard')->with('success', 'Post berhasil dihapus');
    }


    public function showAllPost(){
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('pages.welcome', compact('posts'));
    }

}
