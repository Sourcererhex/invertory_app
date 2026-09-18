<?php
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/helpers.php';
require_login();
$id = (int)($_GET['id'] ?? 0);
$stmt = db()->prepare('DELETE FROM categoria WHERE ID_CATEGORIA = ?');
$stmt->execute([$id]);
flash('success', 'Categoría eliminada.');
redirect('index.php');
