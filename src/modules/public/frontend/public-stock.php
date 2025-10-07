<?php
    $title = "AdegaFlow | Estoque";
    require_once dirname(__DIR__, 4) . '/public_html/config/bootstrap.php';
?>

<html>
    <body class="flex bg-[#343e59]">
        <?php require_once dirname(__DIR__, 4) . '/src/includes/aside.php'?>
        <main class="flex-1 p-0 md:p-5">
            <div class="flex flex-col justify-center">
                <h2 class="block md:hidden text-center text-xl p-3 font-semibold bg-[#2b2d3e] rounded-b-3xl text-amber-50 ">Bem-vindo, <?= $adega_nome ?></h2>
            </div>
           <h2 class=" hidden md:block text-3xl font-semibold text-amber-50">Bem-vindo, <?= $adega_nome ?></h2>
           <div class="mt-4">
                <span class="ml-3 text-2xl text-amber-50 md:text-2xl text-amber-50">Estoque</span>
                 <div class="sm:flex md:grid grid-cols-[70%_30%] p-3">
                    <?php
                        require_once __DIR__ . '/includes/public-stock-products.php';
                        require_once __DIR__ . '/includes/public-stock-add-products.php';
                    ?>
                </div>
           </div>
        </main>
        <?php require_once __DIR__ . '../../../../includes/footer.php'?>
        <script src="src/modules/public/frontend/assets/js/public-stock.js"></script>
    </body>
</html>