<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../assets/vendors/monthpicker/material.css">
    <link href="../../assets/vendors/monthpicker/picker.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
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
                    <span>Módulo de facturación / Consultas</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0003PA</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Consulta Comp.Ventas x marca y meses(tiendas)</h1>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <form id="formFiltros" action="../../assets/php/ZFA/ZLO0003P/filtrosLogica.php" method="POST">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-lg-6 mt-2">
                                <label>Marca:</label>
                                <select class="form-select  mt-1" id="cbbMarca" name="cbbMarca">
                                    <option value="0">TODAS LAS MARCAS</option>
                                    <?php
                                        // Mientras haya filas para obtener del resultado de la consulta
                                        while($rowDesc = odbc_fetch_array($resultDescripcion)){
                                            // Se imprime una opción para el select con el valor y el texto obtenidos de la fila actual
                                            echo "<option value='".$rowDesc['DESCO1']."'>".$rowDesc['DESDES']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mt-2">
                                <label>Rango de meses:</label>
                                <div id="wrapper">
                                    <input id="daterangepicker" class="fs-6 p-2 fw-bold" type="text"
                                        placeholder="Selecciona un rango de meses" onclick="this.blur();"
                                        oninput="this.value = this.value.replace(/[^0-9\/\s-]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0'); if(!(/^(0[1-9]|1[0-2])\/\d{4}\s-\s(0[1-9]|1[0-2])\/\d{4}$/.test(this.value))) this.value = '';">
                                    <input class="d-none" id="startdate" name="startdate">
                                    <input class="d-none" id="enddate" name="enddate">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="demo">
                    <ul class="tablist" role="tablist">
                        <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1"
                            aria-selected="true" role="tab" tabindex="0">País</li>
                        <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false"
                            role="tab" tabindex="0">Tiendas</li>
                    </ul>
                    <div id="panel1" class="tablist__panel p-3" aria-labelledby="tab1" aria-hidden="false"
                        role="tabpanel">
                        <div class="btn-group flex-wrap d-flex justify-content-center justify-content-md-start mb-2 mt-2"
                            role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check " name="btncols" id="btncolHon" autocomplete="off"
                                checked>
                            <label class="btn btn-outline-secondary responsive-font-example pt-3 pb-3 text-black"
                                for="btncolHon"><b>Honduras</b></label>
                            <input type="radio" class="btn-check" name="btncols" id="btncolGua" autocomplete="off">
                            <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"
                                for="btncolGua" id="btnnradio2"><b>Guatemala</b></label>
                            <input type="radio" class="btn-check" name="btncols" id="btncolSal" autocomplete="off">
                            <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"
                                for="btncolSal"><b>El Salvador</b></label>


                        </div>
                        <div class="btn-group flex-wrap d-flex justify-content-center justify-content-md-start mb-2 mt-2"
                            role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btncols" id="btncolCos" autocomplete="off">
                            <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"
                                for="btncolCos"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Costa
                                    Rica&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                            <input type="radio" class="btn-check" name="btncols" id="btncolNic" autocomplete="off">
                            <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"
                                for="btncolNic"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nicaragua&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                            <input type="radio" class="btn-check" name="btncols" id="btncolRep" autocomplete="off">
                            <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"
                                for="btncolRep"><b>Rep. Dominicana</b></label>
                        </div>
                        <hr>
                        <div class="row" id="grafica">
                            <div id="GRHON" class="col-12 col-lg-12">
                                <figure class="highcharts-figure">
                                    <div id="containerHon"></div>
                                </figure>
                            </div>
                            <div id="GRGUA" class="col-12 col-lg-12">
                                <figure class="highcharts-figure">
                                    <div id="containerGua"></div>
                                </figure>
                            </div>
                            <div id="GRSAL" class="col-12 col-lg-12">
                                <figure class="highcharts-figure">
                                    <div id="containerSal"></div>
                                </figure>
                            </div>
                            <div id="GRCOS" class="col-12 col-lg-12">
                                <figure class="highcharts-figure">
                                    <div id="containerCos"></div>
                                </figure>
                            </div>
                            <div id="GRREP" class="col-12 col-lg-12">
                                <figure class="highcharts-figure">
                                    <div id="containerRep"></div>
                                </figure>
                            </div>
                            <div id="GRNIC" class="col-12 col-lg-12">
                                <figure class="highcharts-figure">
                                    <div id="containerNic"></div>
                                </figure>
                            </div>
                        </div>

                        <div class="table-responsive">

                            <table id="myTableMarcas" class="table stripe table-hover " style="width:100%">
                                <thead>
                                    <tr>
                                        <th colspan="2"> </th>
                                        <th colspan="6" class="text-center fs-4" id="Enca">Honduras</th>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <th class="text-start responsive-font-example text-end">Marcas</th>
                                        <th id="honth1" class="text-start responsive-font-example text-end">Unidades Año
                                            <?php echo $ano2;?></th>
                                        <th id="honth2" class="text-start responsive-font-example text-end">Unidades Año
                                            <?php echo $ano2-1;?></th>
                                        <th id="honth3" class="responsive-font-example text-end">Valor Año
                                            <?php echo $ano2;?></th>
                                        <th id="honth4" class="responsive-font-example text-end">Valor Año
                                            <?php echo $ano2-1;?></th>
                                        <th id="honth5" class="responsive-font-example text-end">Variación</th>
                                        <th id="honth6" class="responsive-font-example text-end">Crecimiento</th>
                                        <th id="guath1" class="d-none text-start responsive-font-example text-end">
                                            Unidades Año
                                            <?php echo $ano2;?></th>
                                        <th id="guath2" class="d-none text-start responsive-font-example text-end">
                                            Unidades Año
                                            <?php echo $ano2-1;?></th>
                                        <th id="guath3" class="d-none text-start responsive-font-example text-end">Valor
                                            Año
                                            <?php echo $ano2;?></th>
                                        <th id="guath4" class="d-none text-start responsive-font-example text-end">Valor
                                            Año
                                            <?php echo $ano2-1;?></th>
                                        <th id="guath5" class="d-none text-start responsive-font-example ">Variación
                                        </th>
                                        <th id="guath6" class="d-none text-start responsive-font-example text-end">
                                            Crecimiento</th>
                                        <th id="salth1" class="d-none text-start responsive-font-example text-end">
                                            Unidades Año
                                            <?php echo $ano2;?></th>
                                        <th id="salth2" class="d-none text-start responsive-font-example text-end">
                                            Unidades Año
                                            <?php echo $ano2-1;?></th>
                                        <th id="salth3" class="d-none text-start responsive-font-example text-end">Valor
                                            Año
                                            <?php echo $ano2;?></th>
                                        <th id="salth4" class="d-none text-start responsive-font-example text-end">Valor
                                            Año
                                            <?php echo $ano2-1;?></th>
                                        <th id="salth5" class="d-none text-start responsive-font-example text-end">
                                            Variación</th>
                                        <th id="salth6" class="d-none text-start responsive-font-example text-end">
                                            Crecimiento</th>
                                        <th id="costh1" class="d-none text-start responsive-font-example text-end">
                                            Unidades Año
                                            <?php echo $ano2;?></th>
                                        <th id="costh2" class="d-none text-start responsive-font-example text-end">
                                            Unidades Año
                                            <?php echo $ano2-1;?></th>
                                        <th id="costh3" class="d-none text-start responsive-font-example text-end">Valor
                                            Año
                                            <?php echo $ano2;?></th>
                                        <th id="costh4" class="d-none text-start responsive-font-example text-end">Valor
                                            Año
                                            <?php echo $ano2-1;?></th>
                                        <th id="costh5" class="d-none text-start responsive-font-example text-end">
                                            Variación</th>
                                        <th id="costh6" class="d-none text-start responsive-font-example text-end">
                                            Crecimiento</th>
                                        <th id="repth1" class="d-none text-start responsive-font-example text-end">
                                            Unidades Año
                                            <?php echo $ano2;?></th>
                                        <th id="repth2" class="d-none text-start responsive-font-example text-end">
                                            Unidades Año
                                            <?php echo $ano2-1;?></th>
                                        <th id="repth3" class="d-none text-start responsive-font-example text-end">Valor
                                            Año
                                            <?php echo $ano2;?></th>
                                        <th id="repth4" class="d-none text-start responsive-font-example text-end">Valor
                                            Año
                                            <?php echo $ano2-1;?></th>
                                        <th id="repth5" class="d-none text-start responsive-font-example text-end">
                                            Variación</th>
                                        <th id="repth6" class="d-none text-start responsive-font-example text-end">
                                            Crecimiento</th>
                                        <th id="nicth1" class="d-none text-start responsive-font-example text-end">
                                            Unidades Año
                                            <?php echo $ano2;?></th>
                                        <th id="nicth2" class="d-none text-start responsive-font-example text-end">
                                            Unidades Año
                                            <?php echo $ano2-1;?></th>
                                        <th id="nicth3" class="d-none text-start responsive-font-example text-end">Valor
                                            Año
                                            <?php echo $ano2;?></th>
                                        <th id="nicth4" class="d-none text-start responsive-font-example text-end">Valor
                                            Año
                                            <?php echo $ano2-1;?></th>
                                        <th id="nicth5" class="d-none text-start responsive-font-example text-end">
                                            Variación</th>
                                        <th id="nicth6" class="d-none text-start responsive-font-example text-end">
                                            Crecimiento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $totunHon=0; $totunHon2=0; $totvalHon=0; $totvalHon2=0; $totvarHon=0; $porcreHon=0;  $totvarTotHon=0; $porcreTotHon=0;
                                        $totunGua=0; $totunGua2=0; $totvalGua=0; $totvalGua2=0; $totvarGua=0; $porcreGua=0;
                                        $totunSal=0; $totunSal2=0; $totvalSal=0; $totvalSal2=0; $totvarSal=0; $porcreSal=0;
                                        $totunCos=0; $totunCos2=0; $totvalCos=0; $totvalCos2=0; $totvarCos=0; $porvalCos=0;
                                        $totunRep=0; $totunRep2=0; $totvalRep=0; $totvalRep2=0; $totvarRep=0; $porvalRep=0;
                                        $totunNic=0; $totunNic2=0; $totvalNic=0; $totvalNic2=0; $totvarNic=0; $porvalNic=0;
                                        $totunTot=0; $totunTot2=0;$totvalTot=0; $totvarTot=0; $porunTot=0; $portotunTot=0; $portotvalTot=0;

                                        $registrosMarcas = array();
                                        while($rowMarcas = odbc_fetch_array($resultMarcas)){
                                            $registro = array(
                                            "HISM38" => $rowMarcas['MARCA'],
                                            "DESDES" => $rowMarcas['DESDES'],
                                            "CANHON" => $rowMarcas['CANHON'],
                                            "CANHON2" => $rowMarcas['CANHON2'],
                                            "VALHON" => $rowMarcas['VALHON'],
                                            "VALHON2" => $rowMarcas['VALHON2'],
                                            "CANGUA" => $rowMarcas['CANGUA'],
                                            "CANGUA2" => $rowMarcas['CANGUA2'],
                                            "VALGUA" => $rowMarcas['VALGUA'],
                                            "VALGUA2" => $rowMarcas['VALGUA2'],
                                            "CANCOS" => $rowMarcas['CANCOS'],
                                            "CANCOS2" => $rowMarcas['CANCOS2'],
                                            "VALCOS" => $rowMarcas['VALCOS'],
                                            "VALCOS2" => $rowMarcas['VALCOS2'],
                                            "CANSAL" => $rowMarcas['CANSAL'],
                                            "CANSAL2" => $rowMarcas['CANSAL2'],
                                            "VALSAL" => $rowMarcas['VALSAL'],
                                            "VALSAL2" => $rowMarcas['VALSAL2'],
                                            "CANREP" => $rowMarcas['CANREP'],
                                            "CANREP2" => $rowMarcas['CANREP2'],
                                            "VALREP" => $rowMarcas['VALREP'],
                                            "VALREP2" => $rowMarcas['VALREP2'],
                                            "CANNIC" => $rowMarcas['CANNIC'],
                                            "CANNIC2" => $rowMarcas['CANNIC2'],
                                            "VALNIC" => $rowMarcas['VALNIC'],
                                            "VALNIC2" => $rowMarcas['VALNIC2']
                                            );
                                            $registrosMarcas[] = $registro;
                                        }
                                        foreach($registrosMarcas as $rowMarcas){
                                            //CALCULO DE TOTALES POR PAIS

                                            //HONDURAS
                                            $totunHon+=$rowMarcas['CANHON'];
                                            $totunHon2+=$rowMarcas['CANHON2'];
                                            $totvalHon+=$rowMarcas['VALHON'];
                                            $totvalHon2+=$rowMarcas['VALHON2'];
                                            //GUATEMALA
                                            $totunGua+=$rowMarcas['CANGUA'];
                                            $totunGua2+=$rowMarcas['CANGUA2'];
                                            $totvalGua+=$rowMarcas['VALGUA'];
                                            $totvalGua2+=$rowMarcas['VALGUA2'];

                                            //EL SALVADOR
                                            $totunSal+=$rowMarcas['CANSAL'];
                                            $totunSal2+=$rowMarcas['CANSAL2'];
                                            $totvalSal+=$rowMarcas['VALSAL'];
                                            $totvalSal2+=$rowMarcas['VALSAL2'];
                                            //COSTA RICA
                                            $totunCos+=$rowMarcas['CANCOS'];
                                            $totunCos2+=$rowMarcas['CANCOS2'];
                                            $totvalCos+= $rowMarcas['VALCOS'];
                                            $totvalCos2+= $rowMarcas['VALCOS2'];
                                            //REPUBLICA DOMINICANA
                                            $totunRep+=$rowMarcas['CANREP'];
                                            $totunRep2+=$rowMarcas['CANREP2'];
                                            $totvalRep+=$rowMarcas['VALREP'];
                                            $totvalRep2+=$rowMarcas['VALREP2'];
                                            //NICARAGUA
                                            $totunNic+=$rowMarcas['CANNIC'];
                                            $totunNic2+=$rowMarcas['CANNIC2'];
                                            $totvalNic+=$rowMarcas['VALNIC'];
                                            $totvalNic2+=$rowMarcas['VALNIC2'];
                                        }
                                        $validator="true";
                                        foreach($registrosMarcas as $rowMarcas){
                                            $validator="false";
                                            print '<tr>';
                                            print '<td>'.$rowMarcas['HISM38'].'</td>';
                                            print '<td class="text-darkblue fw-bold responsive-font-example">'.$rowMarcas['DESDES'].'</td>';
                                            //HONDURAS

                                            $totvarHon=$rowMarcas['VALHON']-$rowMarcas['VALHON2'];
                                            $porcreHon=($rowMarcas['VALHON2']!=0)?round((($rowMarcas['VALHON']/$rowMarcas['VALHON2'])-1)*100):0;
                                            print '<td id="hontd1" class="fw-bold responsive-font-example text-end">'.(($rowMarcas['CANHON']==0)?' ':number_format( $rowMarcas['CANHON'],0)).'</td>';
                                            print '<td id="hontd2" class="responsive-font-example text-end">'.(($rowMarcas['CANHON2']==0)?' ':number_format( $rowMarcas['CANHON2'],0)).'</td>';
                                            print '<td id="hontd3" class="fw-bold responsive-font-example text-end">'.(($rowMarcas['VALHON']==0)?' ':"D.".number_format( $rowMarcas['VALHON'],2)).'</td>';
                                            print '<td id="hontd4" class="responsive-font-example text-end">'.(($rowMarcas['VALHON2']==0)?' ':"D.".number_format( $rowMarcas['VALHON2'],2)).'</td>';
                                            if ($totvarHon<0) {print '<td id="hontd5" class="fw-bold responsive-font-example text-danger text-end">'.(($totvarHon==0)?' ':"D.".number_format($totvarHon,2)).'</td>';}else{if ($totvarHon>0) {print '<td id="hontd5" class="fw-bold responsive-font-example text-success text-end">'.(($totvarHon==0)?' ':"D.".number_format($totvarHon,2)).'</td>';}else{print '<td id="hontd5" class="fw-bold responsive-font-example text-end">'.(($totvarHon==0)?' ':"D.".number_format($totvarHon,2)).'</td>';}}
                                            if ($porcreHon<0) {print '<td id="hontd6" class="responsive-font-example  text-danger text-end">'.(($porcreHon==0)?' ':number_format( $porcreHon,0).'%').'</td>';}else{if ($porcreHon>0) {print '<td id="hontd6" class="responsive-font-example  text-success text-end">'.(($porcreHon==0)?' ':number_format( $porcreHon,0).'%').'</td>';}else{print '<td id="hontd6" class="responsive-font-example text-end">'.(($porcreHon==0)?' ':number_format( $porcreHon,0).'%').'</td>';}}
                                            //GUATEMALA
                                            $totvarGua=$rowMarcas['VALGUA']-$rowMarcas['VALGUA2'];
                                            $porcreGua=($rowMarcas['VALGUA2']!=0)?round((($rowMarcas['VALGUA']/$rowMarcas['VALGUA2'])-1)*100):0;
                                            print '<td id="guatd1" class="fw-bold responsive-font-example text-end">'.(($rowMarcas['CANGUA']==0)?' ':number_format( $rowMarcas['CANGUA'],0)).'</td>';
                                            print '<td id="guatd2" class="responsive-font-example text-end">'.(($rowMarcas['CANGUA2']==0)?' ':number_format( $rowMarcas['CANGUA2'],0)).'</td>';
                                            print '<td id="guatd3" class="fw-bold responsive-font-example text-end">'.(($rowMarcas['VALGUA']==0)?' ':"D.".number_format( $rowMarcas['VALGUA'],2)).'</td>';
                                            print '<td id="guatd4" class="responsive-font-example text-end">'.(($rowMarcas['VALGUA2']==0)?' ':"D.".number_format( $rowMarcas['VALGUA2'],2)).'</td>';
                                            if ($totvarGua<0) {print '<td id="guatd5" class="fw-bold responsive-font-example text-danger text-end">'.(($totvarGua==0)?' ':"D.".number_format($totvarGua,2)).'</td>';}else{if ($totvarGua>0) {print '<td id="guatd5" class="fw-bold responsive-font-example text-success text-end">'.(($totvarGua==0)?' ':"D.".number_format($totvarGua,2)).'</td>';}else{print '<td id="guatd5" class="fw-bold responsive-font-example text-end">'.(($totvarGua==0)?' ':"D.".number_format($totvarGua,2)).'</td>';}}
                                            if ($porcreGua<0) {print '<td id="guatd6" class="responsive-font-example text-danger text-end">'.(($porcreGua==0)?' ':number_format( $porcreGua,0).'%').'</td>';}else{if ($porcreGua>0) {print '<td id="guatd6" class="responsive-font-example text-success text-end">'.(($porcreGua==0)?' ':number_format( $porcreGua,0).'%').'</td>';}else{print '<td id="guatd6" class="responsive-font-example text-end">'.(($porcreGua==0)?' ':number_format( $porcreGua,0).'%').'</td>';}}
                                            //EL SALVADOR

                                            $totvarSal=$rowMarcas['VALSAL']-$rowMarcas['VALSAL2'];
                                            $porcreSal=($rowMarcas['VALSAL2']!=0)?round((($rowMarcas['VALSAL']/$rowMarcas['VALSAL2'])-1)*100):0;
                                            print '<td id="saltd1" class="fw-bold responsive-font-example text-end">'.(($rowMarcas['CANSAL']==0)?' ':number_format( $rowMarcas['CANSAL'],0)).'</td>';
                                            print '<td id="saltd2" class="responsive-font-example text-end">'.(($rowMarcas['CANSAL2']==0)?' ':number_format( $rowMarcas['CANSAL2'],0)).'</td>';
                                            print '<td id="saltd3" class="fw-bold responsive-font-example text-end">'.(($rowMarcas['VALSAL']==0)?' ':"D.".number_format( $rowMarcas['VALSAL'],2)).'</td>';
                                            print '<td id="saltd4" class="responsive-font-example text-end">'.(($rowMarcas['VALSAL2']==0)?' ':"D.".number_format( $rowMarcas['VALSAL2'],2)).'</td>';
                                            if ($totvarSal<0) {print '<td id="saltd5" class="fw-bold responsive-font-example text-danger text-end">'.(($totvarSal==0)?' ':"D.".number_format($totvarSal,2)).'</td>';}else{if ($totvarSal>0) {print '<td id="saltd5" class="fw-bold responsive-font-example text-success text-end">'.(($totvarSal==0)?' ':"D.".number_format($totvarSal,2)).'</td>';}else{print '<td id="saltd5" class="fw-bold responsive-font-example text-end">'.(($totvarSal==0)?' ':"D.".number_format($totvarSal,2)).'</td>';}}
                                            if ($porcreSal<0) {print'<td id="saltd6" class="responsive-font-example text-danger text-end">'.(($porcreSal==0)?' ':number_format( $porcreSal,0).'%').'</td>';}else{if ($porcreSal>0) {print '<td id="saltd6" class="responsive-font-example text-success text-end">'.(($porcreSal==0)?' ':number_format( $porcreSal,0).'%').'</td>';}else{print '<td id="saltd6" class="responsive-font-example text-end">'.(($porcreSal==0)?' ':number_format( $porcreSal,0).'%').'</td>';}}

                                            //COSTA RICA
                                            $totvarCos=$rowMarcas['VALCOS']-$rowMarcas['VALCOS2'];
                                            $porcreCos=($rowMarcas['VALCOS2']!=0)?round((($rowMarcas['VALCOS']/$rowMarcas['VALCOS2'])-1)*100):0;
                                            print '<td id="costd1" class="fw-bold responsive-font-example text-end">'.(($rowMarcas['CANCOS']==0)?' ':number_format( $rowMarcas['CANCOS'],0)).'</td>';
                                            print '<td id="costd2" class="responsive-font-example text-end">'.(($rowMarcas['CANCOS2']==0)?' ':number_format( $rowMarcas['CANCOS2'],0)).'</td>';
                                            print '<td id="costd3" class="fw-bold responsive-font-example text-end">'.(($rowMarcas['VALCOS']==0)?' ':"D.".number_format( $rowMarcas['VALCOS'],2)).'</td>';
                                            print '<td id="costd4" class="responsive-font-example text-end">'.(($rowMarcas['VALCOS2']==0)?' ':"D.".number_format( $rowMarcas['VALCOS2'],2)).'</td>';
                                            if ($totvarCos<0) {print '<td id="costd5" class="fw-bold responsive-font-example text-danger text-end">'.(($totvarCos==0)?' ':"D.".number_format($totvarCos,2)).'</td>';}else{if ($totvarCos>0) {print '<td id="costd5" class="fw-bold responsive-font-example  text-success text-end">'.(($totvarCos==0)?' ':"D.".number_format($totvarCos,2)).'</td>';}else{print '<td id="costd5" class="fw-bold responsive-font-example text-end">'.(($totvarCos==0)?' ':"D.".number_format($totvarCos,2)).'</td>';}}
                                            if ($porcreCos<0) {print '<td id="costd6" class="responsive-font-example text-danger text-end">'.(($porcreCos==0)?' ':number_format( $porcreCos,0).'%').'</td>';}else{if ($porcreCos>0) {print '<td id="costd6" class="responsive-font-example  text-success text-end">'.(($porcreCos==0)?' ':number_format( $porcreCos,0).'%').'</td>';}else{print '<td id="costd6" class="responsive-font-example text-end">'.(($porcreCos==0)?' ':number_format( $porcreCos,0).'%').'</td>';}}

                                            //REPUBLICA DOMINICANA
                                            $totvarRep=$rowMarcas['VALREP']-$rowMarcas['VALREP2'];
                                            $porcreRep=($rowMarcas['VALREP2']!=0)?round((($rowMarcas['VALREP']/$rowMarcas['VALREP2'])-1)*100):0;
                                            print '<td id="reptd1" class="fw-bold responsive-font-example text-end">'.(($rowMarcas['CANREP']==0)?' ':number_format( $rowMarcas['CANREP'],0)).'</td>';
                                            print '<td id="reptd2" class="responsive-font-example text-end">'.(($rowMarcas['CANREP2']==0)?' ':number_format( $rowMarcas['CANREP2'],0)).'</td>';
                                            print '<td id="reptd3" class="fw-bold responsive-font-example text-end">'.(($rowMarcas['VALREP']==0)?' ':"D.".number_format( $rowMarcas['VALREP'],2)).'</td>';
                                            print '<td id="reptd4" class="responsive-font-example text-end">'.(($rowMarcas['VALREP2']==0)?' ':"D.".number_format( $rowMarcas['VALREP2'],2)).'</td>';
                                            if ($totvarRep<0) {print '<td id="reptd5" class="fw-bold responsive-font-example text-danger text-end">'.(($totvarRep==0)?' ':"D.".number_format($totvarRep,2)).'</td>';}else{if ($totvarRep>0) {print '<td id="reptd5" class="fw-bold responsive-font-example  text-success text-end">'.(($totvarRep==0)?' ':"D.".number_format($totvarRep,2)).'</td>';}else{print '<td id="reptd5" class="fw-bold responsive-font-example text-end">'.(($totvarRep==0)?' ':"D.".number_format($totvarRep,2)).'</td>';}}
                                            if ($porcreRep<0) {print '<td id="reptd6" class="responsive-font-example text-danger text-end">'.(($porcreRep==0)?' ':number_format( $porcreRep,0).'%').'</td>';}else{if ($porcreRep>0) {print '<td id="reptd6" class="responsive-font-example  text-success text-end">'.(($porcreRep==0)?' ':number_format( $porcreRep,0).'%').'</td>';}else{print '<td id="reptd6" class="responsive-font-example text-end">'.(($porcreRep==0)?' ':number_format( $porcreRep,0).'%').'</td>';}}

                                            //NICARAGUA
                                            $totvarNic=$rowMarcas['VALNIC']-$rowMarcas['VALNIC2'];
                                            $porcreNic=($rowMarcas['VALNIC2']!=0)?round((($rowMarcas['VALNIC']/$rowMarcas['VALNIC2'])-1)*100):0;
                                            print '<td id="nictd1" class="fw-bold responsive-font-example text-end">'.(($rowMarcas['CANNIC']==0)?' ':number_format( $rowMarcas['CANNIC'],0)).'</td>';
                                            print '<td id="nictd2" class="responsive-font-example text-end">'.(($rowMarcas['CANNIC2']==0)?' ':number_format( $rowMarcas['CANNIC2'],0)).'</td>';
                                            print '<td id="nictd3" class="fw-bold responsive-font-example text-end">'.(($rowMarcas['VALNIC']==0)?' ':"D.".number_format( $rowMarcas['VALNIC'],2)).'</td>';
                                            print '<td id="nictd4" class="responsive-font-example text-end">'.(($rowMarcas['VALNIC2']==0)?' ':"D.".number_format( $rowMarcas['VALNIC2'],2)).'</td>';
                                            if ($totvarNic<0) {print '<td id="nictd5" class="fw-bold responsive-font-example text-danger text-end">'.(($totvarNic==0)?' ':"D.".number_format($totvarNic,2)).'</td>';}else{if ($totvarNic>0) {print '<td id="nictd5" class="fw-bold responsive-font-example text-success text-end">'.(($totvarNic==0)?' ':"D.".number_format($totvarNic,2)).'</td>';}else{print '<td id="nictd5" class="fw-bold responsive-font-example text-end">'.(($totvarNic==0)?' ':"D.".number_format($totvarNic,2)).'</td>';}}
                                            if ($porcreNic<0) {print '<td id="nictd6" class="responsive-font-example text-danger text-end">'.(($porcreNic==0)?' ':number_format( $porcreNic,0).'%').'</td>';}else{if ($porcreNic>0) {print '<td id="nictd6" class="responsive-font-example text-success text-end">'.(($porcreNic==0)?' ':number_format( $porcreNic,0).'%').'</td>';}else{print '<td id="nictd6" class="responsive-font-example text-end">'.(($porcreNic==0)?' ':number_format( $porcreNic,0).'%').'</td>';}}

                                            print '</tr>';

                                        }
                                        if ( $validator!="true") {
                                            print '<td>1000000</td>';
                                            print '<td class=" responsive-font-example text-start"><b>TOTAL FINAL</b></td>';
                                            //HONDURAS
                                            $totvarTotHon=($totvalHon-$totvalHon2);
                                            $porcreTotHon=(($totvalHon2!=0)?round((($totvalHon/$totvalHon2)-1)*100):0);
                                            print '<td id="hontd1" class="fw-bold responsive-font-example text-end">'.(($totunHon==0)?' ':number_format( $totunHon,2)).'</td>';
                                            print '<td id="hontd2" class="fw-bold responsive-font-example text-end">'.(($totunHon2==0)?' ':number_format( $totunHon2,2)).'</td>';
                                            print '<td id="hontd3" class="fw-bold responsive-font-example text-end">'.(($totvalHon==0)?' ':"D.".number_format( $totvalHon,2)).'</td>';
                                            print '<td id="hontd4" class="fw-bold responsive-font-example text-end">'.(($totvalHon2==0)?' ':"D.".number_format( $totvalHon2,2)).'</td>';
                                            if ($totvarTotHon<0) {print '<td id="hontd5" class="fw-bold responsive-font-example text-danger text-end">'.(($totvarTotHon==0)?' ':"D.".number_format( $totvarTotHon,2)).'</td>';}else{if ($totvarTotHon>0) {print '<td id="hontd5" class="fw-bold responsive-font-example  text-success text-end">'.(($totvarTotHon==0)?' ':"D.".number_format( $totvarTotHon,2)).'</td>';}else{print '<td id="hontd5" class="fw-bold responsive-font-example text-end">'.(($totvarTotHon==0)?' ':"D.".number_format( $totvarTotHon,2)).'</td>';}}
                                            if ($porcreTotHon<0) {print '<td id="hontd6" class="fw-bold responsive-font-example text-danger text-end">'.(($porcreTotHon==0)?' ':number_format( $porcreTotHon,0).'%').'</td>';}else{if ($porcreTotHon>0) {print '<td id="hontd6" class="fw-bold responsive-font-example text-success text-end">'.(($porcreTotHon==0)?' ':number_format( $porcreTotHon,0).'%').'</td>';}else{print '<td id="hontd6" class="fw-bold responsive-font-example text-end">'.(($porcreTotHon==0)?' ':number_format( $porcreTotHon,0).'%').'</td>';}}
                                            //GUATEMALA
                                            $totvarTotGua=($totvalGua-$totvalGua2);
                                            $porcreTotGua=(($totvalGua2!=0)?round((($totvalGua/$totvalGua2)-1)*100):0);
                                            print '<td id="guatd1" class="fw-bold responsive-font-example text-end">'.(($totunGua==0)?' ':number_format( $totunGua,0)).'</td>';
                                            print '<td id="guatd2" class="fw-bold responsive-font-example text-end">'.(($totunGua2==0)?' ':number_format( $totunGua2,0)).'</td>';
                                            print '<td id="guatd3" class="fw-bold responsive-font-example text-end">'.(($totvalGua==0)?' ':"D.".number_format( $totvalGua,2)).'</td>';
                                            print '<td id="guatd4" class="fw-bold responsive-font-example text-end">'.(($totvalGua2==0)?' ':"D.".number_format( $totvalGua2,2)).'</td>';
                                            if ($totvarTotGua<0) {print '<td id="guatd5" class="fw-bold responsive-font-example text-danger text-end">'.(($totvarTotGua==0)?' ':"D.".number_format( $totvarTotGua,2)).'</td>';}else{if ($totvarTotGua>0) {print '<td id="guatd5" class="fw-bold responsive-font-example text-success text-end">'.(($totvarTotGua==0)?' ':"D.".number_format( $totvarTotGua,2)).'</td>';}else{print '<td id="guatd5" class="fw-bold responsive-font-example text-end">'.(($totvarTotGua==0)?' ':"D.".number_format( $totvarTotGua,2)).'</td>';}}
                                            if ($porcreTotGua<0) {print '<td id="guatd6" class="fw-bold responsive-font-example text-danger text-end">'.(($porcreTotGua==0)?' ':number_format( $porcreTotGua,0).'%').'</td>';}else{if ($porcreTotGua>0) {print '<td id="guatd6" class="fw-bold responsive-font-example text-success text-end">'.(($porcreTotGua==0)?' ':number_format( $porcreTotGua,0).'%').'</td>';}else{print '<td id="guatd6" class="fw-bold responsive-font-example text-end">'.(($porcreTotGua==0)?' ':number_format( $porcreTotGua,0).'%').'</td>';}}
                                            //EL SALVADOR
                                            $totvarTotSal=($totvalSal-$totvalSal2);
                                            $porcreTotSal=(($totvalSal2!=0)?round((($totvalSal/$totvalSal2)-1)*100):0);
                                            print '<td id="saltd1" class="fw-bold responsive-font-example text-end">'.(($totunSal==0)?' ':number_format( $totunSal,0)).'</td>';
                                            print '<td id="saltd2" class="fw-bold responsive-font-example text-end">'.(($totunSal2==0)?' ':number_format( $totunSal2,0)).'</td>';
                                            print '<td id="saltd3" class="fw-bold responsive-font-example text-end">'.(($totvalSal==0)?' ':"D.".number_format( $totvalSal,2)).'</td>';
                                            print '<td id="saltd4" class="fw-bold responsive-font-example text-end">'.(($totvalSal2==0)?' ':"D.".number_format( $totvalSal2,2)).'</td>';
                                            if ($totvarTotSal<0) {print '<td id="saltd5" class="fw-bold responsive-font-example  text-danger text-end">'.(($totvarTotSal==0)?' ':"D.".number_format( $totvarTotSal,2)).'</td>';}else{if ($totvarTotSal>0) {print '<td id="saltd5" class="fw-bold responsive-font-example text-success text-end">'.(($totvarTotSal==0)?' ':"D.".number_format( $totvarTotSal,2)).'</td>';}else{print '<td id="saltd5" class="fw-bold responsive-font-example text-end">'.(($totvarTotSal==0)?' ':"D.".number_format( $totvarTotSal,2)).'</td>';}}
                                            if ($porcreTotSal<0) {print '<td id="saltd6" class="fw-bold responsive-font-example  text-danger text-end">'.(($porcreTotSal==0)?' ':number_format( $porcreTotSal,0).'%').'</td>';}else{if ($porcreTotSal>0) {print '<td id="saltd6" class="fw-bold responsive-font-example text-success text-end">'.(($porcreTotSal==0)?' ':number_format( $porcreTotSal,0).'%').'</td>';}else{print '<td id="saltd6" class="fw-bold responsive-font-example text-end">'.(($porcreTotSal==0)?' ':number_format( $porcreTotSal,0).'%').'</td>';}}

                                            //COSTA RICA
                                            $totvarTotCos=($totvalCos-$totvalCos2);
                                            $porcreTotCos=(($totvalCos2!=0)?round((($totvalCos/$totvalCos2)-1)*100):0);
                                            print '<td id="costd1" class="fw-bold responsive-font-example text-end">'.(($totunCos==0)?' ':number_format( $totunCos,0)).'</td>';
                                            print '<td id="costd2" class="fw-bold responsive-font-example text-end">'.(($totunCos2==0)?' ':number_format( $totunCos2,0)).'</td>';
                                            print '<td id="costd3" class="fw-bold responsive-font-example text-end">'.(($totvalCos==0)?' ':"D.".number_format( $totvalCos,2)).'</td>';
                                            print '<td id="costd4" class="fw-bold responsive-font-example text-end">'.(($totvalCos2==0)?' ':"D.".number_format( $totvalCos2,2)).'</td>';
                                            if ($totvarTotCos<0) {print '<td id="costd5" class="fw-bold responsive-font-example text-danger text-end">'.(($totvarTotCos==0)?' ':"D.".number_format( $totvarTotCos,2)).'</td>';}else{if ($totvarTotCos>0) {print '<td id="costd5" class="fw-bold responsive-font-example text-success text-end">'.(($totvarTotCos==0)?' ':"D.".number_format( $totvarTotCos,2)).'</td>';}else{print '<td id="costd5" class="fw-bold responsive-font-example text-end">'.(($totvarTotCos==0)?' ':"D.".number_format( $totvarTotCos,2)).'</td>';}}
                                            if ($porcreTotCos<0) {print '<td id="costd6" class="fw-bold responsive-font-example text-danger text-end">'.(($porcreTotCos==0)?' ':number_format( $porcreTotCos,0).'%').'</td>';}else{if ($porcreTotCos>0) {print '<td id="costd6" class="fw-bold responsive-font-example text-success text-end">'.(($porcreTotCos==0)?' ':number_format( $porcreTotCos,0).'%').'</td>';}else{print '<td id="costd6" class="fw-bold responsive-font-example text-end">'.(($porcreTotCos==0)?' ':number_format( $porcreTotCos,0).'%').'</td>';}}
                                            //REPUBLICA DOMINICANA
                                            $totvarTotRep=($totvalRep-$totvalRep2);
                                            $porcreTotRep=(($totvalRep2!=0)?round((($totvalRep/$totvalRep2)-1)*100):0);
                                            // Imprimir el total de unidades de Rep
                                            print '<td id="reptd1" class="fw-bold responsive-font-example text-end">'.(($totunRep==0)?' ':number_format( $totunRep,0)).'</td>';
                                            // Imprimir el total de unidades de Rep2
                                            print '<td id="reptd2" class="fw-bold responsive-font-example text-end">'.(($totunRep2==0)?' ':number_format( $totunRep2,0)).'</td>';
                                            // Imprimir el total de valor de Rep
                                            print '<td id="reptd3" class="fw-bold responsive-font-example text-end">'.(($totvalRep==0)?' ':"D.".number_format( $totvalRep,2)).'</td>';
                                            // Imprimir el total de valor de Rep2
                                            print '<td id="reptd4" class="fw-bold responsive-font-example text-end">'.(($totvalRep2==0)?' ':"D.".number_format( $totvalRep2,2)).'</td>';
                                            // Imprimir el total de variación de Rep, con color rojo si es negativo, verde si es positivo, y normal si es cero
                                            if ($totvarTotRep<0) {print '<td id="reptd5" class="fw-bold responsive-font-example text-danger text-end">'.(($totvarTotRep==0)?' ':"D.".number_format( $totvarTotRep,2)).'</td>';}else{if ($totvarTotRep>0) {print '<td id="reptd5" class="fw-bold responsive-font-example text-success">'.(($totvarTotRep==0)?' ':"D.".number_format( $totvarTotRep,2)).'</td>';}else{print '<td id="reptd5" class="fw-bold responsive-font-example text-end">'.(($totvarTotRep==0)?' ':"D.".number_format( $totvarTotRep,2)).'</td>';}}
                                            // Imprimir el porcentaje total de Rep, con color rojo si es negativo, verde si es positivo, y normal si es cero
                                            if ($porcreTotRep<0) {print '<td id="reptd6" class="fw-bold responsive-font-example text-danger text-end">'.(($porcreTotRep==0)?' ':number_format( $porcreTotRep,0).'%').'</td>';}else{if ($porcreTotRep>0) {print '<td id="reptd6" class="fw-bold responsive-font-example text-success">'.(($porcreTotRep==0)?' ':number_format( $porcreTotRep,0).'%').'</td>';}else{print '<td id="reptd6" class="fw-bold responsive-font-example text-end">'.(($porcreTotRep==0)?' ':number_format( $porcreTotRep,0).'%').'</td>';}}
                                            // NICARAGUA
                                            // Calcular la variación total de Nic
                                            $totvarTotNic=($totvalNic-$totvalNic2);
                                            // Calcular el porcentaje total de Nic
                                            $porcreTotNic=(($totvalNic2!=0)?round((($totvalNic/$totvalNic2)-1)*100):0);
                                            // Imprimir el total de unidades de Nic
                                            print '<td id="nictd1" class="fw-bold responsive-font-example text-end">'.(($totunNic==0)?' ':number_format( $totunNic,0)).'</td>';
                                            // Imprimir el total de unidades de Nic2
                                            print '<td id="nictd2" class="fw-bold responsive-font-example text-end">'.(($totunNic2==0)?' ':number_format( $totunNic2,0)).'</td>';
                                            // Imprimir el total de valor de Nic
                                            print '<td id="nictd3" class="fw-bold responsive-font-example text-end">'.(($totvalNic==0)?' ':"D.".number_format( $totvalNic,2)).'</td>';
                                            // Imprimir el total de valor de Nic2
                                            print '<td id="nictd4" class="fw-bold responsive-font-example text-end">'.(($totvalNic2==0)?' ':"D.".number_format( $totvalNic2,2)).'</td>';
                                            // Imprimir el total de variación de Nic, con color rojo si es negativo, verde si es positivo, y normal si es cero
                                            if ($totvarTotNic<0) {print '<td id="nictd5" class="fw-bold responsive-font-example text-danger text-end">'.(($totvarTotNic==0)?' ':"D.".number_format( $totvarTotNic,2)).'</td>';}else{if ($totvarTotNic>0) {print '<td id="nictd5" class="fw-bold responsive-font-example  text-success text-end">'.(($totvarTotNic==0)?' ':"D.".number_format( $totvarTotNic,2)).'</td>';}else{print '<td id="nictd5" class="fw-bold responsive-font-example text-end">'.(($totvarTotNic==0)?' ':"D.".number_format( $totvarTotNic,2)).'</td>';}}
                                            // Imprimir el porcentaje total de Nic, con color rojo si es negativo, verde si es positivo, y normal si es cero
                                            if ($porcreTotNic<0) {print'<td id="nictd6" class="fw-bold responsive-font-example text-danger text-end">'.(($porcreTotNic==0)?' ':number_format( $porcreTotNic,0).'%').'</td>';}else{if ($porcreTotNic>0) {print '<td id="nictd6" class="fw-bold responsive-font-example  text-success text-end">'.(($porcreTotNic==0)?' ':number_format( $porcreTotNic,0).'%').'</td>';}else{print '<td id="nictd6" class="fw-bold responsive-font-example text-end">'.(($porcreTotNic==0)?' ':number_format( $porcreTotNic,0).'%').'</td>';}}
                                            // Imprimir el cierre de la fila de la tabla
                                            print '</tr>';
                                            }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="panel2" class="tablist__panel is-hidden p-3" aria-labelledby="tab2" aria-hidden="true"
                        role="tabpanel">
                        <div class="position-relative">
                            <form id="formFiltros" action="#" method="POST">
                                <div class="row mb-2">
                                    <div class="col-sm-12 col-lg-12 mt-2 mb-4">
                                        <label>Punto de venta:</label>
                                        <select class="form-select  mt-1 " id="cbbCia" name="cbbCia[]" name="states[]"
                                            multiple="multiple" style="width: 100%;">
                                            <option value="999" selected>Todos los puntos de ventas</option>

                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row" id="tablaTiendas">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
    $(document).ready(function() {
        $('#cbbCia').select2({});
        var usuario = '<?php echo $_SESSION["CODUSU"];?>';
        var urlComarc = 'http://172.16.15.20/API.LovablePHP/ZLO0001P/ListComarc/?usuario=' + usuario + '';
        var responseComarc = ajaxRequest(urlComarc);
        if (responseComarc.code == 200) {
            for (let i = 0; i < responseComarc.data.length; i++) {
                if (responseComarc.data[i]['COMCOD'] != 1) {
                    $("#cbbCia").append(' <option value=' + responseComarc.data[i]['COMCOD'] + '>&nbsp;&nbsp;' +
                        responseComarc.data[i]['COMDES'] + '&nbsp;&nbsp;</option>');
                }
            }
        }

        $("#cbbMes").val("<?php echo $mesfiltro; ?>");
        $("#cbbMarca").val(<?php echo $marcaFiltro;  ?>);
        $("#cbbAno").val(<?php echo $anofiltro;  ?>);
        $("#daterangepicker").val("<?php echo $labelSelect;  ?>");

        $("#cbbMarca, #cbbAno, #cbbMes").change(function() {
            $("#formFiltros").submit();
        });

        chargeTable();
        $("#cbbCia").change(function() {
            chargeTable();
        });

        var table5 = $('#myTableMarcas').DataTable({
            autoWidth: false,
            stateSave: true,
            "ordering": false,
            "pageLength": 100,
            "language": {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },

            "columnDefs": [{
                target: 0,
                visible: false,
                searchable: true,
            }, ],
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light fs-6 ",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
                        11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
                        21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37
                    ]
                },
                createEmptyCells: true,
                messageTop: 'a',
                title: 'Comparativo marcas, país y rango meses',
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    var sSh = xlsx.xl['styles.xml'];
                    var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                    var lastFontIndex = $('fonts font', sSh).length - 1;
                    var i;
                    var y;
                    var f1 = '<font>' +
                        '<sz val="11" />' +
                        '<name val="Calibri" />' +
                        '<color rgb="FF0000" />' + // color rojo en la fuente
                        '</font>';
                    var f2 = '<font>' +
                        '<sz val="11" />' +
                        '<name val="Calibri" />' +
                        '<color rgb="007800" />' + // color verde en la fuente
                        '</font>';

                    var n1 = '<numFmt formatCode="##0%"   numFmtId="300"/>';
                    var n2 = '<numFmt formatCode="#,##0.00"   numFmtId="200" />';
                    var s1 =
                        '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                    var s2 =
                        '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                        '<alignment horizontal="center"/></xf>';
                    var s3 =
                        '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                    var s4 =
                        '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                        '<alignment horizontal="center" wrapText="1"/></xf>'
                    var s5 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 1) +
                        '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                        '<alignment horizontal="right"/></xf>';
                    var s6 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 2) +
                        '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                        '<alignment horizontal="right"/></xf>';
                    var s7 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 1) +
                        '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                        '<alignment horizontal="right"/></xf>';
                    var s8 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 2) +
                        '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                        '<alignment horizontal="right"/></xf>';
                    sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                    sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2;
                    sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 +
                        s6 + s7 + s8;

                    var fourDecPlaces = lastXfIndex + 1;
                    var greyBoldCentered = lastXfIndex + 2;
                    var twoDecPlacesBold = lastXfIndex + 3;
                    var greyBoldWrapText = lastXfIndex + 4;
                    var textred1 = lastXfIndex + 5;
                    var textgreen1 = lastXfIndex + 6;
                    var textred2 = lastXfIndex + 7;
                    var textgreen2 = lastXfIndex + 8;
                    $('c[r=A1] t', sheet).text(
                        'REPORTE DE VENTAS COMPARATIVO TIENDAS POR MARCAS, PAIS Y RANGO DE MESES                  <?php echo $labelSelect;  ?>'
                    );
                    $('c[r=A2] t', sheet).text(
                        '_____________________|__________________________________________________________________________________________________HONDURAS____________________________________________________________________|__________________________________________________________________________________________________________________________________________________________________________________________________________________________________________GUATEMALA________________________________________________________________________________________________________________________________________|________________________________________________________EL SALVADOR___________________________________________________|__________________________________________________COSTA RICA___________________________________________________________|__________________________________________________REP. DOMINICANA_______________________________________________|__________________________________________________NICARAGUA____________________________________________________________|'
                    );
                    $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                    $('row:eq(1) c', sheet).attr('s', 7);
                    $('row:eq(2) c', sheet).attr('s', greyBoldCentered);
                    //HONDURAS
                    for (let index = 3; index <= 22; index++) {

                        if (parseFloat(($('row:eq(' + index + ') c[r^="F"]', sheet).text())
                                .slice(2)) < 0) {
                            $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s',
                                textred1); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s',
                                textgreen1); //VERDE
                        }
                    }
                    for (let index = 3; index <= 22; index++) {
                        if (($('row:eq(' + index + ') c[r^="G"]', sheet).text() * 1 < 0)) {
                            $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s',
                                textred2); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s',
                                textgreen2); //VERDE
                        }
                    }
                    //GUATEMALA
                    for (let index = 3; index <= 22; index++) {

                        if (parseFloat(($('row:eq(' + index + ') c[r^="L"]', sheet).text())
                                .slice(2)) < 0) {
                            $('row:eq(' + index + ') c[r^="L"]', sheet).attr('s',
                                textred1); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="L"]', sheet).attr('s',
                                textgreen1); //VERDE
                        }
                    }
                    for (let index = 3; index <= 22; index++) {
                        if (($('row:eq(' + index + ') c[r^="M"]', sheet).text() * 1 < 0)) {
                            $('row:eq(' + index + ') c[r^="M"]', sheet).attr('s',
                                textred2); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="M"]', sheet).attr('s',
                                textgreen2); //VERDE
                        }
                    }
                    //EL SALVADOR

                    for (let index = 3; index <= 22; index++) {

                        if (parseFloat(($('row:eq(' + index + ') c[r^="R"]', sheet).text())
                                .slice(2)) < 0) {
                            $('row:eq(' + index + ') c[r^="R"]', sheet).attr('s',
                                textred1); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="R"]', sheet).attr('s',
                                textgreen1); //VERDE
                        }
                    }
                    for (let index = 3; index <= 22; index++) {
                        if (($('row:eq(' + index + ') c[r^="S"]', sheet).text() * 1 < 0)) {
                            $('row:eq(' + index + ') c[r^="S"]', sheet).attr('s',
                                textred2); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="S"]', sheet).attr('s',
                                textgreen2); //VERDE
                        }
                    }
                    //COSTA RICA

                    for (let index = 3; index <= 22; index++) {

                        if (parseFloat(($('row:eq(' + index + ') c[r^="X"]', sheet).text())
                                .slice(2)) < 0) {
                            $('row:eq(' + index + ') c[r^="X"]', sheet).attr('s',
                                textred1); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="X"]', sheet).attr('s',
                                textgreen1); //VERDE
                        }
                    }
                    for (let index = 3; index <= 22; index++) {
                        if (($('row:eq(' + index + ') c[r^="Y"]', sheet).text() * 1 < 0)) {
                            $('row:eq(' + index + ') c[r^="Y"]', sheet).attr('s',
                                textred2); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="Y"]', sheet).attr('s',
                                textgreen2); //VERDE
                        }
                    }
                    //REP DOMINICANA

                    for (let index = 3; index <= 22; index++) {

                        if (parseFloat(($('row:eq(' + index + ') c[r^="AD"]', sheet).text())
                                .slice(2)) < 0) {
                            $('row:eq(' + index + ') c[r^="AD"]', sheet).attr('s',
                                textred1); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="AD"]', sheet).attr('s',
                                textgreen1); //VERDE
                        }
                    }
                    for (let index = 3; index <= 22; index++) {
                        if (($('row:eq(' + index + ') c[r^="AE"]', sheet).text() * 1 < 0)) {
                            $('row:eq(' + index + ') c[r^="AE"]', sheet).attr('s',
                                textred2); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="AE"]', sheet).attr('s',
                                textgreen2); //VERDE
                        }
                    }
                    //NICARAGUA

                    for (let index = 3; index <= 22; index++) {

                        if (parseFloat(($('row:eq(' + index + ') c[r^="AJ"]', sheet).text())
                                .slice(2)) < 0) {
                            $('row:eq(' + index + ') c[r^="AJ"]', sheet).attr('s',
                                textred1); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="AJ"]', sheet).attr('s',
                                textgreen1); //VERDE
                        }
                    }
                    for (let index = 3; index <= 22; index++) {
                        if (($('row:eq(' + index + ') c[r^="AK"]', sheet).text() * 1 < 0)) {
                            $('row:eq(' + index + ') c[r^="AK"]', sheet).attr('s',
                                textred2); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="AK"]', sheet).attr('s',
                                textgreen2); //VERDE
                        }
                    }
                    var tagName = sSh.getElementsByTagName('sz');
                    for (i = 0; i < tagName.length; i++) {
                        tagName[i].setAttribute("val", "13")
                    }

                }

            }],
            paging: false,
        });



        $('#guatd1, #guatd2, #guatd3, #guatd4, #guatd5, #guatd6').addClass('d-none');
        $('#saltd1, #saltd2, #saltd3, #saltd4, #saltd5, #saltd6').addClass('d-none');
        $('#costd1, #costd2, #costd3, #costd4, #costd5, #costd6').addClass('d-none');
        $('#reptd1, #reptd2, #reptd3, #reptd4, #reptd5, #reptd6').addClass('d-none');
        $('#nictd1, #nictd2, #nictd3, #nictd4, #nictd5, #nictd6').addClass('d-none');
        $('#GRGUA, #GRSAL, #GRCOS, #GRNIC, #GRREP').addClass('d-none');
        $('#btncolHon').click(function() {
            $('#Enca').text('Honduras');
            $('#GRHON').removeClass('d-none');
            $('#GRGUA, #GRSAL, #GRCOS, #GRNIC, #GRREP').addClass('d-none');

            $('#hontd1, #hontd2, #hontd3, #hontd4, #hontd5, #hontd6').removeClass('d-none');
            $('#guatd1, #guatd2, #guatd3, #guatd4, #guatd5, #guatd6').addClass('d-none');
            $('#saltd1, #saltd2, #saltd3, #saltd4, #saltd5, #saltd6').addClass('d-none');
            $('#costd1, #costd2, #costd3, #costd4, #costd5, #costd6').addClass('d-none');
            $('#reptd1, #reptd2, #reptd3, #reptd4, #reptd5, #reptd6').addClass('d-none');
            $('#nictd1, #nictd2, #nictd3, #nictd4, #nictd5, #nictd6').addClass('d-none');

        });

        $('#btncolGua').click(function() {
            $('#Enca').text('Guatemala');
            $('#GRGUA').removeClass('d-none');
            $('#GRHON, #GRSAL, #GRCOS, #GRNIC, #GRREP').addClass('d-none');
            $('#hontd1, #hontd2, #hontd3, #hontd4, #hontd5, #hontd6').addClass('d-none');
            $('#guatd1, #guatd2, #guatd3, #guatd4, #guatd5, #guatd6').removeClass('d-none');
            $('#saltd1, #saltd2, #saltd3, #saltd4, #saltd5, #saltd6').addClass('d-none');
            $('#costd1, #costd2, #costd3, #costd4, #costd5, #costd6').addClass('d-none');
            $('#reptd1, #reptd2, #reptd3, #reptd4, #reptd5, #reptd6').addClass('d-none');
            $('#nictd1, #nictd2, #nictd3, #nictd4, #nictd5, #nictd6').addClass('d-none');

        });
        $('#btncolSal').click(function() {
            $('#GRSAL').removeClass('d-none');
            $('#GRGUA, #GRHON, #GRCOS, #GRNIC, #GRREP').addClass('d-none');
            $('#Enca').text('El Salvador');
            $('#hontd1, #hontd2, #hontd3, #hontd4, #hontd5, #hontd6').addClass('d-none');
            $('#guatd1, #guatd2, #guatd3, #guatd4, #guatd5, #guatd6').addClass('d-none');
            $('#costd1, #costd2, #costd3, #costd4, #costd5, #costd6').addClass('d-none');
            $('#reptd1, #reptd2, #reptd3, #reptd4, #reptd5, #reptd6').addClass('d-none');
            $('#nictd1, #nictd2, #nictd3, #nictd4, #nictd5, #nictd6').addClass('d-none');
            $('#saltd1, #saltd2, #saltd3, #saltd4, #saltd5, #saltd6').removeClass('d-none');
        });
        $('#btncolCos').click(function() {
            $('#GRCOS').removeClass('d-none');
            $('#GRGUA, #GRHON, #GRSAL, #GRNIC, #GRREP').addClass('d-none');
            $('#Enca').text('Costa Rica');
            $('#hontd1, #hontd2, #hontd3, #hontd4, #hontd5, #hontd6').addClass('d-none');
            $('#guatd1, #guatd2, #guatd3, #guatd4, #guatd5, #guatd6').addClass('d-none');
            $('#saltd1, #saltd2, #saltd3, #saltd4, #saltd5, #saltd6').addClass('d-none');
            $('#reptd1, #reptd2, #reptd3, #reptd4, #reptd5, #reptd6').addClass('d-none');
            $('#nictd1, #nictd2, #nictd3, #nictd4, #nictd5, #nictd6').addClass('d-none');
            $('#costd1, #costd2, #costd3, #costd4, #costd5, #costd6').removeClass('d-none');
        });
        $('#btncolNic').click(function() {
            $('#GRNIC').removeClass('d-none');
            $('#GRGUA, #GRHON, #GRSAL, #GRCOS, #GRREP').addClass('d-none');
            $('#Enca').text('Nicaragua');
            $('#hontd1, #hontd2, #hontd3, #hontd4, #hontd5, #hontd6').addClass('d-none');
            $('#guatd1, #guatd2, #guatd3, #guatd4, #guatd5, #guatd6').addClass('d-none');
            $('#saltd1, #saltd2, #saltd3, #saltd4, #saltd5, #saltd6').addClass('d-none');
            $('#costd1, #costd2, #costd3, #costd4, #costd5, #costd6').addClass('d-none');
            $('#reptd1, #reptd2, #reptd3, #reptd4, #reptd5, #reptd6').addClass('d-none');
            $('#nictd1, #nictd2, #nictd3, #nictd4, #nictd5, #nictd6').removeClass('d-none');
        });
        $('#btncolRep').click(function() {
            $('#GRREP').removeClass('d-none');
            $('#GRGUA, #GRHON, #GRSAL, #GRCOS, #GRNIC').addClass('d-none');
            $('#Enca').text('República Dominicana');
            $('#hontd1, #hontd2, #hontd3, #hontd4, #hontd5, #hontd6').addClass('d-none');
            $('#guatd1, #guatd2, #guatd3, #guatd4, #guatd5, #guatd6').addClass('d-none');
            $('#saltd1, #saltd2, #saltd3, #saltd4, #saltd5, #saltd6').addClass('d-none');
            $('#costd1, #costd2, #costd3, #costd4, #costd5, #costd6').addClass('d-none');
            $('#nictd1, #nictd2, #nictd3, #nictd4, #nictd5, #nictd6').addClass('d-none');
            $('#reptd1, #reptd2, #reptd3, #reptd4, #reptd5, #reptd6').removeClass('d-none');
        });
        //GRAFICAS
        //HONDURAS
        var chart = Highcharts.chart('containerHon', {
            chart: {
                height: 600,
                type: 'column'
            },
            lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'Honduras-Comparativo Marcas',
                sourceWidth: 1200,
                sourceHeight: 800,
            },
            title: {
                text: 'HONDURAS<br><br> Año <?php echo $anofiltro; ?> vs Año <?php echo $anofiltro-1; ?>',
                margin: 50
            },
            xAxis: {
                categories: [
                    <?php   foreach($registrosMarcas as $rowMarcas){ echo "'".$rowMarcas['DESDES']."',"; }; ?>
                ],
                labels: {
                    x: -10
                }
            },
            yAxis: {
                allowDecimals: true,
                title: {
                    text: ' '
                },
                tickInterval: 100000,
                endOnTick: false,
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'Año <?php echo $anofiltro; ?>',
                    data: [
                        <?php   foreach($registrosMarcas as $rowMarcas){ echo (($rowMarcas['VALHON']==0)?0:$rowMarcas['VALHON']).","; }; ?>
                    ],
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: -2,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
                {
                    name: 'Año <?php echo $anofiltro-1; ?>',
                    data: [
                        <?php   foreach($registrosMarcas as $rowMarcas){ echo (($rowMarcas['VALHON2']==0)?0:$rowMarcas['VALHON2']).","; }; ?>
                    ],
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: 5,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal'
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -5
                            },
                            title: {
                                text: null
                            }
                        },
                        subtitle: {
                            text: null
                        },
                        credits: {
                            enabled: false
                        }
                    }
                }]
            }
        });
        //GUATEMALA
        var chart = Highcharts.chart('containerGua', {
            chart: {
                height: 600,
                type: 'column'
            },
            lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'Guatemala-Comparativo Marcas',
                sourceWidth: 1200,
                sourceHeight: 800,
            },
            title: {
                text: 'GUATEMALA<br><br> Año <?php echo $anofiltro; ?> vs Año <?php echo $anofiltro-1; ?>',
                margin: 50
            },
            xAxis: {
                categories: [
                    <?php   foreach($registrosMarcas as $rowMarcas){ echo "'".$rowMarcas['DESDES']."',"; }; ?>
                ],
                labels: {
                    x: -10
                }
            },
            yAxis: {
                allowDecimals: true,
                title: {
                    text: ' '
                },
                endOnTick: false,
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'Año <?php echo $anofiltro; ?>',
                    data: [
                        <?php   foreach($registrosMarcas as $rowMarcas){ echo (($rowMarcas['VALGUA']==0)?0:$rowMarcas['VALGUA']).","; }; ?>
                    ],
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: -2,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
                {
                    name: 'Año <?php echo $anofiltro-1; ?>',
                    data: [
                        <?php   foreach($registrosMarcas as $rowMarcas){ echo (($rowMarcas['VALGUA2']==0)?0:$rowMarcas['VALGUA2']).","; }; ?>
                    ],
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: 5,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal'
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -5
                            },
                            title: {
                                text: null
                            }
                        },
                        subtitle: {
                            text: null
                        },
                        credits: {
                            enabled: false
                        }
                    }
                }]
            }
        });
        //EL SALVADOR
        var chart = Highcharts.chart('containerSal', {
            chart: {
                height: 600,
                type: 'column'
            },
            lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'ElSalvador-Comparativo Marcas',
                sourceWidth: 1200,
                sourceHeight: 800,
            },
            title: {
                text: 'EL SALVADOR<br><br> Año <?php echo $anofiltro; ?> vs Año <?php echo $anofiltro-1; ?>',
                margin: 50
            },
            xAxis: {
                categories: [
                    <?php   foreach($registrosMarcas as $rowMarcas){ echo "'".$rowMarcas['DESDES']."',"; }; ?>
                ],
                labels: {
                    x: -10
                }
            },
            yAxis: {
                allowDecimals: true,
                title: {
                    text: ' '
                },
                endOnTick: false,
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'Año <?php echo $anofiltro; ?>',
                    data: [
                        <?php   foreach($registrosMarcas as $rowMarcas){ echo (($rowMarcas['VALSAL']==0)?0:$rowMarcas['VALSAL']).","; }; ?>
                    ],
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: -2,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
                {
                    name: 'Año <?php echo $anofiltro-1; ?>',
                    data: [
                        <?php   foreach($registrosMarcas as $rowMarcas){ echo (($rowMarcas['VALSAL2']==0)?0:$rowMarcas['VALSAL2']).","; }; ?>
                    ],
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: 5,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal'
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -5
                            },
                            title: {
                                text: null
                            }
                        },
                        subtitle: {
                            text: null
                        },
                        credits: {
                            enabled: false
                        }
                    }
                }]
            }
        });
        //COSTA RICA
        var chart = Highcharts.chart('containerCos', {
            chart: {
                height: 600,
                type: 'column'
            },
            lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'CostaRica-Comparativo Marcas',
                sourceWidth: 1200,
                sourceHeight: 800,
            },
            title: {
                text: 'COSTA RICA<br><br> Año <?php echo $anofiltro; ?> vs Año <?php echo $anofiltro-1; ?>',
                margin: 50
            },
            xAxis: {
                categories: [
                    <?php   foreach($registrosMarcas as $rowMarcas){ echo "'".$rowMarcas['DESDES']."',"; }; ?>
                ],
                labels: {
                    x: -10
                }
            },
            yAxis: {
                allowDecimals: true,
                title: {
                    text: ' '
                },
                endOnTick: false,
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'Año <?php echo $anofiltro; ?>',
                    data: [
                        <?php   foreach($registrosMarcas as $rowMarcas){ echo (($rowMarcas['VALCOS']==0)?0:$rowMarcas['VALCOS']).","; }; ?>
                    ],
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: -2,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
                {
                    name: 'Año <?php echo $anofiltro-1; ?>',
                    data: [
                        <?php   foreach($registrosMarcas as $rowMarcas){ echo (($rowMarcas['VALCOS2']==0)?0:$rowMarcas['VALCOS2']).","; }; ?>
                    ],
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: 5,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal'
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -5
                            },
                            title: {
                                text: null
                            }
                        },
                        subtitle: {
                            text: null
                        },
                        credits: {
                            enabled: false
                        }
                    }
                }]
            }
        });
        //NICARAGUA
        var chart = Highcharts.chart('containerNic', {
            chart: {
                height: 600,
                type: 'column'
            },
            lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'Nicaragua-Comparativo Marcas',
                sourceWidth: 1200,
                sourceHeight: 800,
            },
            title: {
                text: 'NICARAGUA<br><br> Año <?php echo $anofiltro; ?> vs Año <?php echo $anofiltro-1; ?>',
                margin: 50
            },
            xAxis: {
                categories: [
                    <?php   foreach($registrosMarcas as $rowMarcas){ echo "'".$rowMarcas['DESDES']."',"; }; ?>
                ],
                labels: {
                    x: -10
                }
            },
            yAxis: {
                allowDecimals: true,
                title: {
                    text: ' '
                },
                endOnTick: false,
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'Año <?php echo $anofiltro; ?>',
                    data: [
                        <?php   foreach($registrosMarcas as $rowMarcas){ echo (($rowMarcas['VALNIC']==0)?0:$rowMarcas['VALNIC']).","; }; ?>
                    ],
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: -2,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
                {
                    name: 'Año <?php echo $anofiltro-1; ?>',
                    data: [
                        <?php   foreach($registrosMarcas as $rowMarcas){ echo (($rowMarcas['VALNIC2']==0)?0:$rowMarcas['VALNIC2']).","; }; ?>
                    ],
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: 5,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal'
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -5
                            },
                            title: {
                                text: null
                            }
                        },
                        subtitle: {
                            text: null
                        },
                        credits: {
                            enabled: false
                        }
                    }
                }]
            }
        });
        //REP DOMINICANA
        var chart = Highcharts.chart('containerRep', {
            chart: {
                height: 600,
                type: 'column'
            },
            lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'RepDominicana-Comparativo Marcas',
                sourceWidth: 1200,
                sourceHeight: 800,
            },
            title: {
                text: 'REP. DOMINICANA<br><br> Año <?php echo $anofiltro; ?> vs Año <?php echo $anofiltro-1; ?>',
                margin: 50
            },
            xAxis: {
                categories: [
                    <?php   foreach($registrosMarcas as $rowMarcas){ echo "'".$rowMarcas['DESDES']."',"; }; ?>
                ],
                labels: {
                    x: -10
                }
            },
            yAxis: {
                allowDecimals: true,
                title: {
                    text: ' '
                },
                endOnTick: false,
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'Año <?php echo $anofiltro; ?>',
                    data: [
                        <?php   foreach($registrosMarcas as $rowMarcas){ echo (($rowMarcas['VALREP']==0)?0:$rowMarcas['VALREP']).","; }; ?>
                    ],
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: -2,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
                {
                    name: 'Año <?php echo $anofiltro-1; ?>',
                    data: [
                        <?php   foreach($registrosMarcas as $rowMarcas){ echo (($rowMarcas['VALREP2']==0)?0:$rowMarcas['VALREP2']).","; }; ?>
                    ],
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: 5,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal'
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -5
                            },
                            title: {
                                text: null
                            }
                        },
                        subtitle: {
                            text: null
                        },
                        credits: {
                            enabled: false
                        }
                    }
                }]
            }
        });
        if (<?php echo $validator;?> == true) {
            $("#grafica").addClass("d-none");
        }

    });

    function chargeTable() {
        var cias = $("#cbbCia").val();
        if (cias.length == 0) {
            cias = [999];
            $("#cbbCia").val(cias).trigger('change');
        }
        if (cias.includes("999") && cias.length > 1) {
            cias = cias.filter(function(valor) {
                return valor !== "999";
            });
            $("#cbbCia").val(cias).trigger('change');
        }
        const divTabla = $("#tablaTiendas");
        var ano2 = '<?php echo $ano2; ?>';
        var mesNum1 = '<?php echo $mesNum1; ?>';
        var mesNum2 = '<?php echo $mesNum2; ?>';
        var urlGet = "http://172.16.15.20/API.LovablePHP/ZLO0003P/ListMarcasTiendas2/?ano=" + ano2 + "&mes=" + mesNum1 +
            "&mes2=" + mesNum2 + "&marca=" + cias + "";
        var response = ajaxRequest(urlGet);
        var tiendasAno1 = [];
        var tiendasAno2 = [];
        if (response.code == 200) {
            var data = response.data;
            var rows = "";
            for (let i = 0; i < data.length; i++) {
                ano1hon = (data[i]['HONVALANO1'] != 0) ? (data[i]['HONVALANO1']) : 0;
                ano2hon = (data[i]['HONVALANO2'] != 0) ? (data[i]['HONVALANO2']) : 0;
                can1hon = (data[i]['HONCANANO1'] != 0) ? (data[i]['HONCANANO1']) : 0;
                can2hon = (data[i]['HONCANANO2'] != 0) ? (data[i]['HONCANANO2']) : 0;
                varhon = ano1hon - ano2hon;
                crehon = (ano1hon != 0 && ano2hon != 0) ? parseFloat(((ano1hon / ano2hon) - 1) * 100) : 0;
                if (parseFloat(varhon) < 0) {
                    varhon = "<td class='fw-bold  text-danger text-end'>D." + varhon.toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + "</td>";
                } else {
                    varhon = "<td class='fw-bold  text-success text-end'>D." + varhon.toLocaleString('es-419', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }) + "</td>";
                }
                if (parseFloat(crehon) < 0) {
                    crehon = "<td class='fw-bold  text-danger text-end'>" + crehon.toLocaleString('es-419', {
                        maximumFractionDigits: 0
                    }) + "%</td>";
                } else {
                    crehon = "<td class='fw-bold  text-success text-end'>" + crehon.toLocaleString('es-419', {
                        maximumFractionDigits: 0
                    }) + "%</td>";
                }
                rows += "<tr>";
                rows += "<td>" + data[i].MARCA + "</td>";
                rows += "<td class='text-start'>" + data[i].DESDES + "</td>";
                rows += "<td class='text-end'>" + parseFloat(can1hon).toLocaleString('es-419') + "</td>";
                rows += "<td class='text-end'>" + parseFloat(can2hon).toLocaleString('es-419', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + "</td>";
                rows += "<td class='text-end'>D." + parseFloat(ano1hon).toLocaleString('es-419') + "</td>";
                rows += "<td class='text-end'>D." + parseFloat(ano2hon).toLocaleString('es-419', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + "</td>";
                rows += varhon;
                rows += crehon;
                rows += "</tr>";
                tiendasAno1.push(parseFloat(ano1hon));
                tiendasAno2.push(parseFloat(ano2hon));
            }
        }
        divTabla.empty();
        divTabla.append(`<div>
                            <div class="col-12 col-lg-12">
                                    <figure class="highcharts-figure">
                                        <div id="containerMarcas"></div>
                                </figure>
                            </div>
                        </div>
                            <div class="col-12">
                            <div class="table-responsive">
                            <table id="myTableTiendas"  class="table stripe table-hover mt-5" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th class="text-start responsive-font-example">Marcas</th>
                                    <th class="text-end responsive-font-example">Unidades Año <?php echo $ano2;?></th>
                                    <th class="text-end responsive-font-example">Unidades Año <?php echo $ano2-1;?></th>
                                    <th class="responsive-font-example text-end">Valor Año <?php echo $ano2;?></th>
                                    <th class="responsive-font-example text-end">Valor Año <?php echo $ano2-1;?></th>
                                    <th class="responsive-font-example text-end">Variación</th>
                                    <th class="responsive-font-example text-end">Crecimiento</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyTiendas">

                                </tbody>
                            </table>
                            </div>
                            </div>`);
        $("#tbodyTiendas").append(rows);
        var table6 = $('#myTableTiendas').DataTable({
            autoWidth: false,
            stateSave: true,
            "ordering": false,
            "pageLength": 100,
            "language": {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            "columnDefs": [{
                target: 0,
                visible: false,
                searchable: true,
            }, ],
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light fs-6 ",
                exportOptions: {
                    columns: [1, 2, 3, 4, 5, 6, 7]
                },
                title: 'ReporteMarcasxTiendas',
                messageTop: 'TIENDAS: ' + $('#cbbCia').find(":selected").text(),
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    var sSh = xlsx.xl['styles.xml'];
                    var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                    var lastFontIndex = $('fonts font', sSh).length - 1;
                    var i;
                    var y;
                    var f1 = '<font>' +
                        '<sz val="11" />' +
                        '<name val="Calibri" />' +
                        '<color rgb="FF0000" />' + // color rojo en la fuente
                        '</font>';
                    var f2 = '<font>' +
                        '<sz val="11" />' +
                        '<name val="Calibri" />' +
                        '<color rgb="007800" />' + // color verde en la fuente
                        '</font>';

                    var n1 = '<numFmt formatCode="##0%"   numFmtId="300"/>';
                    var n2 = '<numFmt formatCode="#,##0.00"   numFmtId="200" />';
                    var s1 =
                        '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                    var s2 =
                        '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                        '<alignment horizontal="center"/></xf>';
                    var s3 =
                        '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                    var s4 =
                        '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                        '<alignment horizontal="center" wrapText="1"/></xf>'
                    var s5 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 1) +
                        '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                        '<alignment horizontal="right"/></xf>';
                    var s6 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 2) +
                        '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                        '<alignment horizontal="right"/></xf>';
                    var s7 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 1) +
                        '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                        '<alignment horizontal="right"/></xf>';
                    var s8 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 2) +
                        '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                        '<alignment horizontal="right"/></xf>';
                    sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                    sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2;
                    sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 + s7 +
                        s8;

                    var fourDecPlaces = lastXfIndex + 1;
                    var greyBoldCentered = lastXfIndex + 2;
                    var twoDecPlacesBold = lastXfIndex + 3;
                    var greyBoldWrapText = lastXfIndex + 4;
                    var textred1 = lastXfIndex + 5;
                    var textgreen1 = lastXfIndex + 6;
                    var textred2 = lastXfIndex + 7;
                    var textgreen2 = lastXfIndex + 8;

                    $('c[r=A1] t', sheet).text('COMPARATIVO VENTAS TODAS LAS MARCAS POR TIENDAS ' +
                        '<?php echo $labelSelect; ?>');
                    $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                    $('row:eq(1) c', sheet).attr('s', 7);
                    for (let index = 3; index <= 40; index++) {

                        if (($('row:eq(' + index + ') c[r^="G"]', sheet).text() * 1 < 0)) {
                            $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s', textred2); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="G"]', sheet).attr('s',
                                textgreen2); //VERDE
                        }
                    }
                    for (let index = 3; index <= 40; index++) {

                        if (parseFloat(($('row:eq(' + index + ') c[r^="F"]', sheet).text()).slice(
                                2)) < 0) {
                            $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s', textred1); //ROJO
                        } else {
                            $('row:eq(' + index + ') c[r^="F"]', sheet).attr('s',
                                textgreen1); //VERDE
                        }
                    }

                    var tagName = sSh.getElementsByTagName('sz');
                    for (i = 0; i < tagName.length; i++) {
                        tagName[i].setAttribute("val", "13");
                    }


                }

            }]
        });

        //TODAS LAS MARCAS
        var chart = Highcharts.chart('containerMarcas', {
            chart: {
                height: 600,
                type: 'column'
            },
            lang: {
                viewFullscreen: "Ver en pantalla completa",
                exitFullscreen: "Salir de pantalla completa",
                downloadJPEG: "Descargar imagen JPEG",
                downloadPDF: "Descargar en PDF",
            },
            exporting: {
                buttons: {
                    contextButton: {
                        menuItems: ["viewFullscreen", "separator", "downloadJPEG", "downloadPDF"]
                    }
                },
                enabled: true,
                filename: 'Tiendas-Comparativo Marcas',
                sourceWidth: 1200,
                sourceHeight: 800,
            },
            title: {
                text: '<span style="font-size:16px;">' + $('#cbbCia').find(":selected").text() +
                    '<span><br><br> Año <?php echo $anofiltro; ?> vs Año <?php echo $anofiltro-1; ?>',
                margin: 50
            },
            xAxis: {
                categories: [
                    <?php   foreach($registrosMarcas as $rowMarcas){ echo "'".$rowMarcas['DESDES']."',"; }; ?>
                ],
                labels: {
                    x: -10
                }
            },
            yAxis: {
                allowDecimals: true,
                title: {
                    text: ' '
                },
                tickInterval: 100000,
                endOnTick: false,
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'Año <?php echo $anofiltro; ?>',
                    data: tiendasAno1,
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: -2,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
                {
                    name: 'Año <?php echo $anofiltro-1; ?>',
                    data: tiendasAno2,
                    dataLabels: [{
                        align: "center",
                        inside: false,
                        rotation: 290,
                        y: -25,
                        x: 5,
                        enabled: true,
                        borderColor: "",
                        style: {
                            fontSize: "12px",
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                            textShadow: false
                        }
                    }],
                },
            ],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal'
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -5
                            },
                            title: {
                                text: null
                            }
                        },
                        subtitle: {
                            text: null
                        },
                        credits: {
                            enabled: false
                        }
                    }
                }]
            }
        });
    }
    </script>
    <script src="../../assets/vendors/monthpicker/picker.js"></script>
    <script src="../../assets/vendors/monthpicker/calendars.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>