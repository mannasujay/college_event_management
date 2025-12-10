# 📧 EMAIL OTP SETUP GUIDE

## 🚨 CURRENT ISSUE: Email Not Sending

Your `.env` is now configured for Gmail, but you need to complete these steps:

---

## ✅ GMAIL SETUP (Follow These Steps)

### **Step 1: Enable 2-Factor Authentication**
1. Go to: https://myaccount.google.com/security
2. Click **"2-Step Verification"**
3. Follow the steps to enable it
4. **This is REQUIRED for app passwords**

### **Step 2: Generate App Password**
1. Go to: https://myaccount.google.com/apppasswords
2. Or: Google Account → Security → 2-Step Verification → App passwords
3. Select App: **"Mail"**
4. Select Device: **"Windows Computer"** or **"Other"**
5. Click **"Generate"**
6. Copy the **16-character password** (e.g., `abcd efgh ijkl mnop`)

### **Step 3: Update .env File**

Open `d:\college-event-management\.env` and update line 54:

```env
MAIL_PASSWORD=your-16-character-app-password-here
```

**Example:**
```env
MAIL_PASSWORD=abcdefghijklmnop
```

**⚠️ IMPORTANT:** 
- Use the 16-character app password (no spaces)
- Do NOT use your regular Gmail password
- Keep this password secret

### **Step 4: Clear Config Cache**
```powershell
php artisan config:clear
```

### **Step 5: Test Email**
Try the "Forgot Password" feature:
1. Go to: http://localhost:8000/login
2. Click "Forgot Password?"
3. Enter: sujaybappa2004@gmail.com
4. Check your Gmail inbox for OTP

---

## 📋 CURRENT CONFIGURATION

Your `.env` file is now configured with:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=sujaybappa2004@gmail.com
MAIL_PASSWORD=(YOU NEED TO ADD THIS)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=sujaybappa2004@gmail.com
MAIL_FROM_NAME=College Event Management
```

---

## 🧪 ALTERNATIVE: TEST WITH LOG DRIVER FIRST

If you want to test WITHOUT sending real emails:

1. Change `.env` line 51 to:
```env
MAIL_MAILER=log
```

2. Clear cache:
```powershell
php artisan config:clear
```

3. Test forgot password feature
4. Check email content in: `storage/logs/laravel.log`

---

## 🔍 TROUBLESHOOTING

### Error: "Failed to authenticate"
- You're using regular Gmail password instead of app password
- Generate app password and use that

### Error: "2-Step verification required"
- Enable 2-factor authentication first
- Then generate app password

### Email not received
- Check spam folder
- Verify email address is correct
- Check logs: `storage/logs/laravel.log`
- Try with MAIL_MAILER=log first

### "App passwords not available"
- Make sure 2-factor authentication is enabled
- Wait a few minutes after enabling 2FA
- Use this direct link: https://myaccount.google.com/apppasswords

---

## ✅ COMPLETE CHECKLIST

- [ ] Enable 2-Factor Authentication on Google Account
- [ ] Generate App Password
- [ ] Update MAIL_PASSWORD in .env
- [ ] Run: php artisan config:clear
- [ ] Test forgot password feature
- [ ] Check Gmail inbox for OTP
- [ ] Verify OTP works

---

## 🎯 QUICK FIX (If Gmail is too complicated)

Use Mailtrap for testing (no app password needed):

1. Sign up: https://mailtrap.io (free)
2. Get credentials from inbox
3. Update `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@test.com
```
4. Run: php artisan config:clear
5. Test - emails will appear in Mailtrap inbox

---

**After completing Gmail setup, OTP emails will be sent to: sujaybappa2004@gmail.com** ✅
