<?php

session_start();

$_SESSION = $_GET["contador"];

echo $_SESSION["contador"];

?>
