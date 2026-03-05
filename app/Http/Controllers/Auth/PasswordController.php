<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $messages = [
            'current_password.required' => 'Vul je huidige wachtwoord in.',
            'current_password.current_password' => 'Het huidige wachtwoord is onjuist.',

            'password.required' => 'Vul een nieuw wachtwoord in.',
            'password.confirmed' => 'De wachtwoordbevestiging komt niet overeen.',
            'password.password' => 'Het wachtwoord voldoet niet aan de vereisten.',
        ];

        $attributes = [
            'current_password' => 'huidig wachtwoord',
            'password' => 'wachtwoord',
            'password_confirmation' => 'wachtwoordbevestiging',
        ];

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ], $messages, $attributes);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Wachtwoord bijgewerkt.');
    }
}
