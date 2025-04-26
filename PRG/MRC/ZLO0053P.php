<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <style>
        .bg-section {
            background-color: rgba(10, 35, 64, 0.8) !important;
            letter-spacing: 1px;
            color: white !important;
        }

        .bg-section2 {
            background-color: rgba(10, 35, 64, 0.5) !important;
            letter-spacing: 1px;
            color: white !important;
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
                    <span> Consumo / Reporte de consumo </span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0053P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Reporte de consumo</h1>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-6 col-lg-2 text-center py-2">
                            <label for="">Año de proceso</label>
                            <select id="cbbAno" class="form-select my-2 ">
                                <option value="" disabled selected>Selecciona un año</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                        <div class="col-6 col-lg-2 text-center py-2">
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
                        <div class="col-12 col-lg-8 py-2">
                            <label>Tipo de impresión</label>
                            <div class="w-100 d-flex flex-column flex-lg-row justify-content-around form-control mt-2">
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="C" type="radio"
                                        id="ckTipo1">
                                    <label class="form-check-label" for="ckTipo1">
                                        Distribuidores
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="T" type="radio"
                                        id="ckTipo2">
                                    <label class="form-check-label" for="ckTipo2">
                                        Trabajo interno
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="V" type="radio"
                                        id="ckTipo3">
                                    <label class="form-check-label" for="ckTipo3">
                                        Vitrina
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="P" type="radio"
                                        id="ckTipo4">
                                    <label class="form-check-label" for="ckTipo4">
                                        Prueba
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="I" type="radio"
                                        id="ckTipo5">
                                    <label class="form-check-label" for="ckTipo5">
                                        Cambio de imagen
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="A" type="radio"
                                        id="ckTipo6">
                                    <label class="form-check-label" for="ckTipo6">
                                        Varios
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input ckTipo" name="ckTipo" value="ALL" type="radio"
                                        checked id="ckTipo7">
                                    <label class="form-check-label" for="ckTipo7">
                                        Todos
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 py-2">
                        <div class="table-container">
                            <table id="tbConsumo" class="table table-hover " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Descripción</th>
                                        <th>Costo</th>
                                    </tr>
                                </thead>
                                <tbody id="tbConsumoBody">
                                </tbody>
                            </table>
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
        $(document).ready(function () {
            fetch('/API.LovablePHP/ZLO0050P/FechaProceso')
                .then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        $("#cbbAno").val(data.data[0].ANOPRO);
                        $("#cbbMes").val(parseInt(data.data[0].MESPRO));
                    }
                }).then(() => {
                    const table = $("#tbConsumo").DataTable({
                        language: {
                            url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
                        },
                        ordering: false,
                        pageLength: 1000,
                        dom: "Bti",
                        buttons: [
                            {
                                extend: "excelHtml5",
                                text: '<i class="fa-solid fa-file-excel"></i> <b>Enviar a Excel</b>',
                                className: "btn btn-success text-light fs-6 my-2",
                                title: function () {
                                    return `Reporte de consumo, ${$("#cbbMes option:selected").text()} ${$("#cbbAno").val()}`;
                                },
                                filename: function () {
                                    return `Reporte de consumo-${$("#cbbMes option:selected").text()}-${$("#cbbAno").val()}`;
                                },
                            },
                            {
                                extend: "pdfHtml5",
                                text: '<i class="fa-solid fa-file-pdf"></i> <b>Exportar a PDF</b>',
                                className: "btn btn-primary text-light fs-6 my-2",
                                title: function () {
                                    return `Reporte de consumo, ${$("#cbbMes option:selected").text()} ${$("#cbbAno").val()}`;
                                },
                                filename: function () {
                                    return `Reporte de consumo-${$("#cbbMes option:selected").text()}-${$("#cbbAno").val()}`;
                                },
                                orientation: 'portrait',
                                pageSize: 'A4',
                                customize: function (doc) {
                                    doc.styles.title = {
                                        color: '#333',
                                        fontSize: '14',
                                        alignment: 'left'
                                    };
                                    doc.pageMargins = [15, 30, 15, 30];
                                    doc.defaultStyle.fontSize = 10;
                                    doc.content[1].table.widths = ['20%', '60%', '20%'];
                                    doc.footer = function (currentPage, pageCount) {
                                        return {
                                            text: currentPage.toString() + ' de ' + pageCount,
                                            alignment: 'center',
                                            fontSize: 12
                                        };
                                    };
                                    const body = doc.content[1].table.body;
                                    body.forEach(function (row, index) {
                                        if (row[0].text && (row[0].text.startsWith('Impresiones') || row[0].text.startsWith('IMPRESIÓN'))) {
                                            row[0].colSpan = 3;
                                            row[0].fillColor = '#777777';
                                            row[0].color = 'white';
                                            row[0].fontSize = 11;
                                            row[1] = { text: '', colSpan: 0 };
                                            row[2] = { text: '', colSpan: 0 };
                                        } else if (row[0].text && row[0].text.startsWith('Total')) {
                                            row[0].colSpan = 2;
                                            row[0].fillColor = '#a9a9a9';
                                            row[0].color = 'white';
                                            row[1] = { text: '', colSpan: 0 };
                                            row[2].fillColor = '#a9a9a9';
                                            row[2].color = 'white';
                                        } else if (row[1].text.startsWith('Total')) {
                                            row[0].fillColor = '#cdcdcd';
                                            row[1].fillColor = '#cdcdcd';
                                            row[1].color = '#white';
                                            row[2].fillColor = '#cdcdcd';
                                            row[2].color = '#white';
                                        } else {
                                            if (index > 1) {
                                                row[0].fillColor = '#ffffff';
                                                row[1].fillColor = '#ffffff';
                                                row[2].fillColor = '#ffffff';
                                            }
                                        }
                                    });
                                }
                            }
                        ],
                        columnDefs: [
                            { width: "12%", targets: 0 },
                            { width: "68%", targets: 1 },
                            { width: "20%", targets: 2, className: "text-end" },
                        ],
                        columns: [
                            {
                                "data": "FECTRA",
                            },
                            {
                                "data": "DESCRLRG",
                            },
                            {
                                "data": "WCOS",
                            }],
                        createdRow: function (row, data, dataIndex) {
                            if (
                                typeof data['FECTRA'] === "string" &&
                                data['FECTRA'].startsWith("Impresiones")
                            ) {
                                $("td:eq(0)", row)
                                    .attr("colspan", 3)
                                    .addClass("bg-section fw-bold");
                                $("td:eq(1)", row).css("display", "none");
                                $("td:eq(2)", row).css("display", "none");
                            } else if (
                                typeof data['FECTRA'] === "string" &&
                                data['FECTRA'].startsWith("Total")
                            ) {
                                $("td:eq(0)", row)
                                    .attr("colspan", 2)
                                    .addClass("bg-section2 fw-bold");
                                $("td:eq(1)", row)
                                    .css("display", "none");
                                $("td:eq(2)", row)
                                    .addClass("bg-section2 fw-bold");
                            } else if (
                                typeof data['FECTRA'] === "string" &&
                                data['FECTRA'].startsWith("&nbsp;&nbsp;")
                            ) {
                                $("td:eq(0)", row)
                                    .addClass("bg-light fw-bold");
                                $("td:eq(1)", row)
                                    .addClass("bg-light fw-bold");
                                $("td:eq(2)", row)
                                    .addClass("bg-light fw-bold");
                            }
                        },
                    });
                    charge(table);
                    $("#cbbAno, #cbbMes").on("change", function () {
                        charge(table);
                    });
                    $("input[name='ckTipo']").on("change", function () {
                        charge(table);
                    });
                })
        });
        function charge(table) {
            table.clear().draw();
            fetch("/API.LovablePHP/ZLO0053P/List", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    anopro: $("#cbbAno").val(),
                    mespro: $("#cbbMes").val(),
                    tipo: $("input[name='ckTipo']:checked").val()
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.code !== 200) {
                        console.error("Error al obtener datos de la API");
                        return;
                    }

                    const rows = data.data;
                    const tableData = [];

                    const grouped = {};
                    let totalGeneral = 0;

                    rows.forEach((item) => {
                        const tipo = item.TIPIMP;
                        const cliente = `${item.CODCL1}_${item.CODCL2}_${item.MAENO4}`;

                        if (!grouped[tipo]) grouped[tipo] = {};
                        if (!grouped[tipo][cliente]) grouped[tipo][cliente] = [];

                        grouped[tipo][cliente].push(item);
                    });

                    const tipos = {
                        C: "Impresiones para Distribuidores",
                        T: "Impresiones para Trabajo interno",
                        V: "Impresiones para Vitrina",
                        P: "Impresiones para Prueba",
                        I: "Impresiones para Cambio de imagen",
                        A: "Impresiones para Varios"
                    };

                    Object.keys(grouped).forEach((tipo) => {
                        tableData.push({ FECTRA: tipos[tipo] || `Impresiones para ${tipo}`, DESCRLRG: "", WCOS: "" });

                        let totalTipo = 0;

                        Object.keys(grouped[tipo]).forEach((cliente) => {
                            const [CODCL1, CODCL2, MAENO4] = cliente.split("_");

                            if (MAENO4 != "") {
                                tableData.push({
                                    FECTRA: "&nbsp;&nbsp;",
                                    DESCRLRG: `${MAENO4}`,
                                    WCOS: ""
                                });
                            }

                            let totalCliente = 0;

                            grouped[tipo][cliente].forEach((item) => {
                                tableData.push({
                                    FECTRA: formatFecha(item.FECTRA),
                                    DESCRLRG: item.DESCRLRG,
                                    WCOS: `L. ${parseFloat(item.WCOS).toFixed(2)}`
                                });

                                totalCliente += parseFloat(item.WCOS);
                            });

                            if (MAENO4 != "") {
                                tableData.push({
                                    FECTRA: "&nbsp;&nbsp;",
                                    DESCRLRG: `Total Cliente ${MAENO4}`,
                                    WCOS: `L. ${totalCliente.toFixed(2)}`
                                });
                            }

                            totalTipo += totalCliente;
                        });

                        tableData.push({
                            FECTRA: `Total ${tipos[tipo] || 'Impresiones para ' + tipo}`,
                            DESCRLRG: "",
                            WCOS: `L. ${totalTipo.toFixed(2)}`
                        });

                        totalGeneral += totalTipo;
                    });
                    tableData.push({
                        FECTRA: "Total final",
                        DESCRLRG: "",
                        WCOS: `L. ${totalGeneral.toFixed(2)}`
                    });

                    table.rows.add(tableData).draw();
                });



        }
        function formatFecha(fechaStr) {
            if (fechaStr === '0' || fechaStr === ' ' || fechaStr === '') {
                return ' ';
            }
            fechaStr = fechaStr.padStart(8, '0');

            let año = fechaStr.substring(0, 4);
            let mes = fechaStr.substring(4, 6);
            let dia = fechaStr.substring(6, 8);

            return `${dia}/${mes}/${año}`;
        }
    </script>
</body>

</html>