<?php
require_once __DIR__.'/../config/auth.php'; require_once __DIR__.'/../config/database.php'; require_once __DIR__.'/../config/helpers.php'; require_login();
$id=(int)($_GET['id']??0);$s=db()->prepare('SELECT * FROM proveedor WHERE ID_PRO=?');$s->execute([$id]);$row=$s->fetch();if(!$row)exit('Proveedor no encontrado');
if($_SERVER['REQUEST_METHOD']==='POST'){$s=db()->prepare('UPDATE proveedor SET NOMBRE_PRO=? WHERE ID_PRO=?');$s->execute([trim($_POST['NOMBRE_PRO']),$id]);flash('success','Proveedor actualizado.');redirect('index.php');}
$title='Editar proveedor';require __DIR__.'/../partials/header.php';require __DIR__.'/../partials/nav.php';?>
<h1 class="mb-6 text-3xl font-bold">Editar proveedor</h1><form method="post" class="max-w-xl space-y-4 rounded-xl theme-surface p-6 shadow"><label>Nombre<input required maxlength="20" name="NOMBRE_PRO" value="<?=e($row['NOMBRE_PRO'])?>" class="form-input mt-1 w-full rounded-lg p-2"></label><button class="rounded bg-blue-600 px-4 py-2 text-white">Actualizar</button><a href="index.php" class="ml-2 rounded bg-slate-300 px-4 py-2">Cancelar</a></form>
<?php require __DIR__.'/../partials/footer.php'; ?>
