<?php
require_once __DIR__.'/../config/auth.php';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../config/helpers.php';require_login();
$id=(int)($_GET['id']??0);$s=db()->prepare('SELECT * FROM unidad_m WHERE ID_UM=?');$s->execute([$id]);$row=$s->fetch();if(!$row)exit('Unidad no encontrada');
if($_SERVER['REQUEST_METHOD']==='POST'){$s=db()->prepare('UPDATE unidad_m SET NOMBRE_UM=?,ABREVIATURA=? WHERE ID_UM=?');$s->execute([trim($_POST['NOMBRE_UM']),trim($_POST['ABREVIATURA']),$id]);flash('success','Unidad actualizada.');redirect('index.php');}
$title='Editar unidad';require __DIR__.'/../partials/header.php';require __DIR__.'/../partials/nav.php';?>
<h1 class="mb-6 text-3xl font-bold">Editar unidad</h1><form method="post" class="max-w-xl space-y-4 rounded-xl theme-surface p-6 shadow"><label>Nombre<input required maxlength="50" name="NOMBRE_UM" value="<?=e($row['NOMBRE_UM'])?>" class="form-input mt-1 w-full rounded-lg p-2"></label><label>Abreviatura<input maxlength="10" name="ABREVIATURA" value="<?=e($row['ABREVIATURA'])?>" class="form-input mt-1 w-full rounded-lg p-2"></label><button class="rounded bg-blue-600 px-4 py-2 text-white">Actualizar</button><a href="index.php" class="ml-2 rounded bg-slate-300 px-4 py-2">Cancelar</a></form>
<?php require __DIR__.'/../partials/footer.php';?>
