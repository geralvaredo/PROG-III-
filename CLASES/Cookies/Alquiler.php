<?php
		
	class Alquiler 
	{
		private $cliente;
		private $pelicula;
		private $dias;
		private $fechaRetiro;
		private $esParaNiños;
		private $importe;	
		function __construct($_cliente, $_pelicula ,$_dias , $fecha = " " )
		{
			$this->cliente = $_cliente ;
			$this->pelicula = $_pelicula;
			$this->dias = $_dias;
			if($fecha == " ") 
			$this->fechaRetiro = date("m.d.y") . " " . date("H:i:s") ;
		    else
		    $this->fechaRetiro = $fecha ;
		    

		     if (isset($_POST['nino']))
		      {
		     	$this->esParaNiños = true ; 	
		     }
		}
		

		public function CalcularImporte()
		{
			if(!$this->esParaNiños)
		 	$this->importe = $this->dias * 15 ;
			else
			 $this->importe = (($this->dias * 15)  - (($this->dias) * 10)/ 100) ;
			
			return $this->importe ;
		}
		public function tostringformat()
		{
			return  $this->cliente . "-"  . $this->pelicula . "-" . $this->dias . "-" .  $this->fechaRetiro . "\n"; 
			 
		}

		public static function RegistrarAlquiler(Alquiler $Alquiler)
		{
			$archivo = fopen("alquiler.txt","a") ;
			$renglon = $Alquiler->tostringformat();
			fwrite($archivo,$renglon) ;
			fclose($archivo) ;
			
		}
        public static function obtenerAlquileres()
        {
        	$archivo = fopen("alquiler.txt","r") ;
        	$listadoAlquiler = array() ;
        	while (!feof($archivo))
        	{
        		$renglon = fgets($archivo) ;
        		$alquiler = explode("-",$renglon) ;
        		$listadoAlquiler[] = $alquiler ;	
        	}

        	fclose($archivo) ;
        	

        	return $listadoAlquiler ;
        	//LEE EL ALQUILER
        	

        }
        public static function Tabla()
        {
        	$listado[] = Alquiler::obtenerAlquileres();
        	echo "<tr>";
        	echo "<th>" . "Cliente" . "</th>";
        	echo "<th>" . "Pelicula" . "</th>" ;
        	echo "<th>" . "Dias" . "</th>" ;
        	echo "<th>" . "Fecha Retiro" . "</th>" ;
        	for($i= 0 ; $i < sizeof($listado[0])- 1 ; $i++)
        	{
        		echo "<tr>";
        	    echo "<th>" . $listado[0][$i][0] . "</th>";
        	    echo "<th>" . $listado[0][$i][1] . "</th>";
        	 	echo "<th>" . $listado[0][$i][2] . "</th>"; ;
        	 	echo "<th>" . $listado[0][$i][3] . "</th>";

        	}
        }

	}

	



?>