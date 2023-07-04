function confirmarDeleteUsuario(){
    var respuesta = confirm("Esta seguro que desea eliminar este usuario");

    if(respuesta){
        return true;
    }else{
        return false;
    }
}

function confirmarDelete(){
    var respuesta = confirm("Esta seguro que desea eliminar este juego");

    if(respuesta){
        return true;
    }else{
        return false;
    }
}

function insertarJuego(){
    return alert("Juego agregado correctamente");
}

function mostrarPaypal(){
    document.getElementById('paypal').style.display = 'block';
}

function ocultarPaypal(){
    document.getElementById('paypal').style.display = 'none';
}

function mostrarTarjeta(){
    document.getElementById('tarjeta').style.display = 'block';
}

function ocultarTarjeta(){
    document.getElementById('tarjeta').style.display = 'none';
}