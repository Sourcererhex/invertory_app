<?php
// Run from the PHP environment once, then delete this file.
// Example: php sql/create_first_user.php
require __DIR__ . '/../config/database.php';
$usuario = $argv[1] ?? 'admin';
$password = $argv[2] ?? 'cambiar-esta-clave';
$tipo = $argv[3] ?? 'Administrador';

$stmt = db()->prepare('INSERT INTO usuarios (USUARIO, PASSWORD, TIPO_USUARIO) VALUES (?, ?, ?)');
$stmt->execute([$usuario, password_hash($password, PASSWORD_DEFAULT), $tipo]);
echo "Usuario creado: {$usuario}\n";
