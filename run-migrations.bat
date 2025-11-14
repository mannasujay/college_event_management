@echo off
echo ====================================
echo Running Migrations
echo ====================================
echo.
echo Make sure you have recreated the database first!
echo.
pause

echo.
echo Running migrations...
php artisan migrate

echo.
echo Creating storage link...
php artisan storage:link

echo.
echo Clearing file-based caches...
php artisan config:clear
php artisan view:clear
php artisan route:clear

echo.
echo ====================================
echo Setup complete!
echo ====================================
echo.
echo You can now test your application!
echo.
pause
