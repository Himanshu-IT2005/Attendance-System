// logout.php
<?php
session_start();

if(session_status() === PHP_SESSION_ACTIVE) {
    session_unset();
    session_destroy();
    echo "Logout successful. Redirecting...";
    header("refresh:3;url=Home.html");
    exit();
} else {
    echo "No active session. Redirecting...";
    header("refresh:3;url=Home.html");
    exit();
}
?>