<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Variant;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'variants')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:products',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'gender' => 'required|in:male,female,unisex',
            'status' => 'required|in:active,inactive',
        ]);

        // Upload thumbnail
        $thumbnailPath = $request->file('thumbnail')->store('products', 'public');

        $product = Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . uniqid(),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'gender' => $request->gender,
            'status' => $request->status,
            'thumbnail' => $thumbnailPath,
            'top_notes' => $request->top_notes,
            'middle_notes' => $request->middle_notes,
            'base_notes' => $request->base_notes,
            'longevity' => $request->longevity,
            'sillage' => $request->sillage,
            'projection' => $request->projection,
            'is_featured' => $request->has('is_featured'),
            'is_best_seller' => $request->has('is_best_seller'),
        ]);

        // Save variants
        if ($request->has('sizes') && is_array($request->sizes)) {
            foreach ($request->sizes as $index => $size) {
                if (!empty($size) && isset($request->prices[$index])) {
                    Variant::create([
                        'product_id' => $product->id,
                        'size' => $size,
                        'price' => str_replace(',', '', $request->prices[$index]),
                        'stock' => $request->stocks[$index] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'required|unique:products,code,' . $product->id,
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'code' => $request->code,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $product->id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'gender' => $request->gender,
            'status' => $request->status,
            'top_notes' => $request->top_notes,
            'middle_notes' => $request->middle_notes,
            'base_notes' => $request->base_notes,
            'longevity' => $request->longevity,
            'sillage' => $request->sillage,
            'projection' => $request->projection,
            'is_featured' => $request->has('is_featured'),
            'is_best_seller' => $request->has('is_best_seller'),
        ];

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        $product->update($data);

        // Update variants
        if ($request->has('variant_ids')) {
            foreach ($request->variant_ids as $index => $variantId) {
                $variant = Variant::find($variantId);
                if ($variant) {
                    $variant->update([
                        'size' => $request->sizes[$index],
                        'price' => str_replace(',', '', $request->prices[$index]),
                        'stock' => $request->stocks[$index],
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(Product $product)
    {
        // Delete thumbnail
        if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
            Storage::disk('public')->delete($product->thumbnail);
        }
        
        // Delete galleries
        foreach ($product->galleries as $gallery) {
            if (Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            $gallery->delete();
        }
        
        // Delete variants
        foreach ($product->variants as $variant) {
            $variant->delete();
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }
}
