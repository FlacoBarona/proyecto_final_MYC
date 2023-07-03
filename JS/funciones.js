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