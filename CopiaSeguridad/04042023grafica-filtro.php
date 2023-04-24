<?php
 $fechagrafica = isset($_POST['fechagra']) ? $_POST['fechagra']: "";
 $mesgrafica = isset($_POST['cbbMesgra']) ? $_POST['cbbMesgra']: "";
 $anografica = isset($_POST['cbbAnogra']) ? $_POST['cbbAnogra']: "";

 $_SESSION['MesGraficas']=$mesgrafica;
 $_SESSION['AnoGraficas']=$anografica;
 $_SESSION['FechaGraficas'] = date("Ymd", strtotime($fechagrafica));
 if ($_SESSION['FechaGraficas']=="19700101") {
    $_SESSION['FechaGraficas']=date("Ymd");
 }
 header("Location: /LovablePHP/?d=". $_SESSION['FechaGraficas']."&m=".$_SESSION['MesGraficas']."&y=".$_SESSION['AnoGraficas']."");

?>