<?php
/*
$result = mysqli_query(Init::Db(), " "' AND `Password`='" . $_POST['password'] . "'");
if ($result->num_rows == 1) {
$_SESSION['USERID'] = ($result->fetch_assoc())['Id'];
*/

require_once 'init.php';
$date = jDateTime::Date("Y-m-d", false, false, null, null, 0);
if (isset($_GET['date']))
    $date = $_GET['date'];
$datekey = preg_replace('/[^0-9+]/', '', $date);
$gregoriandate = jDateTime::toGregorian(2018, 05, 25); // TODO

// Calendar dim
mysqli_query(Init::Db(), "INSERT INTO `Calendar` (`DateKey`, `Jalali`, `Gregorian`) SELECT '" . $datekey . "', '" . $datekey . "', '2018-05-25' WHERE NOT EXISTS (SELECT `DateKey` FROM `Calendar` WHERE DateKey='" . $datekey . "' LIMIT 1);");

?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>اسکژولار | ورود به سیستم</title>

  <!-- <link rel="stylesheet" href="css/reset.min.css">
  <link rel='stylesheet prefetch' href='css/fonts.google.css'>
  <link rel='stylesheet prefetch' href='css/font-awesome.min.css'> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/schedule.css">
</head>

<body>

</body>
</html>