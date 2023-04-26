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
  $mesGraficas1=(float)(isset($_GET['m'])? $_GET['m']:$mes_actual);
  $mesGraficas2=(float)(isset($_GET['m'])? $_GET['m']:$mes_actual) - 1;
  if ($mesGraficas2==0) {
      $mesGraficas2=12;
  }
  if (strlen($mesGraficas1)==1) {
    $mesGraficas1 = "0".$mesGraficas1;
  }
  if (strlen($mesGraficas2)==1) {
    $mesGraficas2 = "0".$mesGraficas2;
  }
  $anoGraficas1=(float)(isset($_GET['y'])? $_GET['y']:$ano_actual);
  $anoGraficas2=(float)(isset($_GET['y'])? $_GET['y']:$ano_actual) - 1;

  if ($dolarescheck=="true") {
    $tablaDIA="LO0710";
    $tablaMES="LO0711";
  }else{
    $tablaDIA="LO0849";
    $tablaMES="LO0850";
  }

//CONSULTA DE VALORES DIA
$GraficasDias="SELECT CODCIA,NOMCIA,TOTAL FROM(SELECT T2.CODCIA,T2.NOMCIA NOMCIA, SUM(TOTAL) TOTAL FROM (SELECT CODCIA,VENDIA AS TOTAL FROM LBPRDDAT/LO2132
WHERE FECFAC=".$fechaGraficas." UNION ALL
SELECT CODCIA as CODCIA,SUBTOT AS TOTAL FROM LBPRDDAT/".$tablaDIA." WHERE FECPRO=".$fechaGraficas."
UNION ALL SELECT codcia,0 AS TOTAL FROM LBPRDDAT/".$tablaDIA."	
WHERE NOT EXISTS ( SELECT 1 FROM LBDESDAT/".$tablaDIA." WHERE fecpro = ".$fechaGraficas.")  GROUP BY CODCIA) AS T1 
INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA
INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA)";
//CONSULTA DE VALORES MES
  $ValoresMes="SELECT CODCIA,NOMCIA,MES1 FROM(SELECT T1.CODCIA, T1.NOMCIA, T1.SUBTOT MES1 FROM (
    (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT codcia, subtot 
    FROM LBPRDDAT/".$tablaMES." WHERE MESPRO = ".$mesGraficas1." AND ANOPRO =".$anoGraficas1." UNION ALL SELECT codcia, 0 AS subtot
    FROM LBPRDDAT/".$tablaMES." WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaMES." WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas1." )
    GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
    WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA)) AS T1)";
