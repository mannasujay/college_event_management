@echo off
echo ====================================
echo Database Complete Reset
echo ====================================
echo.
echo This will:
echo 1. Show you the exact folder to delete
echo 2. Open the folder for you
echo 3. Run migrations after confirmation
echo.
pause

echo.
echo Your MySQL data folder is likely at one of these locations:
echo 1. C:\xampp\mysql\data\college_management_system
echo 2. C:\wamp64\bin\mysql\mysql8.x.x\data\college_management_system
echo 3. C:\laragon\data\mysql\college_management_system
echo.

REM Try to find and open the data directory
echo Attempting to open MySQL data directory...
echo.

if exist "C:\xampp\mysql\data\" (
    echo Found XAMPP MySQL data directory!
    explorer "C:\xampp\mysql\data\"
    echo.
    echo Please:
    echo 1. Find the 'college_management_system' folder
    echo 2. DELETE IT COMPLETELY
    echo 3. Come back here and press any key
    echo.
    pause
    goto :runmigrations
)

if exist "C:\wamp64\bin\mysql\" (
    echo Found WAMP MySQL directory!
    explorer "C:\wamp64\bin\mysql\"
    echo.
    echo Please:
    echo 1. Navigate to: mysql8.x.x\data\
    echo 2. Find the 'college_management_system' folder
    echo 3. DELETE IT COMPLETELY
    echo 4. Come back here and press any key
    echo.
    pause
    goto :runmigrations
)

if exist "C:\laragon\data\mysql\" (
    echo Found Laragon MySQL data directory!
    explorer "C:\laragon\data\mysql\"
    echo.
    echo Please:
    echo 1. Find the 'college_management_system' folder
    echo 2. DELETE IT COMPLETELY
    echo 3. Come back here and press any key
    echo.
    pause
    goto :runmigrations
)

echo Could not automatically find MySQL data directory.
echo.
echo Please manually locate and delete:
echo - The 'college_management_system' folder from your MySQL data directory
echo.
echo Then press any key to continue...
pause

:runmigrations
echo.
echo ====================================
echo Now creating database and running migrations...
echo ====================================
echo.

echo Step 1: Recreating database in MySQL...
echo DROP DATABASE IF EXISTS college_management_system; CREATE DATABASE college_management_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; | mysql -u root

echo.
echo Step 2: Running migrations...
php artisan migrate

echo.
echo Step 3: Creating storage link...
php artisan storage:link

echo.
echo Step 4: Clearing caches...
php artisan config:clear
php artisan view:clear
php artisan route:clear

echo.
echo ====================================
echo Setup Complete!
echo ====================================
echo.
echo Check above for any errors.
echo If successful, all database tables have been created!
echo.
pause
