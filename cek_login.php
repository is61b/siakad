<?php 
session_start();
if(!isset($_SESSION['sid']) AND !isset($_COOKIE['cid'])){
  ?>
  <script>
    document.location="login.php";
  </script>
  <?php
}
?>