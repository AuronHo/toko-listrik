<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB; 

class CartController extends Controller
{
    public function add(Request $request)
    {
        $user = 'user';

        // Validate the input
        $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = \App\Models\Cart::where('user_id', auth()->$user()->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            // If the item exists in the cart, increment the quantity
            $cartItem->increment('quantity', $request->quantity);
        } else {
            // If the item does not exist, create a new cart entry
            \App\Models\Cart::create([
                'user_id' => auth()->$user()->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function remove(Request $request)
    {
        $user = 'user';

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        try {
            $userId = auth()->$user()->id;

            // Find the cart item
            $cartItem = Cart::where('user_id', $userId)
                            ->where('product_id', $validated['product_id'])
                            ->first();

            if ($cartItem) {
                if ($cartItem->quantity > 1) {
                    // Reduce quantity by 1
                    $cartItem->decrement('quantity', 1);
                    return redirect()->back()->with('success', 'Quantity reduced by 1');
                } else {
                    // If quantity is 1, remove the product entirely
                    $cartItem->delete();
                    return redirect()->back()->with('success', 'Product removed from cart');
                }
            }

            return redirect()->back()->with('error', 'Product not found in cart');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $user = 'user';
        $cartItems = Cart::with('product')->where('user_id', auth()->$user()->id)->get();
        return view('cart.index', compact('cartItems'));
    }


}
