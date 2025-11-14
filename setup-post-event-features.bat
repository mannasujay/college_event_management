@echo off
echo ========================================
echo Post-Event Features Setup
echo ========================================
echo.

echo Step 1: Running database migrations...
php artisan migrate
echo.

echo Step 2: Creating storage symlink...
php artisan storage:link
echo.

echo Step 3: Clearing caches...
php artisan config:clear
php artisan view:clear
php artisan cache:clear
php artisan route:clear
echo.

echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo All post-event features are now ready:
echo - Photo Gallery
echo - Digital Certificates  
echo - Event Analytics
echo - Event Reports
echo - Results/Winners
echo - Post-Event Emails
echo - Event Archive
echo.
echo IMPORTANT: To generate PDF certificates, run:
echo   install-dompdf.bat
echo.
echo To configure email sending, update your .env file
echo with SMTP settings.
echo.
pause
