<?php
    $title = "AdegaFlow | Alterar senha";

    session_start();

    if (isset($_SESSION['adega_id'])) {
        header("Location:/home"); 
        exit;
    }

    if (!isset($_GET['token'])) {
        header("Location:/home"); 
        exit;   
    }

    require '../../../../app/functions.php';

    $token = $_GET['token'];
    $decryptedToken = openssl_decrypt(base64_decode($token), 'AES-128-CTR', $key, 0, '1234567891011121');

    if (!$decryptedToken) {
        header("Location:/home"); 
        exit;  
    }

    $tokenData = json_decode($decryptedToken, true);

    if (!$tokenData || time() > $tokenData['expiry']) {
        header("Location:/home"); 
        exit;  
    }

    $adega_id = $tokenData['adega_id'];

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Adega Flow' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="../../tailwind/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" href="../public_html/assets/images/AF_Just_Logo.svg">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     
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

  .select2-hidden-accessible {
    display: none !important;
  }
</style>

<script>
    const adega_id = <?= $adega_id ?>
</script>

<html>
    <body class="flex bg-[#343e59] justify-center items-center">
        <div class="flex flex-col bg-[#2b2d3e] rounded-2xl shadow-2xl p-4 w-96">
            <div class="flex flex-col">
                <div class="flex justify-center">
                    <img src="../../../../../public_html/assets/images/AF_Just_Logo.svg" class="w-36 h-36" alt="">
                </div>
            </div>
            <div class="flex flex-col mt-2">
                <label for="" class="label">Nova senha</label>
                <input type="password" id="senha1" name="senha1" class="form-input w-full">
            </div>
            <div class="flex flex-col mt-2">
                <label for="" class="label">Confirme sua senha</label>
                <input type="password" id="senha2" name="senha2" class="form-input w-full">
            </div>
            <div class="flex flex-col mt-4">
                <button class="btn btn-salvar-senha justify-center items-center inline-flex">
                    <svg aria-hidden="true" role="status" class=" w-4 h-4 me-3 text-white animate-spin loading-salvar hidden " viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Salvar
                </button>
            </div>
        </div>
        <?php require_once __DIR__ . '../../../../includes/footer.php'?>
        <script src="src/modules/public/frontend/assets/js/public-login.js"></script>
    </body>
</html>



