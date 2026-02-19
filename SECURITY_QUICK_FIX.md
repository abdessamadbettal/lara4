# 🚨 Quick Security Fix Guide

This guide provides immediate fixes for common security issues found in Laravel applications.

## Table of Contents
- [Exposed .env File](#exposed-env-file)
- [Debug Mode Enabled in Production](#debug-mode-enabled-in-production)
- [Weak APP_KEY](#weak-app-key)
- [Missing HTTPS](#missing-https)
- [Exposed Git Directory](#exposed-git-directory)
- [Incorrect File Permissions](#incorrect-file-permissions)
- [Weak Database Credentials](#weak-database-credentials)
- [Missing CSRF Protection](#missing-csrf-protection)
- [Unvalidated File Uploads](#unvalidated-file-uploads)
- [Missing Rate Limiting](#missing-rate-limiting)

---

## Exposed .env File

### ⚠️ Issue
Your `.env` file is accessible via web browser, exposing all credentials and secrets.

### 🔍 Check
```bash
curl https://yourdomain.com/.env
```
If you see your .env contents, you have a problem!

### ✅ Fix for Nginx
Add to your server block:
```nginx
location ~ /\.env {
    deny all;
    return 404;
}

# Also block all hidden files
location ~ /\. {
    deny all;
    return 404;
}
```

Reload Nginx:
```bash
sudo nginx -t
sudo systemctl reload nginx
```

### ✅ Fix for Apache
Add to `.htaccess` in Laravel root (NOT public directory):
```apache
<Files .env>
    Require all denied
</Files>
```

Or in your VirtualHost configuration:
```apache
<Files .env>
    Require all denied
</Files>
```

Reload Apache:
```bash
sudo apache2ctl configtest
sudo systemctl reload apache2
```

### ✅ Fix File Permissions
```bash
chmod 600 .env
chown www-data:www-data .env
```

### 🔄 Verify Fix
```bash
curl https://yourdomain.com/.env
# Should return 404 or 403, NOT file contents
```

---

## Debug Mode Enabled in Production

### ⚠️ Issue
`APP_DEBUG=true` exposes sensitive information like database credentials, file paths, and environment variables.

### 🔍 Check
Visit your site and trigger an error (e.g., visit a non-existent page). If you see a detailed error page with code and stack traces, debug mode is on.

### ✅ Fix
Edit your `.env` file:
```ini
APP_ENV=production
APP_DEBUG=false
```

Clear config cache:
```bash
php artisan config:clear
php artisan config:cache
```

### 🔄 Verify Fix
Trigger an error again. You should see a generic error page, not detailed debugging information.

---

## Weak APP_KEY

### ⚠️ Issue
Using the example APP_KEY or a weak key allows attackers to decrypt session data and forge cookies.

### 🔍 Check
Look at your `.env` file. If `APP_KEY` is empty or matches the one in `.env.example`, you need to generate a new one.

### ✅ Fix
Generate a new unique key:
```bash
php artisan key:generate
```

This will automatically update your `.env` file.

### ⚠️ Warning
Changing the APP_KEY will invalidate all existing sessions and encrypted data. Users will need to log in again.

### 🔄 Verify Fix
Check your `.env` file:
```bash
grep APP_KEY .env
```
Should show something like: `APP_KEY=base64:RANDOM_STRING_HERE`

---

## Missing HTTPS

### ⚠️ Issue
Running without HTTPS allows attackers to intercept sensitive data including passwords and session cookies.

### 🔍 Check
```bash
curl -I http://yourdomain.com
```
If you can access the site via HTTP, you're not properly enforcing HTTPS.

### ✅ Fix - Get SSL Certificate
Using Let's Encrypt (free):
```bash
sudo apt update
sudo apt install certbot python3-certbot-nginx

# For Nginx
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# For Apache
sudo certbot --apache -d yourdomain.com -d www.yourdomain.com
```

### ✅ Fix - Force HTTPS in Laravel
Edit `.env`:
```ini
APP_URL=https://yourdomain.com
SESSION_SECURE_COOKIE=true
```

Clear config:
```bash
php artisan config:clear
php artisan config:cache
```

### ✅ Fix - Redirect HTTP to HTTPS (Nginx)
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    return 301 https://$server_name$request_uri;
}
```

### ✅ Fix - Redirect HTTP to HTTPS (Apache)
Add to `.htaccess` in public directory:
```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### 🔄 Verify Fix
```bash
curl -I http://yourdomain.com
```
Should return a 301 redirect to HTTPS.

---

## Exposed Git Directory

### ⚠️ Issue
`.git` directory accessible via web browser exposes your entire source code and history.

### 🔍 Check
```bash
curl https://yourdomain.com/.git/config
```
If you see git configuration, you have a problem!

### ✅ Fix for Nginx
```nginx
location ~ /\.git {
    deny all;
    return 404;
}
```

### ✅ Fix for Apache
Add to `.htaccess`:
```apache
<DirectoryMatch "^/.*/\.git/">
    Require all denied
</DirectoryMatch>
```

### ✅ Better Fix
Don't deploy `.git` directory to production at all:
```bash
# When deploying, exclude .git
rsync -av --exclude='.git' /local/path/ user@server:/production/path/
```

### 🔄 Verify Fix
```bash
curl https://yourdomain.com/.git/config
# Should return 404, NOT file contents
```

---

## Incorrect File Permissions

### ⚠️ Issue
Wrong file permissions can allow unauthorized access or prevent application from functioning.

### 🔍 Check
```bash
ls -la /path/to/laravel/
ls -la /path/to/laravel/storage/
ls -la /path/to/laravel/.env
```

### ✅ Fix
Set correct permissions:
```bash
# Navigate to Laravel root
cd /path/to/laravel

# Set directory ownership
sudo chown -R www-data:www-data .

# Set base permissions
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# Make storage and cache writable
chmod -R 775 storage bootstrap/cache

# Secure .env file
chmod 600 .env

# Make artisan executable
chmod +x artisan
```

### 🔄 Verify Fix
```bash
ls -la .env
# Should show: -rw------- (600)

ls -la storage
# Should show: drwxrwxr-x (775)
```

---

## Weak Database Credentials

### ⚠️ Issue
Using default or weak passwords like "password", "root", "admin" makes your database vulnerable.

### 🔍 Check
Look at your `.env` file:
```bash
grep DB_PASSWORD .env
```

### ✅ Fix
Generate a strong password:
```bash
# Generate a strong random password
openssl rand -base64 32
```

Update MySQL user password:
```sql
-- Connect to MySQL as root
mysql -u root -p

-- Change user password
ALTER USER 'your_db_user'@'localhost' IDENTIFIED BY 'STRONG_PASSWORD_HERE';
FLUSH PRIVILEGES;
EXIT;
```

Update `.env` file:
```ini
DB_PASSWORD=STRONG_PASSWORD_HERE
```

Clear and cache config:
```bash
php artisan config:clear
php artisan config:cache
```

### 🔄 Verify Fix
Test database connection:
```bash
php artisan tinker
>>> DB::connection()->getPdo();
# Should connect successfully
```

---

## Missing CSRF Protection

### ⚠️ Issue
Forms without CSRF tokens are vulnerable to Cross-Site Request Forgery attacks.

### 🔍 Check
View source of your forms. Look for `<input type="hidden" name="_token">`.

### ✅ Fix - Blade Forms
Add `@csrf` directive to all POST forms:
```blade
<form method="POST" action="/profile">
    @csrf
    <!-- form fields -->
    <button type="submit">Submit</button>
</form>
```

### ✅ Fix - AJAX Requests
Include CSRF token in AJAX headers:
```javascript
// Get token from meta tag
const token = document.querySelector('meta[name="csrf-token"]').content;

// Axios (if using)
axios.defaults.headers.common['X-CSRF-TOKEN'] = token;

// Fetch API
fetch('/api/endpoint', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': token,
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
});
```

Ensure meta tag exists in `<head>`:
```blade
<meta name="csrf-token" content="{{ csrf_token() }}">
```

### 🔄 Verify Fix
Submit a form without the CSRF token. Should get a 419 error.

---

## Unvalidated File Uploads

### ⚠️ Issue
Allowing any file type to be uploaded can lead to remote code execution.

### 🔍 Check
Review your file upload code for validation.

### ✅ Fix
Always validate file uploads:
```php
// In your controller
public function upload(Request $request)
{
    $validated = $request->validate([
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'document' => 'required|file|mimes:pdf,doc,docx|max:10240',
    ]);

    // Store in non-public directory
    $path = $request->file('avatar')->store('avatars', 'private');
    
    // Or for public access with proper filename
    $filename = $request->file('avatar')->hashName();
    $path = $request->file('avatar')->storeAs('avatars', $filename, 'public');
    
    return response()->json(['path' => $path]);
}
```

### ✅ Additional Security
```php
// In config/filesystems.php, configure private disk
'disks' => [
    'private' => [
        'driver' => 'local',
        'root' => storage_path('app/private'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'private',
    ],
],
```

Serve private files through controller:
```php
public function download($id)
{
    $file = UserFile::findOrFail($id);
    
    // Authorize user can access this file
    $this->authorize('download', $file);
    
    return Storage::disk('private')->download($file->path);
}
```

---

## Missing Rate Limiting

### ⚠️ Issue
Without rate limiting, attackers can brute force passwords or overwhelm your server.

### 🔍 Check
Try logging in with wrong password multiple times quickly. If not blocked after 5 attempts, you need rate limiting.

### ✅ Fix - Authentication Routes
Laravel includes rate limiting by default. Ensure it's configured:

In `app/Http/Kernel.php`:
```php
protected $middlewareGroups = [
    'web' => [
        // ... other middleware
        \Illuminate\Routing\Middleware\ThrottleRequests::class.':web',
    ],
];
```

For login route specifically:
```php
// In routes/web.php
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1'); // 5 attempts per minute
```

### ✅ Fix - API Routes
```php
// In routes/api.php
Route::middleware('throttle:60,1')->group(function () {
    Route::apiResource('users', UserController::class);
});
```

### ✅ Custom Rate Limit
In `app/Providers/RouteServiceProvider.php`:
```php
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

protected function configureRateLimiting()
{
    RateLimiter::for('login', function (Request $request) {
        return Limit::perMinute(5)->by($request->ip());
    });
}
```

Apply in routes:
```php
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:login');
```

### 🔄 Verify Fix
Try logging in with wrong password 6 times quickly. Should be blocked after 5 attempts with "Too Many Attempts" error.

---

## Quick Security Scan

Run these commands to quickly check for common issues:

```bash
#!/bin/bash

echo "🔍 Security Quick Scan"
echo "====================="

# Check .env is not in public directory
if [ -f "public/.env" ]; then
    echo "❌ .env found in public directory - MOVE IT!"
else
    echo "✅ .env not in public directory"
fi

# Check .env permissions
if [ -f ".env" ]; then
    PERMS=$(stat -c "%a" .env)
    if [ "$PERMS" = "600" ]; then
        echo "✅ .env permissions correct (600)"
    else
        echo "⚠️  .env permissions: $PERMS (should be 600)"
    fi
fi

# Check APP_DEBUG setting
if grep -q "APP_DEBUG=true" .env; then
    echo "❌ APP_DEBUG is true - SET TO FALSE IN PRODUCTION!"
else
    echo "✅ APP_DEBUG is false or not found"
fi

# Check APP_KEY is set
if grep -q "APP_KEY=$" .env; then
    echo "❌ APP_KEY is not set - RUN php artisan key:generate"
else
    echo "✅ APP_KEY is set"
fi

# Check storage permissions
if [ -w "storage" ]; then
    echo "✅ storage directory is writable"
else
    echo "❌ storage directory is not writable"
fi

echo "====================="
echo "For complete security checklist, see SECURITY_BEST_PRACTICES.md"
```

Save as `security-check.sh`, make executable, and run:
```bash
chmod +x security-check.sh
./security-check.sh
```

---

## 🆘 Emergency Response

If you discover you've been compromised:

1. **Immediately** put site in maintenance mode:
   ```bash
   php artisan down
   ```

2. Change ALL passwords:
   - Database password
   - Admin panel passwords
   - Server SSH passwords
   - All API keys and secrets

3. Rotate APP_KEY:
   ```bash
   php artisan key:generate
   ```
   ⚠️ This will log out all users

4. Check for backdoors:
   ```bash
   find . -type f -name "*.php" -mtime -7
   ```

5. Restore from clean backup if available

6. Review logs:
   ```bash
   tail -f storage/logs/laravel.log
   sudo tail -f /var/log/nginx/access.log
   sudo tail -f /var/log/nginx/error.log
   ```

7. Once secured, bring site back:
   ```bash
   php artisan up
   ```

---

## 📚 More Resources

- [SECURITY_BEST_PRACTICES.md](SECURITY_BEST_PRACTICES.md) - Comprehensive security guide
- [DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md) - Pre-deployment security checklist
- [SECURITY.md](SECURITY.md) - Security policy and reporting

**Need help?** Contact: abdessamadbattal@gmail.com
