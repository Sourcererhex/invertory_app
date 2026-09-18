<?php
require_once __DIR__.'/../config/auth.php';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../config/helpers.php';require_admin();
if($_SERVER['REQUEST_METHOD']==='POST'){
    try{$s=db()->prepare('INSERT INTO usuarios(USUARIO,PASSWORD,TIPO_USUARIO) VALUES(?,?,?)');$s->execute([trim($_POST['USUARIO']),password_hash($_POST['PASSWORD'],PASSWORD_DEFAULT),$_POST['TIPO_USUARIO']]);flash('success','Usuario creado.');redirect('index.php');}catch(PDOException $e){$error='No fue posible crear el usuario. El nombre puede estar repetido.';}
}
$title='Nuevo usuario';require __DIR__.'/../partials/header.php';require __DIR__.'/../partials/nav.php';?>
<h1 class="mb-6 text-3xl font-bold">Nuevo usuario</h1><?php if(!empty($error)):?><div class="mb-4 rounded bg-red-50 p-3 text-red-700"><?=e($error)?></div><?php endif;?>
<form method="post" class="max-w-xl space-y-4 rounded-xl theme-surface p-6 shadow"><label>Usuario<input required maxlength="40" name="USUARIO" class="form-input mt-1 w-full rounded-lg p-2"></label><label>Contraseña<input required minlength="8" type="password" name="PASSWORD" class="form-input mt-1 w-full rounded-lg p-2"></label><label>Tipo<select name="TIPO_USUARIO" class="form-input mt-1 w-full rounded-lg p-2"><option>Secre</option><option>Administrador</option></select></label><button class="rounded bg-blue-600 px-4 py-2 text-white">Guardar</button><a href="index.php" class="ml-2 rounded bg-slate-300 px-4 py-2">Cancelar</a></form>
<?php require __DIR__.'/../partials/footer.php';?>
