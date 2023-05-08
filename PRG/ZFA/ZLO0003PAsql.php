<?php
function obtenerNombreMes($numeroMes) {
    $nombresMes = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');
    return $nombresMes[$numeroMes - 1];
  }
$mesfiltro=isset($_SESSION['mesfiltro'])? $_SESSION['mesfiltro']:  $mes_actual; 
$anofiltro=isset($_SESSION['anofiltro'])? $_SESSION['anofiltro']: $ano_actual; 
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

$valorFiltro=$anofiltro.$_SESSION['mesFiltro'];
//FACTORES CAMBIO
 $sqlfactor="SELECT  * FROM (
    (SELECT * FROM lbprddat/lo0709 WHERE MONORI='L' AND MONDES='D' AND FECPRO LIKE '".$valorFiltro."%'
      ORDER BY FECPRO DESC LIMIT 1)
    UNION ALL   
    (SELECT * FROM lbprddat/lo0709 WHERE MONORI='Q' AND MONDES='D' AND FECPRO LIKE '".$valorFiltro."%'
      ORDER BY FECPRO DESC LIMIT 1)       
    UNION ALL 
    (SELECT * FROM lbprddat/lo0709 WHERE MONORI='C' AND MONDES='D' AND FECPRO LIKE '".$valorFiltro."%'
      ORDER BY FECPRO DESC LIMIT 1)
    UNION ALL          
    (SELECT * FROM lbprddat/lo0709 WHERE MONORI='P' AND MONDES='D' AND FECPRO LIKE '".$valorFiltro."%'
      ORDER BY FECPRO DESC LIMIT 1)        
    UNION ALL 
    (SELECT * FROM lbprddat/lo0709 WHERE MONORI='D' AND MONDES='D' AND FECPRO LIKE '".$valorFiltro."%'
      ORDER BY FECPRO DESC LIMIT 1))";
    
$factorL=0;$factorQ=0;$factorC=0;$factorP=0;$factorD=1;
 $resultFactor=odbc_exec($connIBM,$sqlfactor); 
if (!odbc_num_rows($resultFactor)) {
    $_SESSION['mesFiltro']=($_SESSION['mesFiltro']-1);
    if (strlen($_SESSION['mesFiltro'])==1) {
        $_SESSION['mesFiltro']='0'.($_SESSION['mesFiltro']);
    }
    $_SESSION['validacion']=="false";
    echo '<script>window.location.replace("/'.$_SESSION['DEV'].'LovablePHP/PRG/ZFA/ZLO0003PA.php")</script>'; 
}
 
 while($rowFactor = odbc_fetch_array($resultFactor)){
    switch ($rowFactor['MONORI']) {
        case 'L':
            $factorL=$rowFactor['FACTOR'];
            break;
            case 'Q':
                $factorQ=$rowFactor['FACTOR'];
                break;
                case 'C':
                    $factorC=$rowFactor['FACTOR'];
                    break;
                    case 'P':
                        $factorP=$rowFactor['FACTOR'];
                        break;
        default:
                $factorD=1;
            break;
    }
}    

