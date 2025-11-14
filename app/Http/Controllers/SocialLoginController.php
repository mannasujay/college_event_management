<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialLoginController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user exists
            $user = User::where('email', $googleUser->getEmail())->first();
            
            if ($user) {
                // Update existing user with Google info
                $user->update([
                    'provider' => 'google',
                    'provider_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'provider' => 'google',
                    'provider_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => Hash::make(uniqid()), // Random password for social login
                    'role' => 'student', // Default role
                    'email_verified_at' => now(),
                ]);
            }
            
            // Log the user in
            Auth::login($user);
            
            // Redirect based on role
            return $this->redirectBasedOnRole($user);
            
        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Failed to login with Google. Please try again. Error: ' . $e->getMessage());
        }
    }

    /**
     * Redirect to Facebook OAuth
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle Facebook OAuth callback
     */
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            
            // Check if user exists
            $user = User::where('email', $facebookUser->getEmail())->first();
            
            if ($user) {
                // Update existing user with Facebook info
                $user->update([
                    'provider' => 'facebook',
                    'provider_id' => $facebookUser->getId(),
                    'avatar' => $facebookUser->getAvatar(),
                ]);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'provider' => 'facebook',
                    'provider_id' => $facebookUser->getId(),
                    'avatar' => $facebookUser->getAvatar(),
                    'password' => Hash::make(uniqid()), // Random password for social login
                    'role' => 'student', // Default role
                    'email_verified_at' => now(),
                ]);
            }
            
            // Log the user in
            Auth::login($user);
            
            // Redirect based on role
            return $this->redirectBasedOnRole($user);
            
        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Failed to login with Facebook. Please try again. Error: ' . $e->getMessage());
        }
    }

    /**
     * Redirect user based on their role
     */
    private function redirectBasedOnRole($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back, ' . $user->name . '!');
            case 'organizer':
                return redirect()->route('organizer.dashboard')
                    ->with('success', 'Welcome back, ' . $user->name . '!');
            case 'student':
                return redirect()->route('student.dashboard')
                    ->with('success', 'Welcome back, ' . $user->name . '!');
            default:
                return redirect()->route('home')
                    ->with('success', 'Welcome back, ' . $user->name . '!');
        }
    }
}
