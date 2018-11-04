function ValidarLogin()
{
	 var parametroNombre = $("#nombre").val();
	 var parametroEmail = $("#email").val();
	 var parametroPassword = $("#pw").val();

		var funcionAjax=$.ajax({
			type:"POST",
			url:"./nexo.php",
			data:
			{
				nombre:parametroNombre,
				email:parametroEmail,
				password:parametroPassword,
				QueHago:'ValidarLogin'
			}
		});

		funcionAjax.done(function (respuesta){
			console.info("dd",respuesta);
			QueMostrar("MostrarLogin");

				
			
		});

	}



		function QueMostrar(dato)
{
	alert(dato);
		var funcionAjax=$.ajax({
			type:"POST",
			url:"./nexo.php",
			data:
			{
				QueHago:dato
			}
		});

		funcionAjax.done(function (respuesta){
			
		$("#QueMostrar").html(respuesta);
		});

	}


	function deslogear()
{	

	var funcionAjax=$.ajax({
		url:"./desloguearUsuario.php",
		type:"post"		
	});
	funcionAjax.done(function(retorno){

			//$("#usuario").val("Sin usuario.");
			//$("#BotonLogin").html("Login<br>-Sesión-");
			//$("#BotonLogin").removeClass("btn-danger");
			//$("#BotonLogin").addClass("btn-primary");
			alert("DESLOGUEADO");
						QueMostrar("MostrarLogin");
	});	
}

	function MostrarGrilla()
{

		var funcionAjax=$.ajax({
			type:"POST",
			url:"./nexo.php",
			data:
			{
				QueHago:"MostrarGrilla"
			}
		});

		funcionAjax.done(function (respuesta){
		$("#QueMostrar").html(respuesta);
		});

	}
