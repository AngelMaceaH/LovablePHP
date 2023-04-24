<?php
  session_start();
  $_SESSION['productosCk1']= isset($_POST['productosCk1']) ? "true": "false";
  $fechapro = isset($_POST['fechapro']) ? $_POST['fechapro']: "";
  $compro = isset($_POST['comppro1']) ? $_POST['comppro1']: "";
  $_SESSION['comppro2']=$compro;
  $_SESSION['FechaFiltro2'] =  date("Ymd", strtotime($fechapro));
  $_SESSION['SelectionTab']="false";
  header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0001PA.php?id=".$compro.'&dat='. $_SESSION['FechaFiltro2']);

?>