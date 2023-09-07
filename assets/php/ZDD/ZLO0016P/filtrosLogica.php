<?php
    session_start();
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
     
    echo $_SESSION['anoFiltro1'];
    echo $_SESSION['mesFiltro1'];
    echo $_SESSION['diaFiltro1'];

   // header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZDD/ZLO0016P.php");
?>