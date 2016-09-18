<?php
 session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="/css/icon.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/materialize.min.css">
  <link rel="stylesheet" href="/css/sweetalert2.min.css">
  <link rel="stylesheet" href="/css/flipclock.css">
  <script type="text/javascript" src="/js/jquery-3.1.0.min.js"></script>
  <script type="text/javascript" src="/js/flipclock.min.js"></script>
  <script src="/js/sweetalert2.min.js"></script>
<style type="text/css">
pre {white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;}
  .parsley-required,.parsley-type,.parsley-minlength{color:#d32f2f }
</style>
</head>
<body id="body">
  <div id="login">
  <?php if(isset($_SESSION['userid']))
  echo '  <a class="waves-effect waves-red btn-flat right" href="/accounts/signout/">Sign out</a>';
    else
    echo '  <a class="waves-effect waves-green btn-flat right" href="/accounts/signin/">Sign in </a>';
  ?>
</div>
<div id="newadd">
</div>
