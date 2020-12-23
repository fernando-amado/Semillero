$(document).ready(function(){
    tablaUsuarios = $("#tablaUsuarios").DataTable({
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
    $("#formUsuarios").trigger("reset");
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo usuario");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //Agregar
    
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('th:eq(0)').text());
    nombre= fila.find('td:eq(0)').text();
    apellido = fila.find('td:eq(1)').text();
    correo = fila.find('td:eq(2)').text();
    contrasena = fila.find('td:eq(3)').text();
    
    
    
    $("#nombre").val(nombre);
    $("#apellido").val(apellido);
    $("#correo").val(correo);
    $("#contrasena").val(contrasena);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Usuario");            
    $("#modalCRUD").modal("show");  
     
    
});

//botón BORRAR
validacionBorrar=$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('th:eq(0)').text());

    nombre = String($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    swal.fire({
        title: '¿Está seguro de borrar el usuario '+nombre+'?',
        text: "¡Si no lo está, puede cancelar la accíón!",
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
                    title: "El usuario ha sido borrado correctamente",
                    showConfirmButton: false,   
                    html: '<a href="../views/GestionarUsuarios.php"><button  class="btn btn-primary">Aceptar</button><a/>',
                    allowOutsideClick: false
                })
                 
            }
            else{
                alert("mal");
            }
        }
       
    });
    
    
});
   
    

//VALIDACIONES FORMULARIOS

const formulario = document.getElementById('formUsuarios');
const inputs = document.querySelectorAll('#formUsuarios input');

const expresiones = {
	
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apellido: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	contrasena: /^[a-zA-ZÀ-ÿ0-9\s]{4,16}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
}
const campos = {
	nombre: false,
    apellido: false,
    correo: false,
    contrasena: false
	
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "nombre":
			validarCampo(expresiones.nombre, e.target,'nombre');
		break;
		case "apellido":
			validarCampo(expresiones.apellido, e.target, 'apellido');
        break;
        case "correo":
			validarCampo(expresiones.correo, e.target, 'correo');
        break;
        case "contrasena":
			validarCampo(expresiones.apellido, e.target, 'contrasena');
		break;
		
	}
}
const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});


$("#formUsuarios").submit(function(e){

    const terminos = document.getElementById('terminos');
	if(campos.nombre && campos.apellido && campos.correo && campos.contrasena  ){
		
        nombre = $.trim($("#nombre").val());
        apellido = $.trim($("#apellido").val());  
        correo = $.trim($("#correo").val());
        contrasena = $.trim($("#contrasena").val());
         $.ajax({
            url: "../bd/crudUsuarios.php",
            type: "POST",
            dataType: "json",
            data: {nombre:nombre, apellido:apellido,correo:correo,contrasena:contrasena,  id:id, opcion:opcion},
            success: function(data){  
                console.log(data);
                id = data[0].id;            
                nombre = data[0].nombre;
                apellido= data[0].apellido;
                correo= data[0].correo;
                contrasena= data[0].contrasena;
                if(opcion == 1){tablaPersonas.row.add([id,nombre,apellido,correo,contrasena]).draw();
                      
                }
                else{tablaPersonas.row(fila).data([id,nombre,apellido,correo,contrasena]).draw();        
                
                }            
            } 
        });
        Swal.fire({
            icon: "success",
            title: "¡El usuario ha sido guardado correctamente!",     
            showConfirmButton: false,   
            html: '<a href="../views/GestionarUsuarios.php"><button  class="btn btn-primary">Aceptar</button><a/>',
            allowOutsideClick: false
        })
        e.preventDefault(); 
		
	}

   
    
    
    
    else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
	}
    

   
});    
    


    
});