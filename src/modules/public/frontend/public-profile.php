<?php
    $title = "AdegaFlow | Perfil";
    require_once dirname(__DIR__, 4) . '/public_html/config/bootstrap.php';
?>

<html>
    <body class="flex bg-[#343e59]">
        <?php require_once dirname(__DIR__, 4) . '/src/includes/aside.php'?>
        <main class="flex-1 p-3">
           <h2 class="text-3xl font-semibold text-amber-50">Bem-vindo, Adega Dama da Noite</h2>
           <div class="mt-4">
                <span class="text-2xl text-amber-50">Perfil</span>
                <div class="row">
                    <form id="form-perfil">
                        <div class="flex justify-center">
                            <div class="bg-[#2b2d3e] pl-8 pr-8 pt-8 pb-4 rounded-2xl shadow-2xl">
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="flex flex-col">
                                        <label class="label">CNPJ</label>
                                        <input type="text" class="form-input" name="cnpj" id="cnpj" placeholder="00.00.000.000-00">
                                    </div>
                                    <div class="flex flex-col">
                                        <label class="label">Nome</label>
                                        <input type="text" class="form-input" name="nome" id="nome" placeholder="Nome adega">
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 mt-4 gap-2">
                                    <div class="flex flex-col col-span-1">
                                        <label class="label">CEP</label>
                                        <input type="text" class="form-input" name="cep" id="cep" placeholder="000000-00">
                                    </div>
                                    <div class="flex flex-col col-span-2">
                                        <label class="label">Logradouro</label>
                                        <input type="text" class="form-input" name="logradouro" id="logradouro" placeholder="Rua dos Milagres">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 mt-4 gap-2">
                                    <div class="flex flex-col col-span-1">
                                        <label class="label">Bairro</label>
                                        <input type="text" class="form-input" name="bairro" id="bairro" placeholder="Jardim Imperial">
                                    </div>
                                    <div class="flex flex-col col-span-1">
                                        <label class="label">Telefone</label>
                                        <input type="text" class="form-input" name="telefone" id="telefone" placeholder="(11) 90375-2867">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 mt-4 gap-2">
                                    <div class="flex flex-col col-span-1">
                                        <label class="label">Cidade</label>
                                        <input type="text" class="form-input" name="cidade" id="cidade" placeholder="São Paulo">
                                    </div>
                                    <div class="flex flex-col col-span-1">
                                        <label class="label">E-mail</label>
                                        <input type="text" class="form-input" name="email" id="email" placeholder="adega@gmail.com">
                                    </div>
                                </div>
                                <div class="flex justify-center mt-4">
                                    <button type="button" class="font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-[#343e59] text-amber-50 hover:scale-105 duration-300 text-center cursor-pointer">Salvar informações</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
           </div>
        </main>
    </body>
</html>