<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/flexselect.css">
</head>

<body>
    <?php
    include '../layout-prg.php';
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Lovable Radio / Control</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0043P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">CONTROL</h1>
            </div>
            <div class="card-body">
                <div class="demo">
                    <ul class="tablist" role="tablist">
                        <li id="tab1" class="tablist__tab text-center p-3  is-active" aria-controls="panel1"
                            aria-selected="true" role="tab" tabindex="0">Modo reproducción</li>
                        <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false"
                            role="tab" tabindex="0">Compañías a no tener en cuenta</li>
                        <li id="tab3" class="tablist__tab text-center p-3" aria-controls="panel3" aria-selected="false"
                            role="tab" tabindex="0">Horarios</li>
                        <li id="tab4" class="tablist__tab text-center p-3" aria-controls="panel4" aria-selected="false"
                            role="tab" tabindex="0">Feriados</li>
                    </ul>
                    <div id="panel1" class="tablist__panel p-3 border border-0 border-top" aria-labelledby="tab1"
                        aria-hidden="false" role="tabpanel">
                        <div class="table-responsive p-5">
                            <div class="row mt-2 border border-1 shadow rounded p-3">
                                <div class="col-12">
                                    <h5>Modo de reproducción actual</h5>
                                </div>
                                <div class="col-12 d-flex justify-content-around py-4 fs-4">
                                    <div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="switchSpotify">
                                            <label class="form-check-label" for="switchSpotify">Spotify playlist</label>
                                        </div>
                                    </div>
                                    <div class="d-none">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="switchJamendo">
                                            <label class="form-check-label" for="switchJamendo">Jamendo API</label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="switchLocal">
                                            <label class="form-check-label" for="switchLocal">Música local</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="panel2" class="tablist__panel is-hidden p-3 border border-0 border-top"
                        aria-labelledby="tab2" aria-hidden="false" role="tabpanel">
                        <div class="table-responsive p-5">
                            <div class="row mt-2 border border-1 shadow rounded p-3">
                                <div class="col-12 d-none">
                                    <h5 class="mb-3">Compañías a no tener en cuenta</h5>
                                </div>
                                <div class="col-12">
                                    <table class="table-light w-100">
                                        <thead>
                                            <tr class="p-2">
                                                <th style="width: 2% !important;"></th>
                                                <th style="width: 88% !important;">
                                                    <select class="form-select" id="selectTienda">

                                                    </select>
                                                </th>
                                                <th style="width: 10% !important;">
                                                    <button class="btn btn-success" onclick="addCompany()"><i
                                                            class="fa-solid fa-plus text-white"></i></button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body">
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="panel3" class="tablist__panel is-hidden p-3 border border-0 border-top"
                        aria-labelledby="tab3" aria-hidden="false" role="tabpanel">
                        <div class="py-3">
                            <div class="table-responsive">
                                <table id="tableScheduled" class="table table-hover w-100 align-middle">
                                    <thead>
                                        <tr>
                                            <th>Punto de venta</th>
                                            <th>Lunes</th>
                                            <th>Martes</th>
                                            <th>Miercoles</th>
                                            <th>Jueves</th>
                                            <th>Viernes</th>
                                            <th>Sabado</th>
                                            <th>Domingo</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-scheduled">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="panel4" class="tablist__panel is-hidden p-3 border border-0 border-top"
                        aria-labelledby="tab4" aria-hidden="false" role="tabpanel">
                        <div class="py-3">
                            <div class="pb-4">
                                <div class="row">
                                    <div class="col-2"></div>
                                    <div class="col-8">
                                        <label class="mt-2">País:</label>
                                        <select class="form-select mt-1 fw-bold" id="cbbAgrup">
                                            <option value="11,9">Honduras</option>
                                            <option value="10">Guatemala</option>
                                            <option value="12">El Salvador</option>
                                            <option value="13">Costa Rica</option>
                                            <option value="16">Nicaragua</option>
                                            <option value="15">Republica Dominicana</option>
                                        </select>
                                    </div>
                                    <div class="col-2"></div>
                                </div>
                            </div>
                            <button class="btn btn-primary mb-3 fw-bold text-white" onclick="createNewHoliday()"><i
                                    class="fa-solid fa-plus"></i>
                                Agregar un
                                horario</button>
                            <div class="table-responsive">
                                <table class="table table-hover w-100 align-middle">
                                    <thead>
                                        <tr>
                                            <th style="width:10%;">Mes</th>
                                            <th style="width:5%;">Fecha</th>
                                            <th style="width:80%;">Descripción</th>
                                            <th style="width:5%;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-holidays"></tbody>
                                </table>
                            </div>
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
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/js/jquery.flexselect.js"></script>
    <script src="../../assets/js/liquidmetal.js"></script>
    <script>
        let table = null;
        document.querySelectorAll('.form-check-input').forEach((checkbox) => {
            checkbox.addEventListener('change', function () {
                if (this.checked) {
                    document.querySelectorAll('.form-check-input').forEach((otherCheckbox) => {
                        if (otherCheckbox !== this) {
                            otherCheckbox.checked = false;
                        } else {
                            let modo = 0;
                            switch (otherCheckbox.id) {
                                case 'switchSpotify':
                                    modo = 1;
                                    break;
                                case 'switchJamendo':
                                    modo = 2;
                                    break;
                                case 'switchLocal':
                                    modo = 3;
                                    break;
                            }
                            fetch("/API.LovablePHP/Radio/SetModo", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    modo: modo
                                })
                            }).then(response => response.json())
                        }
                    });
                }
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
            table = $("#tableScheduled").DataTable({
                "language": {
                    "url": 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                "pageLength": 100,
                "processing": true,
                "serverSide": true,
                "dom": 'rtip',
                "ajax": {
                    "url": "/API.LovablePHP/Radio/ListSchedules",
                    "type": "POST",
                    "contentType": "application/json",
                    "data": function (d) {
                        return JSON.stringify({
                            "draw": d.draw,
                            "start": d.start,
                            "length": d.length,
                            "search": d.search.value,
                            "columns": d.columns
                        });
                    },
                    "error": function (xhr, status, error) {
                        console.log("Error en la petición:", error);
                    }
                },
                "ordering": false,
                "columnDefs": [
                    { "width": "13%", "targets": 0, "class": "align-middle" },
                    { "width": "11%", "targets": 1, "class": "align-middle" },
                    { "width": "11%", "targets": 2, "class": "align-middle" },
                    { "width": "11%", "targets": 3, "class": "align-middle" },
                    { "width": "11%", "targets": 4, "class": "align-middle" },
                    { "width": "11%", "targets": 5, "class": "align-middle" },
                    { "width": "11%", "targets": 6, "class": "align-middle" },
                    { "width": "11%", "targets": 7, "class": "align-middle" },
                    { "width": "8%", "targets": 8, "class": "align-middle" },
                    { "width": "2%", "targets": 9, "class": "align-middle" },
                ],
                "columns": [
                    { "data": "NOMCIA" },
                    { "data": null, "render": function (data, type, row) { return formatScheduleTime(data.LUN); } },
                    { "data": null, "render": function (data, type, row) { return formatScheduleTime(data.MAR); } },
                    { "data": null, "render": function (data, type, row) { return formatScheduleTime(data.MIE); } },
                    { "data": null, "render": function (data, type, row) { return formatScheduleTime(data.JUE); } },
                    { "data": null, "render": function (data, type, row) { return formatScheduleTime(data.VIE); } },
                    { "data": null, "render": function (data, type, row) { return formatScheduleTime(data.SAB); } },
                    { "data": null, "render": function (data, type, row) { return formatScheduleTime(data.DOM); } },
                    {
                        "data": null, "render": function (data, type, row) {
                            return data.LUN != "" ? data.ESTADO == 0 ? '<span class="badge rounded-pill text-bg-success text-white">Disponible para correo</span>' : '<span class="badge rounded-pill text-bg-danger text-white">Correo ya enviado.</span>' : ""
                        }
                    },
                    {
                        "data": null, "render": function (data, type, row) {
                            return `                                                         <button class="btn btn-warning"
                                                             onclick="editSchedule('${encodeURIComponent(JSON.stringify(data))}')">
                                                             <i class="fa-solid fa-pen text-white"></i>
                                                         </button>`;
                        }
                    },
                ],
                "initComplete": function () {

                    $("#tableScheduled thead th").each(function (index) {
                        var title = $(this).text();
                        $(this).addClass("p-0 py-2 px-2");

                        if (index == 0) {
                            $(this).html(
                                title +
                                '<br><input type="text" class="form-control mt-2 column-search" placeholder="Buscar..." />'
                            );
                        }
                    });
                    $("#tableScheduled thead").on("input", ".column-search", function () {
                        var columnIndex = $(this).parent().index();
                        table.column(columnIndex).search(this.value).draw();
                    });
                }
            });
            const usuario = "<?php echo isset($_SESSION['CODUSU']) ? $_SESSION['CODUSU'] : ''; ?>";
            fetch(`/API.LovablePHP/ZLO0015P/ListTiendas/?user=${usuario}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.code == 200) {
                        const responseData = data.data;
                        let html = "";
                        html += `<option value="" disabled selected></option>`;
                        responseData.forEach((element) => {
                            if (element.CODSEC != "1") {
                                html += `<option value="${element.COMCOD}">${element.COMDES}</option>`;
                            }
                        });
                        document.getElementById("selectTienda").innerHTML = html;
                        $("#selectTienda").flexselect();
                    } else {
                        error();
                    }
                })
            chargeTable();
            chargeHolidays();

            $("#cbbAgrup").change(() => {
                chargeHolidays();
            });

        });
        const select = document.getElementById("selectTienda");
        function chargeTable() {
            const url = "http://172.16.15.20/API.LovablePHP/Radio/ListNotCias";
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        const tableBody = document.getElementById('table-body');
                        tableBody.innerHTML = '';
                        if (data.data.length > 0) {
                            data.data.forEach((compania, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                            <td>${(index + 1)}.</td>
                            <td>${compania.NOMCIA}</td>
                            <td>
                                <button class="btn btn-danger" onclick="deleteCompany(${compania.CODCIA})">
                                <i class="fa-solid fa-trash text-white"></i>
                                </button>
                            </td>
                        `;
                                tableBody.appendChild(row);
                            });
                        } else {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                            <td colspan="3" class="text-center">No hay compañías</td>
                        `;
                            tableBody.appendChild(row);
                        }
                    } else {
                        const tableBody = document.getElementById('table-body');
                        tableBody.innerHTML = '';
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td colspan="3" class="text-center fs-5 py-3">No hay compañías</td>
                        `;
                        tableBody.appendChild(row);
                    }
                });
        }
        function addCompany() {
            const id = $("#selectTienda").val();
            if (!id) {
                swal.fire({
                    title: "Error",
                    text: "Seleccione una compañía",
                    icon: "error",
                    confirmButtonText: "Aceptar",
                });
                return;
            }
            fetch("/API.LovablePHP/Radio/AddNotCias", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id: id
                })
            }).then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        $("#selectTienda").val('');
                        $("#selectTienda_flexselect").val('');
                        chargeTable();
                    }
                });
        }
        function deleteCompany(id) {
            Swal.fire({
                title: "¿Estás seguro de eliminar esta compañía?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("/API.LovablePHP/Radio/DeleteNotCias", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    }).then(response => response.json())
                        .then(data => {
                            if (data.code == 200) {
                                chargeTable();
                            }
                        });
                }
            });

        }
        fetch("/API.LovablePHP/Radio/GetModo")
            .then(response => response.json())
            .then(data => {
                if (data.code == 200) {
                    const modo = parseInt(data.data[0].MODORE);
                    switch (modo) {
                        case 1:
                            document.getElementById('switchSpotify').checked = true;
                            break;
                        case 2:
                            document.getElementById('switchJamendo').checked = true;
                            break;
                        case 3:
                            document.getElementById('switchLocal').checked = true;
                            break;
                    }
                }
            });
        function chargeSchedule() {

            /* fetch("/API.LovablePHP/Radio/ListSchedules")
                 .then(response => response.json())
                 .then(data => {
                     const tableBody = document.getElementById('table-body-scheduled');
                     tableBody.innerHTML = '';
 
                     if (data.code === 200) {
                         const responseData = data.data;
 
                         if (responseData.length > 0) {
                             const fragment = document.createDocumentFragment();
 
                             responseData.forEach(schedule => {
                                 const row = document.createElement('tr')
                                 const formatScheduleTime = (timeString) => {
                                     if (!timeString) return "";
                                     const [start, end] = timeString.split('/');
                                     return `${timeFormatted(start)} - ${timeFormatted(end)}`;
                                 };
 
                                 row.innerHTML = `
                                                     <td>${schedule.NOMCIA}</td>
                                                     <td>${formatScheduleTime(schedule.LUN)}</td>
                                                     <td>${formatScheduleTime(schedule.MAR)}</td>
                                                     <td>${formatScheduleTime(schedule.MIE)}</td>
                                                     <td>${formatScheduleTime(schedule.JUE)}</td>
                                                     <td>${formatScheduleTime(schedule.VIE)}</td>
                                                     <td>${formatScheduleTime(schedule.SAB)}</td>
                                                     <td>${formatScheduleTime(schedule.DOM)}</td>
                                                     <td>${schedule.LUN != "" ? schedule.ESTADO == 0 ? '<span class="badge rounded-pill text-bg-success text-white">Disponible para correo</span>' : '<span class="badge rounded-pill text-bg-danger text-white">Correo ya enviado.</span>' : ""}</td>
                                                     <td>
                                                         <button class="btn btn-warning"
                                                             onclick="editSchedule('${encodeURIComponent(JSON.stringify(schedule))}')">
                                                             <i class="fa-solid fa-pen text-white"></i>
                                                         </button>
                                                     </td>
 
                                                 `;
 
                                 fragment.appendChild(row);
                             });
 
                             tableBody.appendChild(fragment);
                         } else {
                             showNoDataMessage(tableBody);
                         }
                     } else {
                         showNoDataMessage(tableBody);
                     }
                 })
                 .catch(error => console.error("Error al cargar los horarios:", error));*/
        }
        function formatScheduleTime(timeString) {
            if (!timeString) return "";
            const [start, end] = timeString.split('/');
            return `${timeFormatted(start)}&nbsp;&nbsp;${timeFormatted(end)}`;
        };
        function editSchedule(scheduleData) {
            const schedule = JSON.parse(decodeURIComponent(scheduleData));
            $("#lblCia").text(schedule.CODCIA);
            $("#lblPunto").text(schedule.NOMCIA);
            const days = ["LUN", "MAR", "MIE", "JUE", "VIE", "SAB", "DOM"];

            days.forEach(day => {
                if (schedule[day] && schedule[day] !== "") {
                    const [start, end] = schedule[day].split('/');
                    $(`#${day}_start`).val(formatTimeInput(start));
                    $(`#${day}_end`).val(formatTimeInput(end));
                } else {
                    $(`#${day}_start`).val('');
                    $(`#${day}_end`).val('');
                }
            });
            $("#editModal").modal('show');
        }
        function saveEdit() {
            const days = ["LUN", "MAR", "MIE", "JUE", "VIE", "SAB", "DOM"];
            const schedule = {
                CODCIA: $("#lblCia").text(),
                LUN: `${$("#LUN_start").val().replace(":", "")}00/${$("#LUN_end").val().replace(":", "")}00`,
                MAR: `${$("#MAR_start").val().replace(":", "")}00/${$("#MAR_end").val().replace(":", "")}00`,
                MIE: `${$("#MIE_start").val().replace(":", "")}00/${$("#MIE_end").val().replace(":", "")}00`,
                JUE: `${$("#JUE_start").val().replace(":", "")}00/${$("#JUE_end").val().replace(":", "")}00`,
                VIE: `${$("#VIE_start").val().replace(":", "")}00/${$("#VIE_end").val().replace(":", "")}00`,
                SAB: `${$("#SAB_start").val().replace(":", "")}00/${$("#SAB_end").val().replace(":", "")}00`,
                DOM: `${$("#DOM_start").val().replace(":", "")}00/${$("#DOM_end").val().replace(":", "")}00`,
            };
            fetch("/API.LovablePHP/Radio/SaveSchedule", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(schedule)
            }).then(response => response.json())
                .then(data => {
                    if (data.code === 200) {
                        Swal.fire({
                            title: "Horario actualizado",
                            icon: "success",
                            confirmButtonText: "Aceptar",
                        }).then(() => {
                            //chargeSchedule();
                            table.ajax.reload();
                            $("#editModal").modal('hide');
                        });
                    } else {
                        Swal.fire({
                            title: "Error al actualizar el horario",
                            icon: "error",
                            confirmButtonText: "Aceptar",
                        });
                    }
                });
        }
        function chargeHolidays() {
            const sendData = {
                CODCIA: document.getElementById("cbbAgrup").value
            };
            fetch(`/API.LovablePHP/Radio/ListHolidays`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(sendData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        const tableBody = document.getElementById('table-body-holidays');
                        tableBody.innerHTML = '';
                        if (data.data.length > 0) {
                            data.data.forEach((rowIndex, index) => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                            <td>${formatMonth(rowIndex.FECMES)}</td>
                            <td>${rowIndex.FECDIA}</td>
                            <td>${rowIndex.DESCRP}</td>
                            <td>
                                <button class="btn btn-danger" onclick="deleteHoliday('${rowIndex.FECMES}', '${rowIndex.FECDIA}')">
                                <i class="fa-solid fa-trash text-white"></i>
                                </button>
                            </td>
                        `;
                                tableBody.appendChild(row);
                            });
                        } else {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                            <td colspan="3" class="text-center">No hay feriados para este país</td>
                        `;
                            tableBody.appendChild(row);
                        }
                    } else {
                        const tableBody = document.getElementById('table-body-holidays');
                        tableBody.innerHTML = '';
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td colspan="3" class="text-center fs-5 py-3">No hay feriados para este país</td>
                        `;
                        tableBody.appendChild(row);
                    }
                });

        }
        function showNoDataMessage(tableBody) {
            const row = document.createElement('tr');
            row.innerHTML = `<td colspan="9" class="text-center fs-5 py-3">No hay horarios para mostrar</td>`;
            tableBody.appendChild(row);
        }
        function timeFormatted(time) {
            let hours = time.substring(0, 2);
            let minutes = time.substring(2, 4);
            let period = hours >= 12 ? "PM" : "AM";

            hours = hours % 12 || 12;

            return `${hours}:${minutes.toString().padStart(2, "0")}&nbsp;${period}`;
        }
        function formatTimeInput(time) {
            let hours = time.substring(0, 2);
            let minutes = time.substring(2, 4);
            return `${hours}:${minutes}`;
        }
        function formatMonth(month) {
            const months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            return months[month - 1];
        }
        function createNewHoliday() {
            $("#holyModal").modal('show');
        }
        function saveHoliday() {
            const sendData = {
                CODCIA: document.getElementById("cbbAgrup2").value,
                FECDIA: document.getElementById("txtDia").value,
                FECMES: document.getElementById("cbbMes").value,
                DESCRP: document.getElementById("txtDesc").value
            };
            fetch(`/API.LovablePHP/Radio/SaveHolidays`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(sendData)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        Swal.fire({
                            title: "Feriado guardado",
                            icon: "success",
                            confirmButtonText: "Aceptar",
                        }).then(() => {
                            $("#cbbAgrup2").val('11,9');
                            $("#cbbMes").val('1');
                            $("#txtDia").val('');
                            $("#txtDesc").val('');
                            $("#cbbAgrup").val(sendData.CODCIA);
                            chargeHolidays();
                            $("#holyModal").modal('hide');
                        });
                    } else {
                        Swal.fire({
                            title: "Error al guardar el feriado",
                            icon: "error",
                            confirmButtonText: "Aceptar",
                        });
                    }
                });
        }
        function deleteHoliday(fecmes, fecdia) {
            console.log({
                "CODCIA": $("#cbbAgrup").val(),
                "FECDIA": fecmes,
                "FECMES": fecdia
            })
            Swal.fire({
                title: "¿Estás seguro de eliminar este feriado?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar",
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("/API.LovablePHP/Radio/DeleteHolidays", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            "CODCIA": $("#cbbAgrup").val(),
                            "FECMES": fecmes,
                            "FECDIA": fecdia
                        })
                    }).then(response => response.json())
                        .then(data => {
                            if (data.code == 200) {
                                chargeHolidays()
                            }
                        });
                }
            });

        }
    </script>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Editar horario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row py-3">
                        <div class="col-3 text-center"><label for="">Punto de venta:</label></div>
                        <div class="col-9"> <span id="lblCia" class="d-none"></span> <span class="fs-5"
                                id="lblPunto"></span></div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center py-2">
                            <label for="">Lunes:</label>
                        </div>
                        <div class="col-9 d-flex justify-content-between py-2">
                            <div class="row w-100">
                                <div class="col-5">
                                    <input type="time" id="LUN_start" class="form-control">
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center"> hasta </div>
                                <div class="col-5">
                                    <input type="time" id="LUN_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center py-2">
                            <label for="">Martes:</label>
                        </div>
                        <div class="col-9 d-flex justify-content-between py-2">
                            <div class="row w-100">
                                <div class="col-5">
                                    <input type="time" id="MAR_start" class="form-control">
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center"> hasta </div>
                                <div class="col-5">
                                    <input type="time" id="MAR_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center py-2">
                            <label for="">Miercoles:</label>
                        </div>
                        <div class="col-9 d-flex justify-content-between py-2">
                            <div class="row w-100">
                                <div class="col-5">
                                    <input type="time" id="MIE_start" class="form-control">
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center"> hasta </div>
                                <div class="col-5">
                                    <input type="time" id="MIE_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center py-2">
                            <label for="">Jueves:</label>
                        </div>
                        <div class="col-9 d-flex justify-content-between py-2">
                            <div class="row w-100">
                                <div class="col-5">
                                    <input type="time" id="JUE_start" class="form-control">
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center"> hasta </div>
                                <div class="col-5">
                                    <input type="time" id="JUE_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center py-2">
                            <label for="">Viernes:</label>
                        </div>
                        <div class="col-9 d-flex justify-content-between py-2">
                            <div class="row w-100">
                                <div class="col-5">
                                    <input type="time" id="VIE_start" class="form-control">
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center"> hasta </div>
                                <div class="col-5">
                                    <input type="time" id="VIE_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center py-2">
                            <label for="">Sábado:</label>
                        </div>
                        <div class="col-9 d-flex justify-content-between py-2">
                            <div class="row w-100">
                                <div class="col-5">
                                    <input type="time" id="SAB_start" class="form-control">
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center"> hasta </div>
                                <div class="col-5">
                                    <input type="time" id="SAB_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center py-2">
                            <label for="">Domingo:</label>
                        </div>
                        <div class="col-9 d-flex justify-content-between py-2">
                            <div class="row w-100">
                                <div class="col-5">
                                    <input type="time" id="DOM_start" class="form-control">
                                </div>
                                <div class="col-2 d-flex justify-content-center align-items-center"> hasta </div>
                                <div class="col-5">
                                    <input type="time" id="DOM_end" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-bold text-white"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary fw-bold text-white" onclick="saveEdit()">Guardar
                        cambios</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="holyModal" tabindex="-1" aria-labelledby="holyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="holyModalLabel">Ingresar un horario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row p-3">
                        <div class="col-12">
                            <label class="mt-3">País:</label>
                            <select class="form-select mt-1 fw-bold" id="cbbAgrup2">
                                <option value="11,9">Honduras</option>
                                <option value="10">Guatemala</option>
                                <option value="12">El Salvador</option>
                                <option value="13">Costa Rica</option>
                                <option value="16">Nicaragua</option>
                                <option value="15">Republica Dominicana</option>
                            </select>
                        </div>
                        <div class="col-7">
                            <label class="mt-3">Mes:</label>
                            <select class="form-select mt-1 fw-bold" id="cbbMes">
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
                        <div class="col-5">
                            <label class="mt-3">Día:</label>
                            <input type="number" class="form-control mt-1 fw-bold" id="txtDia" min="1" max="31">
                        </div>
                        <div class="col-12">
                            <label class="mt-3">Descripción:</label>
                            <input type="text" class="form-control mt-1 fw-bold" id="txtDesc">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-bold text-white"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary fw-bold text-white"
                        onclick="saveHoliday()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>