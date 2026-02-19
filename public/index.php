<?php

use Illuminate\Http\Request;

/**
 * Laravel Application Entry Point
 * 
 * SECURITY NOTE: This file should be the ONLY PHP file in the public directory.
 * All other application files should be outside the web root for security.
 * 
 * Verify your web server configuration:
 * - Document root should point to /public directory
 * - .env file should NOT be accessible via web browser
 * - Hidden files (.*) should be blocked by web server
 * 
 * Test: curl https://yourdomain.com/.env (should return 404)
 */

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
