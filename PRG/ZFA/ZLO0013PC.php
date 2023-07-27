<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
   

</head>

<body>
    <div class="spinner-wrapper">
        <span class="loader"></span>
    </div>
    <?php
    include '../layout-prg.php';
    include '../../assets/php/ZFA/ZLO0013P/header.php';
    $marca=isset($_SESSION['marca'])?$_SESSION['marca']:"900";
    $plan=isset($_SESSION['plan'])?$_SESSION['plan']:"4";
    $estado=isset($_SESSION['estado'])?$_SESSION['estado']:"1";
    $inventarios=isset($_SESSION['inventarios'])?$_SESSION['inventarios']:"1";
    $clasificacion=isset($_SESSION['clasificacion'])?$_SESSION['clasificacion']:"3";
    $orden=isset($_SESSION['orden'])?$_SESSION['orden']:"1";
    $filtro=isset($_SESSION['filtro'])?$_SESSION['filtro']:"3";
    $repro=isset($_SESSION['repro'])?$_SESSION['repro']:"3";
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Producto Terminado / Clasificación de producto</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0013P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Planeación agregada de operaciones y ventas</h1>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <!---->
                    <form id="formFiltros" action="../../assets/php/ZFA/ZLO0013P/filtrosLogica.php" action="#" method="POST">
                        <div class="row mb-2">
                            <div class="col-12">
                                <div id="isComputer">
                                <div class="btn-group flex-wrap d-flex justify-content-center justify-content-md-start mb-2 mt-2" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check " name="btncols" value="100" id="btn100" autocomplete="off" >
                                    <label class="btn btn-outline-secondary responsive-font-example pt-3 pb-3 text-black"  for="btn100"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/100.GIF" alt="" ></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="200"  id="btn200" autocomplete="off">
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black" for="btn200"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/200.GIF" alt="" ></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="210" id="btn210" autocomplete="off">
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"  for="btn210"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/210.GIF" alt="" ></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="250" id="btn250" autocomplete="off" >
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black" for="btn250"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/250.JPG" alt="" style="height: 50px; margin-top:10px;"></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="450" id="btn450" autocomplete="off" >
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"  for="btn450"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/450.GIF" alt="" ></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="500" id="btn500" autocomplete="off"  >
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black" for="btn500"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/500.GIF" alt="" ></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="550" id="btn550" autocomplete="off" >
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"  for="btn550"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/550.GIF" alt="" style="height: 50px; margin-top:10px;"></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="600" id="btn600" autocomplete="off"  >
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black" for="btn600"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/600.GIF" alt="" ></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="650" id="btn650" autocomplete="off"  >
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black" for="btn650"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/650.GIF" alt="" ></b></label>
                                </div>
                            <div class="btn-group flex-wrap d-flex justify-content-center justify-content-md-start mb-2 mt-2" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btncols" value="700" id="btn700" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"  for="btn700"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/700.GIF" alt="" ></b></label>
                                
                                <input type="radio" class="btn-check" name="btncols" value="800" id="btn800" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"  for="btn800"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/800.GIF" alt="" ></b></label>

                                <input type="radio" class="btn-check" name="btncols" value="900" id="btn900" autocomplete="off">
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"  for="btn900"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/900.GIF" alt="" ></b></label>
                            
                                <input type="radio" class="btn-check" name="btncols" value="360" id="btn360" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"  for="btn360"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/360.GIF" alt="" style="height: 50px; margin-top:10px;"></b></label>
                                
                                <input type="radio" class="btn-check" name="btncols" value="930" id="btn930" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"  for="btn930" ><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/930.GIF" alt="" ></b></label>

                                <input type="radio" class="btn-check" name="btncols" value="940" id="btn940" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"  for="btn940" ><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/940.GIF" alt="" ></b></label>
                            
                                <input type="radio" class="btn-check" name="btncols" value="950" id="btn950" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"  for="btn950" ><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/950.GIF" alt="" ></b></label>

                                <input type="radio" class="btn-check" name="btncols" value="230" id="btn230" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black"  for="btn230" ><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/230.GIF" alt="" ></b></label>

                                <input type="radio" class="btn-check" name="btncols" value="all" id="btnall" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  text-black"style="padding-top: 40px;"  for="btnall" ><b class="fw-bold fs-5" >TODOS</b></label>
                            </div>
                                
                                </div> 
                                <div id="isPhone">
                                    <div class="row">
                                        <div class="col-12">
                                        <label class="mb-2">Marcas:</label>
                                            <select class="form-select  mt-1 mb-3 mb-lg-0" id="cbbMarca" name="cbbMarca">
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-12 ">
                                <label class="mb-2">Planeación Agregada:</label>
                                <select class="form-select  mt-1 mb-3 mb-lg-0" id="cbbPlan" name="cbbPlan">
                                    <option value="1">Plan 30 días</option>
                                    <option value="2">Plan 60 días</option>
                                    <option value="3">Plan 90 días</option>
                                    <option value="4" selected>Todos</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mt-4 ">
                                <div class="row">
                                    <div class="col-7">
                                        <label class="mb-3">Tipos de Inventario</label>
                                        <div class="form-control">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rbInventarios" value="1" id="rbInv1" >
                                                <label class="form-check-label" for="rbInv1">
                                                    En Línea
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rbInventarios" value="2" id="rbInv2">
                                                <label class="form-check-label" for="rbInv2">
                                                    Descontinuado
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rbInventarios" value="3" id="rbInv3">
                                                <label class="form-check-label" for="rbInv3">
                                                    Todo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <label class="mb-3">Clasificación</label>
                                        <div class="form-control">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rbClasificacion" value="1" id="rbCla1">
                                                <label class="form-check-label" for="rbCla1">
                                                    Local
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rbClasificacion" value="2" id="rbCla2" >
                                                <label class="form-check-label" for="rbCla2">
                                                    Importado
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rbClasificacion" value="3" id="rbCla3" >
                                                <label class="form-check-label" for="rbCla3">
                                                    Todo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-lg-6 mt-4">

                                <div class="row">
                                    <div class="col-12 col-lg-4  text-start">
                                        <label class="mb-3">Ordenar por</label>
                                        <div class="form-control">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rbOrden" value="1" id="rbOrd1" >
                                            <label class="form-check-label" for="rbOrd1">
                                                Estilo y color
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rbOrden" value="2" id="rbOrd2" >
                                            <label class="form-check-label" for="rbOrd2">
                                                Talla
                                            </label>
                                        </div><br>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label class="mb-3">Filtrar por</label>
                                        <div class="form-control">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rbFiltro" value="1" id="rbFil1">
                                            <label class="form-check-label" for="rbFil1">
                                                <= Lead Time </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rbFiltro" value="2" id="rbFil2">
                                            <label class="form-check-label" for="rbFil2">
                                                <= Lead Time + 1 Mes </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rbFiltro" value="3" id="rbFil3" >
                                            <label class="form-check-label" for="rbFil3">
                                                Todo
                                            </label>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4 text-start">
                                        <label class="mb-3">No Reprogramable</label>
                                        <div class="form-control">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rbRepro" value="1" id="rbRep1">
                                            <label class="form-check-label" for="rbRep1">
                                                Si </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rbRepro" value="2" id="rbRep2">
                                            <label class="form-check-label" for="rbRep2">
                                               No </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="rbRepro" value="3" id="rbRep3" >
                                            <label class="form-check-label" for="rbRep3">
                                                Todo
                                            </label>
                                        </div>
                                        </div>
                                </div>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
                <hr>
                <div class="table-container mt-3" id="planeacionContainer" style="width:100%">
                    <table id="myTablePlaneacion" class="table stripe table-hover "style="width:100%">
                        <thead>
                            <tr >
                                <th colspan="32" id="thProcessing" style="height:80px;"></th>
                            </tr>
                            <tr class="sticky-top bg-white">
                                <th class="text-black text-start">MARCA</th>
                                <th class="text-black text-start">ESTILO</th>
                                <th class="text-black text-start">COLOR</th>
                                <th class="text-black text-start">TALLA</th>
                                <th class="text-black text-start">T/INV</th>
                                <th class="text-black text-end">DOC. VEN. AÑO/ACT</th>
                                <th class="text-black text-end">VAL. VEN. AÑO/ACT</th>
                                <th class="text-black text-end">PROM. MES</th>
                                <th class="text-black text-end"># MESES</th>
                                <th class="text-black text-end">UND VTAS. MES/ANT</th>
                                <th class="text-black text-end">PERDIDA. VTAS</th>
                                <th class="text-black text-end">PROM. PERDIDA VTAS</th>
                                <th class="text-black text-end">APARTADO VEND</th>
                                <th class="text-black text-end">APARTADO VENTA X CATALOGO</th>
                                <th class="text-black text-end">INVENTARIO DISPONBLE</th>
                                <th class="text-black text-end">INVENTARIO PROCESO</th>
                                <th class="text-black text-end">INVENTARIO CORTADO</th>
                                <th class="text-black text-end">CORTE</th>
                                <th class="text-black text-end">INV. MTP</th>
                                <th class="text-black text-end" >MESES INV</th>
                                <th class="text-black text-end">PROGRAMA</th>
                                <th class="text-black text-end">LEAD TIME</th>
                                <th class="text-black text-end">MESES PRG 12M</th>
                                <th class="text-black text-end">PROM. MEN. 12M</th>
                                <th class="text-black text-end"># MESES 12M</th>
                                <th class="text-black text-end">MESES INV. 6M</th>
                                <th class="text-black text-end">PROM. MEN. 6M</th>
                                <th class="text-black text-end"># MESES 6M</th>
                                <th class="text-black text-end">PROM X MES AÑO/ANT</th>
                                <th class="text-black text-end"># MESES AÑO/ANT</th>
                                <th class="text-black text-end">DOC. VEND. AÑO/ANT.</th>
                                <th class="text-black text-end">VALOR VENDIDO AÑO/ANT</th>

                            </tr>
                        </thead>
                        <tbody id="myTablePlaneacionBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
        <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
         
         var totalUNIVAA = 0;
        var totalVALVAA = 0;
    $( document ).ready(function() {
        $("#btn100,#btn200,#btn210,#btn250,#btn450,#btn500,#btn550,#btn600,#btn650,#btn700,#btn800,#btn900,#btn360,#btn930,#btn940,#btn950,#btn230,#btnall").on("click",function(){
            $("#formFiltros").submit();
        });
        var urlComarc='http://172.16.15.20/API.LovablePHP/ZLO0003P/ListComarc/';
        var responseComarc = ajaxRequest(urlComarc);

        //LLENADO DE MARCAS
        if (responseComarc.code==200) { 
            var cbbMarca=$("#cbbMarca");
              for (let i = 0; i < responseComarc.data.length; i++) {
                cbbMarca.append(' <option value='+responseComarc.data[i]['DESCO1']+' selected>'+responseComarc.data[i]['DESDES']+'</option>');
              }
            }
        var marca='<?php echo $marca; ?>';
        var plan='<?php echo $plan; ?>';
        var estado='<?php echo $estado; ?>';
        var inventarios='<?php echo $inventarios; ?>';
        var clasificacion='<?php echo $clasificacion; ?>';
        var orden='<?php echo $orden; ?>';
        var filtro='<?php echo $filtro; ?>';
        var repro='<?php echo $repro; ?>';
        console.log(marca+' '+plan+' '+estado+' '+inventarios+' '+clasificacion+' '+orden+' '+filtro+' '+repro)
        console.log("http://172.16.15.20/API.LovablePHP/ZLO0013P/ListAsync/?marca="+marca+"&plan="+plan+"&estado="+estado+"&inventarios="+inventarios+"&clasificacion="+clasificacion+"&orden="+orden+"&filtro="+filtro+"&repro="+repro+"");  
        $("#btn"+marca).prop("checked",true);
            $("#cbbMarca").val(marca);
            $("#cbbPlan").val(plan);
            $("#cbbEstad").val(estado);
            $("#rbInv"+inventarios).prop("checked",true);
            $("#rbCla"+clasificacion).prop("checked",true);
            $("#rbOrd"+orden).prop("checked",true);
            $("#rbFil"+filtro).prop("checked",true);
            $("#rbRep"+repro).prop("checked",true);
            var requestError = false;
          var table= $('#myTablePlaneacion').DataTable( {
            language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "pageLength": 50,
                "processing": true,
                "serverSide": true,
                
                "ajax": {
                    "url": "http://172.16.15.20/API.LovablePHP/ZLO0013P/ListAsync/?marca="+marca+"&plan="+plan+"&estado="+estado+"&inventarios="+inventarios+"&clasificacion="+clasificacion+"&orden="+orden+"&filtro="+filtro+"&repro="+repro+"",
                    "type": "POST",
                    "beforeSend": function () {
                    
                        $("#planeacionContainer").addClass("loading");
                    },
                    "complete": function (xhr) {
                        if (requestError) {
                            var table = $('#myTablePlaneacion');
                            table.find('tbody').empty();
                            table.append('<tbody><tr><td colspan="12" class="text-center" style="height:94.5px;"><span class="mt-2">No se encontraron resultados</span></td><td colspan="22"></td></tr></tbody>');
                        } else {
                            $("#planeacionContainer").removeClass("loading");
                                        $("#thProcessing").addClass('d-none');
                                        console.log(xhr.responseJSON);
                           
                        }
                        
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                        requestError = true;
                    }
                },
                "columns": [
                    {data:"MARCA",
                        className:"text-start",},
                    {data:"ESTILO",
                        className:"text-start",},
                    {data:"COLOR",
                        className:"text-start",},
                    {data:"TALLA",
                        className:"text-start",},
                    {data:"TIPINV",
                        className:"text-start",orderable: false },
                    {data:"UNIVAA",
                        className:"text-primary text-end",
                        render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"VALVAA",
                        className:"text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"UPRMAC",
                       className:"text-primary text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"NUMMES",
                        className:"text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    },orderable: false },
                    {data:"DOCVAL",
                         className:"text-brown text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"UVENRE",
                       className:"text-darkblue text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"UVNRPR",
                        className:"text-danger text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"INVAPA",
                       className:"text-info text-end",  render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"APAVXC",
                        className:"text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"INVPTE",
                       className:"text-success text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"INVPRO",
                        className:"text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                {data:"INVPR1",
                        className:"text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"INVCOR",
                        className:"text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"INVMTP",
                        className:"text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"WUNIINV",
                        className:"text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }},
                    {data:"INVPGR",
                        className:"text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"LEATIE",
                        className:"text-success text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                   
                    {data:"MESINV",
                       className:"text-darkblue text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"UPRM1A",
                       className:"text-danger text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"NUMME1",
                        className:"text-end"},
                    {data:"MESIN6",
                        className:"text-darkblue text-end"},
                    {data:"UPRM6A",className:"text-danger", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"NUMME6",
                        className:"text-end"},
                    {data:"UPRMAV",
                        className:"text-info text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"NUMMEV",
                        className:"text-end"},
                    {data:"DOCANT",
                        className:"text-info text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }},
                    {data:"VALANT",
                        className:"text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }},
                ],
                ordering: true,
                dom: 'Bfrtip',
                buttons: [
                    {
                    text: '<i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>',
                    className: "btn btn-success text-light fs-6 mb-2 ladda-button1 text-center",
                    action: function ( e, dt, node, config ) {
                    }
                  },
                    {
                    text: '<i class="fa-solid fa-file-excel me-1"></i><b>Analisis de compras</b>',
                    className: "btn btn-primary text-light fs-6 mb-2 ladda-button2  text-center",
                    action: function ( e, dt, node, config ) {
                    
                    }
                  },
                  {
                    text: '<i class="fa-solid fa-file-excel me-1"></i><b>Analisis de Inv. Almacén</b>',
                    className: "btn btn-primary text-light fs-6 mb-2 ladda-button3  text-center",
                    action: function ( e, dt, node, config ) {
                    
                    }
                  }
                ],
                rowCallback: function(row, data) {
        if (data.TIPINV === 'TOTAL') {
            $(row).addClass('total-row');
        }else{
            if (data.UNIVAA !='') {
             totalUNIVAA += parseFloat(data.UNIVAA);
            }
            if (data.VALVAA !='') {
             totalVALVAA += parseFloat(data.VALVAA);
            }
        }
        },drawCallback: function(settings) {
                console.log(totalUNIVAA);
                console.log(totalVALVAA);
            },

            });
            table.on('draw.dt', function() {
                  $('.ladda-button1').each(function() {
                   
                    var l = Ladda.create(this);
                    $(this).on('click', function() {
                        $(".ladda-button1, .ladda-button2, .ladda-button3").prop("disabled",true);
                      l.start();
                      var urlExcel = "http://172.16.15.20/API.LovablePHP/ZLO0013P/Reporte1/?marca="+marca+"&plan="+plan+"&estado="+estado+"&inventarios="+inventarios+"&clasificacion="+clasificacion+"&orden="+orden+"&filtro="+filtro+"&repro="+repro+"";
                     window.location.href = urlExcel;
                      var xhr = new XMLHttpRequest();
                      xhr.open('HEAD', urlExcel);
                      xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                          if (xhr.status === 200) {
                            var procesosTerminados = xhr.getResponseHeader('X-Procesos-Terminados');
                            if (procesosTerminados) {
                                
                            } else {
                                $(".ladda-button1, .ladda-button2, .ladda-button3").prop("disabled",false);
                            }
                          } else {
                            //console.log('Ocurrió un error al obtener el encabezado.');
                          }
                          l.stop();
                        }
                      };
                      xhr.send();
                    });
                  });
                });
                
                table.on('draw.dt', function() {
                  $('.ladda-button2').each(function() {
                    var l = Ladda.create(this);
                    $(this).on('click', function() {
                        $(".ladda-button1, .ladda-button2, .ladda-button3").prop("disabled",true);
                      l.start();
                      var urlExcel = "http://172.16.15.20/API.LOVABLEPHP/ZLO0012P/ExportAll/?agrup="+1+"&cond=1&filtro="+2+"";
                     window.location.href = urlExcel;
                      var xhr = new XMLHttpRequest();
                      xhr.open('HEAD', urlExcel);
                      xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                          if (xhr.status === 200) {
                            var procesosTerminados = xhr.getResponseHeader('X-Procesos-Terminados');
                            if (procesosTerminados) {
                               
                            } else {
                                $(".ladda-button1, .ladda-button2, .ladda-button3").prop("disabled",false);
                            }
                          } else {
                            //console.log('Ocurrió un error al obtener el encabezado.');
                          }
                          l.stop();
                        }
                      };
                      xhr.send();
                    });
                  });
                  $(".ladda-button1, .ladda-button2, .ladda-button3").prop("disabled",false);
                });

                table.on('draw.dt', function() {
                  $('.ladda-button3').each(function() {
                    var l = Ladda.create(this);
                    $(this).on('click', function() {
                        $(".ladda-button1, .ladda-button2, .ladda-button3").prop("disabled",true);
                      l.start();
                      var urlExcel = "http://172.16.15.20/API.LOVABLEPHP/ZLO0012P/ExportAll/?agrup="+1+"&cond=1&filtro="+2+"";
                     window.location.href = urlExcel;
                      var xhr = new XMLHttpRequest();
                      xhr.open('HEAD', urlExcel);
                      xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4) {
                          if (xhr.status === 200) {
                            var procesosTerminados = xhr.getResponseHeader('X-Procesos-Terminados');
                            if (procesosTerminados) {
                               
                            } else {
                                $(".ladda-button1, .ladda-button2, .ladda-button3").prop("disabled",false);
                            }
                          } else {
                            //console.log('Ocurrió un error al obtener el encabezado.');
                          }
                          l.stop();
                        }
                      };
                      xhr.send();
                    });
                  });
                  $(".ladda-button1, .ladda-button2, .ladda-button3").prop("disabled",false);
                });
         });
    </script>
</body>

</html>