//GRAFICAS DE MEDIA DONA
if ($mesGraficas2==12) {
  $GraficasMes="SELECT CODCIA,NOMCIA,MES1,MES2,MES3 FROM(SELECT T1.CODCIA, T1.NOMCIA, T1.SUBTOT MES1, T2.SUBTOT MES2,T3.SUBTOT MES3 FROM (
    (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT CODCIA,SUM(SUBTOT) SUBTOT 
    FROM LBPRDDAT/".$tablaDIA." WHERE FECPRO BETWEEN ".$anoGraficas1.$mesGraficas1."01 AND ".$anoGraficas1.$mesGraficas1.$diagrafica." GROUP BY CODCIA  UNION ALL SELECT codcia, 0 AS subtot
    FROM LBPRDDAT/".$tablaMES." WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaMES." WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas1." )
    GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
    WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T1
    LEFT JOIN (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT CODCIA,SUM(SUBTOT) SUBTOT
    FROM LBPRDDAT/".$tablaDIA." WHERE FECPRO BETWEEN ".$anoGraficas2.$mesGraficas2."01 AND ".$anoGraficas2.$mesGraficas2.$diagrafica." GROUP BY CODCIA  UNION ALL SELECT codcia, 0 AS subtot
    FROM LBPRDDAT/".$tablaMES." WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaMES." WHERE MESPRO= ".$mesGraficas2." AND ANOPRO=".$anoGraficas1." )
    GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
    WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T2 ON T2.CODCIA = T1.CODCIA
    LEFT JOIN (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT CODCIA,SUM(SUBTOT) SUBTOT
    FROM LBPRDDAT/".$tablaDIA." WHERE FECPRO BETWEEN ".$anoGraficas2.$mesGraficas1."01 AND ".$anoGraficas2.$mesGraficas1.$diagrafica." GROUP BY CODCIA UNION ALL SELECT codcia, 0 AS subtot
    FROM LBPRDDAT/".$tablaMES." WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaMES." WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas2." )
    GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
    WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T3 ON T3.CODCIA = T1.CODCIA))";

    $MesesPasados="SELECT CODCIA,NOMCIA,MES2,MES3 FROM(SELECT T2.CODCIA, T2.NOMCIA, T2.SUBTOT MES2,T3.SUBTOT MES3 FROM (
      (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT codcia, subtot 
      FROM LBPRDDAT/".$tablaMES." WHERE MESPRO = ".$mesGraficas2." AND ANOPRO = ".$anoGraficas2." UNION ALL SELECT codcia, 0 AS subtot
      FROM LBPRDDAT/".$tablaMES." WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaMES." WHERE MESPRO= ".$mesGraficas2." AND ANOPRO=".$anoGraficas2." )
      GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
      WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T2
      LEFT JOIN (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT codcia, subtot 
      FROM LBPRDDAT/".$tablaMES." WHERE MESPRO = ".$mesGraficas1." AND ANOPRO = ".$anoGraficas2." UNION ALL SELECT codcia, 0 AS subtot
      FROM LBPRDDAT/".$tablaMES." WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaMES." WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas2." )
      GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
      WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T3 ON T3.CODCIA = T2.CODCIA))";

}else{
  $GraficasMes="SELECT CODCIA,NOMCIA,MES1,MES2,MES3 FROM(SELECT T1.CODCIA, T1.NOMCIA, T1.SUBTOT MES1, T2.SUBTOT MES2,T3.SUBTOT MES3 FROM (
    (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT CODCIA,SUM(SUBTOT) SUBTOT 
    FROM LBPRDDAT/".$tablaDIA." WHERE FECPRO BETWEEN ".$anoGraficas1.$mesGraficas1."01 AND ".$anoGraficas1.$mesGraficas1.$diagrafica." GROUP BY CODCIA  UNION ALL SELECT codcia, 0 AS subtot
    FROM LBPRDDAT/".$tablaMES." WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaMES." WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas1." )
    GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
    WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T1
    LEFT JOIN (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT CODCIA,SUM(SUBTOT) SUBTOT
    FROM LBPRDDAT/".$tablaDIA." WHERE FECPRO BETWEEN ".$anoGraficas1.$mesGraficas2."01 AND ".$anoGraficas1.$mesGraficas2.$diagrafica." GROUP BY CODCIA  UNION ALL SELECT codcia, 0 AS subtot
    FROM LBPRDDAT/".$tablaMES." WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaMES." WHERE MESPRO= ".$mesGraficas2." AND ANOPRO=".$anoGraficas1." )
    GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
    WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T2 ON T2.CODCIA = T1.CODCIA
    LEFT JOIN (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT CODCIA,SUM(SUBTOT) SUBTOT
    FROM LBPRDDAT/".$tablaDIA." WHERE FECPRO BETWEEN ".$anoGraficas2.$mesGraficas1."01 AND ".$anoGraficas2.$mesGraficas1.$diagrafica." GROUP BY CODCIA UNION ALL SELECT codcia, 0 AS subtot
    FROM LBPRDDAT/".$tablaMES." WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaMES." WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas2." )
    GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
    WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T3 ON T3.CODCIA = T1.CODCIA))";

  $MesesPasados="SELECT CODCIA,NOMCIA,MES2,MES3 FROM(SELECT T2.CODCIA, T2.NOMCIA, T2.SUBTOT MES2,T3.SUBTOT MES3 FROM (
       (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT codcia, subtot 
       FROM LBPRDDAT/".$tablaMES." WHERE MESPRO = ".$mesGraficas2." AND ANOPRO = ".$anoGraficas1." UNION ALL SELECT codcia, 0 AS subtot
       FROM LBPRDDAT/".$tablaMES." WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaMES." WHERE MESPRO= ".$mesGraficas2." AND ANOPRO=".$anoGraficas1." )
       GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
       WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T2
       LEFT JOIN (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT codcia, subtot 
       FROM LBPRDDAT/".$tablaMES." WHERE MESPRO = ".$mesGraficas1." AND ANOPRO = ".$anoGraficas2." UNION ALL SELECT codcia, 0 AS subtot
       FROM LBPRDDAT/".$tablaMES." WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaMES." WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas2." )
       GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
       WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T3 ON T3.CODCIA = T2.CODCIA))";
}
//GRAFICA ANUAL
  $ValoresAnual="SELECT CODCIA,NOMCIA,ANO1,ANO2 FROM(SELECT T1.CODCIA,T3.NOMCIA,T1.ANO1 ANO1,T2.ANO2 ANO2
  FROM (SELECT T3.CODSEC,T2.CODCIA, COALESCE(SUM(T1.SUBTOT), 0) AS ANO1
  FROM lbprddat/".$tablaMES."  AS T1 LEFT JOIN LBPRDDAT/LO0686 AS T3 ON T1.CODCIA = T3.CODCIA     
  RIGHT JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA                                     
  AND T1.ANOPRO = ".$anoGraficas1."                                         
  AND T1.MESPRO BETWEEN 1 AND ".$mesGraficas1." GROUP BY T2.CODCIA,T3.CODSEC) AS T1
  INNER JOIN (SELECT T3.CODSEC,T2.CODCIA, COALESCE(SUM(T1.SUBTOT), 0) AS ANO2
  FROM lbprddat/".$tablaMES."  AS T1 LEFT JOIN LBPRDDAT/LO0686 AS T3 ON T1.CODCIA = T3.CODCIA     
  RIGHT JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA                                     
  AND T1.ANOPRO = ".$anoGraficas2." AND T1.MESPRO BETWEEN 1 AND ".$mesGraficas1."                                 
  GROUP BY T2.CODCIA,T3.CODSEC) AS T2 ON T2.CODCIA=T1.CODCIA INNER JOIN LBPRDDAT/LO0705 AS T3 
  ON T3.CODCIA=T1.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T5 ON T5.DETC90=T1.CODCIA 
  WHERE T5.DETUSU='MARVIN' AND T5.DETPR1 = 'LO1512P' ORDER BY T1.CODSEC)";
