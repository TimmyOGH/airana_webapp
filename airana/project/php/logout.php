<?php
session_start();

// Clear all session variables
session_unset();

// Destroy session
session_destroy();

header("Location: /airana/project/html/main.html");
exit();
?>
