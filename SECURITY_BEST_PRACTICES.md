# 🔒 Security Best Practices for Lara4

This document provides comprehensive security guidelines to help you avoid common security issues when developing and deploying your Laravel application.

## 📋 Table of Contents
- [Environment Security](#environment-security)
- [Deployment Security](#deployment-security)
- [Application Security](#application-security)
- [Database Security](#database-security)
- [Server Configuration](#server-configuration)
- [Monitoring and Maintenance](#monitoring-and-maintenance)
- [Common Vulnerabilities to Avoid](#common-vulnerabilities-to-avoid)

## 🔐 Environment Security

### Never Commit Sensitive Files

**Critical: Never commit these files to version control:**
- `.env` file (contains sensitive credentials)
- `storage/*.key` files
- `auth.json` with credentials
- Database dumps
- Private keys or certificates

**Action:** Verify `.gitignore` includes:
```
.env
.env.backup
.env.production
/storage/*.key
auth.json
```

### Application Key Security

**Issue:** Exposing `APP_KEY` allows attackers to decrypt session data, forge cookies, and compromise your application.

**Prevention:**
1. **Never** use the example APP_KEY from `.env.example`
2. Generate a unique key: `php artisan key:generate`
3. Keep your APP_KEY secret and never share it
4. Rotate keys if compromised (requires re-encrypting data)

### Environment File Protection

**Production Setup:**
```bash
# Set proper permissions
chmod 600 .env
chown www-data:www-data .env

# Ensure .env is NOT in public directory
# It should be in your Laravel root, NOT in /public
```

**Apache Configuration:**
```apache
<Files .env>
    Require all denied
</Files>
```

**Nginx Configuration:**
```nginx
location ~ /\.env {
    deny all;
    return 404;
}
```

## 🚀 Deployment Security

### Production Environment Variables

**Always set these in production `.env`:**
```ini
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_UNIQUE_GENERATED_KEY

# Use strong passwords
DB_PASSWORD=STRONG_RANDOM_PASSWORD

# Secure session settings
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict

# HTTPS enforcement
FORCE_HTTPS=true
```

### Debug Mode

**Critical:** `APP_DEBUG=false` in production!

**Why:** Debug mode exposes:
- Database queries and credentials
- File paths and system information
- Stack traces with code details
- Environment variables

### SSL/HTTPS Configuration

**Always use HTTPS in production:**
```bash
# Force HTTPS in Laravel
# Add to App\Http\Middleware\TrustProxies or create middleware
```

**In your routes or middleware:**
```php
// Force HTTPS
if (!request()->secure() && app()->environment('production')) {
    return redirect()->secure(request()->getRequestUri());
}
```

### File Permissions

**Set correct permissions on production server:**
```bash
# Laravel root directory
chmod 755 /path/to/your/laravel

# Storage and cache directories
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Make sure .env is not accessible
chmod 600 .env

# Protect sensitive files
chmod 600 composer.json composer.lock
```

## 🛡️ Application Security

### Input Validation

**Always validate and sanitize user input:**
```php
// Use Laravel validation
$validated = $request->validate([
    'email' => 'required|email|max:255',
    'name' => 'required|string|max:255',
]);

// Never trust user input in database queries
// Always use parameter binding (Eloquent does this automatically)
```

### SQL Injection Prevention

**Good practices:**
```php
// ✅ GOOD: Using Eloquent ORM
User::where('email', $email)->first();

// ✅ GOOD: Using query builder with bindings
DB::table('users')->where('email', $email)->first();

// ❌ BAD: Raw SQL with concatenation
DB::select("SELECT * FROM users WHERE email = '$email'");

// ✅ GOOD: Raw SQL with bindings
DB::select("SELECT * FROM users WHERE email = ?", [$email]);
```

### XSS Prevention

**Blade templates auto-escape by default:**
```blade
{{-- ✅ GOOD: Auto-escaped --}}
{{ $user->name }}

{{-- ❌ BAD: Unescaped (only use for trusted HTML) --}}
{!! $user->bio !!}
```

### CSRF Protection

**Laravel provides CSRF protection by default:**
```blade
<form method="POST" action="/profile">
    @csrf
    <!-- form fields -->
</form>
```

**For AJAX requests:**
```javascript
// Laravel includes CSRF token in meta tag
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').content;
```

### Mass Assignment Protection

**Always define fillable or guarded properties:**
```php
class User extends Model
{
    // ✅ GOOD: Define fillable fields
    protected $fillable = ['name', 'email', 'password'];
    
    // Or use guarded to protect specific fields
    protected $guarded = ['id', 'is_admin'];
}
```

### Authentication & Authorization

**Use Laravel's built-in authentication:**
```php
// Check authentication
if (Auth::check()) {
    // User is authenticated
}

// Authorize actions with policies
$this->authorize('update', $post);

// Use gates for simple checks
if (Gate::allows('update-post', $post)) {
    // User can update post
}
```

## 💾 Database Security

### Database Credentials

**Production best practices:**
1. Use strong, unique passwords (minimum 16 characters)
2. Create database users with minimal required privileges
3. Never use `root` user for application database access
4. Restrict database access to application server IP only

**MySQL security:**
```sql
-- Create dedicated database user
CREATE USER 'laravel_app'@'localhost' IDENTIFIED BY 'STRONG_RANDOM_PASSWORD';
GRANT SELECT, INSERT, UPDATE, DELETE ON laravel_db.* TO 'laravel_app'@'localhost';
FLUSH PRIVILEGES;
```

### Database Backups

**Automate backups using Spatie Laravel Backup:**
```bash
# Configure in config/backup.php
php artisan backup:run

# Schedule automatic backups (in app/Console/Kernel.php)
$schedule->command('backup:clean')->daily()->at('01:00');
$schedule->command('backup:run')->daily()->at('02:00');
```

**Secure backup storage:**
- Store backups off-site (AWS S3, DigitalOcean Spaces)
- Encrypt backup files
- Test restoration regularly

## 🖥️ Server Configuration

### Nginx Configuration

**Secure Nginx configuration for Laravel:**
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name yourdomain.com;
    
    # Redirect HTTP to HTTPS
    return 301 https://$server_name$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name yourdomain.com;
    root /var/www/laravel/public;

    # SSL Configuration
    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "no-referrer-when-downgrade" always;
    add_header Content-Security-Policy "default-src 'self' http: https: data: blob: 'unsafe-inline'" always;

    # Hide Nginx version
    server_tokens off;

    index index.php;

    charset utf-8;

    # Deny access to hidden files
    location ~ /\. {
        deny all;
        return 404;
    }

    # Deny access to sensitive files
    location ~ /\.env {
        deny all;
        return 404;
    }

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### Apache Configuration

**Secure Apache configuration:**
```apache
<VirtualHost *:443>
    ServerName yourdomain.com
    DocumentRoot /var/www/laravel/public

    SSLEngine on
    SSLCertificateFile /path/to/certificate.crt
    SSLCertificateKeyFile /path/to/private.key

    <Directory /var/www/laravel/public>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    # Deny access to .env file
    <Files .env>
        Require all denied
    </Files>

    # Security Headers
    Header always set X-Frame-Options "SAMEORIGIN"
    Header always set X-XSS-Protection "1; mode=block"
    Header always set X-Content-Type-Options "nosniff"
    
    # Hide Apache version
    ServerTokens Prod
    ServerSignature Off
</VirtualHost>
```

### PHP Configuration

**Security settings in `php.ini`:**
```ini
; Disable dangerous functions
disable_functions = exec,passthru,shell_exec,system,proc_open,popen

; Hide PHP version
expose_php = Off

; Limit resources
memory_limit = 256M
max_execution_time = 30
max_input_time = 60
upload_max_filesize = 10M
post_max_size = 10M

; Session security
session.cookie_httponly = 1
session.cookie_secure = 1
session.cookie_samesite = "Strict"

; Enable opcache for performance
opcache.enable = 1
```

## 📊 Monitoring and Maintenance

### Security Monitoring

**Implement logging and monitoring:**
```php
// Log security events
Log::warning('Failed login attempt', [
    'email' => $request->email,
    'ip' => $request->ip(),
]);

// Monitor activity with Spatie Activity Log (already included)
activity()
    ->causedBy($user)
    ->performedOn($model)
    ->log('action description');
```

**Use Laravel Log Viewer** (already included via opcodesio/log-viewer):
- Access at `/log-viewer` (configure permissions)
- Monitor errors and security events
- Set up alerts for critical events

### Regular Updates

**Keep your application secure:**
```bash
# Update composer dependencies regularly
composer update

# Check for security vulnerabilities
composer audit

# Update npm packages
npm update
npm audit fix

# Review Laravel security releases
# Subscribe to: https://github.com/laravel/framework/security/advisories
```

### Rate Limiting

**Protect against brute force attacks:**
```php
// In routes/web.php or routes/api.php
Route::middleware('throttle:60,1')->group(function () {
    // Routes limited to 60 requests per minute
});

// Custom rate limiting for login
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1'); // 5 attempts per minute
```

## ⚠️ Common Vulnerabilities to Avoid

### 1. Exposed Environment Files

**Issue:** `.env` file accessible via web browser

**Check:**
```bash
curl https://yourdomain.com/.env
# Should return 404, not file contents
```

**Fix:** Configure web server to deny access (see Server Configuration section)

### 2. Debug Mode in Production

**Issue:** `APP_DEBUG=true` exposes sensitive information

**Fix:**
```ini
# .env
APP_ENV=production
APP_DEBUG=false
```

### 3. Weak Database Credentials

**Issue:** Using default or weak passwords like "password", "root", "admin"

**Fix:**
```bash
# Generate strong password
openssl rand -base64 32

# Update .env
DB_PASSWORD=generated_strong_password
```

### 4. Missing CSRF Protection

**Issue:** Forms without `@csrf` token vulnerable to CSRF attacks

**Fix:** Always include `@csrf` in POST forms

### 5. Unvalidated File Uploads

**Issue:** Allowing any file type to be uploaded

**Fix:**
```php
$validated = $request->validate([
    'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
]);

// Store in non-public directory
$path = $request->file('avatar')->store('avatars', 'private');
```

### 6. Directory Traversal

**Issue:** User input in file paths allows accessing unauthorized files

**Fix:**
```php
// ❌ BAD
$file = Storage::get($request->input('file'));

// ✅ GOOD: Validate and sanitize
$filename = basename($request->input('file'));
$allowedFiles = ['document1.pdf', 'document2.pdf'];

if (in_array($filename, $allowedFiles)) {
    $file = Storage::get('documents/' . $filename);
}
```

### 7. Insecure Direct Object References (IDOR)

**Issue:** Exposing internal IDs without authorization checks

**Fix:**
```php
// ❌ BAD
public function show($id)
{
    return User::findOrFail($id);
}

// ✅ GOOD: Check authorization
public function show($id)
{
    $user = User::findOrFail($id);
    $this->authorize('view', $user);
    return $user;
}
```

### 8. Missing Content Security Policy

**Issue:** No CSP header allows XSS attacks

**Fix:** Add to middleware or web server configuration:
```php
// In middleware
return $next($request)->header('Content-Security-Policy', 
    "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';"
);
```

## 🔍 Security Checklist

Use this checklist before deploying to production:

- [ ] `APP_ENV=production` in `.env`
- [ ] `APP_DEBUG=false` in `.env`
- [ ] Unique `APP_KEY` generated (never use example key)
- [ ] Strong database password (16+ characters)
- [ ] `.env` file has correct permissions (600)
- [ ] `.env` not accessible via web browser
- [ ] HTTPS configured with valid SSL certificate
- [ ] Security headers configured (X-Frame-Options, CSP, etc.)
- [ ] Directory permissions set correctly (755 for directories, 644 for files)
- [ ] Storage and cache directories writable by web server
- [ ] Composer dependencies updated and audited
- [ ] npm packages updated and audited
- [ ] Database backups configured and tested
- [ ] Rate limiting enabled for authentication routes
- [ ] CSRF protection enabled on all forms
- [ ] File upload validation implemented
- [ ] Authorization checks on all sensitive operations
- [ ] Logging and monitoring configured
- [ ] Error pages don't expose sensitive information
- [ ] Server tokens/signatures disabled
- [ ] PHP dangerous functions disabled
- [ ] Session cookies set to secure and httponly
- [ ] Regular security updates scheduled

## 📚 Additional Resources

- [Laravel Security Documentation](https://laravel.com/docs/security)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Laravel Security Checklist](https://github.com/Qronicle/laravel-security-checklist)
- [PHP Security Best Practices](https://www.php.net/manual/en/security.php)

## 🆘 If You've Been Compromised

1. **Immediate actions:**
   - Take site offline (maintenance mode): `php artisan down`
   - Change all passwords (database, .env, admin accounts)
   - Rotate APP_KEY: `php artisan key:generate`
   - Review logs for suspicious activity
   - Scan for backdoors and malicious files

2. **Investigation:**
   - Check server access logs
   - Review database for unauthorized changes
   - Audit file modifications: `find . -type f -mtime -7`
   - Check for new admin users

3. **Recovery:**
   - Restore from clean backup if available
   - Update all dependencies
   - Apply security patches
   - Re-deploy with security measures in place
   - Notify affected users if personal data compromised

4. **Prevention:**
   - Document what happened
   - Implement additional security measures
   - Set up monitoring and alerts
   - Regular security audits

---

**Remember:** Security is an ongoing process, not a one-time task. Regularly review and update your security measures.

**Questions?** Review our [Security Policy](SECURITY.md) or contact: abdessamadbattal@gmail.com
