<?php
require_once __DIR__.'/../config/auth.php';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../config/helpers.php';require_login();
$id=(int)($_GET['id']??0);$s=db()->prepare('DELETE FROM material WHERE ID_MATERIAL=?');$s->execute([$id]);flash('success','Material eliminado.');redirect('index.php');
