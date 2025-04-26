let table1,
  table2,
  table3,
  table4,
  table5,
  chart1,
  chart2,
  chart3,
  chart4,
  chart5;
let newChart = 0;
document.addEventListener("DOMContentLoaded", () => {
  //TABLA 1
  fetch("/API.LovablePHP/ZLO0054P/List1")
    .then((response) => response.json())
    .then((data) => {
      if (data.code == 200) {
        const ano = data.ano;
        for (let i = 0; i < 5; i++) {
          document.getElementById(`table1lbl${i}`).innerText = ano - i;
        }
        chargeChart1(data.data, ano);
        $("#cbbChart").on("change", function () {
          chargeChart1(data.data, ano);
        });

        table1 = $("#table1").DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: "/API.LovablePHP/ZLO0054P/List1",
            type: "POST",
            contentType: "application/json",
            data: function (d) {
              return JSON.stringify({
                draw: d.draw,
                start: d.start,
                length: d.length,
                order: d.order,
              });
            },
            error: function (xhr, status, error) {
              console.log(error);
              requestError = true;
            },
          },
          ordering: true,
          pageLength: 12,
          dom: "Bt",
          buttons: [
            {
              extend: "excelHtml5",
              text: '<i class="fa-solid fa-file-excel"></i> <b>Enviar a Excel</b>',
              className: "btn btn-success text-light fs-6 my-2",
              title: "ReporteVentasGeneralesFabrica",
              exportOptions: {
                columns: ":visible",
                modifier: {
                  page: "all",
                },
                orthogonal: "export",
              },
              customize: function (xlsx) {
                const sheet = xlsx.xl.worksheets["sheet1.xml"];
                const sSh = xlsx.xl["styles.xml"];
                const parser = new DOMParser();
                const anios = [
                  $("#table1lbl0").text(),
                  $("#table1lbl1").text(),
                  $("#table1lbl2").text(),
                  $("#table1lbl3").text(),
                  $("#table1lbl4").text(),
                ];
                const rows = sheet.getElementsByTagName("row");
                for (let i = rows.length - 1; i >= 0; i--) {
                  const row = rows[i];
                  const oldR = parseInt(row.getAttribute("r"));
                  const newR = oldR + 1;
                  row.setAttribute("r", newR);
                  const cells = row.getElementsByTagName("c");
                  for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    const cellRef = cell.getAttribute("r");
                    if (cellRef) {
                      const col = cellRef.replace(/[0-9]/g, "");
                      cell.setAttribute("r", `${col}${newR}`);
                    }
                  }
                }
                let headerRow1 = '<row r="2">';
                headerRow1 += `<c t="inlineStr" r="A2"><is><t>Lempiras</t></is></c>`;
                let colChar = "B";
                const mergeRanges = [];

                anios.forEach((anio) => {
                  const nextChar = String.fromCharCode(
                    colChar.charCodeAt(0) + 1
                  );
                  headerRow1 += `<c t="inlineStr" r="${colChar}2"><is><t>Año ${anio}</t></is></c>`;
                  mergeRanges.push(`${colChar}2:${nextChar}2`);
                  colChar = String.fromCharCode(colChar.charCodeAt(0) + 2);
                });

                headerRow1 += "</row>";
                const sheetData = sheet.getElementsByTagName("sheetData")[0];
                sheetData.insertAdjacentHTML("afterbegin", headerRow1);

                let mergeCells = sheet.getElementsByTagName("mergeCells")[0];
                if (!mergeCells) {
                  mergeCells = parser.parseFromString(
                    "<mergeCells></mergeCells>",
                    "text/xml"
                  ).documentElement;
                  sheet.insertBefore(mergeCells, sheetData);
                }

                mergeRanges.forEach((range) => {
                  const mergeCell = parser.parseFromString(
                    `<mergeCell ref="${range}"/>`,
                    "text/xml"
                  ).documentElement;
                  mergeCells.appendChild(mergeCell);
                });

                mergeCells.setAttribute("count", mergeRanges.length);

                var tagName = sSh.getElementsByTagName("sz");
                for (i = 0; i < tagName.length; i++) {
                  tagName[i].setAttribute("val", "13");
                }
                $("row:eq(0) c", sheet).attr("s", 7);

                $("row:eq(1) c", sheet).attr("s", 7);
                $("row:eq(2) c", sheet).attr("s", 7);
                $("c[r=A2] t", sheet).text("Lempiras");
                $("c[r=A1] t", sheet).text(
                  "REPORTE DE VENTAS GENERALES LOVABLE DE HONDURAS"
                );
              },
            },
          ],
          columns: [
            {
              data: "MES",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO1 == 0
                  ? " "
                  : parseFloat(row.CANANO1).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO1 == 0
                  ? " "
                  : parseFloat(row.VALANO1).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO2 == 0
                  ? " "
                  : parseFloat(row.CANANO2).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO2 == 0
                  ? " "
                  : parseFloat(row.VALANO2).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO3 == 0
                  ? " "
                  : parseFloat(row.CANANO3).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO3 == 0
                  ? " "
                  : parseFloat(row.VALANO3).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO4 == 0
                  ? " "
                  : parseFloat(row.CANANO4).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO4 == 0
                  ? " "
                  : parseFloat(row.VALANO4).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO5 == 0
                  ? " "
                  : parseFloat(row.CANANO5).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO5 == 0
                  ? " "
                  : parseFloat(row.VALANO5).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
          ],
        });
      }
    })
    .then(() => {
      fetch("/API.LovablePHP/ZLO0054P/GetTotales1")
        .then((response) => response.json())
        .then((data) => {
          if (data.code == 200) {
            const totales = data.data;

            let tr = `<tr class="bg-dark text-white">
                            <td><strong>Totales</strong></td>`;

            totales.forEach((total) => {
              tr += `
                        <td>${parseFloat(total.CANTID).toLocaleString("en-EN", {
                          minimumFractionDigits: 2,
                          maximumFractionDigits: 2,
                        })}</td>
                        <td>${parseFloat(total.VALOR).toLocaleString("en-EN", {
                          minimumFractionDigits: 2,
                          maximumFractionDigits: 2,
                        })}</td>`;
            });

            tr += `</tr>`;
            $("#table1 tfoot").html(tr);
          }
        });
    });
  //TABLA 2
  fetch("/API.LovablePHP/ZLO0054P/List2")
    .then((response) => response.json())
    .then((data) => {
      if (data.code == 200) {
        const ano = data.ano;
        for (let i = 0; i < 5; i++) {
          document.getElementById(`table2lbl${i}`).innerText = ano - i;
        }
        chargeChart2(data.data, ano);
        $("#cbbChart2").on("change", function () {
          chargeChart2(data.data, ano);
        });

        table2 = $("#table2").DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: "/API.LovablePHP/ZLO0054P/List2",
            type: "POST",
            contentType: "application/json",
            data: function (d) {
              return JSON.stringify({
                draw: d.draw,
                start: d.start,
                length: d.length,
                order: d.order,
              });
            },
            error: function (xhr, status, error) {
              console.log(error);
              requestError = true;
            },
          },
          ordering: true,
          pageLength: 12,
          dom: "Bt",
          buttons: [
            {
              extend: "excelHtml5",
              text: '<i class="fa-solid fa-file-excel"></i> <b>Enviar a Excel</b>',
              className: "btn btn-success text-light fs-6 my-2",
              title: "ReporteVentasVendedorFabrica",
              exportOptions: {
                columns: ":visible",
                modifier: {
                  page: "all",
                },
                orthogonal: "export",
              },
              customize: function (xlsx) {
                const sheet = xlsx.xl.worksheets["sheet1.xml"];
                const sSh = xlsx.xl["styles.xml"];
                const parser = new DOMParser();
                const anios = [
                  $("#table1lbl0").text(),
                  $("#table1lbl1").text(),
                  $("#table1lbl2").text(),
                  $("#table1lbl3").text(),
                  $("#table1lbl4").text(),
                ];
                const rows = sheet.getElementsByTagName("row");
                for (let i = rows.length - 1; i >= 0; i--) {
                  const row = rows[i];
                  const oldR = parseInt(row.getAttribute("r"));
                  const newR = oldR + 1;
                  row.setAttribute("r", newR);
                  const cells = row.getElementsByTagName("c");
                  for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    const cellRef = cell.getAttribute("r");
                    if (cellRef) {
                      const col = cellRef.replace(/[0-9]/g, "");
                      cell.setAttribute("r", `${col}${newR}`);
                    }
                  }
                }
                let headerRow1 = '<row r="2">';
                headerRow1 += `<c t="inlineStr" r="B2"><is><t>Lempiras</t></is></c>`;
                let colChar = "C";
                const mergeRanges = [];

                anios.forEach((anio) => {
                  const nextChar = String.fromCharCode(
                    colChar.charCodeAt(0) + 1
                  );
                  headerRow1 += `<c t="inlineStr" r="${colChar}2"><is><t>Año ${anio}</t></is></c>`;
                  mergeRanges.push(`${colChar}2:${nextChar}2`);
                  colChar = String.fromCharCode(colChar.charCodeAt(0) + 2);
                });

                headerRow1 += "</row>";
                const sheetData = sheet.getElementsByTagName("sheetData")[0];
                sheetData.insertAdjacentHTML("afterbegin", headerRow1);

                let mergeCells = sheet.getElementsByTagName("mergeCells")[0];
                if (!mergeCells) {
                  mergeCells = parser.parseFromString(
                    "<mergeCells></mergeCells>",
                    "text/xml"
                  ).documentElement;
                  sheet.insertBefore(mergeCells, sheetData);
                }

                mergeRanges.forEach((range) => {
                  const mergeCell = parser.parseFromString(
                    `<mergeCell ref="${range}"/>`,
                    "text/xml"
                  ).documentElement;
                  mergeCells.appendChild(mergeCell);
                });

                mergeCells.setAttribute("count", mergeRanges.length);

                var tagName = sSh.getElementsByTagName("sz");
                for (i = 0; i < tagName.length; i++) {
                  tagName[i].setAttribute("val", "13");
                }
                $("row:eq(0) c", sheet).attr("s", 7);

                $("row:eq(1) c", sheet).attr("s", 7);
                $("row:eq(2) c", sheet).attr("s", 7);
                $("c[r=A2] t", sheet).text(" ");
                $("c[r=B2] t", sheet).text("Lempiras");
                $("c[r=B1] t", sheet).text(
                  "REPORTE DE VENTAS POR VENDEDOR LOVABLE DE HONDURAS"
                );
              },
            },
          ],
          columns: [
            {
              className: "dt-control",
              orderable: false,
              data: null,
              defaultContent: "",
            },
            {
              data: "MAENO3",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO1 == 0
                  ? " "
                  : parseFloat(row.CANANO1).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO1 == 0
                  ? " "
                  : parseFloat(row.VALANO1).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO2 == 0
                  ? " "
                  : parseFloat(row.CANANO2).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO2 == 0
                  ? " "
                  : parseFloat(row.VALANO2).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO3 == 0
                  ? " "
                  : parseFloat(row.CANANO3).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO3 == 0
                  ? " "
                  : parseFloat(row.VALANO3).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO4 == 0
                  ? " "
                  : parseFloat(row.CANANO4).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO4 == 0
                  ? " "
                  : parseFloat(row.VALANO4).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO5 == 0
                  ? " "
                  : parseFloat(row.CANANO5).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO5 == 0
                  ? " "
                  : parseFloat(row.VALANO5).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
          ],
        });

        table2.on("click", "td.dt-control", function (e) {
          newChart++;
          let tr = e.target.closest("tr");
          let row = table2.row(tr);
          if (row.child.isShown()) {
            row.child.hide();
          } else {
            const dataRow = row.data();
            row.child(format1(dataRow.DETALLE)).show();
            chargeChartTemp1(dataRow.DETALLE, ano, dataRow.MAENO3);
            const selectChart = $("#cbbChartTemp1" + newChart);
            selectChart.on("change", function () {
              chargeChartTemp1(dataRow.DETALLE, ano, dataRow.MAENO3);
            });
            const childRow = tr.nextElementSibling;
            //childRow.querySelector('td').classList.add('p-0', 'm-0');
          }
        });
      }
    })
    .then(() => {
      fetch("/API.LovablePHP/ZLO0054P/GetTotales2")
        .then((response) => response.json())
        .then((data) => {
          if (data.code == 200) {
            const totales = data.data;

            let tr = `<tr class="bg-dark text-white">
                            <td colspan="2"><strong>Totales</strong></td>`;

            totales.forEach((total) => {
              tr += `
                        <td>${parseFloat(total.CANTID).toLocaleString("en-EN", {
                          minimumFractionDigits: 2,
                          maximumFractionDigits: 2,
                        })}</td>
                        <td>${parseFloat(total.VALOR).toLocaleString("en-EN", {
                          minimumFractionDigits: 2,
                          maximumFractionDigits: 2,
                        })}</td>`;
            });

            tr += `</tr>`;
            $("#table2 tfoot").html(tr);
          }
        });
    });
  //TABLA 3
  fetch("/API.LovablePHP/ZLO0054P/GetChartData")
    .then((response) => response.json())
    .then((data) => {
      if (data.code == 200) {
        const ano = data.ano;
        for (let i = 0; i < 5; i++) {
          document.getElementById(`table3lbl${i}`).innerText = ano - i;
        }
        chargeChart3(data.data, ano);
        $("#cbbChart3").on("change", function () {
          chargeChart3(data.data, ano);
        });

        table3 = $("#table3").DataTable({
          language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
          },
          processing: true,
          serverSide: true,
          ajax: {
            url: "/API.LovablePHP/ZLO0054P/List3",
            type: "POST",
            contentType: "application/json",
            data: function (d) {
              return JSON.stringify({
                draw: d.draw,
                start: d.start,
                length: d.length,
                order: d.order,
              });
            },
            error: function (xhr, status, error) {
              console.log(error);
              requestError = true;
            },
            complete: function (xhr, status) {
              const dataResp = xhr.responseJSON.data;
              const ano = xhr.responseJSON.ano;
              for (let i = 0; i < 5; i++) {
                document.getElementById(`table3lbl${i}`).innerText = ano - i;
              }
            },
          },
          ordering: true,
          pageLength: 50,
          dom: "Brtip",
          buttons: [
            {
              extend: "excelHtml5",
              text: '<i class="fa-solid fa-file-excel"></i> <b>Enviar a Excel</b>',
              className: "btn btn-success text-light fs-6 my-2",
              title: "ReporteVentasFabrica",
              exportOptions: {
                columns: ":visible",
                modifier: {
                  page: "all",
                },
                orthogonal: "export",
              },
              action: function (e, dt, button, config) {
                document
                  .getElementById("loaderExcel")
                  .classList.remove("d-none");
                const checkbox = document.getElementById("ck1");
                const value = checkbox.checked ? 1 : 0;

                fetch("/API.LovablePHP/ZLO0054P/ExportExcel1/", {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json",
                  },
                  body: JSON.stringify({
                    check: value,
                  }),
                })
                  .then((response) => {
                    if (!response.ok) {
                      throw new Error("Network response was not ok");
                    }
                    return response;
                  })
                  .then((response) => response.blob())
                  .then((blob) => {
                    var tempUrl = window.URL.createObjectURL(blob);
                    var a = document.createElement("a");
                    a.href = tempUrl;
                    a.download = `ReporteVentasClientes.xlsx`;
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(tempUrl);
                    a.remove();
                    document
                      .getElementById("loaderExcel")
                      .classList.add("d-none");
                  })
                  .catch((error) => {
                    console.error(
                      "Hubo un problema con la petición Fetch:",
                      error
                    );
                  });
              },
            },
          ],
          columns: [
            {
              className: "dt-control",
              orderable: false,
              data: null,
              defaultContent: "",
            },
            {
              data: "MAENO4",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO1 == 0
                  ? " "
                  : parseFloat(row.CANANO1).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO1 == 0
                  ? " "
                  : parseFloat(row.VALANO1).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO2 == 0
                  ? " "
                  : parseFloat(row.CANANO2).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO2 == 0
                  ? " "
                  : parseFloat(row.VALANO2).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO3 == 0
                  ? " "
                  : parseFloat(row.CANANO3).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO3 == 0
                  ? " "
                  : parseFloat(row.VALANO3).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO4 == 0
                  ? " "
                  : parseFloat(row.CANANO4).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO4 == 0
                  ? " "
                  : parseFloat(row.VALANO4).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO5 == 0
                  ? " "
                  : parseFloat(row.CANANO5).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO5 == 0
                  ? " "
                  : parseFloat(row.VALANO5).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
          ],
        });
        table3.on("click", "td.dt-control", function (e) {
          newChart++;
          let tr = e.target.closest("tr");
          let row = table3.row(tr);
          if (row.child.isShown()) {
            row.child.hide();
          } else {
            const dataRow = row.data();
            row.child(format2(dataRow.DETALLE)).show();
            chargeChartTemp2(dataRow.DETALLE, ano, dataRow.MAENO4);
            const selectChart = $("#cbbChartTemp2" + newChart);
            selectChart.on("change", function () {
              chargeChartTemp2(dataRow.DETALLE, ano, dataRow.MAENO4);
            });
            const childRow = tr.nextElementSibling;
          }
        });
        table3.on("init.dt", function () {
          const checkboxHTML = `<div class="form-check d-inline-block ms-3 align-middle">
                                  <input class="form-check-input" type="checkbox" value="" id="ck1">
                                  <label class="form-check-label" for="ck1">
                                    Exportar con detalles
                                  </label>
                                </div>`;
          $("#table3_wrapper .dt-buttons").append(checkboxHTML);
        });

        chargeChart5(data.data, ano);
        $("#cbbChart5").on("change", function () {
          chargeChart5(data.data, ano);
        });
      }
    })
    .then(() => {
      fetch("/API.LovablePHP/ZLO0054P/GetTotales3")
        .then((response) => response.json())
        .then((data) => {
          if (data.code == 200) {
            const totales = data.data;

            let tr = `<tr class="bg-dark text-white">
                            <td colspan="2"><strong>Totales</strong></td>`;

            totales.forEach((total) => {
              tr += `
                        <td>${parseFloat(total.CANTID).toLocaleString("en-EN", {
                          minimumFractionDigits: 2,
                          maximumFractionDigits: 2,
                        })}</td>
                        <td>${parseFloat(total.VALOR).toLocaleString("en-EN", {
                          minimumFractionDigits: 2,
                          maximumFractionDigits: 2,
                        })}</td>`;
            });

            tr += `</tr>`;
            $("#table3 tfoot").html(tr);
            $("#table5 tfoot").html(tr);
          }
        });
    });
  //TABLA 4
  fetch("/API.LovablePHP/ZLO0054P/List4")
    .then((response) => response.json())
    .then((data) => {
      if (data.code == 200) {
        const ano = data.ano;
        for (let i = 0; i < 5; i++) {
          document.getElementById(`table4lbl${i}`).innerText = ano - i;
        }
        chargeChart4(data.data, ano);
        $("#cbbChart4").on("change", function () {
          chargeChart4(data.data, ano);
        });

        table4 = $("#table4").DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: "/API.LovablePHP/ZLO0054P/List4",
            type: "POST",
            contentType: "application/json",
            data: function (d) {
              return JSON.stringify({
                draw: d.draw,
                start: d.start,
                length: d.length,
                order: d.order,
              });
            },
            error: function (xhr, status, error) {
              console.log(error);
              requestError = true;
            },
          },
          ordering: true,
          pageLength: 12,
          dom: "Bt",
          buttons: [
            {
              extend: "excelHtml5",
              text: '<i class="fa-solid fa-file-excel"></i> <b>Enviar a Excel</b>',
              className: "btn btn-success text-light fs-6 my-2",
              title: "ReporteVentasPaisFabrica",
              exportOptions: {
                columns: ":visible",
                modifier: {
                  page: "all",
                },
                orthogonal: "export",
              },
              customize: function (xlsx) {
                const sheet = xlsx.xl.worksheets["sheet1.xml"];
                const sSh = xlsx.xl["styles.xml"];
                const parser = new DOMParser();
                const anios = [
                  $("#table1lbl0").text(),
                  $("#table1lbl1").text(),
                  $("#table1lbl2").text(),
                  $("#table1lbl3").text(),
                  $("#table1lbl4").text(),
                ];
                const rows = sheet.getElementsByTagName("row");
                for (let i = rows.length - 1; i >= 0; i--) {
                  const row = rows[i];
                  const oldR = parseInt(row.getAttribute("r"));
                  const newR = oldR + 1;
                  row.setAttribute("r", newR);
                  const cells = row.getElementsByTagName("c");
                  for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    const cellRef = cell.getAttribute("r");
                    if (cellRef) {
                      const col = cellRef.replace(/[0-9]/g, "");
                      cell.setAttribute("r", `${col}${newR}`);
                    }
                  }
                }
                let headerRow1 = '<row r="2">';
                headerRow1 += `<c t="inlineStr" r="B2"><is><t>Lempiras</t></is></c>`;
                let colChar = "C";
                const mergeRanges = [];

                anios.forEach((anio) => {
                  const nextChar = String.fromCharCode(
                    colChar.charCodeAt(0) + 1
                  );
                  headerRow1 += `<c t="inlineStr" r="${colChar}2"><is><t>Año ${anio}</t></is></c>`;
                  mergeRanges.push(`${colChar}2:${nextChar}2`);
                  colChar = String.fromCharCode(colChar.charCodeAt(0) + 2);
                });

                headerRow1 += "</row>";
                const sheetData = sheet.getElementsByTagName("sheetData")[0];
                sheetData.insertAdjacentHTML("afterbegin", headerRow1);

                let mergeCells = sheet.getElementsByTagName("mergeCells")[0];
                if (!mergeCells) {
                  mergeCells = parser.parseFromString(
                    "<mergeCells></mergeCells>",
                    "text/xml"
                  ).documentElement;
                  sheet.insertBefore(mergeCells, sheetData);
                }

                mergeRanges.forEach((range) => {
                  const mergeCell = parser.parseFromString(
                    `<mergeCell ref="${range}"/>`,
                    "text/xml"
                  ).documentElement;
                  mergeCells.appendChild(mergeCell);
                });

                mergeCells.setAttribute("count", mergeRanges.length);
                var tagName = sSh.getElementsByTagName("sz");
                for (i = 0; i < tagName.length; i++) {
                  tagName[i].setAttribute("val", "13");
                }
                $("row:eq(0) c", sheet).attr("s", 7);

                $("row:eq(1) c", sheet).attr("s", 7);
                $("row:eq(2) c", sheet).attr("s", 7);
                $("c[r=A2] t", sheet).text(" ");
                $("c[r=B2] t", sheet).text("Lempiras");
                $("c[r=B1] t", sheet).text(
                  "REPORTE DE VENTAS POR PAÍS LOVABLE DE HONDURAS"
                );
              },
            },
          ],
          columns: [
            {
              className: "dt-control",
              orderable: false,
              data: null,
              defaultContent: "",
            },
            {
              data: "PAIDES",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO1 == 0
                  ? " "
                  : parseFloat(row.CANANO1).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO1 == 0
                  ? " "
                  : parseFloat(row.VALANO1).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO2 == 0
                  ? " "
                  : parseFloat(row.CANANO2).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO2 == 0
                  ? " "
                  : parseFloat(row.VALANO2).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO3 == 0
                  ? " "
                  : parseFloat(row.CANANO3).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO3 == 0
                  ? " "
                  : parseFloat(row.VALANO3).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO4 == 0
                  ? " "
                  : parseFloat(row.CANANO4).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO4 == 0
                  ? " "
                  : parseFloat(row.VALANO4).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO5 == 0
                  ? " "
                  : parseFloat(row.CANANO5).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO5 == 0
                  ? " "
                  : parseFloat(row.VALANO5).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
          ],
        });

        table4.on("click", "td.dt-control", function (e) {
          newChart++;
          let tr = e.target.closest("tr");
          let row = table4.row(tr);
          if (row.child.isShown()) {
            row.child.hide();
          } else {
            const dataRow = row.data();
            row.child(format3(dataRow.DETALLE)).show();
            chargeChartTemp3(dataRow.DETALLE, ano, dataRow.PAIDES);
            const selectChart = $("#cbbChartTemp3" + newChart);
            selectChart.on("change", function () {
              chargeChartTemp3(dataRow.DETALLE, ano, dataRow.PAIDES);
            });
            const childRow = tr.nextElementSibling;
            //childRow.querySelector('td').classList.add('p-0', 'm-0');
          }
        });
      }
    })
    .then(() => {
      fetch("/API.LovablePHP/ZLO0054P/GetTotales3")
        .then((response) => response.json())
        .then((data) => {
          if (data.code == 200) {
            const totales = data.data;

            let tr = `<tr class="bg-dark text-white">
                            <td colspan="2"><strong>Totales</strong></td>`;

            totales.forEach((total) => {
              tr += `
                        <td>${parseFloat(total.CANTID).toLocaleString("en-EN", {
                          minimumFractionDigits: 2,
                          maximumFractionDigits: 2,
                        })}</td>
                        <td>${parseFloat(total.VALOR).toLocaleString("en-EN", {
                          minimumFractionDigits: 2,
                          maximumFractionDigits: 2,
                        })}</td>`;
            });

            tr += `</tr>`;
            $("#table4 tfoot").html(tr);
          }
        });
    });
  //TABLA 5
  fetch("/API.LovablePHP/ZLO0054P/List5")
    .then((response) => response.json())
    .then((data) => {
      if (data.code == 200) {
        const ano = data.ano;
        for (let i = 0; i < 5; i++) {
          document.getElementById(`table5lbl${i}`).innerText = ano - i;
        }
        table5 = $("#table5").DataTable({
          language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
          },
          processing: true,
          serverSide: true,
          ajax: {
            url: "/API.LovablePHP/ZLO0054P/List5",
            type: "POST",
            contentType: "application/json",
            data: function (d) {
              return JSON.stringify({
                draw: d.draw,
                start: d.start,
                length: d.length,
                order: d.order,
              });
            },
            error: function (xhr, status, error) {
              console.log(error);
              requestError = true;
            },
            complete: function (xhr, status) {
              const dataResp = xhr.responseJSON.data;
              const ano = xhr.responseJSON.ano;
              for (let i = 0; i < 5; i++) {
                document.getElementById(`table5lbl${i}`).innerText = ano - i;
              }
            },
          },
          ordering: true,
          pageLength: 50,
          dom: "Brtip",
          buttons: [
            {
              extend: "excelHtml5",
              text: '<i class="fa-solid fa-file-excel"></i> <b>Enviar a Excel</b>',
              className: "btn btn-success text-light fs-6 my-2",
              title: "ReporteVentasFabrica",
              exportOptions: {
                columns: ":visible",
                modifier: {
                  page: "all",
                },
                orthogonal: "export",
              },
              action: function (e, dt, button, config) {
                document
                  .getElementById("loaderExcel")
                  .classList.remove("d-none");
                const checkbox = document.getElementById("ck2");
                const value = checkbox.checked ? 1 : 0;

                fetch("/API.LovablePHP/ZLO0054P/ExportExcel2/", {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json",
                  },
                  body: JSON.stringify({
                    check: value,
                  }),
                })
                  .then((response) => {
                    if (!response.ok) {
                      throw new Error("Network response was not ok");
                    }
                    return response;
                  })
                  .then((response) => response.blob())
                  .then((blob) => {
                    var tempUrl = window.URL.createObjectURL(blob);
                    var a = document.createElement("a");
                    a.href = tempUrl;
                    a.download = `ReporteVentasCiudad.xlsx`;
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(tempUrl);
                    a.remove();
                    document
                      .getElementById("loaderExcel")
                      .classList.add("d-none");
                  })
                  .catch((error) => {
                    console.error(
                      "Hubo un problema con la petición Fetch:",
                      error
                    );
                  });
              },
            },
          ],
          columns: [
            {
              className: "dt-control",
              orderable: false,
              data: null,
              defaultContent: "",
            },
            {
              data: "CIUDES",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO1 == 0
                  ? " "
                  : parseFloat(row.CANANO1).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO1 == 0
                  ? " "
                  : parseFloat(row.VALANO1).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO2 == 0
                  ? " "
                  : parseFloat(row.CANANO2).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO2 == 0
                  ? " "
                  : parseFloat(row.VALANO2).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO3 == 0
                  ? " "
                  : parseFloat(row.CANANO3).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO3 == 0
                  ? " "
                  : parseFloat(row.VALANO3).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO4 == 0
                  ? " "
                  : parseFloat(row.CANANO4).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO4 == 0
                  ? " "
                  : parseFloat(row.VALANO4).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.CANANO5 == 0
                  ? " "
                  : parseFloat(row.CANANO5).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
            {
              data: null,
              render: function (data, type, row) {
                return row.VALANO5 == 0
                  ? " "
                  : parseFloat(row.VALANO5).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    });
              },
              className: "text-end bg-light",
            },
          ],
        });
        table5.on("click", "td.dt-control", function (e) {
          newChart++;
          let tr = e.target.closest("tr");
          let row = table5.row(tr);
          if (row.child.isShown()) {
            row.child.hide();
          } else {
            const dataRow = row.data();
            row.child(format4(dataRow.DETALLE)).show();
            chargeChartTemp4(dataRow.DETALLE, ano, dataRow.CIUDES);
            const selectChart = $("#cbbChartTemp4" + newChart);
            selectChart.on("change", function () {
              chargeChartTemp4(dataRow.DETALLE, ano, dataRow.CIUDES);
            });
            const childRow = tr.nextElementSibling;
            //childRow.querySelector('td').classList.add('p-0', 'm-0');
          }
        });
        table5.on("init.dt", function () {
          const checkboxHTML = `<div class="form-check d-inline-block ms-3 align-middle">
                                  <input class="form-check-input" type="checkbox" value="" id="ck2">
                                  <label class="form-check-label" for="ck2">
                                    Exportar con detalles
                                  </label>
                                </div>`;
          $("#table5_wrapper .dt-buttons").append(checkboxHTML);
        });
      }
    })
    .then(() => {
      fetch("/API.LovablePHP/ZLO0054P/GetTotales3")
        .then((response) => response.json())
        .then((data) => {
          if (data.code == 200) {
            const totales = data.data;

            let tr = `<tr class="bg-dark text-white">
                        <td colspan="2"><strong>Totales</strong></td>`;

            totales.forEach((total) => {
              tr += `
                    <td>${parseFloat(total.CANTID).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    })}</td>
                    <td>${parseFloat(total.VALOR).toLocaleString("en-EN", {
                      minimumFractionDigits: 2,
                      maximumFractionDigits: 2,
                    })}</td>`;
            });

            tr += `</tr>`;
            $("#table4 tfoot").html(tr);
          }
        });
    });
});
function chargeChart1(data, ano) {
  const data1 = [],
    data2 = [],
    data3 = [],
    data4 = [],
    data5 = [];
  let tipo = "";
  const valChart = $("#cbbChart").val();
  if (valChart == 1) {
    tipo = "Valores";
    data.forEach((dataRow) => {
      data1.push(parseFloat(dataRow.VALANO1));
      data2.push(parseFloat(dataRow.VALANO2));
      data3.push(parseFloat(dataRow.VALANO3));
      data4.push(parseFloat(dataRow.VALANO4));
      data5.push(parseFloat(dataRow.VALANO5));
    });
  } else {
    tipo = "Docenas";
    data.forEach((dataRow) => {
      data1.push(parseFloat(dataRow.CANANO1));
      data2.push(parseFloat(dataRow.CANANO2));
      data3.push(parseFloat(dataRow.CANANO3));
      data4.push(parseFloat(dataRow.CANANO4));
      data5.push(parseFloat(dataRow.CANANO5));
    });
  }
  chart1 = Highcharts.chart("container", {
    chart: {
      type: "line",
      height: 500,
      style: {
        color: "#FFFFFF",
      },
    },
    lang: {
      viewFullscreen: "Ver en pantalla completa",
      exitFullscreen: "Salir de pantalla completa",
      downloadJPEG: "Descargar imagen JPEG",
      downloadPDF: "Descargar en PDF",
    },
    title: {
      text: `Ventas generales, histórico de ${tipo} por Año`,
      align: "center",
      style: {
        color: "#FFFFFF",
      },
    },
    xAxis: {
      categories: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
      ],
      labels: {
        style: {
          color: "#FFFFFF",
        },
      },
    },
    yAxis: {
      title: {
        text: " ",
        style: {
          color: "#FFFFFF",
        },
      },
      labels: {
        style: {
          color: "#FFFFFF",
        },
      },
    },
    legend: {
      itemStyle: {
        color: "#FFFFFF",
      },
    },
    tooltip: {
      style: {
        color: "#FFFFFF",
      },
      backgroundColor: "#000000",
      borderColor: "#FFFFFF",
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true,
          formatter: function () {
            return this.y.toLocaleString("es-ES").replace(".", ",");
          },
          style: {
            color: "#FFFFFF",
            fontWeight: "bold",
          },
        },
        enableMouseTracking: true,
      },
      series: {
        lineWidth: 4,
        states: {
          hover: {
            enabled: true,
            lineWidth: 4,
          },
        },
      },
    },
    credits: {
      enabled: false,
    },
    exporting: {
      buttons: {
        contextButton: {
          menuItems: [
            "viewFullscreen",
            "separator",
            "downloadJPEG",
            "downloadPDF",
          ],
          theme: {
            fill: "#000000",
            stroke: "#FFFFFF",
            style: {
              color: "#FFFFFF",
            },
          },
        },
        showAllButton: {
          text: "Mostrar todos",
          onclick: function () {
            this.series.forEach(function (series) {
              series.setVisible(true, false);
            });
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: {
              color: "#FFFFFF",
            },
          },
        },
        removeAllButton: {
          text: "Quitar todos",
          onclick: function () {
            this.series.forEach(function (series) {
              series.setVisible(false, false);
            });
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: {
              color: "#FFFFFF",
            },
          },
        },
      },
      enabled: true,
      sourceWidth: 1600,
      sourceHeight: 700,
      chartOptions: {
        chart: {
          backgroundColor: "#303030",
        },
      },
      fallbackToExportServer: false,
    },
    series: [
      {
        name: `${tipo} Año ` + ano,
        data: data1,
      },
      {
        name: `${tipo} Año ` + (ano - 1),
        data: data2,
      },
      {
        name: `${tipo} Año ` + (ano - 2),
        data: data3,
      },
      {
        name: `${tipo} Año ` + (ano - 3),
        data: data4,
      },
      {
        name: `${tipo} Año ` + (ano - 4),
        data: data5,
      },
    ],
  });
}
function chargeChart2(data, ano) {
  const valChart = $("#cbbChart2").val();
  const tipo = valChart == 1 ? "VALANO" : "CANANO";
  const tipoLabel = valChart == 1 ? "Valores" : "Docenas";

  const categorias = [
    `${ano}`,
    `${ano - 1}`,
    `${ano - 2}`,
    `${ano - 3}`,
    `${ano - 4}`,
  ];

  const series = data.map((item) => {
    return {
      name: item.MAENO3,
      data: [
        parseFloat(item[`${tipo}1`] || 0),
        parseFloat(item[`${tipo}2`] || 0),
        parseFloat(item[`${tipo}3`] || 0),
        parseFloat(item[`${tipo}4`] || 0),
        parseFloat(item[`${tipo}5`] || 0),
      ],
    };
  });

  Highcharts.chart("container2", {
    chart: {
      type: "line",
      height: 500,
      style: { color: "#FFFFFF" },
    },
    title: {
      text: `Ventas por vendedor, histórico de ${tipoLabel} por Año`,
      style: { color: "#FFFFFF" },
    },
    xAxis: {
      categories: categorias,
      title: { text: "Año", style: { color: "#FFFFFF" } },
      labels: { style: { color: "#FFFFFF" } },
    },
    yAxis: {
      title: { text: tipoLabel, style: { color: "#FFFFFF" } },
      labels: { style: { color: "#FFFFFF" } },
    },
    legend: { itemStyle: { color: "#FFFFFF" } },
    tooltip: {
      shared: true,
      style: { color: "#FFFFFF" },
      backgroundColor: "#000",
      borderColor: "#FFF",
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true,
          formatter() {
            return this.y.toLocaleString("es-ES").replace(".", ",");
          },
          style: { color: "#FFFFFF", fontWeight: "bold" },
        },
        enableMouseTracking: true,
      },
      series: {
        lineWidth: 4,
        states: {
          hover: { enabled: true, lineWidth: 4 },
        },
      },
    },
    credits: { enabled: false },
    exporting: {
      enabled: true,
      buttons: {
        contextButton: {
          menuItems: [
            "viewFullscreen",
            "separator",
            "downloadJPEG",
            "downloadPDF",
          ],
          theme: { fill: "#000", stroke: "#FFF", style: { color: "#FFF" } },
        },
        showAllButton: {
          text: "Mostrar todos",
          onclick() {
            this.series.forEach((s) => s.setVisible(true, false));
            this.redraw();
          },
          theme: { fill: "#000", stroke: "silver", style: { color: "#FFF" } },
        },
        removeAllButton: {
          text: "Quitar todos",
          onclick() {
            this.series.forEach((s) => s.setVisible(false, false));
            this.redraw();
          },
          theme: { fill: "#000", stroke: "silver", style: { color: "#FFF" } },
        },
      },
      sourceWidth: 1600,
      sourceHeight: 700,
      chartOptions: {
        chart: { backgroundColor: "#303030" },
      },
      fallbackToExportServer: false,
    },
    series: series,
  });
}
function chargeChart3(data) {
  const tipo = $("#cbbChart3").val() == 1 ? "Valores" : "Docenas";
  const meses = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
  ];

  // Agrupar por año
  const grouped = {};
  data.forEach((d) => {
    const anio = d.ANOPRO;
    const mes = parseInt(d.MESPRO);
    const valor =
      tipo === "Valores" ? parseFloat(d.VALOR) : parseFloat(d.CANTID);

    if (!grouped[anio]) {
      grouped[anio] = Array(12).fill(0);
    }
    grouped[anio][mes - 1] = valor;
  });

  const series = Object.entries(grouped).map(([anio, valores]) => ({
    name: `${tipo} Año ${anio}`,
    data: valores,
  }));

  Highcharts.chart("container3", {
    chart: {
      type: "line",
      height: 500,
      style: { color: "#FFFFFF" },
    },
    lang: {
      viewFullscreen: "Ver en pantalla completa",
      exitFullscreen: "Salir de pantalla completa",
      downloadJPEG: "Descargar imagen JPEG",
      downloadPDF: "Descargar en PDF",
    },
    title: {
      text: `Ventas por cliente, histórico de ${tipo} por Año`,
      align: "center",
      style: { color: "#FFFFFF" },
    },
    xAxis: {
      categories: meses,
      labels: { style: { color: "#FFFFFF" } },
    },
    yAxis: {
      title: { text: "", style: { color: "#FFFFFF" } },
      labels: { style: { color: "#FFFFFF" } },
    },
    legend: { itemStyle: { color: "#FFFFFF" } },
    tooltip: {
      style: { color: "#FFFFFF" },
      backgroundColor: "#000000",
      borderColor: "#FFFFFF",
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true,
          formatter: function () {
            return this.y.toLocaleString("es-ES").replace(".", ",");
          },
          style: { color: "#FFFFFF", fontWeight: "bold" },
        },
        enableMouseTracking: true,
      },
      series: {
        lineWidth: 4,
        states: {
          hover: { enabled: true, lineWidth: 4 },
        },
      },
    },
    credits: { enabled: false },
    exporting: {
      buttons: {
        contextButton: {
          menuItems: [
            "viewFullscreen",
            "separator",
            "downloadJPEG",
            "downloadPDF",
          ],
          theme: {
            fill: "#000000",
            stroke: "#FFFFFF",
            style: { color: "#FFFFFF" },
          },
        },
        showAllButton: {
          text: "Mostrar todos",
          onclick: function () {
            this.series.forEach((s) => s.setVisible(true, false));
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: { color: "#FFFFFF" },
          },
        },
        removeAllButton: {
          text: "Quitar todos",
          onclick: function () {
            this.series.forEach((s) => s.setVisible(false, false));
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: { color: "#FFFFFF" },
          },
        },
      },
      enabled: true,
      sourceWidth: 1600,
      sourceHeight: 700,
      chartOptions: {
        chart: { backgroundColor: "#303030" },
      },
      fallbackToExportServer: false,
    },
    series: series,
  });
}
function chargeChart4(data, ano) {
  const valChart = $("#cbbChart4").val();
  const tipo = valChart == 1 ? "VALANO" : "CANANO";
  const tipoLabel = valChart == 1 ? "Valores" : "Docenas";

  const categorias = [
    `${ano}`,
    `${ano - 1}`,
    `${ano - 2}`,
    `${ano - 3}`,
    `${ano - 4}`,
  ];

  const series = data.map((item) => {
    return {
      name: item.PAIDES,
      data: [
        parseFloat(item[`${tipo}1`] || 0),
        parseFloat(item[`${tipo}2`] || 0),
        parseFloat(item[`${tipo}3`] || 0),
        parseFloat(item[`${tipo}4`] || 0),
        parseFloat(item[`${tipo}5`] || 0),
      ],
    };
  });

  Highcharts.chart("container4", {
    chart: {
      type: "line",
      height: 500,
      style: { color: "#FFFFFF" },
    },
    title: {
      text: `Ventas por país, histórico de ${tipoLabel} por Año`,
      style: { color: "#FFFFFF" },
    },
    xAxis: {
      categories: categorias,
      title: { text: "Año", style: { color: "#FFFFFF" } },
      labels: { style: { color: "#FFFFFF" } },
    },
    yAxis: {
      title: { text: tipoLabel, style: { color: "#FFFFFF" } },
      labels: { style: { color: "#FFFFFF" } },
    },
    legend: { itemStyle: { color: "#FFFFFF" } },
    tooltip: {
      shared: true,
      style: { color: "#FFFFFF" },
      backgroundColor: "#000",
      borderColor: "#FFF",
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true,
          formatter() {
            return this.y.toLocaleString("es-ES").replace(".", ",");
          },
          style: { color: "#FFFFFF", fontWeight: "bold" },
        },
        enableMouseTracking: true,
      },
      series: {
        lineWidth: 4,
        states: {
          hover: { enabled: true, lineWidth: 4 },
        },
      },
    },
    credits: { enabled: false },
    exporting: {
      enabled: true,
      buttons: {
        contextButton: {
          menuItems: [
            "viewFullscreen",
            "separator",
            "downloadJPEG",
            "downloadPDF",
          ],
          theme: { fill: "#000", stroke: "#FFF", style: { color: "#FFF" } },
        },
        showAllButton: {
          text: "Mostrar todos",
          onclick() {
            this.series.forEach((s) => s.setVisible(true, false));
            this.redraw();
          },
          theme: { fill: "#000", stroke: "silver", style: { color: "#FFF" } },
        },
        removeAllButton: {
          text: "Quitar todos",
          onclick() {
            this.series.forEach((s) => s.setVisible(false, false));
            this.redraw();
          },
          theme: { fill: "#000", stroke: "silver", style: { color: "#FFF" } },
        },
      },
      sourceWidth: 1600,
      sourceHeight: 700,
      chartOptions: {
        chart: { backgroundColor: "#303030" },
      },
      fallbackToExportServer: false,
    },
    series: series,
  });
}
function chargeChart5(data) {
  const tipo = $("#cbbChart5").val() == 1 ? "Valores" : "Docenas";
  const meses = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
  ];

  // Agrupar por año
  const grouped = {};
  data.forEach((d) => {
    const anio = d.ANOPRO;
    const mes = parseInt(d.MESPRO);
    const valor =
      tipo === "Valores" ? parseFloat(d.VALOR) : parseFloat(d.CANTID);

    if (!grouped[anio]) {
      grouped[anio] = Array(12).fill(0);
    }
    grouped[anio][mes - 1] = valor;
  });

  const series = Object.entries(grouped).map(([anio, valores]) => ({
    name: `${tipo} Año ${anio}`,
    data: valores,
  }));

  Highcharts.chart("container5", {
    chart: {
      type: "line",
      height: 500,
      style: { color: "#FFFFFF" },
    },
    lang: {
      viewFullscreen: "Ver en pantalla completa",
      exitFullscreen: "Salir de pantalla completa",
      downloadJPEG: "Descargar imagen JPEG",
      downloadPDF: "Descargar en PDF",
    },
    title: {
      text: `Ventas por ciudad, histórico de ${tipo} por Año`,
      align: "center",
      style: { color: "#FFFFFF" },
    },
    xAxis: {
      categories: meses,
      labels: { style: { color: "#FFFFFF" } },
    },
    yAxis: {
      title: { text: "", style: { color: "#FFFFFF" } },
      labels: { style: { color: "#FFFFFF" } },
    },
    legend: { itemStyle: { color: "#FFFFFF" } },
    tooltip: {
      style: { color: "#FFFFFF" },
      backgroundColor: "#000000",
      borderColor: "#FFFFFF",
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true,
          formatter: function () {
            return this.y.toLocaleString("es-ES").replace(".", ",");
          },
          style: { color: "#FFFFFF", fontWeight: "bold" },
        },
        enableMouseTracking: true,
      },
      series: {
        lineWidth: 4,
        states: {
          hover: { enabled: true, lineWidth: 4 },
        },
      },
    },
    credits: { enabled: false },
    exporting: {
      buttons: {
        contextButton: {
          menuItems: [
            "viewFullscreen",
            "separator",
            "downloadJPEG",
            "downloadPDF",
          ],
          theme: {
            fill: "#000000",
            stroke: "#FFFFFF",
            style: { color: "#FFFFFF" },
          },
        },
        showAllButton: {
          text: "Mostrar todos",
          onclick: function () {
            this.series.forEach((s) => s.setVisible(true, false));
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: { color: "#FFFFFF" },
          },
        },
        removeAllButton: {
          text: "Quitar todos",
          onclick: function () {
            this.series.forEach((s) => s.setVisible(false, false));
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: { color: "#FFFFFF" },
          },
        },
      },
      enabled: true,
      sourceWidth: 1600,
      sourceHeight: 700,
      chartOptions: {
        chart: { backgroundColor: "#303030" },
      },
      fallbackToExportServer: false,
    },
    series: series,
  });
}

