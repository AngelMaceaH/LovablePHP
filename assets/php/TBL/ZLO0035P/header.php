<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>

    #calendar {
      margin: 0px !important;
      width: 100% !important;
      background-color: #fff;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
      padding: 20px;
    }
    .fc-scroller {
      overflow: hidden !important;
    }
    .fc-scroller-liquid-absolute{
      overflow: hidden !important;
    }
    .fc-toolbar {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .fc-button {
      background-color: #007bff;
      border: none;
      color: #fff;
      padding: 5px 10px;
      border-radius: 4px;
      transition: background-color 0.3s ease;
    }

    .fc-button:hover {
      background-color: #0056b3;
    }

    .fc-button-primary {
      background-color: #007bff;
    }

    .fc-button-primary:hover {
      background-color: #0056b3;
    }

    .fc-daygrid-event {
      border: none;
      color: #fff;
      border-radius: 4px;
      padding: 2px 4px;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }
    .fc-col-header-cell-cushion{
      color: #951313;
      font-size: 16px !important;
    }
    .fc-daygrid-event:hover {
      background-color: #0056b3;
    }

    .fc-day-today {
      background-color: #e6f7ff !important;
    }

    .fc-list-event {
      border-left: 4px solid #007bff;
      padding-left: 10px;
    }

    .fc-list-event:hover {
      background-color: #f1f1f1;
    }

    .fc-daygrid-day-number {
      color: #951313;
      font-size: 20px !important;
      text-decoration: none;
      margin-top: 12px;
    }
    .fc-event-title-container{
      padding: 10px !important;
      cursor: pointer !important;
    }

    .fc-icon {
      color: #fff;
    }

    .fc-theme-standard td,
    .fc-theme-standard th {
      border-color: #e0e0e0;
    }
    .custom-calendar .fc-header-toolbar {
      white-space: nowrap; /* Evita que el contenido del encabezado se envuelva */
    }

    .custom-calendar .fc-toolbar-title {
      margin: 0 50px; /* Añade un poco de espacio entre el título y las flechas */
      display: inline-block;
    }

    .custom-calendar .fc-prev-button,
    .custom-calendar .fc-next-button {
      display: inline-block; /* Asegura que los botones estén en línea con el título */
    }
    .fc-toolbar .fc-button.fc-invisible1-button,
    .fc-toolbar .fc-button.fc-invisible2-button,
    .fc-toolbar .fc-button.fc-invisible3-button {
      visibility: hidden; /* Hacer invisibles los botones */
      width: 30px; /* Ajustar el ancho para centrar correctamente */
      display: inline-block; /* Asegurar que se comporten como botones */
    }
    .fc-day-other {
  background-color: #f0f0f0; /* Fondo gris claro */
}
  .w100{
    width: 100% !important;
  }

  </style>
</head>

<body>

</body>

</html>