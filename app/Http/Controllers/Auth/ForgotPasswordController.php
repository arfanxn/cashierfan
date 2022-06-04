<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class ForgotPasswordController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            "email" => ['required', "email"],
            "password"  => ['required', "max:50", "string", Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()], "confirm_password" => ["same:password"],
        ]);

        User::where("email", $request->email)->update([
            "password" => bcrypt($request->password)
        ]);

        return redirect()->route("users.login-page")->with(['message' => "Password updated successfully, please login"]);
    }
}
