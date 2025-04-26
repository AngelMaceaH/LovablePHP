<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>

<body>
    <?php
    include '../layout-prg.php';
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span> Consumo / Cierre de mes </span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0049P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Cierre de mes</h1>
            </div>
            <div class="card-body">
                <div class="container p-5">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-12 col-lg-4 d-flex flex-column flex-lg-row justify-content-center gap-3">
                            <div class="text-center">
                                <label for="ano">Año proceso actual</label>
                                <input type="text" class="form-control mt-2" id="ano" disabled>
                            </div>
                            <div class="text-center">
                                <label for="mes">Mes proceso actual</label>
                                <input type="text" class="form-control mt-2" id="mes" disabled>
                            </div>
                        </div>
                        <div class="col-4"></div>

                        <div class="col-4"></div>
                        <div class="col-12 col-lg-4 text-center">
                            <label for="" class="mt-5">Año de proceso</label>
                            <select id="cbbAno" class="form-select my-2 ">
                                <option value="" disabled selected>Selecciona un año</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4"></div>
                        <div class="col-12 col-lg-4 text-center mt-5">
                            <label for="">Mes de proceso</label>
                            <select class="form-select my-2" id="cbbMes">
                                <option value="" disabled selected>Selecciona un mes</option>
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4">Abril</option>
                                <option value="5">Mayo</option>
                                <option value="6">Junio</option>
                                <option value="7">Julio</option>
                                <option value="8">Agosto</option>
                                <option value="9">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4">
                        </div>
                        <div class="col-12 col-lg-4">
                            <button id="btnSave" class="btn btn-primary w-100 mt-5 fw-bold text-white">
                                <i class="fa-solid fa-floppy-disk me-2"></i>
                                <span>Guardar</span></button>
                        </div>
                        <div class="col-4">

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
    <div class="footer bg-blck flex-grow-1 d-flex justify-content-center">
        <p class="bggray responsive-font-example"><i>Lovable de Honduras S.A. de C.V</i></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $(document).ready(function () {
            fetch('/API.LovablePHP/ZLO0050P/FechaProceso')
                .then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        $("#ano").val(data.data[0].ANOPRO);
                        $("#mes").val(meses[parseInt(data.data[0].MESPRO) - 1]);
                    }
                });
            $('#btnSave').on('click', () => {
                const ano = $('#cbbAno').val();
                const mes = $('#cbbMes').val();
                if (ano != '' && mes != '') {
                    console.log(ano + ' ' + mes);
                }
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esto ejecutará el cierre del mes",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('/API.LovablePHP/ZLO0049P/Cierre', {
                            method: 'POST',
                            body: JSON.stringify({
                                ano: ano,
                                mes: mes
                            })
                        }).then(response => response.json()).then(data => {
                            if (data.code == 200) {
                                Swal.fire(
                                    'Ejecución exitosa',
                                    'El mes ha sido cerrado.',
                                    'success'
                                )
                                $("#cbbAno").val('');
                                $("#cbbMes").val('');
                            } else {
                                Swal.fire(
                                    'Error',
                                    'Ya existen datos para el mes seleccionado.',
                                    'error'
                                )
                            }

                        })
                    }
                })
            })
        });
    </script>
</body>

</html>