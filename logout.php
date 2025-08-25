<?php
session_start();
session_destroy();

// setelah logout, arahkan ke login
header("Location: login.php");
exit;
