<?php
require_once 'init.php';
require_once 'datagrid.php';

$type = $title = null;
if (isset($_GET['edit']))
{
  $result = mysqli_query(Init::Db(),"SELECT * FROM `Events` WHERE `Id`='" . $_GET['edit'] . "'");
  if ($result->num_rows == 1)
  {
    $row = $result->fetch_assoc();
    $type = $row['Type'];
    $title = $row['Title'];
  }
}
if (isset($_POST['insert']))
{ 
  mysqli_query(Init::Db(), "INSERT INTO Events (`Type`, `Title`)  VALUES ('" . $_POST['type'] . "', '" . $_POST['title'] . "' );");
}
else if (isset($_POST['update']))
{
  mysqli_query(Init::Db(), "UPDATE `Events` SET `Type` = '" . $_POST['type'] . "', `Title`='" . $_POST['title'] . "' WHERE `Id`=" . $_REQUEST['edit'] . ";");
  header('Location: events.php');
}
else if (isset($_GET['del']))
{
  mysqli_query(Init::Db(), "DELETE FROM `Events` WHERE `Id`=" . $_GET['del']);
}

?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>اسکژولار | رویداد <?php echo $date?></title>

  <link rel="stylesheet" href="css/events.css">
</head>
<body>
    <form method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
    <input type="hidden" name="Id" id="Id" />
      <label for="type">نوع رویداد</label>
      <select name="type">
        <option value="COURSE" <?= ($type == 'COURSE') ? "selected" : "" ?>>دوره‌ی آموزشی</option>
        <option value="OFF" <?= ($type == 'OFF') ? "selected" : "" ?>>تعطیلی</option>
        <option value="FESTIVAL" <?= ($type == 'FESTIVAL') ? "selected" : "" ?>>جشنواره</option>
      </select>
      <label for="title">عنوان</label>
      <input type="text" name="title" id="Title" value="<?= $title ?>" />
      <?php if (isset($_GET['edit']))
      {
        echo '<input name="update" type="submit" value="ویرایش" />';
      }
      else
      {
echo <<<MYBUTTON
<button type="submit" name="insert">
  <svg version="1.1" class="send-icn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="36px" viewBox="0 0 100 36" enable-background="new 0 0 100 36" xml:space="preserve">
    <path d="M100,0L100,0 M23.8,7.1L100,0L40.9,36l-4.7-7.5L22,34.8l-4-11L0,30.5L16.4,8.7l5.4,15L23,7L23.8,7.1z M16.8,20.4l-1.5-4.3l-5.1,6.7L16.8,20.4z M34.4,25.4l-8.1-13.1L25,29.6L34.4,25.4z M35.2,13.2l8.1,13.1L70,9.9L35.2,13.2z" />
  </svg>
  <small>ارسال</small>
</button>
MYBUTTON;
      }
      ?>
      <a href="index.php">بازگشت</a>
    </form>
<?php

 
$result = mysqli_query(Init::Db()," SELECT Id, Type 'نوع رویداد', Title 'عنوان رویداد' FROM Events "); 
if( $result )
  table($result);

?>
</body>
<script src='js/jquery.min.js'></script>
<script src="js/events.js"></script>
</html>