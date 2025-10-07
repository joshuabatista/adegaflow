<?php
    $title = "AdegaFlow - Sistema Profissional de Gestão";
    require_once dirname(__DIR__, 4) . '/public_html/config/conection.php';
    require_once dirname(__DIR__, 4) . '/app/functions.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'AdegaFlow - Sistema Profissional' ?></title>
    
    <!-- Meta Tags SEO -->
    <meta name="description" content="Sistema profissional completo para gestão de adegas. Controle de estoque, vendas, caixa e relatórios avançados com tecnologia de ponta.">
    <meta name="keywords" content="sistema adega, gestão estoque, ponto venda, php, tailwind">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph -->
    <meta property="og:title" content="AdegaFlow - Sistema Profissional de Gestão">
    <meta property="og:description" content="Revolucione sua adega com nossa solução completa de gestão">
    <meta property="og:type" content="website">
    
    <!-- Preload Critical Resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" as="style">
    
    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="../../tailwind/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="icon" href="../public_html/assets/images/AF_Just_Logo.svg" type="image/svg+xml">
    
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        :root {
            --primary: #1a1b2e;
            --primary-light: #16213e;
            --accent: #0f3460;
            --gold: #e94560;
            --gradient-primary: linear-gradient(135deg, #1a1b2e 0%, #16213e 50%, #0f3460 100%);
            --gradient-accent: linear-gradient(135deg, #e94560 0%, #ff6b7a 100%);
            --glass: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
        }
        
        body {
            overflow-x: hidden;
            scroll-behavior: smooth;
        }
        
        /* Hero Section */
        .hero-gradient {
            background: var(--gradient-primary);
            position: relative;
        }
        
        .hero-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(233, 69, 96, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(233, 69, 96, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(15, 52, 96, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        
        /* Glass Morphism */
        .glass {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(233, 69, 96, 0.3);
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }
        
        /* Premium Buttons */
        .btn-premium {
            background: var(--gradient-accent);
            border: none;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(233, 69, 96, 0.3);
        }
        
        .btn-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-premium:hover::before {
            left: 100%;
        }
        
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(233, 69, 96, 0.4);
        }
        
        .btn-outline {
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: transparent;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .btn-outline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transition: width 0.3s ease;
            z-index: -1;
        }
        
        .btn-outline:hover::before {
            width: 100%;
        }
        
        .btn-outline:hover {
            border-color: rgba(255, 255, 255, 0.6);
            transform: translateY(-2px);
        }
        
        /* Advanced Animations */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .pulse-premium {
            animation: pulse-premium 2s infinite;
        }
        
        @keyframes pulse-premium {
            0%, 100% { 
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(233, 69, 96, 0.7);
            }
            50% { 
                transform: scale(1.05);
                box-shadow: 0 0 0 20px rgba(233, 69, 96, 0);
            }
        }
        
        /* Navbar Premium */
        .navbar-premium {
            background: rgba(26, 27, 46, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .navbar-scrolled {
            background: rgba(26, 27, 46, 0.95);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }
        
        /* Feature Cards Premium */
        .feature-premium {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.05), rgba(255, 255, 255, 0.02));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .feature-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--gradient-accent);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .feature-premium:hover::before {
            transform: scaleX(1);
        }
        
        /* Stats Animation */
        .counter {
            font-weight: 700;
            font-size: 2.5rem;
        }
        
        /* Scroll Indicators */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% { transform: translate(-50%, 0); }
            40%, 43% { transform: translate(-50%, -10px); }
            70% { transform: translate(-50%, -5px); }
        }
        
        /* Image Parallax Effect */
        .parallax-container {
            perspective: 1000px;
            overflow: hidden;
        }
        
        .parallax-image {
            transition: transform 0.3s ease;
        }
        
        .parallax-container:hover .parallax-image {
            transform: rotateY(5deg) rotateX(5deg) scale(1.05);
        }
        
        /* Mobile Optimizations */
        @media (max-width: 768px) {
            .glass-card:hover {
                transform: translateY(-4px) scale(1.01);
            }
            
            .btn-premium:hover, .btn-outline:hover {
                transform: translateY(-1px);
            }
        }
        
        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient-primary);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }
        
        .loading-logo {
            animation: loadingPulse 1.5s ease-in-out infinite;
        }
        
        @keyframes loadingPulse {
            0%, 100% { opacity: 0.7; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.1); }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--primary);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--gradient-accent);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #ff6b7a 0%, #e94560 100%);
        }
    </style>
