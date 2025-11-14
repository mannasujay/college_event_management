# Manual Database Fix Instructions

## Problem
MySQL tablespace files still exist even after dropping the database, causing "Tablespace exists" error.

## Solution - Follow These Steps:

### Step 1: Stop MySQL Server
1. Open **XAMPP Control Panel** (or WAMP/MAMP)
2. Click **"Stop"** next to MySQL/MariaDB
3. Wait until it shows "Stopped"

### Step 2: Delete Physical Database Files
1. Navigate to your MySQL data directory:
   - **XAMPP**: `C:\xampp\mysql\data\college_management_system\`
   - **WAMP**: `C:\wamp64\bin\mysql\mysql8.x.x\data\college_management_system\`
   - **Laragon**: `C:\laragon\data\mysql\college_management_system\`

2. **Delete the entire `college_management_system` folder**
   - This removes all the corrupted tablespace files

### Step 3: Start MySQL Server
1. Go back to **XAMPP Control Panel**
2. Click **"Start"** next to MySQL/MariaDB
3. Wait until it shows "Running"

### Step 4: Recreate Database in phpMyAdmin
1. Open http://localhost/phpmyadmin
2. Click **"Databases"** tab
3. Create new database:
   - Name: `college_management_system`
   - Collation: `utf8mb4_unicode_ci`
4. Click **"Create"**

### Step 5: Run Migrations
Open PowerShell in your project directory and run:
```powershell
php artisan migrate
```

## Expected Result
All tables will be created successfully:
- ✅ migrations
- ✅ users, roles, password_reset_tokens
- ✅ sessions, cache, cache_locks
- ✅ jobs, job_batches, failed_jobs
- ✅ events, registrations, feedback
- ✅ announcements, results
- ✅ event_photos, certificates, event_reports, event_winners

## Need Help?
If you get any errors, let me know which step failed!
