<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('variants', 'category')
            ->active();

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%');
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Filter by size
        if ($request->filled('size')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('size', $request->size);
            });
        }

        // Filter by price
        if ($request->filled('min_price')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->havingRaw('MIN(price) >= ?', [$request->min_price]);
            });
        }

        if ($request->filled('max_price')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->havingRaw('MIN(price) <= ?', [$request->max_price]);
            });
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::all();
        $contact = Contact::getInfo();

        return view('products.index', compact('products', 'categories', 'contact'));
    }

    public function show($slug)
    {
        $product = Product::with('variants', 'galleries', 'category')
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Increment view count
        $product->increment('views');

        $relatedProducts = Product::with('variants')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->limit(4)
            ->get();

        $contact = Contact::getInfo();

        return view('products.show', compact('product', 'relatedProducts', 'contact'));
    }
}