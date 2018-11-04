function eliminar(usuario)
{
    //alert(usuario);
    //var usu = usuario;
    //var accion = $('#accion').val();
    //alert(accion);
    
    var datos={   "usu": usuario,
                "accion": $('#accion').val()
               } 
    
  
  
   $.ajax(
    {
        type: 'POST',
        url: "nexo.php",
        data: datos,
        success: function(data){
           
            $('#tabla-usuario').html(data);
        }
        
    })   
}
function recargar()
{
 $('#volver').click(function(){
	$.ajax({
		type: "POST",
		url: "ContainerAlta.php",
		data: dataString,
		success: function(data){
			//Cargamos finalmente el contenido deseado
			$('#tabla-container').html(data);}
	});
});   
}

function bajaContainer(container)
{
    var datos =
        {
            "accion" : "Baja" ,
            "container" : container
        }
    
     $.ajax(
    {
        type: 'POST',
        url: "nexo.php",
        data: datos,
        success: function(data){
           
            $('#tabla-container').html(data);
        }
        
    })  
    
    
}
function filtrado()
{
    
    
    var datos = {
               "accion": $('#filtrar').val(),
                "pais" : $('#pais').val()       
    }
    
     $.ajax(
    {
        type: 'POST',
        url: "nexo.php",
        data: datos,
        success: function(data){
           
            $('#tabla-container').html(data);
        }
        
    })  
}





