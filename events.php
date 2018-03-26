<?php //Query 
require_once 'init.php';
require_once 'datagrid.php';


 //SELECT 
 
 $result = mysqli_query(Init::Db()," SELECT Id, Type, Title FROM Events "); 
 if( $result )
 	table($result);

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
  <title>اسکژولار | روز <?php echo $date?></title>

  <link rel="stylesheet" href="css/events.css">
</head>
<body>
    <form id="form1" name="form1" method="post" action="events.php">
    <input type="hidden" name="Id" id="Id" />
    <br class="clear" /> 
    <label for="Type">Type</label><input type="text" name="Type" id="Type" />
    <br class="clear" /> 
    <label for="Title">Title</label><input type="text" name="Title" id="Title" />
    <br class="clear" />
    <input type="submit" name="event" value="post" />
    </form>
</body>
</html>