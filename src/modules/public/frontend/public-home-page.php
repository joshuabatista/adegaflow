<?php
    $title = "AdegaFlow | Inicio";
    require_once dirname(__DIR__, 4) . '/public_html/config/bootstrap.php';
?>

<html>
    <body class="flex bg-[#343e59]">
        <?php require_once dirname(__DIR__, 4) . '/src/includes/aside.php'?>
        <main class="flex-1 p-0 md:p-5">
             <div class="flex flex-col justify-center">
                <h2 class="block md:hidden text-center text-xl p-3 font-semibold bg-[#2b2d3e] rounded-b-3xl text-amber-50 ">Bem-vindo, <?= $adega_nome ?></h2>
            </div>
            <h2 class="hidden md:block text-3xl font-semibold text-amber-50">Bem-vindo, <?= $adega_nome ?></h2>
            <div class="flex justify-between pl-3 pr-3 pt-3 pb-0.5 md:hidden">
                <div class="flex flex-col">
                    <h2 class="text-sm font-semibold text-amber-50">Vendas hoje</h2>
                    <h2 class="text-xl font-semibold text-amber-50 vendasHoje"></h2>
                </div>
                <div class="flex mb-1">
                   <img class="w-14" src="/public_html/assets/images/AF_Just_Logo.svg" alt="">
                </div>
            </div>
            <div class="sm:flex md:grid grid-cols-[70%_30%] p-2">
                <?php
                    require_once __DIR__ . '/includes/public-home-info.php';
                    require_once __DIR__ . '/includes/public-home-new-sale.php';
                ?>
            </div>
            <div class="flex flex-row p-2 ml-3 gap-2 filtros mb-0">
                <div>
                    <label class="label" for="">De</label>
                    <input type="date" name="kpi_de" id="kpi_de" class="shadow appearance-none border rounded w-[80%] sm:w-full h-[40px] sm:h-[46px] py-2 px-3 text-[#343e59] leading-tight focus:outline-none">
                </div>
                <div>
                    <label class="label" for="">Até</label>
                    <input type="date" name="kpi_ate" id="kpi_ate" class="shadow appearance-none border rounded w-[80%] sm:w-full h-[40px] sm:h-[46px] py-2 px-3 text-[#343e59] leading-tight focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 pr-2 pl-2 pb-20 md:pr-3 md:pl-5 md:pb-3 gap-2.5 mt-1">
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