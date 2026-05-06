<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Тапсырыс беру беті
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', '⚠️ Себет бос!');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('checkout', compact('cartItems', 'total'));
    }

    // Тапсырысты орналастыру
    public function store(Request $request)
    {
        $request->validate([
            'full_name'      => 'required|string|max:100',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string|max:255',
            'city'           => 'required|string|max:100',
            'payment_method' => 'required|in:cash,card,online',
        ]);

        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', '⚠️ Себет бос!');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id'        => Auth::id(),
            'full_name'      => $request->full_name,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'city'           => $request->city,
            'payment_method' => $request->payment_method,
            'total_price'    => $total,
            'status'         => 'pending',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        // Себетті тазарту
        CartItem::where('user_id', Auth::id())->delete();

        return redirect('/products')->with('success', '✅ Тапсырысыңыз қабылданды! Тапсырыс №' . $order->id);
    }
}
