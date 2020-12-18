$(document).ready(function(){
    tablaCapitulos = $("#tablaCapitulos").DataTable({
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
    $("#formCapitulos").trigger("reset");
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Capitulo");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //Agregar
    
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('th:eq(0)').text());
    numeroCapitulo= fila.find('td:eq(0)').text();
    tituloCapitulo = fila.find('td:eq(1)').text();
    
    
    
    $("#tituloCapitulo").val(tituloCapitulo);
    $("#numeroCapitulo").val(numeroCapitulo);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Capitulo");            
    $("#modalCRUD").modal("show");  
     
    
});

//botón BORRAR
validacionBorrar=$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('th:eq(0)').text());

    tituloCapitulo = String($(this).closest("tr").find('td:eq(1)').text());
    opcion = 3 //borrar
    swal.fire({
        title: '¿Está seguro de borrar el capitulo '+tituloCapitulo+'?',
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
                url: "../bd/crud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id:id},
                success: function(){
                    tablaCapitulos.row(fila.parents('tr')).remove().draw();
                    
                }
               
               
            });
            if(validacion=!null){
                Swal.fire({
                    icon: "success",
                    title: "El Capitulo ha sido borrado correctamente",
                    showConfirmButton: false,   
                    html: '<a href="../views/GestionarCapitulos.php"><button  class="btn btn-primary">Aceptar</button><a/>',
                    allowOutsideClick: false
                })
                 
            }
            else{
                alert("mal");
            }
        }
       
    });
    
    
});
   
    



    
validacion=$("#formCapitulos").submit(function(e){

     
    
    tituloCapitulo = $.trim($("#tituloCapitulo").val());
    numeroCapitulo = $.trim($("#numeroCapitulo").val());  
     $.ajax({
        url: "../bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {tituloCapitulo:tituloCapitulo, numeroCapitulo:numeroCapitulo,  id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            tituloCapitulo = data[0].tituloCapitulo;
            numeroCapitulo = data[0].numeroCapitulo;
            if(opcion == 1){tablaPersonas.row.add([id,tituloCapitulo,numeroCapitulo]).draw();
                  
            }
            else{tablaPersonas.row(fila).data([id,tituloCapitulo,numeroCapitulo]).draw();        
            
            }            
        } 
    });
    
    
    
    if(validacion!=null){
        Swal.fire({
            icon: "success",
            title: "¡El usuario ha sido guardado correctamente!",     
            showConfirmButton: false,   
            html: '<a href="../views/GestionarCapitulos.php"><button  class="btn btn-primary">Aceptar</button><a/>',
            allowOutsideClick: false
        })
        e.preventDefault();  
    }
    else{
        alert("mal");
    }
    

   
});    

    
});