<?php

// Create test users with known passwords
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "====================================\n";
echo "CREATE TEST USERS\n";
echo "====================================\n\n";

$testUsers = [
    [
        'name' => 'Admin User',
        'email' => 'admin@test.com',
        'password' => 'admin123',
        'role' => 'admin'
    ],
    [
        'name' => 'Organizer User',
        'email' => 'organizer@test.com',
        'password' => 'organizer123',
        'role' => 'organizer'
    ],
    [
        'name' => 'Student User',
        'email' => 'student@test.com',
        'password' => 'student123',
        'role' => 'student'
    ]
];

echo "Creating test users...\n\n";

foreach ($testUsers as $userData) {
    // Check if user already exists
    $existingUser = User::where('email', $userData['email'])->first();
    
    if ($existingUser) {
        echo "⚠️  User already exists: {$userData['email']}\n";
        echo "   Role: {$existingUser->role}\n";
        echo "   To reset password, use the 'Forgot Password' feature\n\n";
    } else {
        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
            'role' => $userData['role'],
            'email_verified_at' => now()
        ]);
        
        echo "✅ Created: {$userData['name']}\n";
        echo "   Email:    {$userData['email']}\n";
        echo "   Password: {$userData['password']}\n";
        echo "   Role:     {$userData['role']}\n\n";
    }
}

echo "====================================\n";
echo "TEST USERS READY!\n";
echo "====================================\n\n";

echo "Login Credentials:\n\n";
echo "ADMIN:\n";
echo "  Email:    admin@test.com\n";
echo "  Password: admin123\n\n";

echo "ORGANIZER:\n";
echo "  Email:    organizer@test.com\n";
echo "  Password: organizer123\n\n";

echo "STUDENT:\n";
echo "  Email:    student@test.com\n";
echo "  Password: student123\n\n";

echo "Now start your server:\n";
echo "  php artisan serve\n\n";
echo "Then login at: http://localhost:8000/login\n\n";
