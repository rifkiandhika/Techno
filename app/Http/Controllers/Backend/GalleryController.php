<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Product $product)
    {
        $galleries = $product->galleries()->orderBy('order')->get();
        return view('admin.gallery.index', compact('product', 'galleries'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'type' => 'required|in:thumbnail,packaging,lifestyle,detail',
        ]);

        foreach ($request->file('images') as $image) {
            $path = $image->store('product-galleries', 'public');
            
            ProductGallery::create([
                'product_id' => $product->id,
                'image' => $path,
                'type' => $request->type,
                'order' => $product->galleries()->max('order') + 1,
            ]);
        }

        return redirect()->back()->with('success', 'Gambar berhasil ditambahkan');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->orders as $id => $order) {
            ProductGallery::where('id', $id)->update(['order' => $order]);
        }
        
        return response()->json(['success' => true]);
    }

    public function destroy(ProductGallery $gallery)
    {
        if (Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }
        
        $gallery->delete();
        
        return redirect()->back()->with('success', 'Gambar berhasil dihapus');
    }
}
