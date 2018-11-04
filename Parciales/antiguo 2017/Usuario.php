<?php

    class Usuario {

       private $nombre;
       private $correo;
       private $edad;
       private $perfil;
       private $clave;  

         function getCorreo()
        {
            return $this->correo;
        }
         function getClave()
        {
            return $this->clave;
        }
        function getNombre()
        {
            return $this->nombre;
        }       
        
         function getEdad()
        {
            return $this->edad;
        }
        function getPerfil()
        {
            return $this->perfil;
        }
        


       function __construct($correo, $clave, $nombre, $perfil ,$edad)
       {
           $this->correo = $correo ;
           $this->clave  = $clave ;
           $this->nombre = $nombre; 
           $this->perfil = $perfil;           
            $this->edad   = $edad; 
         
        }

      function toString()
      {
         return $this->getCorreo() . " - " . $this->getClave() . " - " . $this->getNombre() . " - " . 
             $this->getPerfil(). " - " . $this->getEdad() . "\n" ;
      }
        public static function leer()
        {
          $listaDeUsuarios=  array();
          $archivo=fopen("usuarios.txt","r");
          while(!feof($archivo))
          {
            $renglon=fgets($archivo);
            $usuario=explode(" - ",$renglon);
            $usuario[0]=trim($usuario[0]);
            
            if($usuario[0]!="" )
              $listaDeUsuarios[]= new Usuario(trim($usuario[0]),trim($usuario[1]),trim($usuario[2]),trim($usuario[3]), trim($usuario[4]));
               
                       
          }

          fclose($archivo);
          return $listaDeUsuarios;            
  }

    static function  altaUsuario($usuario)
    {
        $resultado = false;
        $path = 'usuarios.txt' ;
        if(file_exists($path)){
            $archivo =  fopen("usuarios.txt","w") ;
            fwrite($archivo, $usuario->ToString()) ;
            fclose($archivo);
            $resultado = true;
        }
        else{
            $archivo =  fopen("usuarios.txt","a") ; 
            fwrite($archivo, $usuario->ToString()) ;
            fclose($archivo);
            $resultado = true;
            }    
            
            return $resultado;
    }
    public static function baja($usuario)
    {
       // var_dump($usuario);
        
       
        if($usuario === NULL) {
            return FALSE ;
        }
            
         $resultado = true;
        $listaUsuarios = Usuario::leer();
        $listaActualizada = array();
        
        for($i=0; $i<count($listaUsuarios); $i++){
           if( $listaUsuarios[$i]->nombre == $usuario){//encontre el borrado, lo excluyo
               continue;
         }
             $listaActualizada[$i] = $listaUsuarios[$i];
          }
                    //echo  "<pre>" ;    
                  //print_r($listaUsuarios) ;
                  //echo "</pre>";
                
               /*  echo  "<pre>" ;    
                 print_r($listaActualizada) ;
                  echo "</pre>"; 
        */
              
        $archivo = fopen("usuario.txt","w") ;
        

        foreach($listaActualizada as $usuario )
        {
           $cant = fwrite($archivo,$usuario->Tostring());
            if($cant< 1){
                $resultado = false;
                break;
            
        }
      }
        /*for($i=0 ; $i< count($listaActualizada); $i++ )
        {         
          }  
         */      
        fclose($archivo) ;
        
        return $resultado ; 
        
    }
        
  
 
      public static function verificacionUsuarioContra($correo,$cn)
	{
       
         $verificado = "Usuario y Clave Incorrecta";  
		  $lista = Usuario::leer();
          
          foreach($lista as $usuario)   
          {
            
              if($usuario->getCorreo() == $correo && $usuario->getClave() 
                == $cn)
              {
                  $verificado = "Bienvenido";
              }
              
              if($usuario->getCorreo() == $correo && $usuario->getClave() 
                != $cn)
                {
                  $verificado = "Clave Incorrecta" ;
                  
                } 
              if($usuario->getCorreo() != $correo && $usuario->getClave() 
                == $cn)
              {
                  $verificado = "Usuario Incorrecto" ;
              }
          }
         // var_dump($verificado) ;
          return $verificado ;
          
	}   
      public static function verificarUsuario($correo)
      {
          $verificado = false;
           $lista = Usuario::leer();
          foreach($lista as $usuario)
          {
              if($usuario->getCorreo() == $correo)
                  $verificado = true ;
          }
          return $verificado;
      }
       
       public static function altaComentario($correo,$titulo,$comentario)
       {
            $resultado = false;
            $path = 'Comentario.txt' ;
           $renglon = $correo . " - " . $titulo . " - " . $comentario . "\n" ;
            if(file_exists($path)){
            $archivo = fopen("Comentario.txt","w") ;
            fwrite($archivo,$renglon ) ;
            fclose($archivo);
            $resultado = true;
            }
            else{
                $archivo = fopen("Comentario.txt","a") ; 
                fwrite($archivo,$renglon) ;
                fclose($archivo);
                $resultado = true;
                }    

                return $resultado;
           

       }
       public static function altaComentarioConImagen($correo,$titulo,$comentario,$archivo)
       {
            $resultado = false;
            $path = 'ImagenesDeComentario/Comentarios.txt' ;
           $renglon = $correo . " - " . $titulo . " - " . $comentario ." - " . $archivo .  "\n" ;
            if(file_exists($path)){
            $archivo = fopen("ImagenesDeComentario/Comentarios.txt","w") ;
            fwrite($archivo,$renglon ) ;
            fclose($archivo);
            $resultado = true;
            }
            else{
                $archivo = fopen("ImagenesDeComentario/Comentarios.txt","a") ; 
                fwrite($archivo,$renglon) ;
                fclose($archivo);
                $resultado = true;
                }    

                return $resultado;
           

       } 
        
        
        
    }
    



?>