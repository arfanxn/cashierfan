<?php

namespace App\Http\Controllers\Auth;

use App\Actions\StoreUserAvatarAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user()->load(['details']);
        return Inertia::render("Auth/ProfileEdit", compact("user"));
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
            "avatar" => $request->hasFile("avatar") ?
                "required|image|mimes:jpg,jpeg,png,svg,gif,jfif|max:2048" : 'nullable',
            "name" => "required|min:2|max:100|string",
            "phone_number" => "required|max:20",
            "address" => "required|max:255",
        ]);

        $user = Auth::user();
        // update profile 
        $user->update($request->only(['name']));

        StoreUserAvatarAction::exec($user, $request->file('avatar') /**/);

        $user->details()->update($request->only(["phone_number", "address"])/**/);

        $user->touch(); // update the user updated_at column 

        return redirect()->back()
            ->with(["message" => 'Profile  updated successfully']);
    }
}
