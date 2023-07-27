<?php
 session_start();  
 $_SESSION['agrup']= isset($_POST['cbbAgrupacion']) ? $_POST['cbbAgrupacion']: '0';
 $_SESSION['filtro']= isset($_POST['radioFiltro']) ? $_POST['radioFiltro']: '1';
 //$_SESSION['productosCk1']= isset($_POST['productosCk1']) ? "true": "false";
 header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZPT/ZLO0012P.php");
 

?>