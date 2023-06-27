function confirmarDeleteUsuario(){
    var respuesta = confirm("Esta seguro que desea eliminar este usuario");

    if(respuesta){
        return true;
    }else{
        return false;
    }
}