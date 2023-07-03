<?php

function inicioSesion($usuario, $clave, $con) {
    $sql = $con->prepare("SELECT id, usuario FROM usuarios WHERE usuario=? AND clave=?");   
    $sql->execute([$usuario, $clave]); 
    if ($row = $sql->fetch(PDO::FETCH_ASSOC)) {  
        $_SESSION['used_id'] = $row['id'];
        $_SESSION['used_name'] = $row['usuario'];
        header("Location: index.php");
        exit;
    } else {
        return 'El usuario y/o clave son incorrectas';
    }
}

function inicioSesionAdmin($usuario, $clave, $con) {
    $sql = $con->prepare("SELECT id, usuario FROM usuarios WHERE usuario=? AND clave=?");   
    $sql->execute([$usuario, $clave]); 
    if ($row = $sql->fetch(PDO::FETCH_ASSOC)) {  
        $_SESSION['used_id'] = $row['id'];
        $_SESSION['used_name'] = $row['usuario'];
        header("Location: admin.php");
        exit;
    } else {
        return 'El usuario y/o clave son incorrectas';
    }
}

?>