//PROMEDIOS 
$promedios="SELECT CODCIA, COMDES NOMCIA,PRODIA,PROMES,PROANO,PROANO2,MON FROM(SELECT CODSEC,ID CODCIA,COMDES,MON,(SUBDIA/DIATRA)PRODIA,(SUBMES/MESTRA)PROMES,(ANO1/ANOTRA)PROANO,(ANO2/ANO2TRA)PROANO2 FROM(SELECT T1.CODSEC,T1.ID,T1.COMDES,T1.MON, T1.SUBDIA,T1.SUBMES,T2.ANO1,T2.ANO2,T2.VARIA,T1.DIATRA,T3.MESTRA,T3.ANOTRA,T3.ANO2TRA FROM (SELECT T2.CODSEC,T1.CODCIA AS ID,
T1.NOMCIA AS COMDES,T6.RELUS7 AS MON, T4.SUBTOT AS SUBDIA,T4.NUMTRA AS DIATRA, 
T5.SUBTOT AS SUBMES FROM LBPRDDAT/LO0705 AS T1 
INNER JOIN LBPRDDAT/LO0686 AS T2 ON T2.CODCIA = T1.CODCIA 
INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
INNER JOIN (SELECT Total.CODCIA, Total.SUBTOT, COALESCE(TRA.NUMTRA, 0) AS NUMTRA 
FROM (SELECT CODCIA, SUM(total) AS SUBTOT 
      FROM (SELECT CODCIA, VENDIA AS total, 1 NUMTRA 
      FROM LBPRDDAT/LO2132 WHERE FECFAC = ".$fechaGraficas." 
      UNION ALL SELECT CODCIA AS CODCIA, SUBTOT AS total, NUMTRA 
      FROM LBPRDDAT/".$tablaDIA." WHERE FECPRO = ".$fechaGraficas."  UNION ALL 
      SELECT codcia, 0 AS total, NUMTRA FROM LBPRDDAT/".$tablaDIA." 
      WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaDIA." WHERE fecpro=".$fechaGraficas." 
      ))GROUP BY CODCIA) AS Total LEFT JOIN LBPRDDAT/".$tablaDIA." AS TRA 