$selectMes = $mesfiltro;
if ($ckfiltro==1) {
    $selectMes ="HISM37=".$mesfiltro."";
}else{
    $selectMes ="HISM37 BETWEEN 1 AND ".$mesfiltro."";
}
//HONDURAS
 $marcassql="SELECT HON.HISM38,HON.DESDES,HON.CANTIDAD CANHON,HON.VALOR VALHON,
                                          GUA.CANTIDAD CANGUA,GUA.VALOR VALGUA,
                                          SAL.CANTIDAD CANSAL,SAL.VALOR VALSAL,
                                          COS.CANTIDAD CANCOS,COS.VALOR VALCOS,
                                          REP.CANTIDAD CANREP,REP.VALOR VALREP,
                                          NIC.CANTIDAD CANNIC,NIC.VALOR VALNIC
  FROM(SELECT HISM38,DESDES,FLOOR(((FLOOR(CANTIDAD)*12) +ROUND((CANTIDAD - FLOOR(CANTIDAD)) * 100))) CANTIDAD, VALOR FROM (
    SELECT HISM38, MAX(DESDES) as DESDES, SUM(HIS057) CANTIDAD, SUM(HISV22) VALOR
        FROM (
            SELECT HIS056, HISM38, HIS057, HISV22
            FROM LBPRDDAT/hisa5804
            WHERE HISA60=".$anofiltro." AND ".$selectMes." AND (
                HIS056=35 OR HIS056=47 OR HIS056=50 OR HIS056=52 OR HIS056=56 OR
                HIS056=57 OR HIS056=59 OR HIS056=63 OR HIS056=64 OR HIS056=65 OR 
                HIS056=68 OR HIS056=70 OR HIS056=72 OR HIS056=73 OR HIS056=74 OR 
                HIS056=75 OR HIS056=76 OR HIS056=78 OR HIS056=82 OR HIS056=85
            )
        ) T1
        INNER JOIN LBPRDDAT/DESARC T2 ON T1.HISM38=T2.DESCO1 AND T1.HIS056=T2.DESCOD
        GROUP BY HISM38))AS HON LEFT JOIN 
                        (
                          SELECT HISM38,DESDES,FLOOR(((FLOOR(CANTIDAD)*12) +ROUND((CANTIDAD - FLOOR(CANTIDAD)) * 100))) CANTIDAD, VALOR FROM (
    SELECT HISM38, MAX(DESDES) as DESDES, SUM(HIS057) CANTIDAD, SUM(HISV22) VALOR
        FROM (
            SELECT HIS056, HISM38, HIS057, HISV22
            FROM LBPRDDAT/hisa5804
            WHERE HISA60=".$anofiltro." AND ".$selectMes." AND (
                HIS056=49 OR HIS056=66 OR HIS056=69 OR HIS056=71 OR HIS056=86
            )
        ) T1
        INNER JOIN LBPRDDAT/DESARC T2 ON T1.HISM38=T2.DESCO1 AND T1.HIS056=T2.DESCOD
        GROUP BY HISM38) ORDER BY HISM38
                        )AS GUA ON HON.HISM38=GUA.HISM38 LEFT JOIN 
                        (
                          SELECT HISM38,DESDES,FLOOR(((FLOOR(CANTIDAD)*12) +ROUND((CANTIDAD - FLOOR(CANTIDAD)) * 100))) CANTIDAD, VALOR FROM (
    SELECT HISM38, MAX(DESDES) as DESDES, SUM(HIS057) CANTIDAD, SUM(HISV22) VALOR
        FROM (
            SELECT HIS056, HISM38, HIS057, HISV22
            FROM LBPRDDAT/hisa5804
            WHERE HISA60=".$anofiltro." AND ".$selectMes." AND (
                HIS056=48 OR HIS056=53 OR HIS056=61 OR HIS056=62 OR HIS056=77
            )
        ) T1
        INNER JOIN LBPRDDAT/DESARC T2 ON T1.HISM38=T2.DESCO1 AND T1.HIS056=T2.DESCOD
        GROUP BY HISM38) ORDER BY HISM38
                        )AS SAL ON HON.HISM38=SAL.HISM38 LEFT JOIN 
                        (
                          SELECT HISM38,DESDES,FLOOR(((FLOOR(CANTIDAD)*12) +ROUND((CANTIDAD - FLOOR(CANTIDAD)) * 100))) CANTIDAD, VALOR FROM (
    SELECT HISM38, MAX(DESDES) as DESDES, SUM(HIS057) CANTIDAD, SUM(HISV22) VALOR
        FROM (
            SELECT HIS056, HISM38, HIS057, HISV22
            FROM LBPRDDAT/hisa5804
            WHERE HISA60=".$anofiltro." AND ".$selectMes." AND (
                HIS056=54 OR HIS056=60 OR HIS056=80
            )
        ) T1
        INNER JOIN LBPRDDAT/DESARC T2 ON T1.HISM38=T2.DESCO1 AND T1.HIS056=T2.DESCOD
        GROUP BY HISM38) ORDER BY HISM38
                        )AS COS ON HON.HISM38 = COS.HISM38 LEFT JOIN 
                        (
                          SELECT HISM38,DESDES,FLOOR(((FLOOR(CANTIDAD)*12) +ROUND((CANTIDAD - FLOOR(CANTIDAD)) * 100))) CANTIDAD, VALOR FROM (
    SELECT HISM38, MAX(DESDES) as DESDES, SUM(HIS057) CANTIDAD, SUM(HISV22) VALOR
        FROM (
            SELECT HIS056, HISM38, HIS057, HISV22
            FROM LBPRDDAT/hisa5804
            WHERE HISA60=".$anofiltro." AND ".$selectMes." AND (
                HIS056=81
            )
        ) T1
        INNER JOIN LBPRDDAT/DESARC T2 ON T1.HISM38=T2.DESCO1 AND T1.HIS056=T2.DESCOD
        GROUP BY HISM38) ORDER BY HISM38
                        )AS REP ON HON.HISM38 = REP.HISM38 LEFT JOIN 
                        (
                          SELECT HISM38,DESDES,FLOOR(((FLOOR(CANTIDAD)*12) +ROUND((CANTIDAD - FLOOR(CANTIDAD)) * 100))) CANTIDAD, VALOR FROM (
    SELECT HISM38, MAX(DESDES) as DESDES, SUM(HIS057) CANTIDAD, SUM(HISV22) VALOR
        FROM (
            SELECT HIS056, HISM38, HIS057, HISV22
            FROM LBPRDDAT/hisa5804
            WHERE HISA60=".$anofiltro." AND ".$selectMes." AND (
                HIS056=83 OR HIS056=87 
            )
        ) T1
        INNER JOIN LBPRDDAT/DESARC T2 ON T1.HISM38=T2.DESCO1 AND T1.HIS056=T2.DESCOD
        GROUP BY HISM38) ORDER BY HISM38
                        )AS NIC ON HON.HISM38 = NIC.HISM38
                        ORDER BY HON.HISM38";
    $resultMarcas=odbc_exec($connIBM,$marcassql);
  


?>