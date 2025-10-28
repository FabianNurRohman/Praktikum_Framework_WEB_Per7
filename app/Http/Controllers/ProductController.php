<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource (with search, filter & sorting).
     */
    public function index(Request $request)
    {
        $query = Product::query();
    
        $search = $request->input('search');
        $sort = $request->input('sort', 'default'); // default sorting
    
        // 🔍 Pencarian
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('product_name', 'like', '%' . $search . '%')
                  ->orWhere('type', 'like', '%' . $search . '%')
                  ->orWhere('producer', 'like', '%' . $search . '%');
            });
        }
    
        // 🔽 Sorting
        switch ($sort) {
            case 'name':
                $query->orderBy('product_name', 'asc');
                break;
            case 'type':
                $query->orderBy('type', 'asc');
                break;
            case 'producer':
                $query->orderBy('producer', 'asc');
                break;
            default:
                // Default: urut berdasarkan produk terbaru
                $query->orderBy('created_at', 'asc');
                break;
        }
    
        $products = $query->paginate(4);
    
        return view('master-data.product-master.index-product', compact('products', 'sort', 'search'));
    }    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("master-data.product-master.create-product");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input data
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'information' => 'nullable|string',
            'qty' => 'required|integer',
            'producer' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        Product::create($validatedData);

        return redirect()->route('product-index')->with('success', 'Product berhasil ditambahkan!');
    }

    /**
     * Display the specified resource (show detail product).
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('master-data.product-master.detail-product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('master-data.product-master.edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'information' => 'nullable|string',
            'qty' => 'required|integer',
            'producer' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validatedData);

        return redirect()->route('product-index')->with('success', 'Product berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product-index')->with('success', 'Product berhasil dihapus!');
    }
}
