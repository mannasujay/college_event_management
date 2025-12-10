<?php

// Show all users with their emails and passwords
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "====================================\n";
echo "ALL USERS IN DATABASE\n";
echo "====================================\n\n";

$users = User::all();

if ($users->isEmpty()) {
    echo "⚠️  No users found in database.\n";
    echo "   Create users by registering at: http://localhost:8000/register\n\n";
} else {
    echo "Found " . $users->count() . " user(s):\n\n";
    
    foreach ($users as $user) {
        echo "----------------------------------------\n";
        echo "ID:       " . $user->id . "\n";
        echo "Name:     " . $user->name . "\n";
        echo "Email:    " . $user->email . "\n";
        echo "Role:     " . $user->role . "\n";
        echo "Password: [HASHED - Cannot be retrieved]\n";
        echo "Note:     Passwords are encrypted and cannot be shown.\n";
        echo "          To test login, either:\n";
        echo "          1. Remember the password you used during registration\n";
        echo "          2. Use 'Forgot Password' feature to reset\n";
        echo "          3. Create a new test user with known password\n";
        echo "----------------------------------------\n\n";
    }
    
    echo "\n💡 TIP: To create a test user with known password:\n";
    echo "   Run: php artisan tinker\n";
    echo "   Then: User::create(['name' => 'Test Admin', 'email' => 'admin@test.com', 'password' => bcrypt('password123'), 'role' => 'admin']);\n\n";
}

echo "====================================\n";
echo "WANT TO CREATE TEST USERS?\n";
echo "====================================\n";
echo "Run: php create-test-users.php\n\n";
