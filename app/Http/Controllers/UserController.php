<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        $id = Auth::user()->id;
        $data = Post::where('user_id', $id)->with('categories')->get();
        return view('pages.dashboard', compact('data'));
    }

    
    public function showCategory()
    {
        $data = Category::all();
        return view('pages.category', compact('data'));
    }

    public function showCategoryForm(){
        return view('pages.categoryForm');
    }

    public function addCategory(Request $request){
        $request->validate([
            'category' => 'required'
        ]);

        $cat = new Category;
        $cat->name = $request->category;
        $cat->save();

        return redirect()->route('category')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function showEditCategory($id){
        $data = Category::find($id);
        return view('pages.editCategory', compact('data'));
    }

    public function updateCategory(Request $request, $id){
        $request->validate([
            'category' => 'required'
        ]);

        $cat = Category::find($id);
        $cat->name = $request->category;
        $cat->save();

        return redirect()->route('category')->with('success', 'Kategori berhasil diupdate');

    }

    public function deleteCategory($id){
        $data = Category::find($id);
        $data->delete();

        return redirect()->route('category')->with('success', 'Kategori berhasil dihapus');
    }

    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
