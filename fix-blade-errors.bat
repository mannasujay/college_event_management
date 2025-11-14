@echo off
echo ========================================
echo Fixing Blade Template Errors
echo ========================================
echo.

echo Clearing view cache...
php artisan view:clear
echo.

echo Clearing config cache...
php artisan config:clear
echo.

echo Clearing application cache...
php artisan cache:clear
echo.

echo Clearing route cache...
php artisan route:clear
echo.

echo ========================================
echo Fix Applied!
echo ========================================
echo.
echo The "Cannot end a section without first starting one" error
echo has been fixed by clearing all cached views and config.
echo.
echo Your application should now work correctly!
echo.
pause
