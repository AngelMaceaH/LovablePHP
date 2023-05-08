<?php  
   session_start();
   $_SESSION['productosCk']= isset($_POST['productosCk']) ? "true": "false";
   $fechapro = isset($_POST['fechapro']) ? $_POST['fechapro']: "";
   $comppro= isset($_POST['comppro']) ? $_POST['comppro']: "";
   $_SESSION['fechapro'] =  date("Ymd", strtotime($fechapro));
   $_SESSION['mespro'] =  date("m", strtotime($fechapro));
   $_SESSION['anopro'] =  date("Y", strtotime($fechapro));
   $_SESSION['comppro'] =$comppro;
   header('Location: /'.$_SESSION['DEV'].'LovablePHP/PRG/ZFA/ZLO0001P.php?opc='.$_SESSION['opcion'].'&fil='.$_SESSION['filtro'].'');

?>