function format1(d) {
  const data = d;
  let rows = "";

  data.forEach((row) => {
    rows += `<tr>`;
    rows += `<td></td>`;
    rows += `<td>${row.MES}</td>`;
    rows += `<td class="text-end bg-light">${
      row.CANANO1 == "0"
        ? ""
        : parseFloat(row.CANANO1).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.VALANO1 == "0"
        ? ""
        : parseFloat(row.VALANO1).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end ">${
      row.CANANO2 == "0"
        ? ""
        : parseFloat(row.CANANO2).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end ">${
      row.VALANO2 == "0"
        ? ""
        : parseFloat(row.VALANO2).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.CANANO3 == "0"
        ? ""
        : parseFloat(row.CANANO3).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.VALANO3 == "0"
        ? ""
        : parseFloat(row.VALANO3).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end ">${
      row.CANANO4 == "0"
        ? ""
        : parseFloat(row.CANANO4).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end">${
      row.VALANO4 == "0"
        ? ""
        : parseFloat(row.VALANO4).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.CANANO5 == "0"
        ? ""
        : parseFloat(row.CANANO5).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.VALANO5 == "0"
        ? ""
        : parseFloat(row.VALANO5).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `</tr>`;
  });

  return `<div>
                        <div class="mb-3">
                                <label for="" class="form-control border border-0 fw-bold mb-2">Mostrar por: </label>
                                <select id="cbbChartTemp1${newChart}" class="form-control">
                                    <option value="1">Valores</option>
                                    <option value="2">Docenas</option>
                                </select>
                        </div>
                        <figure class="highcharts-figure">
                            <div id="containerChartTemp1${newChart}" class="highcharts-dark text-white Math.rounded">
                            </div>
                        </figure>
                    </div>
                    <div>
                    <table class="table table-bordered striped m-0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width:2.6%;"></th>
                                        <th style="width:9.2%;"></th>
                                        <th colspan="2" class="text-center bg-light" style="width:15.5%;"><span id="tableTemp1${newChart}lbl0"></span></th>
                                        <th colspan="2" class="text-center" style="width:15.2%;"><span id="tableTemp1${newChart}lbl1"></span></th>
                                        <th colspan="2" class="text-center bg-light" style="width:15.5%;"><span id="tableTemp1${newChart}lbl2"></span></th>
                                        <th colspan="2" class="text-center" style="width:15.5%;"><span id="tableTemp1${newChart}lbl3"></span></th>
                                        <th colspan="2" class="text-center bg-light" style="width:16%;"><span id="tableTemp1${newChart}lbl4"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width:2.6%;"></th>
                                        <th style="width:9.2%;">Mes</th>
                                        <th class="text-end bg-light" style="width:6.2%;">Docenas</th>
                                        <th class="text-end bg-light" style="width:9.3%;">Valores</th>
                                        <th class="text-end" style="width:6.2%;">Docenas</th>
                                        <th class="text-end" style="width:9%;">Valores</th>
                                        <th class="text-end bg-light" style="width:6%;">Docenas</th>
                                        <th class="text-end bg-light" style="width:9.5%;">Valores</th>
                                        <th class="text-end" style="width:6%;">Docenas</th>
                                        <th class="text-end" style="width:9.5%;">Valores</th>
                                        <th class="text-end bg-light" style="width:6.3%;">Docenas</th>
                                        <th class="text-end bg-light" style="width:9.7%;">Valores</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${rows}
                                </tbody>
                        </table>
                    </div>`;
}
function format2(d) {
  const data = d;
  let rows = "";

  data.forEach((row) => {
    rows += `<tr>`;
    rows += `<td></td>`;
    rows += `<td>${row.MES}</td>`;
    rows += `<td class="text-end bg-light">${
      row.CANANO1 == "0"
        ? ""
        : parseFloat(row.CANANO1).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.VALANO1 == "0"
        ? ""
        : parseFloat(row.VALANO1).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end ">${
      row.CANANO2 == "0"
        ? ""
        : parseFloat(row.CANANO2).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end ">${
      row.VALANO2 == "0"
        ? ""
        : parseFloat(row.VALANO2).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.CANANO3 == "0"
        ? ""
        : parseFloat(row.CANANO3).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.VALANO3 == "0"
        ? ""
        : parseFloat(row.VALANO3).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end ">${
      row.CANANO4 == "0"
        ? ""
        : parseFloat(row.CANANO4).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end">${
      row.VALANO4 == "0"
        ? ""
        : parseFloat(row.VALANO4).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.CANANO5 == "0"
        ? ""
        : parseFloat(row.CANANO5).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.VALANO5 == "0"
        ? ""
        : parseFloat(row.VALANO5).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `</tr>`;
  });

  return `<div>
                        <div class="mb-3">
                                <label for="" class="form-control border border-0 fw-bold mb-2">Mostrar por: </label>
                                <select id="cbbChartTemp2${newChart}" class="form-control">
                                    <option value="1">Valores</option>
                                    <option value="2">Docenas</option>
                                </select>
                        </div>
                        <figure class="highcharts-figure">
                            <div id="containerChartTemp2${newChart}" class="highcharts-dark text-white Math.rounded">
                            </div>
                        </figure>
                    </div>
                    <div>
                    <table class="table table-bordered striped m-0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width:2.6%;"></th>
                                        <th style="width:9.2%;"></th>
                                        <th colspan="2" class="text-center bg-light" style="width:15.5%;"><span id="tableTemp2${newChart}lbl0"></span></th>
                                        <th colspan="2" class="text-center" style="width:15.2%;"><span id="tableTemp2${newChart}lbl1"></span></th>
                                        <th colspan="2" class="text-center bg-light" style="width:15.5%;"><span id="tableTemp2${newChart}lbl2"></span></th>
                                        <th colspan="2" class="text-center" style="width:15.5%;"><span id="tableTemp2${newChart}lbl3"></span></th>
                                        <th colspan="2" class="text-center bg-light" style="width:16%;"><span id="tableTemp2${newChart}lbl4"></span></th>
                                    </tr>
                                    <tr>
                                        <th style="width:2.6%;"></th>
                                        <th style="width:9.2%;">Mes</th>
                                        <th class="text-end bg-light" style="width:6.2%;">Docenas</th>
                                        <th class="text-end bg-light" style="width:9.3%;">Valores</th>
                                        <th class="text-end" style="width:6.2%;">Docenas</th>
                                        <th class="text-end" style="width:9%;">Valores</th>
                                        <th class="text-end bg-light" style="width:6%;">Docenas</th>
                                        <th class="text-end bg-light" style="width:9.5%;">Valores</th>
                                        <th class="text-end" style="width:6%;">Docenas</th>
                                        <th class="text-end" style="width:9.5%;">Valores</th>
                                        <th class="text-end bg-light" style="width:6.3%;">Docenas</th>
                                        <th class="text-end bg-light" style="width:9.7%;">Valores</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${rows}
                                </tbody>
                        </table>
                    </div>`;
}
function format3(d) {
  const data = d;
  let rows = "";

  data.forEach((row) => {
    rows += `<tr>`;
    rows += `<td></td>`;
    rows += `<td>${row.MES}</td>`;
    rows += `<td class="text-end bg-light">${
      row.CANANO1 == "0"
        ? ""
        : parseFloat(row.CANANO1).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.VALANO1 == "0"
        ? ""
        : parseFloat(row.VALANO1).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end ">${
      row.CANANO2 == "0"
        ? ""
        : parseFloat(row.CANANO2).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end ">${
      row.VALANO2 == "0"
        ? ""
        : parseFloat(row.VALANO2).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.CANANO3 == "0"
        ? ""
        : parseFloat(row.CANANO3).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.VALANO3 == "0"
        ? ""
        : parseFloat(row.VALANO3).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end ">${
      row.CANANO4 == "0"
        ? ""
        : parseFloat(row.CANANO4).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end">${
      row.VALANO4 == "0"
        ? ""
        : parseFloat(row.VALANO4).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.CANANO5 == "0"
        ? ""
        : parseFloat(row.CANANO5).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.VALANO5 == "0"
        ? ""
        : parseFloat(row.VALANO5).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `</tr>`;
  });

  return `<div>
                          <div class="mb-3">
                                  <label for="" class="form-control border border-0 fw-bold mb-2">Mostrar por: </label>
                                  <select id="cbbChartTemp3${newChart}" class="form-control">
                                      <option value="1">Valores</option>
                                      <option value="2">Docenas</option>
                                  </select>
                          </div>
                          <figure class="highcharts-figure">
                              <div id="containerChartTemp3${newChart}" class="highcharts-dark text-white Math.rounded">
                              </div>
                          </figure>
                      </div>
                      <div>
                      <table class="table table-bordered striped m-0" style="width: 100%;">
                                  <thead>
                                      <tr>
                                          <th style="width:2.6%;"></th>
                                          <th style="width:9.2%;"></th>
                                          <th colspan="2" class="text-center bg-light" style="width:15.5%;"><span id="tableTemp3${newChart}lbl0"></span></th>
                                          <th colspan="2" class="text-center" style="width:15.2%;"><span id="tableTemp3${newChart}lbl1"></span></th>
                                          <th colspan="2" class="text-center bg-light" style="width:15.5%;"><span id="tableTemp3${newChart}lbl2"></span></th>
                                          <th colspan="2" class="text-center" style="width:15.5%;"><span id="tableTemp3${newChart}lbl3"></span></th>
                                          <th colspan="2" class="text-center bg-light" style="width:16%;"><span id="tableTemp3${newChart}lbl4"></span></th>
                                      </tr>
                                      <tr>
                                          <th style="width:2.6%;"></th>
                                          <th style="width:9.2%;">Mes</th>
                                          <th class="text-end bg-light" style="width:6.2%;">Docenas</th>
                                          <th class="text-end bg-light" style="width:9.3%;">Valores</th>
                                          <th class="text-end" style="width:6.2%;">Docenas</th>
                                          <th class="text-end" style="width:9%;">Valores</th>
                                          <th class="text-end bg-light" style="width:6%;">Docenas</th>
                                          <th class="text-end bg-light" style="width:9.5%;">Valores</th>
                                          <th class="text-end" style="width:6%;">Docenas</th>
                                          <th class="text-end" style="width:9.5%;">Valores</th>
                                          <th class="text-end bg-light" style="width:6.3%;">Docenas</th>
                                          <th class="text-end bg-light" style="width:9.7%;">Valores</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      ${rows}
                                  </tbody>
                          </table>
                      </div>`;
}
function format4(d) {
  const data = d;
  let rows = "";

  data.forEach((row) => {
    rows += `<tr>`;
    rows += `<td></td>`;
    rows += `<td>${row.MES}</td>`;
    rows += `<td class="text-end bg-light">${
      row.CANANO1 == "0"
        ? ""
        : parseFloat(row.CANANO1).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.VALANO1 == "0"
        ? ""
        : parseFloat(row.VALANO1).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end ">${
      row.CANANO2 == "0"
        ? ""
        : parseFloat(row.CANANO2).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end ">${
      row.VALANO2 == "0"
        ? ""
        : parseFloat(row.VALANO2).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.CANANO3 == "0"
        ? ""
        : parseFloat(row.CANANO3).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.VALANO3 == "0"
        ? ""
        : parseFloat(row.VALANO3).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end ">${
      row.CANANO4 == "0"
        ? ""
        : parseFloat(row.CANANO4).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end">${
      row.VALANO4 == "0"
        ? ""
        : parseFloat(row.VALANO4).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.CANANO5 == "0"
        ? ""
        : parseFloat(row.CANANO5).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `<td class="text-end bg-light">${
      row.VALANO5 == "0"
        ? ""
        : parseFloat(row.VALANO5).toLocaleString("en-EN", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
          })
    }</td>`;
    rows += `</tr>`;
  });

  return `<div>
                            <div class="mb-3">
                                    <label for="" class="form-control border border-0 fw-bold mb-2">Mostrar por: </label>
                                    <select id="cbbChartTemp4${newChart}" class="form-control">
                                        <option value="1">Valores</option>
                                        <option value="2">Docenas</option>
                                    </select>
                            </div>
                            <figure class="highcharts-figure">
                                <div id="containerChartTemp4${newChart}" class="highcharts-dark text-white Math.rounded">
                                </div>
                            </figure>
                        </div>
                        <div>
                        <table class="table table-bordered striped m-0" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width:2.6%;"></th>
                                            <th style="width:9.2%;"></th>
                                            <th colspan="2" class="text-center bg-light" style="width:15.5%;"><span id="tableTemp4${newChart}lbl0"></span></th>
                                            <th colspan="2" class="text-center" style="width:15.2%;"><span id="tableTemp4${newChart}lbl1"></span></th>
                                            <th colspan="2" class="text-center bg-light" style="width:15.5%;"><span id="tableTemp4${newChart}lbl2"></span></th>
                                            <th colspan="2" class="text-center" style="width:15.5%;"><span id="tableTemp4${newChart}lbl3"></span></th>
                                            <th colspan="2" class="text-center bg-light" style="width:16%;"><span id="tableTemp4${newChart}lbl4"></span></th>
                                        </tr>
                                        <tr>
                                            <th style="width:2.6%;"></th>
                                            <th style="width:9.2%;">Mes</th>
                                            <th class="text-end bg-light" style="width:6.2%;">Docenas</th>
                                            <th class="text-end bg-light" style="width:9.3%;">Valores</th>
                                            <th class="text-end" style="width:6.2%;">Docenas</th>
                                            <th class="text-end" style="width:9%;">Valores</th>
                                            <th class="text-end bg-light" style="width:6%;">Docenas</th>
                                            <th class="text-end bg-light" style="width:9.5%;">Valores</th>
                                            <th class="text-end" style="width:6%;">Docenas</th>
                                            <th class="text-end" style="width:9.5%;">Valores</th>
                                            <th class="text-end bg-light" style="width:6.3%;">Docenas</th>
                                            <th class="text-end bg-light" style="width:9.7%;">Valores</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${rows}
                                    </tbody>
                            </table>
                        </div>`;
}
function chargeChartTemp1(data, ano, nombre) {
  const data1 = [],
    data2 = [],
    data3 = [],
    data4 = [],
    data5 = [];
  let tipo = "";
  const selectChart = $("#cbbChartTemp1" + newChart);
  const valChart = selectChart.val();
  if (valChart == 1) {
    tipo = "Valores";
    data.forEach((dataRow) => {
      data1.push(parseFloat(dataRow.VALANO1));
      data2.push(parseFloat(dataRow.VALANO2));
      data3.push(parseFloat(dataRow.VALANO3));
      data4.push(parseFloat(dataRow.VALANO4));
      data5.push(parseFloat(dataRow.VALANO5));
    });
  } else {
    tipo = "Docenas";
    data.forEach((dataRow) => {
      data1.push(parseFloat(dataRow.CANANO1));
      data2.push(parseFloat(dataRow.CANANO2));
      data3.push(parseFloat(dataRow.CANANO3));
      data4.push(parseFloat(dataRow.CANANO4));
      data5.push(parseFloat(dataRow.CANANO5));
    });
  }
  const chart = Highcharts.chart(`containerChartTemp1${newChart}`, {
    chart: {
      type: "line",
      height: 500,
      style: {
        color: "#FFFFFF",
      },
    },
    lang: {
      viewFullscreen: "Ver en pantalla completa",
      exitFullscreen: "Salir de pantalla completa",
      downloadJPEG: "Descargar imagen JPEG",
      downloadPDF: "Descargar en PDF",
    },
    title: {
      text: `${nombre}, Histórico ${tipo} por Año`,
      align: "center",
      style: {
        color: "#FFFFFF",
      },
    },
    xAxis: {
      categories: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
      ],
      labels: {
        style: {
          color: "#FFFFFF",
        },
      },
    },
    yAxis: {
      title: {
        text: " ",
        style: {
          color: "#FFFFFF",
        },
      },
      labels: {
        style: {
          color: "#FFFFFF",
        },
      },
    },
    legend: {
      itemStyle: {
        color: "#FFFFFF",
      },
    },
    tooltip: {
      style: {
        color: "#FFFFFF",
      },
      backgroundColor: "#000000",
      borderColor: "#FFFFFF",
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true,
          formatter: function () {
            return this.y.toLocaleString("es-ES").replace(".", ",");
          },
          style: {
            color: "#FFFFFF",
            fontWeight: "bold",
          },
        },
        enableMouseTracking: true,
      },
      series: {
        lineWidth: 4,
        states: {
          hover: {
            enabled: true,
            lineWidth: 4,
          },
        },
      },
    },
    credits: {
      enabled: false,
    },
    exporting: {
      buttons: {
        contextButton: {
          menuItems: [
            "viewFullscreen",
            "separator",
            "downloadJPEG",
            "downloadPDF",
          ],
          theme: {
            fill: "#000000",
            stroke: "#FFFFFF",
            style: {
              color: "#FFFFFF",
            },
          },
        },
        showAllButton: {
          text: "Mostrar todos",
          onclick: function () {
            this.series.forEach(function (series) {
              series.setVisible(true, false);
            });
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: {
              color: "#FFFFFF",
            },
          },
        },
        removeAllButton: {
          text: "Quitar todos",
          onclick: function () {
            this.series.forEach(function (series) {
              series.setVisible(false, false);
            });
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: {
              color: "#FFFFFF",
            },
          },
        },
      },
      enabled: true,
      sourceWidth: 1600,
      sourceHeight: 700,
      chartOptions: {
        chart: {
          backgroundColor: "#303030",
        },
      },
      fallbackToExportServer: false,
    },
    series: [
      {
        name: `${tipo} Año ` + ano,
        data: data1,
      },
      {
        name: `${tipo} Año ` + (ano - 1),
        data: data2,
      },
      {
        name: `${tipo} Año ` + (ano - 2),
        data: data3,
      },
      {
        name: `${tipo} Año ` + (ano - 3),
        data: data4,
      },
      {
        name: `${tipo} Año ` + (ano - 4),
        data: data5,
      },
    ],
  });
  for (let i = 0; i < 5; i++) {
    document.getElementById(`tableTemp1${newChart}lbl${i}`).innerText = ano - i;
  }
}
function chargeChartTemp2(data, ano, nombre) {
  const data1 = [],
    data2 = [],
    data3 = [],
    data4 = [],
    data5 = [];
  let tipo = "";
  const selectChart = $("#cbbChartTemp2" + newChart);
  const valChart = selectChart.val();
  if (valChart == 1) {
    tipo = "Valores";
    data.forEach((dataRow) => {
      data1.push(parseFloat(dataRow.VALANO1));
      data2.push(parseFloat(dataRow.VALANO2));
      data3.push(parseFloat(dataRow.VALANO3));
      data4.push(parseFloat(dataRow.VALANO4));
      data5.push(parseFloat(dataRow.VALANO5));
    });
  } else {
    tipo = "Docenas";
    data.forEach((dataRow) => {
      data1.push(parseFloat(dataRow.CANANO1));
      data2.push(parseFloat(dataRow.CANANO2));
      data3.push(parseFloat(dataRow.CANANO3));
      data4.push(parseFloat(dataRow.CANANO4));
      data5.push(parseFloat(dataRow.CANANO5));
    });
  }
  const chart = Highcharts.chart(`containerChartTemp2${newChart}`, {
    chart: {
      type: "line",
      height: 500,
      style: {
        color: "#FFFFFF",
      },
    },
    lang: {
      viewFullscreen: "Ver en pantalla completa",
      exitFullscreen: "Salir de pantalla completa",
      downloadJPEG: "Descargar imagen JPEG",
      downloadPDF: "Descargar en PDF",
    },
    title: {
      text: `${nombre}, Histórico ${tipo} por Año`,
      align: "center",
      style: {
        color: "#FFFFFF",
      },
    },
    xAxis: {
      categories: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
      ],
      labels: {
        style: {
          color: "#FFFFFF",
        },
      },
    },
    yAxis: {
      title: {
        text: " ",
        style: {
          color: "#FFFFFF",
        },
      },
      labels: {
        style: {
          color: "#FFFFFF",
        },
      },
    },
    legend: {
      itemStyle: {
        color: "#FFFFFF",
      },
    },
    tooltip: {
      style: {
        color: "#FFFFFF",
      },
      backgroundColor: "#000000",
      borderColor: "#FFFFFF",
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true,
          formatter: function () {
            return this.y.toLocaleString("es-ES").replace(".", ",");
          },
          style: {
            color: "#FFFFFF",
            fontWeight: "bold",
          },
        },
        enableMouseTracking: true,
      },
      series: {
        lineWidth: 4,
        states: {
          hover: {
            enabled: true,
            lineWidth: 4,
          },
        },
      },
    },
    credits: {
      enabled: false,
    },
    exporting: {
      buttons: {
        contextButton: {
          menuItems: [
            "viewFullscreen",
            "separator",
            "downloadJPEG",
            "downloadPDF",
          ],
          theme: {
            fill: "#000000",
            stroke: "#FFFFFF",
            style: {
              color: "#FFFFFF",
            },
          },
        },
        showAllButton: {
          text: "Mostrar todos",
          onclick: function () {
            this.series.forEach(function (series) {
              series.setVisible(true, false);
            });
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: {
              color: "#FFFFFF",
            },
          },
        },
        removeAllButton: {
          text: "Quitar todos",
          onclick: function () {
            this.series.forEach(function (series) {
              series.setVisible(false, false);
            });
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: {
              color: "#FFFFFF",
            },
          },
        },
      },
      enabled: true,
      sourceWidth: 1600,
      sourceHeight: 700,
      chartOptions: {
        chart: {
          backgroundColor: "#303030",
        },
      },
      fallbackToExportServer: false,
    },
    series: [
      {
        name: `${tipo} Año ` + ano,
        data: data1,
      },
      {
        name: `${tipo} Año ` + (ano - 1),
        data: data2,
      },
      {
        name: `${tipo} Año ` + (ano - 2),
        data: data3,
      },
      {
        name: `${tipo} Año ` + (ano - 3),
        data: data4,
      },
      {
        name: `${tipo} Año ` + (ano - 4),
        data: data5,
      },
    ],
  });
  for (let i = 0; i < 5; i++) {
    document.getElementById(`tableTemp2${newChart}lbl${i}`).innerText = ano - i;
  }
}
function chargeChartTemp3(data, ano, nombre) {
  const data1 = [],
    data2 = [],
    data3 = [],
    data4 = [],
    data5 = [];
  let tipo = "";
  const selectChart = $("#cbbChartTemp3" + newChart);
  const valChart = selectChart.val();
  if (valChart == 1) {
    tipo = "Valores";
    data.forEach((dataRow) => {
      data1.push(parseFloat(dataRow.VALANO1));
      data2.push(parseFloat(dataRow.VALANO2));
      data3.push(parseFloat(dataRow.VALANO3));
      data4.push(parseFloat(dataRow.VALANO4));
      data5.push(parseFloat(dataRow.VALANO5));
    });
  } else {
    tipo = "Docenas";
    data.forEach((dataRow) => {
      data1.push(parseFloat(dataRow.CANANO1));
      data2.push(parseFloat(dataRow.CANANO2));
      data3.push(parseFloat(dataRow.CANANO3));
      data4.push(parseFloat(dataRow.CANANO4));
      data5.push(parseFloat(dataRow.CANANO5));
    });
  }
  const chart = Highcharts.chart(`containerChartTemp3${newChart}`, {
    chart: {
      type: "line",
      height: 500,
      style: {
        color: "#FFFFFF",
      },
    },
    lang: {
      viewFullscreen: "Ver en pantalla completa",
      exitFullscreen: "Salir de pantalla completa",
      downloadJPEG: "Descargar imagen JPEG",
      downloadPDF: "Descargar en PDF",
    },
    title: {
      text: `${nombre}, Histórico ${tipo} por Año`,
      align: "center",
      style: {
        color: "#FFFFFF",
      },
    },
    xAxis: {
      categories: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
      ],
      labels: {
        style: {
          color: "#FFFFFF",
        },
      },
    },
    yAxis: {
      title: {
        text: " ",
        style: {
          color: "#FFFFFF",
        },
      },
      labels: {
        style: {
          color: "#FFFFFF",
        },
      },
    },
    legend: {
      itemStyle: {
        color: "#FFFFFF",
      },
    },
    tooltip: {
      style: {
        color: "#FFFFFF",
      },
      backgroundColor: "#000000",
      borderColor: "#FFFFFF",
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true,
          formatter: function () {
            return this.y.toLocaleString("es-ES").replace(".", ",");
          },
          style: {
            color: "#FFFFFF",
            fontWeight: "bold",
          },
        },
        enableMouseTracking: true,
      },
      series: {
        lineWidth: 4,
        states: {
          hover: {
            enabled: true,
            lineWidth: 4,
          },
        },
      },
    },
    credits: {
      enabled: false,
    },
    exporting: {
      buttons: {
        contextButton: {
          menuItems: [
            "viewFullscreen",
            "separator",
            "downloadJPEG",
            "downloadPDF",
          ],
          theme: {
            fill: "#000000",
            stroke: "#FFFFFF",
            style: {
              color: "#FFFFFF",
            },
          },
        },
        showAllButton: {
          text: "Mostrar todos",
          onclick: function () {
            this.series.forEach(function (series) {
              series.setVisible(true, false);
            });
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: {
              color: "#FFFFFF",
            },
          },
        },
        removeAllButton: {
          text: "Quitar todos",
          onclick: function () {
            this.series.forEach(function (series) {
              series.setVisible(false, false);
            });
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: {
              color: "#FFFFFF",
            },
          },
        },
      },
      enabled: true,
      sourceWidth: 1600,
      sourceHeight: 700,
      chartOptions: {
        chart: {
          backgroundColor: "#303030",
        },
      },
      fallbackToExportServer: false,
    },
    series: [
      {
        name: `${tipo} Año ` + ano,
        data: data1,
      },
      {
        name: `${tipo} Año ` + (ano - 1),
        data: data2,
      },
      {
        name: `${tipo} Año ` + (ano - 2),
        data: data3,
      },
      {
        name: `${tipo} Año ` + (ano - 3),
        data: data4,
      },
      {
        name: `${tipo} Año ` + (ano - 4),
        data: data5,
      },
    ],
  });
  for (let i = 0; i < 5; i++) {
    document.getElementById(`tableTemp3${newChart}lbl${i}`).innerText = ano - i;
  }
}
function chargeChartTemp4(data, ano, nombre) {
  const data1 = [],
    data2 = [],
    data3 = [],
    data4 = [],
    data5 = [];
  let tipo = "";
  const selectChart = $("#cbbChartTemp4" + newChart);
  const valChart = selectChart.val();
  if (valChart == 1) {
    tipo = "Valores";
    data.forEach((dataRow) => {
      data1.push(parseFloat(dataRow.VALANO1));
      data2.push(parseFloat(dataRow.VALANO2));
      data3.push(parseFloat(dataRow.VALANO3));
      data4.push(parseFloat(dataRow.VALANO4));
      data5.push(parseFloat(dataRow.VALANO5));
    });
  } else {
    tipo = "Docenas";
    data.forEach((dataRow) => {
      data1.push(parseFloat(dataRow.CANANO1));
      data2.push(parseFloat(dataRow.CANANO2));
      data3.push(parseFloat(dataRow.CANANO3));
      data4.push(parseFloat(dataRow.CANANO4));
      data5.push(parseFloat(dataRow.CANANO5));
    });
  }
  const chart = Highcharts.chart(`containerChartTemp4${newChart}`, {
    chart: {
      type: "line",
      height: 500,
      style: {
        color: "#FFFFFF",
      },
    },
    lang: {
      viewFullscreen: "Ver en pantalla completa",
      exitFullscreen: "Salir de pantalla completa",
      downloadJPEG: "Descargar imagen JPEG",
      downloadPDF: "Descargar en PDF",
    },
    title: {
      text: `${nombre}, Histórico ${tipo} por Año`,
      align: "center",
      style: {
        color: "#FFFFFF",
      },
    },
    xAxis: {
      categories: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
      ],
      labels: {
        style: {
          color: "#FFFFFF",
        },
      },
    },
    yAxis: {
      title: {
        text: " ",
        style: {
          color: "#FFFFFF",
        },
      },
      labels: {
        style: {
          color: "#FFFFFF",
        },
      },
    },
    legend: {
      itemStyle: {
        color: "#FFFFFF",
      },
    },
    tooltip: {
      style: {
        color: "#FFFFFF",
      },
      backgroundColor: "#000000",
      borderColor: "#FFFFFF",
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true,
          formatter: function () {
            return this.y.toLocaleString("es-ES").replace(".", ",");
          },
          style: {
            color: "#FFFFFF",
            fontWeight: "bold",
          },
        },
        enableMouseTracking: true,
      },
      series: {
        lineWidth: 4,
        states: {
          hover: {
            enabled: true,
            lineWidth: 4,
          },
        },
      },
    },
    credits: {
      enabled: false,
    },
    exporting: {
      buttons: {
        contextButton: {
          menuItems: [
            "viewFullscreen",
            "separator",
            "downloadJPEG",
            "downloadPDF",
          ],
          theme: {
            fill: "#000000",
            stroke: "#FFFFFF",
            style: {
              color: "#FFFFFF",
            },
          },
        },
        showAllButton: {
          text: "Mostrar todos",
          onclick: function () {
            this.series.forEach(function (series) {
              series.setVisible(true, false);
            });
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: {
              color: "#FFFFFF",
            },
          },
        },
        removeAllButton: {
          text: "Quitar todos",
          onclick: function () {
            this.series.forEach(function (series) {
              series.setVisible(false, false);
            });
            this.redraw();
          },
          theme: {
            fill: "#000000",
            stroke: "silver",
            style: {
              color: "#FFFFFF",
            },
          },
        },
      },
      enabled: true,
      sourceWidth: 1600,
      sourceHeight: 700,
      chartOptions: {
        chart: {
          backgroundColor: "#303030",
        },
      },
      fallbackToExportServer: false,
    },
    series: [
      {
        name: `${tipo} Año ` + ano,
        data: data1,
      },
      {
        name: `${tipo} Año ` + (ano - 1),
        data: data2,
      },
      {
        name: `${tipo} Año ` + (ano - 2),
        data: data3,
      },
      {
        name: `${tipo} Año ` + (ano - 3),
        data: data4,
      },
      {
        name: `${tipo} Año ` + (ano - 4),
        data: data5,
      },
    ],
  });
  for (let i = 0; i < 5; i++) {
    document.getElementById(`tableTemp4${newChart}lbl${i}`).innerText = ano - i;
  }
}

