<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('customer.cart', compact('cartItems', 'total'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id) // ✅ diperbaiki
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return redirect()->back()->with('success', 'Product Added To Cart');
    }

    public function update(Request $request, $cartId)
    {
        $cartItem = Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();

        return redirect()->back()->with('success', 'Cart Updated');
    }

    public function remove($cartId)
    {
        Cart::where('id', $cartId)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->back()->with('success', 'Item Removed From Cart');
    }
}
