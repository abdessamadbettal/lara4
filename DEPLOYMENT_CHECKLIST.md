# 🚀 Production Deployment Checklist

Use this checklist every time you deploy to production to ensure your Laravel application is secure and optimized.

## Pre-Deployment

### Code & Dependencies
- [ ] All code committed and pushed to repository
- [ ] Code reviewed and tested
- [ ] Unit tests passing: `php artisan test`
- [ ] No debug statements or console.log in code
- [ ] Dependencies updated: `composer update` and `npm update`
- [ ] Security audit run: `composer audit` and `npm audit`
- [ ] `.gitignore` properly configured to exclude sensitive files

### Configuration Review
- [ ] Environment variables reviewed for production
- [ ] Database connection details verified
- [ ] Mail configuration tested
- [ ] Queue configuration set up
- [ ] Cache driver configured (Redis recommended)
- [ ] Session driver configured (database or Redis)
- [ ] Filesystem disk configured for file uploads
- [ ] Backup configuration tested

## Server Setup

### Server Requirements
- [ ] PHP 8.2+ installed
- [ ] Required PHP extensions enabled:
  - [ ] OpenSSL
  - [ ] PDO
  - [ ] Mbstring
  - [ ] Tokenizer
  - [ ] XML
  - [ ] Ctype
  - [ ] JSON
  - [ ] BCMath
  - [ ] Fileinfo
  - [ ] GD
- [ ] Composer installed globally
- [ ] Node.js and npm installed
- [ ] Web server installed (Nginx or Apache)
- [ ] Database server installed (MySQL/PostgreSQL)
- [ ] Redis installed (optional but recommended)
- [ ] Supervisor installed for queue workers

