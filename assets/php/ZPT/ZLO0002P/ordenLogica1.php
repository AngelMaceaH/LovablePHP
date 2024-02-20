<?php
session_start();
 $_SESSION['Orden2']= isset($_POST['cbbOrden2']) ? $_POST['cbbOrden2']: 1;
 $_SESSION['Orden3']= isset($_POST['cbbOrden3']) ? $_POST['cbbOrden3']: 1;
 $_SESSION['Orden4']= isset($_POST['cbbOrden4']) ? $_POST['cbbOrden4']: 2;
 $_SESSION['filtro1']= isset($_POST['filtro1']) ? $_POST['filtro1']: 11;
 if (isset($_POST['productos'])) {
    $_SESSION['productos']=true;
 }else if(isset($_POST['productos3'])){
    $_SESSION['productos']=true;
 }else if(isset($_POST['productos4'])){
    $_SESSION['productos']=true;
 }else{
    $_SESSION['productos']=0;
 }

 header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZPT/ZLO0002P.php");

?>