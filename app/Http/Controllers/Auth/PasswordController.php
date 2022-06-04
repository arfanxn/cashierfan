<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PasswordController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return Inertia::render("Auth/PasswordEdit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            "current_password" => ['required', "string", "min:8"],
            "password"  => ['required', "max:50", "string", Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()], "confirm_password" => ["same:password"],
        ]);

        if (
            !Hash::check($request->current_password, Auth::user()->password)
        ) return redirect()->route("auth.password.edit")->withErrors(['current_password' => "Current password is incorrect"]);

        Auth::user()->update(["password" => bcrypt($request->password)]);

        Auth::logout();

        return redirect()->route("users.login-page")->with(['message' => "Password updated successfully, please relogin."]);
    }
}
