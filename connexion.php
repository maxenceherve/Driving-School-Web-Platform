<?php
  $dbhost = 'tuxa.sme.utc';
  $dbuser = 'nf92p048';
  $dbpass = 'yfkHk550izKB';
  $dbname = 'nf92p048';
  $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
  mysqli_set_charset($connect, 'utf8');
?>
