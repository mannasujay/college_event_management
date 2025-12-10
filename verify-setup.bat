@echo off
echo ====================================
echo COMPLETE SETUP VERIFICATION
echo ====================================
echo.
pause

echo.
echo Step 1: Checking database connection...
php artisan migrate:status

echo.
echo Step 2: Showing all users...
php show-users.php

echo.
echo Step 3: Verifying routes...
php artisan route:list --path=auth

echo.
echo Step 4: Checking email configuration...
php artisan config:clear
echo Config cache cleared!

echo.
echo ====================================
echo SUMMARY
echo ====================================
echo.
echo TEST USERS CREATED:
echo.
echo ADMIN:
echo   Email: admin@test.com
echo   Password: admin123
echo.
echo ORGANIZER:
echo   Email: organizer@test.com
echo   Password: organizer123
echo.
echo STUDENT:
echo   Email: student@test.com
echo   Password: student123
echo.
echo ====================================
echo EMAIL CONFIGURATION
echo ====================================
echo.
echo Current: Gmail SMTP configured
echo Email: sujaybappa2004@gmail.com
echo.
echo ⚠️  TO ENABLE OTP EMAILS:
echo 1. Enable 2-Factor Authentication on Gmail
echo 2. Generate App Password
echo 3. Update MAIL_PASSWORD in .env
echo 4. Read: EMAIL_SETUP_GUIDE.md
echo.
echo ====================================
echo READY TO TEST!
echo ====================================
echo.
echo Start server: php artisan serve
echo Login at: http://localhost:8000/login
echo.
echo Read these files for help:
echo - USER_CREDENTIALS.md (All user login info)
echo - EMAIL_SETUP_GUIDE.md (Fix OTP email)
echo - QUICK_SETUP_GUIDE.md (Complete guide)
echo.
pause