</head>

<body class="bg-gray-900 text-white">
    <!-- Loading Screen -->
    <div id="loading-overlay" class="loading-overlay">
        <div class="loading-logo text-center">
            <img src="../public_html/assets/images/AF_Just_Logo.svg" class="w-24 h-24 mx-auto mb-4" alt="AdegaFlow Logo">
            <div class="text-white text-xl font-semibold">Carregando...</div>
        </div>
    </div>

    <!-- Navigation Premium -->
    <nav id="navbar" class="navbar-premium fixed top-0 w-full z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo Premium -->
                <div class="flex items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-wine-bottle text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">Adega<span class="text-red-400">Flow</span></h1>
                            <p class="text-xs text-gray-400">Sistema Profissional</p>
                        </div>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="#home" class="nav-link text-gray-300 hover:text-white transition-all duration-300 relative group">
                        <span>Início</span>
                        <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-400 group-hover:w-full transition-all duration-300"></div>
                    </a>
                    <a href="#about" class="nav-link text-gray-300 hover:text-white transition-all duration-300 relative group">
                        <span>Sobre</span>
                        <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-400 group-hover:w-full transition-all duration-300"></div>
                    </a>
                    <a href="#features" class="nav-link text-gray-300 hover:text-white transition-all duration-300 relative group">
                        <span>Funcionalidades</span>
                        <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-400 group-hover:w-full transition-all duration-300"></div>
                    </a>
                    <a href="#screenshots" class="nav-link text-gray-300 hover:text-white transition-all duration-300 relative group">
                        <span>Interface</span>
                        <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-400 group-hover:w-full transition-all duration-300"></div>
                    </a>
                    <a href="#contact" class="nav-link text-gray-300 hover:text-white transition-all duration-300 relative group">
                        <span>Contato</span>
                        <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-red-400 group-hover:w-full transition-all duration-300"></div>
                    </a>
                </div>

                <!-- CTA Button -->
                <div class="hidden lg:block">
                    <a href="login" class="btn-premium px-6 py-3 rounded-xl text-white font-semibold text-sm inline-flex items-center space-x-2">
                        <i class="fas fa-rocket"></i>
                        <span>Acessar Sistema</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button id="mobile-menu-btn" class="text-white p-2 rounded-lg hover:bg-white/10 transition-all">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden hidden">
                <div class="glass rounded-2xl m-4 p-6 space-y-4">
                    <a href="#home" class="nav-link block text-white hover:text-red-400 transition-all py-2">Início</a>
                    <a href="#about" class="nav-link block text-white hover:text-red-400 transition-all py-2">Sobre</a>
                    <a href="#features" class="nav-link block text-white hover:text-red-400 transition-all py-2">Funcionalidades</a>
                    <a href="#screenshots" class="nav-link block text-white hover:text-red-400 transition-all py-2">Interface</a>
                    <a href="#contact" class="nav-link block text-white hover:text-red-400 transition-all py-2">Contato</a>
                    <div class="pt-4 border-t border-white/20">
                        <a href="login" class="btn-premium w-full px-6 py-3 rounded-xl text-white font-semibold text-center inline-flex items-center justify-center space-x-2">
                            <i class="fas fa-rocket"></i>
                            <span>Acessar Sistema</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section Premium -->
    <section id="home" class="hero-gradient min-h-screen flex items-center relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-20 h-20 bg-red-500/10 rounded-full floating" style="animation-delay: 0s;"></div>
            <div class="absolute top-40 right-20 w-16 h-16 bg-blue-500/10 rounded-full floating" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-40 left-20 w-12 h-12 bg-purple-500/10 rounded-full floating" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-20 right-40 w-24 h-24 bg-green-500/10 rounded-full floating" style="animation-delay: 0.5s;"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <!-- Logo Hero -->
                <div class="mb-8" data-aos="fade-up" data-aos-duration="1000">
                    <div class="inline-block">
                        <img src="../public_html/assets/images/AF_Just_Logo.svg" class="w-32 h-32 mx-auto" alt="AdegaFlow Logo Profissional">
                    </div>
                </div>

                <!-- Main Title -->
                <div class="mb-8" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white mb-6">
                        <span class=" text-amber-50">Adega</span>
                        <span class="text-amber-50">Flow</span>
                    </h1>
                    <div class="w-32 h-1 bg-gradient-to-r from-red-400 to-red-600 mx-auto rounded-full"></div>
                </div>

                <!-- Subtitle -->
                <div class="mb-8" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    <h2 class="text-2xl md:text-4xl lg:text-5xl font-bold text-white mb-6">
                        <span class="text-gray-200">Sistema de Gestão</span>
                        <br>
                        <span class="text-gray-200">de Adegas</span>
                    </h2>
                    <p class="text-lg md:text-xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
                        Transforme sua adega com nossa solução completa de gestão empresarial. 
                        Tecnologia de ponta, design premium e performance incomparável para levar seu negócio ao próximo nível.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="mb-16" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                        <a href="login" class="btn-premium px-10 py-5 rounded-2xl text-white font-bold text-lg inline-flex items-center space-x-3 group">
                            <i class="fas fa-rocket group-hover:rotate-12 transition-transform"></i>
                            <span>Iniciar Agora</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <!-- <button class="btn-outline px-10 py-5 rounded-2xl text-white font-bold text-lg inline-flex items-center space-x-3 group">
                            <i class="fas fa-play group-hover:scale-110 transition-transform"></i>
                            <span>Ver Demonstração</span>
                        </button> -->
                    </div>
                </div>

                <!-- Stats Premium -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">
                    <div class="glass-card rounded-2xl p-6 text-center">
                        <div class="counter text-red-400 mb-2" data-target="100">0</div>
                        <div class="text-gray-300 text-sm font-medium">% Responsivo</div>
                    </div>
                
                    <div class="glass-card rounded-2xl p-6 text-center">
                        <div class="counter text-green-400 mb-2" data-target="24">0</div>
                        <div class="text-gray-300 text-sm font-medium">Suporte 24h</div>
                    </div>
                    <div class="glass-card rounded-2xl p-6 text-center">
                        <div class="counter text-purple-400 mb-2" data-target="99">0</div>
                        <div class="text-gray-300 text-sm font-medium">% Uptime</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <div class="w-8 h-12 border-2 border-white/30 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-white rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </section>

    <!-- About Section Premium -->
    <section id="about" class="py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-6xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-20" data-aos="fade-up">
                    <div class="inline-flex items-center space-x-2 bg-red-500/10 px-4 py-2 rounded-full mb-6">
                        <i class="fas fa-award text-red-400"></i>
                        <span class="text-red-400 font-medium">Sobre o Sistema</span>
                    </div>
                    <h2 class="text-4xl md:text-6xl font-black text-white mb-8">
                        Inovação e <span class="text-red-400">Excelência</span>
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-red-400 to-red-600 mx-auto rounded-full mb-8"></div>
                    <p class="text-xl text-gray-300 leading-relaxed max-w-4xl mx-auto">
                        O AdegaFlow representa o futuro da gestão empresarial para adegas. Desenvolvido com as mais avançadas tecnologias web e design thinking, oferece uma experiência única que eleva seu negócio a novos patamares de eficiência e profissionalismo.
                    </p>
                </div>

                <!-- Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <!-- Left Content -->
                    <div class="space-y-8" data-aos="fade-right">
                        <div class="feature-premium rounded-3xl p-8">
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center">
                                    <i class="fas fa-code text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">Tecnologia de Ponta</h3>
                                </div>
                            </div>
                            <p class="text-gray-300 leading-relaxed">
                                Arquitetura moderna e escalável, desenvolvida seguindo as melhores práticas de engenharia de software para garantir performance e confiabilidade excepcionais.
                            </p>
                        </div>

                        <div class="feature-premium rounded-3xl p-8">
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">Segurança Avançada</h3>
                                    <p class="text-gray-400">Proteção multicamadas</p>
                                </div>
                            </div>
                            <p class="text-gray-300 leading-relaxed">
                                Implementação de protocolos de segurança enterprise-grade, criptografia de dados e controles de acesso granulares para proteger suas informações críticas.
                            </p>
                        </div>

                        <div class="feature-premium rounded-3xl p-8">
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center">
                                    <i class="fas fa-mobile-alt text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">Design Responsivo</h3>
                                    <p class="text-gray-400">Experiência premium em qualquer dispositivo</p>
                                </div>
                            </div>
                            <p class="text-gray-300 leading-relaxed">
                                Interface adaptive que se molda perfeitamente a smartphones, tablets e desktops, oferecendo uma experiência consistente e otimizada em qualquer plataforma.
                            </p>
                        </div>
                    </div>

                    <!-- Right Content -->
                    <div data-aos="fade-left">
                        <div class="parallax-container">
                            <div class="glass-card rounded-3xl p-8 parallax-image">
                                <div class="text-center mb-8">
                                    <h3 class="text-2xl font-bold text-white mb-4">Métricas de Performance</h3>
                                    <p class="text-gray-400">Indicadores de qualidade técnica</p>
                                </div>
                                
                                <div class="space-y-6">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-300">Performance Score</span>
                                        <div class="flex items-center space-x-3">
                                            <div class="w-32 bg-gray-700 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-green-400 to-green-500 h-2 rounded-full" style="width: 98%"></div>
                                            </div>
                                            <span class="text-green-400 font-bold">98%</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-300">SEO Optimization</span>
                                        <div class="flex items-center space-x-3">
                                            <div class="w-32 bg-gray-700 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-blue-400 to-blue-500 h-2 rounded-full" style="width: 95%"></div>
                                            </div>
                                            <span class="text-blue-400 font-bold">95%</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-300">Accessibility</span>
                                        <div class="flex items-center space-x-3">
                                            <div class="w-32 bg-gray-700 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-purple-400 to-purple-500 h-2 rounded-full" style="width: 96%"></div>
                                            </div>
                                            <span class="text-purple-400 font-bold">96%</span>
                                        </div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-300">Best Practices</span>
                                        <div class="flex items-center space-x-3">
                                            <div class="w-32 bg-gray-700 rounded-full h-2">
                                                <div class="bg-gradient-to-r from-red-400 to-red-500 h-2 rounded-full" style="width: 100%"></div>
                                            </div>
                                            <span class="text-red-400 font-bold">100%</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-8 pt-6 border-t border-white/10">
                                    <div class="flex justify-center space-x-8">
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-green-400">A+</div>
                                            <div class="text-xs text-gray-400">Security</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-blue-400">A+</div>
                                            <div class="text-xs text-gray-400">Performance</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-2xl font-bold text-purple-400">A+</div>
                                            <div class="text-xs text-gray-400">Quality</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section Premium -->
    <section id="features" class="py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-800 via-gray-900 to-black"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-20" data-aos="fade-up">
                <div class="inline-flex items-center space-x-2 bg-blue-500/10 px-4 py-2 rounded-full mb-6">
                    <i class="fas fa-star text-blue-400"></i>
                    <span class="text-blue-400 font-medium">Funcionalidades</span>
                </div>
                <h2 class="text-4xl md:text-6xl font-black text-white mb-8">
                    Recursos <span class="text-blue-400">Extraordinários</span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-400 to-blue-600 mx-auto rounded-full mb-8"></div>
                <p class="text-xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
                    Cada funcionalidade foi meticulosamente desenvolvida para oferecer máxima eficiência e simplicidade, proporcionando uma experiência de gestão sem precedentes.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="glass-card rounded-3xl p-8 text-center group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-boxes text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Gestão de Estoque</h3>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        Controle inteligente de inventário com rastreamento em tempo real, alertas automáticos e análise preditiva de demanda.
                    </p>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2 text-sm text-gray-300">
                            <i class="fas fa-check text-green-400"></i>
                            <span>Rastreamento em tempo real</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-300">
                            <i class="fas fa-check text-green-400"></i>
                            <span>Alertas inteligentes</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-300">
                            <i class="fas fa-check text-green-400"></i>
                            <span>Análise preditiva</span>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="glass-card rounded-3xl p-8 text-center group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-shopping-cart text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Sistema de Vendas</h3>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        Plataforma de vendas completa com checkout otimizado, gestão de clientes e análise de performance de vendas.
                    </p>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2 text-sm text-gray-300">
                            <i class="fas fa-check text-green-400"></i>
                            <span>Checkout otimizado</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-300">
                            <i class="fas fa-check text-green-400"></i>
                            <span>CRM integrado</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-300">
                            <i class="fas fa-check text-green-400"></i>
                            <span>Métricas avançadas</span>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="glass-card rounded-3xl p-8 text-center group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-20 h-20 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-cash-register text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Controle Financeiro</h3>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        Módulo financeiro robusto com fluxo de caixa, conciliação bancária e planejamento orçamentário avançado.
                    </p>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2 text-sm text-gray-300">
                            <i class="fas fa-check text-green-400"></i>
                            <span>Fluxo de caixa</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-300">
                            <i class="fas fa-check text-green-400"></i>
                            <span>Conciliação automática</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-300">
                            <i class="fas fa-check text-green-400"></i>
                            <span>Planejamento orçamentário</span>
                        </div>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="glass-card rounded-3xl p-8 text-center group" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl mx-auto mb-6 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="fas fa-chart-bar text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Analytics & BI</h3>
                    <p class="text-gray-400 mb-6 leading-relaxed">
                        Business Intelligence com dashboards interativos, relatórios customizáveis e insights acionáveis para decisões estratégicas.
                    </p>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2 text-sm text-gray-300">
                            <i class="fas fa-check text-green-400"></i>
                            <span>Dashboards interativos</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-300">
                            <i class="fas fa-check text-green-400"></i>
                            <span>Relatórios customizáveis</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm text-gray-300">
                            <i class="fas fa-check text-green-400"></i>
                            <span>Insights acionáveis</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Features -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="glass-card rounded-2xl p-6 text-center" data-aos="fade-up" data-aos-delay="500">
                    <div class="w-12 h-12 bg-red-500/20 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-rocket text-red-400"></i>
                    </div>
                    <h4 class="font-bold text-white mb-2">Performance Otimizada</h4>
                    <p class="text-gray-400 text-sm">Carregamento ultra-rápido e navegação fluida</p>
                </div>

                <div class="glass-card rounded-2xl p-6 text-center" data-aos="fade-up" data-aos-delay="600">
                    <div class="w-12 h-12 bg-blue-500/20 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-cloud text-blue-400"></i>
                    </div>
                    <h4 class="font-bold text-white mb-2">Cloud-Ready</h4>
                    <p class="text-gray-400 text-sm">Arquitetura preparada para nuvem</p>
                </div>

                <div class="glass-card rounded-2xl p-6 text-center" data-aos="fade-up" data-aos-delay="700">
                    <div class="w-12 h-12 bg-green-500/20 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-sync text-green-400"></i>
                    </div>
                    <h4 class="font-bold text-white mb-2">Atualizações Automáticas</h4>
                    <p class="text-gray-400 text-sm">Sempre atualizado com as últimas funcionalidades</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Screenshots Section Premium -->
    <section id="screenshots" class="py-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-black via-gray-900 to-gray-800"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-20" data-aos="fade-up">
                <div class="inline-flex items-center space-x-2 bg-purple-500/10 px-4 py-2 rounded-full mb-6">
                    <i class="fas fa-desktop text-purple-400"></i>
                    <span class="text-purple-400 font-medium">Interface</span>
                </div>
                <h2 class="text-4xl md:text-6xl font-black text-white mb-8">
                    Design <span class="text-purple-400">Excepcional</span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-purple-400 to-purple-600 mx-auto rounded-full mb-8"></div>
                <p class="text-xl text-gray-300 max-w-4xl mx-auto leading-relaxed">
                    Uma interface que redefine padrões de qualidade, combinando elegância visual com funcionalidade intuitiva para uma experiência de usuário incomparável.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Desktop View -->
                <div class="order-2 lg:order-1" data-aos="fade-right">
                    <div class="space-y-8">
                        <div>
                            <h3 class="text-3xl font-bold text-white mb-4">Interface Desktop</h3>
                            <p class="text-gray-300 leading-relaxed mb-6">
                                Dashboard executivo com visualizações avançadas, controles intuitivos e navegação otimizada para máxima produtividade em estações de trabalho.
                            </p>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-check text-green-400"></i>
                                    <span class="text-gray-300">Dashboard executivo interativo</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-check text-green-400"></i>
                                    <span class="text-gray-300">Gráficos em tempo real</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-check text-green-400"></i>
                                    <span class="text-gray-300">Interface multi-monitor</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-check text-green-400"></i>
                                    <span class="text-gray-300">Atalhos de teclado avançados</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="glass-card rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-blue-400 mb-1">4K</div>
                                <div class="text-xs text-gray-400">Ultra HD Ready</div>
                            </div>
                            <div class="glass-card rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-green-400 mb-1">60fps</div>
                                <div class="text-xs text-gray-400">Smooth Animations</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2" data-aos="fade-left">
                    <div class="parallax-container">
                        <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-8 rounded-3xl shadow-2xl parallax-image">
                            <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                                <img 
                                    src="../public_html/assets/images/AF_HP.png"
                                    alt="Interface desktop premium do AdegaFlow mostrando dashboard executivo com métricas avançadas, gráficos interativos e painel de controle empresarial"
                                    class="w-full h-auto"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile View -->
            <div class="mt-32 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <div class="flex justify-center">
                        <div class="relative">
                            <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-[3rem] shadow-2xl">
                                <div class="bg-black p-2 rounded-[2.5rem] shadow-inner">
                                    <div class="bg-white rounded-[2rem] overflow-hidden">
                                        <img 
                                            src="../public_html/assets/images/AF_Mobile.png"
                                            alt="Interface mobile premium do AdegaFlow com design adaptativo, navegação touch otimizada e experiência mobile-first"
                                            class="w-full h-auto"
                                        />
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile Decorations -->
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-gray-600 rounded-full"></div>
                            <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 w-16 h-16 bg-gray-700 rounded-full border-4 border-gray-600"></div>
                        </div>
                    </div>
                </div>

                <div data-aos="fade-left">
                    <div class="space-y-8">
                        <div>
                            <h3 class="text-3xl font-bold text-white mb-4">Experiência Mobile</h3>
                            <p class="text-gray-300 leading-relaxed mb-6">
                                App mobile nativo com gestos intuitivos, interface touch-first e sincronização perfeita com a versão desktop para produtividade em qualquer lugar.
                            </p>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-check text-green-400"></i>
                                    <span class="text-gray-300">Gestos intuitivos e naturais</span>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-check text-green-400"></i>
                                    <span class="text-gray-300">Notificações push personalizadas</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-check text-green-400"></i>
                                    <span class="text-gray-300">Sincronização em tempo real</span>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>

            <!-- Features Highlight -->
            <div class="mt-32 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="glass-card rounded-2xl p-6 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 bg-blue-500/20 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-paint-brush text-blue-400"></i>
                    </div>
                    <h4 class="font-bold text-white mb-2">Design System</h4>
                    <p class="text-gray-400 text-sm">Componentes consistentes e escaláveis</p>
                </div>

                <div class="glass-card rounded-2xl p-6 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-green-500/20 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-universal-access text-green-400"></i>
                    </div>
                    <h4 class="font-bold text-white mb-2">Acessibilidade</h4>
                    <p class="text-gray-400 text-sm">WCAG 2.1 AAA compliant</p>
                </div>

                

                <div class="glass-card rounded-2xl p-6 text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-12 h-12 bg-red-500/20 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-magic text-red-400"></i>
                    </div>
                    <h4 class="font-bold text-white mb-2">Micro-interactions</h4>
                    <p class="text-gray-400 text-sm">Animações que encantam</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section Premium -->
    <section class="py-32 hero-gradient relative overflow-hidden">
        <!-- Floating Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-32 h-32 bg-red-500/5 rounded-full floating"></div>
            <div class="absolute bottom-20 right-10 w-24 h-24 bg-blue-500/5 rounded-full floating" style="animation-delay: 1s;"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="max-w-5xl mx-auto" data-aos="fade-up">
                <h2 class="text-4xl md:text-6xl font-black text-white mb-8">
                    Pronto para o <span class="text-red-400">Futuro</span>?
                </h2>
                <div class="w-32 h-1 bg-gradient-to-r from-red-400 to-red-600 mx-auto rounded-full mb-8"></div>
                <p class="text-xl md:text-2xl text-gray-300 mb-12 leading-relaxed">
                    Junte-se à revolução da gestão empresarial e transforme sua adega com tecnologia de ponta, 
                    design premium e performance incomparável.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                    <a href="login" class="btn-premium px-12 py-6 rounded-2xl text-white font-bold text-xl inline-flex items-center space-x-3 group">
                        <i class="fas fa-rocket group-hover:rotate-12 transition-transform"></i>
                        <span>Iniciar Jornada</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <!-- <button class="btn-outline px-12 py-6 rounded-2xl text-white font-bold text-xl inline-flex items-center space-x-3 group">
                        <i class="fas fa-phone group-hover:scale-110 transition-transform"></i>
                        <span>Falar com Especialista</span>
                    </button> -->
                </div>

                <!-- Trust Indicators -->
                <div class="glass-card rounded-2xl p-8 max-w-3xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-400 mb-2">99.9%</div>
                            <div class="text-gray-300">Uptime Garantido</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-400 mb-2">24/7</div>
                            <div class="text-gray-300">Suporte Premium</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-400 mb-2">SSL</div>
                            <div class="text-gray-300">Segurança Total</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Premium -->
    <footer id="contact" class="bg-black py-20 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
                <!-- Brand -->
                <div class="lg:col-span-2" data-aos="fade-up">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-wine-bottle text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-white">Adega<span class="text-red-400">Flow</span></h3>
                            <p class="text-gray-400">Sistema Profissional de Gestão</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-8 leading-relaxed max-w-md">
                        Transformando a gestão de adegas através de tecnologia de ponta, design excepcional e inovação constante. 
                        Sua parceria para o sucesso empresarial.
                    </p>
                    <div class="flex space-x-4">
                        <!-- <a href="#" class="w-12 h-12 bg-gray-800 hover:bg-red-500 rounded-xl flex items-center justify-center transition-all group">
                            <i class="fab fa-linkedin text-gray-300 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gray-800 hover:bg-red-500 rounded-xl flex items-center justify-center transition-all group">
                            <i class="fab fa-twitter text-gray-300 group-hover:text-white"></i>
                        </a> -->
                        <a href="#" class="w-12 h-12 bg-gray-800 hover:bg-red-500 rounded-xl flex items-center justify-center transition-all group">
                            <i class="fab fa-instagram text-gray-300 group-hover:text-white"></i>
                        </a>
                        <!-- <a href="#" class="w-12 h-12 bg-gray-800 hover:bg-red-500 rounded-xl flex items-center justify-center transition-all group">
                            <i class="fab fa-github text-gray-300 group-hover:text-white"></i>
                        </a> -->
                    </div>
                </div>

                <!-- Contact -->
                <div data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-xl font-bold text-white mb-6">Contato Premium</h4>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-envelope text-red-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-300">adegaflowservice@gmail.com</p>
                                <p class="text-gray-500 text-sm">Suporte 24h</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <i class="fab fa-whatsapp text-green-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-300">(11) 95031-8382</p>
                                <p class="text-gray-500 text-sm">WhatsApp Business</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-blue-400"></i>
                            </div>
                            <div>
                                <p class="text-gray-300">São Paulo, SP</p>
                                <p class="text-gray-500 text-sm">Brasil</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div data-aos="fade-up" data-aos-delay="300">
                    <h4 class="text-xl font-bold text-white mb-6">Links Rápidos</h4>
                    <div class="space-y-3">
                        <a href="#home" class="block text-gray-300 hover:text-red-400 transition-colors">Início</a>
                        <a href="#about" class="block text-gray-300 hover:text-red-400 transition-colors">Sobre o Sistema</a>
                        <a href="#features" class="block text-gray-300 hover:text-red-400 transition-colors">Funcionalidades</a>
                        <a href="#screenshots" class="block text-gray-300 hover:text-red-400 transition-colors">Interface</a>
                        <a href="login" class="block text-gray-300 hover:text-red-400 transition-colors">Acessar Sistema</a>
                        <a href="#" class="block text-gray-300 hover:text-red-400 transition-colors">Suporte Técnico</a>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 mt-16 pt-8">
                <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
                    <p class="text-gray-400 text-sm">
                        © <?php echo date('Y'); ?> AdegaFlow. Todos os direitos reservados. Desenvolvido com ♥ no Brasil.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-gray-400 hover:text-red-400 transition-colors">Política de Privacidade</a>
                        <a href="#" class="text-gray-400 hover:text-red-400 transition-colors">Termos de Uso</a>
                        <a href="#" class="text-gray-400 hover:text-red-400 transition-colors">LGPD</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            // Initialize AOS
            AOS.init({
                duration: 1000,
                easing: 'ease-out-cubic',
                once: true,
                offset: 100
            });

            // Loading Screen
            setTimeout(function() {
                $('#loading-overlay').fadeOut(500);
            }, 1500);

            // Counter Animation
            function animateCounters() {
                $('.counter').each(function() {
                    const $this = $(this);
                    const target = parseInt($this.data('target'));
                    const duration = 2000;
                    const steps = 50;
                    const increment = target / steps;
                    let current = 0;
                    
                    const timer = setInterval(function() {
                        current += increment;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        $this.text(Math.floor(current) + (target === 8 ? '+' : ''));
                    }, duration / steps);
                });
            }

            // Trigger counter animation when in view
            let countersAnimated = false;
            $(window).on('scroll', function() {
                if (!countersAnimated && $('.counter').length) {
                    const counterTop = $('.counter').first().offset().top;
                    const scrollTop = $(window).scrollTop();
                    const windowHeight = $(window).height();
                    
                    if (scrollTop + windowHeight > counterTop + 100) {
                        animateCounters();
                        countersAnimated = true;
                    }
                }
            });

            // Smooth Scrolling
            $('.nav-link').on('click', function(e) {
                e.preventDefault();
                const target = $(this).attr('href');
                const targetSection = $(target);
                
                if (targetSection.length) {
                    $('html, body').animate({
                        scrollTop: targetSection.offset().top - 80
                    }, 1000, 'easeInOutCubic');
                }
                
                // Close mobile menu
                $('#mobile-menu').addClass('hidden');
            });

            // Mobile Menu Toggle
            $('#mobile-menu-btn').on('click', function() {
                $('#mobile-menu').toggleClass('hidden');
                const isOpen = !$('#mobile-menu').hasClass('hidden');
                $(this).find('i').toggleClass('fa-bars fa-times');
            });

            // Navbar Scroll Effect
            $(window).on('scroll', function() {
                const scroll = $(window).scrollTop();
                if (scroll > 100) {
                    $('#navbar').addClass('navbar-scrolled');
                } else {
                    $('#navbar').removeClass('navbar-scrolled');
                }
            });

            // Parallax Effect
            $(window).on('scroll', function() {
                const scrolled = $(window).scrollTop();
                const rate = scrolled * -0.5;
                $('.floating').css('transform', 'translateY(' + rate + 'px)');
            });

            // Enhanced Button Effects
            $('.btn-premium, .btn-outline').on('mouseenter', function() {
                $(this).addClass('transform scale-105');
            }).on('mouseleave', function() {
                $(this).removeClass('transform scale-105');
            });

            // Progressive Image Loading
            $('img').each(function() {
                const $img = $(this);
                $img.on('load', function() {
                    $img.addClass('loaded');
                });
            });

            // Custom Cursor Effect (Desktop only)
            if ($(window).width() > 768) {
                let cursor = $('<div class="custom-cursor"></div>').appendTo('body');
                
                $(document).on('mousemove', function(e) {
                    cursor.css({
                        left: e.clientX,
                        top: e.clientY
                    });
                });

                $('a, button').hover(
                    function() { cursor.addClass('cursor-hover'); },
                    function() { cursor.removeClass('cursor-hover'); }
                );
            }

            // Performance Monitoring
            window.addEventListener('load', function() {
                setTimeout(function() {
                    const perfData = performance.getEntriesByType('navigation')[0];
                    console.log(`Page Load Time: ${Math.round(perfData.loadEventEnd - perfData.loadEventStart)}ms`);
                }, 0);
            });
        });

        // Custom easing function
        $.easing.easeInOutCubic = function (x, t, b, c, d) {
            if ((t/=d/2) < 1) return c/2*t*t*t + b;
            return c/2*((t-=2)*t*t + 2) + b;
        };
    </script>

    <!-- Custom Cursor Styles -->
    <style>
        .custom-cursor {
            width: 20px;
            height: 20px;
            border: 2px solid #e94560;
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            transition: all 0.1s ease;
            transform: translate(-50%, -50%);
        }
        
        .cursor-hover {
            width: 40px;
            height: 40px;
            background: rgba(233, 69, 96, 0.1);
            border-color: #e94560;
        }
        
        img {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        img.loaded {
            opacity: 1;
        }
    </style>
</body>
</html>
