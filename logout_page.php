<?php

session_start();
session_unset();
session_destroy();

setcookie("Email", "", time() - 10000000, "/");
setcookie("Username", "", time() - 10000000, "/");
setcookie("Id", "", time() - 10000000, "/");

header("Location: home_page.php");
exit();
?>