<?php
// General Configuration
define('APP_NAME', 'GACS Dashboard');
define('APP_URL', getenv('APP_URL') ?: 'http://localhost');
define('ASSETS_URL', APP_URL . '/assets');

// Session Configuration
$session_secure = filter_var(getenv('SESSION_SECURE'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_secure', $session_secure);
ini_set('session.name', getenv('SESSION_NAME') ?: 'GACS_SESSION');
ini_set('session.cookie_lifetime', (int) (getenv('SESSION_LIFETIME') ?: 3600));
session_start();

// Timezone
date_default_timezone_set(getenv('APP_TIMEZONE') ?: 'UTC');

// Error Reporting (set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 0); // Disabled to prevent breaking JSON responses
ini_set('log_errors', 1);

// Autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Load Database Config
require_once __DIR__ . '/database.php';

// Helper Functions
require_once __DIR__ . '/../lib/helpers.php';
