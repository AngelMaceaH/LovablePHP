<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon.ico">
    <style>
        .heightFrame {
            height: 100%;
            max-height: 100vh !important;
        }

        .iframe-container {
            width: 100%;
            height: 90vh;
            overflow: auto;
            border: 1px solid #ccc;
        }

        iframe {
            width: 100%;
            height: 95%;
            border: none;
        }
    </style>
</head>

<body class="overflow-hidden">
    <?php
    include '../layout-prg.php';
    ?>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span> Directorio telefónico / Lista </span>
                </li>
                <li class="breadcrumb-item active"><span>ZLO0045P</span></li>
            </ol>
        </nav>
    </div>
    </header>
    <div id="body-div" class="body flex-grow-3">
        <div class="iframe-container">
            <iframe src="http://172.16.15.20/LovableDirectorio/" title="Lovable Directorio telefónico" scrolling="yes">
            </iframe>
        </div>
    </div>
    </div>
    </div>
</body>

</html>