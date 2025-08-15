<?php
$url = $_SERVER['REQUEST_URI'];
?>

<!-- ASIDE para DESKTOP (oculto no sm, visível md+) -->
<aside class="hidden md:flex md:w-64 bg-[#2b2d3e] text-white flex-col p-4">
  <div class="flex items-center gap-1 justify-center">
      <img src="/public_html/assets/images/AF_Just_Logo.svg" class="w-48 ml-3" alt="Logo">
  </div>
  <div class="flex items-center mb-10 justify-center mt-2">
      <h1 class="text-2xl font-bold">Adega</h1>
      <h1 class="text-2xl font-bold text-[#197679]">Flow</h1>
  </div>

  <nav class="flex flex-col gap-4 justify-center items-center">
    <a href="home" class="<?=$url === '/home' ? 'text-rose-400' : '' ?> hover:text-rose-400 text-2xl cursor-pointer flex items-center">
      <i class="fa-solid fa-house"></i><span class="ml-2">Inicio</span>
    </a>

    <a href="sales" class="<?=$url === '/sales' ? 'text-rose-400' : '' ?> hover:text-rose-400 text-2xl cursor-pointer flex items-center">
      <i class="fa-solid fa-dollar-sign"></i><span class="ml-2">Vendas</span>
    </a>

    <a href="stock" class="<?=$url === '/stock' ? 'text-rose-400' : '' ?> hover:text-rose-400 text-2xl cursor-pointer flex items-center">
      <i class="fa-solid fa-wine-bottle"></i><span class="ml-2">Estoque</span>
    </a>

    <a href="profile" class="<?=$url === '/profile' ? 'text-rose-400' : '' ?> hover:text-rose-400 text-2xl cursor-pointer flex items-center">
      <i class="fa-solid fa-shop"></i><span class="ml-2">Perfil</span>
    </a>

    <a href="logout" class="hover:text-rose-400 text-2xl cursor-pointer flex items-center">
      <i class="fa-solid fa-person-running"></i><span class="ml-2">Sair</span>
    </a>
  </nav>
</aside>

<nav class="fixed bottom-0 left-0 right-0 z-50 md:hidden bg-[#2b2d3e] text-white h-16 flex items-center justify-around"
     style="box-shadow: 0 -6px 18px rgba(0,0,0,0.35);">
  <a href="home" aria-label="Inicio" title="Início"
     class="<?=$url === '/home' ? 'text-rose-400' : 'text-amber-50' ?> text-xl flex flex-col items-center justify-center">
    <i class="fa-solid fa-house"></i>
    <span class="sr-only">Inicio</span>
  </a>

  <a href="sales" aria-label="Vendas" title="Vendas"
     class="<?=$url === '/sales' ? 'text-rose-400' : 'text-amber-50' ?> text-xl flex flex-col items-center justify-center">
    <i class="fa-solid fa-dollar-sign"></i>
    <span class="sr-only">Vendas</span>
  </a>

  <a href="stock" aria-label="Estoque" title="Estoque"
     class="<?=$url === '/stock' ? 'text-rose-400' : 'text-amber-50' ?> text-xl flex flex-col items-center justify-center">
    <i class="fa-solid fa-wine-bottle"></i>
    <span class="sr-only">Estoque</span>
  </a>

  <a href="profile" aria-label="Perfil" title="Perfil"
     class="<?=$url === '/profile' ? 'text-rose-400' : 'text-amber-50' ?> text-xl flex flex-col items-center justify-center">
    <i class="fa-solid fa-shop"></i>
    <span class="sr-only">Perfil</span>
  </a>

  <a href="logout" aria-label="Sair" title="Sair"
     class="text-amber-50 text-xl flex flex-col items-center justify-center">
    <i class="fa-solid fa-person-running"></i>
    <span class="sr-only">Sair</span>
  </a>
</nav>
