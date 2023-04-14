<?php
     session_start();
     if ($_SESSION['FechaFiltro2']!="") {
          $fecha=$_SESSION['FechaFiltro2'];
          $anio = substr($fecha, 0, 4);
          $mes = substr($fecha, 4, 2);
          $dia = substr($fecha, 6, 2);
     }else {
          $mes=$_SESSION['mesanterior'];
          $anio=$_SESSION['anioanterior'];
     }
     
     
     $_SESSION['productosCk2']= isset($_POST['productosCk2']) ? "true": "false";
    
     $_SESSION['diafiltro']= $dia;
     $_SESSION['mesfiltro'] = isset($_POST['cbbMes']) ? $_POST['cbbMes']: "";
     if ($_SESSION['mesfiltro']=='02') {
          $dia=28;
     }else{
          $dia=31;
     }

     $_SESSION['anofiltro']= isset($_POST['cbbAno']) ? $_POST['cbbAno']: "";
     $_SESSION['SelectionTab']="true";
     $compro2 = isset($_POST['comppro2']) ? $_POST['comppro2']: "";
     header("Location: /LovablePHP/PRG/ZFA/ZLO0001PA.php?id=".$compro2.'&dat='.$_SESSION['anofiltro'].$_SESSION['mesfiltro'].$dia);
?>
