<!DOCTYPE html>
<html lang="es">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
  <style>
    .positionRel{
      position: relative; 
      left: 50%;
      transform: translateX(-50%);
    }
    div.dt-buttons {
            float: left;
          }
    @media (max-width: 1199px) {
      .graficasPC {
        display: none;
      }
      .graficasMovil {
        display: flex;
        
      }
    }
    @media (min-width: 1200px) {

      .graficasPC {
        display: block;
      }
      .graficasMovil {
        display: none;
      }
    }
  </style>
</head>
<body>
<?php
      include '../layout-prg.php';
?>
     <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
              <span>Producto Terminado / Inventarios</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0002P</span></li>
            </ol>
          </nav>
        </div>
      </header>
      <div id="body-div" class="body flex-grow-3">
          <div class="card mb-5">
            <div class="card-header">
              
            </div>
            <div class="card-body">
            <div class="demo">
                <ul class="tablist" role="tablist">
                    <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1" aria-selected="true" role="tab" tabindex="0">Puntos de venta</li>
                    <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false" role="tab" tabindex="0">Países</li>
                    <li id="tab3" class="tablist__tab text-center p-3" aria-controls="panel3" aria-selected="false" role="tab" tabindex="0">Fabrica</li>
                </ul>

                <div id="panel1" class="tablist__panel" aria-labelledby="tab1" aria-hidden="false" role="tabpanel">
                <div class="card p-3">
                <h5 class="fs-4 mb-4 mt-2 text-center responsive-font-example">Inventario disponible por punto de venta</h5>
                <hr>
                <form action="../../assets/php/ZPT/ZLO0002P/ordenLogica1.php" method="POST" id="formOrden"  class="mb-3">
                      <div class="row">
                        <div class="col-12 ">
                        <div class="row">
                      <div class="col-12 col-lg-3 mt-2 d-flex  flex-wrap">
                        <label for="cbbOrden2" class="me-3 mt-2" id="lblcbbOrden2">Organizar por: </label>
                        <select name="cbbOrden2" id="cbbOrden2" class="form-select" >
                          <option value="1">Punto de venta</option>
                          <option value="2">Mayor a Menor</option>
                          <option value="3">Menor a Mayor</option>
                        </select>
                      </div>
                      <div class="col-12 col-lg-9 mt-2 d-flex flex-wrap">
                        <label for="filtro1" class=" mt-2" id="">Visualizar por: </label>
                        <select name="filtro1" id="filtro1" class="form-select">
                          <option class="fw-bold" value="1">Honduras (Lov. Ecommerce)</option>
                          <option class="fw-bold" value="2">Honduras (Mod. Íntima)</option>
                          <option class="fw-bold" value="3">Guatemala</option>
                          <option class="fw-bold" value="4">El Salvador</option>
                          <option class="fw-bold" value="5">Costa Rica</option>
                          <option class="fw-bold" value="6">Nicaragua</option>
                          <option class="fw-bold" value="7">Rep. Dominicana</option>
                        </select>
                      </div>
                      <div class="col-12 mt-2">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="1" id="productos" name="productos">
                          <label class="form-check-label" for="productos">
                            Incluir otros productos
                          </label>
                        </div>
                      </div>
                      </div>
                        </div>
                      </div>
                    </form>
                    <div class="graficasPC">
                      <figure class="highcharts-figure" >
                                <div id="container" ></div>
                        </figure>
                    </div>
                  <div class="graficasMovil justify-content-center mt-3 mb-3" style='width:100%;'>
                      <canvas id="miGrafica4"></canvas>
                  </div>
                  <hr class="mt-4 mb-4">
                   
                <table id="myTableInventario" class="table stripe table-hover " style="width:100%">
                  <thead>
                      <tr>
                          <th class="d-none">ID</th>
                          <th >Punto de Venta</th>
                          <th >Total</th>
                      </tr>
                  </thead>
                  <tbody id="myTableInventarioBody">
                  </tbody>
                  </table>
                  </div>
                </div>
                <div id="panel2" class="tablist__panel is-hidden" aria-labelledby="tab2" aria-hidden="true" role="tabpanel">
                <div class="card p-3">
                <h5 class="fs-4 mb-4 mt-2 text-center responsive-font-example">Inventario disponible por país</h5>
                <hr>
                <form action="../../assets/php/ZPT/ZLO0002P/ordenLogica1.php" method="POST" id="formOrden3"  class="mb-3">
                      <div class="row">
                        <div class="col-12 ">
                        <div class="row">
                      <div class="col-12 col-lg-3 mt-2 d-flex  flex-wrap">
                      <label for="cbbOrden3" class="me-3 mt-2" id="lblcbbOrden3">Organizar por: </label>
                        <select name="cbbOrden3" id="cbbOrden3" class="form-select">
                          <option value="1">País</option>
                          <option value="2">Mayor a Menor</option>
                          <option value="3">Menor a Mayor</option>
                        </select>
                      </div>
                      <div class="col-12 col-lg-9 mt-2 d-flex flex-wrap">
                      </div>
                      <div class="col-12 mt-2">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="productos3" name="productos3">
                          <label class="form-check-label" for="productos3">
                            Incluir otros productos
                          </label>
                        </div>
                      </div>
                      </div>
                        </div>
                      </div>
                    </form>
                  <div class="positionRel" style='width:70%'>
                    <div class="graficasPC">
                    <figure class="highcharts-figure" >
                                <div id="container2" ></div>
                        </figure>
                    </div>
                  </div>
                  <div class="graficasMovil justify-content-center mt-3 mb-3" >
                      <canvas id="miGrafica3" ></canvas>
                  </div>
                  <hr class="mt-4 mb-4">
                <table id="myTableInventarioPaises" class="table stripe table-hover " style="width:100%" >
                  <thead>
                      <tr>
                          <th class="d-none">ID</th>
                          <th >Pais</th>
                          <th>Total</th>
                      </tr>
                  </thead>
                  <tbody id="myTableInventarioPaisesBody">
                  </tbody>
                  </table>
                  </div>
                </div>
                <div id="panel3" class="tablist__panel is-hidden" aria-labelledby="tab3" aria-hidden="true" role="tabpanel">
                <div class="card p-3">
                <h5 class="fs-4 mb-4 mt-2 text-center responsive-font-example">Inventario disponible en Fabrica</h5>
                <hr>
                <form action="../../assets/php/ZPT/ZLO0002P/ordenLogica1.php" method="POST" id="formOrden4"  class="mb-3">
                      <div class="row">
                        <div class="col-12 ">
                        <div class="row">
                      <div class="col-12 col-lg-3 mt-2 d-flex  flex-wrap">
                        <label for="cbbOrden4" class="me-3 mt-2" id="lblcbbOrden4">Organizar por: </label>
                        <select name="cbbOrden4" id="cbbOrden4" class="form-select" >
                          <option value="2">Mayor a Menor</option>
                          <option value="3">Menor a Mayor</option>
                        </select>
                      </div>
                      <div class="col-12 col-lg-9 mt-2 d-flex flex-wrap">
                      </div>
                      <div class="col-12 mt-2">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="1" id="productos4" name="productos4">
                          <label class="form-check-label" for="productos4">
                            Incluir otros productos
                          </label>
                        </div>
                      </div>
                      </div>
                        </div>
                      </div>
                    </form>
                  <div class="positionRel" style='width:70%'>
                        <figure class="highcharts-figure" >
                                <div id="container3" ></div>
                        </figure>
                  </div>
                  <hr class="mt-4 mb-4">
                  <table id="myTableInventarioFab" class="table stripe table-hover " style="width:100%" >
                  <thead>
                      <tr>
                          <th class="d-none">ID</th>
                          <th >Fabrica</th>
                          <th>Total</th>
                      </tr>
                  </thead>
                  <tbody id="myTableInventarioFabBody">
                  </tbody>
                  </table>
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
      <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1"></script>
      <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
      <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>
      <script src="https://code.highcharts.com/modules/export-data.js"></script>
      <script src="https://code.highcharts.com/modules/accessibility.js"></script>
      <?php include '../../assets/js/PRG/ZPT/ZLO0002P.php'; ?>

</body>
      
</html>