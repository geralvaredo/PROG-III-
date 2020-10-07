

/*unction MostroBien (respuesta){
	$('#divGrilla').html(datosRespuesta);
	*/




/*unction MostrarGrilla(){
	
    var pagina = "./administracion.php";
    $.ajax({
    	type:'POST',//los atributos se separan por comas
    	url: pagina,
    	data:{ queHago:'mostrarGrilla',}, //puede recibir texto, un objeto Json
    	dataType:'html'	//el ultimo elemento no lleva coma
    })
    .done(
    	MostroBien//{} $('#divGrilla').html(datosRespuesta);	en la funcion de MostroBien    
    )
    .fail(function (jqXHR, textStatus, errorThrown) {	//este recibe mas parametros, informacion de lo que pasó mal
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);	//alert, o console
    });
 
}*/
function FailAjax(jqXHR, textStatus, errorThrown){

	console.info(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
}
function doneBorrarId()
{
   $("#Id").val("");
 	$("#Nombre").val("");
  	$("#Clave").val("");
}
 function BorrarId(id)
 {
	var pagina = "clases/Nexo.php";
    $.ajax(
    {
        type: 'POST',
        url: pagina,	//llama a la pagina que ya esta arriba
        dataType: "json",
		cache: false,
		contentType: false,
		processData: false,
		async: true
        data: 
        {
             datos:id ;
        }
        

    })
	.done(doneBorrarId) {
			//.done es una funcion, recive un delegado/manejador, creado en el instante, puede ser Json o lo que quiera

		
	})
	.fail(FailAjax) {	//este recibe mas parametros, informacion de lo que pasó mal
        	//alert, o console
    });
	*/	

	}//FUNCION
	





    /*var pagina = "./administracion.php";
	var foto = $("#archivo").val();
	
	if(foto === "")
	{
		return;
	}

	var archivo = $("#archivo")[0];
	var formData = new FormData();	//dato para subir archivos. En este caso, una foto
	formData.append("archivo",archivo.files[0]);
	formData.append("queHago", "subirFoto");

	$.ajax({
        type: 'POST',
        url: pagina,	//llama a la pagina que ya esta arriba
        dataType: "json",
		cache: false,
		contentType: false,
		processData: false,
        data: formData,
        async: true
    })
	.done(function (objJson) {		//.done es una funcion, recive un delegado/manejador, creado en el instante, puede ser Json o lo que quiera

		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		$("#divFoto").html(objJson.Html);
	})
	.fail(function (jqXHR, textStatus, errorThrown) {	//este recibe mas parametros, informacion de lo que pasó mal
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);	//alert, o console
    }); */  


/*function BorrarFoto(){

	var pagina = "./administracion.php";
	var foto = $("#hdnArchivoTemp").val();
	
	if(foto === "")
	{
		alert("No hay foto que borrar!!!");
		return;
	}
	
	$.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
			queHago : "borrarFoto",
			foto : foto
		},
        async: true
    })
	.done(function (objJson) {

		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		
		$("#divFoto").html("");
		$("#hdnArchivoTemp").val("");
		$("#archivo").val("");
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });   	
	
	return;
}

function AgregarProducto(){
	alert($("input[type='radio']:checked").val());
	//alert($("#id:'perecedero'").val());	este no lo tiene
    var pagina = "./administracion.php";
	var codBarra = $("#codBarra").val();
	var nombre = $("#nombre").val();
	var archivo = $("#hdnArchivoTemp").val();
	var queHago = $("#hdnQueHago").val();
	
	var producto = {};
	producto.nombre = nombre;
	producto.codBarra = codBarra;
	producto.archivo = archivo;

	if(!Validar(producto)){
		alert("Debe completar TODOS los campos!!!");
		return;
	}
	
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
			queHago : queHago,
			producto : producto
		},
        async: true
    })
	.done(function (objJson) {
		
		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		
		alert(objJson.Mensaje);
		
		BorrarFoto();
		
		$("#codBarra").val("");
		$("#nombre").val("");
		
		MostrarGrilla();

		if(queHago !== "agregar"){
			$("#hdnQueHago").val("agregar");
			$("#codBarra").removeAttr("readonly");
		}
		
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    
		
}

function EliminarProducto(producto){
	
	if(!confirm("Desea ELIMINAR el PRODUCTO "+producto.nombre+"??")){
		return;
	}
	
    var pagina = "./administracion.php";
	
    $.ajax({
        type: 'POST',
        url: pagina,
        dataType: "json",
        data: {
			queHago : "eliminar",
			producto : producto
		},
        async: true
    })
	.done(function (objJson) {
		
		if(!objJson.Exito){
			alert(objJson.Mensaje);
			return;
		}
		
		alert(objJson.Mensaje);
		
		MostrarGrilla();

	})
	.fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    
	
}
function ModificarProducto(objJson){

	$("#codBarra").val(objJson.codBarra);
	$("#nombre").val(objJson.nombre);

	$("#hdnQueHago").val("modificar");
	
	$("#codBarra").attr("readonly", "readonly");
}

function Validar(objJson){

	alert("implementar validaciones...");
	//aplicar validaciones
	return true;
}

*/