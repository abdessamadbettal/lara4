# Security Policy

## 🔒 Security at Lara4

We take the security of Lara4 seriously. This document outlines our security policies and procedures.

## 📢 Reporting a Vulnerability

If you discover a security vulnerability within Lara4, please send an email to **abdessamadbattal@gmail.com**. 

**Please do not** report security vulnerabilities through public GitHub issues.

### What to Include

When reporting a vulnerability, please include:

- **Description:** A clear description of the vulnerability
- **Impact:** The potential impact of the vulnerability
- **Steps to Reproduce:** Detailed steps to reproduce the issue
- **Proof of Concept:** If possible, include a proof of concept
- **Suggested Fix:** If you have suggestions for fixing the issue

### Response Timeline

- **Initial Response:** Within 48 hours of report
- **Status Update:** Within 7 days with assessment
- **Fix Release:** Security patches released as soon as possible
- **Public Disclosure:** After fix is deployed and users have time to update

## 🛡️ Security Best Practices

For comprehensive security guidelines, please refer to:

- **[Security Best Practices Guide](SECURITY_BEST_PRACTICES.md)** - Detailed security guidelines
- **[Deployment Checklist](DEPLOYMENT_CHECKLIST.md)** - Pre-deployment security checks

### Quick Security Tips

1. **Never commit** `.env` files to version control
2. **Always use** `APP_DEBUG=false` in production
3. **Generate unique** `APP_KEY` for each installation
4. **Keep dependencies** updated regularly
5. **Use HTTPS** in production environments
6. **Set strong passwords** for database and admin accounts
7. **Enable rate limiting** on authentication routes
8. **Configure proper** file permissions on servers
9. **Regular backups** of database and files
10. **Monitor logs** for suspicious activity

## 🔐 Supported Versions

We release security updates for the following versions:

| Version | Supported          |
| ------- | ------------------ |
| Latest  | ✅ Yes             |
| Older   | ⚠️ Limited support |

## 🚨 Known Security Considerations

### Environment Configuration

**Critical:** The `.env.example` file should **never** contain real credentials or keys. Always generate new keys for production:

```bash
php artisan key:generate
```

### Debug Mode

**Never** run with `APP_DEBUG=true` in production as it exposes:
- Database credentials
- File paths
- Environment variables
- Application secrets

### File Permissions

Ensure proper permissions on production servers:
```bash
chmod 600 .env
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Database Security

- Use strong passwords (16+ characters, mixed case, numbers, symbols)
- Create dedicated database users with minimal required privileges
- Never use `root` user for application database access
- Restrict database access to application server IP only

### Web Server Configuration

Ensure your web server blocks access to:
- `.env` file
- `.git` directory
- `storage/` directory (except through Laravel)
- Any other sensitive files

## 🔄 Security Updates

We regularly update dependencies to patch security vulnerabilities. To stay secure:

```bash
# Update Composer dependencies
composer update
composer audit

# Update npm packages
npm update
npm audit fix

# Check for Laravel security advisories
# Subscribe: https://github.com/laravel/framework/security/advisories
```

## 📋 Security Checklist

Before deploying to production, verify:

- [ ] `APP_ENV=production` and `APP_DEBUG=false`
- [ ] Unique `APP_KEY` generated
- [ ] Strong database passwords
- [ ] `.env` file properly secured
- [ ] HTTPS configured
- [ ] Security headers enabled
- [ ] File permissions set correctly
- [ ] Dependencies updated
- [ ] Backups configured
- [ ] Monitoring enabled

For complete checklist, see [DEPLOYMENT_CHECKLIST.md](DEPLOYMENT_CHECKLIST.md)

## 📚 Additional Resources

- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Laravel Security Documentation](https://laravel.com/docs/security)
- [PHP Security Best Practices](https://www.php.net/manual/en/security.php)

## 🙏 Acknowledgments

We appreciate security researchers who help keep Lara4 secure. Responsible disclosure of vulnerabilities is greatly appreciated.

---

**Last Updated:** February 2026
