<?php
session_start();
$fechack = isset($_POST['fechaCk10']) ? $_POST['fechaCk10']: "";
 $fechagrafica = isset($_POST['fechagra']) ? $_POST['fechagra']: "";
 $compFiltro = isset($_POST['cbbMesgra']) ? $_POST['cbbMesgra']: "";

 $_SESSION['FechaGraficas'] = date("Ymd", strtotime($fechagrafica));
 if ($_SESSION['FechaGraficas']=="19700101") {
    $_SESSION['FechaGraficas']=date("Ymd");
    $_SESSION['AnoGraficas']=date("Y");
    $_SESSION['MesGraficas']=date("m");
 }else{
    $_SESSION['MesGraficas']=substr($_SESSION['FechaGraficas'],4,2);
    $_SESSION['AnoGraficas']=substr($_SESSION['FechaGraficas'],0,4);
 }
 header("Location: /".$_SESSION['DEV']."LovablePHP/?d=". $_SESSION['FechaGraficas']."&m=".$_SESSION['MesGraficas']."&y=".$_SESSION['AnoGraficas']."&c=".$compFiltro."&ck=".$fechack."");

?>