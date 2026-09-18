<?php
require_once __DIR__.'/../config/auth.php';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../config/helpers.php';require_admin();
$id=(int)($_GET['id']??0);$s=db()->prepare('SELECT ID,USUARIO,TIPO_USUARIO FROM usuarios WHERE ID=?');$s->execute([$id]);$row=$s->fetch();if(!$row)exit('Usuario no encontrado');
if($_SERVER['REQUEST_METHOD']==='POST'){
    if($_POST['PASSWORD']!==''){$s=db()->prepare('UPDATE usuarios SET USUARIO=?,PASSWORD=?,TIPO_USUARIO=? WHERE ID=?');$s->execute([trim($_POST['USUARIO']),password_hash($_POST['PASSWORD'],PASSWORD_DEFAULT),$_POST['TIPO_USUARIO'],$id]);}
    else{$s=db()->prepare('UPDATE usuarios SET USUARIO=?,TIPO_USUARIO=? WHERE ID=?');$s->execute([trim($_POST['USUARIO']),$_POST['TIPO_USUARIO'],$id]);}
    flash('success','Usuario actualizado.');redirect('index.php');
}
$title='Editar usuario';require __DIR__.'/../partials/header.php';require __DIR__.'/../partials/nav.php';?>
<h1 class="mb-6 text-3xl font-bold">Editar usuario</h1><form method="post" class="max-w-xl space-y-4 rounded-xl theme-surface p-6 shadow"><label>Usuario<input required maxlength="40" name="USUARIO" value="<?=e($row['USUARIO'])?>" class="form-input mt-1 w-full rounded-lg p-2"></label><label>Nueva contraseña <span class="text-slate-500 dark:text-slate-400">(vacío = conservar)</span><input minlength="8" type="password" name="PASSWORD" class="form-input mt-1 w-full rounded-lg p-2"></label><label>Tipo<select name="TIPO_USUARIO" class="form-input mt-1 w-full rounded-lg p-2"><option <?= $row['TIPO_USUARIO']==='Secre'?'selected':'' ?>>Secre</option><option <?= $row['TIPO_USUARIO']==='Administrador'?'selected':'' ?>>Administrador</option></select></label><button class="rounded bg-blue-600 px-4 py-2 text-white">Actualizar</button><a href="index.php" class="ml-2 rounded bg-slate-300 px-4 py-2">Cancelar</a></form>
<?php require __DIR__.'/../partials/footer.php';?>
