<?php
    $title = "AdegaFlow | Estoque";
    require_once dirname(__DIR__, 4) . '/public_html/config/bootstrap.php';
?>

<html>
    <body class="flex bg-[#343e59]">
        <?php require_once dirname(__DIR__, 4) . '/src/includes/aside.php'?>
        <main class="flex-1 p-3">
           <h2 class="text-3xl font-semibold text-amber-50">Bem-vindo, Adega Dama da Noite</h2>
           <div class="mt-4">
                <span class="text-2xl text-amber-50">Estoque</span>
                 <div class="grid grid-cols-[70%_30%] p-3">
                    <?php
                        require_once __DIR__ . '/includes/public-stock-products.php';
                        require_once __DIR__ . '/includes/public-stock-add-products.php';
                    ?>
                </div>
           </div>
        </main>
    </body>
</html>