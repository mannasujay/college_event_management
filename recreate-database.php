<?php
// Database Recreation Script

echo "====================================\n";
echo "Database Recreation Script\n";
echo "====================================\n\n";

try {
    // Connect to MySQL without selecting a database
    $pdo = new PDO('mysql:host=127.0.0.1', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    echo "✓ Connected to MySQL successfully\n\n";
    
    // Drop existing database if it exists
    echo "Dropping existing database...\n";
    $pdo->exec("DROP DATABASE IF EXISTS college_management_system");
    echo "✓ Old database dropped (if existed)\n\n";
    
    // Create fresh database
    echo "Creating new database...\n";
    $pdo->exec("CREATE DATABASE college_management_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✓ Database 'college_management_system' created successfully\n\n";
    
    // Verify database exists
    $result = $pdo->query("SHOW DATABASES LIKE 'college_management_system'");
    if ($result->rowCount() > 0) {
        echo "✓ Database verified - ready for migrations!\n\n";
        echo "====================================\n";
        echo "SUCCESS! Database is ready.\n";
        echo "====================================\n\n";
        echo "Next step: Run migrations\n";
        echo "Command: php artisan migrate\n\n";
    }
    
} catch (PDOException $e) {
    echo "✗ ERROR: " . $e->getMessage() . "\n\n";
    echo "Make sure:\n";
    echo "1. MySQL/XAMPP is running\n";
    echo "2. MySQL credentials are correct (user: root, password: empty)\n";
    exit(1);
}
