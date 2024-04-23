<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
</head>

<body>
    <?php
      include '../layout-prg.php';
      include '../../assets/php/ENC/ZLO0021P/header.php';
?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Envios correo electronicos / Clientes</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0030P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5" style="height: 400px;">
            <div id="bgLoader" class="d-none"
                style="position: fixed; z-index: 9999; height: 400px; width: 100%; background-color:rgba(108, 117, 125,0.6);">
            </div>
            <div id="sendingEmail" class="d-none" style="position: fixed; z-index: 9999; top: 30%; left: 50%; ">
                <div class="position-absolute p-4 bg-light p-5 rounded" style="z-index: 9999;">
                    <div class="ps-4 pe-4 pt-3">
                        <span class="loaderEmail"></span>
                    </div>
                </div>
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-opacity-50 rounded" style="z-index: 9998;">
                </div>
            </div>
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Envío de correos electronicos registros de clientes web</h1>
            </div>
            <div class="card-body ">
                <div class="container p-5">
                    <div class="row mt-5">
                        <div class="col-1 ">
                            <label class="form-control border border-0">Cliente</label>
                        </div>
                        <div class="col-9">
                                <span class="" onclick="showClientes()">
                                <input type="text" class="text-muted form-select" id="lblCliente" placeholder="Selecciona un cliente" readonly />
                                </span>
                                <input class="d-none" id="clieId"  />
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" value="" id="sendCliente">
                                <label class="form-check-label mt-1" for="flexCheckDefault">
                                    Incluír cliente
                                </label>
                            </div>
                            <label class="text-danger d-none mt-2" id="lblError">Ingrese el cliente</label>
                        </div>
                        <div class="col-2 text-center">
                            <button type="button" class="btn btn-danger text-white fw-bold" style="width:100%;"
                                onclick="sendCorreo()"><i class="fa-solid fa-paper-plane"></i> Envíar</button>
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        $('#tbClientes thead th').each(function() {
            var title = $(this).text();
            $(this).html(title +
                '<br /><input type="text"  oninput="this.value = this.value.toUpperCase()" class="form-control mt-2"/>'
                );
        });
        var table = $('#tbClientes').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
            },
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "/API.LovablePHP/ZLO0030P/ListClientesAsync/",
                "type": "POST",
                "complete": function(xhr) {
                    //console.log(xhr.responseJSON);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    requestError = true;
                }
            },
            "ordering": false,
            "dom": 'rtip',
            "columns": [{
                            "data": "SITWEB",
                        },
                        {
                            "data": "CODCLI",
                        },
                        {
                            "data": "NOMCLI"
                        },
            ],
            "drawCallback": function() {
                $('#tbClientes tbody tr').on('click', function() {
                    sendCliente(this);
                });
            }
        });
        $('#tbClientes thead input').on('keyup', function() {
            var columnIndex = $(this).parent().index();
            var inputValue = $(this).val().trim();

            if (table.column(columnIndex).search() !== inputValue) {
                table
                    .column(columnIndex)
                    .search(inputValue)
                    .draw();
            }
        });

    });

    function sendCorreo() {
        var numClie = document.getElementById("clieId");
        var clienteck = document.getElementById("sendCliente");
        var valueCk = 0;
        if (clienteck.checked) {
            valueCk = 1;
        }
        var value = numClie.value;
        if (value == "") {
            document.getElementById("lblError").classList.remove("d-none");
        } else {
            document.getElementById("lblError").classList.add("d-none");
            bgLoader.classList.remove("d-none");
            sendingEmail.classList.remove("d-none");
            let url = "/API.LovablePHP/ZLO0030P/SEND/?codcli=" + value + "&sendclie=" + valueCk;
            console.log(url);
            fetch(url)
                .then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Correo enviado',
                        text: 'El correo se envió correctamente',
                    });
                    numClie.value = "";
                    clienteck.checked = false;
                    bgLoader.classList.add("d-none");
                    sendingEmail.classList.add("d-none");
                    $("#clieId").val('');
                    $("#lblCliente").val('');
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El correo no se envió correctamente',
                    });
                });
        }
    }
    function showClientes() {
        $("#modalClientes").modal('show');
    }
    function sendCliente(row) {
        var tr = $(row).closest('tr');
        var tds = tr.find('td');
        var clie = tds.eq(2).text();
        var stweb = tds.eq(0).text();
        var code = tds.eq(1).text();
        $("#clieId").val(code);
        $("#lblCliente").val(clie);
        $("#modalClientes").modal('hide');
    }
    </script>
    <div class="modal fade" id="modalClientes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>

                    <button type="button" class="btn-close" onclick="$('#modalClientes').modal('hide')"></button>
                </div>
                <div class="modal-body">
                    <div class="table-container mt-3" style="width:100%;">
                        <table id="tbClientes" class="table stripe table-hover " style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="10%" class="text-black text-start">Sitio Web</th>
                                    <th colspan="10%" class="text-black text-start">Código</th>
                                    <th colspan="10%" class="text-black text-start">Cliente</th>
                                </tr>
                            </thead>
                            <tbody id="tbClientesBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>