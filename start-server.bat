@echo off
echo Clearing Laravel caches...
php artisan config:clear
php artisan view:clear
php artisan cache:clear
echo.
echo Starting Laravel server...
php artisan serve
