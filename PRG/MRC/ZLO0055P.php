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
                    <span> Consumo / Notificación </span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0055P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="card mb-5">
            <div class="card-header">
                <h1 class="fs-4 mb-1 mt-2 text-center">Correo electrónico para notificación de orden de producción nueva
                </h1>
            </div>
            <div class="card-body vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-5">
                                    <label for="inputEmailPara" class="form-control border border-0">Para</label>
                                    <input type="email" class="form-control" id="inputEmailPara"
                                        placeholder="Ingrese el correo electrónico">
                                </div>
                                <div class="col-5">
                                    <label for="inputEmailCopia" class="form-control border border-0">Copia</label>
                                    <input type="email" class="form-control" id="inputEmailCopia"
                                        placeholder="Ingrese el correo electrónico">
                                </div>
                                <div class="col-2 d-flex align-items-end">
                                    <button class="btn btn-primary w-100">Agregar</button>
                                </div>
                                <span class="form-control text-danger border border-0" id="errorMessage"></span>
                            </div>
                        </div>
                        <div class="col-12 py-3">
                            <div class="row">
                                <div class="col-5">
                                    <table class="table table-bordered table-striped table-hover mt-3"
                                        id="tableEmailPara">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width:90%">Correo destinatario</th>
                                                <th class="text-center" style="width:10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-5">
                                    <table class="table table-bordered table-striped table-hover mt-3"
                                        id="tableEmailCopia">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width:90%">Correo copia</th>
                                                <th class="text-center" style="width:10%"></th>
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
    <script>
        const tableEmailCopia = document.getElementById('tableEmailCopia').getElementsByTagName('tbody')[0];
        const tableEmailPara = document.getElementById('tableEmailPara').getElementsByTagName('tbody')[0];

        const inputEmailPara = document.getElementById('inputEmailPara');
        const inputEmailCopia = document.getElementById('inputEmailCopia');
        const btnAgregar = document.querySelector('.btn-primary');

        document.addEventListener('DOMContentLoaded', function () {
            chargeTable()

        });

        function chargeTable() {
            fetch('http://172.16.15.20/API.LovablePHP/ZLO0055P/List')
                .then(response => response.json())
                .then(data => {
                    if (data.code == 200) {
                        const dataResponse = data.data;

                        let hayPA = false;
                        let hayCC = false;
                        tableEmailPara.innerHTML = '';
                        tableEmailCopia.innerHTML = '';
                        dataResponse.forEach(item => {
                            if (item.TIPDES == 'PA') {
                                hayPA = true;
                                const newRow = tableEmailPara.insertRow(tableEmailPara.rows.length - 1);
                                newRow.insertCell(0).innerText = item.CORELE;
                                const deleteCell = newRow.insertCell(1);
                                deleteCell.innerHTML = '<button class="btn btn-danger btn-sm text-white"><i class="fa-solid fa-trash"></i></button>';
                                deleteCell.querySelector('button').addEventListener('click', function () {
                                    fetch('http://172.16.15.20/API.LovablePHP/ZLO0055P/Delete', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify({ tipo: item.TIPDES, corele: item.CORELE })
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.code == 200) {
                                                chargeTable()
                                            }

                                        })
                                        .catch(error => console.error('Error deleting data:', error));
                                });
                            }

                            if (item.TIPDES == 'CC') {
                                hayCC = true;
                                const newRow = tableEmailCopia.insertRow(tableEmailCopia.rows.length - 1);
                                newRow.insertCell(0).innerText = item.CORELE;
                                const deleteCell = newRow.insertCell(1);
                                deleteCell.innerHTML = '<button class="btn btn-danger btn-sm text-white"><i class="fa-solid fa-trash"></i></button>';
                                deleteCell.querySelector('button').addEventListener('click', function () {
                                    fetch('http://172.16.15.20/API.LovablePHP/ZLO0055P/Delete', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json'
                                        },
                                        body: JSON.stringify({ tipo: item.TIPDES, corele: item.CORELE })
                                    })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.code == 200) {
                                                chargeTable()
                                            }

                                        })
                                        .catch(error => console.error('Error deleting data:', error));
                                });
                            }
                        });
                        if (!hayPA) {
                            const emptyRow = tableEmailPara.insertRow(0);
                            emptyRow.innerHTML = '<td colspan="2" class="text-center py-3">No hay correos agregados</td>';
                        }
                        if (!hayCC) {
                            const emptyRow = tableEmailCopia.insertRow(0);
                            emptyRow.innerHTML = '<td colspan="2" class="text-center py-3">No hay correos agregados</td>';
                        }

                    } else {
                        tableEmailPara.innerHTML = '<td colspan="2" class="text-center py-3">No hay correos agregados</td>';
                        tableEmailCopia.innerHTML = '<td colspan="2" class="text-center py-3">No hay correos agregados</td>';
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        btnAgregar.addEventListener('click', function () {
            const emailPara = inputEmailPara.value.trim();
            const emailCopia = inputEmailCopia.value.trim();

            if (emailPara == '' && emailCopia == '') {
                document.getElementById('errorMessage').innerText = 'Ingrese al menos un correo electrónico.';
                return;
            } else {
                if (emailPara.includes('@') == false && emailCopia.includes('@') == false) {
                    document.getElementById('errorMessage').innerText = 'Ingrese un correo electrónico válido.';
                    return;
                } else {
                    document.getElementById('errorMessage').innerText = '';
                }
            }


            if (emailPara != '') {
                fetch('http://172.16.15.20/API.LovablePHP/ZLO0055P/Add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        tipo: 'PA',
                        corele: emailPara === '' ? emailCopia : emailPara
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.code == 200) {
                            chargeTable()
                        }
                    })

            }

            if (emailCopia != '') {
                fetch('http://172.16.15.20/API.LovablePHP/ZLO0055P/Add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        tipo: 'CC',
                        corele: emailPara === '' ? emailCopia : emailPara
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.code == 200) {
                            chargeTable()
                        }
                    })
            }
            inputEmailPara.value = '';
            inputEmailCopia.value = '';
        });
    </script>
</body>

</html>