<?php 
//*****v   
session_start();
    require('/lib/nusoap.php');
     $host = 'http://localhost:8080/log_ws_ajax/SERVIDOR/testWS.php';
    $client = new nusoap_client($host . '?wsdl');
$queHago = $_POST['QueHago'];



switch ($queHago) {
    case 'ValidarLogin':
       
       $arrayUsuarios =array($_POST['nombre'],$_POST['email'],$_POST['password']);
        $result = $client->call('ValidarLogon',array($arrayUsuarios));
        $bandera = false;
        if($result != false){
        $_SESSION["usuario"] =$result;
        $bandera = true;
        }

        var_dump($bandera);
        
       
        break;
    case "MostrarLogin":
            include("/formularios/frmlogin.php");
            break;
    case "MostrarGrilla":
            include("/formularios/frmgrilla.php");
            break;
    case "AltaUsuario":
  
    
   
        if($_POST['id']!="")
        {
           $arrayUsuarios =array($_POST['id'],$_POST['nombre'],$_POST['email'],$_POST['password'],$_POST['tipo'],$_SESSION['foto']);
             $_SESSION['foto'] = null;
        $result = $client->call('ModificarUsuario',array($arrayUsuarios)); 
        $_SESSION['ID'] =$_POST['id'];
        }else{
                       

        $arrayUsuarios =array($_POST['nombre'],$_POST['email'],$_POST['password'],$_POST['tipo'],$_SESSION['foto']);
          $_SESSION['foto'] = null;
        $result = $client->call('AltaUsuario',array($arrayUsuarios));
       $_SESSION['ID'] = $result;
        }
            break;

    case "subirFoto":
    $ID= $_SESSION['ID'];
    $_SESSION['ID'] = null;

    $archivoTmp = date("Ymd")."_".$ID . ".jpg";
    $arrayID= array($ID,$archivoTmp);
        $result = $client->call('ModificarFoto',array($arrayID));
          var_dump($result);
           move_uploaded_file($_FILES["archivo"]["tmp_name"],"./SERVIDOR/tmp/$archivoTmp");
           $_SESSION['foto'] =$archivoTmp;
                          break;

    case "BajaUsuario":
        $id=$_POST['ID'];
        $result = $client->call('BajaUsuario',array($id));
        var_dump($result);

    break;
            case "TraerUsuario":
             $id=$_POST['ID'];
            $result = $client->call('TraerUsuario',array($id));
            $usu =json_encode($result);
              echo $usu;
        
    break;
      
    default:
        # code...
        break;
}

       



 ?>