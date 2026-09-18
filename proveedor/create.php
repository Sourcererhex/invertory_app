<?php
require_once __DIR__.'/../config/auth.php'; require_once __DIR__.'/../config/database.php'; require_once __DIR__.'/../config/helpers.php'; require_login();
if($_SERVER['REQUEST_METHOD']==='POST'){try{$s=db()->prepare('INSERT INTO proveedor(NOMBRE_PRO) VALUES(?)');$s->execute([trim($_POST['NOMBRE_PRO'])]);flash('success','Proveedor creado.');redirect('index.php');}catch(PDOException $e){$error='No fue posible crear el proveedor.';}}
$title='Nuevo proveedor'; require __DIR__.'/../partials/header.php'; require __DIR__.'/../partials/nav.php'; ?>
<h1 class="mb-6 text-3xl font-bold">Nuevo proveedor</h1><?php if(!empty($error)):?><div class="mb-4 rounded bg-red-50 p-3 text-red-700"><?=e($error)?></div><?php endif;?>
<form method="post" class="max-w-xl space-y-4 rounded-xl theme-surface p-6 shadow"><label>Nombre<input required maxlength="20" name="NOMBRE_PRO" class="form-input mt-1 w-full rounded-lg p-2"></label><button class="rounded bg-blue-600 px-4 py-2 text-white">Guardar</button><a href="index.php" class="ml-2 rounded bg-slate-300 px-4 py-2">Cancelar</a></form>
<?php require __DIR__.'/../partials/footer.php'; ?>
