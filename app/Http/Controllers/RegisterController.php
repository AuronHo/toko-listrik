<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class RegisterController extends Controller
{   
    public function index() 
    {
        if (Auth::check()) {
            return redirect('/'); // Redirect to home if already logged in
        }
        
        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request) 
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:5|max:50|unique:users',
            'email'=> 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);
     
        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration was successful! Please Login');

    }
}
