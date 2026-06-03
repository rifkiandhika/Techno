<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = ['Tips Parfum', 'Lifestyle', 'Review Produk', 'Edukasi Aroma'];
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:articles',
            'category' => 'required|string',
            'content' => 'required',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'is_published' => 'boolean',
        ]);

        $imagePath = $request->file('featured_image')->store('articles', 'public');

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'category' => $request->category,
            'content' => $request->content,
            'featured_image' => $imagePath,
            'is_published' => $request->has('is_published'),
            'published_at' => $request->has('is_published') ? now() : null,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit(Article $article)
    {
        $categories = ['Tips Parfum', 'Lifestyle', 'Review Produk', 'Edukasi Aroma'];
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:articles,title,' . $article->id,
            'category' => 'required|string',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . $article->id,
            'category' => $request->category,
            'content' => $request->content,
            'is_published' => $request->has('is_published'),
        ];

        if ($request->has('is_published') && !$article->is_published) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image && Storage::disk('public')->exists($article->featured_image)) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diupdate');
    }

    public function destroy(Article $article)
    {
        if ($article->featured_image && Storage::disk('public')->exists($article->featured_image)) {
            Storage::disk('public')->delete($article->featured_image);
        }
        
        $article->delete();
        
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus');
    }
}
