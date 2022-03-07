<?php

use Controllers\Utils\Utility;

session_start();
if (!isset($_ENV['SESSION_APP_NAME'])) {
    http_response_code(401);
    Utility::logError(401, "User not authenticated,..");
    die(401);
}
$sessionData = $_SESSION[$_ENV['SESSION_APP_NAME']];
if (!isset($sessionData['expires_at'])) {
    http_response_code(401);
    Utility::logError(401, "User not authenticated,..");
    die(401);
} else {
    if (time() > $sessionData['expires_at']) {
        session_unset();
        session_destroy();
        http_response_code(401);
        Utility::logError(401, "Session expired");
        die(401);
    }
}