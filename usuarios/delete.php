<?php
require_once __DIR__.'/../config/auth.php';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../config/helpers.php';require_admin();
$id=(int)($_GET['id']??0);
if($id === (int)$_SESSION['ID']) { flash('error','No puede eliminar su propio usuario.'); redirect('index.php'); }
$s=db()->prepare('DELETE FROM usuarios WHERE ID=?');$s->execute([$id]);flash('success','Usuario eliminado.');redirect('index.php');
