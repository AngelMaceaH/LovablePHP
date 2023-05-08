//TABLA CONSULTA DE VENTAS RESUMIDAS
//DIA Y MES
$(document).ready(function() {

    $("#myTable").DataTable( {
        stateSave: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "ordering": false,
        "pageLength": 100,
        "columnDefs": [
            {
                target: 0,
                visible: false,
                searchable: false,
            },
            {
                target: 1,
                visible: false,
                searchable: true,
            },
            {
                target: 3,
                visible: true,
                searchable: false,
            },
            {
                target: 4,
                visible: true,
                searchable: false,
            },
            ],
       /* dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light fs-6 ",
                exportOptions: {
                    columns: [2,3,4]
                },
                title: 'ReporteVentas',
                customize: function (xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    var sSh = xlsx.xl['styles.xml'];
                    var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                    var i; var y;
                     
                    var n1 = '<numFmt formatCode="##0.0000%" numFmtId="300"/>';
                    var s1 = '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                    var s2 = '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                                '<alignment horizontal="center"/></xf>';
                    var s3 = '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                    var s4 = '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                                '<alignment horizontal="center" wrapText="1"/></xf>'
                    sSh.childNodes[0].childNodes[0].innerHTML += n1;
                    sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4;
                     
                    var fourDecPlaces    = lastXfIndex + 1;
                    var greyBoldCentered = lastXfIndex + 2;
                    var twoDecPlacesBold = lastXfIndex + 3;
                    var greyBoldWrapText = lastXfIndex + 4;
                    $('c[r=A1] t', sheet).text( 'Reporte de ventas resumidas por compañía' );
                    var tagName = sSh.getElementsByTagName('sz');
                    for (i = 0; i < tagName.length; i++) {
                      tagName[i].setAttribute("val", "13")
                    }
                    $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
                  }
                  
            }
        ]*/
    });

    //ANUAL
    $("#myTableAnual").DataTable( {
        stateSave: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "ordering": false,
        "pageLength": 100,
        "columnDefs": [
            {
                target: 0,
                visible: false,
                searchable: false,
            },
            {
                target: 1,
                visible: false,
                searchable: true,
            },
            {
                target: 3,
                visible: true,
                searchable: false,
            },
            {
                target: 4,
                visible: true,
                searchable: false,
            },
            ],
        /*dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa-solid fa-file-excel"></i> <b >Enviar a Excel</b>',
                className: "btn btn-success text-light fs-6",
                exportOptions: {
                    columns: [2,3,4,5,6]
                },
                title: 'ReporteVentas',
                customize: function (xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    var sSh = xlsx.xl['styles.xml'];
                    var lastXfIndex = $('cellXfs xf', sSh).length - 1;
                    var i; var y;
                     
                    var n1 = '<numFmt formatCode="##0.0000%" numFmtId="300"/>';
                    var s1 = '<xf numFmtId="300" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>';
                    var s2 = '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                                '<alignment horizontal="center"/></xf>';
                    var s3 = '<xf numFmtId="4" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/>'
                    var s4 = '<xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1">'+
                                '<alignment horizontal="center" wrapText="1"/></xf>'
                    sSh.childNodes[0].childNodes[0].innerHTML += n1;
                    sSh.childNodes[0].childNodes[5].innerHTML += s1 + s2 + s3 + s4;
                     
                    var fourDecPlaces    = lastXfIndex + 1;
                    var greyBoldCentered = lastXfIndex + 2;
                    var twoDecPlacesBold = lastXfIndex + 3;
                    var greyBoldWrapText = lastXfIndex + 4;
                    $('c[r=A1] t', sheet).text( 'Reporte de ventas resumidas por compañía' );
                    var tagName = sSh.getElementsByTagName('sz');
                    for (i = 0; i < tagName.length; i++) {
                      tagName[i].setAttribute("val", "13")
                    }
                    $('row:eq(0) c', sheet).attr( 's', greyBoldCentered );
                  }
                  
            }
        ]*/
    });



//TRANSACCIONES

    $("#myTableTransacciones").DataTable( {
        stateSave: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "ordering": false,
        "pageLength": 100,
        "columnDefs": [
            {
                target: 0,
                visible: false,
                searchable: false,
            },
            {
                target: 1,
                visible: false,
                searchable: true,
            },
            {
                target: 3,
                visible: true,
                searchable: false,
            },
            {
                target: 4,
                visible: true,
                searchable: false,
            },
            ],
    });




});
   


   
