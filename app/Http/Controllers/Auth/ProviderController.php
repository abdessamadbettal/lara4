<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Inertia\Inertia;

class ProviderController extends Controller
{
    /**
     * Redirect to the provider for authentication.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider(Request $request)
    {
        $providerValue = $request->provider;

        // Validate the provider to ensure it's supported
        if (!in_array($providerValue, ['google', 'linkedin', 'github'])) {
            return redirect()->route('home')->with('error', 'Unsupported provider.');
        }

        // Store the previous URL to redirect back after login
        session()->put('previous_url', url()->previous());

        return Inertia::location(Socialite::driver($providerValue)->redirect()->getTargetUrl());
    }

    /**
     * Handle the provider callback after authentication.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback(Request $request)
    {
        $providerValue = $request->provider;

        // Validate the provider to ensure it's supported
        if (!in_array($providerValue, ['google', 'linkedin', 'github'])) {
            return redirect()->route('home')->with('error', 'Unsupported provider.');
        }

        $previousUrl = $request->session()->pull('previous_url', route('welcome')); // Use a named route as default
        $providerUser = Socialite::driver($providerValue)->user();

        // Find or create the user
        $user = User::firstOrCreate(
            ['email' => $providerUser->getEmail()],
            [
                'name' => $providerUser->getName(),
                'first_name' => $providerUser->user['given_name'] ?? null,
                'last_name' => $providerUser->user['family_name'] ?? null,
                'password' => Hash::make(Str::random(24)), // Generate a random password
                'email_verified_at' => now(),
                'avatar' => $providerUser->getAvatar(),
            ]
        );

        // Update or create the provider
        Provider::updateOrCreate(
            [
                'provider' => $providerValue,
                'provider_id' => $providerUser->getId(),
            ],
            [
                'user_id' => $user->id,
                'provider_token' => $providerUser->token,
            ]
        );

        // Log the user in
        Auth::login($user);

        return redirect($previousUrl)->with('success', 'Logged in successfully.');


    }
}
