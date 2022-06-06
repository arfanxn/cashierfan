<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class EmailController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return Inertia::render("Auth/EmailEdit");
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
            "email" => ["required", 'email', "max:100"],
        ]);

        $user = Auth::user();

        $user->update(['email' => $request->email]);
        $user->markEmailAsVerified();
        $user->touch();

        return redirect()->route("auth.email.edit")->with(['message' => "Email updated successfully"]);
    }
}