ON TRA.CODCIA = Total.CODCIA AND TRA.FECPRO = ".$fechaGraficas." ) AS T4 ON T4.CODCIA = T1.CODCIA
INNER JOIN ( SELECT CODCIA, SUM(SUBTOT) SUBTOT FROM(
  SELECT codcia, subtot FROM LBPRDDAT/".$tablaMES." 
  WHERE MESPRO = ".$mesGraficas1."  AND ANOPRO =".$anoGraficas1."  UNION ALL SELECT codcia, 0 AS subtot FROM LBPRDDAT/".$tablaMES." 
  WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/".$tablaMES." WHERE MESPRO= ".$mesGraficas1."  AND ANOPRO=".$anoGraficas1."  )GROUP BY CODCIA)GROUP BY CODCIA ORDER BY CODCIA) AS T5 
ON T5.CODCIA = T1.CODCIA INNER JOIN LBPRDDAT/RELAR4 AS T6 ON 
T6.RELCO2 = T1.CODCIA WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' ORDER BY T2.CODSEC) AS T1
INNER JOIN (
SELECT T1.CODSEC CODSEC,T1.CODCIA ID,T3.NOMCIA COMDES,T4.RELUS7 MON,T1.ANO1 ANO1,T2.ANO2 ANO2, 
(T1.ANO1 - T2.ANO2) VARIA
FROM (SELECT T3.CODSEC,T2.CODCIA, COALESCE(SUM(T1.SUBTOT), 0) AS ANO1
FROM lbprddat/".$tablaMES." AS T1                                   
LEFT JOIN LBPRDDAT/LO0686 AS T3 ON T1.CODCIA = T3.CODCIA     
RIGHT JOIN LBPRDDAT/LO0705 AS T2                             
ON T1.CODCIA = T2.CODCIA                                     
AND T1.ANOPRO = ".$anoGraficas1."                                         
AND T1.MESPRO BETWEEN 1 AND ".$mesGraficas1."                                
GROUP BY T2.CODCIA,T3.CODSEC) AS T1
INNER JOIN (SELECT T3.CODSEC,T2.CODCIA, COALESCE(SUM(T1.SUBTOT), 0) AS ANO2
FROM lbprddat/".$tablaMES." AS T1                                   
LEFT JOIN LBPRDDAT/LO0686 AS T3 ON T1.CODCIA = T3.CODCIA     
RIGHT JOIN LBPRDDAT/LO0705 AS T2                             
ON T1.CODCIA = T2.CODCIA                                     
AND T1.ANOPRO = ".$anoGraficas2."                                          
AND T1.MESPRO BETWEEN 1 AND ".$mesGraficas1."                                  
GROUP BY T2.CODCIA,T3.CODSEC) AS T2
ON T2.CODCIA=T1.CODCIA INNER JOIN LBPRDDAT/LO0705 AS T3 
ON T3.CODCIA=T1.CODCIA INNER JOIN LBPRDDAT/RELAR4 AS T4 
ON T4.RELCO2=T1.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T5
ON T5.DETC90=T1.CODCIA 
WHERE T5.DETUSU='MARVIN' AND T5.DETPR1 = 'LO1512P' ORDER BY T2.CODSEC) AS T2 ON T1.ID=T2.ID
INNER JOIN (
  SELECT T7.CODSEC CODSEC, T1.CODCIA ID,T4.NOMCIA COMDES,T5.RELUS7 MON,MESTRA,ANOTRA,ANO2TRA FROM(
    SELECT T2.CODCIA, COALESCE(SUM(T1.NUMTRA), 0) AS MESTRA
    FROM lbprddat/".$tablaDIA." AS T1
    RIGHT JOIN lbprddat/LO0705 AS T2
    ON T1.CODCIA = T2.CODCIA
    AND T1.FECPRO BETWEEN '".$anoGraficas1.$mesGraficas1."01' AND '".$anoGraficas1.$mesGraficas1."31'
    GROUP BY T2.CODCIA) AS T1 INNER JOIN (SELECT T2.CODCIA, COALESCE(SUM(T1.NUMTRA), 0) AS ANOTRA
    FROM lbprddat/".$tablaDIA." AS T1
    RIGHT JOIN lbprddat/LO0705 AS T2
    ON T1.CODCIA = T2.CODCIA
    AND T1.FECPRO BETWEEN '".$anoGraficas1."0101' AND '".$anoGraficas1.$mesGraficas1."31'
    GROUP BY T2.CODCIA) AS T2 ON T1.CODCIA =T2.CODCIA   
  INNER JOIN (SELECT T2.CODCIA, COALESCE(SUM(T1.NUMTRA), 0) AS ANO2TRA
    FROM lbprddat/".$tablaDIA." AS T1
    RIGHT JOIN lbprddat/LO0705 AS T2
    ON T1.CODCIA = T2.CODCIA
    AND T1.FECPRO BETWEEN '".$anoGraficas2."0101' AND '".$anoGraficas2.$mesGraficas1."31'
    GROUP BY T2.CODCIA) AS T3 ON T1.CODCIA=T3.CODCIA   
  INNER JOIN LBPRDDAT/LO0705 AS T4 ON T4.CODCIA=T1.CODCIA 
  INNER JOIN LBPRDDAT/RELAR4 AS T5 ON T5.RELCO2=T1.CODCIA 
  INNER JOIN LBPRDDAT/DETA1699 AS T6 ON T6.DETC90=T1.CODCIA 
  INNER JOIN LBPRDDAT/LO0686 AS T7 ON T7.CODCIA=T1.CODCIA
  WHERE T6.DETUSU='MARVIN' AND T6.DETPR1 = 'LO1512P' ORDER BY T7.CODSEC) AS T3 ON T3.ID = T1.ID) ORDER BY CODSEC)";

  //COMBOBOX
  $sqlCOMARCIndex = "SELECT T2.CODSEC,LO0705.CODCIA COMCOD, LO0705.NOMCIA COMDES 
  FROM LBPRDDAT/LO0705
  INNER JOIN LBPRDDAT/DETA16 ON DETA16.DETC90 = LO0705.CODCIA
  INNER JOIN LBPRDDAT/LO0686 AS T2 ON T2.CODCIA = LO0705.CODCIA
  WHERE DETA16.DETUSU ='".$_SESSION["CODUSU"]."' AND DETA16.DETPR1 = 'LO1512P' AND LO0705.CODCIA!=1 
  ORDER BY T2.CODSEC";
  $resultCOMARCIndex=odbc_exec($connIBM,$sqlCOMARCIndex);

  switch ($compFiltroP) {
    case 1:
      $sqlGraficasDias = $GraficasDias. 'WHERE CODCIA=1';
      $sqlValoresMes = $ValoresMes. 'WHERE CODCIA=1';
      $sqlGraficasMes = $GraficasMes. 'WHERE CODCIA=1';
      $sqlMesesPasados = $MesesPasados. 'WHERE CODCIA=1';
      $sqlValoresAnual = $ValoresAnual. 'WHERE CODCIA=1';
      $sqlValoresPromedio= $promedios.'WHERE CODCIA=1';
      break;
      case 2:
        $sqlGraficasDias = $GraficasDias. 'WHERE CODCIA=35 OR CODCIA=47 OR CODCIA=57 OR CODCIA=52 OR CODCIA=63 OR CODCIA=64 OR CODCIA=72 OR CODCIA=74 OR CODCIA=20 OR CODCIA=22 OR CODCIA=56 OR CODCIA=59 OR CODCIA=65 OR CODCIA=68 OR CODCIA=75 OR CODCIA=76 OR CODCIA=85 OR CODCIA=70 OR CODCIA=73 OR CODCIA=78 OR CODCIA=82';
        $sqlValoresMes = $ValoresMes.'WHERE CODCIA=35 OR CODCIA=47 OR CODCIA=57 OR CODCIA=52 OR CODCIA=63 OR CODCIA=64 OR CODCIA=72 OR CODCIA=74 OR CODCIA=20 OR CODCIA=22 OR CODCIA=56 OR CODCIA=59 OR CODCIA=65 OR CODCIA=68 OR CODCIA=75 OR CODCIA=76 OR CODCIA=85 OR CODCIA=70 OR CODCIA=73 OR CODCIA=78 OR CODCIA=82';
        $sqlGraficasMes = $GraficasMes.'WHERE CODCIA=35 OR CODCIA=47 OR CODCIA=57 OR CODCIA=52 OR CODCIA=63 OR CODCIA=64 OR CODCIA=72 OR CODCIA=74 OR CODCIA=20 OR CODCIA=22 OR CODCIA=56 OR CODCIA=59 OR CODCIA=65 OR CODCIA=68 OR CODCIA=75 OR CODCIA=76 OR CODCIA=85 OR CODCIA=70 OR CODCIA=73 OR CODCIA=78 OR CODCIA=82';
        $sqlMesesPasados = $MesesPasados. 'WHERE CODCIA=35 OR CODCIA=47 OR CODCIA=57 OR CODCIA=52 OR CODCIA=63 OR CODCIA=64 OR CODCIA=72 OR CODCIA=74 OR CODCIA=20 OR CODCIA=22 OR CODCIA=56 OR CODCIA=59 OR CODCIA=65 OR CODCIA=68 OR CODCIA=75 OR CODCIA=76 OR CODCIA=85 OR CODCIA=70 OR CODCIA=73 OR CODCIA=78 OR CODCIA=82';
        $sqlValoresAnual = $ValoresAnual. 'WHERE CODCIA=35 OR CODCIA=47 OR CODCIA=57 OR CODCIA=52 OR CODCIA=63 OR CODCIA=64 OR CODCIA=72 OR CODCIA=74 OR CODCIA=20 OR CODCIA=22 OR CODCIA=56 OR CODCIA=59 OR CODCIA=65 OR CODCIA=68 OR CODCIA=75 OR CODCIA=76 OR CODCIA=85 OR CODCIA=70 OR CODCIA=73 OR CODCIA=78 OR CODCIA=82';
        $sqlValoresPromedio= $promedios.'WHERE CODCIA=35 OR CODCIA=47 OR CODCIA=57 OR CODCIA=52 OR CODCIA=63 OR CODCIA=64 OR CODCIA=72 OR CODCIA=74 OR CODCIA=20 OR CODCIA=22 OR CODCIA=56 OR CODCIA=59 OR CODCIA=65 OR CODCIA=68 OR CODCIA=75 OR CODCIA=76 OR CODCIA=85 OR CODCIA=70 OR CODCIA=73 OR CODCIA=78 OR CODCIA=82';
        break;
        case 3:
          $sqlGraficasDias = $GraficasDias. 'WHERE CODCIA=49 OR CODCIA=66 OR CODCIA=69 OR CODCIA=71 OR CODCIA=86';
          $sqlValoresMes = $ValoresMes.'WHERE CODCIA=49 OR CODCIA=66 OR CODCIA=69 OR CODCIA=71 OR CODCIA=86';
          $sqlGraficasMes = $GraficasMes.'WHERE CODCIA=49 OR CODCIA=66 OR CODCIA=69 OR CODCIA=71 OR CODCIA=86';
          $sqlMesesPasados = $MesesPasados. 'WHERE CODCIA=49 OR CODCIA=66 OR CODCIA=69 OR CODCIA=71 OR CODCIA=86';
          $sqlValoresAnual = $ValoresAnual.'WHERE CODCIA=49 OR CODCIA=66 OR CODCIA=69 OR CODCIA=71 OR CODCIA=86';
          $sqlValoresPromedio= $promedios.'WHERE CODCIA=49 OR CODCIA=66 OR CODCIA=69 OR CODCIA=71 OR CODCIA=86';
          break;
          case 4:
            $sqlGraficasDias = $GraficasDias. 'WHERE CODCIA=48  OR CODCIA=53  OR CODCIA=62  OR CODCIA=61';
            $sqlValoresMes = $ValoresMes.'WHERE CODCIA=48  OR CODCIA=53  OR CODCIA=62  OR CODCIA=61';
            $sqlGraficasMes = $GraficasMes.'WHERE CODCIA=48  OR CODCIA=53  OR CODCIA=62  OR CODCIA=61';
            $sqlMesesPasados = $MesesPasados. 'WHERE CODCIA=48  OR CODCIA=53  OR CODCIA=62  OR CODCIA=61';
            $sqlValoresAnual = $ValoresAnual. 'WHERE CODCIA=48  OR CODCIA=53  OR CODCIA=62  OR CODCIA=61';
            $sqlValoresPromedio= $promedios.'WHERE CODCIA=48  OR CODCIA=53  OR CODCIA=62  OR CODCIA=61';
            break;
            case 5:
              $sqlGraficasDias = $GraficasDias. 'WHERE CODCIA=83 OR CODCIA=87';
              $sqlValoresMes = $ValoresMes.'WHERE CODCIA=83 OR CODCIA=87';
              $sqlGraficasMes = $GraficasMes.'WHERE CODCIA=83 OR CODCIA=87';
              $sqlMesesPasados = $MesesPasados. 'WHERE CODCIA=83 OR CODCIA=87';
              $sqlValoresAnual = $ValoresAnual. 'WHERE CODCIA=83 OR CODCIA=87';
              $sqlValoresPromedio= $promedios.'WHERE CODCIA=83 OR CODCIA=87';
              break;
              case 6:
                $sqlGraficasDias = $GraficasDias. 'WHERE CODCIA=60 OR CODCIA=80';
                $sqlValoresMes = $ValoresMes.'WHERE CODCIA=60 OR CODCIA=80';
                $sqlGraficasMes = $GraficasMes.'WHERE CODCIA=60 OR CODCIA=80';
                $sqlMesesPasados = $MesesPasados. 'WHERE CODCIA=60 OR CODCIA=80';
                $sqlValoresAnual = $ValoresAnual. 'WHERE CODCIA=60 OR CODCIA=80';
                $sqlValoresPromedio= $promedios.'WHERE CODCIA=60 OR CODCIA=80';
                break;
                case 7:
                  $sqlGraficasDias = $GraficasDias. 'WHERE CODCIA=81';
                  $sqlValoresMes = $ValoresMes.'WHERE CODCIA=81';
                  $sqlGraficasMes = $GraficasMes.'WHERE CODCIA=81';
                  $sqlMesesPasados = $MesesPasados. 'WHERE CODCIA=81';
                  $sqlValoresAnual = $ValoresAnual.'WHERE CODCIA=81';
                  $sqlValoresPromedio= $promedios.'WHERE CODCIA=81';
                  break;
    default:
      $sqlGraficasDias = $GraficasDias. 'WHERE CODCIA='.$compFiltroP.'';
      $sqlValoresMes = $ValoresMes.'WHERE CODCIA='.$compFiltroP.'';
      $sqlGraficasMes = $GraficasMes.'WHERE CODCIA='.$compFiltroP.'';
      $sqlMesesPasados = $MesesPasados. 'WHERE CODCIA='.$compFiltroP.'';
      $sqlValoresAnual = $ValoresAnual.'WHERE CODCIA='.$compFiltroP.'';
      $sqlValoresPromedio= $promedios.'WHERE CODCIA='.$compFiltroP.'';
      break;
  }
  
