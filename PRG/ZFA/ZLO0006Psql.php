<?php
function obtenerNombreMes($numeroMes) {
    $nombresMes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
    return $nombresMes[$numeroMes - 1];
  }
  $mes_actual=date("m");
 $ano_actual=date("Y");
$mesfiltro=(isset($_SESSION['mesfiltro2'])&& $_SESSION['mesfiltro2']!='')? $_SESSION['mesfiltro2']:  $mes_actual; 
$anofiltro=(isset($_SESSION['anofiltro'])&& $_SESSION['anofiltro']!='')? $_SESSION['anofiltro']: $ano_actual; 
$ckfiltro=isset($_SESSION['radioCk'])? $_SESSION['radioCk']:1;
isset($_SESSION['validacion'])? $_SESSION['validacion']:$_SESSION['validacion']="false";

if (!isset($_SESSION['mesFiltro'])) {
    $_SESSION['mesFiltro']=$mesfiltro;
}else{
    if($_SESSION['validacion']=="true"){
        $_SESSION['mesFiltro']=$mesfiltro;
        $_SESSION['validacion']="false";
    }
}

//DESCRIPCIONES
$marcasDescripcion="SELECT * FROM LBPRDDAT/DESARC WHERE DESCOD=01";
$resultDescripcion=odbc_exec($connIBM,$marcasDescripcion);
$_SESSION['mesFiltro']=$_SESSION['mesFiltro']-1;
$valorFiltro=$anofiltro.(strlen($_SESSION['mesFiltro'])==1? "0".$_SESSION['mesFiltro']:$_SESSION['mesFiltro']);

