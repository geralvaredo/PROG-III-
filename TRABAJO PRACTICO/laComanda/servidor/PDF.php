<?php 
 require_once 'laComanda/clases/fpdf/fpdf.php' ;
class myPDF extends FPDF {
    
    function __construct(){
    }

    function header(){
        $this->Image('laComanda/clases/lacomanda.jpg',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'EJEMPLO',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Av Rivadavia 1200',0,0,'C');
        $this->Ln();
    }

    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page'. $this->PageNo(). '/{nb}',0,0,'C');
    }

    function headerTable(){
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
    }

   public static function  exportarPDF($data){
        $headers = array_keys($data[0]);
        $pdf = new myPDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('L','A4',0);
        $pdf->header();
        $pdf->footer();
        $pdf->headerTable();
        $pdf->viewTable($data);
        $destino = 'laComanda/clases/archivos/' ;
        $filename = 'reportePedidos.pdf';       
        $pdf->Output($destino.$filename, 'F'); 		
		return $response->withJson($destino.$filename, 200);
    }
}

            


?>