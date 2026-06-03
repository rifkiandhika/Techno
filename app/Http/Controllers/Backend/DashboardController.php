<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Variant;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalVariants = Variant::count();
        
        $lowStockProducts = Variant::with('product')
            ->where('stock', '<', 10)
            ->where('stock', '>', 0)
            ->get();
        
        $outOfStockProducts = Variant::with('product')
            ->where('stock', 0)
            ->get();
        
        $recentProducts = Product::with('category')->latest()->limit(5)->get();
        
        $productsPerCategory = Category::withCount('products')->get();
        
        $stockPerCategory = Category::with(['products.variants'])->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'stock' => $category->products->sum(function ($product) {
                        return $product->variants->sum('stock');
                    })
                ];
            });

        return view('admin.dashboard.index', compact(
            'totalProducts', 'totalCategories', 'totalVariants',
            'lowStockProducts', 'outOfStockProducts', 'recentProducts', 
            'productsPerCategory', 'stockPerCategory'
        ));
    }
}