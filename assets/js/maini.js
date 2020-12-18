$(document).ready(function(){
    tablaIndices = $("#tablaIndices").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='acciones d-flex justify-content-around'><button class='buttonCrud btnEditar' ><i class='fas fa-edit' id_indices='ieditar'></i> </button><button class='buttonCrud btnBorrar'><i class='fas fa-trash 'id_indices='iborrar'></i></button></div>"  
       }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formCapitulos").trigger("reset");
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Indice");            
    $("#modalCRUD").modal("show");        
    id_indices=null;
    opcion = 1; //alta
    
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id_indices = parseInt(fila.find('th:eq(0)').text());
    id_capitulo= fila.find('td:eq(0)').text();
    nombre_ind = fila.find('td:eq(1)').text();
    numero_ind = fila.find('td:eq(2)').text();
    descripcion_ind = fila.find('td:eq(3)').text();
    
    
    
    $("#id_capitulo").val(id_capitulo);
    $("#nombre_ind").val(nombre_ind);
    $("#numero_ind").val(numero_ind);
    $("#descripcion_ind").val(descripcion_ind);

    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Indice");            
    $("#modalCRUD").modal("show");  
     
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id_indices = parseInt($(this).closest("tr").find('th:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id_indices+"?");
    if(respuesta){
        $.ajax({
            url: "../bd/crudi.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id_indices:id_indices},
            success: function(){
                tablaIndices.row(fila.parents('tr')).remove().draw();
                
            }
           
           
        });
       
    }  
    
    window.location.href="../views/gestionarIndices.php";
    
});
});