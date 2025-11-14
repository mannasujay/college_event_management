<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
    /**
     * Redirect to social provider
     */
    public function redirect($provider)
    {
        // Check if Socialite is installed
        if (!class_exists(\Laravel\Socialite\Facades\Socialite::class)) {
            return redirect()->route('login')->with('error', 'Social authentication is not configured yet. Please install Laravel Socialite: composer require laravel/socialite');
        }

        return \Laravel\Socialite\Facades\Socialite::driver($provider)->redirect();
    }

    /**
     * Handle callback from social provider
     */
    public function callback($provider)
    {
        // Check if Socialite is installed
        if (!class_exists(\Laravel\Socialite\Facades\Socialite::class)) {
            return redirect()->route('login')->with('error', 'Social authentication is not configured yet. Please install Laravel Socialite: composer require laravel/socialite');
        }

        try {
            $socialUser = \Laravel\Socialite\Facades\Socialite::driver($provider)->user();
            
            // Check if user exists
            $user = User::where('provider', $provider)
                       ->where('provider_id', $socialUser->id)
                       ->first();
            
            if (!$user) {
                // Check if email already exists
                $existingUser = User::where('email', $socialUser->email)->first();
                
                if ($existingUser) {
                    // Link social account to existing user
                    $existingUser->update([
                        'provider' => $provider,
                        'provider_id' => $socialUser->id,
                        'avatar' => $socialUser->avatar ?? $existingUser->avatar,
                    ]);
                    $user = $existingUser;
                } else {
                    // Create new user
                    $user = User::create([
                        'name' => $socialUser->name,
                        'email' => $socialUser->email,
                        'provider' => $provider,
                        'provider_id' => $socialUser->id,
                        'avatar' => $socialUser->avatar,
                        'password' => Hash::make(Str::random(24)), // Random password
                        'email_verified_at' => now(),
                        'role' => 'student', // Default role
                    ]);
                }
            }
            
            // Log the user in
            Auth::login($user, true);
            
            // Redirect based on role
            switch ($user->role) {
                case 'admin':
                    return redirect('/admin/dashboard');
                case 'organizer':
                    return redirect('/organizer/dashboard');
                default:
                    return redirect('/student/dashboard');
            }
            
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Failed to login with ' . ucfirst($provider) . '. Please try again.');
        }
    }
}
