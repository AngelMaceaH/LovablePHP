<?php
 session_start();  
 $mes_actual=date("m");
 $ano_actual=date("Y");
 function obtenerNumeroMes($nombre_mes) {
   $nombres_mes = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
   $numero_mes = array_search($nombre_mes, $nombres_mes) + 1;
   return $numero_mes;
 }
 $_SESSION['marcaFiltro']= isset($_POST['cbbMarca']) ? $_POST['cbbMarca']: 100;
 $fechaInicial=isset($_POST['startdate']) ? $_POST['startdate']: 0;
 $fechaFinal=isset($_POST['enddate']) ? $_POST['enddate']: 0;
 $_SESSION['mes1']=substr($fechaInicial,4,3);
 $_SESSION['mes2']=substr($fechaFinal,4,3);
 $_SESSION['ano1']=substr($fechaInicial,10,5);
 $_SESSION['ano2']=substr($fechaFinal,10,5);
 $_SESSION['anofiltro']= isset($_SESSION['ano2']) ? $_SESSION['ano2']: $ano_actual;
 $_SESSION['mesFiltro'] = isset($_SESSION['mes2']) ? $_SESSION['mes2']: $mes_actual;

if ($_SESSION['marcaFiltro']!=0) {
    header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0003P.php");
 }else{
    header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0003PA.php");
 }


?>