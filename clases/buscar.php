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
