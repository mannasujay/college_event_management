@echo off
echo ========================================
echo Installing Required Packages
echo ========================================
echo.

echo Installing DomPDF for PDF Certificate Generation...
composer require barryvdh/laravel-dompdf
echo.

echo Clearing configuration cache...
php artisan config:clear
echo.

echo ========================================
echo Installation Complete!
echo ========================================
echo.
echo DomPDF has been installed successfully.
echo You can now generate PDF certificates.
echo.
pause
