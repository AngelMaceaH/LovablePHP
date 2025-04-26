<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/flexselect.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

</head>

<body>
    <?php
    include '../layout-prg.php';
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Directorio telefónico / Control</span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0046P</span></li>
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
                            aria-selected="true" role="tab" tabindex="0">Áreas</li>
                        <li id="tab2" class="tablist__tab text-center p-3" aria-controls="panel2" aria-selected="false"
                            role="tab" tabindex="0">Usuarios</li>
                    </ul>
                    <div id="panel1" class="tablist__panel p-3 border border-0 border-top" aria-labelledby="tab1"
                        aria-hidden="false" role="tabpanel">
                        <div class="table-responsive p-5">
                            <div class="row mt-2 border border-1 shadow rounded p-3">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Áreas del directorio</h5>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <button id="btnAreas" class="btn btn-primary fw-bold"><i
                                                    class="fa-solid fa-plus"></i>
                                                Agregar un area</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 py-4">
                                    <label class="border border-0 mb-3 fw-bold">**Arrastra el área para cambiar su
                                        orden.**</label>
                                    <table id="sortable" class="table table-striped w-100">
                                        <thead>
                                            <tr class="no-sort fs-5">
                                                <th class="d-none">Codigo</th>
                                                <th style="width: 75%;">Descripción del area</th>
                                                <th style="width: 20%;">Secuencia</th>
                                                <th style="width: 5%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="sortable-Body">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="panel2" class="tablist__panel is-hidden p-3 border border-0 border-top"
                        aria-labelledby="tab2" aria-hidden="false" role="tabpanel">
                        <div class="table-responsive p-5">
                            <div class="row mt-2 border border-1 shadow rounded p-3">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Usuarios en el directorio</h5>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <button id="btnUsuarios" class="btn btn-primary fw-bold d-none"><i
                                                    class="fa-solid fa-plus"></i>
                                                Agrega un usuario</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-control border-0 my-1">Área:</label>
                                    <select id="cbbArea" class="form-select">

                                    </select>
                                </div>
                                <div class="col-12">
                                    <table id="tbUsuarios" class="table table-striped w-100 mt-4">
                                        <thead>
                                            <tr class="fs-5">
                                                <th style="width: 5%;">Línea</th>
                                                <th style="width: 50%;">Nombre</th>
                                                <th style="width: 20%;">Cargo</th>
                                                <th style="width: 20%;">Correo electrónico</th>
                                                <th style="width: 5%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbUsuarios-Body">
                                        </tbody>
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
    <div class="modal fade" id="modalAreas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar un área</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" id="codare" value="0">
                        <label for="area" class="form-label">Descripción del area</label>
                        <input type="text" class="form-control" id="area" name="area" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnSaveArea">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalUsuarios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <div class="col-3">
                            <label for="" class="form-control border-0 my-1">Linea:</label>
                            <input type="hidden" id="txtLineaOri" value="0">
                            <input type="hidden" id="txtNombreOri" value="">
                            <input type="text" class="form-control" id="txtLinea" placeholder="Linea">
                        </div>
                        <div class="col-9">
                            <label for="" class="form-control border-0 my-1">Nombre:</label>
                            <input type="text" class="form-control" id="txtName" placeholder="Nombre del usuario">
                        </div>
                        <div class="col-12">
                            <label for="" class="form-control border-0 my-1">Cargo:</label>
                            <input type="text" class="form-control" id="txtCargo" placeholder="Cargo del usuario">
                        </div>
                        <div class="col-12">
                            <label for="" class="form-control border-0 my-1">Correo:</label>
                            <input type="text" class="form-control" id="txtCorreo" placeholder="Correo del usuario">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnSaveUser">Guardar</button>
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="../../assets/js/jquery.flexselect.js"></script>
    <script src="../../assets/js/liquidmetal.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $(document).on("keydown", function (event) {
                if (event.key === "Enter") {
                    if ($("#modalAreas").hasClass('show')) {
                        $("#btnSaveArea").click();
                    } else {
                        $("#btnSaveUser").click();
                    }
                }
            });
            $("#btnAreas").click(function () {
                $('#codare').val(0);
                $("#area").val('');
                $('#modalAreas').modal('show');
            });
            $("#btnUsuarios").click(function () {
                $('#txtLineaOri').val(0);
                $('#txtNombreOri').val('');
                $('#txtLinea').val('');
                $('#txtName').val('');
                $('#txtCargo').val('');
                $('#txtCorreo').val('');

                $('#modalUsuarios').modal('show');
            });

            $("#btnSaveArea").click(() => {
                const codare = $("#codare").val();
                const descrp = $("#area").val();
                if (descrp.trim() == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'El campo descripción es requerido',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                } else {
                    if (codare == '0') {
                        fetch('/API.LovablePHP/ZLO0046P/AddArea', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                descrp: descrp
                            })
                        }).then(response => response.json())
                            .then(data => {
                                if (data.code == 200) {
                                    $("#modalAreas").modal('hide');
                                    chargeAreas();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error al agregar el area',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                    } else {
                        fetch('/API.LovablePHP/ZLO0046P/EditArea', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                codare: codare,
                                descrp: descrp
                            })
                        }).then(response => response.json())
                            .then(data => {
                                if (data.code == 200) {
                                    $("#modalAreas").modal('hide');
                                    $("#codare").val('0');
                                    chargeAreas();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error al editar el area',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                    }
                }
            })
            $("#btnSaveUser").click(() => {
                const codare = $("#cbbArea").val();
                const lineaOri = $("#txtLineaOri").val();
                const nombreOri = $("#txtNombreOri").val();
                const linea = $("#txtLinea").val();
                const nombre = $("#txtName").val();
                const cargo = $("#txtCargo").val();
                const correo = $("#txtCorreo").val();
                if (linea.trim() == '' || nombre.trim() == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'La linea y el nombre son requeridos',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                } else {
                    if (lineaOri == '0' && nombreOri == '') {
                        fetch('/API.LovablePHP/ZLO0046P/AddUser', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                codigo: linea,
                                nombre: nombre,
                                puesto: cargo,
                                correo: correo,
                                codare: codare
                            })
                        }).then(response => response.json())
                            .then(data => {
                                if (data.code == 200) {
                                    $("#modalUsuarios").modal('hide');
                                    chargeUsers();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error al agregar el usuario',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                    } else {
                        fetch('/API.LovablePHP/ZLO0046P/EditUser', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                codigoOri: lineaOri,
                                nombreOri: nombreOri,
                                codigo: linea,
                                nombre: nombre,
                                puesto: cargo,
                                correo: correo,
                                codare: codare
                            })
                        }).then(response => response.json())
                            .then(data => {
                                if (data.code == 200) {
                                    $("#modalUsuarios").modal('hide');
                                    $("#txtLineaOri").val('0');
                                    chargeUsers();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error al editar el usuario',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            });
                    }
                }

            })
            chargeAreas()
            chargeUsers()
            $("#sortable tbody").sortable({
                cursor: "move",
                placeholder: "sortable-placeholder",
                items: "tr:not(.no-sort)",
                helper: function (e, tr) {
                    var $originals = tr.children();
                    var $helper = tr.clone();
                    $helper.children().each(function (index) {
                        $(this).width($originals.eq(index).width());
                    });
                    return $helper;
                },
                update: function (event, ui) {
                    var $tr = $(ui.item).closest('tr');
                    var $trs = $tr.parent().children();
                    let fetchPromises = $trs.map(function (index, tr) {
                        var codare = $(tr).find('td').eq(0).text();

                        return fetch('/API.LovablePHP/ZLO0046P/ChangeOrder', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                codare: codare,
                                codsec: (index + 1)
                            })
                        });
                    }).get();
                    Promise.all(fetchPromises)
                        .then(() => {
                            chargeAreas();
                        })
                        .catch(error => console.error("Error al actualizar áreas:", error));
                }

            }).disableSelection();
            $("#cbbArea").change(() => {
                chargeUsers();
            });
        });
        function chargeAreas() {
            fetch('/API.LovablePHP/ZLO0046P/ListAreas')
                .then(response => response.json())
                .then(data => {
                    let html = '';
                    let options = '<option value="0">TODAS LAS ÁREAS</option>';
                    if (data.code == 200) {
                        $("#cbbArea").empty();
                        data.data.forEach(area => {
                            options += `<option value="${area.CODARE}">${area.DESCRP}</option>`;
                            html += `<tr>
                                <td class="d-none">${area.CODARE}</td>
                                <td><i class="fa fa-bars"></i> <span class="ms-3">${area.DESCRP}</span> </td>
                                <td class="fs-5">${area.CODSEC}</td>
                                <td class="d-flex gap-1">
                                    <button class="btn btn-warning" onclick="editArea('${area.CODARE}','${area.DESCRP}')" ><i class="fa-solid fa-pen text-white fw-bold"></i></button>
                                    <button class="btn btn-danger" onclick="delArea('${area.CODARE}')"><i class="fa-solid fa-trash-can text-white fw-bold"></i></button>
                                </td>
                            </tr>`;
                        });
                        $("#cbbArea").append(options);
                    } else {
                        html = `<tr>
                                <td colspan="3" class="text-center">No hay datos</td>
                            </tr>`;
                    }
                    document.getElementById('sortable-Body').innerHTML = html;
                });
        }
        function chargeUsers() {
            const codAre = $("#cbbArea").val();
            fetch('/API.LovablePHP/ZLO0046P/List',
                {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        codare: codAre
                    })
                }
            ).then(response => response.json())
                .then(data => {
                    let html = '';
                    if (data.code == 200) {
                        data.data.forEach(user => {
                            html += `<tr>
                                <td>${user.CODIGO}</td>
                                <td>${user.NOMBRE}</td>
                                <td>${user.PUESTO}</td>
                                <td>${user.CORREO}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-warning btnEditUser d-none" onclick="editUser('${user.CODIGO}','${user.NOMBRE}','${user.PUESTO}','${user.CORREO}')" ><i class="fa-solid fa-pen text-white fw-bold"></i></button>
                                        <button class="btn btn-danger btnDelUser d-none"  onclick="delUser('${user.CODIGO}','${user.NOMBRE}')"><i class="fa-solid fa-trash-can text-white fw-bold"></i></button>
                                    </div>
                                </td>
                            </tr>`;
                        });
                    } else {
                        html = `<tr>
                                <td colspan="5" class="text-center">No hay datos</td>
                            </tr>`;
                    }
                    document.getElementById('tbUsuarios-Body').innerHTML = html;
                    console.log(codAre);
                    if (codAre == '0' || codAre == null) {
                        $("#btnUsuarios").addClass("d-none")
                        document.querySelectorAll(".btnEditUser").forEach(btn => {
                            $(btn).addClass("d-none")
                        });
                        document.querySelectorAll(".btnDelUser").forEach(btn => {
                            $(btn).addClass("d-none")
                        });
                    } else {
                        $("#btnUsuarios").removeClass("d-none")
                        document.querySelectorAll(".btnEditUser").forEach(btn => {
                            $(btn).removeClass("d-none")
                        });
                        document.querySelectorAll(".btnDelUser").forEach(btn => {
                            $(btn).removeClass("d-none")
                        });
                    }
                });
        }
        function editArea(codare, descrp) {
            $('#area').val(descrp);
            $('#codare').val(codare);
            $('#modalAreas').modal('show');
        }
        function editUser(linea, nombre, cargo, correo) {
            $('#txtLineaOri').val(linea);
            $('#txtNombreOri').val(nombre);
            $('#txtLinea').val(linea);
            $('#txtName').val(nombre);
            $('#txtCargo').val(cargo);
            $('#txtCorreo').val(correo);
            $('#modalUsuarios').modal('show');
        }

        function delArea(codare) {
            fetch('/API.LovablePHP/ZLO0046P/DeleteArea', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    codare: codare
                })
            }).then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        //Recorriendo todas las filas
                        var trs = $('#sortable tbody tr');
                        let fetchPromises = trs.map(function (index, tr) {
                            console.log(tr)
                            var codare = $(tr).find('td').eq(0).text();

                            return fetch('/API.LovablePHP/ZLO0046P/ChangeOrder', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    codare: codare,
                                    codsec: (index + 1)
                                })
                            });
                        }).get();
                        Promise.all(fetchPromises)
                            .then(() => {
                                console.log("Todas las áreas han sido actualizadas.");
                                chargeAreas();
                            })
                            .catch(error => console.error("Error al actualizar áreas:", error));
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al eliminar el area',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
        }
        function delUser(linea, nombre) {
            const codare = $("#cbbArea").val();
            fetch('/API.LovablePHP/ZLO0046P/DelUser', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    codigo: linea,
                    codare: codare,
                    nombre: nombre
                })
            }).then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        chargeUsers();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al eliminar el usuario',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
        }

    </script>
</body>

</html>