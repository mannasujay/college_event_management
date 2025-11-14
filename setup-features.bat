@echo off
echo ====================================
echo Feature Setup Script
echo ====================================
echo.
echo This script will:
echo 1. Clear all Laravel caches
echo 2. Verify Socialite installation
echo 3. Check configurations
echo.
pause

echo.
echo Step 1: Clearing caches...
call php artisan config:clear
call php artisan cache:clear
call php artisan route:clear
call php artisan view:clear

echo.
echo Step 2: Checking installations...
call php artisan route:list --path=auth

echo.
echo ====================================
echo Setup Complete!
echo ====================================
echo.
echo Next Steps:
echo 1. Configure Google OAuth in .env
echo 2. Configure Facebook OAuth in .env
echo 3. Configure email settings in .env
echo 4. Read SOCIAL_LOGIN_EMAIL_PHOTO_SETUP.md
echo.
pause
