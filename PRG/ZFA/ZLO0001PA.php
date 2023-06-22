<!DOCTYPE html>
<html lang="es">
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
      $_SESSION['FechaFiltro2'] = $_GET['dat'];
        $fecha=$_SESSION['FechaFiltro2'];
        $_SESSION['comppro2']=$_GET['id'];
            $anio =0;
            $mes =0;
            $dia =0;
        if ($fecha!="") {
            $anio = substr($fecha, 0, 4);
            $mes = substr($fecha, 4, 2);
            $dia = substr($fecha, 6, 2);
        }
        $fechaFiltro = implode("", array($dia, $mes, $anio));
        if ($_GET['dat']!="19700101" && $_GET['dat']!="") {
            $_SESSION['mesanterior']=$mes;
            $_SESSION['anioanterior']=$anio;
        }
        if($_GET['dat']=="19700101"){
            echo "<script>window.location = '/".$_SESSION['DEV']."LovablePHP/PRG/ZFA/ZLO0001PA.php?id=".$_SESSION['comppro2']."&dat='</script>";
        }
        $ckProductos1 = isset($_SESSION['productosCk1']) ? $_SESSION['productosCk1'] : "0";
        $ckProductos2 = isset($_SESSION['productosCk2']) ? $_SESSION['productosCk2'] : "0";
      $fechafiltro = isset($_SESSION['FechaFiltro2']) ? $_SESSION['FechaFiltro2'] : "";
      $compfiltro = isset($_SESSION['comppro2']) && !empty($_SESSION['comppro2']) ? $_SESSION['comppro2'] : 0;
      $mesficha= ($mes!=0)? $mes : $_SESSION['mesanterior'];
      $anioficha= ($anio!=0)? $anio : $_SESSION['anioanterior'];
?>
    <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
              <span>Modulo de facturación</span>
              </li>
              <li class="breadcrumb-item active"><span>ZLO0001PA</span></li>
            </ol>
          </nav>

    </header>
    <div id="body-div" class="body flex-grow-1">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="demo">
                <ul class="tablist" role="tablist">
                    <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1" aria-selected="true" role="tab" tabindex="0">Detalle por factura</li>
                    <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false" role="tab" tabindex="0">Resumen por días</li>
                </ul>

                <div id="panel1" class="tablist__panel" aria-labelledby="tab1" aria-hidden="false" role="tabpanel">
                   <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-9 col-lg-10 col-xl-10 col-xxl-11 col-8 " >
                            <h2 class="fs-4 mb-1 mt-4 text-center">Detalle de ventas por <b>factura</b>.</h2>
                        </div>
                        <div class="col-1 ">
                        <a class='btn btn-light mt-2' href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/PRG/ZFA/ZLO0001P.php"><b>Regresar</b></a>
                        </div>
                    </div>
                        
                        <form id="formFiltros" action="../../assets/php/ZFA/ZLO0001P/logic2.php" method="POST">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-lg-6 mt-2">
                                <label>Compañía:</label>
                                <select class="form-select" id="comppro1" name="comppro1" >
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mt-2 mb-3">
                            <label>Fecha:</label>
                            <input type="date" class="form-control" name="fechapro" id="fechapro" data-date-format="dd/mm/yyyy" onfocus="(this.type='date')" onkeydown="return false;">
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-2">
                                <div class="input-group">
                                <input class="me-2" type="checkbox" value="1" id="productosCk1" name="productosCk1">
                                 <label for="productosCk1"><b>Incluir otros productos</b></label>
                                </div>
                             </div>
                            
                        </div>
                        </form>
                        <hr> 
                        
                        <div class="table-responsive">
                        <label class="m-4 fw-bold">**Presione doble clic sobre la factura para ver detalles de la factura**</label>
                        <table id="myTable2" class="table stripe table-hover mt-4" style="width:100%" >
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Día</th>
                                <th class="text-center">Factura</th>
                                <th class="text-end">Descuento</th>
                                <th class="text-end">Valor total</th>
                                <th class="text-end">Impuesto</th>
                                <th class="text-end">Neto</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        </table>
                        </div>
                        
                    </div>
                </div>
                <div id="panel2" class="tablist__panel is-hidden" aria-labelledby="tab2" aria-hidden="true" role="tabpanel">
                   <div class="container-fluid">
                   <div class="row">
                        <div class="col-md-9 col-lg-10 col-xl-10 col-xxl-11 col-8 " >
                        <h2 class="fs-4 mb-1 mt-4 text-center">Resumen de ventas por <b>días</b>.</h2>
                        </div>
                        <div class="col-1 ">
                        <a class='btn btn-light mt-2' href="/<?php echo $_SESSION['DEV'] ?>LovablePHP/PRG/ZFA/ZLO0001P.php"><b>Regresar</b></a>
                        </div>
                    </div>
                       
                        <form id="formFiltros2" action="../../assets/php/ZFA/ZLO0001P/logic3.php" method="POST">
                        <div class="row mb-2">
                            <div class="col-sm-12 col-lg-6 mt-2">
                                <label>Compañía:</label>
                                <select class="form-select" id="comppro2" name="comppro2" >
                               
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-6 mt-2 mb-3">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6" >
                                    <label>Mes:</label>
                                    <select class="form-select" id="cbbMes" name="cbbMes">
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
                                    <div class="col-sm-12 col-lg-6">
                                    <label>Año:</label>
                                        <select class="form-select" id="cbbAno" name="cbbAno">
                                        <?php
                                            $anio_actual = date('Y');
                                            for ($i = $anio_actual; $i >= 1990; $i--) {
                                            echo "<option value='$i'>$i</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                    </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 mb-2">
                                <div class="input-group">
                                <input class="me-2" type="checkbox" value="1" id="productosCk2" name="productosCk2">
                                 <label for="productosCk2"><b>Incluir otros productos</b></label>
                                </div>
                             </div>
                        </div>
                        </form>
                        <hr> 
                        <div class="table-responsive">
                        <table id="myTable3" class="table stripe table-hover mt-4" style="width:100%" >
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center"></th>
                                <th class="text-start">Día</th>
                                <th class="text-center">Tra</th>
                                <th class="text-end">Descuento</th>
                                <th class="text-end">Valor total</th>
                                <th class="text-end">Impuesto</th>
                                <th class="text-end">Neto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               
                               ?> 
                        </tbody>
                        </table>
                        </div>
                        



                   </div>
                </div>
 
                </div>
            </div>
            <div class="card-footer">
          
            </div>
        </div>
    </div>
    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
      <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
    </div>
    <?php include '../../assets/js/PRG/ZFA/ZLO0001PA.php'; ?>
</body>

</html>