<?php 

class Pedido 
{
    private $idProv;
    private $producto;
    private $cantidad;
    
    public function getIdProv()
	{
		return $this->idProv;
	}
	public function getProducto()
	{
		return $this->producto;
	}
	public function getCantidad()
	{
		return $this->cantidad;
	}
	public function setIdProv($id)
	{
	   $this->idProv = $id ;
	}

	public function setProducto($p)
	{
	   $this->producto = $p ;
    }
    
    public function setCantidad($cant)
	{
	   $this->cantidad = $cant ;
    }
    

    public function __construct($id=NULL, $producto=NULL, $cantidad=NULL)
	{
		if($id !== NULL ){
			$this->idProv = $id;
			$this->producto = $producto;
			$this->cantidad = $cantidad;
			
		}
	}
    
    public function toString()
	{
	  	return $this->idProv." - ".$this->producto." - ".$this->cantidad . "\r\n";
    }
    
    public static function guardarPedido($p)
	{
		$resultado = FALSE;		
	
		$ar = fopen("pedidos.txt", "a");		
		
		$cant = fwrite($ar,$p->toString());
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		
		fclose($ar);
		
		return $resultado;
	}
	public static function traerPedidos(){
		$listaPedidos = array();
		
		$archivo=fopen("pedidos.txt", "r");

		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$pedido = explode(" - ", $archAux);			
			$pedido[0] = trim($pedido[0]);
			if($pedido[0] != ""){
				$listaPedidos[] = new Pedido($pedido[0], $pedido[1],$pedido[2]);
			}
		}
		fclose($archivo);
        return $listaPedidos;
    }
    
  public static function listaProveedor($id){
      $pedidos = Pedido::traerPedidos();
      $pedidoListado = array();   
      for ($i=0; $i < count($pedidos) ; $i++) { 
        if($pedidos[$i]->idProv == $id){
            $pedidoListado[] = $pedidos[$i];
        }
      }  

      return $pedidoListado;

  }  
}




?>