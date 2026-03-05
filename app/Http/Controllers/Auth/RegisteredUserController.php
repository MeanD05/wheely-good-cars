<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
        {
        $messages = [
            'name.required' => 'Vul je naam in.',
            'name.string' => 'De naam moet tekst zijn.',
            'name.max' => 'De naam mag niet langer zijn dan :max tekens.',

            'email.required' => 'Vul je e-mailadres in.',
            'email.email' => 'Vul een geldig e-mailadres in.',
            'email.max' => 'Het e-mailadres mag niet langer zijn dan :max tekens.',
            'email.unique' => 'Dit e-mailadres is al in gebruik.',

            'country_code.max' => 'De landcode is te lang.',

            'phone.max' => 'Het telefoonnummer is te lang.',
            'phone.string' => 'Het telefoonnummer moet tekst zijn.',

            'password.required' => 'Vul een wachtwoord in.',
            'password.confirmed' => 'De wachtwoordbevestiging komt niet overeen.',
            'password.password' => 'Het wachtwoord voldoet niet aan de vereisten.',
        ];

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            'country_code' => ['nullable', 'string', 'max:6'],
            'phone' => ['nullable', 'string', 'max:25'],
        ], $messages);

        $fullPhone = null;

        if ($request->filled('phone')) {
            $countryCode = $request->input('country_code', '+31');

           
            $phone = preg_replace('/[^0-9]/', '', (string) $request->phone);

            
            $phone = ltrim($phone, '0');

          
            if ($phone === '') {
                $fullPhone = null;
            } else {
                $fullPhone = $countryCode . $phone;
            }
        }

      
        if ($fullPhone !== null) {
            if (User::where('phone_number', $fullPhone)->exists()) {
                throw ValidationException::withMessages(['phone' => ['Dit telefoonnummer is al in gebruik.']]);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $fullPhone,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('home', absolute: false));
        }
}
