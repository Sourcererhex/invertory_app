<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';
require_login();

$rows = db()->query('SELECT ID_CATEGORIA, NOMBRE_CAT, CODIGO FROM categoria ORDER BY ID_CATEGORIA DESC')->fetchAll();
$title = 'Categorías';
require __DIR__ . '/../partials/header.php';
require __DIR__ . '/../partials/nav.php';
require __DIR__ . '/../partials/flash.php';
?>
<div class="mb-4 flex items-center justify-between">
    <h1 class="text-3xl font-bold">Categorías</h1>
    <a href="create.php" class="rounded bg-blue-600 px-4 py-2 font-semibold text-white">Nueva categoría</a>
</div>
<div class="overflow-x-auto rounded-xl theme-surface shadow">
<table class="min-w-full">
<thead class="bg-slate-800 text-white"><tr><th class="p-3 text-left">ID</th><th class="p-3 text-left">Nombre</th><th class="p-3 text-left">Código</th><th class="p-3">Acciones</th></tr></thead>
<tbody>
<?php foreach ($rows as $row): ?>
<tr class="border-b border-slate-200 dark:border-slate-700">
<td class="p-3"><?= e((string)$row['ID_CATEGORIA']) ?></td>
<td class="p-3"><?= e($row['NOMBRE_CAT']) ?></td>
<td class="p-3"><?= e((string)$row['CODIGO']) ?></td>
<td class="p-3 text-center">
<a class="mr-2 rounded bg-amber-500 px-3 py-1 text-white" href="edit.php?id=<?= (int)$row['ID_CATEGORIA'] ?>">Editar</a>
<a class="rounded bg-red-600 px-3 py-1 text-white" href="delete.php?id=<?= (int)$row['ID_CATEGORIA'] ?>" onclick="return confirm('¿Eliminar categoría?')">Eliminar</a>
</td>
</tr>
<?php endforeach; ?>
</tbody></table></div>
<?php require __DIR__ . '/../partials/footer.php'; ?>
