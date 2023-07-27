<?php
 session_start();
    if (isset($_POST['boole'])) {
        $booleano=intval($_POST['boole']);
        if ($booleano==2) {
            $marca=$_POST['cbbMarca'];
        }else{
            $marca=$_POST['btncols'];
        }
    }
    $plan=$_POST['cbbPlan'];
    $estado=$_POST['cbbEstad'];
    $inventarios=$_POST['rbInventarios'];
    $clasificacion=$_POST['rbClasificacion'];
    $orden=$_POST['rbOrden'];
    $filtro=$_POST['rbFiltro'];
    $repro=$_POST['rbRepro'];
    $formato=$_POST['cbbFormato'];
    $_SESSION['formato']=$formato;
    $_SESSION['marca']=$marca;
    $_SESSION['plan']=$plan;
    $_SESSION['estado']=$estado;
    $_SESSION['inventarios']=$inventarios;
    $_SESSION['clasificacion']=$clasificacion;
    $_SESSION['orden']=$orden;
    $_SESSION['filtro']=$filtro;
    $_SESSION['repro']=$repro;

    if(isset($_POST['btnOrderValue']) && $_SESSION['estado']!=0){
        $btnOrderValue=$_POST['btnOrderValue'];
        $_SESSION['btnOrderValue']=$btnOrderValue;
    }else{
        $_SESSION['btnOrderValue']=0;
    }
    echo $_SESSION['formato'];
   header("Location: /".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0013P.php");
 
?>