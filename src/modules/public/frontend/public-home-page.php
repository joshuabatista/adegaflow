<?php
    $title = "AdegaFlow | Inicio";
    require_once dirname(__DIR__, 4) . '/public_html/config/bootstrap.php';
?>

<html>
    <body class="flex bg-[#343e59]">
        <?php require_once dirname(__DIR__, 4) . '/src/includes/aside.php'?>
        <main class="flex-1 p-3">
            <div class="grid grid-cols-[70%_30%] p-3">
                <?php
                    require_once __DIR__ . '/includes/public-home-info.php';
                    require_once __DIR__ . '/includes/public-home-new-sale.php';
                ?>
            </div>
        </main>
    </body>
</html>