//VENTAS DIA
  $resultG=odbc_exec($connIBM,$sqlGraficasDias);
  $compHonduras=array();$vendiaHonduras=array(); 
  while ($rowG= odbc_fetch_array($resultG)) {
    $codcia=$rowG['CODCIA'];
    $vendia=$rowG['TOTAL'];
    $compHonduras[]=$rowG['NOMCIA'];
    $vendiaHonduras[] = (float)$vendia;
  }
//VENTAS MES
  $compMesHonduras=array(); $venmesHonduras=array(); $venmes1Honduras=0; $venmes2Honduras=0; $venmes3Honduras=0; 
  $ventasMesGrafica=array();
  $resultVMes=odbc_exec($connIBM,$sqlValoresMes);  
  while ($rowValorM= odbc_fetch_array($resultVMes)) { 
    $codMeses1=$rowValorM['CODCIA'];
    $ventasMesGrafica[] = (float)$rowValorM['MES1'];
  }
//VENTAS MES GRAFICAS MEDIA DONA  
  $variacionmes2=0;$variacionmes3=0;$crecimientomes2=0;$crecimientomes3=0;
  $resultM=odbc_exec($connIBM,$sqlGraficasMes); 
  while ($rowM= odbc_fetch_array($resultM)) { 
    $codMes=$rowM['CODCIA'];
    $venmes=$rowM['MES1'];
    $compMesHonduras[]=$rowM['NOMCIA'];
    $venmesHonduras[] = (float)$venmes;
    $venmes1Honduras+=$rowM['MES1'];
    $venmes2Honduras+=$rowM['MES2'];
    $venmes3Honduras+=$rowM['MES3'];
  }
  if ($venmes==0) {
       $resultMeses=odbc_exec($connIBM,$sqlMesesPasados); 
       while ($rowMeses= odbc_fetch_array($resultMeses)) { 
        $codMeses=$rowMeses['CODCIA'];
        $venmes2Honduras+=$rowMeses['MES2'];
        $venmes3Honduras+=$rowMeses['MES3'];
       }
  }
  $variacionmes2=$venmes1Honduras-$venmes2Honduras;
  $variacionmes3=$venmes1Honduras-$venmes3Honduras;
  if ($venmes1Honduras!=0 && $venmes2Honduras!=0) {
    $crecimientomes2 = round((($venmes1Honduras/$venmes2Honduras)-1)*100);
  }
  if ($venmes1Honduras!=0 && $venmes3Honduras!=0) {
    $crecimientomes3 = round((($venmes1Honduras/$venmes3Honduras)-1)*100);
  }

  $ventasdeldia=0; $ventasdelmes=0;
  $ventasdeldia=count($vendiaHonduras)>0 ? $vendiaHonduras[0]:0;
  $ventasdelmes=count($ventasMesGrafica)>0 ? $ventasMesGrafica[0]:0;

  //VENTAS ANUALES
  $venAnual1=0; $venAnual2=0;$variacion=0;$crecimiento=0;
  $resultAnual=odbc_exec($connIBM,$sqlValoresAnual); 
  while ($rowAnual= odbc_fetch_array($resultAnual)) { 
    $venAnual1+=$rowAnual['ANO1'];
    $venAnual2+=$rowAnual['ANO2'];
  }
  $variacion=$venAnual1-$venAnual2;
  if ($venAnual1!=0 && $venAnual2!=0) {
    $crecimiento = round((($venAnual1/$venAnual2)-1)*100);
  }
  //PROMEDIOS
  $prodia=0;$promes=0;$proano=0;$proano2=0;$variacionpro=0;$crecimientopro=0;
  $resultPromedios=odbc_exec($connIBM,$sqlValoresPromedio); 
  while ($rowPromedios= odbc_fetch_array($resultPromedios)) { 
    $_SESSION['MONE']=$rowPromedios['MON'];
    if ($dolarescheck=="true") {
      $_SESSION['MONE']="D";
    }
    $prodia+=$rowPromedios['PRODIA'];
    $promes+=$rowPromedios['PROMES'];
    $proano+=$rowPromedios['PROANO'];
    $proano2+=$rowPromedios['PROANO2'];
  }
  $variacionpro=$proano-$proano2;
  if ($proano!=0 && $proano2!=0) {
    $crecimientopro = round((($proano/$proano2)-1)*100);
  }
?>