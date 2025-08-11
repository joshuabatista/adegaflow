<?php
    $title = "AdegaFlow | Inicio";
    require_once dirname(__DIR__, 4) . '/public_html/config/bootstrap.php';
?>

<html>
    <body class="flex bg-[#343e59]">
        <?php require_once dirname(__DIR__, 4) . '/src/includes/aside.php'?>
        <main class="flex-1 p-3">
            <h2 class="text-3xl font-semibold text-amber-50">Bem-vindo, <?= $adega_nome ?></h2>
            <div class="grid grid-cols-[70%_30%] pl-3 pr-3 pt-3">
                <?php
                    require_once __DIR__ . '/includes/public-home-info.php';
                    require_once __DIR__ . '/includes/public-home-new-sale.php';
                ?>
            </div>
            <div class="flex flex-row p-2 ml-3 gap-2">
                <div>
                    <label class="label" for="">De</label>
                    <input type="date" name="kpi_de" id="kpi_de" class="form-input">
                </div>
                <div>
                    <label class="label" for="">Até</label>
                    <input type="date" name="kpi_ate" id="kpi_ate" class="form-input">
                </div>
            </div>
            <div class="grid grid-cols-4 pr-3 pl-5 pb-3 gap-2.5 mt-1">
                <?php
                    require_once __DIR__ . '/includes/public-home-kpi.php';
                ?>
            </div>
            
        </main>
        <?php require_once __DIR__ . '../../../../includes/footer.php'?>
        <script src="src/modules/public/frontend/assets/js/public-home-info.js"></script>
        <script src="src/modules/public/frontend/assets/js/public-home-new-sale.js"></script>
    </body>
</html>