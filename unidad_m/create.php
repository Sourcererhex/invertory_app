<?php
require_once __DIR__.'/../config/auth.php';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../config/helpers.php';require_login();
if($_SERVER['REQUEST_METHOD']==='POST'){$s=db()->prepare('INSERT INTO unidad_m(NOMBRE_UM,ABREVIATURA) VALUES(?,?)');$s->execute([trim($_POST['NOMBRE_UM']),trim($_POST['ABREVIATURA'])]);flash('success','Unidad creada.');redirect('index.php');}
$title='Nueva unidad';require __DIR__.'/../partials/header.php';require __DIR__.'/../partials/nav.php';?>
<h1 class="mb-6 text-3xl font-bold">Nueva unidad de medida</h1><form method="post" class="max-w-xl space-y-4 rounded-xl theme-surface p-6 shadow"><label>Nombre<input required maxlength="50" name="NOMBRE_UM" class="form-input mt-1 w-full rounded-lg p-2"></label><label>Abreviatura<input maxlength="10" name="ABREVIATURA" class="form-input mt-1 w-full rounded-lg p-2"></label><button class="rounded bg-blue-600 px-4 py-2 text-white">Guardar</button><a href="index.php" class="ml-2 rounded bg-slate-300 px-4 py-2">Cancelar</a></form>
<?php require __DIR__.'/../partials/footer.php';?>
