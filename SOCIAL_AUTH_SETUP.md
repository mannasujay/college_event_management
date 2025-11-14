# Social Authentication Setup Guide

## 🔐 Google OAuth Setup

### Step 1: Create Google Cloud Project
1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select existing one
3. Enable "Google+ API"

### Step 2: Create OAuth Credentials
1. Go to "Credentials" in the sidebar
2. Click "Create Credentials" → "OAuth client ID"
3. Select "Web application"
4. Add authorized redirect URIs:
   ```
   http://localhost:8000/auth/google/callback
   http://127.0.0.1:8000/auth/google/callback
   ```
5. Copy the Client ID and Client Secret

### Step 3: Add to .env
```env
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
```

---

## 📘 Facebook OAuth Setup

### Step 1: Create Facebook App
1. Go to [Facebook Developers](https://developers.facebook.com/)
2. Click "My Apps" → "Create App"
3. Choose "Consumer" as app type
4. Fill in app details and create

### Step 2: Configure Facebook Login
1. Go to "Settings" → "Basic"
2. Copy App ID and App Secret
3. Add "Facebook Login" product
4. In Facebook Login settings, add redirect URI:
   ```
   http://localhost:8000/auth/facebook/callback
   ```

### Step 3: Add to .env
```env
FACEBOOK_CLIENT_ID=your-facebook-app-id
FACEBOOK_CLIENT_SECRET=your-facebook-app-secret
```

---

## ✅ Testing Social Login

1. Make sure your `.env` has the credentials
2. Run: `php artisan config:clear`
3. Visit: http://127.0.0.1:8000/login
4. Click "Google" or "Facebook" buttons
5. Complete OAuth flow

---

## 🎨 Features Included

### Social Authentication
- ✅ Google OAuth 2.0 login
- ✅ Facebook OAuth login
- ✅ Automatic account creation
- ✅ Account linking (if email exists)
- ✅ Avatar sync from social provider
- ✅ Default role assignment (student)

### Modern Navbar
- ✅ Responsive design (mobile/tablet/desktop)
- ✅ Smooth animations and transitions
- ✅ User dropdown menu with avatar
- ✅ Active link highlighting
- ✅ Mobile hamburger menu
- ✅ Glassmorphism effects
- ✅ Role-based navigation

### Security
- ✅ CSRF protection
- ✅ Email verification
- ✅ Password nullable for social users
- ✅ Provider ID tracking

---

## 📝 Notes

- Social users are created with a random password
- Email must be provided by social provider
- New users default to "student" role
- Admins can change roles later
- Avatar is optional and auto-synced

---

## 🚀 Production Setup

For production, update redirect URIs in:
1. Google Cloud Console → Add your domain
2. Facebook App Settings → Add your domain
3. Update `.env`:
   ```env
   APP_URL=https://yourdomain.com
   ```

---

## 🛠️ Troubleshooting

**"Client ID not found"**
- Check credentials in `.env`
- Run `php artisan config:clear`

**"Redirect URI mismatch"**
- Verify URI in provider console matches exactly
- Include both `http://` and `https://`

**"Email not provided"**
- Enable email permission in OAuth consent screen
- Request "email" scope explicitly

---

## 📧 Support

For issues:
1. Check `.env` configuration
2. Clear config cache
3. Verify redirect URIs
4. Check provider console logs
