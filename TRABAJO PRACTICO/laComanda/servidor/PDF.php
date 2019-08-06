<?php 
 require_once 'laComanda/clases/fpdf/fpdf.php' ;
class myPDF extends FPDF {
    
    function __construct(){
    }

    /*public function Header(){
       *$this->Image('laComanda/clases/lacomanda.jpg',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'EJEMPLO',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Av Rivadavia 1200',0,0,'C');
        $this->Ln();
    }*/

   /* public function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page'. $this->PageNo(). '/{nb}',0,0,'C');
    }*/

    /*function headerTable($data){
        $this->SetFont('Times','B',12);        
        $this->Cell(20,10,'FECHA',1,0,'C');
        $this->Cell(40,10,'NRO PEDIDO',1,0,'C');
        $this->Cell(60,10,'NOMBRE Y APELLIDO',1,0,'C');
        $this->Cell(40,10,'ESTADO',1,0,'C');
        $this->Cell(60,10,'PEDIDO',1,0,'C');
        $this->Ln();
                
    }

    function viewTable($data){
        $this->SetFont('Times','B',12);
        foreach ($data as $campo) {
            $this->Cell(20,10,$campo,1,0,'C');
            $this->Cell(40,10,$campo,1,0,'L');
            $this->Cell(60,10,$campo,1,0,'L');
            $this->Cell(40,10,$campo,1,0,'L');
            $this->Cell(60,10,$campo,1,0,'L');
            $this->Ln();
            
        }
    }*/

   public static function  exportarPDF($request,$response,$data,$nombre){
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $headers = array_keys($data[0]);
        $pdf = new FPDF('L');
        $pdf->AliasNbPages();
        $pdf->AddPage();      
        $pdf->headerTable($headers);
        $pdf->viewTable($data);
        $horaMinuto = date('H-i');
            $fecha =  date("Y-m-d") ;
        $destino = 'laComanda/clases/archivos/' ;
        $filename = 'reporte' . $nombre . $fecha .   $horaMinuto  .'.pdf';  
        $pdf->Output($destino.$filename, 'F'); 
        return $response->withJson($destino.$filename, 200);
        
    }

    public static function  exportarExcel($request,$response,$data,$nombre){
        try{
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $destino = 'laComanda/clases/archivos/' ;
            $horaMinuto = date('H-i');
            $fecha =  date("Y-m-d") ; 
            $filename = $nombre . $fecha . $horaMinuto . '.xls';           
            $stream = fopen($destino.$filename, 'w+');
                $headers = array_keys($data[0]);
                fwrite($stream, chr(0xEF) . chr(0xBB) . chr(0xBF));
                //Header
                fputcsv($stream, $headers, ';');
                foreach($data as $item){
                    fputcsv($stream, $item, ';');
                }
    rewind($stream); 
    $response = $response
        ->withHeader('Content-Type', 'application/vnd.ms-excel')
        ->withHeader('Content-Disposition', 'attachment; filename="' . $filename .  '"')
        ->withHeader('Pragma', 'no-cache')
        ->withHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0')
                        ->withHeader('Expires', '0');
                        
                return $response->withJson($destino.$filename, 200);
           
        }catch(Exception $e){
            if($e->getCode()=='42S02'){
                    return $response->withJson('No se pudo exportar a un archivo Excel', 404);
            }else{
                return $response->withJson($e->getMessage(), 400);
            }
        }
        
    }
}

            


?>