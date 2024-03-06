<?php
   // Iniciar una nueva sesión o reanudar la existente
   session_start();

   // Verificar si 'productosCk' fue enviado a través de POST, si es así, asignar "true", de lo contrario, asignar "false"
   $_SESSION['productosCk']= isset($_POST['productosCk']) ? "true": "false";

   // Verificar si 'fechapro' fue enviado a través de POST, si es así, asignar el valor, de lo contrario, asignar una cadena vacía
   $fechapro = isset($_POST['fechapro']) ? $_POST['fechapro']: "";

   // Verificar si 'comppro' fue enviado a través de POST, si es así, asignar el valor, de lo contrario, asignar una cadena vacía
   $comppro= isset($_POST['comppro']) ? $_POST['comppro']: "";

   // Convertir la fecha a formato "Ymd" y almacenarla en la sesión
   $_SESSION['fechapro'] =  date("Ymd", strtotime($fechapro));

   // Extraer el mes de la fecha y almacenarlo en la sesión
   $_SESSION['mespro'] =  date("m", strtotime($fechapro));

   // Extraer el año de la fecha y almacenarlo en la sesión
   $_SESSION['anopro'] =  date("Y", strtotime($fechapro));

   // Almacenar 'comppro' en la sesión
   $_SESSION['comppro'] =$comppro;

   // Redirigir al usuario a otra página con algunos parámetros en la URL
   header('Location: /'.$_SESSION['DEV'].'LovablePHP/PRG/ZFA/ZLO0001P.php?opc='.$_SESSION['opcion'].'&fil='.$_SESSION['filtro'].'');
?>
