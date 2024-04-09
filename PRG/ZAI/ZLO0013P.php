<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>

<body>
    <?php
    include '../layout-prg.php';
    include '../../assets/php/ZAI/ZLO0013P/header.php';
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
        <div class="card">
            <div class="card-body p-0 m-0">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-secondary" style="width:100px; margin-right:15px;"
                                    onclick="animateMenu()"> <i id="iconArrow"
                                        class="fa-solid fa-angles-up text-white"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="menuMarcas">
                        <form class="" id="formFiltros" action="../../assets/php/ZAI/ZLO0013P/filtrosLogica.php"
                            action="#" method="POST">
                            <div class="row mb-2">
                                <div class="col-12 ">
                                    <input type="text" class="d-none" id="boole" name="boole">
                                    <div id="isComputer">
                                        <div class="btn-group flex-wrap d-flex justify-content-center justify-content-lg-start mb-2 mt-2"
                                            role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check " name="btncols" value="100"
                                                id="btn100" autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example pt-3 pb-3 text-black menuMarca"
                                                for="btn100"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/100.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="200" id="btn200"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn200"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/200.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="210" id="btn210"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn210"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/210.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="250" id="btn250"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn250"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/250.JPG" alt=""
                                                        style="height: 50px; margin-top:10px;"></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="450" id="btn450"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn450"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/450.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="500" id="btn500"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn500"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/500.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="550" id="btn550"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn550"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/550.GIF" alt=""
                                                        style="height: 50px; margin-top:10px;"></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="600" id="btn600"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn600"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/600.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="650" id="btn650"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn650"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/650.GIF" alt=""></b></label>
                                            <input type="radio" class="btn-check" name="btncols" value="700" id="btn700"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn700"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/700.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="800" id="btn800"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn800"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/800.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="900" id="btn900"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn900"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/900.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="360" id="btn360"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn360"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/360.GIF" alt=""
                                                        style="height: 50px; margin-top:10px;"></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="930" id="btn930"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn930"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/930.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="940" id="btn940"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn940"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/940.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="950" id="btn950"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn950"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/950.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="230" id="btn230"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  pt-3 pb-3 text-black menuMarca"
                                                for="btn230"><b><img class="img-fluid round1 imgButtons"
                                                        src="../../assets/img/icons/230.GIF" alt=""></b></label>

                                            <input type="radio" class="btn-check" name="btncols" value="all" id="btnall"
                                                autocomplete="off">
                                            <label
                                                class="btn btn-outline-secondary responsive-font-example  text-black menuMarca"
                                                style="padding-top: 30px;" for="btnall"><b
                                                    style="font-size:12px">TODOS</b></label>
                                        </div>
                                    </div>
                                    <div id="isPhone">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="mb-2">Marcas:</label>
                                                <select class="form-select  mt-1 mb-3 mb-lg-0" id="cbbMarca"
                                                    name="cbbMarca">
                                                    <option value="all">TODOS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 ">
                                    <label class="mb-2 mt-2">Formato de reportes:</label>
                                    <div class='selectBox mt-1 mb-3 mb-lg-0'>
                                        <span class='selected d-flex justify-content-between'></span>
                                        <div class="selectOptions">
                                            <span class="selectOption d-flex justify-content-between"
                                                value="0">Todos</span>
                                            <span class="selectOption d-flex justify-content-between" value="10"
                                                data-bs-toggle="tooltip" data-bs-placement="right"
                                                data-bs-title="NO CONTIENE: &#13;&#10;-Marcas: 450,960,970,995&#13;&#10;-Totales por estilo&#13;&#10;-Estilos fuera de programa&#13;&#10;-Estilos nuevos en programa&#13;&#10;-MESES PRG 12M Solamente desde 0 hasta 12 meses">Análisis
                                                de compras </span>
                                            <span class="selectOption d-flex justify-content-between" value="20"
                                                data-bs-toggle="tooltip" data-bs-placement="right"
                                                data-bs-title="CONTIENE: Total docenas x estilo -Nuevos meses de inventario -Importados -Cantidad a mover a Materia Prima NO CONTIENE: &#13;&#10;-Marcas: 450,960,970,995&#13;&#10;-Totales por estilo&#13;&#10;-Estilos fuera de programa&#13;&#10;-Estilos nuevos en programa&#13;&#10;-Estilos en 0.00 Materia Prima">Análisis
                                                de inventario </span>
                                        </div>
                                        <input type="text" class="d-none" id="cbbFormato" name="cbbFormato" value="0">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 ">
                                    <label class="mb-2 mt-2">Planeación Agregada:</label>
                                    <select class="form-select  mt-1 mb-3 mb-lg-0" id="cbbPlan" name="cbbPlan">
                                        <option value="1">Plan 30 días</option>
                                        <option value="2">Plan 60 días</option>
                                        <option value="3">Plan 90 días</option>
                                        <option value="4" selected>Todos</option>
                                    </select>
                                </div>
                                <div class="col-12 col-lg-4 d-none">
                                    <div class="row">
                                        <div class="col-9">
                                            <label class="mb-2 mt-2">Análisis estadístico</label>
                                            <select class="form-select  mt-1 mb-3 mb-lg-0" id="cbbEstad"
                                                name="cbbEstad">
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
                                        <div class="col-3">
                                            <button type="submit" class="btn mt-2" id="btnOrder1" value="1"
                                                name="btnOrderValue" style="width:100%;"><i
                                                    class="fa-solid fa-up-long text-white f-2"></i></button>
                                            <button type="submit" class="btn mt-2" id="btnOrder2" value="2"
                                                name="btnOrderValue" style="width:100%;"><i
                                                    class="fa-solid fa-down-long text-white f-2"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6  ">
                                    <div class="row">
                                        <div class="col-7">
                                            <label class="mb-3">Tipos de Inventario</label>
                                            <div class="form-control">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rbInventarios"
                                                        value="1" id="rbInv1">
                                                    <label class="form-check-label" for="rbInv1">
                                                        En Línea
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rbInventarios"
                                                        value="2" id="rbInv2">
                                                    <label class="form-check-label" for="rbInv2">
                                                        Descontinuado
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rbInventarios"
                                                        value="3" id="rbInv3">
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
                                                    <input class="form-check-input" type="radio" name="rbClasificacion"
                                                        value="1" id="rbCla1">
                                                    <label class="form-check-label" for="rbCla1">
                                                        Local
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rbClasificacion"
                                                        value="2" id="rbCla2">
                                                    <label class="form-check-label" for="rbCla2">
                                                        Importado
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rbClasificacion"
                                                        value="3" id="rbCla3">
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
                                                    <input class="form-check-input" type="radio" name="rbOrden"
                                                        value="1" id="rbOrd1">
                                                    <label class="form-check-label" for="rbOrd1">
                                                        Estilo y color
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rbOrden"
                                                        value="2" id="rbOrd2">
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
                                                    <input class="form-check-input" type="radio" name="rbFiltro"
                                                        value="1" id="rbFil1">
                                                    <label class="form-check-label" for="rbFil1">
                                                        <= Lead Time </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rbFiltro"
                                                        value="2" id="rbFil2">
                                                    <label class="form-check-label" for="rbFil2">
                                                        <= Lead Time + 1 Mes </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rbFiltro"
                                                        value="3" id="rbFil3">
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
                                                    <input class="form-check-input" type="radio" name="rbRepro"
                                                        value="1" id="rbRep1">
                                                    <label class="form-check-label" for="rbRep1">
                                                        Si </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rbRepro"
                                                        value="2" id="rbRep2">
                                                    <label class="form-check-label" for="rbRep2">
                                                        No </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rbRepro"
                                                        value="3" id="rbRep3">
                                                    <label class="form-check-label" for="rbRep3">
                                                        Todo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown d-flex justify-content-end mt-3">
                                    <button class="btn btn-light fw-bold" style="width:300px;" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-caret-down"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ocultar/Mostrar
                                        Columnas
                                    </button>
                                    <ul class="dropdown-menu overflow-auto" style="height:400px;" id="hiddenColumns">
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="fixed-scrollbar">
                    <div class="table-container mt-3 " id="planeacionContainer">
                        <div id="planeacionLoader" class="d-none">
                            <div class="position-absolute top-0 start-50 translate-middle">
                                <button class="btn btn-danger mt-5" type="button" disabled>
                                    <span class="spinner-border text-white" style="width: 1.5rem; height: 1.5rem;"
                                        aria-hidden="true"></span>
                                    <span role="status" class="ms-2 text-white fs-4">Cargando...</span>
                                </button>
                            </div>
                        </div>
                        <div id="loaderExcel" class="d-none">
                            <button class="btn btn-success position-absolute top-50 start-50 translate-middle p-4"
                                style="z-index: 9999;" type="button" disabled>
                                <i class="fa-solid fa-file-excel fa-flip text-white" style="font-size:70px;"></i>
                            </button>
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-secondary bg-opacity-50 rounded"
                                style="z-index: 9998;"></div>
                        </div>
                        <div id="loaderTable" class="d-none" style="position:fixed; z-index: 9999; width: 100%; ">
                            <button class="btn btn-light position-absolute top-50 start-50 translate-middle p-4"
                                style="z-index: 9999;" type="button" disabled>
                                <i class="fa-solid fa-gear fa-spin" style="font-size:70px;"></i>
                            </button>
                            <div class="position-fixed  top-0 start-0 w-100 h-100 bg-secondary bg-opacity-50 rounded"
                                style="z-index: 9998;"></div>
                        </div>
                        <div>
                            <label class="ms-2 fw-bold mb-3">**Presione doble clic sobre el estilo para ver sus
                                Ventas**</label>
                            <table id="myTablePlaneacion" class="table stripe table-hover " style="width:100%">
                                <thead>
                                    <tr>
                                        <th colspan="33" id="thProcessing" style="height:1px;"></th>
                                    </tr>
                                    <tr class="sticky-top bg-white" style="font-size:12px;">
                                        <th class="text-white bg-white">N.</th>
                                        <th class="text-black text-center bg-white">MARCA</th>
                                        <th class="text-black text-center bg-white">ESTILO</th>
                                        <th class="text-black text-center bg-white">COLOR</th>
                                        <th class="text-black text-center bg-white">TALLA</th>
                                        <th class="text-black text-center bg-white">T/INV</th>
                                        <th class="text-black text-center">DOC. VEN. <br>AÑO/ACT</th>
                                        <th class="text-black text-center">VAL. VEN. <br>AÑO/ACT</th>
                                        <th class="text-black text-center">PROM. MES</th>
                                        <th class="text-black text-center"># <br>MESES</th>
                                        <th class="text-black text-center">UND VTAS. <br>MES/ANT</th>
                                        <th class="text-black text-center">PERDIDA. <br>VTAS</th>
                                        <th class="text-black text-center">PROM. <br>PERDIDA VTAS</th>
                                        <th class="text-black text-center">APARTADO <br>VENDEDOR</th>
                                        <th class="text-black text-center">APARTADO <br>VENTA X CATALOGO</th>
                                        <th class="text-black text-center">INVENTARIO <br>DISPONBLE</th>
                                        <th class="text-black text-center">INVENTARIO <br>PROCESO</th>
                                        <th class="text-black text-center">INVENTARIO <br>CORTADO</th>
                                        <th class="text-black text-center">CORTE</th>
                                        <th class="text-black text-center">MESES INV ANTES MTP</th>
                                        <th class="text-black text-center">INV. MTP</th>
                                        <th class="text-black text-center">MESES INV</th>
                                        <th class="text-black text-center">PROGRAMA</th>
                                        <th class="text-black text-center">PROGRAMA 1</th>
                                        <th class="text-black text-center">PROGRAMA 2</th>
                                        <th class="text-black text-center">LEAD TIME</th>
                                        <th class="text-black text-center">MESES <br>PRG 12M</th>
                                        <th class="text-black text-center">PROM.MEN. <br>12M</th>
                                        <th class="text-black text-center"># <br>MESES 12M</th>
                                        <th class="text-black text-center">MESES <br>INV. 6M</th>
                                        <th class="text-black text-center">PROM. <br>MEN. 6M</th>
                                        <th class="text-black text-center"># <br>MESES 6M</th>
                                        <th class="text-black text-center">PROM X MES <br>AÑO/ANT</th>
                                        <th class="text-black text-center"># <br>MESES AÑO/ANT</th>
                                        <th class="text-black text-center">DOC. VEND. <br>AÑO/ANT.</th>
                                        <th class="text-black text-center">VALOR VENDIDO <br>AÑO/ANT</th>
                                        <th class="text-black text-center">IMPORTADO</th>
                                        <th class="text-black text-center">DOC. <br>TOTALES</th>
                                        <th class="text-black text-center">NUEVO INV.</th>
                                        <th class="text-black text-center">NUEVO <br>BALANCE</th>
                                        <th class="text-black text-center">MAT. PRIMA <br>EN ALMACEN</th>
                                    </tr>
                                </thead>
                                <tbody id="myTablePlaneacionBody" style="font-size: 12px;">
                                </tbody>
                            </table>
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
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script>
        // Función para habilitar cajas de selección
        function enableSelectBoxes(valorDeseado) {
            // Iterar sobre todas las cajas de selección
            document.querySelectorAll('div.selectBox').forEach(function(selectBox) {
                // Añadir evento de click a las flechas y opciones seleccionadas
                selectBox.querySelectorAll('span.selected, span.selectArrow').forEach(function(span) {
                    span.addEventListener('click', function() {
                        var optionsDiv = this.parentNode.querySelector('div.selectOptions');
                        // Si las opciones están ocultas, mostrarlas. Si no, ocultarlas.
                        if (optionsDiv.style.display === 'none' || optionsDiv.style.display === '') {
                            optionsDiv.style.display = 'block';
                        } else {
                            optionsDiv.style.display = 'none';
                        }
                    });
                });
                // Buscar la opción con el valor deseado
                var spanEncontrado = selectBox.querySelector('span.selectOption[value="' + valorDeseado + '"]');
                if (spanEncontrado) {
                    // Si se encuentra la opción, seleccionarla
                    selectBox.querySelector('span.selected').innerHTML = spanEncontrado.innerHTML;
                    selectBox.setAttribute('value', spanEncontrado.getAttribute('value'));
                } else {
                    // Si no se encuentra la opción, seleccionar la primera opción
                    var firstOption = selectBox.querySelector('div.selectOptions span.selectOption');
                    selectBox.querySelector('span.selected').innerHTML = firstOption.innerHTML;
                    selectBox.setAttribute('value', firstOption.getAttribute('value'));
                }

                // Añadir evento de click a las opciones
                selectBox.querySelectorAll('span.selectOption').forEach(function(span) {
                    span.addEventListener('click', function() {
                        // Al hacer click en una opción, seleccionarla y ocultar las demás opciones
                        this.parentNode.style.display = 'none';
                        this.closest('div.selectBox').setAttribute('value', this.getAttribute('value'));
                        this.parentNode.parentNode.querySelector('span.selected').innerHTML = this.innerHTML;
                        document.getElementById('cbbFormato').value = this.getAttribute('value');
                    });
                });
            });
        }
        // Variables para almacenar totales
        var totalUNIVAA = 0;
        var totalVALVAA = 0;

        // Función para alternar la visibilidad de un elemento
        function toggleItem(id) {
            var element = document.getElementById(id);
            if (element) {
                // Alternar la clase 'active'
                element.classList.toggle('active');
                // Si el elemento está activo, añadir '👁 OCULTO - ' al texto
                if (element.classList.contains('active')) {
                    element.textContent = '👁 OCULTO - ' + element.textContent;
                } else {
                    // Si el elemento no está activo, eliminar '👁 OCULTO - ' del texto
                    element.textContent = element.textContent.replace('👁 OCULTO - ', '');
                }
            }
        }
        var marca = '<?php echo $marca; ?>';
        var plan = '<?php echo $plan; ?>';
        var estado = '<?php echo $estado; ?>';
        var inventarios = '<?php echo $inventarios; ?>';
        var clasificacion = '<?php echo $clasificacion; ?>';
        var orden = '<?php echo $orden; ?>';
        var filtro = '<?php echo $filtro; ?>';
        var repro = '<?php echo $repro; ?>';
        var btnOrder = '<?php echo $btnOrder; ?>';
        var formato = '<?php echo $formato; ?>';
        var searchBox = "";
        var visibleColumn = true;
        var visibleColumn2 = true;
        var columnasExcel = [];
        var columnsFixed = 0;
        var columnsNoVisible = [];
        const columnDataValues = ["ROWNUM", "MARCA", "ESTILO", "COLOR", "TALLA", "TIPINV", "UNIVAA", "VALVAA", "UPRMAC",
            "NUMMES", "DOCVAL", "UVENRE", "UVNRPR", "INVAPA", "APAVXC", "INVPTE", "INVPRO", "INVPR1", "INVCOR",
            "WUNIINV2", "INVMTP", "WUNIINV", "INVPGR", "INVPG1", "INVPG2", "LEATIE", "MESINV", "UPRM1A", "NUMME1",
            "MESIN6", "UPRM6A", "NUMME6", "UPRMAV", "NUMMEV", "DOCANT", "VALANT", "IMPORT", "DOZTOT", "NUEINV",
            "BALANCE", "MATPRIMA"
        ];
        var columnsConfig = [];
        const encabezados = ["N.", "MARCA", "ESTILO", "COLOR", "TALLA", "T/INV", "DOC. VEN. AÑO/ACT",
            "VAL. VEN. AÑO/ACT", "PROM. MES", "# MESES", "UND VTAS. MES/ANT", "PERDIDA. VTAS",
            "PROM. PERDIDA VTAS", "APARTADO VENDEDOR", "APARTADO VENTA X CATALOGO", "INVENTARIO DISPONBLE",
            "INVENTARIO PROCESO", "INVENTARIO CORTADO", "CORTE", "MESES INV ANTES MTP", "INV. MTP",
            "MESES INV", "PROGRAMA", "PROGRAMA 1", "PROGRAMA 2", "LEAD TIME", "MESES PRG 12M",
            "PROM.MEN. 12M", "# MESES 12M", "MESES INV. 6M", "PROM. MEN. 6M", "# MESES 6M",
            "PROM X MES AÑO/ANT", "# MESES AÑO/ANT", "DOC. VEND. AÑO/ANT.", "VALOR VENDIDO AÑO/ANT",
            "IMPORTADO", "DOC. TOTALES", "NUEVO INV.", "NUEVO BALANCE", "MAT. PRIMA EN ALMACEN"
         ];
        document.addEventListener('DOMContentLoaded', function() {
            var columnsNoV = getCookie("columnsVisible");
            if (columnsNoV) {
                columnsNoVisible = columnsNoV.split(',');
            }
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    html: true
                })
            });
            document.addEventListener('keypress', function(e) {
                var searchEstiloInput = document.getElementById('searchEstiloInput');
                if (e.which === 13 && document.activeElement === searchEstiloInput) {
                    searchEstilo();
                }
            });

            document.querySelectorAll('.dropdown-menu').forEach(function(dropdownMenu) {
                dropdownMenu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });

            ["btn100", "btn200", "btn210", "btn250", "btn450", "btn500", "btn550", "btn600", "btn650", "btn700",
                "btn800", "btn900", "btn360", "btn930", "btn940", "btn950", "btn230", "btnall"
            ].forEach(function(id) {
                var button = document.getElementById(id);
                if (button) {
                    button.addEventListener('click', function() {
                        document.getElementById('boole').value = "1";
                        document.getElementById('formFiltros').submit();
                    });
                }
            });
            var cbbMarca = document.getElementById('cbbMarca');
            if (cbbMarca) {
                cbbMarca.addEventListener('change', function() {
                    document.getElementById('boole').value = "2";
                    document.getElementById('formFiltros').submit();
                });
            }

            var urlComarc = 'http://172.16.15.20/API.LovablePHP/ZLO0003P/ListComarc/';
            var responseComarc = ajaxRequest(urlComarc);

            //LLENADO DE MARCAS
            if (responseComarc.code == 200) {
                var cbbMarca = document.getElementById('cbbMarca');
                responseComarc.data.forEach(function(item) {
                    var option = document.createElement('option');
                    option.value = item['DESCO1'];
                    option.textContent = item['DESDES'];
                    cbbMarca.appendChild(option);
                });
            }

            enableSelectBoxes(formato);
            searchBox = getCookie("searchVal");
            document.cookie = "searchVal=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
            if (searchBox == null) {
                searchBox = 0;
            }
            if (btnOrder == 0 || estado == 0) {
                document.getElementById("btnOrder1").classList.add("btn-secondary");
                document.getElementById("btnOrder2").classList.add("btn-secondary");
            } else if (btnOrder == 1) {
                document.getElementById("btnOrder1").classList.add("btn-danger");
                document.getElementById("btnOrder2").classList.add("btn-secondary");
            } else if (btnOrder == 2) {
                document.getElementById("btnOrder1").classList.add("btn-secondary");
                document.getElementById("btnOrder2").classList.add("btn-danger");
            }
            document.getElementById("btn" + marca).checked = true;
            document.getElementById("rbInv" + inventarios).checked = true;
            document.getElementById("rbCla" + clasificacion).checked = true;
            document.getElementById("rbOrd" + orden).checked = true;
            document.getElementById("rbFil" + filtro).checked = true;
            document.getElementById("rbRep" + repro).checked = true;
            document.getElementById("cbbMarca").value = marca;
            document.getElementById("cbbPlan").value = plan;
            document.getElementById("cbbFormato").value = formato;
            document.getElementById("cbbEstad").value = estado;

            if (formato == 0) {
                columnasExcel = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22,
                    23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35
                ];
                var visibleColumn = true;
                var visibleColumn2 = false;
            } else if (formato == 10) {
                columnasExcel = [1, 2, 3, 4, 5, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30,
                    31, 32, 33, 34, 35
                ];
                var visibleColumn = false;
                var visibleColumn2 = false;
            } else if (formato == 20) {
                columnasExcel = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22,
                    23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40
                ];
                var visibleColumn = true;
                var visibleColumn2 = true;
            }
            var hiddenColumns = document.getElementById('hiddenColumns');
            for (let i = 5; i < columnasExcel.length; i++) {
                var li = document.createElement('li');
                var a = document.createElement('a');
                a.className = 'toggle-vis dropdown-item';
                a.id = 'item-' + columnasExcel[i];
                a.type = 'button';
                a.setAttribute('data-column', columnasExcel[i]);
                a.textContent = encabezados[columnasExcel[i]];
                a.onclick = function() {
                    toggleItem('item-' + columnasExcel[i]);
                };
                li.appendChild(a);
                hiddenColumns.appendChild(li);
            }
            var requestError = false;
            columnsFixed = 5;
            for (let i = 0; i < columnDataValues.length; i++) {
                switch (columnDataValues[i]) {
                    case "ROWNUM":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            className: "bg-white text-transparent",
                            orderable: false
                        });
                        break;
                    case "MARCA":
                    case "ESTILO":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            className: "text-start bg-white",
                            orderable: false
                        });
                        break;
                    case "TIPINV":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            className: "text-center bg-white",
                            orderable: false
                        });
                        break;
                    case "COLOR":
                    case "TALLA":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            className: "text-end bg-white",
                            orderable: false
                        });
                        break;
                    case "WUNIINV2":
                    case "WUNIINV":
                    case "VALANT":
                        //SIN COLOR
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            className: "text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "NUMME1":
                    case "NUMME6":
                    case "NUMMEV":
                        //SIN COLOR
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            className: "text-end",
                            orderable: false,
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? '‎' :
                                    parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 0,
                                        maximumFractionDigits: 0
                                    }));
                            }
                        });
                        break;
                    case "UPRMAV":
                    case "DOCANT":
                        //COLOR CYAN
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            className: "text-info text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "UPRMAV":
                    case "DOCANT":
                        //COLOR CYAN
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            className: "text-info text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "MESINV":
                    case "MESIN6":
                        //COLOR AZUL OSCURO
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            className: "text-darkblue text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "UPRM1A":
                    case "UPRM6A":
                        //COLOR ROJO
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            className: "text-danger text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "APAVXC":
                        //COLOR MORADO
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            className: "text-violet text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "INVPTE":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            className: "text-success text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "LEATIE":
                        //COLOR VERDE
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            className: "text-success text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 0,
                                        maximumFractionDigits: 0
                                    }));
                            }
                        });
                        break;
                    case "INVPRO":
                    case "INVPR1":
                        //COLOR VERDE CLARO
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            className: "text-violet text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "INVCOR":
                    case "INVMTP":
                    case "INVPGR":
                    case "INVPG1":
                    case "INVPG2":
                        //COLOR NARANJA
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            className: "text-orange text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                        //VISIBLE COLUMN 1:
                    case "UNIVAA":
                    case "UPRMAC":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            visible: visibleColumn,
                            className: "text-info text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "VALVAA":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            visible: visibleColumn,
                            className: "text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "NUMMES":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            orderable: false,
                            visible: visibleColumn,
                            className: "text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? '‎' :
                                    parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 0,
                                        maximumFractionDigits: 0
                                    }));
                            }
                        });
                        break;
                    case "DOCVAL":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            visible: visibleColumn,
                            className: "text-brown text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "INVAPA":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            visible: visibleColumn,
                            className: "text-violet text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "UVENRE":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            visible: visibleColumn,
                            className: "text-darkblue text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    case "UVNRPR":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            visible: visibleColumn,
                            className: "text-danger text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                        //VISIBLE COLUMN 2:
                    case "IMPORT":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            visible: visibleColumn2,
                            className: "text-start"
                        });
                        break;
                    case "DOZTOT":
                    case "NUEINV":
                    case "BALANCE":
                    case "MATPRIMA":
                        columnsConfig.push({
                            data: columnDataValues[i],
                            type: "num-fmt",
                            visible: visibleColumn2,
                            className: "text-end",
                            render: function(data) {
                                return ((isNaN(parseFloat(data)) || parseFloat(data) == 0) ? (0)
                                    .toFixed(2) : parseFloat(data).toLocaleString('es-419', {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    }));
                            }
                        });
                        break;
                    default:
                        break;
                }
            }
            var table = initTable();
            var isInitialized = false;
            table.on('init.dt', function() {
                isInitialized = true;
            });
            $('#myTablePlaneacion thead').on('click', 'th', function(e) {
                e.preventDefault();
                var enca = $(this).text();
                if (enca != 'MARCA' && enca != 'ESTILO' && enca != 'COLOR' && enca != 'TALLA' && enca !=
                    'T/INV' && enca != '# MESES' && enca != '# MESES 12M' && enca != '# MESES 6M' && enca !=
                    '# MESES AÑO/ANT') {
                    var colIndex = $(this).index();
                    document.getElementById('loaderTable').classList.remove('d-none');
                    setTimeout(() => {
                        setCookie("boolOrder", "2", 1);
                        table.rows().every(function() {
                            var data = this.data();
                            var rowNode = this.node();
                            if (data.TIPINV == 'TOTAL' || data.TIPINV == 'TOTALM') {
                                rowNode.classList.add('d-none');
                            }
                        });
                        encabezados.forEach(function(item, index) {
                            if (item == enca) {
                                colIndex = index - 1;
                            }
                        });
                        var orderDir = table.order()[0][1];
                        document.getElementById('loaderTable').classList.add('d-none');
                        table.order([colIndex + 1, orderDir]).draw();
                        var dataTablesFilter = document.querySelector('.dataTables_filter');
                        var existingButton = document.getElementById('refreshOrderButton');
                        if (existingButton) {
                            dataTablesFilter.removeChild(existingButton);
                        }
                        var button2 = document.createElement('button');
                        button2.id = 'refreshOrderButton';
                        button2.className = 'btn btn-light ms-3 me-3 fw-bold';
                        button2.style.width = '200px';
                        button2.onclick = function() {
                            restartOrder();
                        };
                        button2.innerHTML =
                            '<i class="fa-solid fa-rotate-left"></i> Refrescar orden';
                        var firstChild = dataTablesFilter.firstChild;
                        dataTablesFilter.insertBefore(button2, firstChild);
                    }, 200);
                }

            });

            document.querySelectorAll('a.toggle-vis').forEach((el) => {
                el.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.getElementById('loaderTable').classList.remove('d-none');
                    setTimeout(() => {
                        let columnIdx = e.target.getAttribute('data-column');
                        let column = table.column(columnIdx);
                        column.visible(!column.visible());
                        let headerText = $(this).text().split(' - ')[1];
                        let headerText2 = $(this).text();
                        const index = columnsNoVisible.indexOf(columnIdx);
                        if (!column.visible() && index == -1) {
                            if (!columnsNoVisible.includes(columnIdx)) {
                                if (headerText == 'MARCA' || headerText == 'ESTILO' ||
                                    headerText == 'COLOR' || headerText == 'TALLA' ||
                                    headerText == 'T/INV') {
                                    columnsFixed--;
                                }
                                columnsNoVisible.push(columnIdx);
                            }
                        } else {
                            const index = columnsNoVisible.indexOf(columnIdx);
                            if (index > -1) {
                                if (headerText2 == 'MARCA' || headerText2 == 'ESTILO' ||
                                    headerText2 == 'COLOR' || headerText2 == 'TALLA' ||
                                    headerText2 == 'T/INV') {
                                    columnsFixed++;
                                }
                                columnsNoVisible.splice(index, 1);
                            }
                        }
                        setCookie("columnsVisible", columnsNoVisible, 1);
                        document.getElementById('loaderTable').classList.add('d-none');
                    }, 200);
                });
            });
            var toggleMarca = getCookie("marcasToggle");
            if (toggleMarca != null) {
                animateMenu();
            }
            ocultandoColumnas(table, columnsNoVisible);
        });

        function ocultandoColumnas(table, columnsNoVisible) {
            if (columnsNoVisible.length > 0) {
                for (let i = 0; i < columnsNoVisible.length; i++) {
                    toggleItem('item-' + columnsNoVisible[i]);
                }
                table.columns().every(function(index) {
                    let columnIndexString = index.toString();
                    if (columnsNoVisible.includes(columnIndexString)) {
                        this.visible(false);
                    }
                });
            }
        }
        var previousSearch = "";
        function initTable() {
            console.log("http://172.16.15.20/API.LovablePHP/ZLO0013P/List2/?marca=" + marca + "&plan=" +
                        plan + "&estado=" + estado + "&btnor=" + btnOrder + "&inventarios=" + inventarios +
                        "&clasificacion=" + clasificacion + "&orden=" + orden + "&filtro=" + filtro +
                        "&repro=" + repro + "&formato=" + formato + "&searchVal=" + searchBox + "");
            var table = $('#myTablePlaneacion').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                    loadingRecords: `Cargando datos...`
                },
                fixedColumns: {
                    left: columnsFixed,
                },
                scrollCollapse: true,
                "pageLength": 1000,
                "processing": true,
                "ajax": {
                    "url": "http://172.16.15.20/API.LovablePHP/ZLO0013P/List2/?marca=" + marca + "&plan=" +
                        plan + "&estado=" + estado + "&btnor=" + btnOrder + "&inventarios=" + inventarios +
                        "&clasificacion=" + clasificacion + "&orden=" + orden + "&filtro=" + filtro +
                        "&repro=" + repro + "&formato=" + formato + "&searchVal=" + searchBox + "",
                    "type": "POST",
                    "beforeSend": function() {
                        $("#planeacionContainer").addClass("loading");
                        $("#planeacionLoader").removeClass("d-none");
                    },
                    "complete": function(xhr) {
                        $("#planeacionContainer").removeClass("loading");
                        $("#planeacionLoader").addClass("d-none");
                        $("#thProcessing").addClass('d-none');
                        var registrosMismoEstilo = [];
                        var table = $('#myTablePlaneacion').DataTable();
                        table.rows().every(function(rowIdx, tableLoop, rowLoop) {
                            var data = this.data();
                            var rowNode = this.node();
                            if (rowIdx < table.rows().count() - 1 && data.TIPINV !== 'TOTALM') {
                                rowNode.classList.add('clickable-row');
                                rowNode.setAttribute('data-marca', data.MARCA);
                                rowNode.setAttribute('data-estilo', data.ESTILO);
                                registrosMismoEstilo.push(data);
                            }
                        });
                        document.getElementById('myTablePlaneacion').addEventListener('dblclick',
                            function(event) {
                                document.getElementById('loaderTable').classList.remove('d-none');
                                setTimeout(() => {
                                    var target = event.target.closest('.clickable-row');
                                    if (target) {
                                        var marcaValue = target.getAttribute('data-marca');
                                        var estiloValue = target.getAttribute(
                                            'data-estilo');
                                        var registrosFiltrados = registrosMismoEstilo
                                            .filter(function(registro) {
                                                return registro.MARCA == marcaValue &&
                                                    registro.ESTILO == estiloValue;
                                            });
                                        openModalVentas(estiloValue, registrosFiltrados);
                                    }
                                    document.getElementById('loaderTable').classList.add(
                                        'd-none');
                                }, 200);

                            });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                        requestError = true;
                    }
                },
                "columns": columnsConfig,
                ordering: true,
                dom: 'Bftip',
                initComplete: function() {
                    var input = document.createElement('input');
                    input.type = 'text';
                    input.placeholder = 'Buscar un estilo...';
                    input.id = 'searchEstiloInput';
                    input.oninput = function() {
                        this.value = this.value.toUpperCase();
                    };
                    var button = document.createElement('button');
                    button.className = 'btn btn-danger ms-3 me-3 text-white fw-bold';
                    button.style.width = '100px';
                    button.onclick = function() {
                        searchEstilo();
                    };
                    button.innerHTML = '<i class="fa-solid fa-magnifying-glass"></i> Buscar';
                    var dataTablesFilter = document.querySelector('.dataTables_filter');
                    dataTablesFilter.appendChild(input);
                    dataTablesFilter.appendChild(button);
                    var label = document.querySelector('.dataTables_filter label');
                    if (label) {
                        var childNodes = label.childNodes;
                        for (var i = 0; i < childNodes.length; i++) {
                            var node = childNodes[i];
                            if (node.nodeType === Node.TEXT_NODE) {
                                label.removeChild(node);
                            }
                        }
                    }
                    if (searchBox != '0') {
                        var dataTableInput = document.getElementById('myTablePlaneacion').closest(
                            '.dataTables_wrapper').querySelector('input[type="search"]');
                        if (dataTableInput) {
                            dataTableInput.value = searchBox;
                        }
                    }
                    var table = $('#myTablePlaneacion').DataTable();
                    let column = table.column(0);
                    column.visible(!column.visible());

                },
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>',
                        className: "btn btn-success text-light fs-6 mb-2 ms-3 text-center",
                        title: 'ReportePlaneacion',
                        action: function(e, dt, button, config) {
                            document.getElementById('loaderExcel').classList.remove('d-none');
                            setTimeout(() => {
                                $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e,
                                    dt, button, config);
                                document.getElementById('loaderExcel').classList.add(
                                    'd-none');
                            }, 200);
                        },
                        messageTop: ($("#cbbFormato").val() != 0) ? 'Formato: ' + $(".selected").text() :
                            'Formato: Todos',
                        exportOptions: {
                            modifier: {
                                search: 'applied',
                                order: 'applied'
                            },
                            format: {
                                body: function(data, row, column, node) {
                                    // Puedes realizar aquí alguna manipulación de datos si es necesario
                                    if ($(node).closest('tr').hasClass('d-none')) {
                                        return 'NULL'; // Excluir filas vacías
                                    }
                                    return data;
                                }
                            },
                            customizeData: function(data) {
                                for (var i = data.body.length - 1; i >= 0; i--) {
                                    var row = data.body[i];
                                    var excludeRow = false;
                                    if (row[0] === 'NULL') {
                                        excludeRow = true;
                                    }
                                    if (excludeRow) {
                                        data.body.splice(i, 1);
                                    }
                                }
                            },
                            columns: columnasExcel
                        },
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            var sSh = xlsx.xl['styles.xml'];
                            var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                            var lastFontIndex = $('fonts font', sSh).length - 1;
                            var lastFillIndex = $('fills fill', sSh).length - 1;
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
                            var f3 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="00BBCD" />' + // color cyan de la fuente
                                '</font>';
                            var f4 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="7E5006" />' + // color cyan de la fuente
                                '</font>';
                            var f5 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="00377D" />' + // color azul oscuro de la fuente
                                '</font>';
                            var f6 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="0F8900" />' + // color verde oscuro de la fuente
                                '</font>';
                            var f7 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="C1C100" />' + // color amarillo de la fuente
                                '</font>';
                            var f8 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="FFB202" />' + // color naranja de la fuente
                                '</font>';
                            var f9 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="9F6CFF" />' + // color morada de la fuente
                                '</font>';
                            var fillRosa =
                                '<fill><patternFill patternType="solid"><fgColor rgb="FFFFE1F1"/></patternFill></fill>';
                            var fillAmarillo =
                                '<fill><patternFill patternType="solid"><fgColor rgb="FFFFFF99"/></patternFill></fill>';

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
                            var s9 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 3) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s10 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 4) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s11 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 5) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s12 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 6) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s13 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 7) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s14 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 8) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s15 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 9) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';

                            //MISMAS FUENTES FONDO ROSA
                            var s16 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 1) +
                                '" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s17 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 2) +
                                '" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s18 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 1) +
                                '" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s19 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 2) +
                                '" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s20 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 3) +
                                '" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s21 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 4) +
                                '" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s22 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 5) +
                                '" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s23 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 6) +
                                '" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s24 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 7) +
                                '" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s25 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 8) +
                                '" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s26 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 9) +
                                '" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            //MISMAS FUENTES FONDO AMARILLO
                            var s29 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 1) +
                                '" fillId="' + (lastFillIndex + 2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s30 = '<xf  numFmtId="200" fontId="' + (lastFontIndex + 2) +
                                '" fillId="' + (lastFillIndex + 2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s31 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 1) +
                                '" fillId="' + (lastFillIndex + 2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s32 = '<xf  numFmtId="300" fontId="' + (lastFontIndex + 2) +
                                '" fillId="' + (lastFillIndex + 2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s33 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 3) +
                                '" fillId="' + (lastFillIndex + 2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s34 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 4) +
                                '" fillId="' + (lastFillIndex + 2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s35 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 5) +
                                '" fillId="' + (lastFillIndex + 2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s36 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 6) +
                                '" fillId="' + (lastFillIndex + 2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s37 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 7) +
                                '" fillId="' + (lastFillIndex + 2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s38 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 8) +
                                '" fillId="' + (lastFillIndex + 2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s39 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 9) +
                                '" fillId="' + (lastFillIndex + 2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';

                            var xfRosa = '<xf numFmtId="0" fontId="0" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="right"/></xf>';
                            var xfAmarillo = '<xf numFmtId="0" fontId="0" fillId="' + (lastFillIndex + 2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="right"/></xf>';
                            var xfRosaChar = '<xf numFmtId="0" fontId="0" fillId="' + (lastFillIndex + 1) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="left"/></xf>';
                            var xfAmarilloChar = '<xf numFmtId="0" fontId="0" fillId="' + (lastFillIndex +
                                    2) +
                                '" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="left"/></xf>';
                            sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                            sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2 + f3 + f4 + f5 + f6 + f7 +
                                f8 + f9;
                            sSh.childNodes[0].childNodes[2].innerHTML += fillRosa + fillAmarillo;
                            sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 +
                                s6 + s7 + s8 + s9 + s10 + s11 + s12 + s13 + s14 + s15;
                            //AGREGANDO FONDO ROSA
                            sSh.childNodes[0].childNodes[5].innerHTML += s16 + s17 + s18 + s19 + s20 +
                                s21 + s22 + s23 + s24 + s25 + s26 + xfRosa;
                            //AGREGANDO FONDO AMARILLO
                            sSh.childNodes[0].childNodes[5].innerHTML += s29 + s30 + s31 + s32 + s33 +
                                s34 + s35 + s36 + s37 + s38 + s39 + xfAmarillo;
                            //AGREGANDO FONDO ROSA A CARACTERES
                            sSh.childNodes[0].childNodes[5].innerHTML += xfRosaChar + xfAmarilloChar;
                            var fourDecPlaces = lastXfIndex + 1;
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
                            var textpurple = lastXfIndex + 15;
                            //MISMAS FUENTES FONDO ROSA
                            var textred1Rosa = lastXfIndex + 16;
                            var textgreen1Rosa = lastXfIndex + 17;
                            var textred2Rosa = lastXfIndex + 18;
                            var textgreen2Rosa = lastXfIndex + 19;
                            var textCyanRosa = lastXfIndex + 20;
                            var textBrownRosa = lastXfIndex + 21;
                            var textDarkblueRosa = lastXfIndex + 22;
                            var textDarkGreenRosa = lastXfIndex + 23;
                            var textYellowRosa = lastXfIndex + 24;
                            var textNaranjaRosa = lastXfIndex + 25;
                            var textpurpleRosa = lastXfIndex + 26;
                            var bgPink = lastXfIndex + 27;
                            //MISMAS FUENTES FONDO AMARILLO
                            var textred1Amarillo = lastXfIndex + 28;
                            var textgreen1Amarillo = lastXfIndex + 29;
                            var textred2Amarillo = lastXfIndex + 30;
                            var textgreen2Amarillo = lastXfIndex + 31;
                            var textCyanAmarillo = lastXfIndex + 32;
                            var textBrownAmarillo = lastXfIndex + 33;
                            var textDarkblueAmarillo = lastXfIndex + 34;
                            var textDarkGreenAmarillo = lastXfIndex + 35;
                            var textYellowAmarillo = lastXfIndex + 36;
                            var textNaranjaAmarillo = lastXfIndex + 37;
                            var textpurpleAmarillo = lastXfIndex + 38;
                            var bgYellow = lastXfIndex + 39;

                            var bgPinkChar = lastXfIndex + 40;
                            var bgYellowChar = lastXfIndex + 41;

                            $('c[r=A1] t', sheet).text(
                                'REPORTE DE PLANEACION AGREGADA DE OPERACIONES Y VENTAS');
                            $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                            $('row:eq(1) c', sheet).attr('s', 7);
                            $('row:eq(2) c', sheet).attr('s', 7);
                            $('row', sheet).each(function() {
                                var row = $(this);
                                var cellA = $('c[r^="A"]', row);
                                var cellE = $('c[r^="E"]', row);
                                if (row.index() < 3) {
                                    return;
                                }
                                if (cellE.text().toString() == 'NULL') {
                                    row.remove();
                                }
                                if (formato == 10) {
                                    $('c[r^="F"], c[r^="R"]', row).attr('s', textDarkblue);
                                    $('c[r^="G"]', row).attr('s', textDarkGreen);
                                    $('c[r^="H"], c[r^="I"]', row).attr('s', textYellow);
                                    $('c[r^="J"], c[r^="L"], c[r^="N"], c[r^="O"], c[r^="P"]', row)
                                        .attr('s', textNaranja);
                                    $('c[r^="Q"]', row).attr('s', textgreen1);
                                    $('c[r^="S"], c[r^="V"]', row).attr('s', textred1);
                                    $('c[r^="X"], c[r^="Z"]', row).attr('s', textCyan);

                                    if (cellE.text() === "L") {
                                        if (parseFloat($('c[r^="R"]', row).text()) <= parseFloat($(
                                                'c[r^="Q"]', row).text()) ||
                                            parseFloat($('c[r^="U"]', row).text()) <= parseFloat($(
                                                'c[r^="Q"]', row).text()) ||
                                            isNaN(parseFloat($('c[r^="U"]', row).text())) || isNaN(
                                                parseFloat($('c[r^="R"]', row).text()))) {
                                            if (parseFloat($('c[r^="U"]', row).text()) != 0) {
                                                $('c[r^="F"], c[r^="R"]', row).attr('s',
                                                    textDarkblueRosa);
                                                $('c[r^="G"]', row).attr('s', textDarkGreenRosa);
                                                $('c[r^="H"], c[r^="I"]', row).attr('s',
                                                    textYellowRosa);
                                                $('c[r^="J"], c[r^="L"], c[r^="N"], c[r^="O"], c[r^="P"]',
                                                    row).attr('s', textNaranjaRosa);
                                                $('c[r^="Q"]', row).attr('s', textgreen1Rosa);
                                                $('c[r^="S"], c[r^="V"]', row).attr('s',
                                                    textred1Rosa);
                                                $('c[r^="X"], c[r^="Z"]', row).attr('s',
                                                    textCyanRosa);

                                                $('c[r^="A"],c[r^="K"], c[r^="M"], c[r^="T"], c[r^="U"], c[r^="W"], c[r^="Y"], c[r^="AA"]',
                                                    row).attr('s', bgPink);
                                                $('c[r^="B"],c[r^="C"], c[r^="D"], c[r^="E"]', row)
                                                    .attr('s', bgPinkChar);
                                            }
                                        } else {
                                            if (parseFloat($('c[r^="R"]', row).text()) <= (
                                                    parseFloat($('c[r^="Q"]', row).text()) + 1) ||
                                                parseFloat($('c[r^="U"]', row).text()) <= (
                                                    parseFloat($('c[r^="Q"]', row).text()) + 1)) {
                                                $('c[r^="F"], c[r^="R"]', row).attr('s',
                                                    textDarkblueAmarillo);
                                                $('c[r^="G"]', row).attr('s',
                                                textDarkGreenAmarillo);
                                                $('c[r^="H"], c[r^="I"]', row).attr('s',
                                                    textYellowAmarillo);
                                                $('c[r^="J"], c[r^="L"], c[r^="N"], c[r^="O"], c[r^="P"]',
                                                    row).attr('s', textNaranjaAmarillo);
                                                $('c[r^="Q"]', row).attr('s', textgreen1Amarillo);
                                                $('c[r^="S"], c[r^="V"]', row).attr('s',
                                                    textred1Amarillo);
                                                $('c[r^="X"], c[r^="Z"]', row).attr('s',
                                                    textCyanAmarillo);

                                                $('c[r^="A"],c[r^="K"], c[r^="M"], c[r^="T"], c[r^="U"], c[r^="W"], c[r^="Y"], c[r^="AA"]',
                                                    row).attr('s', bgYellow);
                                                $(' c[r^="B"],c[r^="C"], c[r^="D"], c[r^="E"]', row)
                                                    .attr('s', bgYellowChar);
                                            }
                                        }
                                    }
                                } else {
                                    $('c[r^="F"], c[r^="H"], c[r^="AF"], c[r^="AH"]', row).attr('s',
                                        textCyan);
                                    $('c[r^="L"], c[r^="AA"], c[r^="AD"]', row).attr('s', textred1);
                                    $('c[r^="J"]', row).attr('s', textBrown);
                                    $('c[r^="Y"]', row).attr('s', textgreen1);
                                    $('c[r^="K"], c[r^="M"], c[r^="N"], c[r^="Z"]', row).attr('s',
                                        textDarkblue);
                                    $('c[r^="M"], c[r^="N"]', row).attr('s', textpurple);
                                    $('c[r^="O"]', row).attr('s', textDarkGreen);
                                    $('c[r^="P"], c[r^="Q"], c[r^="V"]', row).attr('s', textYellow);
                                    $('c[r^="R"], c[r^="T"], c[r^="V"], c[r^="W"], c[r^="X"]', row)
                                        .attr('s', textNaranja);
                                    if (cellE.text() === "L") {
                                        if (parseFloat($('c[r^="Z"]', row).text()) <= parseFloat($(
                                                'c[r^="Y"]', row).text()) ||
                                            parseFloat($('c[r^="AC"]', row).text()) <= parseFloat($(
                                                'c[r^="Y"]', row).text()) ||
                                            isNaN(parseFloat($('c[r^="AC"]', row).text())) || isNaN(
                                                parseFloat($('c[r^="Z"]', row).text()))) {
                                            if (parseFloat($('c[r^="Z"]', row).text()) != 0) {
                                                $('c[r^="F"], c[r^="H"], c[r^="AF"], c[r^="AH"]',
                                                    row).attr('s', textCyanRosa);
                                                $('c[r^="L"], c[r^="AA"], c[r^="AD"]', row).attr(
                                                    's', textred1Rosa);
                                                $('c[r^="J"]', row).attr('s', textBrownRosa);
                                                $('c[r^="Y"]', row).attr('s', textgreen1Rosa);
                                                $('c[r^="K"], c[r^="M"], c[r^="N"], c[r^="Z"]', row)
                                                    .attr('s', textDarkblueRosa);
                                                $('c[r^="M"], c[r^="N"]', row).attr('s',
                                                    textpurpleRosa);
                                                $('c[r^="O"]', row).attr('s', textDarkGreenRosa);
                                                $('c[r^="P"], c[r^="Q"], c[r^="V"]', row).attr('s',
                                                    textYellowRosa);
                                                $('c[r^="R"], c[r^="T"], c[r^="V"], c[r^="W"], c[r^="X"]',
                                                    row).attr('s', textNaranjaRosa);

                                                $('c[r^="A"], c[r^="G"], c[r^="I"], c[r^="S"], c[r^="U"], c[r^="AB"], c[r^="AC"], c[r^="AE"], c[r^="AG"], c[r^="AI"]',
                                                    row).attr('s', bgPink);
                                                $('c[r^="B"],c[r^="C"], c[r^="D"], c[r^="E"], c[r^="AJ"]',
                                                    row).attr('s', bgPinkChar);
                                            }
                                        } else {
                                            if (parseFloat($('c[r^="Z"]', row).text()) <= (
                                                    parseFloat($('c[r^="Y"]', row).text()) + 1) ||
                                                parseFloat($('c[r^="AC"]', row).text()) <= (
                                                    parseFloat($('c[r^="Y"]', row).text()) + 1)) {
                                                $('c[r^="Y"]', row).attr('s', textgreen1Amarillo);
                                                $('c[r^="L"], c[r^="AA"], c[r^="AD"]', row).attr(
                                                    's', textred1Amarillo);
                                                $('c[r^="F"], c[r^="H"], c[r^="AF"], c[r^="AH"]',
                                                    row).attr('s', textCyanAmarillo);
                                                $('c[r^="J"]', row).attr('s', textBrownAmarillo);
                                                $('c[r^="K"], c[r^="M"], c[r^="N"], c[r^="Z"]', row)
                                                    .attr('s', textDarkblueAmarillo);
                                                $('c[r^="M"], c[r^="N"]', row).attr('s',
                                                    textpurpleAmarillo);
                                                $('c[r^="O"]', row).attr('s',
                                                textDarkGreenAmarillo);
                                                $('c[r^="P"], c[r^="Q"], c[r^="V"]', row).attr('s',
                                                    textYellowAmarillo);
                                                $('c[r^="R"], c[r^="T"], c[r^="V"], c[r^="W"], c[r^="X"]',
                                                    row).attr('s', textNaranjaAmarillo);

                                                $('c[r^="A"], c[r^="B"], c[r^="E"], c[r^="G"], c[r^="I"], c[r^="S"], c[r^="U"], c[r^="AB"], c[r^="AC"], c[r^="AE"], c[r^="AG"], c[r^="AI"]',
                                                    row).attr('s', bgYellow);
                                                $('c[r^="B"],c[r^="C"], c[r^="D"], c[r^="E"], c[r^="AJ"]',
                                                    row).attr('s', bgYellowChar);
                                            }
                                        }
                                    }
                                }
                                //TOTALES
                                if (cellE.text() === "TOTAL" || cellE.text() === "TOTALM") {
                                    $('c[r^="A"], c[r^="B"], c[r^="C"], c[r^="D"], c[r^="E"], c[r^="F"], c[r^="G"], c[r^="H"], c[r^="I"], c[r^="J"], c[r^="K"], c[r^="L"], c[r^="M"], c[r^="N"], c[r^="O"], c[r^="P"], c[r^="Q"], c[r^="R"], c[r^="S"], c[r^="T"], c[r^="U"], c[r^="V"], c[r^="W"], c[r^="X"], c[r^="Y"], c[r^="Z"], c[r^="AA"], c[r^="AB"], c[r^="AC"], c[r^="AD"], c[r^="AE"], c[r^="AF"], c[r^="AG"]',
                                        row).attr('s', 7);
                                    $('c[r^="A"], c[r^="B"], c[r^="C"], c[r^="D"], c[r^="E"]',
                                        row).text('s', ' ');
                                }

                            });
                            var tagName = sSh.getElementsByTagName('sz');
                            for (i = 0; i < tagName.length; i++) {
                                tagName[i].setAttribute("val", "13");
                            }
                            if (formato == 10) {
                                var table = $('#myTablePlaneacion').DataTable();
                                var col = $('col', sheet);
                                table.columns().every(function(index) {
                                    var column = this;
                                    if (!column.visible()) {
                                        var headerText = $(column.header()).text();
                                        if (index > 13 && index < 36) {
                                            var colIndex = 0;
                                            encabezados.forEach(function(item, index) {
                                                if (item == headerText) {
                                                    colIndex = index;
                                                }
                                            });
                                            $(col[colIndex - 9]).attr('width', 0);
                                        }
                                    }
                                });
                            } else {
                                var table = $('#myTablePlaneacion').DataTable();
                                var col = $('col', sheet);
                                table.columns().every(function(index) {
                                    var column = this;
                                    if (!column.visible()) {
                                        if (index < 36 && index > 0) {
                                            $(col[index - 1]).attr('width', 0);
                                        }
                                    }
                                });
                            }

                        }
                    },

                ],
                rowCallback: function(row, data) {
                    if (data.TIPINV === 'TOTAL' || data.TIPINV === 'TOTALM') {
                        row.classList.add('total-row');
                        row.querySelectorAll('td:nth-child(2), td:nth-child(3), td:nth-child(5)')
                            .forEach(td => {
                                td.classList.add('gray-letters');
                            });
                    } else {
                        if (data.TIPINV === 'L') {
                            if (parseFloat(data.MESINV) <= parseFloat(data.LEATIE) || parseFloat(data
                                    .MESIN6) <= parseFloat(data.LEATIE) || isNaN(parseFloat(data
                                    .MESIN6)) || isNaN(parseFloat(data.MESINV))) {
                                if (!isNaN(parseFloat(data.MESINV))) {
                                    row.classList.add('bg-pink');
                                }
                            } else {
                                if (parseFloat(data.MESINV) <= (parseFloat(data.LEATIE) + 1) ||
                                    parseFloat(data.MESIN6) <= (parseFloat(data.LEATIE) + 1)) {
                                    if (!isNaN(parseFloat(data.MESINV))) {
                                        row.classList.add('bg-yellow');
                                    }
                                }
                            }
                        }
                        if (data.UNIVAA !== '') {
                            totalUNIVAA += parseFloat(data.UNIVAA);
                        }
                        if (data.VALVAA !== '') {
                            totalVALVAA += parseFloat(data.VALVAA);
                        }
                    }
                }
            });
            return table;
        }
        function restartOrder() {
            setCookie("boolOrder", "1", 1);
            document.getElementById('loaderTable').classList.remove('d-none');
            setTimeout(() => {
                var table = $('#myTablePlaneacion').DataTable();
                table.order([0, 'asc']).draw();
                var button = document.getElementById('refreshOrderButton');
                if (button) {
                    button.parentNode.removeChild(button);
                }
                table.rows().every(function() {
                    var data = this.data();
                    var rowNode = this.node();
                    if (data.TIPINV == 'TOTAL' || data.TIPINV == 'TOTALM') {
                        rowNode.classList.remove('d-none');
                    }
                });
                document.getElementById('loaderTable').classList.add('d-none');
            }, 100);
        }
        function searchEstilo() {
            var searchBox = document.getElementById("searchEstiloInput");
            var searchText = searchBox.value;
            if (searchText !== '') {
                setCookie("searchVal", searchText, 1);
            } else {
                setCookie("searchVal", '0', 1);
            }
            location.reload();
        }
        function openModalVentas(estilo, data) {
            var anoActual = new Date().getFullYear();
            $("#lblEstilo").text(estilo);
            var urlResumen = "http://172.16.15.20/API.LovablePHP/ZLO0013P/ListResumen/?ano=" + anoActual + "&estilo=" +
                estilo + "";

            var responseResumen = ajaxRequest(urlResumen);
            const tableResumenBody = $("#tableResumenBody");
            tableResumenBody.empty();
            if (responseResumen.code == 200) {
                var options;

                for (let i = 0; i < responseResumen.data.length; i++) {
                    options += "<tr ondblclick='changeResumen(`" + responseResumen.data[i]['ANO'] + "`,`" + estilo + "`)'>";
                    options += "<td>" + responseResumen.data[i]['ANO'] + "</td>";
                    if (responseResumen.data[i]['INGRE'] != 0) {
                        options += "<td>" + ((isNaN(parseFloat(responseResumen.data[i]['INGRE'])) || parseFloat(
                            responseResumen.data[i]['INGRE']) == 0) ? '&#160;' : parseFloat(responseResumen.data[i][
                            'INGRE'
                        ]).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    } else {
                        options += "<td></td>";
                    }
                    if (responseResumen.data[i]['VENDI'] != null) {
                        options += "<td>" + ((isNaN(parseFloat(responseResumen.data[i]['VENDI'])) || parseFloat(
                            responseResumen.data[i]['VENDI']) == 0) ? '&#160;' : parseFloat(responseResumen.data[i][
                            'VENDI'
                        ]).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    } else {
                        options += "<td></td>";
                    }
                    if (responseResumen.data[i]['PERDI'] != null) {
                        options += "<td>" + ((isNaN(parseFloat(responseResumen.data[i]['PERDI'])) || parseFloat(
                            responseResumen.data[i]['PERDI']) == 0) ? '&#160;' : parseFloat(responseResumen.data[i][
                            'PERDI'
                        ]).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    } else {
                        options += "<td></td>";
                    }
                    options += "</tr>";
                }
                tableResumenBody.append(options);
            } else {
                tableResumenBody.append('<tr><td colspan="4" class="text-center">No se encontraron registros</td></tr>');
            }
            chargeDetalles(anoActual, estilo);
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
                setCookie("marcasToggle", 1, 1);
            } else {
                icon.removeClass("fa-angles-down");
                icon.addClass("fa-angles-up");
                document.cookie = "marcasToggle=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
            }
            $("#menuMarcas").animate({
                height: 'toggle'
            });
        }
        function changeResumen(numano, estilo) {
            document.getElementById('loaderTable2').classList.remove('d-none');
            setTimeout(() => {
                chargeDetalles(numano, estilo);
                document.getElementById('loaderTable2').classList.add('d-none');
            }, 400);
        }
        function chargeDetalles(numano, estilo) {
            $("#currentYear").text(numano);
            $("#divTable").empty();
            $("#divTable").append(`
            <div id="loaderTable2" class="d-none" style="position:fixed; z-index: 9999; width: 100%; ">
                <button class="btn btn-light position-absolute top-50 start-50 translate-middle p-4"
                style="z-index: 9999;" type="button" disabled>
                <i class="fa-solid fa-gear fa-spin" style="font-size:70px;"></i>
                </button>
            <div class="position-fixed  top-0 start-0 w-100 h-100 bg-secondary bg-opacity-50 rounded"
            style="z-index: 9998;"></div>
            </div>
            <table id="myTableDetalles" class="table stripe table-hover "style="width:100%">
                            <thead>
                                <tr class="sticky-top bg-white" style="font-size:12px;">
                                    <th class="text-black text-center bg-white detaHead">MARCA</th>
                                    <th class="text-black text-center bg-white detaHead">ESTILO</th>
                                    <th class="text-black text-center bg-white detaHead">COLOR</th>
                                    <th class="text-black text-center bg-white detaHead">TALLA</th>
                                    <th class="text-black text-center bg-white detaHead">T/INV</th>
                                    <th class="text-black text-center">DOC.VEN.<br>AÑO/ACT</th>
                                    <th class="text-black text-center">PROM. MES<br>AÑO/ACT</th>
                                    <th class="text-black text-center">#MESES<br>AÑO/ACT</th>
                                    <th class="text-black text-center">PERDIDA. VTAS<br>AÑO/ACT</th>
                                    <th class="text-black text-center">PROM.PERDIDA VTAS<br>AÑO/ACT</th>
                                    <th class="text-black text-center">APARTADO VEND<br>AÑO/ACT</th>
                                    <th class="text-black text-center">INVENTARIO DISPONIBLE<br>AÑO/ACT</th>
                                    <th class="text-black text-center">V. ENERO</th>
                                    <th class="text-black text-center">V. FEBRERO</th>
                                    <th class="text-black text-center">V. MARZO</th>
                                    <th class="text-black text-center">V. ABRIL</th>
                                    <th class="text-black text-center">V. MAYO</th>
                                    <th class="text-black text-center">V. JUNIO</th>
                                    <th class="text-black text-center">V. JULIO</th>
                                    <th class="text-black text-center">V. AGOSTO</th>
                                    <th class="text-black text-center">V. SEPTIEMBRE</th>
                                    <th class="text-black text-center">V. OCTUBRE</th>
                                    <th class="text-black text-center">V. NOVIEMBRE</th>
                                    <th class="text-black text-center">V. DICIEMBRE</th>
                                    <th class="text-black text-center">P. VTAS.<br>ENERO</th>
                                    <th class="text-black text-center">P. VTAS.<br>FEBRERO</th>
                                    <th class="text-black text-center">P. VTAS.<br>MARZO</th>
                                    <th class="text-black text-center">P. VTAS.<br>ABRIL</th>
                                    <th class="text-black text-center">P. VTAS.<br>MAYO</th>
                                    <th class="text-black text-center">P. VTAS.<br>JUNIO</th>
                                    <th class="text-black text-center">P. VTAS.<br>JULIO</th>
                                    <th class="text-black text-center">P. VTAS.<br>AGOSTO</th>
                                    <th class="text-black text-center">P. VTAS.<br>SEPTIEMBRE</th>
                                    <th class="text-black text-center">P. VTAS.<br>OCTUBRE</th>
                                    <th class="text-black text-center">P. VTAS.<br>NOVIEMBRE</th>
                                    <th class="text-black text-center">P. VTAS.<br>DICIEMBRE</th>
                                </tr>
                            </thead>
                            <tbody id="myTableDetallesBody">

                            </tbody>
                        </table>`);
            var urldeta = "http://172.16.15.20/API.LovablePHP/ZLO0013P/ListDeta/?marca=" + marca + "&plan=" +
                plan + "&estado=" + estado + "&btnor=" + btnOrder + "&inventarios=" + inventarios +
                "&clasificacion=" + clasificacion + "&orden=" + orden + "&filtro=" + filtro +
                "&repro=" + repro + "&formato=" + formato + "&searchVal=" + estilo + "&ano=" + numano + "";
            var responseDeta = ajaxRequest(urldeta);
            const myTableDetallesBody = $("#myTableDetallesBody");
            myTableDetallesBody.empty();
            var options = "";
            if (responseDeta.code == 200) {
                const data = responseDeta.data;
                for (let i = 0; i < data.length; i++) {
                    if (data[i]['TIPINV'] == 'TOTAL') {
                        options += "<tr class='total-row'  style='font-size:12px;'>";
                        options += "<td class='gray-letters bg-white' style='width:55px !important;'>" + data[i]['MARCA'] +
                            "</td>";
                        options += "<td class='gray-letters bg-white' style='width:55px !important;'>" + data[i]['ESTILO'] +
                            "</td>";
                    } else {
                        options += "<tr style='font-size:12px;'>";
                        options += "<td class='bg-white' style='width:55px !important;'>" + data[i]['MARCA'] + "</td>";
                        options += "<td class='bg-white' style='width:55px !important;'>" + data[i]['ESTILO'] + "</td>";
                    }
                    options += "<td class='bg-white' style='width:55px !important;'>" + data[i]['COLOR'] + "</td>";
                    options += "<td class='bg-white' style='width:55px !important;'>" + data[i]['TALLA'] + "</td>";
                    options += "<td class='bg-white' style='width:55px !important;'>" + data[i]['TIPINV'] + "</td>";
                    options += "<td class='text-end text-info'>" + ((isNaN(parseFloat(data[i]['UNIVAA'])) || parseFloat(
                            data[i][
                                'UNIVAA'
                            ]) == 0) ?
                        '&#160;' : parseFloat(data[i]['UNIVAA']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-info'>" + ((isNaN(parseFloat(data[i]['UPRMAC'])) || parseFloat(
                            data[i][
                                'UPRMAC'
                            ]) == 0) ?
                        '&#160;' : parseFloat(data[i]['UPRMAC']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end'>" + data[i]['NUMMES'] + "</td>";
                    options += "<td class='text-end text-darkblue'>" + ((isNaN(parseFloat(data[i]['UVENRE'])) || parseFloat(
                            data[i][
                                'UVENRE'
                            ]) == 0) ?
                        '&#160;' : parseFloat(data[i]['UVENRE']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger'>" + ((isNaN(parseFloat(data[i]['UVNRPR'])) || parseFloat(
                            data[i][
                                'UVNRPR'
                            ]) == 0) ?
                        '&#160;' : parseFloat(data[i]['UVNRPR']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-violet'>" + ((isNaN(parseFloat(data[i]['INVAPA'])) || parseFloat(
                            data[i][
                                'INVAPA'
                            ]) == 0) ?
                        '&#160;' : parseFloat(data[i]['INVAPA']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-success'>" + ((isNaN(parseFloat(data[i]['INVPTE'])) || parseFloat(
                            data[i][
                                'INVPTE'
                            ]) == 0) ?
                        '&#160;' : parseFloat(data[i]['INVPTE']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-brown'>" + ((isNaN(parseFloat(data[i]['V1'])) || parseFloat(data[i]
                            ['V1']) == 0) ?
                        '&#160;' : parseFloat(data[i]['V1']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-brown'>" + ((isNaN(parseFloat(data[i]['V2'])) || parseFloat(data[i]
                            ['V2']) == 0) ?
                        '&#160;' : parseFloat(data[i]['V2']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-brown'>" + ((isNaN(parseFloat(data[i]['V3'])) || parseFloat(data[i]
                            ['V3']) == 0) ?
                        '&#160;' : parseFloat(data[i]['V3']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-brown'>" + ((isNaN(parseFloat(data[i]['V4'])) || parseFloat(data[i]
                            ['V4']) == 0) ?
                        '&#160;' : parseFloat(data[i]['V4']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-brown'>" + ((isNaN(parseFloat(data[i]['V5'])) || parseFloat(data[i]
                            ['V5']) == 0) ?
                        '&#160;' : parseFloat(data[i]['V5']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-brown'>" + ((isNaN(parseFloat(data[i]['V6'])) || parseFloat(data[i]
                            ['V6']) == 0) ?
                        '&#160;' : parseFloat(data[i]['V6']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-brown '>" + ((isNaN(parseFloat(data[i]['V7'])) || parseFloat(data[
                            i]['V7']) == 0) ?
                        '&#160;' : parseFloat(data[i]['V7']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-brown'>" + ((isNaN(parseFloat(data[i]['V8'])) || parseFloat(data[i]
                            ['V8']) == 0) ?
                        '&#160;' : parseFloat(data[i]['V8']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-brown'>" + ((isNaN(parseFloat(data[i]['V9'])) || parseFloat(data[i]
                            ['V9']) == 0) ?
                        '&#160;' : parseFloat(data[i]['V9']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-brown'>" + ((isNaN(parseFloat(data[i]['V10'])) || parseFloat(data[
                            i]['V10']) == 0) ?
                        '&#160;' : parseFloat(data[i]['V10']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-brown'>" + ((isNaN(parseFloat(data[i]['V11'])) || parseFloat(data[
                            i]['V11']) == 0) ?
                        '&#160;' : parseFloat(data[i]['V11']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-brown'>" + ((isNaN(parseFloat(data[i]['V12'])) || parseFloat(data[
                            i]['V12']) == 0) ?
                        '&#160;' : parseFloat(data[i]['V12']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger '>" + ((isNaN(parseFloat(data[i]['PV1'])) || parseFloat(
                            data[i]['PV1']) == 0) ?
                        '&#160;' : parseFloat(data[i]['PV1']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger'>" + ((isNaN(parseFloat(data[i]['PV2'])) || parseFloat(data[
                            i]['PV2']) == 0) ?
                        '&#160;' : parseFloat(data[i]['PV2']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger'>" + ((isNaN(parseFloat(data[i]['PV3'])) || parseFloat(data[
                            i]['PV3']) == 0) ?
                        '&#160;' : parseFloat(data[i]['PV3']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger'>" + ((isNaN(parseFloat(data[i]['PV4'])) || parseFloat(data[
                            i]['PV4']) == 0) ?
                        '&#160;' : parseFloat(data[i]['PV4']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger'>" + ((isNaN(parseFloat(data[i]['PV5'])) || parseFloat(data[
                            i]['PV5']) == 0) ?
                        '&#160;' : parseFloat(data[i]['PV5']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger'>" + ((isNaN(parseFloat(data[i]['PV6'])) || parseFloat(data[
                            i]['PV6']) == 0) ?
                        '&#160;' : parseFloat(data[i]['PV6']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger '>" + ((isNaN(parseFloat(data[i]['PV7'])) || parseFloat(
                            data[i]['PV7']) == 0) ?
                        '&#160;' : parseFloat(data[i]['PV7']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger'>" + ((isNaN(parseFloat(data[i]['PV8'])) || parseFloat(data[
                            i]['PV8']) == 0) ?
                        '&#160;' : parseFloat(data[i]['PV8']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger'>" + ((isNaN(parseFloat(data[i]['PV9'])) || parseFloat(data[
                            i]['PV9']) == 0) ?
                        '&#160;' : parseFloat(data[i]['PV9']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger'>" + ((isNaN(parseFloat(data[i]['PV10'])) || parseFloat(
                            data[i]['PV10']) == 0) ?
                        '&#160;' : parseFloat(data[i]['PV10']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger'>" + ((isNaN(parseFloat(data[i]['PV11'])) || parseFloat(
                            data[i]['PV11']) == 0) ?
                        '&#160;' : parseFloat(data[i]['PV11']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "<td class='text-end text-danger'>" + ((isNaN(parseFloat(data[i]['PV12'])) || parseFloat(
                            data[i]['PV12']) == 0) ?
                        '&#160;' : parseFloat(data[i]['PV12']).toLocaleString('es-419', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        })) + "</td>";
                    options += "</tr>";
                }
            }
            myTableDetallesBody.append(options);
            $("#myTableDetalles").DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                fixedColumns: {
                    left: 5,
                },
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fa-solid fa-file-excel me-1"></i><b>Enviar a Excel</b>',
                        className: "btn btn-success text-light fs-6 mb-2 text-center",
                        title: estilo + '-detalle' + numano,
                        action: function(e, dt, button, config) {
                            document.getElementById('loaderExcel').classList.remove('d-none');
                            setTimeout(() => {
                                $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e,
                                    dt, button, config);
                                document.getElementById('loaderExcel').classList.add(
                                    'd-none');
                            }, 200);
                        },
                        messageTop: ' ',
                        exportOptions: {
                            modifier: {
                                search: 'applied',
                                order: 'applied'
                            },
                            format: {
                                body: function(data, row, column, node) {
                                    // Puedes realizar aquí alguna manipulación de datos si es necesario
                                    if ($(node).closest('tr').hasClass('d-none')) {
                                        return 'NULL'; // Excluir filas vacías
                                    }
                                    return data;
                                }
                            },
                            customizeData: function(data) {
                                for (var i = data.body.length - 1; i >= 0; i--) {
                                    var row = data.body[i];
                                    var excludeRow = false;
                                    if (row[0] === 'NULL') {
                                        excludeRow = true;
                                    }
                                    if (excludeRow) {
                                        data.body.splice(i, 1);
                                    }
                                }
                            },
                        },
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
                            var f3 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="00BBCD" />' + // color cyan de la fuente
                                '</font>';
                            var f4 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="7E5006" />' + // color cyan de la fuente
                                '</font>';
                            var f5 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="00377D" />' + // color azul oscuro de la fuente
                                '</font>';
                            var f6 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="0F8900" />' + // color verde oscuro de la fuente
                                '</font>';
                            var f7 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="C1C100" />' + // color amarillo de la fuente
                                '</font>';
                            var f8 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="FFB202" />' + // color naranja de la fuente
                                '</font>';
                            var f9 = '<font>' +
                                '<sz val="11" />' +
                                '<name val="Calibri" />' +
                                '<color rgb="9F6CFF" />' + // color morada de la fuente
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
                            var s9 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 3) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s10 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 4) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s11 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 5) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s12 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 6) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s13 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 7) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s14 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 8) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            var s15 = '<xf numFmtId="0" fontId="' + (lastFontIndex + 9) +
                                '" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">' +
                                '<alignment horizontal="right"/></xf>';
                            sSh.childNodes[0].childNodes[0].innerHTML += n1 + n2;
                            sSh.childNodes[0].childNodes[1].innerHTML += f1 + f2 + f3 + f4 + f5 +
                                f6 + f7 + f8 + f9;
                            sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4 + s5 +
                                s6 + s7 + s8 + s9 + s10 + s11 + s12 + s13 + s14 + s15;

                            var fourDecPlaces = lastXfIndex + 1;
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
                            var textpurple = lastXfIndex + 15;
                            $('c[r=A1] t', sheet).text(
                                'REPORTE DE PLANEACION AGREGADA DE OPERACIONES Y VENTAS DETALLE: ' +
                                estilo);
                            $('row:eq(0) c', sheet).attr('s', greyBoldCentered);
                            $('row:eq(1) c', sheet).attr('s', 7);
                            $('row:eq(2) c', sheet).attr('s', 7);
                            $('row', sheet).each(function() {
                                var row = $(this);
                                var cellA = $('c[r^="A"]', row);
                                var cellE = $('c[r^="E"]', row);

                                if (row.index() < 3) {
                                    return;
                                }
                                $('c', row).each(function() {
                                    var cell = $(this);
                                    var cellText = cell.text();

                                    if (cellText == '&nbsp;') {
                                        cell.text(' ');
                                    }
                                });
                                if (cellE.text().toString() == 'NULL') {
                                    row.remove();
                                }
                                $('c[r^="Y"], c[r^="Z"],c[r^="AA"],c[r^="AB"],c[r^="AC"],c[r^="AD"], c[r^="AE"],c[r^="AF"], c[r^="AG"],c[r^="AH"],c[r^="AI"],c[r^="AJ"]',
                                    row).attr('s', textred1);
                                $('c[r^="M"], c[r^="N"],c[r^="O"],c[r^="P"],c[r^="Q"],c[r^="R"], c[r^="S"],c[r^="T"], c[r^="U"],c[r^="V"],c[r^="W"],c[r^="X"]',
                                    row).attr('s', textBrown);
                                //TOTALES

                                if (cellE.text() === "TOTAL" || cellE.text() === "TOTALC") {
                                    $('c[r^="A"], c[r^="B"], c[r^="C"], c[r^="D"], c[r^="E"], c[r^="F"], c[r^="G"], c[r^="H"], c[r^="I"], c[r^="J"], c[r^="K"], c[r^="L"], c[r^="M"], c[r^="N"], c[r^="O"], c[r^="P"], c[r^="Q"], c[r^="R"], c[r^="S"], c[r^="T"], c[r^="U"], c[r^="V"], c[r^="W"], c[r^="X"], c[r^="Y"], c[r^="Z"], c[r^="AA"], c[r^="AB"], c[r^="AC"], c[r^="AD"], c[r^="AE"], c[r^="AF"], c[r^="AG"], c[r^="AH"], c[r^="AI"], c[r^="AJ"]',
                                        row).attr('s', 7);
                                    $('c[r^="A"], c[r^="B"], c[r^="C"], c[r^="D"], c[r^="E"]', row)
                                        .text('s', ' ');
                                }
                            });
                            var tagName = sSh.getElementsByTagName('sz');
                            for (i = 0; i < tagName.length; i++) {
                                tagName[i].setAttribute("val", "13");
                            }
                        }
                    },

                ],
                "pageLength": 1000,
                "paging": false,
                ordering: true,
                dom: 'Bftip',
                rowCallback: function(row, data) {
                    if (data[4] === 'TOTAL' || data[4] === 'TOTALC') {
                        row.classList.add('total-row');
                        row.querySelectorAll('td:nth-child(2), td:nth-child(3), td:nth-child(5)')
                            .forEach(td => {
                                td.classList.add('gray-letters');
                            });
                    }
                }
            });
        }
        $(function($) {
            var scrollbar = $('<div id="fixed-scrollbar"><div></div></div>').appendTo($(document.body));
            scrollbar.hide().css({
                overflowX: 'auto',
                position: 'fixed',
                width: '100%',
                bottom: 0
            });
            var fakecontent = scrollbar.find('div');

            function top(e) {
                return e.offset().top;
            }

            function bottom(e) {
                return e.offset().top + e.height();
            }

            var active = $([]);

            function find_active() {
                scrollbar.show();
                var active = $([]);
                $('.fixed-scrollbar').each(function() {
                    if (top($(this)) < top(scrollbar) && bottom($(this)) > bottom(scrollbar)) {
                        fakecontent.width($(this).get(0).scrollWidth);
                        fakecontent.height(1);
                        active = $(this);
                    }
                });
                fit(active);
                return active;
            }

            function fit(active) {
                if (!active.length) return scrollbar.hide();
                scrollbar.css({
                    left: active.offset().left,
                    width: active.width()
                });
                fakecontent.width($(this).get(0).scrollWidth);
                fakecontent.height(1);
                delete lastScroll;
            }

            function onscroll() {
                var oldactive = active;
                active = find_active();
                if (oldactive.not(active).length) {
                    oldactive.unbind('scroll', update);
                }
                if (active.not(oldactive).length) {
                    active.scroll(update);
                }
                update();
            }

            var lastScroll;

            function scroll() {
                if (!active.length) return;
                if (scrollbar.scrollLeft() === lastScroll) return;
                lastScroll = scrollbar.scrollLeft();
                active.scrollLeft(lastScroll);
            }

            function update() {
                if (!active.length) return;
                if (active.scrollLeft() === lastScroll) return;
                lastScroll = active.scrollLeft();
                scrollbar.scrollLeft(lastScroll);
            }

            scrollbar.scroll(scroll);

            onscroll();
            $(window).scroll(onscroll);
            $(window).resize(onscroll);
        });
    </script>
</body>
<!-- Modal -->
<div class="modal fade" id="ventasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
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
                                <label for="" class="form-control mb-3 mb-lg-0 mt-lg-5">Estilo: <span
                                        id="lblEstilo"></span></label>
                            </div>
                            <div class="col-12 col-lg-9">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h5><u>Resumen por año</u></h5>
                                    </div>
                                    <div>
                                        <h6><b>**Doble click para ver el detalle**</b></h6>
                                    </div>
                                </div>
                                <div class="table-responsive mt-3  rounded" style="width:100%; height:200px;">
                                    <table id="tableResumen" class="table stripe table-secondary table-hover "
                                        style="width:100%">
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
                                <h5 class="mb-3"><u>Detalle del año</u> <span id="currentYear"></span></h5>
                                <div id="divTable" class="table-container2">

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