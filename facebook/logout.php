<?php
session_start();
session_destroy();
setcookie("admin","1",time() - (60 * 60 * 24 * 365));
header('location: /index.php');
?>