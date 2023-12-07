<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .table th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    } 
    .table-container {
        width: 100%;
        overflow-x: auto;
        max-height: 550px;
        position: relative;
        z-index: 1;
        top: 0;
    }
    .total-row {
        background-color: rgba(0, 0, 0, 0.3) !important;
        color: white !important;
    }
    .gray-letters{
        color: transparent !important;
    }
    .breakMargin{
        margin-top: 0px;
    }
    @media screen and (min-width: 1650px) {
        .breakMargin{
             margin-top: 100px;
        }
    }
    .text-cyan{
        color: rgba(0, 133, 195,0.8);
    }
    .text-green{
        color: rgba(0, 194, 29,0.8);
    }
    .text-yellow{
        color: rgba(195, 183, 0,1);
    }
  </style>
</head>
<body>
    
</body>
</html>