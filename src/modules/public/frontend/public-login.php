<?php
    $title = "AdegaFlow | Login";
    require_once dirname(__DIR__, 4) . '/public_html/config/conection.php';
    require_once dirname(__DIR__, 4) . '/app/functions.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Adega Flow' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../../tailwind/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" href="../public_html/assets/images/AF_Just_Logo.svg">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
     
</head>

<style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    
  .animate-slide-in {
    animation: slideIn 0.4s ease-out forwards;
  }
  .animate-slide-out {
    animation: slideOut 0.4s ease-in forwards;
  }

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateX(50px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  @keyframes slideOut {
    from {
      opacity: 1;
      transform: translateX(0);
    }
    to {
      opacity: 0;
      transform: translateX(50px);
    }
  }
</style>

<html>
    <body class="min-h-screen flex items-center justify-center bg-[#343e59] p-4">
        <main class="w-full max-w-6xl flex-1">
            <div class="rounded-3xl shadow-2xl p-6 md:p-8 bg-[#2b2d3e] mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-0 items-center">
                    <div class="flex flex-col items-center justify-center text-center">
                        <img src="../../../../../public_html/assets/images/AF_Just_Logo.svg" class="w-48 md:w-96 h-auto mb-4 md:mb-6" alt="">
                        <div class="flex items-center justify-center">
                            <h1 class="text-3xl md:text-5xl font-bold text-zinc-700">Adega</h1>
                            <h1 class="text-3xl md:text-5xl font-bold text-[#197679] ml-2">Flow</h1>
                        </div>
                    </div>
                    <form id="form-login" class="flex flex-col justify-center">
                        <div class="">
                            <div class="flex justify-center mb-6 md:mb-8">
                                <h2 class="text-2xl md:text-3xl font-semibold text-amber-50">Acessar Painel</h2>
                            </div>
                            <div class="flex flex-col gap-4 md:gap-6">
                                <div class="mt-4">
                                    <label for="" class="label block text-sm font-medium text-amber-50 mb-2">E-mail</label>
                                    <input type="text" name="email" id="email" class="form-input w-full">
                                </div>
                                <div class="mt-4">
                                    <label for="" class="label block text-sm font-medium text-amber-50 mb-2">Senha</label>
                                    <input type="password" name="senha" id="senha" class="form-input w-full">
                                </div>
                                <div class="mt-2">
                                    <span data-modal-target="modal-esqueci-senha" data-modal-toggle="modal-esqueci-senha" class="text-xs font-semibold text-amber-50 esqueci-senha cursor-pointer block text-center md:text-left hover:text-[#197679] transition-colors">Esqueceu sua senha?</span>
                                </div>
                                <div class="mt-6 flex justify-center">
                                    <button class="btn btn-login w-full md:w-60 justify-center items-center inline-flex py-3 px-6 rounded-xl transition-all duration-200 hover:shadow-lg">
                                        <svg aria-hidden="true" role="status" class="w-4 h-4 me-3 text-white animate-spin loading-logar hidden" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                        </svg>
                                        Entrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div id="modal-esqueci-senha" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-screen p-4">
                        <div class="relative w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-xl shadow-xl dark:bg-gray-700 p-6 md:p-8">
                                <div class="before">
                                    <div class="flex justify-center mb-4">
                                        <video src="../../../../../public_html/assets/images/AF_Success.mp4" autoplay loop muted playsinline class="w-32 h-32 md:w-44 md:h-44 max-w-none max-h-none"></video>
                                    </div>
                                    <div class="py-4">
                                        <input type="email" id="emailRecovery" placeholder="seu@email.com.br" class="form-input email w-full" />
                                    </div>

                                    <div class="flex flex-col sm:flex-row items-center justify-center p-2 gap-2">
                                        <button type="button" class="btn-success w-full sm:w-[17rem] btn-esqueci-senha justify-center items-center inline-flex py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                                            <svg aria-hidden="true" role="status" class="w-4 h-4 me-3 text-white animate-spin loading-enviar-email hidden" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                            </svg>
                                            Enviar
                                        </button>
                                        <button data-modal-hide="modal-esqueci-senha" type="button" class="btn w-full sm:w-[17rem] py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                                <div class="after hidden">
                                    <div class="flex justify-center mb-4">
                                        <video src="../../../../../public_html/assets/images/AF_Success.mp4" autoplay loop muted playsinline class="w-32 h-32 md:w-44 md:h-44 max-w-none max-h-none"></video>
                                    </div>
                                    <div class="py-4">
                                        <input type="text" id="" placeholder="informe o código enviado" class="form-input codigo w-full" />
                                    </div>
                                    <div class="flex flex-col sm:flex-row items-center justify-center p-2 gap-2">
                                        <button type="button" class="btn-success w-full sm:w-50 btn-validar justify-center items-center inline-flex py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                                            <svg aria-hidden="true" role="status" class="w-4 h-4 me-3 text-white animate-spin loading-enviar-codigo hidden" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                            </svg>
                                            Validar
                                        </button>
                                        <button data-modal-hide="modal-esqueci-senha" type="button" class="btn w-full sm:w-50 py-2 px-4 rounded-lg transition-all duration-200 hover:shadow-md">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="src/modules/public/frontend/assets/js/public-login.js"></script>
        <?php require_once __DIR__ . '../../../../includes/footer.php' ?>