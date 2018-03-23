<?php
require_once 'init.php';
if (isset($_GET['Bye']) && $_GET['bye'] == "✓")
  session_destroy();
if (isset($_POST['login']))
{
  $result = mysqli_query(Init::Db(), "SELECT Id FROM `Users` WHERE `Username`='" . $_POST['username'] . "' AND `Password`='" . $_POST['password'] . "'");
  if ($result->num_rows == 1) {
    $_SESSION['USERID'] = ($result->fetch_assoc())['Id'];
    header('Location: index.php');
  }
  else{
    $_SESSION['message'] = "نام کاربری یا کلمه عبور صحیح نیست";
    header('Location: login.php');
  }
}
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
  <link rel="stylesheet" href="css/login.css">
</head>

<body>

<div class="pen-title">
  <h1>اسکژولار | ورود به سیستم</h1>
  <?php
  if (isset($_SESSION['message']))
  {
    echo '<span class="error">' . $_SESSION['message'] . '</span>';
    unset($_SESSION['message']);
  }
  else
    echo "<span>Pen <i class='fa fa-code'></i> by <a href='http://andytran.me'>Andy Tran</a></span>";
  ?>
</div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">لاگین</h1>
    <form method="post" action="login.php">
      <div class="input-container">
        <input name="username" type="#{type}" id="#{label}" required="required"/>
        <label for="#{label}">نام‌کاربری</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input name="password" type="#{type}" id="#{label}" required="required"/>
        <label for="#{label}">گذر‌واژه</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button name="login"><span>ورود</span></button>
      </div>
      <div class="footer"><a href="#">کلمه‌ی عبور خود را فراموش کرده‌اید؟</a></div>
    </form>
  </div>
  <div class="card alt">
    <div class="toggle"></div>
    <h1 class="title">ثبت نام
      <div class="close"></div>
    </h1>
    <form>
      <div class="input-container">
        <input type="#{type}" id="#{label}" required="required"/>
        <label for="#{label}">نام کاربری</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="#{type}" id="#{label}" required="required"/>
        <label for="#{label}">گذر‌واژه</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input type="#{type}" id="#{label}" required="required"/>
        <label for="#{label}">تکرار گذر‌واژه</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <button name="register"><span>بعدی</span></button>
      </div>
    </form>
  </div>
</div>
  <a id="home" href="/" title="برو به خانه!"><i class="fa fa-link"></i></a>
  <!-- Gordarg <a id="codepen" href="http://gordarg.com/" title="Follow me!"><i class="fa fa-codepen"></i></a> -->
  <script src='js/jquery.min.js'></script>
  <script  src="js/login.js"></script>

</body>

</html>
