<?php
    $title = "AdegaFlow";
    require_once dirname(__DIR__, 4) . '/public_html/config/conection.php';
    require_once dirname(__DIR__, 4) . '/app/functions.php';
?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Adega Flow' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../../tailwind/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="icon" href="../public_html/assets/images/AF_Just_Logo.svg">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
        integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#343e59',
                        secondary: '#2b2d3e'
                    }
                }
            }
        }
    </script>
    
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #343e59 0%, #2b2d3e 100%);
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease-out;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .feature-card {
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, #343e59, #2b2d3e);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(52, 62, 89, 0.3);
        }
        
        .navbar-scroll {
            background: rgba(43, 45, 62, 0.95);
            backdrop-filter: blur(10px);
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Header/Navigation -->
    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-wine-bottle text-yellow-400 mr-2"></i>
                        <span class="text-[#2b2d3e]">Adega<span class=" text-amber-50">Flow</span></span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#home" class="nav-link text-white hover:text-blue-400 transition-colors">Início</a>
                        <a href="#about" class="nav-link text-white hover:text-blue-400 transition-colors">Sobre</a>
                        <a href="#features" class="nav-link text-white hover:text-blue-400 transition-colors">Funcionalidades</a>
                        <a href="#screenshots" class="nav-link text-white hover:text-blue-400 transition-colors">Screenshots</a>
                        <a href="#contact" class="nav-link text-white hover:text-blue-400 transition-colors">Contato</a>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-white hover:text-blue-400">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 bg-primary rounded-b-lg">
                    <a href="#home" class="nav-link block px-3 py-2 text-white hover:text-blue-400">Início</a>
                    <a href="#about" class="nav-link block px-3 py-2 text-white hover:text-blue-400">Sobre</a>
                    <a href="#features" class="nav-link block px-3 py-2 text-white hover:text-blue-400">Funcionalidades</a>
                    <a href="#screenshots" class="nav-link block px-3 py-2 text-white hover:text-blue-400">Screenshots</a>
                    <a href="#contact" class="nav-link block px-3 py-2 text-white hover:text-blue-400">Contato</a>
                </div>
            </div>
        </div>
    </nav>

    <section id="home" class="hero-gradient min-h-screen flex items-center relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-20 text-6xl text-white">
                <i class="fas fa-wine-glass"></i>
            </div>
            <div class="absolute top-40 right-32 text-4xl text-white">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div class="absolute bottom-32 left-32 text-5xl text-white">
                <i class="fas fa-cash-register"></i>
            </div>
            <div class="absolute bottom-20 right-20 text-3xl text-white">
                <i class="fas fa-boxes"></i>
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <div class="mb-8 fade-in">
                    <div class="inline-block pulse-animation">
                        <img src="../public_html/assets/images/AF_Just_Logo.svg" class=" w-64" alt="">
                    </div>
                    <h1 class="text-5xl md:text-7xl font-bold text-white mb-4">
                        <span class="text-[#2b2d3e]">Adega<span class=" text-amber-50">Flow</span></span>
                    </h1>
                </div>

                <!-- Título principal -->
                <div class="mb-6 fade-in">
                    <h2 class="text-2xl md:text-4xl font-bold text-white mb-4">
                        Sistema Completo de Gerenciamento para Adegas
                    </h2>
                    <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                        Controle total do seu negócio com gestão de estoque, vendas, caixa e relatórios detalhados. 
                        Uma solução moderna, responsiva e desenvolvida especialmente para adegas.
                    </p>
                </div>

                <!-- Botões de ação -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center fade-in">
                    <a href="login" class="btn-primary px-8 py-4 rounded-lg text-white font-semibold text-lg shadow-lg">
                        <i class="fas fa-rocket mr-2"></i>
                        Começar Agora
                    </a>
                    <!-- <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-primary transition-all">
                        <i class="fas fa-play mr-2"></i>
                        Ver Demo
                    </button> -->
                </div>

                <!-- Estatísticas -->
                <!-- <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 fade-in">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-400">100%</div>
                        <div class="text-gray-300">Responsivo</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-400">PHP 8+</div>
                        <div class="text-gray-300">Tecnologia Moderna</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-400">Autoral</div>
                        <div class="text-gray-300">Projeto Original</div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <!-- Sobre o Sistema -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center fade-in">
                <h2 class="text-4xl font-bold text-primary mb-8">Sobre o Adega Flow</h2>
                <p class="text-lg text-gray-700 leading-relaxed mb-12">
                    O Adega Flow é um sistema completo de gerenciamento desenvolvido especificamente para proprietários de adegas que desejam ter controle total sobre seu negócio. Com uma interface moderna e intuitiva, o sistema oferece todas as ferramentas necessárias para gerenciar estoque, realizar vendas, controlar o caixa e gerar relatórios detalhados.
                </p>

                <!-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center fade-in">
                        <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-code text-2xl text-primary"></i>
                        </div>
                        <h3 class="font-semibold text-primary mb-2">PHP 8+</h3>
                        <p class="text-sm text-gray-600">Desenvolvido com a versão mais recente do PHP</p>
                    </div>

                    <div class="text-center fade-in">
                        <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-mobile-alt text-2xl text-primary"></i>
                        </div>
                        <h3 class="font-semibold text-primary mb-2">Responsivo</h3>
                        <p class="text-sm text-gray-600">Funciona perfeitamente em todos os dispositivos</p>
                    </div>

                    <div class="text-center fade-in">
                        <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-palette text-2xl text-primary"></i>
                        </div>
                        <h3 class="font-semibold text-primary mb-2">Tailwind CSS</h3>
                        <p class="text-sm text-gray-600">Design moderno e customizável</p>
                    </div>

                    <div class="text-center fade-in">
                        <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-cog text-2xl text-primary"></i>
                        </div>
                        <h3 class="font-semibold text-primary mb-2">jQuery</h3>
                        <p class="text-sm text-gray-600">Interatividade e dinamismo</p>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <!-- Funcionalidades -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-4xl font-bold text-primary mb-4">Funcionalidades Principais</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Todas as ferramentas que você precisa para gerenciar sua adega de forma eficiente e profissional.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Controle de Estoque -->
                <div class="feature-card bg-white rounded-lg shadow-lg p-6 text-center fade-in">
                    <div class="bg-blue-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-boxes text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Controle de Estoque</h3>
                    <p class="text-gray-600 mb-4">
                        Gerencie seu inventário com precisão. Controle entradas, saídas e mantenha sempre atualizado o status dos seus produtos.
                    </p>
                    <ul class="text-left text-sm text-gray-500">
                        <li class="flex items-center mb-1">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Cadastro de produtos
                        </li>
                        <li class="flex items-center mb-1">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Controle de quantidade
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Alertas de estoque baixo
                        </li>
                    </ul>
                </div>

                <!-- Gestão de Vendas -->
                <div class="feature-card bg-white rounded-lg shadow-lg p-6 text-center fade-in">
                    <div class="bg-green-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shopping-cart text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Gestão de Vendas</h3>
                    <p class="text-gray-600 mb-4">
                        Registre vendas de forma rápida e eficiente. Acompanhe o desempenho e histórico de todas as transações.
                    </p>
                    <ul class="text-left text-sm text-gray-500">
                        <li class="flex items-center mb-1">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Processo de venda rápido
                        </li>
                        <li class="flex items-center mb-1">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Histórico de transações
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Controle de clientes
                        </li>
                    </ul>
                </div>

                <!-- Sistema de Caixa -->
                <div class="feature-card bg-white rounded-lg shadow-lg p-6 text-center fade-in">
                    <div class="bg-yellow-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-cash-register text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Sistema de Caixa</h3>
                    <p class="text-gray-600 mb-4">
                        Controle financeiro completo com abertura e fechamento de caixa, controle de receitas e despesas.
                    </p>
                    <ul class="text-left text-sm text-gray-500">
                        <li class="flex items-center mb-1">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Abertura/Fechamento
                        </li>
                        <li class="flex items-center mb-1">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Controle de receitas
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Gestão de despesas
                        </li>
                    </ul>
                </div>

                <!-- Relatórios -->
                <div class="feature-card bg-white rounded-lg shadow-lg p-6 text-center fade-in">
                    <div class="bg-purple-500 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-bar text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Relatórios Detalhados</h3>
                    <p class="text-gray-600 mb-4">
                        Gere relatórios completos de vendas, compras e performance para tomar decisões estratégicas.
                    </p>
                    <ul class="text-left text-sm text-gray-500">
                        <li class="flex items-center mb-1">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Relatórios de vendas
                        </li>
                        <li class="flex items-center mb-1">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Análise de performance
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Gráficos interativos
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Screenshots -->
    <section id="screenshots" class="py-20 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-4xl font-bold text-primary mb-4">Interface do Sistema</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Conheça a interface moderna e intuitiva do Adega Flow, projetada para facilitar o seu dia a dia.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Desktop Screenshot -->
                <div class="fade-in">
                    <div class="bg-gradient-to-br from-primary to-secondary p-6 rounded-lg shadow-2xl">
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                            <img 
                                src="../public_html/assets/images/AF_HP.png"
                                alt="Interface desktop do Adega Flow mostrando dashboard com gráficos de vendas, métricas de receita e sistema de gestão de estoque"
                                class="w-full h-auto"
                            />
                        </div>
                    </div>
                    <div class="text-center mt-6">
                        <h3 class="text-xl font-bold text-primary mb-2">Versão Desktop</h3>
                        <p class="text-gray-600">Dashboard completo com gráficos interativos e métricas em tempo real</p>
                    </div>
                </div>

                <!-- Mobile Screenshot -->
                <div class="fade-in">
                    <div class="flex justify-center">
                        <div class="bg-gradient-to-br from-primary to-secondary p-4 rounded-2xl shadow-2xl max-w-xs">
                            <div class="bg-white rounded-xl overflow-hidden shadow-lg">
                                <img 
                                    src="../public_html/assets/images/AF_Mobile.png"
                                    alt="Interface mobile do Adega Flow exibindo tela de ponto de venda com seleção de produtos, acompanhamento de vendas e menu de navegação"
                                    class="w-full h-auto"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-6">
                        <h3 class="text-xl font-bold text-primary mb-2">Versão Mobile</h3>
                        <p class="text-gray-600">Interface otimizada para smartphones com fácil navegação touch</p>
                    </div>
                </div>
            </div>

            <!-- Features Highlights -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center fade-in">
                    <div class="bg-blue-500 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-responsive text-white"></i>
                    </div>
                    <h4 class="font-bold text-primary mb-2">100% Responsivo</h4>
                    <p class="text-gray-600 text-sm">Adapta-se perfeitamente a qualquer tamanho de tela</p>
                </div>

                <div class="text-center fade-in">
                    <div class="bg-green-500 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-tachometer-alt text-white"></i>
                    </div>
                    <h4 class="font-bold text-primary mb-2">Alto Performance</h4>
                    <p class="text-gray-600 text-sm">Carregamento rápido e navegação fluida</p>
                </div>

                <div class="text-center fade-in">
                    <div class="bg-yellow-500 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-white"></i>
                    </div>
                    <h4 class="font-bold text-primary mb-2">Seguro</h4>
                    <p class="text-gray-600 text-sm">Desenvolvido seguindo as melhores práticas de segurança</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 hero-gradient">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-4xl mx-auto fade-in">
                <h2 class="text-4xl font-bold text-white mb-6">
                    Pronto para Revolucionar sua Adega?
                </h2>
                <p class="text-xl text-gray-300 mb-8">
                    Junte-se aos proprietários de adegas que já estão usando o Adega Flow para otimizar seus negócios.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <button class="bg-white text-primary px-8 py-4 rounded-lg font-semibold text-lg hover:bg-gray-100 transition-all shadow-lg">
                        <i class="fas fa-download mr-2"></i>
                        Acessar sistema
                    </button>
                    <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-white hover:text-primary transition-all">
                        <i class="fas fa-envelope mr-2"></i>
                        Entrar em Contato
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-secondary py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Logo e Descrição -->
                <div class="fade-in">
                    <div class="text-2xl font-bold text-white flex items-center mb-4">
                        <i class="fas fa-wine-bottle text-yellow-400 mr-2"></i>
                        <span class="text-[#2b2d3e]">Adega<span class=" text-[#343e59]">Flow</span></span>
                    </div>
                    <p class="text-gray-300 mb-4">
                        Sistema completo de gerenciamento para adegas. Desenvolvido com as mais modernas tecnologias web.
                    </p>
                    
                </div>

                <!-- Contato -->
                <div class="fade-in">
                    <h3 class="text-lg font-semibold text-[#343e59] mb-4">Contato</h3>
                    <div class="space-y-2 text-gray-300">
                        <p class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-blue-400"></i>
                            adegaflowservice@gmail.com
                        </p>
                        <p class="flex items-center">
                            <i class="fab fa-whatsapp mr-2 text-green-400"></i>
                            (11) ewsfsfdc
                        </p>
                        
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-600 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    © <?php echo date('Y'); ?> Adega Flow. Todos os direitos reservados. 
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            // Smooth scrolling para links de navegação
            $('.nav-link').on('click', function(e) {
                e.preventDefault();
                const target = $(this).attr('href');
                const targetSection = $(target);
                
                if (targetSection.length) {
                    $('html, body').animate({
                        scrollTop: targetSection.offset().top - 70
                    }, 800);
                }
                
                // Fechar menu mobile após clique
                $('#mobile-menu').addClass('hidden');
            });

            // Toggle menu mobile
            $('#mobile-menu-btn').on('click', function() {
                $('#mobile-menu').toggleClass('hidden');
            });

            // Navbar background on scroll
            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 50) {
                    $('#navbar').addClass('navbar-scroll');
                } else {
                    $('#navbar').removeClass('navbar-scroll');
                }
            });

            // Fade in animation on scroll
            function checkFadeIn() {
                $('.fade-in').each(function() {
                    const elementTop = $(this).offset().top;
                    const elementBottom = elementTop + $(this).outerHeight();
                    const viewportTop = $(window).scrollTop();
                    const viewportBottom = viewportTop + $(window).height();

                    if (elementBottom > viewportTop && elementTop < viewportBottom) {
                        $(this).addClass('visible');
                    }
                });
            }

            // Trigger fade in on scroll and page load
            $(window).on('scroll', checkFadeIn);
            checkFadeIn(); // Initial check

            // Hover effects para feature cards
            $('.feature-card').hover(
                function() {
                    $(this).addClass('shadow-2xl');
                },
                function() {
                    $(this).removeClass('shadow-2xl');
                }
            );

            // Click effect nos botões
            $('.btn-primary, button').on('click', function() {
                $(this).addClass('transform scale-95');
                setTimeout(() => {
                    $(this).removeClass('transform scale-95');
                }, 150);
            });
        });
    </script>
</body>
</html>
