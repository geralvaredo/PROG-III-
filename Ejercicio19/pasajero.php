
<?php 

    /**
     * 
     */
    class Pasajero 
    {
        private $_nombre ;
        private $_apellido ;
        private $_dni ;
        public $_esPlus;
            public function GetApellido()
            {
                return $this->_apellido ;
            }

            public function GetNombre()
            {
                return $this->_nombre ;
            }
            public function GetDni()
            {
                return $this->_dni ;
            }
            public function GetPlus()
            {
                return $this->_esPlus ;
            }




            public function GetinfoPasajero()
            {
                return "<br>" . $this->GetApellido() . "<br>" . 
                $this->GetNombre() . "<br>" . $this->GetDni() .
                "<br>" . $this->GetPlus() . "<br>" ;
            }

        function __construct($nombre = NULL, $apellido = NULL, $dni= NULL, $plus= NULL)
        {
            $this->_nombre = $nombre ;
            $this->_apellido = $apellido ;
            $this->_dni = $dni ;
            $this->_esPlus = $plus ;
        }

        function Equals($p1,$p2)
        {
            if($p1->GetDni() == $p2->GetDni() )
            return true ;
            else
            return false ;
        }


        public static function MostrarPasajero($p)
        {
            echo $p->GetinfoPasajero() ;
        }


    }
    




?>