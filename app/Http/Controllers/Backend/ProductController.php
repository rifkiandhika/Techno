<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Variant;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'code'        => 'required|unique:products',
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'thumbnail'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'gender'      => 'required|in:male,female,unisex',
            'status'      => 'required|in:active,inactive',
        ]);

        // Upload thumbnail ke public/images/products
        $file          = $request->file('thumbnail');
        $filename      = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/products'), $filename);
        $thumbnailPath = 'images/products/' . $filename;

        $product = Product::create([
            'code'          => $request->code,
            'name'          => $request->name,
            'slug'          => Str::slug($request->name) . '-' . uniqid(),
            'category_id'   => $request->category_id,
            'description'   => $request->description,
            'gender'        => $request->gender,
            'status'        => $request->status,
            'thumbnail'     => $thumbnailPath,
            'top_notes'     => $request->top_notes,
            'middle_notes'  => $request->middle_notes,
            'base_notes'    => $request->base_notes,
            'longevity'     => $request->longevity,
            'sillage'       => $request->sillage,
            'projection'    => $request->projection,
            'is_featured'   => $request->has('is_featured'),
            'is_best_seller' => $request->has('is_best_seller'),
        ]);

        // Simpan variants
        if ($request->has('sizes') && is_array($request->sizes)) {
            foreach ($request->sizes as $index => $size) {
                if (!empty($size) && isset($request->prices[$index])) {
                    Variant::create([
                        'product_id' => $product->id,
                        'size'       => $size,
                        'price'      => str_replace(',', '', $request->prices[$index]),
                        'stock'      => $request->stocks[$index] ?? 0,
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
            'code'        => 'required|unique:products,code,' . $product->id,
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'thumbnail'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'code'          => $request->code,
            'name'          => $request->name,
            'slug'          => Str::slug($request->name) . '-' . $product->id,
            'category_id'   => $request->category_id,
            'description'   => $request->description,
            'gender'        => $request->gender,
            'status'        => $request->status,
            'top_notes'     => $request->top_notes,
            'middle_notes'  => $request->middle_notes,
            'base_notes'    => $request->base_notes,
            'longevity'     => $request->longevity,
            'sillage'       => $request->sillage,
            'projection'    => $request->projection,
            'is_featured'   => $request->has('is_featured'),
            'is_best_seller' => $request->has('is_best_seller'),
        ];

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama
            if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                @unlink(public_path($product->thumbnail));
            }

            $file          = $request->file('thumbnail');
            $filename      = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $data['thumbnail'] = 'images/products/' . $filename;
        }

        $product->update($data);

        // Update variants
        if ($request->has('variant_ids')) {
            foreach ($request->variant_ids as $index => $variantId) {
                $variant = Variant::find($variantId);
                if ($variant) {
                    $variant->update([
                        'size'  => $request->sizes[$index],
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
        // Hapus thumbnail
        if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
            @unlink(public_path($product->thumbnail));
        }

        // Hapus galleries
        foreach ($product->galleries as $gallery) {
            if (file_exists(public_path($gallery->image))) {
                @unlink(public_path($gallery->image));
            }
            $gallery->delete();
        }

        // Hapus variants
        foreach ($product->variants as $variant) {
            $variant->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus');
    }
}