<?php  
//$fecha = isset($_POST['fechapro']) ? $_POST['fechapro'] : "";
//$comp = isset($_POST['comppro']) ? $_POST['comppro'] : "";
   session_start();
   $_SESSION['productosCk']= isset($_POST['productosCk']) ? "true": "false";
   $fechapro = isset($_POST['fechapro']) ? $_POST['fechapro']: "";
   $comppro= isset($_POST['comppro']) ? $_POST['comppro']: "";
   $_SESSION['fechapro'] =  date("Ymd", strtotime($fechapro));
   $_SESSION['mespro'] =  date("m", strtotime($fechapro));
   $_SESSION['anopro'] =  date("Y", strtotime($fechapro));
   $_SESSION['comppro'] =$comppro;
   header('Location: /LovablePHP/PRG/ZFA/ZLO0001P.php');
   /*"SELECT T1.codcia AS ID,T3.NOMCIA AS COMDES,T1.fecpro AS FECHA,
      RELAR4.RELUS7 AS MON, SUM(T1.subtot) as SUBDIA, T2.subtot as SUBMES FROM(
      SELECT codcia, fecpro, subtot FROM LBPRDDAT/LO0849 WHERE fecpro = ".$_SESSION['FechaFiltro']."                       
      UNION ALL SELECT codcia, ".$_SESSION['FechaFiltro']." AS fecpro, 0 AS subtot FROM LBPRDDAT/LO0849                            
      WHERE NOT EXISTS ( SELECT 1 FROM LBDESDAT/LO0849 WHERE fecpro = ".$_SESSION['FechaFiltro']." )) as T1 
      INNER JOIN (SELECT codcia, mespro, anopro, subtot FROM LBPRDDAT/LO0850 WHERE MESPRO = ".$_SESSION['MesFiltro']." AND ANOPRO = ".$_SESSION['AnoFiltro']."                       
      UNION ALL SELECT codcia, ".$_SESSION['MesFiltro']." AS MESPRO,".$_SESSION['AnoFiltro']." AS ANOPRO, 0 AS subtot FROM LBPRDDAT/LO0850                            
      WHERE NOT EXISTS ( SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO = ".$_SESSION['MesFiltro']." AND ANOPRO = ".$_SESSION['AnoFiltro']." )) as T2 ON T1.codcia = T2.codcia
      INNER JOIN LBPRDDAT/LO0705 AS T3 ON T1.codcia = T3.codcia
      INNER JOIN LBPRDDAT/RELAR4 ON T1.codcia = RELAR4.RELCO2
      INNER JOIN LBPRDDAT/DETA16 ON T1.codcia = DETA16.DETC90
      WHERE (T2.MESPRO = ".$_SESSION['MesFiltro']." AND T2.ANOPRO = ".$_SESSION['AnoFiltro'].")".$_SESSION['CompFiltro']." 
      AND DETA16.DETUSU = '".$_SESSION["CODUSU"]."'  AND DETA16.DETPR1 = 'LO1512P'
      GROUP BY T1.codcia,T3.NOMCIA,RELAR4.RELUS7,T1.fecpro, T2.subtot ORDER BY T1.codcia";
      
         CASO DE AÑADIR OTROS PRODUCTOS
      if ($ckProductos == "true") {
          $_SESSION['logicSql'] ="SELECT TM1.ID AS ID,TM1.CODCIA AS CODCIA,TM1.COMDES AS COMDES, TM1.MON AS MON, 
          TM1.SUBDIA + TM2.SUBDIA AS SUBDIA,TM1.SUBMES + TM2.SUBMES AS SUBMES FROM 
          (SELECT T2.CODSEC AS ID,T1.CODCIA AS CODCIA,
          T1.NOMCIA AS COMDES,T6.RELUS7 AS MON, T4.SUBTOT AS SUBDIA, 
          T5.SUBTOT AS SUBMES FROM LBPRDDAT/LO0705 AS T1 
          INNER JOIN LBPRDDAT/LO0686 AS T2 ON T2.CODCIA = T1.CODCIA 
          INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
          INNER JOIN (SELECT CODCIA, SUM(total) AS SUBTOT
          FROM (SELECT CODCIA,VENDIA AS total FROM LBPRDDAT/LO2132
          WHERE FECFAC=".$_SESSION['FechaFiltro']." UNION ALL
          SELECT CODCIA as CODCIA,SUBTOT AS total FROM LBPRDDAT/LO0849 WHERE FECPRO=".$_SESSION['FechaFiltro']." 
          UNION ALL SELECT codcia,0 AS total FROM LBPRDDAT/LO0849	
          WHERE NOT EXISTS ( SELECT 1 FROM LBDESDAT/LO0849 WHERE fecpro = ".$_SESSION['FechaFiltro'].")) AS Total  
          GROUP BY CODCIA ) AS T4 ON T4.CODCIA = T1.CODCIA
          INNER JOIN (SELECT codcia, subtot FROM LBPRDDAT/LO0850 
          WHERE MESPRO = ".$_SESSION['MesFiltro']." AND ANOPRO =".$_SESSION['AnoFiltro']." UNION ALL SELECT codcia, 0 AS subtot FROM LBPRDDAT/LO0850 
          WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO = ".$_SESSION['MesFiltro']." AND ANOPRO = ".$_SESSION['AnoFiltro']." )GROUP BY CODCIA) AS T5 
          ON T5.CODCIA = T1.CODCIA INNER JOIN LBPRDDAT/RELAR4 AS T6 ON 
          T6.RELCO2 = T1.CODCIA WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' ORDER BY T2.CODSEC ASC) AS TM1  
          LEFT JOIN (SELECT CODCIA,SUM(WVSUBD) AS SUBDIA, SUM(WVSUBD) AS SUBMES 
          FROM (SELECT T7.CODCIA AS CODCIA, T9.valcde * T7.FACCAM AS WVSUBD 
          FROM LBPRDDAT/lo042902 AS T7 LEFT JOIN LBPRDDAT/lo145101 AS T8 
          ON T7.numfac = T8.numfac LEFT JOIN LBPRDDAT/lo043004 AS T9 
          ON T7.numfac = T9.numfac WHERE T8.numfac IS NULL 
          AND T9.marca >= 996 AND T9.FECFAC =". $_SESSION['FechaFiltroDMY']." UNION ALL SELECT T10.FACCO4 AS CODCIA,
          T12.facv02 * T10.facfa3 AS WVSUBD FROM LBPRDDAT/facar213 AS T10	
          LEFT JOIN LBPRDDAT/lo145101 AS T11 ON T10.FACNU3 = T11.numfac
          LEFT JOIN LBPRDDAT/facar3 AS T12 ON T10.FACNU3 = T12.FACNU5
          WHERE T11.numfac IS NULL AND T12.facma1 >= 996
          AND T12.FACFE9 =". $_SESSION['FechaFiltroDMY'].") AS T13
          GROUP BY CODCIA ORDER BY CODCIA) AS TM2 ON TM2.CODCIA = TM1.CODCIA ORDER BY ID";
          $sqlquery_zlo0001p = isset($_SESSION['logicSql']) ? $_SESSION['logicSql'] : " ";                    
          $result_zlo0001p=odbc_exec($connIBM,$sqlquery_zlo0001p);
        }
        if ($ckProductos == "false") { }
        
      */

?>

