# 🔐 USER CREDENTIALS REFERENCE

## 📊 ALL USERS IN DATABASE

### ✅ TEST USERS (KNOWN PASSWORDS)

#### 1. **ADMIN USER**
- **Email:** admin@test.com
- **Password:** admin123
- **Role:** admin
- **Access:** Full system access, can manage users, events, approvals

#### 2. **ORGANIZER USER**
- **Email:** organizer@test.com
- **Password:** organizer123
- **Role:** organizer
- **Access:** Can create/manage events, upload photos, view feedback

#### 3. **STUDENT USER**
- **Email:** student@test.com
- **Password:** student123
- **Role:** student
- **Access:** Can register for events, submit feedback, view certificates

---

### 🔒 EXISTING USERS (UNKNOWN PASSWORDS)

These users were created earlier. Passwords are encrypted and cannot be retrieved.

#### 4. **Sujay Manna**
- **Email:** sujaybappa2004@gmail.com
- **Role:** student
- **Password:** ❌ Unknown (Use "Forgot Password" to reset)

#### 5. **Pritam Das**
- **Email:** sahoopreet90@gmail.com
- **Role:** student
- **Password:** ❌ Unknown (Use "Forgot Password" to reset)

#### 6. **Admin User**
- **Email:** admin@college.com
- **Role:** admin
- **Password:** ❌ Unknown (Use "Forgot Password" to reset)

#### 7. **Admin User**
- **Email:** admin@example.com
- **Role:** admin
- **Password:** ❌ Unknown (Use "Forgot Password" to reset)

#### 8. **Organizer User**
- **Email:** organizer@example.com
- **Role:** organizer
- **Password:** ❌ Unknown (Use "Forgot Password" to reset)

#### 9. **Student User**
- **Email:** student@example.com
- **Role:** student
- **Password:** ❌ Unknown (Use "Forgot Password" to reset)

---

## 🚀 HOW TO LOGIN

### **Step 1: Start Server**
```powershell
php artisan serve
```

### **Step 2: Open Browser**
```
http://localhost:8000/login
```

### **Step 3: Login with Test Credentials**
Use any of the test users above:
- admin@test.com / admin123
- organizer@test.com / organizer123
- student@test.com / student123

---

## 🔄 RESET PASSWORD (For Unknown Passwords)

### **Option 1: Use Forgot Password Feature**
1. Go to: http://localhost:8000/login
2. Click "Forgot Password?"
3. Enter email address
4. Check email for OTP (after email is configured)
5. Enter OTP and set new password

### **Option 2: Update Password via Tinker**
```powershell
php artisan tinker
```

Then run:
```php
$user = App\Models\User::where('email', 'sujaybappa2004@gmail.com')->first();
$user->password = bcrypt('newpassword123');
$user->save();
```

### **Option 3: Delete and Recreate User**
```powershell
php artisan tinker
```

Then:
```php
App\Models\User::where('email', 'sujaybappa2004@gmail.com')->delete();
App\Models\User::create([
    'name' => 'Sujay Manna',
    'email' => 'sujaybappa2004@gmail.com',
    'password' => bcrypt('mynewpassword'),
    'role' => 'admin'
]);
```

---

## 📋 ROLE PERMISSIONS

### **ADMIN** 👑
- ✅ Manage all users
- ✅ Change user roles
- ✅ Approve/reject events
- ✅ View all registrations
- ✅ Upload event photos (after event ends)
- ✅ Create announcements
- ✅ View analytics
- ✅ Access all features

### **ORGANIZER** 📝
- ✅ Create new events
- ✅ Edit own events
- ✅ View event registrations
- ✅ Upload event photos (after event ends)
- ✅ View feedback
- ✅ Generate reports
- ✅ Send post-event emails
- ✅ Declare winners

### **STUDENT** 🎓
- ✅ Register for events
- ✅ View event details
- ✅ Submit feedback
- ✅ View certificates
- ✅ Unregister from events
- ❌ Cannot create events
- ❌ Cannot upload photos
- ❌ Cannot manage users

---

## 💡 IMPORTANT NOTES

### **About Passwords:**
- Passwords are **ENCRYPTED** using bcrypt
- They **CANNOT** be decrypted or viewed
- This is a security feature
- Always use "Forgot Password" to reset

### **About Test Users:**
- Created specifically for testing
- Have simple passwords for easy testing
- Can be deleted if not needed

### **Security Tip:**
- Never share passwords
- Use strong passwords in production
- Change default test passwords before deploying

---

## 🛠️ USEFUL COMMANDS

### Create New User:
```powershell
php artisan tinker
```
```php
User::create([
    'name' => 'New User',
    'email' => 'newuser@test.com',
    'password' => bcrypt('password123'),
    'role' => 'student'
]);
```

### List All Users:
```powershell
php show-users.php
```

### Create Test Users Again:
```powershell
php create-test-users.php
```

### Reset Password:
```powershell
php artisan tinker
```
```php
$user = User::where('email', 'email@test.com')->first();
$user->password = bcrypt('newpassword');
$user->save();
```

---

## 📞 NEED HELP?

If you can't login:
1. Verify email is correct
2. Use one of the test accounts
3. Use "Forgot Password" feature
4. Check if server is running: `php artisan serve`
5. Check browser console for errors

**Start testing with: admin@test.com / admin123** ✅