### SSL/HTTPS
- [ ] SSL certificate obtained (Let's Encrypt or commercial)
- [ ] Certificate installed and configured
- [ ] HTTPS redirect configured
- [ ] Mixed content issues resolved
- [ ] Certificate auto-renewal set up

### Web Server Configuration
- [ ] Document root points to `/public` directory
- [ ] `.env` file access blocked
- [ ] Hidden files (.*) access blocked
- [ ] PHP files outside `/public` not accessible
- [ ] Proper URL rewriting configured
- [ ] Security headers configured:
  - [ ] X-Frame-Options: SAMEORIGIN
  - [ ] X-Content-Type-Options: nosniff
  - [ ] X-XSS-Protection: 1; mode=block
  - [ ] Referrer-Policy: no-referrer-when-downgrade
  - [ ] Content-Security-Policy configured
- [ ] Server tokens/signatures hidden
- [ ] Gzip compression enabled
- [ ] HTTP/2 enabled (if available)

## Laravel Configuration

### Environment Configuration (.env)
```ini
# Core Settings
- [ ] APP_NAME set to production name
- [ ] APP_ENV=production
- [ ] APP_KEY generated (php artisan key:generate)
- [ ] APP_DEBUG=false
- [ ] APP_URL set to production domain (with https://)

# Security
- [ ] SESSION_SECURE_COOKIE=true
- [ ] SESSION_HTTP_ONLY=true
- [ ] SESSION_SAME_SITE=strict

# Database
- [ ] DB_CONNECTION set correctly
- [ ] DB_HOST set correctly
- [ ] DB_PORT set correctly
- [ ] DB_DATABASE set correctly
- [ ] DB_USERNAME set to non-root user
- [ ] DB_PASSWORD set to strong password

# Cache & Queue
- [ ] CACHE_DRIVER set (redis recommended)
- [ ] QUEUE_CONNECTION set (redis or database)
- [ ] REDIS_HOST configured if using Redis
- [ ] REDIS_PASSWORD set if using Redis

# Mail
- [ ] MAIL_MAILER configured
- [ ] MAIL_HOST configured
- [ ] MAIL_FROM_ADDRESS set correctly
- [ ] MAIL_FROM_NAME set correctly
- [ ] Test email sent successfully

# Services
- [ ] GOOGLE_CLIENT_ID set (if using)
- [ ] GOOGLE_CLIENT_SECRET set (if using)
- [ ] GITHUB_CLIENT_ID set (if using)
- [ ] GITHUB_CLIENT_SECRET set (if using)
- [ ] AWS credentials configured (if using S3)
```

### File Permissions
```bash
# Run these commands on your server
- [ ] Laravel root: chmod 755 /path/to/laravel
- [ ] Storage writable: chmod -R 775 storage
- [ ] Bootstrap cache writable: chmod -R 775 bootstrap/cache
- [ ] .env secure: chmod 600 .env
- [ ] Set ownership: chown -R www-data:www-data /path/to/laravel
```

### Optimization Commands
```bash
# Run these after deployment
- [ ] php artisan config:cache
- [ ] php artisan route:cache
- [ ] php artisan view:cache
- [ ] php artisan event:cache
- [ ] composer install --optimize-autoloader --no-dev
- [ ] npm run build (or npm ci && npm run build)
```

### Database
- [ ] Database created
- [ ] Database user created with appropriate permissions
- [ ] Database backup script configured
- [ ] Migrations run: `php artisan migrate --force`
- [ ] Seeders run if needed: `php artisan db:seed --force`
- [ ] Database connection tested

### Storage & Logs
- [ ] Storage link created: `php artisan storage:link`
- [ ] Log directory writable
- [ ] Log rotation configured
- [ ] Old logs cleanup automated
- [ ] Media library disk configured
- [ ] File upload limits set correctly

### Queue Workers (if using queues)
- [ ] Supervisor installed
- [ ] Queue worker configuration created
- [ ] Supervisor reloaded: `supervisorctl reread && supervisorctl update`
- [ ] Queue worker started: `supervisorctl start laravel-worker:*`
- [ ] Failed jobs handling configured

**Example Supervisor Configuration:**
```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/laravel/artisan queue:work redis --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/laravel/storage/logs/worker.log
stopwaitsecs=3600
```

### Scheduled Tasks
- [ ] Cron job added for Laravel scheduler
```bash
* * * * * cd /path/to/laravel && php artisan schedule:run >> /dev/null 2>&1
```
- [ ] Scheduler verified: `php artisan schedule:list`
- [ ] Critical schedules tested

### Backup Configuration
- [ ] Backup disk configured (S3, DigitalOcean Spaces, etc.)
- [ ] Backup schedule configured
- [ ] Backup notification email set
- [ ] Manual backup tested: `php artisan backup:run`
- [ ] Backup restoration tested
- [ ] Backup monitoring set up

## Security Verification

### Critical Security Checks
- [ ] `.env` file not accessible via browser: `curl https://yourdomain.com/.env`
- [ ] Debug mode disabled (check error pages)
- [ ] Git directory not accessible: `curl https://yourdomain.com/.git/`
- [ ] Admin panel protected (rate limiting, IP whitelist if needed)
- [ ] CSRF protection enabled on all forms
- [ ] SQL injection protection (using Eloquent/Query Builder)
- [ ] XSS protection (Blade escaping enabled)
- [ ] File upload validation implemented
- [ ] Authorization checks on sensitive routes
- [ ] Rate limiting configured for API and auth routes

### Security Headers Verification
Test at: https://securityheaders.com/

- [ ] X-Frame-Options header present
- [ ] X-Content-Type-Options header present
- [ ] X-XSS-Protection header present
- [ ] Referrer-Policy header present
- [ ] Content-Security-Policy configured
- [ ] Strict-Transport-Security header present (HSTS)

### SSL/TLS Verification
Test at: https://www.ssllabs.com/ssltest/

- [ ] SSL certificate valid
- [ ] Certificate chain complete
- [ ] Grade A or higher
- [ ] TLS 1.2+ enabled
- [ ] TLS 1.0/1.1 disabled
- [ ] Weak ciphers disabled

## Application Testing

### Functionality Testing
- [ ] Homepage loads correctly
- [ ] User registration works
- [ ] User login works
- [ ] Password reset works
- [ ] Social login works (if configured)
- [ ] Admin panel accessible
- [ ] File uploads work
- [ ] Email sending works
- [ ] Search functionality works
- [ ] Forms submit correctly
- [ ] API endpoints work (if applicable)

### Performance Testing
- [ ] Page load time acceptable (<3 seconds)
- [ ] Images optimized
- [ ] CSS/JS minified and bundled
- [ ] Browser caching configured
- [ ] Database queries optimized
- [ ] N+1 query issues resolved
- [ ] Opcache enabled and configured

### Browser Testing
- [ ] Chrome/Edge tested
- [ ] Firefox tested
- [ ] Safari tested (if target audience uses)
- [ ] Mobile responsive
- [ ] No console errors

## Monitoring & Logging

### Logging
- [ ] Laravel Log Viewer accessible (admin only)
- [ ] Application logging level set correctly
- [ ] Error reporting configured (Sentry, Bugsnag, etc.)
- [ ] Log rotation enabled
- [ ] Critical error notifications set up

### Monitoring
- [ ] Uptime monitoring configured (UptimeRobot, Pingdom, etc.)
- [ ] Server resource monitoring (CPU, RAM, Disk)
- [ ] Database performance monitoring
- [ ] Application performance monitoring (APM)
- [ ] SSL certificate expiry monitoring

### Backups
- [ ] Automated daily backups running
- [ ] Backup notifications working
- [ ] Off-site backup storage configured
- [ ] Backup restoration procedure documented
- [ ] Backup restoration tested recently

## Post-Deployment

### Immediate Checks (within 1 hour)
- [ ] Application accessible at production URL
- [ ] No error pages or exceptions
- [ ] Logs checked for critical errors
- [ ] Queue workers processing jobs
- [ ] Scheduled tasks running
- [ ] Email sending working
- [ ] Admin panel accessible

### Daily Checks (first week)
- [ ] Monitor logs daily for errors
- [ ] Check performance metrics
- [ ] Verify backup completion
- [ ] Monitor uptime
- [ ] Check for security alerts

### Regular Maintenance
- [ ] Weekly: Review logs and errors
- [ ] Weekly: Check server resources
- [ ] Monthly: Update dependencies (security patches)
- [ ] Monthly: Test backup restoration
- [ ] Monthly: Review security configuration
- [ ] Quarterly: Full security audit
- [ ] Quarterly: Performance optimization review

## Rollback Plan

### Preparation
- [ ] Previous version tagged in git
- [ ] Database backup taken before migration
- [ ] Rollback procedure documented
- [ ] Rollback tested in staging

### If Issues Occur
1. [ ] Put site in maintenance mode: `php artisan down`
2. [ ] Identify the issue in logs
3. [ ] If critical, rollback:
   ```bash
   git checkout previous-stable-tag
   composer install --no-dev
   php artisan migrate:rollback
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
4. [ ] Clear all caches: `php artisan cache:clear`
5. [ ] Restart queue workers: `supervisorctl restart laravel-worker:*`
6. [ ] Test application
7. [ ] Bring site back online: `php artisan up`

## Documentation

- [ ] Deployment documented in internal wiki
- [ ] Server credentials stored securely (password manager)
- [ ] Emergency contact list updated
- [ ] Deployment date and version logged
- [ ] Known issues documented
- [ ] Monitoring dashboards bookmarked

## Digital Ocean Specific

### Droplet Configuration
- [ ] Droplet size appropriate for traffic
- [ ] Automatic backups enabled
- [ ] Firewall configured:
  - [ ] Port 22 (SSH) - restricted to your IP
  - [ ] Port 80 (HTTP) - open
  - [ ] Port 443 (HTTPS) - open
  - [ ] Port 3306 (MySQL) - blocked from external access
- [ ] SSH key authentication configured
- [ ] Password authentication disabled
- [ ] Non-root sudo user created
- [ ] Fail2ban installed and configured
- [ ] UFW (firewall) enabled
- [ ] Monitoring alerts configured in DO dashboard

### Laravel Forge / Envoyer (if using)
- [ ] Deployment script configured
- [ ] Environment variables set
- [ ] Deploy hooks configured
- [ ] SSL certificate auto-renewal enabled
- [ ] Deployment notifications configured

## Sign-Off

**Deployed by:** _________________  
**Date:** _________________  
**Version/Commit:** _________________  
**Sign-off:** _________________  

---

## Quick Reference Commands

```bash
# Put site in maintenance mode
php artisan down --refresh=15 --secret="secret-token"

# Bring site back online
php artisan up

# Clear all caches
php artisan optimize:clear

# Rebuild caches
php artisan optimize

# Check queue worker status
supervisorctl status laravel-worker:*

# Restart queue workers
supervisorctl restart laravel-worker:*

# View recent logs
tail -f storage/logs/laravel.log

# Check disk space
df -h

# Check memory usage
free -m

# Check PHP-FPM status
systemctl status php8.2-fpm

# Restart PHP-FPM
systemctl restart php8.2-fpm

# Check Nginx status
systemctl status nginx

# Restart Nginx
systemctl restart nginx
```

---

**Last Updated:** February 2026  
**Next Review:** Before each major deployment  

For security concerns, see [SECURITY_BEST_PRACTICES.md](SECURITY_BEST_PRACTICES.md)
