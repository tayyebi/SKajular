<?php
require_once 'init.php';
$date = jDateTime::Date("Y-m-d", false, false, null, null, 0);
if (isset($_GET['date']))
    $date = $_GET['date'];
$datekey = preg_replace('/[^0-9+]/', '', $date);
$gregoriandate = jDateTime::toGregorian(2018, 05, 25); // TODO //
mysqli_query(Init::Db(), "INSERT INTO `Calendar` (`DateKey`, `Jalali`, `Gregorian`) SELECT '" . $datekey . "', '" . $datekey . "', '2018-05-25' WHERE NOT EXISTS (SELECT `DateKey` FROM `Calendar` WHERE DateKey='" . $datekey . "' LIMIT 1);");
if (isset($_POST['session']))
{
  $query = "INSERT INTO `Session` (`Date`, `From`, `To`, `Note`) VALUES ('" . $_POST['date'] . "', '" . $_POST['from'] . "', '" . $_POST['to'] . "', '" . $_POST['note'] . "')";
  echo $query;
  exit;
  mysqli_query(Init::Db(), $query);
}
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>اسکژولار | روز <?php echo $date?></title>

  <link rel="stylesheet" href="css/schedule.css">
</head>

<body>
<div class="timetable">

<form method="post" action="schedule.php">
  <input type="text" name="note" placeholder="توضیحات" />
  <input type="text" placeholder="از ساعت" name="from" data-mask="__:__" />
  <input type="text" placeholder="تا ساعت" name="to" data-mask="__:__" />
  <input type="hidden" name="date" value="<?php echo $datekey ?>" />
  <select name="eventid">
  <!-- TODO: Group by event type
  <optgroup label="Outdoors">
  </optgroup>
  -->
  <?php
  $events = mysqli_query(Init::Db(), "SELECT * FROM `Events`;");
  while($event = $events->fetch_assoc())
  {
    echo '<option value="' . $event["Id"] . '">' . $event["Title"] . '</option>';
  }
  ?>
  </select>
  <input type="submit" name="session" value="تعریف جلسه" />
</form>4
تست
<?php
$sessions = mysqli_query(Init::Db(), "SELECT * FROM `Session` WHERE `Date`='" . $datekey . "' ORDER BY `From` ASC;");
while($session = $sessions->fetch_assoc())
{
  echo $session["Note"];
}
?>
</div>
</body>
<script type="text/javascript">
Array.prototype.forEach.call(document.body.querySelectorAll("*[data-mask]"), applyDataMask);

function applyDataMask(field) {
    var mask = field.dataset.mask.split('');

    // For now, this just strips everything that's not a number
    function stripMask(maskedData) {
        function isDigit(char) {
            return /\d/.test(char);
        }
        return maskedData.split('').filter(isDigit);
    }

    // Replace `_` characters with characters from `data`
    function applyMask(data) {
        return mask.map(function(char) {
            if (char != '_') return char;
            if (data.length == 0) return char;
            return data.shift();
        }).join('')
    }

    function reapplyMask(data) {
        return applyMask(stripMask(data));
    }

    function changed() {   
        var oldStart = field.selectionStart;
        var oldEnd = field.selectionEnd;

        field.value = reapplyMask(field.value);

        field.selectionStart = oldStart;
        field.selectionEnd = oldEnd;
    }

    field.addEventListener('click', changed)
    field.addEventListener('keyup', changed)
}
</script>
</html>