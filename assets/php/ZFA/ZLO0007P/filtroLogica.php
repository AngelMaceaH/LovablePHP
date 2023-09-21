<?php
    session_start();
    $_SESSION['paisFiltro']=isset($_POST['cbbPais'])?$_POST['cbbPais']:1;
    $_SESSION['ciaFiltro']=isset($_POST['cbbCia'])?$_POST['cbbCia']:1;
    $date=$_POST['datepicker2'];
    $Date1=substr($date,0,10);
    $Date2=substr($date,12,22);
    $arrayDate1=(explode("/",$Date1));
    $arrayDate2=(explode("/",$Date2));
    $_SESSION['anoFiltro1']=trim($arrayDate1[2]);
    $_SESSION['mesFiltro1']=trim($arrayDate1[1]);
    $_SESSION['diaFiltro1']=trim($arrayDate1[0]);

    $_SESSION['anoFiltro2']=trim($arrayDate2[2]);
    $_SESSION['mesFiltro2']=trim($arrayDate2[1]);
    $_SESSION['diaFiltro2']=trim($arrayDate2[0]);

    //echo $_SESSION['anoFiltro1'].$_SESSION['mesFiltro1'].$_SESSION['diaFiltro1']. '   '.$_SESSION['anoFiltro2'].$_SESSION['mesFiltro2'].$_SESSION['diaFiltro2'];
    if (isset($_POST['cbbClick'])) {
        if ($_POST['cbbClick']=="cbbCia") {
         $_SESSION['clickCia']=1;
         $_SESSION['clickPais']=0;
        }
        if ($_POST['cbbClick']=="cbbPais") {
            $_SESSION['ciaFiltro']=[900];
            $_SESSION['clickCia']=0;
            $_SESSION['clickPais']=1;
        }
    }
    header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0007P.php");
?>