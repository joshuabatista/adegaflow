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
                                    <button class="btn btn-login w-60 justify-center items-center inline-flex">
                                        <svg aria-hidden="true" role="status" class=" w-4 h-4 me-3 text-white animate-spin loading-logar hidden " viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                        </svg>
                                        Entrar
                                    </button>
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