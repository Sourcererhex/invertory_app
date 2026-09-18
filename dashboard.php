<?php
require_once __DIR__ . '/config/auth.php';
require_once __DIR__ . '/config/helpers.php';
require_login();
$title = 'Dashboard';
require __DIR__ . '/partials/header.php';
require __DIR__ . '/partials/nav.php';
?>
<h1 class="mb-6 text-3xl font-bold">Panel principal</h1>
<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    <a href="/material/index.php" class="rounded-xl theme-surface p-6 shadow hover:shadow-lg"><h2 class="text-xl font-bold">Materiales</h2><p class="mt-2 text-slate-500 dark:text-slate-400">Crear, consultar, modificar y eliminar.</p></a>
    <a href="/categoria/index.php" class="rounded-xl theme-surface p-6 shadow hover:shadow-lg"><h2 class="text-xl font-bold">Categorías</h2></a>
    <a href="/proveedor/index.php" class="rounded-xl theme-surface p-6 shadow hover:shadow-lg"><h2 class="text-xl font-bold">Proveedores</h2></a>
    <a href="/unidad_m/index.php" class="rounded-xl theme-surface p-6 shadow hover:shadow-lg"><h2 class="text-xl font-bold">Unidades de medida</h2></a>
    <?php if (($_SESSION['TIPO_USUARIO'] ?? '') === 'Administrador'): ?>
    <a href="/usuarios/index.php" class="rounded-xl theme-surface p-6 shadow hover:shadow-lg"><h2 class="text-xl font-bold">Usuarios</h2><p class="mt-2 text-slate-500 dark:text-slate-400">Solo administrador.</p></a>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/partials/footer.php'; ?>
