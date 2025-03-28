<?php
// Manejo de sesión solo en la vista
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit();
}

require_once __DIR__ . '/../../controllers/RutasController.php';
$controller = new RutasController();
$data = $controller->handleEditRequest();

// Mensajes
$error = $data['error'] ?? null;
$ruta = $data['ruta'];
$dificultades = $data['dificultades'];
$estados = $data['estados'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ruta - AppCamiones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 2rem 0;
        }
        .form-container {
            max-width: 800px;
            width: 100%;
            margin: 0 auto;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
        .form-title {
            color: #2c3e50;
            border-bottom: 2px solid #f8f9fa;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        .btn-action {
            min-width: 120px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../auth/dashboard.php">
                <i class="bi bi-truck me-2"></i>AppCamiones
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../auth/dashboard.php"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="list.php"><i class="bi bi-signpost-2 me-1"></i> Rutas</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i> <?php echo htmlspecialchars($_SESSION['user']['nombre']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../auth/perfil.php"><i class="bi bi-person me-2"></i> Mi Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="../../controllers/AuthController.php?logout=true"><i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido principal - Centrado verticalmente -->
    <main class="main-content">
        <div class="container">
            <div class="form-container">
                <h2 class="form-title text-center"><i class="bi bi-signpost-2 me-2"></i>Editar Ruta #<?= htmlspecialchars($ruta['id_ruta']) ?></h2>
                
                <!-- Mensajes de feedback -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?= htmlspecialchars($error) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="edit.php?action=editar&id=<?= $ruta['id_ruta'] ?>" id="rutaForm">
                    <div class="row g-3">
                        <!-- Sección 1: Datos básicos -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="origen" class="form-label required-field">Origen</label>
                                <input type="text" class="form-control" id="origen" name="origen" required
                                    value="<?= htmlspecialchars($ruta['origen']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="destino" class="form-label required-field">Destino</label>
                                <input type="text" class="form-control" id="destino" name="destino" required
                                    value="<?= htmlspecialchars($ruta['destino']) ?>">
                            </div>
                        </div>
                        
                        <!-- Sección 2: Detalles de la ruta -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="distancia" class="form-label required-field">Distancia (km)</label>
                                <input type="number" step="0.01" class="form-control" id="distancia" name="distancia" required
                                    value="<?= htmlspecialchars($ruta['distancia']) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tiempo_estimado" class="form-label required-field">Tiempo Estimado</label>
                                <input type="text" class="form-control" id="tiempo_estimado" name="tiempo_estimado" required
                                    placeholder="Ej: 2 horas 30 minutos"
                                    value="<?= htmlspecialchars($ruta['tiempo_estimado']) ?>">
                            </div>
                        </div>
                        
                        <!-- Sección 3: Dificultad y estado -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dificultad" class="form-label required-field">Dificultad</label>
                                <select class="form-select" id="dificultad" name="id_dificultad" required>
                                    <option value="">Seleccione una dificultad</option>
                                    <?php foreach ($dificultades as $dificultad): ?>
                                        <option value="<?= $dificultad['id_dificultad'] ?>"
                                            <?= ($ruta['id_dificultad'] == $dificultad['id_dificultad']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($dificultad['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="estado" class="form-label required-field">Estado</label>
                                <select class="form-select" id="estado" name="id_estado_ruta" required>
                                    <option value="">Seleccione un estado</option>
                                    <?php foreach ($estados as $estado): ?>
                                        <option value="<?= $estado['id_estado_ruta'] ?>"
                                            <?= ($ruta['id_estado_ruta'] == $estado['id_estado_ruta']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($estado['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <button type="submit" class="btn btn-primary btn-action me-2">
                                <i class="bi bi-save me-1"></i> Guardar Cambios
                            </button>
                            <button type="reset" class="btn btn-outline-secondary btn-action">
                                <i class="bi bi-eraser me-1"></i> Restablecer
                            </button>
                        </div>
                        <a href="list.php" class="btn btn-secondary btn-action">
                            <i class="bi bi-arrow-left me-1"></i> Volver al listado
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Auto-ocultar mensajes después de 5 segundos
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
            
            // Asegurar que el foco esté en el primer campo al cargar
            $('#origen').focus();
        });
    </script>
</body>
</html>