<?php
// ログインの有無を判別するための処理
  session_start();
  if (!isset($_SESSION['id'])){
    header('Location: login.php');
  }
?>