$selectMes = $mesfiltro;
if ($ckfiltro==1) {
    $selectMes ="MESPRO=".$mesfiltro."";
}else{
    $selectMes ="MESPRO BETWEEN 1 AND ".$mesfiltro."";
}
//HONDURAS
 $marcassql="SELECT HON.MARCA,HON.DESDES,HON.CANTIDAD CANHON,HON.VALOR VALHON,
                                          GUA.CANTIDAD CANGUA,GUA.VALOR VALGUA,
                                          SAL.CANTIDAD CANSAL,SAL.VALOR VALSAL,
                                          COS.CANTIDAD CANCOS,COS.VALOR VALCOS,
                                          REP.CANTIDAD CANREP,REP.VALOR VALREP,
                                          NIC.CANTIDAD CANNIC,NIC.VALOR VALNIC
  FROM(SELECT MARCA,DESDES,FLOOR(((FLOOR(CANTIDAD)*12) +ROUND((CANTIDAD - FLOOR(CANTIDAD)) * 100))) CANTIDAD, VALOR FROM (
    SELECT MARCA, MAX(DESDES) as DESDES, SUM(CANVEN) CANTIDAD, SUM(VALVEN) VALOR
        FROM (
            SELECT CODCIA, MARCA, CANVEN, VALVEN
            FROM LBPRDDAT/LO2234
            WHERE ANOPRO=".$anofiltro." AND ".$selectMes." AND CODCIA IN(35,47,50,52,56,57,59,63,64,65,68,70,72,73,74,75,76,78,82,85,88,90)
        ) T1
        INNER JOIN LBPRDDAT/DESARC T2 ON T1.MARCA=T2.DESCO1 AND T1.CODCIA=T2.DESCOD
        GROUP BY MARCA))AS HON LEFT JOIN 
                        (
                          SELECT MARCA,DESDES,FLOOR(((FLOOR(CANTIDAD)*12) +ROUND((CANTIDAD - FLOOR(CANTIDAD)) * 100))) CANTIDAD, VALOR FROM (
    SELECT MARCA, MAX(DESDES) as DESDES, SUM(CANVEN) CANTIDAD, SUM(VALVEN) VALOR
        FROM (
            SELECT CODCIA, MARCA, CANVEN, VALVEN
            FROM LBPRDDAT/LO2234
            WHERE ANOPRO=".$anofiltro." AND ".$selectMes." AND CODCIA IN(49,66,69,71,86,89)
        ) T1
        INNER JOIN LBPRDDAT/DESARC T2 ON T1.MARCA=T2.DESCO1 AND T1.CODCIA=T2.DESCOD
        GROUP BY MARCA) ORDER BY MARCA
                        )AS GUA ON HON.MARCA=GUA.MARCA LEFT JOIN 
                        (
                          SELECT MARCA,DESDES,FLOOR(((FLOOR(CANTIDAD)*12) +ROUND((CANTIDAD - FLOOR(CANTIDAD)) * 100))) CANTIDAD, VALOR FROM (
    SELECT MARCA, MAX(DESDES) as DESDES, SUM(CANVEN) CANTIDAD, SUM(VALVEN) VALOR
        FROM (
            SELECT CODCIA, MARCA, CANVEN, VALVEN
            FROM LBPRDDAT/LO2234
            WHERE ANOPRO=".$anofiltro." AND ".$selectMes." AND CODCIA IN(48,53,61,62,77)
        ) T1
        INNER JOIN LBPRDDAT/DESARC T2 ON T1.MARCA=T2.DESCO1 AND T1.CODCIA=T2.DESCOD
        GROUP BY MARCA) ORDER BY MARCA
                        )AS SAL ON HON.MARCA=SAL.MARCA LEFT JOIN 
                        (
                          SELECT MARCA,DESDES,FLOOR(((FLOOR(CANTIDAD)*12) +ROUND((CANTIDAD - FLOOR(CANTIDAD)) * 100))) CANTIDAD, VALOR FROM (
    SELECT MARCA, MAX(DESDES) as DESDES, SUM(CANVEN) CANTIDAD, SUM(VALVEN) VALOR
        FROM (
            SELECT CODCIA, MARCA, CANVEN, VALVEN
            FROM LBPRDDAT/LO2234
            WHERE ANOPRO=".$anofiltro." AND ".$selectMes." AND CODCIA IN(54,60,80)
        ) T1
        INNER JOIN LBPRDDAT/DESARC T2 ON T1.MARCA=T2.DESCO1 AND T1.CODCIA=T2.DESCOD
        GROUP BY MARCA) ORDER BY MARCA
                        )AS COS ON HON.MARCA = COS.MARCA LEFT JOIN 
                        (
                          SELECT MARCA,DESDES,FLOOR(((FLOOR(CANTIDAD)*12) +ROUND((CANTIDAD - FLOOR(CANTIDAD)) * 100))) CANTIDAD, VALOR FROM (
    SELECT MARCA, MAX(DESDES) as DESDES, SUM(CANVEN) CANTIDAD, SUM(VALVEN) VALOR
        FROM (
            SELECT CODCIA, MARCA, CANVEN, VALVEN
            FROM LBPRDDAT/LO2234
            WHERE ANOPRO=".$anofiltro." AND ".$selectMes." AND (
                CODCIA IN (81,91)
            )
        ) T1
        INNER JOIN LBPRDDAT/DESARC T2 ON T1.MARCA=T2.DESCO1 AND T1.CODCIA=T2.DESCOD
        GROUP BY MARCA) ORDER BY MARCA
                        )AS REP ON HON.MARCA = REP.MARCA LEFT JOIN 
                        (
                          SELECT MARCA,DESDES,FLOOR(((FLOOR(CANTIDAD)*12) +ROUND((CANTIDAD - FLOOR(CANTIDAD)) * 100))) CANTIDAD, VALOR FROM (
    SELECT MARCA, MAX(DESDES) as DESDES, SUM(CANVEN) CANTIDAD, SUM(VALVEN) VALOR
        FROM (
            SELECT CODCIA, MARCA, CANVEN, VALVEN
            FROM LBPRDDAT/LO2234
            WHERE ANOPRO=".$anofiltro." AND ".$selectMes." AND (
                CODCIA=83 OR CODCIA=87 
            )
        ) T1
        INNER JOIN LBPRDDAT/DESARC T2 ON T1.MARCA=T2.DESCO1 AND T1.CODCIA=T2.DESCOD
        GROUP BY MARCA) ORDER BY MARCA
                        )AS NIC ON HON.MARCA = NIC.MARCA
                        ORDER BY HON.MARCA";

    $resultMarcas=odbc_exec($connIBM,$marcassql);
  


?>