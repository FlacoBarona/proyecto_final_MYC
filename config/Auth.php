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

function mostrarMensajes(array $errors){
    if(count($errors) > 0){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
        foreach($errors as $error){
            echo '<li>'. $error . '</li>';
        }
        echo '</ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        
    }            
}

?>