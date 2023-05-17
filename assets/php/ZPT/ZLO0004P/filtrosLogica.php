<?php
 session_start();  
 $mes_actual=date("m")-1;
 $ano_actual=date("Y");
 $_SESSION['anofiltro2']= isset($_POST['cbbAno']) ? $_POST['cbbAno']: $ano_actual;
 $_SESSION['mesfiltro3'] = isset($_POST['cbbMes']) ? $_POST['cbbMes']: $mes_actual;
 $_SESSION['paisfiltro2']= isset($_POST['cbbPais']) ? $_POST['cbbPais']: 1;
 $_SESSION['Orden']= isset($_POST['cbbOrden']) ? $_POST['cbbOrden']: 1;

if ($_SESSION['paisfiltro2']==8) {
    header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZPT/ZLO0004PA.php");
}else{
    header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZPT/ZLO0004P.php");
}
 

?>