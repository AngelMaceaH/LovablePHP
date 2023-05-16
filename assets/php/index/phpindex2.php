<?php
function obtenerNombreMes($numeroMes) {
    $nombresMes = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
    return $nombresMes[$numeroMes - 1];
  }
  $dolarescheck=isset($_SESSION['dolaresCk'])? $_SESSION['dolaresCk']:"true";
  $fechacheck=isset($_SESSION['fechack'])? $_SESSION['fechack']:"false";
  $fecha_actual = date("Ymd");
  $mes_actual=date("m");
  $ano_actual=date("Y");
  $compFiltroP=(float)(isset($_SESSION['$compFiltro'])? $_SESSION['$compFiltro']:1);
  $fechaGraficas=isset($_SESSION['FechaGraficas'])? $_SESSION['FechaGraficas']:$fecha_actual;
 
  $aniografica=substr($fechaGraficas,0,4);
  $mesgrafica=substr($fechaGraficas,4,2);
  $diacbb = substr($fechaGraficas,6,2);
  if ($fechacheck=="true") {
    $diagrafica="31";
  }else{
    $diagrafica=substr($fechaGraficas,6,2);
  }
  $mesGraficas1=(float)(isset($mesgrafica)? $mesgrafica:$mes_actual);
  $mesGraficas2=(float)(isset($mesgrafica)? $mesgrafica:$mes_actual) - 1;
  if ($mesGraficas2==0) {
      $mesGraficas2=12;
  }
  if (strlen($mesGraficas1)==1) {
    $mesGraficas1 = "0".$mesGraficas1;
  }
  if (strlen($mesGraficas2)==1) {
    $mesGraficas2 = "0".$mesGraficas2;
  }
  $anoGraficas1=(float)(isset($aniografica)? $aniografica:$ano_actual);
  $anoGraficas2=(float)(isset($aniografica)? $aniografica:$ano_actual) - 1;

  if ($dolarescheck=="true") {
    $tablaDIA="LO0710";
    $tablaMES="LO0711";
  }else{
    $tablaDIA="LO0849";
    $tablaMES="LO0850";
  }

?>