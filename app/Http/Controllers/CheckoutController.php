<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function remove(Request $request)
    {
        $user = 'user';

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        try {
            // Get the currently authenticated user's ID
            $userId = auth()->$user()->id;
        
            // Delete all cart items related to this user
            Cart::where('user_id', $userId)->delete();
        
            return redirect('/products')->with('success', 'Transaction have been completed!');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
        
    }
}
