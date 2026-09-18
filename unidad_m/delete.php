<?php
require_once __DIR__.'/../config/auth.php';require_once __DIR__.'/../config/database.php';require_once __DIR__.'/../config/helpers.php';require_login();
$id=(int)($_GET['id']??0);$s=db()->prepare('DELETE FROM unidad_m WHERE ID_UM=?');$s->execute([$id]);flash('success','Unidad eliminada.');redirect('index.php');
