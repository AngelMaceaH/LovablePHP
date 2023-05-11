<?php
 session_start();  
 $mes_actual=date("m");
 $ano_actual=date("Y");
 function obtenerNumeroMes($nombre_mes) {
   $nombres_mes = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
   $numero_mes = array_search($nombre_mes, $nombres_mes) + 1;
   return $numero_mes;
 }
 function obtenerNombreMesAbr($numeroMes) {
   $nombresMes =  array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
   return $nombresMes[$numeroMes - 1];
 }
 $_SESSION['marcaFiltro']= isset($_POST['cbbMarca']) ? $_POST['cbbMarca']: 100;
 
 if (strlen($_POST['startdate'])!=0) {
   $fechaInicial= $_POST['startdate'];
   $_SESSION['mes1']=substr($fechaInicial,4,3);
   $_SESSION['ano1']=substr($fechaInicial,10,5);
   $_SESSION['mes1anterior']=$_SESSION['mes1'];
   $_SESSION['ano1anterior']=$_SESSION['ano1'];
 }else{
   $_SESSION['mes1']=obtenerNombreMesAbr(1);
   $_SESSION['ano1']=$ano_actual;
 }
 if (strlen($_POST['enddate'])!=0) {
   $fechaFinal=$_POST['enddate'];
   $_SESSION['mes2']=substr($fechaFinal,4,3);
   $_SESSION['ano2']=substr($fechaFinal,10,5);
   $_SESSION['mes2anterior']=$_SESSION['mes2'];
   $_SESSION['ano2anterior']=$_SESSION['ano2'];
 }else{
   $_SESSION['mes2']=isset($_SESSION['mes2anterior'])? $_SESSION['mes2anterior']:obtenerNombreMesAbr($mes_actual);
   $_SESSION['ano2']=isset($_SESSION['ano2anterior'])? $_SESSION['ano2anterior']:$ano_actual;
 }
 $_SESSION['anofiltro']= isset($_SESSION['ano2']) ? $_SESSION['ano2']: $ano_actual;
 $_SESSION['mesFiltro'] = isset($_SESSION['mes2']) ? obtenerNumeroMes($_SESSION['mes2']): $mes_actual;

if ($_SESSION['marcaFiltro']!=0) {
    header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0003P.php");
 }else{
    header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0003PA.php");
 }

?>