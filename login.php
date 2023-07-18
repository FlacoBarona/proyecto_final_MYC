<?php 
session_start();
$valor = false;
if (isset($_SESSION['user_name'])) {
    $valor = true;
  }
  echo json_encode($valor);
?>