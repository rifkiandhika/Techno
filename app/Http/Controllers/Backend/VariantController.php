<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index(Product $product)
    {
        $variants = $product->variants;
        return view('admin.variants.index', compact('product', 'variants'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'size' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Variant::create([
            'product_id' => $product->id,
            'size' => $request->size,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.products.edit', $product)->with('success', 'Varian berhasil ditambahkan');
    }

    public function update(Request $request, Variant $variant)
    {
        $request->validate([
            'size' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $variant->update($request->all());

        return redirect()->back()->with('success', 'Varian berhasil diupdate');
    }

    public function destroy(Variant $variant)
    {
        $product = $variant->product;
        $variant->delete();
        
        return redirect()->route('admin.products.edit', $product)->with('success', 'Varian berhasil dihapus');
    }
}
