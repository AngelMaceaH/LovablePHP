<?php
 session_start();  
 $mes_actual=date("m");
 $ano_actual=date("Y");
 $_SESSION['anofiltro']= isset($_POST['cbbAno']) ? $_POST['cbbAno']: $ano_actual;
 $_SESSION['mesfiltro'] = isset($_POST['cbbMes']) ? $_POST['cbbMes']: $mes_actual;
 $_SESSION['marcaFiltro']= isset($_POST['cbbMarca']) ? $_POST['cbbMarca']: 100;

 if ($_SESSION['marcaFiltro']!=0) {
    header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0003P.php");
 }else{
    header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0003PA.php");
 }
 

?>