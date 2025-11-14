@echo off
echo ====================================
echo Database Recreation Script
echo ====================================
echo.
echo This script will:
echo 1. Drop the existing database
echo 2. Create a fresh database
echo 3. Run all migrations
echo.
echo Make sure MySQL is running!
echo.
pause

echo.
echo Connecting to MySQL and recreating database...
mysql -u root -e "DROP DATABASE IF EXISTS college_management_system;"
mysql -u root -e "CREATE DATABASE college_management_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -e "SHOW DATABASES;"

echo.
echo Database recreated successfully!
echo.
echo Now running migrations...
php artisan migrate

echo.
echo Creating storage link...
php artisan storage:link

echo.
echo Clearing caches...
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo.
echo ====================================
echo Database setup complete!
echo ====================================
pause
