<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/vendors/highcharts.css">
</head>

<body>
    <?php
    include '../layout-prg.php';
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span> Consultas / Ventas de fábrica </span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0054P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body">

        <div class="card mb-5">
            <div class="p-3">
                <div class="demo">
                    <ul class="tablist" role="tablist">
                        <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1"
                            aria-selected="true" role="tab" tabindex="0">Ventas generales</li>
                        <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false"
                            role="tab" tabindex="0">Ventas por vendedor</li>
                        <li id="tab3" class="tablist__tab text-center p-3" aria-controls="panel3" aria-selected="false"
                            role="tab" tabindex="0">Ventas por cliente</li>
                        <li id="tab4" class="tablist__tab text-center p-3" aria-controls="panel4" aria-selected="false"
                            role="tab" tabindex="0">Ventas clientes x País</li>
                        <li id="tab5" class="tablist__tab text-center p-3" aria-controls="panel5" aria-selected="false"
                            role="tab" tabindex="0">Ventas clientes x Ciudad</li>
                        <div id="loaderExcel" class="d-none">
                            <button class="btn btn-success position-absolute top-0 start-50 translate-middle"
                                style="z-index: 9999; margin-top: 700px;" type="button" disabled="">
                                <svg class="svg-inline--fa fa-file-excel fa-flip text-white" style="font-size: 70px;"
                                    aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-excel"
                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                    data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM155.7 250.2L192 302.1l36.3-51.9c7.6-10.9 22.6-13.5 33.4-5.9s13.5 22.6 5.9 33.4L221.3 344l46.4 66.2c7.6 10.9 5 25.8-5.9 33.4s-25.8 5-33.4-5.9L192 385.8l-36.3 51.9c-7.6 10.9-22.6 13.5-33.4 5.9s-13.5-22.6-5.9-33.4L162.7 344l-46.4-66.2c-7.6-10.9-5-25.8 5.9-33.4s25.8-5 33.4 5.9z">
                                    </path>
                                </svg>
                            </button>
                            <div class="position-absolute top-0 start-0 w-100  bg-secondary bg-opacity-50 rounded"
                                style="z-index: 9998; height: 100%; !important; width:100%  !important;">
                            </div>
                        </div>
                    </ul>
                    <div id="panel1" class="tablist__panel p-3 border rounded" aria-labelledby="tab1"
                        aria-hidden="false" role="tabpanel">
                        <div class="table-responsive">
                            <div class="mb-3">
                                <label for="" class="form-control border border-0 fw-bold mb-2">Mostrar por: </label>
                                <select id="cbbChart" class="form-control">
                                    <option value="1">Valores</option>
                                    <option value="2">Docenas</option>
                                </select>
                            </div>
                            <figure class="highcharts-figure">
                                <div id="container" class="highcharts-dark text-white Math.rounded">
                                </div>
                            </figure>
                            <span>Expresado en <b>lempiras</b></span>
                            <table class="table table-bordered striped" id="table1" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class=""></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table1lbl0"></span></th>
                                        <th colspan="2" class="text-center "><span id="table1lbl1"></span></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table1lbl2"></span></th>
                                        <th colspan="2" class="text-center "><span id="table1lbl3"></span></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table1lbl4"></span></th>
                                    </tr>
                                    <tr>
                                        <th class="">Mes</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                        <th class="text-end">Docenas</th>
                                        <th class="text-end">Valores</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                        <th class="text-end">Docenas</th>
                                        <th class="text-end">Valores</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    <div id="panel2" class="tablist__panel is-hidden p-3 border rounded" aria-labelledby="tab2"
                        aria-hidden="false" role="tabpanel">
                        <div class="table-responsive">
                            <div class="mb-3">
                                <label for="" class="form-control border border-0 fw-bold mb-2">Mostrar por: </label>
                                <select id="cbbChart2" class="form-control">
                                    <option value="1">Valores</option>
                                    <option value="2">Docenas</option>
                                </select>
                            </div>
                            <figure class="highcharts-figure">
                                <div id="container2" class="highcharts-dark text-white Math.rounded">
                                </div>
                            </figure>
                            <span>Expresado en <b>lempiras</b></span>
                            <table class="table table-bordered striped" id="table2" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class=""></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table2lbl0"></span></th>
                                        <th colspan="2" class="text-center "><span id="table2lbl1"></span></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table2lbl2"></span></th>
                                        <th colspan="2" class="text-center "><span id="table2lbl3"></span></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table2lbl4"></span></th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th class="">Vendedor</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                        <th class="text-end">Docenas</th>
                                        <th class="text-end">Valores</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                        <th class="text-end">Docenas</th>
                                        <th class="text-end">Valores</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    <div id="panel3" class="tablist__panel is-hidden p-3 border rounded" aria-labelledby="tab3"
                        aria-hidden="false" role="tabpanel">
                        <div class="table-responsive">
                            <div class="mb-3">
                                <label for="" class="form-control border border-0 fw-bold mb-2">Mostrar por: </label>
                                <select id="cbbChart3" class="form-control">
                                    <option value="1">Valores</option>
                                    <option value="2">Docenas</option>
                                </select>
                            </div>
                            <figure class="highcharts-figure">
                                <div id="container3" class="highcharts-dark text-white Math.rounded">
                                </div>
                            </figure>
                            <span>Expresado en <b>lempiras</b></span>
                            <table class="table table-bordered striped" id="table3" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class=""></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table3lbl0"></span></th>
                                        <th colspan="2" class="text-center "><span id="table3lbl1"></span></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table3lbl2"></span></th>
                                        <th colspan="2" class="text-center "><span id="table3lbl3"></span></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table3lbl4"></span></th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th class="">Cliente</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                        <th class="text-end">Docenas</th>
                                        <th class="text-end">Valores</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                        <th class="text-end">Docenas</th>
                                        <th class="text-end">Valores</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    <div id="panel4" class="tablist__panel is-hidden p-3 border rounded" aria-labelledby="tab4"
                        aria-hidden="false" role="tabpanel">
                        <div class="table-responsive">
                            <div class="mb-3">
                                <label for="" class="form-control border border-0 fw-bold mb-2">Mostrar por: </label>
                                <select id="cbbChart4" class="form-control">
                                    <option value="1">Valores</option>
                                    <option value="2">Docenas</option>
                                </select>
                            </div>
                            <figure class="highcharts-figure">
                                <div id="container4" class="highcharts-dark text-white Math.rounded">
                                </div>
                            </figure>
                            <span>Expresado en <b>lempiras</b></span>
                            <table class="table table-bordered striped" id="table4" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class=""></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table4lbl0"></span></th>
                                        <th colspan="2" class="text-center "><span id="table4lbl1"></span></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table4lbl2"></span></th>
                                        <th colspan="2" class="text-center "><span id="table4lbl3"></span></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table4lbl4"></span></th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th class="">País</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                        <th class="text-end">Docenas</th>
                                        <th class="text-end">Valores</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                        <th class="text-end">Docenas</th>
                                        <th class="text-end">Valores</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    <div id="panel5" class="tablist__panel is-hidden p-3 border rounded" aria-labelledby="tab5"
                        aria-hidden="false" role="tabpanel">
                        <div class="table-responsive">
                            <div class="mb-3">
                                <label for="" class="form-control border border-0 fw-bold mb-2">Mostrar por: </label>
                                <select id="cbbChart5" class="form-control">
                                    <option value="1">Valores</option>
                                    <option value="2">Docenas</option>
                                </select>
                            </div>
                            <figure class="highcharts-figure">
                                <div id="container5" class="highcharts-dark text-white Math.rounded">
                                </div>
                            </figure>
                            <span>Expresado en <b>lempiras</b></span>
                            <table class="table table-bordered striped" id="table5" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class=""></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table5lbl0"></span></th>
                                        <th colspan="2" class="text-center "><span id="table5lbl1"></span></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table5lbl2"></span></th>
                                        <th colspan="2" class="text-center "><span id="table5lbl3"></span></th>
                                        <th colspan="2" class="text-center bg-light"><span id="table5lbl4"></span></th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th class="">Ciudad</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                        <th class="text-end">Docenas</th>
                                        <th class="text-end">Valores</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                        <th class="text-end">Docenas</th>
                                        <th class="text-end">Valores</th>
                                        <th class="text-end bg-light">Docenas</th>
                                        <th class="text-end bg-light">Valores</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
        <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="../../assets/js/PRG/ZFA/ZLO0054P/script.js"></script>
</body>

</html>