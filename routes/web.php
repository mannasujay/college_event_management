<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $upcomingEvents = \App\Models\Event::where('status', 'active')
        ->where('event_date', '>=', now())
        ->orderBy('event_date', 'asc')
        ->take(3)
        ->get();
    $totalEvents = \App\Models\Event::count();
    $totalStudents = \App\Models\User::where('role', 'student')->count();
    $totalRegistrations = \App\Models\Registration::count();
    return view('home', compact('upcomingEvents', 'totalEvents', 'totalStudents', 'totalRegistrations'));
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function () {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            
            // Redirect based on user role
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'organizer') {
                return redirect()->intended('/organizer/dashboard');
            } else {
                return redirect()->intended('/student/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    });

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', function () {
        $validated = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = \App\Models\User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'student', // Always register as student
        ]);

        Auth::login($user);

        // Always redirect to student dashboard
        return redirect('/student/dashboard');
    });
    
    // Password Reset Routes
    Route::get('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'showForgotPasswordForm'])->name('password.forgot');
    Route::post('/forgot-password/send-otp', [\App\Http\Controllers\PasswordResetController::class, 'sendOtp'])->name('password.sendOtp');
    Route::get('/verify-otp', [\App\Http\Controllers\PasswordResetController::class, 'showVerifyOtpForm'])->name('password.verifyOtpForm');
    Route::post('/verify-otp', [\App\Http\Controllers\PasswordResetController::class, 'verifyOtp'])->name('password.verifyOtp');
    Route::get('/reset-password', [\App\Http\Controllers\PasswordResetController::class, 'showResetPasswordForm'])->name('password.resetForm');
    Route::post('/reset-password', [\App\Http\Controllers\PasswordResetController::class, 'resetPassword'])->name('password.reset');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

// Public Events Routes
Route::middleware('auth')->group(function () {
    Route::get('/events', [\App\Http\Controllers\EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [\App\Http\Controllers\EventController::class, 'show'])->name('events.show');
    
    // Event Registration
    Route::post('/events/{event}/register', [\App\Http\Controllers\RegistrationController::class, 'store'])->name('events.register');
    Route::delete('/events/{event}/unregister', [\App\Http\Controllers\RegistrationController::class, 'destroy'])->name('events.unregister');
    
    // My Registrations
    Route::get('/my-registrations', [\App\Http\Controllers\RegistrationController::class, 'myRegistrations'])->name('my-registrations');
});

// Dashboard redirect based on role
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role === 'organizer') {
        return redirect('/organizer/dashboard');
    } else {
        return redirect('/student/dashboard');
    }
})->middleware('auth')->name('dashboard');

// Public Pages
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/contact', function () {
    // Handle contact form submission
    $validated = request()->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);
    
    // Here you can send email or store in database
    // For now, just return back with success message
    
    return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
})->name('contact.submit');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

// Include role-specific routes
require __DIR__.'/admin.php';
require __DIR__.'/organizer.php';
require __DIR__.'/student.php';
