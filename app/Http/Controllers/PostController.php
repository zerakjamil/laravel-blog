<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        $posts = Post::with('category','author')->latest()->filter(request(['search' , 'category' ,'author']));

        return view('posts',[
            'posts' => $posts->paginate(6)->withQueryString(),
            'categories' => Category::all(),
            'search' => request('search'),
            'pageNumbers' => Post::count() / 6,
        ]);
    }

    public function show(Post $post): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('first-post' , [
            'posts' => $post,
            'comments' => Comment::where('post_id' , $post->id)->latest()->get(),
            'likes' => Like::all(),
        ]);
    }

    Public function categoryIndex(Category $category){
        return view('posts',[
            'posts' => Post::with('category' , 'author')->where('category_id' , $category->id)->paginate(6),
        ]);
    }

}
