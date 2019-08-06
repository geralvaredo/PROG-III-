<?php 
interface iExport{
   
    public function exportPDF($request, $response);
    public function exportExcel($request, $response);   
    
}

?>