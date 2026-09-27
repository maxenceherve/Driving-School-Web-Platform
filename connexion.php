<?php
// Database connection. Credentials are loaded from config.php (not versioned).
require_once __DIR__ . '/config.php';

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('Error connecting to MySQL');
mysqli_set_charset($connect, 'utf8');
