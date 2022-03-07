<?php
require_once "./../vendor/autoload.php";
session_start();
if (!isset($_ENV['SESSION_APP_NAME'])) {
    Controllers\Utils\Utility::logError(1, "Here");
    header('Location: login');
}
$sessionData = $_SESSION[$_ENV['SESSION_APP_NAME']];
if (!isset($sessionData['expires_at'])) {
    Controllers\Utils\Utility::logError(1, "Here One" . json_encode($sessionData));
    header('Location: login');
} else {
    if(time() > $sessionData['expires_at']){
        Controllers\Utils\Utility::logError(1, "Here tow");
        session_unset();
        session_destroy();
        header('Location: login');
    }
}

$user = $sessionData['user'];
?>

<script type="text/javascript">
    const loggedInUser = <?php echo $user; ?>
</script>