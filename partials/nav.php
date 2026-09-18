<?php require_once __DIR__ . '/../config/auth.php'; ?>
<nav class="bg-slate-900 text-white shadow">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3">
        <a href="/dashboard.php" class="text-xl font-bold">Inventario</a>
        <div class="flex items-center gap-3 text-sm">
            <span><?= e($_SESSION['USUARIO'] ?? '') ?></span>
            <button type="button" id="themeToggle" class="rounded-lg border border-slate-600 px-3 py-2 hover:bg-slate-800" aria-label="Cambiar tema">
                <span id="themeIcon">🌙</span> <span class="hidden sm:inline">Tema</span>
            </button>
            <a class="rounded bg-red-600 px-3 py-2 hover:bg-red-700" href="/logout.php">Salir</a>
        </div>
    </div>
</nav>
<div class="mx-auto max-w-7xl px-4 py-6">
    <div class="mb-6 flex flex-wrap gap-2">
        <a class="theme-surface rounded px-4 py-2 shadow hover:bg-slate-50 dark:hover:bg-slate-700" href="/material/index.php">Materiales</a>
        <a class="theme-surface rounded px-4 py-2 shadow hover:bg-slate-50 dark:hover:bg-slate-700" href="/categoria/index.php">Categorías</a>
        <a class="theme-surface rounded px-4 py-2 shadow hover:bg-slate-50 dark:hover:bg-slate-700" href="/proveedor/index.php">Proveedores</a>
        <a class="theme-surface rounded px-4 py-2 shadow hover:bg-slate-50 dark:hover:bg-slate-700" href="/unidad_m/index.php">Unidades</a>
        <?php if (($_SESSION['TIPO_USUARIO'] ?? '') === 'Administrador'): ?>
            <a class="theme-surface rounded px-4 py-2 shadow hover:bg-slate-50 dark:hover:bg-slate-700" href="/usuarios/index.php">Usuarios</a>
        <?php endif; ?>
    </div>
    <script>
    (function () {
        const root = document.documentElement;
        const button = document.getElementById('themeToggle');
        const icon = document.getElementById('themeIcon');
        function update() { icon.textContent = root.classList.contains('dark') ? '☀️' : '🌙'; }
        update();
        button?.addEventListener('click', function () {
            const dark = root.classList.toggle('dark');
            localStorage.setItem('inventory-theme', dark ? 'dark' : 'light');
            update();
        });
    })();
    </script>
