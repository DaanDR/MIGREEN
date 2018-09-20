<?php
session_start();
 include_once ("../config/configure.php");

    // Session Leeg....
    $_SESSION = array();

    // Redirect naar login
    echo '
      <script type="text/javascript">
            parent.window.location.href = "http://' . APP_PATH . 'autorisatie/login.php";
      </script>';

    echo header($strUrl = 'http://' . APP_PATH . 'autorisatie/login.php'); // 'autorisatie/login.php';)
?>