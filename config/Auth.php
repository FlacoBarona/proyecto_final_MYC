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

    function esNulo(array $parametros){
        foreach($parametros as $parametro){
            if(strlen(trim($parametro)) <1){
                return true;
            }
        }
        return false;
    }

    function esEmail($correo){
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    function validaClave($clave, $confirmaClave){
        if(Strcmp($clave, $confirmaClave) == 0){
            return true;
        }
        return false;
    }

    function usuarioExiste($usuario, $con) {
        $sql =$con->prepare("SELECT id FROM usuarios WHERE usuario LIKE ?");
        $sql->execute([$usuario]);
        if($sql->fetchColumn() > 0){
            return true;;
        }
        return false;
        
    }

    function registrar(array $datos, $con) {
        $sql =$con->prepare( "INSERT INTO usuarios (correo, usuario, clave, claveConfirma) 
                VALUES (?,?,?,?)");
        if($sql->execute($datos)){
            return true;;
        }
        return false;
        
    }

    function disminuirCantidad($id, $cantidada, $conexion){
        $sql = $conexion->prepere("UPDATE juegos SET  cantidad = $cantidada WHERE id='$id'");
        $sql->execute();
    }

?>