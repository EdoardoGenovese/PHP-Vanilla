<?php
session_start();

require_once 'connect.php';
$pdo = connect();

$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
include $page . '.php';
?>
