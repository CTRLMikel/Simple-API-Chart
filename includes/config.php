<?php
$db_user = 'root';
$db_password = '';
$db_name = 'alcohol';

try {
    $db = new PDO('mysql:host=127.0.0.1;dbname='.$db_name.';charset=utf8', $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors gracefully
    die('Connection failed: ' . $e->getMessage());
}

define('API_BASED_CHART_TITLE', 'Alcohol Consumption by Country');
?>
