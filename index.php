<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
</head>

<body>
  <?php

    function obtenerNombreMes($numeroMes) {
      $nombresMes = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
      return $nombresMes[$numeroMes - 1];
    }
      include 'layout.php';
      $fechacheck=isset($_GET['ck'])? $_GET['ck']:"false";
      $fecha_actual = date("Ymd");
      $mes_actual=date("m");
      $ano_actual=date("Y");
      $compFiltroP=(float)(isset($_GET['c'])? $_GET['c']:1);
      $fechaGraficas=isset($_GET['d'])? $_GET['d']:$fecha_actual;
      $aniografica=substr($fechaGraficas,0,4);
      $mesgrafica=substr($fechaGraficas,4,2);
      $diacbb = substr($fechaGraficas,6,2);
      if ($fechacheck=="true") {
        $diagrafica=substr($fechaGraficas,6,2);
      }else{
        $diagrafica="31";
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

      $sqlGraficasDias="SELECT T2.CODCIA,T2.NOMCIA NOMCIA, SUM(TOTAL) TOTAL FROM (SELECT CODCIA,VENDIA AS TOTAL FROM LBPRDDAT/LO2132
      WHERE FECFAC=".$fechaGraficas." UNION ALL
      SELECT CODCIA as CODCIA,SUBTOT AS TOTAL FROM LBPRDDAT/LO0849 WHERE FECPRO=".$fechaGraficas."
      UNION ALL SELECT codcia,0 AS TOTAL FROM LBPRDDAT/LO0849	
      WHERE NOT EXISTS ( SELECT 1 FROM LBDESDAT/LO0849 WHERE fecpro = ".$fechaGraficas.")  GROUP BY CODCIA) AS T1 
      INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA
      INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA";
      $resultG=odbc_exec($connIBM,$sqlGraficasDias);
      $compHonduras=array();$vendiaHonduras=array(); $compGuatemala=array(); $vendiaGuatemala=array();$compElSalvador=array(); $vendiaElSalvador=array();
      $compNicaragua=array(); $vendiaNicaragua=array();$compCostaRica=array(); $vendiaCostaRica=array();$compRepDomi=array(); $vendiaRepDomi=array();
      while ($rowG= odbc_fetch_array($resultG)) {
        $codcia=$rowG['CODCIA'];
        $vendia=$rowG['TOTAL'];
        if ((float)$vendia !=0) {
          if ($compFiltroP==1) {
            if (in_array($codcia, array(1))) {
              $compHonduras[]=$rowG['NOMCIA'];
              $vendiaHonduras[] = (float)$vendia;
            }
          } else if ($compFiltroP==2) {
        if (in_array($codcia, array(35, 47,57,52,63,64,72,74,20,22,56,59,65,68,75,76,85,70,73,78,82))) {
            $compHonduras[]=$rowG['NOMCIA'];
            $vendiaHonduras[] = (float)$vendia;
        }}else if ($compFiltroP==3){
          if (in_array($codcia, array(49,66,69,71,86))) {
            $compHonduras[]=$rowG['NOMCIA'];
            $vendiaHonduras[] = (float)$vendia;
        }
        }else if ($compFiltroP==4){
          if (in_array($codcia, array(48,53,62,61))) {
            $compHonduras[]=$rowG['NOMCIA'];
            $vendiaHonduras[] = (float)$vendia;
        }
        }else if ($compFiltroP==5){
          if (in_array($codcia, array(83,87))) {
            $compHonduras[]=$rowG['NOMCIA'];
            $vendiaHonduras[] = (float)$vendia;
        }
        }else if ($compFiltroP==6){
          if (in_array($codcia, array(60,80))) {
            $compHonduras[]=$rowG['NOMCIA'];
            $vendiaHonduras[] = (float)$vendia;
        }
        }else if ($compFiltroP==7){
          if (in_array($codcia, array(81))) {
            $compHonduras[]=$rowG['NOMCIA'];
            $vendiaHonduras[] = (float)$vendia;
        }
        }
        }
      }

      switch ($compFiltroP) {
        case 1:
          $_SESSION['MONE']="L";
          break;
          case 2:
            $_SESSION['MONE']="L";
            break;
            case 3:
              $_SESSION['MONE']="Q";
              break;
              case 4:
                $_SESSION['MONE']="D";
                break;
                case 5:
                  $_SESSION['MONE']="D";
                  break;
                  case 6:
                    $_SESSION['MONE']="C";
                    break;
                    case 7:
                      $_SESSION['MONE']="P";
                      break;
        default:
        $_SESSION['MONE']=" ";
          break;
      }

      $compMesHonduras=array(); $venmesHonduras=array(); $venmes1Honduras=0; $venmes2Honduras=0; $venmes3Honduras=0; 
      
      $ventasMesGrafica=array();
      $sqlValoresMes="SELECT T1.CODCIA, T1.NOMCIA, T1.SUBTOT MES1 FROM (
        (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT codcia, subtot 
        FROM LBPRDDAT/LO0850 WHERE MESPRO = ".$mesGraficas1." AND ANOPRO =".$anoGraficas1." UNION ALL SELECT codcia, 0 AS subtot
        FROM LBPRDDAT/LO0850 WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas1." )
        GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
        WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA)) AS T1";
    
      $resultVMes=odbc_exec($connIBM,$sqlValoresMes);  
      while ($rowValorM= odbc_fetch_array($resultVMes)) { 
        $codMeses1=$rowValorM['CODCIA'];
        if ($compFiltroP==1) {
          if (in_array($codMeses1, array(1))) {
            $ventasMesGrafica[] = (float)$rowValorM['MES1'];
          }
       }else if ($compFiltroP==2) {
            if (in_array($codMeses1, array(35, 47,57,52,63,64,72,74,20,22,56,59,65,68,75,76,85,70,73,78,82))) {
              $ventasMesGrafica[] = (float)$rowValorM['MES1'];
            }
         }
         else if ($compFiltroP==3) {
          if (in_array($codMeses1, array(49,66,69,71,86))) {
            $ventasMesGrafica[] = (float)$rowValorM['MES1'];
          }
       }
          else if ($compFiltroP==4) {
              if (in_array($codMeses1, array(48,53,62,61))) {
                $ventasMesGrafica[] = (float)$rowValorM['MES1'];
                }
            }
          else if ($compFiltroP==5) {
              if (in_array($codMeses1, array(83,87))) {
                $ventasMesGrafica[] = (float)$rowValorM['MES1'];
              }
          }
          else if ($compFiltroP==6) {
            if (in_array($codMeses1, array(60,80))) {
              $ventasMesGrafica[] = (float)$rowValorM['MES1'];
            }
          }
          else if ($compFiltroP==7) {
            if (in_array($codMeses1, array(81))) {
              $ventasMesGrafica[] = (float)$rowValorM['MES1'];
            }
         }
      
      }

      if ($mesGraficas2==12) {
        $sqlGraficasMes="SELECT T1.CODCIA, T1.NOMCIA, T1.SUBTOT MES1, T2.SUBTOT MES2,T3.SUBTOT MES3 FROM (
          (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT CODCIA,SUM(SUBTOT) SUBTOT  
          FROM LBPRDDAT/LO0849 WHERE FECPRO BETWEEN 20230401 AND 20230411 GROUP BY CODCIA  UNION ALL SELECT codcia, 0 AS subtot
          FROM LBPRDDAT/LO0850 WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas1." )
          GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
          WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T1
          LEFT JOIN (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT codcia, subtot 
          FROM LBPRDDAT/LO0850 WHERE MESPRO = ".$mesGraficas2." AND ANOPRO =".$anoGraficas2." UNION ALL SELECT codcia, 0 AS subtot
          FROM LBPRDDAT/LO0850 WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO= ".$mesGraficas2." AND ANOPRO=".$anoGraficas2." )
          GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
          WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T2 ON T2.CODCIA = T1.CODCIA
          LEFT JOIN (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT codcia, subtot 
          FROM LBPRDDAT/LO0850 WHERE MESPRO = ".$mesGraficas1." AND ANOPRO =".$anoGraficas2." UNION ALL SELECT codcia, 0 AS subtot
          FROM LBPRDDAT/LO0850 WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas2." )
          GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
          WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T3 ON T3.CODCIA = T1.CODCIA)";
      }else{
        $sqlGraficasMes="SELECT T1.CODCIA, T1.NOMCIA, T1.SUBTOT MES1, T2.SUBTOT MES2,T3.SUBTOT MES3 FROM (
          (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT CODCIA,SUM(SUBTOT) SUBTOT 
          FROM LBPRDDAT/LO0849 WHERE FECPRO BETWEEN ".$anoGraficas1.$mesGraficas1."01 AND ".$anoGraficas1.$mesGraficas1.$diagrafica." GROUP BY CODCIA  UNION ALL SELECT codcia, 0 AS subtot
          FROM LBPRDDAT/LO0850 WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas1." )
          GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
          WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T1
          LEFT JOIN (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT CODCIA,SUM(SUBTOT) SUBTOT
          FROM LBPRDDAT/LO0849 WHERE FECPRO BETWEEN ".$anoGraficas1.$mesGraficas2."01 AND ".$anoGraficas1.$mesGraficas2.$diagrafica." GROUP BY CODCIA  UNION ALL SELECT codcia, 0 AS subtot
          FROM LBPRDDAT/LO0850 WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO= ".$mesGraficas2." AND ANOPRO=".$anoGraficas1." )
          GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
          WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T2 ON T2.CODCIA = T1.CODCIA
          LEFT JOIN (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT CODCIA,SUM(SUBTOT) SUBTOT
          FROM LBPRDDAT/LO0849 WHERE FECPRO BETWEEN ".$anoGraficas2.$mesGraficas1."01 AND ".$anoGraficas2.$mesGraficas1.$diagrafica." GROUP BY CODCIA UNION ALL SELECT codcia, 0 AS subtot
          FROM LBPRDDAT/LO0850 WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas2." )
          GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
          WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T3 ON T3.CODCIA = T1.CODCIA)";
        
      }
      
      $resultM=odbc_exec($connIBM,$sqlGraficasMes); 
      while ($rowM= odbc_fetch_array($resultM)) { 
        $codMes=$rowM['CODCIA'];
        $venmes=$rowM['MES1'];
        if ((float)$venmes !=0) {
          if ($compFiltroP==1) {
            if (in_array($codMes, array(0,1))) {
              $compMesHonduras[]=$rowM['NOMCIA'];
              $venmesHonduras[] = (float)$venmes;
              $venmes1Honduras+=$rowM['MES1'];
              $venmes2Honduras+=$rowM['MES2'];
              $venmes3Honduras+=$rowM['MES3'];
            }
          } else if ($compFiltroP==2) {
          if (in_array($codMes, array(35, 47,57,52,63,64,72,74,20,22,56,59,65,68,75,76,85,70,73,78,82))) {
            $compMesHonduras[]=$rowM['NOMCIA'];
            $venmesHonduras[] = (float)$venmes;
            $venmes1Honduras+=$rowM['MES1'];
            $venmes2Honduras+=$rowM['MES2'];
            $venmes3Honduras+=$rowM['MES3'];
          }
        } else if ($compFiltroP==3) {
          if (in_array($codMes, array(49,66,69,71,86))) {
            $compMesHonduras[]=$rowM['NOMCIA'];
            $venmesHonduras[] = (float)$venmes;
            $venmes1Honduras+=$rowM['MES1'];
            $venmes2Honduras+=$rowM['MES2'];
            $venmes3Honduras+=$rowM['MES3'];
          }
        }else if ($compFiltroP==4) {
          if (in_array($codMes, array(48,53,62,61))) {
            $compMesHonduras[]=$rowM['NOMCIA'];
            $venmesHonduras[] = (float)$venmes;
            $venmes1Honduras+=$rowM['MES1'];
            $venmes2Honduras+=$rowM['MES2'];
            $venmes3Honduras+=$rowM['MES3'];
          }
        }else if ($compFiltroP==5) {
          if (in_array($codMes, array(83,87))) {
            $compMesHonduras[]=$rowM['NOMCIA'];
            $venmesHonduras[] = (float)$venmes;
            $venmes1Honduras+=$rowM['MES1'];
            $venmes2Honduras+=$rowM['MES2'];
            $venmes3Honduras+=$rowM['MES3'];
          }
        }else if ($compFiltroP==6) {
          if (in_array($codMes, array(60,80))) {
            $compMesHonduras[]=$rowM['NOMCIA'];
            $venmesHonduras[] = (float)$venmes;
            $venmes1Honduras+=$rowM['MES1'];
            $venmes2Honduras+=$rowM['MES2'];
            $venmes3Honduras+=$rowM['MES3'];
          }
        }else if ($compFiltroP==7) {
          if (in_array($codMes, array(81))) {
            $compMesHonduras[]=$rowM['NOMCIA'];
            $venmesHonduras[] = (float)$venmes;
            $venmes1Honduras+=$rowM['MES1'];
            $venmes2Honduras+=$rowM['MES2'];
            $venmes3Honduras+=$rowM['MES3'];
          }
        }
       }
      }
      if ($venmes==0) {
        if ($mesGraficas2==12) {
         $sqlMesesPasados="SELECT T2.CODCIA, T2.NOMCIA, T2.SUBTOT MES2,T3.SUBTOT MES3 FROM (
          (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT codcia, subtot 
          FROM LBPRDDAT/LO0850 WHERE MESPRO = ".$mesGraficas2." AND ANOPRO = ".$anoGraficas2." UNION ALL SELECT codcia, 0 AS subtot
          FROM LBPRDDAT/LO0850 WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO= ".$mesGraficas2." AND ANOPRO=".$anoGraficas2." )
          GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
          WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T2
          LEFT JOIN (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT codcia, subtot 
          FROM LBPRDDAT/LO0850 WHERE MESPRO = ".$mesGraficas1." AND ANOPRO = ".$anoGraficas2." UNION ALL SELECT codcia, 0 AS subtot
          FROM LBPRDDAT/LO0850 WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas2." )
          GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
          WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T3 ON T3.CODCIA = T2.CODCIA)";
          }else{
            $sqlMesesPasados="SELECT T2.CODCIA, T2.NOMCIA, T2.SUBTOT MES2,T3.SUBTOT MES3 FROM (
              (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT codcia, subtot 
              FROM LBPRDDAT/LO0850 WHERE MESPRO = ".$mesGraficas2." AND ANOPRO = ".$anoGraficas1." UNION ALL SELECT codcia, 0 AS subtot
              FROM LBPRDDAT/LO0850 WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO= ".$mesGraficas2." AND ANOPRO=".$anoGraficas1." )
              GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
              WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T2
              LEFT JOIN (SELECT T2.CODCIA CODCIA, T2.NOMCIA NOMCIA, SUM(SUBTOT) SUBTOT FROM(SELECT codcia, subtot 
              FROM LBPRDDAT/LO0850 WHERE MESPRO = ".$mesGraficas1." AND ANOPRO = ".$anoGraficas2." UNION ALL SELECT codcia, 0 AS subtot
              FROM LBPRDDAT/LO0850 WHERE NOT EXISTS (SELECT 1 FROM LBDESDAT/LO0850 WHERE MESPRO= ".$mesGraficas1." AND ANOPRO=".$anoGraficas2." )
              GROUP BY CODCIA) AS T1 INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA INNER JOIN LBPRDDAT/DETA1699 AS T3 ON T3.DETC90=T1.CODCIA
              WHERE T3.DETUSU='MARVIN' AND T3.DETPR1 = 'LO1512P' GROUP BY T2.CODCIA,T2.NOMCIA ORDER BY CODCIA) AS T3 ON T3.CODCIA = T2.CODCIA)";
          }
           $resultMeses=odbc_exec($connIBM,$sqlMesesPasados); 
           
           while ($rowMeses= odbc_fetch_array($resultMeses)) { 
            $codMeses=$rowMeses['CODCIA'];
            if ($compFiltroP==1) {
              if (in_array($codMeses, array(1))) {
                  $venmes2Honduras+=$rowMeses['MES2'];
                  $venmes3Honduras+=$rowMeses['MES3'];
              }
           }else if ($compFiltroP==2) {
                if (in_array($codMeses, array(35, 47,57,52,63,64,72,74,20,22,56,59,65,68,75,76,85,70,73,78,82))) {
                    $venmes2Honduras+=$rowMeses['MES2'];
                    $venmes3Honduras+=$rowMeses['MES3'];
                }
             }
             else if ($compFiltroP==3) {
              if (in_array($codMeses, array(49,66,69,71,86))) {
                  $venmes2Honduras+=$rowMeses['MES2'];
                  $venmes3Honduras+=$rowMeses['MES3'];
              }
           }
              else if ($compFiltroP==4) {
                  if (in_array($codMeses, array(48,53,62,61))) {
                      $venmes2Honduras+=$rowMeses['MES2'];
                      $venmes3Honduras+=$rowMeses['MES3'];
                    }
                }
              else if ($compFiltroP==5) {
                  if (in_array($codMeses, array(83,87))) {
                      $venmes2Honduras+=$rowMeses['MES2'];
                      $venmes3Honduras+=$rowMeses['MES3'];
                  }
              }
              else if ($compFiltroP==6) {
                if (in_array($codMeses, array(60,80))) {
                    $venmes2Honduras+=$rowMeses['MES2'];
                    $venmes3Honduras+=$rowMeses['MES3'];
                }
              }
              else if ($compFiltroP==7) {
                if (in_array($codMeses, array(81))) {
                    $venmes2Honduras+=$rowMeses['MES2'];
                    $venmes3Honduras+=$rowMeses['MES3'];
                }
             }
           }
      }
      $ventasdeldia=0; $ventasdelmes=0;
      $ventasdeldia=count($vendiaHonduras)>0 ? $vendiaHonduras[0]:0;
      $ventasdelmes=count($ventasMesGrafica)>0 ? $ventasMesGrafica[0]:0;

    ?>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
          <!-- if breadcrumb is single--><span>Inicio</span>
        </li>
        <li class="breadcrumb-item active"><span>Pagina Principal</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div class="body flex-grow-1 px-3">
    <div class="container-lg">
      <!--  <div class="d-flex justify-content-center">
            <div>
              <div class="card mb-4 text-white bg-primary me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Lunes</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>

            <div>
              <div class="card mb-4 text-white bg-primary  me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Martes</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>
    
            <div>
              <div class="card mb-4 text-white bg-primary  me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Miércoles</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>
         
            <div>
              <div class="card mb-4 text-white bg-primary  me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Jueves</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>
         
            <div>
              <div class="card mb-4 text-white bg-primary  me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Viernes</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>
      
            <div>
              <div class="card mb-4 text-white bg-primary  me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Sábado</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>
         
            <div>
              <div class="card mb-4 text-white bg-primary  me-1">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">Domingo</div>
                    <div>Users</div>
                  </div>
                </div>
              </div>
            </div>
      
          </div>-->
      <!-- /.row-->

      <div class="card">
        <div class="card-body">
          <form id="formGraficas" action="grafica-filtro.php" method="POST">
            <div class="row mb-2">
              <div class="col-sm-12 col-lg-6 mt-2">
                <label>Fecha:</label>
                <input type="date" class="form-control" name="fechagra" id="fechagra" data-date-format="dd/mm/yyyy"
                  onfocus="(this.type='date')" onkeydown="return false;">
              </div>
              <div class="col-sm-12 col-lg-6 mt-2">
                <label>País:</label>
                <select class="form-control" id="cbbMesgra" name="cbbMesgra">
                      <option value="1">Lovable de Honduras</option>
                      <option value="2">Tiendas Honduras</option>
                      <option value="3">Tiendas Guatemala</option>
                        <option value="4">Tiendas El Salvador</option>
                        <option value="5">Tiendas Nicaragua</option>
                        <option value="6">Tiendas Costa Rica</option>
                        <option value="7">Tiendas Republica Dominicana</option>
                        </select>  
                <input type="text" id="fechaCk10" name="fechaCk10" class="d-none"> 
              </div>
            </div>
          </form>
        </div>
      </div>
      <!--<div class="card mt-2">
          <div class="card-header"></div>
          <div class="card-body"><canvas id="GraficaBarra" class="mt-2 mb-2"></canvas></div>
          <div class="card-footer"></div>
        </div>-->

      <div class="padding-graficas mb-4">
        <div class="row mt-1">
          <!--HONDURAS-->
          <div class="col-12 col-md-12">
            <div class="row">
              <div class="col-12 col-md-12">
                <!--<div class="card bg-blck">
              <h2 class="text-center mt-2 text-light">Honduras</h2>
              <hr class="text-light">
             </div>-->
              <div class="card">
                    <div class="card-header">
                      <h4 class="text-center fw-bold" id="tituloGraficasVentas"> </h4>
                    </div>
                    <div class="card-body">
                      <div id="HonRow" class="row">
                        <?php
                            if ( $compFiltroP==1 ||$compFiltroP==7 ) {
                              echo '<div id="colHonDia"  class="justify-content-center col-12 col-lg-3">
                              <h5 class="mt-2 mb-1 text-center">Ventas del día</h5>
                              <canvas  id="HonDia" class="mt-3 mb-3" ></canvas>
                              <label class="form-control text-darkblue fw-bold fs-3 text-center mt-5 pt-2 pb-2">'.$_SESSION['MONE'].'. '.number_format($ventasdeldia,2, '.', ',').'</label>
                              </div>';
                              echo '<script> $("#HonDia").hide()</script>';
                            }else{
                              echo '<div id="colHonDia"  class="justify-content-center col-12 col-lg-3">
                              <h5 class="mt-2 mb-1 text-center">Ventas del día</h5>
                              <canvas  id="HonDia" class="mt-3 mb-3" ></canvas>
                              </div>';
                            }

                            if ( $compFiltroP==1 ||$compFiltroP==7 ) {
                              echo '<div id="colHonMes" class="col-12 col-lg-3">
                            <h5 class="mt-2 mb-1 text-center">Ventas del Mes</h5>
                            <canvas  id="HonMes1" class="mt-3 mb-3" ></canvas>
                            <label class="form-control text-pink fw-bold fs-3 text-center mt-5 pt-2 pb-2">'.$_SESSION['MONE'].'. '.number_format($ventasdelmes,2, '.', ',').'</label>
                            </div>';
                              echo '<script> $("#HonMes1").hide()</script>';
                            }else{
                              echo '<div id="colHonMes" class="col-12 col-lg-3">
                              <h5 class="mt-2 mb-1 text-center">Ventas del Mes</h5>
                              <canvas  id="HonMes1" class="mt-3 mb-3" ></canvas>
                              </div>';
                            }
                           
// <h6 class="mt-2 mb-1 text-center responsive-font-example ">'.obtenerNombreMes($mesGraficas1).' '.$anoGraficas1.' VS '.obtenerNombreMes($mesGraficas2).' '.$anoGraficas2.'</h6>
                            if ($mesGraficas2==12) {
                              echo '<div id="colHonMes2" class="col-12 col-lg-3">
                              
                              <div class="input-group mt-4 mb-md-2 mt-md-2">
                                <input class="me-2" type="checkbox" value="1" id="fechaCk" name="fechaCk">
                                <label for="productosCk">Filtrar hasta la fecha: </label>
                              </div>
                            <div class="d-flex justify-content-evenly">
                              <div>
                              <label class="responsive-font-example fw-bold">'.obtenerNombreMes($mesGraficas1).' '.$anoGraficas1.'</label>
                              <div class="mt-3" style="display:inline-block; width:30px; height:20px; background-color:rgba(25, 170, 222,0.6);"></div>
                              </div>
                              <div >
                              <label class="responsive-font-example fw-bold">'.obtenerNombreMes($mesGraficas2).' '.$anoGraficas2.'</label>
                              <div class="mt-3" style="display:inline-block; width:30px; height:20px; background-color:rgba(222, 84, 44,0.6);"></div>
                              </div>
                            </div>
                          <canvas id="HonMes2" ></canvas>
                          </div>';
                            }else{
                          //  <h6 class="mt-2 mb-1 text-center responsive-font-example">'.obtenerNombreMes($mesGraficas1).' '.$anoGraficas1.' VS '.obtenerNombreMes($mesGraficas2).' '.$anoGraficas1.'</h6>
                              echo '<div id="colHonMes2" class="col-12 col-lg-3">
                              <div class="input-group mt-4 mb-md-2 mt-md-2">
                                <input class="me-2" type="checkbox" value="1" id="fechaCk" name="fechaCk">
                                <label for="productosCk">Filtrar hasta la fecha: <b>'.$diacbb.'/'.$mesgrafica.'/'.$aniografica.'</b></label>
                              </div>
                            <div class="d-flex justify-content-evenly">
                              <div>
                              <label class="responsive-font-example fw-bold">'.obtenerNombreMes($mesGraficas1).' '.$anoGraficas1.'</label>
                              <div class="mt-3" style="display:inline-block; width:30px; height:20px; background-color:rgba(25, 170, 222,0.6);"></div>
                              </div>
                              <div >
                              <label class="responsive-font-example fw-bold">'.obtenerNombreMes($mesGraficas2).' '.$anoGraficas1.'</label>
                              <div class="mt-3" style="display:inline-block; width:30px; height:20px; background-color:rgba(222, 84, 44,0.6);"></div>
                              </div>
                            </div>
                          <canvas id="HonMes2" ></canvas>
                          </div>';
                            }
                        //<h6 class="mt-2 mb-1 text-center responsive-font-example">'.obtenerNombreMes($mesGraficas1).' '.$anoGraficas1.' VS '.obtenerNombreMes($mesGraficas1).' '.$anoGraficas2.'</h6>
                            echo ' <div id="colHonMes3" class="col-12 col-lg-3">
                            <div class=" mb-md-4 pb-md-3">
                                
                              </div>
                            <div class="d-flex justify-content-evenly">
                              <div>
                              <label class="responsive-font-example fw-bold" >'.obtenerNombreMes($mesGraficas1).' '.$anoGraficas1.'</label>
                              <div class="mt-3" style="display:inline-block; width:30px; height:20px; background-color:rgba(25, 170, 222,0.6);"></div>
                              </div>
                              <div >
                              <label class="responsive-font-example fw-bold">'.obtenerNombreMes($mesGraficas1).' '.$anoGraficas2.'</label>
                              <div class="mt-3" style="display:inline-block; width:30px; height:20px; background-color:rgba(222, 84, 44,0.6);"></div>
                              </div>
                            </div>
                            <canvas id="HonMes3" ></canvas>
                            </div>';
                        
                          ?>
                    </div>
                  </div>
                  <!-- <div class="card-footer"></div>-->
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
     

    </div>
    <!--CONTAINER LG-->
  </div>
  <!--BODY-->
  <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
    <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

  <?php include 'graficas.php';?>
  <script>
  
    function obtenerNombreMes(numeroMes) {
              const nombresMes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
              return nombresMes[numeroMes - 1];
            }
            var Mes1 = obtenerNombreMes(<?php echo $mesGraficas1; ?>);
            var Mes2 = obtenerNombreMes(<?php echo $mesGraficas2; ?>);
            var Anio1 = <?php echo $anoGraficas1; ?>;
            var Anio2 = <?php echo $anoGraficas2; ?>;
            var compFiltro = <?php echo $compFiltroP; ?>;

    $(document).ready(function () {
      $('#fechaCk').prop('checked', <?php echo  $fechacheck ?>);
      $("#cbbMesgra").val(compFiltro);
      $("#tituloGraficasVentas").empty();
      $("#tituloGraficasVentas").append($( "#cbbMesgra option:selected" ).text());
      $("#fechagra").val(formatoFecha("<?php echo $fechaGraficas; ?>"));

    });
    function formatoFecha(fecha) {
      let year = fecha.substring(0, 4);
      let month = fecha.substring(4, 6);
      let day = fecha.substring(6, 8);
      return year + "-" + month + "-" + day;
    }
  </script>
</body>
<div class="spinner-wrapper">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>

</html>