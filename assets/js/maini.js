$(document).ready(function(){
    tablaIndices = $("#tablaIndices").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='acciones d-flex justify-content-around'><button class='buttonCrud btnEditar' ><i class='fas fa-edit' id='ieditar'></i> </button><button class='buttonCrud btnBorrar'><i class='fas fa-trash 'id='iborrar'></i></button></div>"  
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
    $("#formIndices").trigger("reset");
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Índices");            
    $("#modalCRUD").modal("show");        
    id_indices=null;
    opcion = 1; //Agregar
    
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id_indices = parseInt(fila.find('th:eq(0)').text());
    id_capitulo= fila.find('td:eq(0)').text();
    numero_ind = fila.find('td:eq(1)').text();
    nombre_ind = fila.find('td:eq(2)').text();
    descripcion_ind = fila.find('td:eq(3)').text();
    
    
    
    $("#id_capitulo").val(id_capitulo);
    $("#numero_ind").val(numero_ind);
    $("#nombre_ind").val(nombre_ind);
    $("#descripcion_ind").val(descripcion_ind);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Índices");            
    $("#modalCRUD").modal("show");  
     
    
});

//botón BORRAR
validacionBorrar=$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id_indices = parseInt($(this).closest("tr").find('th:eq(0)').text());

    nombre_ind = String($(this).closest("tr").find('td:eq(1)').text());
    opcion = 3 //borrar
    swal.fire({
        title: '¿Está seguro de borrar el indices '+nombre_ind+'?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: "Aceptar"
      }).then(function(result){
    
        if(result.value){
    
            $.ajax({
                url: "../bd/crudi.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id_indices:id_indices},
                success: function(){
                    tablaIndices.row(fila.parents('tr')).remove().draw();
                    
                }
               
               
            });
            if(validacion=!null){
                Swal.fire({
                    icon: "success",
                    title: "El Indice ha sido borrado correctamente",
                    showConfirmButton: false,   
                    html: '<a href="../views/GestionarIndices.php"><button  class="btn btn-primary">Aceptar</button><a/>',
                    allowOutsideClick: false
                })
                 
            }
            else{
                alert("mal");
            }
        }
       
    });
    
    
});
   
    



    
validacion=$("#formIndices").submit(function(e){

     
    
    id_capitulo = $.trim($("#id_capitulo").val());
    numero_ind = $.trim($("#numero_ind").val()); 
    nombre_ind = $.trim($("#nombre_ind").val());
    descripcion_ind = $.trim($("#descripcion_ind").val()); 
    indice_id = $.trim($("#indice_id").val());
     $.ajax({
        url: "../bd/crudi.php",
        type: "POST",
        dataType: "json",
        data: {id_capitulo:id_capitulo, numero_ind:numero_ind,nombre_ind:nombre_ind,descripcion_ind:descripcion_ind, id_indices:id_indices,indice_id:indice_id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id_indices = data[0].id_indices;            
            id_capitulo = data[0].id_capitulo;
            numero_ind = data[0].numero_ind;
            nombre_ind = data[0].nombre_ind;
            descripcion_ind = data[0].descripcion_ind;
            indice_id = data[0].indice_id;
            if(opcion == 1){tablaPersonas.row.add([id_indices,id_capitulo,numero_ind,nombre_ind,descripcion_ind,indice_id]).draw();
                  
            }
            else{tablaPersonas.row(fila).data([id_indices,id_capitulo,numero_ind,nombre_ind,descripcion_ind,indice_id]).draw();        
            
            }            
        } 
    });
    
    
    
    if(validacion!=null){
        Swal.fire({
            icon: "success",
            title: "¡El indice ha sido guardado correctamente!",     
            showConfirmButton: false,   
            html: '<a href="../views/GestionarIndices.php"><button  class="btn btn-primary">Aceptar</button><a/>',
            allowOutsideClick: false
        })
        e.preventDefault();  
    }
    else{
        alert("mal");
    }
    

   
});    

    
});