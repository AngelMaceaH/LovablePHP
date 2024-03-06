<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <style>
      .bg-factura {
          background-color: #FAFAFA;
      }
    </style>
</head>

<body>
    <?php include '../layout-prg.php';?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Módulo de facturación / Consultas</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0001PRT</span></li>
            </ol>
        </nav>

        </header>
        <div id="body-div" class="body flex-grow-1">
            <div class="card mb-5">
                <div class="card-header ">
                    <h5 class=" text-start responsive-font-example mt-2 mb-2" id="lblCorre"></h5>
                </div>
                <div class="card-body">
                    <div class="bg-factura p-1 rounded">
                        <div class="row">
                            <div class="col-3">
                                <h5 class=" text-start responsive-font-example mt-2 mb-2">Factura: <b
                                        id="lblFactura"></b></h5>
                            </div>
                            <div class="col-6">
                                <h5 class=" text-start responsive-font-example mt-2 mb-2">Cliente: <b
                                        id="lblCliente"></b></h5>
                            </div>
                            <div class="col-3">
                                <h5 class=" text-start responsive-font-example mt-2 mb-2">Tipo: <b id="lblTipo"></b>
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 col-lg-6">
                                <h5 class=" text-start responsive-font-example mb-2" id="lblVendedor"></h5>
                            </div>

                            <div class="col-4 col-lg-2">
                                <h5 class=" text-start responsive-font-example mb-2" id="lblFecha"></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 col-lg-3">
                                <h5 class=" text-start responsive-font-example mb-2">Plazo:<b id="lblPlazo"></b></h5>
                            </div>
                            <div class="col-4 col-lg-3">
                                <h5 class=" text-start responsive-font-example mb-2">Moneda: <b id="lblMoneda"></b></h5>
                            </div>
                            <div class="col-4 col-lg-3">
                                <h5 class=" text-start responsive-font-example mb-2">Impuesto (S/N): <b
                                        id="lblImpuesto"></b></h5>
                            </div>
                            <div class="col-3 col-lg-3">
                                <h5 class=" text-start responsive-font-example mb-2">No. Bultos: <b id="lblBultos"></b>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="enca2">
                        <div class="row ">
                            <div class="col-6 ">
                                <h5 class=" text-start responsive-font-example mb-2"><b>Consecutivo</b></h5>
                            </div>
                            <div class="col-6">
                                <h5 class=" text-start responsive-font-example mb-2"><b>Clave</b></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5 class=" text-start responsive-font-example mb-2"><b id="lblConsecu"></b></h5>
                            </div>
                            <div class="col-6">
                                <h5 class=" text-start responsive-font-example mb-2"><b id="lblClave"></b></h5>
                            </div>
                        </div>
                    </div>
                    <div id="enca1">
                        <div class="row ">
                            <div class="col-6 ">
                                <h5 class=" text-start responsive-font-example mb-2"><b>P E D I D O S</b></h5>
                            </div>
                            <div class="col-6">
                                <h5 class=" text-start responsive-font-example mb-2"><b>P R E V E N T A S</b></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5 class=" text-start responsive-font-example mb-2"><b id="lblPedidos"></b></h5>
                            </div>
                            <div class="col-6">
                                <h5 class=" text-start responsive-font-example mb-2"><b id="lblPreventas"></b></h5>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="bg-factura p-1 rounded">
                        <div class="row">
                            <div class="col-6">
                                <h5 class=" text-start responsive-font-example mb-2">Fecha Ven: <b id="lblFechaVen"></b>
                                </h5>
                            </div>
                            <div class="col-6">
                                <h5 class=" text-start responsive-font-example mb-2">Lugar de Destino: <b
                                        id="lblLugarDes"></b></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <h5 class=" text-start responsive-font-example mb-2">Transporte: <b id="lblTransp"></b>
                                </h5>
                            </div>
                            <div class="col-6">
                                <h5 class=" text-start responsive-font-example mb-2">Fecha Embarque: <b
                                        id="lblFechaEmbar"></b></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <h5 class=" text-start responsive-font-example mb-2">Total Bruto: <span
                                        class="responsive-font-example"><b id="lblTBruto"></b></span></h5>
                            </div>
                            <div class="col-3">
                                <h5 class=" text-start responsive-font-example mb-2">Desc: <span
                                        class="responsive-font-example"><b id="lblDesc"></b></span></h5>
                            </div>
                            <div class="col-3">
                                <h5 class=" text-start responsive-font-example  mb-2">Imp: <span
                                        class="responsive-font-example"><b id="lblImp"></b></span></h5>
                            </div>
                            <div class="col-3">
                                <h5 class=" text-start responsive-font-example mb-2">Total Neto: <span
                                        class="responsive-font-example"><b id="lblTNeto"></b></span></h5>
                            </div>
                        </div>
                        <div class="row" id="enca22">
                            <div class="col-12">
                                <h5 class="text-start responsive-font-example mb-2">Tot.c/Desc: <span
                                        class="responsive-font-example"><b id="lblTDesc"></b></span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="myTableFactura" class="table stripe table-hover mt-4" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Marca</th>
                                    <th class="text-center">Estilo</th>
                                    <th class="text-end">Color</th>
                                    <th class="text-end">Talla</th>
                                    <th class="text-end">CLD</th>
                                    <th class="text-end">Cantidad</th>
                                    <th class="text-end">NIV%</th>
                                    <th class="text-end">Desc</th>
                                    <th class="text-end">Precio</th>
                                    <th class="text-end">Valor</th>
                                </tr>
                            </thead>
                            <tbody id="myTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
        <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
            <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
        </div>
        <?php include '../../assets/js/PRG/ZFA/ZLO0001P/ZLO0001PRT.php'; ?>
</body>

</html>