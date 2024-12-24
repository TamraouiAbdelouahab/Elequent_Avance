<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::All();
        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.article.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valideted = $request->validate([
            'title'=> 'required',
            'content'=> 'required',
            'category'=> 'required',
            'tags'=>'array',
            'tags.*' => 'exists:tags,id'
        ]);

        $article = Article::create([
            'title'=> $valideted['title'],
            'content'=> $valideted['content'],
            'user_id'=>Auth::user()->id,
            'category_id'=> $valideted['category'],
        ]);
        $article->tags()->attach($request->tags);



        return redirect()->route('article.index')->with('success', 'Article créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('admin.article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.article.edit',compact('article','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $valideted = $request->validate([
            'title'=> 'required',
            'content'=> 'required',
            'category'=> 'required',
            'tags'=>'array',
            'tags.*' => 'exists:tags,id'
        ]);

        $article->update([
            'title'=> $valideted['title'],
            'content'=> $valideted['content'],
            'category_id'=> $valideted['category'],
        ]);
        $article->tags()->sync($request->tags);

        return redirect()->route('article.index')->with('success', 'Article créé avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Article $article)
    {
        // $article = Article::find($id);
        $article->delete();
        return redirect()->route('article.index')->with('success', 'Article supprimé avec succès.');
    }
}