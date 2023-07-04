$(buscarJuegos());

function buscarJuegos(consulta){
    $.ajax({
        url: 'Tienda_online/clases/buscar.php',
        type: 'POST',
        dataType: 'html',
        data: {consulta: consulta},
    })
    .done(function(respuesta){
        $("#datos").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    })
}