<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::latest()->paginate(10);
        return view('product.index', compact('products'));
    }

    public function create(): View
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'         => 'required|image|mimes:jpg,jpeg,png|max:2000',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10,',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric',
        ]);

        $image = $request->file('image');
        $image->storeAs('product', $image->hashName());

        Product::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock,
        ]);

        return redirect()->route('product.index')
            ->with('success', 'Product Berhasil Ditambahkan');
    }

    public function show(string $id): View
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'image'       => 'nullable|image|mimes:jpeg,jpg,png|max:2000',
            'title'       => 'required|min:5',
            'description' => 'required|min:10',
            'price'       => 'required|numeric',
            'stock'       => 'required|numeric',
        ]);
        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::delete('product/'. $product->image);
            $image = $request->file('image');
            $image->storeAs('product', $image->hashName());

            $product->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock,
            ]);
        } else {
            $product::update([
                'title'         => $request->title,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock,
            ]);
        }

        return redirect()
        ->route('product.index')
        ->with(['success' => 'Data Berhasil DiUpdate']);
    }

    public function destroy(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        // hapus image
        Storage::delete('product/'. $product->image);
        // hapus data
        $product->delete();
        return redirect()
            ->route('product.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
