<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../assets/vendors/monthpicker/material.css">
    <link href="../../assets/vendors/monthpicker/picker.css" rel="stylesheet">
</head>

<body>
    <div class="spinner-wrapper">
        <span class="loader"></span>
    </div>
    <?php
      include '../layout-prg.php';
      include '../../assets/js/PRG/ZFA/ZLO0003P.php';
?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Módulo de facturación / Consultas</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0003P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Consulta Comp.Ventas x marca,pais y meses(tiendas)</h1>
            </div>
            <div class="card-body">

                <div class="position-relative">
                    <form id="formFiltros" action="../../assets/php/ZFA/ZLO0003P/filtrosLogica.php" method="POST">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-lg-6 mt-2">
                                <label>Marca:</label>
                                <select class="form-select  mt-1" id="cbbMarca" name="cbbMarca">
                                    <option value="0" checked>TODAS LAS MARCAS</option>

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
                        <div class="row" id="grafica">
                            <div class="col-12 col-lg-12">
                                <figure class="highcharts-figure">
                                    <div id="container2"></div>
                                </figure>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="myTableMarcasPaises" class="table stripe table-hover " style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="d-none">ID</th>
                                        <th class="text-start">Paises</th>
                                        <th class="text-end">Und. Año <?php echo $ano2;?></th>
                                        <th class="text-end">Valor Año <?php echo $ano2;?></th>
                                        <th class="text-end">Und. Año <?php echo $ano2-1;?></th>
                                        <th class="text-end">Valor Año <?php echo $ano2-1;?></th>
                                        <th class="text-end">Variación</th>
                                        <th class="text-end">Crecimiento</th>
                                    </tr>
                                </thead>
                                <tbody id="myTableMarcasPaisesBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="panel2" class="tablist__panel is-hidden p-3" aria-labelledby="tab2" aria-hidden="true"
                            role="tabpanel">
                            <div class="row" id="grafica2">
                              <div class="col-12 col-lg-12">
                                  <figure class="highcharts-figure">
                                      <div id="container3"></div>
                                  </figure>
                              </div>
                          </div>
                            <table id="myTableMarcasTiendas" class="table stripe table-hover " style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="d-none">ID</th>
                                        <th class="text-start">Punto de venta</th>
                                        <th class="text-end">Und. Año <?php echo $ano2;?></th>
                                        <th class="text-end">Valor Año <?php echo $ano2;?></th>
                                        <th class="text-end">Und. Año <?php echo $ano2-1;?></th>
                                        <th class="text-end">Valor Año <?php echo $ano2-1;?></th>
                                        <th class="text-end">Variación</th>
                                        <th class="text-end">Crecimiento</th>
                                    </tr>
                                </thead>
                                <tbody id="myTableMarcasTiendasBody">
                                   
                                </tbody>
                            </table>

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

    <script src="../../assets/vendors/monthpicker/picker.js"></script>
    <script src="../../assets/vendors/monthpicker/calendars.min.js"></script>
</body>

</html>