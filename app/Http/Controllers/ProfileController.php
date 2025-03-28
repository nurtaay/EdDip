<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $activeSub = $user->subscriptions()
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->latest('end_date')
            ->first();

        $allSubs = $user->subscriptions()->latest()->get();
        return view('profile.show', compact('user', 'activeSub', 'allSubs'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profiles', 'public');
            $user->image = $path;
        }

        if ($validated['name']) {
            $user->name = $validated['name'];
        }

        if ($validated['email']) {
            $user->email = $validated['email'];
        }

        $user->save();

        return back()->with('success', __('alert.profile_updated'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->with('error', __('alert.password_mismatch'));
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return back()->with('success', __('alert.password_updated'));
    }

}
