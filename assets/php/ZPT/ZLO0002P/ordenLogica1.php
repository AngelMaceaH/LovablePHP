<?php
session_start();  
 $_SESSION['Orden2']= isset($_POST['cbbOrden2']) ? $_POST['cbbOrden2']: 1;
 $_SESSION['Orden3']= isset($_POST['cbbOrden3']) ? $_POST['cbbOrden3']: 1;
 $_SESSION['productos']=isset($_POST['productos'])? $_POST['productos']:0;
 $_SESSION['productos']=isset($_POST['productos3'])? $_POST['productos3']:0;
 
 header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZPT/ZLO0002P.php");

?>