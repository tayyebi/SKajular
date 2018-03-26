<?php
require_once 'init.php';
require_once 'datagrid.php';


if (isset($_POST['event']))
{
 //INSERT 
 
 $result = mysqli_query(Init::Db()," INSERT INTO Events ( Id, Type, Title )  VALUES ( '$Id', '$Type', '$Title' ) "); 

 if( $result )
 {
 	echo 'Success';
 }
 else
 {
 	echo 'Query Failed';
 }

 //UPDATE 
 $result = mysqli_query(Init::Db()," UPDATE Events SET  Id = '$Id',  Type = '$Type',  Title = '$Title' WHERE col = val "); 

 if( $result )
 {
 	echo 'Success';
 }
 else
 {
 	echo 'Query Failed';
 }

 //DELETE 
 $result = mysqli_query(Init::Db()," DELETE FROM Events WHERE col = val "); 

 if( $result )
 {
 	echo 'Success';
 }
 else
 {
 	echo 'Query Failed';
 }
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
    <form method="post" action="events.php">
    <input type="hidden" name="Id" id="Id" />
    <label for="type">نوع رویداد</label>
    <select name="type">
      <option value="COURSE">دوره‌ی آموزشی</option>
      <option value="OFF">تعطیلی</option>
      <option value="FESTIVAL">جشنواره</option>
    </select>
    <label for="title">عنوان</label>
    <input type="text" name="title" id="Title" />
    <button type="submit">
      <svg version="1.1" class="send-icn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="36px" viewBox="0 0 100 36" enable-background="new 0 0 100 36" xml:space="preserve">
        <path d="M100,0L100,0 M23.8,7.1L100,0L40.9,36l-4.7-7.5L22,34.8l-4-11L0,30.5L16.4,8.7l5.4,15L23,7L23.8,7.1z M16.8,20.4l-1.5-4.3
	l-5.1,6.7L16.8,20.4z M34.4,25.4l-8.1-13.1L25,29.6L34.4,25.4z M35.2,13.2l8.1,13.1L70,9.9L35.2,13.2z" />
      </svg>
      <small>ارسال</small>
    </button>
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