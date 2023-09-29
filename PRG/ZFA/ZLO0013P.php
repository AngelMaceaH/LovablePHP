<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>
<body>
    <?php
    include '../layout-prg.php';
    include '../../assets/php/ZFA/ZLO0013P/header.php';
    $marca=isset($_SESSION['marca'])?$_SESSION['marca']:"900";
    $plan=isset($_SESSION['plan'])?$_SESSION['plan']:"4";
    $inventarios=isset($_SESSION['inventarios'])?$_SESSION['inventarios']:"1";
    $clasificacion=isset($_SESSION['clasificacion'])?$_SESSION['clasificacion']:"3";
    $orden=isset($_SESSION['orden'])?$_SESSION['orden']:"1";
    $filtro=isset($_SESSION['filtro'])?$_SESSION['filtro']:"3";
    $repro=isset($_SESSION['repro'])?$_SESSION['repro']:"3";

    $estado=isset($_SESSION['estado'])?$_SESSION['estado']:"0";
    $btnOrder=isset($_SESSION['btnOrderValue'])?$_SESSION['btnOrderValue']:"0";

    $formato=isset($_SESSION['formato'])?$_SESSION['formato']:"0";
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
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-secondary pe-3 ps-3" onclick="animateMenu()"> <i id="iconArrow" class="fa-solid fa-angles-up text-white"></i></button>
                            </div>
                        </div>
                    </div>
                   <div class="card-body" id="menuMarcas">
                   <form class="" id="formFiltros" action="../../assets/php/ZFA/ZLO0013P/filtrosLogica.php" action="#" method="POST">
                        <div class="row mb-2">
                            <div class="col-12 ">
                                <input type="text" class="d-none" id="boole" name="boole">
                                <div id="isComputer">
                                <div class="btn-group flex-wrap d-flex justify-content-center justify-content-lg-start mb-2 mt-2" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check " name="btncols" value="100" id="btn100" autocomplete="off" >
                                    <label class="btn btn-outline-secondary responsive-font-example pt-3 pb-3 text-black menuMarca"  for="btn100"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/100.GIF" alt="" ></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="200"  id="btn200" autocomplete="off">
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca" for="btn200"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/200.GIF" alt="" ></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="210" id="btn210" autocomplete="off">
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"  for="btn210"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/210.GIF" alt="" ></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="250" id="btn250" autocomplete="off" >
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca" for="btn250"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/250.JPG" alt="" style="height: 50px; margin-top:10px;"></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="450" id="btn450" autocomplete="off" >
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"  for="btn450"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/450.GIF" alt="" ></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="500" id="btn500" autocomplete="off"  >
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca" for="btn500"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/500.GIF" alt="" ></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="550" id="btn550" autocomplete="off" >
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"  for="btn550"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/550.GIF" alt="" style="height: 50px; margin-top:10px;"></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="600" id="btn600" autocomplete="off"  >
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca" for="btn600"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/600.GIF" alt="" ></b></label>

                                    <input type="radio" class="btn-check" name="btncols" value="650" id="btn650" autocomplete="off"  >
                                    <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca" for="btn650"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/650.GIF" alt="" ></b></label>
                                    <input type="radio" class="btn-check" name="btncols" value="700" id="btn700" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"  for="btn700"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/700.GIF" alt="" ></b></label>
                                
                                <input type="radio" class="btn-check" name="btncols" value="800" id="btn800" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"  for="btn800"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/800.GIF" alt="" ></b></label>

                                <input type="radio" class="btn-check" name="btncols" value="900" id="btn900" autocomplete="off">
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"  for="btn900"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/900.GIF" alt="" ></b></label>
                            
                                <input type="radio" class="btn-check" name="btncols" value="360" id="btn360" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"  for="btn360"><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/360.GIF" alt="" style="height: 50px; margin-top:10px;"></b></label>
                                
                                <input type="radio" class="btn-check" name="btncols" value="930" id="btn930" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"  for="btn930" ><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/930.GIF" alt="" ></b></label>

                                <input type="radio" class="btn-check" name="btncols" value="940" id="btn940" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"  for="btn940" ><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/940.GIF" alt="" ></b></label>
                            
                                <input type="radio" class="btn-check" name="btncols" value="950" id="btn950" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"  for="btn950" ><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/950.GIF" alt="" ></b></label>

                                <input type="radio" class="btn-check" name="btncols" value="230" id="btn230" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"  for="btn230" ><b><img class="img-fluid round1 imgButtons" src="../../assets/img/icons/230.GIF" alt="" ></b></label>

                                <input type="radio" class="btn-check" name="btncols" value="all" id="btnall" autocomplete="off" >
                                <label class="btn btn-outline-secondary responsive-font-example  text-black menuMarca"style="padding-top: 30px;"  for="btnall" ><b style="font-size:12px" >TODOS</b></label>
                                </div>
                           <!-- <div class="btn-group flex-wrap d-flex justify-content-center justify-content-lg-start mb-2 mt-2" role="group" aria-label="Basic radio toggle button group">
                               
                            </div>-->
                                
                                </div> 
                                <div id="isPhone">
                                    <div class="row">
                                        <div class="col-12">
                                        <label class="mb-2">Marcas:</label>
                                            <select class="form-select  mt-1 mb-3 mb-lg-0" id="cbbMarca" name="cbbMarca">
                                                <option value="all">TODOS</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-12 col-lg-4 ">
                                <label class="mb-2">Formato de reportes:</label>
                                <select class="form-select  mt-1 mb-3 mb-lg-0" id="cbbFormato" name="cbbFormato">
                                <optgroup>
                                    <option class="" value="0">Todos</option>
                                </optgroup>
                                <optgroup>
                                <option class="fw-bold" value="0" disabled>Compra</option>
                                <option class="" value="10">Análisis de compras</option>
                                </optgroup>
                                <optgroup>
                                <option class="fw-bold" value="0" disabled>Almacén</option>
                                <option class="" value="20">Análisis de inventario</option>
                                </optgroup>
                                </select>
                            </div>
                            <div class="col-12 col-lg-4 ">
                                <label class="mb-2">Planeación Agregada:</label>
                                <select class="form-select  mt-1 mb-3 mb-lg-0" id="cbbPlan" name="cbbPlan">
                                    <option value="1">Plan 30 días</option>
                                    <option value="2">Plan 60 días</option>
                                    <option value="3">Plan 90 días</option>
                                    <option value="4" selected>Todos</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="row">
                                <div class="col-9">
                                <label class="mb-2">Análisis estadístico</label>
                                <select class="form-select  mt-1 mb-3 mb-lg-0" id="cbbEstad" name="cbbEstad">
                                    <option value="0" selected>Ninguno</option>    
                                    <option value="1">Doc. Vend. Año/Act</option>
                                    <option value="2">Valor Vendido Año/Act</option>
                                    <option value="3">Prom x Mes Año/Act</option>
                                    <option value="4">Perdida de Ventas</option>
                                    <option value="5">Promedio Perdida de Ventas</option>
                                    <option value="6">Inventario PTE</option>
                                    <option value="7">Inventario Proceso</option>
                                    <option value="8">Inventario Cortado</option>
                                    <option value="9">Corte</option>
                                    <option value="10">Programa</option>
                                    <option value="11">Meses Inv.</option>
                                    <option value="12">Doc. Vend. Año/Ant</option>
                                    <option value="13">Valor Vendido Año/Ant</option>
                                    <option value="14">Prom x Mes Año/Ant</option>
                                </select>
                                </div>
                                <div  class="col-3">
                                    <button type="submit" class="btn mt-2" id="btnOrder1" value="1"  name="btnOrderValue" style="width:100%;"><i class="fa-solid fa-up-long text-white f-2"></i></button>
                                    <button type="submit" class="btn mt-2" id="btnOrder2" value="2" name="btnOrderValue" style="width:100%;"><i class="fa-solid fa-down-long text-white f-2"></i></button>
                                </div>
                            </div>
                            </div>
                            <div class="col-12 col-lg-6  ">
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
                            <div class="col-12 col-lg-6 ">

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
                </div>
                
                <div class="table-container mt-3" id="planeacionContainer" style="width:100%;">
                    <table id="myTablePlaneacion" class="table stripe table-hover "style="width:100%">
                        <thead>
                            <tr >
                                <th colspan="33" id="thProcessing" style="height:100px;"></th>
                            </tr>
                            <tr class="sticky-top bg-white">
                                <th class="d-none">rownum</th>
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
                                <th class="text-black text-end">IMPORTADO</th>
                                <th class="text-black text-end">DOC. TOTALES</th>
                                <th class="text-black text-end">NUEVO INV.</th>
                                <th class="text-black text-end">NUEVO BALANCE</th>
                                <th class="text-black text-end">MAT. PRIMA EN ALMACEN</th>
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
            $("#boole").val("1");
            $("#formFiltros").submit();
        });
        $("#cbbMarca").on("change",function () {
            $("#boole").val("2");
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
        var btnOrder='<?php echo $btnOrder; ?>';
        var formato='<?php echo $formato; ?>';
        var searchBox=getCookie("searchVal");
        document.cookie = "searchVal=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
        if (searchBox==null) {
            searchBox=0;
        }
        if (btnOrder==0 || estado==0) {
            $("#btnOrder1").addClass("btn-secondary");
            $("#btnOrder2").addClass("btn-secondary");
        }else if(btnOrder==1){
            $("#btnOrder1").addClass("btn-danger");
            $("#btnOrder2").addClass("btn-secondary");
        }else if(btnOrder==2){
            $("#btnOrder1").addClass("btn-secondary");
            $("#btnOrder2").addClass("btn-danger");
        }
            $("#btn"+marca).prop("checked",true);
            $("#cbbMarca").val(marca);
            $("#cbbPlan").val(plan);
            $("#cbbFormato").val(formato);
            $("#cbbEstad").val(estado);
            $("#rbInv"+inventarios).prop("checked",true);
            $("#rbCla"+clasificacion).prop("checked",true);
            $("#rbOrd"+orden).prop("checked",true);
            $("#rbFil"+filtro).prop("checked",true);
            $("#rbRep"+repro).prop("checked",true);
            var columnasExcel;
            if (formato==0) {
                var columnasExcel=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32]; 
                var visibleColumn=true;
                var visibleColumn2=false;
            }else if (formato==10) {
                var columnasExcel=[1,2,3,4,5,14,15,16,17,18,19,20,21,22,23,24,25]; 
                var visibleColumn=false;
                var visibleColumn2=false;
            }else if(formato==20){
                var columnasExcel=[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37]; 
                var visibleColumn=true;
                var visibleColumn2=true;
            }
        
            console.log("http://172.16.15.20/API.LovablePHP/ZLO0013P/List2/?marca="+marca+"&plan="+plan+"&estado="+estado+"&btnor="+btnOrder+"&inventarios="+inventarios+"&clasificacion="+clasificacion+"&orden="+orden+"&filtro="+filtro+"&repro="+repro+"&formato="+formato+"&searchVal="+searchBox+"");
            var requestError = false;
            $.fn.dataTable.ext.search.push(function(settings, searchData, index, rowData, counter) {
                    var searchVal = $('#myTablePlaneacion').DataTable().search(); 
                    var columnValue = searchData[2]; 
                    if (!searchVal) {
                        return true;
                    }
                    return columnValue.includes(searchVal);
                });
                var table= $('#myTablePlaneacion').DataTable( {
                    language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 100,
                "processing":true,
                
                "ajax": {
                    "url": "http://172.16.15.20/API.LovablePHP/ZLO0013P/List2/?marca="+marca+"&plan="+plan+"&estado="+estado+"&btnor="+btnOrder+"&inventarios="+inventarios+"&clasificacion="+clasificacion+"&orden="+orden+"&filtro="+filtro+"&repro="+repro+"&formato="+formato+"&searchVal="+searchBox+"",
                    "type": "POST",
                    "beforeSend": function () {
                        $("#planeacionContainer").addClass("loading");
                    },
                    "complete": function (xhr) {
                        $("#planeacionContainer").removeClass("loading");
                        $("#thProcessing").addClass('d-none');
                        console.log(xhr.responseJSON);
                        var registrosMismoEstilo = [];

                var table = $('#myTablePlaneacion').DataTable();
                table.rows().every(function (rowIdx, tableLoop, rowLoop) {
                    var data = this.data();
                    var rowNode = this.node();
                    if (rowIdx < table.rows().count() - 1 && data.TIPINV !== 'TOTALM') {
                        $(rowNode).addClass('clickable-row');
                        $(rowNode).attr('data-marca', data.MARCA);
                        $(rowNode).attr('data-estilo', data.ESTILO);
                        registrosMismoEstilo.push(data);
                    }
                });

                $('#myTablePlaneacion').on('click', '.clickable-row', function () {
                    var marcaValue = $(this).data('marca'); 
                    var estiloValue = $(this).data('estilo'); 
                    var registrosFiltrados = registrosMismoEstilo.filter(function (registro) {
                        if (registro.MARCA == marcaValue && registro.ESTILO == estiloValue) {
                            return  registro ;
                        }
                    });       
                    openModalVentas(estiloValue, registrosFiltrados);
                });
                        
                                        
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                        requestError = true;
                    }
                },
                "columns": [
                    {data:"ROWNUM",
                        className:"d-none",orderable: false, },
                    {data:"MARCA",
                        className:"text-end",orderable: false },
                    {data:"ESTILO",
                        className:"text-start",orderable: false },
                    {data:"COLOR",
                        className:"text-start",orderable: false },
                    {data:"TALLA",
                        className:"text-start",orderable: false },
                    {data:"TIPINV",
                        className:"text-start",orderable: false },
                    {data:"UNIVAA",
                        className:"text-primary text-end",
                        render: function(data) {
        return (isNaN(parseFloat(data))? 0:parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"VALVAA",
                        className:"text-end", render: function(data) {
                            var valor=parseFloat(data);
                            if (isNaN(valor)) {valor='';}                       
        return  valor.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                    {data:"UPRMAC",
                       className:"text-primary text-end", render: function(data) {
        return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"NUMMES",
                        className:"text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    },orderable: false },
                    {data:"DOCVAL",
                         className:"text-brown text-end", render: function(data) {
       return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"UVENRE",
                       className:"text-darkblue text-end", render: function(data) {
       return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"UVNRPR",
                        className:"text-danger text-end", render: function(data) {
       return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"INVAPA",
                       className:"text-info text-end",  render: function(data) {
       return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"APAVXC",
                        className:"text-end", render: function(data) {
       return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"INVPTE",
                       className:"text-success text-end", render: function(data) {
       return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"INVPRO",
                        className:"text-end", render: function(data) {
       return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                {data:"INVPR1",
                        className:"text-end", render: function(data) {
       return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"INVCOR",
                        className:"text-end", render: function(data) {
       return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"INVMTP",
                        className:"text-end", render: function(data) {
       return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"WUNIINV",
                        className:"text-end", render: function(data) {
                            return (isNaN(parseFloat(data))? 0:parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    }},
                    {data:"INVPGR",
                        className:"text-end", render: function(data) {
        return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"LEATIE",
                        className:"text-success text-end", render: function(data) {
        return data.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    } },
                   
                    {data:"MESINV",
                       className:"text-darkblue text-end", render: function(data) {
       return (isNaN(parseFloat(data))? 0:parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"UPRM1A",
                       className:"text-danger text-end", render: function(data) {
                        return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"NUMME1",
                        className:"text-end"},
                    {data:"MESIN6",
                        className:"text-darkblue text-end"},
                    {data:"UPRM6A",className:"text-danger text-end", render: function(data) {
                        return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"NUMME6",
                        className:"text-end"},
                    {data:"UPRMAV",
                        className:"text-info text-end", render: function(data) {
         return (isNaN(parseFloat(data))? 0:parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    } },
                    {data:"NUMMEV",
                        className:"text-end"},
                    {data:"DOCANT",
                        className:"text-info text-end", render: function(data) {
                            return (isNaN(parseFloat(data))? ' ':parseFloat(data).toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    }},
                    {data:"VALANT",
                        className:"text-end", render: function(data) {
                            var valor=parseFloat(data);
                            if (isNaN(valor)) {valor='';}                       
        return  valor.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }},
    {data:"IMPORT",className:"text-start"},
    {data:"DOZTOT",className:"text-end", render: function(data) {
        if (data=='') {
            return '';
        }else{
            return parseFloat(data);
        }
    }},
    {data:"NUEINV",className:"text-end", render: function(data) {
        if (data!='&#160;') {
            return parseFloat(data);
        }else{
            return data;
        }
        
    }}, {data:"BALANCE",className:"text-end", render: function(data) {
        if (data!='&#160;') {
            return parseFloat(data);
        }else{
            return data;
        }
    }},
        {data:"MATPRIMA",className:"text-end", render: function(data) {
            if (data!='&#160;') {
            return parseFloat(data);
        }else{
            return data;
        }
    }},
                ],
                "columnDefs": 
                [
                {"targets": [0], "searchable": false, },
                {"targets": [3], "searchable": false, },
                {"targets": [4], "searchable": false, },
                {"targets": [5], "searchable": false, },  
                {"targets": [6], "visible": visibleColumn, "searchable": false, },
                {"targets": [7], "visible": visibleColumn, "searchable": false,},
                {"targets": [8], "visible": visibleColumn, "searchable": false,},
                {"targets": [9], "visible": visibleColumn, "searchable": false,},
                {"targets": [10], "visible": visibleColumn,"searchable": false, },
                {"targets": [11], "visible": visibleColumn, "searchable": false,},
                {"targets": [12], "visible": visibleColumn, "searchable": false,},
                {"targets": [13], "visible": visibleColumn, "searchable": false,},
                {"targets": [14], "searchable": false, },
                    {"targets": [15], "searchable": false, },
                    {"targets": [16], "searchable": false, },
                    {"targets": [17], "searchable": false, }, 
                    {"targets": [18], "searchable": false, },
                    {"targets": [19], "searchable": false, },
                    {"targets": [20], "searchable": false, },
                    {"targets": [21], "searchable": false, }, 
                    {"targets": [22], "searchable": false, },
                    {"targets": [23], "searchable": false, },
                    {"targets": [24], "searchable": false, },
                    {"targets": [25], "searchable": false, }, 
                {"targets": [26], "visible": visibleColumn, "searchable": false,},
                {"targets": [27], "visible": visibleColumn,"searchable": false, },
                {"targets": [28], "visible": visibleColumn,"searchable": false, },
                {"targets": [29], "visible": visibleColumn,"searchable": false, },
                {"targets": [30], "visible": visibleColumn,"searchable": false, },
                {"targets": [31], "visible": visibleColumn,"searchable": false, },
                {"targets": [32], "visible": visibleColumn,"searchable": false, },
                {"targets": [33],"visible": visibleColumn2, "searchable": false, },  
                {"targets": [34],"visible": visibleColumn2, "searchable": false, },  
                {"targets": [35],"visible": visibleColumn2, "searchable": false, },  
                {"targets": [36],"visible": visibleColumn2, "searchable": false, },  
                {"targets": [37],"visible": visibleColumn2, "searchable": false, },  
                ],
                ordering: false,
                dom: 'Bfrtip',
                
                buttons: [
                    {
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>',
                    className: "btn btn-success text-light fs-6 mb-2 text-center",
                    title: 'ReportePlaneacion',
                    messageTop:($("#cbbFormato").val()!=0)?'Formato: '+$("#cbbFormato option:selected").text():'Formato: Todos', 
                    exportOptions: {
                    columns:columnasExcel,
                    },
                    customize: function (xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                var sSh = xlsx.xl['styles.xml'];
                var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                var lastFontIndex = $('fonts font', sSh).length - 1;
                var i; var y;
                var f1 = '<font>'+
                 '<sz val="11" />'+
                 '<name val="Calibri" />'+
                 '<color rgb="FF0000" />'+ // color rojo en la fuente
               '</font>';
               var f2 = '<font>'+
                 '<sz val="11" />'+
                 '<name val="Calibri" />'+
                 '<color rgb="007800" />'+ // color verde en la fuente
               '</font>';
                 var f3 = '<font>' +
                    '<sz val="11" />' +
                    '<name val="Calibri" />' +
                    '<color rgb="00BBCD" />' +  // color cyan de la fuente
                '</font>';
                var f4 = '<font>' +
                    '<sz val="11" />' +
                    '<name val="Calibri" />' +
                    '<color rgb="7E5006" />' +  // color cyan de la fuente
                '</font>';
                var f5 = '<font>' +
                    '<sz val="11" />' +
                    '<name val="Calibri" />' +
                    '<color rgb="2A81F1" />' +  // color azul oscuro de la fuente
                '</font>'; 
                var f6 = '<font>' +
                    '<sz val="11" />' +
                    '<name val="Calibri" />' +
                    '<color rgb="0F8900" />' +  // color verde oscuro de la fuente
                '</font>';
                var f7 = '<font>' +
                    '<sz val="11" />' +
                    '<name val="Calibri" />' +
                    '<color rgb="C1C100" />' +  // color amarillo de la fuente
                '</font>'; 
                var f8 = '<font>' +
                    '<sz val="11" />' +
                    '<name val="Calibri" />' +
                    '<color rgb="FFB202" />' +  // color naranja de la fuente
                '</font>';   
                var n1 = '<numFmt formatCode="##0%"   numFmtId="300"/>';
                var n2 = '<numFmt formatCode="#,##0.00"   numFmtId="200" />';
                var s1 = '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                var s2 = '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                            '<alignment horizontal="center"/></xf>';
                var s3 = '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                var s4 = '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                            '<alignment horizontal="center" wrapText="1"/></xf>'
                var s5 = '<xf  numFmtId="200" fontId="'+(lastFontIndex+1)+'" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                 '<alignment horizontal="right"/></xf>';  
                 var s6 = '<xf  numFmtId="200" fontId="'+(lastFontIndex+2)+'" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                 '<alignment horizontal="right"/></xf>';  
                 var s7 = '<xf  numFmtId="300" fontId="'+(lastFontIndex+1)+'" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                 '<alignment horizontal="right"/></xf>';  
                 var s8 = '<xf  numFmtId="300" fontId="'+(lastFontIndex+2)+'" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                 '<alignment horizontal="right"/></xf>';
                 var s9 = '<xf numFmtId="0" fontId="' + (lastFontIndex+3) + '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
             '<alignment horizontal="right"/></xf>';
             var s10 = '<xf numFmtId="0" fontId="' + (lastFontIndex+4) + '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
             '<alignment horizontal="right"/></xf>'; 
             var s11 = '<xf numFmtId="0" fontId="' + (lastFontIndex+5) + '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
             '<alignment horizontal="right"/></xf>'; 
             var s12 = '<xf numFmtId="0" fontId="' + (lastFontIndex+6) + '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
             '<alignment horizontal="right"/></xf>';
             var s13 = '<xf numFmtId="0" fontId="' + (lastFontIndex+7) + '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
             '<alignment horizontal="right"/></xf>';
             var s14 = '<xf numFmtId="0" fontId="' + (lastFontIndex+8) + '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
             '<alignment horizontal="right"/></xf>';
                sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2 + f3 + f4+f5+f6+f7+f8;
                sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 + s6 + s7 + s8 + s9 + s10+s11+s12+s13+s14;
                 
                var fourDecPlaces    = lastXfIndex + 1;
                var greyBoldCentered = lastXfIndex + 2;
                var twoDecPlacesBold = lastXfIndex + 3;
                var greyBoldWrapText = lastXfIndex + 4;
                var textred1 = lastXfIndex + 5;
                var textgreen1 = lastXfIndex + 6;
                var textred2 = lastXfIndex + 7;
                var textgreen2 = lastXfIndex + 8;
                var textCyan = lastXfIndex + 9;
                var textBrown = lastXfIndex + 10;
                var textDarkblue = lastXfIndex + 11;
                var textDarkGreen = lastXfIndex + 12;
                var textYellow = lastXfIndex + 13;
                var textNaranja = lastXfIndex + 14;
                $('c[r=A1] t', sheet).text( 'REPORTE DE PLANEACION AGREGADA DE OPERACIONES Y VENTAS');
                $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
                $('row:eq(1) c', sheet).attr( 's', 7 );
                $('row:eq(2) c', sheet).attr( 's', 7 );
                $('row', sheet).each(function () {
                    var row = $(this);
                    if (row.index() < 3) {
                        return;
                    }
                    $('c[r^="F"], c[r^="H"], c[r^="AC"], c[r^="AE"]', row).attr('s', textCyan);
                });

                $('row', sheet).each(function (index) {
                    if (index < 3) {
                        return;
                    }
                    var row = $(this);
                    $('c[r^="L"], c[r^="X"], c[r^="AA"]', row).attr('s', textred1);
                    });
                    
                    $('row', sheet).each(function (index) {
                    if (index < 3) {
                        return;
                    }
                    var row = $(this);
                    $('c[r^="J"]', row).attr('s', textBrown); 
                    });

                    $('row', sheet).each(function (index) {
                    if (index < 3) {
                        return;
                    }
                    var row = $(this);
                    $('c[r^="K"], c[r^="M"], c[r^="N"]', row).attr('s', textDarkblue);
                    });

                    $('row', sheet).each(function (index) {
                    if (index < 3) {
                        return;
                    }
                    var row = $(this);
                    $('c[r^="O"]', row).attr('s', textDarkGreen);  
                    });

                    $('row', sheet).each(function (index) {
                    if (index < 3) {
                        return;
                    }
                    var row = $(this);
                    $('c[r^="P"], c[r^="Q"], c[r^="V"]', row).attr('s', textYellow);
                    });
                    $('row', sheet).each(function (index) {
                    if (index < 3) {
                        return;
                    }
                    var row = $(this);
                    $('c[r^="R"], c[r^="S"], c[r^="U"]', row).attr('s', textNaranja);
                    });

                    //TOTALES
                    $('row', sheet).each(function (index) {
                    if (index < 2) {
                        return;
                    }
                    var row = $(this);
                    var cellE = $('c[r^="E"]', row);
                    if (cellE.text() === "TOTAL" || cellE.text() === "TOTALM") {
                        $('c[r^="A"], c[r^="B"], c[r^="C"], c[r^="D"], c[r^="E"], c[r^="F"], c[r^="G"], c[r^="H"], c[r^="I"], c[r^="J"], c[r^="K"], c[r^="L"], c[r^="M"], c[r^="N"], c[r^="O"], c[r^="P"], c[r^="Q"], c[r^="R"], c[r^="S"], c[r^="T"], c[r^="U"], c[r^="V"], c[r^="W"], c[r^="X"], c[r^="Y"], c[r^="Z"], c[r^="AA"], c[r^="AB"], c[r^="AC"], c[r^="AD"], c[r^="AE"], c[r^="AF"]', row).attr('s', 7);
                        $('c[r^="A"], c[r^="B"], c[r^="C"], c[r^="D"], c[r^="E"]', row).text('s', ' ');
                    }
                    });
                var tagName = sSh.getElementsByTagName('sz');
                for (i = 0; i < tagName.length; i++) {
                  tagName[i].setAttribute("val", "13");
                } 
                }
                  },
                    
                ],
                rowCallback: function(row, data) {
        if (data.TIPINV === 'TOTAL' || data.TIPINV === 'TOTALM') {
            $(row).addClass('total-row');
            $('td:eq(1), td:eq(2), td:eq(5)', row).addClass('gray-letters');
        }else{
            if (data.UNIVAA !='') {
             totalUNIVAA += parseFloat(data.UNIVAA);
            }
            if (data.VALVAA !='') {
             totalVALVAA += parseFloat(data.VALVAA);
            }
        }
        }
            });
            var searchTimer;
var previousSearch = ""; 

$('#myTablePlaneacion').on('search.dt', function () {
    var searchBox = $('#myTablePlaneacion').closest('.dataTables_wrapper').find('input[type="search"]');
    clearTimeout(searchTimer);
    searchTimer = setTimeout(function() {
        var searchText = searchBox.val();
        if (searchText != previousSearch) {
            setCookie("searchVal", searchText, 1);
            previousSearch = searchText;
            var tableData = $('#myTablePlaneacion').DataTable().column(2).data();
            var found = false;
            tableData.each(function (value, index) {
                    if (value==searchText) {
                        found = true;
                        return false;
                    }
                });
                if (!found) {
                    location.reload();
                }
            }
        }, 1500);
    });



            var toggleMarca=getCookie("marcasToggle");
            if (toggleMarca!=null) {
                animateMenu();
            }

            $("#myTablePlaneacion").append('<caption style="caption-side: top" class="fw-bold text-black"><label class="ms-2 fw-bold">**Presione clic sobre el estilo para ver sus Ventas**</label></caption>');
         });
        
         function openModalVentas(estilo,data) {
        var anoActual=new Date().getFullYear();
          $("#lblEstilo").text(estilo);
          $("#currentYear").text(anoActual);
          
          var urlResumen="http://172.16.15.20/API.LovablePHP/ZLO0013P/ListResumen/?ano="+anoActual+"&estilo="+estilo+"";
          console.log(urlResumen);
          var responseResumen=ajaxRequest(urlResumen);
          const tableResumenBody=$("#tableResumenBody");
        tableResumenBody.empty();
          if (responseResumen.code==200) {
            var options;
            for (let i = 0; i < responseResumen.data.length; i++) {
                options+="<tr>";
                options+="<td>"+responseResumen.data[i]['ANO']+"</td>";
                if (responseResumen.data[i]['INGRE']!=0) {
                    options+="<td>"+responseResumen.data[i]['INGRE'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
                }else{
                    options+="<td></td>";
                }
                if(responseResumen.data[i]['VENDI']!=null){
                    options+="<td>"+responseResumen.data[i]['VENDI'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
                }else{
                    options+="<td></td>";
                }
                if (responseResumen.data[i]['PERDI']!=null) {
                    options+="<td>"+responseResumen.data[i]['PERDI'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
                }else{
                    options+="<td></td>";
                }
                
                options+="</tr>";
            }
            tableResumenBody.append(options);
          }else{
            tableResumenBody.append('<tr><td colspan="4" class="text-center">No se encontraron registros</td></tr>');
          }
          const myTableDetallesBody=$("#myTableDetallesBody");
          options="";
          myTableDetallesBody.empty();
          for (let i = 0; i < data.length; i++) {
            if (data[i]['TIPINV']=='TOTAL') {
                options+="<tr class='total-row'>";
                options+="<td class='gray-letters'>"+data[i]['MARCA']+"</td>";
                options+="<td class='gray-letters'>"+data[i]['ESTILO']+"</td>";
            }else{
                options+="<tr>";
                options+="<td>"+data[i]['MARCA']+"</td>";
                options+="<td>"+data[i]['ESTILO']+"</td>";
            }
            options+="<td>"+data[i]['COLOR']+"</td>";
            options+="<td>"+data[i]['TALLA']+"</td>";
            options+="<td>"+data[i]['TIPINV']+"</td>";
            options+="<td>"+data[i]['UNIVAA'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['VALVAA'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['UPRMAC'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['NUMMES']+"</td>";
            options+="<td>"+data[i]['DOCVAL'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['UVENRE'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['UVNRPR'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['INVAPA'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['APAVXC'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['INVPTE'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['INVPRO'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['INVPR1'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['INVCOR'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['INVMTP'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['WUNIINV'.toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })]+"</td>";
            options+="<td>"+data[i]['INVPGR'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['LEATIE'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['MESINV'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['UPRM1A'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['NUMME1']+"</td>";
            options+="<td>"+data[i]['MESIN6'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['UPRM6A'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['NUMME6']+"</td>";
            options+="<td>"+data[i]['UPRMAV'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['NUMMEV'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['DOCANT'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="<td>"+data[i]['VALANT'].toLocaleString('es-419', { minimumFractionDigits: 2, maximumFractionDigits: 2 })+"</td>";
            options+="</tr>";
          }
          myTableDetallesBody.append(options);

          $("#ventasModal").modal("show");  
         }
         function closeModal() {
            $("#ventasModal").modal("hide"); 
         }
         function animateMenu() {
                let icon = $("#iconArrow");

                if (icon.hasClass("fa-angles-up")) {
                    icon.removeClass("fa-angles-up");
                    icon.addClass("fa-angles-down"); 
                    document.cookie = "marcasToggle=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
                   setCookie("marcasToggle",1,1);
                } else {
                    icon.removeClass("fa-angles-down");
                    icon.addClass("fa-angles-up");
                    document.cookie = "marcasToggle=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
                }
                $("#menuMarcas").animate({
                    height: 'toggle'
                });
            }

    </script>
</body>
<!-- Modal -->
<div class="modal fade" id="ventasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle de ventas</h1>
        <button type="button" class="btn-close" onclick="closeModal()"></button>
      </div>
      <div class="modal-body">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-3">
                    <label for="" class="form-control mb-3 mb-lg-0 mt-lg-5">Estilo: <span id="lblEstilo"></span></label>
                    </div>
                    <div class="col-12 col-lg-9">
                    <h5><u>Resumen por año</u></h5>
                    <div class="table-responsive mt-3  rounded" style="width:100%;">
                        <table id="tableResumen" class="table stripe table-secondary table-hover "style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        Año
                                    </th>
                                    <th>
                                        Docenas ingresadas
                                    </th>
                                    <th>
                                        Docenas Vendidas
                                    </th>
                                    <th>
                                        Docenas Perdida Ventas
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableResumenBody">
                               
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <div class="col-12">
                    <hr>
                    <h5><u>Detalle del año</u>  <span id="currentYear"></span></h5>
                    <div class="overflow-auto mt-3  rounded" style="width:100%; height: 400px;">
                    <table id="myTableDetalles" class="table stripe table-hover "style="width:100%">
                        <thead>
                            <tr class="sticky-top bg-white">
                                <th class="d-none">rownum</th>
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
                        <tbody id="myTableDetallesBody">

                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</html>