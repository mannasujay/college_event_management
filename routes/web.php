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
    
    // Social Authentication Routes
    Route::get('/auth/google', [\App\Http\Controllers\SocialLoginController::class, 'redirectToGoogle'])->name('social.redirect.google');
    Route::get('/auth/google/callback', [\App\Http\Controllers\SocialLoginController::class, 'handleGoogleCallback']);
    Route::get('/auth/facebook', [\App\Http\Controllers\SocialLoginController::class, 'redirectToFacebook'])->name('social.redirect.facebook');
    Route::get('/auth/facebook/callback', [\App\Http\Controllers\SocialLoginController::class, 'handleFacebookCallback']);
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    
    if (request()->expectsJson()) {
        return response()->json(['message' => 'Logged out successfully', 'redirect' => '/'], 200);
    }
    
    return redirect('/')->with('success', 'You have been logged out successfully.');
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

// Post-Event Features Routes
// Photo Gallery
Route::get('/events/{event}/gallery', [\App\Http\Controllers\EventPhotoController::class, 'index'])->name('events.photos');
Route::post('/events/{event}/photos', [\App\Http\Controllers\EventPhotoController::class, 'store'])->name('events.photos.store')->middleware('auth');
Route::delete('/photos/{photo}', [\App\Http\Controllers\EventPhotoController::class, 'destroy'])->name('events.photos.destroy')->middleware('auth');

// Certificates
Route::get('/events/{event}/certificates/generate', [\App\Http\Controllers\CertificateController::class, 'generate'])->name('certificates.generate')->middleware('auth');
Route::get('/registrations/{registration}/certificate', [\App\Http\Controllers\CertificateController::class, 'view'])->name('certificates.view')->middleware('auth');
Route::get('/registrations/{registration}/certificate/download', [\App\Http\Controllers\CertificateController::class, 'download'])->name('certificates.download')->middleware('auth');

// Event Analytics
Route::get('/events/{event}/analytics', [\App\Http\Controllers\EventAnalyticsController::class, 'show'])->name('events.analytics')->middleware('auth');

// Event Reports
Route::get('/events/{event}/report/create', [\App\Http\Controllers\EventReportController::class, 'create'])->name('events.report.create')->middleware('auth');
Route::post('/events/{event}/report', [\App\Http\Controllers\EventReportController::class, 'store'])->name('events.report.store')->middleware('auth');
Route::get('/events/{event}/report', [\App\Http\Controllers\EventReportController::class, 'show'])->name('events.report.show');
Route::get('/reports/{report}/download', [\App\Http\Controllers\EventReportController::class, 'downloadFile'])->name('events.report.download')->middleware('auth');

// Event Winners/Results
Route::get('/events/{event}/winners/create', [\App\Http\Controllers\EventWinnerController::class, 'create'])->name('events.winners.create')->middleware('auth');
Route::post('/events/{event}/winners', [\App\Http\Controllers\EventWinnerController::class, 'store'])->name('events.winners.store')->middleware('auth');
Route::get('/events/{event}/winners', [\App\Http\Controllers\EventWinnerController::class, 'show'])->name('events.winners.show');

// Post-Event Emails
Route::post('/events/{event}/send-emails', [\App\Http\Controllers\PostEventEmailController::class, 'send'])->name('events.send-emails')->middleware('auth');

// Event Archive
Route::get('/events/archive', [\App\Http\Controllers\EventArchiveController::class, 'index'])->name('events.archive');

// Include role-specific routes
require __DIR__.'/admin.php';
require __DIR__.'/organizer.php';
require __DIR__.'/student.php';
