<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location:index.php");
    exit();
}


?>
Salve irmão isso aqui é seu<br>
<a href="sair.php">Sair</a>
