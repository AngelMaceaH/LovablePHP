<?php
session_start();
$_SESSION['dolaresCk']= isset($_POST['dolaresChk']) ? "1": "0";
$_SESSION['fechack'] = isset($_POST['fechaCk10']) ? $_POST['fechaCk10']: "";
$fechagrafica = isset($_POST['fechagra']) ? $_POST['fechagra']: "";
$_SESSION['$compFiltro'] = isset($_POST['cbbMesgra']) ? $_POST['cbbMesgra']: "";

 $_SESSION['FechaGraficas'] = date("Ymd", strtotime($fechagrafica));
 if ($_SESSION['FechaGraficas']=="19700101") {
    $_SESSION['FechaGraficas']=date("Ymd");
 }
 header("Location: /".$_SESSION['DEV']."LovablePHP/");

?>