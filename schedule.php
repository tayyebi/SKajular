<?php
require_once 'init.php';
$date = jDateTime::Date("Y-m-d", false, false, null, null, 0);
if (isset($_GET['date']))
    $date = $_GET['date'];
echo $date;
?>