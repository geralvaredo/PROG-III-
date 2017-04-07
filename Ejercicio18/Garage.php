<?php 

/**
 * 
 */
 
class Garage 
{
    public $_razonSocial;
    public $_precio;
    private $Auto = array();
    function __construct($razon, $precio = NULL)
    {
        $this->_razonSocial = $razon ;
        $this->_precio = $precio ; 
    }

    public function GetAuto()
    {
        return $this->Auto ;
    }
    public function SetAuto($a1)
    {
       $this->Auto[] = $a1 ;
    }
function MostrarGarage()
{
    echo   "<br>" . "Razon Social :" . $this->_razonSocial . "<br>" . "precio: ". $this->_precio ;
    
    foreach($this->Auto as $item)
    {
      echo  $item ;
    }
    
     
    // $auto = Auto::MostrarAuto() ;  
}

function Equals ($g1,$a1)
{
    $respuesta = false ;
    foreach ($g1->GetAuto() as  $item) 
    {
       if( $item == $a1 )

        {
           $respuesta = true ;
            break ;
        }
        
    }
    return $respuesta ;
}

function Add($G,$A) 
{
    if(!$this->Equals($G,$A))
   { $this->SetAuto($A) ;
    echo "El Auto Fue ingresado Exitosamente" ;
   }
    else
    {
    echo "El Auto Ya Existe" ;
    }
    
}

function Remove($G,$A)
{
    $respuesta = "Auto No Eliminado" ;
    if($this->Equals($G,$A))
        for ($i=0; $i < count($this->Auto); $i++) 
        { 
            if($this->Auto[0] != "")

            if($this->Auto[$i] == $A)
           {
                $respuesta = "Auto Eliminado" ;
               $this->Auto[$i] = 0;
            break ;
            }
        }  
        echo "<br>" . $respuesta ;
}




}


?>