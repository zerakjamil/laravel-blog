<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index(){
        $posts = Post::with('category','author')->latest()->filter(request(['search' , 'category' ,'author']));

        return view('admin.posts.index',[
           'posts' => Post::paginate(50)
        ]);
    }
    public function create(){
        return view('admin.posts.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request){

        $post = new Post();

        $data = $request->validate([
            'title' => ['required' , 'min:10' , 'max:100'],
            'excerpt' => ['required'],
            'thumbnail' => $post->exists() ? ['image'] :['required' , 'image'],
            'body' => ['required'],
            'category' => ['required' , Rule::exists('categories' , 'id')]
        ]);
        $data['author_id'] = auth()->id();
        $data['user_id'] = auth()->id();
        $data['slug'] = fake()->slug();
        $data['category_id'] = $data['category'];
        $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        Post::create($data);

        return back()->with('success' , 'your post has been submitted');

    }
    public function edit(Post $post){
        return view('admin.posts.edit' , [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function update(Post $post , Request $request){
        $data = $request->validate([
            'title' => ['required' , 'min:10' , 'max:100'],
            'excerpt' => ['required'],
            'body' => ['required'],
            'thumbnail' => $post->exists() ? ['image'] :['required' , 'image'],
            'category' => ['required'],

        ]);
        $data['author_id'] = auth()->id();
        $data['user_id'] = auth()->id();
        if ($post->category->name != $data['category']){
            $data['category_id'] = $data['category'];
        }

        if($data['thumbnail'] ?? false){
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }

        $post->update($data);

        return redirect()->back()->with('success' , 'Your post has been updated.');

    }

    public function destroy(Post $post){
        $post->delete();
        return back()->with('success' , 'Post Deleted Successfully');
    }


}
