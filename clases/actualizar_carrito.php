<?php
    function agregar($id, $cantidad)
    {
        $res = 0;
    
        if ($id > 0 && $cantidad > 0 && is_numeric(($cantidad))) {
            if (isset($_SESSION['carrito']['productos'][$id])) {
                $_SESSION['carrito']['productos'][$id] = $cantidad;
    
                $db = new Database();
                $con = $db->conectar();
    
                $sql = $con->prepare("SELECT precio, descuento FROM juegos WHERE id=? AND  activo=1 LIMIT 1");
                $sql->execute([$id]);
                $row = $sql->fetch(PDO::FETCH_ASSOC);
                $precio = $row['precio'];
                $descuento = $row['descuento'];
                $precio_des = $precio - (($precio * $descuento) / 100);
                $res = $cantidad * $precio_des;
    
                return $res;
            }
        }else{
            return $res;
        }
    }

    function eliminar($id){
        if($id > 0){
            if(isset($_SESSION['carrito']['productos'][$id])){
                unset($_SESSION['carrito']['productos'][$id]);
                return true;
            }
        }else {
            return false;
        }
    }
?>