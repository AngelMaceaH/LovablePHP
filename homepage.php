<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
  <style type='text/css'>
   
    @media (min-width: 1200px) {
    <?php
    $FiltroDiv=(float)(isset($_GET['c'])? $_GET['c']:1);
    if($FiltroDiv==2||$FiltroDiv==3||$FiltroDiv==4||$FiltroDiv==5||$FiltroDiv==6||$FiltroDiv==7)
    {
    echo '#colHonMes3,#colHonMes2 {margin-top:11%; margin-bottom:13%;}';
    }
  ?>
  }
  @media (min-width: 1600px) {
    <?php
    $FiltroDiv=(float)(isset($_GET['c'])? $_GET['c']:1);
    if($FiltroDiv==2||$FiltroDiv==3||$FiltroDiv==4||$FiltroDiv==5||$FiltroDiv==6||$FiltroDiv==7)
    {
    echo '#colHonMes3,#colHonMes2 {margin-top:11%; margin-bottom:15%;}';
    }
  ?>
  }
  
  
</style>
</head>

<body>
<div class="spinner-wrapper">
  <div class="spinner-border text-danger" role="status">
  </div>
</div>
  <?php
      include 'layout.php';
      include 'assets/php/index/phpindex2.php';
    ?>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
              <span>Inicio</span>
        </li>
        <li class="breadcrumb-item active"><span>Pagina Principal</span></li>
      </ol>
    </nav>
  </div>
  </header>
  <div class="body flex-grow-1 px-3">
      <div class="card mb-3">
        <div class="card-body">
          <form id="formGraficas" action="assets/php/index/grafica-filtro.php" method="POST">
            <div class="row mb-2">
              <div class="col-sm-12 col-lg-6 mt-2">
                <label>Fecha:</label>
                <input type="date" class="form-control" name="fechagra" id="fechagra" data-date-format="dd/mm/yyyy"
                  onfocus="(this.type='date')" onkeydown="return false;">
              </div>
              <div class="col-sm-12 col-lg-6 mt-2">
                <label>Vista por:</label>
                <select class="form-select" id="cbbMesgra" name="cbbMesgra">
                      <option class="fw-bold" value="1">Lovable de Honduras</option>
                      <option class="fw-bold" value="2">Tiendas Honduras (Lov. Ecommerce)</option>
                      <option class="fw-bold" value="3">Tiendas Honduras (Mod. Íntima)</option>
                      <option class="fw-bold" value="4">Tiendas Guatemala</option>
                        <option class="fw-bold" value="5">Tiendas El Salvador</option>
                        <option class="fw-bold" value="6">Tiendas Nicaragua</option>
                        <option class="fw-bold" value="7">Tiendas Costa Rica</option>
                        <option class="fw-bold" value="8">Tiendas Republica Dominicana</option>

                        <?php
                      while ($rowCOMARCIndex = odbc_fetch_array($resultCOMARCIndex)) {
                        echo "<option value='" . $rowCOMARCIndex['COMCOD'] . "'>" . rtrim(utf8_encode($rowCOMARCIndex['COMDES'])) . "</option>";
                      }
                      ?>
                        </select>  
                <input type="text" id="fechaCk10" name="fechaCk10" class="d-none"> 
              </div>
            </div>
          </form>
        </div>
        <div class="card-footer"></div>
      </div>
      <div class="card">
          <div class="card-header">

          </div>
          <div class="card-body">
              <h1>Estadísticas de inventario en proceso...</h1>
          </div>
          <div class="card-footer">

          </div>
        </div>

  </div>
  <!--BODY-->
  <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
    <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
  <script>
    console.log("NIVEL USUARIO "+<?php echo $_SESSION['NIVEL']; ?>)
    function obtenerNombreMes(numeroMes) {
              const nombresMes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
              return nombresMes[numeroMes - 1];
            }
            var Mes1 = obtenerNombreMes(<?php echo $mesGraficas1; ?>);
            var Mes2 = obtenerNombreMes(<?php echo $mesGraficas2; ?>);
            var Anio1 = <?php echo $anoGraficas1; ?>;
            var Anio2 = <?php echo $anoGraficas2; ?>;
            var compFiltro = <?php echo $compFiltroP; ?>;

    $(document).ready(function () {
      
      $('#dolaresCk').prop('checked', <?php echo $dolarescheck; ?>);
      $('#fechaCk').prop('checked', <?php echo  $fechacheck ?>);
      $("#cbbMesgra").val(compFiltro);
      $("#tituloGraficasVentas").empty();
      $("#tituloGraficasVentas").append($( "#cbbMesgra option:selected" ).text());
      $("#fechagra").val(formatoFecha("<?php echo $fechaGraficas; ?>"));

    });
    function formatoFecha(fecha) {
      let year = fecha.substring(0, 4);
      let month = fecha.substring(4, 6);
      let day = fecha.substring(6, 8);
      return year + "-" + month + "-" + day;
    }
  </script>
</body>


</html>