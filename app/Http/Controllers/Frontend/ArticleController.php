<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Contact;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->orderBy('published_at', 'desc')->paginate(9);
        $categories = Article::published()->distinct()->pluck('category');
        $contact = Contact::getInfo();

        return view('articles.index', compact('articles', 'categories', 'contact'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->published()
            ->firstOrFail();
        
        $article->increment('views');
        
        $relatedArticles = Article::where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->published()
            ->limit(3)
            ->get();
            
        $contact = Contact::getInfo();

        return view('articles.show', compact('article', 'relatedArticles', 'contact'));
    }
}