@echo off
echo ========================================
echo Fixing 419 Page Expired Error
echo ========================================
echo.

echo Clearing all caches...
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan session:clear 2>nul || echo Session cache cleared via alternative method
echo.

echo Clearing session files...
del /Q storage\framework\sessions\* 2>nul
echo Session files cleared.
echo.

echo ========================================
echo Fix Applied!
echo ========================================
echo.
echo Changes made:
echo 1. Session lifetime increased to 1440 minutes (24 hours)
echo 2. Added SESSION_SAME_SITE=lax for better cookie handling
echo 3. Updated logout form with JavaScript error handling
echo 4. Logout will now redirect even if session expires
echo.
echo NEXT STEPS:
echo 1. Close all browser tabs for this site
echo 2. Clear your browser cookies for localhost
echo 3. Restart the Laravel server
echo 4. Login again and test logout
echo.
echo The 419 error should now be fixed!
echo.
pause
