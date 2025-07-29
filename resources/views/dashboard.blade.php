<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mis Gremios</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --gold-color: #f39c12;
            --dark-bg: #34495e;
            --light-bg: #ecf0f1;
            --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --gradient-4: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .navbar {
            background: var(--primary-color) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }

        .hero-section {
            background: var(--gradient-1);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
            border-radius: 0 0 50px 50px;
        }

        .guild-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .guild-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .guild-header {
            height: 120px;
            position: relative;
            overflow: hidden;
        }

        .guild-header.warrior {
            background: var(--gradient-2);
        }

        .guild-header.mage {
            background: var(--gradient-1);
        }

        .guild-header.merchant {
            background: var(--gradient-4);
        }

        .guild-header.craftsman {
            background: var(--gradient-3);
        }

        .guild-icon {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            font-size: 3rem;
            opacity: 0.3;
        }

        .guild-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(255,255,255,0.9);
            color: var(--primary-color);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .guild-info {
            padding: 25px;
        }

        .guild-title {
            font-size: 1.4rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .guild-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .guild-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .stat-label {
            font-size: 0.8rem;
            color: #888;
        }

        .guild-actions {
            display: flex;
            gap: 10px;
        }

        .btn-guild {
            flex: 1;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary-custom {
            background: var(--secondary-color);
            border: none;
            color: white;
        }

        .btn-primary-custom:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .btn-outline-custom {
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
            background: transparent;
        }

        .btn-outline-custom:hover {
            background: var(--secondary-color);
            color: white;
        }

        .create-guild-card {
            border: 2px dashed #bdc3c7;
            background: rgba(255,255,255,0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 350px;
            border-radius: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .create-guild-card:hover {
            border-color: var(--secondary-color);
            background: rgba(255,255,255,0.9);
            transform: translateY(-5px);
        }

        .create-guild-content {
            text-align: center;
            color: #7f8c8d;
        }

        .create-guild-content:hover {
            color: var(--secondary-color);
        }

        .stats-overview {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .overview-stat {
            text-align: center;
        }

        .overview-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .overview-label {
            color: #7f8c8d;
            font-weight: 500;
        }

        .section-title {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 30px;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 40px 0;
            }

            .guild-stats {
                flex-direction: column;
                gap: 15px;
            }

            .guild-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-shield-alt me-2"></i>
            GuildSpace
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Explorar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mensajes</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i>
                        Mi Perfil
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-4 mb-3">
                    <i class="fas fa-crown me-3"></i>
                    Bienvenido, Maestro Artesano
                </h1>
                <p class="lead">Gestiona tus gremios, conecta con otros miembros y haz crecer tu comunidad</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Stats Overview -->
    <div class="stats-overview">
        <div class="row">
            <div class="col-md-3 col-6">
                <div class="overview-stat">
                    <div class="overview-number">4</div>
                    <div class="overview-label">Gremios Activos</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="overview-stat">
                    <div class="overview-number">156</div>
                    <div class="overview-label">Compañeros</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="overview-stat">
                    <div class="overview-number">23</div>
                    <div class="overview-label">Proyectos</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="overview-stat">
                    <div class="overview-number">89%</div>
                    <div class="overview-label">Participación</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mis Gremios -->
    <h2 class="section-title">
        <i class="fas fa-users me-2"></i>
        Mis Gremios
    </h2>

    <div class="row">
        <!-- Gremio 1 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card guild-card">
                <div class="guild-header warrior">
                    <div class="guild-badge">LÍDER</div>
                    <div class="guild-icon">
                        <i class="fas fa-sword"></i>
                    </div>
                </div>
                <div class="guild-info">
                    <h5 class="guild-title">Guerreros del Norte</h5>
                    <p class="guild-description">Gremio especializado en estrategias de combate y entrenamiento militar avanzado.</p>
                    <div class="guild-stats">
                        <div class="stat-item">
                            <div class="stat-number">45</div>
                            <div class="stat-label">Miembros</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">8</div>
                            <div class="stat-label">Misiones</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">95%</div>
                            <div class="stat-label">Actividad</div>
                        </div>
                    </div>
                    <div class="guild-actions">
                        <button class="btn btn-primary-custom btn-guild">Ingresar</button>
                        <button class="btn btn-outline-custom btn-guild">Gestionar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gremio 2 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card guild-card">
                <div class="guild-header mage">
                    <div class="guild-badge">MIEMBRO</div>
                    <div class="guild-icon">
                        <i class="fas fa-magic"></i>
                    </div>
                </div>
                <div class="guild-info">
                    <h5 class="guild-title">Academia Arcana</h5>
                    <p class="guild-description">Círculo de estudiosos dedicados al arte místico y la investigación mágica.</p>
                    <div class="guild-stats">
                        <div class="stat-item">
                            <div class="stat-number">32</div>
                            <div class="stat-label">Miembros</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">12</div>
                            <div class="stat-label">Estudios</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">88%</div>
                            <div class="stat-label">Actividad</div>
                        </div>
                    </div>
                    <div class="guild-actions">
                        <button class="btn btn-primary-custom btn-guild">Ingresar</button>
                        <button class="btn btn-outline-custom btn-guild">Perfil</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gremio 3 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card guild-card">
                <div class="guild-header merchant">
                    <div class="guild-badge">CO-LÍDER</div>
                    <div class="guild-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                </div>
                <div class="guild-info">
                    <h5 class="guild-title">Mercaderes Unidos</h5>
                    <p class="guild-description">Red de comerciantes especializados en rutas comerciales y negociaciones.</p>
                    <div class="guild-stats">
                        <div class="stat-item">
                            <div class="stat-number">67</div>
                            <div class="stat-label">Miembros</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">25</div>
                            <div class="stat-label">Contratos</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">92%</div>
                            <div class="stat-label">Actividad</div>
                        </div>
                    </div>
                    <div class="guild-actions">
                        <button class="btn btn-primary-custom btn-guild">Ingresar</button>
                        <button class="btn btn-outline-custom btn-guild">Administrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gremio 4 -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card guild-card">
                <div class="guild-header craftsman">
                    <div class="guild-badge">ARTESANO</div>
                    <div class="guild-icon">
                        <i class="fas fa-hammer"></i>
                    </div>
                </div>
                <div class="guild-info">
                    <h5 class="guild-title">Forjadores Élite</h5>
                    <p class="guild-description">Maestros artesanos especializados en la creación de objetos únicos y legendarios.</p>
                    <div class="guild-stats">
                        <div class="stat-item">
                            <div class="stat-number">28</div>
                            <div class="stat-label">Miembros</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">15</div>
                            <div class="stat-label">Obras</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">96%</div>
                            <div class="stat-label">Actividad</div>
                        </div>
                    </div>
                    <div class="guild-actions">
                        <button class="btn btn-primary-custom btn-guild">Ingresar</button>
                        <button class="btn btn-outline-custom btn-guild">Taller</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Crear Nuevo Gremio -->
    <h2 class="section-title mt-5">
        <i class="fas fa-plus-circle me-2"></i>
        Expandir Horizonte
    </h2>

    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="create-guild-card" onclick="createGuild()">
                <div class="create-guild-content">
                    <i class="fas fa-plus-circle fa-3x mb-3"></i>
                    <h5>Crear Nuevo Gremio</h5>
                    <p class="mb-0">Funda tu propia comunidad</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="create-guild-card" onclick="exploreGuilds()">
                <div class="create-guild-content">
                    <i class="fas fa-search fa-3x mb-3"></i>
                    <h5>Explorar Gremios</h5>
                    <p class="mb-0">Únete a comunidades existentes</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="create-guild-card" onclick="viewInvitations()">
                <div class="create-guild-content">
                    <i class="fas fa-envelope fa-3x mb-3"></i>
                    <h5>Invitaciones</h5>
                    <p class="mb-0">3 invitaciones pendientes</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="create-guild-card" onclick="viewRecommendations()">
                <div class="create-guild-content">
                    <i class="fas fa-star fa-3x mb-3"></i>
                    <h5>Recomendados</h5>
                    <p class="mb-0">Gremios sugeridos para ti</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    function createGuild() {
        alert('Funcionalidad para crear nuevo gremio - ¡Próximamente!');
    }

    function exploreGuilds() {
        alert('Navegando a la sección de explorar gremios...');
    }

    function viewInvitations() {
        alert('Mostrando invitaciones pendientes...');
    }

    function viewRecommendations() {
        alert('Cargando gremios recomendados...');
    }

    // Animación sutil al cargar
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.guild-card, .create-guild-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.6s ease';

                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 50);
            }, index * 100);
        });
    });
</script>
</body>
</html>
