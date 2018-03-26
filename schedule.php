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
  mysqli_query(Init::Db(), "INSERT INTO `Session` (`Date`, `From`, `To`, `Note`) VALUES ('" . $_POST['date'] . "', '" . $_POST['from'] . "', '" . $_POST['to'] . "', '" . $_POST['note'] . "')");
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

<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
  <input type="text" name="note" placeholder="توضیحات" />
  <input type="text" placeholder="از ساعت" name="from" data-mask="__:__" />
  <input type="text" placeholder="تا ساعت" name="to" data-mask="__:__" />
  <input type="hidden" name="date" value="<?php echo $datekey ?>" />
  <select name="eventid">
  <?php
  $eventtypes = mysqli_query(Init::Db(), "SELECT `Type` FROM `Events` GROUP BY `Type`;");
  while($eventtype = $eventtypes->fetch_assoc())
  {
    echo '<optgroup label="' . $eventtype["Type"] . '">';
    $events = mysqli_query(Init::Db(), "SELECT * FROM `Events` WHERE `Type`='" . $eventtype["Type"] . "';");
    while($event = $events->fetch_assoc())
    {
      echo '<option value="' . $event["Id"] . '">' . $event["Title"] . '</option>';
    }
    echo '</optgroup>';
  }
  ?>
  </select>
  <input type="submit" name="session" value="تعریف جلسه" />
</form>
<div class="sessions">
<?php
$sessions = mysqli_query(Init::Db(), "SELECT * FROM `Session` WHERE `Date`=" . $datekey . " ORDER BY `From` ASC;");
while($session = $sessions->fetch_assoc())
{
    echo '<div class="session">';
    echo '<a class="delete" href="schedule.php?date=' . $datekey . '&del=' . $session["Id"] . '">حذف</a>';
    echo '<a class="edit" href="schedule.php?date=' . $datekey . '&edit=' . $session["Id"] . '">ویرایش</a>';
    echo '<span class="note">' . $session["Note"] . '</span>';
    echo '<span class="time">' . substr($session["From"], 0,5) . ' - ' . substr($session["To"],0,5) . '</span>';
    echo '</div>';
}
?>
</div>
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