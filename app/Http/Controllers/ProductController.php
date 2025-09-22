<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'about' => 'required|string',
            'price' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
            'photo' => 'required|image|mimes:png,svg,jpg,jpeg,webp',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('product_photos','public');
                $validated['photo'] = $photoPath;
            }
            $validated['slug'] = Str::slug($request->name);

            $newProduct = Product::create($validated);
            DB::commit();

            return redirect()->route('admin.products.index');
        } catch (\Exception $e) {
            DB::rollback();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!'. $e->getMessage()],
            ]);

            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string:max:255',
            'about' => 'sometimes|string',
            'price' => 'sometimes|integer',
            'category_id' => 'sometimes|integer|exists:categories,id',
            'photo' => 'sometimes|images|mimes:svg,png,jpg,jpeg,webp',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('product_photos', 'public');
                $validated['photo'] = $photoPath;
            }
            $validated['slug'] = Str::slug($request->name);
            
            $product->update($validated);
            DB::commit();

            return redirect()->route('admin.products.index');
        } catch (\Exception $e) {
            DB::rollback();
            $error = ValidationException::withMessages([
                'system_error' => ['System Error!'. $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['system_error'. $e->getMessage()],
            ]);
            throw $error;
        }
    }
}
