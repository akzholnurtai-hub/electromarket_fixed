<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;

class ElectroMarketController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function login()
    {
        return view('login');
    }

    public function loginCheck(Request $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect('/home');
        }

        return back()->with('message', 'Қате email немесе пароль');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function register()
    {
        return view('register');
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = \App\Models\User::create([
            'name'     => $request->fullname,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('client');

        Auth::login($user);

        return redirect('/home');
    }

    public function analytics()
    {
        $totalOrders   = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue  = Order::where('status', '!=', 'cancelled')->sum('total_price');
        $totalProducts = Product::count();

        return view('analytics', compact('totalOrders', 'pendingOrders', 'totalRevenue', 'totalProducts'));
    }

    public function profile()
    {
        $user   = Auth::user();
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('profile', compact('user', 'orders'));
    }

    public function productDetail($id)
    {
        $product = Product::findOrFail($id);
        return view('product-detail', compact('product'));
    }

    public function orders()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Статус жаңартылды!');
    }
}
