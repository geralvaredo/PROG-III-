<?php
class Container 
{
     private $numero ;
     private $descripcion ;
     private $pais ;
     private $foto ;

    function __construct ($numero, $descripcion, $pais, $foto )  {
        
        $this->numero = $numero ;
        $this->descripcion = $descripcion;
        $this->pais = $pais; 
        $this->foto = $foto ;
    }

    function getNumero(){
        
        return $this->numero;
    }
    function setNumero($numero){

        $this->numero = $numero;
    }
     function getDescripcion(){
        
        return $this->descripcion;
    }
    function setDescripcion($des){

        $this->descripcion = $des;
    }
    function getPais(){
        
        return $this->pais;
    }
    function setPais($pais){
        
         $this->pais = $pais;
    }
    function getFoto(){
        
        return $this->foto;
    }
    function setFoto($fotito){
        
       $this->foto = $fotito;
    }

    function toString() {

    return  $this->getNumero() . "-" . $this->getDescripcion() . "-" . $this->getPais() . "-" .
        $this->getFoto() . "\n"  ;  

    }

        public static function leer()
        {
          $listaDeContainer = array();
          $archivo=fopen("container.txt","r");
          while(!feof($archivo))
          {
            $renglon=fgets($archivo);
            $container=explode("-",$renglon);
            $container[0]=trim($container[0]);
            
            if($container[0]!="" )
              $listaDeContainer[]= new Container(trim($container[0]),trim($container[1]),trim($container[2]),trim($container[3]));
               
                       
          }    
    
                fclose($archivo);
          return $listaDeContainer;  

    }
    
      public static function  altaContainer($container)
    {
        $resultado = false;
        $path = 'abm_usuario_container/container.txt' ;
        if(file_exists($path)){
            $archivo =  fopen("container.txt","w") ;
            fwrite($archivo, $container->ToString()) ;
            fclose($archivo);
            $resultado = true;
        }
        else{
            $archivo =  fopen("container.txt","a") ; 
            fwrite($archivo, $container->ToString()) ;
            fclose($archivo);
            $resultado = true;
            }    
            
            return $resultado;
    }
    
    
    public static function baja($container)
    {             
        if($container === NULL) {
            return FALSE ;
        }
            
         $resultado = true;
        $listaContainers = Container::leer();
        $listaActualizada = array();
        $imagenBorrar = NULL;
        
        for($i=0; $i<count($listaContainers); $i++){
           if( $listaContainers[$i]->numero == $container){//encontre el borrado, lo excluyo
               $imagenBorrar = trim($listaContainers[$i]->foto);
               continue;
         }
             $listaActualizada[$i] = $listaContainers[$i];
          }
                
        unlink("archivos/".$imagenBorrar);      
        $archivo = fopen("container.txt","w") ;       

        foreach($listaActualizada as $container)
        {
           $cant = fwrite($archivo,$container->Tostring());
            if($cant< 1){
                $resultado = false;
                break;           
             }
        }
          
        fclose($archivo) ;
        
        return $resultado ; 
        
    }
     public static function verificacion($container,$pais)
	{        
         $verificado = false;  
		 $lista = Container::leer();
          
          foreach($lista as $usuario)   
          {            
              if($usuario->getNumero() == $container && $usuario->getPais() == $pais)
              {
                  $verificado = true;
              }
          }        
          return $verificado ;
          
	} 
     public static function filtrarPorPais($pais)
        {
          $listaDeContainer = Container::leer();
         $grillaContainer = '<table class="table">
				<thead">
				<tr >
				<th>  NUMERO </th>
                <th>  DESCRIPCION  </th>
                <th>  PAIS  </th>
				<th>  FOTO  </th>                
				</tr> 
				</thead>';
          foreach($listaDeContainer as $container)
          {
              if($container->getPais() == $pais)
                   {
                 
                  $numero = $container->getNumero();
                  $descripcion = $container->getDescripcion();
                  $pais = $container->getPais();        
                  $grillaContainer .= " <tbody> <tr><td>" .
                "$numero" . "</td><td>" . "$descripcion" . "</td><td>" .  
                "$pais" .  "</td><td>". "<img src='". "archivos/" .$container->getFoto(). " ' border='0' width='150' height='50'>" . "</td><td>" 
                ;
              }
             
                
                  
          }
            
         
         
            $grillaContainer .= ' </tbody> </table>';	
           
                  
                
          return $grillaContainer;  

    }
    
    public static function traerContainer()
        {
          $listaDeContainer = Container::leer();
         $grillaContainer = '<table class="table">
				<thead">
				<tr >
				<th>  NUMERO </th>
                <th>  DESCRIPCION  </th>
                <th>  PAIS  </th>
				<th>  FOTO  </th>                
				</tr> 
				</thead>';
          foreach($listaDeContainer as $container)
          {
                             
                 
                  $numero = $container->getNumero();
                  $descripcion = $container->getDescripcion();
                  $pais = $container->getPais();        
                  $grillaContainer .= " <tbody> <tr><td>" .
                "$numero" . "</td><td>" . "$descripcion" . "</td><td>" .  
                "$pais" .  "</td><td>". "<img src='". "archivos/" .$container->getFoto(). " ' border='0' width='150' height='50'>" . "</td><td>"      
                ;
                    
                  
          }
            
            $grillaContainer .= ' </tbody> </table>';	
           
                  
                
          return $grillaContainer;  

    }   
    
    

}




?>