<?php
    $title = "AdegaFlow | Vendas";
    require_once dirname(__DIR__, 4) . '/public_html/config/bootstrap.php';
?>

<html>
    <body class="flex bg-[#343e59]">
        <?php require_once dirname(__DIR__, 4) . '/src/includes/aside.php'?>
        <main class="flex-1 p-3">
           <h2 class="text-3xl font-semibold text-amber-50">Bem-vindo, <?= $adega_nome ?></h2>
           <div class="mt-4">
                <span class="text-2xl text-amber-50">Vendas</span>
                <div class="grid grid-cols-12 p-3 mt-7 gap-2.5">
                    <div class="col-span-2">
                        <label class="label" for="grid-first-name">De</label>
                        <input class="form-input" id="de" type="date" placeholder="01/01/2025">
                    </div>

                    <div class="col-span-2">
                        <label class="label" for="grid-first-name">
                            Até
                        </label>
                        <input class="form-input" id="ate" type="date" placeholder="31/01/2025">
                    </div>

                    <div class="col-span-3">
                        <label class="label" for="grid-first-name">
                            Produto
                        </label>
                        <input type="text" name="produto" id="produto" class="form-input" placeholder="Cerveja">
                    </div>

                    <div class="col-span-3">
                        <label class="label" for="grid-first-name">
                            Plano de Contas
                        </label>
                        <select name="plano_contas" id="plano_contas" class="form-input">
                            <option value="">Selecione</option>
                        </select>
                    </div>

                    
                    <div class="col-span-2">
                        <label class="label" for="grid-first-name">
                            Venda ID
                        </label>
                        <input type="text" name="venda_id" id="venda_id" class="form-input" placeholder="#168456848">
                    </div>
                </div>
                <div class="flex justify-start p-3 gap-2.5">
                    <button class=" w-3.5 text-amber-50 cursor-pointer" id="btn-sales-excel">
                        <i class="fa-regular fa-file-excel fa-2x"></i>
                    </button>
                </div>
                <div class="grid grid-cols-12 gap-2 border-b p-3 mt-4 bg-[#2b2d3e] rounded-t-xl text-sm font-semibold text-white shadow-2xl">
                    <div class="col-span-2">Venda ID</div>
                    <div class="col-span-1">Data</div>
                    <div class="col-span-4">Produto</div>
                    <div class="col-span-1">Qtd</div>
                    <div class="col-span-2">Valor</div>
                    <div class="col-span-1 text-center">Excluir</div>
                    <div class="col-span-1 text-center">Editar</div>
                </div>
                <div class="container-sales shadow-2xl">
                
                </div>

                
                <div class="flex justify-center mt-4 loading">
                    <div role="status">
                        <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="flex flex-row justify-between">
                    <div class="hidden mt-4 sm:flex">
                        <span class="font-medium text-base text-amber-50 pagination-info-card"></span>
                    </div>

                    <div class="flex gap-4 mt-4">
                        <button
                            class="btn-prev-card cursor-pointer bg-[#2b2d3e] inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-gradient-to-r from-[#2b2d3e] to-[#2b2d3e] text-white text-sm font-medium hover:opacity-90 transition-all duration-200 shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Anterior
                        </button>

                        <button
                            class="btn-next-card cursor-pointer bg-[#2b2d3e] inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-gradient-to-r from-[#313344] to-[#333547] text-white text-sm font-medium hover:opacity-90 transition-all duration-200 shadow-md">
                            Próximo
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>

           </div>
        </main>
        <?php require_once __DIR__ . '../../../../includes/footer.php'?>
        <script src="src/modules/public/frontend/assets/js/public-sales.js"></script>
    </body>
</html>