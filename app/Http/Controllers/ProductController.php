<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('products', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-detail', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required',
            'price'       => 'required|integer',
            'description' => 'nullable',
            'image'       => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $data['image'] = 'images/' . $filename;
        }

        Product::create($data);

        return redirect('/products')->with('success', '✅ Өнім қосылды!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', '🗑️ Өнім өшірілді!');
    }
}
