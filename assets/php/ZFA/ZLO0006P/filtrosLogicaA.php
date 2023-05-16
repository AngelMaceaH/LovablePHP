<?php
    session_start();  
    $mes_actual=date("m");
    $ano_actual=date("Y");
    $_SESSION['mesfiltro2'] = isset($_POST['cbbMes']) ? $_POST['cbbMes']: $mes_actual;
    $_SESSION['anofiltro']= isset($_POST['cbbAno']) ? $_POST['cbbAno']: $ano_actual;
    $_SESSION['validacion']="true";
    $_SESSION['radioCk']=(isset($_POST['flexRadioDefault'])?$_POST['flexRadioDefault']:1);


    header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0006P.php");
    
?>