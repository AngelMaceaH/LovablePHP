<?php
     session_start(); // Iniciar la sesión
     if ($_SESSION['FechaFiltro2']!="") { // Si la fecha del filtro no está vacía
          $fecha=$_SESSION['FechaFiltro2']; // Asignar la fecha del filtro a la variable $fecha
          $anio = substr($fecha, 0, 4); // Extraer el año de la fecha
          $mes = substr($fecha, 4, 2); // Extraer el mes de la fecha
          $dia = substr($fecha, 6, 2); // Extraer el día de la fecha
     }else { // Si la fecha del filtro está vacía
          $mes=$_SESSION['mesanterior']; // Asignar el mes anterior a la variable $mes
          $anio=$_SESSION['anioanterior']; // Asignar el año anterior a la variable $anio
     }

     $_SESSION['productosCk2']= isset($_POST['productosCk2']) ? "true": "false"; // Asignar el valor de productosCk2 a la sesión

     $_SESSION['diafiltro']= $dia; // Asignar el día a la sesión
     $_SESSION['mesfiltro'] = isset($_POST['cbbMes']) ? $_POST['cbbMes']: ""; // Asignar el mes a la sesión
     if ($_SESSION['mesfiltro']=='02') { // Si el mes es febrero
          $dia=28; // Asignar 28 al día
     }else{ // Si el mes no es febrero
          $dia=31; // Asignar 31 al día
     }

     $_SESSION['anofiltro']= isset($_POST['cbbAno']) ? $_POST['cbbAno']: ""; // Asignar el año a la sesión
     $_SESSION['SelectionTab']="true"; // Asignar "true" a la sesión
     $compro2 = isset($_POST['comppro2']) ? $_POST['comppro2']: ""; // Asignar el valor de comppro2 a la variable $compro2
     header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0001PA.php?id=".$compro2.'&dat='.$_SESSION['anofiltro'].$_SESSION['mesfiltro'].$dia); // Redirigir a la nueva ubicación
?>
