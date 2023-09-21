<?php
 session_start();
    if(isset($_POST['btncols'])){
        $marca=$_POST['btncols'];
    }else{
        if (isset($_POST['cbbMarca'])) {
            $marca=$_POST['cbbMarca'];
        }
    }
    $plan=$_POST['cbbPlan'];
    $estado=$_POST['cbbEstad'];
    $inventarios=$_POST['rbInventarios'];
    $clasificacion=$_POST['rbClasificacion'];
    $orden=$_POST['rbOrden'];
    $filtro=$_POST['rbFiltro'];
    $repro=$_POST['rbRepro'];
    $_SESSION['marca']=$marca;
    $_SESSION['plan']=$plan;
    $_SESSION['estado']=$estado;
    $_SESSION['inventarios']=$inventarios;
    $_SESSION['clasificacion']=$clasificacion;
    $_SESSION['orden']=$orden;
    $_SESSION['filtro']=$filtro;
    $_SESSION['repro']=$repro;
    header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0013PA.php");
 
?>