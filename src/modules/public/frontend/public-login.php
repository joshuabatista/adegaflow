<?php
    $title = "AdegaFlow | Login";
    require_once dirname(__DIR__, 4) . '/public_html/config/bootstrap.php';
?>


<html>
    <body class="flex bg-[#343e59]">
        <main class="flex-1 p-3">
            <div class="rounded-2xl shadow-2xl p-4 bg-[#2b2d3e] m-40 ml-60 mr-60">
                <div class="grid grid-cols-[50%_50%]">
                    <div class="flex items-center flex-col justify-center">
                        <img src="../../../../../public_html/assets/images/AF_Just_Logo.svg" class=" w-96" alt="">
                        <div class="flex items-center mb-3 justify-center mt-2">
                            <h1 class="text-5xl font-bold text-zinc-700">Adega</h1>
                            <h1 class="text-5xl font-bold text-[#197679]">Flow</h1>
                        </div>
                    </div>
                    <form id="form-login">
                        <div class="">
                            <div class="flex justify-center mt-10">
                                <h2 class="text-3xl font-semibold text-amber-50">Acessar Painel</h2>
                            </div>
                            <div class="flex flex-col mt-10 gap-2 m-25 ">
                                <div class="mt-4">
                                    <label for="" class="label">E-mail</label>
                                    <input type="text" name="email" id="email" class="form-input">
                                </div>
                                <div class="mt-4">
                                    <label for="" class="label">Senha</label>
                                    <input type="password" name="senha" id="senha" class="form-input">
                                </div>
                                <div class="mt-4 flex justify-center">
                                    <button class="btn btn-login w-60">Entrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <script src="src/modules/public/frontend/assets/js/public-login.js"></script>
        <?php require_once __DIR__ . '../../../../includes/footer.php'?>
    </body>
</html>