<?php 
session_start();
if( !isset($_SESSION["submit"])){
  header("Location: login_form.php");
  exit;
}

//koneksi ke dalam database
require '../function.php';

include '../header.php'; 
?>