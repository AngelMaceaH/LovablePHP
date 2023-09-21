<?php
 session_start();  
 $mes_actual=date("m")-1;
 $ano_actual=date("Y");
 $_SESSION['anofiltro']= isset($_POST['cbbAno']) ? $_POST['cbbAno']: $ano_actual;
 $_SESSION['mesfiltro'] = isset($_POST['cbbMes']) ? $_POST['cbbMes']: $mes_actual;
 $_SESSION['cia'] = isset($_POST['filtro1']) ? $_POST['filtro1']: 0;
if (strlen($_SESSION['mesfiltro'])==1) {
    $_SESSION['mesfiltro']="0".$_SESSION['mesfiltro'];
}
 header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZPT/ZLO0009P.php");
 

?>