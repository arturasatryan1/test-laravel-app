<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GeneratedUrl;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function register(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'phone_number' => $request->phone_number,
        ]);

        $generatedUrl = GeneratedUrl::generateNewLinkForByUser($user);

        return back()->with([
            'uri' => $generatedUrl->uri,
            'expiry_date' => $generatedUrl->expiry_date
        ]);
    }
}
