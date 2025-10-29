<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\PasswordResetOtpMail;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    // Show forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }
    
    // Send OTP to email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->with('error', 'Email address not found in our system.');
        }
        
        // Generate 6-digit OTP
        $otp = sprintf("%06d", mt_rand(1, 999999));
        
        // Delete old OTPs for this email
        DB::table('password_reset_otps')->where('email', $request->email)->delete();
        
        // Store OTP in database
        DB::table('password_reset_otps')->insert([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(10),
            'created_at' => Carbon::now(),
        ]);
        
        // Send OTP via email
        try {
            Mail::to($request->email)->send(new PasswordResetOtpMail($otp, $user->name));
            
            return redirect()->route('password.verifyOtpForm')
                ->with('email', $request->email)
                ->with('success', 'OTP has been sent to your email address.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send OTP. Please try again. Error: ' . $e->getMessage());
        }
    }
    
    // Show OTP verification form
    public function showVerifyOtpForm()
    {
        if (!session('email')) {
            return redirect()->route('password.forgot')->with('error', 'Please request a new OTP.');
        }
        
        return view('auth.verify-otp');
    }
    
    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);
        
        $otpRecord = DB::table('password_reset_otps')
            ->where('email', $request->email)
            ->where('otp', $request->otp)
            ->first();
        
        if (!$otpRecord) {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }
        
        // Check if OTP is expired
        if (Carbon::now()->greaterThan($otpRecord->expires_at)) {
            DB::table('password_reset_otps')->where('email', $request->email)->delete();
            return redirect()->route('password.forgot')
                ->with('error', 'OTP has expired. Please request a new one.');
        }
        
        // OTP is valid, redirect to reset password form
        return redirect()->route('password.resetForm')
            ->with('email', $request->email)
            ->with('success', 'OTP verified successfully! Now set your new password.');
    }
    
    // Show reset password form
    public function showResetPasswordForm()
    {
        if (!session('email')) {
            return redirect()->route('password.forgot')->with('error', 'Please request a new OTP.');
        }
        
        return view('auth.reset-password');
    }
    
    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        
        // Update user password
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->with('error', 'User not found.');
        }
        
        $user->password = Hash::make($request->password);
        $user->save();
        
        // Delete OTP record
        DB::table('password_reset_otps')->where('email', $request->email)->delete();
        
        return redirect()->route('login')->with('success', 'Password reset successfully! You can now login with your new password.');
    }
}

