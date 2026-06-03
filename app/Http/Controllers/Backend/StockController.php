<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use App\Models\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::with('variants')->get();
        $lowStockVariants = Variant::with('product')->where('stock', '<', 10)->get();
        $stockHistories = StockHistory::with('variant.product', 'user')
            ->latest()
            ->limit(50)
            ->get();
            
        return view('admin.stock.index', compact('products', 'lowStockVariants', 'stockHistories'));
    }

    public function stockIn(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:variants,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $variant = Variant::findOrFail($request->variant_id);
        $oldStock = $variant->stock;
        
        $variant->increment('stock', $request->quantity);
        
        StockHistory::create([
            'variant_id' => $variant->id,
            'type' => 'in',
            'quantity' => $request->quantity,
            'note' => $request->note,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', "Stok {$variant->product->name} ({$variant->size}ml) bertambah {$request->quantity}");
    }

    public function stockOut(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:variants,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $variant = Variant::findOrFail($request->variant_id);
        
        if ($variant->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }
        
        $variant->decrement('stock', $request->quantity);
        
        StockHistory::create([
            'variant_id' => $variant->id,
            'type' => 'out',
            'quantity' => $request->quantity,
            'note' => $request->note,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', "Stok {$variant->product->name} ({$variant->size}ml) berkurang {$request->quantity}");
    }

    public function history(Request $request)
    {
        $histories = StockHistory::with('variant.product', 'user')
            ->when($request->variant_id, function ($query, $variantId) {
                return $query->where('variant_id', $variantId);
            })
            ->latest()
            ->paginate(50);
            
        $variants = Variant::with('product')->get();
            
        return view('admin.stock.history', compact('histories', 'variants'));
    }
}
