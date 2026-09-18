<?php
require_once __DIR__.'/../config/auth.php';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../config/helpers.php';require_login();
$q=trim($_GET['q']??'');
$sql='SELECT m.*,c.NOMBRE_CAT,p.NOMBRE_PRO,u.NOMBRE_UM,u.ABREVIATURA FROM material m LEFT JOIN categoria c ON c.ID_CATEGORIA=m.ID_CATEGORIA LEFT JOIN proveedor p ON p.ID_PRO=m.ID_PRO LEFT JOIN unidad_m u ON u.ID_UM=m.ID_UM';
$params=[];
if($q!==''){$sql.=' WHERE m.NOMBRE_MATERIAL LIKE ? OR m.SKU LIKE ?';$params=["%$q%","%$q%"];}
$sql.=' ORDER BY m.ID_MATERIAL DESC';$s=db()->prepare($sql);$s->execute($params);$rows=$s->fetchAll();$title='Materiales';
require __DIR__.'/../partials/header.php';require __DIR__.'/../partials/nav.php';require __DIR__.'/../partials/flash.php';?>
<div class="mb-4 flex flex-wrap items-center justify-between gap-3"><h1 class="text-3xl font-bold">Materiales</h1><a href="create.php" class="rounded bg-blue-600 px-4 py-2 text-white">Nuevo material</a></div>
<form class="mb-5 flex gap-2"><input name="q" value="<?=e($q)?>" placeholder="Nombre o SKU" class="form-input flex-1 rounded-lg p-2"><button class="rounded bg-slate-700 px-4 py-2 text-white">Buscar</button></form>
<div class="overflow-x-auto rounded-xl theme-surface shadow"><table class="min-w-full"><thead class="bg-slate-800 text-white"><tr><th class="p-3 text-left">Material</th><th class="p-3">SKU</th><th class="p-3">Stock</th><th class="p-3">TUA</th><th class="p-3">PATA</th><th class="p-3 text-left">Categoría</th><th class="p-3 text-left">Proveedor</th><th class="p-3">Acciones</th></tr></thead><tbody>
<?php foreach($rows as $r):?><tr class="border-b border-slate-200 dark:border-slate-700"><td class="p-3 font-semibold"><?=e($r['NOMBRE_MATERIAL'])?></td><td class="p-3"><?=e($r['SKU'])?></td><td class="p-3 text-center"><?=e((string)$r['STOCK'])?></td><td class="p-3 text-center"><?=e((string)$r['TUA'])?> <?=e($r['ABREVIATURA'])?></td><td class="p-3 text-center"><?=e((string)$r['PATA'])?> (<?=e($r['NOMBRE_UM'])?>)</td><td class="p-3"><?=e($r['NOMBRE_CAT'])?></td><td class="p-3"><?=e($r['NOMBRE_PRO'])?></td><td class="p-3 whitespace-nowrap"><a class="mr-2 rounded bg-amber-500 px-3 py-1 text-white" href="edit.php?id=<?=$r['ID_MATERIAL']?>">Editar</a><a class="rounded bg-red-600 px-3 py-1 text-white" href="delete.php?id=<?=$r['ID_MATERIAL']?>" onclick="return confirm('¿Eliminar material?')">Eliminar</a></td></tr><?php endforeach;?>
</tbody></table></div><?php require __DIR__.'/../partials/footer.php';?>
