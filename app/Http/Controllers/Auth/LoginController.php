<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "email" => ["required", 'email', "string", 'max:100'],
            "password" => ["required", "min:8"],
            "remember" => ["nullable", "boolean"],
        ]);

        if (Auth::attempt($request->only(['email', "password"]), $request->get("remember", false)/**/)/**/) {

            // regenerate the session
            $request->session()->regenerate();
            // regenerate the token
            $request->session()->regenerateToken();

            return redirect()->route('/')->with(['message' => 'Login successful']);
        } else {
            return redirect()->route('users.login-page')
                ->withErrors(['password' => 'The credentials does not match our records.']);
        }
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->route('users.login-page')->with(['message' => 'Logout successfully']);
    }
}
