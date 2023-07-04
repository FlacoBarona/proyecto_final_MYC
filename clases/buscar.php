<?php

$con = new mysqli("localhost", "root", "", "tienda_online");
$salida = "";



$campo = isset($_POST['campo']) ? $con->real_escape_string($_POST['campo']) : null;
$where = '';
if($campo != null){
    $sql = "SELECT * FROM juegos
    WHERE nombre LIKE '%" . $campo . "%'";
}else{
    $salida .=
    "<tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>";
}
$resultado = $con->query($sql);
if ($resultado->num_rows > 0) {
$fila = $resultado->fetch_assoc();
        $salida .=
            "<tr>
                <td>" . $fila['nombre'] . "</td>
                <td>" . $fila['descripcion'] . "</td>
                <td>" . $fila['precio'] . "</td>
                <td>" . $fila['descuento'] . ' %'. "</td>
                <td>" . $fila['id_categoria'] . "</td>
                <td>". ' <a href="index.php" class="btn btn-primary">Ver detalles</a>'. "</td>
            </tr>";

} else {
    $salida .= "NO HAY COINSIDENCIA";
}

echo json_encode($salida, JSON_UNESCAPED_UNICODE);
$con->close();

?>