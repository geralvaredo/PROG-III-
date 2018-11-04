function AltaUsuario()
{
alert("estoy en alta");


	 var parametroNombre = $("#Anombre").val();
	 var parametroEmail = $("#Aemail").val();
	 var parametroPassword = $("#Apw").val();
	 var parametroTipo = $("#Atipo").val();
 	var parametroID= $("#Aid").val();
 
		var funcionAjax=$.ajax({
			type:"POST",
			url:"./nexo.php",
			data:
			{
				nombre:parametroNombre,
				email:parametroEmail,
				password:parametroPassword,
				tipo:parametroTipo,
				id:parametroID,
				QueHago:'AltaUsuario'
			}
		});

		funcionAjax.done(function (respuesta){
			SubirFoto();
			MostrarGrilla();
		

				
			
		});

	}

function BorrarUsuario(idParametro)
{

	alert(idParametro);

		var funcionAjax=$.ajax({
			type:"POST",
			url:"./nexo.php",
			data:
			{
				ID:idParametro,
				QueHago:'BajaUsuario'
			}
		});

		funcionAjax.done(function (respuesta){
			MostrarGrilla();

				
			
		});

	}

	function ModificarUsuario(idParametro)
{
   

		var funcionAjax=$.ajax({
			type:"POST",
			url:"./nexo.php",
			data:
			{
				
				ID:idParametro,
				QueHago:'TraerUsuario'
			}
		});

		funcionAjax.done(function (respuesta){
		
		var usuario = JSON.parse(respuesta);
			$("#alta").val("Modificacion");
	  $("#Anombre").val(usuario.Nombre);
	  $("#Aemail").val(usuario.Email);
	  $("#Apw").val(usuario.Password);
	  $("#Atipo").val(usuario.Tipo);
	 $("#Aid").val(usuario.id);
			

				
			
		});

	}





function doneSubirFoto(objJson){
MostrarGrilla();
}


function FailAjax(jqXHR, textStatus, errorThrown){

alert("falla");
	console.info(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
}

function doneMostrarGrilla(datosRta){

	$("#divGrilla").html(datosRta);
}

function SubirFoto(){

    var pagina = "./nexo.php";
	var foto = $("#archivo").val();

	var archivo = $("#archivo")[0];
	var formData = new FormData();//objeto que me permite subir archivo
	formData.append("archivo",archivo.files[0]);
	formData.append("QueHago", "subirFoto");

	parametros={
		type: 'POST',
        url: pagina,
      
		cache: false,//para subir foto va en false
		contentType: false,//para subir foto va en false
		processData: false,//para subir foto va en false
        data: formData,
        async: true

	}
	$.ajax(parametros)
	.done(doneSubirFoto)
	.fail(FailAjax);   //termina mi ajax
}