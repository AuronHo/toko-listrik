<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = 'user';

        return view('dashboard.products.index', [
            'title' => 'List of Products',
            'products' => product::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create', [
            'title' => 'Create New Products',
            'categories' => Category::all(),
            'currencies' => Currency::all(),
            'discounts' => Discount::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:products', 
            'category_id' => 'required',
            'price' => 'required',
            'currency_id' => 'required',
            'stock' => 'required',
            'discount_id' => 'required',
            'status' => 'required|max:50',
            'image' => 'image|file'
        ]);

        if($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('products-image', 'public');
        }

        Product::create($validatedData);

        return redirect('/dashboard/products')->with('success', 'New Product Has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        return view('dashboard.products.edit', [
            'product' => $product, 
            'title' => 'Edit',
            'categories' => Category::all(),
            'currencies' => Currency::all(),
            'discounts' => Discount::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $user = 'user';

        $rules = [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'price' => 'required',
            'currency_id' => 'required',
            'stock' => 'required',
            'discount_id' => 'required',
            'status' => 'required|max:50',
            'image' => 'image|file'
        ];


        if($request->slug != $product->slug) {
            $rules['slug'] = 'required|unique:products';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('products-image', 'public');
        }

        Product::where('id', $product->id)
            ->update($validatedData);

        return redirect('/dashboard/products')->with('success', 'The Product Has been Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if($product->image) {
            Storage::delete($product->image);
        }

        Product::destroy($product->id);

        return redirect('/dashboard/products')->with('success', 'The Product Has been Deleted!');

        dd('Destroy method called');
    }

    public function checkSlug(Request $request) 
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
