<?php

namespace App\Http\Controllers;

use App\Models\Product;


class CustomerController extends Controller
{
    public function dashboard()
    {
        return view('customer.dashboard');
    }

    public function product()
    {
        $products = Product::paginate(10);
        return view('customer.products', compact('products'));
    }
}
