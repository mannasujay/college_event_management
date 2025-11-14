@echo off
echo Installing Laravel Socialite...
echo.
composer require laravel/socialite
echo.
echo Clearing Laravel caches...
php artisan config:clear
php artisan view:clear
php artisan cache:clear
echo.
echo Installation complete!
echo.
echo Next steps:
echo 1. Add Google/Facebook credentials to .env
echo 2. Check SOCIAL_AUTH_SETUP.md for detailed setup guide
echo.
pause
