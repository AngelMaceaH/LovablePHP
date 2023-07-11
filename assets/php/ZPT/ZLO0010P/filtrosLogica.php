<?php
 session_start();  
 $mes_actual=date("m")-1;
 $ano_actual=date("Y");
 $_SESSION['anofiltro2']= isset($_POST['cbbAno']) ? $_POST['cbbAno']: $ano_actual;
 $_SESSION['mesfiltro2'] = isset($_POST['cbbMes']) ? $_POST['cbbMes']: $mes_actual;
if (strlen($_SESSION['mesfiltro'])==1) {
    $_SESSION['mesfiltro2']="0".$_SESSION['mesfiltro'];
}
 header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZPT/ZLO0010P.php");
 

?>