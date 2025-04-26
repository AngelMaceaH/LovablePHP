<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/flexselect.css">
</head>

<body>
    <?php include '../layout-prg.php'; ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Autenticador / Cambio fecha de corte</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0051P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center"></h1>
            </div>
            <div class="card-body table-responsive">
                <button onclick="showModalToken()" class="btn btn-warning fw-bold text-white"
                    style="width: 150px;">Nuevo <i class="fa-solid fa-plus"></i></button>
                <table id="tableList" class="table table-striped w-100">
                    <thead>
                        <tr>
                            <th>Punto de venta</th>
                            <th>Usuario Solicitud</th>
                            <th>Asunto</th>
                            <th>Fecha Corte</th>
                            <th>Código</th>
                            <th>Usuario Grabación</th>
                            <th>Fecha y hora</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>

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
    <div class="modal fade" id="tokenModal" tabindex="-1" aria-labelledby="tokenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tokenModalLabel">Generar un nuevo código</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-lg-7">
                            <label for="" class="py-2">Punto de venta</label>
                            <select id="cbbCia" class="form-select">
                                <option value="" disabled selected>Selecciona un punto de venta</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-5">
                            <label for="" class="py-2">Usuario solicitó</label>
                            <div id="selectUsua">
                                <select class="form-select" id="txtUsuaSol">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="w-100 d-flex justify-content-between py-2 mt-2">
                                <div>
                                    <label for="descrp">Asunto</label>
                                </div>
                                <div>
                                    <span>(<span id="spnDescrp">300</span>) caracteres restantes.</span>
                                </div>
                            </div>

                            <textarea id="txtAsunto" placeholder="Ingrese la descripcion" class="form-control mt-2"
                                maxlength="300"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="" class="mt-3">Fecha de corte</label>
                            <input type="date" class="form-control my-3" id="txtfecha">
                        </div>
                        <div class="col-12">
                            <label class="text-danger fw-bold fs-6 py-3" id="txtAlert"></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary fw-bold text-white" id="btnSave">Generar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <script src="../../assets/js/jquery.flexselect.js"></script>
    <script src="../../assets/js/liquidmetal.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let tableList;
        const selectUsua = document.getElementById('selectUsua');
        document.addEventListener('DOMContentLoaded', () => {
            $("#txtAsunto").on('input', function () {
                var maxLength = 300;
                var length = $(this).val().length;
                var length = maxLength - length;
                $('#spnDescrp').text(length);
            });
            fetch('/API.LovablePHP/ZLO0051P/Tiendas')
                .then(response => response.json())
                .then(data => {
                    const cbbCia = document.getElementById('cbbCia');
                    if (data.code == 200) {
                        data.data.forEach(element => {
                            const option = document.createElement('option');
                            option.value = element.CODCIA;
                            option.text = element.NOMCIA;
                            cbbCia.appendChild(option);
                        });
                    }
                })
            tableList = $('#tableList').DataTable({
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 15,
                "processing": true,
                "serverSide": true,
                "ordering": false,
                "ajax": {
                    "url": "/API.LovablePHP/ZLO0051P/List",
                    "type": "POST",
                    "contentType": "application/json",
                    "data": function (d) {
                        return JSON.stringify({
                            "draw": d.draw,
                            "start": d.start,
                            "length": d.length,
                            "search": d.search.value,
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                        requestError = true;
                    }
                },
                "ordering": false,
                "dom": 'frtip',
                "autoWidth": false,
                "columnDefs": [
                    { "width": "15%", "targets": 0, "orderable": false, "class": "align-middle" },
                    { "width": "10%", "targets": 1, "orderable": false, "class": "align-middle" },
                    { "width": "35%", "targets": 2, "orderable": false, "class": "align-middle" },
                    { "width": "10%", "targets": 3, "orderable": false, "class": "align-middle" },
                    { "width": "7.5%", "targets": 4, "orderable": false, "class": "align-middle" },
                    { "width": "7.5%", "targets": 5, "orderable": false, "class": "align-middle" },
                    { "width": "15%", "targets": 6, "orderable": false, "class": "align-middle" },
                    { "width": "5%", "targets": 7, "orderable": false, "class": "align-middle" },
                ],
                "columns": [
                    {
                        "data": "NOMCIA",
                    },
                    {
                        "data": "USUAPL",
                    },
                    {
                        "data": "ASUNTO",
                    },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return formatFecha2(data.FECCOR);
                        }
                    },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return data.CODIGO
                        }
                    },
                    {
                        "data": "USUGRA"
                    },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            return formatFecha(data.FECGRA, data.HORGRA);
                        }
                    },
                    {
                        "data": null,
                        "render": function (data, type, row) {
                            switch (data.ESTADO) {
                                case 'A':
                                    return '<span class="badge bg-success fs-6 fw-light"><i>Activo</i></span>';
                                    break;
                                case 'U':
                                    return '<span class="badge bg-warning fs-6 text-black fw-light"><i>Usado</i></span>';
                                    break;
                                default:
                                    return '<span class="badge bg-light fs-6 text-black fw-light"><i>Inactivo</i></span>';
                                    break;
                            }
                        }
                    }
                ]
            });
            $("#cbbCia").on('change', () => {
                selectUsua.innerHTML = '';
                fetch('/API.LovablePHP/ZLO0051P/ListUsuarios', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        codcia: $("#cbbCia").val()
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        const select = document.createElement('select');
                        select.className = 'form-select';
                        select.id = 'txtUsuaSol';
                        const option = document.createElement('option');
                        option.value = '';
                        option.text = '';
                        select.appendChild(option);
                        if (data.code == 200) {
                            data.data.forEach(element => {
                                const option = document.createElement('option');
                                option.value = element.CODUSU;
                                option.text = element.CODUSU;
                                select.appendChild(option);
                            });
                        }
                        selectUsua.appendChild(select);
                        $("#txtUsuaSol").flexselect();
                    })

            })
            $("#btnSave").on('click', () => {
                const cia = $("#cbbCia").val();
                const usuaSol = $("#txtUsuaSol").val();
                const asunto = $("#txtAsunto").val();
                const usuario = "<?php echo isset($_SESSION['CODUSU']) ? $_SESSION['CODUSU'] : ''; ?>";
                const fecha = $("#txtfecha").val().replaceAll("-", "");
                $("#txtAlert").text("");
                if (cia == null || usuaSol == "" || asunto == "" || fecha == "") {
                    $("#txtAlert").text("Todos los campos son requeridos.");
                }
                fetch('/API.LovablePHP/ZLO0051P/Codigo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        codcia: cia,
                        usuapl: usuaSol,
                        asunto: asunto,
                        usugra: usuario,
                        fecha: fecha
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.code == 200) {
                            const codigo = data.codigo;
                            $("#tokenModal").modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'El código generado es:',
                                html: `<b>${codigo}</b><br><br>El código expirará en 20 minutos...`,
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                tableList.ajax.reload();
                            })


                        }
                    })
            })
        })
        function formatFecha2(fechaStr) {
            if (fechaStr === '0' || fechaStr === ' ' || fechaStr === '') {
                return ' ';
            }
            fechaStr = fechaStr.padStart(8, '0');

            let año = fechaStr.substring(0, 4);
            let mes = fechaStr.substring(4, 6);
            let dia = fechaStr.substring(6, 8);
            return `${dia}/${mes}/${año}`;
        }
        function formatFecha(fechaStr, horaStr) {
            if (fechaStr === '0' || fechaStr === ' ' || fechaStr === '') {
                return ' ';
            }
            fechaStr = fechaStr.padStart(8, '0');

            let año = fechaStr.substring(0, 4);
            let mes = fechaStr.substring(4, 6);
            let dia = fechaStr.substring(6, 8);
            horaStr = horaStr.padStart(6, '0');
            let hora = horaStr.substring(0, 2);
            let minuto = horaStr.substring(2, 4);
            let segundo = horaStr.substring(4, 6);
            return `${dia}/${mes}/${año} ${hora}:${minuto}:${segundo}`;
        }
        function showModalToken() {
            $("#cbbCia").val('');
            $("#txtUsuaSol").val('');
            $("#txtUsuaSol_flexselect").val('');
            $("#txtAsunto").val('');
            $("#txtfecha").val('');
            $("#spnDescrp").text('300');
            $('#tokenModal').modal('show')
        }
    </script>
</body>

</html>