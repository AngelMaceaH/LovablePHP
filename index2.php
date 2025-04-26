<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="assets/css/flexselect.css">
    <title>Lovable de Honduras</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <?php include 'layout.php'; ?>
    </header>
    <main>
        <section>
            <article>
                <div class="container-fluid">
                    <div class="row d-flex justify-content-end px-3">
                        <div class="row d-flex flex-wrap">
                            <div class="col-12 col-xl-6 order-last order-xl-first d-flex align-items-end">
                                <div class="form-check form-switch">
                                    <input class="form-check-input fs-5" type="checkbox" role="switch" id="dolaresCk"
                                        name="dolaresChk">
                                    <h6 class="form-check-label fw-bold mt-1" for="dolaresCk">Valores en dólares</h6>
                                </div>
                            </div>

                            <div class="col-6 col-xl-3 p-0">
                                <label>Vista por:</label>
                                <select class="form-control" id="cbbAgrup">
                                    <option value="1">Lovable de Honduras</option>
                                    <option value="11">Tiendas Honduras (Lov. Ecommerce)</option>
                                    <option value="9">Tiendas Honduras (Mod. Íntima)</option>
                                    <option value="10">Tiendas Guatemala</option>
                                    <option value="12">Tiendas El Salvador</option>
                                    <option value="13">Tiendas Costa Rica</option>
                                    <option value="16">Tiendas Nicaragua</option>
                                    <option value="15">Tiendas Republica Dominicana</option>
                                </select>
                                <input type="text" id="fechaCk10" name="fechaCk10" class="d-none">
                            </div>

                            <div class="col-6 col-xl-3">
                                <label>Fecha:</label>
                                <input type="date" class="form-control" name="fechagra" id="fechagra"
                                    data-date-format="dd/mm/yyyy" onfocus="(this.type='date')"
                                    onkeydown="return false;">
                            </div>
                        </div>

                    </div>
                </div>
            </article>
        </section>
        <section>
            <article>
                <div class="body flex-grow-1 px-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6">
                                <div class="card my-2">
                                    <div class="card-body">
                                        <h6>
                                            Ventas del día
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card my-2">
                                    <div class="card-body">
                                        <h6>
                                            Ventas del mes
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
        <section>
            <article>
                <div class="body flex-grow-1 px-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="card my-2">
                                    <div class="card-body">
                                        <h6>
                                            Comparativo Mes anterior
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card my-2">
                                    <div class="card-body">
                                        <h6>
                                            Comparativo Mismo mes del año anterior
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card my-2">
                                    <div class="card-body">
                                        <h6>
                                            Comparativo Año anterior
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
        <section>
            <article>
                <div class="body flex-grow-1 px-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card my-2">
                                    <div class="card-body">
                                        <h6>
                                            Histórico de ventas por año
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
        <section>
            <article>
                <div class="body flex-grow-1 px-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="card my-2">
                                    <div class="card-body">
                                        <h6>

                                        </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card my-2">
                                    <div class="card-body">
                                        <h6>
                                            Estilos más vendidos
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
        <section>
            <article>
                <div class="body flex-grow-1 px-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card my-2">
                                    <div class="card-body">
                                        <h6>
                                            Promedios por transacciones
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        /*unidades,
transacciones,
clientes dia*/
        window.addEventListener('DOMContentLoaded', (event) => {
            const cbbAgrup = document.getElementById('cbbAgrup');
            let usuario = '<?php echo $_SESSION["CODUSU"]; ?>';
            let urlTiendas = '/API.LovablePHP/Users/FindAgrupT/?codusu=' + usuario + '';
            let responseTiendas = ajaxRequest(urlTiendas);
            let tiendasOptions = '';
            if (responseTiendas.code == 200) {
                for (let i = 0; i < responseTiendas.data.length; i++) {
                    if (responseTiendas.data[i].COMCOD != 1) {
                        tiendasOptions += '<option value="' + responseTiendas.data[i].COMCOD.padStart(2, '0') +
                            '">' +
                            responseTiendas.data[
                                i].COMDES + '</option>';
                    }
                }
            }
            $("#cbbAgrup").append(tiendasOptions);
            $('#cbbAgrup').select2({
                placeholder: "Busca una opción...",
                allowClear: true
            });
        });
    </script>
</body>

</html>