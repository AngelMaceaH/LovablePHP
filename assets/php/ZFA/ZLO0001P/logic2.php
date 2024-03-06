<?php
  // Iniciar la sesión
  session_start();
  // Verificar si 'productosCk1' está establecido en POST, si es así, asignar "true", de lo contrario "false"
  $_SESSION['productosCk1']= isset($_POST['productosCk1']) ? "true": "false";
  // Verificar si 'fechapro' está establecido en POST, si es así, asignar el valor, de lo contrario asignar cadena vacía
  $fechapro = isset($_POST['fechapro']) ? $_POST['fechapro']: "";
  // Verificar si 'comppro1' está establecido en POST, si es así, asignar el valor, de lo contrario asignar cadena vacía
  $compro = isset($_POST['comppro1']) ? $_POST['comppro1']: "";
  // Asignar el valor de 'compro' a la sesión 'comppro2'
  $_SESSION['comppro2']=$compro;
  // Convertir 'fechapro' a formato "Ymd" y asignar a la sesión 'FechaFiltro2'
  $_SESSION['FechaFiltro2'] =  date("Ymd", strtotime($fechapro));
  // Asignar "false" a la sesión 'SelectionTab'
  $_SESSION['SelectionTab']="false";
  // Redirigir al usuario a la nueva ubicación
  header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0001PA.php?id=".$compro.'&dat='. $_SESSION['FechaFiltro2']);

?>