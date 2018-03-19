<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>اسکژولار | خانه</title>

  <!-- <link rel="stylesheet" href="css/reset.min.css">
  <link rel='stylesheet prefetch' href='css/fonts.google.css'>
  <link rel='stylesheet prefetch' href='css/font-awesome.min.css'> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/index.css">
</head>

<body>

<?php
require_once dirname(__FILE__) . '/jdatetime.class.php';
/*
echo jDateTime::date('Y-m-d', false, false);
echo "<br />";
echo jDateTime::date('Y-m-d', false, false, false);
echo "<br />";
echo jDateTime::date("l j F Y H:i T", false, null, null, 'America/New_York');
echo "<br />";
echo jDateTime::Date("l j F Y H:i", false, false, null, null, 1*24*3600);
*/
$date = new jDateTime(false, true, 'Asia/Tehran');
$monthNames = Array($date->getMonthNames(1), $date->getMonthNames(2), $date->getMonthNames(3),
$date->getMonthNames(4), $date->getMonthNames(5), $date->getMonthNames(6), $date->getMonthNames(7),
$date->getMonthNames(8), $date->getMonthNames(9), $date->getMonthNames(10), $date->getMonthNames(11),
$date->getMonthNames(12));

if (!isset($_REQUEST["month"])) $_REQUEST["month"] = $date->mDate("n");
if (!isset($_REQUEST["year"])) $_REQUEST["year"] = $date->mDate("Y");

$cMonth = $_REQUEST["month"];
$cYear = $_REQUEST["year"];
 
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;
 
if ($prev_month == 0 ) {
    $prev_month = 12;
    $prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
    $next_month = 1;
    $next_year = $cYear + 1;
}
?>
<table width="200" style="direction: rtl;">
<tr align="center">
<td bgcolor="#999999" style="color:#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="50%" align="right"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $prev_month . "&year=" . $prev_year; ?>" style="color:#FFFFFF">ماه قبل</a></td>
<td width="50%" align="left"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $next_month . "&year=" . $next_year; ?>" style="color:#FFFFFF">ماه بعد</a>  </td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr align="center">
<td colspan="7" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong></td>
</tr>
<tr>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $date -> getDayNames("sat"); ?></strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $date -> getDayNames("sun"); ?></strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $date -> getDayNames("mon"); ?></strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $date -> getDayNames("tue"); ?></strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $date -> getDayNames("wed"); ?></strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $date -> getDayNames("thu"); ?></strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $date -> getDayNames("fri"); ?></strong></td>
</tr>
<?php
date_default_timezone_set('Asia/Tehran');
$a = $date->toGregorian($cYear, $cMonth, 1);
$timestamp = mktime(0, 0, 0, $a[1], $a[2], $a[0]+1900);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
$maxday = (($cMonth > 6) ? 30 : 31);
if (!$date->IsLeapYear($cYear))
    $maxday = 29;
for ($i=0; $i<($maxday+$startday); $i++) {
    if(($i % 7) == 0 ) echo "<tr>";
    if($i < $startday) echo "<td></td>";
    else echo "<td align='center' valign='middle' height='20px'>". ($i - $startday + 1) . "</td>";
    if(($i % 7) == 6 ) echo "</tr>";
}
?>
</table>
</td>
</tr>
</table>
</body>
</html>