<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccount extends Controller
{
    public function create()
    {
        return inertia('Useraccount/Create');
    }

    public function store(Request $request)
    {
        $user = User::create($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',     // Uppercase
                'regex:/[a-z]/',     // Lowercase
                'regex:/[0-9]/',     // Number
                'regex:/[@$!%*?&#£]/', // Special character
            ],

        ]));
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Account created successfully');
    }
}
