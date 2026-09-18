<?php
require_once __DIR__ . '/../config/auth.php'; require_once __DIR__ . '/../config/database.php'; require_once __DIR__ . '/../config/helpers.php'; require_login();
$rows=db()->query('SELECT ID_PRO,NOMBRE_PRO FROM proveedor ORDER BY ID_PRO DESC')->fetchAll(); $title='Proveedores';
require __DIR__.'/../partials/header.php'; require __DIR__.'/../partials/nav.php'; require __DIR__.'/../partials/flash.php'; ?>
<div class="mb-4 flex justify-between"><h1 class="text-3xl font-bold">Proveedores</h1><a href="create.php" class="rounded bg-blue-600 px-4 py-2 text-white">Nuevo proveedor</a></div>
<div class="overflow-x-auto rounded-xl theme-surface shadow"><table class="min-w-full"><thead class="bg-slate-800 text-white"><tr><th class="p-3">ID</th><th class="p-3 text-left">Nombre</th><th class="p-3">Acciones</th></tr></thead><tbody>
<?php foreach($rows as $r): ?><tr class="border-b border-slate-200 dark:border-slate-700"><td class="p-3 text-center"><?=e((string)$r['ID_PRO'])?></td><td class="p-3"><?=e($r['NOMBRE_PRO'])?></td><td class="p-3 text-center"><a class="mr-2 rounded bg-amber-500 px-3 py-1 text-white" href="edit.php?id=<?=$r['ID_PRO']?>">Editar</a><a class="rounded bg-red-600 px-3 py-1 text-white" href="delete.php?id=<?=$r['ID_PRO']?>" onclick="return confirm('¿Eliminar proveedor?')">Eliminar</a></td></tr><?php endforeach; ?>
</tbody></table></div><?php require __DIR__.'/../partials/footer.php'; ?>
