<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Себет беті
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart', compact('cartItems', 'total'));
    }

    // Себетке қосу
    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $existing = CartItem::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            $existing->increment('quantity');
        } else {
            CartItem::create([
                'user_id'    => Auth::id(),
                'product_id' => $request->product_id,
                'quantity'   => 1,
            ]);
        }

        return back()->with('success', '✅ Өнім себетке қосылды!');
    }

    // Санын жаңарту
    public function update(Request $request, $id)
    {
        $item = CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $qty = (int) $request->quantity;

        if ($qty <= 0) {
            $item->delete();
        } else {
            $item->update(['quantity' => $qty]);
        }

        return back()->with('success', 'Жаңартылды!');
    }

    // Себеттен өшіру
    public function remove($id)
    {
        CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return back()->with('success', 'Өнім өшірілді!');
    }
}
