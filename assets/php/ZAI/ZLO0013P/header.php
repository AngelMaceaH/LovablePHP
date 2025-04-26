<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.6/ladda-themeless.min.css"
        integrity="sha512-EOY99TUZ7AClCNvbnvrhtMXDuWzxUBXV7SFovruHvYf2dbvRB5ya+jgDPk5bOyTtZDbqFH3PTuTWl/D7+7MGsA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.0/spin.min.js"
        integrity="sha512-fgSmjQtBho/dzDJ+79r/yKH01H/35//QPPvA2LR8hnBTA5bTODFncYfSRuMal78C08vUa93q3jyxPa273cWzqA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Ladda/1.0.0/ladda.min.js"
        integrity="sha512-hZL8cWjOAFfWZza/p0uD0juwMeIuyLhAd5QDodiK4sBp1sG7BIeE1TbMGIbnUcUgwm3lVSWJzBK6KxqYTiDGkg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: auto;
        }

        #body-div {
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .table-frame {
            height: calc(100vh - 220px);
            overflow: auto;
            z-index: 999;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th {
            white-space: nowrap;
            text-align: center;
        }

        td {
            white-space: nowrap;
        }

        #loaderScreen {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1040;
            background-color: rgba(100, 100, 100, 0.9);
        }

        #hiddenColumns {
            z-index: 1050;
            position: relative;
        }

        #menuFilter {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 500px !important;
            z-index: 1050;
        }



        /* Contenedor de paginación */
        #divPagination {
            display: flex;
            justify-content: center;
            /* Centrar los botones de paginación */
            padding: 10px;
            margin-top: 10px;
            background-color: #f8f9fa;
            /* Color de fondo similar al de Bootstrap */
            border: 1px solid #dee2e6;
            /* Borde como en Bootstrap */
            border-radius: 0.25rem;
            /* Bordes redondeados */
        }

        #divRows {
            display: flex;
            justify-content: center;
            /* Centrar los botones de paginación */
            padding: 10px;
            margin-top: 10px;
            background-color: #f8f9fa;
            /* Color de fondo similar al de Bootstrap */
            border: 1px solid #dee2e6;
            /* Borde como en Bootstrap */
            border-radius: 0.25rem;
            /* Bordes redondeados */
            font-weight: bold;
        }

        /* Botones de paginación */
        #divPagination .paginate_button {
            padding: 0.5rem 0.75rem;
            /* Padding similar al de los botones de Bootstrap */
            margin-left: 4px;
            /* Espacio entre botones */
            border: 1px solid #dee2e6;
            /* Borde de botones */
            border-radius: 0.25rem;
            /* Bordes redondeados */
            color: #007bff;
            /* Color azul de Bootstrap para enlaces */
            text-decoration: none;
            /* Sin subrayado */
            background-color: white;
            /* Fondo blanco */
            cursor: pointer;
            /* Cursor tipo puntero para indicar clickeable */
        }

        /* Botones de paginación al pasar el mouse */
        #divPagination .paginate_button:hover {
            color: white;
            background-color: #007bff;
            /* Fondo azul al pasar el mouse */
            border-color: #0056b3;
            /* Borde más oscuro al pasar el mouse */
        }

        /* Botón actualmente seleccionado (página actual) */
        #divPagination .paginate_button.current,
        #divPagination .paginate_button.current:hover {
            color: white;
            background-color: #007bff;
            border-color: #0056b3;
        }

        /* Botones deshabilitados (anterior/siguiente cuando no aplicable) */
        #divPagination .paginate_button.disabled,
        #divPagination .paginate_button.disabled:hover {
            color: #6c757d;
            /* Color gris para elementos deshabilitados */
            pointer-events: none;
            /* Evita que se pueda interactuar con el botón */
            background-color: #e9ecef;
            border-color: #dee2e6;
        }








        .imgButtons {
            width: 50px;
        }

        .menuMarca {
            width: 5%;
        }

        .round1 {
            border-radius: 20px;
        }

        .total-row {
            background-color: rgba(0, 0, 0, 0.2) !important;
            color: white !important;
        }

        .fs-14 {
            font-size: 14px !important;
        }

        .total-row button {
            display: none;
        }

        .gray-letters {
            color: transparent !important;
        }

        #isPhone {
            display: none;
        }

        @media only screen and (max-width: 1400px) {
            #isPhone {
                display: block;
            }

            #isComputer {
                display: none;
            }
        }

        #myTablePlaneacion_filter input[type="search"] {
            display: none;
        }

        .table-container {
            width: 100%;
            height: 560px;
            overflow-x: auto;
            position: relative;
            z-index: 1;
            top: 0;
        }

        .table-container2 {
            width: 100%;
            height: 350px;
            overflow-x: auto;
            position: relative;
            z-index: 1;
            top: 0;
        }

        @media screen and (min-width: 1400px) {
            .table-container {
                width: 100%;
                height: 560px;
                overflow-x: auto;
                position: relative;
                z-index: 1;
                top: 0;
            }
        }

        @media screen and (min-width: 1650px) {
            .table-container {
                width: 100%;
                height: 700px;
                overflow-x: auto;
                position: relative;
                z-index: 1;
                top: 0;
            }

            .table-container2 {
                width: 100%;
                height: 500px;
                overflow-x: auto;
                position: relative;
                z-index: 1;
                top: 0;
            }
        }

        .text-brown {
            color: #5B2503;
        }

        .text-darkblue {
            color: #003C97;
        }

        .text-violet {
            color: #C18BFF;
        }

        .text-lightGreen {
            color: #00D30A;
        }

        .text-orange {
            color: #E8B000;
        }

        .bg-pink {
            background-color: rgba(238, 183, 255, 0.6) !important;
        }

        .bg-yellow {
            background-color: rgba(243, 249, 69, 0.4) !important;
        }

        .btn.btn-success,
        .btn.btn-primary {
            display: inline-flex;
            align-items: center;
            width: 260px;
            justify-content: center;
        }

        .btn.btn-success .btn-inner,
        .btn.btn-primary .btn-inner {
            display: inline-block;
            vertical-align: middle;
            line-height: normal;
            justify-content: center;
        }

        .fixed-scrollbar {
            overflow: auto;
        }

        .text-transparent {
            color: transparent !important;
        }

        div.selectBox {
            position: relative;
            display: inline-block;
            cursor: default;
            text-align: left;
            width: 100%;
            line-height: 35px;
            clear: both;
            color: rgba(0, 0, 0, 0.6);
        }

        span.selected {
            width: 100%;
            text-indent: 20px;
            border: 1px solid #ccc;
            //    border-right:none;
            border-radius: 5px;
            background: #fff;
            overflow: hidden;
        }

        span.selectArrow {
            width: 30px;
            border: 1px solid color:rgba(0, 0, 0, 0.6);
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            text-align: center;
            font-size: 10px;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -o-user-select: none;
            user-select: none;
            background: #fff;
        }

        span.selectArrow,
        span.selected {
            position: relative;
            float: left;
            height: 37px;
            z-index: 1;
        }

        div.selectOptions {
            position: absolute;
            top: 35px;
            left: 0;
            width: 100%;
            border: 1px solid #ccc;
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 5px;
            overflow: hidden;
            background: #fff;
            padding-top: 2px;
            display: none;
        }

        span.selectOption {
            display: block;
            width: 100%;
            line-height: 20px;
            padding: 5px 4%;
        }

        .dataTables_wrapper .dataTable thead th {
            background-color: white !important;
        }

        .sorting_disabled {
            z-index: 9999 !important;
            background-color: white !important;
        }

        .detaHead {
            z-index: 9999 !important;
            background-color: white !important;
        }

        .dtfc-fixed-left {
            width: 38px !important;
        }

        span.selectOption:hover {
            color: #f6f6f6;
            background: #000;
            /*     opacity:0.5; */
        }

        .fs-10 {
            font-size: 10px;
        }

        #photosModal .modal-dialog {
            max-width: 85vh;
            max-height: 80vh;
        }

        #photosModal .carousel-inner {
            max-width: 85vh;
            max-height: 80vh;
            position: relative;
        }

        #photosModal .carousel-inner img {
            width: auto;
            height: auto;
            max-width: 85vh;
            max-height: 80vh;
            object-fit: cover;
        }

        #photosModal .carousel-images {
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            display: flex;
            gap: 10px;
        }

        #photosModal .carousel-images button {
            width: 100% !important;
            height: 100% !important;
            max-width: 110px !important;
            max-height: 110px !important;
            background-color: transparent;
            border: none;
        }

        #photosModal .carousel-images button img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
            opacity: 0.5;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        #photosModal .carousel-images button img.active{
            transform: scale(1.2);
            opacity: 1;
        }

        #photosModal .carousel-images button:hover img {
            transform: scale(1.2);
            opacity: 1;
        }

    </style>
</head>

<body>

</body>

</html>