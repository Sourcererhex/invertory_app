<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/helpers.php';
require_login();
$title = 'Dashboard';
require __DIR__ . '/partials/header.php';
require __DIR__ . '/partials/nav.php';
?>
<h1>Panel principal</h1>
<div>
    <a href="/material/index.php"><h2>Materiales</h2><p>Crear, consultar, modificar y eliminar.</p></a>
    <a href="/categoria/index.php"><h2>Categorías</h2></a>
    <a href="/proveedor/index.php"><h2>Proveedores</h2></a>
    <a href="/unidad_m/index.php"><h2>Unidades de medida</h2></a>
    <?php if (($_SESSION['TIPO_USUARIO'] ?? '') === 'Administrador'): ?>
    <a href="/usuarios/index.php"><h2>Usuarios</h2><p>Solo administrador.</p></a>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/partials/footer.php'; ?>
