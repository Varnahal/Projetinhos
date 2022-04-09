<?php

session_start();
ob_start();
define('chuvachu',true)
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Varnahal</title>
</head>
<body>
   <?php
   require './vendor/autoload.php';
   use Core\ConfigControler as Home;
   $url = new Home();
   $url->carregar();
   ?> 
</body>
</html>