<!DOCTYPE html>
<html lang="es">
<head>
    <title>Cobra Reports Menu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        .tab-content > .tab-pane { padding-top: 1em; }
        .nav-tabs .nav-link.active { background-color: #f8f9fa; }
        .section-col { float: left; min-width: 220px; width: 33.333%; font-size: larger; }
        .section-col-gen { float: left; min-width: 180px; width: 24.9%; font-size: larger; }
        button { margin: 0.75em; }
    </style>
</head>
<body>
<div class="container py-4">
    <ul class="nav nav-tabs" id="reportTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab">Administración</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="gen-tab" data-bs-toggle="tab" data-bs-target="#gen" type="button" role="tab">Reportes Generales</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="spec-tab" data-bs-toggle="tab" data-bs-target="#spec" type="button" role="tab">Reportes por Clientes</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="bot-tab" data-bs-toggle="tab" data-bs-target="#bot" type="button" role="tab">ROBOT y ELASTIX</button>
        </li>
    </ul>
    <div class="tab-content" id="reportTabsContent">
        <div class="tab-pane fade show active" id="admin" role="tabpanel">
            <div class="row">
                <div class="section-col">
                    <h2>Cargas</h2>
                    <?php foreach ($cargas as $row) { ?>
                        <button class="btn btn-outline-primary w-100 mb-2" onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button>
                    <?php } ?>
                </div>
                <div class="section-col">
                    <h2>Visitas</h2>
                    <?php foreach ($visitas as $row) { ?>
                        <button class="btn btn-outline-primary w-100 mb-2" onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button>
                    <?php } ?>
                </div>
                <div class="section-col">
                    <h2>Administración</h2>
                    <?php foreach ($admin as $row) { ?>
                        <button class="btn btn-outline-primary w-100 mb-2" onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="gen" role="tabpanel">
            <div class="row">
                <div class="section-col-gen">
                    <h2>Queues</h2>
                    <?php foreach ($queues as $row) { ?>
                        <button class="btn btn-outline-secondary w-100 mb-2" onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button>
                    <?php } ?>
                </div>
                <div class="section-col-gen">
                    <h2>Promesas y Pagos</h2>
                    <?php foreach ($promPago as $row) { ?>
                        <button class="btn btn-outline-secondary w-100 mb-2" onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button>
                    <?php } ?>
                </div>
                <div class="section-col-gen">
                    <h2>Horarios</h2>
                    <?php foreach ($horarios as $row) { ?>
                        <button class="btn btn-outline-secondary w-100 mb-2" onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button>
                    <?php } ?>
                </div>
                <div class="section-col-gen">
                    <h2>Hojas de Cálculo</h2>
                    <?php foreach ($XLS as $row) { ?>
                        <button class="btn btn-outline-secondary w-100 mb-2" onclick="window.location = '<?php echo $row['page']; ?>.php?capt=<?php echo $capt; ?>'"><?php echo $row['label']; ?></button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="spec" role="tabpanel">
            <!-- Reportes por Clientes -->
        </div>
        <div class="tab-pane fade" id="bot" role="tabpanel">
            <!-- ROBOT y ELASTIX -->
        </div>
    </div>
    <div class="mt-4">
        <button class="btn btn-success me-2" onclick="window.location = 'quick.php?capt=<?php echo $capt; ?>'">Tiempo Real</button>
        <button class="btn btn-info me-2" onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>'">Las Cuentas</button>
        <button class="btn btn-danger" onclick="window.location = 'resumen.php?capt=<?php echo $capt; ?>&go=LOGOUT'">LOGOUT</button>
    </div>
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tabs = document.querySelectorAll('.nav-tabs .nav-link');
        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) { t.classList.remove('active'); });
                this.classList.add('active');
            });
        });
    });
</script>
</body>
</html>
