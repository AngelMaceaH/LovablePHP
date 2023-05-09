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
    $mes_actual=date("m");
    $ano_actual=date("Y");
      include '../layout-prg.php';
      include 'ZLO0003PAsql.php';
?>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
          <span>Modulo de facturacion</span>
        </li>
        <li class="breadcrumb-item active"><span>ZLO0003PA</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div id="body-div" class="body flex-grow-3">
    <div class="card mb-5">
      <div class="card-header">
      <h1 class="fs-4 mb-1 mt-2 text-center">Consulta Comp. tiendas por marca, pais y meses</h1>
      </div>
      <div class="card-body">
            <div class="position-relative">
              <form id="formFiltros" action="../../assets/php/ZFA/ZLO0003P/filtrosLogicaA.php" method="POST">
                <div class="row">
                <div class="col-sm-12 mt-2">
                        <label>Marca:</label>
                        <select class="form-select  mt-1" id="cbbMarca" name="cbbMarca">
                        <option value="0">TODAS LAS MARCAS</option>
                          <?php
                           while($rowDesc = odbc_fetch_array($resultDescripcion)){
                            echo "<option value='".$rowDesc['DESCO1']."'>".$rowDesc['DESDES']."</option>";
                           }
                            ?>
                        </select>
                      </div>
                </div>
                <div class="row mb-2">
                  <div class="col-sm-12 col-lg-6 mt-2">
                    <div class="row">
                      <div class="col-sm-12 col-lg-6">
                        <label>Año de proceso:</label>
                        <select class="form-select  mt-1" id="cbbAno" name="cbbAno">
                          <?php
                                            $anio_actual = date('Y');
                                            for ($i = $anio_actual; $i >= 2009; $i--) {
                                            echo "<option value='$i'>$i</option>";
                                            }
                                        ?>
                        </select>
                      </div>
                      <div class="col-sm-12 col-lg-6">
                        <label>Mes de proceso:</label>
                        <select class="form-select mt-1" id="cbbMes" name="cbbMes">
                          <option value="01">Enero</option>
                          <option value="02">Febrero</option>
                          <option value="03">Marzo</option>
                          <option value="04">Abril</option>
                          <option value="05">Mayo</option>
                          <option value="06">Junio</option>
                          <option value="07">Julio</option>
                          <option value="08">Agosto</option>
                          <option value="09">Septiembre</option>
                          <option value="10">Octubre</option>
                          <option value="11">Noviembre</option>
                          <option value="12">Diciembre</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-6 mt-4">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="1" checked>
                      <label class="form-check-label" for="flexRadioDefault1">
                        Solo mes de proceso
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="2" >
                      <label class="form-check-label" for="flexRadioDefault2">
                        Acumulado hasta mes de proceso
                      </label>
                    </div>
                  </div>
                </div>
              </form>
              </div>
              <hr>
         
            <div class="btn-group flex-wrap d-flex justify-content-center justify-content-md-start mb-2 mt-2" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check " name="btncols" id="btncolHon" autocomplete="off" checked>
                <label class="btn btn-outline-secondary responsive-font-example pt-3 pb-3 text-black" for="btncolHon"><b>Honduras</b></label>

                <input type="radio" class="btn-check" name="btncols"  id="btncolGua" autocomplete="off">
                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black" for="btncolGua" id="btnnradio2"><b>Guatemala</b></label>

                <input type="radio" class="btn-check" name="btncols" id="btncolSal" autocomplete="off">
                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black" for="btncolSal"><b>El Salvador</b></label>

                <input type="radio" class="btn-check" name="btncols" id="btncolCos" autocomplete="off" >
                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black" for="btncolCos"><b>Costa Rica</b></label>
            </div>
            <div class="btn-group flex-wrap d-flex justify-content-center justify-content-md-start mb-2 mt-2" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btncols" id="btncolNic" autocomplete="off" >
                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black" for="btncolNic"><b>Nicaragua</b></label>
                
                <input type="radio" class="btn-check" name="btncols" id="btncolRep" autocomplete="off" >
                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black" for="btncolRep"><b>Rep. Dominicana</b></label>

                <input type="radio" class="btn-check" name="btncols" id="btncolTot" autocomplete="off" >
                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black" for="btncolTot"><b>Total</b></label>
               
            </div>

         
              <div class="table-responsive">
             
              <table id="myTableMarcas" class="table stripe table-hover " style="width:100%">
                <thead>
                <tr>
                  <th colspan="2"> </th>
                  <th colspan="4" class="text-center fs-4" id="Enca" >Honduras</th>
                </tr>
                  <tr>
                    <th>ID</th>
                    <th class="text-start responsive-font-example">Marcas</th>
                    <th id="honth1" class="text-start responsive-font-example">Unidades</th>
                    <th id="honth2" class="text-start responsive-font-example">%</th>
                    <th id="honth3" class="text-start responsive-font-example">Valor $</th>
                    <th id="honth4" class="text-start responsive-font-example">%</th>

                    <th id="guath1" class="d-none text-start responsive-font-example">Unidades</th>
                    <th id="guath2" class="d-none text-start responsive-font-example">%</th>
                    <th id="guath3" class="d-none text-start responsive-font-example">Valor $</th>
                    <th id="guath4" class="d-none text-start responsive-font-example">%</th>

                    <th id="salth1" class="d-none text-start responsive-font-example">Unidades</th>
                    <th id="salth2" class="d-none text-start responsive-font-example">%</th>
                    <th id="salth3" class="d-none text-start responsive-font-example">Valor $</th>
                    <th id="salth4" class="d-none text-start responsive-font-example">%</th>

                    <th id="costh1" class="d-none text-start responsive-font-example">Unidades</th>
                    <th id="costh2" class="d-none text-start responsive-font-example">%</th>
                    <th id="costh3" class="d-none text-start responsive-font-example">Valor $</th>
                    <th id="costh4" class="d-none text-start responsive-font-example">%</th>
                    
                    <th id="repth1" class="d-none text-start responsive-font-example">Unidades</th>
                    <th id="repth2" class="d-none text-start responsive-font-example">%</th>
                    <th id="repth3" class="d-none text-start responsive-font-example">Valor$</th>
                    <th id="repth4" class="d-none text-start responsive-font-example">%</th>

                    <th id="nicth1" class="d-none text-start responsive-font-example">Unidades</th>
                    <th id="nicth2" class="d-none text-start responsive-font-example">%</th>
                    <th id="nicth3" class="d-none text-start responsive-font-example">Valor $</th>
                    <th id="nicth4" class="d-none text-start responsive-font-example">%</th>
                    
                    <th id="totth1" class="d-none text-start responsive-font-example">Unidades</th>
                    <th id="totth2" class="d-none text-start responsive-font-example">%</th>
                    <th id="totth3" class="d-none text-start responsive-font-example">Valor $</th>
                    <th id="totth4" class="d-none text-start responsive-font-example">%</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $totunHon=0; $totvalHon=0; $porunHon=0; $portotunHon=0; $porvalHon=0; $portotvalHon=0;
                  $totunGua=0; $totvalGua=0; $porunGua=0; $portotunGua=0; $porvalGua=0; $portotvalGua=0;
                  $totunSal=0; $totvalSal=0; $porunSal=0; $portotunSal=0; $porvalSal=0; $portotvalSal=0;
                  $totunCos=0; $totvalCos=0; $porunCos=0; $portotunCos=0; $porvalCos=0; $portotvalCos=0;
                  $totunRep=0; $totvalRep=0; $porunRep=0; $portotunRep=0; $porvalRep=0; $portotvalRep=0;
                  $totunNic=0; $totvalNic=0; $porunNic=0; $portotunNic=0; $porvalNic=0; $portotvalNic=0;
                  $totunTot=0; $totvalTot=0; $porunTot=0; $portotunTot=0; $porvalTot=0; $portotvalTot=0; 
                  $totuniMarca=0; $totvalMarca=0;
                  
                  $registrosMarcas = array();
                  while($rowMarcas = odbc_fetch_array($resultMarcas)){
                    $registro = array(
                      "HISM38" => $rowMarcas['HISM38'],
                      "DESDES" => $rowMarcas['DESDES'],
                      "CANHON" => $rowMarcas['CANHON'],
                      "VALHON" => $rowMarcas['VALHON'],
                      "CANGUA" => $rowMarcas['CANGUA'],
                      "VALGUA" => $rowMarcas['VALGUA'],
                      "CANCOS" => $rowMarcas['CANCOS'],
                      "VALCOS" => $rowMarcas['VALCOS'],
                      "CANSAL" => $rowMarcas['CANSAL'],
                      "VALSAL" => $rowMarcas['VALSAL'],
                      "CANREP" => $rowMarcas['CANREP'],
                      "VALREP" => $rowMarcas['VALREP'],
                      "CANNIC" => $rowMarcas['CANNIC'],
                      "VALNIC" => $rowMarcas['VALNIC']    
                    );
                    $registrosMarcas[] = $registro;
                  }
                  foreach($registrosMarcas as $rowMarcas){
                    //CALCULO DE TOTALES POR PAIS

                    //HONDURAS
                    $totunHon+=$rowMarcas['CANHON'];
                    $totvalHon+=(($rowMarcas['VALHON']!=0)? ($rowMarcas['VALHON']/$factorL):0);
                    //GUATEMALA
                    $totunGua+=$rowMarcas['CANGUA'];
                    $totvalGua+= (($rowMarcas['VALGUA']!=0)? ($rowMarcas['VALGUA']/$factorQ):0);
                   
                    //EL SALVADOR
                    $totunSal+=$rowMarcas['CANSAL'];
                    $totvalSal+=(($rowMarcas['VALSAL']!=0)? ($rowMarcas['VALSAL']/1):0);
                    
                     //COSTA RICA
                     $totunCos+=$rowMarcas['CANCOS'];
                     $totvalCos+= (($rowMarcas['VALCOS']!=0)? ($rowMarcas['VALCOS']/$factorC):0);
                    
                     //REPUBLICA DOMINICANA 
                     $totunRep+=$rowMarcas['CANREP'];
                     $totvalRep+=(($rowMarcas['VALREP']!=0)? ($rowMarcas['VALREP']/$factorP):0);
                     
                     //NICARAGUA
                     $totunNic+=$rowMarcas['CANNIC'];
                     $totvalNic+=(($rowMarcas['VALNIC']!=0)? ($rowMarcas['VALNIC']/1):0);
                     
                     //TOTALTES
                     $totunTot=$totunHon+$totunGua+$totunSal+$totunCos+$totunRep+$totunNic;
                     $totvalTot=$totvalHon+$totvalGua+$totvalSal+$totvalCos+$totvalRep+$totvalNic;
                  }

                  foreach($registrosMarcas as $rowMarcas){                
                    print '<tr>';
                    print '<td>'.$rowMarcas['HISM38'].'</td>';
                    print '<td class="text-darkblue fw-bold responsive-font-example">'.$rowMarcas['DESDES'].'</td>';
                    //HONDURAS
                    $porunHon=(($rowMarcas['CANHON']!=0)?(($rowMarcas['CANHON']/$totunHon)*100):0);
                    $portotunHon=($totunHon/$totunTot)*100;
                    $porvalHon=(($rowMarcas['VALHON']!=0)?((($rowMarcas['VALHON']/$factorL)/$totvalHon)*100):0);
                    $portotvalHon=($totvalHon/$totvalTot)*100;
                    print '<td id="hontd1" class="fw-bold responsive-font-example">'.(($rowMarcas['CANHON']==0)?' ':number_format( $rowMarcas['CANHON'],0)).'</td>';
                    print '<td id="hontd2" class="responsive-font-example">'.(($porunHon==0)?' ':number_format( $porunHon,2)).'</td>';
                    print '<td id="hontd3" class="fw-bold responsive-font-example">'.(($rowMarcas['VALHON']==0)?' ':number_format( $rowMarcas['VALHON'],2)).'</td>';
                    print '<td id="hontd4" class="responsive-font-example">'.(($porvalHon==0)?' ':number_format( $porvalHon,2)).'</td>';
                    //GUATEMALA
                    $porunGua=(($rowMarcas['CANGUA']!=0)?(($rowMarcas['CANGUA']/$totunGua)*100):0);
                    $portotunGua=($totunGua/$totunTot)*100;
                    $porvalGua=(($rowMarcas['VALGUA']!=0)?((($rowMarcas['VALGUA']/$factorQ)/$totvalGua)*100):0);
                    
                    $portotvalGua=($totvalGua/$totvalTot)*100;
                    print '<td id="guatd1" class="fw-bold responsive-font-example">'.(($rowMarcas['CANGUA']==0)?' ':number_format( $rowMarcas['CANGUA'],0)).'</td>';
                    print '<td id="guatd2" class="responsive-font-example">'.(($porunGua==0)?' ':number_format( $porunGua,2)).'</td>';
                    print '<td id="guatd3" class="fw-bold responsive-font-example">'.(($rowMarcas['VALGUA']==0)?' ':number_format( $rowMarcas['VALGUA'],2)).'</td>';
                    print '<td id="guatd4" class="responsive-font-example">'.(($porvalGua==0)?' ':number_format( $porvalGua,2)).'</td>';
                    //EL SALVADOR
                    
                    $porunSal=(($rowMarcas['CANSAL']!=0)?(($rowMarcas['CANSAL']/$totunSal)*100):0);
                    $portotunSal=($totunSal/$totunTot)*100;
                    $porvalSal=(($rowMarcas['VALSAL']!=0)?((($rowMarcas['VALSAL']/1)/$totvalSal)*100):0);
                    $portotvalSal=($totvalSal/$totvalTot)*100;
                    print '<td id="saltd1" class="fw-bold responsive-font-example">'.(($rowMarcas['CANSAL']==0)?' ':number_format( $rowMarcas['CANSAL'],0)).'</td>';
                    print '<td id="saltd2" class="responsive-font-example">'.(($porunSal==0)?' ':number_format( $porunSal,2)).'</td>';
                    print '<td id="saltd3" class="fw-bold responsive-font-example">'.(($rowMarcas['VALSAL']==0)?' ':number_format( $rowMarcas['VALSAL'],2)).'</td>';
                    print '<td id="saltd4" class="responsive-font-example">'.(($porvalSal==0)?' ':number_format( $porvalSal,2)).'</td>';
                    //COSTA RICA
                    $porunCos=(($rowMarcas['CANCOS']!=0)?(($rowMarcas['CANCOS']/$totunCos)*100):0);
                    $portotunCos=($totunCos/$totunTot)*100;
                    $porvalCos=(($rowMarcas['VALCOS']!=0)?((($rowMarcas['VALCOS']/$factorC)/$totvalCos)*100):0);
                    
                    $portotvalCos=($totvalCos/$totvalTot)*100;
                    print '<td id="costd1" class="fw-bold responsive-font-example">'.(($rowMarcas['CANCOS']==0)?' ':number_format( $rowMarcas['CANCOS'],0)).'</td>';
                    print '<td id="costd2" class="responsive-font-example">'.(($porunCos==0)?' ':number_format( $porunCos,2)).'</td>';
                    print '<td id="costd3" class="fw-bold responsive-font-example">'.(($rowMarcas['VALCOS']==0)?' ':number_format( $rowMarcas['VALCOS'],2)).'</td>';
                    print '<td id="costd4" class="responsive-font-example">'.(($porvalCos==0)?' ':number_format( $porvalCos,2)).'</td>';
                    //REPUBLICA DOMINICANA
                    $porunRep=(($rowMarcas['CANREP']!=0)?(($rowMarcas['CANREP']/$totunRep)*100):0);
                    $portotunRep=($totunRep/$totunTot)*100;
                    $porvalRep=(($rowMarcas['VALREP']!=0)?((($rowMarcas['VALREP']/$factorP)/$totvalRep)*100):0);
                    $portotvalRep=($totvalRep/$totvalTot)*100;
                    print '<td id="reptd1" class="fw-bold responsive-font-example">'.(($rowMarcas['CANREP']==0)?' ':number_format( $rowMarcas['CANREP'],0)).'</td>';
                    print '<td id="reptd2" class="responsive-font-example">'.(($porunRep==0)?' ':number_format( $porunRep,2)).'</td>';
                    print '<td id="reptd3" class="fw-bold responsive-font-example">'.(($rowMarcas['VALREP']==0)?' ':number_format( $rowMarcas['VALREP'],2)).'</td>';
                    print '<td id="reptd4" class="responsive-font-example">'.(($porvalRep==0)?' ':number_format( $porvalRep,2)).'</td>';
                    //NICARAGUA
                    $porunNic=(($rowMarcas['CANNIC']!=0)?(($rowMarcas['CANNIC']/$totunNic)*100):0);
                    
                    $portotunNic=($totunNic/$totunTot)*100;
                    $porvalNic= (($rowMarcas['VALNIC']!=0)?((($rowMarcas['VALNIC']/1)/$totvalNic)*100):0);
                   
                    $portotvalNic=($totvalNic/$totvalTot)*100;
                    print '<td id="nictd1" class="fw-bold responsive-font-example">'.(($rowMarcas['CANNIC']==0)?' ':number_format( $rowMarcas['CANNIC'],0)).'</td>';
                    print '<td id="nictd2" class="responsive-font-example">'.(($porunNic==0)?' ':number_format( $porunNic,2)).'</td>';
                    print '<td id="nictd3" class="fw-bold responsive-font-example">'.(($rowMarcas['VALNIC']==0)?' ':number_format( $rowMarcas['VALNIC'],2)).'</td>';
                    print '<td id="nictd4" class="responsive-font-example">'.(($porvalNic==0)?' ':number_format( $porvalNic,2)).'</td>';
                     //TOTALES
                     $totuniMarca=$rowMarcas['CANHON']+$rowMarcas['CANGUA']+$rowMarcas['CANSAL']+$rowMarcas['CANCOS']+$rowMarcas['CANREP']+$rowMarcas['CANNIC'];
                     $totvalMarca=(($rowMarcas['VALHON']!=0)?($rowMarcas['VALHON']/$factorL):0)+
                                  (($rowMarcas['VALGUA']!=0)?($rowMarcas['VALGUA']/$factorQ):0)+
                                  (($rowMarcas['VALSAL']!=0)?($rowMarcas['VALSAL']/1):0)+
                                  (($rowMarcas['VALCOS']!=0)?($rowMarcas['VALCOS']/$factorC):0)+
                                  (($rowMarcas['VALREP']!=0)?($rowMarcas['VALREP']/$factorP):0)+
                                  (($rowMarcas['VALNIC']!=0)?($rowMarcas['VALNIC']/1):0);
                     $porunTot=(($totuniMarca/$totunTot)*100);
                     $porvalTot=(($totvalMarca/$totvalTot)*100);

                     print '<td id="tottd1" class="fw-bold responsive-font-example">'.(($totuniMarca==0)?' ':number_format( $totuniMarca,0)).'</td>';
                     print '<td id="tottd2" class="responsive-font-example">'.(($porunTot==0)?' ':number_format( $porunTot,2)).'</td>';
                     print '<td id="tottd3" class="fw-bold responsive-font-example">'.(($totvalMarca==0)?' ':number_format( $totvalMarca,2)).'</td>';
                     print '<td id="tottd4" class="responsive-font-example">'.(($porvalTot==0)?' ':number_format( $porvalTot,2)).'</td>';
 
                    print '</tr>';

                  }
                    //
                    print '<tr>';
                    print '<td>999999</td>';
                    print '<td><b></b></td>';
                    print '<td id="hontd1" class="fw-bold"></td>';
                    print '<td id="hontd2"></td>';
                    print '<td id="hontd3" class="fw-bold"></td>';
                    print '<td id="hontd4"></td>';
                    print '<td id="guatd1" class="fw-bold"></td>';
                    print '<td id="guatd2"></td>';
                    print '<td id="guatd3" class="fw-bold"></td>';
                    print '<td id="guatd4"></td>';
                    print '<td id="saltd1" class="fw-bold"></td>';
                    print '<td id="saltd2"></td>';
                    print '<td id="saltd3" class="fw-bold"></td>';
                    print '<td id="saltd4"></td>';
                    print '<td id="costd1" class="fw-bold"></td>';
                    print '<td id="costd2"></td>';
                    print '<td id="costd3" class="fw-bold"></td>';
                    print '<td id="costd4"></td>';
                    print '<td id="reptd1" class="fw-bold"></td>';
                    print '<td id="reptd2"></td>';
                    print '<td id="reptd3" class="fw-bold"></td>';
                    print '<td id="reptd4"></td>';
                    print '<td id="nictd1" class="fw-bold"></td>';
                    print '<td id="nictd2"></td>';
                    print '<td id="nictd3" class="fw-bold"></td>';
                    print '<td id="nictd4"></td>';
                    print '<td id="tottd1" class="fw-bold"></td>';
                    print '<td id="tottd2"></td>';
                    print '<td id="tottd3" class="fw-bold"></td>';
                    print '<td id="tottd4"></td>';
                    print '</tr>';
                    print '<tr>';

                    print '<td>1000000</td>';
                    print '<td class=" responsive-font-example"><b>TOTAL FINAL</b></td>';
                    //HONDURAS
                    print '<td id="hontd1" class="fw-bold responsive-font-example">'.number_format( $totunHon,0).'</td>';
                    print '<td id="hontd2" class="fw-bold responsive-font-example">'.number_format( $portotunHon,2).'</td>';
                    print '<td id="hontd3" class="fw-bold responsive-font-example">'.number_format( $totvalHon,2).'</td>';
                    print '<td id="hontd4" class="fw-bold responsive-font-example">'.number_format( $portotvalHon,2).'</td>';
                    //GUATEMALA
                    print '<td id="guatd1" class="fw-bold responsive-font-example">'.number_format( $totunGua,0).'</td>';
                    print '<td id="guatd2" class="fw-bold responsive-font-example">'.number_format( $portotunGua,2).'</td>';
                    print '<td id="guatd3" class="fw-bold responsive-font-example">'.number_format( $totvalGua,2).'</td>';
                    print '<td id="guatd4" class="fw-bold responsive-font-example">'.number_format( $portotvalGua,2).'</td>';
                    //EL SALVADOR
                    print '<td id="saltd1" class="fw-bold responsive-font-example">'.number_format( $totunSal,0).'</td>';
                    print '<td id="saltd2" class="fw-bold responsive-font-example">'.number_format( $portotunSal,2).'</td>';
                    print '<td id="saltd3" class="fw-bold responsive-font-example">'.number_format( $totvalSal,2).'</td>';
                    print '<td id="saltd4" class="fw-bold responsive-font-example">'.number_format( $portotvalSal,2).'</td>';
                    //COSTA RICA
                    print '<td id="costd1" class="fw-bold responsive-font-example">'.number_format( $totunCos,0).'</td>';
                    print '<td id="costd2" class="fw-bold responsive-font-example">'.number_format( $portotunCos,2).'</td>';
                    print '<td id="costd3" class="fw-bold responsive-font-example">'.number_format( $totvalCos,2).'</td>';
                    print '<td id="costd4" class="fw-bold responsive-font-example">'.number_format( $portotvalCos,2).'</td>';
                    //REPUBLICA DOMINICANA
                    print '<td id="reptd1" class="fw-bold responsive-font-example">'.number_format( $totunRep,0).'</td>';
                    print '<td id="reptd2" class="fw-bold responsive-font-example">'.number_format( $portotunRep,2).'</td>';
                    print '<td id="reptd3" class="fw-bold responsive-font-example">'.number_format( $totvalRep,2).'</td>';
                    print '<td id="reptd4" class="fw-bold responsive-font-example">'.number_format( $portotvalRep,2).'</td>';
                    //NICARAGUA
                    print '<td id="nictd1" class="fw-bold responsive-font-example">'.number_format( $totunNic,0).'</td>';
                    print '<td id="nictd2" class="fw-bold responsive-font-example">'.number_format( $portotunNic,2).'</td>';
                    print '<td id="nictd3" class="fw-bold responsive-font-example">'.number_format( $totvalNic,2).'</td>';
                    print '<td id="nictd4" class="fw-bold responsive-font-example">'.number_format( $portotvalNic,2).'</td>';

                      //TOTALES
                      print '<td id="tottd1" class="fw-bold responsive-font-example">'.number_format( $totunTot,0).'</td>';
                      print '<td id="tottd2" class="fw-bold responsive-font-example"></td>';
                      print '<td id="tottd3" class="fw-bold responsive-font-example">'.number_format( $totvalTot,2).'</td>';
                      print '<td id="tottd4" class="fw-bold responsive-font-example"></td>';
                    print '</tr>';
                  ?>
                </tbody>
              </table>
              </div>
            

        </div>
      </div>
    </div>
  </div>
  <script>
       $( document ).ready(function() {
            $("#cbbMes").val("<?php echo $mesfiltro; ?>"); 
            $("#cbbAno").val(<?php echo $anofiltro;  ?>);
            if ((<?php echo $ckfiltro;  ?>)==1) {
              $("#flexRadioDefault1").prop("checked", true);
              $("#flexRadioDefault2").prop("checked", false);
            }else{
              $("#flexRadioDefault1").prop("checked", false);
              $("#flexRadioDefault2").prop("checked", true);
            }
           
          $("#cbbMes, #cbbAno, #flexRadioDefault1, #flexRadioDefault2, #cbbMarca",).change(function() {
              $("#formFiltros").submit();
            });

               var table5 = $('#myTableMarcas').DataTable({
                          autoWidth: false,
                          stateSave: true,
                          "ordering": false,
                          "pageLength": 100,
                          "language": {
                              url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                          },
                          columns: [
                              {},{},{},{},{},{},{},{},{},{},
                              {},{},{},{},{},{},{},{},{},{},
                              {},{},{},{},{},{},{},{},{},{},
                            ],
                          "columnDefs": [
                              {
                                  target: 0,
                                  visible: false,
                                  searchable: true,
                              },
                            ],
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'excelHtml5',
                                    text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                                    className: "btn btn-success text-light fs-6 ",
                                    exportOptions: {
                                        columns: [1,2,3,4,5,6,7,8,9,10,
                                                  11,12,13,14,15,16,17,18,19,20,
                                                  21,22,23,24,25,26,27,28,29]
                                    },
                                    createEmptyCells: true,
                                    messageTop:'a',
                                    title: 'ReporteMarcas',
                                    customize: function (xlsx) {
                                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                        var sSh = xlsx.xl['styles.xml'];
                                        var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                                        var i; var y;
                                        
                                        var n1 = '<numFmt formatCode="##0.0000%" numFmtId="300"/>';
                                        var s1 = '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                                        var s2 = '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                                                    '<alignment horizontal="center"/></xf>';
                                        var s3 = '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                                        var s4 = '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                                                    '<alignment horizontal="center" wrapText="1"/></xf>'
                                        sSh.childNodes[0].childNodes[0].innerHTML += n1;
                                        sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4;
                                        
                                        var fourDecPlaces    = lastXfIndex + 1;
                                        var greyBoldCentered = lastXfIndex + 2;
                                        var twoDecPlacesBold = lastXfIndex + 3;
                                        var greyBoldWrapText = lastXfIndex + 4;
                                        if ((<?php echo $ckfiltro;  ?>)==1) {
                                          $('c[r=A1] t', sheet).text('REPORTE DE VENTAS COMPARATIVO MARCAS Y PAIS                  AÑO: <?php echo $anofiltro;  ?>  MES:  <?php echo obtenerNombreMes($mesfiltro); ?>');    
                                        }else{
                                          $('c[r=A1] t', sheet).text('REPORTE DE VENTAS COMPARATIVO MARCAS Y PAIS                  AÑO: <?php echo $anofiltro;  ?>  DESDE:  <?php echo obtenerNombreMes(1); ?>   HASTA:  <?php echo obtenerNombreMes($mesfiltro); ?>');    
                                        }
                                       
                                        $('c[r=A2] t', sheet).text('                                                                            HONDURAS                                                             GUATEMALA                                                        EL SALVADOR                                                                        COSTA RICA                                                              NICARAGUA                                                    REP. DOMINICANA                                                       TOTAL      ');
                                        $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
                                        $('row:eq(1) c', sheet).attr( 's', 7 );
                                        $('row:eq(2) c', sheet).attr( 's', greyBoldCentered );
                                        var tagName = sSh.getElementsByTagName('sz');
                                       
                                        for (i = 0; i < tagName.length; i++) {
                                          tagName[i].setAttribute("val", "13")
                                        }
                                       
                                      }
                                      
                                }
                            ],
                              paging: false,
                        });



                 $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none');
                 $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                 $('#costd1, #costd2, #costd3, #costd4').addClass('d-none');
                 $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none');
                 $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none');
                 $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none');

                $('#btncolHon').click(function() {
                  $('#Enca').text('Honduras');
                  $('#honth1, #honth2, #honth3, #honth4').removeClass('d-none'); $('#hontd1, #hontd2, #hontd3, #hontd4').removeClass('d-none');
                  $('#guath1, #guath2, #guath3, #guath4').addClass('d-none'); $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none');
                  $('#salth1, #salth2, #salth3, #salth4').addClass('d-none'); $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                  $('#costh1, #costh2, #costh3, #costh4').addClass('d-none'); $('#costd1, #costd2, #costd3, #costd4').addClass('d-none');
                  $('#repth1, #repth2, #repth3, #repth4').addClass('d-none'); $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none');
                  $('#nicth1, #nicth2, #nicth3, #nicth4').addClass('d-none'); $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none');
                  $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none'); $('#totth1, #totth2, #totth3, #totth4').addClass('d-none');
                });

                $('#btncolGua').click(function() {
                  $('#Enca').text('Guatemala');
                  $('#honth1, #honth2, #honth3, #honth4').removeClass('d-none'); $('#hontd1, #hontd2, #hontd3, #hontd4').addClass('d-none');
                  $('#guatd1, #guatd2, #guatd3, #guatd4').removeClass('d-none'); $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                  $('#costd1, #costd2, #costd3, #costd4').addClass('d-none'); $('#costh1, #costh2, #costh3, #costh4').addClass('d-none');
                  $('#salth1, #salth2, #salth3, #salth4').addClass('d-none'); $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                  $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none'); $('#nicth1, #nicth2, #nicth3, #nicth4').addClass('d-none');
                  $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none'); $('#repth1, #repth2, #repth3, #repth4').addClass('d-none');
                  $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none'); $('#totth1, #totth2, #totth3, #totth4').addClass('d-none');
                });
                $('#btncolSal').click(function() {
                  $('#Enca').text('El Salvador');
                  $('#honth1, #honth2, #honth3, #honth4').addClass('d-none'); $('#hontd1, #hontd2, #hontd3, #hontd4').addClass('d-none');
                  $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none'); $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                  $('#costd1, #costd2, #costd3, #costd4').addClass('d-none'); $('#costh1, #costh2, #costh3, #costh4').addClass('d-none');
                  $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none'); $('#nicth1, #nicth2, #nicth3, #nicth4').addClass('d-none');
                  $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none'); $('#repth1, #repth2, #repth3, #repth4').addClass('d-none');
                  $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none'); $('#totth1, #totth2, #totth3, #totth4').addClass('d-none');
                  $('#salth1, #salth2, #salth3, #salth4').removeClass('d-none'); $('#saltd1, #saltd2, #saltd3, #saltd4').removeClass('d-none');
                });
                $('#btncolCos').click(function() {
                  $('#Enca').text('Costa Rica');
                  $('#honth1, #honth2, #honth3, #honth4').addClass('d-none'); $('#hontd1, #hontd2, #hontd3, #hontd4').addClass('d-none');
                  $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none'); $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                  $('#salth1, #salth2, #salth3, #salth4').addClass('d-none'); $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                  $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none'); $('#nicth1, #nicth2, #nicth3, #nicth4').addClass('d-none');
                  $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none'); $('#repth1, #repth2, #repth3, #repth4').addClass('d-none');
                  $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none'); $('#totth1, #totth2, #totth3, #totth4').addClass('d-none');
                  $('#costd1, #costd2, #costd3, #costd4').removeClass('d-none'); $('#costh1, #costh2, #costh3, #costh4').removeClass('d-none');
                });
                $('#btncolNic').click(function() {
                  $('#Enca').text('Nicaragua');
                  $('#honth1, #honth2, #honth3, #honth4').addClass('d-none'); $('#hontd1, #hontd2, #hontd3, #hontd4').addClass('d-none');
                  $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none'); $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                  $('#salth1, #salth2, #salth3, #salth4').addClass('d-none'); $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                  $('#costd1, #costd2, #costd3, #costd4').addClass('d-none'); $('#costh1, #costh2, #costh3, #costh4').addClass('d-none');
                  $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none'); $('#repth1, #repth2, #repth3, #repth4').addClass('d-none');
                  $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none'); $('#totth1, #totth2, #totth3, #totth4').addClass('d-none');
                  $('#nictd1, #nictd2, #nictd3, #nictd4').removeClass('d-none'); $('#nicth1, #nicth2, #nicth3, #nicth4').removeClass('d-none');
                });
                $('#btncolRep').click(function() {
                  $('#Enca').text('República Dominicana');
                  $('#honth1, #honth2, #honth3, #honth4').addClass('d-none'); $('#hontd1, #hontd2, #hontd3, #hontd4').addClass('d-none');
                  $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none'); $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                  $('#salth1, #salth2, #salth3, #salth4').addClass('d-none'); $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                  $('#costd1, #costd2, #costd3, #costd4').addClass('d-none'); $('#costh1, #costh2, #costh3, #costh4').addClass('d-none');
                  $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none'); $('#nicth1, #nicth2, #nicth3, #nicth4').addClass('d-none');
                  $('#tottd1, #tottd2, #tottd3, #tottd4').addClass('d-none'); $('#totth1, #totth2, #totth3, #totth4').addClass('d-none');
                  $('#reptd1, #reptd2, #reptd3, #reptd4').removeClass('d-none'); $('#repth1, #repth2, #repth3, #repth4').removeClass('d-none');
                });
                $('#btncolTot').click(function() {
                  $('#Enca').text('Total');
                  $('#honth1, #honth2, #honth3, #honth4').addClass('d-none'); $('#hontd1, #hontd2, #hontd3, #hontd4').addClass('d-none');
                  $('#guatd1, #guatd2, #guatd3, #guatd4').addClass('d-none'); $('#guath1, #guath2, #guath3, #guath4').addClass('d-none');
                  $('#salth1, #salth2, #salth3, #salth4').addClass('d-none'); $('#saltd1, #saltd2, #saltd3, #saltd4').addClass('d-none');
                  $('#costd1, #costd2, #costd3, #costd4').addClass('d-none'); $('#costh1, #costh2, #costh3, #costh4').addClass('d-none');
                  $('#nictd1, #nictd2, #nictd3, #nictd4').addClass('d-none'); $('#nicth1, #nicth2, #nicth3, #nicth4').addClass('d-none');
                  $('#reptd1, #reptd2, #reptd3, #reptd4').addClass('d-none'); $('#repth1, #repth2, #repth3, #repth4').addClass('d-none');
                  $('#tottd1, #tottd2, #tottd3, #tottd4').removeClass('d-none'); $('#totth1, #totth2, #totth3, #totth4').removeClass('d-none');
                });
               
       });
     
      
  </script>
</body>

</html>