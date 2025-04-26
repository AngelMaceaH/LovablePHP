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
  ?>
  <div class="container-fluid">
    <div class="row" style="width:100%;">
      <div class="col-12 col-lg-4">
        <div class="dropdown d-flex justify-content-end mt-2">
          <button id="dropdownButton" class="btn btn-light fw-bold" style="width:100%;" type="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-caret-down"></i>&nbsp;&nbsp;&nbsp;&nbsp;Ocultar/Mostrar
            Columnas
          </button>
          <ul class="dropdown-menu overflow-auto" style="height:400px;" id="hiddenColumns">
          </ul>
        </div>
      </div>
      <div class="col-12 col-lg-3">
        <button class="btn btn-success fw-bold text-white mt-2" style="width:100%;" id="btnExport">
          <i class="fa-solid fa-file-excel"></i>&nbsp;&nbsp;Exportar a excel
        </button>
      </div>
      <div class="col-12 col-lg-2">
        <button class="btn btn-dark fw-bold text-white mt-2" style="width:100%;" id="btnFilter">
          <i class="fa-solid fa-filter"></i> Filtrar
        </button>
      </div>
      <div class="col-12 col-lg-3">
        <div class="input-group mt-2">
          <input type="text" class="form-control fw-bold text-black" id="searchBox"
            oninput="this.value = this.value.toUpperCase();" placeholder="Buscar un estilo...">
          <button class="btn btn-danger text-white fw-bold" type="button" id="btnSearch"><i
              class="fa-solid fa-magnifying-glass"></i> Buscar</button>
        </div>
      </div>
    </div>
  </div>
  </header>
  <div id="body-div" class="flex-grow-1 bg-white">
    <div id="loaderScreen">
      <div class="position-absolute top-50 start-50">
        <i class="fa-solid fa-gear fa-spin text-white" style="font-size:200px;"></i>
      </div>
    </div>
    <div id="menuFilter" class="bg-light p-2 border border-2">
      <div class="row mb-2">
        <div class="col-12 ">
          <input type="text" class="d-none" id="boole" name="boole">
          <div id="isComputer">
            <div class="btn-group flex-wrap d-flex justify-content-center justify-content-lg-start" role="group"
              aria-label="Basic radio toggle button group">
              <input type="radio" class="btn-check btnMar " name="btncols" value="100" id="btn100" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  text-black menuMarca  d-flex flex-column align-items-center justify-content-center"
                for="btn100">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/100.GIF" alt="">
                  <p class="fs-10 mt-2">BOUTIQUE</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="200" id="btn200" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example   text-black menuMarca d-flex flex-column align-items-center justify-content-center"
                for="btn200">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/200.GIF" alt="">
                  <p class="fs-10 mt-2">LOVABLE</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="210" id="btn210" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn210">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/210.GIF" alt="">
                  <p class="fs-10 mt-2">LOVABLE SOCK</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="240" id="btn240" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn240">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/240.png" alt=""
                    style="height: 50px; margin-top:10px;">
                  <p class="fs-10 mt-2">LOVABLE MATERNAL</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="250" id="btn250" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn250">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/250.JPG" alt=""
                    style="height: 50px; margin-top:10px;">
                  <p class="fs-10 mt-2">LOVABLE BODY</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="450" id="btn450" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn450">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/450.GIF" alt="">
                  <p class="fs-10 mt-2">SPLASH</p>
                </b>
              </label>
              <input type="radio" class="btn-check btnMar " name="btncols" value="460" id="btn460" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn460">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 " src="../../assets/img/icons/460.png" alt="">
                  <p class="fs-10 mt-2">LOVABLE SWIMWEAR</p>
                </b>
              </label>
              <input type="radio" class="btn-check btnMar " name="btncols" value="470" id="btn470" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn470">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 " src="../../assets/img/icons/460.png" alt="">
                  <p class="fs-10 mt-2">LOVABLE SWIMWEAR BL</p>
                </b>
              </label>
              <input type="radio" class="btn-check btnMar " name="btncols" value="480" id="btn480" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn480">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/480.png" alt="">
                  <p class="fs-10 mt-2">LOVABLE KIDS SPKASH</p>
                </b>
              </label>
              <input type="radio" class="btn-check btnMar " name="btncols" value="500" id="btn500" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn500">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/500.GIF" alt="">
                  <p class="fs-10 mt-2">FEMINA</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="550" id="btn550" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn550">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/550.GIF" alt=""
                    style="height: 50px; margin-top:10px;">
                  <p class="fs-10 mt-2">LOVABLE TEENS</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="600" id="btn600" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn600">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/600.GIF" alt="">
                  <p class="fs-10 mt-2">LOVABLE KIDS</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="650" id="btn650" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn650">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/650.GIF" alt="">
                  <p class="fs-10 mt-2">DOLCE AMORE</p>
                </b>
              </label>
            </div>
            <div class="btn-group flex-wrap d-flex justify-content-center justify-content-lg-start" role="group"
              aria-label="Basic radio toggle button group">
              <input type="radio" class="btn-check btnMar " name="btncols" value="700" id="btn700" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn700">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/700.GIF" alt="">
                  <p class="fs-10 mt-2">LE GEMME</p>
                </b>
              </label>
              <input type="radio" class="btn-check btnMar " name="btncols" value="800" id="btn800" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn800">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/800.GIF" alt="">
                  <p class="fs-10 mt-2">SEDUCCION</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="900" id="btn900" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn900">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/900.GIF" alt="">
                  <p class="fs-10 mt-2">FRENCH CURVES</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="360" id="btn360" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn360">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/360.GIF" alt=""
                    style="height: 50px; margin-top:10px;">
                  <p class="fs-10 mt-2">ENCANTOS</p>
                </b>
              </label>
              <input type="radio" class="btn-check btnMar " name="btncols" value="920" id="btn920" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn920">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/920.png" alt=""
                    style="height: 50px; margin-top:10px;">
                  <p class="fs-10 mt-2">LOVABLE BODY CARE</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="930" id="btn930" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn930">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/930.GIF" alt="">
                  <p class="fs-10 mt-2">ANDROS KIDS</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="940" id="btn940" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn940">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/940.GIF" alt="">
                  <p class="fs-10 mt-2">ANDROS JR</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="950" id="btn950" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn950">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/950.GIF" alt="">
                  <p class="fs-10 mt-2">ANDROS</p>
                </b>
              </label>
              <input type="radio" class="btn-check btnMar " name="btncols" value="910" id="btn910" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn910">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1" src="../../assets/img/icons/910.png" alt="">
                  <p class="fs-10 mt-2">ANDROS SWIMWEAR</p>
                </b>
              </label>
              <input type="radio" class="btn-check btnMar " name="btncols" value="990" id="btn990" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn990">
                <b class="d-flex flex-column align-items-center justify-content-center">

                  <p class="fs-10 mt-2">ANDROS KIDS SWIMWEAR</p>
                </b>
              </label>
              <input type="radio" class="btn-check btnMar " name="btncols" value="230" id="btn230" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center  text-black menuMarca"
                for="btn230">
                <b class="d-flex flex-column align-items-center justify-content-center">
                  <img class="img-fluid round1 imgButtons" src="../../assets/img/icons/230.GIF" alt="">
                  <p class="fs-10 mt-2">LOVABLE SPORT</p>
                </b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="res" id="btnres" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center text-black menuMarca"
                style="padding-top: 10px;" for="btnres">
                <b class="fs-10">OTRAS MARCAS</b>
              </label>

              <input type="radio" class="btn-check btnMar " name="btncols" value="all" id="btnall" autocomplete="off">
              <label
                class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center text-black menuMarca"
                style="padding-top: 10px;" for="btnall">
                <b class="fs-10">TODAS LAS MARCAS</b>
              </label>
              <input type="radio" class="btn-check btnMar " name="btncols" value="all" id="btnall" autocomplete="off"
                disabled>
              <!--
                    <label
                              class="btn btn-outline-secondary responsive-font-example  d-flex flex-column align-items-center justify-content-center text-black menuMarca"
                              style="padding-top: 10px;" for="btnall">
                              <b class="fs-10"> &nbsp; &nbsp;</b>
                            </label>
              -->
            </div>
          </div>
          <div id="isPhone">
            <div class="row">
              <div class="col-12">
                <label class="mb-2">Marcas:</label>
                <select class="form-select  mt-1 mb-3 mb-lg-0" id="cbbMarca" name="cbbMarca">
                  <option value="100">BOUTIQUE </option>
                  <option value="200">LOVABLE </option>
                  <option value="210">LOVABLE SOCK </option>
                  <option value="240">LOVABLE MATERNAL</option>
                  <option value="250">LOVABLE BODY </option>
                  <option value="450">SPLASH </option>
                  <option value="460">LOVABLE SWIMWEAR </option>
                  <option value="470">LOVABLE SWIMWEAR BL </option>
                  <option value="480">LOVABLE KIDS SWINWEAR </option>
                  <option value="500">FEMINA </option>
                  <option value="550">LOVABLE TEENS </option>
                  <option value="600">LOVABLE KIDS </option>
                  <option value="650">DOLCE AMORE </option>
                  <option value="700">LE GEMME </option>
                  <option value="800">SEDUCCION </option>
                  <option value="900">FRENCH CURVES </option>
                  <option value="360">ENCANTOS </option>
                  <option value="920">LOVABLE BODY CARE</option>
                  <option value="930">ANDROSKID </option>
                  <option value="940">ANDROSJR </option>
                  <option value="950">ANDROS </option>
                  <option value="910">ANDROS SWIMWEAR</option>
                  <option value="990">ANDROS KIDS SWIMWEAR</option>
                  <option value="230">LOVABLE SPORT </option>
                  <option value="res">OTRAS MARCAS</option>
                  <option value="all">TODAS LAS MARCAS</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-4 ">
          <label class="mb-2 mt-2">Formato de reportes:</label>
          <div class='selectBox mt-1 mb-3 mb-lg-0'>
            <span class='selected d-flex justify-content-between'></span>
            <div class="selectOptions">
              <span class="selectOption d-flex justify-content-between" value="0">Todos</span>
              <span class="selectOption d-flex justify-content-between" value="10" data-bs-toggle="tooltip"
                data-bs-placement="right"
                data-bs-title="NO CONTIENE: &#13;&#10;-Marcas: 450,960,970,995&#13;&#10;-Totales por estilo&#13;&#10;-Estilos fuera de programa&#13;&#10;-Estilos nuevos en programa&#13;&#10;-MESES PRG 12M Solamente desde 0 hasta 12 meses">Análisis
                de compras </span>
              <span class="selectOption d-flex justify-content-between" value="20" data-bs-toggle="tooltip"
                data-bs-placement="right"
                data-bs-title="CONTIENE: Total docenas x estilo -Nuevos meses de inventario -Importados -Cantidad a mover a Materia Prima NO CONTIENE: &#13;&#10;-Marcas: 450,960,970,995&#13;&#10;-Totales por estilo&#13;&#10;-Estilos fuera de programa&#13;&#10;-Estilos nuevos en programa&#13;&#10;-Estilos en 0.00 Materia Prima">Análisis
                de inventario </span>
            </div>
            <input type="text" class="d-none" id="cbbFormato" name="cbbFormato" value="0">
          </div>
        </div>
        <div class="col-12 col-lg-4 ">
          <label class="mb-2 mt-2">Planeación Agregada:</label>
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
              <label class="mb-2 mt-2">Análisis estadístico</label>
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
                <option value="10">Programa 1</option>
                <option value="11">Programa 2</option>
                <option value="12">Programa Total</option>
                <option value="13">Meses Inv.</option>
                <option value="14">Meses Inv. Antes MTP</option>
                <option value="15">Doc. Vend. Año/Ant</option>
                <option value="16">Valor Vendido Año/Ant</option>
                <option value="17">Prom x Mes Año/Ant</option>
              </select>
            </div>
            <div class="col-3">
              <div class="row">
                <div class="col-12">
                  <input type="radio" class="btn-check" name="btnOrderValue" value="1" id="btnOrder1"
                    autocomplete="off">
                  <label class="btn btn-danger mt-2" id="lblOrder1" for="btnOrder1" style="width:100%;"
                    data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Ascendente">
                    <i class="fa-solid fa-up-long text-white f-2"></i>
                  </label>
                </div>
                <div class="col-12">
                  <input type="radio" class="btn-check" name="btnOrderValue" value="2" id="btnOrder2"
                    autocomplete="off">
                  <label class="btn btn-danger mt-2" id="lblOrder2" for="btnOrder2" style="width:100%;"
                    data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Descendente">
                    <i class="fa-solid fa-down-long text-white f-2"></i>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-3 mt-2">
          <label class="mb-3">Tipos de Inventario</label>
          <div class="form-control">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="rbInventarios" value="1" id="rbInv1">
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
        <div class="col-12 col-lg-2 mt-2">
          <label class="mb-3">Clasificación</label>
          <div class="form-control">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="rbClasificacion" value="1" id="rbCla1">
              <label class="form-check-label" for="rbCla1">
                Local
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="rbClasificacion" value="2" id="rbCla2">
              <label class="form-check-label" for="rbCla2">
                Importado
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="rbClasificacion" value="3" id="rbCla3">
              <label class="form-check-label" for="rbCla3">
                Todo
              </label>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-2 mt-2">
          <label class="mb-3">Ordenar por</label>
          <div class="form-control">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="rbOrden" value="1" id="rbOrd1">
              <label class="form-check-label" for="rbOrd1">
                Estilo y color
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="rbOrden" value="2" id="rbOrd2">
              <label class="form-check-label" for="rbOrd2">
                Talla
              </label>
            </div><br>
          </div>
        </div>
        <div class="col-12 col-lg-3 mt-2">
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
              <input class="form-check-input" type="radio" name="rbFiltro" value="3" id="rbFil3">
              <label class="form-check-label" for="rbFil3">
                Todo
              </label>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-2 mt-2">
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
              <input class="form-check-input" type="radio" name="rbRepro" value="3" id="rbRep3">
              <label class="form-check-label" for="rbRep3">
                Todo
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="table-frame">
      <table class="table table-sm " id="myTablePlaneacion">
        <thead>
          <tr>
            <th colspan="5" style="text-align: end;"><span>INDICACIONES:</span></th>
            <th colspan="4" style="text-align: start;"><span>1. Presione doble clic sobre la fila para ver sus
                Ventas</span></th>
            <th colspan="4" style="text-align: start;"><span>2. Presione clic sobre el estilo para ser sus
                imágenes</span></th>
          </tr>
          <tr class="sticky-top bg-white">
            <th>N.</th>
            <th>MARCA</th>
            <th>ESTILO</th>
            <th>COLOR</th>
            <th>TALLA</th>
            <th>T/INV</th>
            <th>DOC. VEN. <br>AÑO/ACT</th>
            <th>VAL. VEN. <br>AÑO/ACT</th>
            <th>PROM. MES</th>
            <th># <br>MESES</th>
            <th>UND VTAS. <br>MES/ANT</th>
            <th>PERDIDA. <br>VTAS</th>
            <th>PROM. <br>PERDIDA VTAS</th>
            <th>APARTADO <br>VENDEDOR</th>
            <th>APARTADO <br>VENTA X CATALOGO</th>
            <th>INVENTARIO <br>DISPONBLE</th>
            <th>INVENTARIO <br>PROCESO</th>
            <th>INVENTARIO <br>CORTADO</th>
            <th>CORTE</th>
            <th>MESES INV ANTES MTP</th>
            <th>INV. MTP</th>
            <th>MESES INV</th>
            <th>PROGRAMA 1</th>
            <th>PROGRAMA 2</th>
            <th>PROGRAMA TOTAL</th>
            <th>LEAD TIME</th>
            <th>MESES <br>PRG 12M</th>
            <th>PROM.MEN. <br>12M</th>
            <th># <br>MESES 12M</th>
            <th>MESES <br>INV. 6M</th>
            <th>PROM. <br>MEN. 6M</th>
            <th># <br>MESES 6M</th>
            <th>PROM X MES <br>AÑO/ANT</th>
            <th># <br>MESES AÑO/ANT</th>
            <th>DOC. VEND. <br>AÑO/ANT.</th>
            <th>VALOR VENDIDO <br>AÑO/ANT</th>
            <th>IMPORTADO</th>
            <th>DOC. <br>TOTALES</th>
            <th>NUEVO INV.</th>
            <th>NUEVO <br>BALANCE</th>
            <th>MAT. PRIMA <br>EN ALMACEN</th>
          </tr>
        </thead>
        <tbody id="tableBody">

        </tbody>
      </table>
    </div>
    <div class="bg-white" style="width:99%;" id="divTableInfo">
      <div class="row">
        <div class="col-4">
          <div id="divRows" class="ms-3 mt-1">

          </div>
        </div>
        <div class="col-4">

        </div>
        <div class="col-4">
          <div id="divPagination" class="me-3 mt-1">

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                  <label for="" class="form-control mb-3 mb-lg-0 mt-lg-5">Estilo: <span id="lblEstilo"></span></label>
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
                    <table id="tableResumen" class="table stripe table-secondary table-hover " style="width:100%">
                      <thead>
                        <tr>
                          <th class='text-end'>
                            Año
                          </th>
                          <th class='text-end'>
                            Docenas ingresadas
                          </th>
                          <th class='text-end'>
                            Docenas Vendidas
                          </th>
                          <th class='text-end'>
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

  <div class="modal fade" id="photosModal" tabindex="-1" aria-labelledby="photosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="photosModalLabel"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div id="carouselExampleIndicators" class="carousel carousel-dark slide w-100">
                <div class="carousel-inner" id="carouselInnerPhotos"></div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                  data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                  data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
            <div class="col-12">
              <div class="carousel-images w-100 d-flex justify-content-center py-3" id="carouselInnerPhotosButtons">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="cantidadesModal" tabindex="-1" aria-labelledby="cantidadesModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 3000px !important;">
      <div class="modal-content" style="width:100%px;">
        <div class="modal-header">
          <div class="row">
            <div class="col-12">
              <h1 class="modal-title fs-5" id="cantidadesModalLabel">Detalle de cantidades apartadas</h1>
            </div>
            <div class="col-12">
              <div class="row">
                <div class="col-12 py-2">
                  <th class="text-start">Marca: </th>
                  <th class="text-start"><span id="spnMarca"></span></th>
                  <th class="text-start">Estilo: </th>
                  <th class="text-start"><span id="spnEstilo"></span></th>
                </div>
                <div class="col-12 py-2">
                  <th class="text-start">Color: </th>
                  <th class="text-start"><span id="spnColor"></span></th>
                  <th class="text-start">Talla: </th>
                  <th class="text-start"><span id="spnTalla"></span></th>
                </div>
              </div>
            </div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-12 fw-bold text-center py-3 table-responsive">
            <table class="table table-hover border fs-6">
              <thead>
                <tr>
                  <th style="width:6.5%;" class="text-center">Num. Preventa</th>
                  <th style="width:6.5%;" class="text-end">Docenas apartadas</th>
                  <th style="width:24.5%;" class="text-start">Vendedor</th>
                  <th style="width:24.5%;" class="text-start">Cliente</th>
                  <th style="width:8.5%;" class="text-start">Fecha Preventa</th>
                  <th style="width:8.5%;" class="text-end">Días transcurridos</th>
                  <th style="width:3.5%;" class="text-end">Moneda</th>
                  <th style="width:9.5%;" class="text-end">Valor neto</th>

                </tr>
              </thead>
              <tbody id="tableCantidadesBody">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../assets/js/PRG/ZAI/ZLO0013PA.js?v=1"></script>
</body>

</html>