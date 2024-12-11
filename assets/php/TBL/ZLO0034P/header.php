<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>

  .container-fluid {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
  }

  .row {
    margin-right: -15px;
    margin-left: -15px;
  }

  .col-xs-1,
  .col-sm-1,
  .col-md-1,
  .col-lg-1,
  .col-xs-2,
  .col-sm-2,
  .col-md-2,
  .col-lg-2,
  .col-xs-3,
  .col-sm-3,
  .col-md-3,
  .col-lg-3,
  .col-xs-4,
  .col-sm-4,
  .col-md-4,
  .col-lg-4,
  .col-xs-5,
  .col-sm-5,
  .col-md-5,
  .col-lg-5,
  .col-xs-6,
  .col-sm-6,
  .col-md-6,
  .col-lg-6,
  .col-xs-7,
  .col-sm-7,
  .col-md-7,
  .col-lg-7,
  .col-xs-8,
  .col-sm-8,
  .col-md-8,
  .col-lg-8,
  .col-xs-9,
  .col-sm-9,
  .col-md-9,
  .col-lg-9,
  .col-xs-10,
  .col-sm-10,
  .col-md-10,
  .col-lg-10,
  .col-xs-11,
  .col-sm-11,
  .col-md-11,
  .col-lg-11,
  .col-xs-12,
  .col-sm-12,
  .col-md-12,
  .col-lg-12 {
    position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
  }

  .col-xs-1,
  .col-xs-2,
  .col-xs-3,
  .col-xs-4,
  .col-xs-5,
  .col-xs-6,
  .col-xs-7,
  .col-xs-8,
  .col-xs-9,
  .col-xs-10,
  .col-xs-11,
  .col-xs-12 {
    float: left;
  }

  .col-xs-2 {
    width: 16.66666667%;
  }

  /********************************************************************************************************************/
  @import url('https://fonts.googleapis.com/css?family=Muli:400,300');

  .Mulifont {
    font-family: 'Muli', sans-serif !important;
  }

  .gu-mirror {
    position: fixed !important;
    margin: 0 !important;
    z-index: 9999 !important;
  }

  .gu-hide {
    display: none !important;
  }

  .gu-unselectable {
    -webkit-user-select: none !important;
    -moz-user-select: none !important;
    -ms-user-select: none !important;
    user-select: none !important;
  }

  .gu-transit {
    opacity: .2;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";
    filter: alpha(opacity=20);
  }

  .gu-mirror {
    opacity: .8;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
    filter: alpha(opacity=80);
  }

  .pad {
    padding-left: 0;
    padding-right: 0;
  }

  .bg {
    padding: 50px 0px;
    min-height: 600px;
    background: #e0eaf3;
  }

  .container-fluid .col-xs-2 div.box {
    text-align: center;
    margin: 10px auto;
    padding-top: 5px;
    padding-bottom: 5px;
    width: 90%;
    background: #fff;
    border: 1px solid #ccc;
    font-size: 13px !important;
  }

  .fs-14 {
    font-size: 14px;
  }

  .fs-16 {
    font-size: 16px;
  }

  .fs-20 {
    font-size: 20px;
  }

  .form-control {
    margin: 0 auto;
    margin-top: 20px;
    width: 90%;
    border-radius: 0;
  }

  .gwe {
    border: none;
  }

  .btn {
    margin-top: 20px;
    border-radius: 0;
  }

  .white {
    text-align: center;
  }

  .white .form-control {
    margin-top: 0;
  }

  .white .input-label {
    margin-top: 20px;
    text-align: center;
  }

  .box .tasks {
    padding-bottom: 7px;
  }

  .box .tasks .task-name {
    font-size: 1.3em;
    font-weight: bold;
    text-transform: uppercase;
  }

  .box .tasks .task-desc {
    font-size: 1.1em;
    color: #555;
  }

  .box .tasks .task-deadline {
    margin-top: 5px;
    margin-right: 5px;
    font-size: .8em;
    color: #555;
  }

  .done div.box {
    pointer-events: none;
    background: #ddd !important;
  }

  .done div.box .tasks {
    color: #fff !important;
  }

  .move {
    text-align: center;
    background: #eee;
  }

  .move .btn {
    margin-bottom: 20px;
  }

  .checked {
    border: 3px solid #ddA500 !important;
  }

  .w100 {
    width: 100%;
  }

  .w50 {
    width: 50%;
  }

  .text-darkblue {
    color: #1e2a78;
  }

  input[type="checkbox"] {
    margin-left: 2%;
    border: #000;
    color: #fff;
    background: #fff;
    border-radius: none;
  }

  .bg-secondary-subtle {
    background-color: rgba(108, 117, 125, 0.3)
  }

  .text-title {
    font-size: 13px;
    font-weight: bold;
    text-transform: uppercase;
  }

  /* Estilos para el scrollbar completo */
  ::-webkit-scrollbar {
    width: 5px;
    /* ancho del scrollbar */
    height: 12px;
    /* altura del scrollbar para scroll horizontal */
  }

  /* Estilos para la pista (parte que no es el control deslizable) */
  ::-webkit-scrollbar-track {
    background: #f1f1f1;
    /* color de fondo de la pista */
    border-radius: 10px;
    /* redondear las esquinas de la pista */
  }

  /* Estilos para el control deslizable (thumb) */
  ::-webkit-scrollbar-thumb {
    background: #888;
    /* color de fondo del thumb */
    border-radius: 10px;
    /* redondear las esquinas del thumb */
  }

  /* Estilos para el estado hover del thumb */
  ::-webkit-scrollbar-thumb:hover {
    background: #555;
    /* color de fondo del thumb al hacer hover */
  }

  .dropdown-menu {
    /*transform: translate(-110px, 38px) !important;*/
  }
  </style>
</head>

<body>

</body>

</html>