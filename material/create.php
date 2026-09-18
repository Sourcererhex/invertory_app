<?php
require_once __DIR__.'/../config/auth.php';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../config/helpers.php';require_login();
$pdo=db();$cats=$pdo->query('SELECT ID_CATEGORIA,NOMBRE_CAT FROM categoria ORDER BY NOMBRE_CAT')->fetchAll();$pros=$pdo->query('SELECT ID_PRO,NOMBRE_PRO FROM proveedor ORDER BY NOMBRE_PRO')->fetchAll();$ums=$pdo->query('SELECT ID_UM,NOMBRE_UM,ABREVIATURA FROM unidad_m ORDER BY NOMBRE_UM')->fetchAll();
if($_SERVER['REQUEST_METHOD']==='POST'){try{$s=$pdo->prepare('INSERT INTO material(NOMBRE_MATERIAL,STOCK,SKU,FECHA_CADUCIDAD,TUA,PATA,FECHA_REGISTRO,FOTO,ID_CATEGORIA,ID_PRO,ID_UM) VALUES(?,?,?,?,?,?,?,?,?,?,?)');$s->execute([trim($_POST['NOMBRE_MATERIAL']),$_POST['STOCK'],trim($_POST['SKU']),$_POST['FECHA_CADUCIDAD']?:null,$_POST['TUA']!==''?$_POST['TUA']:null,$_POST['PATA'],$_POST['FECHA_REGISTRO']?:null,trim($_POST['FOTO'])?:null,$_POST['ID_CATEGORIA']?:null,$_POST['ID_PRO']?:null,$_POST['ID_UM']]);flash('success','Material creado.');redirect('index.php');}catch(PDOException $e){$error='No fue posible crear el material. Verifique el SKU y los datos.';}}
$title='Nuevo material';require __DIR__.'/../partials/header.php';require __DIR__.'/../partials/nav.php';?>
<h1 class="mb-6 text-3xl font-bold">Nuevo material</h1><?php if(!empty($error)):?><div class="mb-4 rounded bg-red-50 p-3 text-red-700"><?=e($error)?></div><?php endif;?>
<form method="post" class="grid max-w-4xl gap-4 rounded-xl theme-surface p-6 shadow md:grid-cols-2">
<label>Nombre<input required maxlength="100" name="NOMBRE_MATERIAL" class="form-input mt-1 w-full rounded-lg p-2"></label>
<label>SKU<input required maxlength="30" name="SKU" class="form-input mt-1 w-full rounded-lg p-2"></label>
<label>Stock<input required type="number" name="STOCK" value="0" class="form-input mt-1 w-full rounded-lg p-2"></label>
<label>Fecha caducidad<input name="FECHA_CADUCIDAD" class="form-input mt-1 w-full rounded-lg p-2" placeholder="Según formato usado por el sistema"></label>
<label>TUA<input type="number" step="0.01" name="TUA" class="form-input mt-1 w-full rounded-lg p-2"></label>
<label>PATA<input type="number" name="PATA" value="0" class="form-input mt-1 w-full rounded-lg p-2"></label>
<label>Fecha registro<input type="date" name="FECHA_REGISTRO" class="form-input mt-1 w-full rounded-lg p-2"></label>
<label>Foto<input maxlength="500" name="FOTO" class="form-input mt-1 w-full rounded-lg p-2" placeholder="Ruta/nombre de archivo"></label>
<label>Categoría<select name="ID_CATEGORIA" class="form-input mt-1 w-full rounded-lg p-2"><option value="">-- Sin categoría --</option><?php foreach($cats as $x):?><option value="<?=$x['ID_CATEGORIA']?>"><?=e($x['NOMBRE_CAT'])?></option><?php endforeach;?></select></label>
<label>Proveedor<select name="ID_PRO" class="form-input mt-1 w-full rounded-lg p-2"><option value="">-- Sin proveedor --</option><?php foreach($pros as $x):?><option value="<?=$x['ID_PRO']?>"><?=e($x['NOMBRE_PRO'])?></option><?php endforeach;?></select></label>
<label>Unidad de medida<select required name="ID_UM" class="form-input mt-1 w-full rounded-lg p-2"><?php foreach($ums as $x):?><option value="<?=$x['ID_UM']?>"><?=e($x['NOMBRE_UM'])?> (<?=e($x['ABREVIATURA'])?>)</option><?php endforeach;?></select></label>
<div class="md:col-span-2"><button class="rounded bg-blue-600 px-4 py-2 text-white">Guardar</button><a href="index.php" class="ml-2 rounded bg-slate-300 px-4 py-2">Cancelar</a></div>
</form><?php require __DIR__.'/../partials/footer.php';?>
