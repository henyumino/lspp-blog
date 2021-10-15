<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function store(Request $request, $post_id)
    {
        $request->validate([
            'content' => 'required|max:255'
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $post_id,
            'content' => $request->content
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
    }

    
    public function edit($id)
    {
        $comm = Comment::find($id);

        if($comm->user_id !== Auth::user()->id){
            return redirect()->back();
        }

        return view('pages.editComment', compact('comm'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|max:255'
        ]);

       $comm =  Comment::find($id);

       $comm->content = $request->content;
       $comm->save();

       $post = Post::find($comm->post_id);
       $slug = $post->slug;

        return redirect()->action([PostController::class, 'show'], ['slug' => $slug])->with('success', 'Komentar berhasil diupdate');
    }

    
    public function destroy($id)
    {
        $comm = Comment::find($id);

        if($comm->user_id === Auth::user()->id){
            Comment::destroy($id);
            return redirect()->back()->with('success', 'Komentar berhasil dihapus');
        }
        
        return redirect()->back();

    }
}
