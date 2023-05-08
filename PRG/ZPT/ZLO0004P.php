<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>
<body>
<div class="spinner-wrapper">
    <div class="spinner-border text-danger" role="status">
    </div>
  </div>
<?php
      include '../layout-prg.php';
      $mes_actual=date("m")-1;
      $ano_actual=date("Y");
           $mesfiltro=isset($_SESSION['mesfiltro2'])? $_SESSION['mesfiltro2']: $mes_actual; 
           $anofiltro=isset($_SESSION['anofiltro2'])? $_SESSION['anofiltro2']: $ano_actual; 
           $paisfiltro=isset($_SESSION['paisfiltro2'])? $_SESSION['paisfiltro2']: 1; 
           $cia="";
           switch ($paisfiltro) {
            case 1:
              $cia="CODCIA IN (35,47,57,64,63,72,52,74,75,68,56,76,59,85,65,70,73,78,82,20,22)";
              break;
              case 2:
                $cia="CODCIA IN (49,66,69,71,86)";
                break;
                case 3:
                  $cia="CODCIA IN (48,53,61,62)";
                  break;
                  case 4:
                    $cia="CODCIA IN (60,80)";
                    break;
                    case 5:
                      $cia="CODCIA IN (83,87)";
                      break;
                      case 6:
                        $cia="CODCIA IN (81)";
                        break;
            
            default:
              # code...
              break;
           }

     $sqlmeses="SELECT T4.CODSEC,T1.CODCIA,NOMCIA,PRV12M,PRV06M,MIN12M,M1,M2,M3 FROM( 
      SELECT M1.CODCIA, M1.PRV12M,M1.PRV06M, M1.MIN12M,M1.MIN06M M1, M2.MIN06M M2, M3.MIN06M M3 FROM (
      SELECT CODCIA,PRV12M,PRV06M,MIN12M,MIN06M FROM lbprddat/LO1960 WHERE
      ".$cia." and ANOPRO=".$anofiltro." AND MESPRO=".$mesfiltro.") AS M1
      INNER JOIN (
      SELECT CODCIA,MIN06M FROM lbprddat/LO1960 WHERE
      ".$cia." and ANOPRO=".$anofiltro." AND MESPRO=".($mesfiltro-1).") AS M2 ON M1.CODCIA=M2.CODCIA  
      INNER JOIN (
      SELECT CODCIA,MIN06M FROM lbprddat/LO1960 WHERE
      ".$cia." and ANOPRO=".$anofiltro." AND MESPRO=".($mesfiltro-2).") AS M3 ON M1.CODCIA=M3.CODCIA)AS T1
      INNER JOIN LBPRDDAT/LO0705 AS T2 ON T1.CODCIA = T2.CODCIA
      INNER JOIN LBPRDDAT/DETA16 AS T3 ON T3.DETC90 = T1.CODCIA
      INNER JOIN LBPRDDAT/LO0686 AS T4 ON T4.CODCIA = T1.CODCIA
      WHERE T3.DETUSU ='".$_SESSION["CODUSU"]."' AND T3.DETPR1 = 'LO1512P'
      ORDER BY T4.CODSEC";
      
      $resultMeses=odbc_exec($connIBM,$sqlmeses); 
     
?>
     <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Producto Terminado</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0004P</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div id="body-div" class="body flex-grow-3">
          <div class="card mb-5">
            <div class="card-header">
              <h1 class="fs-4 mb-1 mt-2 text-center">Meses de inventario Tiendas</h1>
            </div>
            <div class="card-body">
          <div class="position-relative">
              <form id="formFiltros" action="../../assets/php/ZPT/ZLO0004P/filtrosLogica.php" method="POST">
                <div class="row mb-2">
                <div class="col-sm-12 col-lg-6 mt-2">
                        <label>País:</label>
                        <select class="form-select  mt-1" id="cbbPais" name="cbbPais">
                          <option value="1">Honduras</option>
                          <option value="2">Guatemala</option>
                          <option value="3">El Salvador</option>
                          <option value="4">Costa Rica</option>
                          <option value="5">Nicaragua</option>
                          <option value="6">Rep. Dominicana</option>
                        </select>
                      </div>
                      <div class="col-sm-12 col-lg-3 mt-2">
                        <label>Año:</label>
                        <select class="form-select  mt-1" id="cbbAno" name="cbbAno">
                          <?php
                                $anio_actual = date('Y');
                                for ($i = $anio_actual; $i >= 2009; $i--) {
                                echo "<option value='$i'>$i</option>";
                                }
                            ?>
                        </select>
                      </div>
                      <div class="col-sm-12 col-lg-3 mt-2">
                        <label>Mes:</label>
                        <select class="form-select mt-1" id="cbbMes" name="cbbMes">
                          <option value="1">Enero</option>
                          <option value="2">Febrero</option>
                          <option value="3">Marzo</option>
                          <option value="4">Abril</option>
                          <option value="5">Mayo</option>
                          <option value="6">Junio</option>
                          <option value="7">Julio</option>
                          <option value="8">Agosto</option>
                          <option value="9">Septiembre</option>
                          <option value="10">Octubre</option>
                          <option value="11">Noviembre</option>
                          <option value="12">Diciembre</option>
                        </select>
                      </div>
                </div>
              </form>
              </div>
              <hr>
                <div class="demo">
                    <ul class="tablist" role="tablist">
                        <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1" aria-selected="true" role="tab" tabindex="0">Meses</li>
                        <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false" role="tab" tabindex="0">Unidades</li>
                    </ul>
                    <div id="panel1" class="tablist__panel p-3" aria-labelledby="tab1" aria-hidden="false" role="tabpanel">
                    <div class="table-responsive">
                          <table id="myTableInvMeses" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th class="d-none">ID</th>
                                    <th>Punto de Venta</th>
                                    <th>Prom. Vta 12M</th>
                                    <th>Prom. Vta 6M</th>
                                    <th>Meses Inv.12M</th>
                                    <th>Meses Inv.6M</th>
                                    <th>Meses Inv.6M (Mes anterior)</th>
                                    <th>Meses Inv.6M (2 Meses anterior)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   while($rowMeses = odbc_fetch_array($resultMeses)){
                                    print '<tr>';
                                      print '<td class="d-none">'.$rowMeses['CODSEC'].'</td>';
                                      print '<td>'.$rowMeses['NOMCIA'].'</td>';
                                      print '<td>'.$rowMeses['PRV12M'].'</td>';
                                      print '<td>'.$rowMeses['PRV06M'].'</td>';
                                      print '<td>'.$rowMeses['MIN12M'].'</td>';
                                      print '<td>'.$rowMeses['M1'].'</td>';
                                      print '<td>'.$rowMeses['M2'].'</td>';
                                      print '<td>'.$rowMeses['M3'].'</td>';
                                    print '</tr>';
                                   }
                                ?>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div id="panel2" class="tablist__panel is-hidden" aria-labelledby="tab2" aria-hidden="true" role="tabpanel">
                      
                    </div>
          </div>
          </div>
          <div class="card-footer">

          </div>
        </div>
        </div>
      </div>
      
    </div>
    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
      <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
      </div>
     <script>
      $( document ).ready(function() {
            $("#cbbMes").val("<?php echo $mesfiltro; ?>");
            $("#cbbPais").val(<?php echo $paisfiltro;  ?>); 
            $("#cbbAno").val(<?php echo $anofiltro;  ?>); 
              $("#cbbPais, #cbbAno, #cbbMes").change(function() {
                $("#formFiltros").submit();
               });
        });
     </script>
    
</body>
</html>