function BorrarUsuario(idParametro)
{
	//alert(idParametro);
		var funcionAjax=$.ajax({
		url:"nexo.php",
		type:"post",
		data:{
			queHacer:"BorrarUsuario",
			id:idParametro	
		}
	});
	funcionAjax.done(function(retorno){
		Mostrar("MostrarGrilla");
		$("#informe").html("cantidad de eliminados "+ retorno);	

		
	});
	funcionAjax.fail(function(retorno){	
		$("#informe").html(retorno.responseText);	
	});	
}

function EditarUsuario(idParametro)
{
	var funcionAjax=$.ajax({
		url:"nexo.php",
		type:"post",

		data:{
			queHacer:"TraerUsuario",
			id:idParametro
		},
	
	});
	funcionAjax.done(function(retorno){
		console.info("erorr",retorno);
		var usuario = JSON.parse(retorno);
		$("#idUsuario").val(usuario.id);
		$("#usuario").val(usuario.usuario);
		$("#clave").val(usuario.contrasena);
		$("#tipo").val(usuario.tipo);
	});
	funcionAjax.fail(function(retorno){	
		$("#informe").html(retorno.responseText);	
	});	
	Mostrar("MostrarFormAlta");
}

function GuardarUsuario()
{
		var id=$("#idUsuario").val();
		alert(id);
		var usuario=$("#usu").val();
		var contrasena=$("#clave").val();
		var tipo=$("#tipo").val();
		alert(usuario);
		var funcionAjax=$.ajax({
		url:"nexo.php",
		type:"post",
		data:{
			queHacer:"GuardarUsuario",
			id:id,
			usuario:usuario,
			contrasena:contrasena,
			tipo:tipo	
		}
	});
	funcionAjax.done(function(retorno){
			Mostrar("MostrarGrilla");
			console.info("alta",retorno);
		$("#informe").html("cantidad de agregados "+ retorno);	
		
	});
	funcionAjax.fail(function(retorno){	
		$("#informe").html(retorno.responseText);	
	});	
}