<?php
  session_start();
  header("Content-type: text/css");
?>

  .background
  {
    background: #66999 url(../../uploads/<?php echo $_SESSION['login_background']; ?>) center center cover no-repeat fixed;
  }
